
<?php
//   error_reporting(E_ALL);
//   ini_set('display_errors', '1');
include '../../univ/baseurl.php';
function sp_autoloader($class){
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$bb="SELECT * FROM `tbl_user` where user_id= $userid";
$data  = dbQuery($dbConn,$bb);
$row_datau = dbFetchAssoc($data);


//unset($_SESSION['otp1']);

if($_SESSION["otp1"]==''|| $_GET['res']=='resend'){
$otp=rand(11111,99991);
$_SESSION["otp1"] = $otp;
//$to = "shaniy405@gmail.com";
$to=$row_datau["user_email"]; 
$subject = "OTP to access commision page";
$txt = "Your Otp is:".$otp;


$e = new _email;
 $e->send_invite_email_1($to,$txt,$txt);
 redirect("index.php");
}
 





if(isset($_POST['submit_module'])){
 
   $otp=$_POST['otp'];
   if($otp==$_SESSION["otp1"]){
    $_SESSION["commision_verify"] = '2';

   }else{
    echo "wrong otp";
   }
}



if(isset($_POST['submit_module_commmision'])){
   
    $user=$_POST['vip'];
    $vip_tier_2=$_POST['vip2'];
    $vip_tier_3=$_POST['vip3'];
    


    $update1="UPDATE tbl_setting SET `vip_comm` = '$user', `vip_tier_2` = '$vip_tier_2', `vip_tier_3` = '$vip_tier_3' WHERE idspSetting=1";
    
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



<?php if($_SESSION["commision_verify"]!='2'){
  ?>

<div class="card text-center" style="width: 300px;margin-left: 393px;"     >
    <div class="card-header h5 text-white bg-primary">Access VIP Page </div>
    <div class="card-body px-5">
        <p class="card-text py-2">
        Please enter the one time password
to verify your account.
        </p>
        <form action ="" method="post">
        <div class="form-outline">
          
            <label class="form-label" for="typeEmail">Enter OTP</label>
            <input type="text" id="otp" class="form-control my-3" name="otp" />
        </div>
       
        <button class=" btn btn-warning" style="margin: 10px 0px;" type="submit" name="submit_module">VERIFY </button>
           <span><a href="<?php echo $BaseUrl.'/backofadmin/vip_commission/index.php?res=resend';?>"class="btn btn-warning" href="">RESEND EMAIL</a> <span>
       
    </div>
</div>
</form>
<?php } else  {?>

    <?php  
       $bb="SELECT * FROM `tbl_setting` where idspSetting=1";
       $data  = dbQuery($dbConn,$bb);
       $row_data = dbFetchAssoc($data)
        
        ?>
    <section class="content">
		<div class="box box-success">
        <form action ="" method="post">
            <div class="row">
                <div class="col-md-4">
			<div class="box-body"> 
            <label for="fname">Vip Commission %:</label>
            <input type="number" id="vip" name="vip" min="0" max="100" value="<?php echo $row_data['vip_comm']; ?>">
            <br> <br>
    </div>
    </div>
    <div class="col-md-4">
    <div class="box-body"> 
           <label for="fname">Tier 2 Commissions %:</label>
            <input type="number" id="vip2" name="vip2" min="0" max="100" value="<?php echo $row_data['vip_tier_2']; ?>">
        </div>   
        </div> 
        <div class="col-md-4">  
        <div class="box-body">    
            <label for="fname">Tier 3 Commissions %:</label>
            <input type="number" id="vip3" name="vip3" min="0" max="100" value="<?php echo $row_data['vip_tier_3']; ?>">
          
			</div>
			</div>
            

        </div>
        <button class="pull-right btn btn-warning" type="submit" name="submit_module_commmision" style="margin: 13px;" >Update </button> 
            </form>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->



    <?php } ?>