<?php
include('../univ/baseurl.php');
include('../univ/main.php');
session_start();
$dbConn = mysqli_connect(DOMAIN, UNAME, PASS,DBNAME);



if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "my-groups/";
include_once ("../authentication/check.php");

}else{

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

    $pr = new _spprofiles;  
    $result  = $pr->read($_SESSION["pid"]);
    if ($result != false){
        $sprows = mysqli_fetch_assoc($result);
        $profileCity = $sprows["spProfilesCity"];   
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<?php include('../component/f_links.php');?>
<link href="<?php echo $BaseUrl;?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo $BaseUrl;?>/assets/plugins/select2/dist/js/select2.min.js"></script>
<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
<script>
function execute(settings) {
$('#sidebar').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($){
if (top === self) {
execute({
top: 20,
bottom: 50
});
}
});
function execute_right(settings) {
$('#sidebar_right').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($){
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});

</script>
<!--This script for sticky left and right sidebar END-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<style>

.main_grop_box h6 {
color: #000;
text-align: center;
font-size: 14px;
font-family: MarksimonLight;
text-transform: uppercase;
margin: 20px 0 -5px;
}

.list-wrapper {
padding: 15px;
overflow: hidden;
}

.list-wrapper2 {
padding: 15px;
overflow: hidden;
}

.list-item {
border: 1px solid #EEE;
background: #FFF;
margin-bottom: 10px;
padding: 10px;
box-shadow: 0px 0px 10px 0px #EEE;
display: contents;
}

.list-item h4 {
color: #FF7182;
font-size: 18px;
margin: 0 0 5px;    
}

.list-item p {
margin: 0;
}

.list-item2 {
border: 1px solid #EEE;
background: #FFF;
margin-bottom: 10px;
padding: 10px;
box-shadow: 0px 0px 10px 0px #EEE;
display: contents;
}

.list-item2 h4 {
color: #FF7182;
font-size: 18px;
margin: 0 0 5px;    
}

.list-item2 p {
margin: 0;
}

.simple-pagination ul {
margin: 0 0 20px;
padding: 0;
list-style: none;
text-align: center;
}

.simple-pagination li {
display: inline-block;
margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
color: #666;
padding: 5px 10px;
text-decoration: none;
border: 1px solid #3e2048;
background-color: #3e2048;
box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
color: #FFF;

}

.heading07 h2 span, .heading08 h2 span {
color: #6a7e3b;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {

}


@media screen and (min-width: 650px) {

.main_grop_box h2 {

margin: -19px 0 10px;
}

}

.groupBtnSearch {
color: #fff!important;
background-color: #1c4994;
/* margin-right: 133px!important; */
}

.btn {
display: inline-block;
padding: 6px 12px;
margin-bottom: 0;
font-size: 14px;
font-weight: normal;
line-height: 1.42857143;
text-align: center;
white-space: nowrap;
vertical-align: middle;
-ms-touch-action: manipulation;
touch-action: manipulation;
cursor: pointer;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
background-image: none;
border: 1px solid transparent;
border-radius: 4px;
}


</style>

</head>
<body onload="pageOnload('admin')" class="bg_gray" >
<?php

include_once("../header.php");
$p = new _spprofiles;
$rp = $p->readProfiles($_SESSION['uid']);
?>

<section class="landing_page">
<div class="container">

<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-landing.php');?>


	
	




</div>
<div class="col-md-10">

<div class="row">

<input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="">
<!-- <div class="col-md-12 m_top_10">
    <div class="topstatus timeline-topstatus">

    <div class="createbox">
        <span><label><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/create_post_icon_enable.png" alt="" class="img-responsive" > <strong>Create Group</strong></label></span>
    </div>
</div>
</div> -->
<!-- <div class="col-md-12">
<div class="commentprofile timeline_comm_box">
    <div class="main_grop_timeline">
        <div class="row">
            <div class="col-md-3">
                <img src="<?php echo $BaseUrl;?>/assets/images/icon/group-main.png" alt="" class="img-responsive" />
            </div>
            <div class="col-md-8">
                <h2>Create Group</h2>
                <h3>The SharePage</h3>
                <div class="pull-right">
                    <label ><a href="<?php echo $BaseUrl;?>/my-groups/create-group.php" class="btn btnPosting db_btn db_primarybtn">
                    Create Group</a></label>
                </div>
            </div>
        </div>
    </div>
</div>
</div> -->
<!-- <div class="pull-right" style="margin-top: 12px;">
                    <label ><a href="<?php echo $BaseUrl;?>/my-groups/create-group.php" class="btn btnPosting db_btn db_primarybtn">
                    Create Group</a></label>
                </div> -->
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="heading01 text-center" id="ip6" style="background-color: white;">


                        <div class="left_head_top" style="margin-left: 130px;">

                            <form class="inner_top_form" method="POST" action="<?php echo $BaseUrl;?>/my-groups/search-group.php">

                                <div class="form-group" style="margin-bottom: -8px!important;">
                                    <select class="form-control cate_drop" name="txtCategory">
                                     <option value="all" >All</option><?php 
       //new title

                                     $g_cat = new _spgroup;


                                     $search_title = $g_cat->read_title();


          //$search_title_row = mysqli_fetch_assoc($search_title);
                //$stitle  =  $search_title_row['txtCategory'];

       /// $sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ";
 //       $result=mysqli_query($dbConn,$sql);
//
                                     while($rows = mysqli_fetch_assoc($search_title)) {  
                                            //  print_r($rows); 
                                                //die('----------------');

                                        ?>

                                        <option value='<?php echo $rows["group_category_name"]; ?>' 
                                            <?php echo (isset($_POST['txtCategory']) && $_POST['txtCategory'] ==$rows["group_category_name"])?'selected':''; ?>>
                                            <?php echo $rows["group_category_name"];?>
                                        </option>
                                    <?php } ?> 
                                </select>
                            </div>
							
                            <div class="form-group">
                                <input type="text" class="form-control searchbox" aria-describedby="basic-addon1" name="txtSearch" value="<?php if(isset($_POST['txtSearch'])){ echo $_POST['txtSearch'];  }?>" placeholder="Search by group title">
                            </div>
                            <button class="btn groupBtnSearch" type="submit" name="btnSearch"><i class="fa fa-search"></i>  Search</button>
							
							<div class="pull-right" style="margin-top: 6px;margin-left: 15px;">
                        <label ><a href="<?php echo $BaseUrl;?>/my-groups/create-group.php" class="btn btnPosting db_btn db_primarybtn">
                        Create Group</a></label>
                    </div>
							
                            <!-- <input type="submit" class="btn" value="Advance Search" name="btnSearch" > -->
                        </form>

                    </div>
                </div>
				
				<?php
				if($_GET['msg'] == "update" ){ ?>
					<div class="alert alert-success " style="margin-top:20px; margin-bottom:-20px;"role="alert">
Successfully Updated!
</div>

<script>
	  window.setTimeout(function () { 
	  $(".alert-success").alert('close'); 
      }, 4000);
	</script>
				<?php	}
				
					if(isset($_POST['saveint'])){
					$intr = new _groupsponsor;
					$intr->removeINT($_SESSION['uid'],$_SESSION['pid']);
					
					$chk="";  
foreach($_POST['intrest'] as $chk1)  
   {
      $chk = $chk1;  
	  $data = array(
	  "intrest_id	"=> $chk,
	  "user_id	"=> $_SESSION['uid'],
	  "profile_id	"=> $_SESSION['pid']
	  );
	  $intr->createInt($data);
	 
   }
   }
   
$intr1= new _groupsponsor;
   $interest = $intr1->readInterest($_SESSION['uid'],$_SESSION['pid']);
$interest_usr = array();
   if($interest){
	   
	   while($myfetch = mysqli_fetch_assoc($interest)){
	   
array_push($interest_usr,$myfetch['intrest_id']);
		   }
	   
	   }
	  // print_r($interest_usr);


//$marks = array(100, 65, 70, 87);

  
?>

 <br> <br>
 <div class="row" style="    background-color: white;    border-radius: 26px;margin-left: 5px;">

<h3>&nbsp;&nbsp;&nbsp;&nbsp; Update Your Group Intrest

<a class="btn btn-primary pull-right" style="margin-right: 10px;" href="index.php">Back</a>

 </h3>
 
<form method="POST" action="?msg=update">
    
	<div class="row" style="padding:20px">
	
	 <input type="checkbox" style="margin-left:18px;" name="select-all" id="select-all" /> Select / Deselect All<br><br>
     <?php
	$obj33= new _groupconversation;
	$result33=$obj33->readPost22();
	while($row3=mysqli_fetch_assoc($result33)){
	$intrestid =	$row3['id'];
	?>
	<div class="col-md-4">
  <input type="checkbox" style="margin:3px;" id="intrest<?php echo $intrestid; ?>" name="intrest[]" value=<?php echo $intrestid; ?>
  <?php 
    if (in_array($intrestid, $interest_usr))
  {
    echo "checked";
  }
  ?>
  <label for="intrest<?php echo $intrestid; ?>"><?php echo $row3['group_category_name']; ?> </label><br>
</div>
	<?php
	}
?>
</div>
<button type="submit" style="margin:20px ;background-color: #3e2048;" class="btn btn-primary" name="saveint">Save</button>

</form>

 
 
 </div>
 
 
            

    <div class="modal fade" id="interestupdModal" tabindex="-1" role="dialog" aria-labelledby="interestupdModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="exampleModalLabel1">Update Your Interests </h4>
</div>
<form id="updinterestForm" method="POST">
<div class="modal-body">
<div class="form-group">
<label for="category" class="lbl_7">Category
<span class="red">* <span class="spUserCountry erormsg"></span></span>
</label>
<input type="hidden" value="0" id="edit_id" name="edit_id"> 
<select id="upd_category" class="form-control" name="upd_category">
<option value="">Select Category</option>
<?php
$cat = "SELECT * FROM `group_category` WHERE `status` = 0 ORDER BY `group_category_name` asc";
$result=mysqli_query($dbConn,$cat);
while($rows = mysqli_fetch_array($result)) {
       
?>
<option value='<?php echo $rows['id']; ?>'><?php echo $rows['group_category_name']; ?></option>

 <?php } ?>
 
 
 
 
 
 
</select>

</div>
</div>
<div class="modal-footer">
<!-- <button type="button" class="btn btn-default" data-dismiss="myodal">Close</button> -->
<button type="button" id="upd_int" name="upd_int" class="btn btn-primary">Update</button>
</div>
</form>

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
} ?>

<script type="text/javascript">
$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
 </script>

<script type="text/javascript">
$('#channelSubmit').click(function(){
var cat = $('#category').val();

$.ajax({
url: "add_interest.php",
type: "POST",
data: {
cat: cat

},
success: function (response) {
if(response = '1')
{
window.location = 'index.php';
}
else
{
// alert('something went wrong')
}


},

});
});

function editRecord(id)
{
    $('#interestupdModal').modal('show');
    $('#upd_int').click(function(){
    $('#edit_id').val(id);
    var cat_id = $('#upd_category').val();
    // $('#upd_category').val(cat_id);

    $.ajax({
    url: "upd_interest.php",
    type: "POST",
    data: {
    cat_id: cat_id,
    id: id
    },

    success: function (response) {
    if(response = '1')
    {
    window.location = 'index.php';
    }
    else
    {
    // alert('something went wrong')
    }


    },

});
});
}
// $('#upd_int').click(function(){
// var upd_cat = $('#upd_category').val();
// var id = $('#id').val();

// $.ajax({
// url: "upd_interest.php",
// type: "POST",
// data: {
// upd_cat: upd_cat,
// id: id

// },
// success: function (response) {
// if(response = '1')
// {
// window.location = 'index.php';
// }
// else
// {
// // alert('something went wrong')
// }


// },

// });
// });
</script>
<script type="text/javascript">
$('#addmemontimeline').click(function(){
var gid = $('#grpid').val();
var pid = $('#pid').val();
var gname = $('#gname').val();
$.ajax({
url: "join_group.php",
type: "POST",
data: {
gid: gid,
pid: pid,
gname: gname
},
success: function (response) {
if(response = '1')
{
// var link = document.getElementById('link').value;

window.location = 'index.php';
}
else
{
alert('something went wrong')
}

// $('#bottom_reaction').html(response);
},

});
});
</script>
<script>

// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 6;

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

<script>
  $(".default-select2").select2();
  $(".multiple-select2").select2({ placeholder: "Select a category" });
  
  
       
    

  
</script>