

<div class="row " style="margin:20px">
<h4 style="background: grey;text-align:center;font-size: 25px;" >Timeline</h4>
<?php 

$p2 = new _postings;
$sp= new _spprofiles;
$res2=$p2->businesspost($_GET['business']);
if($res2!=false){
	
	while ($rows = mysqli_fetch_assoc($res2)) {
		$pic = new _postingpic;
       $result = $pic->read($rows['idspPostings']);
	   if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$pict = $rp['spPostingPic']; 
$idspPostingPic = $rp['idspPostingPic']; 
		if (isset($pict)) { ?>
		<div class='col-md-3'  style="margin-top: 15px;"> 
		<a  class="pop<?php echo $idspPostingPic ?>"  onclick="maker_fun('<?php echo $idspPostingPic; ?>')"><img  class=' imageresource<?php echo $idspPostingPic;?> postpic img-thumbnail img-responsive bradius-15' style="height:250px;width:225px;" src="<?php  echo  $pict; ?>"></a>    
		</div>
		
		<?php 
//die('abccccccccccc');
/*
echo "<div class='col-md-3'>";
echo "<a class='thumbnail mag' data-effect='mfp-newspaper' style='border: 0px solid #ddd;' href='" . ($pict) . "'><img alt='Posting Pic' src='" . ($pict) . "' style='height: 50%;    width: 50%;' class='postpic img-thumbnail img-responsive bradius-15'></a>";
//include("postingpic.php");
echo "</div>";
*/
}else{

echo "<h5 style='text-align:center;'>Record not Found</h5>";

}

	   }
	}
}
?>

</div>


<div class="row " style="margin:20px">
<h4 style="background: grey;text-align:center;font-size: 25px;"  >Store</h4>
<?php 
$p = new _productposting;

                              
 $res2 = $p->limit_all_product(1,$_GET['business']);

if($res2!=false){
	while ($rows = mysqli_fetch_assoc($res2)) {
		
		$pic = new _productpic;
     $result = $pic->read($rows['idspPostings']);
	 
	   if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$pict = $rp['spPostingPic']; 
$idspPostingPic = $rp['idspPostingPic']; 
		if (isset($pict)) { ?>
		<div class='col-md-3' style="margin-top: 15px;">
		<a class="pop<?php echo $idspPostingPic ?>"  onclick="maker_fun('<?php echo $idspPostingPic; ?>')" ><img  class=' imageresource<?php echo $idspPostingPic;?>   postpic img-thumbnail img-responsive bradius-15' style="height:250px;width:225px;" src="<?php  echo  $pict; ?>"></a>
		</div>
		
		<?php 

}else{

echo "<h5 style='text-align:center;'>Record not Found</h5>";

}

	   }
	}
}
?>

</div>

<div class="row " style="margin:20px">
<h4 style="background: grey;text-align:center;font-size: 25px;"  >Real Estate</h4>
<?php 
 $pc      = new _realstateposting;
$pf     = new _postfield;
$_GET["categoryID"] = "3";

$res2 = $pc->myAllSellActiveProperty($_GET['categoryID'], $_GET['business'], $type);

if($res2!=false){
	while ($rows = mysqli_fetch_assoc($res2)) {
		//print_r($rows);
	$pic = new _realstatepic;
                                                    
   $result = $pic->readFeature($rows['idspPostings']);
	 
	   if ($result != false) {
$rp = mysqli_fetch_assoc($result);  
//print_r($rp);
$pict = $rp['spPostingPic']; 
$idspPostingPic = $rp['idspPostingPic']; 
		if (isset($pict)) { ?>
		<div class='col-md-3' style="margin-top: 15px;">
		<a class="pop<?php echo $idspPostingPic ?>"  onclick="maker_fun('<?php echo $idspPostingPic; ?>')" ><img  class='imageresource<?php echo $idspPostingPic;?> postpic img-thumbnail img-responsive bradius-15' style="height:250px;width:225px;" src="<?php  echo  $pict; ?>"></a>
		</div>
		
		<?php 

}else{

echo "<h5 style='text-align:center;'>Record not Found</h5>";

}

	   }
	}
}
?>

