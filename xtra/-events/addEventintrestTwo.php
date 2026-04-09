	
	<script type="text/javascript">
		$(".intrestArea").on("click", function(){
			var postid = $(this).attr("data-postid");
			var pid = $(this).attr("data-pid");
			var area = $(this).attr("data-area");
			var classhtml = "ie_"+postid;
			$.post("http://localhost/share-page/events/addEventintrestTwo.php", {postid: postid, pid: pid, area: area}, function (r) {
				//alert(r);
				$("."+classhtml).html(r);
				//window.location.reload();
			});
		});
	</script>
<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$ei = new _eventIntrest;
	
	
	$postid = $_POST['postid'];
	$pid 	= $_POST['pid'];
	$area 	= $_POST['area'];
	
	$result = $ei->chekAlready($postid, $pid);
	if($result != false && $result->num_rows>0){
		//update
		$result2 = $ei->update($postid, $pid, $area);

	}else{
		$result2 = $ei->create($postid, $pid, $area);
	}

	if($area == 2){
		$area2 = "<i class='fa fa-check'></i>";
		$title = "Going";
	}else{
		$area2 = "";
		
	}
	if($area == 1){
		$area1 = "<i class='fa fa-check'></i>";
		$title = "Interested";
	}else{
		$area1 = "";
		
	}
	if($area == 0){
		$area0 = "<i class='fa fa-check'></i>";
		$title = "May Be";
	}else{
		$area0 = "";
		
	}
	//echo $title;
?>
	<div class="dropdown intrestEvent " style="display: block;">
		<button class="btn btn_group_join dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button>
	    <ul class="dropdown-menu ">
	        <li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $pid;?>" data-postid="<?php echo $postid;?>" data-area="2"><?php echo $area2;?> Going</a></li>
			<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $pid;?>" data-postid="<?php echo $postid;?>" data-area="1"><?php echo $area1;?> Interested</a></li>
			<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $pid;?>" data-postid="<?php echo $postid;?>" data-area="0"><?php echo $area0;?> May Be</a></li>
	    </ul>
	</div>


	

