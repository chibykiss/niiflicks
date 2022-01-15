<?php
// echo json_encode('this is series');
session_start();
include 'conn.php';
$response = array();
class check_serie extends connection{
    private $email;
    private $sid;
    private $seaid;
    private $episid;
    private $seano;
    public function process_serie($EM,$SID,$SEAID,$EPID,$SENO){
        global $response;
        $this->email = $EM;
        $this->sid = $SID;
        $this->seaid = $SEAID;
        $this->episid = $EPID;
        $this->seano = $SENO;
        try{
            $query = "SELECT email FROM users WHERE email = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->email]);
            $exists = $stmt->rowCount();
            if($exists == 1){
                $sql = "SELECT user_mail,series_id,season_id FROM token_series WHERE user_mail = ? AND series_id = ? AND season_id = ?";
                $smt = $this->connect()->prepare($sql);
                $send = $smt->execute([$this->email,$this->sid,$this->seaid]);
                if($send){
                    $count = $smt->rowCount();
                    if($count == 1){
                        $result = $smt->fetch();
                        $response['error'] = false;
                        $response['message'] = 'aquired';
                            if(isset($_SESSION['s_id']) && isset($_SESSION['sea_id']) && isset($_SESSION['uml']) && isset($_SESSION['epz_id']) && isset($_SESSION['ses_no'])){
                                unset($_SESSION['s_id']);
                                unset($_SESSION['sea_id']);
                                unset($_SESSION['uml']);
                                unset($_SESSION['epz_id']);
                                unset($_SESSION['ses_no']);
                                $_SESSION['s_id'] = $result['series_id'];
                                $_SESSION['sea_id'] = $result['season_id'];
                                $_SESSION['uml'] = $result['user_mail'];
                                $_SESSION['epz_id'] = $this->episid;
                                $_SESSION['ses_no'] = $this->seano;
                            }
                            else{
                                $_SESSION['s_id'] = $result['series_id'];
                                $_SESSION['sea_id'] = $result['season_id'];
                                $_SESSION['uml'] = $result['user_mail'];
                                $_SESSION['epz_id'] = $this->episid;
                                $_SESSION['ses_no'] = $this->seano;
                            }
                    }else{
                        $response['error'] = false;
                        $response['message'] = 'not_found';
                    }
                }

            }else{
                $response['error'] = false;
                $response['message'] = 'not_user';
            }
         
        }
        catch(Exception $e){
            echo json_encode('Meaasege ' .$e->getMessage());
        }
        
    }
}
if(isset($_POST['seaid']) && isset($_POST['sid']) && isset($_POST['email']) && isset($_POST['epsid'])){
    $serieid = $_POST['sid'];
    $seasonid = $_POST['seaid']; 
    $userml = $_POST['email'];
    $epid = $_POST['epsid'];
    $season_no = $_POST['seano'];
}
$initiate = new check_serie;
$initiate->process_serie($userml,$serieid,$seasonid,$epid,$season_no);
echo json_encode($response);