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

           <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

       
        
    </head>

    <body class="bg_gray">
      <?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>

          <?php


    if (isset($_GET['orderid']) && $_GET['orderid'] > 0) {
        $cid = $_GET['orderid'];

        $p = new _orderSuccess;
        $result = $p->readCnfrmOrdr($cid);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $txnId = $row['txn_id'];
            $dt = new DateTime($row['payment_date']);
            $paymentEmail = $row['payer_email'];
        }

    }else{
        $re = new _redirect;
        $redirctUrl = $BaseUrl . "/store/dashboard/my_orderhistory.php";
        $re->redirect($redirctUrl);
    }


/*
            $o = new _orderSuccess;

             $result = $o->orderedprofiledata($_GET['orderid']);

              // echo $o->ta->sql;
        if($result != false){
          
                        $row = mysqli_fetch_assoc($result);
                        $Profilid   = $row['spProfile_idspProfile'];

                     
                         }
             */

             $or = new _order;
            $result1 = $or->readOrderTxn($txnId, $_SESSION['pid']);   

          //  echo $or->ta->sql;  
           
                if ($result1) {
               while ($row1 = mysqli_fetch_assoc($result1)) {
              /*  echo "<pre>";
                print_r($row1);*/

                  
                        $ProTitle   = $row1['spPostingTitle'];
                         $orderpostid   = $row1['spPostings_idspPostings'];



            $pp = new _productpic;  
             $result2 = $pp->read($orderpostid);
       // echo $pp->ta->sql;
        if($result2 != false){
          
                        $row2 = mysqli_fetch_assoc($result2);
                        $Productimg   = $row2['spPostingPic'];
                        
                        

                         }         

                        

                         }
                       }
               
                                                                 
          /*
             $p = new _productposting;
      
        $result1 = $p->singletimelines($Profilid);
       // echo $p->ta->sql;
        if($result1 != false){
          
                        $row1 = mysqli_fetch_assoc($result1);
                        $ProTitle   = $row1['spPostingTitle'];
                         $Propostid   = $row1['idspPostings'];
                        

                         }*/



           ?>


     <section class="main_box">            
            <div class="container">
            		

                <div class="row">

                	 <div class="col-md-3"></div>
                    <div class="col-md-6">
                	<div class="bg_white detailEvent m_top_10  btn-border-radius">

               <ol class="breadcrumb" style="padding: 10px 20px;margin-bottom: 0px!important;list-style: none;background-color: unset!important;border-radius: 4px;">
      <li><a href="<?php echo $BaseUrl;?>/store/dashboard/"><i class="fa fa-dashboard"></i> Buyer Dashboard</a></li>
        <li><a href="<?php echo $BaseUrl;?>/store/dashboard/my_orderhistory.php">My Order History</a></li>
         <li class="active">Rating</li>
     
    </ol>
   
              <form id="reviewratingform" enctype="multipart/form-data" >

          <!-- <?php print_r($_SESSION['pid']);?>

                <?php print_r($_SESSION['uid']);?>

                <?php print_r($_GET["orderid"]);?> 
 -->

                        <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                        <input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">

                         

               <input type="hidden" name="spPostings_idspPostings" value="<?php echo $orderpostid; ?>">

                 <input type="hidden" name="idspOrder" value="<?php echo $_GET["orderid"]; ?>">

                    <div class="row">
                        <div class="col-md-12">

                        	<div class="reviewEvent" style="margin-top: 8px;  margin-left: 22px;">
                              <div class="row">
                                <div class="col-md-4"> 
                                      
                                     <?php  
                                     if ($Productimg) {
                                       echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($Productimg) . "' style='height: 120px;' >";

                                     }else{
                                       echo "<img alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive' style='height: 120px;'>";
                                     }

                                    

                                     ?>
                                   </div>
                                    <div class="col-md-8"> 

                                       <h2 class="eventcapitalize" style="font-weight: bolder;color: #202548;"><?php echo $ProTitle;   ?></h2>

                                      <div class="row reviewdetail">
                                        
                                        <p id='eventrating' class="rating" style="margin-left: 3%;margin-bottom: 0px;line-height: 16px; ">
                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            <input style="cursor:pointer" class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer" class = "full" for="star1" title="Sucks big time - 1 star"></label>
                            
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
 
                        	<div class="row">
                        		<div class="col-md-6">
                        	<h3 class="eventcapitalize" style="font-size: 22px;">Write a Review</h3>
                        		</div>

                        		<!-- <div class="col-md-6">

                			
                        		</div> -->
                        	</div>

                        	<div class="row">
                        		<div class="col-md-12">
                  <div class="form-group">
			
			<textarea class="form-control" id="review" name="review" rows="6"></textarea> 
            <br>
            <span id="review_err" style="color:red;"></span>
		         </div>
                        		</div>

                        		
                        	</div>




                        </div>
                        </div>


                        <div class="row">
                          <div class="reviewbutton">
                              <button type="reset" class="btn butn_cancel  btn-border-radius" id="Buynowclear"  style=" font-weight: bolder;">Clear</button>

                              <button type="submit" class="btn butn_storeReview  btn-border-radius" id="Buynow"  style=" font-weight: bolder;">Submit</button>
                          </div> 
                        </div>
                    </div>

           </form>  

                       </div>
                       </div>
                        <div class="col-md-3"></div>
                   </div>



                       </div>
     </section>
        
      
      <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        
        

        <script type="text/javascript">
            
            $(document).ready(function(e){



/*$('#Buynow').click(function(e){*/

/*var review = $('#review').val();

if(review == ""){

   $("#review_err").text("Please Enter Review.");

}else{*/



    // Submit form data via Ajax
    $("#reviewratingform").on('submit', function(e){

    
      var review = $('#review').val();



if(!$('.stars').is(':checked')) { 

  $("#review_err").text("Please select Star rating.");
  return false;

}else if(review == ""){

   $("#review_err").text("Please Enter Review.");
  return false;
}else{

        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'addstorerating.php',
            data: new FormData(this),
                processData: false,
              contentType: false,
            
            success: function(response){ 

                       //  console.log(data);


                                 swal({

                                  title: "Your review has been submitted successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                      //  window.location.reload();
                            location.href = "<?php echo $BaseUrl;?>/store/dashboard/my_orderhistory.php";

                                  });
            }
        });
}




    });




/*
}
*/

    //Some code
/*});*/

});

        </script>
</body>
</html>
<?php
}
?>