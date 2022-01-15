<?php
session_start();
require_once 'conn.php';
class update_view extends connection{
    private $serieid;
    private $seaid;
    private $episid;
    private $epiname;
    public function updateview($SID,$SEID,$EPID,$EPNM){
        $this->serieid = $SID;
        $this->seaid = $SEID;
        $this->episid = $EPID;
        $this->epiname = $EPNM;
        $sql = "UPDATE d_episodes SET view_count = view_count+1   WHERE id = ? AND series_id = ? AND season_id = ?;";
        $smt = $this->connect()->prepare($sql);
        $send = $smt->execute([$this->episid,$this->serieid,$this->seaid]);
        $query = "SELECT trailer,filmposter,description FROM d_episodes WHERE id = ? AND series_id = ? AND season_id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$this->episid,$this->serieid,$this->seaid]);
        $result = $stmt->fetch();
        $_SESSION['trailer'] = $result['trailer'];
        $_SESSION['poster'] = $result['filmposter'];
        $_SESSION['desc'] = $result['description'];
        if($send){
            //echo 'done';
           header("location: ../series_single/$this->serieid/$this->seaid/$this->episid/$this->epiname");
        }else{
            echo 'failed';
        }
    }
}
$sid = $_GET['sid'];
$seid = $_GET['seid'];
$epid = $_GET['epid'];
$e_name = $_GET['e_name'];


$try = new update_view;
$try->updateview($sid,$seid,$epid,$e_name);