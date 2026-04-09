<style>
#btn1{
	box-shadow: none !important;
    border: 1px solid transparent !important;
	
}
.butn_find_room1:hover{background-color:#92bb33!important;}

</style>
<a data-toggle="modal" class="pointer btn butn_dash_real  btn-border-radius" data-target="#inviteFriend"><span class="fa fa-user"></span> Invite and Earn </a>
<?php if($_SESSION['guet_yes'] != 'yes'){ ?>

<a href="<?php echo $BaseUrl.'/real-estate/dashboard/';?>" class="btn butn_dash_real  btn-border-radius"><i class="fa fa-dashboard "></i> Dashboard</a>

<?php } ?>
<?php
$u = new _spuser;
if ($_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 3) {
    // IS EMAIL IS VERIFIED
    $p_result = $u->isverify($_SESSION['uid']);
    if ($p_result == 1) {
        $pv = new _postingview;
        $reuslt_vld = $pv->chekposting(3,$_SESSION['pid']);

        if ($reuslt_vld == false) {
            ?>
            <a style="margin-top: 0px; background-color:#3ea941;" href="<?php echo $BaseUrl.'/post-ad/real-estate/?post';?>" class="btn butn_save m_top_20 btn-border-radius">Submit an Ad</a>
            <?php
        }
    }
}



?>
<!-- if(isset($home) && $home == true){ ?> -->
    <?php
// }else{
    ?>
	<?php if($_SESSION['guet_yes'] != 'yes'){ ?>

    <a href="<?php echo $BaseUrl.'/real-estate/all-room.php';?>" class="btn butn_find_room1 btn-border-radius" id="btn1" style="background-color:#acdf31; color:white; border:none; border-radius:5px ">Search Rentals</a> <?php } ?>
    <?php
// }
?>