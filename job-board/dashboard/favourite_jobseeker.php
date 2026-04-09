    <?php

    include('../../univ/baseurl.php');
    session_start();

    if($_SESSION['ptid'] != 1){
    header('location:'.$BaseUrl.'/job-board/');
    }
    if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/"; 
    include_once ("../../authentication/check.php");

    }else{
    function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $f = new _spprofiles;

    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 44;
    $header_jobBoard = "header_jobBoard";



    if(isset($_POST['notes_submit'])){ 
        //echo $_POST['notes'];
       // print_r ($_POST['notes_submit']); die("qqqqqqqqqqqqqqqq");
    $notes = $_POST['notes'];
    $employer_id = $_POST['employer_id'];
    $seeker_id = $_POST['seeker_id'];
    $action = $_POST['action'];
    $notes_id =  $_POST['notes_id'];

    if($action=="insert"){

    $data = array(
    'employer_id'=>$employer_id,
    'jobseeker_id'=>$seeker_id,
    'notes'=>$notes
    );

    $data = $f->insert_notes($data);

    } 


    if($action=="update"){
    $data = array(
    'notes'=>$notes
    );


    $data = $f->update_notes($data, $notes_id);
    }

    }


    ?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>
    <!--<script src="<?php // echo $BaseUrl;?>/assets/js/home.js"></script> -->

    <?php include('../../component/f_links.php');?>
    <!--     <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/font_animate.css">
    <?php include('../../component/dashboard-link.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>



    <style type="text/css">

    .category_tabs .resp-tabs-container .category-engineer .category-engineer-content .engineer-details .specialities {
    margin-bottom: 10px;
    margin-top: 0px;
    padding: 0;
    height: 30px;
    overflow: hidden;
    }

    .nav > li > a:hover, .nav > li > a:focus {
    text-decoration: none;
    background-color: #31abe3; 
    }
    #profileDropDown li.active {
    background-color: #1f3060;
    }
    #profileDropDown li.active a {
    color: white;
    }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <body class="bg_gray">
    <?php
    include_once("../../header.php");
    ?>
    <section class="landing_page">
    <div class="container">
    <div class="row">
    <?php //include('../thisisjobboard.php'); ?> 
    <!-- <div class="col-md-3"> -->
    <div class="sidebar col-md-3 no-padding" id="sidebar" >
    <?php include('left-menu.php'); ?> 
    </div>
    <!-- </div> -->
    <div class="col-md-9">
    <div class="col-sm-12 nopadding dashboard-section whiteboardmain" style="margin-top: 7px;padding: 16px 0px 0px 0px;">
    <div class="col-xs-12 dashboardbreadcrum">
    <ul class="breadcrumb">
    <li><a href="<?php echo $BaseUrl;?>/job-board/dashboard">Dashboard</a></li>
    <!-- <li>Browse All Jobseekers</li> -->  
    <li>Favourite Resume</li>
    <span style=" display: unset;">
    <form method="get" action="" style="display: flex; margin-top: -7px; margin-right:-14px;" class="float-right">
    <input type="text" name="search" class="form-control" value="<?php if($_GET['search']){ echo $_GET['search'] ; } ?>">  
    <button style="border-radius: 3px;background-color: #0090ca !important;color: white;" name="btnAdresSearch" type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
    </span>
    <!-- <a href="https://thesharepage.com/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a> -->
    </ul>
    </div>
    </div>

    <div class="row category_tabs " id="jobseekrtab" style="margin-top: 108px;">
    <div class="resp-tabs-container" style="border-top: 0px;" >
    <div class="col-sm-12 nopadding">
    <?php

    $st = new _job_favorites;

    /*    if($_GET['cat'] == 'ALL'){

    $result = $f->profileTypePerson(5, $_SESSION['uid'],$limit,$offset);

    }else{

    $result = $f->profileTypePersonbycat(5, $_SESSION['uid'],$_GET['cat'],$limit,$offset);

    }*/


    if($_GET['search']){ 
    //die('1111111111');
    $name= $_GET['search'];
    $result = $st->myfavourite_job($_SESSION['pid'],$name);
    }
    else{

    $result = $st->myfavourite_job1($_SESSION['pid']);
    //print_r($result);die('222222');

    }

    //$result = $f->freelancers($_SESSION['uid']);
    /*echo $st->ta->sql;*/
    if($result){
    //print_r($result); 
    //die('==');
    while ($rows = mysqli_fetch_assoc($result)) {
    //print_r($rows); 

    $f = new _spprofiles;

    $result1 = $f->empTypePerson($rows['spPostings_idspPostings']);
    if($result1!=false){
    //die('=---=');
    $row = mysqli_fetch_assoc($result1);
    // print_r($row);die;
    // echo  $row['skill'];
 
    $skill = explode(',', $row['skill']);
    //print_r($skill);
 
    ?>

    <div class="list-wrapper">
    <div class="list-item">
    <div class="category-engineer">
    <div class="category-engineer-content">
    <div class="engineer-avatar">

    <?php
    //print_r ($skill);
    if(isset($row['spProfilePic'])){
        echo "<a href='".$BaseUrl."/job-board/user-profile.php?pid=".$row['idspProfiles']."'><img alt='Posting Pic' class='img-responsive center-block' src='".($row['spProfilePic'])."'></a>";

    }else{
    echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../../img/default-profile.png' >" ;
    }

    ?>
    <h3 class="engineer-name"><?php echo ucfirst($row['spProfileName']);?></h3>

    </div>
    <div class="col-xs-12 engineer-details">

    <label class="jobseek" style="float: right;margin-right: 3px;">              
    <?php

    /*print_r($_SESSION['uid']);

    print_r($_SESSION['pid']);*/
    $st = new _job_favorites;
    $res_ev = $st->chekFavourite($row['idspProfiles'], $_SESSION['pid'], $_SESSION['uid']);
    //$res_ev = $ev->read($_GET["postid"]);
    // echo $ev->ta->sql; 
    if($res_ev != false){     ?>

    <a href="javascript:void(0)" id="remtofavoritesjobseek" data-postid="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
    <!-- <span id="removetofavouriteeve"><i class="fa fa-heart"></i></span> -->
    <i class="fa fa-heart"></i></a>



    <?php



    }else{
    ?>
    <a href="javascript:void(0)"  id="addtofavouritejobseek" data-postid="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
    <!--    <span id="addtofavouriteeve" class="iconhover"><i class="fa fa-heart-o"></i></span> -->
    <i class="fa fa-heart-o"></i></a>



    <?php
    }
    ?>
    </label>


    <div class="col-xs-12 specialities">
    <?php
    $i = 1;

    //echo count($skill);

    if($row['skill'] != false){
    //echo("2222");
    foreach($skill as $key => $value){
    if($i <= 3){
    echo "<span>".$value."</span>";
    }
    $i++;
    }
    }else{
    echo "<span>No Skills Define</span>";
    }
    ?>





    </div>

    <?php

    $employer_id = ($_SESSION['uid']); 
    $seeker_id = $row['idspProfiles'];

    $data = $f->job_notes($employer_id, $seeker_id);


    ?>
    <a href="<?php echo $BaseUrl.'/job-board/user-profile.php?pid='.$row['idspProfiles'];?>" class="btn jobboard-view-profile">View Profile</a>

    <?php 
    if($data->num_rows == "1"){
    $row_notes = mysqli_fetch_assoc($data);
    $notes = $row_notes['notes'] ;
    $notes_id = $row_notes['id'] ;
    ?>
    <button type="button" style=" background-image: -webkit-linear-gradient(90deg,#ebae85 0,#f60 100%);" data-employer_id="<?php echo $employer_id; ?>" data-seeker_id="<?php echo $seeker_id; ?>" data-notes="<?php echo $notes; ?>" data-action="update"  data-notes_id="<?php echo $notes_id; ?>" onclick="myFunction()" class="btn jobboard-view-profile notes_action" data-toggle="modal" data-target="#myModal" >Notes</button>
    <?php }
    else {?>
    <button type="button" data-employer_id="<?php echo $employer_id; ?>" data-seeker_id="<?php echo $seeker_id; ?>" data-notes="<?php echo ""; ?>" data-action="insert"  data-notes_id="<?php echo ""; ?>" onclick="myFunction()" class="btn jobboard-view-profile notes_action" data-toggle="modal" data-target="#myModal">Notes</button>
    <?php   } ?>


    </div>
    </div>
    </div>
    </div>
    </div>
    <?php
}
    }
    }else{

    echo "<h4 style='text-align:center;'>No Resume found!</h4>";
    }
    ?>
    <div id="pagination-container"></div>
    </div>


    </div>

    </div>



    </div>
    </div>
    </div>
    </section>

