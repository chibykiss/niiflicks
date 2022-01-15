<?php
//echo json_encode('its arriving');
include_once 'conn.php';
$response = array();
class resumable extends connection{
    private $email;
    private $sid;
    private $seaid;
    private $epid;
    private $ctime;
    public function set_currenttime($EM,$SID,$SEAID,$EPID,$CT){
        global $response;
        $this->email = $EM;
        $this->sid = $SID;
        $this->seaid = $SEAID;
        $this->epid = $EPID;
        $this->ctime = $CT;
        //check id the user already has a saved resumable time
        $sql = "SELECT email FROM resume_serie WHERE email=? AND serie_id=? AND season_id=? AND episode_id=?";
        $smt = $this->connect()->prepare($sql);
        $smt->execute([$this->email,$this->sid,$this->seaid,$this->epid]);
        $exist = $smt->rowCount();
        if($exist == 1){
            $query = "UPDATE resume_serie SET time = ? WHERE email = ? AND serie_id = ? AND season_id=? AND episode_id=?";
            $stmt = $this->connect()->prepare($query);
            $send = $stmt->execute([$this->ctime,$this->email,$this->sid,$this->seaid,$this->epid]);
            if($send){
                $response['message'] = 'time updated';
            }else{
                $response['message'] = 'time update failed';
            }
        }else{
            $sqlt = "INSERT INTO resume_serie(email,serie_id,season_id,episode_id,time) VALUES(?,?,?,?,?);";
            $swmt = $this->connect()->prepare($sqlt);
            $result = $swmt->execute([$this->email,$this->sid,$this->seaid,$this->epid,$this->ctime]);
            if($result){
                $response['message'] = 'new time inserted';
            }else{
                $response['message'] = 'new time insertion failed';
            }
        }
    }
}
// $try = new resumable;
// $try->set_currenttime('ezumachibuike@gmail.com',10,12.23);
if(isset($_POST['email']) && isset($_POST['sid']) && isset($_POST['seaid']) && isset($_POST['episid']) && isset($_POST['ctime'])){
    $email = $_POST['email'];
    $sid = $_POST['sid'];
    $seaid = $_POST['seaid'];
    $episid = $_POST['episid'];
    $curnt = $_POST['ctime'];
    $try = new resumable;
    $try->set_currenttime($email,$sid,$seaid,$episid,$curnt);
}
echo json_encode($response);