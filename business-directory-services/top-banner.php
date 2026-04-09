<style>
#topdircty1 .btn-get-started {
font-family: "Raleway", sans-serif;  
font-weight: 500;
font-size: 16px;
letter-spacing: 2px;
display: inline-block;
padding: 10px 28px;
border-radius: 5px;
transition: 0.5s;
border: 2px solid #4eb478;
color: #fff;
}

.views{
margin-left: auto !important;
margin-top: auto !important;
margin-bottom: 8px;     
}

.btn-get-started{
background-color: black !important; 
border: 2px solid black !important;       
}

#heddin{
margin-top: auto !important;  
}

.swal2-popup {
font-size: 2rem !important;  
}
</style>



<style>
.ebcf_modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
padding-top: 100px; /* Location of the box */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.ebcf_modal-content {
background-color: #fefefe;
margin: auto;
padding: 20px;
border: 1px solid #888;
width: 80%;
}

/* The Close Button */
.ebcf_close {
color: #aaaaaa;
float: right;
font-size: 28px;
font-weight: bold;
}

.ebcf_close:hover,
.ebcf_close:focus {
color: #000;
text-decoration: none;
cursor: pointer;
}

</style>



<section id="topdircty1" class="<?php if ($spfile) {
echo 'topdircty2';
} else {
echo 'topdircty3';
} ?>">
<div class="hero-container" data-aos="fade-up">
<?php if ($content_header) { ?>
<h1 style="background-color:grey" id = "heddin"><?php echo $content_header;  ?></h1>  
<?php } else { ?>
<h1>To Know More About Our <span>Business</span></h1>
<?php } ?>


<div class="btn-group views" > 





<!--<a href="#" id="mySizeChart">Open Modal</a>-->  




<?php

$businessId = isset($_GET["business"]) ? (int) $_GET["business"] : 0;

if (!isset($_SESSION['pid'])) {
//$id = $_GET['business'];
$_SESSION['afterlogin'] = "business-directory-services/details.php?business=" . $businessId;
//$_SESSION['afterlogin'] = "business-directory-services/"; 

?>



<a href="<?php echo $BaseUrl; ?>"  href="<?php echo $BaseUrl; ?><?php echo $_SERVER['REQUEST_URI']; ?>" class=" btn-get-started scrollto "  title="share"><i class="fa fa-share" style="font-size: 20px;color:grey"></i></a>     

<a href="<?php echo $BaseUrl; ?>" onclick="top_fav()" class="btn-get-started scrollto" data-favourite="1" data-company="<?php echo $businessId ; ?>" data-pid="<?php echo $_SESSION['pid']; ?>" title="Add to favourite"><i class="fa fa-heart-o" style="font-size: 20px;color:white;"></i></a>    

<a href="<?php echo $BaseUrl; ?>" onclick="top_rec() class=" btn-get-started scrollto" data-favourite="2" data-company="<?php echo $businessId; ?>" data-pid="<?php echo $_SESSION['pid']; ?>" title="Add to resource"><i class="fa fa-star" style="font-size: 20px;color:white;"></i></a>  

<?php
} else {
?>


<a  id="mySizeChart"  href="<?php echo $BaseUrl; ?><?php echo $_SERVER['REQUEST_URI']; ?>" class=" btn-get-started scrollto copy_text"  title="share"><i class="fa fa-share" style="font-size: 20px;color:grey"></i></a> 



<?php
$fd = new _favouriteBusiness;
$result_fav = $fd->chkFavAlready($businessId, $_SESSION['pid'], 1);   
if ($result_fav) {
?>
<!-- <a href="javascript:void(0)" class="removeToProfileFav btn-get-started scrollto" data-favourite="1" data-company="<?php echo $_GET['business']; ?>" data-pid="<?php echo $_SESSION['pid']; ?>"><i class="bx bx-heart-circle"></i> Remove to Favourite </a>-->
<a href="javascript:void(0)" class="removeToProfileFav btn-get-started scrollto" onclick="top_fav('<?php echo $businessId; ?>','<?php echo $_SESSION['pid']; ?>',0)" data-favourite="1" data-company="<?php echo $businessId; ?>" data-pid="<?php echo $_SESSION['pid']; ?>" title="Remove from favourite"><i class="fa fa-heart" style="font-size: 20px;"></i></a>




</a>
<?php } else { ?>
<a href="javascript:void(0)" class="addToProfileFav btn-get-started scrollto" data-favourite="1" data-company="<?php echo $businessId; ?>" onclick="top_fav('<?php echo $businessId; ?>','<?php echo $_SESSION['pid']; ?>',1)" data-pid="<?php echo $_SESSION['pid']; ?>" title="Add to favourite"><i class="fa fa-heart-o" style="font-size: 20px;color:white !important;"></i></a>    
<?php } ?>

<?php
$fd = new _favouriteBusiness;
$result_fav = $fd->chkFavAlready($businessId, $_SESSION['pid'], 2);
if ($result_fav) {
?>
<a href="javascript:void(0)" class=" removeToResorc btn-get-started scrollto" data-favourite="2"
onclick="top_rec('<?php echo $businessId; ?>','<?php echo $_SESSION['pid']; ?>',0)" data-company="<?php echo $businessId; ?>" data-pid="<?php echo $_SESSION['pid']; ?>" title="Remove to resource" style="padding-top: 5px;"><i class="fa fa-star " style="font-size: 27px;color: blue;"></i></a>   
<?php } else { ?>
<a href="javascript:void(0)" class="addtoResorc btn-get-started scrollto" data-favourite="2" data-company="<?php echo $businessId; ?>" onclick="top_rec('<?php echo $businessId; ?>','<?php echo $_SESSION['pid']; ?>',2)" data-pid="<?php echo $_SESSION['pid']; ?>" title="Add to resource"><i class="fa fa-star" style="font-size: 20px;color:white;"></i></a>       
<?php }
} ?>

