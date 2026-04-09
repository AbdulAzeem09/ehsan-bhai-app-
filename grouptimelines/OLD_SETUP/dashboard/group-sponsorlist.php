<?php 
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
   
    $_GET["categoryID"] = "10";
    $_GET["categoryName"] = "GroupEvents";

    //$header_event = "events";
    $activePage = 5;

      if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/grouptimelines");
    }

?>

<!DOCTYPE html>
<html lang="en-US">

    <head>
        <?php include('../../component/links.php');?>
          <script src="<?php echo $BaseUrl;?>/assets/js/home.js"></script>

        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!-- <script src="<?php echo $BaseUrl;?>/assets/js/home.js"></script> -->
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

          <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
          <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

          <style type="text/css">
              .sponsorPic{
                display: block!important;
              }

          </style>
    </head>

    <body class="bg_gray" >
         
        <?php include_once("../../header.php");?>
         <script type="text/javascript">
            $(function() {
            $('#spsponsorPrice').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });
           
        
            $('#spsponsorPrice1').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });
           
        });
        </script>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Sponsor List</h3>
                    </div>
                </div>
            </div>
        </section>
     
        
        <section class="m_top_15">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_event_menu whiteevent" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
                        <div class="form-group" >

                            <?php 
                            $sponsor = 1;
                            include('top-button-dashboard.php'); 
                            ?>
                        </div>
                        <div class="row">
                            <!--Add album size-->
                           
                            <div class="modal fade" id="sponsorAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                          <div class="loadbox" >
                           <div class="loader"></div>
                          </div>
                         
                                <div class="modal-dialog" role="document">
                          

                                    <div class="modal-content sharestorepos no-radius bradius-15">
                                        <form action="createsponsor.php" method="post" id="sp-create-album" class="no-margin" enctype="multipart/form-data">
                                            <div class="modal-header  bg-white br_radius_top">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor4</b></h4>
                                            </div>
                                            <div class="modal-body">
                                                
                                            
                                                <input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                                <div class="row">
                                                  



                                                 
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sponsorTitle">Company<span style="color:red;">*</span></label>
                                                             <span id="sponsorTitle_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="sponsorTitle" name="sponsorTitle" value=""  onkeyup="keyupsponsorfun()" />
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sponsorWebsite">Company Website<span style="color:red;">*</span></label>
                                                              <span id="sponsorWebsite_error" style="color:red; margin-bottom: 0px;font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="sponsorWebsite" name="sponsorWebsite" value="" onkeyup="keyupsponsorfun()" />
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="spsponsorPrice">Price<span style="color:red;">*</span></label>
                                                             <span id="spsponsorPrice_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="spsponsorPrice" name="spsponsorPrice" placeholder="$" maxlength="8" onkeyup="keyupsponsorfun()"/>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label for="sponsorCategory">Category<span style="color:red;">*</span></label>
                                                        <span id="sponsorCategory_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                         <select class="form-control" name="sponsorCategory" id="sponsorCategory" onkeyup="keyupsponsorfun()">
                                                               <option value="">Select Category</option>
                                                                <option class="General">General</option>
                                                                <option class="Prime">Prime</option>
                                                                <option class="Platinum">Platinum</option>
                                                                <option class="Gold">Gold</option>
                                                                <option class="Silver">Silver</option>
                                                                <option class="Media">Media</option>
                                                            </select>
                                                             
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="sponsorDesc">Short Description<span style="color:red;">*</span></label>
                                                            <span id="spsponsorDesc_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <textarea class="form-control" name="sponsorDesc" id="spsponsorDesc" 
                                                            maxlength="500" onkeyup="keyupsponsorfun()"></textarea>
                                                             
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                <label for="spSponsorPic">Add Logo<span style="color:red;">*</span></label>
                                                                 
                                                             <input type="file" class="sponsorPic" name="sponsorImg" id="sponsorImg" onkeyup="keyupsponsorfun()">
                                                                   <span id="sponsorImg_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                                    <p class="help-block"><small>Browse files from your device</small></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9" style="padding-left: 130px;">
                                                                <div class="form-group">
                                                                    <label for="sponsorPreview">Logo Preview</label>


                                                                    <div id="sponsorPreview"></div>
                                                                    <div id="postingsponsorPreview">
                                                                        <div class="row">
                                                                            <div id="spPreview">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            
                                            </div>
                                            <div class="modal-footer bg-white br_radius_bottom">
                                                <button type="button" class="btn btn-default db_btn db_orangebtn" data-dismiss="modal">Close</button>
                                                <button id="addSponser" type="submit" class="btn btn-primary db_btn db_primarybtn">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Done-->
                            
                            <div class="col-md-12">
                                <div class="box groupbox-danger">
                                    <div class="box-body">
                                        
                                        <div class="table-responsive bg_white">
                                            <table class="table table-striped groupeventTable" id="sponMod">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Title</th>
                                                        <th>Website</th>
                                                        <th>Category</th>
                                                        <th>Profile</th>
                                                        <th>Price</th>
                                                        <th>Logo</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                   
                                                    $sp  = new _groupsponsor;
                                                    $p = new _spprofiles;

                                                    $result = $sp->readAll($_SESSION['pid']);
                                                    //$res = $p->draftEvent($_GET['categoryID']);
                                                    //echo $sp->ta->sql;
                                                    $i = 1;
                                                    if($result){
                                                        while ($row = mysqli_fetch_assoc($result)) { 
                                                           
                                                            ?>
                                                            <tr>

                                                               <!--  <?php print_r($row['idspSponsor']);?> --> 

                                                                <td><?php echo $i; ?></td>
                                                                <td class="eventcapitalize"><?php echo $row['sponsorTitle'];?></td>
                                                                <td><a href="<?php echo $row['sponsorWebsite']?>" target="_blank" ><?php echo $row['sponsorWebsite'];?></a></td>
                                                                <td><?php echo $row['sponsorCategory'];?></td>
                                                                <td class="eventcapitalize"><?php 
                                                                    
                                                                    $result2 = $p->readUserId($row['spProfile_idspProfile']);
                                                                    //echo $p->ta->sql;
                                                                    if($result2){
                                                                        $row2 = mysqli_fetch_assoc($result2);

                                                                       // print_r($row2);
                                                                        echo "<a href='javascript:void(0)' >".$row2['spProfileName']."</a>";                                                                
                                                                    }
                                                                ?></td>
                                                                <td><?php echo ($row['spsponsorPrice'] > 0)?'$'.$row['spsponsorPrice']:'';?></td>
                                                                <td>
                                                                    <?php

                                                                    //print_r($row['sponsorImg']); 
                                                                    if(isset($row['sponsorImg'])){

                                                                        echo '<img src="'.($row['sponsorImg']).'" class="img-responsive" alt="" style="height: 50px;width: 50px;">';

                                                                       /* echo '<img src="'.$row['sponsorImg'].'" class="img-responsive" alt="" style="height: 50px;width: 50px;">';*/
                                                                    }else{
                                                                        echo '<img src="../assets/images/blank-img/no-store.png" class="img-responsive" alt="" style="height: 50px;width: 50px;">';
                                                                    }
                                                                   
                                                                    ?>
                                                                    
                                                                </td>
                                                                <td><a class='sendSponsorEdit' href='javascript:void(0)' data-toggle='modal' data-target='#sponsorEdit<?php echo $row['idspSponsor'];  ?>' data-sponsor="<?php echo $row['idspSponsor'];?>"><i class="fa fa-edit"></i></a>
                                                                    
                                                                <a href="javascript:void(0)" data-postid="<?php echo $row['idspSponsor']; ?>" class="delsponsor" ><i class="fa fa-trash"></i></a></td>
                                                            </tr> <?php
                                                            $i++;
                                                          

                                                             ?>

                                                               <!--Edit album size-->
        <div class="modal fade" id="sponsorEdit<?php echo $row['idspSponsor'];  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="loadbox">
             <div class="loader"></div>
             </div>
            <div class="modal-dialog" role="document">
                <div class="modal-content sharestorepos bradius-15">

        <!-- <?php print_r([$row['idspSponsor']]); ?>
-->
    <form action="createsponsor.php" method="post" id="sp-create-album" enctype="multipart/form-data">

                         <div class="modal-header  bg-white br_radius_top">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel"><b>Edit Sponsor</b></h4>
                        </div>
                        <div class="modal-body">
                       
                   
                                            
            <input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">



                                             <?php               
                                                   // print_r($row3['idspSponsor']);

                                                    $SponsorId  = $row['idspSponsor'];

                                                   // print_r($SponsorId);

                                                    $res = $sp->readSponsor($SponsorId);

                                                    // $sp  = new _sponsorpic;
                                                  

                                                    if($res){
                                                     while ($row1 = mysqli_fetch_assoc($res)) {

                                                     // $row1 = mysqli_fetch_assoc($res);

                                                      // print_r($row1['sponsorTitle']);
                                                        /* print_r($row1['sponsorImg']);*/

                                                        //print_r($row1);


                                                     ?>
                                            
                   <input type="hidden" name="idspSponsor" value="<?php echo $row1['idspSponsor'];?>">

                                                <div class="row">
                    
                                                    <div class="col-md-6">
                                              
                                                        <div class="form-group">
                                                             
                                                            <label for="sponsorTitle">Company<span style="color:red;">*</span></label>
                                                            <span id="sponsorTitle_error1" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                            <input type="text" class="form-control"
                                                             id="sponsorTitle1" name="sponsorTitle" value="<?php echo $row1['sponsorTitle'];?>"  onkeyup="keyupsponsorfun1()"/>
                                                            

                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sponsorWebsite">Company Website<span style="color:red;">*</span></label>
                                                            <span id="sponsorWebsite_error1" style="color:red; margin-bottom: 0px;font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="sponsorWebsite1" name="sponsorWebsite" value="<?php echo $row1['sponsorWebsite'];?>"  onkeyup="keyupsponsorfun1()" />
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="spsponsorPrice">Price<span style="color:red;">*</span></label>
                                                             <span id="spsponsorPrice_error1" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="spsponsorPrice1" name="spsponsorPrice" maxlength="8" value="<?php echo $row1['spsponsorPrice'];?>" onkeyup="keyupsponsorfun1()" />
                                                           

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                         <label for="sponsorCategory">Category<span style="color:red;">*</span></label>
                                                          <span id="sponsorCategory_error1" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <select class="form-control" id="sponsorCategory1" name="sponsorCategory" value="<?php echo $row1['sponsorCategory'];?>"  onkeyup="keyupsponsorfun1()">
                                                            <option value="">Select Category</option>

                                                             <option class="General" value="General"  <?php if ( $row1['sponsorCategory'] == "General" ) { echo "selected"; } ?>>
                                                              General</option>
                                                                <option class="Prime" value="Prime"<?php if ( $row1['sponsorCategory'] == "Prime" ) { echo "selected"; } ?> >Prime</option>
                                                                <option class="Platinum" value="Platinum"<?php if ( $row1['sponsorCategory'] == "Platinum" ) { echo "selected"; } ?>>Platinum</option>
                                                                <option class="Gold" value="Gold"<?php if ( $row1['sponsorCategory'] == "Gold" ) { echo "selected"; } ?>>Gold</option>
                                                                <option class="Silver" value="Silver"<?php if ( $row1['sponsorCategory'] == "Silver" ) { echo "selected"; } ?>>Silver</option>
                                                                <option class="Media" value="Media"<?php if ( $row1['sponsorCategory'] == "Media" ) { echo "selected"; } ?>>Media</option>
                                                            </select>
                                                           
                                                       

                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="sponsorDesc">Short Description<span style="color:red;">*</span></label> <span id="spsponsorDesc_error1" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                            <textarea class="form-control" id="spsponsorDesc1" name="sponsorDesc" value="<?php $row1['sponsorDesc'];  ?>" maxlength="500" onkeyup="keyupsponsorfun1()"><?php echo $row1['sponsorDesc'];  ?></textarea>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="spSponsorPic">Add Logo<span style="color:red;">*</span></label>

                            


    <input type="file" class="sponsorPic" id="sponsorImg1" name="sponsorImg">
<!--    <span id="sponsorImg_error1" style="color:red; "></span>
 -->    <p class="help-block"><small>Browse files from your device</small></p>


<?php if (!empty($row1['sponsorImg'])) { 

  echo '<img src="'.($row1['sponsorImg']).'" class="img-responsive" alt="" style="height: 50px;width: 50px;">';
     }else{?>

        <img src='../assets/images/blank-img/no-store.png' style="height: 50px;width: 50px;" />
   <?php }
 ?>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-9" style="padding-left: 130px">
                                                                <div class="form-group">
                                                                    <label for="sponsorPreview">Logo Preview</label>
                                                                    <div id="sponsorPreview"></div>
                                                                    <div id="postingsponsorPreview">
                                                                        <div class="row">
                                                                            <div id="spPreview" >
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </div>

                                            <?php }

                                        }?>
                                               
                                            
                                            </div>

                        <div class="modal-footer bg-white br_radius_bottom">
                            <button type="button" class="btn btn-default db_btn db_orangebtn" data-dismiss="modal">Close</button>
                            <button id="EditSponser" type="submit" class="btn btn-primary db_btn db_primarybtn spaddSponsor" >Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                                                        
                                                       <?php }
                                                    }else{ ?>
                                            
                        <td colspan="8"><center>No Record Found</center></td><?php }?>
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="space"></div>
         <?php 
       
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
<script type="text/javascript">
               
