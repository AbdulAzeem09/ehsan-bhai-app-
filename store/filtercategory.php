<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "my-groups/";
	include_once("../authentication/check.php");
} else {
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	?>
	<!DOCTYPE html>
	<html lang="en-US">

	<head>
		<?php include('../component/f_links.php'); ?>
		<?php include('store_headpart.php'); ?>	

		<script type="text/javascript">
			$(function() {
				$('#leftmenu').multiselect({
					includeSelectAllOption: true
				});

			});
		</script>
		<script>
			$(function() {
				$('#dynamic_select').on('change', function() {
					var url = "view-all.php?catName=" + $(this).val(); 
					if (url) { 
						window.location = url; 
					}
					return false;
				});

			});
		</script>
		<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
		<script>
			function execute(settings) {
				$('#sidebar').hcSticky(settings);
			}
			jQuery(document).ready(function($) {
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
			jQuery(document).ready(function($) {
				if (top === self) {
					execute_right({
						top: 20,
						bottom: 50
					});
				}
			});

			$(function() {
				$("#dynamic_price").on('change', function() {

					$("#price_form").submit();
					return true;


				});

			});
		</script>


		
		<style type="text/css">

.featured_box h4 
		{
			background-color: #fff!important;
		}
			.timeline-topstatus.right_sidebar {
				padding-top: 20px;
			}

			#slider-distance {
				width: 100% !important;
			}

			#profileDropDown li.active {
				background-color: #0f8f46;
			}

			#profileDropDown li.active a {
				color: white;
			}
			.form-select {
        font-size:1.5rem!important;
    }
    .form-control {
        font-size:1.5rem!important;
    }
    .inner_top_form button{
	padding: 8.9px 12px !important;
    }

		</style>
	</head>

	<body class="bg_gray">
		<?php
		$header_store = "header_store";
		include_once("../header.php");
		?>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="leftsidebar">
				<div class="custom-menu">
					<button type="button" id="leftsidebarCollapse" class="btn btn-primary">
						<i class="fa fa-bars"></i>
						<span class="sr-only">Toggle Menu</span>
					</button>
				</div>
				<div class="p-4">
					<h1>Categories</h1>                
					<?php include('../component/left-storecategory.php'); ?>
				</div>
			</nav>
			<!-- Page Content  -->
			<div id="rightcontent" class="p-4 p-md-5 pt-5">
				<section class="main_box">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<?php
								include('top-dashboard.php');
								?>
								<div class="breadcrumb_box m_btm_10 rounded shadow">
									<div class="row d-flex justify-conent-between">
										<div class="col-md-8">
											<form method="POST" action="">
												<div class="input-group" >
													<input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore'])) ? $_GET['mystore'] : '1' ?>">
													<input type="text" class="form-control" name="txtStoreSearch" value="<?php echo isset($_POST['txtStoreSearch']) ? $_POST['txtStoreSearch'] : ''; ?>" placeholder="Search For Products" />
													<button type="submit" class="btn btn-primary" name="btnSearchStore"><i class="fa fa-search" aria-hidden="true"></i></button>
												</div>
											</form>
										</div>
<!-- comment stat filter  -->

										<!-- <div class="col-md-4">
											<form id="price_form" method="POST" action="">
												<div class="d-flex">
													<select class="form-select" id="dynamic_price" name="pricedropdown">
														<option value="">Select Price Order</option>
														<option value="Asc" <?php if ($_POST["pricedropdown"] == 'Asc') echo "selected"; ?>>Asc</option>
														<option value="Desc" <?php if ($_POST["pricedropdown"] == 'Desc') echo "selected"; ?>>Desc</option>
													</select>
												</div>
											</form>
<!--    <div class="" style="display: inline">
<select class="form-control pull-right no-radius" id="dynamic_select" style="width: 150px;">
<?php
$pr = new _spprofilehasprofile;
$p = new _postfield;
$m = new _subcategory;

if (isset($_GET['catName'])) {
$selectValue = str_replace('_', ' ', $_GET['catName']);
$SelectTitle = str_replace('-', '&', $selectValue);
}


