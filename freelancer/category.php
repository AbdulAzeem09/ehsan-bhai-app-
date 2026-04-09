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
    
    if(isset($_GET['pro']) && $_GET['pro'] >0){

    }else{
        $redirctUrl = $BaseUrl.'/freelancer';
        $re = new _redirect;
        $re->redirect($redirctUrl);
        //header('location:'.$BaseUrl.'/freelancer');
    }
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
        
                
        
    </head>

    <body class="bg_gray">
    	<?php
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="col-xs-12 category_selected_banner text-center">
                <h1 class="category_name">
                    Choose among the top freelancers
                </h1>
                
                <?php
                $f = new _spprofiles;
                $result2 = $f->chekProfileIsBusiness($_SESSION['uid']);
                if($result2){ ?>
                    <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?post';?>" class="btn get-started categorypostbtn">Post a project - It’s Free</a> <?php
                }else{ ?>
                    <!-- Modal -->
                    <div id="Notabussiness" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content no-radius">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                                </div>
                                <div class="modal-body nobusinessProfile">
                                    <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                                    <h2>You have no business profile. If you want to <span>post job</span> then make your own business profile. </h2>
                                    <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Creat Business Profile</a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <a href="javascript(0)" class="btn get-started"  data-toggle="modal" data-target="#Notabussiness" >Post a project - It’s Free</a> <?php
                } ?>
                
            </div>
            <div class="col-xs-12 category_tabs">
                <div class="container">
                    <div id="row">
                        <div class="col-xs-3">
                            <div class="heading_page">
                                <h2>Category</h2>
                            </div>
                            <div class="left_Freelance_category">
                                <ul>
                                    <?php
                                        $m = new _subcategory;
                                        $catid = 5;
                                        $result = $m->read($catid);
                                        if($result){
                                            while($rows = mysqli_fetch_assoc($result)){?>
                                                <li><a href="<?php echo $BaseUrl.'/freelancer/category.php?pro='.$rows['idsubCategory']; ?>" class="<?php echo ($rows['idsubCategory'] == $_GET['pro'])?'active':''; ?>"><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></a></li>
                                                <?php
                                            }
                                        }
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="heading_page">
                                <?php
                                $m = new _subcategory;
                                $result = $m->showName($_GET['pro']);
                                if($result){
                                    $row = mysqli_fetch_assoc($result);
                                    echo "<h2>".$row['subCategoryTitle']."</h2>";
                                }
                                ?>
                               
                            </div>

                            <div class="category_tabs">
                                <div class="resp-tabs-container">
                                    <?php
                                        $f = new _spprofiles;
                                        $catid = $_GET['pro'];
										
                                        $result = $f->get_category_freelancers($_SESSION['uid'], $catid);
                                        //echo $f->ta->sql;
                                        if($result){
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $fi = new _profilefield;
                                                $result_fi = $fi->read($row['idspProfiles']);
												
												//print_r($row);die;
                                                //echo $fi->ta->sql;
                                                if($result_fi){
                                                    $ProjectName = '';
                                                    $perhour = '';
                                                    $skill = '';
                                                    while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                        $pro = new _projecttype;
                                                        $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                        //echo $pro->ta->sql;
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
                                                    ?>
                                                    
                                                        <div class="category-engineer" id="cat_freelance">
                                                            <div class="category-engineer-content">
                                                                <div class="engineer-avatar">

 <?php
                    if(isset($row['spProfilePic']) && !empty($row['spProfilePic'])){
                    echo "<img  alt='Posting Pic' class='img-responsive center-block bradius-10' src=' ".($row['spProfilePic'])."' >" ;
                     }else{
                     echo "<img  alt='Posting Pic' class='img-responsive center-block bradius-10' src='../assets/images/blank-img/default-profile.png' >" ;
                                                                }
                                                                ?> 



                                       <!--  <?php
                                                 if(isset($row['spProfilePic'])){
             echo "<img alt='Posting Pic' class='img-responsive center-block bradius-10' src=' ".($row['spProfilePic'])."' >" ;
                                                                    }else{
                echo "<img  alt='Posting Pic' class='img-responsive center-block bradius-10' 
                src='../assets/images/blank-img/default-profile.png' >" ;


                                                                    }
                                                                    ?> -->

                                                                    <h3 class="engineer-name"><?php echo ucwords(strtolower($row['spProfileName']));?></h3>
                                                                    <p class="engineer-designation"><?php echo $ProjectName;?></p>
                                                                </div>
															<?php	$profileid=$row['idspProfiles'];
	//echo $profileid; die;
	$spobj= new _spprofiles;

$result_read=$spobj->read_cure($profileid);

if($result_read)
{
$userid='';
	$row_urecord= mysqli_fetch_assoc($result_read);
	 
	$userid=$row_urecord['spUser_idspUser'];
	 
	 
}

//userid


                 $spu= new _spuser;
				 $result_user=$spu->read($userid);
				 if($result_user){
					 $currancys='';
					 $row_user= mysqli_fetch_assoc($result_user);
					 
					 $currancys=$row_user['currency'];
					 //echo $currancys;die;
					 
				 }
				 ?>
                                                                <div class="col-xs-12 engineer-details">
                                                                    <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span>
                                    <span class="red pull-right"><?php echo $currancys.' '.$perhour;?>/hr</span></div>
                                                                    <div class="col-xs-12 nopadding">
                                                                        <span class="black pull-left">Location</span>

                                                             <span class="red pull-right">
                                                                       <?php 
                                                                            $co = new _country;
                                                                            $result3 = $co->readCountryName($row['spProfilesCountry']);
                                                             if($result3 != false){
                                                            $row3 = mysqli_fetch_assoc($result3);
                                                            echo $row3['country_title'];
                                                                            }else{
                                                              echo "Any";
                                                          }
                                                                            //echo $row['spProfilesCountry'];
                                                                            ?>
                                                                        
                                                                        </span>
                                                                    </div>
                           <!--  <div class="col-xs-12 specialities">
                                    <?php
                                                                        $i = 1;
                                                                        if($skill != ''){
                                                                            foreach($skill as $key => $value){
                                                                                if($i <= 5){
                                                                                    echo "<span>".$value."</span>";
                                                                                }
                                                                                $i++;
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
 -->

                             <div class="col-xs-12 specialities">
                                                                    <?php
                                                                    $i = 1;
                                                                    if($skill != ''){
                                                                        foreach($skill as $key => $value){

                                                                            if($i <= 5){
                                                                                if ($value != '') {
                                                                                    echo "<span class='freelancer_uppercase'>".$value."</span>";
                                                                                }                                                                            
                                                                            }
                                                                            $i++;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>


<a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['idspProfiles'];?>" class="btn engineer-view-profile  btn-border-radius">View Profile</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <?php include('btm-category.php'); ?>
        </section>



    	<?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
} ?>