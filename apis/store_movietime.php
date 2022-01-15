<?php
//echo json_encode('its arriving');
include_once 'conn.php';
$response = array();
class resumable extends connection{
    private $email;
    private $movid;
    private $ctime;
    public function set_currenttime($EM,$MID,$CT){
        global $response;
        $this->email = $EM;
        $this->movid = $MID;
        $this->ctime = $CT;
        //check id the user already has a saved resumable time
        $sql = "SELECT email FROM resume_movie WHERE email = '$this->email' AND movie_id = '$this->movid'";
        $smt = $this->connect()->prepare($sql);
        $smt->execute();
        $exist = $smt->rowCount();
        if($exist == 1){
            $query = "UPDATE resume_movie SET resumable_time = ? WHERE email = ? AND movie_id = ?";
            $stmt = $this->connect()->prepare($query);
            $send = $stmt->execute([$this->ctime,$this->email,$this->movid]);
            if($send){
                $response['message'] = 'time updated';
            }else{
                $response['message'] = 'time update failed';
            }
        }else{
            $sqlt = "INSERT INTO resume_movie(email,movie_id,resumable_time) VALUES(?,?,?);";
            $swmt = $this->connect()->prepare($sqlt);
            $result = $swmt->execute([$this->email,$this->movid,$this->ctime]);
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
if(isset($_POST['email']) && isset($_POST['mid']) && isset($_POST['ctime'])){
    $email = $_POST['email'];
    $mid = $_POST['mid'];
    $curnt = $_POST['ctime'];
    $try = new resumable;
    $try->set_currenttime($email,$mid,$curnt);
}
echo json_encode($response);