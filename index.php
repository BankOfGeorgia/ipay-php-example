<?php
require_once('template/index.html');

if (isset($_POST['pay']) || isset($_POST['installment']) || isset($_POST['cardpayment'])) {
    $token = getToken(1006, '581ba5eeadd657c8ccddc74c839bd3ad');
    $intent = (isset($_POST['pay']) ? 'CAPTURE' : (isset($_POST['cardpayment']) ? 'AUTHORIZE' : 'LOAN'));
    $items = [
        0 =>
            [
                'amount' => '100.0',
                'description' => 'desc_1',
                'product_id' => '11111',
                'quantity' => 1,
            ],
        1 =>
            [
                'amount' => '50.00',
                'description' => 'desc_2',
                'product_id' => '11112',
                'quantity' => 1,
            ]
    ];

    $response = makeOrder($token, $intent, '$https://demo.ipay.ge', 'ka', true, $items, null,null);

    if (isset($response['order_id'])) {
        $payment_hash = $response['payment_hash'];
        $order_id = $response['order_id'];
        $redirect_url = $response['links'][1]['href'];
        header("Location:" . $redirect_url);
    }
}

function getToken($client_id, $secret_key)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(

        //For production replace https://dev.ipay.ge/ to https://ipay.ge
        CURLOPT_URL => "https://dev.ipay.ge/opay/api/v1/oauth2/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",

        //The "grant_type=client_credentials" means that you are sending a username and a password to the "oauth2/token" endpoint
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/x-www-form-urlencoded",

            //iPay client_id and secret_key in base64
            "Authorization: Basic " . base64_encode($client_id . ':' . $secret_key)
        ],
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response = json_decode($response, true);
    return $response['access_token']; //access token from response

}

function makeOrder($token, $intent, $redirect_url, $locale, $show_shop_order_id_on_extract, $items, $loan_code,$card_transaction_id)
{
    $postfields = [
        /**
         * CAPTURE – provides several payment options for users, on the same page. Payment can be performed
         * by card and with BOG digital credentials ( username & password )
         * AUTHORIZE – Allows users to pay only with entering card details.
         * LOAN - users can pay with only installment option. For this
         * user should enter BOG credentials, username / password and go through
         * installment payment process.
         */
        // ENUM: CAPTURE, AUTHORIZE, LOAN
        'intent' => $intent,

        //URL of the page to which the payer will be redirected after a success/failure payment. Does not contain any data
        'redirect_url' => $redirect_url,

        //Shop order id
        'shop_order_id' => '123465',

        //Used for recurring payment. Optional
        'card_transaction_id' => $card_transaction_id,

        //Default: "ka". Enum: "ka" "en-US". Localization on which ipay.ge payment page will be displayed. Defaulted to ka if not provided or invalid.
        'locale' => $locale,

        //BOOLEAN. If the value is true, shop_order_id will appear in the extract. default: true
        'show_shop_order_id_on_extract' => $show_shop_order_id_on_extract,

        //Used in case the offer is valid for installment plan.
        'loan_code' => $loan_code,

        'purchase_units' =>
            [
                0 =>
                    [
                        'amount' =>
                            [
                                //Enum: "GEL" "USD" "EUR"
                                'currency_code' => 'GEL',

                                //Total amount
                                'value' => '150',
                            ],
                        'industry_type' => 'ECOMMERCE',
                    ],
            ],
        //product list - optional
        'items' => $items
        ,
    ];

    $curl = curl_init();

    curl_setopt_array($curl, array(

        //For production replace https://dev.ipay.ge/ to https://ipay.ge
        CURLOPT_URL => "https://dev.ipay.ge/opay/api/v1/checkout/orders",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($postfields),
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",

            //access token
            "Authorization: Bearer " . $token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response = json_decode($response, true);
    return $response;
}

//EOF