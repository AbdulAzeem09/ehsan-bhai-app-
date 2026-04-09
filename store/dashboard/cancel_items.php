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

    display: table-cell;
    vertical-align: middle;
}
.modal-content {
 
    width:inherit;
    height:inherit;
    
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
                                       <li><a href="#">Get Request For Return Item</a></li>
                                     
                                    </ul>
                    

                                 <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13 || $activePage == 15)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div>
                            </div>
 -->
<!-- table list open --> <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                        <li><a href="#">Get Request For Return Item</a></li>
                                     
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
									
									
                                        <table class="table tbl_store_setting display" id="example" cellspacing="0" width="100%" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">No.</th>
													<th class="text-center" style="width: 50px;">No.</th>
                                                    <th>Buyer Name</th>
                                                    <th>Product Name</th>
                                                    <th>Buyer Reason</th>
                                                    
                                                    <th>Seller Comment</th>
                                                    <th>Action</th>
                                                    <th>Comment</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $p = new _spcustomers_basket;
                                              
                                               $result = $p->readcancel($_SESSION['pid']);
                                             //  echo $p->ta->sql;

												//print_r($result);
                                                if ($result != false) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        //extract($row);
                                                     

                                                       //echo "<pre>";
                                                      // print_r($row);

                                                      $order_id  = $row['idspPostings'];
                                                      
                                                     //echo $order_id;die('=====');
													$comment=$row['seller_comment'];
                                                       $buyerprofilid  = $row['spByuerProfileId'];
                                                         $sellerprofilid  = $row['spSellerProfileId'];

                                                      
                                                        $Response  = $row['reason'];
                                                           $buyerComment  = $row['comments'];
                                                           $sellerComment  = $row['seller_comment'];

                                                           $sp = new _spprofiles;

                                                                 $spbuyresult  = $sp->read($buyerprofilid);
                                                                    if($spbuyresult != false)
                                                                       {
                                                              $buyrow = mysqli_fetch_assoc($spbuyresult);
                                                              $buyername = $buyrow["spProfileName"];
     
                                                                }
									$p=new _productposting;
									$pr=$p->read($order_id);
									
									//print_r($pr);
									if($pr !=false){
									
									$prn=mysqli_fetch_assoc($pr);
									
									$prname=$prn['spPostingTitle'];
									//echo $prname;die('=======');

									}                   


                                                      $sl = new _sellercomment;
                                                $commresult  = $sl->getsellercomment($row['id']);
                                                       //  echo $sl->ta->sql;            

                                                                    if($commresult != false)
                                                                       {
                                                   while ($commrow = mysqli_fetch_assoc($commresult)) {

                                                      $Sellercomment = $commrow["sellercomments"];
                                                      $Scommentid = $commrow["id"];
                                                        $commid = $commrow["comment_id"];                                                                    
                                                            
                                                             }
                                                           }

                                
							?>
				<?php 
					
						if(isset($_POST['submit'])){
						//die('==========');
					$comment=array("seller_comment"=>$_POST['sellercomments']); 
					
					 $s=new _spcustomers_basket;
				     $st= $s->updatecomment($comment,$_POST['idspOrder']);
					
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                  <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>
                                                                   
                                                        <tr>
                                                            <td></td>
															<td><?php echo $i; ?></td>
                                                        <td class="eventcapitalize"><?php echo $buyername; ?></td>
                                                            <td class="eventcapitalize"><?php echo $prname; ?></td>
                                                        <td><?php echo $Response; ?></td>
                                                        


                                                       

                                                         <td class="buyer">    
                                                           
                                              <?php if (isset($sellerComment)) {
												 // echo $sellerComment; 
												  ?>
												  
                                                <a href=""data-toggle="modal" data-target="#p<?php echo $$order_id;?>"><?php  echo $sellerComment; ?></a>
												 
                                                          
                                                      <?php  }else{ ?>
                                                          <p>No Comment</p>
                                                       <?php } ?>

                                                        
                                                      </td>

                                                        

                                                        <td>
     

       <select  id="sendstatus" name="status" onchange="get_approvedata(<?php echo $row['id'];?>);" style="background-color: #008d4c; border-color: #008d4c;height: 33px; border-radius: 8px; " class="btn btn-info btn-sm">
        <!--   <option value="" style="display:none">Status</option>  -->
       <option  value="Accepted"<?php if ($row['status'] == 'Accepted') {echo "disabled"; }?> <?php if ($row['status'] == 'Accepted') {echo "selected";  }?>>Accepted</option>

                   
                    
          <option  value="Review In Request" <?php if($row['status'] == 'Review In Request') echo "selected"; ?>>Review In Request</option>

          <option  value="Decline Request"<?php if ($row['status'] == 'Decline Request') {echo "disabled";

            }?> <?php if ($row['status'] == 'Decline Request') {echo "selected"; }?>>Decline Request</option>

                    
          
        </select>

                                                           </td>

       <td><a href="" class="btn" data-toggle="modal" data-target="#mycomment<?php echo $row['id'];?>" 
                                                              style="color: #fff!important;  background-color: #7CB8E0; border-radius: 8px;">Comment</a></td>
                                                              
                                                           
                                                        </tr>
                                                       

   <!-- Modal -->
<div class="modal fade" id="p<?php echo $Scommentid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content no-radius bradius-15 ">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                 <h4 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Seller Comment</h4>

                </div>
          <div class="modal-body"><p style="padding: 8px;"><?php echo $sellerComment; ?>

        </p></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                  <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>                                                        
                         
                          
                                <!-- Modal -->
<div class="modal fade" id="mycomment<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">

     <form  action="" method="post" enctype="multipart/form-data"> 
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

         <input type="hidden" name="idspOrder" id="comment_id<?php echo $row['idspOrder'];?>" value="<?php echo $row['idspOrder'];?>">    
                  <div class="form-group">
            <label for="sell1">Enter Comment <span class="red">*</span></label> 
        <textarea class="form-control" name="sellercomments" id="sellercommentid<?php echo $row['id'];?>" rows="4"></textarea>
             <span id="sellercommentid_error" style="color:red;"></span>

              </div>
                  

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;" >Close</button>
					
					
            <button type="submit" class="btn btn-primary" name="submit"
                   
                   style="background-color: green; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Submit</button>
                </div>
            </div>
        </form>  
        </div>
    </div>
 
</div>
                                                                                         
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                                 else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="8">
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
            url: 'addsellercomment.php',
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

<script type="text/javascript">
//function get_approvedata(id){

 function get_approvedata(id){

  //  alert();
    //lert($('#discount').val());
 
 var rid = id;

 var Statusdropdown=$('#sendstatus').val();
 //alert(Statusdropdown);
 //alert(rid);

//var sid = $("#withdrawuserid").val();
 
//alert(sid);

//alert(Statusdropdown);

swal({
      title: "Are you sure?",
      type: "warning",
      confirmButtonClass: "sweet_ok",
      confirmButtonText: "Yes",
      cancelButtonClass: "sweet_cancel",
      cancelButtonText: "No",
      showCancelButton: true,
    },

      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
             type: 'POST',
           //  url: 'deleteshipping_add.php',

              url:'addreturn_response.php',
      //  data: {'status': '1','userid':userid},
        //data:  'status=1&userid='+userid,
      
            // data: info,
            data:{'status': Statusdropdown,'rid': rid},

             error: function() {
                alert('Something is wrong');
             },
               success: function(response){ 

                       // console.log(data);
                          window.location.reload();


                                /* swal({

                                  title: "Submitted Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location.reload();

                                  });*/

   }


          });
        
    } 
       
      });


  }



</script>

<!-- 
<script type="text/javascript">
$(document).ready(function(e){
    // Submit form data via Ajax
    $(".commentsell").on("click", function () {

//alert();
 var comment_id = $("#comment_id").val();
     
        //  var msg = $("#message-text").val();

       var sellercommentid = $("#sellercommentid").val();
alert(comment_id);
alert(sellercommentid);

           if (sellercommentid == "") {
            
            $("#sellercommentid_error").text("Please Enter Comment.");
             $("#sellercommentid").focus();


             return false;
           }else{

        $.ajax({
            type: 'POST',
            url: 'addsellercomment.php',
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

    });
});

</script>
 -->

    </body>
</html>
<?php
}
?>