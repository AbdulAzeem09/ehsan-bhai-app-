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
                        $activePage = 22;
                        //include('left-menu.php'); 
                        ?> 
                    </div> -->
                     <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-sellermenu.php'); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
                        $storeTitle = " Dashboard / Active Products";
                       // include('../top-dashboard.php');
                        //include('../searchform.php');                       
                        ?>
                        
                        <div class="row">

                          

                                 <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                         <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Auction List</a></li>
                                     
                          </ul>
                            </div>
                                          <!-- <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Auction List</a></li>
                                     
                                    </ul> -->
                                
<!-- 
                                <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div> -->

                      <!--   <div class="col-md-12">
                                <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                       
                                       <li><a href="<?php echo $BaseUrl.'/store/dashboard/auctionactive_product.php'; ?>" class="<?php echo ($activePage == 22)?'active':''?>">Open</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/auctionclose_product.php';?>" class="<?php echo ($activePage == 24)?'active':''?>">Closed</a></li>
                                       
                                       </ul>
                                </div>
                            </div> -->



<div class="col-md-12">
            <div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">
         <div class="panel-heading" style="padding: 0px!important;background-color: #BACCE8;
    border-color: #BACCE8;">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1warning" data-toggle="tab">Open</a></li>
                           <!--  <li><a href="#tab2warning" data-toggle="tab">Closed</a></li> -->
                           
                           <!--  <li><a href="#tab3warning" data-toggle="tab">Paid Bid</a></li> -->
                       
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1warning">

                   <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
    .paginate_button {
  border-radius: 0 !important;
}
</style>
<?php 
	 $p = new _spprofiles;
	
	$result2 = $p->read_bid($_GET['postid']);
	if($result2!=false){
	$table="example";
	
	}
else{
	$table="";
}
	
	?>
                             <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                          <table class="table tbl_store_setting display" id="<?php echo $table;?>" cellspacing="0" width="100%" >
                                            <thead>
                                                <tr>
                                                   <th class="text-center" style="width: 50px;">ID</th>
													<th class="text-center" style="width: 50px;">ID</th>
                                                    <th class="text-center">Title</th>
                                                    <th class="text-center">Bid Price</th>
                                                    <th class="text-center">Buyer Name</th>
                                                    <th class="text-center">Bid Date</th>
												
													<th class="text-center">Status</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //$p = new _postingview;
                                               $p = new _spprofiles;

                                             
												
										
                                                $result1 = $p->readp($_GET['postid']);
												$row1 = mysqli_fetch_assoc($result1);
												//print_r($row1);
												
												$spPostingTitle = $row1['spPostingTitle'];
												$result2 = $p->read_bid($_GET['postid']);
												

                                                if ($result2) {
                                                    $i = 1;
                                                   while ($row2 = mysqli_fetch_assoc($result2)) {
												      $result = $p->read($row2['spProfiles_idspProfiles']);
												$row = mysqli_fetch_assoc($result);
												
												$buyer = $row['spProfileName'];
                                                        $bid_price = $row2['auctionPrice'];
                                                        $edt = $row2['bid_timestamp'];
														$id=$row2['id'];
														$postid=$_GET['postid'];
                                                       ?>
                                                       <tr>
                                                            <td></td>
															<td class="text-center"><?php echo $i; ?></td>
                                                            <td class="text-center"><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$postid; ?>"><?php echo $spPostingTitle; ?></a></td>
                                                            <td class="text-center"><?php  echo $row1['default_currency'].' '.$bid_price; ?></td>
                                                            <td class="text-center"><a href="<?php echo $BaseUrl;?>/friends/?profileid=<?php echo $row2['spProfiles_idspProfiles'];?>"><?php  echo $buyer; ?></td>
                                                            <td class="text-center"><?php echo $edt;?></td>
				
						<?php  $appr="$BaseUrl/store/dashboard/bid_approve.php?id=$id&postid=$postid";
						
						 
						if($row2['status']==0){?>
                                                            <td class="text-center"><a  href="javascript:void(0);" onclick="approve('<?php echo $appr; ?>')">Approve</a></td>
															<script type="text/javascript">
																
																
  function  approve(a){

              swal({
            title: "Are you sure it will be awarded?",
            type: "warning",
            confirmButtonClass: "sweet_ok",
            confirmButtonText: "Yes",
            cancelButtonClass: "sweet_cancel",
            cancelButtonText: "No",
            showCancelButton: true,
        },
        function(isConfirm) {
            if (isConfirm) {
                    window.location.href= a;
            }
        });

    }
    
</script>
						<?php }if($row2['status']==1){?>
						<td style="color:green;" class="text-center">Awarded</td>
						<?php }if($row2['status']==3){ ?>
						<td style="color:blue;" class="text-center">Paid</td>
						<?php } ?>
                                                        </tr>
                                                       <?php
                                                       $i++;
                                                   }
                                               }
                                                else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="6">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> 
                       </div>
                       
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


  <script type="text/javascript">
    $(document).ready(function() {

  var table = $('#example').DataTable({ 
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

} );
});
  </script>
          
                        <!--<div class="tab-pane fade" id="tab2warning">
                                   <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
    .paginate_button {
  border-radius: 0 !important;
}
</style>
                            <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
 <table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">ID</th>
													<th class="text-center" style="width: 50px;">ID</th>
                                                    <th>Title</th>
                                                    <th>Bid Price</th>
                                                    <th>Buyer Name</th>
                                                    <th>Bid Date</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //$p = new _postingview;
                                             //  $p = new _productposting;

                                               // $result = $p->auctionexpiredProduct($_SESSION['pid']);

                                             //   if ($result) {
                                              //      $i = 1;
                                               //     while ($row = mysqli_fetch_assoc($result)) {
                                                //       $dt = new DateTime($row['spPostingDate']);
                                                //        $edt = new DateTime($row['spPostingExpDt']);
                                                       ?>
                                                       <tr>
                                                            <td></td>
															<td class="text-center"><?php //echo $i; ?></td>
                                                            <td><a href="<?php //echo $BaseUrl.'/my-store/detail.php?catid=1&postid='.$row['idspPostings']; ?>"><?php echo $row['spPostingTitle']; ?></a></td>
                                                            <td>$<?php //echo $row['spPostingPrice']; ?></td>
                                                            <td><?php //echo $dt->format('d M Y'); ?></td>
                                                            <td><?php //echo $edt->format('d M Y'); ?></td>

                                                            
                                                        </tr>
                                                       <?php
                                                     //  $i++;
                                                 //   }
                                               // }
                                             //   else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="6">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                             //   }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
							
							<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
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

} );
});
  </script>
                        </div>
                      
                     
                    </div>
                </div>
            </div>
        </div>

                      
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
} ?>