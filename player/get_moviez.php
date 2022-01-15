<?php   
include '../apis/conn.php';
include_once '../apis/client_loc.php';
class getit extends connection{
    private $id;
    private $genre;
    private $currency;
    private $rate;
    public function myMovie($MID){
        $this->id = $MID;
    try{
        $sql = "SELECT * from d_movies  WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->id]);
        $result = $stmt->fetch();
        $count = $stmt->rowCount();

        if($count == 1){
            $title = $result['title'];
            $this->genre = $result['genre'];
            $movie = $result['movie'];
            $desc = $result['overview'];
            $views = $result['view_count'];
            $price = $result['nairaamount'];
            $poster = $result['filmposter'];
            $duration = $result['duration'];
            $release_date = $result['release_date'];
           
            echo '
            
    <div class="col-lg-12">
        <div class="gen-video-holder">

                <video
                id="my-video"
                class="video-js vjs-big-play-centered vjs-matrix"
                poster="niiflicks/directors'.$poster.'"
            >
                <source src="niiflicks/directors'.$movie.'" type="video/mp4" />
                <source src="MY_VIDEO.webm" type="video/webm" />
                <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="niiflicks/directors'.$movie.'" target="_blank"
                    >supports HTML5 video</a
                >
                </p>
            </video>
                
        </div>
    </div>

    <div class="col-lg-12">
        <div class="single-video">
            <div class="gen-single-video-info">
                <h2 class="gen-title">'.$title.'</h2>
                <div class="gen-single-meta-holder">
                    <ul>
                        <li class="gen-sen-rating">TV-PG</li>
                        <li>
                            <i class="fas fa-eye">
                            </i>
                            <span>'.$views.'</span>
                        </li>
                        
                        <li>English</li>
                        <!--<li>&#8358; '.$price.'</li>-->
                    </ul>
                </div>
                <p>'.$desc.'
                </p>
                <div class="gen-after-excerpt">
                    <div class="gen-extra-data">
                        <ul>
                        
                            <li><span>Genre :</span>
                                <span>
                                    <a href="#">
                                        '.$this->genre.' </a>
                                </span>
                            </li>
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

    public function morelike(){
        $this->currency = getVisIpAddr();
        $this->rate = get_rate();
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
                        $price = '&#8358; '.number_format(round($one_genre['dollaramount'] * $this->rate));
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
                                            <a href="unlock/'.$one_genre['id'].'/'.$one_genre['title'].'"><span>Watch Now</span></a>
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



