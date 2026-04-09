<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

    require_once("../univ/baseurl.php" );
	session_start();
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="dashboard/";
		include_once ("../authentication/islogin.php");
		
		}else{
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		
		spl_autoload_register("sp_autoloader");
		
		$pageactive = 55;
	?>
	<?php
	
	$p=new _pos_po;
	$id=$_SESSION['uid'];
	$client_id=$_POST['clientId'];
	$client_secert=$_POST['clientSecret']; 
	
	if($_FILES["key_json1"]["name"]){
		//echo $_FILES["key_json1"]["name"];  // image name
		//die('=======');
	$uploads_dir = "img";
	$temp = explode(".", $_FILES["key_json1"]["name"]);// array
	//echo $temp;
	//die('===========');
   $newfilename = round(microtime(true)) . '.' . end($temp);
  // echo $newfilename;// random number
  // die('=========');
    move_uploaded_file($_FILES["key_json1"]["temp"], "/img/" . $newfilename);
	}
	
  $name1=$_POST['hidden1'];
  
	 if($newfilename){
		$aa=$newfilename;
		
	 }
	 else{
		  $aa= $name1;
	 }
	// 
	
	$data=array(
	           // "idspUser"=>$id,
	            "client_id"=>$client_id,
				"client_secret"=>$client_secert,
				"key_json"=>$aa
	
	
	);
	
$uid = $_SESSION['uid'];
$b = new _pos_po;
$da = $b->readApi($uid);
if($da!=false){
	$res2=$p->updateApi($data,$id);
}else{
	$res=$p->insertApi($data);
	
}	
	?>
	<script>
         window.location.replace('<?php echo $BaseUrl?>/dashboard/api.php');
        </script>
	
	
	
	<?php
	} ?>