<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- image gallery script strt -->
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
        <!-- image gallery script end -->
        <!-- this script for slider art -->
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">



<style type="text/css">
  

.rating-box {
  position:relative!important;
  vertical-align: middle!important;
  font-size: 18px;
  font-family: FontAwesome;
  display:inline-block!important;
  color: lighten(@grayLight, 25%);
  padding-bottom: 10px;
}

 .rating-box:before{
    content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
  }

  .ratings {
    position: absolute!important;
    left:0;
    top:0;
    white-space:nowrap!important;
    overflow:hidden!important;
    color: Gold!important;
   
  }
   .ratings:before {
      content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
    }


</style>

       
        
    </head>    
<body class="bg_gray">
        <?php 

          $header_select = "freelancers";

        include_once("../header.php");?>

     <section class="main_box">            
            <div class="container">
            		

                <div class="row">


                    <div class="col-md-12">
                	<div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">

              
          <!--   <?php print_r($_SESSION['pid']);?>

                <?php print_r($_SESSION['uid']);?> -->

               <!--  <?php print_r($_GET["postid"]);?>  -->

                 <div class="row">
                     <div class="showeventrating">

                      <ol class="breadcrumb"  style="padding: 8px 0px;margin-bottom: 0px!important;list-style: none;background-color: unset!important;border-radius: 4px;color: #f60;">
      <li><a href="<?php echo $BaseUrl ?>/freelancer" style="color: #f60;"><i class="fa fa-home"></i> Home</a></li>
       <li><a href="<?php echo $BaseUrl ?>/freelancer/user-profile.php?profile=<?php echo $_GET['postid'];?>" style="color: #f60;">Freelancer Detail</a></li>
      <li class="active">Rating</li>
    </ol>

                        <div style="text-align: -webkit-center;">


                            <img src="<?php echo $BaseUrl;?>/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 70px;"><p style="font-size: 30px;">The SharePage</p></div>


                            <?php  /* $p = new _spevent;
                                   $res1 = $p->read($_GET['postid']);

                                 if($res1 != false){
                                        $row1 = mysqli_fetch_assoc($res1);

                                    
                                    }
*/
                                  $r = new _freelance_recomndation;

                                  $sumres = $r->readfreelancerating($_GET["postid"]);

                                  //echo $r->ta->sql; 

                                  //print_r($sumres->num_rows); 

                                 $totalreviews = $sumres->num_rows;
                                  
                                        while ($sumrow = mysqli_fetch_assoc($sumres)) {

                                          //echo "<pre>";
                                      //print_r($sumrow);


                                           $sumrating += $sumrow['recomnd_rating'];

                                           $ratarr[] =  $sumrow['recomnd_rating'];

                                          //echo count($ratarr);


                                        }



                                      $countrate = count($ratarr);

                                       $averagerate = $sumrating / $countrate;

                                           $totalrate  = round($averagerate, 1);

                                      

                                       // echo  $averagerate;


                           
                            
                        


                             ?>  

                              <div class="row">
                              <div class="col-md-8">
                                 <p class="eventcapitalize" style="font-size: 25px; margin-bottom: -14px;"><?php echo $row1['spPostingTitle'];?></p>
                                 <p class="eventcapitalize" style="font-size: 16px; padding-top: 14px;"><?php echo $row1['spPostingEventVenue'];?></p>
                                 <br> 
                               </div>
                                 <div class="col-md-4">
                                 <!-- <div style="position: absolute; top: 4px; right: 16px;"> -->
                                  <div style="float: right; top: 4px; right: 16px;">

                                 <!--  <p id='eventrating' class="rating" style="margin-bottom: 0px;"> -->

                                    <div class="rating-box">
                                      <?php if($totalrate >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalrate > "4" && $totalrate < "5") { 
                                        echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalrate >= "4") { 
                                        echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalrate > "3" && $totalrate < "4") { 
                                        echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalrate >= "3") { 
                                        echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalrate > "2" && $totalrate < "3") { 
                                        echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalrate >= "2") { 
                                        echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalrate > "1" && $totalrate < "2") { 
                                        echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalrate >= "1") { 
                                        echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalrate <= "0") { 
                                        echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                        ?>

                                    </div>
                                    <span style="font-size: 30px; padding-left: 3px;"><?php if($totalrate <= 0 ){ echo "0.0"; }else{ echo $totalrate; } ?></span> 

                                 <!--  </p> -->

                                 
                           <!--        <p id='eventrating' class="rating" style="margin-bottom: 0px;">


                                          
                                           <input class="stars" type="radio" id="star5" name="rating" value="5" <?php if($totalrate >= "5") { echo "checked";}?>>

                                           
                                            <label  style="cursor:pointer; <?php if($totalrate >= "5") { echo "color: gold";}?>" class = "full" for="star5" title="Awesome - 5 stars"></label>

                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" <?php if($totalrate >= "4") { echo "checked";}?>>


                                            <label style="cursor:pointer; <?php if($totalrate >= "4") { echo "color: gold";}?>" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" <?php if($totalrate >= "3") { echo "checked";}?>>


                                            <label style="cursor:pointer; <?php if($totalrate >= "3") { echo "color: gold";}?>" class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input style="cursor:pointer" class="stars" type="radio" id="star2" name="rating" value="2" <?php if($totalrate >= "2") { echo "checked";}?>>

                                            <label style="cursor:pointer; <?php if($totalrate >= "2") { echo "color: gold";}?>" class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input class="stars" type="radio" id="star1" name="rating" value="1" <?php if($totalrate >= "1") { echo "checked";}?>>
                                            <label style="cursor:pointer; <?php if($totalrate >= "1") { echo "color: gold";}?>" class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                
                                </p> -->
                                 

                                 <p style=" padding-left: 3px;">Reviews <?php if($totalreviews > 0){ echo $totalreviews; }else{ echo "0"; }?></p> 
                                </div>
                              </div>


                                  
                              </div>    
                          
                            <h4>Reviews</h4>
                            

                             <?php $pro = new _spprofiles;

                                  $r = new _freelance_recomndation;
                                   $res = $r->readfreelancerating($_GET["postid"]);


                                    // echo $r->ta->sql;  

                                   //print_r($res);

                                   if($res != false){
                                        while ($row = mysqli_fetch_assoc($res)) {


                                             $result = $pro->read($row['postProject_idspProfiles']); 
                                              
                                              //echo $pro->ta->sql; 

                                               $row2 = mysqli_fetch_assoc($result);

                                       /* $postingDate = $row["recomnd_date"];*/

                                              ?>

                                            
                         

                         <div class="row">
                              <div class="col-md-3">
                                  
                                  

                            <div class=""><img src="../assets/images/blank-img/default-profile.png" class="img-responsive" style="height: 70px; border-radius: 100%;">

                               <div class="" style="position: absolute; top: 10px; right: 80px;">
                               
                                <p class="eventcapitalize"><b><?php echo $row2['spProfileName'];?></b></p>
                                 <p><? echo $postingDate; ?></p> 

                              </div>
                            </div>    

                              </div>


                            <!--  <?php print_r($row['rating']);?> -->
                             


                              <div class="col-md-9" style="padding-top: 5px; margin-left: -40px;">
                                 <p id='eventrating' class="rating" style="margin-bottom: 0px;">

                                  <!--  <input class="stars" type="radio" id="star5" name="rating" value="5" <?php echo ($row['rating'] >= 5)?'checked="checked"':''; ?>>
 -->
                         <input class="stars" type="radio" id="star5" name="rating" value="5" <?php if($row['recomnd_rating'] == "5") { echo "checked "; }?> 
                              />
                                            <label  style="cursor:pointer; <?php if($row['recomnd_rating'] >= "5") { echo "color: gold";}?>" class = "full" for="star5" title="Awesome - 5 stars" style="color: gold!important;"></label>

                                            <input class="stars" type="radio" id="star4" name="rating" value="4" <?php if($row['recomnd_rating'] == "4") { echo "checked";}?> />

                                            <label style="cursor:pointer; <?php if($row['recomnd_rating'] >= "4") { echo "color: gold";}?>" class = "full <?php if($row['recomnd_rating'] == "4") { echo "checkrating "; }?>" for="star4" title="Pretty good - 4 stars"></label>

                                            <input class="stars" type="radio" id="star3" name="rating" value="3" <?php if($row['recomnd_rating'] == "3") { echo "checked";}?> />


                                            <label style="cursor:pointer; <?php if($row['recomnd_rating'] >= "3") { echo "color: gold";}?>" class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input style="cursor:pointer;" class="stars" type="radio" id="star2" name="rating" value="2" <?php if($row['recomnd_rating'] == "2") { echo "checked";}?> />

                                            <label style="cursor:pointer; <?php if($row['recomnd_rating'] >= "2") { echo "color: gold";}?>" class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input class="stars" type="radio" id="star1" name="rating" value="1" <?php if($row['recomnd_rating'] == "1") { echo "checked";}?> />

                                            <label style="cursor:pointer; <?php if($row['recomnd_rating'] >= "1") { echo "color: gold";}?>" class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                </p>
                                  
                                  <div style="position: absolute;  bottom: -40px;  left: 20px;" ><p ><?php echo $row['desc_recomndation'];?></p></div>
                              </div>
                         </div>
                         <br>

                          <?php  }

                                        
                                    }else{?>

                                      <div style="text-align: center;">No Review Available</div>

                                  <?php  }



                                  ?>


                         



                     </div>
                 </div>




                       
                   </div>



                       </div>
                   </div>
               </div>

     </section>
        
      
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        

       
</body>
</html>
<?php
}
?>