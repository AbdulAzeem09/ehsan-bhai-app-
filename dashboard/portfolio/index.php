<?php

require_once("../../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 30;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
<style>
.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}

div:where(.swal2-container).swal2-center>.swal2-popup {
height: 297px;
font-size: 15px;

}

.leftDashboard {
background-color: #dda0dd;
height: 1000px;
}

</style>
</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
;
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<!--   <section class="content-header">
<h1>My Selling Product</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">My Selling Product</li>
</ol>
</section>-->

<div class="content">
<div class="row">
<div class="col-sm-12">
<div class="box box-success">
<div class="box-header">

</div><!-- /.box-header -->
<div class="box-body">
<div class="row text-center">
<h4><b>MY PORTFOLIO<b></h4>
</div>
<form enctype="multipart/form-data" id="formsubmit"  action="" method="post" >											
<div class="after-add-more">
<div class="row">
<div class="col-md-6">                                
<div class="form-group">
<label class="control-label">Title:</label>
<input  type="text" class="form-control" id="spPortname" placeholder="Enter Title" maxlength="60"   name="spPortname" required />
<span class="red"  id="sp1" ></span>
</div>
</div>
<div class="col-md-6"    style=" margin-top: 26px;" >
<span class="tagLine-max-char">Max 60 characters</span>
</div>
</div>
<div class="row">
<div class="col-md-6">                                
<div class="form-group">
<label class="control-label">Weblink:</label>
<input maxlength="200" type="text" class="form-control" id="spWeblink" placeholder="Enter Weblink" name="spWeblink" required />
<span class="red"  id="sp2"></span>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12" id="yourAddresRemove" >
<div class="form-group">
<label for="spProfileAbout" class="control-label">Portfolio Item Description:</label>
<textarea class="form-control" rows="3" id="spPortdes" name="spPortdes" id="spPortdes" required value="<?php echo (isset($spPortdes))?$spPortdes: ''; ?>" ><?php echo (isset($spPortdes))?$spPortdes: ''; ?>  </textarea>
<span class="red" id="sp3"></span>
</div>	
</div>
</div>
<br>
<div class="row">
<div class="col-sm-3">
<div class="form-group">
<label class="control-label">Upload File:</label>
<input type="file" class="form-control" required name="spPortimg[]"  accept=" image/* " style="display:block;" multiple  >
</div>
</div></div>

<h4><b>Add to my profile</b></h4>  
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" style="width: 100%;">
<thead>
<tr>
<th  class="text-center">Freelancer</th>
<th  class="text-center">Business</th>
<th  class="text-center">Personal</th>
<th  class="text-center">Professional</th>
<th  class="text-center">Employment</th>

<th class="text-center">Family</th>
</tr>
</thead>

<tbody>
<tr>
<td>
<div class="form-check">
<input class="form-check-input" type="checkbox" name="portFreelancer" value="1" id="portFreelancer">

</div>

</td>
<td>
<div class="form-check">
<input class="form-check-input" type="checkbox" name="portBussiness" value="1" id="portBussiness">

</div>

</td>
<td>
<div class="form-check">
<input class="form-check-input" type="checkbox" name="portPersonal" value="1" id="portPersonal">

</div>

</td> <td>
<div class="form-check">
<input class="form-check-input" type="checkbox"  name="portProfessional" value="1" id="portProfessional">

</div>

</td> <td>
<div class="form-check">
<input class="form-check-input" type="checkbox"   name="portEmployment" value="1" id="portEmployment">

</div>

</td> <td>
<div class="form-check">
<input class="form-check-input" type="checkbox"    name="portFamily" value="1" id="portFamily">

</div>

</td>
</tr>

</tbody>


</table>

<div class="row">
<div class="col-sm-12">
<?php if($_SESSION['guet_yes'] != 'yes'){ ?>

<input type="submit" class="btn btn-submit  addprofile db_btn db_primarybtn  btn-border-radius" name="submit" value="Submit">
<?php } ?>
</div>
</div>
<br>
</div>

