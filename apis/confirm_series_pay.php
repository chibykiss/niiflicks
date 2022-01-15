<?php
// echo json_encode('its arriving here');
header('Content-Type: application/json');
include 'conn.php';
$response = array();
class confirm_pay extends connection{
    private $email;
    private $serieid;
    private $seasonid;
    private $seriename;

    public function confirm_it($EM,$SID,$SEID,$SNM){
        global $response;
        $this->email = $EM;
        $this->serieid = $SID;
        $this->seasonid = $SEID;
        $this->seriename = $SNM;
        $query = "SELECT user_mail FROM token_series WHERE user_mail = ? AND series_id = ? AND season_id=?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$this->email,$this->serieid,$this->seasonid]);
        $count = $stmt->rowCount();
        if($count == 1){
            $response['error'] = false;
            $response['message'] = 'purchased';
        }else{
            $sql = "INSERT INTO token_series(user_mail,series_id,season_id) VALUES(?,?,?)";
            $smt = $this->connect()->prepare($sql);
            $send = $smt->execute([$this->email,$this->serieid,$this->seasonid]);
            if($send){
                $response['error'] = false;
                $response['message'] = 'inserted';
            }else{
                $response['error'] = true;
                $response['message'] = 'internal db error';
            }
        }
       
    }
}
// $try = new confirm_pay;
// $try->confirm_it('ezumachibuike@gmail.com',12,14,'lost');
if(isset($_POST['sea_id']) && isset($_POST['dmovie']) && isset($_POST['dmail']) && isset($_POST['mid'])){
    $seasonid = $_POST['sea_id'];
    $email = $_POST['dmail'];
    $seriesid = $_POST['mid'];
    $seriename = $_POST['dmovie'];

    // $response['seasonid'] = $seasonid;
    // $response['email'] = $email;
    // $response['seriesid'] = $seriesid;
    // $response['seriesname'] = $seriename;

    $try = new confirm_pay;
    $try->confirm_it($email,$seriesid,$seasonid,$seriename);
}else{
    $response['error'] = true;
    $response['message'] = 'values_not_set';
}
echo json_encode($response);
