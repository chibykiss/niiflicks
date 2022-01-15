<?php
session_start();
header('Access-Control-Allow-Origin: 127.0.0.1/niiflick.com/premiers.html');
include 'conn.php';
$response = array();
class premiers extends connection{
    private $category;
    public function get_premiers($CT){
        global $response;
        $this->category = $CT;
        if($this->category == 'latest'){
            $sql = "SELECT id,title,filmposter,nairaamount FROM d_movies WHERE status = 1 AND deleted_at IS NULL ORDER BY id DESC;";
            $stmt = $this->connect()->prepare($sql);
            $send = $stmt->execute();
            if($send){
                $premiers = $stmt->fetchAll();
                foreach($premiers as $premier){
                    $response['res'] = $premiers;
                     $response['error'] = false;
                     $response['message'] = 'data acquired';
                }
            }else{
                $response['error'] = true;
                $response['message'] = 'internal sql error';
            }
        }
        else if($this->category == 'trending'){
            $sql = "SELECT id,title,filmposter,nairaamount,view_count FROM d_movies WHERE status = 1 AND deleted_at IS NULL ORDER BY view_count DESC;";
            $stmt = $this->connect()->prepare($sql);
            $send = $stmt->execute();
            if($send){
                $premiers = $stmt->fetchAll();
                foreach($premiers as $premier){
               
                    $response['res'] = $premiers;
                     $response['error'] = false;
                     $response['message'] = 'data acquired';
                   
                }
            }else{
                $response['error'] = true;
                $response['message'] = 'internal sql error';
            }
        }else{
            $response['error'] = true;
            $response['message'] = 'how did you get here';
        }
       
      
      
        
        
        
    }
}
// $try = new premiers;
// $try->get_premiers();
if(isset($_GET['qc']) && isset($_SESSION['qr_code']) && isset($_GET['cat'])){
    $qr = $_GET['qc'];
    $cat = $_GET['cat'];
    $qr_code = $_SESSION['qr_code'];
    if($qr == $qr_code){
        //$response['message'] = 'they match';
        $try = new premiers;
        $try->get_premiers($cat);
        session_unset();
        session_destroy();
    }
    else{
        
        $response['message'] = 'do_not_match';
       
        
    }
    // $response['from_fetch'] = $qr;
    // $response['from_session'] = $qr_code;
}else{
    $response['error'] = true;
    $response['message'] = 'not_set';
    
}
echo json_encode($response);

// while($premiers = $stmt->fetchAll()){
    //     array_push($response['data'],$premiers);
    //     $response['error'] = false;
    //     $response['message'] = 'data acquired';
    // }
    // // echo '<pre>',print_r($premiers),'</pre>';
    // echo '<pre>',print_r($premiers),'</pre>';

        // echo $premier['title'].'<br>';
                //    $response = $premiers;
                    //  array_push($response['allp'],$premiers);
 //var_dump($premiers);