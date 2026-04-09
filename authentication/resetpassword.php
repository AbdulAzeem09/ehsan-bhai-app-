<?php
include("../univ/baseurl.php" );
session_start();

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
?>
<html lang="en">
<head>
<?php include('../component/header_link.php');?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>

<style>

body {
font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
}
</style>
<style>
        .forgotForm {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-group {
            position: relative;
        }

        .fa {
            position: absolute;
            font-size: 16px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .forgotForm {
                max-width: 100%;
            }
            .fa-eye-slash {
                right: 10px;
            }
        }
        .btn-border-radius{
        	border-radius: 10px !important;
        }
    </style>
</head>
<body class="bg_forgot" >

<section class="homepage">
<div class="container">

<div class="">
<div class="row">
<div class="col-md-offset-3 col-md-6">
<div class="forgot_widget">
<div class="row">
<div class="col-md-12">
<div class="pad_top_55">

<div class="row logo_signup">
<div class="col-md-12 text-center">
<a href="<?php echo $BaseUrl;?>" style="left: 41%;"><img src="<?php echo $BaseUrl;?>//assets/images/logo/tsp_trans.png" alt="The SharePage" class="img-responsive" style="width: 108px;height: 115px;" /></a>
</div>
</div>
<div class="forgotForm">
    <div class="space-lg"></div>
    <form action="reset.php" method="post" onsubmit="return matchPassword()">
        <input type="hidden" name="userid_" value="<?php echo $_GET["me"]; ?>">
        <input type="hidden" name="resetcode_" value="<?php echo $_GET["recode"] ?>">

        <div class="form-group">
            <label for="newpassword">New Password</label>
            <input type="password" class="form-control" id="newpassword" name="newpassword_" required>
            <b><i class="fa fa-eye-slash" id="toggle-new-password" style="right: 9px;top: 29px;"></i></b>
        </div>

        <div class="form-group">
            <label for="repassword">Retype Password</label>
            <input type="password" class="form-control" id="repassword" name="repassword_" required>
            <b><i class="fa fa-eye-slash" id="toggle-repassword" style="right: 9px;top: 29px;"></i></b>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-border-radius" style="min-width: 130px;">Reset</button>
        </div>
    </form>
</div>                    
<div class="space-lg"></div>
</div>
</div>

</div>                                
</div>
</div>
</div>
</div>
</div>
</section>

<?php include('../component/f_btm_script.php'); ?>
<!-- telephone -->



</body>


</html>
<script>  
function matchPassword() {  
var pw1 = $('#newpassword').val();
//alert(pw1);
var pw2 = $('#repassword').val();
//alert(pw2);
if(pw1 != pw2)  
{   
Swal.fire({
position: 'center',
icon: 'failure',
title: 'Password does not match',
showConfirmButton: true,

})
return false;
} else {  
Swal.fire({
position: 'center',
icon: 'success',
title: 'Password Created Successfully',
showConfirmButton: false,

})
//alert("Password created successfully");  
}  
}  
</script>  
<script>
    // JavaScript function to toggle password visibility
    function togglePasswordVisibility(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        }
    }
    // Attach event listeners for toggling password visibility
    document.getElementById("toggle-new-password").addEventListener("click", function () {
        togglePasswordVisibility("newpassword", "toggle-new-password");
    });

    document.getElementById("toggle-repassword").addEventListener("click", function () {
        togglePasswordVisibility("repassword", "toggle-repassword");
    });
</script>
