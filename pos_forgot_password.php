<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('univ/baseurl.php');
//die('---');
session_start();

if(!isset($_SESSION['pid'])){     
 $_SESSION['afterlogin']="store/";
 include_once ("authentication/islogin.php");

}else{
 function sp_autoloader($class){
   include 'mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "1";

$email = $_GET['email'];
$rand = $_GET['rand'];


//$uid = 

if(isset($_POST['submit'])){
    $p = new _pos;  
    //print_r($_POST);
    //die('========');
    $pid = $_SESSION['pid'];
    $u_id = $_SESSION['uid'];
    $new_password_in = $_POST['new_password_in']; 
    $confirm_password_in = $_POST['confirm_password_in']; 
    $data = array("password"=>$new_password_in);  
    $resss = $p->read_pos_pass($u_id);
    $rowss = $resss->num_rows;

    if($rowss){
      $res = $p->update_pos_pass($data, $u_id); 
    } else {  
    $data2 = array("pid"=>$pid, "uid"=>$u_id, "password"=>$new_password_in);
    $res2 = $p->create_pos_pass($data2); 
    }
    unset($_SESSION['pass_check']);  

    ?>
    <script>
    window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/index.php'; ?>";   

    </script>
	
 <?php }

 $us= new _spuser;
         $us2=$us->read_pos_rand($email,$rand); 

         if($us2){ ?>
			<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Update</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>


   <section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 ">

            <h3 class="mb-5 text-center">Enter Password</h3>
        <form action="" method="post" id="passwordForm">
            <div class="form-outline mb-4">
            <label class="form-label" for="typePasswordX-2">New Password</label>
              <input type="password" id="new_password" name="new_password_in" class="form-control form-control-lg" />
              <span id="new_pass" class="text-danger"></span>
            </div>

            <div class="form-outline mb-4">
            <label class="form-label" for="typePasswordX-2">Confirm Password</label>
              <input type="password" id="confirm_password" name="confirm_password_in" class="form-control form-control-lg" />
             <span id="confirm_pass" class="text-danger"></span>
            </div>

            <!-- Checkbox -->


            <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Submit</button>
   </form>
            <hr class="my-4">

            

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  
</body>

</html>
			 
		<?php }else{
			 echo '<h1>You Are Not Verified User !</h1>';
		 }


 } ?>
 <script>
  $(document).ready(function() {
    $('#passwordForm').submit(function(event) {
      
      var password = $('#new_password').val();
      var confirmPassword = $('#confirm_password').val();
      if(password == "" || confirmPassword == ""){
        if(password == ""){
          $("#new_pass").html("field is required")
          event.preventDefault();
        }else(
          $("#new_pass").html("")
        )
        if(confirmPassword == ""){
          $("#confirm_pass").html("field is required")
          event.preventDefault();
        }else{
          $("#confirm_pass").html("")
        }
        
      } else if(password !== confirmPassword){
          $("#confirm_pass").html("Password and Confirm Password do not match.")
          $("#new_pass").html("")
          event.preventDefault();
        }else{
          $("#passwordForm").submit()
        }
    });
  });
</script>
