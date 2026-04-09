<?php

/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include('../univ/baseurl.php');
include("../univ/main.php");
session_start();
$dbConn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}

if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "my-groups/";
	include_once("../authentication/check.php");
} else {
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$u = new _spuser;
    $pr = new _spprofiles;
    $result = $pr->read($_SESSION["pid"]);
    if ($result != false) {
        $sprows = mysqli_fetch_assoc($result);
        $address = htmlspecialchars($sprows['address'] ?? "");
        $zipcode = htmlspecialchars($sprows['spUserzipcode'] ?? "");
        $country = htmlspecialchars($sprows['spProfilesCountry'] ?? "");
        $state = htmlspecialchars($sprows['spProfilesState'] ?? "");
        $city = $profileCity = htmlspecialchars($sprows["spProfilesCity"] ?? "");
    }else{
        $res = $u->read($_SESSION["uid"]);
        if ($res !== false) {
            $row = mysqli_fetch_assoc($res);
            $address = htmlspecialchars($row['spUserAddress'] ?? "");
            $zipcode = htmlspecialchars($row['spUserzipcode'] ?? "");
            $country = htmlspecialchars($row['spUserCountry'] ?? "");
            $state = htmlspecialchars($row['spUserState'] ?? "");
            $city = $profileCity = htmlspecialchars($row['spUserCity'] ?? "");
        }
    }
	
	include_once("../views/common/header.php"); 
?>

	<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
	<?php include('../component/f_links.php'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/group.css">

	<!--This script for sticky left and right sidebar STart-->
	<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
	<script>
		function execute(settings) {
			if($('#sidebar').length > 0 ){
				$('#sidebar').hcSticky(settings);
			}
		}
		// if page called directly
		jQuery(document).ready(function($) {
			if (top === self) {
				execute({
					top: 20,
					bottom: 50
				});
			}
		});

		function execute_right(settings) {
			if($('#sidebar_right').length > 0 ){
				$('#sidebar_right').hcSticky(settings);
			}
		}
		// if page called directly
		jQuery(document).ready(function($) {
			if (top === self) {
				execute_right({
					top: 20,
					bottom: 50
				});
			}
		});
	</script>

	<?php
	$p = new _spprofiles;
	$rp = $p->readProfiles($_SESSION['uid']);
	$pid = $_SESSION["pid"];
	$txtSearch = $_GET['txtSearch'] ?? "";
	$groupStatus = $_GET['group'] ?? "";
	$groupStatus2 = $_GET['status'] ?? "";
	?>
	<input type="hidden" name="pid" class="pid" id="pid" value="<?php echo $pid; ?>">
	<div class="body-wrapper">
		<div class="group-wrapper">
			<div class="side-bar" id="side-bar">
				<?php include('../component/left-landing.php'); ?>
			</div>
			<div class="groups-wrapper">
				<div class="main-heading">
					Search Groups
					<div class="menu-icon">
						<img src="./images/menu-icon.svg" alt="">
					</div>
				</div>
				<?php 
					$searchFilterEnabled = true;
					include('./group-common-tabs.php');
				?>
			</div>
		</div>

		<div class="modal" id="add-group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="staticBackdropLabel">CREATE GROUP</h1>
						</div>

						<div class="modal-body">
							<form action="">
								<div class="input-group in-1-col">
									<label>Group Name <span style="font-weight: normal;">(max 50 characters)</span></label>
									<input type="text" id="spGroupName" name="spGroupName" onkeyup="clearerror('name');" maxlength="50" placeholder="Enter Group Name" required>
									<span id="title_error" class="red"></span>
								</div>

								<div class="input-group in-1-col">
									<label>Category</label>
									<select class="form-control bradius-10" onclick="clearerror('category');" id="grpcategory" name="spgroupCategory" required>
										<option value="">Select Category </option>
										<?php
										$sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ORDER BY group_category_name asc";
										$result = mysqli_query($dbConn, $sql);
										while ($rows = mysqli_fetch_assoc($result)) {
										?>
											<option value='<?php echo $rows["id"]; ?>'><?php echo $rows["group_category_name"]; ?></option>
										<?php
										}
										?>
									</select>
									<span id="cat_error" class="red"></span>

								</div>

								<div class="d-none">
                                    <input type="hidden" id="address" name="address" value="<?php echo $address; ?>">
                                    <input type="hidden" id="shipp_zipcode" value="<?php echo $zipcode; ?>">
                                    <input type="hidden" id="spUserCountry" name="spUserCountry" value="<?php echo $country; ?>">
                                    <input type="hidden" id="spUserState" name="spUserState" value="<?php echo $state; ?>">
                                    <input type="hidden" id="spUserCity" name="spUserCity" value="<?php echo $city; ?>">
                                </div>
								<div class="input-group in-1-col">

									<label>Select Privacy</label>
									<div class="public align-items-end">
										<div class="check-box">
											<label class="main-container mb-1"> Public
												<input checked type="radio" id="spgroupflag" onclick="clearerror('flag');" name="spgroupflag" class="privacy" value="0" required>
												<span class="checkmark"></span>
											</label>
										</div>
										<div class="check-box">
											<label class="main-container mb-1"> Private
												<input type="radio" id="spgroupflag" onclick="clearerror('flag');" name="spgroupflag" class="privacy" value="1" required>
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									<span id="flag_error" class="red "></span>
								</div>
								
								<div class="input-group in-1-col">
                                    <label>Status</label>
                                    <div class="public align-items-end">
                                        <div class="check-box">
                                            <label class="main-container mb-1"> Draft
                                                <input checked type="radio" id="grpstatus" onclick="clearerror('status');" name="status" class="privacy" value="draft" required>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="check-box">
                                            <label class="main-container mb-1"> Live
                                                <input type="radio" id="grpstatus" onclick="clearerror('status');" name="status" class="privacy" value="active" required>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

								<div class="input-group in-1-col">
									<label>Description</label>
									<textarea id="spGroupAbout" name="spGroupAbout" maxlength="500" placeholder="Type Description.." rows="4" cols="50" onkeyup="clearerror('About');"></textarea>
									<span id="des_error" class="red"></span>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" id="spgroupSubmit" class="btn btn-primary active">Create</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<script src="../grouptimelines/script.js"></script>
	<?php
		include_once("../views/common/footer.php");
		include('../component/f_btm_script.php');
	?>
</body>

</html>
<?php
} ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
<script src="<?php echo $BaseUrl; ?>/assets/emoji/vanillaEmojiPicker.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
<script type="text/javascript">
	var groupid = "<?php echo $GLOBALS['groupid'] ?? 0; ?>"; 
	var profid = "<?php echo $_SESSION['pid']; ?>";
</script>
<?php
	$js_files = [
		'/assets/js/posting/group-timeline.js',                 
	];

	foreach ($js_files as $jsf) {
		echo '<script src="'.$BaseUrl.$jsf.'?v='. $versions.'"></script>';
	}
?>  

<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script> -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js'></script>
<script>
	// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/
	var items = $(".list-wrapper .list-item");
	var numItems = items.length;
	var perPage = 6;
	items.slice(perPage).hide();
	if (perPage > numItems) {
		$('#pagination-container').hide();
	} else {
		$('#pagination-container').show();
	}

	$('#pagination-container').pagination({
		items: numItems,
		itemsOnPage: perPage,
		prevText: "&laquo;",
		nextText: "&raquo;",
		onPageClick: function(pageNumber) {
			var showFrom = perPage * (pageNumber - 1);
			var showTo = showFrom + perPage;
			items.hide().slice(showFrom, showTo).show();
		}
	});
	
    $(document).ready(function() {
    	$("#spgroupSubmit").click(function() {
			var name = $('#spGroupName').val();
			var category = $('#grpcategory').val();
			var privacy = $("input[name='spgroupflag']:checked").val();
			var des = $('#spGroupAbout').val();
			var country = $('#spUserCountry').val();
			var state = $('#spUserState').val();
			var city = $('#spUserCity').val();
			var zipcode = $('#shipp_zipcode').val();
			var address = $('#address').val();
			var profid = $('#pid').val();
			var status = $("input[name='status']:checked").val();

			if (name == '') {
				$('#title_error').html('Name is required');
				return false;
			}else if(name.length > 50){
				$('#title_error').html('Group Name length should be 50 characters.');
				return false;
			}else{
				$('#title_error').html('');		
			}
			
			if ((category == '') || (des == '') || (privacy == '')) {				
				if (category == '') {
					$('#cat_error').html('Category is required');
				} else {
					$('#cat_error').html('');
				}
				
				if (des == '') {
					$('#des_error').html('Description is required');
				} else {
					$('#des_error').html('');			
				}
			
				if (!privacy) {
					$('#flag_error').html('Privacy is required');
				} else {
					$('#flag_error').html('');
				}	
				return false;
			}
			
			var formData = new FormData();
			formData.append('spGroupName', name);
			formData.append('spgroupCategory', category);
			formData.append('spUserCountry', country);
			formData.append('spUserState', state);
			formData.append('spUserCity', city);
			formData.append('zipcode', zipcode);
			formData.append('spgroupflag', privacy);
			formData.append('spGroupAbout', des);	
			formData.append('spProfiles_idspProfiles', profid);
			formData.append('status', status);		
			$.ajax({
				type: "POST",
				url: '../post-ad/addgroup.php',
				data: formData,
				processData: false, // tell jQuery not to process the data
				contentType: false,
				success: function(response) {
					var res=response.trim();
					if(res == "limit_exceeds"){
						toastr.error('You can not publish more then 20 groups.'); 
						return false;
					}
					window.location.href ="<?php echo $BaseUrl;?>"+res;
				}
			});
    
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.group-navigation .link');
        const contentDivs = document.querySelectorAll('.group-list-wrapper');

        links.forEach((link, index) => {
            link.addEventListener('click', function () {
                // Remove active-link class from all links
                links.forEach(link => link.classList.remove('active-link'));

                // Add active-link class to the clicked link
                this.classList.add('active-link');

                // Hide all content divs
                contentDivs.forEach(div => div.classList.add('d-none'));

                // Show the content div corresponding to the clicked link
                contentDivs[index].classList.remove('d-none');
            });
        });
    });
</script>
<style>
    .modal-backdrop.show {
		display: none !important;
	}
</style>
<script type="text/javascript">
	function clearerror(type) {
		if (type === 'name') {
			$('#title_error').html('');			
		} 

		if (type === 'category') {
			$('#cat_error').html('');
			
		}  
		if (type === 'flag') {
			$('#flag_error').html('');		
		} 
		if (type === 'About') {
			$('#des_error').html('');			
		}
	}

  	document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('input[name="group"]');
        radios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                document.getElementById('groupForm').submit();
            });
        });
    });
</script>