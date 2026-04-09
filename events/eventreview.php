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
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- image gallery script strt -->
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
        <!-- image gallery script end -->
        <!-- this script for slider art -->
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

       
        
    </head>    
<body class="bg_gray">
        <?php include_once("../header.php");?>

           <?php
             
             $p = new _spevent;
       // $pf  = new _postfield;

        $result = $p->singletimelines($_GET['postid']);
        //echo $p->ta->sql;
        if($result != false){
          
                        $row = mysqli_fetch_assoc($result);
                        $ProTitle   = $row['spPostingTitle'];

                         }

           ?>


     <section class="main_box">            
            <div class="container">
            		

                <div class="row">

                	 <div class="col-md-3"></div>
                    <div class="col-md-6">
                	<div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">

              <form id="reviewratingform" enctype="multipart/form-data" >

              <!-- <?php print_r($_SESSION['pid']);?>

                <?php print_r($_SESSION['uid']);?>

                <?php print_r($_GET["postid"]);?> -->


                        <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                        <input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">

                 <input type="hidden" name="idspPostings" value="<?php echo $_GET["postid"]; ?>">

                    <div class="row">
                        <div class="col-sm-12">

                        	<div class="reviewEvent">
                              <div class="row">
                                <div class="col-sm-12">
                                       <h2 class="eventcapitalize" style="font-weight: bolder;text-align: center;color: #202548;"><?php echo $ProTitle;   ?></h2>
                                </div>
                            </div>
 
                        	<div class="row">
                        		<div class="col-md-6">
                        	<h3 class="eventcapitalize" style="font-weight: bolder;">Write a Review</h3>
                        		</div>

                        		<div class="col-md-6">

                			 <div class="row reviewdetail">
                                        
                                        <p id='eventrating' class="rating" style="margin-left: 41%;margin-bottom: 0px;line-height: 16px; margin-top: 26px;">
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
                        		<div class="col-sm-12">
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
                              <button type="reset" class="btn butn_cancel" id="Buynowclear"  style="border-radius: 25px; font-weight: bolder;">Clear</button>

                              <button type="submit" class="btn butn_Review" id="Buynow"  style="border-radius: 25px; font-weight: bolder;">Submit</button>
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
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
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
            url: 'addreviewrating.php',
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
                            location.href = "<?php echo $BaseUrl;?>/events/mybookedtickets.php";

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