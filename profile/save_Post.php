<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">

<!-- Magnific Popup core JS file -->
<script src="../assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<!-- Favourite post start -->
<!-- <div class="post_timeline bradius-15 bg-white" style="padding: 5px 15px;">
<!-- Audio start -->
<!--<input type="hidden" name="txtProfileId" id="txtProfileId" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="txtPagid" id="txtPagid" value="5">
<div class="row filterArea no-margin bradius-20 bg-white">
<!--  <div class="col-md-4 " style="padding: 3px;">

</div> -->
<!--<div class="col-md-4 no-padding">
<form class="form-inline">
<div class="form-group">
<label>Sort By</label>
<select class="form-control ordrSave bradius-20">
<option value="DESC">DESC</option>
<option value="ASC">ASC</option>

</select>
</div>
</form>
</div>
<style>
#searchtx {
margin-left: 196px !important;
}
</style>
<!--  <div class="col-md-4 no-padding">
<a href="<?php echo $BaseUrl . '/profile/index.php?hidePost' ?>" class="db_btn db_primarybtn">Hidden Post</a>
</div> -->
<!--<div class="col-md-4 no-padding">
<form class="">
<div class="">

<input type="text" name="" value="" id="searchtx" class="form-control searchkeywordbox" placeholder="search keyword, description" />
</div>
</form>
</div>
</div>

</div>-->   

<div class="" style='padding:0px 10px;'>

<div class="row">
<div class="gallery-img  okkk" id="update_gallery">

	
<?php


$res = $p->getrelated($_SESSION['pid']);
//var_dump($res);
//  echo $p->tas->sql; die("==========");



