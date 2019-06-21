<?php
session_start();
/**
 * ვამოწმებთ თუ არსებობს პოსტი order_id და payment_hash-ით.
 * თუ სესიაში იძებნება მსგავსი გადახდა ვაბრუნდებთ header response code 200-ს  და თუ არა მაშინ შესაბამის კოდს.
 * ლინკის მაგალითი https://.ge/callback.php?order_id=your_order_id&payment_hash=your_payment_hash
 * https://upriani.ge/callback.php - ეს არის თქვენი მაღაზიის ქოლბექების მისამართი
 * p.s შეგიძლიათ შეცვალოთ სურვილისამებრ, ოღონდ უნდა მოგვაწოდოთ რომ ჩვენთან გაიწეროს
 * თუ თქვენგან არასწორი პასუხი დაბრუნდება, ქოლბექები გამეორდება 5 ჯერ და შემდეგ გადავა უარყოფილ სტატუსზე.
 */
if (isset($_POST['order_id']) && isset($_POST['payment_hash']) && !empty($_POST['order_id']) && !empty($_POST['payment_hash'])) {
    $PAYMENTID = (isset($_POST['order_id']) && !empty($_POST['order_id']) ? $_POST['order_id'] : '');
    $PAYMENT_HASH = (isset($_POST['payment_hash']) && !empty($_POST['payment_hash']) ? $_POST['payment_hash'] : '');
    $PAN = $_POST['pan']; // ბარათის დამაკსული პანი რომლითაც მოხდა ანგარიშსწორება
    $TRANSACTION_ID = $_POST['transaction_id']; // ტრანზაქციის იდენტიფიკატორი რომელიც საჭიროა რეკურენტული გადახდისთვის
    // log($PAYMENTID,$PAYMENT_HASH,$PAN,$TRANSACTION_ID)
    foreach ($_SESSION['payment_hash'] as $key => $value) {
        if ($key == $PAYMENTID && $value == $PAYMENT_HASH) {
            header("HTTP/1.1 200 Ok");
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

} else {
    require_once "template/index.html";
    if (isset($_POST['pay']) & !empty($_POST)) {

        $ipayAuthorizationURL = 'https://dev.ipay.ge/opay/api/v1/oauth2/token'; // IPay ავტორიზაციის ლინკი

        $ipayCheckoutURL = 'https://dev.ipay.ge/opay/api/v1/checkout/orders'; // IPay გადახდის ლინკი

        $usernameAndPassword = '1006:581ba5eeadd657c8ccddc74c839bd3ad'; // IPay მერჩანტის იდენტიფიკატორი და პაროლი

        $redirect_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // პარამეტრში ვუთითებთ იმ მისამართს რომელზეც უნდა გადმოვიდეს მომხმარებელი წარმატებული ან წარუმატებელი გადახდის შემდეგ

        $checkoutDetails = [
            "intent" => "CAPTURE",
            "redirect_url" => "",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "GEL",
                        "value" => 0
                    ],
                    "industry_type" => "ECOMMERCE"
                ]
            ],
            "items" => []
        ]; //checkout details array

        $amount = 1.00; //პროდუქტის ფასი
        $description = "product description text"; //პროდუქტის აღწერა
        $product_id = "123456789"; //პროდუქტის იდენტიფიკატორი
        $quantity = 1; //პროდუქტის რაოდენობა

        array_push($checkoutDetails["items"],
            ["amount" => $amount, "description" => $description, "product_id" => $product_id, "quantity" => $quantity]); // items-ში უნდა ჩავწეროთ ყველა განსვავებული პროდუქტი თავისი თვისებებით

        $checkoutDetails["purchase_units"][0]["amount"]["value"] = $amount; // მოცემულ ამეტრში ვუთითებთ ჯამურ თანხას

        $checkoutDetails["redirect_url"] = $redirect_url;

        $authorizationResponse = ipayAuthorization($ipayAuthorizationURL, $usernameAndPassword);

        if ($authorizationResponse["access_token"]) {
            $checkoutResponse = ipayCheckout($authorizationResponse["access_token"], $ipayCheckoutURL, $checkoutDetails);
            if (isset($checkoutResponse["status"])) {
                foreach ($checkoutResponse["links"] as $link) {
                    if ($link["rel"] && $link["rel"] == "self") {
                        $_SESSION['payment_hash'][$checkoutResponse['id']] = $checkoutResponse['payment_hash']; // ეს არის payment_hash, არის უნიკალური გადახდის ჭრილში და დაბრუნდება ..api/v1/checkout/orders დროს.
                        // ამ ხეშით მოგმართავთ ipay.ge ქოლბექის დროს. სასურველია ბაზაში შეინახოთ გადახდასთან ერთად. ამ შემთხვევაში ვინახავთ სესიაში დემონსტრაცისთვის.
                    }

                    if ($link["rel"] && $link["rel"] == "approve") {
                        header("Location:" . $link["href"]);
                    }
                }
            } else {
                print_r($checkoutResponse);
            }
        } else {
            print_r($authorizationResponse);
        }
    }
}

/**
 * @param $ipayAuthorizationURL
 * @param $usernameAndPassword
 * @return bool|mixed
 */

function ipayAuthorization($ipayAuthorizationURL, $usernameAndPassword)
{
    $options = (array(
        "http" => array(
            "method" => "POST",
            "header" => "Content-type: application/x-www-form-urlencoded\r\n" . "Authorization: Basic " . base64_encode($usernameAndPassword),
            "content" => http_build_query(array("grant_type" => "client_credentials"))
        )
    ));

    $context = stream_context_create($options);

    $response = json_decode(file_get_contents($ipayAuthorizationURL, false, $context), true);
    if (isset($response["access_token"])) {
        return $response;
    }
    return false;
}

/**
 * @param $token
 * @param $ipayCheckoutURL
 * @param $checkoutDetails
 * @return bool|mixed
 */
function ipayCheckout($token, $ipayCheckoutURL, $checkoutDetails)
{
    $options = (array(
        "http" => array(
            "method" => "POST",
            "header" => "Content-type: application/json \r\n" . "Authorization: Bearer " . $token,
            "content" => json_encode($checkoutDetails)
        )
    ));
    $context = stream_context_create($options);
    $response = json_decode(file_get_contents($ipayCheckoutURL, false, $context), true);
    if (isset($response["status"])) {
        return $response;
    }
    return false;
}