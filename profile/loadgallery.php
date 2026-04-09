    <style>
	body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
}

.list-wrapper {
	padding-top:25px;
	overflow: hidden;
	}

.list-item {
	display: contents;
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
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
	background-color: #FF7182;
	border-color: #FF7182;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #e04e60;
}
</style> 
    
    <?php
    //session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $p  = new _postingview;
    $p2 = new _postingview;
	
	

    if(isset($_POST['orderBy'])){
        $orderBy = $_POST['orderBy'];
        $txtProfileId = $_POST['txtProfileId'];

        $res = $p->globaltimelinesProfile_ordr($orderBy, $txtProfileId);
		
		?>
         <div class="list-wrapper">
   <?php  if ($res != false){
                    while ($timeline = mysqli_fetch_assoc($res)) {
		//$_GET["timelineid"] = $v['idspPostings'];
		$_GET["timelineid"] = $timeline['idspPostings'];
        $res2 = $p2->singletimelines($_GET["timelineid"]);
		 //echo $res2->num_rows.'bbbbb';
		?>
		
		<?php 
        if ($res2 != false){
            while ($rows = mysqli_fetch_assoc($res2)) {?>
            
				<?php //print_r($rows);
                $pic = new _postingpic;
                $result = $pic->read($rows['idspPostings']);
				//echo $result->num_rows.'cccc';
                //echo $pic->ta->sql;
                if ($result != false) {
                    while ($rp = mysqli_fetch_assoc($result)) {
                        $pict = $rp['spPostingPic'];
                        if (isset($pict)) {
                            $dt = new DateTime($rows['spPostingDate']);
                            ?>
<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">

<!-- Magnific Popup core JS file -->
<script src="../assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<div class="list-item">
                            <div class="col-md-4 no-paddingrr searchable text-center 1">   
                                <input type="checkbox" class="emp_checkbox" style="z-index: 9;left: 53px;top: 10px;" value="<?php echo $rows['idspPostings']; ?>" data-emp-id="<?php echo $rows['idspPostings']; ?>">

                                <!--  <span id="spFavouritePost"  data-toggle="tooltip" data-placement="bottom" title="" class="icon-favorites fa fa-heart sp-favorites" data-postid="<?php echo $rows['idspPostings']; ?>" data-original-title="Favourite"><span class="font_regular"></span></span> -->

                                <!--  <span id="spFavouritePost" style="position: absolute;top: 12px;right: 30px;" data-toggle="tooltip" data-placement="bottom" title="" class="icon-favorites fa fa-heart removefavorites faa-pulse animated" data-postid="<?php echo $rows['idspPostings']; ?>" data-original-title="Unfavourite" aria-describedby="tooltip621374"><span class="font_regular"> </span></span> -->
                               

                               <!--  <span id="spFavouritePost" data-toggle="tooltip" data-placement="bottom" title="" class="icon-favorites fa fa-heart removefavorites faa-pulse animated" data-postid="2281" data-original-title="Unfavourite"><span class="font_regular"> </span></span> -->
                               <span id='spFavouritePost' style="position: absolute;top: 12px;right: 53px;" data-toggle='tooltip' data-placement='bottom' title='Unfavourite' class='icon-favorites fa fa-heart removefavorites faa-pulse animated' data-postid="<?php echo $rows['idspPostings']; ?> " data-original-title="Unfavourite"><span class='font_regular'> </span></span>
                               <div class="thumbnail" >
                                <a class="fav  mag" data-effect="mfp-newspaper" href="<?php echo ($pict); ?>">
                                    <img class="group1" style="width:100%" src="<?php echo ($pict); ?>">
                                </a>
                                </div>
                                 

                               <!--  <div class="btmFoot br_radius_bottom">
                                    <p class="date"><?php echo $dt->format('d-M-Y'); ?></p> -->

                                    <!--  <i class="icon-favorites fa fa-heart sp-favorites" style="color:red;"></i> -->
                                   <!--  <a class="name br_radius_bottom" href="<?php echo $BaseUrl.'/friends/?profileid='.$rows['idspProfiles'];?>"><?php echo ucwords($rows['spProfileName']);?></a> -->
                                <!-- </div> -->
                            </div> 
							</div>
                            <?php
                        }
                    }
                }?>
			
           <?php  
			   
			   }
        }?>
	
<?php 
    }
}
	/*}
	if(!empty($perpageresult)) {
		$output .= '<div class="row"><div class="col-md-12 text-center" id="pagination">' . $perpageresult . '</div></div>';
	}
	print $output;*/
?>
</div>
<div id="pagination-container"></div>
               
   <?php  }
    
    ?>
    
       <script type="text/javascript">   
    
$('.fav').magnificPopup({
  type: 'image'
  // other options
});


<!-- pagination js  -->
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/
</script> 
<script>
var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 12;

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