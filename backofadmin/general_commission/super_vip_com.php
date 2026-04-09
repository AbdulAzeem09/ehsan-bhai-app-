
<?php
error_reporting(0);
include '../../univ/baseurl.php';
function sp_autoloader($class){
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


//unset($_SESSION['otp1']);
if($_SESSION["otp3"]==''|| $_GET['res1']=='supresend'){
  
$otp=rand(11111,99991);
$_SESSION["otp3"] = $otp; 
$to = "krsure1234@gmail.com";
//$to=$_SESSION["spUserEmail"]; 
$subject = "My subject";
$txt = "Your Otp is:".$otp;


$e = new _email;
 $e->send_invite_email_1($to,$txt);
 redirect("index.php?view=super_vip");
}
 





if(isset($_POST['submit_module_1'])){
 
   $otp=$_POST['otp'];
   if($otp==$_SESSION["otp3"]){
    $_SESSION["commision_verify_2"] = '1';
   }else{
    echo "wrong otp";
   }

   

}



if(isset($_POST['submit_module_commmision'])){
   
    $user=$_POST['super_vip'];
    $super_tier_2=$_POST['super_tier_2'];

    $super_tier_3=$_POST['super_tier_3'];

    $update1="UPDATE tbl_setting SET `super_vip_com` = '$user',`super_tier_2` = ' $super_tier_2',`super_tier_3` = '$super_tier_3' WHERE idspSetting=1";
    
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



<?php if($_SESSION["commision_verify_2"]!='1'){
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
        <button class="pull-right btn btn-warning" type="submit" name="submit_module_1">Verify </button> 
        <span><a href="<?php echo $BaseUrl.'/backofadmin/general_commission/index.php?res1=supresend';?>"class="btn btn-warning" href="">RESEND EMAIL</a> <span>
       
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
            <label for="fname">Super VIP Commission %:</label>
            <input type="number" id="super_vip" name="super_vip" min="0" max="100" value="<?php echo $row_data['super_vip_com']; ?>">

            <label for="fname">Tier 2 Commissions%:</label>
            <input type="number" id="super_tier_2" name="super_tier_2" min="0" max="100" value="<?php echo $row_data['super_tier_2']; ?>">

            <label for="fname">Tier 3 Commissions%:</label>
            <input type="number" id="super_tier_3" name="super_tier_3" min="0" max="100" value="<?php echo $row_data['super_tier_3']; ?>">
           <br><br>
				
			
				
			</div>
            <button class="pull-right btn btn-warning" type="submit" name="submit_module_commmision">Update </button> 
            </form>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->



    <?php } ?>