
<?php
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	$buycoupons = new _sppost_has_spprofile;
	$result = $buycoupons->read($_POST["postid"] , $_POST["profileid"]);
	if($result != false)
	{
		//echo "You have alredy bidden on this project !";
		
	}
	
	else
	{
		$buycoupons->buycoupons($_POST["postid"] , $_POST["profileid"],$_POST["enddate"],$_POST["categoryid"]);
		echo $buycoupons->ta->sql;
	}
?>
