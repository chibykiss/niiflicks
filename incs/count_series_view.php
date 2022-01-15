<?php
session_start();
require_once 'conn.php';
class update_view extends connection{
    private $id;
    private $movname;
    public function updateview($ID,$MVN){
        $this->id = $ID;
        $this->movname = $MVN;
        $sql = "UPDATE d_tvseries SET view_count = view_count+1   WHERE id = '$this->id';";
        $smt = $this->connect()->prepare($sql);
        $send = $smt->execute();
        $query = "SELECT trailer,filmposter,overview FROM d_tvseries WHERE id = '$this->id'";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        $_SESSION['trailer'] = $result['trailer'];
        $_SESSION['poster'] = $result['filmposter'];
        $_SESSION['desc'] = $result['overview'];
        if($send){
            //echo 'done';
           header("location: ../seasons/$this->id/$this->movname");
        }else{
            echo 'failed';
        }
    }
}
$id = $_GET['id'];
$mname = $_GET['m_name'];

$try = new update_view;
$try->updateview($id,$mname);