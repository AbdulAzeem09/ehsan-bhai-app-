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



<style type="text/css">
  

.rating-box {
  position:relative!important;
  vertical-align: middle!important;
  font-size: 18px;
  font-family: FontAwesome;
  display:inline-block!important;
  color: lighten(@grayLight, 25%);
  padding-bottom: 10px;
}

 .rating-box:before{
    content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
  }

  .ratings {
    position: absolute!important;
    left:0;
    top:0;
    white-space:nowrap!important;
    overflow:hidden!important;
    color: Gold!important;
   
  }
   .ratings:before {
      content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
    }


</style>

       
        
    </head>    
<body class="bg_gray">
        <?php 

          $header_select = "freelancers";

        include_once("../header.php");?>

     <section class="main_box">            
            <div class="container">
            		

                <div class="row">


                    <div class="col-sm-12">
                	<div class="bg_white detailEvent m_top_10  btn-border-radius" >
  <ol class="breadcrumb"  style="padding: 8px 0px;margin-bottom: 0px!important;list-style: none;background-color: unset!important;border-radius: 4px;color: #f60;">
      <li><a href="<?php echo $BaseUrl ?>/freelancer" style="color: #f60;"><i class="fa fa-home"></i> Home</a></li>
      
    </ol>
	
	 <?php $pro = new _spprofiles;
	 if($result){
	 $result = $pro->read($_GET['prof_id']); 
		  $row2 = mysqli_fetch_assoc($result); 
		  
	 }
	 
	 
?>
<div class="row text-center">
	<img  src="<?php  echo $row2['spProfilePic']; ?>" class="" ><br><br>
	
	<p class="eventcapitalize"><b><?php echo $row2['spProfileName'];?></b></p>
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