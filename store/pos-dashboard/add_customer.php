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
<style>
#header{margin-top: 25px!important;}
</style>
    <body class="bg_gray">
    	<?php
        
        $activePage = 1;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
    
 <section class="main_box">
            <div class="container">
                <div class="row">
				
				 <div id="sidebar" class="col-md-2 hidden-xs no-padding" >
                        <div class="left_grid store_left_cat" >
                            <?php
                               include('left-posmenu.php'); 
                            ?>
                        </div>
                    </div>
					
					<div class="col-md-1"></div>
					
					 <div class="col-md-8 bg_white" style="padding-bottom: 15px; margin-top: 20px;">
					 <h1>Create New Customer</h2>
					 
					 <form action="add_detail.php" method="post" enctype="multipart/form-data" class="" >  

  
<input type="hidden" name="p_id" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="u_id" value="<?php echo $_SESSION['uid']; ?>">

<div class="row">
<div class="col-md-6">
    <div class="form-group">
      <label class="add_shippinglabel" for="shipp_username">Customer#:<span class="red"></span></label>
              
    <input type="text" class="form-control"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"  id="shipp_username" placeholder="Customer#" name="fullname" required> 
       <span id="shippname_error" style="color:red;"></span>
    </div>
    </div>
	
	<div class="col-md-6">
    <div class="form-group">
      <label class="add_shippinglabel" for="customer_name_">Customer Name:<span class="red"></span></label>
              
    <input type="text" class="form-control"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"  id="customer_name_" placeholder="" name="customer_name" required> 
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
                                        name="spUserEmail" value="<?php echo $useremail;?>"  required>
                                      
                                    </div>
                                    </div>
									
	<div class="col-md-4">
	<div class="form-group">
      <label class="add_shippinglabel" for="respUserEphone">Phone Number:<span class="red"></span></label>
               
  <input type="text" class="form-control"  id="respUserEphone" placeholder="" name="phone" required>
  <span id="shippphone_error" style="color:red;"></span>
 
</div>
</div>	

<div class="col-md-4">
	<div class="form-group">
      <label class="add_shippinglabel" for="customer_type_">Customer Type:<span class="red"></span></label>
               
  <input type="text" class="form-control"  id="customer_type_" placeholder="" name="customer_type" required>
  <span id="shippphone_error" style="color:red;"></span>
 
</div>
</div>	
                                    </div>   
									
									
			<h4>Mailing/Preference</h4>	
<div class="row">	
<div class="col-md-6">		
<div class="form-group">
  <label class="add_shippinglabel" for="shipp_address">Address: (max 50 characters)<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="address" id="shipp_address"></textarea>
   <span id="shippaddress_error" style="color:red;"></span>
  </div>
  </div>
  <div class="col-md-6">		
  <div class="form-group">
      <label class="add_shippinglabel" for="shipp_zipcode">Zipcode:<span class="red"></span></label>
  <input type="text" class="form-control" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" required>
  <span id="shippzipcode_error" style="color:red;"></span>
   </div>
   </div>
   
  </div>
  
<div class="row">	
<div class="col-md-4">								
		     <div class="form-group">
                                    <label for="spPostCountry_" class="lbl_2">Country</label>
                                    <select class="form-control " name="spPostCountry" id="spUserCountry">
                                        <option value="">Select Country </option>
                                        <?php
																			
																			
																				
																						
																													
									$co = new _country;
								$result3 = $co->readCountry();
										if($result3 != false){
							while ($row3 = mysqli_fetch_assoc($result3)) {
																				
																 $usercountry = $row3['country_id'];
																			?>

                                        <option value='<?php echo $row3['country_id'];?>' <?php echo (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] == $row3['country_id'])?'selected':''; ?>><?php echo $row3['country_title'];?></option>
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
                                    <select class="form-control spPostingsState" name="spUserState">
                                        <option>Select State</option>
                                        <?php 
                                                            
              // if (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] > 0) {
                                                                $countryId = $usercountry;
                                                                $pr = new _state;
                   $result2 = $pr->readState($countryId);
                                         if($result2 != false){
                                                                    while ($row2 = mysqli_fetch_assoc($result2)) { 
																	
																	$userstate = $row2["state_id"];
																	?>
                                        <option value='<?php echo $row2["state_id"];?>' <?php echo (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] == $row2["state_id"] )?'selected':'';?>><?php echo $row2["state_title"];?> </option>
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
                                                                    $result3 = $co->readCity($_SESSION['spPostState']);
                                                                    //echo $co->ta->sql;
                                                                    if($result3 != false){
                                                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] == $row3['city_id'])?'selected':''; ?>><?php echo $row3['city_title'];?></option> <?php
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
              
    <input type="text" class="form-control"   id="sales_price_" placeholder="" name="sales_price"> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
    </div>
	
	<div class="col-md-4">
 <div class="form-group">
      <label class="add_shippinglabel" for="tax_">TAX:<span class="red"></span></label>
              
    <input type="text" class="form-control"    id="tax_"  placeholder="" name="tax">    
       <span id="shippname_error" style="color:red;"></span>
    </div>
    </div>
                          

  
<div class="col-md-4">


<div class="form-group">
      <label class="add_shippinglabel" for="discount_">Discount:<span class="red"></span></label>
               
  <input type="text" class="form-control"  id="discount_" placeholder="" name="discount">
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
                                        <option value="cash">Cash</option>
                                        <option value="cash1">cash1</option>
                                        <option value="cash2">cash2</option>
										
	</select>									
  </div>
  </div>
 <div class="col-md-6">		
<div class="form-group">
  <label class="add_shippinglabel" for="shipp_address">Payment2:<span class="red"></span></label>
   <select class="form-control" name="payment_2">
                                        <option value="cod">COD</option>
                                        <option value="cod1">COD1</option>
                                        <option value="cod2">COD2</option>
										
	</select>									
  </div>
  </div>
   
  </div>
  
  

 <div class="form-group">
  <label class="add_shippinglabel" for="notes_">Notes<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="notes" id="notes_"></textarea>
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
<input type="checkbox" name="email_news" value="Yes">	Receive Email & Newsletter
      
        <button type="submit" class="btn btn-default Add_adderess">Add Detail</button>  
      
    </div>
   

</form>
					
				     </div>
				
				</div>
				</div>
 </section>










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