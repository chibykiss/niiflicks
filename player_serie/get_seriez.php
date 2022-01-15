<?php   
include '../apis/conn.php';
class getit extends connection{
    private $sid;
    private $seaid;
    private $epid;
    private $sesno;

    public function mySerie($SID,$SEAID,$EPID,$SSNO){
        $this->sid = $SID;
        $this->seaid = $SEAID;
        $this->epid = $EPID;
        $this->sesno = $SSNO;
        // echo $this->epid;
    try{
        if($this->epid == 'first'){
            $sql = "SELECT id,filmposter,name,release_date,description,view_count,duration,videopath,episode_number from d_episodes  WHERE series_id = ? AND season_id = ? AND episode_number = 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->sid,$this->seaid]);
          }else{
            $sql = "SELECT id,filmposter,name,release_date,description,view_count,duration,videopath,episode_number FROM d_episodes  WHERE id = ? AND series_id = ? AND season_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->epid,$this->sid,$this->seaid]);
        }
        $result = $stmt->fetch();
        $count = $stmt->rowCount();
        if($count == 1){
            $title = $result['name'];
            $movie = $result['videopath'];
            $desc = $result['description'];
            $views = $result['view_count'];
            $poster = $result['filmposter'];
            $duration = $result['duration'];
            $release_date = $result['release_date'];
            $epino = $result['episode_number'];
            $epirid = $result['id'];
            echo '
            
    <div class="col-lg-12">
        <div class="gen-video-holder">
                <video
                    id="my-video"
                    class="video-js vjs-big-play-centered vjs-matrix"
                    poster="niiflicks/directors/uploads/tvseries/posters/'.$poster.'"
                >
                    <source src="niiflicks/directors/uploads/tvseries/episodes/'.$movie.'" type="video/mp4" />
                    <source src="MY_VIDEO.webm" type="video/webm" />
                    <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="niiflicks/directors/uploads/tvseries/episodes/'.$movie.'" target="_blank"
                        >supports HTML5 video</a
                    >
                    </p>
                </video>
              
        </div>
    </div>

    <div class="col-lg-12">
        <div class="single-video">
            <div class="gen-single-video-info">
                <h2 class="gen-title">'.$title.' S'.$this->sesno.'Ep'.$epino.'</h2>
                <div class="gen-single-meta-holder">
                    <ul>
                        <li class="gen-sen-rating">TV-PG</li>
                        <li>
                            <i class="fas fa-eye">
                            </i>
                            <span>'.$views.'</span>
                        </li>
                        
                        <li>English</li>
                        
                    </ul>
                </div>
                <p>'.$desc.'
                </p>
                <div class="gen-after-excerpt">
                    <div class="gen-extra-data">
                        <ul>
                        <input id="real_id" type="hidden" value="'.$epirid.'"/>
                           
                          
                            <li><span>Run Time :</span>
                                <span>'.$duration.'</span>
                            </li>
                            <li>
                                <span>Release Date :</span>
                                <span>'.$release_date.'</span>
                            </li>
                        </ul>
                    </div>
                   
                    <div class="gen-socail-share mt-0">
                        <h4 class="align-self-center">Social Share :</h4>
                        <ul class="social-inner">
                            <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li><a href="#" class="facebook"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li><a href="#" class="facebook"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
            
            ';

        }else{
            echo 'how did you get here';
        }
    }
    catch(Exception $ex){
        echo 'there was an error with db '.$ex->getMessage;
    }
    }

    public function moreEpisodes(){
        if($this->epid == 'first'){
            $query = "SELECT id,filmposter,name,episode_number FROM d_episodes WHERE series_id = ? AND season_id = ? AND episode_number != 1 AND status = 1 AND deleted_at IS NULL;";
        }else{
            $query = "SELECT id,filmposter,name,episode_number FROM d_episodes WHERE series_id = ? AND season_id = ? AND id <> '$this->epid' AND status = 1 AND deleted_at IS NULL;";
        }
        $smt = $this->connect()->prepare($query);
        $result = $smt->execute([$this->sid,$this->seaid]);
        if($result){
            $is_there = $smt->rowCount();
            if($is_there >= 1){
                $all_genre = $smt->fetchAll();
                foreach($all_genre as $one_genre){
                    //$onetitle = preg_replace('/\s+/', '_', $one_genre['title']);
                    echo '
                    <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                        <div class="gen-movie-contain">
                            <div class="gen-movie-img">
                                <img src="niiflicks/directors/uploads/tvseries/posters/'.$one_genre['filmposter'].'"
                                    alt="single-video-image">
                                <div class="gen-movie-add">
                                    <div class="wpulike wpulike-heart">
                                        <div class="wp_ulike_general_class">
                                            <a href="#" class="sl-button text-white"><i
                                                    class="far fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <ul class="menu bottomRight">
                                        <li class="share top">
                                            <i class="fa fa-share-alt"></i>
                                            <ul class="submenu">
                                                <li><a href="#" class="facebook"><i
                                                            class="fab fa-facebook-f"></i></a>
                                                </li>
                                                <li><a href="#" class="facebook"><i
                                                            class="fab fa-instagram"></i></a>
                                                </li>
                                                <li><a href="#" class="facebook"><i
                                                            class="fab fa-twitter"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="video-actions--link_add-to-playlist dropdown">
                                        <a class="dropdown-toggle" href="#"
                                            data-toggle="dropdown"><i
                                                class="fa fa-plus"></i></a>
                                        <div class="dropdown-menu">
                                            <a class="login-link" href="#">Sign in to add
                                                this video to a playlist.</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="gen-movie-action">
                                    <a href="player_serie/play/'.$this->sid.'/'.$this->seaid.'/'.$one_genre['id'].'/'.$this->sesno.'" class="gen-button">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="gen-info-contain">
                                <div class="gen-movie-info">
                                    <h3><a href="player_serie/play/'.$this->sid.'/'.$this->seaid.'/'.$one_genre['id'].'/'.$this->sesno.'">'.$one_genre['name'].' S'.$this->sesno.'Ep'.$one_genre['episode_number'].'</a></h3>
                                </div>
                                <div class="gen-movie-meta-holder">
                                    <ul>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    ';
                }
            }
            

        }else{

        }
    }
}
// $try = new getit();
// $try->mySerie(6,8,5);


