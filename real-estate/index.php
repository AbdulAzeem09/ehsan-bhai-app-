<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
include('../univ/baseurl.php');
session_start();
//print_r($_SESSION);
// echo $_SESSION['pid'];
// exit;
if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "real-estate/";
	include_once("../authentication/check.php");
} else {
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");



	$f = new _spprofiles;
	$re = new _redirect;
//check profile is freelancer or not
	if ($_SESSION['guet_yes'] != "yes") {



		$chekIsBusiness = $f->readBusiness($_SESSION['pid']);
		if ($chekIsBusiness == false) {
			$_SESSION['count'] = 0;
			$_SESSION['msg'] = "Only  Professional, Business and Personal Profile can create an ad in this module. Please create or switch to any of the mentioned profiles.";
		}
	}


	$_GET["categoryID"] = "3";
	$_GET["categoryName"] = "Realestate";
	$header_realEstate = "realEstate";
	$home = true;

	?>


	<!DOCTYPE html>
	<html lang="en-US">

	<head>
		<?php include('../component/links.php'); ?>

		<!--This script for posting timeline data Start-->


		<!--This script for posting timeline data End-->

		<style type="text/css">
			.app {
				border: 1px solid black;
				margin-left: 5px;
				height: 175px;
				width: 19%;
				float: left;
				overflow: hidden;
			}


			.space1 {
				margin-top: 30px;
			}

			.realBox .boxHead {
				background-color: #95ba3d;
				padding: 5px 10px;
			}

			#indent {
				margin-top: 5px;
				float: left;
			}

			#profileDropDown li a {
				padding: 0px !important;
			}

			span#car1 {
				margin-top: 12px;
			}

			#profileDropDown li.active {
				background-color: #95ba3d !important;
			}

			#profileDropDown li.active a {
				color: #fff !important;
			}

			.inner_top_form input[type=text] {
				width: 52% !important;
			}
		</style>
	</head>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
<!-- <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script> -->
	<body class="bg_gray">
		<?php include_once("../header.php"); ?>
		<section class="main_box no-padding" id="art-page">
			<div class="RealEsmap">
				<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13931873.302173598!2d74.27075075!3d31.514923349999993!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1516348101457" frameborder="0" style="border:0" allowfullscreen></iframe>

				<p>
					<?php
					$p = new _postingview;
					$fieldName = 'All';
					$total = 0;
					$result = $p->countTotalPost($_GET["categoryID"], $fieldName);
//echo $p->ta->sql;
					if ($result != false) {
						if ($result->num_rows > 0) {
							echo $total = $result->num_rows;
						} else {
							echo $total = 0;
						}
					}
				?><br> <span>Global live events</span>
			</p>
		</div>
		<?php include('top-search.php'); ?>
		<div class="container">
			
			<div class="row">
				<div class="col-md-12">
					<div class="realTitle2 text-center">
						<h3><span>900+</span> Real Estate & Homes for Sale</h3>
						<!--<a href="<?php echo $BaseUrl . '/real-estate/all-property.php'; ?>">View all listings</a>-->
					</div>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-md-offset-2 col-md-8">			    
			    <input type="text" class="form-control" id="mainSearch" name="realEstateSearch" placeholder="Type a city or listing ID, or community to search" autocomplete="off" style="height:45px;">				
		    </div>		    
		    <!--<div class="col-md-1">
		      <button class="btn btn-light" type="submit" style="font-size:27px;margin-left:-27px;"><i class="fa fa-search"></i></button>
		    </div>-->		    
		  </div>		
			
			
			<div class="space-lg"></div>
			<div class="row">
				<?php

				$country=$_SESSION['spPostCountry'];
				$state=$_SESSION['spPostState'];
				$city=$_SESSION['spPostCity'];


				$p = new _realstateposting;
				$pf = new _postfield;
				$type = "Sell";

				$res = $p->showAllProperty($_GET["categoryID"], $type, $country, $state, $city);
				
