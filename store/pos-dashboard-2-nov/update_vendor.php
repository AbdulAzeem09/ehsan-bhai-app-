<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';  
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = "1";
?>
<!DOCTYPE html>
<html lang="en-US"> 
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>   
        

    </head>

    <body class="bg_gray">
    	<?php
        
        $activePage = 1;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
    <?php 
		$p = new _pos_vendor;
															
	    $result = $p->read_data_id($_GET['postid']);
		
		if ($result) {
                                                               
         while ($row = mysqli_fetch_assoc($result)) {
			 
		
																	
	
	?>
 <section class="main_box">
            <div class="container">
                <div class="row">
				
				 <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-posmenu.php'); 
                            ?>
                        </div>
                    </div>
					
					<div class="col-md-1"></div>
					 <div class="col-md-8 bg_white" style="padding-bottom: 15px; margin-top: 10px;">
					  <h1>Update Vendor</h2>
					 
					 <form action="../update_detail_vendor.php" method="post" enctype="multipart/form-data" class="" >  

  
<input type="hidden" name="p_id" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="u_id" value="<?php echo $_SESSION['uid']; ?>">

<input type="hidden" name="id" value="<?php echo $_GET['postid']; ?>">


    <div class="form-group">
      <label class="add_shippinglabel" for="shipp_username">Name:<span class="red"></span></label>
              
    <input type="text" class="form-control"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"  id="shipp_username" placeholder="Enter Your Name" name="fullname" value="<?php echo $row['name']?>" required> 
       <span id="shippname_error" style="color:red;"></span>
    </div>

  <!--<div class="form-group">
  <label class="add_shippinglabel" for="shipp_address">Address: (max 50 characters)<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="address" id="shipp_address"><?php echo $row['address']?>"</textarea>
   <span id="shippaddress_error" style="color:red;"></span>
  </div>-->


                                    <div class="form-group">
                                        <label for="spUserEmail" class="control-label">Email <span class="red"></span>


                                        </label>
                                        <input type="email" class="form-control" id="spUserEmail" 
                                        name="spUserEmail" value="<?php echo $row['email']?>"  required>
                                      
                                    </div>
						  
						 <div class="form-group">
                                    <label for="spPostCountry_" class="lbl_2">Country</label>
                                    <select class="form-control " name="spPostCountry" id="spUserCountry_1">
                                        <option value="">Select Country </option>
                                        <?php
																			
																			
																				
																						
																													
									$co = new _country;
								$result3 = $co->readCountry();
										if($result3 != false){
							while ($row3 = mysqli_fetch_assoc($result3)) {
																				
																 $usercountry = $row['country'];
																			?>

                                        <option value='<?php echo $row3['country_id'];?>' <?php echo ( $row['country'] == $row3['country_id'])?'selected':''; ?>><?php echo $row3['country_title'];?></option>
                                        <?php
																			}
																			}
																			?>
                                    </select>
                                    <!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
                                </div>
								
								
				 <div class="form-group">
               <div class="loadUserState">
                                    <label for="spPostingCity"  class="lbl_3">State</label>
                                    <select class="form-control spPostingsState" name="spUserState" id= "spUserState_1">
                                        <option>Select State</option>
                                        <?php 
                                                            
              // if (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] > 0) {
                                                                $countryId = $usercountry;
                                                                $pr = new _state;
                   $result2 = $pr->readState($countryId);
                                         if($result2 != false){
                                                                    while ($row2 = mysqli_fetch_assoc($result2)) { 
																	
																	$userstate = $row['state'];
																	?>
                                        <option value='<?php echo $row2["state_id"];?>' <?php echo ($row['state'] == $row2["state_id"] )?'selected':'';?>><?php echo $row2["state_title"];?> </option>
                                        <?php
                                                                    }
                                                                }
                                                          //  }
                                                            ?>
                                    </select>
                                </div>
         </div>	


 <div class="form-group">
 <div class="loadCity">
      <label for="spPostingCity"  class="">City</label>
                                        <select class="form-control" name="spUserCity">
                                            <option>Select City</option>
                                            <?php 
                                                                    $stateId = $userstate;

                                                                    $co = new _city;
                                                                    $result3 = $co->readCity($stateId); 
                                                                    //echo $co->ta->sql;
                                                                    if($result3 != false){
                                                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                            <option value='<?php echo $row3['city_id']; ?>' <?php echo ( $row['city'] == $row3['city_id'])?'selected':''; ?>><?php echo $row3['city_title'];?></option> <?php
                                                                        }
                                                                    
                                                                } ?>
                                        </select>
	 </div>
   </div>	


 <div class="form-group">
      <label class="add_shippinglabel" for="shipp_username">Street name:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="shipp_username" placeholder="Enter Your Street name"  value="<?php echo $row['street_name']?>" name="street_name"> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>

<div class="form-group">
      <label class="add_shippinglabel" for="shipp_username">Street number:<span class="red"></span></label>
              
    <input type="text" class="form-control"    id="shipp_username" placeholder="Enter Your Street number" value="<?php echo $row['street_no']?>" name="street_no"> 
       <span id="shippname_error" style="color:red;"></span>
    </div>	
                                

  <div class="form-group">
      <label class="add_shippinglabel" for="shipp_zipcode">Zipcode:<span class="red"></span></label>
  <input type="text" class="form-control" placeholder="6 digits [0-9] zipcode" name="zipcode" value="<?php echo $row['zipcode']?>" id="shipp_zipcode" required >
  <span id="shippzipcode_error" style="color:red;"></span>
   </div>

<div class="form-group">
      <label class="add_shippinglabel" for="respUserEphone"> Primary Phone Number:<span class="red"></span></label>
               
  <input type="text" class="form-control"  id="respUserEphone" placeholder="
  Enter phone number" name="phone" value="<?php echo $row['phone']?>" required>
  <span id="shippphone_error" style="color:red;"></span>
 
</div>

<div class="form-group">
      <label class="add_shippinglabel" for="respUserEphone">Secondary Phone Number:<span class="red"></span></label>
               
  <input type="text" class="form-control"  id="respUserEphone" placeholder="
  Enter phone number" name="phone_1" value="<?php echo $row['alt_phone']?>">
  <span id="shippphone_error" style="color:red;"></span>
 
</div>

 <div class="form-group">
  <label class="add_shippinglabel" for="shipp_address">Notes:<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="address" id="shipp_address"><?php echo $row['notes']?>"</textarea>
   <span id="shippaddress_error" style="color:red;"></span>
  </div>

 <div class="form-group" style="margin-bottom: 73px;">
                                <label for="yourName" class="control-label contact">Photo<span class="red"></span><span style="font-size: 12px;"> </span></label>
								
								<?php //echo $row['file1']; ?>
								<?php if($row['file1'] != "NULL"){ ?>
								<span id="img1" class="pull-right"><b id="x1" style="font-size: 21px;">x</b><img src="<?php echo $BaseUrl.'/store/pos_dashboard1/upload_pos/'.$row['file1']; ?>"  width="100" height="100"></span>
								<?php } ?>
								
								<input type="file" style="display:block;" class=" showimg" accept="image/*" name="uploadidentity" id="uploadidentity"  <?php if (!empty($row[2])) {echo "disabled";  }?>  />
								<input type="hidden" name="file_1" value="<?php echo $row['file1']; ?>">
								

</div>
<hr>

<!--<div class="form-group" style="margin-bottom: 73px;">
                                <label for="yourName" class="control-label contact">Secondary Photo<span class="red"></span><span style="font-size: 12px;"> </span></label>
								<?php if($row['file2']!= "NULL"){ ?>
								<span id="img2" class="pull-right"><b id="x2" style="font-size: 21px;">x</b><img src="<?php echo $BaseUrl.'/store/pos_dashboard1/upload_pos/'.$row['file2']; ?>"  width="100" height="100"></span>
								<?php } ?>
								
								<input type="file" style="display:block;" class=" showimg" accept="image/*" name="uploadidentity1" id="uploadidentity1"  <?php if (!empty($row[2])) {echo "disabled";  }?>  />
								
								<input type="hidden" name="file_2" value="<?php echo $row['file2']; ?>">   


</div>-->
    <div class="form-group">        
      <div class="">
        <button type="submit" class="btn btn-default Add_adderess">Update Detail</button>  
      </div>
    </div>

</form>
					
				     </div>
				
				</div>
				</div>
 </section>


<?php  }

		} ?>







    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        // <!-- ========DASHBOARD FOOTER CHARTS====== -->
        include('../../component/dash_btm_script.php');
        ?>
    </body>