</form> 

<script src="https:<?php echo $baseurl?>/assets/js/sweetalert.js.0.19/dist/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
    $("#formsubmit").submit(function(e) {
        var a = $("#spPortname").val();
        var b = $("#spWeblink").val();
        var c = $("#spPortdes").val();
        var fileInput = $("#fileInput")[0].files[0];
        
        // Check if any of the fields are empty
        if (a == "" || b == "" || c == "" || !fileInput) {
            if (a == "") {
                $("#sp1").text("Please Fill This Field");
            } else {
                $("#sp1").text("");
            }
            if (b == "") {
                $("#sp2").text("Please Fill This Field");
            } else {
                $("#sp2").text("");
            }
            if (c == "") {
                $("#sp3").text("Please Fill This Field");
            } else {
                $("#sp3").text("");
            }
            if (!fileInput) {
                $("#sp4").text("Please upload a file");
            } else {
                $("#sp4").text("");
            }
            e.preventDefault();
            return false;
        }

        // Check file extension
        var fileName = fileInput.name;
        var fileExtension = fileName.split('.').pop().toLowerCase();
        if (fileExtension !== 'jpg') {
            $("#sp4").text("Please upload a JPG file");
            e.preventDefault();
            return false;
        }

        Swal.fire({
            title: 'Data Posted Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok !'
        }).then((result) => {
            if (result.isConfirmed) {

            }
        });
    });

    $("#spPortname").change(function() {
        $("#sp1").text("");
    });
    $("#spWeblink").change(function() {
        $("#sp2").text("");
    });
    $("#spPortdes").change(function() {
        $("#sp3").text("");
    });
    $("#fileInput").change(function() {
        $("#sp4").text("");
    });
});
</script>


</div>
</div>


</div>
</div>

</div>


<?php
//echo "<pre>";
// print_r($_POST);   
include('../../helpers/image.php');
if(isset($_POST['submit'])){

    $spPortname = $_POST['spPortname'];
    $spPortdes = $_POST['spPortdes'];
    $spWeblink = $_POST['spWeblink'];
    $portFreelancer = isset($_POST['portFreelancer']) ? $_POST['portFreelancer'] : 0;
    $portBussiness = isset($_POST['portBussiness']) ? $_POST['portBussiness'] : 0;
    $portPersonal = isset($_POST['portPersonal']) ? $_POST['portPersonal'] : 0;
    $portProfessional = isset($_POST['portProfessional']) ? $_POST['portProfessional'] : 0;
    $portEmployment = isset($_POST['portEmployment']) ? $_POST['portEmployment'] : 0;
    $portFamily = isset($_POST['portFamily']) ? $_POST['portFamily'] : 0;

    $uidp = $_SESSION['uid'];
    $pidp = $_SESSION['pid'];

    $data = array(
        "spPid"=>$pidp, 
        "spTitle"=>$spPortname,
        "desPort"=>$spPortdes, 
        "spUid"=>$uidp,
        "spWeblink"=>$spWeblink,
        "portFreelancer"=>$portFreelancer,
        "portBussiness"=>$portBussiness,
        "portPersonal"=>$portPersonal,
        "portProfessional"=>$portProfessional,
        "portEmployment"=>$portEmployment,
        "portFamily"=>$portFamily,
    );

    $image = new Image();
    // Validate image files
    $image->validateFileImageExtensions($_FILES['spPortimg']);

    // Check if validation failed
    if ($imageValidationResult !== null) {
        // Handle validation failure, for example:
        //echo $imageValidationResult;
        echo "<script>alert('select proper image');</script>";

    } else {
        // Process form submission
        $pf = new _spPortfolio;
        $lastid = $pf->create($data);
        if(isset($_FILES['spPortimg'])){
            foreach($_FILES["spPortimg"]["tmp_name"] as $key=>$tmp_name) {        
                $filename = $_FILES["spPortimg"]["name"][$key];
                $tempname = $_FILES["spPortimg"]["tmp_name"][$key];
                $folder = "image/".$filename;

                if (move_uploaded_file($tempname, $folder)) {
                    $msg = "Image uploaded successfully";
                    $imgdata = array(
                        "portfolio_id"=>$lastid, 
                        "image"=>$filename
                    );
                    $pf->imageInsert($imgdata); 
                }
            }
        }
        
    }
}		
?>
								



