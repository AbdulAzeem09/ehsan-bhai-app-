<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />


</head>

<style type="text/css">

.ui-autocomplete{

width: 20%!important;
background-color: rgb(255, 255, 255)!important;
border: 1px solid black!important;
}



</style>
<div class="modal fade" id="myshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius bradius-15 bg-white">
<form action="../social/share-timeline.php" method="POST" class="sharestorepos">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title">Share Post</h4>

</div>

<div class="modal-body sharedimage">
<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
<input type="hidden" id="shareposting" name="spPostings_idspPostings">
<input type="hidden" id="spCategories_idspCategory" name="spCategories_idspCategory" value="1">

<div class="row">
<div class="col-md-6">
<div class="dropdown">
<label>Choose Source</label>
<span id="shareError1" style="color:red;"></span>
<button class="btn btn-default dropdown-toggle" type="button" id="dropdownShare" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
Select group or friend
<span class="caret"></span>
</button>
<ul class="dropdown-menu" aria-labelledby="dropdownShare">
<li id="groupshare" class="sppointer sharedd"><a href="#">Share with a group</a></li>

<li id="friendshare" class="sppointer sharedd"><a href="#">Share with a friend</a>
</li>
</ul>
</div>

</div>
<!-- <div class="col-md-12" id="groupshow">
<div class="form-group">
<label>Select Group</label>
<input type="hidden" class="form-control" id="spgroupshareid" name="spShareToGroup">
<input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
</div>
</div> -->

<div class="col-md-6 group-select-block hidden" id="groupshow">
<div class="form-group">
<label>Select Group</label> <span id="shareError2" style="color:red;">*</span>
<select class="select3 form-control" name="spShareToGroup[]" id="groupSelect" multiple >
<option value=""></option>
</select>
</div>
</div>

<!-- <div class="col-md-5 hidden" id="profileshow">
<div class="form-group">
<input type="hidden" id="spfriendshareid" name="spShareToWhom">
<input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
</div>
</div> -->
<div class="col-md-6 friend-select-block hidden" id="profileshow">
<div class="form-group">
<label>Select Friend</label> <span id="shareError3" style="color:red;">*</span>
<select class="select2 form-control" name="spShareToWhom[]" id="friendSelect" multiple >
<option value=""></option>
</select>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Say something about this</label> <span id="shareError" style=""></span>
<input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...">
</div>
</div>

</div>

<div class="row">
<div class="col-md-offset-3 col-md-6">

<ul class="row hide-bullets">



<?php 
$postId = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
$pc = new _productpic;
$res = $pc->read($postId);
//echo $pc->ta->sql;
$active1 = 0; 
if ($res != false) { 
$active2 = 0; 
// while($postr = mysqli_fetch_assoc($res)){
$postr = mysqli_fetch_assoc($res);
//print_r($postr);
$picture = $postr['spPostingPic']; 
if($active2 == 0){
$pic = $picture;

}

?>

<img id="modalpostingpic" src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-rounded img-thumbnail" />
<li class="col-sm-2 padding_5 thumb_box">
<!-- <a class="thumbnail" id="carousel-selector-<?php echo $active2;?>">
<?php
if(isset($picture)){ ?>
    <img src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-responsive" > <?php
}else{ ?>
    <img src="../img/no.png" alt="Posting Pic" class="img-responsive" > <?php
}
?>
</a>
</li> --> <?php
$active2++;
// }
}else{?>
<img src="../img/no.png" alt="Posting Pic" class="img-responsive" style="margin: 0 auto;" ><?php
}
?>

</ul> 



</div>
</div>


<div class="row">

<div class=" col-md-2"></div>
<div class="col-md-8">

<?php



$p = new _productposting;
$rd = $p->read($postId);
$price = 0;
$currency = "USD";
if ($rd != false) {
$row = mysqli_fetch_assoc($rd);

$price      = $row['retailSpecDiscount']; 
$desc       = $row['description'];

$currency = $row['default_currency'];

}



?>
<style>
.table tbody tr td{
border: none;
}
</style>

