<?php
header('Access-Control-Allow-Origin: *');
include 'conn.php';

class single_premier extends connection{
    private $id;

    public function get_single($ID){
        $response = array();
        $this->id = $ID;
        $sql = "SELECT id,trailer,filmposter,title,description,nairaamount,genre FROM d_movies WHERE id = '$this->id';";
        $stmt = $this->connect()->prepare($sql);
        $send = $stmt->execute();

        if($send){
            $premier = $stmt->fetchAll();
            $response = $premier;

        }else{
            $response['error'] = true;
            $response['message'] = 'internal server error';
        }
        echo json_encode($response);
    }
}
 if(isset($_GET['id'])){
    $id = $_GET['id'];
    //echo json_encode($id);
}
$use = new single_premier;
$use->get_single($id);


