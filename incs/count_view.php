<?php
session_start();
require_once 'conn.php';
class update_view extends connection{
    private $id;
    private $movname;
    public function updateview($ID,$MVN){
        $this->id = $ID;
        $this->movname = $MVN;
        $sql = "UPDATE d_movies SET view_count = view_count+1   WHERE id = '$this->id';";
        $smt = $this->connect()->prepare($sql);
        $send = $smt->execute();
        $query = "SELECT trailer,filmposter,overview FROM d_movies WHERE id = '$this->id'";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        $_SESSION['trailer'] = $result['trailer'];
        $_SESSION['poster'] = $result['filmposter'];
        $_SESSION['desc'] = $result['overview'];
        $trailer = $result['trailer'];
        $poster = $result['filmposter'];
        $desc = $result['overview'];
        if($send){
            echo <<< JS
            <script>
            if(sessionStorage.getItem("trailer") === null || sessionStorage.getItem("poster") === null || sessionStorage.getItem("desc") === null){
                sessionStorage.setItem('trailer', "$trailer");
                sessionStorage.setItem('poster', "$poster");
                sessionStorage.setItem('desc', "$desc");
            }else{
                sessionStorage.clear();
                sessionStorage.setItem('trailer', "$trailer");
                sessionStorage.setItem('poster', "$poster");
                sessionStorage.setItem('desc', "$desc");
            }
            window.location.assign("../single/$this->id/$this->movname");
            </script>
            JS;
            //header("location: ../single/$this->id/$this->movname");
        }else{
            echo 'failed';
        }
    }
}
$id = $_GET['id'];
$mname = $_GET['m_name'];

$try = new update_view;
$try->updateview($id,$mname);