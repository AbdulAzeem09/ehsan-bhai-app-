	<style>
		.swal2-popup {
	font-size:1.5rem!important;
}
		.deleteMember:hover, .deletefriend a:hover {

			color:#000!important;
		}
		
		.dropdown-menu li {
			
    border-right: none !important;
		}
	</style>



	</style>
	
	<div class="row no-margin findRealTimeSearch bradius-20">
		<!-- <div class="col-md-offset-4 col-md-8 no-padding"> -->
		<div class="col-md-12 no-padding">
			<form class="form-inline">
				<div class="form-group pull-right" style="width: 90%;">
					<label>Search:</label>
					<input type="text" name="" placeholder="Profile Name / Store Name / Profile Type" class="form-control no-radius bradius-20" id="searchtx" style="width: 84%" />
				</div>
			</form>
		</div>
	</div>

	<div class='row'>
		<div class='col-md-6'>
			<h4>Friends</h4>
		</div>
	</div>
	<hr class="underline" style="margin-top: 0px;">

	<?php
	$b = array();
	$r = new _spprofilehasprofile;
	$pv = new _postingview;
	//echo $_SESSION["uid"];
	$res = $r->readall($_SESSION["pid"]); //As a receiver
	//print_r($res);
	//echo $r->ta->sql;
	if ($res != false) {
		while ($rows = mysqli_fetch_assoc($res)) {
			$p = new _spprofiles;
			$sender = $rows["spProfiles_idspProfileSender"];
			array_push($b, $sender);

			$result = $p->read($rows["spProfiles_idspProfileSender"]);
			//echo $p->ta->sql;

			if ($result != false) {
				$row = mysqli_fetch_assoc($result);
				//print "<pre>"; print_r($row); print "<pre>";
				$totalFrnd = $r->countTotalFrnd($row['idspProfiles']);
				//get friend store
				$result3 = $pv->singlefriendstore($sender);
				if ($result3 != false) {
					if (mysqli_num_rows($result3) > 0) {
						$storeshow = mysqli_num_rows($result3);
					} else {
						$storeshow = 0;
					}
				} else {
					$storeshow = 0;
				}
	?>
				<div class="searchable deletefriend">
					<div class="row">
						<div class="col-md-7">
							<?php
							echo "<img  alt='profile-Pic' class='img-responsive' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../img/default-profile.png") . "'>";
							?>
							<a href='<?php echo $BaseUrl . "/friends/?profileid=" . $rows["spProfiles_idspProfileSender"]; ?>'><span class='searchtimelines title' data-profileid="<?php echo $row["idspProfiles"]; ?>"><?php echo ucwords($row["spProfileName"] . " (" . $row["spProfileTypeName"] . ")"); ?></span></a>
							<span class="totalfriend"><?php echo $totalFrnd; ?> Friends</span>

						</div>
						<div class="col-md-5 text-right">
							<?php
							if ($storeshow != 0) { ?>
								<span class="verticalline"><a href="<?php echo $BaseUrl . '/friend-store/single-friend.php?friend=' . $rows["spProfiles_idspProfileSender"]; ?>" class="btn">Visit Store (<?php echo $storeshow; ?> Products)</a></span> <?php
																																																														}
																																																															?>
							<div class="dropdown" style="display: inline">
								<button class="btn btn_more dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></button>
								<ul class="dropdown-menu">
									<?php
									$fv = new _spprofilefeature;
									$result4 = $fv->chkBlock($_SESSION['pid'], $row['idspProfiles']);
									if ($result4) {
										$block = 0;
									} else {
										$block = 1;
									}
									?>
									<li><a href="#" data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $row['idspProfiles']; ?>" data-sender="<?php echo $_SESSION['pid']; ?>" class="sendasms">Send Message</a></li>
									<li><a href="#" data-toggle="modal" data-target="#addToGroup" data-pid="<?php echo $row['idspProfiles']; ?>" class="addtogroup">Add to group</a></li>
									<li><a href="<?php echo $BaseUrl . '/friends/favourite.php?block=' . $block . '&by=' . $_SESSION['pid'] . '&to=' . $row['idspProfiles']; ?>"><?php echo ($block == 0) ? 'Unblock' : 'Block'; ?></a></li>
									<li class='verticalline sp-group-details'  style="text-align-last: left;"><a href='#' class='btn deleteMember' onlick=hello() data-profileid='<?php echo $rows["spProfiles_idspProfileSender"]; ?>'>Unfriend</a></li>


								

                                   </script>




									<!--<li><a href="#">Invite event</a></li>-->
								</ul>
							</div>
						</div>
					</div>
				</div>


				<?php
			}
		}
	}

	$r = new _spprofilehasprofile;
	$res = $r->readallfriend($_SESSION["pid"]); //As a sender
	//print_r($res);
	//echo $r->ta->sql;
	if ($res != false) {
		while ($rows = mysqli_fetch_assoc($res)) {

			$rm = in_array($rows["spProfiles_idspProfilesReceiver"], $b, true);
			if ($rm == "") {
				$p = new _spprofiles;
				$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
				if ($result != false) {
					$receive = $rows["spProfiles_idspProfilesReceiver"];

					$row = mysqli_fetch_assoc($result);
					$totalFrnd2 = $r->countTotalFrnd($row['idspProfiles']);

					//get friend store
					$result3 = $pv->singlefriendstore($receive);
					if ($result3 != false) {
						if (mysqli_num_rows($result3) > 0) {
							$storeshow = mysqli_num_rows($result3);
						} else {
							$storeshow = 0;
						}
					} else {
						$storeshow = 0;
					}
				?>
					<div class="searchable deletefriend ">
						<div class="row">
							<div class="col-md-7">
								<?php
								echo "<img  alt='profile-Pic' class='img-responsive' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../img/default-profile.png") . "'>";
								?>
								<a href='<?php echo $BaseUrl . "/friends/?profileid=" . $rows["spProfiles_idspProfilesReceiver"]; ?>'><span class='searchtimelines title' data-profileid="<?php echo $row["idspProfiles"]; ?>"><?php echo ucwords($row["spProfileName"] . " (" . $row["spProfileTypeName"] . ")"); ?></span></a>
								<span class="totalfriend"><?php echo $totalFrnd2 ?> Friends</span>
							</div>
							<div class="col-md-5 text-right">

								<?php
								if ($storeshow != 0) { ?>
									<span class="verticalline"><a href="<?php echo $BaseUrl . '/friend-store/single-friend.php?friend=' . $rows["spProfiles_idspProfilesReceiver"]; ?>" class="btn">Visit Store (<?php echo $storeshow; ?> Products)</a></span> <?php
																																																															}
																																																																?>

								<div class="dropdown" style="display: inline">
									<button class="btn btn_more dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></button>
									<ul class="dropdown-menu">
										<?php
										$fv = new _spprofilefeature;
										$result4 = $fv->chkBlock($_SESSION['pid'], $row['idspProfiles']);
										if ($result4) {
											$block = 0;
										} else {
											$block = 1;
										}
										?>

										<li><a href="#" data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $row['idspProfiles']; ?>" data-sender="<?php echo $_SESSION['pid']; ?>" class="sendasms">Send Message</a></li>
										<li><a href="#" data-toggle="modal" data-target="#addToGroup" data-pid="<?php echo $row['idspProfiles']; ?>" class="addtogroup">Add to group</a></li>
										<?php
										$link = $BaseUrl . '/friends/favourite.php?block=' . $block . '&by=' . $_SESSION['pid'] . '&to=' . $row['idspProfiles'];
										?>

										<li><a onclick="block('<?php echo $link; ?>')" data-link="<?php echo $BaseUrl . '/friends/favourite.php?block=' . $block . '&by=' . $_SESSION['pid'] . '&to=' . $row['idspProfiles']; ?>"><?php echo ($block == 0) ? 'Unblock' : 'Block'; ?></a></li>

										<?php $flag = -1; ?>
										<li> <a href='javascript:void(0)' id="sendrequest" style="text-align:left!important" data-flag="<?php echo $flag; ?>" data-profilename="<?php echo $row["spProfileName"]; ?>" data-sender="<?php echo $_SESSION["pid"]; ?>" class='btn sp-group-details' onclick="unfriend_frn('<?php echo $rows['spProfiles_idspProfilesReceiver'];  ?>')" data-reciver='<?php echo $rows["spProfiles_idspProfilesReceiver"];  ?>'><span class='verticalline deleteMember1' >Unfriend</span></a>
										</li>
										
										<!-- <li><a href="<?php echo $BaseUrl . '/events/'; ?>">Invite a event</a></li>-->
									</ul>
								</div>

							</div>
						</div>
					</div>
	<?php

				}
			}
		}
	} else {

		//echo "<h5 class='text-center'>No Record Found!</h5>";
	}
	?>
	<script src="https:<?php echo $baseurl?>/assets/js/sweetalert.js.0.19/dist/sweetalert2.all.min.js"></script>

	<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
	<script>
		$(document).ready(function() {

			$("#sendrequest").click(function(i, e) {
				//alert("jdfjdf");
				var btn = this;
				var senderId = $(this).data("sender");
				var reciverId = $(this).data("reciver");
				var profilename = $(this).data("profilename");
				var flag = $(this).data("flag");
				$.post('../friends/sendrequest.php', {
					sender: senderId,
					reciever: reciverId,
					profilename: profilename,
					flag: flag
				}, function(d) {

					window.location.reload();
				});
			});

			//Accept Friend Request
			$(".acceptReqOfUser").on("click", function() {
				$.post('../friends/accept.php', {
					sender: $(this).data("sender"),
					receiver: $(this).data("receiver")
				}, function(d) {
					location.reload();
				});
			});
		});
	</script>



	<script>
		function block(link) {

			Swal.fire({
				title: 'Are you sure?',
				text: "This person Will be blocked",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, block it!'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location = link;
				}
			})

		}
		function unfriend_frn(prid)
		{
             

			Swal.fire({
          title: 'Are you sure?',
        text: "You want to unfriend ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {

			$.ajax({
           type:"post",
        url: MAINURL + "/my-friend/unfriends.php",
        data: {id:prid},
success:function(shashi)
{
	location.reload();
 
}
		});
	}
});
	}


	</script>