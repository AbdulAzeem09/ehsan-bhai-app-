<?php
    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "business-directory/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

   $header_directy = "header_directy";
   $activePage = 1;
   $page = "dashboardPage";
?>


<?php 
if(isset($_POST['submit_module'])){

    $prof = new _spprofiles;
                                

if($_POST['job']=="1"){

    $data = array("pid"=>$_SESSION['pid'],
                  "uid"=>$_SESSION['uid'],
                  "module_name"=>"Job",
                  "status"=> 1 );

   $prof->business_tabs($data);

}   


}


?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <!-- owl carousel -->
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
        
        <script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
        <!--NOTIFICATION-->
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
        <!-- this script for slider art -->
        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    autoPlay: true,
                    responsiveClass: true,
                    responsive: {
                      0: {
                        items: 1,
                        nav: false
                      },
                      600: {
                        items: 3,
                        nav: false
                      },
                      1000: {
                        items: 4,
                        nav: false
                      }
                    }
                });
            });    
        </script>
    </head>

    <body class="bg_gray">
         <?php
        include_once("../header.php"); 
        ?>
        <!-- Modal -->
        <!--Adding new Resume modal-->
        <div class="modal fade jobseeker" id="addnews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="resumeheadr">Add News</h3>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo $BaseUrl.'/business-directory/addnews.php';?>" method="post" class="">                            
                            <input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'];?>">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><h4>Title</h4></label>
                                <input type="text" class="form-control no-radius" id="cmpanynewsTitle" name="cmpanynewsTitle" />
                            </div>
                            <div class="row">
                                <?php 
                                $prof = new _spprofiles;
                                $result2 = $prof->chekProfileIsBusiness($_SESSION['uid']);
                                //echo $prof->ta->sql;
                                if($result2){
                                    while ($row2 = mysqli_fetch_assoc($result2)) {?>
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="<?php echo $row2['idspProfiles'];?>" name="profileCheck[]" <?php echo ($_SESSION['pid'] == $row2['idspProfiles'])?'checked':''; ?> ><?php echo $row2['spProfileName'];?></label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }

                                ?>
                                
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><h4>Description</h4></label>
                                <textarea class="form-control no-radius" name="cmpanynewsDesc"></textarea>
                            </div>
                            <div class="modal-footer" class="uploadupdate">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--READALL NEWS-->
        <div class="modal fade jobseeker" id="ReadNews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="resumeheadr">Update News</h3>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo $BaseUrl.'/business-directory/updatenews.php';?>" method="post" class="">                            
                            <div id="updateNews"></div>
                            <div class="modal-footer" class="uploadupdate">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		
        <section>
            <div class="row no-margin">
               <!-- <div class="col-md-3 no-padding">
                    <?php 
                    //include('../component/left-business.php');
                    ?>
                </div>-->
                <div class="col-md-12 no-padding">
                    <div class="head_right_enter">
                        <div class="row no-margin">
                            <?php
                            include('top-head-inner.php');
                            ?>
                            <div class="col-md-12 no-padding">
                                <div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
                                    <!--PopularArt-->
                                    <div role="tabpanel" class="tab-pane active serviceDashboard" id="video1">
                                        <?php include('search-form.php');?>
                                        <?php include('top-dashboard.php');?>
                                        <div class="bg_white" style="padding: 20px;">
                                            
                                            <div class="row" >
                                                <!--<div class="col-md-12 m_btm_15 ">
                                                    <?php
                                                    //echo $_SESSION['ptid'];
                                                    if (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 1) {
                                                        ?>
                                                        <a  href="#" class="btn btn_bus_dircty pull-right" data-toggle="modal" data-target="#addnews" id="addnews" style=" background-color:#e39b0f;"><span class="glyphicon glyphicon-plus"></span> Add News</a>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                   
                                                </div>-->
                                                <form action ="" method="post">
                                                <div class="col-md-12">
												
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered  tabDirc dashServ">
                                                            <thead class="">
                                                                <tr>
                                                                    <th>Module</th>
                                                                    <th>Mode</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                                <tr>
                                                                    <td>Job</td>
                                                                    <td><input type="checkbox" name="job" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Videos</td>
                                                                    <td><input type="checkbox" name="video" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Store</td>
                                                                    <td><input type="checkbox" name="store" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Real Estate</td>
                                                                    <td><input type="checkbox" name="real_estate" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Rental</td>
                                                                    <td><input type="checkbox" name="rental" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Freelancer</td>
                                                                    <td><input type="checkbox" name="freelancer" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Events</td>
                                                                    <td><input type="checkbox" name="event" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Art and Craft</td>
                                                                    <td><input type="checkbox" name="art_craft" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Classified Ad</td>
                                                                    <td><input type="checkbox" name="classified" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>My Business Space</td>
                                                                    <td><input type="checkbox" name="bussiness_space" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Business For Sale</td>
                                                                    <td><input type="checkbox" name="business_sale" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Trainings</td>
                                                                    <td><input type="checkbox" name="training" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>News</td>
                                                                    <td><input type="checkbox" name="new" value="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Contact</td>
                                                                    <td><input type="checkbox" name="contact" value="1"></td>
                                                                </tr>
                                                                
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
													
													
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="pull-right btn btn-warning" type="submit" name="submit_module">submit</button>
                                                </div>
                                            </form>
                                            </div>


                                        </div>

                                        
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="space-lg"></div>

        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        <!-- notification js -->
        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
	</body>
</html>
<?php
} ?>