function keyupsponsorfun() {

  //alert();

        var company= $("#sponsorTitle").val()

        var Website = $("#sponsorWebsite").val()
        var Price = $("#spsponsorPrice").val()
        var category = $("#sponsorCategory").val()
        var Description = $("#spsponsorDesc").val()
        var sponsorImage = $("#sponsorImg").val()

//alert(category);
 //alert(category.length);

   if(company != "")
  {
    $('#sponsorTitle_error').text(" ");
    
  }
  if(Website != "")
  {
    $('#sponsorWebsite_error').text(" ");
 }
   if(Price != "" )
  {
    $('#spsponsorPrice_error').text(" ");
    
  }
 if(category.length != 0)
  {
    $('#sponsorCategory_error').text(" ");
  
  }
   if(Description != "")
  {
    $('#spsponsorDesc_error').text(" ");
  }
   if(sponsorImage != "")
  {
    $('#sponsorImg_error').text(" ");
  
  }
  
       
}

        </script>


  <script type="text/javascript">
               
function keyupsponsorfun1() {

  //alert();

        var company= $("#sponsorTitle1").val()

        var Website = $("#sponsorWebsite1").val()
        var Price = $("#spsponsorPrice1").val()
        var category = $("#sponsorCategory1").val()
        var Description = $("#spsponsorDesc1").val()
        //var sponsorImage = $("#sponsorImg1").val()

//alert(category);
 //alert(category.length);

   if(company != "")
  {
    $('#sponsorTitle_error1').text(" ");
    
  }
  if(Website != "")
  {
    $('#sponsorWebsite_error1').text(" ");
 }
   if(Price != "" )
  {
    $('#spsponsorPrice_error1').text(" ");
    
  }
 if(category.length != 0)
  {
    $('#sponsorCategory_error1').text(" ");
  
  }
   if(Description != "")
  {
    $('#spsponsorDesc_error1').text(" ");
  }
  /* if(sponsorImage != "")
  {
    $('#sponsorImg_error').text(" ");
  
  }*/
  
       
}

        </script>
    </body>
</html>
<?php
} ?>