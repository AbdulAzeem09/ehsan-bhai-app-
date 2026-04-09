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
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Business Account & Inventory | TheSharepage </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
   <div class="container-fluid">
      <div class="row flex-nowrap">
	  
	 <?php include('left_side_landing.php');?>   
	  
         <div class="col py-3">
            <div class="row mb-4">
               <div class="col-12 p-3">
                  <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                     <h4 class="float-start"> Add New Customer</h4>
                     <span class="float-end">
                         <a href="customer-list.php" class="btn btn-outline-secondary me-3">Customer List</a>
                        <button type="submit" form="addcustomer" class="btn btn-main me-3"><i class="fas fa-plus"></i> Add Customer</button>
                     </span>
                  </div>
                  <form action="<?php echo $BaseUrl; ?>/store/pos-dashboard/add_detail.php" method="post" enctype="multipart/form-data" class="" id="addcustomer">
                     <div class="row">
                        <div class="col-8">
                           <div class="row">
                            
                              <div class="col-6 mb-3">
                                 <input type="text" class="form-control shadowBox" id="customername" placeholder="Customer Name" name="customername" value="" >
                              </div>
							  <div class="col-6 mb-3" id="add_membership">
                                 <select class="form-control form-select shadowBox" id="submembership" name="submembership" >
                                    <option selected> Select Sub Membership</option>
                            
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-6 mb-3">
                                 <input type="number" class="form-control shadowBox" id="customerphone" placeholder="Customer Phone" name="customerphone" value="" >
                              </div>
                              <div class="col-6 mb-3">
                                 <input type="email" class="form-control shadowBox" id="customeremail" placeholder="Customer Email" name="customeremail" value="" >
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-6 mb-3">
                                 <select class="form-control form-select shadowBox" id="customertype" name="customertype">
                                    <option selected> Select Customer Type</option>
                                    <option value="1">Retail</option>
                                    <option value="2">Whole Sale</option>
                                    <option value="3">Domeste</option>
                                 </select>
                              </div>
                            
                           </div>
                           <div class="row">
                              <div class="col-8 mb-4">
                                 <!--<select class="form-control form-select shadowBox" id="membership" name="membership">
                                    <option selected> Select Membership Type</option>
                                    <option value="1">Browns</option>
                                    <option value="2">Silver</option>
                                    <option value="3">Gold</option>
									
									
                                 </select>--> <br> 
								 <input onclick="fun_Membership_qty()" class="form-radio-input" type="radio" value="1" id="Membership_qty"  name="membership">
                                       <label class="form-radio-label" for="Membership_qty">Membership By Quantity</label>
									   
									   <input onclick="fun_Membership_dur()"  value="2" class="form-radio-input" type="radio" id="Membership_dur" name="membership" >
                                       <label class="form-radio-label" for="Membership_dur">Membership By Duration</label>
                              </div>
                              
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="form-group d-flex">
                                    <div class="form-check me-4">
                                       <input class="form-check-input" type="checkbox" value="1" id="emailcheck" name="emailcheck" >
                                       <label class="form-check-label" for="emailcheck">Receive Email & Newsletter</label>
                                    </div>
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="1" id="empcheck" name="empcheck">
                                       <label class="form-check-label" for="empcheck">Is this customer an employee of this business?</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="profile-img mb-4 border border-3 text-center p-2">
                              <img src="" class="img-sm img-fluid img-thumbnail mb-2" id= "preview_img">   
                              <input type="file" class="form-control shadowBox" name="profile_img" id="image_file" style="width:310px; text-align: center;">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12">
                           <div class="tab-container-one">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                 <li class="nav-item active">
                                    <a class="nav-link active" href="#mailing" role="tab" aria-controls="mailing" data-bs-toggle="tab">Mailing / Preference</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#cpt" role="tab" aria-controls="cpt" data-bs-toggle="tab">Credit & Payment Terms</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#note" role="tab" aria-controls="note" data-bs-toggle="tab">Note</a>
                                 </li>
                              </ul>
                              <div class="tab-content">
                                 <div class="tab-pane active" id="mailing" role="tabpanel" aria-labelledby="mailing-tab">
                                    <div class="row">
                                       <div class="col-6 mb-3">                              
                                          <input type="text" class="form-control" id="address" name="address" placeholder="Address" >
                                       </div>
									    <div class="col-6 mb-3">
                                          <input type="text" class="form-control" id="zip" name="zip" placeholder="ZIP" >
                                       </div>
									   
									    <div class="col-4 mb-3">
                                          <!--<select class="form-control form-select shadowBox" id="membership" name="country_">
                                             <option selected> Select Country</option>
                                             <option value="1">USA</option>
                                             <option value="2">Canada</option>
                                             <option value="3">ABC</option>
                                          </select>-->
										  
							 <div class="form-group">
                                    <label for="spPostCountry_" class="lbl_2">Country</label>
                                    <select class="form-control form-select shadowBox" name="spPostCountry" id="spUserCountry">
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
									   
                                       <div class="col-4 mb-3">                              
                                          <!--<input type="text" class="form-control" id="state-province" name="state_province" placeholder="State / Province" >-->
		 <div class="form-group">
               <div class="loadUserState">
                                    <label for="spPostingCity"  class="lbl_3">State</label>
                                    <select class="form-control form-select shadowBox spPostingsState"  name="spUserState">
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
                                       <div class="col-4 mb-3">
                                         <!-- <input type="text" class="form-control" id="city" name="city" placeholder="City" >-->
										 
		 <div class="form-group">
 <div class="loadCity">
      <label for="spPostingCity"  class="">City</label>
                                        <select class="form-control form-select shadowBox" name="spUserCity">
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
                                 </div>
                                 <div class="tab-pane" id="cpt" role="tabpanel" aria-labelledby="cpt-tab">
                                    <div class="row">
                                       <div class="col-4">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select-payment" name="paymentterm">
                                                <option value="1">Cash</option>
                                                <option value="2">Credit Card</option>
                                                <option value="3">Bank Account</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select-credit" name="creditterm">
                                                <option value="cod">COD</option>
                                                <option value="week">Week</option>
                                                <option value="10days">10days</option>
                                                <option value="month">month</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <select class="form-control form-select" id="select-payment" name="paymentterm_type">
                                             <option selected>Discount Type</option>
                                             <option value="2">Senior Discount</option>
                                             <option value="3">Children Discount</option>
                                             <option value="4">Celebrity Discount </option>
                                             <option value="5">Media Discount </option>
                                             <option value="6"> Close Network Discount </option>
                                             <option value="7"> Employee Discount t </option>                                                 
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="note" role="tabpanel" aria-labelledby="note-tab">
                                    <div class="row">
                                       <div class="col-12">
                                          <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>                        
                     </div>
                  </form>
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
	 
		  $("#spUserCountry").on("change", function () { 
		var a = $("#spUserCountry").val();
		  $.post("../loadUserState.php", {countryId: a}, function (r) {
               // alert(r);
                $(".loadUserState").html(r);
            });
	 });
	 
	 
	 
	 }); 
	 
	  function fun_Membership_qty(){
		  
		  
			var tbl = "membership_qty";
			 $.ajax({
					url: 'read_data_membership.php',  
					type: 'post',
					
					data: {tbl:tbl} ,    
					 
					success: function(response){ 
					
					//alert(response);
					
					$('#add_membership').html(response);  
					}

					});
	  }
	  
	  function fun_Membership_dur(){
		  
		  
			var tbl = "membership_dur";
			 $.ajax({
					url: 'read_data_membership.php',  
					type: 'post',
					
					data: {tbl:tbl} ,    
					 
					success: function(response){ 
					
					//alert(response);
					
					$('#add_membership').html(response);  
					}

					});
	  }
	 
	 
   
 </script>
	  
</body>
</html>
<?php } ?>