</div>
</div>
</section>  


<div id="mySizeChartModal" class="ebcf_modal" style="z-index:1;">   

<div class="ebcf_modal-content">
<span class="ebcf_close">&times;</span>

<h3 class="text-center"><b>Share Weblink</b></h3>    
<form action="<?php echo $BaseUrl . '/my-profile/invitefriend.php'; ?>" method="post" class="" id="form_submit" onsubmit="validateMyForm();">  

<input type="hidden" name="business_services" value="business_services">  
<input type="hidden" name="business" value="<?php echo $businessId; ?>">  
<div class="row">

<div class="form-group">
<label for="yourName" class="control-label contact">Your Name <span class="red">*</span>

</label>
<br>
<span id="error_name" style="color:red;"></span>
<input type="text" class="form-control" id="yourName" value="<?php if(isset($_SESSION['MyProfileName'])) { echo $_SESSION['MyProfileName']; } ?>" readonly />

</div>

<div class="form-group">
<label for="sendTo" class="control-label contact">Send To <span style="font-size: 12px; color: red;">Add multiple emails by separating with Semicolon ;</span> <span class="red">*</span></label>
<br>
<span id="error_email" style="color:red;"></span>
<textarea class="form-control" id="if_email" name="if_email" placeholder="" required=""></textarea>
</div>

<div class="form-group">
<label for="txtmessage" class="control-label contact">Message <span class="red">*</span></label> 
<br>
<span id="error_massage" style="color:red;"></span>
<textarea class="form-control" rows="7" id="if_message" name="if_message" required="">Hi there.
I am sharing my business weblink, please see below:
<?php echo $BaseUrl; ?><?php echo $_SERVER['REQUEST_URI']; ?>  

Thank you
Regards
<?php if(isset($_SESSION['MyProfileName'])) { echo $_SESSION['MyProfileName']; } ?>

</textarea>
</div>

</div>

<button type="button" onclick="validateEmail()" class="btn btn-submit db_btn db_primarybtn"><i class="fa fa-user"></i> Share Weblink</button>   
</form>

</div>

</div>    

<script>
function validateEmail() {
var emailField = $('#if_email').val();
//alert(emailField)

var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.;])+\.([A-Za-z]{2,4})$/;


/*if (reg.test(emailField.value) == false) 
{
alert('Invalid Email Address');
//return false;
}
else{
$('#form_submit').submit();

}*/
$('#form_submit').submit();
}
</script>    

<script type="text/javascript">
function validateMyForm()
{
    
    var name =  document.getElementById("yourName").value;
    var email =  document.getElementById("if_email").value;
    var massage =  document.getElementById("if_message").value;



  if(name == '')
  { 
    alert("please enter the name");
    returnToPreviousPage();
    return false;
  }
  if(email == '')
  { 
    alert("please enter the email");
    returnToPreviousPage();
    return false;
  }
  
  if(massage == '')
  { 
    alert("please enter the massage");
    returnToPreviousPage();
    return false;
  }
  
 // alert("validations passed");
  return true;
}
</script>
<!-- <script>
 $("#form_submit").on("click",function(e){
    
        

    var name =  document.getElementById("yourName").value;
    var email =  document.getElementById("if_email").value;
    var massage =  document.getElementById("if_message").value;
    
    if(name == '' || email == '' || massage == '')
    {
        if(name == ''){
        e.preventDefault();
       $("#error_name").html('plz fill the required');
       
       }else{
        $("#error_name").html('');
       }


       if(email == ''){
        e.preventDefault();
       $("#error_email").html('plz fill the required');
       
       }else{
        $("#error_email").html('');
       }

       if(massage == ''){
        e.preventDefault();
       $("#error_massage").html('plz fill the required');
       
       }else{
        $("#error_massage").html('');
       }

       return false;



    }
    
    
 






});
</script> -->


<script src="<?php echo $BaseUrl?>/assets/js/sweetalert.js"></script>   

<script type="text/javascript">

function showNofification(title, icon) {
$.notify({
title: title,
icon: icon,
message: ""
}, {
type: 'success',
animate: {
enter: 'animated fadeInUp',
exit: 'animated fadeOutRight'
},
placement: {
from: "top",
align: "right"
},
offset: 20,
spacing: 10,
z_index: 1031,
});
}
</script>

<script>
$('.copy_text').click(function (e) {
e.preventDefault();
var copyText = $(this).attr('href');

document.addEventListener('copy', function(e) {
e.clipboardData.setData('text/plain', copyText);
e.preventDefault();
}, true);

document.execCommand('copy');  
//console.log('copied text : ', copyText);
//alert('copied text: ' + copyText);    
// var mess = 'copied to Clipboard'
//$('.copy_text').attr("title",mess);
// Swal.fire('copied to Clipboard.')     
});
</script>  


<script>
// Get the modal
var ebModal = document.getElementById('mySizeChartModal');

// Get the button that opens the modal
var ebBtn = document.getElementById("mySizeChart");

// Get the <span> element that closes the modal
var ebSpan = document.getElementsByClassName("ebcf_close")[0];

// When the user clicks the button, open the modal 
ebBtn.onclick = function() {
ebModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
ebSpan.onclick = function() {
ebModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == ebModal) {
ebModal.style.display = "none";
}
}


</script> 




