<?php
include('../../univ/baseurl.php');
session_start();

if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$active = 4;

$_GET["categoryid"] = "1";
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add New Suppliers | TheSharepage-POS </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="../../assets/js/validations.js"></script>
</head>
<body>
<div class="container-fluid">
<div class="row flex-nowrap">

<?php include('left_side_landing.php');?>   

<div class="col py-3">
<div class="row mb-4">
<div class="col-12 p-3">
<div class="d-flex justify-content-between border-bottom pb-2 mb-3">
<h4 class="float-start"> Add New Suppliers</h4>
<span class="float-end">
<a href="supplier-list.php" class="btn btn-outline-secondary me-3">Supplier List</a>
<button type="submit" form="addcustomer" onclick="form_submit()" class="btn btn-main me-3"><i class="fas fa-plus"></i> Add Supplier</button>
</span>
</div>
<form action="<?php echo $BaseUrl; ?>/store/pos-dashboard/add-supplier-detail.php" method="post" enctype="multipart/form-data" class="" id="addcustomer">
<div class="row">
<div class="col-8">
<div class="row">
<!-- <div class="col-6 mb-3">
<input type="text" class="form-control shadowBox" id="customerno" placeholder="Customer#" name="customerno" value="" required>
</div>-->
<div class="col-6 mb-3">
<input type="text" class="form-control shadowBox" id="customername" placeholder="Supplier Name" name="customername" value="" required>
</div>
<div class="col-6 mb-3">
<input type="text" class="form-control shadowBox" id="customerphone" placeholder="Supplier Phone" name="customerphone" value="" required>
<span id="custphone"  name="cphone"></span>
<input type="hidden" id="phonehidden">
</div>
</div>
<div class="row">

<div class="col-6 mb-3">
<input type="text" class="form-control shadowBox" id="customeremail" placeholder="Supplier Email" name="customeremail" value="" required>
<span id="custemail" class="text-danger" name="cemail"></span>
<input type="hidden" id="custhidden">
</div>
</div>
<div class="row">
<!--<div class="col-6 mb-3">
<select class="form-control form-select shadowBox" id="customertype" name="customertype">
<option selected> Select Customer Type</option>
<option value="1">Retail</option>
<option value="2">Whole Sale</option>
<option value="3">Domeste</option>
</select>
</div>
<div class="col-6 mb-3">
<select class="form-control form-select shadowBox" id="profiletype" name="profiletype">
<option selected> Select Profile Type</option>
<option value="1">Business</option>
<option value="2">Personal</option>
<option value="3">Professional</option>
</select>
</div>-->
</div>
<!-- <div class="row">
<div class="col-6 mb-3">
<select class="form-control form-select shadowBox" id="membership" name="membership">
<option selected> Select Membership Type</option>
<option value="1">Browns</option>
<option value="2">Silver</option>
<option value="3">Gold</option>
</select>
</div>
<div class="col-6 mb-3">
<select class="form-control form-select shadowBox" id="submembership" name="submembership">
<option selected> Select Sub Membership</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select>
</div>
</div>-->
<div class="row">
<div class="col-12">
<div class="form-group d-flex">
<div class="form-check me-4">
<input class="form-check-input" type="checkbox" value="1" id="emailcheck" name="emailcheck" >
<label class="form-check-label" for="emailcheck">Receive Email & Newsletter</label>
</div>
<div class="form-check">
<input class="form-check-input" type="checkbox" value="1" id="empcheck" name="empcheck">
<label class="form-check-label" for="empcheck">Is this customer an employee of this business?</label>
</div>
</div>
</div>
</div>
</div>
<div class="col-4">
<div class="profile-img mb-4 border border-3 text-center p-2">
<img src="" class="img-sm img-fluid img-thumbnail mb-2" id= "preview_img">   
<input type="file" class="form-control shadowBox" name="profile_img" id="image_file" style="width:333px; text-align: center;">
<span class="error_message" id="image_file_error"style="color: red;"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="tab-container-one">
<!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item active">
<a class="nav-link active active" href="#mailing" role="tab" aria-controls="mailing" data-bs-toggle="tab">Mailing / Preference</a>
</li>
<li class="nav-item">
<a class="nav-link active" href="#cpt" role="tab" aria-controls="cpt" data-bs-toggle="tab">Credit & Payment Terms</a>
</li>
<li class="nav-item">
<a class="nav-link active" href="#note" role="tab" aria-controls="note" data-bs-toggle="tab">Note</a>
</li>
</ul> -->
<div class="tab-content">
<div class="tab-pane active" id="mailing" role="tabpanel" aria-labelledby="mailing-tab">
<div class="row">
<div class="col-6 mb-3">
<label for="spPostaddress_" class="lbl_2">Address</label>                              
<input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
</div>
<div class="col-6 mb-3">
<label for="spPostZIP_" class="lbl_2">ZIP</label>
<input type="text" class="form-control" id="zip" name="zip" placeholder="ZIP" required>
</div>

<div class="col-4 mb-3">
<!--<select class="form-control form-select shadowBox" id="membership" name="country_">
<option selected> Select Country</option>
<option value="1">USA</option>
<option value="2">Canada</option>
<option value="3">ABC</option>
</select>-->

<div class="form-group">
<label for="spPostCountry_" class="lbl_2">Country</label>
<select class="form-control form-select shadowBox" name="spPostCountry" id="spUserCountry">
<option value="">Select Country </option>
<?php





