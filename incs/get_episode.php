<?php
require_once 'conn.php';
include 'apis/client_loc.php';
class seasons extends connection{
    private $currency;
    private $rate;
    private $seriesid;
    private $seasonid;
    private $episid;
    private $stitle;
    private $s_trailer;
    public function series_trailer($SRID){
        $this->seriesid = $SRID;
        $sqm = "SELECT trailer,title FROM d_tvseries WHERE id = '$this->seriesid' AND status = 1 AND deleted_at IS NULL";
        $stm = $this->connect()->prepare($sqm);
        $stm->execute();
        $dtrailer = $stm->fetch();
        $this->s_trailer = $dtrailer['trailer'];
        $this->stitle = $dtrailer['title'];
        
    }
    public function episode_trailer($SEID,$EPID){
        
        $this->seasonid = $SEID;
        $this->episid = $EPID;
       
        $sqll = "SELECT trailer FROM d_episodes WHERE series_id = ? AND season_id = ? AND id = ? AND status = 1 AND deleted_at IS NULL";
        $smtt = $this->connect()->prepare($sqll);
        $go = $smtt->execute([$this->seriesid,$this->seasonid,$this->episid]);
        if($go){
            $trailer = $smtt->fetch();
            if($trailer['trailer'] == null){
                echo '
                <div class="gen-video-holder">
                <video width="100%" height="500px" controls autoplay controlsList="nodownload">
                    <source src="niiflicks/directors/uploads/tvseries/trailers/'.$this->s_trailer.'" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                </div>
                ';
            }else{
                echo '
                <div class="gen-video-holder">
                <video width="100%" height="500px" controls autoplay controlsList="nodownload">
                    <source src="niiflicks/directors/uploads/tvseries/episode_trailers/'.$trailer['trailer'].'" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                </div>
                ';
            }
           
        }

    }
    public function episode_detail(){
        $sqlm = "SELECT name,view_count,description,release_date FROM d_episodes WHERE series_id = '$this->seriesid' AND season_id = '$this->seasonid' AND id='$this->episid' AND deleted_at IS NULL";
        $smtm = $this->connect()->prepare($sqlm);
        $gom = $smtm->execute();    
        if($gom){
            $dserie = $smtm->fetch();
            echo '
            <div class="gen-single-tv-show-info">
            <h2 class="gen-title">'.$dserie['name'].'</h2>
            <div class="gen-single-meta-holder">
                <ul>
                    <li></li>
                    <li>'.$dserie['release_date'].'</li>
                    <li>
                        <i class="fas fa-eye">
                        </i>
                        <span>'.$dserie['view_count'].'</span>
                    </li>
                    <input id="serietitle" type="hidden" value="'.$this->stitle.'" />
                </ul>
            </div>
            <p>'.$dserie['description'].'</p>


                <div class="gen-after-excerpt">
                    <div class="gen-extra-data">
                        <ul class="nav">
                            <div>
                                <a  type="button" class="btn gen-button gen-button-flat" data-toggle="modal" data-target="#myModal1">
                                    <span class="text">WATCH SERIES</span>
                                </a>
                                <a href="register" class="gen-button gen-button-flat">
                                <span class="text">REGISTER</span>
                                </a>
                                <input type="text" id="clink" class="input" value="" required>
                                <a href="#" id="to_copy" class="gen-button gen-button-flat">
                                    <span class="text">Copy Link</span>
                                </a>
                            </div>
                        </ul>
                        <!-- <a  type="button" class="btn gen-button gen-button-flat" data-toggle="modal" data-target="#myModal1">
                    
                            <span class="text">WATCH MOVIE</span>
                        </a>
                        <a href="register.php" class="gen-button gen-button-flat">
                            <span class="text">REGISTER</span>
                        </a>

                        
                        <input type="text" id="clink" class="input" value="" required>
                        <a href="#" id="to_copy" class="gen-button gen-button-flat">
                            <span class="text">Copy Link</span>
                        </a> -->
                        
                    </div>
                
                    <div class="gen-socail-share mt-0">
                        <h4 class="align-self-center">Social Share :</h4>
                        <ul class="social-inner">
                            <li><a href="#" class="facebook facebook-btn"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li><a href="#" class="facebook linkedin-btn"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li><a href="#" class="facebook twitter-btn"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                    </div>

                </div> 
        </div>
            ';
        }

    }
    public function get_from_db(){
        $sql = "SELECT id,season_number,dollaramount FROM d_seasons WHERE tvseries_id = '$this->seriesid'";
        $smt = $this->connect()->prepare($sql);
        $send = $smt->execute();
        if($send){
            return $smt->fetchAll();
        }else{
            return 'db error';
        }
    }
 
