
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
    $active = 4;
    
    $_GET["categoryid"] = "1";
    
    $postid = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
?>





<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Business Account & Inventory | TheSharepage </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <script src="../../assets/js/validations.js"></script>
</head>
<body>
   <div class="container-fluid">
      <div class="row flex-nowrap">
	  
	  <?php include('left_side_landing.php');?>  
         
         <div class="col py-3">
            <div class="row mb-4">
               <div class="col-12 p-3">
                  <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                     <h4 class="float-start"> Edit Supplier</h4>
                     <span class="float-end">
                        <a href="supplier-list.php" class="btn btn-outline-secondary me-3">Supplier List</a>
                        <button type="submit" form="addcustomer" class="btn btn-main me-3"><i class="fas fa-save"></i> Update User</button>
                     </span>
                  </div>
				  <?php 
		$p = new _pos;
															
	    $result = $p->read_supplier_id($postid); 
		
		if ($result) {
                                                               
         while ($row = mysqli_fetch_assoc($result)) {
			 
		
																	
	
	?>
				  
                  <form action="<?php echo $BaseUrl; ?>/store/pos-dashboard/update-supplier-detail.php" method="post" enctype="multipart/form-data" class="" id="addcustomer">
				  <input type="hidden" name="p_id" value="<?php echo $_SESSION['pid']; ?>">

  <input type="hidden" name="u_id" value="<?php echo $_SESSION['uid']; ?>">

    <input type="hidden" name="id" value="<?php echo $postid; ?>">  
				  
                     <div class="row">
                        <div class="col-8">
                          <div class="row">
                             <!--  <div class="col-6 mb-3">
                                 <input type="text" class="form-control shadowBox" id="customerno" placeholder="Customer#" name="customerno" value="<?php echo $row['name']; ?>" required>
                              </div>-->
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control shadowBox" id="customername" placeholder="Supplier Name" value="<?php echo $row['customer_name']; ?>" name="customername" required>
                              </div>
							   <div class="col-6 mb-3">
                                 <input type="text" class="form-control shadowBox" id="customerphone" placeholder="Supplier Phone" value="<?php echo $row['phone']; ?>" name="customerphone" required>
                              </div>
                           </div>
                           <div class="row">
                             
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control shadowBox" id="customeremail" placeholder="Supplier Email" value="<?php echo $row['email']; ?>"  name="customeremail"  required>
                              </div>
                           </div>
                           <div class="row">
                              <!--<div class="col-6 mb-3">
                                 <select class="form-control form-select shadowBox" id="customertype" name="customertype">
                                    <option selected> Select Customer Type</option>
                                    <option value="1"  <?php if($row['customer_type'] == 1 ){ echo "selected";} ?>>Retail</option>
                                    <option value="2" <?php if($row['customer_type'] == 2 ){ echo "selected";} ?> >Whole Sale</option>
                                    <option value="3" <?php if($row['customer_type'] == 3 ){ echo "selected";} ?> >Domeste</option>
                                 </select>
                              </div>
                              <div class="col-6 mb-3">
                                 <select class="form-control form-select shadowBox" id="profiletype" name="profiletype">
                                    <option selected> Select Profile Type</option>
                                    <option value="1"  <?php if($row['profiletype'] == 1 ){ echo "selected";} ?> >Business</option>
                                    <option value="2" <?php if($row['profiletype'] == 2 ){ echo "selected";} ?> >Personal</option>
                                    <option value="3"  <?php if($row['profiletype'] == 3 ){ echo "selected";} ?> >Professional</option>
                                 </select>
                              </div>>-->
                           </div>
                           <!--<div class="row">
                              <div class="col-6 mb-3">
                                 <select class="form-control form-select shadowBox" id="membership" name="membership">
                                    <option selected> Select Membership Type</option>
                                    <option value="1" <?php if($row['membership'] == 1 ){ echo "selected";} ?> >Browns</option>
                                    <option value="2"  <?php if($row['membership'] == 2 ){ echo "selected";} ?> >Silver</option>
                                    <option value="3" <?php if($row['membership'] == 3 ){ echo "selected";} ?> >Gold</option>
                                 </select>
                              </div>
                              <div class="col-6 mb-3">
                                 <select class="form-control form-select shadowBox" id="submembership" name="submembership">
                                    <option selected> Select Sub Membership</option>
                                    <option value="1" <?php if($row['submembership'] == 1 ){ echo "selected";} ?> >1</option>
                                    <option value="2" <?php if($row['submembership'] == 2 ){ echo "selected";} ?> >2</option>
                                    <option value="3" <?php if($row['submembership'] == 3 ){ echo "selected";} ?> >3</option>
                                 </select>
                              </div>
                           </div>-->
                           <div class="row">
                              <div class="col-12">
                                 <div class="form-group d-flex">
                                    <div class="form-check me-4">
									<?php  if($row['email_news'] == 1){ ?>
                                       <input class="form-check-input" type="checkbox" onchange="fun_ch()" value="1" id="emailcheck" checked name="emailcheck"  >  
									<?php } else{ ?>
									<input class="form-check-input" type="checkbox" value="1" id="emailcheck" name="emailcheck"  >
									<?php }?>
                                       <label class="form-check-label" for="emailcheck">Receive Email & Newsletter</label>
                                    </div>
                                    <div class="form-check">
									<?php  if($row['empcheck'] == 1){ ?>
									
                                       <input class="form-check-input" type="checkbox" name="empcheck" value="1" checked id="empcheck" >
									<?php }else{ ?>
									<input class="form-check-input" type="checkbox" name="empcheck" value="1"  id="empcheck">
									<?php } ?>
                                       <label class="form-check-label" for="empcheck">Is this customer an employee of this business?</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="profile-img mb-4 border border-3 text-center p-2"> 
						   <?php if($row['file']){ ?>
                              <img src="<?php echo $BaseUrl.'/store/pos-dashboard/upload_pos/'.$row['file']; ?>" class="img-sm img-fluid img-thumbnail mb-2" id= "preview_img" >  
						   <?php }else{ ?>
                                	<img src="<?php echo $BaseUrl.'/assets/images/icon/blank-img.png'; ?>" class="img-sm img-fluid img-thumbnail mb-2" style="height:220px" id= "preview_img" > 
						   <?php } ?>									
                              <input type="file" class="form-control shadowBox" id="image_file" name="profile_img" style="width:333px; text-align: center;"><span class="error_message" id="image_file_error"style="color: red;"></span>
							  <input type="hidden" name="hidden_file" value="<?php echo $row['file']; ?>">    
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12">
                           <div class="tab-container-one">
                              <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                                 <li class="nav-item active">
                                    <a class="nav-link active " href="#mailing" role="tab" aria-controls="mailing" data-bs-toggle="tab">Mailing / Preference</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link active" href="#cpt" role="tab" aria-controls="cpt" data-bs-toggle="tab">Credit & Payment Terms</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link active" href="#note" role="tab" aria-controls="note" data-bs-toggle="tab">Note</a>
                                 </li>
                              </ul> -->
                              <div class="tab-content">
                                 <div class="tab-pane active" id="mailing" role="tabpanel" aria-labelledby="mailing-tab">
                                    <div class="row">
                                       <div class="col-6 mb-3">   
                                       <label for="spPostaddress_" class="lbl_2">Address</label>                           
                                          <input type="text" class="form-control" id="address" value="<?php echo $row['address']; ?>" placeholder="Address" name="address" required>
                                       </div>
									   
									    <div class="col-6 mb-3">
                               <label for="spPostZIP_" class="lbl_2">ZIP</label>
                                          <input type="text" class="form-control" id="zip" name="zip" placeholder="ZIP" value="<?php echo $row['zipcode']; ?>" required>
                                       </div>
									   <div class="col-4 mb-3">
                                          <!--<select class="form-control form-select shadowBox" id="membership" name="country_">
                                             <option selected> Select Country</option>
                                             <option value="1" <?php if($row['country'] == 1 ){ echo "selected";} ?> >USA</option>
                                             <option value="2" <?php if($row['country'] == 2 ){ echo "selected";} ?> >Canada</option>
                                             <option value="3" <?php if($row['country'] == 3 ){ echo "selected";} ?> >ABC</option>
                                          </select>-->
										   <div class="form-group">
                                    <label for="spPostCountry_" class="lbl_2">Country</label>
                                    <select class="form-control form-select shadowBox " name="spPostCountry" id="spUserCountry_1" >
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
									   
									   
                                       <div class="col-4 mb-3">                              
                                          <!--<input type="text" class="form-control" id="state-province" name="state_province"  value="<?php echo $row['state']; ?>" placeholder="State / Province" required>-->
										  
										  				 <div class="form-group">
               <div class="loadUserState">
                                    <label for="spPostingCity"  class="lbl_3">State</label>
                                    <select class="form-control form-select shadowBox " name="spUserState" id= "spUserState_1" >
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
                                       <div class="col-4 mb-3">
                                         <!-- <input type="text" class="form-control" id="city"  name="city" value="<?php echo $row['city']; ?>" placeholder="City" required>-->
										 
										 <div class="form-group">
 <div class="loadCity">
      <label for="spPostingCity"  class="">City</label>
                                        <select class="form-control form-select shadowBox " name="spUserCity">
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
                                 </div>
                                 <div class="tab-pane active" id="cpt" role="tabpanel" aria-labelledby="cpt-tab">
                                    <div class="row">
                                       <div class="col-4">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select-payment" name="paymentterm">
                                                <option value="1" <?php if($row['payment_1'] == 1 ){ echo "selected";} ?> >Cash</option>
                                                <option value="2" <?php if($row['payment_1'] == 2 ){ echo "selected";} ?> >Credit Card</option>
                                                <option value="3" <?php if($row['payment_1'] == 3 ){ echo "selected";} ?> >Bank Account</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select-credit" name="creditterm">
                                                <option value="cod" <?php if($row['payment_2'] == "cod" ){ echo "selected";} ?> >COD</option>
                                                <option value="week"<?php if($row['payment_2'] == "week" ){ echo "selected";} ?> >Week</option>
                                                <option value="10days" <?php if($row['payment_2'] == "10days" ){ echo "selected";} ?> >10days</option>
                                                <option value="month" <?php if($row['payment_2'] == "month" ){ echo "selected";} ?> >month</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <select class="form-control form-select" id="select-payment" name="paymentterm_type">
                                             <option selected>Discount Type</option>
                                             <option value="2" <?php if($row['paymentterm_type'] == "2" ){ echo "selected";} ?> >Senior Discount</option>
                                             <option value="3" <?php if($row['paymentterm_type'] == "3" ){ echo "selected";} ?> >Children Discount</option>
                                             <option value="4" <?php if($row['paymentterm_type'] == "4" ){ echo "selected";} ?> >Celebrity Discount </option>
                                             <option value="5" <?php if($row['paymentterm_type'] == "5" ){ echo "selected";} ?> >Media Discount </option>
                                             <option value="6" <?php if($row['paymentterm_type'] == "6" ){ echo "selected";} ?> > Close Network Discount </option>
                                             <option value="7" <?php if($row['paymentterm_type'] == "7" ){ echo "selected";} ?> > Employee Discount </option>                                                  
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane active" id="note" role="tabpanel" aria-labelledby="note-tab">
                                    <div class="row">
                                       <div class="col-12">
                                       <label for="spPostNote_" class="lbl_2">Note</label>
                                          <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo $row['notes']; ?></textarea>   
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>                        
                     </div>
                  </form>
				  
		<?php }} ?>
               </div>
            </div>            
            <div class="row">
               <div class="col-lg-12 footer">                     
                  <span>Copyrights &copy; 2022 TheSharePage, All Reights Reserved</span>                    
               </div>
            </div>
         </div>
      </div>
   </div>
   <!------------------------------------------ Scripts Files ------------------------------------------>
   <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <script src="js/data.js"></script>
   <script src="js/custom-chart.js"></script>
   <script type="text/javascript">
      $(document).ready( function () {
        $('#table_id').DataTable({  
         buttons: {
           buttons: [ 'copy', 'csv', 'excel' ]
        }
     });        
     });
  </script>
  
   <script>
	  image_file.onchange = evt => {
  const [file] = image_file.files
  if (file) {
    preview_img.src = URL.createObjectURL(file) 
  }
}
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
	 
	/* function fun_ch(){
		 
		if ($("#empcheck input[type=checkbox]").prop(
		  ":checked")) {
			alert("Check box in Checked");
		} else {
			alert("Check box is Unchecked");   
		}
	 }*/
	 
	 
   document.getElementById("image_file").addEventListener("change", function() {
     validateImageFile("image_file", "image_file_error");
   });
 </script>
	  
</body>
</html>

<?php } ?>
