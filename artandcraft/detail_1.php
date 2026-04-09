


<?php 
    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "artandcraft/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = 13;
    if(isset($_GET['postid']) && $_GET['postid'] > 0){

        $p = new _postingview;
        $pf  = new _postfield;

        $result = $p->singletimelines($_GET['postid']);
        //echo $p->ta->sql;
        if($result != false){
            $row = mysqli_fetch_assoc($result);
            $spProfiles_idspProfilesid   = $row['spProfiles_idspProfiles'];
            $posttype   = $row['ad_type'];
            $ProTitle   = $row['spPostingTitle'];
            $ProDes     = $row['spPostingNotes'];
            $ArtistName = $row['spProfileName']; 
            $ArtistId   = $row['idspProfiles'];
            $ArtistAbout= $row['spProfileAbout'];
            $ArtistPic  = $row['spProfilePic'];
            $price      = $row['spPostingPrice'];
            $country    = $row['spPostingsCountry'];
            $city      = $row['spPostingsCity'];

            $pr = new _spprofilehasprofile;
            $result3 = $pr->frndLeevel($_SESSION['pid'], $row['idspProfiles']);
            if($result3 == 0){
              $level = '1st Connection';
            }else if($result3 == 1){
              $level = '1st Connection';
            }else if($result3 == 2){
              $level = '2nd Connection';
            }else if($result3 == 3){
              $level = '3rd Connection';
            }else{
              $level = '';
            }

            //posting fields
            $result_pf = $pf->read($row['idspPostings']);
            //echo $pf->ta->sql."<br>";
            if($result_pf){
                $catName = "";
                $imageSize = "";
                $printedYear    = "";
                $OrganizerId = "";
                $Quantity = "";
                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                    
                    if($catName == ''){
                        if($row2['spPostFieldName'] == 'photos_'){
                            $catName = $row2['spPostFieldValue'];

                        }
                    }
                    if($imageSize == ''){
                        if($row2['spPostFieldName'] == 'imagesize_'){
                            $imageSize = $row2['spPostFieldValue'];

                        }
                    }
                    if($printedYear == ''){
                        if($row2['spPostFieldName'] == 'mediaprinted_'){
                            $printedYear = $row2['spPostFieldValue'];

                        }
                    }
                    if($OrganizerId == ''){
                        if($row2['spPostFieldName'] == 'spPostingEventOrgId_'){
                            $OrganizerId = $row2['spPostFieldValue'];

                        }
                    }
                    if($Quantity == ''){
                        if($row2['spPostFieldName'] == 'quantity_'){
                            $Quantity = $row2['spPostFieldValue'];

                        }
                    }
                }
            }
        }

        //rating
        $r = new _sppostrating;
        $res = $r->read($_SESSION["pid"],$_GET["postid"]);
        if($res != false){
            $rows = mysqli_fetch_assoc($res);
            $rat = $rows["spPostRating"];
        }else{
            $rat = 0;
        }
            
        $result = $r->review($_GET["postid"]);
        if($result != false){
            $total = 0;
            $count = $result->num_rows;
            while($rows = mysqli_fetch_assoc($result)){
                $total += $rows["spPostRating"];
            }
            $ratings = $total/$count;
        }else{
            $ratings = 0;
        }
        $r = new _sppostreview;
        $result = $r->review($_GET["postid"]);
        if($result != false)
        {
            $rows = mysqli_fetch_assoc($result);
            $review = $result->num_rows;
        }
        else
            $review = 0;
    }else{
        $re = new _redirect;
        $redirctUrl = "../artandcraft";
        $re->redirect($redirctUrl);
        //header('location:../photos/');
    }


    $header_photo = "header_photo";
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links-artcraft.php');?>
	<!--Bootstrap core css-->

        <!--This script for posting timeline data End-->
        <!--NOTIFICATION-->
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- image gallery script strt -->
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
        <!-- image gallery script end -->
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <script>
            function checkqty(txb) {                
                var qty = parseInt(txb);
                var actualQty = $("#spOrderQty").val();
                //alert(actualQty);return false;
                //console.log(actualQty);
                if(qty > actualQty){
                    document.getElementById("newValue").value = actualQty;
                }
                if(qty < 1){
                    document.getElementById("newValue").value = 1;
                    //alert("less");
                }
            }
        </script>
