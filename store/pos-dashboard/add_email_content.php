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
/*---------Paragraf insert  than send email------------*/

if(isset($_POST['btn_insert'])){
	//die('======');
	//print_r($_POST);    
	//print_r ($_REQUEST);
	//die('===');
$uid=$_SESSION['uid'];
$pid=$_SESSION['pid'];
$data = array("uid"=>$uid,
				"pid"=>$pid,
               "1paragraph"=>$_POST['11paragraph'],
               "2paragraph"=>$_POST['22paragraph'],			
               "subject"=>$_POST['subject']			
); 

$res = $p->add_email_content($data); 

$data=$_POST['customer_id'];
	$i=0;
	while($i < sizeof($data)){
		//echo $data[$i];
	$result1 = $p->read_email_id($data[$i]);
	//print_r(result1); 
	if ($result1) {
					
	$row1 = mysqli_fetch_assoc($result1);
	//echo $row1['email'];
	$email=$row1['email'];
	//echo $row1['customer_name'];
	//echo $row1['phone'];
	//print_r($row1);
	$r = $p->read_id_spuser($row1['phone']);
	if($r){
	$ro = mysqli_fetch_assoc($r);
	$id=$ro['idspUser'];
	//echo $id;
	//print_r($ro);
	$r1 = $p->read_quantity_q($id);
	if($r1){
	$ro1 = mysqli_fetch_assoc($r1);
	//print_r($ro1);
	$quantity=$ro1['quantity'];
	$pid=$ro1['pid'];
	//echo $pid;
	
	$r12 = $p->read_compny_address($pid);
	if($r12){
	$ro12 = mysqli_fetch_assoc($r12);
	//print_r($ro12);
	$companyaddress=$ro12['companyaddress'];
	$companyname=$ro12['companyname'];
	$companyPhoneNo=$ro12['companyPhoneNo'];
	$pid=$ro12['spprofiles_idspProfiles'];
	///echo $companyaddress;
  // $pid=2973;
	
	 $us1=$p->read_compny_logo($_SESSION['uid']); 

         if($us1){

           $row=mysqli_fetch_assoc($us1);
		  // print_r($row);
		   $logo=$row['file'];
	       // echo $logo;
		 }	 
	}
	 $u1=$p->read_paragraph($_SESSION['pid']); 

         if($u1){

           $ro_1=mysqli_fetch_assoc($u1);
		   //print_r($ro_1);
		    $paragraph1=$ro_1['1paragraph'];
			 $paragraph2=$ro_1['2paragraph'];
			 $subject=$ro_1['subject'];
			 
			 // print_r($ro_1['1paragraph']);
			 //echo  $subject;
			 ///die('===');
		 }
	$e = new _email;
	
	 $e->send_email_d($email,$row1['customer_name'],$quantity,$companyaddress,$logo,$companyname,$companyPhoneNo,$paragraph1,$paragraph2,$subject);
	}
	}
	}
	$i++;
	}


}
/*---------Paragraf update than send email------------*/

if(isset($_POST['btn_update'])){
	//die('======');
//$uid=$_SESSION['uid'];
//$pid=$_SESSION['pid'];
$id=$_POST['id'];
$data = array(
               "1paragraph"=>$_POST['1paragraph'],
               "2paragraph"=>$_POST['2paragraph'],	   		
               "subject"=>$_POST['subject']			   
); 

$res = $p->update_email_content($data,$id); 

$data=$_POST['customer_id'];
	$i=0;
	while($i < sizeof($data)){
		//echo $data[$i];
	$result1 = $p->read_email_id($data[$i]);
	//print_r(result1); 
	if ($result1) {
					
	$row1 = mysqli_fetch_assoc($result1);
	//echo $row1['email'];
	$email=$row1['email'];
	//echo $row1['customer_name'];
	//echo $row1['phone'];
	//print_r($row1);
	$r = $p->read_id_spuser($row1['phone']);
	if($r){
	$ro = mysqli_fetch_assoc($r);
	$id=$ro['idspUser'];
	//echo $id;
	//print_r($ro);
	$r1 = $p->read_quantity_q($id);
	if($r1){
	$ro1 = mysqli_fetch_assoc($r1);
	//print_r($ro1);
	$quantity=$ro1['quantity'];
	$pid=$ro1['pid'];
	//echo $pid;
	
	$r12 = $p->read_compny_address($pid);
	if($r12){
	$ro12 = mysqli_fetch_assoc($r12);
	//print_r($ro12);
	$companyaddress=$ro12['companyaddress'];
	$companyname=$ro12['companyname'];
	$companyPhoneNo=$ro12['companyPhoneNo'];
	$pid=$ro12['spprofiles_idspProfiles'];
	///echo $companyaddress;
  // $pid=2973;
	
	 $us1=$p->read_compny_logo($_SESSION['uid']); 

         if($us1){

           $row=mysqli_fetch_assoc($us1);
		  // print_r($row);
		   $logo=$row['file'];
	       // echo $logo;
		 }	 
	}
	 $u1=$p->read_paragraph($_SESSION['pid']); 

         if($u1){

           $ro_1=mysqli_fetch_assoc($u1);
		   //print_r($ro_1);
		    $paragraph1=$ro_1['1paragraph'];
			 $paragraph2=$ro_1['2paragraph'];
			 $subject=$ro_1['subject'];
			 
			 // print_r($ro_1['1paragraph']);
			 //echo  $subject;
			 ///die('===');
		 }
	$e = new _email;
	
	 $e->send_email_d($email,$row1['customer_name'],$quantity,$companyaddress,$logo,$companyname,$companyPhoneNo,$paragraph1,$paragraph2,$subject);
	}
	}
	}
	$i++;
	}




}

 

?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=payment_type&msg=send'; ?>";

</script>