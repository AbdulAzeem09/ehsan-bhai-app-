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
         <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-side">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 mainnav">
               <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                  <span class="fs-5 d-none d-sm-inline">POINT OF SALE</span>
               </a>
               <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                  <li><a href="index.html" class="nav-link px-0 align-middle"><i class="fas fa-tachometer-alt"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>                        
                  </li>
                  <li><a href="pos.html" target="_blank" rel="noopener noreferrer" class="nav-link px-0 align-middle"><i class="fas fa-cash-register"></i> <span class="ms-1 d-none d-sm-inline">POS</span> </a>                        
                  </li>
                  <li><a href="#product" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fab fa-product-hunt"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                     <ul class="collapse nav flex-column ms-1" id="product" data-bs-parent="#menu">
                        <li class="w-100">
                           <a href="category.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Categories</span></a>
                        </li>
                        <li>
                           <a href="attributes.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Attributes</span></a>
                        </li>
                        <li>
                           <a href="brands.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Brands</span></a>
                        </li>
                        <li>
                           <a href="add-product.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Add Product</span></a>
                        </li>
                        <li>
                           <a href="product-list.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Product List</span></a>
                        </li>
                     </ul>
                  </li>
                  <li><a href="#customer" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                     <ul class="collapse nav flex-column ms-1" id="customer" data-bs-parent="#menu">
                        <li class="w-100">
                           <a href="customer-add.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Add Customer</span></a>
                        </li>
                        <li class="w-100">
                           <a href="customer-import.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Import Customer</span></a>
                        </li>
                        <li>
                           <a href="customer-list.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Customer's List</span></a>
                        </li>
                        <li>
                           <a href="customer-sale-history.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Sales History</span></a>
                        </li>                      
                     </ul>
                  </li>
                  <li><a href="#Suppliers" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Suppliers</span> </a>
                     <ul class="collapse nav flex-column ms-1" id="Suppliers" data-bs-parent="#menu">
                        <li class="w-100">
                           <a href="Suppliers-add.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Add Suppliers</span></a>
                        </li>
                        <li class="w-100">
                           <a href="Suppliers-import.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Import Suppliers</span></a>
                        </li>
                        <li>
                           <a href="Suppliers-list.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Supplier's List</span></a>
                        </li>
                        <li>
                           <a href="Suppliers-sale-history.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Sales History</span></a>
                        </li>                      
                     </ul>
                  </li>
                  <li><a href="#inventory" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fas fa-th-large"></i> <span class="ms-1 d-none d-sm-inline">Inventory</span> </a>
                     <ul class="collapse nav flex-column ms-1" id="inventory" data-bs-parent="#menu">
                        <li class="w-100">
                           <a href="receive-inventory.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Receive Inventory</span></a>
                        </li>
                        <li class="w-100">
                           <a href="return-inventory.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Return Inventory</span></a>
                        </li>
                        <li>
                           <a href="adjust-inventory.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Adjust Inventory</span></a>
                        </li>
                        <li>
                           <a href="transfer-inventory.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Transfer Inventory</span></a>
                        </li>
                        <li>
                           <a href="unposted-inventory.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Unposted Inventory</span></a>
                        </li>
                        <li>
                           <a href="inventory-audit.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Inventory Audit</span></a>
                        </li>                      
                     </ul>
                  </li>
                  <li><a href="#purchase" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fas fa-cart-arrow-down"></i> <span class="ms-1 d-none d-sm-inline">Purchase</span> </a>
                     <ul class="collapse nav flex-column ms-1" id="purchase" data-bs-parent="#menu">
                        <li class="w-100">
                           <a href="create-po.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Create PO</span></a>
                        </li>
                        <li class="w-100">
                           <a href="sent-po.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Sent PO</span></a>
                        </li>
                        <li>
                           <a href="draft-po.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Draft PO</span></a>
                        </li>
                        <li>
                           <a href="receive-inventory-by-po.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Received Inventory by PO</span></a>
                        </li>                   
                     </ul>
                  </li>
                  <li><a href="#reports" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fas fa-scroll"></i> <span class="ms-1 d-none d-sm-inline">Reports</span> </a>
                     <ul class="collapse nav flex-column ms-1" id="reports" data-bs-parent="#menu">
                        <li class="w-100">
                           <a href="sale-history.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Sales History</span></a>
                        </li>                        
                        <li>
                           <a href="custom-purchase.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Custom Purchase Report</span></a>
                        </li>  
                        <li>
                           <a href="stock-movement.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Stock Movement</span></a>
                        </li>              
                     </ul>
                  </li>              
                  <li><a href="store.html" class="nav-link px-0 align-middle"><i class="fas fa-store"></i> <span class="ms-1 d-none d-sm-inline">Store</span></a>
                  </li>
                  <li><a href="settings.html" class="nav-link px-0 align-middle"><i class="fas fa-cogs"></i> <span class="ms-1 d-none d-sm-inline">Settings</span></a>
                  </li>
               </ul>
               <hr>
               <div class="dropdown pb-4 profile">
                  <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="img/user.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                     <span class="d-none d-sm-inline mx-1">Jhone Dev</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                     <li><a class="dropdown-item" href="#">Settings</a></li>
                     <li><a class="dropdown-item" href="#">Profile</a></li>
                     <li>
                        <hr class="dropdown-divider">
                     </li>
                     <li><a class="dropdown-item" href="#">Sign out</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col py-3">
            <div class="row mb-4">
               <div class="col-12">
                  <h3>Sent PO List</h3>
                  <div class="row justify-content-md-center">                     
                      <div class="col-4 mb-3">
                        <label>Select Vendor</label>
                        <select class="form-control form-select js-example-basic-multiple" id="inputGroupSelect02" name="customer">
                           <option value="1">All Vendors</option>
                           <option value="2">Dave</option>
                           <option value="3">Yusha</option>
                        </select>
                     </div>
                     <div class="col-2 mb-3">
                        <label>Date From</label>
                        <input type="date" class="form-control" placeholder="Choose Date Start"  aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-2 mb-3">
                        <label>Date To</label>
                        <input type="date" class="form-control" placeholder="Choose Date End"  aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-2 mb-3">
                        <button type="button" class="btn btn-main mt-4"><i class="fas fa-filter"></i> Show</button> 
                     </div>
                  </div> 
                  <div class="info"></div>
                  <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
                   <thead>
                    <tr>
                     <th>Sent Date</th>
                     <th>PO#</th>
                     <th>Qty</th>
                     <th>Price</th>
                     <!-- <th>Discount</th>
                     <th>Size</th>
                     <th>Color</th> -->
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>                    
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>                  
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>
                  <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>5</td>
                     <td>$15</td>
                     <!-- <td>%5</td>
                     <td>N/A</td>
                     <td>N/A</td> -->
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a></td>
                  </tr>
               </tbody>
            </table>
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
     var table = $('#table_id').dataTable( );
    
  } );
</script>
</body>
</html>