<!-- New Design Data Start -->

 <style type="text/css">svg:not(:root).svg-inline--fa{overflow:visible}.svg-inline--fa{display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em}.svg-inline--fa.fa-lg{vertical-align:-.225em}.svg-inline--fa.fa-w-1{width:.0625em}.svg-inline--fa.fa-w-2{width:.125em}.svg-inline--fa.fa-w-3{width:.1875em}.svg-inline--fa.fa-w-4{width:.25em}.svg-inline--fa.fa-w-5{width:.3125em}.svg-inline--fa.fa-w-6{width:.375em}.svg-inline--fa.fa-w-7{width:.4375em}.svg-inline--fa.fa-w-8{width:.5em}.svg-inline--fa.fa-w-9{width:.5625em}.svg-inline--fa.fa-w-10{width:.625em}.svg-inline--fa.fa-w-11{width:.6875em}.svg-inline--fa.fa-w-12{width:.75em}.svg-inline--fa.fa-w-13{width:.8125em}.svg-inline--fa.fa-w-14{width:.875em}.svg-inline--fa.fa-w-15{width:.9375em}.svg-inline--fa.fa-w-16{width:1em}.svg-inline--fa.fa-w-17{width:1.0625em}.svg-inline--fa.fa-w-18{width:1.125em}.svg-inline--fa.fa-w-19{width:1.1875em}.svg-inline--fa.fa-w-20{width:1.25em}.svg-inline--fa.fa-pull-left{margin-right:.3em;width:auto}.svg-inline--fa.fa-pull-right{margin-left:.3em;width:auto}.svg-inline--fa.fa-border{height:1.5em}.svg-inline--fa.fa-li{width:2em}.svg-inline--fa.fa-fw{width:1.25em}.fa-layers svg.svg-inline--fa{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.fa-layers{display:inline-block;height:1em;position:relative;text-align:center;vertical-align:-.125em;width:1em}.fa-layers svg.svg-inline--fa{-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter,.fa-layers-text{display:inline-block;position:absolute;text-align:center}.fa-layers-text{left:50%;top:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter{background-color:#ff253a;border-radius:1em;-webkit-box-sizing:border-box;box-sizing:border-box;color:#fff;height:1.5em;line-height:1;max-width:5em;min-width:1.5em;overflow:hidden;padding:.25em;right:0;text-overflow:ellipsis;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-bottom-right{bottom:0;right:0;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom right;transform-origin:bottom right}.fa-layers-bottom-left{bottom:0;left:0;right:auto;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom left;transform-origin:bottom left}.fa-layers-top-right{right:0;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-top-left{left:0;right:auto;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top left;transform-origin:top left}.fa-lg{font-size:1.3333333333em;line-height:.75em;vertical-align:-.0667em}.fa-xs{font-size:.75em}.fa-sm{font-size:.875em}.fa-1x{font-size:1em}.fa-2x{font-size:2em}.fa-3x{font-size:3em}.fa-4x{font-size:4em}.fa-5x{font-size:5em}.fa-6x{font-size:6em}.fa-7x{font-size:7em}.fa-8x{font-size:8em}.fa-9x{font-size:9em}.fa-10x{font-size:10em}.fa-fw{text-align:center;width:1.25em}.fa-ul{list-style-type:none;margin-left:2.5em;padding-left:0}.fa-ul>li{position:relative}.fa-li{left:-2em;position:absolute;text-align:center;width:2em;line-height:inherit}.fa-border{border:solid .08em #eee;border-radius:.1em;padding:.2em .25em .15em}.fa-pull-left{float:left}.fa-pull-right{float:right}.fa.fa-pull-left,.fab.fa-pull-left,.fal.fa-pull-left,.far.fa-pull-left,.fas.fa-pull-left{margin-right:.3em}.fa.fa-pull-right,.fab.fa-pull-right,.fal.fa-pull-right,.far.fa-pull-right,.fas.fa-pull-right{margin-left:.3em}.fa-spin{-webkit-animation:fa-spin 2s infinite linear;animation:fa-spin 2s infinite linear}.fa-pulse{-webkit-animation:fa-spin 1s infinite steps(8);animation:fa-spin 1s infinite steps(8)}@-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.fa-rotate-90{-webkit-transform:rotate(90deg);transform:rotate(90deg)}.fa-rotate-180{-webkit-transform:rotate(180deg);transform:rotate(180deg)}.fa-rotate-270{-webkit-transform:rotate(270deg);transform:rotate(270deg)}.fa-flip-horizontal{-webkit-transform:scale(-1,1);transform:scale(-1,1)}.fa-flip-vertical{-webkit-transform:scale(1,-1);transform:scale(1,-1)}.fa-flip-both,.fa-flip-horizontal.fa-flip-vertical{-webkit-transform:scale(-1,-1);transform:scale(-1,-1)}:root .fa-flip-both,:root .fa-flip-horizontal,:root .fa-flip-vertical,:root .fa-rotate-180,:root .fa-rotate-270,:root .fa-rotate-90{-webkit-filter:none;filter:none}.fa-stack{display:inline-block;height:2em;position:relative;width:2.5em}.fa-stack-1x,.fa-stack-2x{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.svg-inline--fa.fa-stack-1x{height:1em;width:1.25em}.svg-inline--fa.fa-stack-2x{height:2em;width:2.5em}.fa-inverse{color:#fff}.sr-only{border:0;clip:rect(0,0,0,0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.sr-only-focusable:active,.sr-only-focusable:focus{clip:auto;height:auto;margin:0;overflow:visible;position:static;width:auto}.svg-inline--fa .fa-primary{fill:var(--fa-primary-color,currentColor);opacity:1;opacity:var(--fa-primary-opacity,1)}.svg-inline--fa .fa-secondary{fill:var(--fa-secondary-color,currentColor);opacity:.4;opacity:var(--fa-secondary-opacity,.4)}.svg-inline--fa.fa-swap-opacity .fa-primary{opacity:.4;opacity:var(--fa-secondary-opacity,.4)}.svg-inline--fa.fa-swap-opacity .fa-secondary{opacity:1;opacity:var(--fa-primary-opacity,1)}.svg-inline--fa mask .fa-primary,.svg-inline--fa mask .fa-secondary{fill:#000}.fad.fa-inverse{color:#fff}</style><link rel="apple-touch-icon" sizes="180x180" href="../dashboard/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../dashboard/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../dashboard/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../dashboard/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../dashboard/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../dashboard/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="../dashboard/assets/js/config.js"></script>
    <script src="../dashboard/vendors/overlayscrollbars/OverlayScrollbars.min.js"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="../dashboard/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
    <style>
        .swiper-wrapper {
    position: relative;
    width: 100%;
    height: unset;
    z-index: 1;
    display: flex;
    transition-property: transform;
    box-sizing: content-box;
}


    </style>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="../../../../../css.css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="../dashboard/vendors/overlayscrollbars/OverlayScrollbars.min.css" rel="stylesheet">
    <link href="../dashboard/assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl" disabled="true">
   
    <link href="../dashboard/assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl" disabled="true">
    <link href="../dashboard/assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <script>
      var isRTL = JSON.parse(localStorage.getItem('isRTL'));
      if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
  <style type="text/css" data-href="lib\style.css">.star-rating {
  width: 0;
  position: relative;
  display: inline-block;
  background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDguOSIgaGVpZ2h0PSIxMDMuNiIgdmlld0JveD0iMCAwIDEwOC45IDEwMy42Ij48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6I2UzZTZlNjt9PC9zdHlsZT48L2RlZnM+PHRpdGxlPnN0YXJfMDwvdGl0bGU+PGcgaWQ9IkxheWVyXzIiIGRhdGEtbmFtZT0iTGF5ZXIgMiI+PGcgaWQ9IkxheWVyXzEtMiIgZGF0YS1uYW1lPSJMYXllciAxIj48cG9seWdvbiBjbGFzcz0iY2xzLTEiIHBvaW50cz0iMTA4LjkgMzkuNiA3MS4zIDM0LjEgNTQuNCAwIDM3LjYgMzQuMSAwIDM5LjYgMjcuMiA2Ni4xIDIwLjggMTAzLjYgNTQuNCA4NS45IDg4LjEgMTAzLjYgODEuNyA2Ni4xIDEwOC45IDM5LjYiLz48L2c+PC9nPjwvc3ZnPg0K);
  background-position: 0 0;
  background-repeat: repeat-x;
  cursor: pointer;
}
.star-rating .star-value {
  position: absolute;
  height: 100%;
  width: 100%;
  background: url('data:image/svg+xml;base64,PHN2Zw0KCXhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwOC45IiBoZWlnaHQ9IjEwMy42IiB2aWV3Qm94PSIwIDAgMTA4LjkgMTAzLjYiPg0KCTxkZWZzPg0KCQk8c3R5bGU+LmNscy0xe2ZpbGw6I2YxYzk0Nzt9PC9zdHlsZT4NCgk8L2RlZnM+DQoJPHRpdGxlPnN0YXIxPC90aXRsZT4NCgk8ZyBpZD0iTGF5ZXJfMiIgZGF0YS1uYW1lPSJMYXllciAyIj4NCgkJPGcgaWQ9IkxheWVyXzEtMiIgZGF0YS1uYW1lPSJMYXllciAxIj4NCgkJCTxwb2x5Z29uIGNsYXNzPSJjbHMtMSIgcG9pbnRzPSI1NC40IDAgNzEuMyAzNC4xIDEwOC45IDM5LjYgODEuNyA2Ni4xIDg4LjEgMTAzLjYgNTQuNCA4NS45IDIwLjggMTAzLjYgMjcuMiA2Ni4xIDAgMzkuNiAzNy42IDM0LjEgNTQuNCAwIi8+DQoJCTwvZz4NCgk8L2c+DQo8L3N2Zz4NCg==');
  background-repeat: repeat-x;
}
.star-rating.disabled {
  cursor: default;
}
.star-rating.is-busy {
  cursor: wait;
}
.star-rating .star-value.rtl {
  -moz-transform: scaleX(-1);
  -o-transform: scaleX(-1);
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1);
  filter: FlipH;
  -ms-filter: "FlipH";
  right: 0;
  left: auto;
}
.text-warning {
    --falcon-text-opacity: 1;
    color: #99068a !important;
}

.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #99068a;
    background-color: transparent;
    border-bottom: 2px solid var(--falcon-primary);
}
</style>


<!-- Image Popup Gallary -->
<link href="../dashboard/vendors/glightbox/glightbox.min.css" rel="stylesheet" />
<script src="../dashboard/vendors/glightbox/glightbox.min.js"></script>
<!-- Image Popup Gallary -->

<!-- sLIDER gALLERY sECTION sTYLE-->

<style>
    .tcb-product-slider {
  background: #333;
  background-image: url(https://plugins.miniorange.com/wp-content/uploads/2018/12/grey-bg.png);
  background-size: cover;
  background-repeat: no-repeat;
  padding: 100px 0;
}
.tcb-product-slider .carousel-control {
  width: 0%;
}

.tcb-product-item a:hover {
  text-decoration: none;
}
.tcb-product-item .tcb-hline {
  margin: 10px 0;
  height: 1px;
  background: #ccc;
}
@media all and (max-width: 768px) {
  .tcb-product-item {
    margin-bottom: 30px;
  }
}
.tcb-product-photo {
  text-align: center;
  height: 180px;
  background: #fff;
  padding: 5px;
}
.tcb-product-photo img {
  height: 100%;
  display: inline-block;
}
.tcb-product-info {
  background: #ededed;
  padding: 15px;
}
.tcb-product-title h4 {
  margin-top: 0;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}
.tcb-product-rating {
  color: #acacac;
}
.tcb-product-rating .active {
  color: #FFB500;
}
.tcb-product-price {
  color: #333333;
  font-size: 13px;
  padding: 0 0 5px 0;
}



.details {
    margin: 50px 0; }
 .details h1 {
      font-size: 32px;
      text-align: center;
      margin-bottom: 3px; }
    .details .back-link {
      text-align: center; }
      .details .back-link a {
        display: inline-block;
        margin: 20px 0;
        padding: 15px 30px;
        background: #333;
        color: #fff;
        border-radius: 24px; }
        .details .back-link a svg {
          margin-right: 10px;
          vertical-align: text-top;
          display: inline-block; }



.btn-primary {
    color: #fff;
    background-color: #99068a;
    border-color: #2e6da4;
}
.card-header {
    padding: 1rem 1.25rem;
    margin-bottom: 0;
    background-color: rgb(153 6 138 / 41%);
    border-bottom: 0px solid var(--falcon-card-border-color);
}
a {
    color: #99068a;
    text-decoration: none;
}

</style>

<!-- New Design Data End -->


    <!-- ===============================================-->
    <!--    Designed Header Footer Styles-->
    <!-- ===============================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/custom.css" >
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" > -->
	<!-- TABLE CSS -->
	<!-- zoom effect -->
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
  	 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>
    <!-- youtube links -->
    <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/youtube.js"></script>

    <!-- SWEET ALERT MSG -->
    <link href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/sweetalert.min.js"></script>
    <!-- END -->

    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
     <!-- Magnific Popup core JS file -->
     <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery.validate.min.js"></script>
  
  
  <script type="text/javascript">
	
    $('.thumbnail').magnificPopup({
    type: 'image'
    // other options
    });

</script>
        
    </head>


  <body>
 <!-- Modal -->
 <div id="flagPost" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <form method="post" action="addtoflag.php" class="sharestorepos">
                    <div class="modal-content no-radius">
                        <input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid'];?>">
                        <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                        <input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Flag Post</h4>
                        </div>
                        <div class="modal-body">
                            <div class="radio">
                                <label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
                            </div> 

                            <!-- <label>Why flag this post?</label> -->
                            <textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="" class="btn butn_mdl_submit ">
                            <button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include_once("../header.php");?>

    
        
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container" data-layout="container">
        <script>
          var isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        </script>

   
         
          
        <div class="content pt-2" >
        
        <div class="row">
          <div class="col-12">
            <div class="card mb-3 btn-reveal-trigger">
              <div class="card-header position-relative min-vh-5 mb-2">
              <nav style="--falcon-breadcrumb-divider: '»';" aria-label="breadcrumb">
<ol class="breadcrumb">
  <li class="breadcrumb-item"  ><a href="#" style="color: #000000;" >Home</a></li>
  <li class="breadcrumb-item"  ><a href="#"  style="color: #000000;" >Art And Craft</a></li>
  <li class="breadcrumb-item active"   aria-current="page"  style="color: #000000;" > Art </li>
</ol>

</nav>


              </div>
            </div>
          </div>
        </div>
        <div class="row g-0">
          <div class="col-lg-8 pe-lg-2">
            <div class="card mb-3">

            <div class="card-header">
                  <h5 class="mb-0">Product Category : Not Defined</h5>
                
          </div>
          
          
          <div class="position-relative rounded-1 border bg-white dark__bg-1100 p-3">
          <div class="position-absolute end-0 top-0 mt-2 me-3 z-index-1">
              <button class="btn btn-link btn-sm p-0 btn-border-radius" type="button">
                  Product :  &nbsp;<?php if($posttype==1){ echo 'Art'; }else{ echo 'Craft' ;} ?><?php echo  $_GET['postid'];?>           
                </button>
              </div>
         
                    
              
         
    
      
      <div class="card-body bg-light">
      
          
            <div class="row mb-3">
     
             



           
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                  <div class="product-slider" id="galleryTop">
                    <div class="swiper-container theme-slider position-lg-absolute all-0 swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events swiper-container-autoheight" data-swiper="{&quot;autoHeight&quot;:true,&quot;spaceBetween&quot;:5,&quot;loop&quot;:true,&quot;loopedSlides&quot;:5,&quot;thumb&quot;:{&quot;spaceBetween&quot;:5,&quot;slidesPerView&quot;:5,&quot;loop&quot;:true,&quot;freeMode&quot;:true,&quot;grabCursor&quot;:true,&quot;loopedSlides&quot;:5,&quot;centeredSlides&quot;:true,&quot;slideToClickedSlide&quot;:true,&quot;watchSlidesVisibility&quot;:true,&quot;watchSlidesProgress&quot;:true,&quot;parent&quot;:&quot;#galleryTop&quot;},&quot;slideToClickedSlide&quot;:true}">
                      <div class="swiper-wrapper h-100" style="height: 297px; transform: translate3d(-2840px, 0px, 0px); transition-duration: 0ms;" id="swiper-wrapper-a6d62efaf010751cf" aria-live="polite"><div class="swiper-slide h-100 swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="1" style="width: 563px; margin-right: 5px;" role="group" aria-label="2 / 6"><img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-2.jpg" alt=""></div><div class="swiper-slide h-100 swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 563px; margin-right: 5px;" role="group" aria-label="3 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-3.jpg" alt=""></div><div class="swiper-slide h-100 swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 563px; margin-right: 5px;" role="group" aria-label="4 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-4.jpg" alt=""></div><div class="swiper-slide h-100 swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 563px; margin-right: 5px;" role="group" aria-label="5 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-5.jpg" alt=""></div><div class="swiper-slide h-100 swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="5" style="width: 563px; margin-right: 5px;" role="group" aria-label="6 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-6.jpg" alt=""></div>
                        <div class="swiper-slide h-100 swiper-slide-active" data-swiper-slide-index="0" style="width: 563px; margin-right: 5px;" role="group" aria-label="1 / 6"><img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1.jpg" alt=""></div>
                        <div class="swiper-slide h-100 swiper-slide-next" data-swiper-slide-index="1" style="width: 563px; margin-right: 5px;" role="group" aria-label="2 / 6"><img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-2.jpg" alt=""></div>
                        <div class="swiper-slide h-100" data-swiper-slide-index="2" style="width: 563px; margin-right: 5px;" role="group" aria-label="3 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-3.jpg" alt=""></div>
                        <div class="swiper-slide h-100" data-swiper-slide-index="3" style="width: 563px; margin-right: 5px;" role="group" aria-label="4 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-4.jpg" alt=""></div>
                        <div class="swiper-slide h-100" data-swiper-slide-index="4" style="width: 563px; margin-right: 5px;" role="group" aria-label="5 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-5.jpg" alt=""></div>
                        <div class="swiper-slide h-100 swiper-slide-duplicate-prev" data-swiper-slide-index="5" style="width: 563px; margin-right: 5px;" role="group" aria-label="6 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-6.jpg" alt=""></div>
                      <div class="swiper-slide h-100 swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="0" style="width: 563px; margin-right: 5px;" role="group" aria-label="1 / 6"><img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1.jpg" alt=""></div><div class="swiper-slide h-100 swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="1" style="width: 563px; margin-right: 5px;" role="group" aria-label="2 / 6"><img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-2.jpg" alt=""></div><div class="swiper-slide h-100 swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 563px; margin-right: 5px;" role="group" aria-label="3 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-3.jpg" alt=""></div><div class="swiper-slide h-100 swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 563px; margin-right: 5px;" role="group" aria-label="4 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-4.jpg" alt=""></div><div class="swiper-slide h-100 swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 563px; margin-right: 5px;" role="group" aria-label="5 / 6"> <img class="rounded-1 fit-cover h-100 w-100" src="../dashboard/assets/img/products/1-5.jpg" alt=""></div></div>
                      <div class="swiper-nav">
                        <div class="swiper-button-next swiper-button-white" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-a6d62efaf010751cf"></div>
                        <div class="swiper-button-prev swiper-button-white" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-a6d62efaf010751cf"></div>
                      </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                  </div>
                <div class="swiper-container thumb swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events swiper-container-free-mode swiper-container-thumbs" style="cursor: grab;">
                <div class="swiper-wrapper" style="transform: translate3d(-340.8px, 0px, 0px); transition-duration: 0ms;" id="swiper-wrapper-c31a87ab32c6361b" aria-live="polite">
                <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="1" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="2 / 6">

            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-2.jpg" alt="">



            
          </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="3 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-3.jpg" alt="">
          </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="4 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-4.jpg" alt="">
          </div><div class="swiper-slide swiper-slide-duplicate swiper-slide-visible" data-swiper-slide-index="4" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="5 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-5.jpg" alt="">
          </div><div class="swiper-slide swiper-slide-duplicate swiper-slide-visible swiper-slide-prev" data-swiper-slide-index="5" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="6 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-6.jpg" alt="">
          </div>
          <div class="swiper-slide swiper-slide-visible swiper-slide-active swiper-slide-thumb-active" data-swiper-slide-index="0" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="1 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1.jpg" alt="">
          </div>
        
          <div class="swiper-slide swiper-slide-visible swiper-slide-next" data-swiper-slide-index="1" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="2 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-2.jpg" alt="">
          </div>
        
          <div class="swiper-slide swiper-slide-visible" data-swiper-slide-index="2" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="3 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-3.jpg" alt="">
          </div>
        
          <div class="swiper-slide" data-swiper-slide-index="3" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="4 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-4.jpg" alt="">
          </div>
        
          <div class="swiper-slide" data-swiper-slide-index="4" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="5 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-5.jpg" alt="">
          </div>
        
          <div class="swiper-slide swiper-slide-duplicate-prev" data-swiper-slide-index="5" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="6 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-6.jpg" alt="">
          </div>
        <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active swiper-slide-thumb-active" data-swiper-slide-index="0" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="1 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1.jpg" alt="">
          </div><div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="1" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="2 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-2.jpg" alt="">
          </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="3 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-3.jpg" alt="">
          </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="4 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-4.jpg" alt="">
          </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 108.6px; margin-right: 5px;" role="group" aria-label="5 / 6">
            <img class="img-fluid rounded mt-1" src="file:///C:/xampp/htdocs/falcon%20dashboard/assets/img/products/1-5.jpg" alt="">
          </div></div><span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div></div>
                <div class="col-lg-6">

                  <h5> <?php echo $ProTitle; ?> </h5>
                 
                  <div class="fs--4 mb-3 d-inline-block text-decoration-none"><svg class="svg-inline--fa fa-star fa-w-18 text-warning" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star fa-w-18 text-warning" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star fa-w-18 text-warning" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star fa-w-18 text-warning" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star-half-alt fa-w-17 text-warning star-icon" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star-half-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 536 512" data-fa-i2svg=""><path fill="currentColor" d="M508.55 171.51L362.18 150.2 296.77 17.81C290.89 5.98 279.42 0 267.95 0c-11.4 0-22.79 5.9-28.69 17.81l-65.43 132.38-146.38 21.29c-26.25 3.8-36.77 36.09-17.74 54.59l105.89 103-25.06 145.48C86.98 495.33 103.57 512 122.15 512c4.93 0 10-1.17 14.87-3.75l130.95-68.68 130.94 68.7c4.86 2.55 9.92 3.71 14.83 3.71 18.6 0 35.22-16.61 31.66-37.4l-25.03-145.49 105.91-102.98c19.04-18.5 8.52-50.8-17.73-54.6zm-121.74 123.2l-18.12 17.62 4.28 24.88 19.52 113.45-102.13-53.59-22.38-11.74.03-317.19 51.03 103.29 11.18 22.63 25.01 3.64 114.23 16.63-82.65 80.38z"></path></svg><!-- <span class="fa fa-star-half-alt text-warning star-icon"></span> Font Awesome fontawesome.com --><span class="ms-1 text-600">(8)</span></div>
                     <h4 class="d-flex align-items-center"><span class="text-warning me-2">$<?php echo $price; ?></span><span class="me-1 fs--1 text-500"><del class="me-1">$2400</del><strong class="text-warning me-2">-50%</strong></span></h4>
                  
                  <div class="row">
                    <div class="col-auto pe-0">
  
                    </div>
                    <div class="col-auto px-2 px-md-3">
                        
                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="window-maximize" class="svg-inline--fa fa-window-maximize fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm0 394c0 3.3-2.7 6-6 6H54c-3.3 0-6-2.7-6-6V192h416v234z"></path></svg>
                            <span class="d-none d-sm-inline-block">Size</span>
                        </div>
                    <div class="col-auto px-0">
                       
                    <select class="form-select mb-3" aria-label="Default select example">
                    <option selected="">Monthly Plan</option>
                    <option value="1">Annual Plan</option>
                  </select></div>
                  </div>
                  <div class="row">
                    <div class="col-auto pe-0">
  
                    </div>
                    <div class="col-auto px-2 px-md-3">
                        
                            <svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                            <span class="d-none d-sm-inline-block">Quantity</span>
                        </div>
                    <div class="col-auto px-0">
                       
                    <div class="input-group input-group-sm" data-quantity="data-quantity"><button class="btn btn-sm btn-outline-secondary border-300 btn-border-radius" data-field="input-quantity" data-type="minus">-</button><input class="form-control text-center input-quantity input-spin-none" type="number" min="0" value="0" aria-label="Amount (to the nearest dollar)" style="max-width: 50px"><button class="btn btn-sm btn-outline-secondary border-300 btn-border-radius" data-field="input-quantity" data-type="plus">+</button></div>
                  </div>
                  
                 
                </div>
                 
                    <div class="row">
                 
                    <div class="col-auto px-2 px-md-3 pt-5">
                        <a class="btn btn-m btn-primary btn-border-radius" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
                      </div>
                    <div class="col-auto px-0 pt-5"><a class="btn btn-m btn-outline-danger border-300" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wish List"><svg class="svg-inline--fa fa-heart fa-w-16 me-1" aria-hidden="true" focusable="false" data-prefix="far" data-icon="heart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M458.4 64.3C400.6 15.7 311.3 23 256 79.3 200.7 23 111.4 15.6 53.6 64.3-21.6 127.6-10.6 230.8 43 285.5l175.4 178.7c10 10.2 23.4 15.9 37.6 15.9 14.3 0 27.6-5.6 37.6-15.8L469 285.6c53.5-54.7 64.7-157.9-10.6-221.3zm-23.6 187.5L259.4 430.5c-2.4 2.4-4.4 2.4-6.8 0L77.2 251.8c-36.5-37.2-43.9-107.6 7.3-150.7 38.9-32.7 98.9-27.8 136.5 10.5l35 35.7 35-35.7c37.8-38.5 97.8-43.2 136.5-10.6 51.1 43.1 43.5 113.9 7.3 150.8z"></path></svg>
                    <!-- <span class="far fa-heart me-1"></span> Font Awesome fontawesome.com -->282</a></div>
                  </div>
                  
                </div>
              </div>
              <div class="row" style="padding-top: 2.3rem;">
                <div class="col-12">
                  <div class="overflow-hidden mt-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item"><a class="nav-link ps-0" id="description-tab" data-bs-toggle="tab" href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="false">DESCRIPTION</a></li>

                      <li class="nav-item"><a class="nav-link px-2 px-md-3 active" id="exdescription-tab" data-bs-toggle="tab" href="#tab-exdescription" role="tab" aria-controls="tab-exdescription" aria-selected="true">EVENT / EXIBITION</a></li>
  
                    
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade" id="tab-description" role="tabpanel" aria-labelledby="description-tab">
                      
                      
                      <h5 class="fs-3">Will I be charged sales tax?</h5>
                      </div>

                      <div class="tab-pane fade active show pt-2" id="tab-exdescription" role="tabpanel" aria-labelledby="exdescription-tab">
                      
                      <ul class="list-group list-group-flush">
                      <div class="d-flex btn-reveal-trigger">
                      <div class="calendar"><span class="calendar-month">Dec</span><span class="calendar-day">16</span></div>
                      <div class="flex-1 position-relative ps-3">
                        <h3 class="fs-3 mb-0"><a href="../../app/events/event-detail.html">Folk Festival</a></h3>
                        <p class="mb-1">Organized by <a href="#!" class="text-700">Harvard University</a></p>
                        <p class="text-1000 mb-0">Time: 9:00AM</p>
                        <p class="text-1000 mb-0">Location: Cambridge Masonic Hall Association</p>Place: Porter Square, North Cambridge
                      </div>
                    </div>
                    <div class="border-dashed-bottom my-3"></div>
                    <div class="d-flex btn-reveal-trigger">
                      <div class="calendar"><span class="calendar-month">Dec</span><span class="calendar-day">16</span></div>
                      <div class="flex-1 position-relative ps-3">
                        <h6 class="fs-3 mb-0"><a href="../../app/events/event-detail.html">Folk Festival</a></h6>
                        <p class="mb-1">Organized by <a href="#!" class="text-700">Harvard University</a></p>
                        <p class="text-1000 mb-0">Time: 9:00AM</p>
                        <p class="text-1000 mb-0">Location: Cambridge Masonic Hall Association</p>Place: Porter Square, North Cambridge
                      </div>
                    </div>
                    <div class="border-dashed-bottom my-3"></div>
                    <div class="d-flex btn-reveal-trigger">
                      <div class="calendar"><span class="calendar-month">Dec</span><span class="calendar-day">16</span></div>
                      <div class="flex-1 position-relative ps-3">
                        <h6 class="fs-3 mb-0"><a href="../../app/events/event-detail.html">Folk Festival</a></h6>
                        <p class="mb-1">Organized by <a href="#!" class="text-700">Harvard University</a></p>
                        <p class="text-1000 mb-0">Time: 9:00AM</p>
                        <p class="text-1000 mb-0">Location: Cambridge Masonic Hall Association</p>Place: Porter Square, North Cambridge
                      </div>
                    </div>
                    <div class="border-dashed-bottom my-3"></div>
                    <div class="d-flex btn-reveal-trigger">
                      <div class="calendar"><span class="calendar-month">Dec</span><span class="calendar-day">16</span></div>
                      <div class="flex-1 position-relative ps-3">
                        <h6 class="fs-3 mb-0"><a href="../../app/events/event-detail.html">Folk Festival</a></h6>
                        <p class="mb-1">Organized by <a href="#!" class="text-700">Harvard University</a></p>
                        <p class="text-1000 mb-0">Time: 9:00AM</p>
                        <p class="text-1000 mb-0">Location: Cambridge Masonic Hall Association</p>Place: Porter Square, North Cambridge
                      </div>
                    </div>
  

  
</ul>


                      </div>




                      

<div class="tab-pane fade" id="tab-specifications" role="tabpanel" aria-labelledby="specifications-tab">
                      <div class="tcb-product-slider">
       
    </div>




                      </div>
                      

                      <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="row mt-3">
                          <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="mb-1"><svg class="svg-inline--fa fa-star fa-w-18 text-warning fs--1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning fs--1"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star fa-w-18 text-warning fs--1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning fs--1"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star fa-w-18 text-warning fs--1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning fs--1"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star fa-w-18 text-warning fs--1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning fs--1"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star fa-w-18 text-warning fs--1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning fs--1"></span> Font Awesome fontawesome.com --><span class="ms-3 text-dark fw-semi-bold">Awesome support, great code 😍</span></div>
                            <p class="fs--1 mb-2 text-600">By Drik Smith • October 14, 2019</p>
                            <p class="mb-0">You shouldn't need to read a review to see how nice and polished this theme is. So I'll tell you something you won't find in the demo. After the download I had a technical question, emailed the team and got a response right from the team CEO with helpful advice.</p>
                            <hr class="my-4">
                            <div class="mb-1"><svg class="svg-inline--fa fa-star fa-w-18 text-warning fs--1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning fs--1"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star fa-w-18 text-warning fs--1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning fs--1"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star fa-w-18 text-warning fs--1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning fs--1"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star fa-w-18 text-warning fs--1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <span class="fa fa-star text-warning fs--1"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-star-half-alt fa-w-17 text-warning star-icon fs--1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star-half-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 536 512" data-fa-i2svg=""><path fill="currentColor" d="M508.55 171.51L362.18 150.2 296.77 17.81C290.89 5.98 279.42 0 267.95 0c-11.4 0-22.79 5.9-28.69 17.81l-65.43 132.38-146.38 21.29c-26.25 3.8-36.77 36.09-17.74 54.59l105.89 103-25.06 145.48C86.98 495.33 103.57 512 122.15 512c4.93 0 10-1.17 14.87-3.75l130.95-68.68 130.94 68.7c4.86 2.55 9.92 3.71 14.83 3.71 18.6 0 35.22-16.61 31.66-37.4l-25.03-145.49 105.91-102.98c19.04-18.5 8.52-50.8-17.73-54.6zm-121.74 123.2l-18.12 17.62 4.28 24.88 19.52 113.45-102.13-53.59-22.38-11.74.03-317.19 51.03 103.29 11.18 22.63 25.01 3.64 114.23 16.63-82.65 80.38z"></path></svg><!-- <span class="fa fa-star-half-alt text-warning star-icon fs--1"></span> Font Awesome fontawesome.com --><span class="ms-3 text-dark fw-semi-bold">Outstanding Design, Awesome Support</span></div>
                            <p class="fs--1 mb-2 text-600">By Liane • December 14, 2019</p>
                            <p class="mb-0">This really is an amazing template - from the style to the font - clean layout. SO worth the money! The demo pages show off what Bootstrap 4 can impressively do. Great template!! Support response is FAST and the team is amazing - communication is important.</p>
                          </div>
                          <div class="col-lg-6 ps-lg-5">
                            <form>
                              <h5 class="mb-3">Write your Review</h5>
                              <div class="mb-3"><label class="form-label">Ratting: </label>
                                <div class="d-block star-rating" data-rater="{&quot;starSize&quot;:32,&quot;step&quot;:0.5}" style="width: 160px; height: 32px; background-size: 32px;"><div class="star-value" style="background-size: 32px; width: 0px;"></div><div class="star-value" style="background-size: 32px;"></div></div>
                              </div>
                              <div class="mb-3"><label class="form-label" for="formGroupNameInput">Name:</label><input class="form-control" id="formGroupNameInput" type="text"></div>
                              <div class="mb-3"><label class="form-label" for="formGroupEmailInput">Email:</label><input class="form-control" id="formGroupEmailInput" type="email"></div>
                              <div class="mb-3"><label class="form-label" for="formGrouptextareaInput">Review:</label><textarea class="form-control" id="formGrouptextareaInput" rows="3"></textarea></div><button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
         
     
       
        
        </div>
        
       
   
        
             
        
      
    </div>
   
   
  
   
  


            </div>
           
           
          </div>
          <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">

              <div class="card mb-3 overflow-hidden">
                <div class="card-header">
                  <h5 class="mb-0">Seller Details</h5>
                </div>
                <div class="card-body bg-light">
                <div class="d-flex">
                    
                <svg  aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" class="svg-inline--fa fa-map-marker-alt fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg>
                   
                <div class="flex-1 ms-2"><a class="fw-semi-bold" href="../../pages/user/profile.html">Location: </a>Canada , Altona</div>
                  </div>
                  <div class="border-dashed-bottom my-3"></div>
                  <div class="d-flex">
                  <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="store" class="svg-inline--fa fa-store fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 616 512"><path fill="currentColor" d="M602 118.6L537.1 15C531.3 5.7 521 0 510 0H106C95 0 84.7 5.7 78.9 15L14 118.6c-33.5 53.5-3.8 127.9 58.8 136.4 4.5.6 9.1.9 13.7.9 29.6 0 55.8-13 73.8-33.1 18 20.1 44.3 33.1 73.8 33.1 29.6 0 55.8-13 73.8-33.1 18 20.1 44.3 33.1 73.8 33.1 29.6 0 55.8-13 73.8-33.1 18.1 20.1 44.3 33.1 73.8 33.1 4.7 0 9.2-.3 13.7-.9 62.8-8.4 92.6-82.8 59-136.4zM529.5 288c-10 0-19.9-1.5-29.5-3.8V384H116v-99.8c-9.6 2.2-19.5 3.8-29.5 3.8-6 0-12.1-.4-18-1.2-5.6-.8-11.1-2.1-16.4-3.6V480c0 17.7 14.3 32 32 32h448c17.7 0 32-14.3 32-32V283.2c-5.4 1.6-10.8 2.9-16.4 3.6-6.1.8-12.1 1.2-18.2 1.2z"></path></svg>
                    <div class="flex-1 ms-2"><a class="fw-semi-bold" href="../../pages/user/profile.html">Visit Store</a></div>
                  </div>
                 
                  <div class="border-dashed-bottom my-3"></div>
                  <div class="d-flex"><a class="d-inline-block" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Card verification value" aria-label="Card verification value"><svg class="svg-inline--fa fa-question-circle fa-w-16 ms-2" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zM262.655 90c-54.497 0-89.255 22.957-116.549 63.758-3.536 5.286-2.353 12.415 2.715 16.258l34.699 26.31c5.205 3.947 12.621 3.008 16.665-2.122 17.864-22.658 30.113-35.797 57.303-35.797 20.429 0 45.698 13.148 45.698 32.958 0 14.976-12.363 22.667-32.534 33.976C247.128 238.528 216 254.941 216 296v4c0 6.627 5.373 12 12 12h56c6.627 0 12-5.373 12-12v-1.333c0-28.462 83.186-29.647 83.186-106.667 0-58.002-60.165-102-116.531-102zM256 338c-25.365 0-46 20.635-46 46 0 25.364 20.635 46 46 46s46-20.636 46-46c0-25.365-20.635-46-46-46z"></path></svg><!-- <span class="fa fa-question-circle ms-2"></span> Font Awesome fontawesome.com --></a>
                    <div class="flex-1 ms-2"><a class="fw-semi-bold" href="../../pages/user/profile.html">Enquiry</a></div>
                  </div>
                  <div class="border-dashed-bottom my-3"></div>
                  <div class="d-flex"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="flag" class="svg-inline--fa fa-flag fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M349.565 98.783C295.978 98.783 251.721 64 184.348 64c-24.955 0-47.309 4.384-68.045 12.013a55.947 55.947 0 0 0 3.586-23.562C118.117 24.015 94.806 1.206 66.338.048 34.345-1.254 8 24.296 8 56c0 19.026 9.497 35.825 24 45.945V488c0 13.255 10.745 24 24 24h16c13.255 0 24-10.745 24-24v-94.4c28.311-12.064 63.582-22.122 114.435-22.122 53.588 0 97.844 34.783 165.217 34.783 48.169 0 86.667-16.294 122.505-40.858C506.84 359.452 512 349.571 512 339.045v-243.1c0-23.393-24.269-38.87-45.485-29.016-34.338 15.948-76.454 31.854-116.95 31.854z"></path></svg>
                    <div class="flex-1 ms-2"><a class="fw-semi-bold" href="../../pages/user/profile.html">Flag this Post</a></div>
                  </div>
                  
                 
                  <h5 class="fs-2 mt-5 mb-2">Share with friends</h5>
                  <div class="icon-group pt-2"><a class="icon-item text-facebook" href="#!"><svg class="svg-inline--fa fa-facebook-f fa-w-10" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg><!-- <span class="fab fa-facebook-f"></span> Font Awesome fontawesome.com --></a><a class="icon-item text-twitter" href="#!"><svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg><!-- <span class="fab fa-twitter"></span> Font Awesome fontawesome.com --></a><a class="icon-item text-google-plus" href="#!"><svg class="svg-inline--fa fa-google-plus-g fa-w-20" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google-plus-g" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M386.061 228.496c1.834 9.692 3.143 19.384 3.143 31.956C389.204 370.205 315.599 448 204.8 448c-106.084 0-192-85.915-192-192s85.916-192 192-192c51.864 0 95.083 18.859 128.611 50.292l-52.126 50.03c-14.145-13.621-39.028-29.599-76.485-29.599-65.484 0-118.92 54.221-118.92 121.277 0 67.056 53.436 121.277 118.92 121.277 75.961 0 104.513-54.745 108.965-82.773H204.8v-66.009h181.261zm185.406 6.437V179.2h-56.001v55.733h-55.733v56.001h55.733v55.733h56.001v-55.733H627.2v-56.001h-55.733z"></path></svg><!-- <span class="fab fa-google-plus-g"></span> Font Awesome fontawesome.com --></a><a class="icon-item text-linkedin" href="#!"><svg class="svg-inline--fa fa-linkedin-in fa-w-14" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path></svg><!-- <span class="fab fa-linkedin-in"></span> Font Awesome fontawesome.com --></a><a class="icon-item text-700" href="#!"><svg class="svg-inline--fa fa-medium-m fa-w-16" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="medium-m" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M71.5 142.3c.6-5.9-1.7-11.8-6.1-15.8L20.3 72.1V64h140.2l108.4 237.7L364.2 64h133.7v8.1l-38.6 37c-3.3 2.5-5 6.7-4.3 10.8v272c-.7 4.1 1 8.3 4.3 10.8l37.7 37v8.1H307.3v-8.1l39.1-37.9c3.8-3.8 3.8-5 3.8-10.8V171.2L241.5 447.1h-14.7L100.4 171.2v184.9c-1.1 7.8 1.5 15.6 7 21.2l50.8 61.6v8.1h-144v-8L65 377.3c5.4-5.6 7.9-13.5 6.5-21.2V142.3z"></path></svg><!-- <span class="fab fa-medium-m"></span> Font Awesome fontawesome.com --></a></div>
                 </div>
              </div>
            
             
             
          
              
            </div>
          </div>
        </div>
     
<style>



.carousel .thumb-content .btn:hover, .carousel .thumb-content  .btn:focus {
	color: #fff;
	background: #7ac400;
	box-shadow: none;
}
.carousel .thumb-content .btn i {
	font-size: 14px;
	font-weight: bold;
	margin-left: 5px;
}

.carousel-control-prev, .carousel-control-next {
	height: 44px;
	width: 40px;
	background: #99068a;	
	margin: auto 0;
	border-radius: 4px;
	opacity: 0.8;
}
.carousel-control-prev:hover, .carousel-control-next:hover {
	background: #78bf00;
	opacity: 1;
}
.carousel-control-prev i, .carousel-control-next i {
	font-size: 36px;
	position: absolute;
	top: 50%;
	display: inline-block;
	margin: -19px 0 0 0;
	z-index: 5;
	left: 0;
	right: 0;
	color: #fff;
	text-shadow: none;
	font-weight: bold;
}
.carousel-control-prev i {
	margin-left: -2px;
}
.carousel-control-next i {
	margin-right: -4px;
}		
.carousel-indicators {
	bottom: -50px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 10px;
	height: 10px;
	margin: 4px;
	border-radius: 50%;
	border: none;
}
.carousel-indicators li {	
	background: rgba(0, 0, 0, 0.2);
}
.carousel-indicators li.active {	
	background: rgba(0, 0, 0, 0.6);
}
.carousel .wish-icon {
	position: absolute;
	right: 25px;
	top: 10px;
	z-index: 99;
	cursor: pointer;
	font-size: 16px;
	color: #abb0b8;
}
.carousel .wish-icon .fa-heart {
	color: #ff6161;
}

</style>

<div class="container-xl">
	<div class="row">
		<div class="col-md-12">
			<h2>Related <b>Arts</b></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active" style="height: 330px!important;
    overflow: hidden;">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="">									
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Apple iPad</h4>									
								
									<p class="item-price"><strike>$400.00</strike> <b>$369.00</b></p>
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="Headphone">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Sony Headphone</h4>									
								
									<p class="item-price"><strike>$25.00</strike> <b>$23.99</b></p>
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>		
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="Macbook">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Macbook Air</h4>									
								
									<p class="item-price"><strike>$899.00</strike> <b>$649.00</b></p>
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>								
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="Nikon">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Nikon DSLR</h4>									
								
									<p class="item-price"><strike>$315.00</strike> <b>$250.00</b></p>
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="Play Station">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Sony Play Station</h4>
									<p class="item-price"><strike>$289.00</strike> <span>$269.00</span></p>
								
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="Macbook">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Macbook Pro</h4>
									<p class="item-price"><strike>$1099.00</strike> <span>$869.00</span></p>
								
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="Speaker">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Bose Speaker</h4>
									<p class="item-price"><strike>$109.00</strike> <span>$99.00</span></p>
									
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="Galaxy">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Samsung Galaxy S8</h4>
									<p class="item-price"><strike>$599.00</strike> <span>$569.00</span></p>
								
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>						
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="iPhone">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Apple iPhone</h4>
									<p class="item-price"><strike>$369.00</strike> <span>$349.00</span></p>
								
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="Canon">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Canon DSLR</h4>
									<p class="item-price"><strike>$315.00</strike> <span>$250.00</span></p>
								
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="Pixel">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Google Pixel</h4>
									<p class="item-price"><strike>$450.00</strike> <span>$418.00</span></p>
									
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>	
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border: 1px solid #d4dbc4e8;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src="https://www.ampersand-graphics.com/wp-content/uploads/2019/04/1077184466.jpg" class="img-fluid" alt="Watch">
								</div>
								<div class="thumb-content" style="text-align: center;">
									<h4>Apple Watch</h4>
									<p class="item-price"><strike>$350.00</strike> <span>$330.00</span></p>
									<!----<div class="star-rating">  
										<ul class="list-inline">
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star-o"></i></li>
										</ul>
									</div>----->
									<a href="#" class="btn btn-primary" style="color: white;">View More</a>
                   <a class="btn btn-sm btn-primary" style="background-color: #99068a;" href="#!"><svg class="svg-inline--fa fa-cart-plus fa-w-18 me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <span class="fas fa-cart-plus me-sm-2"></span> Font Awesome fontawesome.com -->
                        <span class="d-none d-sm-inline-block"  style="color: white;">Add To Cart</span></a>
								</div>						
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
</div>
      </div>
      
   
      <!-- Bottom Slider - Products Display -->



   
        
      </div>
    
    </main>
    
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

 
    <?php include('postshare.php');?>

        
       <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        <!-- notification js -->
        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></>

        <script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
            // Colorbox Call
            $(document).ready(function(){
                $("[rel^='lightbox']").prettyPhoto();
            });
        </script>
        <!-- image gallery script end -->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="../dashboard/vendors/popper/popper.min.js"></script>
    <script src="../dashboard/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../dashboard/vendors/anchorjs/anchor.min.js"></script>
    <script src="../dashboard/vendors/is/is.min.js"></script> 
    <script src="../dashboard/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="../dashboard/vendors/rater-js/index.js"></script>

    <script src="../dashboard/vendors/lodash/lodash.min.js"></script>
    <script src="../../../../../v3/polyfill.min.js?features=window.scroll"></script>
    <script src="../dashboard/vendors/list.js/list.min.js"></script>
    <script src="../dashboard/assets/js/theme.js"></script>
  

</body></html>
<?php
}
?>