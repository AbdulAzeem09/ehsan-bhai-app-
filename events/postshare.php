<style>
.btn:hover {
color: #bf0f4d!important;
opacity: .8;
}

</style>
<?php
$post_id = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
?>
<div class="modal fade" id="myshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content " style="border-radius: 15px;">
<form action="../social/shareEvent.php" method="POST" onsubmit="return validateForm()" class="sharestorepos">
<div class="modal-header" style="border-top-left-radius: 15px;
border-top-right-radius: 15px;">
<h4 class="modal-title">Share Post</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body sharedimage">
<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
<input type="hidden" id="shareposting" name="spPostings_idspPostings" value="<?php echo $post_id?>">

<div class="row">
<div class="col-md-6">
<label>Select group or friend  </label>
<div class="dropdown" id="drop1">
<button class="btn btn-default dropdown-toggle" type="button" id="dropdownShare" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
Select group or friend
<span class="caret"></span>
</button>
<span id="error_group" style="color:red;"></span>
<ul class="dropdown-menu" aria-labelledby="dropdownShare">
<li id="groupshare" class="sppointer sharedd"><a href="#">Share in a group</a></li>
<li id="friendshare" class="sppointer sharedd"><a href="#">Share to a friend</a></li>
</ul>
</div>
</div>
<input type="hidden" value="error" id="checkingtoggle">
<!--<div class="col-md-6  hidden" id="groupshow">
<div class="">
<input type="hidden" id="spgroupshareid" name="spShareToGroup" value="">
<input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
</div>
</div>


<div class="col-md-6 hidden" id="profileshow">
<div class="">
<input type="hidden" id="spfriendshareid" name="spShareToWhom" value="">
<input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
</div>
</div>
<div class="col-md-12">
<input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...">
</div>-->

<div class="col-md-6 group-select-block hidden" id="groupshow">
<div class="form-group" style="margin-left:1px;">
<label>Select Group</label>
<select class="select3 form-control" style="color:red" name="spShareToGroup[]" id="groupSelect" multiple >
<option value=""></option>
</select>
<span id="spgroupSelect" style="color:red"></span>
</div>
</div>

<!-- <div class="col-md-5 hidden" id="profileshow">
<div class="form-group">
<input type="hidden" id="spfriendshareid" name="spShareToWhom">
<input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
</div>
</div> -->
<div class="col-md-6 friend-select-block hidden" id="profileshow">
<div class="form-group" style="margin-left:1px;">
<label>Select Friend</label>
<select class="select2 form-control" name="spShareToWhom[]" id="friendSelect" multiple >
<option value=""></option>
</select>
<span id="spfriendSelect" style="color:red"></span>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<label>Say something about this</label>
<span id="sayfield" style="color:red;margin: -5px;"></span>
<input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...6">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="center-block">

<?php
//this is posting for featured pic
$pic = new _eventpic;
$res2 = $pic->readFeature($post_id);
if($res2 != false){
if($res2->num_rows > 0){
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive center-block' src='" .$pic2 . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/xnoevent.jpg.pagespeed.ic.VLoUF7pX4o.webp' class='img-responsive center-block'>"; 
}
}
}else{
$res2 = $pic->read($post_id);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive center-block' src='" . $pic2 . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/xnoevent.jpg.pagespeed.ic.VLoUF7pX4o.webp' class='img-responsive center-block'>"; 
}
}
?>

<!-- <img id="modalpostingpic" 
src="../../img/no.png" alt="Posting Pic" class="img-responsive center-block" /> -->
</div>
</div>
<div class="col-sm-12 eventShareDetail">
<div class="row">
<?php
if(!empty($startDate)){
//echo $start_date;
$dy = new DateTime($startDate);
$day = $dy->format('d');
$month = $dy->format('M');
$weak = $dy->format('D');
}else{
$day = 0;
$month = "&nbsp;";
$weak = "&nbsp;";
}
?>
<div class="col-md-1">
<span class="datee"><?php echo $month; ?><br><?php echo $day;?></span>
</div>
<div class="col-md-8">
<h2 class="eventcapitalize">
<?php if (strlen($ProTitle) < 20) { echo $ProTitle ; } else { echo substr($ProTitle, 0, 18) . '...'; } ?>
</h2>


<p class="address"><?php echo $weak." ".$startTime;?> <?php echo $venu;?></p>
</div>
<div class="col-md-3">
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($post_id, $_SESSION['pid']);
if($result != false){
$row3 = mysqli_fetch_assoc($result);
$area = $row3['intrestArea'];

if($area == 2){
$area2 = "<i class='fa fa-check'></i>";
$title = "Going";
}else if($area == 1){
$area1 = "<i class='fa fa-check'></i>";
$title = "Interested";
}else if($area == 0){
$area0 = "<i class='fa fa-check'></i>";
$title = "May Be";
}
}else{ 
$title = "Event";
}

