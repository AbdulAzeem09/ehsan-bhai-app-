<?php
   
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$vrr=new _realstateposting;
		
		
		?>
		  
		<form action="" method="post">
<input  type="text" placeholder="Enter name" name="name">
<input  type="text" placeholder="Last name" name="last">
<input  type="text" placeholder="Password " name="pass">
<button type="submit" name="button">Button</button>
</form>