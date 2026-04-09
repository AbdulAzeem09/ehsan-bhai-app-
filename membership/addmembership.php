<?php
	session_start();
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$up = new _spprofiles;
		$res = $up->read($_SESSION["pid"]);
		if($res != false)
		{
			$row = mysqli_fetch_assoc($res);
			$profiletype = $row["spProfileType_idspProfileType"];
			$profilename= strtolower($row["spProfileName"]);
			$profilename = str_replace(' ', '-', $profilename);
			$profileid = $row["idspProfiles"];
			$membership = $row["spMembership_idspMembership"];
			$store = strtolower($row["spDynamicWholesell"]);
			$store = str_replace(' ', '-', $store);
		}
			//if($profiletype == 1 || $profiletype == 2 || $profiletype == 3 ||$profiletype == 4)
			if($profiletype == 1)
			{	
					$id = $up->setmembership($_POST["membershipid"],$_POST["duration"],$_SESSION["pid"]);
					if($id == 1)
					{
						echo "Your Transaction has been completed !";
						
						mkdir("../".$store);
						$wholesellerstore = fopen("../".$store . "/index.php", "w") or die("Unable to open file!");
						
						$txt ='<?php 
						session_start();
						$_GET["categoryID"]= "1";
						$_GET["spPostingsFlag"] = "0";
						$_GET["categoryName"] = "Buy&Sell";
						$_GET["profileid"]= "'.$row["idspProfiles"].'";
						$_SESSION["pid"]= "'.$row["idspProfiles"].'";
						include "../publicpost/index.php";
						?>';
						
				
						fwrite($wholesellerstore, $txt);
						fclose($wholesellerstore);
						$up->wholeselldirectory($_SESSION["pid"],$store);
					}
					else
					  echo "Please try again , Your transaction has not been completed ! ";
			}
		else 
			echo "Select Your business Profile !";
?>