<style>











.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}

/* .swal2-popup {

font-size: 2rem !important;
} */


</style>

<div class="content">
<div class="row">
<div class="col-sm-12">
<div class="box box-success">
<div class="box-header">

</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive" style="overflow-x:hidden;">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" style="width: 100%;" >
<thead>
<tr>
<th  class="text-center">Title</th>
<th  class="text-center">Title</th>
<th  class="text-center">Weblink</th>
<th  class="text-center">Description</th>


<th class="text-center">Action</th>
</tr>
</thead> 
<tbody>
<?php
$pf = new _spPortfolio;
// die("------------");
$result = $pf->readport($_SESSION['pid'],$_SESSION['uid']);


//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//echo "<pre>";
//print_r($row); die("--------------------------");
?><tr>
<td></td>

<td class="text-center "><span class="smalldot"><?php echo ucfirst($row['spTitle']); ?></span></td>
<td class="text-center "><span class="smalldot"><?php echo ucfirst($row['spWeblink']); ?></span></td>
<td   class="text-center "><span class="smalldot"><?php echo $row['desPort']; ?></span></td>
<!-- <td class="text-center">
<?php echo "<img src='/dashboard/portfolio/image/".$row['spImg']."' alt='image' width='40' height='40' />";?>

</td>-->
<td class="text-center">
<!--<a  class="update-portfolio" class="" data-id="<?php echo $row['id'];?>"  data-title="<?php echo $row['spTitle'];?>" 
data-weblink="<?php echo $row['spWeblink'];?>" data-des="<?php echo $row['desPort'];?>"   data-toggle="modal" data-target="#exampleModal">
<i class="fa fa-edit "></i>
</a>-->
<a  class="update-portfolio" href="<?php echo $BaseUrl.'/dashboard/portfolio/editPortfolio.php?id='.$row['id']; ?>" class="" data-id="<?php echo $row['id'];?>"  data-title="<?php echo $row['spTitle'];?>" 
data-weblink="<?php echo $row['spWeblink'];?>" data-des="<?php echo $row['desPort'];?>"   >
<i title="Edit" class="fa fa-pencil "></i>
</a>				
<!--<a href="<?php echo $BaseUrl.'//?active=1&postid='.$row['spPid']; ?>" class="" data-postid="<?php echo $row['spPid'];?>"><i class="fa fa-edit"></i></a> -->

&nbsp;&nbsp;
<!--<a href="<?php echo $BaseUrl.'/dashboard/portfolio/delete_port.php?work=delete&id='.$row['id']; ?>" class="disable-btn" data-work="delete" data-Id="<?php echo $row['id'];?>"><i style="color:red;" class="fa fa-trash disable-btn" ></i></a>-->
<span class="delete_rec">
<!--<a  class="disable-btn" data-work="delete" data-Id="<?php echo $row['id'];?>"><i style="color:red;" class="fa fa-trash disable-btn" ></i></a>
</span>-->

<span onclick="deletefun(<?php echo $row['id'];?>)"><i style="color:red;" title="Delete" class="fa fa-trash disable-btn" ></i></span>



</td> 


</td>

</tr>
<?php
// $i++
}
}
?>


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
</div>





</div>
</section>


