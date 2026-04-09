<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$pl = new _company_news;

	if (isset($_POST['newsId'])) {
		$res = $pl->readNews($_POST['newsId']);
		if($res){
			$row = mysqli_fetch_assoc($res);
			$postTime = strtotime($row['cmpanynewsdate']); 
			?>
			<label><?php echo $row['cmpanynewsTitle']; ?><small style="color: #CCC;">(<?php echo date("d-M-Y", $postTime); ?>)</small></label>
			
            <p style="margin-top: 10px;"><?php echo $row['cmpanynewsDesc'];?></p>
			<?php
		}
	}	
?>