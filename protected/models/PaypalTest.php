<?php
class PaypalTest extends CComponent{

public $api_user = "test-facilitator_api1.toxsl.com";
public $api_pass = "97C5N7F7Q687QHJV";
public $api_sig = "AFcWxV21C7fd0v3bYYYRCpSSRl31A1E1n6ikmTNjr3NLuwYK1.oEaDD4";
public $app_id = "APP-80W284485P519543T";
public $apiUrl = 'https://svcs.sandbox.paypal.com/AdaptivePayments/';
public $paypalUrl="https://www.paypal.com/webscr?cmd=_ap-payment&paykey=";
public $headers;

public function __construct(){
    $this->headers = array(
        "X-PAYPAL-SECURITY-USERID: ".$this->api_user,
        "X-PAYPAL-SECURITY-PASSWORD: ".$this->api_pass,
        "X-PAYPAL-SECURITY-SIGNATURE: ".$this->api_sig,
        "X-PAYPAL-REQUEST-DATA-FORMAT: JSON",
        "X-PAYPAL-RESPONSE-DATA-FORMAT: JSON",
        "X-PAYPAL-APPLICATION-ID: ".$this->app_id,
    );
}

public function getPaymentOptions($paykey){

}
public function setPaymentOptions(){

}
public function _paypalSend($data,$call){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->apiUrl.$call);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
    $response = json_decode(curl_exec($ch),true);
    return $response;

}
public function splitPay(){
 
    // create the pay request
    $createPacket = array(
        "actionType" =>"PAY",
        "currencyCode" => "USD",
        "receiverList" => array(
            "receiver" => array(
                array(
                    "amount"=> "1.00",
                    "email"=>"test@toxsl.com"
                ),
               /*  array(
                    "amount"=> "2.00",
                    "email"=>"********@gmail.ca"
                ), */
            ),
        ),
        "returnUrl" => "http://test.local/payments/confirm",
        "cancelUrl" => "http://test.local/payments/cancel",
        "requestEnvelope" => array(
            "errorLanguage" => "en_US",
            "detailLevel" => "ReturnAll",
        ),
    );

    $response = $this->_paypalSend($createPacket,"Pay");
   
}
}