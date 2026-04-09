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
			<input type="hidden" id="idcmpanynews" name="idcmpanynews" value="<?php echo $row['idcmpanynews']; ?>">
            <div class="form-group">
                <label for="recipient-name" class="control-label"><h4>Title</h4></label>
                <input type="text" class="form-control no-radius" id="cmpanynewsTitle" name="cmpanynewsTitle" value="<?php echo $row['cmpanynewsTitle']; ?>" />
            </div>
            
            <div class="form-group">
                <label for="recipient-name" class="control-label"><h4>Description</h4></label>
                <textarea class="form-control no-radius" name="cmpanynewsDesc" rows="6" required><?php echo $row['cmpanynewsDesc'];?></textarea>
            </div>
			<?php
		}
	}	
?>