</div>

<div class="row " style="margin:20px">
<h4 style="background: grey;text-align:center;font-size: 25px;"  >Rental</h4>
<?php 
 $pc      = new _realstateposting;
$pf     = new _postfield;
$_GET["categoryID"] = "3";

$res2 = $pc->myRentalProperty($_GET['categoryID'], $_GET['business'], $type);

if($res2!=false){
	while ($rows = mysqli_fetch_assoc($res2)) {
		//print_r($rows);
	$pic = new _realstatepic;
                                                    
   $result = $pic->readFeature($rows['idspPostings']);
	 
	   if ($result != false) {
$rp = mysqli_fetch_assoc($result);  
//print_r($rp);
$pict = $rp['spPostingPic']; 
$idspPostingPic = $rp['idspPostingPic']; 
		if (isset($pict)) { ?>
		<div class='col-md-3' style="margin-top: 15px;">
		<a class="pop<?php echo $idspPostingPic ?>"  onclick="maker_fun('<?php echo $idspPostingPic; ?>')"><img  class='imageresource<?php echo $idspPostingPic;?> postpic img-thumbnail img-responsive bradius-15' style="height:250px;width:225px;" src="<?php  echo  $pict; ?>"></a>
		</div>
		
		<?php 

}else{

echo "<h5 style='text-align:center;'>Record not Found</h5>";

}

	   }
	}
}
?>

</div>

<div class="row " style="margin:20px ">
<h4 style="background: grey;text-align:center;font-size: 25px;" >Events</h4>
<?php 
 $start = 0;
$p      = new _spevent;

$_GET["categoryID"] = "9";

$res2    = $p->publicpost($start, $_GET["categoryID"]);

if($res2!=false){
	while ($rows = mysqli_fetch_assoc($res2)) {
		//print_r($rows);
	$pic = new _eventpic;
                                        
   $result = $pic->readFeature($rows['idspPostings']);
	 
	   if ($result != false) {
$rp = mysqli_fetch_assoc($result);  
//print_r($rp);
$pict = $rp['spPostingPic']; 
$idspPostingPic = $rp['idspPostingPic']; 
		if (isset($pict)) { ?>
		<div class='col-md-3' style="margin-top: 15px;">
		<a class="pop<?php echo $idspPostingPic ?>"  onclick="maker_fun('<?php echo $idspPostingPic; ?>')"><img  class='imageresource<?php echo $idspPostingPic;?> postpic img-thumbnail img-responsive bradius-15' style="height:250px;width:225px;" src="<?php  echo  $pict; ?>"></a>
		</div>
		
		<?php 

}else{

echo "<h5 style='text-align:center;'>Record not Found</h5>";

}

	   }
	}
}
?>

</div>

<div class="row " style="margin:20px ">
<h4 style="background: grey;text-align:center;font-size: 25px;" >Art & Craft</h4>
<?php 
 $start = 0;
$limit = 1;
$_GET["categoryID"] = 13;
$p = new _postingviewartcraft;
$stt= new _orderSuccess;
$res2 = $stt->readname_art_all($_GET['business']);

if($res2!=false){
	while ($rows = mysqli_fetch_assoc($res2)) {
		//print_r($rows);
	$pic = new _postingpicartcraft;
	$result = $pic->read($rows['idspPostings']);     
	 
	   if ($result != false) {
$rp = mysqli_fetch_assoc($result);  
//print_r($rp);
$pict = $rp['spPostingPic'];
$idspPostingPic = $rp['idspPostingPic'];  
		if (isset($pict)) { ?>
		<div class='col-md-3' style="margin-top: 15px;">
		<a class="pop<?php echo $idspPostingPic ?>"  onclick="maker_fun('<?php echo $idspPostingPic; ?>')"><img  class='imageresource<?php echo $idspPostingPic;?> postpic img-thumbnail img-responsive bradius-15' style="height:250px;width:225px;" src="<?php  echo  $pict; ?>"></a>
		</div>
		
		<?php 

}else{

echo "<h5 style='text-align:center;'>Record not Found</h5>";

}

	   }
	}
}
?>

