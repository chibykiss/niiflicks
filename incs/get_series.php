<?php
//header('Access-Control-Allow-Origin: 127.0.0.1/niiflick.com/premiers.html');
include 'apis/conn.php';
class series extends connection{
  
  
    public function get_series(){
            $sql = "SELECT id,title,filmposter FROM d_tvseries WHERE status = 1 AND deleted_at IS NULL ORDER BY id DESC;";
            $stmt = $this->connect()->prepare($sql);
            $send = $stmt->execute();
            if($send){
                $series = $stmt->fetchAll();
                foreach($series as $serie){
                    $title = rawurlencode($serie['title']);
                   

                    
                    echo '
                     <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-2 movie-grid style-2 cardhovr">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="niiflicks/directors/uploads/tvseries/posters/'.$serie['filmposter'].'"
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
                                                    <a href="incs/count_series_view.php?id='.$serie['id'].'&m_name='.$title.'" class="gen-button">
                                                        <i class="fa fa-shopping-basket"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3 style="margin-left:10px;"><a href="incs/count_series_view.php?id='.$serie['id'].'&m_name='.$title.'">'.$serie['title'].'</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <!--<li>stuff here</li>
                                                        <li>
                                                            <a href=""><span>View</span></a>
                                                        </li>-->
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
        $sql = "SELECT id,title,filmposter,view_count FROM d_tvseries WHERE status = 1 AND deleted_at IS NULL ORDER BY view_count DESC;";
        $stmt = $this->connect()->prepare($sql);
        $send = $stmt->execute();
        if($send){
            $trendings = $stmt->fetchAll();
            

            foreach($trendings as $trends){
                $tname = rawurlencode( $trends['title']);
                echo '
                <div class="item">
                <div class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                    <div class="gen-carousel-movies-style-2 movie-grid style-2 cardhovr">
                        <div class="gen-movie-contain">
                            <div class="gen-movie-img">
                                <img src="niiflicks/directors/uploads/tvseries/posters/'.$trends['filmposter'].'"
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
                                    <a href="incs/count_series_view.php?id='.$trends['id'].'&m_name='.$tname.'" class="gen-button">
                                        <i class="fa fa-credit-card"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="gen-info-contain">
                                <div class="gen-movie-info">
                                    <h3><a href="incs/count_series_view.php?id='.$trends['id'].'&m_name='.$tname.'">'.$trends['title'].'</a>
                                    </h3>
                                </div>
                                <div class="gen-movie-meta-holder">
                                    <ul>
                                        <!--<li>Stuff Again</li>
                                        <li>
                                            <a href=""><span>View</span></a>
                                        </li>-->
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
