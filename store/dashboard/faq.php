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


     $pro = new _spprofiles;
        $result = $pro->profileforresume($_SESSION["uid"]);


        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $ProfileName = $row['spProfileName'];

               $UserEmailid = $row['spProfileEmail'];

              $spUserid = $row['spUser_idspUser'];

               //$profiletype = 1;
              
        }
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">


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
                    <!-- <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php 
                        $activePage = 54;
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
                        $storeTitle = " Dashboard / Active Products";
                       // include('../top-dashboard.php');
                        //include('../searchform.php');     
/*
                              $activePage = 52;    */    
                              $activePage = 54;          
                        ?>
                        
                        <div class="row">

                          
                    <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

                         <li><a href="#">FAQ</a></li>
                                     
                          </ul>
                            </div>


<div class="col-md-12">
            <div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">
         <div class="panel-heading" style="padding: 0px!important;background-color: #BACCE8;
    border-color: #BACCE8;">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab1warning" data-toggle="tab">FAQ</a></li>
                         <li><a href="#tab2warning" data-toggle="tab">FAQ Contact</a></li>
                           
                           
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1warning">
                             
                  
                              <div class="col-md-12 ">


    <div class="panel-group" id="accordion">
        <div class="faqHeader">FAQ's</div>
        <h4 class="faqpara">Just the Facts</h4>


   <?php 
 $all = new _spAllStoreForm; 
       $result4 = $all->readFAQ('store'); 

          //echo $all->faq->sql;

       if ($result4) { 
          $i = 1;                                    
        while ($row4 = mysqli_fetch_assoc($result4)) { 
           
           
             $id = $row4['id'];
              $id = $i;
          $question = $row4['spfaq_question'];
            $answer = $row4['spfaq_answer'];
           
           


    ?>
        <div class="panel panel-default" style="margin-top: 7px!important;">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $id?>"><?php echo  $question;?></a>
                </h4>
            </div>
            <div id="collapseOne<?php echo $id?>" class="panel-collapse collapse in">
                <div class="panel-body" style="border: 1px solid #ddd;">
                    <p><?php echo  $answer;?></p>
                </div>
            </div>
        </div>

<?php
 $i++;
  }
}?>
    </div>
                       </div>
                     </div>
                       
                   
                        <div class="tab-pane fade" id="tab2warning">
                         <div class="col-md-12 ">
                    
                         <form id="contactform" enctype="multipart/form-data"> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6">

           <input type="hidden" name="contactID" value=1> 
                              <div class="form-group">
                       <label for="sel1">Name:<span class="red">*</span></label>
                       <input type="text" name="cname" id="cnameid" class="form-control" value="<?php echo $ProfileName; ?>" onkeyup="keyupBankfun()">
                        <span id="cnameid_error" style="color:red;"></span>
                        </div>
                      </div>
                         <div class="col-md-6">
                        <div class="form-group">
                       <label for="sel2">Email:<span class="red">*</span> </label>
                        <input type="text" name="cemail" id="cemailid" class="form-control" 
                       value="<?php echo $UserEmailid; ?>" onkeyup="keyupBankfun()">
                         <span id="cemailid_error" style="color:red;"></span>
                        </div>
                      </div>
                    </div>

                         <div class="form-group">
                       <label for="sel3">Message:<span class="red">*</span> </label>
                       <textarea class="form-control" id="cmessageid" name="cmessage" rows="4" onkeyup="keyupBankfun()"></textarea>
                        <span id="cmessageid_error" style="color:red;"></span>
                        </div>   

                        <button class="btn" type="submit" style="background-color: #337ab7;color: #fff; border-radius: 6px;border: none;float: right;">Submit</button>



                            </div>
                          </div>
                        </form>
                        
 
                        </div>
                        </div>
                      
                       <!--  <div class="tab-pane fade" id="tab5warning">Warning 5</div> -->
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



<script type="text/javascript">
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#contactform").on('submit', function(e){
  //   alert();
         e.preventDefault();

        var Name= $("#cnameid").val()

        var Email = $("#cemailid").val()
        var Message = $("#cmessageid").val()
    

      //  alert(Bankuser);


        if(Name == "" &&  Email == "" && Message == ""){

           /* $("#shipadd_error").text("Please Enter Address.");*/

            $("#cnameid_error").text("Please Enter Your Name.");
             $("#cnameid").focus();

            $("#cemailid_error").text("Please Enter Email.");
             $("#cemailid").focus();

            $("#cmessageid_error").text("Please Enter Message.");
             $("#cmessageid").focus();


      

         return false;
        }else if (Name == "") {
            
            $("#cnameid_error").text("Please Enter Your Name.");
             $("#cnameid").focus();


             return false;
        }else if (Email == "") {
          
            $("#cemailid_error").text("Please Enter Email.");
             $("#cemailid").focus();

             return false;
        }else if (Message == "") {
          $("#cmessageid_error").text("Please Enter Message.");
             $("#cmessageid").focus();
             
             return false;
        }

   else{
      
        $.ajax({
            type: 'POST',
            url: 'addrfqcontactinfo.php',
            data: new FormData(this),
                processData: false,
              contentType: false,
            
                
            success: function(response){ 

                         //console.log(data);


                                 swal({

                                  title: "Message Submitted Successfully!",
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


function keyupBankfun() {

 //alert();
        var Name= $("#cnameid").val()

        var Email = $("#cemailid").val()
        var Message = $("#cmessageid").val()
    

    

   if(Name != "")
  {
    $('#cnameid_error').text(" ");
    
  }
  if(Email != "")
  {
    $('#cemailid_error').text(" ");
 }
   if(Message != "" )
  {
    $('#cmessageid_error').text(" ");
    
  }

       
}

</script>

    </body>
</html>
<?php
} ?>