if ($res != false) {

while ($timeline = mysqli_fetch_assoc($res)) {



$_GET["timelineid"] = $timeline['spPostings_idspPostings'];
//print_r($timeline);
// exit;
?>

<div style="font-weight:bold;">

<?php


$p2 = new _postingview;
if (isset($grouptimelines) && $grouptimelines == 1) {

// echo"here";
$res2 = $p2->allgrouptimelines($_GET["timelineid"]);
} else {

$res2 = $p2->singletimelines_2($_GET["timelineid"], $_SESSION['pid']);
//     print_r($res2);
// echo"here1";
//echo $_GET["timelineid"];
//	 die("====55555=======");
}
//echo $p2->ak->sql;
?>

<?php
//echo $p2->ta->sql;
if ($res2 != false)
while ($rows = mysqli_fetch_assoc($res2)) {
//print_r($rows);echo 'aaaaaaa';

$pp = new _postingview;
$resu = $pp->profileidget($_GET["timelineid"]);
if ($resu != false) {
$row33 = mysqli_fetch_assoc($resu);
$iddd = $row33['spProfiles_idspProfiles'];
}





$pro = new _spprofiles;
$result3 = $pro->readUserId($iddd);

if ($result3 != false) {
$row3 = mysqli_fetch_assoc($result3);
$picture3 = $row3["spProfilePic"];
$profilename3 = $row3["spProfileName"];
// print_r($row3);echo 'aaaaaaa';


?>
<div class=" post_timeline searchable post_timeline_all_post ">
<div class="row <?php (isset($_GET["grouptimeline"]) ? "" : ($rows["spPostingVisibility"] != -1 && !isset($_GET["groupid"]) ? "highlight" : "")); ?>">
<div class="col-md-6">
<div class="left_profile_timeline">
    <?php
    //print_r($rows);die('+++');
    
    $picture = $rows["spProfilePic"];
    $profilename = $rows["spProfileName"];
    $postingDate = $p2->spPostingDate($rows["spPostingDate"]);

    if (isset($picture3)) {
        echo "<img alt='profilepic'  class='img-circle' src=' " . ($picture3) . "'>";
    } else {
        echo "<img alt='profilepic'  class='' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' >";
    }
    ?>
</div>
<div class="title_profile">

<a href="<?php echo $BaseUrl.'/friends/?profileid='.$row3['idspProfiles']; ?>"><h4><?php echo ucwords($profilename3); ?></h4></a>
    <h5><?php echo $postingDate; ?> <i class="fa fa-globe"></i></h5>
</div>
</div>
<div class="col-md-6">
<div class="dropdown pull-right right_profile_timeline">
    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
    <ul class="dropdown-menu">
        <?php
        $sp = new _savepost;
        $result2 = $sp->savepost($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
        if ($result2) {
            if ($result2->num_rows > 0) { 
               $unsve = $BaseUrl . '/post-ad/savePost.php?unsave=' . $rows['idspPostings'] ;
                ?>
                <li><a onclick='Unsave_Post("<?php echo $unsve ?>")'><i class="fa fa-save"></i> Unsave Post</a></li> <?php
                                                                                                                                                            } else { ?>
                <li><a href="<?php echo $BaseUrl . '/post-ad/savePost.php?postid=' . $rows['idspPostings']; ?>"><i class="fa fa-save"></i> Save Post</a></li> <?php
                                                                                                                                                            }
                                                                                                                                                        } else { ?>
            <li><a href="<?php echo $BaseUrl . '/post-ad/savePost.php?postid=' . $rows['idspPostings']; ?>"><i class="fa fa-save"></i> Save Post</a></li> <?php
                                                                                                                                                        }
                                                                                                                                                        ?>

        <!-- <li><a href="#"><i class="fa fa-pencil"></i> Edit Post</a></li> -->
        <!-- <li><a href="#"><i class="fa fa-map-o"></i> Add Location</a></li> -->
        <?php
        //Delete timeline by poster//
        $pr = new _spprofiles;
        $pres = $pr->checkprofile($_SESSION['uid'], $rows['idspProfiles']);
        if ($pres != false) {
            echo "<li><a href='../post-ad/deletePost.php?postid=" . $rows['idspPostings'] . "&flag=1' ><i class='fa fa-trash'></i> Delete Post</a></li>";
            //echo "<li><a href='#'><i class='fa fa-trash'></i> Delete Post</a></li>";
        }
        ?>
        <!-- <li><a href="#"><i class="fa fa-bell-o"></i> Notification On</a></li> -->

    </ul>

</div>
</div>

<div class="col-md-12 ">
<h2><?php echo $rows['spPostingNotes']; ?></h2>


<?php



$pic = new _postingpic;
$result = $pic->read($rows['idspPostings']);
// echo $pic->ta->sql;
// 
if ($result != false) {

    //die('mjh');
    while ($rp = mysqli_fetch_assoc($result)) {
        $pict = $rp['spPostingPic'];
    }
} else {
    $pict = NULL;
}
$media = new _postingalbum;
$result = $media->read($rows['idspPostings']);
if ($result != false) {
    $r = mysqli_fetch_assoc($result);
    // print_r($r);
    // die('========');
    $picture = $r['spPostingMedia'];
    $sppostingmediaTitle = $r['sppostingmediaTitle'];
    $sppostingmediaExt = $r['sppostingmediaExt'];
    if ($sppostingmediaExt == 'mp3') { ?>
        <div style='margin-left:15px;margin-right:15px;'>
            <audio controls>
                <source src="<?php echo $BaseUrl . '/upload/' . $sppostingmediaTitle; ?>" type="audio/<?php echo $sppostingmediaExt; ?>">
                Your browser does not support the audio element.
            </audio>
        </div>
    <?php
    } else if ($sppostingmediaExt == 'mp4') { ?>
        <div style='margin-left:15px;margin-right:15px;'>
            <video style='max-height:300px;width: 100%; border-radius: 17px;' controls>
                <source src='<?php echo $sppostingmediaTitle; ?>' type="video/<?php echo $sppostingmediaExt; ?>">
            </video>
        </div>
    <?php
    } else if ($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx') {
    ?>
        <div class="row timelinefile">
            <div class="col-md-offset-1 col-md-1 no-padding">
                <img src="<?php echo $BaseUrl . '/assets/images/pdf.png' ?>" alt="pdf" class="img-responsive" />
            </div>
            <div class="col-md-10">
                <h3><?php echo $sppostingmediaTitle; ?></h3>
                <small><?php echo $sppostingmediaExt; ?></small>
                <a href="<?php echo $sppostingmediaTitle; ?>">Download</a>
            </div>
        </div>
<?php
    }
} else {
    if (isset($pict)) {
        echo "<div class='timlinepicture text-center'>";
        echo "<a class='fav mag' data-effect='mfp-newspaper' href='" . ($pict) . "'><img alt='Posting Pic' src='" . ($pict) . "' class='postpic img-thumbnail img-responsive' style='width:50%;height:50%'></a>";
        include("postingpic.php");
        echo "</div>";
    }
    /* else
echo "<img alt='Posting Pic' src='../img/no.png' style='vertical-align:top; max-height: 300px; max-width: 800px;' class='postpic img-thumbnail' height='300' width='600' class='img-thumbnail'>" ; */
} ?>

</div>

<div class="col-md-12">
<div class="space"></div>
</div>


</div>
</div>
<?php
}
}
?>
</div>



<?php
}
}
?>


</div>
<!-- <div class="col-md-4  right_box_timeline right_sidebar pull-right" style="background-color: yellow22;">
khgjhbjk

</div> -->
</div>

<!-- image gallery end -->
</div>


<script type="text/javascript">
$('.fav').magnificPopup({
type: 'image'
// other options
});
</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
    <script>
        function Unsave_Post(userId) {
           // alert(userId);
        Swal.fire({
        title: 'Are You Sure You Want to Unsave Post ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Unsave!'
        }).then((result) => {
        if (result.isConfirmed) {
            swal("Unsave Successfully !", "", "success");
            window.location.href = userId;
        }
        });
        }
    </script>
 
    <?php   
    if(isset($_GET['save_Post'])){

    
    ?>
  
<?php
    }
?>