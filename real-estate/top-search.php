<?php include('../component/f_links.php');
?>
<div class="container bg_white" style="height: 85px;">
    <div class="row">
		<!-- <div class="col-md-6">
			<div class="realTitle1">
				<h2>Find your <span>Dream Home</span></h2>
			</div>
		</div> -->
    <div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog">
      <div class="modal-content no-radius">

       <div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
         <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
           <h2>Your current profile does not have <br>access to this page. Please create or switch<br> <span>"Business, Professional"</span> modules can sell property.</h2>
            <div class="space-md"></div>
             <a href="<?php echo $BaseUrl . '/my-profile'; ?>" class="btn">Create or Switch Profile</a>
              <a href="<?php echo $BaseUrl . '/real-estate/index.php'; ?>" class="btn">Back to Home</a>
             </div>
           </div>
        </div>
    </div>
<div class="col-md-12 " style="    padding-top: 6px;">
			
			
			<!--	https://dev.thesharepage.com/real-estate/all-room.php -->
			<?php if($_SESSION['guet_yes'] != 'yes'){ ?>
				<?php if($_SESSION['ptname'] != 'Business' && $_SESSION['ptname'] != 'Professional'){ ?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_dash_real m_top_20 btn-border-radius" style="background-color: #58691D;;"> Submit a Property</a><?php
}else{?>
<a href="<?php echo $BaseUrl.'/post-ad/real-estate/';?>" class="btn butn_dash_real m_top_20 btn-border-radius" style="background-color: #58691D;;"> Submit a Property</a>
			<?php
			}
				if(isset($home) && $home == true){ ?>
				<a href="<?php echo $BaseUrl.'/real-estate/dashboard/';?>" class="btn butn_dash_real m_top_20 btn-border-radius" style="background-color: #97a37c;margin-right: 10px;margin-left: 10px;"><i class="fa fa-dashboard"></i> Dashboard</a> <?php
					}else{
				?>
				<a  href="<?php echo $BaseUrl.'/real-estate/find-a-room.php';?>" class="btn butn_find_room btn-border-radius">Find A Room</a>
				<?php
				}}
				
				
				
				//print_r($_SESSION);  
                $u = new _spuser;
                if ($_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 3) {
                    // IS EMAIL IS VERIFIED
                    $p_result = $u->isverify($_SESSION['uid']);
					//print_r($p_result);
                    if ($p_result == 1) {
                        $pv = new _postingview;
                        $reuslt_vld = $pv->chekposting(3,$_SESSION['pid']);
                        if ($reuslt_vld == false) {
						?>
						<!--<a style="margin-top: 20px; background-color:#3ea941" href="<?php echo $BaseUrl.'/post-ad/real-estate/?post';?>" class="btn butn_save m_top_20">Submit an Ad</a>--->
						<?php
						}
					}
				}
			?>
			<?php if($_SESSION['guet_yes'] != 'yes'){ ?>

			<a style="margin-top: 20px;background-color: #83a532 !important;" href="/real-estate/all-room.php" class="btn butn_save m_top_20 btn-border-radius">Search Rentals</a>
			<a style="margin-top: 20px;background-color: #83a532 !important;margin-left: 10px;" href="/real-estate/search.php" class="btn butn_save m_top_20 btn-border-radius">Advanced Search</a>
			<?php } ?>
			
			
		</div>
		
	</div>

	<style>
		
		.iconss {
		padding-left: 25px;
		background: url("https://png.pngtree.com/png-vector/20190419/ourmid/pngtree-vector-location-icon-png-image_956422.jpg") no-repeat left;
		background-size: 20px;
		}
		input#spPostingAddress_ {
		background-color: white;
		}


      @media(max-width:480px)
      {
         .location-details{
            margin-top:-5px!important;
         }
         .left_real_menu {
    background-color: #fff!important;
}
.breadcrumb {
    margin-bottom: 30px!important;
}
      }
		
      
	</style>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>
	
	<div class="row">
		<form class="searchReal" action="search.php">
			<div class="col-md-5">
				<div class="form-group">
					
					<?php 
						
						//unset($_SESSION['realstate_default_address']);
						
						
							$p = new _spuser;
							$defAdd = $p->read($_SESSION['uid']);
							
							$default_address = 	mysqli_fetch_assoc($defAdd);
							
							$defcountry = $default_address['default_country'];
							$defstate = $default_address['default_state'];
							$defcity = $default_address['default_city'];
							
							$totaladdress = $defcity.', '.$defstate.', '.$defcountry;
							
						
					?>
					
				</div>
			</div> 
			<!-- <div class="col-md-6" style=" margin-left: -74px; ">
				<div class="form-group">
					 <button style="border-radius: 3px;background-color: #5d7425 !important;color: white;    padding-right: 16px;" name="btnAdresSearch" type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button> 
				</div>       
			</div> -->
		</form>
		<div class="location-details" style="float:right;margin-top: -45px;    margin-right: 10px;">
		  <?php include_once("top-location.php"); ?>
		</div>


<script>
	var input = document.getElementById('spPostingAddress_');
	var autocomplete = new google.maps.places.Autocomplete(input);
</script>  
<script type="text/javascript">
	$(document).ready(function(){
		$(".usercountry").hide();
	});
	//==========ON CHANGE LOAD CITY==========
	$(".spPostingsState").on("change", function () {
		
		//alert(this.value);
		var state = this.value;
		$.post("loadUserCity.php", {state: state}, function (r) {
			//alert(r);
			$(".loadCity").html(r);
		});
		
	});
	//==========ON CHANGE LOAD CITY==========
</script>				
