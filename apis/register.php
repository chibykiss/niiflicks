<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'conn.php';
$response = array();
class register extends connection{
    private $fname;
    private $mail;
    private $pass;

    public function register_me($FN,$ML,$PW){
        global $response;
        $this->fname=$FN;
        $this->mail=$ML;
        $this->pass=$PW;

        $query = "SELECT email FROM users WHERE email = ?;";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$this->mail]);
        $exists = $stmt->rowCount();
        if($exists == 1){
            $response['error'] = true;
            $response['message'] = 'exists';
        }else{
            $sql = "INSERT INTO users(fullname,email,password) VALUES (?,?,?);";
            $smt = $this->connect()->prepare($sql);
            $send = $smt->execute([$this->fname,$this->mail,$this->pass]);
          
            if($send){
                $response['error'] = false;
                $response['message'] = 'registered';
       
            }else{
                $response['error'] = true;
                $response['message'] = 'failed';
            }
        }
      
    }
}

if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['pwd'])){
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$fullname = $firstname.' '.$lastname;
$try = new register;
$try->register_me($fullname,$email,$pwd);
}else{
$response['error'] = true;
$response['mesaage'] = 'not set';
}



echo json_encode($response);