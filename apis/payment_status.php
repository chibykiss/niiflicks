<?php
include 'conn.php';
class pay_status extends connection{
    private $trans_id;
    private $trans_ref;
    private $email;
    public function payment_status($TID,$TR,$ML){
        $this->trans_id = $TID;
        $this->trans_ref = $TR;
        $this->email = $ML;
                $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$this->trans_ref",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_bcd7a00020044b8a30409f18a163b55c9cd21d30",
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $new_res = json_decode($response);
            $sig = $new_res->data->authorization->signature;
            $reuse = $new_res->data->authorization->reusable;
            // print_r($new_res->data->authorization);
            if($reuse == 1){
                $query = "SELECT signature FROM authorization WHERE signature = '$sig' AND email = '$this->email';";
                $stmt = $this->connect()->prepare($query);
                $stmt->execute();
                $count = $stmt->rowCount();
                if($count != 1){
                    $auth_code = $new_res->data->authorization->authorization_code;
                    $card_type = $new_res->data->authorization->card_type;
                    $first6 = $new_res->data->authorization->bin;
                    $last4 = $new_res->data->authorization->last4;
                    $bank = $new_res->data->authorization->bank;
                    $acct_name = $new_res->data->authorization->account_name;
                    $expmnt = $new_res->data->authorization->exp_month;
                    $expyr = $new_res->data->authorization->exp_year;
                    $country_code = $new_res->data->authorization->country_code;
                    $card = '**** **** **** '.$last4;
                    $details = $expmnt.','.$expyr.','.$country_code;
                    $email = $this->email;
        
                    // echo $auth_code.$card_type.$card.$bank.$sig.$acct_name.$details.$this->email;
                    $sql = "INSERT INTO 
                    authorization(email,auth_code,card_type,card,bank,signature,account_name,details)
                    VALUES('$email','$auth_code','$card_type','$card','$bank','$sig','$acct_name','$details');";
                    $smt = $this->connect()->prepare($sql);
                    $send = $smt->execute();
        
                      
                }
             
          
                
            }
          echo $response;
        }
    }
}

$trans_id = $_GET['trxid'];
$trans_ref = $_GET['trxref'];
$email = $_GET['email'];
// echo json_encode($trans_id.''.$trans_ref);
$transaction = new pay_status;
$transaction->payment_status($trans_id,$trans_ref,$email);
?>