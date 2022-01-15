<?php
include 'conn.php';
$response = array();
class nextep extends connection{
    private $serieid;
    private $seasonid;
    private $episodeid;
    public function nextone($SERID,$SNID,$EPID){
        global $response;
        $this->serieid = $SERID;
        $this->seasonid = $SNID;
        $this->episodeid = $EPID;
        try{
            $sql = "SELECT episode_number FROM d_episodes WHERE series_id = ? AND season_id=? AND id=?";
            $smt = $this->connect()->prepare($sql);
            $send = $smt->execute([$this->serieid,$this->seasonid,$this->episodeid]);
            if($send){
                $result = $smt->fetch();
                $epino = $result['episode_number'];
                $epino = $epino + 1;
                $query = "SELECT id FROM d_episodes WHERE series_id=? AND season_id=? AND episode_number =?";
                $stmt = $this->connect()->prepare($query);
                $activate = $stmt->execute([$this->serieid,$this->seasonid,$epino]);
                if($activate){
                    $exists = $stmt->rowCount();
                    if($exists == 1){
                        $nxtepi = $stmt->fetch();
                        $newepi = $nxtepi['id'];
                        $response['error'] = false;
                        $response['message'] = 'data acquired';
                        $response['epid'] = $newepi;
                    }else{
                        $response['error'] = true;
                        $response['message'] = 'no next episode';
                        $response['epid'] = 'no other episodes exist';
                    }
                }
            }
        }
        catch(Exception $e){
            $response['error'] = $e->getMessage();
        }
       
    }
}
if(isset($_POST['sid']) && isset($_POST['seaid']) && isset($_POST['episid'])){
    $serid = $_POST['sid'];
    $seasid = $_POST['seaid'];
    $episid = $_POST['episid'];
    $try = new nextep;
    $try->nextone($serid,$seasid,$episid);
}
echo json_encode($response);