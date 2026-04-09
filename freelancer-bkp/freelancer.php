<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="freelancer/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
     $activePage = 7;

    // ==CHEK PROFILE IS BUSINESS OR FREELANCE OR NOT
    $f = new _spprofiles;
    $re = new _redirect;
    //check profile is freelancer or not
    $chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
    if($chekIsFreelancer == false){
        $redirctUrl = $BaseUrl . "/my-profile/";
        $_SESSION['count'] = 0;
        $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
        $re->redirect($redirctUrl);
    }
    // END

?>
<!DOCTYPE html>
<html lang="en-US">
       

    <head>

        <?php include('../component/f_links.php');?>
         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">



<style type="text/css">
    


.rating-box {
  position:relative!important;
  vertical-align: middle!important;
  font-size: 18px;
  font-family: FontAwesome;
  display:inline-block!important;
  color: lighten(@grayLight, 25%);
  /*padding-bottom: 10px;*/
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
        //session_start();
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardpage">
                
                <div class="col-xs-12 col-sm-3 ">
                    <div class="leftsidebar left_freelance_top1">
                        <?php include('../component/left-freelancer-profile.php');?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding  ">
                     <div class="col-md-12 nopadding dashboard-section" style="margin-top: 24px;">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
                              <li>Find Freelancer</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="category_tabs">
                        <div class="row">
                            <div class="resp-tabs-container" style="border-top: 0px;">
                                <div class="col-md-12 nopadding">
                         <?php
                                   if($_GET['cat'] == 'ALL'){
                                     
                                       //$result = $f->freelancers($_SESSION['uid']);

                                       $result = $f->get_all_category_freelancers($_SESSION['uid']);

                                   }else{
                                    $result = $f->get_category_freelancers($_SESSION['uid'],$_GET['cat']);
                                   }
                                    

                                  //  echo("<pre>");

                                   //print_r($_SESSION['uid']);

                                    //echo $f->ta->sql;
                                    if($result){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        /*    echo("<pre>");
                                            print_r($row);
*/
                                            $fi = new _spfreelancer_profile;
                                            $result_fi = $fi->read($row['idspProfiles']);

                                            $row_fi = mysqli_fetch_assoc($result_fi);

                                            // while($row_fi = mysqli_fetch_assoc($result_fi)){

                                           /* echo("<pre>");
                                            print_r($row_fi);*/


                                            $skills = $row_fi['skill'];
                                            $perhour = $row_fi['hourlyrate'];

                                            $skill = explode(',', $skills);
                                             //print_r($skill);
                                              

                                              /* if($skill != ''){
                                                         $skill = explode(',', $skills);
                                                            
                                                    }*/
                   

                                            /*}*/

                                           // echo $fi->ta->sql;
                                           /* if($result_fi){
                                                $ProjectName = '';
                                                $perhour = '';
                                                $skill = '';*/

                                  /*        while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                    $pro = new _projecttype;
                                                    $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                    echo $pro->ta->sql;
                                                    if($ProjectName == ''){
                                                        if($result_pro){
                                                            $row_pr = mysqli_fetch_assoc($result_pro);
                                                            $ProjectName = $row_pr['project_title'];
                                                        }
                                                    }

                                                    if($perhour == ''){
                                                        if($row_fi['spProfileFieldName'] == 'hourlyrate_'){
                                                            $perhour = $row_fi['spProfileFieldValue'];
                                                        }
                                                    }

                                                    if($skill == ''){
                                                        if($row_fi['spProfileFieldName'] == 'skill_'){
                                                            $skill = explode(',', $row_fi['spProfileFieldValue']);
                                                            
                                                        }
                                                    }
                                                }
*/
                                                // SHOW COUNTRY NAME
                                                
                                       /*         $cntry = new _country;
                                                $result2 = $cntry->readCountryName($row['spProfilesCountry']);
                                                if ($result2) {
                                                    $country = mysqli_fetch_assoc($result2);
                                                    $country_name = $country['country_title'];
                                                }else{
                                                    $country_name = "Any";
                                                }*/
                                                ?>
                                                
                                                    <div class="category-engineer">
                                                        <div class="category-engineer-content">
                                                            <div class="engineer-avatar">
                                                                <?php
                    if(isset($row['spProfilePic']) && !empty($row['spProfilePic'])){
                    echo "<img  alt='Posting Pic' class='img-responsive center-block bradius-10' src=' ".($row['spProfilePic'])."' >" ;
                     }else{
                     echo "<img  alt='Posting Pic' class='img-responsive center-block bradius-10' src='../assets/images/blank-img/default-profile.png' >" ;
                                                                }
                                                                ?>
                                                                <h3 class="engineer-name freelancer_capitalize" style="word-break: break-word;"><?php echo $row['spProfileName'];?></h3>
                                                               <!--  <p class="engineer-designation freelancer_capitalize"><?php echo ($ProjectName != '')?$ProjectName:'&nbsp;';?></p> -->
                                                            </div>
                                                            <div class="col-xs-12 engineer-details">
                                                                  <?php if(!empty($perhour)){  ?>
                                                                <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span>
                    <span class="red pull-right">$<?php echo $perhour;?>/hr</span></div>
                                                                  <?php } ?>

                                                                <!--   <?php if(!empty($country_name)){  ?>
                                                                <div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $country_name;?></span></div>
                                                                  <?php } ?> -->
                                                               
                                                               <?php if(!empty($skill)){  

                                                                     // print_r($skills);


                                                               	?>


                                                             <div class="col-xs-12 specialities">

                                                             	

                                                            <!--  	<?php echo "<span class='freelancer_uppercase'>".$skills."</span>"; ?> -->
                                                                    <?php
                                                                    $i = 1;
                                                                    
                                                                        foreach($skill as $key => $value){

                                                                            if($i <= 5){
                                                                                if ($value != '') {
                                                                                    echo "<span class='freelancer_uppercase'>".$value."</span>";
                                                                                }                                                                            
                                                                            }
                                                                            $i++;
                                                                        }
                                                                   
                                                                    ?> 
                                                                </div>
                                                             <?php } ?>

                                                               

                                                 <?php
                       
                            
                         $mr = new _freelance_recomndation;

                         $resultsum1 = $mr->readfreelancerating($row['idspProfiles']);

                         // echo $mr->ta->sql;
                             
                           $totalreviewrate1 = 0;

                          if($resultsum1 != false){

                         

                         $totalmyreviews1 = $resultsum1->num_rows;

                       //echo"here";  
                     //  echo $totalreviews;

                                   
                           while($rowreview1 = mysqli_fetch_assoc($resultsum1)){

                          //  print_r($rowreview1);

                                            $sumrevrating1 += $rowreview1['recomnd_rating'];

                                             $rateingarr1[] =  $rowreview1['recomnd_rating'];

                                        }  

                                      $count1 = count($rateingarr1);

                                      $reviewaveragerate1 = $sumrevrating1 / $count1;

                                      $totalreviewrate1  = round($reviewaveragerate1, 1);

                                      /*echo $totalreviewrate1;
*/
                                }      


                        ?>




                        <p class="rating_box">
                          
                             <div class="rating-box">
                                      <?php if($totalreviewrate1 >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalreviewrate1 > "4" && $totalreviewrate1 < "5") { 
                                        echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalreviewrate1 >= "4") { 
                                        echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalreviewrate1 > "3" && $totalreviewrate1 < "4") { 
                                        echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalreviewrate1 >= "3") { 
                                        echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalreviewrate1 > "2" && $totalreviewrate1 < "3") { 
                                        echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalreviewrate1 >= "2") { 
                                        echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalreviewrate1 > "1" && $totalreviewrate1 < "2") { 
                                        echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalreviewrate1 >= "1") { 
                                        echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalreviewrate1 <= "0" ) { 
                                        echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                        ?>

                                    </div>
                            
                        </p>

                      



















                                                                <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['idspProfiles'];?>" class="btn engineer-view-profile viewprofile">View Profile</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                <?php
                                           /* }*/
                                        }
                                    }else{

                                    	echo"<h3 class='text-center'>No freelancer available for this category</h3>";
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>  
           <!--  <div class="col-xs-12 category_tabs"> -->
                
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