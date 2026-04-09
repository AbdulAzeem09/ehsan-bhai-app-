<?php
	include('../../univ/baseurl.php');
	session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/check.php");
    
}else{

	
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

  
  
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

        <?php include('../../component/f_links.php');?>

        <!-- ===== INPAGE SCRIPTS====== -->
        

        <!--This script for sticky left and right sidebar STart-->
     
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
        include_once("../../header.php");
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
                     
                       <!--  <div class="row"> -->
                                      <div class="col-md-12">
                                          <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store'; ?>"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

                          <li><a href="<?php echo $BaseUrl.'/public_rfq'; ?>">Public RFQ</a></li>

                     <li> <a href="<?php echo $BaseUrl.'/store/dashboard/quote_constoretactform.php?idspRfqComment='.$_GET['idspRfqComment']; ?>"  >Contact</a></li>
                                     
                          </ul>
                                      </div>
                  <!--       </div>   -->

                    <div class="col-md-12 rfqpage">
                     <!--    <?php 
                         $activePage = 8;
                       // include('top-dashboard.php');


                        ?>-->

                        <?php   $r = new _rfq;
                        $result = $r->readRfqquotedetail($_GET['idspRfqComment']);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);

                        }
                        
                        ?>
 
                        <div class="dash_bg_white" style="min-height: 400px;padding: 20px;">
          <form id="contactform" method="post" action="addquote_contactdetail.php" class="rfq_form" enctype="multipart/form-data" >

     <input type="hidden" name="idspRfqComment"  id="idspRfqComment" value="<?php echo $_GET['idspRfqComment'];?>"> 

    <input type="hidden" name="idspRfq" id="idspRfq" value="<?php echo $row['idspRfq'];?>"> 
                  
 
    <div class="form-group">
            <label for="sell1">Title<span class="red">*</span></label><span id="quoteTitle_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span> 
        <input type="text" class="form-control" name="quoteTitle"  id="quoteTitle" onkeyup="keyupQuotationfun()"/>

          

              </div>


            
                  <div class="form-group">
            <label for="sell2">Description<span class="red">*</span></label> <span id="quotedescription_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span> 
        <textarea class="form-control" name="quotedescription" id="quotedescription" rows="4" onkeyup="keyupQuotationfun()"></textarea>
            

              </div>

               <div class="form-group">
                 <label for="sell3">Image<span class="red">*</span></label>
                   <span id="quoteMedia_error"style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                     <input type="file" name="quoteMedia"  id="quoteMedia" onkeyup="keyupQuotationfun()"/>

               </div>
                          
                    
<button type="submit" class="btn btn-primary" id="contactsubmit" style="background-color: green; color: #fff;border-radius: 20px; border: none;     width: 12%; margin-top: 10px;">Submit</button>


                      </form>
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
   <script type="text/javascript">
            

$(document).ready(function(e){
    

  $("#contactsubmit").on("click", function () {
   // alert();                                                 
           // e.preventDefault();
       // var shipadd= $("#shipping_address").val()
        var quoteTitle= $("#quoteTitle").val()
        var quotedescription = $("#quotedescription").val()
        var quoteMedia = $("#quoteMedia").val()
      

/*
alert(quoteTitle);
alert(quotedescription);
 alert(quoteMedia);*/


if(quoteTitle == "" &&  quotedescription == "" && quoteMedia == ""){

  
            $("#quoteTitle_error").text("Please Enter Title.");
             $("#quoteTitle").focus();

            $("#quotedescription_error").text("Please Enter Description.");
             $("#quotedescription").focus();

            $("#quoteMedia_error").text("Please Choose a Picture.");
             $("#quoteMedia").focus();

        

         return false;
        }else if (quoteTitle == "") {
           
            $("#quoteTitle_error").text("Please Enter Title.");
             $("#quoteTitle").focus();

             return false;
        }else if (quotedescription == "" ) {
        
              $("#quotedescription_error").text("Please Enter Description.");
             $("#quotedescription").focus();



             return false;
        }else if (quoteMedia == "") {
           $("#quoteMedia_error").text("Please Choose a Picture.");
             $("#quoteMedia").focus();


             return false;
        }
        else {
$("#contactform").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
}); 
        </script>

<script type="text/javascript">
            

function keyupQuotationfun() {

  //alert();
 var quoteTitle= $("#quoteTitle").val()
var quotedescription = $("#quotedescription").val()
    

   if(quoteTitle != "")
  {
    $('#quoteTitle_error').text(" ");
    
  }
  if(quotedescription != "")
  {
    $('#quotedescription_error').text(" ");
 }
  
  
       
}

        </script>
      
    </body>
</html>
<?php
}
?>