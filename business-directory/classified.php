

<div class="row">
<?php 

//$res = $p->publicpost_music_all();
 $p      = new _classified;
  $pf     = new _postfield;
  $res    = $p->myposted_service($_GET['business']);

if($res){
while ($row = mysqli_fetch_assoc($res)){
    //print_r($row);
    if($row['spuser_idspuser']!=NULL){
                                         $st= new _spuser;
                                    $st1=$st->readdatabybuyerid($row['spuser_idspuser']);
                                    if($st1!=false){
                                    $stt=mysqli_fetch_assoc($st1);
                                    $account_status=$stt['deactivate_status'];
                                    }
                                        }

//if(isset($_GET['keyword'])){
//if (str_contains(, )) { 
//if (strpos($row['spPostingTitle'], $_GET['keyword']) !== false) //{
//if(preg_match("/{$keyword}/i",$row['spPostingTitle'])){

//continue;
//}
//}




$result_pf = $pf->read($row['idspPostings']);
// echo $pf->ta->sql."<br>";
$sercom = $row['spPostSelection'];
/*if($result_pf){
$sercom = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
if($sercom == ''){
if($row2['spPostFieldName'] == 'spPostSelection_'){
$sercom = $row2['spPostFieldValue'];
}
}
}
}*/
if($account_status!=1){
?>
<div class="col-md-3">
<div class="ser_box_1"style="background-color: #ddd7d7;">
<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>">
<?php
$pic = new _classifiedpic;
//echo $row['idspPostings'];
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

<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="title">
<?php 




if(strlen($row['spPostingTitle']) < 15){
echo ucwords(strtolower($row['spPostingTitle']));
}else{
echo substr(ucwords(strtolower($row['spPostingTitle'])), 0,15)."...";
} 
?>   

</a>


<span class="views"><?php echo (isset($sercom) && $sercom != '')?$sercom:'&nbsp;'; ?></span>
<span class="expiry">Expires on <?php echo $row['spPostingExpDt'];?></span>
<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="btn ">View Detail</a>
</div>
</div>
<?php
}
}
}else{

echo "<h3 style='text-align:center;'>Record not Found</h3>";

}
?>
</div>  