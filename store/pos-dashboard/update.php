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
		$p = new _pos;
															
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
					  <h1>Update Customer</h2>
					 
					 <form action="../update_detail.php" method="post" enctype="multipart/form-data" class="" >  

  
<input type="hidden" name="p_id" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="u_id" value="<?php echo $_SESSION['uid']; ?>">

<input type="hidden" name="id" value="<?php echo $_GET['postid']; ?>">


   <div class="row">
<div class="col-md-6">
    <div class="form-group">
      <label class="add_shippinglabel" for="shipp_username">Customer#:<span class="red"></span></label>
              
    <input type="text" class="form-control"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"  id="shipp_username" placeholder="Customer#" name="fullname" value="<?php echo $row['name']; ?>" required> 
       <span id="shippname_error" style="color:red;"></span>
    </div>
    </div>
	
	<div class="col-md-6">
    <div class="form-group">
      <label class="add_shippinglabel" for="customer_name_">Customer Name:<span class="red"></span></label>
              
    <input type="text" class="form-control"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"  id="customer_name_" placeholder="" name="customer_name" value="<?php echo $row['customer_name']; ?>" required> 
       <span id="shippname_error" style="color:red;"></span>
    </div>
    </div>
	
	
    </div>

 <!-- <div class="form-group">
  <label class="add_shippinglabel" for="shipp_address">Address: (max 50 characters)<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="address" id="shipp_address"></textarea>
   <span id="shippaddress_error" style="color:red;"></span>
  </div>-->

  <div class="row">
  <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="spUserEmail" class="control-label">Email <span class="red"></span>


                                        </label>
                                        <input type="email" class="form-control" id="spUserEmail" 
                                        name="spUserEmail" value="<?php echo $row['email']; ?>"  required>
                                      
                                    </div>
                                    </div>
									
	<div class="col-md-4">
	<div class="form-group">
      <label class="add_shippinglabel" for="respUserEphone">Phone Number:<span class="red"></span></label>
               
  <input type="text" class="form-control"  id="respUserEphone" placeholder="" name="phone" value="<?php echo $row['phone']; ?>" required>
  <span id="shippphone_error" style="color:red;"></span>
 
</div>
</div>	

<div class="col-md-4">
	<div class="form-group">
      <label class="add_shippinglabel" for="customer_type_">Customer Type:<span class="red"></span></label>
               
  <input type="text" class="form-control"  id="customer_type_" placeholder="" name="customer_type" value="<?php echo $row['customer_type']; ?>" required>
  <span id="shippphone_error" style="color:red;"></span>
 
</div>
</div>	
                                    </div>   
									
									
			<h4>Mailing/Preference</h4>	
<div class="row">	
<div class="col-md-6">		
<div class="form-group">
  <label class="add_shippinglabel" for="shipp_address">Address: (max 50 characters)<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="address" id="shipp_address"><?php echo $row['address']; ?></textarea>
   <span id="shippaddress_error" style="color:red;"></span>
  </div>
  </div>
  <div class="col-md-6">		
  <div class="form-group">
      <label class="add_shippinglabel" for="shipp_zipcode">Zipcode:<span class="red"></span></label>
  <input type="text" class="form-control" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" value="<?php echo $row['zipcode']; ?>" required>
  <span id="shippzipcode_error" style="color:red;"></span>
   </div>
   </div>
   
  </div>
  
						  <div class="row">
						  <div class="col-md-4">
						 <div class="form-group">
                                    <label for="spPostCountry_" class="lbl_2">Country</label>
                                    <select class="form-control " name="spPostCountry" id="spUserCountry_1" >
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
								
								
                                </div>
								
					 <div class="col-md-4">			
				 <div class="form-group">
               <div class="loadUserState">
                                    <label for="spPostingCity"  class="lbl_3">State</label>
                                    <select class="form-control " name="spUserState" id= "spUserState_1" >
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
                                        <option value='<?php echo $row2["state_id"];?>' <?php echo ( $row['state'] == $row2["state_id"] )?'selected':'';?>><?php echo $row2["state_title"];?> </option>
                                        <?php
                                                                    }
                                                                }
                                                          //  }
                                                            ?>
                                    </select>
                                </div>
         </div>	
		 
		 
         </div>	

 <div class="col-md-4">
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
                                            <option value='<?php echo $row3['city_id']; ?>' <?php echo ($row['city'] == $row3['city_id'])?'selected':''; ?>><?php echo $row3['city_title'];?></option> <?php
                                                                        }
                                                                    
                                                                } ?>
                                        </select>
	 </div>
   </div>

   
   </div>	
   </div>	
   


 <h4>Prices/TAX</h4>
		<div class="row">	

