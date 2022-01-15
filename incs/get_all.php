<?php
include 'conn.php';
include 'apis/client_loc.php';
class premiers extends connection{
    private $category;
    private $currency;
    private $rate;
    public function get_premiers($CT){
        $this->currency = getVisIpAddr();
        $this->rate = get_rate();
        $this->category = $CT;
        if($this->category == 'latest'){
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
                   <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gen-carousel-movies-style-3 movie-grid style-3 cardhovr">
                            <div class="gen-movie-contain">
                                <div class="gen-movie-img">
                                    <img src="niiflicks/directors'.$premier['filmposter'].'" alt="streamlab-image">
                                    <div class="gen-movie-add">
                                        <div class="wpulike wpulike-heart">
                                            <div class="wp_ulike_general_class wp_ulike_is_not_liked"><button
                                                    type="button" class="wp_ulike_btn wp_ulike_put_image"></button>
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
                                                        <a class="login-link" href="#">Sign in to add this movie to
                                                            a
                                                            playlist.</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gen-movie-action">
                                        <a href="incs/count_view.php?id='.$premier['id'].'&m_name='.$title.'" class="gen-button">
                                            <i class="fa fa-shopping-basket"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="gen-info-contain">
                                    <div class="gen-movie-info">
                                        <h3><a href="incs/count_view.php?id='.$premier['id'].'&m_name='.$title.'">'.$premier['title'].'</a></h3>
                                    </div>
                                    <div class="gen-movie-meta-holder">
                                        <ul>
                                            <li>'.$amount.'</li>
                                            <li>
                                                <a href="unlock/'.$premier['id'].'/'.$premier['title'].'"><span>Watch Now</span></a>
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
               
                echo 'internal sql error(latest)';
            }
        }
        else if($this->category == 'trending'){
            $sql = "SELECT id,title,filmposter,dollaramount,view_count FROM d_movies WHERE status = 1 AND deleted_at IS NULL ORDER BY view_count DESC;";
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
                    //print all trending movies
                    echo '
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gen-carousel-movies-style-3 movie-grid style-3 cardhovr">
                            <div class="gen-movie-contain">
                                <div class="gen-movie-img">
                                    <img src="niiflicks/directors'.$premier['filmposter'].'" alt="streamlab-image">
                                    <div class="gen-movie-add">
                                        <div class="wpulike wpulike-heart">
                                            <div class="wp_ulike_general_class wp_ulike_is_not_liked"><button
                                                    type="button" class="wp_ulike_btn wp_ulike_put_image"></button>
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
                                                        <a class="login-link" href="#">Sign in to add this movie to
                                                            a
                                                            playlist.</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gen-movie-action">
                                        <a href="incs/count_view.php?id='.$premier['id'].'&m_name='.$title.'" class="gen-button">
                                            <i class="fa fa-shopping-basket"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="gen-info-contain">
                                    <div class="gen-movie-info">
                                        <h3><a href="incs/count_view.php?id='.$premier['id'].'&m_name='.$title.'">'.$premier['title'].'</a></h3>
                                    </div>
                                    <div class="gen-movie-meta-holder">
                                        <ul>
                                            <li>'.$amount.'</li>
                                            <li>
                                                <a href="unlock/'.$premier['id'].'/'.$premier['title'].'"><span>Watch Now</span></a>
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
              
                echo 'internal sql error(trending)';
            }
        }else{
            
             echo '<h3>Error in Category</h3>';
        }
       
    }
}

    



