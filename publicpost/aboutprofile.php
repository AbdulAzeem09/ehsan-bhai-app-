<?php
		function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");
		$p = new _spprofiles;
		$res = $p->read($_POST["profileid"]);
		if($res != false)
		{
			
			$rows = mysqli_fetch_assoc($res);
			/*echo "<div class='row'>";
			echo "<div class='col-md-4'><img  alt='Posting Pic' class='class='img-rounded pull-right' style='width:80px; height:80px;' src=' ".($rows["spProfilePic"])."' ><br></div>";
			echo "<div class='col-md-8'><h4>".$rows["spProfileName"]. "</h4>".wordwrap($rows["spProfileAbout"],20,"<br>\n",true)."</div>";
			echo "</div>";*/
			
			$name = $rows["spProfileName"];
			$desc = $rows["spProfileAbout"];
			$pic = $rows["spProfilePic"];
		}
?>


<div class="card" style="width:100%">
  <img src="<?php echo ($pic); ?>"  alt="Avatar" style="width:100%">
  <div class="container" style="width:100%">
    <p><b><?php echo $name;?></b></p> 
    <p><?php echo $desc?></p> 
  </div>
</div>