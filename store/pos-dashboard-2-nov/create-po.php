<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Business Account & Inventory | TheSharepage </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
           <div class="row align-self-stretch">
            <div class="d-flex justify-content-between border-bottom mb-3">
               <h4 class="float-start"> Create PO</h4>               
            </div>
            <div class="col-12 mb-3">
               <div class="border-3 border-primary border-top p-1 bg-light shadowBox">
                  <div class="mb-1">
                     <div class="input-group d-flex mobile-view">                        
                        <div class="col-md-6 col-sm-12 pe-2">
                           <select class="form-control mb-3 form-select js-example-basic-multiple" id="inputGroupSelect02" name="supplier">
                              <option value="1">Jhone</option>
                              <option value="2">Dave</option>
                              <option value="3">Yusha</option>
                           </select>  
                           <div class="d-flex">
                              <input type="text" class="form-control mb-3 mt-3 me-2" placeholder="Vendor ID" aria-label="vendorID" aria-describedby="addon-wrapping">                                                   
                              <input type="text" class="form-control mb-3 mt-3 me-2" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">                                                   
                              <input type="text" class="form-control mb-3 mt-3" placeholder="Phone" aria-label="phone" aria-describedby="addon-wrapping">      
                           </div>                                             
                        </div>
                        <div class="col-md-6 col-sm-12">
                           <div class="d-flex">
                              <input type="text" class="form-control mb-3 me-2" placeholder="PO#" aria-label="poNo" aria-describedby="addon-wrapping">
                               <input type="date" class="form-control mb-3 me-2"  aria-label="invDate:" aria-describedby="addon-wrapping"> 
                              <input type="text" class="form-control mb-3" placeholder="Ordered By#" aria-label="invNo" aria-describedby="addon-wrapping">                             
                           </div>  
                           <div class="d-flex">
                              <input type="text" class="form-control mb-3 me-2" placeholder="Last Receive Date" aria-label="lastReceiveDate" aria-describedby="addon-wrapping">
                               <input type="text" class="form-control mb-3 me-2" placeholder="ETD Date" aria-label="etdDAte:" aria-describedby="addon-wrapping"> 
                              <input type="text" class="form-control mb-3" placeholder="ETA Date" aria-label="etaDate" aria-describedby="addon-wrapping">                             
                           </div>                                                      
                        </div>                                                      
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12">
               <div class="border-3 border-success border-top p-3 bg-orange shadowBox">
                  <div class="">
                     <form method="post" action="#">
                        <div class="d-flex justify-content-center input-group">
                           <div class="col-md-1 col-sm-12">
                              <input type="text" class="form-control me-2" placeholder="Barcode" aria-label="Barcode" aria-describedby="addon-wrapping">
                           </div>
                           <div class="col-md-2 col-sm-12">
                              <select class="form-control me-2 form-select js-example-basic-multiple" id="select-product" name="products">
                                 <option value="1">Banna</option>
                                 <option value="2">Apple</option>
                                 <option value="3">Water Bottle</option>
                              </select>
                           </div>
                           <div class="col-md-1 col-sm-12">
                             <input type="date" class="form-control me-2" aria-label="shipDate" aria-describedby="addon-wrapping">
                        </div>
                        <div class="col-md-1 col-sm-12">
                            <input type="text" class="form-control me-2" placeholder="Qty" aria-label="qty" aria-describedby="addon-wrapping">
                        </div>                           
                        <div class="col-md-1 col-sm-12">
                           <input type="text" class="form-control me-2" placeholder="P Unit" aria-label="pUnit" aria-describedby="addon-wrapping">
                        </div>
                        <div class="col-md-1 col-sm-12">
                           <input type="text" class="form-control me-2" placeholder="Conv" aria-label="conv" aria-describedby="addon-wrapping">
                        </div>
                        <div class="col-md-1 col-sm-12">
                           <input type="text" class="form-control me-2" placeholder="Unit Cost" aria-label="unitCost" aria-describedby="addon-wrapping">
                        </div> 
                        <div class="col-md-1 col-sm-12">
                           <input type="text" class="form-control me-2" placeholder="Total Cost" aria-label="TotalCost" aria-describedby="addon-wrapping">
                        </div> 
                        <div class="col-md-1 col-sm-12">
                           <div class="form-check ms-2 mt-2">
                              <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                              <label class="form-check-label" for="invalidCheck2">GST</label>
                           </div>
                        </div> 
                        <div class="col-1">
                           <button type="button" class="btn btn-success float-end me-5" data-bs-toggle="modal" data-bs-target="#productdata"> Add</button>
                        </div>                            
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-lg-12 top-product">
            <div style="overflow-x:auto;"></div>
            <table id="example" class="table bg-light table-striped shadowBox">
               <thead>
                  <tr>
                     <th>Barcode</th>
                     <th>Product Name</th>
                     <th>Ship Date</th>
                     <th>Qty</th>
                     <th>On Hand</th>
                     <th>Qty Sold</th>
                     <th>Min Stock</th>
                     <th>Reg Stock</th>
                     <th>S Unit</th>
                     <th>Conv</th>
                     <th>Qty Recv</th>
                     <th>Unit Cost</th>
                     <th>Total Cost</th>
                     <th>GST</th>
                     <th>Notes</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>|||||||||||</td>
                     <td>Bannana</td>
                     <td>26-09-22</td>
                     <td>0</td>
                     <td>5</td>
                     <td>3</td>
                     <td>12</td>
                     <td>5</td>
                     <td>6</td>
                     <td> 5 </td>
                     <td> 7 </td>
                     <td>$30.00</td>
                     <td>$60.00</td>
                     <td>3%</td>
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> </td>
                  </tr>
                  <tr>
                     <td>|||||||||||</td>
                     <td>Bannana</td>
                     <td>26-09-22</td>
                     <td>0</td>
                     <td>5</td>
                     <td>3</td>
                     <td>12</td>
                     <td>5</td>
                     <td>6</td>
                     <td> 5 </td>
                     <td> 7 </td>
                     <td>$30.00</td>
                     <td>$60.00</td>
                     <td>3%</td>
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <div class="row d-flex mobile-view summary">
         <div class="col-md-12 col-sm-12 bg-light shadowBox">
            <div class="row">

               <div class="col-1">
                  <span class="input-group-text" id="addon-wrapping">Cost</span>
                  <input type="text" class="disabled" readonly aria-label="On Hand Quantity" aria-describedby="addon-wrapping">
               </div>                                   
               <div class="col-1">
                  <span class="input-group-text" id="addon-wrapping">Regular</span>
                  <input type="text" class="disabled" readonly aria-label="On Order Quantity" aria-describedby="addon-wrapping">
               </div>
               <div class="col-1">
                  <span class="input-group-text" id="addon-wrapping">Hand</span>
                  <input type="text" class="disabled" readonly aria-label="Hand" aria-describedby="addon-wrapping"> 
               </div>
               <div class="col-1">
                  <span class="input-group-text" id="addon-wrapping">Hold</span>
                  <input type="text" class="disabled" readonly aria-label="hold" aria-describedby="addon-wrapping"> 
               </div>                  
               <div class="col-1">
                  <span class="input-group-text" id="addon-wrapping">Order</span>
                  <input type="text" class="disabled" readonly aria-label="Order" aria-describedby="addon-wrapping"> 
               </div>
               <div class="col-2">
                  <span class="input-group-text" id="addon-wrapping">Cust Order</span>
                  <input type="text" class="disabled" readonly  aria-label="Tax" aria-describedby="addon-wrapping"> 
               </div>
               <div class="col-2">
                  <span class="input-group-text" id="addon-wrapping">Total Qty</span>
                  <input type="text" class="disabled" readonly  aria-label="Total Qty" aria-describedby="addon-wrapping"> 
               </div>
               <div class="col-2">
                  <span class="input-group-text" id="addon-wrapping">GST</span>
                  <input type="number" class=""  aria-label="gst" aria-describedby="addon-wrapping"> 
               </div>

            </div>
         </div>            
         <div class="col-12 bg-light shadowBox"> 
            <div class="d-flex flex-nowrap float-start mt-2 mb-3">               
                  <label class="me-3 mt-1" id="addon-wrapping">Misc Charges</label>
                  <input type="text" class="me-3" style="width: 100px;" aria-label="misccharges" aria-describedby="addon-wrapping"> 
                  <select class="form-control me-2 form-select"  style="width:150px;" id="select-miscType" name="miscType">
                     <option selected>Select Misc</option>
                     <option value="2">Shipping</option>
                     <option value="3">Other</option>
                     <option value="3">Packaging</option>
                  </select>
                  <label class="me-3 mt-1" id="addon-wrapping">Total</label>
                  <input type="text" class="me-3" style="width: 100px;" aria-label="misccharges" aria-describedby="addon-wrapping"> 
            </div> 
            <div class="-d-flex float-end">              
               <input type="button" class="btn btn-main float-end ps-2 pe-2 m-2" data-bs-toggle="modal" data-bs-target="#" name="print" value="Generate">
               <input type="button" class="btn btn-success float-end ps-2 pe-2 m-2" data-bs-toggle="modal" data-bs-target="#" name="print" value="Ship Date">
               <input type="button" class="btn btn-success float-end ps-2 pe-2 m-2" data-bs-toggle="modal" data-bs-target="#" name="print" value="Import">
               <input type="button" class="btn btn-success float-end ps-2 pe-2 m-2" data-bs-toggle="modal" data-bs-target="#" name="print" value="Add Email">
               <input type="button" class="btn btn-success float-end ps-2 pe-2 m-2" data-bs-toggle="modal" data-bs-target="#" name="print" value="Add Print">
               <input type="submit" class="btn btn-primary float-end ps-2 pe-2 m-2" name="" value="Hold">
               <input type="button" class="btn btn-secondary float-end ps-2 pe-2 m-2" data-bs-toggle="modal" data-bs-target="#helpModal"  value="Help">
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
<!-------------------------------- All Modals ----------------------------------->     
<!-- Modal Help -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="helpM">Help Option</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-6">
                  <div class="d-flex flex-wrap" role="group" aria-label="First group">
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Item List</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Item Stock History</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Item Sales History</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Customer List </button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Customer Sales Hisoty </button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Customer Transation History</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Item Search By Serial#</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Item Search By Tack#</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Gift Card History</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Debit Card</button>
                  </div>
               </div>
               <div class="col-6">
                  <img src="img/help.jpg" class="img-fluid">
               </div>
            </div>
         </div>
         <div class="modal-footer">                  
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<!------------------------------------------ Scripts Files ------------------------------------------>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript" src="js/custom-chart.js"></script>     
<script type="text/javascript">
   $(document).ready(function () {
     $('#example').DataTable();
     "columnDefs": [
     { "searchable": false, "targets": 0 }
     ]
  });

</script>
<script type="text/javascript">
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
 });
</script>
</body>
</html>