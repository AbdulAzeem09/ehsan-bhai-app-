<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    

   // $_GET["categoryID"] = "9";
   // $_GET["categoryName"] = "Events";
    $header_coupon = "header_coupon";
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- this script for slider art -->

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
    
    <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
     <style>
         .header_coupon{
            background-color: #912A86; 
            padding: 0px 10px 5px; 
     }
    </style>

    </head>

    <body class="bg_gray">
          <?php include_once("../header.php");?>


  <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 no-padding">
                        <div class="left_couponimg" id="leftArtFrm">
                            <img src="<?php echo $BaseUrl;?>/assets/images/coupon/fashion2.PNG" class="img-responsive" alt="" style="min-width: 100%;"/>
                        </div>
                    </div>

                      <div class="col-md-9 col-xs-12">

                        <div class="row">
                            <div class="col-md-12">
                                
 <form enctype="multipart/form-data" action="" method="post" id="sp-form-post" name="postform">
                              
                        <div class="add_couponform bradius-12" style="border-radius: 12px;border-top-left-radius: 12px;border-top-right-radius: 12px;">
                                   
                    <h3 style="border-top-left-radius: 12px!important; border-top-right-radius: 12px!important;"><i style="color: #428bca" class="fa fa-pencil"></i> SUBMIT YOUR DETAILS</h3>

                                    <div class="add_couponform_body">
                            <h4 >BUISSNESS LOCATION AND CONTACT INFO</h4> 
                            <p>This information will not be shared on the website. We will only  use this to contact you if we have questions about your submission.</p>

                            <div class="space"></div>
                <!-- field section -->

                <div class="row">
                <div class="col-md-12">

                 <div class="row no-margin">
                <div class="col-md-6 no-padding">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Bussiness Name</label>
                <input type="text" class="form-control" id="" name=""  placeholder=""/>

                </div>
                
                </div>
                </div>

                <h4 style="margin-top: 15px;  margin-bottom: 20px;"> COUPON INFO</h4>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Coupon Code</label>
                <input type="text" class="form-control" id="" name=""  placeholder="The code customer will enter to recieve discount"/>

                </div>
            </div>

            <div class="col-md-6">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Coupon Name<span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="" name=""  placeholder=""/>

                </div>
            </div>
        </div>

        <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Type</label>
                <input type="text" class="form-control" id="" name=""  placeholder="% Discount"/>

                </div>
            </div>

            <div class="col-md-3">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Date Start<span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="" name=""  placeholder=""/>

                </div>
            </div>

             <div class="col-md-3">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Date End<span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="" name=""  placeholder=""/>

                </div>
            </div>
        </div>


        <div class="row">
                  

            <div class="col-md-3">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Number Available</label>
                <input type="text" class="form-control" id="" name=""  placeholder=""/>

                </div>
            </div>

             <div class="col-md-3">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Coupon Amount</label>
                <input type="text" class="form-control" id="" name=""  placeholder=""/>

                </div>
            </div>
       

            <div class="col-md-6">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Category</label>
                 <select class="form-control" name="sponsorCategory">
                                            <option class="General">1</option>
                                            <option class="Prime">2</option>
                                            <option class="Platinum">3</option>
                                            <option class="Gold">4</option>
                                            <option class="Silver">5</option>
                                            <option class="Media">6</option>
                                        </select>

                </div>
            </div>
        </div>


                 <div class="row no-margin">
                <div class="col-md-12 no-padding">
                    <div class="form-group">
                 <label for="spPostingNotes">Description</label>
               <textarea class="form-control" id="spPostingNotes" name="spPostingNotes" maxlength="500" equired=""> </textarea>

                </div>
                
                </div>
                </div>
  

             <div class="row">
                  
             <div class="col-md-6">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Discounted Items</label>
                  <input type="text" class="form-control" id="" name=""  placeholder=""/>


                </div>
            </div>

             <div class="col-md-3">
                    <div class="form-group">
                 <label for="spPostingTitle" class="lbl_1">Upload Picture</label>
                <input type="text" class="form-control" id="" name=""  placeholder=""/>

                </div>
            </div>

       </div>


         <div class="row">
         <p style="font-weight: bold;
    padding-left: 15px;
    font-size: 16px;
    padding-top: 12px;
    padding-bottom: 10px;">Use Coupon On</p>

         <div class="col-md-2">
             <div class="form-group">
           <input type="radio" name="phone_status" value="private" checked="">
           <label for="spProfilePostalCode">Print Only</label>
                      

                 </div>
                </div>

                 <div class="col-md-4">
             <div class="form-group">
           <input type="radio" name="phone_status" value="private" checked="">
           <label for="spProfilePostalCode" style="display: inline;">If Online Enter Cash 
            Discount or Persentage Discount </label>


                 </div>
                </div>

                 <div class="col-md-4">
             <div class="form-group">
             <input type="text" class="form-control" id="" name=""  placeholder=""/>

                 </div>
                </div>

           
            
                      


                   <div class="col-md-2">
             <div class="form-group">
           <input type="radio" name="phone_status" value="private" checked="">
           <label for="spProfilePostalCode">Cash</label>
           <br>
            <input type="radio" name="phone_status" value="private" checked="">
           <label for="spProfilePostalCode">Percentage</label>
                      

                 </div>
                </div>



         </div>

           <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                 <label for="spPostingNotes">Add Option</label>
              <select class="form-control" name="sponsorCategory">
                                            <option class="General">Add Option</option>
                                            <option class="Prime">30% for 2</option>
                                             <option class="Prime">50% for 3</option>
                                            
                                        </select>

                </div>
                
                </div>
<!-- 
                <div class="col-md-10">
                    <div class="form-group">
              <label for="spPostingNotes">Add Option</label> 
               <textarea class="form-control" id="spPostingNotes" name="spPostingNotes" maxlength="500" equired=""> </textarea>

                </div>
                
                </div> -->
                </div>


                  <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                 <label for="spPostingNotes">Add Fine Print</label>
               <textarea class="form-control" id="spPostingNotes" name="spPostingNotes" maxlength="500" equired=""> </textarea>

                </div>
                
                </div>
                </div>

                  <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                 <label for="spPostingNotes">Additional Details</label>
               <textarea class="form-control" id="spPostingNotes" name="spPostingNotes" maxlength="500" equired=""> </textarea>

                </div>
                
                </div>
                </div>


                <div class="row" style="margin-top: 60px; margin-bottom: 15px;">
                    <a href="" class="btn butn_cancel pull-right coupon_btn coupon_cancel" style="margin-right: 5px;">Cancel</a>

                      <a href="" class="btn butn_cancel pull-right coupon_btn coupon_draft" style="margin-right: 5px;">Save As Draft</a>

                        <a href="" class="btn butn_cancel pull-right coupon_btn coupon_submit" style="margin-right: 5px;">Submit Ad</a>



                </div>




 





                     </div>
                     </div>














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
    </body>
</html>
<?php
}
?>