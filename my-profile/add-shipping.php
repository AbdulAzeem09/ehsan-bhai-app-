
<?php
    include('../univ/baseurl.php');
     include( "../univ/main.php");
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-profile/";
    include_once ("../authentication/check.php");
    
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $p = new _spprofiles;
    $rpvt = $p->readProfiles($_SESSION["uid"]);
    
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>

         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
        <!-- PAGE SCRIPT -->
        <!-- telephone -->
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/country/css/intlTelInput.css">
        <script type="text/javascript">
            $(function() {
                $('#spUserPhone').keypress(function(event){
                    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                       event.preventDefault(); //stop character from entering input
                    }
               });
            });
        </script>
        <!-- this script for webcam -->
        <script src="<?php echo $BaseUrl; ?>/assets/js/webcam/webcam.min.js"></script>
        <!-- END SCRIPT -->

<style>
.a-section.a-spacing-none.default-section {
    background-color: #b9d4eb;
}
.para_class{
    padding-top: 35px;
} 
.a_div{
  margin-top:-5px;
}
</style>
       
    </head>

    <body class="bg_gray">
        <?php include_once ("../header.php"); ?>
       

        <section class="landing_page">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-12">
                    	<div class="profile_section">
                    		<div class="row">
                    		<!-- 	<div class="col-md-2 bg_white" style="height: 400px;"></div> -->
                    			<!-- <div class="col-md-2">
                                    
                    				<div class="left_profile">
                    					
                    					<h2>My Account</h2>
                                        <p ><a href="<?php echo $BaseUrl.'/my-profile/';?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;My Profile</a></p>
                    					<p ><a href="<?php echo $BaseUrl.'/my-profile/my-account.php';?>"><i class="fa fa-dollar"></i>&nbsp;&nbsp;&nbsp;My Account</a></p>
                                        
                                           

                    				</div>
                    			</div> -->
<ol class="breadcrumb bg_white">
          <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/timeline/';?>">Dashboard</a></li>
      
       <li class="breadcrumb-item"><a href="#">My Account</a></li>
                                    
                       </ol>

<div class="col-md-12 bg_white" style="height: auto; padding-bottom: 60px;">

<div style="padding-left: 71px; padding-top: 25px;">

<h1 class="" style="color: #032350;">My Addresses</h1>
</div>



<div class="a-section a-spacing-double-large" style="margin-left: 90px;">
<div class="a-row a-spacing-micro">


<!-- + Box -->
<div class="a-column a-span4 a-spacing-none a-spacing-top-mini address-column" style="margin-left: -16px;">

<a id="ya-myab-address-add-link" class="a-link-normal add-new-address-button"
 href="<?php echo $BaseUrl.'/my-profile/Addnew_address.php';?>">

	<div class="a-box first-desktop-address-tile">
	  <div class="a-box-inner a-padding-extra-large">
	  	<div id="ya-myab-plus-address-icon" class="a-section a-spacing-none address-plus-icon aok-inline-block"></div><h2 class="a-color-tertiary">Add address</h2></div></div></a>
</div>

<!-- + Box -->
<!-- Default close -->

<?php  

  $con = mysqli_connect(DBHOST, UNAME, PASS);

     if(!$con) {
        die('Not Connected To Server');
    }
 
    //Connection to database
    if(!mysqli_select_db($con, DBNAME)) {
        echo 'Database Not Selected';
    }

$uid=$_SESSION["uid"];

//print_r($uid);

$shippingdata = "SELECT * FROM addshipping_address WHERE uid= $uid AND status= 1"; 
$result = $con -> query($shippingdata);

