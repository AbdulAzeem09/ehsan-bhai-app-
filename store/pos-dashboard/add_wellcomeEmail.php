<?php 



 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	
	//print_r($_POST); die("----------");
	
	$p = new _pos;
//$res = $u->read($_SESSION["uid"]);
if(isset($_POST['btn_insert_w'])){
	//die('======');
	//print_r($_POST);    
	//print_r ($_REQUEST);
	//die('===');
$uid=$_SESSION['uid'];
$pid=$_SESSION['pid'];
$data = array("uid"=>$uid,
				"pid"=>$pid,
               "paragraph"=>$_POST['paragraph_w'],   
               "subject"=>$_POST['subject_w']	  		
); 

$res = $p->add_wellcomeEmail_content($data); 

}


if(isset($_POST['btn_update_w'])){
	//die('======');
//$uid=$_SESSION['uid'];
//$pid=$_SESSION['pid'];
$id=$_POST['id'];
$data = array(
               "paragraph"=>$_POST['paragraph_w1'],
               "subject"=>$_POST['subject_w1']			
); 

$res = $p->update_Wellcomeemail_content($data,$id); 

}

 

?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=payment_type'; ?>";

</script>