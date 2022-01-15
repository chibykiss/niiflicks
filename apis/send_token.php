<?php
header('Content-Type: application/json');
include 'conn.php';

class sendToken extends connection{
    private $email;
    private $movieid;
    private $token;
    private $movie;

    public function send_it($EM,$MID,$TK,$MV){
        $response = array();
        $this->email = $EM;
        $this->movieid = $MID;
        $this->token = $TK;
        $this->movie = $MV;
        //check if there is already a token for that movie
        try {
            //code...
      
        $query = "SELECT user_email,movie_id,exhausted,token FROM token WHERE user_email = ? AND movie_id = ? AND exhausted=?;";
        $smt = $this->connect()->prepare($query);
        $smt->execute([$this->email,$this->movieid,0]);
        $mytokens = $smt->fetch();
        $count = $smt->rowCount();
        // foreach ($mytokens as $mytoken) {
        //     $exhaustion = $mytoken['exhausted'];
        //     $dixtokn = $mytoken['watch_freq'];
        // }
        //echo $dixtokn;
        //echo $count;
        // echo $this->movieid;
        if($count == 1){
            $response['data'] = $mytokens;
            $response['dbstat'] = 'token_exists';
        }else{
            $sql = "INSERT INTO token(user_email, movie_id, token) VALUES(?,?,?);";
            $stmt = $this->connect()->prepare($sql);
            $send = $stmt->execute([$this->email,$this->movieid,$this->token]);
    
            if($send){
                $response['dbstat'] = 'token_inserted';
                $to = $this->email; 
                $from = 'noreply@niflicks.com'; 
                $fromName = 'Niiflicks'; 
                 
                $subject = $this->movie." Unlock Token"; 
                 
                $htmlContent = '
                   <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Niiflicks Token</title>
        </head>
        <body>
            <div style="width:100%; min-width:800px; height:100%; line-height:1.6em; color:#ffffff; background-color:#f2f2f2; font-weight:400;">
                <table style="border-spacing:0; margin:0 auto; clear:both; font-size:16px; font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif; padding:50px; width:720px;">
                    <tbody>
                        <tr>
                            <td style="font-size:12px; color:#888; vertical-align:baseline; padding:20px 40px;">
                                <div style="display: block; width:120px; margin:auto;">
                                    <img src="../images/niiflicks-logo.png" style="display:block; width:120px; margin:5px auto 1px auto;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top; margin:0; background:rgb(0, 0, 0); font-size:16px; line-height:24px; word-wrap:break-word; padding:20px 40px 40px 40px; border-radius:6px; border-bottom: 10px solid #eb0404;">
              
                                <p><strong></strong>Hello There,</strong><br>use the code below to unlock '.$this->movie.' on niiflicks mobile app or in our website</p>
                                <p style="text-align: center;"><strong style="background-color: rgb(160, 0, 0); padding: 4px 7px;">'.$this->token.'</strong></p> 
                                <div style="width: 50%; height: 100%; margin: 0 auto;">
                                <a style="text-decoration: none; color: rgb(255, 0, 0); float: left;" target="_blank" href="https://play.google.com/store/apps/details?id=com.ini.niiflicks">Go to app</a>
                                <a style="text-decoration: none; color: rgb(255, 0, 0); float: right;" target="_blank" href="https://niiflicks.com">Go to website</a>
                                </div>
                            </td>
                        </tr>
                     
                    </tbody>
                </table>
            </div>
        </body>
        </html>
                    
                    '; 
                 
                // Set content-type header for sending HTML email 
                $headers = "MIME-Version: 1.0" . "\r\n"; 
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                 
                // Additional headers 
                $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
               
                 
                // Send email 
                // if(mail($to, $subject, $htmlContent, $headers)){ 
                    
                //     $response['mstatus'] = 'sent';
                // }else{ 
                //     $response['mstatus'] = 'failed';
                   
                // }
                $response['mstatus'] = 'sent';
    
    
    
    
    
            }else{
                $response['db_stat'] = 'token insertion failed';
                
            }
        }


        echo json_encode($response, JSON_FORCE_OBJECT);
    }
        catch (PDOexception $ex) {
            echo $ex->getMessage();
        }
        
    }
}

// $new_token = new sendToken;
// $new_token->send_it('ezumachibuike@gmail.com',14,'DRT6vS','Shang chi');  
if(isset($_POST['dmail']) && isset($_POST['mid']) && isset($_POST['otp'])){
    $mail = $_POST['dmail'];
    $movie_id = $_POST['mid'];
    $otp = $_POST['otp'];
    $dmovie = $_POST['dmovie'];
    $new_token = new sendToken;
    $new_token->send_it($mail,$movie_id,$otp,$dmovie);
}else{
    echo json_encode('the values are not set');
}