//print_r($result);exit;
/*if ($result->num_rows == 0) {
	$shippingdata = "SELECT * FROM addshipping_address WHERE uid= $uid AND status= 0"; 

$result = $con -> query($shippingdata);

}
*/
//print_r($result);die("");
while($row = mysqli_fetch_assoc($result)){;

//print_r($row);
//print_r($shippingdata);

//print_r(expression)
?>
<?php if (!empty($row)) { ?>
  

<div class="a-column a-span4 a-spacing-none a-spacing-top-mini address-column a-span-last">
<div id="ya-myab-display-address-block-1" class="a-box a-spacing-none normal-desktop-address-tile" style="margin-left: -15px;">
<div class="a-box-inner a-padding-none">
  
	<div class="a-section a-spacing-none default-section"><span class="a-size-small a-color-secondary default-line-item">Default: &nbsp; <img src='../assets/images/logo/tsp_trans.png' alt='The SharePage'
   style='width: 26px; height: 26px; padding-bottom: 3px;'>
</span>
<div id="ya-myab-default-shipping-address-icon" class="a-section a-spacing-none amazon-logo aok-inline-block"></div>
</div>

<div class="a-section address-section-with-default">
<div class="a-row a-spacing-small">               

<?php $co = new _country;
                        $result3 = $co->readCountryName($row['country']);
                        if ($result3) {
                        	$row3 = mysqli_fetch_assoc($result3);
                        	 

                        } ?>

             <?php
					$co = new _state;
                           $result4 = $co->readStateName($row['state']);
                                        if ($result4) {
                                        	$row4 = mysqli_fetch_assoc($result4);
                                        	
                                        }
										?>
										<?php
                                    $co = new _city;
                                    $result5 = $co->readCityName($row['city']);
                                    if ($result5) {
                                    	$row5 = mysqli_fetch_assoc($result5);
                                    	//print_r($row4);die;
                                    }
                                    ?>


 <ul class="a-unordered-list a-nostyle a-vertical" style="list-style-type: none; min-height:155px;">
 	<li><b><span class="a-list-item"><h5 id="address-ui-widgets-FullName" class="id-addr-ux-search-text  a-text-bold" style="font-weight: bold; text-transform: capitalize;"><?php echo $row['fullname'];?></h5></span></b></li>

 	<li><span class="a-list-item"><span id="address-ui-widgets-AddressLineOne" class="id-addr-ux-search-text"><?php echo $row['fulladdress'];?></span></span></li>


 	<li><span class="a-list-item"><span id="address-ui-widgets-AddressLineTwo" class="id-addr-ux-search-text"> <?php echo $row['landmark'];?> </span></span></li>


 	<li><span class="a-list-item"><span id="address-ui-widgets-CityStatePostalCode" class="id-addr-ux-search-text"><?php echo $row5['city_title'];?>, <?php echo  $row4['state_title'];?> <?php echo $row1['zipcode'];?></span></span></li>


 	<li><span class="a-list-item"><span id="address-ui-widgets-Country" class="id-addr-ux-search-text"> <?php echo $row['country_title'];?></span></span></li>

 	
 <li><span class="a-list-item"><span id="address-ui-widgets-PhoneNumber" class="id-addr-ux-search-text">Phone Number: &#8234;<?php echo $row['phone'];?>&#8236;</span></span></li>
 </ul>

<div class="a-row" style="padding-left: 40px;">

<a class="a-link-normal" href="<?php echo $BaseUrl.'/my-profile/Editnew_address.php?id='.$row['id']?>">Edit</a>

&nbsp; | &nbsp;

<a class="a-link-normal delete" id="deletedata" onclick="get_shippingaddress(<?php echo $row['id']; ?>);" 
 href="#">Remove</a>

</div>	

</div>
</div>
</div>
</div>
</div>
 <?php }
} ?>


<!-- set as defalut -->

<?php  

  $con = mysqli_connect(DBHOST, UNAME, PASS);

     if(!$con) {
        die('Not Connected To Server');
    }
   //Connection to database
    if(!mysqli_select_db($con, DBNAME)) {
        echo 'Database Not Selected';
    }

$selectstatus0 = "SELECT * FROM addshipping_address  WHERE uid= $uid AND status= 0";

//print_r($selectstatus0);

$result1 = $con -> query($selectstatus0);

//$row = mysqli_fetch_assoc($result1);
//$row1 = mysqli_fetch_assoc($result1);

//print_r($row1);

?>

<!-- Default -->

<?php if ($result1) {

  while ($row1 = mysqli_fetch_assoc($result1)) { ?>


<div class="a-column a-span4 a-spacing-none a-spacing-top-mini address-column a-span-last">
<div id="ya-myab-display-address-block-1" class="a-box a-spacing-none normal-desktop-address-tile" style="margin-left: -15px;">
<div class="a-box-inner a-padding-none">

	
<div class="a-section address-section-no-default">
<div class="a-row a-spacing-small para_class">        

 <!-- <?php echo $_SESSION['id']; ?>  -->      

<?php $co = new _country;
                        $result3 = $co->readCountryName($row1['country']);
                        if ($result3) {
                        	$row3 = mysqli_fetch_assoc($result3);
                        	 

                        } ?>

             <?php
					$co = new _state;
                           $result4 = $co->readStateName($row1['state']);
                                        if ($result4) {
                                        	$row4 = mysqli_fetch_assoc($result4);
                                        	
                                        }
										
										$citys = new _city;
											$resultss = $citys->readCityName($row1['city']);
											if($resultss){
												$rowss = mysqli_fetch_assoc($resultss);
											}
											//print_r($rowss); exit;
										?>

<ul class="a-unordered-list a-nostyle a-vertical" style="list-style-type: none; min-height: 155px;">

 	<li><b><span class="a-list-item"><h5 id="address-ui-widgets-FullName" class="id-addr-ux-search-text  a-text-bold" style="font-weight: bold; text-transform: capitalize;"><?php echo $row1['fullname'];?></h5></span></b></li>

 	<li><span class="a-list-item"><span id="address-ui-widgets-AddressLineOne" class="id-addr-ux-search-text"><?php echo $row1['fulladdress'];?></span></span></li>


 	<li><span class="a-list-item"><span id="address-ui-widgets-AddressLineTwo" class="id-addr-ux-search-text"> <?php echo $row1['landmark'];?> </span></span></li>


 	<li><span class="a-list-item"><span id="address-ui-widgets-CityStatePostalCode" class="id-addr-ux-search-text"><?php echo $rowss['city_title'];?>, <?php echo  $row4['state_title'];?> <?php echo $row1['zipcode'];?></span></span></li>


 	<li><span class="a-list-item"><span id="address-ui-widgets-Country" class="id-addr-ux-search-text"> <?php echo $row3['country_title'];?></span></span></li>

 	
 	<li><span class="a-list-item"><span id="address-ui-widgets-PhoneNumber" class="id-addr-ux-search-text">Phone number: &#8234;<?php echo $row1['phone'];?>&#8236;</span></span></li>
 </ul>

<!-- <div class="a-row" style=" padding-left: 40px;">
<a class="a-link-normal" href="#">Add delivery instructions
</a>
</div> -->

	
</div>

</div>

</div>
<div class="a-row a_div" style="padding-left: 40px;">


<a class="a-link-normal" href="<?php echo $BaseUrl.'/my-profile/Editnew_address.php?id='.$row1['id']?>">Edit</a>

&nbsp; | &nbsp;

 <a class="a-link-normal delete" id="deletedata" onclick="get_shippingaddress(<?php echo $row1['id']; ?>);" 
 href="#">Remove</a> 


&nbsp; | &nbsp;

<a class="a-link-normal" href="#" onclick="set_status(<?php echo $row1['id']; ?>);"> 

Set as Default</a>

</div>
</div>

</div>

<?php }
}

  ?>

