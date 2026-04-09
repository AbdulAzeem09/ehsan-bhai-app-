<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once("../../univ/baseurl.php" );
require_once( "../../common.php");
session_start();
if (!isset($_SESSION['bank_otp_verified'])) {
	 $BaseUrl = "https://dev.thesharepage.com";
  header("Location: $BaseUrl/dashboard/enterotp");
}
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 54;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../../component/f_links.php');?>
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>
section.content-header {
margin-top: -10px;
padding-left: 30px;
margin-bottom: -5px;
}
ol.breadcrumb {
margin-right: 25px;
}

</style>
</head>
<body class="bg_gray">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<section class="content-header">
<h1>Bank Details</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">My Bank Details</li>
</ol>
</section>

<div class="content">

<div class="box box-success">
<div class="box-header">

</div><!-- /.box-header -->
<div class="box-body">


<div class="container col-md-12">
<form method="post">
<div class="row">

<?php
$uid = $_SESSION['uid'];
$b = new _spbankdetail;
$data = $b->read($uid);
if($data!=false){
$row = mysqli_fetch_array( $data );
}
//print_r($row);
?>

<div class="col-md-6">
<div class="form-group">
<input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uid'];?>">
<label for="spBankusername" class="control-label">Name of Account Holder <span class="red">*</span></label>
<input type="text" class="form-control" id="spBankuser" 
name="spBankusername" value="<?php echo $row['spBankusername'];?>">
<span id="spBankuser_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankname" class="control-label">Bank Name<span class="red">*</span></label>
<input type="text" class="form-control" id="spBankname" name="spBankname" value="<?php echo $row['spBankname'];?>">
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankusername" class="control-label">Bank Number <span class="red">*</span></label>
<input type="text" class="form-control" id="spBanknumber" 
name="spBanknumber" value="<?php echo $row['spBanknumber'];?>">
<span id="spBanknumber_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankname" class="control-label">Branch Number<span class="red">*</span></label>
<input type="text" class="form-control" id="spBranchnumber" name="spBranchnumber" value="<?php echo $row['spBranchnumber'];?>">
<span id="spBranchnumber_error" style="color:red;"></span>
</div>
</div>



<div class="col-md-6">
<div class="form-group">
<label for="spAccountname" class="control-label">Account Number <span class="red">*</span></label>
<input type="password" class="form-control" maxlength="18" id="spAccountnumber" name="spAccountnumber" value="<?php echo $row['spAccountnumber'];?>">
<b><i class="fa fa-eye-slash" id="toggle-password" style="right: 30px;top: 32px;cursor: pointer; position: absolute;font-size: 20px;"></i></b>
<span id="spAccountnumber_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankcode" class="control-label">IFSC Code<span class="red">*</span></label>
<input type="text" class="form-control" maxlength="11" id="spBankcode" name="spBankcode" value="<?php echo $row['spBankcode'];?>">
<span id="spBankcode_error" style="color:red;"></span>
</div>
</div>
<div class="col-md-6">
<button type="submit" style="margin-bottom:25px"  id="savebankdetail"class="btn btn-submit db_btn db_primarybtn">Save</button>
</div>
</div>
</form>
</div>								

</div>
</div>



