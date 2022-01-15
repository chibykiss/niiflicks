<?php
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'conn.php';

class checkplay extends connection{
  
    private $email;
    private $tkn;
    private $serid;
    private $sid;
    private $epid;

    public function processIt($EM,$TK,$SERID,$SID,$EPID){
        $response = array();
        
        $this->email = $EM;
        $this->tkn = $TK;
        $this->serid = $SERID;
        $this->sid = $SID;
        $this->epid = $EPID;
        //echo $this->serid.'<br>'.$this->sid.'<br>'.$this->epid.'<br>';
        try{
            $query = "SELECT user_mail,token,id,exhausted,watch_freq FROM token_series WHERE user_mail = ? AND token = ? AND series_id = ? AND season_id = ?;";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->email,$this->tkn,$this->serid,$this->sid]);
            $result = $stmt->fetch();
           
            $count = $stmt->rowCount();// counts the row retrned by the query
            //check if the query returned a row equal to 1 or more
            if($count >= 1){
                $exhausted = $result['exhausted'];
                //check if the exhausted feild is equal 1 ie the token has expired
                if($exhausted == 1){
                    $result['error'] = true;
                    $response['message'] = 'exhausted';
                    $response['eid'] = $result['id'];
                    

                    //if its not expired
                }
                else{
                  //take the user in to watch the movie
                    
                    // $sql = "SELECT * FROM d_episodes WHERE id = '$this->epid' AND series_id = '$this->serid' AND season_id = '$this->sid';";
                    // $smt = $this->connect()->prepare($sql);
                    // $send = $smt->execute();
                    // $data = $smt->fetch();
                    // if($data){
                    // $path = $data['videopath'];
                    // $response['path'] = $path;
                    // }
                    // $response['error'] = false;
                    // $response['message'] = 'data acquired';
                    
                    
                    

                    $new_freq = $result['watch_freq'];// assign the frequency value to a variable
                    // chec if the frequency from the db is equal to 10 times
                    if($new_freq == 10){
                        
                        //if it equals 10 times, update the exhausted feild and make it 1, ie exhaust the token
                        $sql = "UPDATE token_series SET exhausted = 1 WHERE user_mail=? AND token=? AND series_id=? AND season_id=?;";
                        $smt = $this->connect()->prepare($sql);
                        $smt->execute([$this->email,$this->tkn,$this->serid,$this->sid]);
                        $result['error'] = true;
                        $response['message'] = 'exhausted';// return exhausted
                        $response['eid'] = $result['id'];
                       
                        //the else statemnt
                    }
                    else{
                        //if the frequency is not up to 10 times, add 1 each time to the value of the frequency
                       
                        $new_freq = ($new_freq + 1);
                        $sql = "UPDATE token_series SET watch_freq = ? WHERE user_mail = ? AND token = ? AND series_id = ? AND season_id=?;";
                        $smt = $this->connect()->prepare($sql);
                        $smt->execute([$new_freq,$this->email,$this->tkn,$this->serid,$this->sid]);
                      
                        // $response['data'] = $result;
                        $sql2 = "SELECT * FROM d_episodes WHERE id = '$this->epid' AND series_id = '$this->serid' AND season_id = '$this->sid';";
                        $smt2 = $this->connect()->prepare($sql2);
                        $send2 = $smt2->execute();
                        $data2 = $smt2->fetch();
                        if($data2){
                          
                        $path = $data2['videopath'];
                        $response['path'] = $path;
                        }
                        $response['error'] = false;
                        $response['message'] = 'data acquired';
                    }
                   
                
                    
                   
                  
                }
               
            }else{
                $response['error'] = true;
                $response['message'] = 'not_found';
                
            }
        }
        catch(Exception $e){
            // echo json_encode('Message '.    $e->getMessage());
            echo 'message: '.$e->getMessage();
        }
   
        echo json_encode($response);
    }
}

$try = new checkplay;
$try->processIt('ezumachibuike@gmail.com','RD8CV4',5,5,4);

// if(isset($_POST['email']) && isset($_POST['tkn'])){
//     if(empty($_POST['email']) || empty($_POST['tkn'])){
//       echo json_encode('feilds empty');
//     }else{

// $email = $_POST['email'];
// $token = $_POST['tkn'];
// $episodeid = $_POST['episode_id'];
// $seasonid = $_POST['season_id'];
// $seriesid = $_POST['series_id'];
// // $response['mid'] = $movieid;
// // $response['email'] = $email;
// // $response['tkn'] = $token;
// $try = new checkplay;
// $try->processIt($email,$token,$seriesid,$seasonid,$episodeid);
// }
// }else{
//     echo json_encode('its not set');
// }
