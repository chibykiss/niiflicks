<?php
// header('Access-Control-Allow-Origin: *');
include 'apis/conn.php';
include_once 'apis/client_loc.php';
class single_premier extends connection{
    private $id;
    private $genre;
    private $currency;
    private $rate;

    public function get_single($ID){
        $this->id = $ID;
        $this->currency = getVisIpAddr();
        $this->rate = get_rate();
        $sql = "SELECT id,trailer,filmposter,title,description,dollaramount,genre,view_count,duration,release_date FROM d_movies WHERE id = '$this->id';";
        $stmt = $this->connect()->prepare($sql);
        $send = $stmt->execute();

        if($send){
            $premier = $stmt->fetch();
            $this->genre = $premier['genre'];
            $amount = '';
            $real_amount = '';
            if($this->currency == 'NG'){
                 $real_amount = round(($premier['dollaramount'] * $this->rate),-2);
                 $amount = '&#8358; '.number_format($real_amount);
            }else{
                 $amount = '$ '.$premier['dollaramount'];
            }
           
            echo '
            <div class="col-lg-12">
            <div class="gen-video-holder">
            <video width="100%" height="550px" controls controlsList="nodownload" autoplay>
            <source src="niiflicks/directors'.$premier['trailer'].'" type="video/mp4">
            
            Your browser does not support the video tag.
            </video>
            </div>
            </div>

            <div class="col-lg-12">
                <div class="single-video">
                    <div class="gen-single-video-info">
                        <h2 class="gen-title">'.$premier['title'].'</h2>
                        <div class="gen-single-meta-holder">
                            <ul>
                                <li class="gen-sen-rating">TV-PG</li>
                                <li>
                                    <i class="fas fa-eye">
                                    </i>
                                    <span>'.$premier['view_count'].' Views</span>
                                </li>
                                
                                <li>English</li>
                                <li id="normalamt">'.$amount.'</li>
                                <input type="hidden" id="user_ip" value="'.$this->currency.'">
                                <input type="hidden" id="rel_amount" value="'.$real_amount.'">
                                <input type="hidden" id="dollarm" value="'.$premier['dollaramount'].'">
                                <input type="hidden" id="trail" value="'.$premier['trailer'].'">
                                <input type="hidden" id="pics" value="'.$premier['filmposter'].'">
                                <input type="hidden" id="dexc" value="'.$premier['description'].'">
                            </ul>
                        </div>
                        <p>'.$premier['description'].'
                        </p>
                        <div class="gen-after-excerpt">
                            <div class="gen-extra-data">
                                <ul>
                                
                                    <li><span>Genre :</span>
                                        <span>
                                            <a href="action.html">
                                            '.$premier['genre'].' </a>
                                        </span>
                                    </li>
                                    <li><span>Run Time :</span>
                                        <span>'.$premier['duration'].'</span>
                                    </li>
                                    <li>
                                        <span>Release Date :</span>
                                        <span>'.$premier['release_date'].'</span>
                                    </li>
                                </ul>
                                <a  type="button" class="btn gen-button gen-button-flat" data-toggle="modal" data-target="#myModal1">
                               
                                    <span class="text">WATCH MOVIE</span>
                                </a>
                                <a href="register" class="gen-button gen-button-flat">
                                    <span class="text">REGISTER</span>
                                </a>

                                
                                <input type="text" id="clink" class="input" value="" required>
                                <a href="#" id="to_copy" class="gen-button gen-button-flat">
                                    <span class="text">Copy Link</span>
                                </a>
                                
                            </div>
                        
                            <div class="gen-socail-share mt-0">
                                <h4 class="align-self-center">Social Share :</h4>
                                <ul class="social-inner">
                                    <li><a href="https://www.facebook.com/sharer.php?u=http://localhost/niiflicks.com/single/'.$premier['id'].'/'.$premier['title'].'" class="facebook facebook-btn"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li><a href="#" class="facebook linkedin-btn"><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li><a href="#" class="facebook twitter-btn"><i class="fab fa-twitter"></i></a></li>
                                </ul>
                            </div>

                        </div> 
                    </div>
                </div>
            </div>
            ';

        }else{
           echo 'internal server error';
        }
    
    }

    public function morelike(){
        $query = "SELECT id,filmposter,title,dollaramount FROM d_movies WHERE genre = '$this->genre' AND status = 1 AND deleted_at IS NULL AND id <> '$this->id'";
        $smt = $this->connect()->prepare($query);
        $result = $smt->execute();
        if($result){
            $is_there = $smt->rowCount();
            if($is_there >= 1){
                $all_genre = $smt->fetchAll();
                foreach($all_genre as $one_genre){
                    $onetitle = rawurlencode( $one_genre['title']);
                    $price = '';
                    if($this->currency == 'NG'){
                        $price = round(($one_genre['dollaramount'] * $this->rate),-2);
                        $price = '&#8358; '.number_format($price);
                    }else{
                        $price = '$ '.$one_genre['dollaramount'];
                    }
                    //$onetitle = preg_replace('/\s+/', '_', $one_genre['title']);
                    echo '
                    <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                        <div class="gen-movie-contain">
                            <div class="gen-movie-img">
                                <img src="niiflicks/directors'.$one_genre['filmposter'].'"
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
                                    <a href="incs/count_view.php?id='.$one_genre['id'].'&m_name='.$onetitle.'" class="gen-button">
                                        <i class="fa fa-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="gen-info-contain">
                                <div class="gen-movie-info">
                                    <h3><a href="incs/count_view.php?id='.$one_genre['id'].'&m_name='.$onetitle.'">'.$one_genre['title'].'</a></h3>
                                </div>
                                <div class="gen-movie-meta-holder">
                                    <ul>
                                        <li>'.$price.'</li>
                                        <li>
                                            <a href="unlock.php?id='.$one_genre['id'].'&m_name='.$one_genre['title'].'"><span>Watch Now</span></a>
                                        </li>
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



