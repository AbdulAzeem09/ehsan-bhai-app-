<style>


</style>
<div class="row">
<?php 

$catId = isset($_GET['catId']) ? (int) $_GET['catId'] : 0;

if($_GET['page']==1){

	$start = 0;
}else{

$sss = $_GET['page']-1;
$start = 10*$sss;
}
$limit = 1;

$limitaa = 10;


$p = new _postingviewartcraft;
if($catId){


//echo 1;
$res = $p->sameCategoryPicNEW(13, $catId, $_GET['for']);

//var_dump($res);
/*if($res){
$numrowsw = mysqli_num_rows($res); 
}*/

}else{
//echo 2;
$res = $p->publicpost($start, $_GET["categoryID"], $limitaa);
$numrowsw = mysqli_num_rows($res); 
}

//echo $p->ta->sql; die;
if($res != false){

while ($row = mysqli_fetch_assoc($res)) {
if($row['spuser_idspuser']!=NULL){
$st= new _spuser;
$st1=$st->readdatabybuyerid($row['spuser_idspuser']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}}
//print_r($row);
if($account_status!=1){
?>
	<div class="col-md-4">
		<div class="artBox m_btm_20">
			<div class="topartBox" id="shpBycat">
				<?php if(!empty($row['discountphoto'])){ ?>
				<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
				<?php } ?>
			<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
			<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" >
				<?php 
				$pic = new _postingpicartcraft;
				$res2 = $pic->read($row['idspPostings']);
				if ($res2 != false) {    
					$rp = mysqli_fetch_assoc($res2);
					$pic2 = $rp['spPostingPic'];
					echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
					<?php
				} else{
					echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
					<?php
				} ?>
			</a>
			<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>"><?php if(strlen($row['spPostingTitle']) < 20){
					echo $row['spPostingTitle'];
				}else{
					echo substr($row['spPostingTitle'], 0,20)."...";
				}?></a>
			<p>
				<?php
				if(strlen($row['spPostingNotes']) < 20){
					echo $row['spPostingNotes'];
				}else{
					echo substr($row['spPostingNotes'], 0,20)."...";
				} ?>
			</p>
			<hr>
			<div class="">
				<div class="col-md-12 p-0">
							<!-- <strike>#40.00</strike> -->
						<?php
							$userid=$_SESSION['uid'];
							$c= new _orderSuccess;
							$currency= $c->readcurrency($userid);
							$res1= mysqli_fetch_assoc($currency);
							$curr=$res1['currency'];
							?>
						<?php
					if(empty($row['spPostingPrice'])){
						echo "<span class='price'>Free</span>";
					}else{
						if(empty($row['discountphoto'])){	
							echo '<span class="price">  ' .$curr.' '.$row['spPostingPrice'].  '  </span>';
						}else{
							echo '<span class="price"> ' .$curr.' '.$row['discountphoto'].  '  </span>'; 
						}
					} 
					if(empty($row['discountphoto'] != $row['spPostingPrice'] )){
						$row['spPostingPrice'];
					}else{ 
						echo '  <span class="price text-success" style="color:green;">  </span>  ';
						//<del>  ' .$curr.' '.$row['spPostingPrice'].  '  </del>

						if (is_numeric($row['spPostingPrice']) && is_numeric($row['discountphoto'])) {


							$perto =  ($row['spPostingPrice']-$row['discountphoto'])/$row['spPostingPrice']*100;
							echo '  ('.round($perto, 2).'%)  ';
						}
					}
					if($row['sippingcharge']==1){

						echo '<br> <span class="badge badge-success" style=" background-color: #24BD9D; ">Free Delivery</span>';
					}
					else{



					?>
			
			 <?php } ?>

		</div>
		
		
		
			</div>
			 
<?php } ?>

</div>

<div class="btmartBox">
				<ul class="social">
				<li> 

					<div  id="adremovetoboard<?php echo $row['idspPostings']; ?>">
						<?php

						$aap = new _addtoboard;

						$result = $aap->chkExist($row['idspPostings'], $_SESSION['pid']);
						if($result != false){  ?>

						<a class="removetoboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Remove to board"><i class="fa fa-times-circle-o" aria-hidden="true" style="font-size:27px; color:#fff;"></i>  </a>
						<?php	}else{ ?>

						<a class="addtoboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Add to board">
						<img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a>
						<?php		}
						?>

					</div>


				</li>

				<!--    <li><a href="<?php // echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="Download"><img src="<?php //echo //$BaseUrl?>/assets/images/art/icon-download.png" alt="" class="img-responsive"></a></li>
				<li data-toggle="tooltip" title="Share"><a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'><span class='sp-share-art' data-postid='<?php echo $row['idspPostings'];?>' src='<?php echo ($pic2); ?>'><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></span></a></li> -->
				<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="View Product">

					<i class="fa fa-info-circle" aria-hidden="true" style=" font-size: 27px; color: white; "></i>

				</a></li>
				</ul>
		 
	</div>

		</div>
			</div>
<?php }
}
?>



</div>