//$res    = $p->publicpost_event($_GET["categoryID"]);
//echo $p->ta->sql;
//print_r($res);die("======fggggggggd======");
				$count = 0;
				if ($res != false) {
					$limit=$res->num_rows;
					while ($row = mysqli_fetch_assoc($res)) {

						if($count > 7){
							continue;
						}
						$count++ ;

//print_r($row);
						if ($row['spuser_idspuser'] != NULL) {
							$st = new _spuser;
							$st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
							if ($st1 != false) {
								$stt = mysqli_fetch_assoc($st1);


								$account_status = $stt['deactivate_status'];
							}
						}
						$pt = new _productposting;
						$postids = $row['idspPostings'];
						$flagcmd = $pt->flagcount(3, $postids);
						$flagnums = $flagcmd->num_rows;
						if ($flagnums == '9') {
							$updatestatus = $pt->realstatus($idposting);
						}
						$address = $row['spPostingAddress'];
						$bedroom = $row['spPostingBedroom'];
						$bathroom = $row['spPostingBathroom'];
						$sqrfoot = $row['spPostingSqurefoot'];
						$basement = $row['spPostBasement'];
						$propertyType = $row['spPostingPropertyType'];
						$price = $row['spPostingPrice'];

//posting fields
						$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
/*  if($result_pf){


while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($propertyType == ''){
if($row2['spPostFieldName'] == 'spPostingPropertyType_'){
$propertyType = $row2['spPostFieldValue'];
}
}
if($address == ''){
if($row2['spPostFieldName'] == 'spPostingAddress_'){
$address = $row2['spPostFieldValue'];
}
}
if($bedroom == ''){
if($row2['spPostFieldName'] == 'spPostingBedroom_'){
$bedroom = $row2['spPostFieldValue'];
}
}
if($bathroom == ''){
if($row2['spPostFieldName'] == 'spPostingBathroom_'){
$bathroom = $row2['spPostFieldValue'];
}
}
if($sqrfoot == ''){
if($row2['spPostFieldName'] == 'spPostingSqurefoot_'){
$sqrfoot = $row2['spPostFieldValue'];
}
}
if($basement == ''){
if($row2['spPostFieldName'] == 'spPostBasement_'){
$basement = $row2['spPostFieldValue'];
}
}

}

}*/
if ($account_status != 1) {

	?>
	<div class="col-md-3">
		<div class="realBox">
			<a href="<?php echo $BaseUrl . '/real-estate/property-detail.php?postid=' . $row['idspPostings']; ?>">
				<div class="boxHead">
					<h2 class="text1"><?php echo $row['spPostingTitle']; ?></h2>
					<p>
						<i class="fa fa-map-marker"></i>
						<?php
						if (strlen($address) < 30) {
							echo $address;
						} else {
							echo substr($address, 0, 30) . "...";
						}
						?>
					</p>
				</div>
				<?php
				$pic = new _realstatepic;

				$res2 = $pic->readFeature($row['idspPostings']);
				if ($res2 != false) {
					if ($res2->num_rows > 0) {
						if ($res2 != false) {
							$rp = mysqli_fetch_assoc($res2);


							$pic2 = $rp['spPostingPic'];
							echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
						}
					} else {
						$res2 = $pic->read($row['idspPostings']);
						if ($res2 != false) {
							$rp = mysqli_fetch_assoc($res2);
							$pic2 = $rp['spPostingPic'];
							echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
						}
					}
				} else {
					$res2 = $pic->read($row['idspPostings']);
					if ($res2 != false) {
						$rp = mysqli_fetch_assoc($res2);

						$pic2 = $rp['spPostingPic'];
						echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
					} else {
						echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>";
					}
				} ?>
				<div class="midLayer">
					<ul>
						<li title="Square Foot"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-1.png">  <?php echo ($sqrfoot > 0) ? ' '.$sqrfoot : 0; ?></li>
						<li title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-2.png"><?php echo ($bedroom > 0) ? ' '.$bedroom : ' 0'; ?></li>
						<li title="Bath Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-3.png"><?php echo ($bathroom > 0) ? ' '.$bathroom : ' 0'; ?></li>
						<li title="Basement" class="text-right"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-4.png"><?php echo ($basement > 0) ? $basement: ' 0'; ?></li>
					</ul>
				</div>
				<div class="boxFoot bg_white text-center">
					<p class="proType text1"><?php echo $propertyType; ?></p>
					<p class="text1"><span><?php echo $row['defaltcurrency'] . ' ' . (is_numeric($price) ? number_format($price) : ""); ?></span></p> 
				</div>
			</a>
		</div>
		</div> <?php }

	}
}
?>
</div>
<?php
if(false){ //not required anymore
	?>
	<center>
		<a href="<?php echo $BaseUrl;?>/real-estate/viewall.php" style="font-size:25px;">View All</a>
	</center>
	<?php
	
}
?>