</div>
    <section class="content-header">
        <h1>Card Details</h1>
    </section>
    <div class="content">
        <div class="box box-success">
            <div class="box-header">

            </div>
            <div class="box-body">


                <div class="container col-md-12">
                    <form method="post" id="cardData">
                        <div class="row">

                            <?php
                                $row = selectQ("select customerName, cardNumber, cardExpMonth, cardExpYear, cardCVC from spuser where idspUser = ?", "i",[$_SESSION['uid']], "one");
                                if($row['cardNumber']){
                                    $row['cardNumber'] = decryptMessage($row['cardNumber']);
                                    $maskedCardNumber = str_repeat('*', strlen($row['cardNumber']) - 4) . substr($row['cardNumber'], -4);
                                }
                            ?>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                    <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uid'];?>">
                                    <label for="customerName" class="control-label">Name of Card Holder <span class="red">*</span></label>
                                    <input type="text" class="form-control" id="customerName"
                                           name="customerName" value="<?php echo $row['customerName'];?>">
                                    <span id="customerName_error" style="color:red;"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber" class="control-label">Card Number<span class="red">*</span></label>
                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" value="<?php if($maskedCardNumber){ echo $maskedCardNumber;}?>">
                                    <span id="cardNumber_error" style="color:red;"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cardExpMonth" class="control-label">Card Expiry Month <span class="red">*</span></label>
                                    <input type="text" class="form-control" id="cardExpMonth" name="cardExpMonth" placeholder="MM" maxlength="2" value="<?php echo $row['cardExpMonth'];?>">
                                    <span id="cardExpMonth_error" style="color:red;"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cardExpYear" class="control-label">Card Expiry Year<span class="red">*</span></label>
                                    <input type="text" class="form-control" id="cardExpYear" name="cardExpYear" placeholder="YYYY" maxlength="4" value="<?php echo $row['cardExpYear'];?>">
                                    <span id="cardExpYear_error" style="color:red;"></span>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC" class="control-label">Card CVC <span class="red">*</span></label>
                                    <input type="text" class="form-control" maxlength="3" id="cardCVC" name="cardCVC" value="<?php echo $row['cardCVC'];?>">
                                    <span id="cvcName_error" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" style="margin-top:24px"  id="savecarddetail" class="btn btn-submit db_btn db_primarybtn">Save</button>
                            </div>
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
</section>

<div class="" style="padding-left: 19%">
  <h1>Saved Cards</h1>
  <div class="table-responsive">
   <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
   <table class="table tbl_store_setting display" id="example" cellspacing="0" style="width:98%;">
     <thead>
       <tr>
         <th></th>
         <th>sl</th>
         <th class="text-center">customerName</th>
         <th class="text-center">cardNumber</th>
         <th class="text-center">cardExpiryDate</th>
         <th class="text-center">cardCVC</th>
       </tr>
     </thead>
 <tbody>
 <?php
 $userid = $_SESSION['uid'];
 
 $carddetails = selectQ("SELECT * FROM spcarddetail WHERE uid = ?", "i", [$userid]);

 if($carddetails) {
   foreach ($carddetails as $i => $row) {
     $decryptedCardNumber = decryptMessage($row['cardNumber']);
     $maskedDigits = str_repeat('x', 12) . substr($decryptedCardNumber, -4);
     $formattedCardNumber = chunk_split($maskedDigits, 4, ' ');
     $maskedCVC = str_repeat('*', strlen($row['cardCVC']));
 ?>



  <tr>
    <td></td>
    <td><?php echo $i + 1; ?></td>
    <td class="text-center"><span class="smalldot"><?php echo$row['customerName']; ?></span></td>
    <td class="text-center"><span class="smalldot"><?php echo $formattedCardNumber; ?></span></td>
    <td class="text-center"><span><?php echo $row['cardExpMonth']."/".$row['cardExpYear']; ?></span></td>
    <td class="text-center"><span class="smalldot"><?php echo $maskedCVC; ?></span></td>
  </tr>
 <?php
   }
 } else {
    echo "<tr><td colspan='7' class='text-center'>No Saved cards</td></tr>";
 }
 ?>
 </tbody>
</table>
</div>
</div>


