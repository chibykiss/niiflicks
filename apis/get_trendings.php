<?php
session_start();
header('Access-Control-Allow-Origin: 127.0.0.1/niiflick.com/premiers.html');
include 'conn.php';
$response = array();
class premiers extends connection{

    public function get_premiers(){
        global $response;
        $sql = "SELECT id,title,filmposter,nairaamount,view_count FROM d_movies WHERE status = 1 ORDER BY view_count DESC;";
        $stmt = $this->connect()->prepare($sql);
        $send = $stmt->execute();
        if($send){
            $premiers = $stmt->fetchAll();
            // while($premiers = $stmt->fetchAll()){
            //     array_push($response['data'],$premiers);
            //     $response['error'] = false;
            //     $response['message'] = 'data acquired';
            // }
            // // echo '<pre>',print_r($premiers),'</pre>';
            // echo '<pre>',print_r($premiers),'</pre>';
            foreach($premiers as $premier){
               // echo $premier['title'].'<br>';
            //    $response = $premiers;
                //  array_push($response['allp'],$premiers);
                $response['result'] = $premiers;
                 $response['error'] = false;
                 $response['message'] = 'data acquired';
                //var_dump($premiers);
            }
        }else{
            $response['error'] = true;
            $response['message'] = 'internal sql error';
        }
      
        
        
        
    }
}
// $try = new premiers;
// $try->get_premiers();
if(isset($_GET['qcz']) && isset($_SESSION['qr_codez'])){
    $qr = $_GET['qcz'];
    $qr_code = $_SESSION['qr_codez'];
    if($qr == $qr_code){
        //$response['message'] = 'they match';
        $try = new premiers;
        $try->get_premiers();
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
