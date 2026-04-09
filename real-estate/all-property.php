<?php
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="real-estate/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    $header_realEstate = "realEstate";
    if(isset($_GET['dream']) && $_GET['dream'] == 'buy'){
        $breadTitle = "Buy";
    }else if(isset($_GET['dream']) && $_GET['dream'] == 'rent'){
        $breadTitle = "Rent";
    }else if(isset($_GET['dream']) && $_GET['dream'] == 'open'){
        $breadTitle = "Open";
    }else{
        $breadTitle = "Listing";
    }


?>
<!DOCTYPE html>
<html lang="en-US">
    <style>

.heading07 h2 span {
    color: #6a7e3b;
}

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
	display:contents;
}

.list-item h4 {
	color: #FF7182;
	font-size: 18px;
	margin: 0 0 5px;	
}

.list-item p {
	margin: 0;
}

.simple-pagination ul {
	margin: 0 0 20px;
	padding: 0;
	list-style: none;
	text-align: center;
}

.simple-pagination li {
	display: inline-block;
	margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
	color: #666;
	padding: 5px 10px;
	text-decoration: none;
	border: 1px solid #EEE;
	background-color: #FFF;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
	color: #FFF;
background-color: #95ba3d;
    border-color: #95ba3d;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #95ba3d;
}
.realBox .boxHead {
    background-color: #95ba3d;
   
}
.agentbreadCrumb{margin-top: 20px;
    margin-bottom: -20px;}
@media(max-width:480px)
{
  .location-details{
    margin-top:-5px!important;
  }
}
	</style>
    <head>
	
        <?php include('../component/f_links.php');?>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		
	
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="realTopBread" style="padding:0px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" style="margin-top:22px">
								<div class="col-md-6">
					<div class="text-left   agentbreadCrumb">
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
											<li class="breadcrumb-item active">All Property</li>
										</ol>
									</div>
								</div>
								<div class="col-md-6">
									<div class="text-right">
										<?php include_once("top-buttons.php");?>
									</div>
								</div>
							</div>
                    </div>
                    <!---<div class="col-md-12">
                        <div class="heading07 text-center">
                            <h2>All <span>Property</span></h2>
                        </div>
                    </div>-->
                    <!---<div class="col-md-12">
                        <div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate/all-property.php?dream=buy';?>">Sell</a></li>
                                <li class="breadcrumb-item active"><?php echo $breadTitle;?></li>
                            </ol>
                        </div>
                    </div>--->
                </div>  
            </div>
        </section>
        <section class="" style="padding: 30px;">
          <div class="container">
            <div class="col-md-12 offset-md-6 text-right bg-white mt-2" style="margin-bottom: 10px;">
            <?php include_once("top-location.php"); ?>
            </div>
            <div class="row">
				      <div class="col-md-offset-2 col-md-9">
			          <input type="text" class="form-control" id="mainSearch" name="realEstateSearch" placeholder="Type a city or listing ID, or community to search" autocomplete="off" style="height:45px;">
		          </div>
      		  </div>
            <div class="col-md-12">
              <div class="heading07 text-center">
                <h2> <span style="color:#6a7e3b">All Property</span></h2>
              </div>
            </div>

                <div class="space"></div>
                <div class="row">
										<div class="list-wrapper">

                    <?php
               		
	
                       $country=$_SESSION['spPostCountry'];
                       $state=$_SESSION['spPostState'];
                       $city=$_SESSION['spPostCity'];

				
                    
                    $p      = new _realstateposting;
                    $pf     = new _postfield;
                    $type = "Sell";
                    $res = $p->showAllProperty($_GET["categoryID"], $type,$country,$state,$city);
                    //$res    = $p->publicpost_event($_GET["categoryID"]);
                    //echo $p->ta->sql;
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) {
                            ?>
	<div class="list-item">

                            <div class="col-md-3">
                                <div class="realBox">
                                    <a href="<?php echo $BaseUrl.'/real-estate/property-detail.php?postid='.$row['idspPostings'];?>">
                                        <div class="boxHead">
                                            <h2>
                                                <?php 
												//print_r($row); die('==============');
                                                if(strlen($row['spPostingTitle']) < 15){
                                                    echo ucwords($row['spPostingTitle']);
                                                }else{
                                                    echo ucwords(substr($row['spPostingTitle'], 0,15)).'...';
                                                }
                                                ?>
                                                    
                                            </h2>
                                            <p style="white-space: nowrap;
    width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;">
                                                <i class="fa fa-map-marker"></i> 
                                                <?php //spPostingAddress_
                                                if(strlen($row['spPostingAddress']) < 30){
                                                    echo $row['spPostingAddress'];
                                                }else{
                                                    echo substr($row['spPostingAddress'], 0,30)."...";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <?php
                                        $pic = new _realstatepic;
                                        
                                        $res2 = $pic->readFeature($row['idspPostings']);
                                        if($res2 != false){
                                            if($res2->num_rows > 0){
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
                                                }
                                            }else{
                                                $res2 = $pic->read($row['idspPostings']);
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
                                                }
                                            }
                                        }else{
                                            $res2 = $pic->read($row['idspPostings']);
                                            if ($res2 != false) {
                                                $rp = mysqli_fetch_assoc($res2);
                                                $pic2 = $rp['spPostingPic'];
                                                echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
                                            } else{
                                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>"; 
                                            }
                                        }?>
                                        <div class="midLayer">
                                            <ul>
                                                <li  title="Square Foot"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-1.png"><?php echo ($row['spPostingSqurefoot']  > 0)?$row['spPostingSqurefoot']:0; ?></li>
                                                <li  title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-2.png"><?php echo ($row['spPostingBedroom'] > 0)?$row['spPostingBedroom'] :0;?></li>
                                                <li  title="Bath Room" class="text-center"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-3.png"><?php echo ($row['spPostingBathroom']  > 0)?$row['spPostingBathroom']:0; ?></li>
                                                <li  title="Basement" class="text-right"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-4.png"><?php echo ($row['spPostBasement']  > 0)?$row['spPostBasement'] :0; ?></li>
                                            </ul>
                                        </div>
                                        <div class="boxFoot bg_white text-center"> 
                                            <p class="proType"><?php echo $propertyType;?></p>
                                            <p><span><?php if(!empty($row['spPostingPrice'])) { echo $row['defaltcurrency'].' '.number_format($row['spPostingPrice']); }?></span></p>
                                        </div>
                                    </a>
                                </div>
                            </div> 
							    </div> 
							<?php
                     
                        }
                    }
                    ?>
                       </div>  
                </div>
            </div>
								   <div id="pagination-container"></div>

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


		<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/
