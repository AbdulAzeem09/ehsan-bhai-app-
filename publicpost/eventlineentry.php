<!--  <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">
 <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/font_animate.css"> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">
  <script src="../assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<div  class="post" style="font-weight:bold;" >
    <?php

    include('../univ/baseurl.php');
    include( "../univ/main.php");

   // ob_start();
 //   echo "here";
    //session_start();

    if (isset($_GET["js"])) {

        function sp_autoloader($class) {
            include '../mlayer/' . $class . '.class.php';
        }

        spl_autoload_register("sp_autoloader");
        $grouptimelines = $_GET["js"];
    }

 $conn = _data::getConnection();
    $p2 = new _postings;

/*    print_r($grouptimelines);*/
   /* print_r($_GET["timelineid"]);*/

    /*print_r($proid);
    print_r($sharedesc);*/
	?>

	<?php
    if (isset($grouptimelines) && $grouptimelines == 1) {

       // $res2 = $p2->allgrouptimelines($_GET["timelineid"]);
        $res2 = $p2->allgrouptimelinesPost($_GET["timelineid"]);
        /*echo $p2->ta->sql;*/
       /* $res2 = $p2->allgrouptimelinesPost($_GET["groupid"]);*/

        //echo "here1";

    } else {

        $res2 = $p2->singletimelinespost($_GET["timelineid"]);

       /*echo "here2";*/
    }
	//echo $p2->ta->sql;
    ?>

    <?php

    //echo $p2->ta->sql;
    if ($res2 != false)
        while ($rows = mysqli_fetch_assoc($res2)) {
/*print_r($rows);*/

            $sql35 = "SELECT * FROM share WHERE  timelineid = ".$rows['idspPostings'];
                        /*echo $sql3;*/
                        $res35 = mysqli_query($conn, $sql35);
if($res35 != false){
$row35  = mysqli_fetch_assoc($res35);

/*print_r($row35);*/

$sharedesc = $row35['spShareComment'];
$shareproid = $row35['spPostings_idspPostings'];
}

            /*$postingDate = $p2->spPostingDate($rows["spPostingDate"]); */
            /*print_r($rows["spPostingDate"]);*/
/*$time_ago = strtotime($rows["spPostingDate"]); */

/*$time_ago = strtotime($rows["spPostingDate"]);
$datetime1 = new DateTime();
$datetime2 = new DateTime($rows["spPostingDate"]);
$interval = $datetime1->diff($datetime2);
$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
echo $elapsed;*/
/*print_r($time_ago);*/
             $postingDate = $p2->to_time_ago($time_ago);


            ?>



            <div class="post_timeline post_timeline_all_post searchable deldiv_<?php echo $rows['idspPostings'];?>" >
                <div class="row ">
                                       <div class="col-md-8">

                                        <input type="hidden" id="postid" value="<?php echo $rows["idspPostings"]; ?>">
                                        <input type="hidden" id="postdate" value="<?php echo $rows["spPostingDate"]; ?>">
                        <?php
                        /*$picture = $rows["spProfilePic"];
                        $profilename = $rows["spProfileName"];*/
                        //this option is true when any person share any post
                        if(!empty($rows['sharetype'])){
                            /*echo $shareby;*/

                            $pro = new _spprofiles;
                            $result3 = $pro->readUserId($shareby);
                           /* print_r($result3);*/
                            if($result3 != false){
                                $row3 = mysqli_fetch_assoc($result3);
                                // this is new time
                                //$postingDate3 = $p2->get_timeago(strtotime($rows["spPostingDate"]));
                                /* print_r($row3);*/
                                // this is old time
                                $postingDate3 = $p2->spPostingDate($rows["spPostingDate"]); ?>
                                <div class="left_profile_timeline">
                                    <?php
                                    $picture3 = $row3["spProfilePic"];
                                    $profilename3 = $row3["spProfileName"];

                                    if (isset($picture3)) {
                                        echo "<img alt='profilepic'  class='img-circle' src='" . ($picture3) . "'>";
                                    }else{
                                        echo "<img alt='profilepic'  class='' src='".$BaseUrl."/assets/images/icon/blank-img.png' >";
                                    }
                                    $sharedProfile = $BaseUrl."/friends/?profileid=".$shareby;
                                    $PostProfile = $BaseUrl."/friends/?profileid=".$rows['spProfiles_idspProfiles'];
                                    ?>
                                </div>
                                <div class="title_profile">
                                   <!--  <h4><?php echo "<a href='".ucwords(strtolower($sharedProfile))."'>".ucwords(strtolower($profilename3))."</a> Shared <a href='".$PostProfile."'>".ucwords(strtolower($profilename))."</a> Post"; ?> </h4> -->
                                    <h4><?php echo "<a href='".ucwords(strtolower($sharedProfile))."'>".ucwords(strtolower($profilename3))."</a> Shared  Post"; ?> </h4>
                                    <h5 id="posttimeago<?php echo $rows["idspPostings"]; ?>"><?php echo $postingDate3; ?> <i class="fa fa-globe"></i></h5>
                                </div>
                                <?php
                            }
                        }else{

                        	/*print_r($rows);*/
                             $prof = new _spprofiles;
                            $result32 = $prof->readUserId($rows["spProfiles_idspProfiles"]);

                            //echo $prof->ta->sql;
                            /*print_r($result31);*/
                            if($result32 != false){
                        	/*echo "here";*/
                        	 $row32 = mysqli_fetch_assoc($result32);
                        	   $picture = $row32["spProfilePic"];
                                    $profilename = $row32["spProfileName"];
                                    /* $postingDate = $p2->get_timeago(strtotime($rows["spPostingDate"]));*/

                                     /*print_r($row3);*/
                            ?>
                            <div class="left_profile_timeline">
                                <?php


                                if (isset($picture)) {
                                    echo "<img alt='profilepic'  class='img-circle' src='" . ($picture) . "'>";
                                }else{
                                    echo "<img alt='profilepic'  class='' src='".$BaseUrl."/assets/images/icon/blank-img.png' >";
                                }
                                ?>
                            </div>
                            <div class="title_profile">
                                <h4><a href="<?php echo $BaseUrl.'/friends/?profileid='.$rows['spProfiles_idspProfiles'];?>">
                                        <?php echo ucwords(strtolower($profilename)); ?>
                                        <?php
                                        if(isset($rows['spGroupName']) &&  !empty($rows['spGroupName'])) {

                                            ?>
                                            <span style="font-size: 14px;">(<?php echo $rows['spGroupName']; ?>)</span>
                                            <?php
                                        }
                                        ?>

                                    </a></h4>
                                <h5 id="posttimeago<?php echo $rows["idspPostings"]; ?>"><?php echo $postingDate; ?> <i class="fa fa-globe"></i></h5>
                            </div> <?php
                        }

                    }  ?>

                    </div>

<?php if(isset($rows["idspPostings"]) && !empty($rows["idspPostings"])){   ?>
                    <script type="text/javascript">


document.getElementById("posttimeago"+<?php echo $rows["idspPostings"]; ?>).innerHTML = get_post_time(<?php echo $rows["idspPostings"]; ?>,<?php echo "'". $rows["spPostingDate"] ."'";?>);
 function get_post_time(postid,postdate){


              /*  var postid = $("#postid").val();
        var postdate = $("#postdate"+postid).val();*/



       /* alert(postdate);*/
       /* alert(postid);*/


  var countDownDate = new Date(postdate)

// Update the count down every 1 second
/*  var x = setInterval(function() {*/

  // Get today's date and time

    var today = new Date();

/*var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

var dateTime = date+' '+time;*/
        /*document.getElementById("spPostingDate").value = dateTime; */
  var now = new Date();

/*    alert(countDownDate);
    alert(now);*/

   /* var isLarger = new Date("2-11-2012 13:40:00") > new Date("01-11-2012 10:40:00");*/
  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
/*  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);*/


      var seconds = Math.floor((now - (countDownDate))/1000);
      var  minutes = Math.floor(seconds/60);
       var hours = Math.floor(minutes/60);
       var days = Math.floor(hours/24);

      var  hours = hours-(days*24);
      var  minutes = minutes-(days*24*60)-(hours*60);
      var  seconds = seconds-(days*24*60*60)-(hours*60*60)-(minutes*60);


if(days > 0){

var ago = days+ " days ago";

}else if(days <= 0 &&  hours >0 ){

       var ago = hours+ " hours ago";
}else if(days <= 0 &&  hours <=0 && minutes > 0){

       var ago = minutes + " minutes ago";
}else if(days <= 0 &&  hours <=0 && minutes <= 0 && seconds > 0){

       var ago = seconds + " seconds ago";
}

/*console.log(ago);*/


/*}, 10000);*/

return ago;

 }

                    </script>


                  <?php } ?>


                    <div class="col-md-12 ">
                        <h2 style="word-wrap: break-word;">
                            <?php // echo $rows['spPostingNotes'];?>
                            <!-- MAKE A LINK -->

                            <?php
                                   if(!empty($rows['sharetype'])){


                             echo "<p>".$sharedesc."</p>";

                             }else{
                                  echo $text = $p2->turnUrlIntoHyperlink($rows['spPostingNotes']);


                                }

                             ?>
                            <!-- END -->
                        </h2>
                        <?php


/*print_r($proid);
print_r($shareby);*/


                         if( !empty($rows['sharetype'])){  ?>
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$shareproid;?>"  target="_blank">View Product</a>
<br>
<br>
<?php } ?>
                        <?php
                        $pic = new _postingpic;
                        $result = $pic->read($rows['idspPostings']);
                        /*echo $pic->ta->sql;*/
                        if ($result != false) {
                            while ($rp = mysqli_fetch_assoc($result)) {
                                $pict = $rp['spPostingPic'];
                            }
                        } else{
                            $pict = NULL;
                        }
                        $media = new _postingalbum;
                        $result = $media->read($rows['idspPostings']);

                        //echo $media->ta->sql;
                        if ($result != false) {
                            $r = mysqli_fetch_assoc($result);
                            $picture = $r['spPostingMedia'];
							$sppostingmediaTitle = $r['sppostingmediaTitle'];
							$sppostingmediaExt = $r['sppostingmediaExt'];
							if($sppostingmediaExt == 'mp3'){ ?>
								<div style='margin-left:15px;margin-right:15px;'>
									<audio controls>
										<source src="<?php echo $sppostingmediaTitle;?>" type="audio/<?php echo $sppostingmediaExt;?>">
										Your browser does not support the audio element.
									</audio>
								</div>
								<?php
							}else if($sppostingmediaExt == 'mp4'){ ?>
								<div style='margin-left:15px;margin-right:15px;'>
									<video  style='max-height:300px;width: 100%;border-radius: 17px;' controls>
										<source src='<?php echo $sppostingmediaTitle;?>' type="video/<?php echo $sppostingmediaExt;?>">
									</video>
								</div>
								<?php
							}else if($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx'){
								?>
								<div class="row timelinefile">
									<div class="col-md-offset-1 col-md-1 no-padding">
										<img src="<?php echo $BaseUrl.'/assets/images/pdf.png'?>" alt="pdf" class="img-responsive" />
									</div>
									<div class="col-md-10">
										<h3><?php echo $sppostingmediaTitle;?></h3>
										<small><?php echo $sppostingmediaExt;?></small>
										<a href="<?php echo $sppostingmediaTitle;?>" target="_blank">Download</a>
									</div>
								</div>
								<?php
							}
                        } else {
                            if (isset($pict)) {
                                echo "<div class='timlinepicture text-center'>";
                                echo "<a class='thumbnail mag' data-effect='mfp-newspaper' style='border: 0px solid #ddd;' href='" . ($pict) . "'><img alt='Posting Pic' src='" . ($pict) . "' style='height: 50%;    width: 50%;' class='postpic img-thumbnail img-responsive bradius-15'></a>";
                                include("postingpic.php");
                                echo "</div>";
                            }
                            /* else
                              echo "<img alt='Posting Pic' src='../img/no.png' style='vertical-align:top; max-height: 300px; max-width: 800px;' class='postpic img-thumbnail' height='300' width='600' class='img-thumbnail'>" ; */
                        } ?>

                    </div>


                </div>
            </div>
            <?php
        } ?>
