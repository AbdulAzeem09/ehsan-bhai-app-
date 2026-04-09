	
<?php
	include('../../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

	$postid = $_POST['postid'];
	$pid = $_POST['pid'];
	$intrest = $_POST['intrest'];
?>
		<div class="row">
			<?php
			$ie = new _eventIntrest;
            $result = $ie->chekGoing($postid, $intrest);
            //echo $ie->ta->sql;
            if($result != false){
            	while ($row = mysqli_fetch_assoc($result)) { 
            		$pro = new _spprofiles;
                    $result7 = $pro->read($row['spProfile_idspProfile']);
                    if($result7 != false){
                        $row7 = mysqli_fetch_assoc($result7);
                        ?>
                        <div class="col-md-6">
                            <div class="featuringBox row bg_gray no-margin">
                                <a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['spProfile_idspProfile'];?>">
                                    <div class="col-md-3 no-padding">
                                        <?php 
                                        echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
                                        ?>
                                    </div>
                                    <div class="col-md-9 no-padding">
                                        <h4><?php echo $row7['spProfileName'];?></h4>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                    }
            		?>
            		<?php
            	}
            }
			?>
		</div>