<div class="space"></div>
</div>
</section>
<section class="realCountdown">
	<div class="container">
		<div class="row text-center">
			<div class="col-md-3">
				<h3>
					<?php

					$p = new _realstateposting;
//$valuerent = 'Rent A Room';
//$count = $p->readRoomRent($defcountry,$defstate,$defcity);
					$fieldName = 'Rent A Room';
					$count = $p->myRentRooms($_SESSION['spPostCity'], $_SESSION['spPostState'], $_SESSION['spPostCountry'],  $fieldName);

					if ($count != false) {

						echo $count->num_rows;
					} else {
						echo 0;
					}

/*if(empty($count)){
$CountrentRoom=0;
}
//print_r($count);
//die('-----');
else{
$CountrentRoom = mysqli_num_rows($count);
//echo ($CountrentRoom);
}

if($CountrentRoom){
//die('====');
echo $CountrentRoom;
}else{
echo 0;
}*/

?>
</h3>
<p>Rent a Room</p>
</div>
<div class="col-md-3">
	<h3>
		<?php
		$p = new _realstateposting;
//$valuerent = 'Rent A Room';
// $count2 = $p->readEntireRoomRent($defcountry,$defstate,$defcity);
//$countEntRoom = mysqli_num_rows($count2);
//$rentaroom = 0;
		$type2 = "Rent Entire Place";
		$count2 = $p->myAllRentEntire($_SESSION['spPostCity'], $_SESSION['spPostState'], $_SESSION['spPostCountry']);

		if ($count2 != false) {

			echo $count2->num_rows;
		} else {
			echo 0;
		}

		?>
	</h3>
	<p>Rent Entire Room</p>
</div>
<div class="col-md-3">
	<h3>
		<?php

		$p = new _realstateposting;
//$valuerent = 'Rent A Room';
		$count3 = $p->readSellProp($_SESSION['spPostState'], $_SESSION['spPostCountry'], $_SESSION['spPostCity']);
// $countSell = mysqli_num_rows($count3);

		if ($count3 != false) {
			echo $count3->num_rows;
		} else {
			echo 0;
		}

		?>
	</h3>
	<p>Sell Property</p>
</div>
<div class="col-md-3">
	<h3>
		<?php
		$p = new _realstateposting;
