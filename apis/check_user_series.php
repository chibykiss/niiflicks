<?php
session_start();
include 'conn.php';
include_once 'client_loc.php';
class checkEmail extends connection{
    private $email;
    private $serieid;
    private $serienm;
    private $seasonid;
    private $seano;
    private $epid;
    private $location;
    public function user_email($EM,$SID,$SEID,$SNM,$SNO,$EPI){
        $this->email = $EM;
        $this->serieid = $SID;
        $this->seasonid = $SEID;
        $this->serienm = $SNM;
        $this->seano = $SNO;
        $this->epid = $EPI;
        $this->location = getVisIpAddr();
        //check if user exists as a niiflicks app user
        $sql = "SELECT email FROM users WHERE email = ?;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->email]);

        $count = $stmt->rowCount();
        if($count == 1){
            
            //check if movie is available in your country
            $sqlst = "SELECT distribution FROM d_tvseries WHERE id = '$this->serieid';";
            $sqmt = $this->connect()->prepare($sqlst);
            $sqmt->execute();

            
            $dist = $sqmt->fetch();//get the ditribution from db
            $dcons = $dist['distribution'];
            $decoded = json_decode($dcons);
            if (in_array($this->location, $decoded)){
            //check if you have already purchased this token
            $query = "SELECT * FROM token_series WHERE user_mail = ? AND series_id = ? AND season_id = ?;";
            $smt = $this->connect()->prepare($query);
            $smt->execute([$this->email,$this->serieid,$this->seasonid]);

            $count = $smt->rowCount();
            if($count == 1){
                echo 'purchased';
                if(isset($_SESSION['serie_id']) || isset($_SESSION['season_id']) || isset($_SESSION['user_ms']) || isset($_SESSION['serie_name']) || isset($_SESSION['season_num']) || isset($_SESSION['epis_id'])){
                    unset($_SESSION['serie_id']);
                    unset($_SESSION['season_id']);
                    unset($_SESSION['user_ms']);
                    unset($_SESSION['serie_name']);
                    unset($_SESSION['season_num']);
                    unset($_SESSION['epis_id']);
                    $_SESSION['serie_id'] = $this->serieid;
                    $_SESSION['season_id'] = $this->seasonid;
                    $_SESSION['user_ms'] = $this->email;
                    $_SESSION['serie_name'] = $this->serienm;
                    $_SESSION['season_num'] = $this->seano;
                    $_SESSION['epis_id'] = $this->epid;
                }else{
                    $_SESSION['serie_id'] = $this->serieid;
                    $_SESSION['season_id'] = $this->seasonid;
                    $_SESSION['user_ms'] = $this->email;
                    $_SESSION['serie_name'] = $this->serienm;
                    $_SESSION['season_num'] = $this->seano;
                    $_SESSION['epis_id'] = $this->epid;
                }
               
            }else{
                echo 'exists';
                if(isset($_SESSION['serie_id']) || isset($_SESSION['season_id']) || isset($_SESSION['user_ms']) || isset($_SESSION['serie_name']) || isset($_SESSION['season_num']) || isset($_SESSION['epis_id'])){
                    unset($_SESSION['serie_id']);
                    unset($_SESSION['season_id']);
                    unset($_SESSION['user_ms']);
                    unset($_SESSION['serie_name']);
                    unset($_SESSION['season_num']);
                    unset($_SESSION['epis_id']);
                    $_SESSION['serie_id'] = $this->serieid;
                    $_SESSION['season_id'] = $this->seasonid;
                    $_SESSION['user_ms'] = $this->email;
                    $_SESSION['serie_name'] = $this->serienm;
                    $_SESSION['season_num'] = $this->seano;
                    $_SESSION['epis_id'] = $this->epid;
                }else{
                    $_SESSION['serie_id'] = $this->serieid;
                    $_SESSION['season_id'] = $this->seasonid;
                    $_SESSION['user_ms'] = $this->email;
                    $_SESSION['serie_name'] = $this->serienm;
                    $_SESSION['season_num'] = $this->seano;
                    $_SESSION['epis_id'] = $this->epid;
                }
            }

            }else{
                echo 'Movie not available in your country';
            }

        }else{
            echo 'you are not a registered niiflicks user';
        }

    }

}

// $tryit = new checkEmail;
// $tryit->user_email('ezumachibuike@gmail.com',6,9,'Black Adam'); 

if(isset($_POST['email']) && isset($_POST['serie_id']) && isset($_POST['serie_name']) && isset($_POST['season_id']) && isset($_POST['seasonno']) && isset($_POST['episid'])){
    $email = $_POST['email'];
    $serie_id = $_POST['serie_id'];
    $serie_name = $_POST['serie_name'];
    $season_id = $_POST['season_id'];
    $season_num = $_POST['seasonno'];
    $episid = $_POST['episid'];
    trim($email);
    stripslashes($email);
    
    if($email == ''){
        echo 'email cannot be empty';
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
      }
    else{
        $tryit = new checkEmail;
        $tryit->user_email($email,$serie_id,$season_id,$serie_name,$season_num,$episid); 
    }
}else{
    echo 'email and movie id not set';
    header("Location: ../index.php");
}