$(document).ready(function() {
  $.widget( "custom.catcomplete", $.ui.autocomplete, {
    _create: function() {
      this._super();
      this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
    },
    _renderMenu: function( ul, items ) {
      var that = this,
      currentCategory = "";
      $.each( items, function( index, item ) {
        var li;
        if (item.category !== undefined && item.category != currentCategory ) {
          ul.append( "<li class='ui-autocomplete-category' style='font-weight:bold;margin-left:5px'>" + item.category + "</li>" );
          currentCategory = item.category;
        }
        li = that._renderItemData( ul, item );
        if ( item.category !== undefined) {
          li.attr( "aria-label", item.category + " : " + item.label );
        }
        if(item.count){
          li.append(" ("+item.count+") ")          
        }
      });
    }
  });

  $("#mainSearch").catcomplete({
    minLength: 1,
    source: "/api.php?class=RealEstate&action=mainSearch",
    focus: function () {
      return false;
    },
    response: function(event, ui) {
      if (!ui.content.length) {
        var noResult = { value:"",label:"Sorry, no current listings match your search. Please check your spelling." };
        ui.content.push(noResult);
      }
    },
    select: function (event, ui) {
      //$("#mainSearch").val(ui.item.label);
      //$("#mainSearchDataGroup").val(ui.item.category);
      //$("#mainSearchDataId").val(ui.item.value);     
      if(ui.item.category == "City"){     
        window.location.href = "../real-estate/search.php?cityId="+ui.item.value;
      }
      else if(ui.item.category == "ListingId"){     
        window.location.href = "../real-estate/search.php?listingId="+ui.item.value;
      }
      else if(ui.item.category == "Community"){     
        window.location.href = "../real-estate/search.php?community="+ui.item.value;
      }
      else if(ui.item.category == "Address"){     
        window.location.href = "../real-estate/search.php?txtAddress="+ui.item.value;
      }
      return false;
    }
  });
});
var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 8;

    items.slice(perPage).hide();

    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });
</script>