<?php include('../../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>


<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>							

<script>
/*$(document).ready(function(){
$(".delete_rec").click(function(){
alert("The paragraph was clicked.");
swal({
title: "Do You Want Deactive this Account?",

type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactive!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
}),
function(isConfirm) {
if (isConfirm) {
window.location.href = 'deactivate_account.php';
} 
};



});
});*/



</script>

<script type="text/javascript">
function deletefun(id){ 

var work="delete";
//alert(Id);
//	var b = $('#id'+id).val();
//	var c = $('.dele').val();
var my_path1 = $("#my_path1").val();
//alert(my_path1);

Swal.fire({
title: 'Are You Sure You Want to Delete?',
text: "",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
type: "GET",
url: "delete_port.php",
data: {id:id,work:work}, 
success: function(response){

window.location.href ="<?php echo $BaseUrl; ?>/dashboard/portfolio/" ;



}

});
}
})  



}   



</script>


<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>








<script>
$(function() {
$(':checkbox').checkboxpicker();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
$("body").on("click",".add-more",function(){ 
var html = $(".after-add-more").first().clone();

//  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

$(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");


$(".after-add-more").last().after(html);



});

$("body").on("click",".remove",function(){ 
$(this).parents(".after-add-more").remove();
});
});

</script>
<script type="text/javascript">
$(document).ready(function(){
$(document).on("click",".disable-btn",function() {
var dataId = $(this).attr("data-Id");

var work = $(this).attr("data-work");
//alert(work);
if(work=='deactive'){
swal({
title: "Do You Want Deactive this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactive!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/dashboard/portfolio/delete_port.php?id=' +dataId+'&work='+work;
} 
});

}	
if(work=='delete'){
//alert('11');
swal({
title: "Do You Want Delete this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Delete!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/dashboard/portfolio/delete_port.php?id=' +dataId+'&work='+work;
} 
});
}	

// alert(dataId);
});
});

// function deactiveProp(propId){ 
//     swal({
//           title: "Do You Want Delete this User?",
//           /*text: "You Want to Logout!",*/
//           type: "warning",
//           confirmButtonClass: "sweet_ok",
//           confirmButtonText: "Yes, Delete!",
//           cancelButtonClass: "sweet_cancel",
//           cancelButtonText: "Cancel",
//           showCancelButton: true,
//         },
//     function(isConfirm) {
//       if (isConfirm) {
//        window.location.href = <?php //echo $BaseUrl.'/real-estate/dashboard/deactivate_post.php?postid='?> + propId;
//       } 
//     });
// }
</script>





<form enctype="multipart/form-data" action="deactivate_port.php" method ="post" >		
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h2 class="modal-title" id="UpdatePort">Update Portfolio</h2>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="after-add-more">
<div class="row">
<div class="col-md-12">                                
<div class="form-group">
<label class="control-label">Title:</label>
<input maxlength="200" type="text" class="form-control" placeholder="Enter Title" name="spPortname" id="spPortname" required/>
<input type="hidden" name="portfolio_id" id="portfolio_id" value="">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">                                
<div class="form-group">
<label class="control-label">Weblink:</label>
<input maxlength="200" type="text" class="form-control" placeholder="Enter Weblink" name="spWeblink"  id="spWeblink" required/>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12" id="yourAddresRemove" >
<div class="form-group">
<label for="spProfileAbout" class="control-label">Portfolio Item Description:</label>
<textarea class="form-control" rows="3" name="spPortdes" id="spPortdesf" required ></textarea>
</div>	
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Upload File:</label>
<input type="file" class="form-control" name="spPortimg" id="spPortimg"  accept=" image/* " style="display:block;" required />
</div>
</div></div>


<br>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: orange; color:white;">Close</button>
<input type="submit" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Update">
<!--<button type="button" class="btn btn-primary">Save changes</button>-->
</div>
</div>
</div>
</div>
</form>	



</body> 
</html>
<?php
} ?>



<script>
$( document ).ready(function() {
$(".update-portfolio").on("click", function (event) {

var id = $(this).attr('data-id');
var title = $(this).attr('data-title');
var des = $(this).attr('data-des');
var weblink = $(this).attr('data-weblink');

$("#spPortname").val(title);
$("#spPortdesf").val(des);
$("#portfolio_id").val(id);
$("#spWeblink").val(weblink);



});

});


</script>