$catid = 1;
$result = $m->read($catid);
if ($result) {
while ($rows = mysqli_fetch_assoc($result)) {
?>
<option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php echo (isset($SelectTitle) && $SelectTitle == $rows['subCategoryTitle']) ? 'selected' : ''; ?> ><?php echo $rows["subCategoryTitle"]; ?></option>
<?php

}
}
?>
</select>




</div> 

</div> -->
<!-- comment stat filter  -->
</div>

</div>


<div class="row no-margin ">


	<?php
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$au = new _productposting;
	$p = new _postingview;
	if (isset($_GET['friend']) && $_GET['friend'] > 0) {
		$result3 = $p->singlefriendstore($_GET['friend']);
	}
	if (isset($_POST['txtStoreSearch'])) {

		$txtSearchCategory  = $_POST['txtSearchCategory'];
		$txtStoreSearch   = $_POST['txtStoreSearch'];
		$result3 = $au->search_personal(1, $txtStoreSearch);
	} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {

		$result3 = $au->readDESCretailsort_p(1, $_SESSION['pid']);


	} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {

		$result3 = $au->readASCretailsort_p(1, $_SESSION['pid']);


	} else if (isset($_GET['type']) && $_GET['type'] !=  '') {

		$result3 = $au->auction($_GET['type'], $_SESSION['uid'], $_SESSION['pid']);
	} else if (isset($_GET['condition']) && $_GET['condition'] !=  '') {

		if ($_GET['folder'] ==  'retail') {

			if (isset($_POST['btnPriceRange'])) {
				$txtStartPrice = $_POST['txtStartPrice'];
				$txtEndPrice = $_POST['txtEndPrice'];
				$exp = date('Y-m-d h:i:s');
				if ($_GET['condition'] == 'All') {
					$result3 = $au->myretailall_store_prange($txtStartPrice, $txtEndPrice, $exp);
					if ($result3 != '') {
						$num_rows = $result3->num_rows;
					}
				} else {

					$result3 = $au->myretail_store_prange($_GET['condition'], $txtStartPrice, $txtEndPrice, $exp);
					if ($result3 != '') {
						$num_rows = $result3->num_rows;
					}
				}



			} else if ($_GET['condition'] == 'All') {

				if ($_GET['page'] == 1) {
					$start = 0;
				} else {
					$sss = $_GET['page'] - 1;
					$start = 10 * $sss;
				}

				$limitaa = 10;
				$r3 = $au->allretailproductnumrows(1, $_SESSION['pid']);
				if ($r3 != '') {
				}

				$result3 = $au->allretailproduct(1, $_SESSION['pid'], $start, $limitaa);
				if ($result3 != '') {
					$num_rows = $result3->num_rows;
				}
			} else if ($_GET['condition'] == 'New') {


				$result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'], $_SESSION['pid']);
				if ($result3 != '') {
					$num_rows = $result3->num_rows;
				}

			} else if ($_GET['condition'] == 'Has Defect') {
				$condit = 'Used and has Defect';
				$result3 = $au->readitemcondtion_product($_GET['folder'], $condit, $_SESSION['pid']);
				if ($result3 != '') {
					$num_rows = $result3->num_rows;
				}
			} else if ($_GET['condition'] == 'Antique') {
				$result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'], $_SESSION['pid']);
				if ($result3 != '') {
					$num_rows = $result3->num_rows;
				}

			} else if ($_GET['condition'] == 'Unused') {
				$result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'], $_SESSION['pid']);
				if ($result3 != '') {
					$num_rows = $result3->num_rows;
				}
			} else if ($_GET['condition'] == 'Old') {
				$result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'], $_SESSION['pid']);
				if ($result3 != '') {
					$num_rows = $result3->num_rows;
				}

			}
		} else if ($_GET['folder'] == 'store') {

			if (isset($_POST['btnPriceRange'])) {
				$txtStartPrice = $_POST['txtStartPrice'];
				$txtEndPrice = $_POST['txtEndPrice'];
				$exp = date('Y-m-d h:i:s');
				if ($_GET['condition'] == 'All') {
					$result3 = $au->myauctionall_store_prange($txtStartPrice, $txtEndPrice, $exp);
				} else {
					$result3 = $au->myauction_store_prange($_GET['condition'], $txtStartPrice, $txtEndPrice, $exp);
				}



			} else if ($_GET['condition'] == 'All') {
				$result3 = $p->publicpost_all();
			} else if ($_GET['condition'] == 'New') {
				$result3 = $au->readitemcondtion_storeproduct($_GET['condition']);

			} else if ($_GET['condition'] == 'Has Defect') {
				$result3 = $au->readitemcondtion_storeproduct($_GET['condition']);

			} else if ($_GET['condition'] == 'Antique') {
				$result3 = $au->readitemcondtion_storeproduct($_GET['condition']);

			} else if ($_GET['condition'] == 'Unused') {
				$result3 = $au->readitemcondtion_storeproduct($_GET['condition']);

			} else if ($_GET['condition'] == 'Old') {
				$result3 = $au->readitemcondtion_storeproduct($_GET['condition']);

			}
		}
	} else if (isset($_GET['mod']) && $_GET['mod'] !=  '') {
		if ($_GET['mod'] == 'retail') {
			$result3 = $p->retailpost(1);
		} else if ($_GET['mod'] == 'wholesale') {
			$result3 = $p->allwholesellpost();
		} else if ($_GET['mod'] == 'manufacturer') {
			$result3 = $p->manufacturePost();
		} else if ($_GET['mod'] == 'distributor') {
			$result3 = $p->distributorPost();
		} else if ($_GET['mod'] == 'personal') {
			$result3 = $p->personalSalePost();
		}
	} else {
		if (isset($_GET['friendlevel']) && $_GET['friendlevel'] > 0) {

			if ($_GET['friendlevel'] == 1) {
				$result5 = $pr->frndLevelone($_SESSION['pid']);
				$levelpass = "1st Degree";
			} else if ($_GET['friendlevel'] == 2) {
				$result5 = $pr->frndLevelScnd($_SESSION['pid']);
				$levelpass = "2nd Degree";
			} else if ($_GET['friendlevel'] == 3) {
				$result5 = $pr->frndLevelThird($_SESSION['pid']);
				$levelpass = "3rd Degree";
			}

			if ($result5) {
				foreach ($result5 as $key => $value5) {
					if ($_SESSION['pid'] != $value5) {
						friendlevel($value5, $BaseUrl, $folder, $levelpass);
					}
				}
			}
		} else if (isset($_GET['mystore']) && $_GET['mystore'] == 6) {
			if (isset($_GET['catName'])) {
				$result3 = $p->single_my_post($SelectTitle, $_SESSION['uid']);
			} else if (isset($_GET['orderby'])) {
				$result3 = $p->myall_store_order_by($_SESSION['uid'], $_GET['orderby']);
			} else if (isset($_GET['condition'])) {
				$result3 = $p->myall_store_condition($_SESSION['uid'], $_GET['condition']);
			} else if (isset($_POST['btnPriceRange'])) {
				$txtStartPrice = $_POST['txtStartPrice'];
				$txtEndPrice = $_POST['txtEndPrice'];

				$result3 = $p->myall_store_prange($_SESSION['uid'], $txtStartPrice, $txtEndPrice);
			} else if (isset($_GET['country'])) {
				$result3 = $p->myall_store_country($_SESSION['uid'], $_GET['country']);
			} else {
				$result3 = $p->myall_store($_SESSION['uid']);
			}
		} else if (isset($_GET["mystore"]) && $_GET["mystore"] == 4) {
			if (isset($_GET['catName'])) {
				$result3 = $p->single_store_friends_Posting($SelectTitle, $_SESSION['uid']);
			} else if (isset($_GET['orderby'])) {
				$result3 = $p->store_friends_Posting_order_by($_SESSION['uid'], $_GET['orderby']);
			} else if (isset($_GET['condition'])) {
				$result3 = $p->store_friends_Posting_condition($_SESSION['uid'], $_GET['condition']);
			} else if (isset($_POST['btnPriceRange'])) {
				$txtStartPrice = $_POST['txtStartPrice'];
				$txtEndPrice = $_POST['txtEndPrice'];

				$result3 = $p->store_friends_Posting_prange($_SESSION['uid'], $txtStartPrice, $txtEndPrice);
			} else if (isset($_GET['country'])) {
				$result3 = $p->store_friends_Posting_country($_SESSION['uid'], $_GET['country']);
			} else {
				$result3 = $p->store_friends_Posting($_SESSION['uid']);
			}
		} else if (isset($_GET['mystore']) && $_GET['mystore'] == 5) {
			if (isset($_GET['catName'])) {
				$result3 = $p->single_group_main_Posting($SelectTitle, $_SESSION['pid']);
			} else if (isset($_GET['orderby'])) {
				$result3 = $p->all_group_store_order_by($_SESSION['pid'], $_GET['orderby']);
			} else if (isset($_GET['condition'])) {
				$result3 = $p->all_group_store_condition($_SESSION['pid'], $_GET['condition']);
			} else if (isset($_POST['btnPriceRange'])) {
				$txtStartPrice = $_POST['txtStartPrice'];
				$txtEndPrice = $_POST['txtEndPrice'];

				$result3 = $p->all_group_store_prange($_SESSION['pid'], $txtStartPrice, $txtEndPrice);
			} else if (isset($_GET['country'])) {
				$result3 = $p->all_group_store_country($_SESSION['pid'], $_GET['country']);
			} else {
				$result3 = $p->all_group_store($_SESSION['pid']);
			}
		} else if (isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2) {
			if (isset($_GET['catName'])) {
				$result3 = $p->single_retail_store($SelectTitle);
			} else if (isset($_GET['orderby'])) {
				$result3 = $p->retailpost_order_by($_GET['orderby']);
			} else if (isset($_GET['condition'])) {
				$result3 = $p->retailpost_condition($_GET['condition']);
			} else if (isset($_POST['btnPriceRange'])) {
				$txtStartPrice = $_POST['txtStartPrice'];
				$txtEndPrice = $_POST['txtEndPrice'];

				$result3 = $p->retailpost_prange($txtStartPrice, $txtEndPrice);
			} else if (isset($_GET['country'])) {
				$result3 = $p->retailpost_country($_GET['country']);
			} else {
				$result3 = $p->retailpost(1);
			}
		} else {
			if (isset($_GET['catName'])) {
				$result3 = $p->single_publicpost($SelectTitle);
			} else if (isset($_GET['orderby'])) {
				$result3 = $p->publicpost_price($_GET['orderby']);
			} else if (isset($_GET['condition'])) {
				$result3 = $p->publicpost_condition($_GET['condition']);
			} else if (isset($_POST['btnPriceRange'])) {
				$txtStartPrice = $_POST['txtStartPrice'];
				$txtEndPrice = $_POST['txtEndPrice'];

				$result3 = $p->publicpost_prange($txtStartPrice, $txtEndPrice);
			} else if (isset($_GET['country'])) {
				$result3 = $p->publicpost_country($_GET['country']);
			} else {

				$filterid = $id;
				$result3 = $p->personal_allfilter($filterid);
			}
		}
	}



	?>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active" style="font-size: large;" aria-current="page"><b><?php echo $id ;?> PRODUCTS</b></li>
		</ol>
	</nav>
	<div class="heading03">
		<h3><?php
		$userid = $_SESSION['uid'];
		$c = new _orderSuccess;


		$currency = $c->readcurrency($userid);

		$res1 = mysqli_fetch_assoc($currency);




		if (isset($_GET['catName'])) {

			echo $SelectTitle;
		} else if (isset($_GET['friendlevel'])) {
			if ($_GET['friendlevel'] == 1) {
				echo "1st Level Friends Products";
			} else if ($_GET['friendlevel'] == 2) {
				echo "2nd Level Friends Products";
			} else if ($_GET['friendlevel'] == 3) {
				echo "3rd Level Friends Products";
			} else {

				header('location:' . $BaseUrl . '/' . $folder);
			}
		} else {

			$aa = $result3->num_rows;
			if (isset($_POST['txtStoreSearch']) && $_POST['txtStoreSearch'] != '') {

				echo $result3->num_rows . " results found for " . $_POST['txtStoreSearch'];
			} else {

				if ($account_status == 1) {
					if ($aa) {
						echo $aa . " results found";
					}
				} else {


				}
			}
		}

	?></h3>