</html>
<?php
}
?>

<script>
$(document).ready(function(){
  $("#x2").click(function(){
	  var a= "<?php  echo $_GET['postid']?>"; 
	  var b = "first_img";
	  
	  $.ajax({
		  url: "../delete_vendor_file.php",
       type: "POST",
       data: {id : a, type:b},
		  success: function(result){
      $("#img2").hide();
	  }
	  });
    
  });
  $("#x1").click(function(){  
	  var a= "<?php  echo $_GET['postid']?>";
	  var b = "second_img"; 
	   $.ajax({
		  url: "../delete_vendor_file.php",
       type: "POST",
       data: {id : a, type:b},
		  success: function(result){
     $("#img1").hide();
	  }
	  });
    
  });
});
</script>

 <script>
 
 $(document).ready(function(){
	 
		  $("#spUserCountry_1").on("change", function () { 
		var a = $("#spUserCountry_1").val();
		  $.post("../loadUserState_1.php", {countryId: a}, function (r) {
               // alert(r);
                $(".loadUserState").html(r);
            });
	 });
	 
	  $("#spUserState_1").on("change", function () { 
		var b = $("#spUserState_1").val();
		  $.post("../loadUserCity.php", {state: b}, function (r) {
               // alert(r);
                $(".loadCity").html(r);
            });
	 });
	 
	 
	 });
	 
	 
   
 </script>