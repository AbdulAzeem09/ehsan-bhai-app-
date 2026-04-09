<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$vr=new _realstateposting;
		
	  if(isset($_POST['button'])){
		 $arr=array(
		'first'=>$_POST['name'],
		'last'=>$_POST['last']
		);
		$vr->host9($arr);
	  }
  
	  $vr2=$vr->read_d();
	  
	  if(isset($_GET['action']) && $_GET['action']=='deletes'){
		 $v4=$_GET['id'];
		 $dl=$vr->remove1($v4);

			 $redirectUrl = $BaseUrl . '/artandcraft/dkm.php';
 			header("Location: " . $redirectUrl);

		 //header("location:https://dev.thesharepage.com/artandcraft/dkm.php");
	  }
	  
	  
	  
?> 

<form action="" method="post">
<input  type="text" placeholder="Enter name" name="name">
<input  type="text" placeholder="Last name" name="last">
<button type="submit" name="button">Button</button>
</form>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>File</th>
<th>Action</th>
</tr>
<?php While($vr3=mysqli_fetch_assoc($vr2)){
	//print_r($vr3);
?>
<tr>
<td><?php echo $id1=$vr3['id'] ?></td>
<td><?php echo $vr3['first'].' '.$vr3['last'] ?></td>
<td><?php ?></td>
<td><a class="button" href="?id=<?php echo $id1; ?>&action=deletes">Delete</a></td>
<td><a class="button" href="update_d.php?id=<?php echo $id1; ?>">Update</a></td>
</tr>
<?php }?>
</table>