<?php
require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
session_start();
class recurrent{
    private $auth_code;
    private $email;
    private $amount;

    public function recurent_pay($AC,$EM,$AM){
        $this->auth_code = $AC;
        $this->email = $EM;
        $this->amount = $AM;
        $this->amount = $this->amount * 100;
        $url = "https://api.paystack.co/transaction/charge_authorization";
        $fields = [
        'authorization_code' => $this->auth_code,
        'email' => $this->email,
        'amount' => $this->amount,
        'subaccount' => $_ENV['PAYSTACK_SUBACCT']
        ];
        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();
    
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
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
        $newres = json_decode($result);
        // print_r($newres);
        $refs = $newres->data->reference;
        header("location: ../payment_success.php?trxref=$refs&reference=$refs");
        // echo $result;

    }

}

// $try = new recurrent;
// $try->recurent_pay('AUTH_q6qel6ndfk','kellysmart@gmail.com',300);
if(isset($_GET['auth']) && isset($_GET['email']) && isset($_GET['amount']) && isset($_GET['type'])){
    $authorization = $_GET['auth'];
    $mail = $_GET['email'];
    $price = $_GET['amount']; 
    $type = $_GET['type'];
    if(isset($_SESSION['show_type'])){
        unset($_SESSION['show_type']);
        $_SESSION['show_type'] = $type;
    }else{
        $_SESSION['show_type'] = $type; 
    }
    
    $try = new recurrent;
    $try->recurent_pay($authorization,$mail,$price);
}else{
    echo 'not set';
}
?>