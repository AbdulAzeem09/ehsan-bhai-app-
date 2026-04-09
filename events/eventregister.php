
<?php
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	$evreg = new _sppost_has_spprofile;
	$result = $evreg->read($_POST["postid"] , $_POST["profileid"]);
	if($result != false)
	{
		echo "You have alredy registered !";
		
	}
	else
	{
		$evreg->eventregistration($_POST["postid"] , $_POST["profileid"],$_POST["startdate"],$_POST["enddate"],$_POST["categoryid"]);
		echo "You have sucessfully registered";
	}
?>
