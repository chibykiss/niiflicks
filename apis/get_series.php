<?php
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include 'conn.php';
$response = array();
class premiers extends connection{

    public function get_premiers(){
        global $response;
        $sql = "SELECT id,title,filmposter,dollaramount FROM d_tvseries WHERE status = 1;";
        $stmt = $this->connect()->prepare($sql);
        $send = $stmt->execute();
        if($send){
            $premiers = $stmt->fetchAll();
          
        //   var_dump($premiers);
            foreach($premiers as $premier){
            
                $response['data'] = $premiers;
                 $response['error'] = false;
                 $response['message'] = 'data acquired';
                
            }
        }else{
            $response['error'] = true;
            $response['message'] = 'internal sql error';
        }
      
        
        
        
    }
}
$try = new premiers;
$try->get_premiers();

echo json_encode($response);