</div>
<?php
if ($result3) {

	$auction_store = $result3->num_rows;
	?>
	<div class="item">
		<?php
		$active = 0;
		while ($row3 = mysqli_fetch_assoc($result3)) {
			if ($row3['spuser_idspuser'] != NULL) {
				$st = new _spuser;
				$st1 = $st->readdatabybuyerid($row3['spuser_idspuser']);
				if ($st1 != false) {
					$stt = mysqli_fetch_assoc($st1);
					$account_status = $stt['deactivate_status'];
				}

			}
			$price = $row3['spPostingPrice'];
			$default_currency = $row3['default_currency'];
			if ($row3['sellType'] == 'Personal') {
				if ($row3['retailQuantity'] != '') {
					$discount   = $row3['retailQuantity'];
				} else {
					$discount   = $row3['retailQuantity'];
				}
			}
			if ($row3['sellType'] == 'Wholesaler') {
				$discount   = $row3['spPostingPrice'];
			}
			$spec_dis = (((int)$price * (int)$discount) / 100);
			$disc_price = $price - $spec_dis;
			$dt = new DateTime($row3['spPostingDate']);

			?>
			 <div class="item <?php echo ($active >= 15) ? 'seeproduct' : ''; ?>"> 
				<?php if ($account_status != 1) { ?>
					<div class="col-xs-5ths col-md-4">
						<div class="featured_box subcategory_box1">
							<div class="img_fe_box">
								<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $row3['idspPostings']; ?>">
									<?php
									$pic = new _productpic;
									$result4 = $pic->read($row3['idspPostings']);
									if ($row3['spCategories_idspCategory'] != 5 && $row3['spCategories_idspCategory'] != 2) {
										if ($result4 != false) {
											if (mysqli_num_rows($result4) > 0) {
												$rp = mysqli_fetch_assoc($result4);
												$picture = $rp['spPostingPic'];
												echo "<img alt='Posting Pic' class='img-fluid' src=' " . ($picture) . "' > ";
											}
										} else {
											echo "<img alt='Posting Pic' src='../img/no.png' class='img-fluid'>";
										}
									} else {
										echo "<img alt='Posting Pic' src='../img/no.png' class='img-fluid'>";
									}
									?>
								</a>
							</div>
							<ul>
								<li>
									<?php
									if ($_SESSION['pid'] != $rows['idspProfiles']) {

										$result6 = $pr->frndLeevel($_SESSION['pid'], $row3['idspProfiles']);

										if ($result6 == 0) {
											$level = '1st Degree';
										} else if ($result6 == 1) {
											$level = '1st Degree';
										} else if ($result6 == 2) {
											$level = '2nd Degree';
										} else if ($result6 == 3) {
											$level = '3rd Degree';
										} else {
											$level = 'Not Defined';
										}
									} else {
										$level = '1st Degree';
									}

									 ?>
								</li>


                                 <li>

								 <?php

if (!empty($row3['spPostingTitle'])) {
	if (strlen($row3['spPostingTitle']) < 10) {
		?><h4><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $row3['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucfirst($row3['spPostingTitle']); ?></a></h4><?php

	} else {
		?><h4><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $row3['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucfirst(substr($row3['spPostingTitle'], 0, 15) . '...'); ?></a></h4><?php
	}
} else {
}




                                    ?>




								</li>




								<li>
									<h5 style="float: left;font-size:14px">

										<?php
										$curr = $row3['default_currency'];
										$price = $row3['spPostingPrice'];
										if ($row3['spPostingPrice'] != '') {

											$curr = $row3['default_currency'];
											$price = $row3['spPostingPrice'];
											$discount   = $row3['retailSpecDiscount'];

											if ($row3['sellType'] == 'personal') {
												if ($row3['retailSpecDiscount'] != '') {
													$discount   = $row3['retailSpecDiscount'];
												} else {
													$discount   = $row3['spPostingPrice'];
												}
											}
											echo $row3['sellType'];

										}

										?>


									</h5>
								</li>

								<p class="date"></p>

								<input type="hidden" id="auctionexpid<?php echo $row3['idspPostings'] ?>" value="<?php echo $row3['idspPostings'] ?>">

								<input type="hidden" id="auctionexp<?php echo $row3['idspPostings'] ?>" value="<?php echo $row3['spPostingExpDt'] ?>">

								<script type="text/javascript">
									$(document).ready(function() {
										get_auctionexpdata("<?php echo $row3['idspPostings']; ?>");


									});
								</script>


								<?php
								if ($_GET['folder'] == "retail") {
									if ($row3['retailQuantity'] > 0) { ?>

										<span style="color:green"><b>Available</b></span>

									<?php } else {  ?>
										<span style="color:red"><b>Out Of Stock</b></span>
									<?php }
								} ?>

							</ul>

						</div>
					</div>

				<?php }				
			} 
			?>
		</div>
	</div><br>
	<div class="row">
		<?php if ($_GET['page'] != "1") { ?>
			<!-- <a class="float-start btn btn-primary " style="width: 50px" href="<?php echo $BaseUrl . '/retail/view-all.php?condition=All&folder=retail&page=' . $_GET['page'] - 1; ?>">Previous</a> -->
		<?php  } ?>


		<?php if ($num_rows == "10") { ?>
			<a class="float-end  btn btn-primary" style="width: 50px" href="<?php echo $BaseUrl . '/retail/view-all.php?condition=All&folder=retail&page=' . $_GET['page'] + 1; ?>">Next</a>
		<?php  } ?>
		<?php
	} else {
		echo "<h4 class='text-center'>No Record Found</h4>";
	} ?>
</div>

</div>
</div>
</div>
</section>
</div>
</div>



<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!--Javascript-->
<!-- <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-3.2.1.slim.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script>
    (function ($) {
        "use strict";
        var fullHeight = function () {
            $(".js-fullheight").css("height", $(window).height());
            $(window).resize(function () {
                $(".js-fullheight").css("height", $(window).height());
            });
        };
        fullHeight();
        $("#leftsidebarCollapse").on("click", function () {
            $("#leftsidebar").toggleClass("active");
        });
    })(jQuery);
</script>
<script type="text/javascript">
	$(document).ready(function() {


	});
</script>


<script type="text/javascript">
	function get_auctionexpdata(id) {
		var auction_exp = $("#auctionexp" + id).val()



		var countDownDate = new Date(auction_exp).getTime();


		var x = setInterval(function() {


			var now = new Date().getTime();

// Find the distance between now and the count down date
			var distance = countDownDate - now;


// Time calculations for days, hours, minutes and seconds
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);



			if (days > 0 && hours > 0 && minutes > 0 && seconds > 0) {

				document.getElementById("auction_enddate" + id).innerHTML = days + "d " + hours + "h " +
				minutes + "m " + seconds + "s ";

				document.getElementById("oldbidtime").innerHTML = days + "d " + hours + "h " +
				minutes + "m " + seconds + "s ";

				document.getElementById("lowbidtime").innerHTML = days + "d " + hours + "h " +
				minutes + "m " + seconds + "s ";

			} else if (days <= 0 && hours > 0 && minutes > 0 && seconds > 0) {

				document.getElementById("auction_enddate" + id).innerHTML = hours + "h " +
				minutes + "m " + seconds + "s ";

				document.getElementById("oldbidtime").innerHTML = hours + "h " +
				minutes + "m " + seconds + "s ";

				document.getElementById("lowbidtime").innerHTML = hours + "h " +
				minutes + "m " + seconds + "s ";

			} else if (days <= 0 && hours <= 0 && minutes > 0 && seconds > 0) {

				document.getElementById("auction_enddate" + id).innerHTML = minutes + "m " + seconds + "s ";

				document.getElementById("oldbidtime").innerHTML = minutes + "m " + seconds + "s ";

				document.getElementById("lowbidtime").innerHTML = minutes + "m " + seconds + "s ";

			} else if (days <= 0 && hours <= 0 && minutes <= 0 && seconds > 0) {

				document.getElementById("auction_enddate" + id).innerHTML = seconds + "s ";

				document.getElementById("oldbidtime").innerHTML = seconds + "s ";

				document.getElementById("lowbidtime").innerHTML = seconds + "s ";

			}

// Output the result in an element with id="demo"



			if (days == 0 && hours == 0 && minutes <= 5) {

				$('#auction_end').show();
				$('#AuctionPrice').hide();
				$('.placebidAuction').hide();
				$('#bidmsg').hide();
			}
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("auction_enddate" + id).innerHTML = "EXPIRED";
			}
		}, 1000);





	}
</script>

</body>

</html>
<?php
}
?>
