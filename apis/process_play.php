<?php
session_start();
include 'conn.php';

class checkplay extends connection{
    private $movie_id;
    private $email;
    private $tkn;

    public function processIt($MID,$EM,$TK){
        $response = array();
        $this->movie_id = $MID;
        $this->email = $EM;
        $this->tkn = $TK;
        try{
            $query = "SELECT user_email,token,movie_id,exhausted,watch_freq FROM token WHERE user_email = ? AND token = ? AND movie_id = ?;";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->email,$this->tkn,$this->movie_id]);
            $result = $stmt->fetch();
           
            $count = $stmt->rowCount();// counts the row retrned by the query
            //check if the query returned a row equal to 1 or more
            if($count >= 1){
                $exhausted = $result['exhausted'];
                //check if the exhausted feild is equal 1 ie the token has expired
                if($exhausted == 1){
                    $result['error'] = true;
                    $response['message'] = 'exhausted';
                    $response['mid'] = $result['movie_id'];
                    

                    //if its not expired
                }
                else{
                    //i am going to use session to prevent the watch frquency from incresing as long as
                    //the user is still in a session. so that the watch frequency is unique
                    if(isset($_SESSION['userml'])){
                        $response['error'] = false;
                        $response['message'] = 'data acquired';
                        if(isset($_SESSION['id_mov']) && isset($_SESSION['userml'])){
                            unset($_SESSION['id_mov']);
                            unset($_SESSION['userml']);
                            $_SESSION['id_mov'] = $result['movie_id'];
                            $_SESSION['userml'] = $result['user_email'];
                        }else{
                            $_SESSION['id_mov'] = $result['movie_id'];
                            $_SESSION['userml'] = $result['user_email'];
                        }
                        $response['idmov'] = $result['movie_id'];
                    //if the user is just coming to watch with a unique session
                    }
                    else{
                        $new_freq = $result['watch_freq'];// assign the frquency value to a variable
                    


                    // chec if the frequency from the db is equal to 10 times
                    if($new_freq == 10){
                        
                        //if it equals 10 times, update the exhausted feild and make it 1, ie exhaust the token
                        $sql = "UPDATE token SET exhausted = 1 WHERE user_email=? AND token=? AND movie_id=?;";
                        $smt = $this->connect()->prepare($sql);
                        $smt->execute([$this->email,$this->tkn,$this->movie_id]);
                        $reponse['error'] = true;
                        $response['message'] = 'exhausted';// return exhausted
                        $response['mid'] = $result['movie_id'];
                       
                        //the else statemnt
                    }
                    else{
                        //if the frequency is not up to 10 times, add 1 each time to the value of the frequency
                        $new_freq = ($new_freq + 1);
                        $sql = "UPDATE token SET watch_freq = ? WHERE user_email = ? AND token = ? AND movie_id = ?;";
                        $smt = $this->connect()->prepare($sql);
                        $smt->execute([$new_freq,$this->email,$this->tkn,$this->movie_id]);

                            $response['error'] = false;
                            $response['message'] = 'data_acquired';
                            if(isset($_SESSION['id_mov']) && isset($_SESSION['userml'])){
                                unset($_SESSION['id_mov']);
                                unset($_SESSION['userml']);
                                $_SESSION['id_mov'] = $result['movie_id'];
                                $_SESSION['userml'] = $result['user_email'];
                            }else{
                                $_SESSION['id_mov'] = $result['movie_id'];
                                $_SESSION['userml'] = $result['user_email'];
                            }
                            $response['idmov'] = $result['movie_id'];
                        // $response['data'] = $result;
                       
                        
                    }
                    }
                
                    
                   
                  
                }
               
            }else{
                $response['error'] = true;
                $response['message'] = 'not_found';
                
            }
        }
        catch(Exception $e){
            echo json_encode('Message '.    $e->getMessage());
        }
   
        echo json_encode($response);
    }
}

// $try = new checkplay;
// $try->processIt(11,'ezumachibuike@gmail.com','DzraM3');

if(isset($_POST['mid']) && isset($_POST['email']) && isset($_POST['tkn'])){
$movieid = $_POST['mid'];
$email = $_POST['email'];
$token = $_POST['tkn'];
// $response['mid'] = $movieid;
// $response['email'] = $email;
// $response['tkn'] = $token;
$try = new checkplay;
$try->processIt($movieid,$email,$token);
}else{
    json_encode('its not set');
}
