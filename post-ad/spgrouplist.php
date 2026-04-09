<?php
			include_once("../header.php");
			function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");
			$p = new _spgroup;
			$rpvt = $p->read();
			 if ($rpvt != false){
				while($row = mysqli_fetch_assoc($rpvt)) {
				 echo $row['spGroupName'];
				 echo "<br>";
					
				}
			}
		?>
	