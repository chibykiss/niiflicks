<?php
include_once 'conn.php';
include 'apis/client_loc.php';
class search extends connection{
    private $term;
    private $currency;
    private $rate;
    public function search_now($TM){
        $this->term = $TM;
        $this->currency = getVisIpAddr();
        $this->rate = get_rate();
        try{
            $sql  = "SELECT id,title,filmposter,dollaramount FROM d_movies WHERE title LIKE CONCAT('%', ?, '%') OR genre = ? AND status = 1 AND deleted_at IS NULL ORDER BY id DESC;";
            $smt = $this->connect()->prepare($sql);
            $send = $smt->execute([$this->term,$this->term]);
            $hasval = $smt->rowCount();
            if($send){
                if($hasval >= 1){
                    $results = $smt->fetchAll();
                    foreach($results as $result){
                        $title = rawurlencode($result['title']);
                        $amount = '';
                       if($this->currency == 'NG'){
                            $amount = round(($result['dollaramount'] * $this->rate),-2);
                            $amount = '&#8358; '.number_format($amount);
                       }else{
                            $amount = '$ '.$result['dollaramount'];
                       }
                       echo '
                       <div class="col-xl-3 col-lg-4 col-md-6">
                       <div class="gen-carousel-movies-style-3 movie-grid style-3">
                           <div class="gen-movie-contain">
                               <div class="gen-movie-img">
                                   <img src="niiflicks/directors'.$result['filmposter'].'" alt="streamlab-image">
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
                                       <a href="incs/count_view.php?id='.$result['id'].'&m_name='.$title.'" class="gen-button">
                                           <i class="fa fa-shopping-basket"></i>
                                       </a>
                                   </div>
                               </div>
                               <div class="gen-info-contain">
                                   <div class="gen-movie-info">
                                       <h3><a href="incs/count_view.php?id='.$result['id'].'&m_name='.$title.'">'.$result['title'].'</a></h3>
                                   </div>
                                   <div class="gen-movie-meta-holder">
                                       <ul>
                                           <li>'.$amount.'</li>
                                           <li>
                                               <a href="unlock/'.$result['id'].'/'.$result['title'].'"><span>Watch Now</span></a>
                                           </li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                       ';

                    }
                    //print_r($result);
                }else{
                    echo '<h4 style="margin: 0 auto;">N0 RESULT FOUND<h4>';
                }
            }else{
                echo 'db internal error';
            }
        }
        catch(Exception $e){
            echo 'error: ' .$e->getMessage();
        }
       
    }
}