</div>

<script type="text/javascript">

function flagpost(postid){

/*$("#radReport").();

alert($("#radReport").val());*/
if ($('input[name="radReport"]:checked').length == 0) {
         var logo = "../assets/images/logo/tsplogo.PNG";

                     swal({
                              title: "Please Select a Reason to Flag.",
                              imageUrl: logo
                          });
         return false;
        }else {
            ///alert("checked");





          swal({
            title: "Are you sure?",
            type: "warning",
            confirmButtonClass: "sweet_ok",
            confirmButtonText: "Yes",
            cancelButtonClass: "sweet_cancel",
            cancelButtonText: "No",
            showCancelButton: true,
        },
        function(isConfirm) {
            if (isConfirm) {


                    $.ajax({
                        url: "../publicpost/flagpost.php",
                        type: "POST",
                        data:  $("#flagpostfrm"+postid).serialize(),
                        dataType: "text",
                        success: function(vi){

                           $("#flag"+postid).hide();
                           $("#unflag"+postid).show();

                           $("#myModal"+postid).hide();
                           $(".modal-backdrop").remove();
                          $("body").removeClass("modal-open");

                    var logo = "../assets/images/logo/tsplogo.PNG";


                     swal({
                              title: "Flagged successfully.",
                              imageUrl: logo
                          });

                        },
                        error: function(error){

                        }
                    });

            }
        });

  }
}



/*    $('#timeline-container').on('click', ".sendPostidEdit", function (e) {
var MAINURL = "https://thesharepage.dbvertex.com/";

        $(".posteditloader").css({ display: "block" });
        var postid = $(this).attr("data-postid");

         //alert(postid);
        $(".sp-post-edit").load(MAINURL+"/profile/postField.php", {postid: postid}, function (response) {
            //alert(response);
            $(".posteditloader").css({ display: "none" });
        });
    });
*/


</script>
<script type="text/javascript">

$('.thumbnail').magnificPopup({
  type: 'image'
  // other options
});




</script>
