<?php
header('Access-Control-Allow-Origin: *');
include 'conn.php';
$response = array();
class more extends connection{
    private $genre;

    public function more_like($GN){
        global $response;
        $this->genre = $GN;

        $sql = "SELECT id,title,genre,filmposter,nairaamount FROM d_movies WHERE genre=? AND status = 1  ORDER BY id DESC;";
        $smt = $this->connect()->prepare($sql);
        $send = $smt->execute([$this->genre]);
        if($send){
            $result = $smt->fetchAll();
            $response['data'] = $result;
            $response['error'] = false;
            $response['message'] = 'data acquired';
        }else{
            $response['error'] = true;
            $response['message'] = 'internal db error';
        }
    }
}
$try = new more;
$try->more_like('action');
echo json_encode($response);
// if(isset($_GET['genre'])){
//     $genre = $_GET['genre'];
//     $try = new more;
//     $try->more_like($genre);
// }else{
//     $response['error'] = true;
//     $response['message'] = 'nothing was set';
// }