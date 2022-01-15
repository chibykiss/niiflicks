<?php
include 'conn.php';
class get_time extends connection{
    private $email;
    private $serieid;
    private $seasonid;
    private $episodeid;
    public function check_resumable($EM,$SID,$SEAID,$EPID){
        $response = array();
        $this->email = $EM;
        $this->serieid = $SID;
        $this->seasonid = $SEAID;
        $this->episodeid = $EPID;
        $sql = "SELECT time FROM resume_serie WHERE email=? AND serie_id=? AND season_id=? AND episode_id=?";
        $smt = $this->connect()->prepare($sql);
        $send = $smt->execute([$this->email,$this->serieid,$this->seasonid,$this->episodeid]);
        $exist = $smt->rowCount();
        if($send){
            if($exist == 1){
                $result = $smt->fetch();
                $response['error'] = false;
                $response['message'] = 'it exists';
                $response['data'] = $result['time'];
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
if(isset($_POST['email']) && isset($_POST['sid']) && isset($_POST['seaid']) && isset($_POST['episid'])){
    $email = $_POST['email'];
    $sid = $_POST['sid'];
    $seaid = $_POST['seaid'];
    $episid = $_POST['episid'];
    $try = new get_time;
    $try->check_resumable($email,$sid,$seaid,$episid);
}