<div class="col-md-4">		
       <div class="form-group">
      <label class="add_shippinglabel" for="sales_price_">Sales Price:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="sales_price_" placeholder="" name="sales_price" value="<?php echo $row['sales_price']; ?>" > 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
    </div>
	
	<div class="col-md-4">
 <div class="form-group">
      <label class="add_shippinglabel" for="tax_">TAX:<span class="red"></span></label>
              
    <input type="text" class="form-control"    id="tax_"  placeholder="" name="tax" value="<?php echo $row['tax']; ?>" >    
       <span id="shippname_error" style="color:red;"></span>
    </div>
    </div>
                          

  
<div class="col-md-4">


<div class="form-group">
      <label class="add_shippinglabel" for="discount_">Discount:<span class="red"></span></label>
               
  <input type="text" class="form-control"  id="discount_" placeholder="" name="discount" value="<?php echo $row['discount']; ?>">
  <span id="shippphone_error" style="color:red;"></span>
 
</div>
</div>


</div>

<h4>Credit & Payment Terms</h4>

<div class="row">	
<div class="col-md-6">		
<div class="form-group">
  <label class="add_shippinglabel" for="shipp_address">Payment1:<span class="red"></span></label>
   <select class="form-control" name="payment_1">
                                        <option value="cash" <?php if($row['payment_1'] == "cash") echo 'selected = "selected"'; ?> >Cash</option>
                                        <option value="cash1" <?php if($row['payment_1'] == "cash1") echo 'selected = "selected"'; ?> >cash1</option>
                                        <option value="cash2" <?php if($row['payment_1'] == "cash2") echo 'selected = "selected"'; ?> >cash2</option>
										
	</select>									
  </div>
  </div>
 <div class="col-md-6">		
<div class="form-group">
  <label class="add_shippinglabel" for="shipp_address">Payment2:<span class="red"></span></label>
   <select class="form-control" name="payment_2">
                                        <option value="cod" <?php if($row['payment_2'] == "cod") echo 'selected = "selected"'; ?> >COD</option>
                                        <option value="cod1" <?php if($row['payment_2'] == "cod1") echo 'selected = "selected"'; ?> >COD1</option>
                                        <option value="cod2" <?php if($row['payment_2'] == "cod2") echo 'selected = "selected"'; ?> >COD2</option>
										
	</select>									
  </div>
  </div>
   
  </div>
  
  

 <div class="form-group">
  <label class="add_shippinglabel" for="notes_">Notes<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="notes" id="notes_"><?php echo $row['notes'] ?></textarea>
   <span id="shippaddress_error" style="color:red;"></span>
  </div> 

 <!--<div class="form-group">
                                <label for="yourName" class="control-label contact">Photo<span class="red"></span><span style="font-size: 12px;"> </span></label>
								<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity" id="uploadidentity"  <?php if (!empty($row[2])) {echo "disabled";  }?> />

</div>-->


 <!--<div class="form-group">
                                <label for="yourName" class="control-label contact">image<span class="red"></span><span style="font-size: 12px;"> </span></label>
								<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadimg[]" id="uploadimg"   multiple/>

</div> -->

<!--<div class="form-group">
                                <label for="yourName" class="control-label contact">Secondary Photo<span class="red"></span><span style="font-size: 12px;"> </span></label>
								<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity1" id="uploadidentity1"  <?php if (!empty($row[2])) {echo "disabled";  }?> />

</div>
<div class="form-group">         
      <div class="">
        <button type="submit" name="btn" class="btn btn-default Add_adderess">submit</button>  
      </div>
    </div>-->



    <div class="form-group"> 
	<?php if($row['email_news'] == 'Yes'){ ?>
<input type="checkbox" name="email_news" value="<?php echo $row['email_news']; ?>" checked>	Receive Email & Newsletter
		 <?php } else{ ?>
		 <input type="checkbox" name="email_news" value="Yes">	Receive Email & Newsletter
		 <?php }?>
        <button type="submit" class="btn btn-default Add_adderess">Update Detail</button>  
      
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
		  url: "../delete_file.php",
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
		  url: "../delete_file.php",
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