</div>

<div class="row " style="margin:20px ">
<h4 style="background: grey;text-align:center;font-size: 25px;" >Classified Ad</h4> 
<?php 
 $p      = new _classified;
  $pf     = new _postfield;
  $res2    = $p->myposted_service($_GET['business']);

if($res2!=false){
	while ($rows = mysqli_fetch_assoc($res2)) {
		
	$pic = new _classifiedpic;

$result = $pic->read($rows['idspPostings']);
	 
	   if ($result != false) {
$rp = mysqli_fetch_assoc($result);  
//print_r($rp);
$pict = $rp['spPostingPic']; 
$idspPostingPic = $rp['idspPostingPic']; 
		if (isset($pict)) { ?>
		<div class='col-md-3' style="margin-top: 15px;">
		<a class="pop<?php echo $idspPostingPic ?>"  onclick="maker_fun('<?php echo $idspPostingPic; ?>')"><img  class='imageresource<?php echo $idspPostingPic;?> postpic img-thumbnail img-responsive bradius-15' style="height:250px;width:225px;" src="<?php  echo  $pict; ?>"></a>
		</div>
		
		<?php 

}

	   }else{

echo "<h5 style='text-align:center;'>Record not Found</h5>";

}
	}
}
?>

</div>

<div class="row " style="margin:20px ">
<h4 style="background: grey;text-align:center;font-size: 25px;" >Business For Sale</h4> 
<?php 
 $de= new _businessrating;
 $res2= $de->read_business_tab($_GET['business']);

if($res2!=false){
	while ($rows = mysqli_fetch_assoc($res2)) {
		
$result=$de->read_files($rows['idspbusiness']);
	 
	   if ($result != false) {
$rp = mysqli_fetch_assoc($result);    
//print_r($rp);
$pict = $rp['filename']; 
$idspPostingPic = $rp['id']; 
		if (isset($pict)) { ?>
		<div class='col-md-3' style="margin-top: 15px;">
		<a class="pop<?php echo $idspPostingPic ?>"  onclick="maker_fun('<?php echo $idspPostingPic; ?>')"><img  class='imageresource<?php echo $idspPostingPic;?> postpic img-thumbnail img-responsive bradius-15' style="height:250px;width:225px;" src="<?php  echo  $BaseUrl; ?>/business_for_sale/uploads/<?php  echo  $pict; ?>"></a>         
		</div>   
		
		<?php 

}

	   }else{

echo "<h5 style='text-align:center;'>Record not Found</h5>";

}
	}
}
?>

</div>

<div class="row " style="margin:20px ">
<h4 style="background: grey;text-align:center;font-size: 25px;" >Trainings</h4> 
<?php 
 $p = new _postings;
$res2 = $p->read_active_training_pid($_GET['business']);

if($res2!=false){
	while ($rows = mysqli_fetch_assoc($res2)) {
		
$pic = new _postings;

$result = $pic->read_cover_images($rows['id']); 
	 
	   if ($result != false) {
$rp = mysqli_fetch_assoc($result);  
//print_r($rp);
$pict = $rp['filename']; 
$idspPostingPic = $rp['id'];  
		if (isset($pict)) { ?>
		<div class='col-md-3' style="margin-top: 15px;">
		<a class="pop<?php echo $idspPostingPic ?>"  onclick="maker_fun('<?php echo $idspPostingPic; ?>')"><img  class='imageresource<?php echo $idspPostingPic;?> postpic img-thumbnail img-responsive bradius-15' style="height:250px;width:225px;" src="<?php  echo  $BaseUrl; ?>/post-ad/uploads/<?php  echo  $pict; ?>"></a>
		</div>
		
		<?php 

}

	   }else{

echo "<h5 style='text-align:center;'>Record not Found</h5>";

}
	}
}
?>

</div>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 100%; height: 264px;" > 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>     

<script>     

 function maker_fun(a){
    //$(".pop").on("click", function() {
   $('#imagepreview').attr('src', $('.imageresource'+a).attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
//});
 }

</script>      