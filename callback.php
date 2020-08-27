<?php

/**
 * Callbackurl is used to direct iPay to a web service that you have setup
 * which can receive the order transaction status.
 * Data sent to the server using POST and contain the following parameters:
 * @property string $status
 * @property string|null $pan
 * @property string $order_id
 * @property string $payment_hash
 * @property int $ipay_payment_id
 * @property string|null $shop_order_id
 * @property string $payment_method
 * @property string $card_type
 * @property string|null $transaction_id
 */
if (isset($_POST['order_id'])) {
    if ($order_id == $_POST['order_id'] && $payment_hash == $_POST['payment_hash']) {

        //your code

        //When you receive a callback, you must return the corresponding HTTP code
        header("HTTP/1.1 200 Ok");
    } else {
        header("HTTP/1.0 404 Not Found");
    }
}