<table class="table table-borderless" style="">

<tbody>
<tr>
<td style="border: 0px;width: 43%;"><label>Product Name</label></td>
<td> : </td>
<td style="border: 0px;text-align: left;"><?php echo $PostTitle; ?></td>
</tr>
<tr>
<td style="border: 0px;width: 43%;"><label>Price</label></td>
<td> : </td>
<td style="border: 0px;text-align: left;"><?php echo $currency.' '.$price; ?></td>
</tr>
<tr>
<td style="border: 0px;width: 55%;"><label>Product Description</label></td>
<td> : </td>
<td style="border: 0px;text-align: left;"><?php if($Itemdescription){echo $Itemdescription; } else{ echo "Not Defined";}?></td>
</tr>
<!-- <tr>
<td style="border: 0px;width: 50%;"><label>Product Description:</label></td>
<td style="border: 0px;text-align: left;"><?php echo $desc; ?></td>
</tr> -->
</tbody>
</table>


</div>

<div class=" col-md-2"></div>
</div>

</div>
<div class="modal-footer br_radius_bottom bg-white">
<button type="" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" id="share"  class="btn btn-primary db_btn db_primarybtn btn-border-radius">Share</button>
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript">


$("#share").click(function() {

var dropdownShare = $("#dropdownShare").text();
var aboutshare = $("#aboutshare").val();
var groupSelect = $("#groupSelect :selected").text();
var friendSelect = $("#friendSelect :selected").text();

if (dropdownShare == "Select group or friend") {
$("#shareError1").html("This field is required");
return false;
} else if (dropdownShare == "Share with a group ") {
$("#shareError1").html("");
if (groupSelect == "") {
$("#shareError2").html("This field is required");
return false;
} else {
$("#shareError2").html("");
}
} else {
$("#shareError1").html("");
if (friendSelect == "") {
$("#shareError3").html("This field is required");
return false;
} else {
$("#shareError3").html("");
}
}

/* if (aboutshare == "") {
$("#shareError").html("This field is required4");
return false;
} else {
$("#shareError").html("");
}*/
}); 







//     $("#share").click(function() {


//          var spgroupshareid =  $("#spgroupshareid").val();
//           var spfriendshareid =  $("#spfriendshareid").val();
//           var spfriendname =  $("#spfriendname").val();
//            var spgroupname =  $("#spgroupname").val();



//         if(spfriendshareid == "" && spgroupshareid == ""){

//               $("#errshrtype").text("Please Select share type");
//              /* $("#errfrd").text("Please Select friend from list");*/

//           }else if(spfriendname == "" && spgroupname == "" ){
//            /* alert(spfriendname);*/
//             $("#errshrtype").text("");
//               $("#errfrd").text("Please Select friend from list ");

//           }else if(spfriendshareid == "" && spgroupshareid == ""){
//               $("#errshrtype").text("");
//               $("#errfrd").text("Please Select friend from list");

//           }else{

//               $("#sharestorepos").submit()


//           }

//    /*   alert();*/
//    /* $("#sharestorepos").submit(); */  
// });



</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" ></script>
<script type="text/javascript">
$(".select2").select2();
$(".select3").select2();

$('#friendSelect').select2({
placeholder: "Select Friends",
multiple: true,
width:'100%',
ajax: {
url: '../mlayer/findFriend.php',
datatype:"json",
data: function (data) {
console.log(data);
if (!data.term) {
data.term = '';
}
return {
searchTerm: data.term // search term
};
},
processResults: function (response) {


let data=JSON.parse(response);

return {
results: data,
more: false
};
},
cache: true
}
});

$('#groupSelect').select2({
placeholder: "Select Groups",
multiple: true,
width:'100%',
ajax: {
url: '../mlayer/findGroup.php',
datatype:"json",
data: function (data) {
if (!data.term) {
data.term = '';
}
return {
searchTerm: data.term // search term
};
},
processResults: function (response) {


let data=JSON.parse(response);

return {
results: data,
more: false
};
},
cache: true
}
});
</script>  
