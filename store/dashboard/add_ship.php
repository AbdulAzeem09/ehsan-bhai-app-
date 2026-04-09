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
    if (isset($_GET['oid']) && $_GET['oid']> 0) {
        $oid = $_GET['oid'];
    }else{
        $re = new _redirect;
        $re->redirect("order_mang.php");
    }
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
                  <!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php 
                        $activePage = 16;
                       // include('left-menu.php'); 
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
                        $storeTitle = " Dashboard / My Orders";
                        //include('../top-dashboard.php');
                       // include('../searchform.php');                       
                        ?>
                        
                        <div class="row no-margin">

                               <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Add Shipment</a></li>
                                     
                          </ul>
                            </div>

                            <div class="col-md-12 no-padding">
                                <div class="dash_bg_white">
                                    <form method="post" action="addship.php" id="shipform">
                                        <input type="hidden" name="oid" value="<?php echo $oid; ?>">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Shipment Title<span class="red">*</span></label><span id="shipcmpny_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span> 
                                                    <input type="text" name="ship_cmpny"  class="form-control" id="shipcmpny" onkeyup="keyupQuotationfun()"/>
                                                </div>
                                            </div>
       

                                     <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Shipment Track No<span class="red">*</span></label><span id="shipTrack_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span> 
                                                    <input type="text" name="shipTrack" class="form-control" id="shipTrack" onkeyup="keyupQuotationfun()"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Shipment Date<span class="red">*</span></label><span id="spUserDob_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span> 
                                                    <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd " data-link-field="dtp_input1">
                                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>                   
                                                        <input class="form-control shippingDate" id="spUserDob" name="shipDate" type="text" onkeyup="keyupQuotationfun()">
                                                    </div>
                                                    <input type="hidden" id="dtp_input2" value="" /><br/>
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label>Shipment Date</label>
                                                    <input type="date" name="shipDate" required="" class="form-control" />
                                                </div> -->
                                            </div>
                                            <div class="col-md-12">
                                                <input type="submit" id="shipsubmit" name="" value="Save" class="btn btn-submit" />
                                            </div>
                                        </div>
                                    </form>

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
          <!-- <script type="text/javascript">

            $(document).ready(function(e){
    alert();
       $( ".shippingDate" ).datepicker({ minDate: 0});     

       }); 
     </script> -->
 <script type="text/javascript">

$(document).ready(function(e){
    

  $("#shipsubmit").on("click", function () {
   //alert();                                                 
           // e.preventDefault();
       // var shipadd= $("#shipping_address").val()
        var shipcmpny= $("#shipcmpny").val()
        var shipTrack = $("#shipTrack").val()
        var spUserDob = $("#spUserDob").val()
      




//alert(shipcmpny);
//alert(shipTrack);
// alert(spUserDob);


if(shipcmpny == "" &&  shipTrack == "" && spUserDob == ""){

  
            $("#shipcmpny_error").text("Required!");
             $("#shipcmpny").focus();

            $("#shipTrack_error").text("Required!");
             $("#shipTrack").focus();

            $("#spUserDob_error").text("Required!");
           //  $("#quoteMedia").focus();

        

         return false;
        }else if (shipcmpny == "") {
           
           $("#shipcmpny_error").text("Required!");
             $("#shipcmpny").focus();

             return false;
        }else if (shipTrack == "" ) {
        
           $("#shipTrack_error").text("Required!");
             $("#shipTrack").focus();



             return false;
        }else if (spUserDob == "") {
            $("#spUserDob_error").text("Required!");
            // $("#spUserDob").focus();


             return false;
        }
        else {
$("#shipform").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
}); 
        </script>

<script type="text/javascript">
            

function keyupQuotationfun() {

  //alert();
   var shipcmpny= $("#shipcmpny").val()
        var shipTrack = $("#shipTrack").val()
        var spUserDob = $("#spUserDob").val()
      
    

   if(shipcmpny != "")
  {
    $('#shipcmpny_error').text(" ");
    
  }
  if(shipTrack != "")
  {
    $('#shipTrack_error').text(" ");
 }
   if(spUserDob != "")
  {
    $('#spUserDob_error').text(" ");
 }
  
  
       
}

        </script>
    </body>
</html>
<?php
}
?>