<!-- Close set as default -->
</div>

</div>


                    			<!-- col-md-10 close-->	
								
                    			</div>
<!--<div style=" padding-top: 10px;float:right;margin-right:50px;">
<a href="<?php echo $BaseUrl.'/cart/';?>" title="" style="font-size:20px;  text-decoration-line: underline; color: #032350;
    font-weight: bold;">Go Back</a>	

</div>-->
                    			<div class="col-md-2"></div>
								
                    		</div>
							
                    	</div>
						
                    </div>
                    
                </div>
            </div>


        </section>

        <?php
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>

      <!-- telephone -->
     
       
  
<script type="text/javascript">
	
	function set_status(id) {       
/*swal({
			title: "Are you sure?",
			type: "warning",
			confirmButtonClass: "sweet_ok",
			confirmButtonText: "Yes",
			cancelButtonClass: "sweet_cancel",
			cancelButtonText: "No",
			showCancelButton: true,
		},

		function(isConfirm) {
	  if (isConfirm) {*/

	  	var statusid = id;

     //  alert(statusid);

         $.ajax({
            type: 'POST',
            url: 'update_shippstatus.php',

            data: 'status=1&statusid='+statusid,
            
              success: function(response){ 

                         //console.log(data);

                         location.href = "<?php echo $BaseUrl;?>/my-profile/add-shipping.php";

                              /*   swal({

                                  title: "Identity Uploaded Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location.reload();

                                  });
*/
   }

    });
}
		/*});

}*/
</script>    

<script type="text/javascript">

function get_shippingaddress(shippid){

var info = shippid;

//alert(info);

swal({
        title: "Are you sure?",
       // 
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
       // closeOnConfirm: false,
        //closeOnCancel: false
      },


      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
          	 type: 'POST',
             url: 'deleteshipping_add.php',
            // data: info,
            data:{'info': info},

             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
              // $("#"+info).remove();
               /*   swal("Deleted!", "Your imaginary file has been deleted.", "success");
*/
             swal({                          
                                  title: "Delete Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location.reload();

                                  });

             }

          });
        
    } else {
          //swal("Cancelled", "Your Data is safe :)", "error");
        }
       
      });

}

</script>

  <script src="<?php echo $BaseUrl;?>/assets/css/country/js/intlTelInput.js"></script>
 <script>

            var input = document.querySelector("#spUserPhone");
            window.intlTelInput(input, {
              // allowDropdown: false,
              // autoHideDialCode: false,
              // autoPlaceholder: "off",
              // dropdownContainer: document.body,
              // excludeCountries: ["us"],
              // formatOnDisplay: false,
              // geoIpLookup: function(callback) {
              //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
              //     var countryCode = (resp && resp.country) ? resp.country : "";
              //     callback(countryCode);
              //   });
              // },
              // hiddenInput: "full_number",
              initialCountry: "auto",
              // localizedCountries: { 'de': 'Deutschland' },
              // nationalMode: false,
              // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
              // placeholderNumberType: "MOBILE",
               preferredCountries: ['us', 'ca'],
               separateDialCode: true,
              utilsScript: "<?php echo $BaseUrl;?>/assets/css/country/js/utils.js",
            });
        </script>

	</body>
</html>
<?php
}
?>