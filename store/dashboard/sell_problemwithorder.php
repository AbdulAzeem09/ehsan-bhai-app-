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
                        $activePage = 52;
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
                        $storeTitle = "Buyer Dashboard / My Orders";
                        $folder = "store";
                       // include('../top-dashboard.php');
                       // include('../searchform.php');                       
                        ?>
                        
                        <div class="row">
                            <!--  <div class="col-md-12">
                                    

                                     <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
                                       <li><a href="#">Problem with order</a></li>
                                      
                                    </ul>
                    


                                <div class="text-right" style="margin-top: -10px;">
                                       <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>
                                       
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24 || $activePage == 52)?'active':''?>">Buyer Dashboard</a></li>
                                    </ul>
                              

                                </div>
                            </div>
 -->
<!-- table list open --><div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                      <li><a href="#">Problem with Order</a></li>
                                     
                          </ul>
                            </div>
 
 <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
    .paginate_button {
  border-radius: 0 !important;
}
</style>
                            <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
									
									<?php  
												
                                                $p = new _store_problemwithorder;
                                              
                                       $result = $p->getMysellerproduct($_SESSION['pid']);
											//var_dump($result);
												//print_r($result);die('======');
                                                if ($result!=false) {?>
                          <table class="table tbl_store_setting display" id="example" cellspacing="0" width="100%" >
						  
												<?php } else {	  ?>
			 <table class="table tbl_store_setting display" id="" cellspacing="0" width="100%" >

												<?php } ?>
                                            <thead>
                                                <tr>
                                                    
													<th class="text-center" style="width: 50px;">No.</th>

                                                    <th>Product Name</th>
                                                     <th>Buyer Name</th>

                                                    <th>Buyer Comment</th>
                                                  
                                                    <th>Seller Comment</th>

                                                     <th>Comment</th>

                                                 
                                                  
                                                    
                                                </tr>
                                            </thead>
                                           
                                                <?php
												
                                                $p = new _store_problemwithorder;
                                              
                                       $result = $p->getMysellerproduct($_SESSION['pid']);
									   
											//var_dump($result);
												//print_r($result);die('======');
                                                if ($result!=false) {?>
												 <tbody>
                                                    <?php $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        //extract($row);

                                                      
                                                       //echo "<pre>";
                                                       //print_r($row);
                                             //   echo $p->ta->sql;

                                                   $buyerprofilid  = $row['buyerprofil_id'];

                                                    $sellerprofilid  = $row['sellerprofil_id'];

                                                     
                                                         $buyercomments  = $row['buyerproblem'];
                                                      
                                                         $txnid  = $row['txn_id'];

                                            $or = new _order; 
                                        $result2 = $or->readOrderTxn($txnid, $buyerprofilid);
                                                //   echo $or->ta->sql;
                                                    if ($result2) {

                                                    $row2 = mysqli_fetch_assoc($result2);
                                                     $productname = $row2["spPostingTitle"];

                                                        }



                                                    $sp = new _spprofiles;

                                                    $spbuyresult  = $sp->read($buyerprofilid);
                                               if($spbuyresult != false)
                                                                       {
                                                      $buyrow = mysqli_fetch_assoc($spbuyresult);
                                                       $buyername = $buyrow["spProfileName"];
   
                                                                    
                                                             }

                                                  
                                              $commresult  = $p->getsellercomment($row['id']);

                                                     //echo $p->tab->sql;
                                             if($commresult != false)
                                                                       {
                                                   while ($commrow = mysqli_fetch_assoc($commresult)) {

                                                   // print_r($commrow);

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
                <div class="modal-body"><p style="padding: 8px;"><?php echo $buyercomments; ?></p></div>
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
                                                             <td class="eventcapitalize"><?php echo $buyername; ?></td>
                                                           
                                                   
                                                    <td class="buyer">
                                         <a href=""data-toggle="modal" data-target="#<?php echo $row['id'];?>"><?php echo $buyercomments; ?></a>
                                                        </td>
                                                           
                                                  
                                                          

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
             <div class="modal-body"><p style="padding: 8px;">  
              <?php echo $Sellercomment; ?></p></div>
                <div class="modal-footer" style="border-top-color: #fff;">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                  <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>                                                        
                                                     <td><a href="" class="btn" data-toggle="modal"
                                                        data-target="#mycomment<?php echo $row['id'];?>" 
                                                              style="color: #fff!important;  background-color: #7CB8E0; border-radius: 8px;">Comment</a></td>
                                                      
          <!-- Modal -->
<div class="modal fade" id="mycomment<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">

         <!--   <form id="sellercommentfrm"action="addsellercomment.php" method="post" enctype="multipart/form-data"> -->
            <div class="modal-content no-radius bradius-15">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h3 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Comment</h3>

                </div>
                <div class="modal-body">
                 <!--   <input type="hidden" name="cid" value="<?php echo $row['id'];?>"> -->
                    <!--   <input type="hidden" name="spByuerProfileId" value="<?php echo $buyerprofilid;?>">
                         <input type="hidden" name="spSellerProfileId" value="<?php echo $sellerprofilid;?>">

                           <input type="hidden" name="order_id" value="<?php echo $order_id;?>">

 -->

         <input type="hidden" name="comment_id" id="comment_id<?php echo $row['id'];?>" value="<?php echo $row['id'];?>">    
                  <div class="form-group">
            <label for="sell1">Enter Comment <span class="red">*</span></label> 
        <textarea class="form-control" name="sellercomments" id="sellercommentid<?php echo $row['id'];?>" rows="4"></textarea>
             <span id="sellercommentid_error" style="color:red;"></span>

              </div>
                  

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;" >Close</button>
            <button type="button" class="btn btn-primary" 
                   
                    onclick="get_commentdata(<?php echo $row['id'];?>)" style="background-color: green; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Submit</button>
                </div>
            </div>
    <!--    </form>  -->
        </div>
    </div>
 
</div>
                                                   
                                                        </tr>

         
                                                        <?php
                                                        $i++;
                                                    }?>
													
													</tbody>
                                            <?php     }
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


                        </div>

                    </div>
                </div>
            </div>
        </section>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

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

      <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
 
<script type="text/javascript">
//function get_approvedata(id){

 function get_commentdata(id){
//alert();

       
var comment_id = $("#comment_id"+id).val()
 
 var sellercommentid = $("#sellercommentid"+id).val()

if (sellercommentid == "") {
            
            $("#sellercommentid_error").text("Please Enter Comment.");
             $("#sellercommentid").focus();


             return false;
 }else{
   $.ajax({
            type: 'POST',
            url: 'addproblemwithorder.php',
            data: {comment_id: comment_id, sellercomments: sellercommentid},
            
                
            success: function(response){ 

                         //console.log(data);

                                 swal({

                                  title: "Comment Submitted Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location.reload();

                                  });

  
            }
        });

 }


  }



</script>

    </body>
</html>
<?php
}
?>