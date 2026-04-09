<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	session_start();
	$p = new _comment;
	$result = $p->read($_POST["postid"]);
	if($result != false){
		?>
		<?php
			while($row = mysqli_fetch_assoc($result)){ ?>
				<div class="multiComment hidecmnt_<?php echo $row["idComment"]; ?>">
					<div class="row">
						<div class="col-md-6">
							<?php
								if(isset($row["spProfilePic"])){ ?>
									<img alt='profilepic'  class='img-circle' src='<?php echo ($row["spProfilePic"]);?>' style='width: 40px; height: 40px;margin-right: 5px;'><?php 
								}else{
									echo "<img alt='profilepic'  class='img-circle' src='".$BaseUrl."/img/default-profile.png' style='width: 40px; height: 40px;margin-right: 5px;'> ";
								}
								
								echo ucwords(strtolower($row["spProfileName"]));
								?>
						</div>
						<div class="col-md-6 text-right">
							<div class="comDelright">
								<?php
								echo "<button type='button' class='deletecmt btn ".($_SESSION["uid"]==$row["userid"] ?"":"hidden")."' data-commentid='".$row["idComment"]."'><span class='fa fa-trash' ></span></button>";
								
								echo "<button type='button' class='editcomment btn ".($_SESSION["uid"]==$row["userid"] ?"":"hidden")."' data-commentid='".$row["idComment"]."' data-commenttext='".$row["comment"]."'><span class='fa fa-pencil' ></span></button>";
								?>
							</div>
						</div>
						<div class="col-md-12">
							<div class="commentdetail">
								<?php echo wordwrap($row["comment"],40,"<br>\n",true); ?>
							</div>
							
						</div>
					</div>
				</div>
				<?php
			}
				?>
		
		<?php
	}
?>