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
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===== INPAGE SCRIPTS====== -->       
        <?php include('../../component/dashboard-link.php'); ?>
  <style type="text/css">
.buyer{
    max-width: 100px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.modal {
}
.vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
}
.vertical-align-center {
    /* To center vertically */
    display: table-cell;
    vertical-align: middle;
}
.modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width:inherit;
    height:inherit;
    /* To center horizontally */
    margin: 0 auto;
}
</style>      
    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                   <!--  <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php 
                        $activePage = 15;
                       // include('left-menu.php'); 
                        ?> 
                    </div> -->
                      <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-buyermenu.php'); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
                        $storeTitle = "Buyer Dashboard / My Orders";
                        $folder = "store";
                       // include('../top-dashboard.php');
                       // include('../searchform.php');                       
                        ?>
                        
                        <div class="row">
                           <!--   <div class="col-md-12">
                                    

                                     <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
                                       <li><a href="#">Returning Items</a></li>
                                    
                                    </ul>
                    


                                <div class="text-right" style="margin-top: -10px;">
                                       <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                    </ul>
                            

                                </div>
                            </div>
 -->
                             <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

                         <li><a href="#">Returning Items</a></li>
                                     
                          </ul>
                            </div>


 <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
				   <style type="text/css">
    .paginate_button {
  border-radius: 0 !important;
}
</style>
<!-- table list open -->
 
                            <div class="col-md-12 ">
                                <div class="">
								<?php
                                                $p = new _spstorereturning_product;
                                              
                                               $result = $p->getbuyerproduct($_SESSION['pid']);

                                                if ($result!=false) {
													$tableid="example1";
												}
												else{
												$tableid='';
												}
											
													
													?>
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
										<table class="table tbl_store_setting display " id="<?php echo $tableid;?>" cellspacing="0" width="100%" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">No.</th>
                                                    <th>Product Name</th>
                                                    <th>Why are you returning this?</th>
                                                    <th class="text-center"  style="width: 16.66%">Buyer Comment</th>
                                                   

                                                    <th>Status</th>
                                                    <th>Seller Comment</th>
                                                    
                                                </tr>
                                            </thead>
                                            
                                                <?php
                                                $p = new _spstorereturning_product;
                                              
                                               $result = $p->getbuyerproduct($_SESSION['pid']);

                                                if ($result!=false) {?>
												<tbody>
                                                <?php     $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        //extract($row);
                                                     
													 
                                                       //echo "<pre>";
                                                       //print_r($row);

                                                        $sellerprofilid  = $row['spSellerProfileId'];

                                                      $productname  = $row['spproduct_title'];
                                                        $Response  = $row['response'];
                                                           $buyerComment  = $row['comments'];
                                                               $status  = $row['status'];

                                                    







                                                      $sl = new _sellercomment;
                                                $commresult  = $sl->getsellercomment($row['id']);
                                                        // echo $sl->ta->sql;            

                                                                    if($commresult != false)
                                                                       {
                                                   while ($commrow = mysqli_fetch_assoc($commresult)) {

                                                      $Sellercomment = $commrow["sellercomments"];
                                                      $Scommentid = $commrow["id"];
                                                      $commid = $commrow["comment_id"];
                                                                                                                               
                                                            
                                                             }
                                                           }

                                                       

                                                         
                                                    
         
                                                        ?>
                                                       

                                <!-- Modal -->
<div class="modal fade" id="<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
           <div class="modal-content no-radius bradius-15 ">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Buyer Comment</h4>

                </div>
                <div class="modal-body"><p style="padding: 8px;"><?php echo $buyerComment; ?></p></div>
                <div class="modal-footer" style="border-top-color: #fff;">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                  <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>
                                        
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td class="eventcapitalize"><?php echo $productname; ?></td>
                                                            <td><?php echo $Response; ?></td>
                                                    <td class="buyer">
                                            <a href=""data-toggle="modal" data-target="#<?php echo $row['id'];?>"><?php echo $buyerComment; ?></a>
                                                        </td>
                                                           
                                                            <td><?php echo  $status; ?></td>
                                                          

                                                           <td class="buyer">    
                                                            
                                                     <?php if (isset($Sellercomment) && $row['id'] == $commid) { ?>
                                                 <a href=""data-toggle="modal" data-target="#s<?php echo $Scommentid;?>"><?php  echo $Sellercomment; ?></a>
                                                          
                                                      <?php  }else{ ?>
                                                          <p>No Comment</p>
                                                       <?php } ?></td>



                                                           

   <!-- Modal -->
<div class="modal fade" id="s<?php echo $Scommentid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content no-radius bradius-15 ">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                 <h4 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Seller Comment</h4>

                </div>
           <div class="modal-body"><p style="padding: 8px;"><?php  echo $Sellercomment; ?>

       </p></div>
                <div class="modal-footer" style="border-top-color: #fff;">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                  <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>                                                        
                                                         
                                                      
                                                           
                                                        </tr>

         
                                                        <?php
                                                        $i++;
                                                    }?>
													</tbody>
                                                <?php }
                                                 else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="7">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                ?>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
                       
					   <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
					   
					   <script type="text/javascript">
    $(document).ready(function() {

  var table = $('#example1').DataTable({ 
        select: false,
        "columnDefs": [{
            className: "Name", 
            "targets":[0],
            "visible": false,
            "searchable":false
        }]
    });//End of create main table

  
  $('#example tbody').on( 'click', 'tr', function () {
   
   // alert(table.row( this ).data()[0]);

});
	});
  </script>
                        </div>

                    </div>
                </div>
            </div>
        </section>



      <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
       
    </body>
</html>
<?php
}
?>