<?php
//header('Access-Control-Allow-Origin: 127.0.0.1/niiflick.com/premiers.html');
include 'apis/conn.php';
include 'apis/client_loc.php';
class premiers extends connection{
    private $currency;
    private $rate;
    private $pg;
	private $limit;
	private $start;
    public function get_premiers($PG){
        $this->limit = 4;
		$this->pg = $PG;
		$this->start = ($this->pg-1)*$this->limit;
            $this->currency = getVisIpAddr();
            $this->rate = get_rate();
            $sql = "SELECT id,title,filmposter,dollaramount FROM d_movies WHERE status = 1 AND deleted_at IS NULL ORDER BY id DESC LIMIT $this->start,$this->limit;";
            $stmt = $this->connect()->prepare($sql);
            $send = $stmt->execute();
            if($send){
                $premiers = $stmt->fetchAll();
                foreach($premiers as $premier){
                    $title = rawurlencode($premier['title']);
                    $amount = '';
                   if($this->currency == 'NG'){
                        $amount = '&#8358; '.number_format(round($premier['dollaramount'] * $this->rate));
                   }else{
                        $amount = '$ '.$premier['dollaramount'];
                   }

                    
                    echo '
                     <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                        <div class="gen-movie-contain">
                            <div class="gen-movie-img">
                                <img src="niiflicks/directors'.$premier['filmposter'].'" alt="single-video-image">
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
                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                class="fa fa-plus"></i></a>
                                        <div class="dropdown-menu">
                                            <a class="login-link" href="#">Sign in to add
                                                this video to a playlist.</a>
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
                                            <a href="unlock.php?id='.$premier['id'].'&m_name='.$premier['title'].'"><span>Watch Now</span></a>
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
                     $price = '&#8358; '.number_format(round($trends['dollaramount'] * $this->rate));
                }else{
                     $price = '$ '.$trends['dollaramount'];
                }
                echo '
                <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="gen-carousel-movies-style-3 movie-grid style-3">
                    <div class="gen-movie-contain">
                        <div class="gen-movie-img">
                            <img src="niiflicks/directors.'.$trends['filmposter'].'" alt="'.$trends['filmposter'].'">
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
                                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                            class="fa fa-plus"></i></a>
                                    <div class="dropdown-menu">
                                        <a class="login-link" href="#">Sign in to add
                                            this video to a playlist.</a>
                                    </div>
                                </div>
                            </div>
                            <div class="gen-movie-action">
                                <a href="incs/count_view.php?id='.$trends['id'].'&m_name='.$tname.'" class="gen-button">
                                    <i class="fa fa-shopping-basket"></i>
                                </a>
                            </div>
                        </div>
                        <div class="gen-info-contain">
                            <div class="gen-movie-info">
                                <h3><a href="incs/count_view.php?id='.$trends['id'].'&m_name='.$tname.'">'.$trends['title'].'</a></h3>
                            </div>
                            <div class="gen-movie-meta-holder">
                                <ul>
                                    <li>'.$price.'</li>
                                    <li>
                                        <a href="unlock.php?id='.$trends['id'].'&m_name='.$trends['title'].'"><span>Watch Now</span></a>
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
       }
       public function pagination(){
		$sql3 = "SELECT id FROM d_movies WHERE status = 1 AND deleted_at IS NULL ORDER BY id DESC;";
		$send3 = $this->connect()->prepare($sql3);
        $send3->execute();
		$total = $send3->rowCount();
		// $result3 = $send3->fetch_all(MYSQLI_ASSOC);
		// $total = $result3[0]['id'];
		// if($this->decide > 10){
			$pages = ceil($total/$this->limit);
		$previous = $this->pg-1;
		$next = $this->pg+1;
        $active='';
		// $to = $this->start+$this->limit;
        if($total >4){
            echo '
        <nav aria-label="Page navigation">
            <ul class="page-numbers">
                
		';
		for($j=1; $j<=$pages; $j++){
            if(isset($_GET['page'])){
                if($_GET['page'] == $j){
                    $active = 'current';
                }else{
                    $active = '';
                }
            }
            
			echo '
                    
                    <li><a class="page-numbers '.$active.'" href="premieres.php?page='.$j.'">'.$j.'</a></li> 
		';
		}
		echo '
                <li><a class="next page-numbers" href="premieres.php?page='.$next.'">Next page</a></li>
                </ul>
        </nav>
		';
        }
		
	
		
		
		
	}
}