    public function series_season(){
        
       $seasons = $this->get_from_db($this->seriesid);
            foreach($seasons as $season){
                echo '
                    <li style="display:none;" class="nav-item">
                    <a class="nav-link show" data-toggle="tab" href="#season_'.$season['season_number'].'">Season '.$season['season_number'].'</a>
                    </li>
                ';
            }
        }
        public function optionz(){
            $this->currency = getVisIpAddr();
            $this->rate = get_rate();
            $options = $this->get_from_db($this->seriesid);
          foreach($options as $option){
            $amount = '';
            if($this->currency == 'NG'){
                $real_amount = round(($option['dollaramount'] * $this->rate),-2);

                 $amount = '&#8358; '.number_format($real_amount);
            }else{
                 $amount = '$ '.$option['dollaramount'];
            }
              $seano = $option['season_number'];
              echo '
              <option data-nprice="'.$amount.'" data-rprice="'.$real_amount.'"  data-sidval="'.$seano.'" data-sid="'.$option['id'].'">Season '.$seano.' '.$amount.'</option>
              
              ';
            
          }
        }
    public function season_click(){
      
        $query = "SELECT id,season_number,dollaramount FROM d_seasons WHERE tvseries_id = '$this->seriesid'";
        $stmt = $this->connect()->prepare($query);
        $send = $stmt->execute();
        if($send){
            $seasons = $stmt->fetchAll();
            foreach($seasons as $season){
                $sno = $season['season_number'];
                $seasonid = $season['id'];
                // $price = $season['dollaramount'];
           

                if($sno == 1){
                    echo '
                <div id="season_'.$sno.'" class="tab-pane active show">
                <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true"
                    data-desk_num="4" data-lap_num="3" data-tab_num="2" data-mob_num="1"
                    data-mob_sm="1" data-autoplay="false" data-loop="false" data-margin="30">
                    ';
                    $sqlz = "SELECT id,name,episode_number,filmposter FROM d_episodes WHERE series_id = '$this->seriesid' AND season_id = '$seasonid' AND status=1";
                    $smtz = $this->connect()->prepare($sqlz);
                    $send2 = $smtz->execute();
                    if($send2){
                        $exists = $smtz->rowCount();
                        if($exists >= 1){
                            $episodes = $smtz->fetchAll();
                            foreach($episodes as $episode){
                                $epino = $episode['episode_number'];
                                $epid = $episode['id'];
                                echo '
                                <div class="item">
                                    <div class="gen-episode-contain">
                                        <div class="gen-episode-img">
                                            <img src="niiflicks/directors/uploads/tvseries/posters/'.$episode['filmposter'].'" alt="'.$episode['filmposter'].'">
                                            <div class="gen-movie-action">
                                                <a href="incs/count_episode.php?sid='.$this->seriesid.'&seid='.$seasonid.'&epid='.$epid.'&e_name='.$episode['name'].'" class="gen-button">
                                                    <i class="fa fa-shopping-basket"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="gen-info-contain">
                                            <div class="gen-episode-info">
                                                <h3>
                                                    S'.$sno.'Ep'.$epino.' <span>-</span>
                                                    <a href=href="incs/count_episode.php?sid='.$this->seriesid.'&seid='.$seasonid.'&epid='.$epid.'&e_name='.$episode['name'].'">
                                                        '.$episode['name'].'
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="gen-single-meta-holder">
                                                <ul>
                                                   
                                                    <li class="release-date">
                                                        <a style="color:#ffff;" href="unlock_serie/'.$this->seriesid.'/'.$this->stitle.'/'.$seasonid.'/'.$sno.'/'.$epid.'">Watch Now</a>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        }else{
                            echo '<h4>No Episode yet</h4>';
                        }
                     
                    }
                   

                 
                    
                echo '
                </div>
            </div>                
                ';
                }else{
                    echo '
                    <div id="season_'.$sno.'" class="tab-pane">
                    <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true"
                        data-desk_num="4" data-lap_num="3" data-tab_num="2" data-mob_num="1"
                        data-mob_sm="1" data-autoplay="false" data-loop="false" data-margin="30">
                    ';
                    $sqlz = "SELECT id,name,episode_number,filmposter FROM d_episodes WHERE series_id = '$this->seriesid' AND season_id = '$seasonid' AND status=1";
                    $smtz = $this->connect()->prepare($sqlz);
                    $send2 = $smtz->execute();
                    if($send2){
                        $exists = $smtz->rowCount();
                        if($exists >= 1){
                            $episodes = $smtz->fetchAll(); 
                            foreach($episodes as $episode){
                                $epino = $episode['episode_number'];
                                $epid = $episode['id'];
                                echo '
                                <div class="item">
                                    <div class="gen-episode-contain">
                                        <div class="gen-episode-img">
                                            <img src="niiflicks/directors/uploads/tvseries/posters/'.$episode['filmposter'].'" alt="'.$episode['filmposter'].'">
                                            <div class="gen-movie-action">
                                                <a href="incs/count_episode.php?sid='.$this->seriesid.'&seid='.$seasonid.'&epid='.$epid.'&e_name='.$episode['name'].'" class="gen-button">
                                                    <i class="fa fa-shopping-basket"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="gen-info-contain">
                                            <div class="gen-episode-info">
                                                <h3>
                                                S'.$sno.'Ep'.$epino.' <span>-</span>
                                                    <a href="incs/count_episode.php?sid='.$this->seriesid.'&seid='.$seasonid.'&epid='.$epid.'&e_name='.$episode['name'].'">
                                                        '.$episode['name'].'
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="gen-single-meta-holder">
                                                <ul>
                                                    
                                                    <li class="release-date">
                                                    <a style="color:#ffff;" href="unlock_serie/'.$this->seriesid .'/'.$this->stitle.'/'.$seasonid.'/'.$sno.'/'.$epid.'">Watch Now</a>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                            }
                        }else{
                            echo '<h4>No Episodes yet</h4>';
                        }
                      
                    }
                  
                     
                        
                    echo '
                    </div>
                </div>                
                    ';
                }
               
            }
        }
    }
    public function get_genre(){
        $queri = "SELECT genre FROM d_tvseries WHERE id = '$this->seriesid' AND status=1 AND deleted_at IS NULL";
        $srt = $this->connect()->prepare($queri);
        $exe = $srt->execute();
        if($exe){
            $result = $srt->fetch();
            $type = $result['genre'];
            $query = "SELECT id,title,genre,filmposter FROM d_tvseries WHERE genre = '$type' AND status=1 AND deleted_at IS NULL AND id <> '$this->seriesid'";
            $xmt = $this->connect()->prepare($query);
            $xmt->execute();
            $count = $xmt->rowCount();
            if($count >= 1){
                $more = $xmt->fetchAll();
                foreach($more as $genre){
                    echo '
                    <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gen-carousel-movies-style-1 movie-grid style-1">
                        <div class="gen-movie-contain">
                            <div class="gen-movie-img">
                                <img src="niiflicks/directors/uploads/tvseries/posters/'.$genre['filmposter'].'" alt="streamlab-image">
                                <div class="gen-movie-add">
                                    <div class="wpulike wpulike-heart">
                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                            <button type="button"
                                                class="wp_ulike_btn wp_ulike_put_image"></button>
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
                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                class="fa fa-plus"></i></a>
                                        <div class="dropdown-menu mCustomScrollbar">
                                            <div class="mCustomScrollBox">
                                                <div class="mCSB_container">
                                                    <a class="login-link" href="#">Sign in to add this
                                                        movie to a
                                                        playlist.</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gen-movie-action">
                                    <a href="incs/count_series_view.php?id='.$genre['id'].'&m_name='.$genre['title'].'" class="gen-button">
                                        <i class="fa fa-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="gen-info-contain">
                                <div class="gen-movie-info">
                                    <h3><a href="incs/count_series_view.php?id='.$genre['id'].'&m_name='.$genre['title'].'">'.$genre['title'].'</a></h3>
                                </div>
                                <div class="gen-movie-meta-holder">
                                    <ul>
                                        
                                        <li>
                                            <a href="comedy.html"><span>'.$type.'</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
                }
              
            }else{
                
            }
        }

    }
}
// $try = new seasons;
// $try->series_season(10);
// $try->optionz();
// $try->season_click();
// $try->get_genre();