<?php include('../../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>

<script>
const passwordInput = document.getElementById("spAccountnumber");
const togglePassword = document.getElementById("toggle-password");

togglePassword.addEventListener("click", function () {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");
    }
});
</script>
<script>
$("#savebankdetail").click(function(event) {
event.preventDefault();
var spProfile_idspProfile = "<?php echo $_SESSION['pid']; ?>";
var uid= $("#uid").val()
var Bankuser= $("#spBankuser").val()
var Bankname = $("#spBankname").val()
var Banknumber = $("#spBanknumber").val()
var Branchnumber = $("#spBranchnumber").val()
var Accountnumber = $("#spAccountnumber").val()
var Bankcode = $("#spBankcode").val()

if(Bankuser == "" &&  Bankname == "" && Banknumber == "" && Branchnumber == "" && Accountnumber == "" && Bankcode == ""){

/* $("#shipadd_error").text("Please Enter Address.");*/

$("#spBankuser_error").text("Please Enter Name of Account Holder .");
$("#spBankuser").focus();

$("#spBankname_error").text("Please Enter Bank Name.");
$("#spBankname").focus();

$("#spBanknumber_error").text("Please Enter Bank Number.");
$("#spBanknumber").focus();


$("#spBranchnumber_error").text("Please Enter Branch Number.");
$("#spBranchnumber").focus();

$("#spAccountnumber_error").text("Please Enter Account Number.");
$("#spAccountnumber").focus();


$("#spBankcode_error").text("Please Enter IFSC Code.");
$("#spBankcode").focus();

return false;
}else if (Bankuser == "") {

$("#spBankuser_error").text("Please Enter Name of Account Holder .");
$("#spBankuser").focus();


return false;
}else if (Bankname == "") {

$("#spBankname_error").text("Please Enter Bank Name.");
$("#spBankname").focus();

return false;
}else if (Banknumber == "") {
$("#spBanknumber_error").text("Please Enter Bank Number.");
$("#spBanknumber").focus();

return false;
}else if (Branchnumber == "") {
$("#spBranchnumber_error").text("Please Enter Branch Number.");
$("#spBranchnumber").focus();

return false;
}else if (Accountnumber == "") {

$("#spAccountnumber_error").text("Please Enter Account Number.");
$("#spAccountnumber").focus();


return false;
}else if (Bankcode == "") {
$("#spBankcode_error").text("Please Enter IFSC Code.");
$("#spBankcode").focus();

return false;
}




else{

$.ajax({
type: 'POST',
url: '/my-profile/addbankdetail.php',
data: {
spProfile_idspProfile:spProfile_idspProfile,
uid: uid,
spBankusername: Bankuser,
spBankname: Bankname,
spBanknumber: Banknumber,
spBranchnumber: Branchnumber,
spAccountnumber: Accountnumber,
spBankcode: Bankcode
},

success: function(response){ 

//  console.log(data);


swal({

title: "Bank Detail Added Successfully!",
type: 'success',
showConfirmButton: true

},
function(id) {

window.location.reload();


});


}
});

}



});
//});
</script>
<script>
    $("#savecarddetail").click(function(event) {
        event.preventDefault();
        var validation = true;
        var Carduser= $("#customerName").val()
        var Cardnumber = $("#cardNumber").val()
        var CardExpMonth = $("#cardExpMonth").val()
        var CardExpYear = $("#cardExpYear").val()
        var Cardcvc = $("#cardCVC").val()

        if(Carduser == "") {
            validation = false;
            $("#customerName_error").text("Please Enter Name of Card Holder .");
            $("#customerName").focus();
        }
        if(Cardnumber == ""){
            validation = false;
            $("#cardNumber_error").text("Please Enter Card Number.");
            $("#cardNumber").focus();
        }
        if(CardExpMonth == ""){
            validation = false;
            $("#cardExpMonth_error").text("Please Enter Card Expiry Month.");
            $("#cardExpMonth").focus();
        }
        if(CardExpYear == ""){
            validation = false;
            $("#cardExpYear_error").text("Please Enter Card Expiry Year.");
            $("#cardExpYear").focus();
        }
        if(Cardcvc == ""){
            validation = false;
            $("#cardCVC_error").text("Please Enter Card CVC.");
            $("#cardCVC").focus();
        }
        if(validation === true){

            $.ajax({
                type: 'POST',
                url: '/my-profile/addcarddetail.php',
                data: $("#cardData").serialize(),

                success: function(response){

//  console.log(data);


                    swal({

                            title: "Card Detail Added Successfully!",
                            type: 'success',
                            showConfirmButton: true

                        },
                        function(id) {

                            window.location.reload();


                        });


                }
            });

        } else {
            return false;
        }



    });
</script>


</body> 
</html>
<?php
} ?>
