<?php
//header('Access-Control-Allow-Origin: 127.0.0.1/niiflick.com/premiers.html');
include 'apis/conn.php';
include 'apis/client_loc.php';
class premiers extends connection{
    private $currency;
    private $rate;
  
    public function get_premiers(){
        
            $this->currency = getVisIpAddr();
            $this->rate = get_rate();
            $sql = "SELECT id,title,filmposter,dollaramount FROM d_movies WHERE status = 1 AND deleted_at IS NULL ORDER BY id DESC;";
            $stmt = $this->connect()->prepare($sql);
            $send = $stmt->execute();
            if($send){
                $premiers = $stmt->fetchAll();
                foreach($premiers as $premier){
                    $title = rawurlencode($premier['title']);
                    $amount = '';
                   if($this->currency == 'NG'){
                        $amount = round(($premier['dollaramount'] * $this->rate),-2);
                        $amount = '&#8358; '.number_format($amount);
                   }else{
                        $amount = '$ '.$premier['dollaramount'];
                   }

                    
                    echo '
                     <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-2 movie-grid style-2 cardhovr">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="niiflicks/directors'.$premier['filmposter'].'"
                                                    alt="owl-carousel-video-image">
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
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="incs/count_view.php?id='.$premier['id'].'&m_name='.$title.'" class="gen-button">
                                                        <i class="fa fa-credit-card"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="incs/count_view.php?id='.$premier['id'].'&m_name='.$title.'">'.$premier['title'].'</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>'.$amount.'</li>
                                                        <li>
                                                            <a href="unlock/'.$premier['id'].'/'.$premier['title'].'"><span>Watch Movie</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> 
                    ';
                    
                }
            }else{
               
                echo 'internal sql error';
            }
     
    
       }
       public function get_trending(){
        $sql = "SELECT id,title,filmposter,dollaramount,view_count FROM d_movies WHERE status = 1 AND deleted_at IS NULL ORDER BY view_count DESC;";
        $stmt = $this->connect()->prepare($sql);
        $send = $stmt->execute();
        if($send){
            $trendings = $stmt->fetchAll();
            

            foreach($trendings as $trends){
                $tname = rawurlencode( $trends['title']);
                $price = '';
                if($this->currency == 'NG'){
                    $price = round(($trends['dollaramount'] * $this->rate),-2);
                    $price = '&#8358; '.number_format($price);
                    
                }else{
                     $price = '$ '.$trends['dollaramount'];
                }
                echo '
                <div class="item">
                <div class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                    <div class="gen-carousel-movies-style-2 movie-grid style-2 cardhovr">
                        <div class="gen-movie-contain">
                            <div class="gen-movie-img">
                                <img src="niiflicks/directors'.$trends['filmposter'].'"
                                    alt="owl-carousel-video-image">
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
                                                    <a class="login-link" href="register.html">Sign in
                                                        to add this
                                                        movie to a
                                                        playlist.</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gen-movie-action">
                                    <a href="incs/count_view.php?id='.$trends['id'].'&m_name='.$tname.'" class="gen-button">
                                        <i class="fa fa-credit-card"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="gen-info-contain">
                                <div class="gen-movie-info">
                                    <h3><a href="incs/count_view.php?id='.$trends['id'].'&m_name='.$tname.'">'.$trends['title'].'</a>
                                    </h3>
                                </div>
                                <div class="gen-movie-meta-holder">
                                    <ul>
                                        <li>'.$price.'</li>
                                        <li>
                                            <a href="unlock/'.$trends['id'].'/'.$trends['title'].'"><span>Watch Now</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div> 
                ';
            }
        }
       }
    
}
