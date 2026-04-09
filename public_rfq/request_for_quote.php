<?php
	include('../univ/baseurl.php');
	session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../authentication/check.php");
    
}else{

	
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

  
  
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

        <?php include('../component/f_links.php');?>

        <!-- ===== INPAGE SCRIPTS====== -->
        

        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
        <script>
            function execute(settings) {
                $('#sidebar').hcSticky(settings);
            }
            // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            function execute_right(settings) {
                $('#sidebar_right').hcSticky(settings);
            }
             // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute_right({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            
        </script>
        <!--This script for sticky left and right sidebar END--> 
        <style type="text/css">
            


            input[type="file"] {
    display: block!important;
}
        </style>
    </head>

    <body class="bg_gray">
      <?php
        //this is for store header
        $header_store = "header_store";
        include_once("../header.php");
      ?>
    	

        <section class="main_box">
            <div class="container">
                <div class="row">
                    <!-- <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                            //  include('../component/left-store.php');
                            ?>
                        </div>
                    </div> -->

                     <div class="col-md-12">
                        
                        <?php 
                      //  $activePage = 8;
                       // $storeTitle = " (<small>RFQ Detail</small>)";
                      //  include('top-dashboard.php');
                        
                        $r = new _rfq;
                        $result = $r->rfqRead($_GET['rfq']);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                        }
                        
                        ?>
                       <!--  <div class="row"> -->
                                      <div class="col-md-12">
                                          <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
           <li><a href="<?php echo $BaseUrl.'/store/storeindex.php?folder=home'; ?>"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

                          <li><a href="<?php echo $BaseUrl.'/public_rfq?page=1'; ?>">Public RFQ</a></li>

                          <li><a href="<?php echo $BaseUrl.'/public_rfq/request_for_quote.php';?>">Request for Quote</a></li>
                                     
                          </ul>
                                      </div>
                  <!--       </div>   -->


                    <div class="col-md-12 rfqpage">
                     <!--    <?php 
                         $activePage = 8;
                       // include('top-dashboard.php');


                        ?>-->
 
                        <div class="dash_bg_white" style="min-height: 400px;padding: 20px;">
          <form id="quotationform" method="post" action="addrfq.php" class="rfq_form" enctype="multipart/form-data" >
                                        <input type="hidden" name="spProfile_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
                                        <input type="hidden" name="spCategory_idspCategory" value="1">
                                        <div class="row">
                                            <div class="col-md-12 m_btm_20">
                                                <h2 class="heading05">Public RFQ (<small>Request For Quote</small>)</h2>
                                                
                                            </div>
                                         <!--    <div class="col-md-12">
                                                <?php 
                                                if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
                                                    if($_SESSION['count'] <= 1){
                                                        $_SESSION['count'] +=1; ?>
                                                        <div class="alert alert-success alert-dismissible">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <?php echo $_SESSION['errorMessage'];  ?>
                                                        </div> <?php
                                                        unset($_SESSION['errorMessage']);
                                                    }
                                                } ?>
                                                
                                            </div> -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>What are you looking for?<span class="red">*</span></label> <span id="rfqTitle_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                    <input type="text" class="form-control" name="rfqTitle"  id="rfqTitle" onkeyup="keyupQuotationfun()"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Category<span class="red">*</span></label><span id="rfqCategory_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                    <select class="form-control" name="rfqCategory" id="rfqCategory" onkeyup="keyupQuotationfun()">
                                                        <option value="">Category</option>
                                                        <?php
                                                            $m = new _subcategory;
                                                            $catid = 1;
                                                            $result = $m->read($catid);
                                                            if($result){
                                                                while($rows = mysqli_fetch_assoc($result)){
                                                                    echo "<option value='".ucwords(strtolower($rows["subCategoryTitle"]))."'>".ucwords(strtolower($rows["subCategoryTitle"]))."</option>";
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Quantity required<span class="red">*</span></label><span id="rfqQty_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                    <input type="text" class="form-control" name="rfqQty" id="rfqQty" onkeyup="keyupQuotationfun()"/>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Expected date of arrival<span class="red">*</span></label><span id="rfqDelivered_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                    <!-- <input type="text" class="form-control" name="rfqDelivered" /> -->
                                                    <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                   
                                                        <input class="form-control" data-filter="1" size="16" id="rfqDelivered" name="rfqDelivered" type="text" value="" onkeyup="keyupQuotationfun()">
                                                    </div>
                                                    <input type="hidden" id="dtp_input2" value="" /><br/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="spPostingCountry">Country<span class="red">*</span></label><span id="rfqCountry_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                    <select id="spUserCountry" class="form-control " name="rfqCountry" onkeyup="keyupQuotationfun()">
                                                        <option value="">Select Country</option>
                                                        <?php
                                                        $co = new _country;
                                                        $result3 = $co->readCountry();
                                                        if($result3 != false){
                                                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                ?>
                                                                <option value='<?php echo $row3['country_id'];?>' ><?php echo $row3['country_title'];?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="loadUserState">
                                                    <div class="form-group">
                                                        <label for="spPostingCity">State<span class="red">*</span></label><span id="rfqState_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                        <select required class="form-control" name=" spQuotationState"  id="rfqState" onkeyup="keyupQuotationfun()">
                                                            <option value="">Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="loadCity">
                                                    <div class="form-group">
                                                        <label for="spPostingCity">City<span class="red"></span></label><span id="rfqCity_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                        <select class="form-control" name="spQuotationCity" id="rfqCity" onkeyup="keyupQuotationfun()">
                                                            <option value="">Select City</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Quotereached">Quote Reached<span class="red">*</span></label><span id="quotereached_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                     <select class="form-control" name=" spQuotereached" id="Quotereached" onkeyup="keyupQuotationfun()">
                                                    <option value="">Select Option</option>
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    </select>

                                                  <!--   <input type="text" class="form-control" name="Quotereached" /> -->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="spPostingMedia">Image<span class="red">*</span></label><span id="spPostingMedia_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                    <input type="file" name="spPostingMedia[]" 
                                                    id="spPostingMedia" required multiple="" class="fileimage"
                                                    onkeyup="keyupQuotationfun()"/>
                                                     <span class="validation" style="display:none;"> Upload Max 5 Files allowed </span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description<span class="red">*</span></label><span id="rfqDesc_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                             <textarea class="form-control" name="rfqDesc" rows="6" id="rfqDesc" onkeyup="keyupQuotationfun()" maxlength="500"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="submit" name="" id="quotationsubmit" class="btn btn-submit btn-border-radius " style="background-color:green!important; " value="Send Public Query">
                                            </div>
                                        </div>
                                    </form>

                                </div>


                    </div>
                </div>
                </div>
            </div>
        </section>
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>

       <script type="text/javascript">
            

$(document).ready(function(e){
    // Submit form data via Ajax

    //$("#shipaddfrm").on('submit', function(e){


  $("#quotationsubmit").on("click", function () {
   // alert();                                                 

           // e.preventDefault();
       // var shipadd= $("#shipping_address").val()
        var rfqTitle= $("#rfqTitle").val()
        var rfqCategory = $("#rfqCategory").val()
        var rfqQty = $("#rfqQty").val()
        var rfqDelivered = $("#rfqDelivered").val()
        var rfqCountry = $("#spUserCountry").val()
        var rfqState = $("#rfqState").val()
          var rfqCity = $("#rfqCity").val()
          var spPostingMedia = $(".fileimage").val()
          var rfqDesc = $("#rfqDesc").val()
           var quotereached = $("#Quotereached").val()
          


/*alert(rfqTitle);
alert(rfqCategory);
 alert(rfqQty);
alert(rfqDelivered);
 alert(rfqCountry);
alert(rfqState);
 alert(rfqCity);

 alert(spPostingMedia);
 alert(rfqDesc);
*/



if(rfqTitle == "" &&  rfqCategory.length == 0 && rfqQty == "" && rfqDelivered == "" && rfqCountry.length == 0 && rfqState.length == 0 && rfqCity.length == 0 && spPostingMedia == "" && rfqDesc == "" && quotereached.length == 0){

  
            $("#rfqTitle_error").text("This field is required.");
             $("#rfqTitle").focus();

            $("#rfqCategory_error").text("Select Category.");
             $("#rfqCategory").focus();

            $("#rfqQty_error").text("Enter Quantity.");
             $("#rfqQty").focus();

            $("#rfqDelivered_error").text("Select Date.");
            // $("#rfqDelivered").focus();

              $("#rfqCountry_error").text("Select Country.");
              $("#spUserCountry").focus();
             

               $("#rfqState_error").text("Select State.");
             $("#rfqState").focus();

            // $("#rfqCity_error").text("Select City.");
            //  $("#rfqCity").focus();

                $("#quotereached_error").text("Select Option.");
             $("#Quotereached").focus();

               $("#spPostingMedia_error").text("Choose a Picture.");
             $(".fileimage").focus();

            $("#rfqDesc_error").text("Enter Description.");
             $("#rfqDesc").focus();

            
          


         return false;
        }else if (rfqTitle == "") {
            
             $("#rfqTitle_error").text("This field is required.");
             $("#rfqTitle").focus();


             return false;
        }else if (rfqCategory.length == 0 ) {
        
            $("#rfqCategory_error").text("Select Category.");
             $("#rfqCategory").focus();


             return false;
        }else if (rfqQty == "") {
         $("#rfqQty_error").text("Enter Quantity.");
             $("#rfqQty").focus();

             return false;
        }else if (rfqDelivered == "") {
       
          $("#rfqDelivered_error").text("Select Country.");
             $("#rfqDelivered").focus();


             return false;
        }else if (rfqCountry.length == 0) {
        
              $("#rfqCountry_error").text("Select Country.");
              $("#spUserCountry").focus();
             
             return false;
        }else if (rfqState.length == 0) {
      
             $("#rfqState_error").text("Select State.");
             $("#rfqState").focus();

             return false;
        }
        
        // else if (rfqCity.length == "" ) {
      
        //      $("#rfqCity_error").text("Select City.");
        //      $("#rfqCity").focus();


        //      return false;
        // }
        
        
        else if (quotereached.length == 0) {
      
         
            $("#quotereached_error").text("Enter Description.");
             $("#Quotereached").focus();




             return false;
        }else if (spPostingMedia == "") {
         $("#spPostingMedia_error").text("Choose a Picture.");
             $(".fileimage").focus();



             return false;
        }else if (rfqDesc == "") {
      
         
            $("#rfqDesc_error").text("Enter Description.");
             $("#rfqDesc").focus();



             return false;
        }
        else {
$("#quotationform").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
}); 
        </script>


<script type="text/javascript">
            

function keyupQuotationfun() {

  //alert();

     var rfqTitle= $("#rfqTitle").val()
        var rfqCategory = $("#rfqCategory").val()
        var rfqQty = $("#rfqQty").val()
        var rfqDelivered = $("#rfqDelivered").val()
        var rfqCountry = $("#spUserCountry").val()
        var rfqState = $("#rfqState").val()
        //   var rfqCity = $("#rfqCity").val()
          var spPostingMedia = $(".fileimage").val()
          var rfqDesc = $("#rfqDesc").val()
//alert(category);
 //alert(category.length);

   if(rfqTitle != "")
  {
    $('#rfqTitle_error').text(" ");
    
  }
  if(rfqCategory.length != 0)
  {
    $('#rfqCategory_error').text(" ");
 }
   if(rfqQty != "" )
  {
    $('#rfqQty_error').text(" ");
    
  }
 if(rfqDelivered != "")
  {
    $('#rfqDelivered_error').text(" ");
  
  }
   if(rfqCountry.length != 0)
  {
    $('#rfqCountry_error').text(" ");
  }
   if(rfqState.length != " ")
  {
    $('#rfqState_error').text(" ");
  
  }
//   if(rfqCity.length != 0)
//   {
//     $('#rfqCity_error').text(" ");
  
//   }
  if(quotereached.length != 0)
  {
    $('#quotereached_error').text(" ");
  
  }
  if(spPostingMedia != "")
  {
    $('#spPostingMedia_error').text(" ");
  
  }
  if(rfqDesc != "")
  {
    $('#rfqDesc_error').text(" ");
  
  }

 
  
       
}



        </script>

 <script type="text/javascript">
            $(document).ready(function(){
  $('#spPostingMedia').change(function(){
    //alert();
   //get the input and the file list
    var input = document.getElementById('spPostingMedia');
      if(input.files.length>5){
          $('.validation').css('display','block');
      }else{
          $('.validation').css('display','none');
      }
   });
});
        </script>
    </body>
</html>
<?php
}
?>