<style type="text/css">
    
    .friend_message .messages ul li img {
	width: 45px;
	height: 45px;
	border-radius: 50%;
	float: left;
    }
	
    .friend_message .messages ul li {
    display: inline-block;
    clear: both;
    float: left;
    margin: 15px 15px 5px 15px;
    width: calc(100% - 25px);
    font-size: 1.9em;
    padding: 0 25 0 25px !important;
	}
</style>

<?php
    include('../univ/baseurl.php');
    session_start();
		date_default_timezone_set('Asia/Kolkata'); 
	if (!isset($_SESSION['pid'])) {
		$_SESSION['afterlogin'] = "friendmessage/";
		include_once ("../authentication/check.php");
		
		}else{
		
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		
		spl_autoload_register("sp_autoloader");
	?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<?php include('../component/f_links.php');?>
			<!--This script for sticky left and right sidebar STart-->
			<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
			<script>
				function execute(settings) {
                $('#sidebar').hcSticky(settings);
				}
				// if page called directly
				jQuery(document).ready(function($){
                if (top === self) {
				execute({
				top: 20,
				bottom: 50
				});
                }
				});
				function execute_right(settings) {
                $('#sidebar_right').hcSticky(settings);
				}
				// if page called directly
				jQuery(document).ready(function($){
                if (top === self) {
				execute_right({
				top: 20,
				bottom: 50
				});
                }
				});
				
			</script>
			<!--This script for sticky left and right sidebar END-->
			<!--NOTIFICATION-->
			<!-- <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'> -->
		</head>
		<body class="bg_gray" onload="pageOnload('freiendmessage')">
			
			<?php
				
				include_once("../header.php");
			?>
			<section class="landing_page">
				<div class="container pubpost">
					<div id="sidebar" class="col-md-2 no-padding">
						<?php include('../component/left-landing.php');?>
					</div>
					<!-- Modal -->
					<div id="composeNewTxt" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content no-radius sharestorepos">
								<form method="post" >
									<div class="modal-header">
										
										<h4 class="modal-title"><i class="fa fa-pencil"></i> Compose Message</h4>
									</div>
									<div class="modal-body">
										
										<input type="hidden" name="txtSender" id="txtSender" value="<?php echo $_SESSION['pid'];?>">
										<div class="form-group">
											<label>Select User<span class="red">* <span class="error_user"></span></span></label>
											<select class="form-control" name="txtReceiver" id="txtReceiver">
												<option value="0">Select User</option>
												<?php
													$b = array();
													$r = new _spprofilehasprofile;
													$pv = new _postingview;
													$res = $r->readall($_SESSION["pid"]);//As a receiver
													if($res != false){
														while($rows = mysqli_fetch_assoc($res)){
															$p = new _spprofiles;
															$sender = $rows["spProfiles_idspProfileSender"];
															array_push($b,$sender);
															$result = $p->read($rows["spProfiles_idspProfileSender"]);
															//echo $p->ta->sql;
															if($result != false){
																$row = mysqli_fetch_assoc($result);
																echo '<option value="'.$row['idspProfiles'].'">'.ucwords(strtolower($row['spProfileName'])).'&nbsp;('.$row["spProfileTypeName"].')</option>';
															}
														}
													}
													$r = new _spprofilehasprofile;
													$res = $r->readallfriend($_SESSION["pid"]);//As a sender
													//echo $r->ta->sql;
													if($res != false){
														while($rows = mysqli_fetch_assoc($res)){
															
															$rm = in_array($rows["spProfiles_idspProfilesReceiver"],$b,true);
															if($rm == ""){
																$p = new _spprofiles;
																$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
																if($result != false){
																	$receive = $rows["spProfiles_idspProfilesReceiver"];
																	$row = mysqli_fetch_assoc($result);
																	echo '<option value="'.$row['idspProfiles'].'">'.ucwords(strtolower($row['spProfileName'])).'&nbsp;('.$row["spProfileTypeName"].')</option>';
																}
															}
														}
													}
													
												?>
											</select>
										</div>
										
										<div class="form-group">
											<label>Message<span class="red">* <span class="error_msg"></span></span></label>
											<textarea class="form-control" name="spfriendChattingMessage" id="friendMessage" required=""></textarea>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<input type="button" class="btn btn-primary composTxtNow" id="button1" name="" value="Send Message">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-10" >
						<div class="row m_top_10">
							<div class="col-md-12">
								<div class="topstatus" style="border-bottom: 1px solid #CCC;padding: 8px 15px;">
									<div class="createbox composeTxt">
										<span><label data-toggle="modal" data-target="#composeNewTxt"><i class="fa fa-envelope"></i> Compose Message</label></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row m_top_15">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading"><i class="fa fa-comments"></i> INBOX</div>
									<div class="panel-body">
										<div class="table-responsive myfriend"  >
											<table class="table all_inbox table-hover freelanceconversation">
												<tbody>
													<?php  
														$g          = new _spgroup;
														$r          = new _spprofilehasprofile;
														$unread     = new _friendchatting;
														$p          = new _spprofiles;
														
														
														//all unread msg jo mjhy receive howy
														$aa = array();
														//echo "===yha main receiver ho===";
														$result1 = $unread->totalUnreadReceiver($_SESSION["pid"]);
														
														if($result1 != false){
															while ($row1 = mysqli_fetch_assoc($result1)) {
																//expire code strt
																$rslt = $g->friendprofile($_SESSION["uid"], $row1["spprofiles_idspProfilesSender"]);
																//echo $g->ta->sql;
																$groupname = "";
																$groupid = 0;
																$g = new _spgroup;
																if ($rslt != false) {
																	$rws = mysqli_fetch_assoc($rslt);
																	$groupid = $rws["idspGroup"];
																	$groupname = $rws["spGroupName"];
																	$groupname = str_replace(' ', '', $groupname);
																}
																//expire code end
																array_push($aa, $row1["spprofiles_idspProfilesSender"]);
																
																$senderPid      = $row1["spprofiles_idspProfilesSender"]; //Friend
																$receiverPid    = $row1["spprofiles_idspProfilesReciver"]; //My
																$total = 0;
																$unres = $unread->unreadmessage($senderPid, $receiverPid); //$receiver
																//echo $unread->ta->sql;
										if ($unres != false) {
													$total = $unres->num_rows;
																}
																
																$result = $p->read($row1["spprofiles_idspProfilesSender"]);
																if ($result != false) {
												$row = mysqli_fetch_assoc($result);
																?>
                                                                <tr class="chat-row">
                                                                    <td><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Delete" class="hidden"><i class="fa fa-trash"></i></a></td>
                                                                    <td>
                                                                        <?php
echo " <a href='javascript:void(0)' class=' friendchat myfriends " . ($groupid != 0 ? "groupfriend" : "notgroup") . " " . trim($groupname) . "' data-friendname='" . $row["spProfileName"] . "' data-friendid='" . $row["idspProfiles"] . "' data-frndicon='" . $row["spprofiletypeicon"] . "' data-friendname='" . $row["spProfileName"] . "' data-groupid='" . $groupid . "' data-myid='".$receiverPid."'>
<img  alt='profile-Pic' class='img-responsive chat_img' id='".$senderPid."' style='' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../img/default-profile.png") . "' ><span class='frndname'>" . ucwords(strtolower($row["spProfileName"])) . " </span><span class='badge totalunreadmsg no-radius ".($total > 0 ?"":"hidden")." ' style=''>" . $total . "</span></a>";
																			
																		?>
																	</td>
                                                                    <td>
                                                                        <?php
																			// GET LAST MSG AND DATE OF THAT USER
																			//echo $row1["spprofiles_idspProfilesSender"]; 
																			$result4 = $unread->lastmsg($row1["spprofiles_idspProfilesSender"], $_SESSION['pid']);
																			//print_r($result4);
																			//echo $unread->ta->sql;
																			if ($result4!=false) {
																				//die('===');
																				$row4 = mysqli_fetch_assoc($result4);
																				echo $row4['spfriendChattingMessage'];
																				
						$dt = $row4['spMessageDate']; 
						//echo $dt;
						date_default_timezone_set('Asia/kolkata'); 
		$new_time = date("d M Y h:i:s", strtotime("{$dt} + 7 hours"));
																			}
																		?>
																	</td>
             <td style="width: 180px;"><?php echo $new_time; ?></td>
																</tr>
                                                                <?php
																}
																
															}
															}else{
															//  echo "<center>No Record Found</center>";
														}
														//echo "===yha main sender ho===";
														$bb = array();
														$result2 = $unread->totalUnreadSender($_SESSION["pid"]);
														//echo $unread->ta->sql;
														if($result2 != false){
															// print_r(mysqli_fetch_assoc($result2));
															// exit;
															while ($row2 = mysqli_fetch_assoc($result2)) {
																array_push($bb, $row2["spprofiles_idspProfilesReciver"]);
																$rr = in_array($row2["spprofiles_idspProfilesReciver"], $aa, true);
																
																$senderPidd     = $row2["spprofiles_idspProfilesSender"]; //My
																$receiverPidd   = $row2["spprofiles_idspProfilesReciver"]; //Friend
																$total = 0;
																//echo $
																$unres = $unread->unreadmessage($senderPidd, $receiverPidd);
																//echo $unread->ta->sql."<br>";
																if ($unres != false) {
																	$total = $unres->num_rows;
																}
																if ($rr == "") {
																	
																	$groupid = 0;
																	$groupname = "";
																	
																	$rslt = $g->friendprofile($_SESSION["uid"], $row2["spprofiles_idspProfilesReciver"]);
																	if ($rslt != false) {
																		$rws = mysqli_fetch_assoc($rslt);
																		$groupid = $rws["idspGroup"];
																		$groupname = $rws["spGroupName"];
																		$groupname = str_replace(' ', '', $groupname);
																	}
																	
																	$result3 = $p->read($row2["spprofiles_idspProfilesReciver"]);
																	if ($result3 != false) {//All friend details
																		$row = mysqli_fetch_assoc($result3);
																	?>
                                                                    <tr class="chat-row">
                                                                        <td>
                                                                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Delete" class="hidden" ><i class="fa fa-trash"></i></a>
																		</td>
                                                                        <td>
                                                                            <?php
																				echo " <a href='javascript:void(0)' class='friendchat myfriends " . ($groupid != 0 ? "groupfriend" : "notgroup") . " " . $groupname . "' data-friendname='" . $row["spProfileName"] . "' data-frndicon='" . $row["spprofiletypeicon"] . "'  data-friendid='" . $row["idspProfiles"] . "' data-groupid='" . $groupid . "' data-myid='".$senderPidd."'> 
																				<img  alt='profile-Pic' class='img-responsive chat_img' id='".$row["idspProfiles"]."' style='display:inline;margin-right: 5px;width:30px; height: 30px;' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../assets/images/blank-img/default-profile.png") . "' ><span class='frndname'>" . ucwords(strtolower($row["spProfileName"])) . "</span> </a>";
																				
																			?>
																		</td>
                                                                        <td>
                                                                            <?php
																				// GET LAST MSG AND DATE OF THAT USER
																				$result4 = $unread->lastmsg($_SESSION['pid'],$row2["spprofiles_idspProfilesReciver"] );
																				if ($result4) {
																					$row4 = mysqli_fetch_assoc($result4);
																					echo $row4['spfriendChattingMessage'];
																					date_default_timezone_set('Asia/Kolkata'); 
																					$dt = new DateTime($row4['spMessageDate']); 
																				}
																			?>
																		</td>
                                                                        <td style="width: 180px;"><?php echo $dt->format('d M Y h:i:s'); ?></td>
																	</tr>
                                                                    <?php
																		
																	}
																}
																
															}
														}
													?>
												</tbody>                    
											</table>
										</div>
										
									</div>
								</div>
								
								
								<!-- load Chat -->
								<div class="chattingsystem" style="max-height: 650px;height: auto;position: relative;">
									<div class="show_loader"></div>
									<div class="friendchatsystem myfriend"><!--Dynamic Loading Message--> </div>
								</div>
								<!-- END -->
								
							</div>
						</div>
						
						
						<!-- <div id="sidebar_right" class="col-md-3 no-padding" style="left: auto" ></div> -->
						
						
						
					</div>
					<?php //include('../component/right-landing.php');?>
				</section>
	
				<script>
				$(document).ready(function(){
					$("#button1").click(function(){
						    setTimeout(function () {
                    $("#friendMessage").val("");
                 }, 1000);
					//var ab=	$("#friendMessage").val("");
					});
				});
				$("#button1").click(function(){
						    setTimeout(function () {
                    $("#txtReceiver").val('Select User');
                 }, 1000);
				});
				
				</script>
				<?php include('../component/footer.php');?>
				<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
				<?php include('../component/f_btm_script.php'); ?>  
				<script type="text/javascript">
					var pad_top_val = "15px";
					$(".chat_form").css("padding-top", pad_top_val);
					
					$(".chat-row").click(function() {
						window.scrollTo(2,document.body.scrollHeight);    
					});
					
				</script>
			</body>
		</html>
		<?php
		}
	?>		