<?php
include 'conn.php';
$response = array();
class retrieve_card extends connection{
    private $email;
    public function retrieve_it($EM){
        global $response;
        $this->email = $EM;
        $sql = "SELECT auth_code,card_type,card,email FROM authorization WHERE email = ?;";
        $smt = $this->connect()->prepare($sql);
        $send = $smt->execute([$this->email]);
        $count = $smt->rowCount();
        if($send){
            if($count >= 1){
                $result = $smt->fetchAll();
                $response['error'] = false;
                $response['message'] = 'card_exist'; 
                $response['data'] = $result;
            }else{
                $response['error'] = false;
                $response['message'] = 'no_card';
            }
           
        }else{
            $response['error'] = true;
            $response['message'] = 'internal db error';
        }
    }
    
}
$email = $_POST['email'];
$try = new retrieve_card;
$try->retrieve_it($email);
echo json_encode($response);