//$valuerent = 'Rent A Room';
		$count4 = $p->readOpenHouse($_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity']);
//$countOpenHouse = mysqli_num_rows($count4);

		if ($count4 != false) {
			echo $count4->num_rows;
		} else {
			echo 0;
		}

		?>
	</h3>
	<p>Open House</p>
</div>
</div>
</div>
</section>
<section class="lookingReal">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="realTitle3 text-center">
					<h3>What are you <span>looking</span> for?</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col app" style="padding-top: 6px;">
				<div class="lokingRealbox text-center">
					<a href="<?php echo $BaseUrl . '/real-estate/search.php?txtAddress=&spPostingPropertyType=Condo&pricefrom=&priceto=&spPostingBedroom=&spPostingBathroom=&Squrefootfrom=&Squrefootto=&spPostingTitle=&btnAdresSearch=Filter' ?>">
						<img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-5.png" class="img-responsive">
						<h2 style="text-transform: capitalize;">Condominium</h2>
						<!--<p>Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim donec vel lectus vel felis.</p>-->
					</a>
				</div>
			</div>
			<div class="col app" style="padding-top: 6px;">
				<div class="lokingRealbox text-center">
					<a href="<?php echo $BaseUrl . '/real-estate/search.php?txtAddress=&spPostingPropertyType=Detached+House&pricefrom=&priceto=&spPostingBedroom=&spPostingBathroom=&Squrefootfrom=&Squrefootto=&spPostingTitle=&btnAdresSearch=Filter' ?>">
						<img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-6.png" class="img-responsive">
						<h2 style="text-transform: capitalize;">Detached houses</h2>
						<!--<p>Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim donec vel lectus vel felis.</p>-->
					</a>
				</div>
			</div>
			<div class="col app" style="padding-top: 6px;">
				<div class="lokingRealbox text-center">
					<a href="<?php echo $BaseUrl . '/real-estate/search.php?txtAddress=&spPostingPropertyType=Duplex&pricefrom=&priceto=&spPostingBedroom=&spPostingBathroom=&Squrefootfrom=&Squrefootto=&spPostingTitle=&btnAdresSearch=Filter' ?>">
						<img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-7.png" class="img-responsive">
						<h2 style="text-transform: capitalize;">Duplexes</h2>
						<!--<p>Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim donec vel lectus vel felis.</p>-->
					</a>
				</div>
			</div>
			<div class="col app" style="padding-top: 6px;">
				<div class="lokingRealbox text-center">
					<a href="<?php echo $BaseUrl . '/real-estate/search.php?txtAddress=&spPostingPropertyType=Town+House&pricefrom=&priceto=&spPostingBedroom=&spPostingBathroom=&Squrefootfrom=&Squrefootto=&spPostingTitle=&btnAdresSearch=Filter' ?>">
						<img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-8.png" class="img-responsive">
						<h2 style="text-transform: capitalize;">Town Houses</h2>
						<!--<p>Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim donec vel lectus vel felis.</p>-->
					</a>
				</div>
			</div>
			<div class="col app" style="padding-top: 6px;">
				<div class="lokingRealbox text-center">
					<a href="<?php echo $BaseUrl . '/real-estate/search.php?txtAddress=&spPostingPropertyType=Land%2Flot&pricefrom=&priceto=&spPostingBedroom=&spPostingBathroom=&Squrefootfrom=&Squrefootto=&spPostingTitle=&btnAdresSearch=Filter' ?>">
						<img src="<?php echo $BaseUrl; ?>/assets/images/real/land-icon88x86.png" class="img-responsive">
						<h2 style="text-transform: capitalize;">Lands</h2>
						<!--<p>Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim donec vel lectus vel felis.</p>-->
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- <section class="searchBoxReal space1">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h3>Find Your <span>Neighbourhood</span></h3>
<p>Does it have pet-friendly rentals? Get important local information on the area you're most interested in.</p>
<form method="POST" action="search.php" >
<div class="form-group">
<input type="text" name="txtAddress" class="form-control" placeholder="Search for a property">
<input type="submit" name="btnAdresSearch" class="btn" value="Search Local">
</div>
</form>
</div>
</div>
</div>
</section>-->
<section>
	<div class="container">
		<div class="row">

		</div>
		<div class="row brownsReal">
			<div class="col-md-12">
				<?php
				$p = new _postingview;
				$count = 1;
				$result2 = $p->getAgetsReal($_GET['categoryID']);
//echo $p->ta->sql;
				if ($result2 != false) {
					while ($row2 = mysqli_fetch_assoc($result2)) {
						echo '<a href="' . $BaseUrl . '/real-estate/agent-detail.php?agentId=' . $row2['idspProfiles'] . '">' . $row2['spProfileName'] . '</a>';
						$count++;
						if ($count > 12) {
							break;
						}
					}
				}
				?>
			</div>
			<div class="row">

			</div>
		</div>
	</div>
</section>
<section class="agentHome">
	<div class="row no-margin">
		<?php
		$p = new _postingview;
		$res = $p->getAgentListRand($_GET["categoryID"]);
		if ($res != false) {
			$row = mysqli_fetch_assoc($res);
			$Pname = $row['spProfileName'];
			$Pemail = $row['spProfileEmail'];
			$Pphone = $row['spProfilePhone'];
			$Pabout  = $row["spProfileAbout"];
			$picture    = $row["spProfilePic"];
		} else {
			$Pname = "";
			$Pemail = "";
			$Pabout = "";
			$picture = "";
			$Pphone = "";
		}
		?>
<!--     <div class="col-md-9 no-padding">
<div class="leftBox">
<h2>Feel Free to Contact Our <span>Agents</span></h2>
<p class="desc"><?php echo $Pabout; ?></p>
<div class="row">
<div class="col-md-8">
<a href="<?php echo $BaseUrl . '/real-estate/agent-detail.php?agentId=' . $row['idspProfiles']; ?>"><?php echo $Pname; ?></a>
</div>
<div class="col-md-4">
<p><i class="fa fa-envelope"></i> <?php echo $Pemail; ?></p>
<p><i class="fa fa-phone"></i> <?php echo $Pphone; ?></p>
</div>
</div>
</div>
</div> -->
<div class="col-md-3 no-padding">
	<?php
	if (isset($picture) && $picture != '') {
		?>
		<img src="<?php echo ($picture); ?>" class="img-responsive">
		<?php
	}
	?>

</div>
</div>
</section>

<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		$.widget( "custom.catcomplete", $.ui.autocomplete, {
      _create: function() {
        this._super();
        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
      },
      _renderMenu: function( ul, items ) {
        var that = this,
          currentCategory = "";
        $.each( items, function( index, item ) {
          var li;
          if (item.category !== undefined && item.category != currentCategory ) {
            ul.append( "<li class='ui-autocomplete-category' style='font-weight:bold;margin-left:5px'>" + item.category + "</li>" );
            currentCategory = item.category;
          }
          li = that._renderItemData( ul, item );
          if ( item.category !== undefined) {
            li.attr( "aria-label", item.category + " : " + item.label );
          }
          if(item.count){
            li.append(" ("+item.count+") ")          
          }
        });
      }
    });
		
		$("#mainSearch").catcomplete({
        minLength: 1,
        source: "/api.php?class=RealEstate&action=mainSearch",
        focus: function () {
          return false;
        },
        response: function(event, ui) {
            if (!ui.content.length) {
                var noResult = { value:"",label:"Sorry, no current listings match your search. Please check your spelling." };
                ui.content.push(noResult);
            }
        },
        select: function (event, ui) {
          //$("#mainSearch").val(ui.item.label);
          //$("#mainSearchDataGroup").val(ui.item.category);
          //$("#mainSearchDataId").val(ui.item.value);     
          if(ui.item.category == "City"){     
            window.location.href = "../real-estate/search.php?cityId="+ui.item.value;
          }
          else if(ui.item.category == "ListingId"){     
            window.location.href = "../real-estate/search.php?listingId="+ui.item.value;
          }
          else if(ui.item.category == "Community"){     
            window.location.href = "../real-estate/search.php?community="+ui.item.value;
          }
          else if(ui.item.category == "Address"){     
            window.location.href = "../real-estate/search.php?txtAddress="+ui.item.value;
          }
          return false;
        }
    });

		
		<?php
		if (isset($_SESSION['msg']) && $_SESSION['count'] == 0) {
			?>
			$.notify({
				title: "<?php echo '<strong>' . $_SESSION['msg'] . '</strong>' ?>",
				icon: '',
				message: ""
			}, {
				type: 'success',
				animate: {
					enter: 'animated fadeInUp',
					exit: 'animated fadeOutRight'
				},
				placement: {
					from: "top",
					align: "right"
				},
				offset: 20,
				spacing: 10,
				z_index: 1031,
			});
			<?php
			$_SESSION['count']++;
			unset($_SESSION['err']);
		}
		?>
	});
</script>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');

// include('../component/footer.php');
//include('../component/f_btm_script.php');
// include('../component/f_btm_script.php');

?>
</body>

</html>
<?php
}
?>