<!-- <script type="text/javascript">
    
    
    function myFunction(){
        alert('ddddd');

    var  employer_id = $(this).data("employer_id");
    var seeker_id = $(this).data("seeker_id");
    var notes = $(this).data("notes");
    var action = $(this).data("action");
    var  notes_id = $(this).data("notes_id");

    $(".modal-body #employer_id").val( employer_id );
    $(".modal-body #seeker_id").val( seeker_id );
    $(".modal-body #notes").val( notes );
    $(".modal-body #action").val( action );
    $(".modal-body #notes_id").val( notes_id );

    }
</script> -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Employee Notes</h4>
    </div>
    <div class="modal-body">

    <form method="post" action="">

    <textarea type="text" name="notes" class="form-control" id="notes" rows="6"></textarea>

    <input type="hidden" id="employer_id" name="employer_id">
    <input type="hidden" id="seeker_id" name="seeker_id">
    <input type="hidden" id="action" name="action">
    <input type="hidden" id="notes_id" name="notes_id">



    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" name="notes_submit">Save</button>
    </form>

    </div>
    </div>

    </div>
    </div>
    <!-- <button type="button" data-employer_id="<?php echo $employer_id; ?>" data-seeker_id="<?php echo $seeker_id; ?>" data-notes="<?php echo $notes; ?>" data-action="update"  data-notes_id="<?php echo $notes_id; ?>"  class="btn jobboard-view-profile notes_action" data-toggle="modal" data-target="#myModal" >Notes</button> -->

    <script>

    $( document ).ready(function() {
    $('.notes_action').click(function(){
    //alert('hello');
    employer_id = $(this).data("employer_id");
    seeker_id = $(this).data("seeker_id");
    notes = $(this).data("notes");
    action = $(this).data("action");
    notes_id = $(this).data("notes_id");
    $(".modal-body #employer_id").val( employer_id );
    $(".modal-body #seeker_id").val( seeker_id );
    $(".modal-body #notes").val( notes );
    $(".modal-body #action").val( action );
    $(".modal-body #notes_id").val( notes_id );
    });
    });



    </script>


    <?php 

    include('../../component/f_footer.php');
    include('../../component/f_btm_script.php'); 
    //die('-==---==');
    ?>
    </body>
    </html>
    <?php
    } ?>

    <script type="text/javascript">
    var MAINURL = "https://dev.thesharepage.com";
    $(".jobseek").on("click", "#addtofavouritejobseek",function () {


    var postid = $(this).data('postid');

    //alert(postid);


    var pid = $(this).data('pid');

    var btnfavorites = this;

    //alert(pid);

    $.post(MAINURL+"/social/addfavorites.php", {postid: postid, pid: pid}, function (response) {
    //$("#addtofavouriteeve").html("<i class='fa fa-heart' aria-hidden='true'></span>");
    $(btnfavorites).replaceWith('<a href="javascript:void(0)" id="remtofavoritesjobseek" data-postid="'+postid+'" data-pid="'+pid+'"><i class="fa fa-heart"></i></a>');
    //window.location.reload();
    });
    });


    $(".jobseek").on("click","#remtofavoritesjobseek", function () {
    var postid = $(this).data('postid');
    var pid = $(this).data('pid');

    // alert(pid);
    var btnremovefavorites = this;

    $.post(MAINURL+"/social/deletefavorites.php", {postid: postid}, function (response) {
    //$("#removetofavouriteeve").html("<i class='fa fa-heart-o' aria-hidden='true'></span>");
    //window.location.reload();
    $(btnremovefavorites).replaceWith('<a href="javascript:void(0)" id="addtofavouritejobseek" data-postid="'+postid+'" data-pid="'+pid+'"><i class="fa fa-heart-o"></i></a>');
    });
    });
    var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 8;

    items.slice(perPage).hide();

    $('#pagination-container').pagination({
    items: numItems,
    itemsOnPage: perPage,
    prevText: "&laquo;",
    nextText: "&raquo;",
    onPageClick: function (pageNumber) {
    var showFrom = perPage * (pageNumber - 1);
    var showTo = showFrom + perPage;
    items.hide().slice(showFrom, showTo).show();
    }
    });



    </script>
