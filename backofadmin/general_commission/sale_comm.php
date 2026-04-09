
<?php
error_reporting(0);
// error_reporting(E_ALL);
// 	ini_set('display_errors', '1');



include '../../univ/baseurl.php';
function sp_autoloader($class){
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

//print_r($_SESSION); die('rrrrrrr');
$userid=$_SESSION['userId'];
    
$bb="SELECT * FROM `tbl_user` where user_id= $userid";
$data  = dbQuery($dbConn,$bb);
$row_datau = dbFetchAssoc($data);


//unset($_SESSION['otp1']);
if($_SESSION["otp_4"]=='' || $_GET['res']=='resend' ){
  
$otp=rand(11111,99991);
$_SESSION["otp_4"] = $otp; 
$to=$row_datau["user_email"]; 
//echo ($to); die('hhhhhh');
//$to = "krsure1234@gmail.com";
$subject = "My subject";
$txt = "Your Otp is:".$otp;


$e = new _email;
 $e->send_invite_email_1($to,$txt);

 redirect("index.php?view=sale");
 //header('location:'.$BaseUrl.'/backofadmin/general_commission/index.php?view=sale');
}
 





if(isset($_POST['submit_module_1'])){
 
   $otp=$_POST['otp'];
   if($otp==$_SESSION["otp_4"]){
    $_SESSION["commision_verify_3"] = '1';
   }else{
    echo "wrong otp";
   }

   

}



if(isset($_POST['submit_module_commmision'])){
   
    $user=$_POST['sale_com'];

    $update1="UPDATE tbl_setting
    SET sale_comm = $user WHERE idspSetting=1";
    
    $result4  = dbQuery($dbConn,$update1);
   
}


?>


<style>

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
	</style>



<?php if($_SESSION["commision_verify_3"]!='1'){
  ?>

<div class="card text-center" style="width: 300px;margin-left: 393px;"     >
    <div class="card-header h5 text-white bg-primary">Access General Page </div>
    <div class="card-body px-5">
        <p class="card-text py-2">ENTER THE OTP SENT TO YOUR EMAIL.</p>
        <form action ="" method="post">
        <div class="form-outline"> 
          
            <label class="form-label" for="typeEmail">Enter OTP</label>
            <input type="text" id="otp" class="form-control my-3" name="otp" />
        </div>


        <button class=" btn btn-warning" style="margin: 10px 0px;" type="submit" name="submit_module_1">VERIFY </button>
           <span><a href="<?php echo $BaseUrl.'/backofadmin/general_commission/index.php?view=sale&res=resend';?>"class="btn btn-warning" href="">RESEND EMAIL</a> <span>
       
    </div>
</div>
</form>
<?php } else  {?>
<?php  
    
    $bb="SELECT * FROM `tbl_setting` where idspSetting=1";
    $data  = dbQuery($dbConn,$bb);
    $row_data = dbFetchAssoc($data);

    ?>
    <section class="content">
		<div class="box box-success">
        <form action ="" method="post"> 
			<div class="box-body"> 
            <label for="fname">Sale Commission %:</label>
            <input type="number" id="sale_com" name="sale_com" min="0" max="100" value="<?php echo $row_data['sale_comm']; ?>">
           <br><br>
				
			
				
			</div>
            <button class="pull-right btn btn-warning" type="submit" name="submit_module_commmision">Update </button> 
            </form>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->



    <?php } ?>