$ie = new _eventIntrest;
$resulti1 = $ie->chekGoing($post_id, 2);
// echo $ie->ta->sql;
if($resulti1 != false && $resulti1->num_rows >0){
$going = $resulti1->num_rows;
}else{
$going =  0;
}

$resulti2 = $ie->chekGoing($post_id, 1);
// echo $ie->ta->sql;
if($resulti2 != false && $resulti2->num_rows >0){
$interested = $resulti2->num_rows;
}else{
$interested =  0;
}


$resulti3 = $ie->chekGoing($post_id, 0);
// echo $ie->ta->sql; 
if($resulti3 != false && $resulti3->num_rows >0){
$MayBe = $resulti3->num_rows;
}else{
$MayBe =  0;
}
?>

<span id="">

</span>
<div class="ie_<?php echo $post_id;?>">

<div class="dropdown intrestEvent " id="eventDetaildrop" style="display: block;">
<button class="new_class" id="button2" type="button" data-toggle="dropdown" aria-expanded="true" style="border: none;">  <i class="fa fa-calendar"></i><?php echo $title;?></button>
<ul class="dropdown-menu ">
<li><a href="javascript:void(0)" class="intrestArea" id="go1" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $post_id;?>" data-area="2"> <i class="fa fa-calendar"></i><?php echo $area2;?> Going (<?php echo $going; ?>) </a></li>
<li><a href="javascript:void(0)" class="intrestArea" id="inter1" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $post_id;?>" data-area="1"><?php echo $area1;?> <i class="fa fa-calendar"></i> Interested (<?php echo $interested; ?>)</a></li>
<li><a href="javascript:void(0)" class="intrestArea" id="may1" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $post_id;?>" data-area="0"><?php echo $area0;?> <i class="fa fa-calendar"></i> May Be (<?php echo $MayBe; ?>)</a></li>
</ul>
</div>
</div> 
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer" style="border-bottom-left-radius: 15px;
border-bottom-right-radius: 15px;">
<button type="" class="btn butn_cancel" data-dismiss="modal" style="border-radius: 30px;">Cancel</button>
<button type="submit" id="share" class="btn butn_mdl_submit" style="border-radius: 30px;">Share</button>
</div>
</form>
</div>
</div>
</div>

<script>
function validateForm() {
var x = document.getElementById("groupSelect").value;
var y = document.getElementById("friendSelect").value;    
var z = document.getElementById("dropdownShare").innerText; 

if (((x == "") || (y != "")) && ((y == "") || (x != ""))||(z=='Select group or friend')) {
if(z=='Select group or friend'){
document.getElementById("error_group").innerHTML = "Please Select group or friend ";

}else{
document.getElementById("error_group").innerHTML = "";
}
document.getElementById("spgroupSelect").innerHTML = "Please select any Group ";
document.getElementById("spfriendSelect").innerHTML = "Please select any friend ";

return false;
}

else{ 

return true; 

}

}
</script>					

<script>
$(document).ready(function(){

$("#go1").click(function(){

$("#button2 ").html('Going'); 


});

$("#inter1").click(function(){

$("#button2  ").html('Interested');


});

$("#may1").click(function(){ 

$("#button2 ").html('MayBe');

});

});

$("#joinstatus").change(function(){
var area = $('#joinstatus').val();
alert(a);

$.ajax({
type: "POST",   
url: "addEventinterest.php",
data: "area=" + area,
success: function(data) {
alert("sucess");
}
});
$("#drop1").mouseover(function(){
$("#drop1").css("background-color", "yellow");
});

});	



</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" ></script>
<script type="text/javascript">
$(".select2").select2();
$(".select3").select2();

$('#friendSelect').select2({
placeholder: "Select Friends",
multiple: true,
width:'80%',
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
$('#checkingtoggle').val("");

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
width:'80%',
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

$('#checkingtoggle').val("");
let data=JSON.parse(response);

return {
results: data,
more: false
};
},
cache: true
}
});




// $('#share').on('click',function(){
//  	var aa=$('#aboutshare').val();
// 	 var bb=$('#checkingtoggle').val();
// 	if(bb != ''){
// 		$('#error_group').html('This field is required111');
//  		return false;
// 	}
// //  else if(aa==''){
// // 	$('#error_group').html('');
// //  $('#sayfield').html('This field is required2');
// //  		return false;
// // }
// 	else{
// 		return true;
// 	}



//  });














</script>
