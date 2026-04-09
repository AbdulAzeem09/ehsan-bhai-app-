
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


//print_r($_SESSION); die();
?>

 


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Business Account & Inventory | TheSharepage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css"
            integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
            />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <style type="text/css">
            .nav-tabs .nav-item.show .nav-link, .nav-tabs .slink.active, .tab-content .stab-pane.active {
            color: #000;
            background-color: #a1c699;
            border-color: #126a00  #fff #fff;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
        <div class="row flex-nowrap">
		
		
		
           <?php include('left_side_landing.php');?>    
			
			
			
			
            <div class="col py-3">
                <div class="row mb-4">
                    <div class="col-12 p-3">
                        <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                            <h4 class="float-start">Sales Reports</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="tab-container-one pe-1">
                                            <ul class="nav flex-column nav-tabs" id="myTab" role="tablist" aria-orientation="vertical">
                                                <li class="nav-item active">
                                                    <a class="nav-link active" href="#saleByCategory" role="tab" aria-controls="saleByCategory" data-bs-toggle="tab">Sale By Category</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#saleByDayCashier" role="tab" aria-controls="saleByDayCashier" data-bs-toggle="tab">Sale By Day/Cashier</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#saleByDay_week_Month" role="tab" aria-controls="saleByDay_week_Month" data-bs-toggle="tab">Sale By Day/Week/Month</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#saleBySalesPerson_Department" role="tab" aria-controls="saleBySalesPerson_Department" data-bs-toggle="tab">Sale By SalesPerson/Department</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#saleByLot" role="tab" aria-controls="saleByLot" data-bs-toggle="tab">Sale By Lot#</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="saleByCategory" role="tabpanel" aria-labelledby="saleByCategory-tab">
                                                <h3 class="py-3">Sale By Category</h3>
                                                <form>
                                                    <div class="row justify-content-md-center">
                                                        <div class="col-auto">
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Date From</label>
                                                                    <input type="date" class="form-control"  required style="width:210px" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Date To</label>
                                                                    <input type="date" class="form-control" required style="width:210px" />
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">SalesPerson From</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">SalesPerson To</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Department From</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Department To</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Tax Area From</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tax Area To</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" required>
                                                                    <label class="form-check-label" for="invalidCheck2">with Salesperson breakdown</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" required>
                                                                    <label class="form-check-label" for="invalidCheck2">with Deparment breakdown</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" required>
                                                                    <label class="form-check-label" for="invalidCheck2">Supperess Subcategory breakdown</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" required>
                                                                    <label class="form-check-label" for="invalidCheck2">Print with Cost</label>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#productdata"><i class="fas fa-print"></i> Print</button>      
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="saleByDayCashier" role="tabpanel" aria-labelledby="saleByDayCashier-tab">
                                                <h3 class="py-3">Sale By Day Cashier</h3>
                                                <form>
                                                    <div class="row justify-content-md-center">
                                                        <div class="col-auto">
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Date From</label>
                                                                    <input type="date" class="form-control"  required style="width:210px" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Date To</label>
                                                                    <input type="date" class="form-control" required style="width:210px" />
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Cashier From</label>
                                                                   <!-- <input type="text" class="form-control" required />-->
																    <select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" name=" "><option value="">Select Users</option>
												 <?php
					$p = new _pos;
					
							$result_1 = $p->read_users($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['user_name']; ?></option>
                          
						   
					<?php }} ?>  

                                                </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Cashier To</label>
                                                                    <!--<input type="text" class="form-control" required />-->
																	 <select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" name=" "><option value="">Select Users</option>
												 <?php
					$p = new _pos;
					
							$result_1 = $p->read_users($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['user_name']; ?></option>
                          
						   
					<?php }} ?>  

                                                </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" required>
                                                                    <label class="form-check-label" for="invalidCheck2">with Cashier breakdown</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" required>
                                                                    <label class="form-check-label" for="invalidCheck2">Print with Cost</label>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#productdata"><i class="fas fa-print"></i> Print</button>      
                                                        </div>
                                                    </div>
                                                </form>2147647038
                                            </div>
                                            <div class="tab-pane" id="saleByDay_week_Month" role="tabpanel" aria-labelledby="saleByDay_week_Month-tab">
                                                <h3 class="py-3">Sale By Day/Week/Month</h3>
                                                <form action="<?php echo $BaseUel; ?>/mpdf_new/pdf.php" method="post"> 
                                                    <div class="row justify-content-md-center">
                                                        <div class="col-auto">
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Date From</label>
                                                                    <input type="date" name="start_date" class="form-control" placeholder="Type Payment Method" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Date To</label>
                                                                    <input name="end_date" type="date" class="form-control" placeholder="Type Payment Method" required />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Select Duration</label>
                                                                <select class="form-control form-select mb-3" id="select-payment" name="paymentterm_1">
                                                                    <option value="1">Day</option>
                                                                    <option value="2">Week</option>
                                                                    <option value="3">Month</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Group By</label>
                                                                <select class="form-control form-select mb-3" id="select-payment" name="paymentterm_2">
                                                                    <option value="1">Day</option>
                                                                    <option value="2">Week</option>
                                                                    <option value="3">Month</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="print_cost" type="checkbox" value="" required>
                                                                    <label class="form-check-label" for="invalidCheck2">Print Cost</label>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#productdata"><i class="fas fa-print"></i> Print</button>      
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="saleBySalesPerson_Department" role="tabpanel" aria-labelledby="saleBySalesPerson_Department-tab">
                                                <h3 class="py-3">Sale By SalesPerson/Department</h3>
                                                <form>
                                                    <div class="row justify-content-md-center">
                                                        <div class="col-auto">
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Date From</label>
                                                                    <input type="date" class="form-control"  required style="width:210px" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Date To</label>
                                                                    <input type="date" class="form-control" required style="width:210px" />
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">SalesPerson From</label>
                                                                    <!--<input type="text" class="form-control" required />-->
																	 <select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" name=" "><option value="">Select Users</option>
												 <?php
					$p = new _pos;
					
							$result_1 = $p->read_users($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['user_name']; ?></option>
                          
						   
					<?php }} ?>  

                                                </select>
																	
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">SalesPerson To</label>
                                                                    <!--<input type="text" class="form-control" required />-->
																	
																	 <select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" name=" "><option value="">Select Users</option>
												 <?php
					$p = new _pos;
					
							$result_1 = $p->read_users($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['user_name']; ?></option>
                          
						   
					<?php }} ?>  

                                                </select>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Department From</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Department To</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Tax Area From</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tax Area To</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                                                    <label class="form-check-label" for="invalidCheck2">with Salesperson breakdown</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                                                    <label class="form-check-label" for="invalidCheck2">with Deparment breakdown</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                                                    <label class="form-check-label" for="invalidCheck2">Supperess Subcategory breakdown</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                                                    <label class="form-check-label" for="invalidCheck2">Print with Cost</label>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#productdata"><i class="fas fa-print"></i> Print</button>      
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="saleByLot" role="tabpanel" aria-labelledby="saleByLot-tab">
                                                <h3 class="py-3">Sale By Lot#</h3>
                                                <form>
                                                    <div class="row justify-content-md-center">
                                                        <div class="col-auto">
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Date From</label>
                                                                    <input type="date" class="form-control"  required style="width:210px" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Date To</label>
                                                                    <input type="date" class="form-control" required style="width:210px" />
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-2">
                                                                    <label class="form-label">Lot# From</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Lot# To</label>
                                                                    <input type="text" class="form-control" required />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                                                    <label class="form-check-label" for="invalidCheck2">with Lot breakdown</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                                                    <label class="form-check-label" for="invalidCheck2">Print with Cost</label>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#productdata"><i class="fas fa-print"></i> Print</button>      
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        </div>
        <!-- Modal Customer Details -->
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-main text-light">
                        <h5 class="modal-title" id="exampleModalLabel">Customers Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-main">Save changes</button>
                    </div>
                    </form>
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
            $(document).ready(function () {
                $("#payment_table").DataTable({                 
                 searching: false,
                 paging: false,     
             });
                $("#qty_table").DataTable({                 
                 searching: false,
                 paging: false,     
             });
                $("#duration_table").DataTable({                 
                 searching: false,
                 paging: false,     
             });
                $("#tax_table").DataTable({                 
                 searching: false,
                 paging: false,     
             });
                $("#deparment_table").DataTable({                 
                 searching: false,
                 paging: false,     
             });
                $("#category_table").DataTable({                 
                 searching: false,
                 paging: false,     
             });                
                $("#branches_table").DataTable({                 
                 searching: false,
                 paging: false,     
             });
                $("#users_table").DataTable();
                $("#roles_table").DataTable({                 
                 searching: false,
                 paging: false,     
             });
                $("#discount_table").DataTable({                 
                 searching: false,
                 paging: false,     
             });
            });
        </script>
		
		<script type="text/javascript">
   $(document).ready(function() {
     $('.js-example-basic-multiple').select2();
  });
</script>
 <script type="text/javascript">
         $(document).ready(function () {
          $('#example').DataTable();
          "columnDefs": [
          { "searchable": false, "targets": 0 }
          ]
         });
         
      </script>
	  
    </body>
</html>
<?php } ?>