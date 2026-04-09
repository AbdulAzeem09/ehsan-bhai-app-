<?php
  include('../univ/baseurl.php');
  session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>  
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script> 
        <script type="text/javascript">
            //USER ONE
            $(function () {
                $('#leftmenu').multiselect({
                    includeSelectAllOption: true
                });
                
            });
            
        </script>
        
    </head>

    <body class="bg_gray">
      <?php
        
        if(!isset($_SESSION['pid']))
        { 
          include_once ("../authentication/check.php");
          $_SESSION['afterlogin']="my-posts/";
        }
        function sp_autoloader($class)
        {
          include '../mlayer/' . $class . '.class.php';
        }
        spl_autoload_register("sp_autoloader");
        //this is for store header
        $header_store = "header_store";

        include_once("../header.php");
        
        
      ?>
    	
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                              include('../component/left-store.php');
                            ?>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="top_banner">
                                    <?php
                                    if(isset($_GET['mystore']) || isset($_GET["spPostingsFlag"])){
                                      ?><img src="<?php echo $BaseUrl?>/assets/images/icon/store/store_banner.jpg" class="img-responsive"> <?php
                                    }else{
                                      $bann = new _postbanner;
                                      $result_ban = $bann->read_banner($_SESSION['pid']);
                                      //echo $bann->ta->sql;
                                      if($result_ban != false){
                                        $row_ban = mysqli_fetch_assoc($result_ban);
                                        echo "<img alt='Banner Picture' class='img-responsive' src=' " . $row_ban['sppostingbanner']. "' >";
                                      }else{
                                        echo "<img alt='Banner Picture' class='img-responsive' src='".$BaseUrl."/assets/images/icon/store/store_banner.jpg' >";
                                      }
                                      ?>
                                      <form method="post" action="addbanner.php" enctype="multipart/form-data" >
                                        <input type="hidden" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'];?>">
                                        <div class="upload_banner">
                                          <span class="input-group-btn text-right"> 
                                            <!-- image-preview-input -->
                                            <div class="btn btn-default image-preview-input"> 
                                                <span class="glyphicon glyphicon-folder-open"></span> 
                                                <span class="image-preview-input-title">Browse</span>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="spPostingPic"/>
                                                <!-- rename it --> 
                                            </div>
                                            <button type="submit" class="btn btn-labeled btn-primary chngeBanner" > <span class="btn-label"><i class="glyphicon glyphicon-upload"></i> </span>Upload</button>
                                          </span>
                                        </div>
                                      </form> <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php include('searchform.php');?>
                        <div class="retail_level_two m_btm_10 banner_btn" id="top_page_heading">
                            <div class="row">
                              <div class="col-md-offset-4 col-md-4">
                                  <h3><?php echo $storeTitle;?></h3>
                              </div>
                              <div class="col-md-4">
                                <a href="<?php echo $BaseUrl?>/post-ad/sell/?post" class="notify create_add text-right">Create AD</a>
                              </div>
                            </div>
                        </div>
                        <?php
                        $p = new _postingview;
                        if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                          //my store
                          $res = $p->myall_store($_SESSION['uid']);
                          $storeofmonth = $p->store_of_month(6, $_SESSION['uid'], $_SESSION['pid']);

                        }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                          //friend store
                          $res = $p->store_friends_Posting($_SESSION['uid']);
                          $storeofmonth = $p->store_of_month(4, $_SESSION['uid'], $_SESSION['pid']);

                        }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                          //group post
                          $res = $p->all_group_store($_SESSION['pid']);
                          $storeofmonth = $p->store_of_month(5, $_SESSION['uid'], $_SESSION['pid']);

                        }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                          //group post
                          $res = $p->retailpost(1);
                          $storeofmonth = $p->store_of_month(2, $_SESSION['uid'], $_SESSION['pid']);

                        }else{
                          //public store
                          $res = $p->publicpost(isset($start), 1);
                          $storeofmonth = $p->store_of_month(1, $_SESSION['uid'], $_SESSION['pid']);
                        }
                        ?>
                        <div class="row no-margin three_box">
                            <div class="col-md-4 no-padding">
                                <a href="#">
                                    <div class="s_m_box text-center">
                                        <h2>Best seller category</h2>
                                        <h4><?php echo $storeofmonth;?></h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 no-padding">
                                <a href="#">
                                    <div class="s_m_box text-center">
                                      <?php
                                        //echo $p->ta->sql;
                                        if($res != false){
                                          $res_r = $res;
                                          $heighestRating = 0;
                                          $heightId = 0;
                                          while ($num = mysqli_fetch_assoc($res_r)) {

                                            $r = new _sppostrating;
                                            $result_r = $r->review($num["idspPostings"]);
                                            //echo $r->ta->sql."<br>";
                                            if ($result_r != false) {
                                                $total = 0;
                                                $count = $result_r->num_rows;
                                                while ($rows_r = mysqli_fetch_assoc($result_r)) {
                                                    $total += $rows_r["spPostRating"];
                                                }
                                                $ratings = $total / $count;
                                                //echo $ratings."-".$num['idspPostings']."<br>";

                                                if($ratings > $heighestRating){
                                                  $heighestRating = $ratings;
                                                  $heightId = $num["idspPostings"];
                                                }
                                            }
                                          }
                                        }
                                        //echo $heightId;
                                        
                                      ?>
                                        <h2>Featured Seller</h2>
                                        <h4>
                                          <?php
                                          $result_rating = $p->read($heightId);
                                          if($result_rating != false){
                                            //echo $p->ta->sql;
                                            $name_p = mysqli_fetch_assoc($result_rating);
                                            echo $name_p['spProfileName'];

                                          }else{
                                            echo "No Top Created Person";
                                          }
                                          ?>
                                        </h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 no-padding">
                                <a href="#">
                                    <div class="s_m_box text-center">
                                        <h2>Active Auctions</h2>
                                        <h4><?php echo $res->num_rows; ?></h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3>New Arrival <span class="pull-right"><a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>">(View All)</a></span></h3>
                              </div>

                              <div class="carousel carousel-showmanymovetwo slide" id="itemslider_two">
                                <div class="carousel-inner">
                                  <?php
                                  $p = new _postingview;
                                    if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                      //my store
                                      $res = $p->myall_store($_SESSION['uid']);
                                    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                      //friend store
                                      $res = $p->store_friends_Posting($_SESSION['uid']);
                                    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                      //group post
                                      $res = $p->all_group_store($_SESSION['pid']);

                                    }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                        //group post
                                        $res = $p->retailpost(1);
                                    }else{
                                      //public store
                                      $res = $p->publicpost(isset($start), 1);
                                    }

                                  //echo $p->ta->sql;
                                  $active = 0;
                                  if($res != false){
                                    while ($rows = mysqli_fetch_assoc($res)) {?>
                                      <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths">
                                          <div class="img_new_arriv text-center">
                                            <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
                                              <?php
                                                $pic = new _postingpic;
                                                $result = $pic->read($rows['idspPostings']);
                                                //echo $pic->ta->sql;
                                                if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' src='../img/no-pic.jpg' class='img-responsive'>";
                                                }else{
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' src='../img/no-pic.jpg' class='img-responsive'>";
                                                }
                                              ?>
                                              
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                      <?php
                                      $active++;
                                    }
                                  } ?>

                                  
                                </div>
                                <div id="slider-control" class="slideNewContrl">
                                  <a class="left carousel-control" href="#itemslider_two" data-slide="prev"><img src="https://s12.postimg.org/uj3ffq90d/arrow_left.png" alt="Left" class="img-responsive"></a>
                                  <a class="right carousel-control" href="#itemslider_two" data-slide="next"><img src="https://s12.postimg.org/djuh0gxst/arrow_right.png" alt="Right" class="img-responsive"></a>
                                </div>
                              </div>
                            </div>
                        
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
              								<div class="heading03">
              									<h3>All Products <span class="pull-right"><a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>">(View All)</a></span></h3>
              								</div>

                              <div class="carousel carousel-showmanymoveone slide" id="itemslider">
                                <div class="carousel-inner">
                                  <?php
                                  
                                    $p = new _postingview;
                                    if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                      //my store
                                      $res = $p->myall_store($_SESSION['uid']);
                                    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                      //friend store
                                      $res = $p->store_friends_Posting($_SESSION['uid']);
                                    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                      //group post
                                      $res = $p->all_group_store($_SESSION['pid']);
                                    }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                        //retail post
                                        $res = $p->retailpost(1);
                                    }else{
                                      //public store
                                      $res = $p->publicpost(isset($start), 1);
                                    }
                                    
                                  //echo mysqli_num_rows($res);
                                  //echo $p->ta->sql;
                                  $active = 0;
                                  if($res != false){
                                    while ($rows = mysqli_fetch_assoc($res)) {
                                      $dt = new DateTime($rows['spPostingDate']);
                                     ?>
                                      <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths">
                                          <div class="featured_box text-center">
                                            <div class="img_fe_box">
                                              <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
                                                <?php
                                                  $pic = new _postingpic;
                                                  $result = $pic->read($rows['idspPostings']);
                                                  //echo $pic->ta->sql;
                                                  if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                                                    if ($result != false) {
                                                        $rp = mysqli_fetch_assoc($result);
                                                        $picture = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                    } else
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                  }else{
                                                    if ($result != false) {
                                                        $rp = mysqli_fetch_assoc($result);
                                                        $picture = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                    } else
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                  }
                                                ?>
                                              </a>
                                            </div>
                                            <h4>
                                              <?php 
                                                if(!empty($rows['spPostingtitle'])){
                                                    if(strlen($rows['spPostingtitle']) < 15){
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo $rows['spPostingtitle']; ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo substr($rows['spPostingtitle'], 0,15).'...'; ?></a><?php
                                                    }
                                                }else{
                                                    echo "&nbsp;";
                                                }
                                                ?>    
                                            </h4>
                                            <h5 >
                                              <?php
                                              if ($rows['spPostingPrice'] != false) {
                                                  echo "<div class='postprice' style='display: inline-block;' data-price='" . $rows['spPostingPrice'] . "'>$" . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                              }else{
                                                  echo "Expires on ".$rows['spPostingExpDt'];
                                              }
                                              ?>
                                            </h5>
                                            <h6 class="name"><?php echo $rows['spProfileName'];?></h6>
                                            <p class="date"><?php echo $dt->format('d F'); ?> | <?php echo $dt->format('H:i a'); ?></p>
                                          </div>
                                        </div>
                                      </div> <?php
                                      $active++;
                                    }
                                  } ?>
                                  
                                </div>

                                <div id="slider-control">
                                <a class="left carousel-control" href="#itemslider" data-slide="prev"><img src="https://s12.postimg.org/uj3ffq90d/arrow_left.png" alt="Left" class="img-responsive"></a>
                                <a class="right carousel-control" href="#itemslider" data-slide="next"><img src="https://s12.postimg.org/djuh0gxst/arrow_right.png" alt="Right" class="img-responsive"></a>
                              </div>
                              </div>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="heading03">
                              <h3>Request For Quotations</h3>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <a href="#">
                              <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/quote.jpg" class="img-responsive" />
                            </a>
                          </div>
                          <div class="col-md-4 no_pad_left_right">
                            <div class="quote_box">
                              <h2>One Request, Multiple Quotes.</h2>

                              <form >
                                <div class="">
                                  <select class="form-control">
                                    <option>Category</option>
                                    <?php
                                    $p = new _postfield;
                                    $catid = 1;
                                    $result2 = $p->readlabel($catid);
                                    //echo $p->ta->sql;
                                    if ($result2 != false){
                                        $catCount = 0;
                                        while($row2 = mysqli_fetch_assoc($result2)){
                                            if($row2['spPostFieldLabel'] == 'Subcategory'){
                                                if($catCount == 0){
                                                
                                                  $values = $p->readvalues($catid, $row2['spPostFieldLabel']);
                                                  //echo $p->ta->sql;
                                                  if($values != false){
                                                      while($vals = mysqli_fetch_assoc($values)){
                                                          $fieldValue = $vals["spPostFieldValue"];
                                                          ?>
                                                          <option value="<?php echo $fieldValue;; ?>"><?php echo $fieldValue; ?></option>
                                                          <?php
                                                      }
                                                  }
                                                     
                                                }
                                            }
                                        }
                                    } 

                                    ?>
                                    
                                  </select>
                                  <input type="text" class="form-control" id="" placeholder="What are you looking for...">
                                </div>
                                <div class="">
                                  <input type="text" class="form-control" id="qty" placeholder="Quantity">
                                </div>
                                <button type="submit" class="btn">Request For Quotations</button>
                              </form>


                            </div>
                          </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>



    	
        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
        <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script> 
        <script type="text/javascript">
          $(document).ready(function(){
            $('#itemslider').carousel({ interval: false });
            $('.carousel-showmanymoveone .item').each(function(){
              var itemToClone = $(this);
            for (var i=1;i<5;i++) {
              itemToClone = itemToClone.next();
              if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
              }
              itemToClone.children(':first-child').clone()
                .addClass("cloneditem-"+(i))
                .appendTo($(this));
              }
            });
          });
        </script>
        <script type="text/javascript">
          $(document).ready(function(){
            $('#itemslider_two').carousel({ interval: false });
            $('.carousel-showmanymovetwo .item').each(function(){
              var itemToClone = $(this);
              for (var i=1;i<5;i++) {
                itemToClone = itemToClone.next();
                if (!itemToClone.length) {
                  itemToClone = $(this).siblings(':first');
                }
                itemToClone.children(':first-child').clone()
                  .addClass("cloneditem-"+(i))
                  .appendTo($(this));
                }
              });
          });
        </script>
    </body>
</html>