$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {

$usercountry = $row3['country_id'];
?>

<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] == $row3['country_id'])?'selected':''; ?>><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
</div>

</div> 

<div class="col-4 mb-3">                              
<!--<input type="text" class="form-control" id="state-province" name="state_province" placeholder="State / Province" required>-->
<div class="form-group">
<div class="loadUserState">
<label for="spPostingCity"  class="lbl_3">State</label>
<select class="form-control form-select shadowBox spPostingsState"  name="spUserState">
<option>Select State</option>
<?php 

// if (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($countryId);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { 

$userstate = $row2["state_id"];
?>
<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] == $row2["state_id"] )?'selected':'';?>><?php echo $row2["state_title"];?> </option>
<?php
}
}
//  }
?>
</select>
</div>
</div>	


</div>
<div class="col-4 mb-3">
<!-- <input type="text" class="form-control" id="city" name="city" placeholder="City" required>-->

<div class="form-group">
<div class="loadCity">
<label for="spPostingCity"  class="">City</label>
<select class="form-control form-select shadowBox" name="spUserCity">
<option>Select City</option>
<?php 
$stateId = $userstate;

$co = new _city;
$result3 = $co->readCity($_SESSION['spPostState']);
//echo $co->ta->sql;
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] == $row3['city_id'])?'selected':''; ?>><?php echo $row3['city_title'];?></option> <?php
}

} ?>
</select>
</div>
</div>	


</div>


</div>
</div>
<div class="tab-pane active" id="cpt" role="tabpanel" aria-labelledby="cpt-tab">
<div class="row">
<div class="col-4">
<div class="d-flex me-1">
<select class="form-control form-select" id="select-payment" name="paymentterm">
<option value="1">Cash</option>
<option value="2">Credit Card</option>
<option value="3">Bank Account</option>
</select>
</div>
</div>
<div class="col-4">
<div class="d-flex me-1">
<select class="form-control form-select" id="select-credit" name="creditterm">
<option value="cod">COD</option>
<option value="week">Week</option>
<option value="10days">10days</option>
<option value="month">month</option>
</select>
</div>
</div>
<div class="col-4">
<select class="form-control form-select" id="select-payment" name="paymentterm_type">
<option selected>Discount Type</option>
<option value="2">Senior Discount</option>
<option value="3">Children Discount</option>
<option value="4">Celebrity Discount </option>
<option value="5">Media Discount </option>
<option value="6"> Close Network Discount </option>
<option value="7"> Employee Discount t </option>                                                 
</select>
</div>
</div>
</div>
<div class="tab-pane active" id="note" role="tabpanel" aria-labelledby="note-tab">
<div class="row">
<div class="col-12">
<label for="spPostNote_" class="lbl_2">Note</label>
<textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
</div>
</div>
</div>
</div>
</div>
</div>                        
</div>
</form>
</div>
</div>            
<div class="row">
<div class="col-lg-12 footer">                     
<span>Copyrights &copy; 2022 TheSharePage, All Reights Reserved</span>                    
</div>
</div>
</div>
</div>
</div>
<!------------------------------------------ Scripts Files ------------------------------------------>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script>
<script type="text/javascript">
$(document).ready( function () {
$('#table_id').DataTable({  
buttons: {
buttons: [ 'copy', 'csv', 'excel' ]
}
});        
});
</script>

<script>
image_file.onchange = evt => {
const [file] = image_file.files
if (file) {
preview_img.src = URL.createObjectURL(file)   
}
}
</script>


<script>

$(document).ready(function(){

$("#spUserCountry").on("change", function () { 
var a = $("#spUserCountry").val();
$.post("../loadUserState.php", {countryId: a}, function (r) {
// alert(r);
$(".loadUserState").html(r);
});
});



}); 
</script>	 
<script>

$(document).ready(function(){
$("#customeremail").keyup(function(){
var email=$("#customeremail").val();
$.ajax({
url: 'dataInsertByAjax.php',  
type: 'post',
data: {
emailsub:email
} ,    
success: function(response){ 
const WithoutSpaces = response.replace(/\s+/g, '');
if(WithoutSpaces=="1"){
$('#custemail').html('<b class="text-danger">Email Already Used</b>');
}else{
$('#custemail').html('<b class="text-success"">Email Available</b>');
}
$('#custhidden').val(WithoutSpaces);
}

});    
});

$("#customerphone").keyup(function(){
var phone=$("#customerphone").val();
$.ajax({
url: 'dataInsertByAjax.php',  
type: 'post',
data: {
phonesub:phone
} ,    
success: function(response){ 
const WithoutSpaces = response.replace(/\s+/g, '');
//alert(WithoutSpaces);
if(WithoutSpaces=="3"){
$('#custphone').html('<b class="text-danger">Phone Number Already Used</b>');
}else{
$('#custphone').html('<b class="text-success"">Phone Number Available</b>');
}
$('#phonehidden').val(WithoutSpaces);
}

});    
});


}); 
function form_submit(){
var con =$('#custhidden').val();
var connn =$('#phonehidden').val();
if(con==2 && connn==2 ){
$('#addcustomer').submit()
} else if(con==1){
//alert('This Email Already Registered !');
swal('This Email Already Registered !');
}else if(connn==3){
swal('This Phone Already Registered !');
}

}
document.getElementById("image_file").addEventListener("change", function() {
  validateImageFile("image_file", "image_file_error");
});
</script>

</body>
</html>
<?php } ?>
