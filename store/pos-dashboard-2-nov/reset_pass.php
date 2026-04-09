<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


	$sp = new _spuser;
	$rand = rand(1111,9999);
	$uid = $_SESSION['uid'];
	$spUserEmail = $_SESSION['spUserEmail'];
	
	$data = array("sprand_no"=>$rand);
	$sp->update_random($data,$uid,$spUserEmail);

	$e = new _email; 
	$re = $e->pos_forgot_pass_email($spUserEmail, $rand); 
    $_SESSION['mail_send']=1;	

?>  
 
<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/password_check.php'; ?>";
</script>