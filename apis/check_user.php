<?php
session_start();
include 'conn.php';
include_once 'client_loc.php';
class checkEmail extends connection{
    private $email;
    private $movieid;
    private $movienm;
    private $location;
    public function user_email($EM,$MID,$MVN){
        $this->email = $EM;
        $this->movieid = $MID;
        $this->movienm = $MVN;
        $this->location = getVisIpAddr();
        //check if user exists as a niiflicks app user
        $sql = "SELECT email FROM users WHERE email = ?;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->email]);

        $count = $stmt->rowCount();
        if($count == 1){
            
            //check if movie is available in your country
            $sqlst = "SELECT distribution FROM d_movies WHERE id = '$this->movieid';";
            $sqmt = $this->connect()->prepare($sqlst);
            $sqmt->execute();

            
            $dist = $sqmt->fetch();//get the ditribution from db
            $dcons = $dist['distribution'];
            $decoded = json_decode($dcons);
            if (in_array($this->location, $decoded)){
            //check if you have already purchased this token
            $query = "SELECT * FROM token WHERE user_email = ? AND movie_id = ? AND exhausted = ?;";
            $smt = $this->connect()->prepare($query);
            $smt->execute([$this->email,$this->movieid,0]);

            $count = $smt->rowCount();
            if($count == 1){
                echo 'purchased';
                if(isset($_SESSION['movie_id']) || isset($_SESSION['user_m']) || isset($_SESSION['movie_name'])){
                    unset($_SESSION['movie_id']);
                    unset($_SESSION['user_m']);
                    unset($_SESSION['movie_name']);
                    $_SESSION['movie_id'] = $this->movieid;
                    $_SESSION['user_m'] = $this->email;
                     $_SESSION['movie_name'] = $this->movienm;
                }else{
                    $_SESSION['movie_id'] = $this->movieid;
                    $_SESSION['user_m'] = $this->email;
                    $_SESSION['movie_name'] = $this->movienm;
                }
               
            }else{
                echo 'exists';
                if(isset($_SESSION['movie_id']) || isset($_SESSION['user_m']) || isset($_SESSION['movie_name'])){
                    unset($_SESSION['movie_id']);
                    unset($_SESSION['user_m']);
                    unset($_SESSION['movie_name']);
                    $_SESSION['movie_id'] = $this->movieid;
                    $_SESSION['user_m'] = $this->email;
                     $_SESSION['movie_name'] = $this->movienm;
                }else{
                    $_SESSION['movie_id'] = $this->movieid;
                    $_SESSION['user_m'] = $this->email;
                    $_SESSION['movie_name'] = $this->movienm;
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
// $tryit->user_email('ezumachibuike@gmail.com',9,'Black Adam'); 

if(isset($_POST['email']) && isset($_POST['mov_id']) && isset($_POST['mov_name'])){
    $email = $_POST['email'];
    $mov_id = $_POST['mov_id'];
    $movie_name = $_POST['mov_name'];
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
        $tryit->user_email($email,$mov_id,$movie_name); 
    }
}else{
    echo 'email and movie id not set';
    header("Location: ../index.php");
}

