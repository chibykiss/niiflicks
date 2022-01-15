<?php
include 'conn.php';
class get_time extends connection{
    private $email;
    private $movieid;
    public function check_resumable($EM,$MD){
        $response = array();
        $this->email = $EM;
        $this->movieid = $MD;
        $sql = "SELECT resumable_time FROM resume_movie WHERE email = '$this->email' AND movie_id = '$this->movieid'";
        $smt = $this->connect()->prepare($sql);
        $send = $smt->execute();
        $exist = $smt->rowCount();
        if($send){
            if($exist == 1){
                $result = $smt->fetch();
                $response['error'] = false;
                $response['message'] = 'it exists';
                $response['data'] = $result['resumable_time'];
            }else{
                $response['error'] = false;
                $response['message'] = 'it doesent exist';
                $response['data'] = 'not_exist';
            }
        }
        echo json_encode($response);
    }
}
// $try = new get_time;
// $try->check_resumable('ezumachibuike@gmail.com',13);
if(isset($_POST['email']) && isset($_POST['mid'])){
    $email = $_POST['email'];
    $mid = $_POST['mid'];
    $try = new get_time;
    $try->check_resumable($email,$mid);
}