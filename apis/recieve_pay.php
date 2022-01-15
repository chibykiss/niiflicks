<?php
require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
session_start();
class payPaystack{
    private $email;
    private $amount;
    private $url;

    public function initPay($EM,$AM){
        $this->email = $EM;
        $this->amount = $AM;
        $this->url = "https://api.paystack.co/transaction/initialize";
        $this->amount = $this->amount * 100;

        $fields = [
            'email' => $this->email,
            'amount' => $this->amount,
            'subaccount' => $_ENV['PAYSTACK_SUBACCT']
          ];

          $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $this->url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$_ENV["PAYSTACK_SKEY"].'',
        "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

        //execute post
        $result = curl_exec($ch);
        echo $result;

    }
}

// $email = 'fresh@gmail.com';
// $amount = '2000';
// $type = 'movie';
$email = $_POST['email'];
$amount = $_POST['amount'];
$type = $_POST['type'];
if(isset($_SESSION['show_type'])){
    unset($_SESSION['show_type']);
    $_SESSION['show_type'] = $type;
}else{
    $_SESSION['show_type'] = $type; 
}
$pay = new payPaystack;
$pay->initPay($email,$amount);
