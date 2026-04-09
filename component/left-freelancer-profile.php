<style>
.left_freelance_top .dropdown button {width:120%;font-size: 13px;padding: 6px 6px;}
</style>
    <div class="left_freelance_top">
        <!-- <h2 class="nameheading"><a href="<?php echo $BaseUrl;?>/freelancer">Freelancer</a></h2> -->
        <!-- <p>&nbsp;</p> -->
        <?php
        $p = new _spprofiles;
        if($_SESSION['ptid'] == 1 OR $_SESSION['ptid'] == 2){ ?>
    <div class="row no-margin">


        <div class="left_freelance_menu">
           
           <li class="Back_to_freelancer"><button style="background-color: #f78d47;border-color: #f78d47;" class="btn btn-primary"><a href="<?php echo $BaseUrl.'/freelancer/'; ?> " style="color: white!important;">

            <i class="fa fa-arrow-left"></i> Home </a></li></button>
        </div>
                 <div class="col-md-4" style="padding-top:20px">
                    <?php
                    $result = $p->read($_SESSION['pid']);
                    if ($result != false) {
                        $row = mysqli_fetch_assoc($result);
                        if (isset($row["spProfilePic"])){
                            echo "<img alt='profilepic' class='img-responsive1 propic center-block' src=' " . ($row["spProfilePic"]) . "'  >";
                        }else{
                            echo "<img alt='profilepic' class='img-responsive1 img-circle propic center-block' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                        }
                    }
                    ?>
                </div>  
                <div class="col-md-8" style="padding-top:20px">
                    <div class="dropdown">
                        <button style="margin-left: -12px;" class="btn btn-primary dropdown-toggle freelancer_capitalize sidedropdown" type="button" data-toggle="dropdown"><?php echo $_SESSION['MyProfileName']; ?>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu sp-profile-det">
                            <?php
                                
                                $rpvt = $p->readProfiles($_SESSION["uid"]);
                                //echo $p->ta->sql;
                                if ($rpvt != false){
                                    while($row = mysqli_fetch_assoc($rpvt)) {
                                        if($row['spProfileType_idspProfileType'] == 1 || $row['spProfileType_idspProfileType'] == 2){
                                            ?>
                                            <li>
    <a id='makedefaultprofile' class='freelancer_capitalize' data-profileid='<?php echo $row['idspProfiles'];?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' >

                    <?php if (isset($row["spProfilePic"]) && !empty($row["spProfilePic"]))
                     {
                    echo "<img alt='Posting Pic' class='img-responsive' src=' ".($row["spProfilePic"])."'>"; 
                        }else{
                        echo "<img alt='Posting Pic' class='img-responsive' src='../assets/images/blank-img/default-profile.png' >";
                     }
                     ?>

                    <?php echo $row['spProfileName'];?> 
                    <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>


                 </a>

                
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                            
                        </ul>
                    </div>
                </div>
                <?php       
                          $rpvt = $p->readprofile_type($_SESSION["pid"]);

                          //print_r($rpvt)
                                if ($rpvt != false){
                                    while($row = mysqli_fetch_assoc($rpvt)) {

    if($row['spProfileType_idspProfileType'] == 2){?>

    <br><span class="freelancer_profile">(<?php echo $row['spProfileTypeName']." Profile";?>)</span>

             <?php } ?>
              <?php  if($row['spProfileType_idspProfileType'] == 1){?>

    <br><span class="freelancer_profile">(<?php echo $row['spProfileTypeName']." Profile";?>)</span>                                
                                        <?php }
                                    }
                                }
                            ?> 

            </div>
             
            <?php            
        }else{ 
            $re = new _redirect;
            $result2 = $p->readBusFreeProfiles($_SESSION['uid']);
            if($result2){
                $row2 = mysqli_fetch_assoc($result2);
                $LeftProName = $row2['spProfileName'];
                $LeftProId = $row2['idspProfiles'];

            }else{

                $redirctUrl = $BaseUrl . "/freelancer/";
                $_SESSION['count'] = 0;
                $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
                $re->redirect($redirctUrl);
                
            }
            ?>
<!--             <div class="row no-margin">
                <div class="col-md-4 no-padding">
                    <?php
                    $result3 = $p->read($LeftProId);
                    if ($result3 != false) {
                        $row3 = mysqli_fetch_assoc($result3);
                        if (isset($row3["spProfilePic"])){
                            echo "<img alt='profilepic' class='img-responsive propic center-block' src=' " . ($row3["spProfilePic"]) . "'  >";
                        }else{
                            echo "<img alt='profilepic' class='img-responsive propic center-block' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                        }
                    } ?>
                </div>
                <div class="col-md-8">
                    <div class="dropdown" style="background-color: #3e3e3e!important;">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: #3e3e3e!important;"><?php echo $LeftProName; ?>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu sp-profile-det">
                            <?php
                               
                                $rpvt = $p->readProfiles($_SESSION["uid"]);
                                //echo $p->ta->sql;
                                if ($rpvt != false){
                                    while($row = mysqli_fetch_assoc($rpvt)) {
                                        if($row['spProfileType_idspProfileType'] == 1 || $row['spProfileType_idspProfileType'] == 2){
                                            ?>
                                            <li>
                                                <a id='makedefaultprofile' data-profileid='<?php echo $row['idspProfiles'];?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' >
                                                    <img src="<?php echo ($row["spProfilePic"]);?>" class="img-responsive"> <?php echo $row['spProfileName'];?> <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                            
                        </ul>
                    </div>
                </div>
              <?php       
                          $rpvt = $p->readprofile_type($_SESSION["pid"]);

                          //print_r($rpvt)
                          if ($rpvt != false){
                                    while($row = mysqli_fetch_assoc($rpvt)) {

    if($row['spProfileType_idspProfileType'] == 2){?>

    <br><span class="freelancer_profile">(<?php echo $row['spProfileTypeName']." Profile";?>)</span>

             <?php } ?>
              <?php  if($row['spProfileType_idspProfileType'] == 1){?>

    <br><span class="freelancer_profile">(<?php echo $row['spProfileTypeName']." Profile";?>)</span>                                
                                        <?php }
                                    }
                                }
                            ?> 

            </div>
 -->
            <?php
            
        }

      
        ?>
        
<h2 class="skill-category" style="margin-top: 20px!important;">Skill Categories</h2>

<h1 class="" style="font-size: 20px;
    font-family: Marksimon!important; <?php if (isset($_POST['cat'])) {
     echo "border: 1px solid #a1a1a1;
    background-color: #fff;
    border-left: 4px solid #ff6802;
    padding: 4px 1px 3px 5px;";
    } ?>">

  <!--   <a href="#0" class="button" data-toggle="modal" data-target="#myfeed" style="color: black; " >My Feed</a> -->
   <!--  <a href="#0" class="button"  style="color: black; " >My Feed</a> -->
    </h1>

<form action="projects.php" method="POST">
  

<div class="modal fade" id="myfeed" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content modalwidth">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="font-size: 25px;">My Feed</h4>
        </div>

<!-- <form method="post" action="projects.php"> -->
        <div class="modal-body">

          <ul class="nav skill-category-list">

  <!-- <li id="li_checkbox1"> -->

     <?php
            $catId = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;
            $m = new _subcategory;

            $catid = 5;
            $result = $m->read($catid);
            $row = mysqli_fetch_assoc($result);


           if($result){
                while ($row = mysqli_fetch_assoc($result)) { 

                   // $p = new _postingview;

                  /*   $f = new _spprofiles;

                    $res =   $f->freelancers($_SESSION['uid']);
                    echo $f->ta->sql;
*/
                    if($res){
                        $totalProject = $res->num_rows;
                    }else{
                        $totalProject = 0;
                    }
                    
                    ?>


<!-- <a href="<?php echo $BaseUrl.'/freelancer/projects.php?cat='.$row['idsubCategory'];?>"
                     class="<?php  if(isset($_GET['cat'])){ echo ($_GET['cat'] == $row['idsubCategory'])? 'active': '';}
                     ?>" > -->

  <label for="checkbox<?php echo $row['subCategoryTitle']; ?>" id="checkbox1_label" class="control-label checkboxtab">
  <input type="checkbox" class="" id="checkbox<?php echo $row['subCategoryTitle']; ?>" name="cat[]" value="<?php echo ($row['subCategoryTitle']);?>" style="position: unset!important;opacity: unset!important;cursor: pointer!important;height: unset!important;width: unset!important;"> 

    <?php echo ($row['subCategoryTitle']);?>(<?php echo $totalProject;?>)</label>

             <!--  </a> -->

       <!--</li> -->
           
                    <?php
                }
            }
            ?>
        </ul>

          
        </div>
        <div class="modal-footer">

          <button type="submit" id="" style="background-color: #ff9900!important;" class="btn btn-primary btn-modalsubmit">Submit</button>


     <!--      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>

        </form>
      </div>
    </div>
  </div>

</form>



<ul class="nav skill-category-list">


<?php  $s = new _subcategory;

    $sf  = new _freelancerposting;

   $idresult = $s->showall_id(5);
                        
   while($row4 = mysqli_fetch_assoc($idresult)){

                            $catidall[]=$row4['idsubCategory'];

                           }
                            $commaseprated_id = "'" . implode ( "', '", $catidall) . "'";

                            $result1 = $m->showall_Nameall($commaseprated_id);

                           // echo $m->ta->sql;

                        
                      if ($result1) {

                        while($row5 = mysqli_fetch_assoc($result1))
                             {
                                    
                               $subCategoryTitle[] =$row5['subCategoryTitle'];

                               // $array=$subCategoryTitle;     
                                }
                      

                              if (($key = array_search("Admin", $subCategoryTitle)) !== false) {
                                    unset($subCategoryTitle[$key]);
                                    }

                               // print_r($subCategoryTitle);               
                              

                $subCategoryTitle_name = "'" . implode ( "', '", $subCategoryTitle) . "'";

                   // print_r($subCategoryTitle_name);

               $res = $sf->total_post_freelancer_name1($subCategoryTitle_name);


                               //echo $p->ta->sql;
   $f = new _spprofiles;

                    $res =  $f->get_all_category_freelancers($_SESSION['uid']);
                   /* echo $f->ta->sql;
*/
/* $st= new _spuser;
									$st1=$st->readdatabybuyerid($_SESSION['uid']);
									if($st1!=false){
									$stt=mysqli_fetch_assoc($st1);
									$account_status=$stt['deactivate_status'];
									}*/
                    //print_r($res);
                
                   if($res){
                        $allProject = $res->num_rows;
                    }else{
                        $allProject = 0;
                    }   

                    ?>  

        <li>
     <a href="<?php echo $BaseUrl.'/freelancer/freelancer.php?cat=ALL';?>" 

     class="<?php if($catId){ echo ($catId == 'ALL')? 'active': '';}  ?>" title="">All <span class="red">(<?php echo $allProject;?>)</span></a>

        </li>          
              
         <?php   }

       
         ?>
  









  <?php
          $m = new _subcategory;
          $catid = 5;
          $result = $m->read($catid);

         //   $row = mysqli_fetch_assoc($result);

          

           if($result){
                while ($row = mysqli_fetch_assoc($result)) { 
				//print_r($row);

                   $f = new _spprofiles;

                    $res =   $f->freelancers($_SESSION['uid']);
                   
/*while ($row1 = mysqli_fetch_assoc($result)) {


  print_r($row1);
                        // $res1 = $sf->getType($row['subCategoryTitle']);
                 


}*/
                  //echo $p->ta->sql;
$sf = new _spfreelancer_profile;

$res1 = $f->get_category_freelancers($_SESSION['uid'],$row['idsubCategory']);
//echo $f->ta->sql;
                    if($res1){
                        $totalProject = $res1->num_rows;
                    }else{
                        $totalProject = 0;
                    }
                    
                    ?>

             

                  <li>
                    <a href="<?php echo $BaseUrl.'/freelancer/freelancer.php?cat='.$row['idsubCategory'];?>"
                     class="<?php  if($catId){ echo ($catId == $row['idsubCategory'])? 'active': '';}
                     ?>" >

                     <?php echo ucfirst(strtolower($row['subCategoryTitle']));?>
                      <span class="red">(<?php echo $totalProject;?>)</span>
                     </a>

                  </li>
                    
                    <?php
                }
            }
            ?>

   
          
        </ul>
    </div>
