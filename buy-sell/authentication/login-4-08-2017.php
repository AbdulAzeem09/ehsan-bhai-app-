<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	session_start(); 
	$i=0;
	$u = new _spuser;
	$r = $u->login($_POST['spUserName'],hash("sha256", $_POST['spUserPassword']));
	if ($r != false)
	{	
		while($rows = mysqli_fetch_array($r))
		{  
			if ($rows >= 1)							
			{
				$_SESSION['login_user']= $rows['spUserName'];
				$_SESSION['uid'] =  $rows['idspUser']; 
				$_SESSION['spUserEmail'] = $rows['spUserEmail']; 
				$p = new _spprofiles;
				$rp = $p->readProfiles($_SESSION['uid']);
				if ($rp != false)
				{
					$row = mysqli_fetch_array($rp);
					$updateid = $p->update(array('is_active' => 1), "WHERE t.idspProfiles =" . $row['idspProfiles']);
					$_SESSION['pid'] = $row['idspProfiles'];
					$_SESSION['myprofile'] = $row["spProfileName"];
					$_SESSION['ptname'] = $row["spProfileTypeName"];
					$_SESSION['ptpeicon'] = $row["spprofiletypeicon"];
					$_SESSION['ptid'] = $row["spProfileType_idspProfileType"];
					$_SESSION['isActive'] = 1;
					$c = new _order;
					$res = $c->read($_SESSION['pid']);
					if($res != false)
					{
						$_SESSION['cartcount'] = $res->num_rows;
						//echo $_SESSION['cartcount'];
						
					}

					else
					{
						$_SESSION['cartcount']=0;
					}
	
				}
				
			}
		}
		if(isset($_SESSION['login_user']))
		{
			if(isset($_SESSION['afterlogin']))
			{
				echo $BaseUrl."/".$_SESSION['afterlogin'];
			}
			else
				echo $BaseUrl."/details/";
			
			//echo $_SESSION['afterlogin'];
			
		}
	}
	
	else 
	{
		 //$_SESSION['err'] = "Invalid username or password";
		 //echo  $_SESSION['err'];
		 //echo "/index.php";
	}
	
	
	
?>