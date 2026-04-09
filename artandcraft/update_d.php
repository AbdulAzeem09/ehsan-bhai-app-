<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$vrr=new _realstateposting;
		
		$id=$_GET['id'];
		$rd=$vrr->read1($id);
		$rd1=mysqli_fetch_assoc($rd); 
		 if(isset($_POST['button'])){
		 $arr=array(
		'first'=>$_POST['name'],  
		'last'=>$_POST['last']
		);
		
		
		$vrr->update1($arr,$id);
		//header("location:https://dev.thesharepage.com/artandcraft/dkm.php");

		$redirectUrl = $BaseUrl . '/artandcraft/dkm.php';
 		header("Location: " . $redirectUrl);
	  }
		
		
?>


<form action="" method="post">    
<input  type="text" placeholder="Enter name" name="name" value="<?php echo $rd1['first'] ?>" > 
<input  type="text" placeholder="Last name" name="last" value="<?php echo $rd1['last'] ?>" >
<button type="submit" name="button">Button</button>
</form>