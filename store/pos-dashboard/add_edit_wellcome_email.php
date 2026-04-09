<?php 

/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/

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
	
$uid=$_SESSION['uid'];
$pid=$_SESSION['pid'];
$data = array("uid"=>$uid,
				"pid"=>$pid,
               "paragraph"=>$_POST['paragraph_w'],   
               "subject"=>$_POST['subject_w']	  		
); 

$res = $p->add_wellcomeEmail_content($data); 

$data=$_POST['customer_id'];
	$i=0;
	while($i < sizeof($data)){
		
	$result1 = $p->read_email_id($data[$i]);
	
	if ($result1) {
		//die('========');			
	$row1 = mysqli_fetch_assoc($result1);
	$email=$row1['email'];
	$name=$row1['customer_name'];
	
	
	$result_p = $p->read_Wellcomeemail_c($_SESSION['uid'],$_SESSION['pid']);
	
	if ($result_p) {
					
	$row_p = mysqli_fetch_assoc($result_p);
	
	$paragraph=$row_p['paragraph'];
	$subject=$row_p['subject'];
	//die('======');
	
	//Read company Name
	$r12 = $p->read_compny_address($_SESSION['pid']);
	if($r12){
	$ro12 = mysqli_fetch_assoc($r12);
	$companyname=$ro12['companyname'];
	
	}
	//Read company logo
	$us1=$p->read_compny_logo($_SESSION['uid']); 

         if($us1){

           $row=mysqli_fetch_assoc($us1);
		  // print_r($row);
		   $logo=$row['file'];
	       //echo $logo;
		   ///die('===');
		 }
	
	$e = new _email;
	$send=$e->send_reg_email_pos($email,$name,$paragraph,$logo,$companyname);
	
	$dataa = array(	
               "status"=>1			
					); 

 $p->update_Status1($dataa,$data[$i]); 
	}
	}
	
	$i++;
	}
}

     /*---------update paragraf than send mail --------- */
	 
	 
if(isset($_POST['btn_update_w'])){
	//die('======');
//$uid=$_SESSION['uid'];
//$pid=$_SESSION['pid'];
$id=$_POST['id'];
$data = array(
               "paragraph"=>$_POST['paragraph_w1'],
               "subject"=>$_POST['subject_w1'],			
              		
); 

$res = $p->update_Wellcomeemail_content($data,$id); 


$data=$_POST['customer_id'];
	$i=0;
	while($i < sizeof($data)){
		
	$result1 = $p->read_email_id($data[$i]);
	
	if ($result1) {
		//die('========');			
	$row1 = mysqli_fetch_assoc($result1);
	$email=$row1['email'];
	$name=$row1['customer_name'];
	
	
	$result_p = $p->read_Wellcomeemail_c($_SESSION['uid'],$_SESSION['pid']);
	
	if ($result_p) {
					
	$row_p = mysqli_fetch_assoc($result_p);
	
	$paragraph=$row_p['paragraph'];
	$subject=$row_p['subject'];
	//die('======');
	
	//Read company Name
	$r12 = $p->read_compny_address($_SESSION['pid']);
	if($r12){
	$ro12 = mysqli_fetch_assoc($r12);
	//print_r($ro12);
	//$companyaddress=$ro12['companyaddress'];
	$companyname=$ro12['companyname'];
	//echo $companyname;
	//die('===');
	}
	//Read company logo
	$us1=$p->read_compny_logo($_SESSION['uid']); 

         if($us1){

           $row=mysqli_fetch_assoc($us1);
		  // print_r($row);
		   $logo=$row['file'];
	       //echo $logo;
		   ///die('===');
		 }
	
	$e = new _email;
	$send=$e->send_reg_email_pos($email,$name,$paragraph,$logo,$companyname);
	
	$dataa = array(	
               "status"=>1			
					); 

 $p->update_Status1($dataa,$data[$i]); 
	}
	}
	
	$i++;
	}
	///die('======');
}

 

?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=payment_type&msg=send'; ?>";

</script>
<script>
//window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/edit_wellcome_email.php'; ?>";

</script>