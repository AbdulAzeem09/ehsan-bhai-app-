<?php
$p2 = new _postingview;
$res2 = $p2->grouptimelines($_GET["groupid"]);
if ($res2 != false)
    while ($rows = mysqli_fetch_assoc($res2)) {
        echo "<div class='timelines'>";
        //Profile pic
        $picture = $rows["spProfilePic"];
        $profilename = $rows["spProfileName"];
        echo "<div class='row'>";
        echo "<div class='col-md-3' style='padding-top:10px;'>";
        if (isset($picture))
            echo "<div class='commentoverflow' style='margin-left:10px;'><span style='cursor:pointer' data-profilename='" . $profilename . "' data-profileid='" . $rows["idspProfiles"] . "' class='searchtimelines'><img alt='profilepic'  class='img-circle' src=' " . ($picture) . "' style='width: 40px; height: 40px;'><span style='color:#1a936f;'>&nbsp;&nbsp;" . $profilename . "</span></span></div>";
        else
            echo "<div class='commentoverflow'><img alt='profilepic'  class='img-circle' src='../img/default-profile.png' style='width: 40px; height: 40px;'><span style='color:#1a936f;'>" . $profilename . "</span></div>";
        echo "</div><div class='col-md-7'></div>";
        //View Store code
        if (isset($rows["spDynamicWholesell"])) {
            echo "<div class='col-md-2' style='padding-top:20px;'><a href='../" . $rows["spDynamicWholesell"] . "/'>View Store</a></div>";
        }
        echo "</div><br>";
        //Profile pic Completed
        echo "<div class='thumbnail'>";
        $pic = new _postingpic;
        $result = $pic->read($rows['idspPostings']);
        if ($result != false) {
            echo "<div style='padding:10px;'>";
            while ($rp = mysqli_fetch_assoc($result)) {
                $pict = $rp['spPostingPic'];
                echo "<img  alt='Posting Pic' class='img-thumbnail imagehover sppointer post-highlight' style='width:72px; height: 72px;' src=' " . ($pict) . "' >";
                echo "\x20\x20\x20";
            }
            echo "</div>";

            //echo "<img alt='Posting Pic' src=' ".($pic)."' style='vertical-align:top; max-height: 300px; max-width: 800px;' class='postpic img-thumbnail' height='300' width='600' class='img-thumbnail'>" ;
        } else
            $pict = NULL;

        $media = new _postingalbum;
        $result = $media->read($rows['idspPostings']);
        if ($result != false) {
            $r = mysqli_fetch_assoc($result);
            $picture = $r['spPostingMedia'];
            echo "<div style='margin-left:50px;'><video height='300' width='600' style='max-height: 300px; max-width: 800px;' controls  class='img-thumbnail'><source class='imagehover sppointer postpic ' src='data:video/mp4;base64, " . ($picture) . "'></video></div>";
        } else {
            if (isset($pict))
                echo "<img alt='Posting Pic' src=' " . ($pict) . "' style='vertical-align:top; max-height: 300px; max-width: 800px;' class='postpic img-thumbnail' height='300' width='600' class='img-thumbnail'>";
            else
                echo "<img alt='Posting Pic' src='../img/no.png' style='vertical-align:top; max-height: 300px; max-width: 800px;' class='postpic img-thumbnail' height='300' width='600' class='img-thumbnail'>";
        }
        echo "<br><div style='margin-left:10px;'>" . $rows['spPostingNotes'] . "</div>";
        echo "</div>";
        //Socializing Code//////////////

        echo "<div class='row' style='margin-left:10px;'>";
        echo "<div class='col-md-12' style='margin-top:6px;'>";
        $pl = new _postlike;
        $r = $pl->read($rows['idspPostings']);
        if ($r != false) {
            $i = 0;
            $liked = $r->num_rows;
            while ($row = mysqli_fetch_assoc($r)) {
                if ($row['spProfiles_idspProfiles'] == $_SESSION['pid']) {
                    echo "<span data-toggle='tooltip' data-placement='bottom' title='Unlike' class='icon-socialise fa fa-thumbs-up spunlike' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $r->num_rows . "'> (" . $r->num_rows . ")</span>";
                    $i++;
                }
            }
            if ($i == 0) {
                echo "<span data-likeid='postid" . $rows['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $r->num_rows . "'> (" . $r->num_rows . ")</span>";
            }
        } else {
            $liked = 0;
            echo "<span data-likeid='postid" . $rows['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $liked . "'></span>";
        }

        $pl = new _favorites;
        $re = $pl->read($rows['idspPostings']);
        if ($re != false) {
            $i = 0;
            while ($rw = mysqli_fetch_assoc($re)) {
                if ($rw['spUserid'] == $_SESSION['uid']) {
                    echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart removefavorites' style='margin-left:10px;' data-postid='" . $rows['idspPostings'] . "'></span>";
                    $i++;
                }
            }
            if ($i == 0) {
                echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $rows['idspPostings'] . "'></span>";
            }
        } else {

            echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $rows['idspPostings'] . "'></span>";
        }

        echo "</div></div>";
        //Socializing Code Complete
        //Comment Code
        $c = new _comment;
        $result = $c->read($rows['idspPostings']);
        if ($result != false) {
            while ($row = mysqli_fetch_assoc($result)) {
                $profilename = $row["spProfileName"];
                $comment = $row["comment"];
                $picture = $row["spProfilePic"];
            }
            echo "<a href='#' data-toggle='modal' data-target='#mycomment'><span  style='margin-left:10px;' class='morecomment' data-postid='" . $rows['idspPostings'] . "' >View previous comments</span></a>";
            echo "<div class='row' style='margin-left:10px;'>";
            if (isset($picture))
                echo "<div class='col-md-3 commentoverflow'><img alt='profilepic'  class='img-circle' src=' " . ($picture) . "' style='width: 40px; height: 40px;'><span style='color:#1a936f;'>" . $profilename . "</span></div>";
            else
                echo "<div class='col-md-3 commentoverflow'><img alt='profilepic'  class='img-circle' src='../img/default-profile.png' style='width: 40px; height: 40px;'><span style='color:#1a936f;'>" . $profilename . "</span></div>";


            echo "<div class='col-md-8 commentoverflow' style='margin-top:8px;'><span style='color:gray;' >" . $comment . "</span></div>";
            echo "</div>";
        }
        echo "<div style='margin-left:10px;margin-right:10px;'>";
        include("../social/commentform.php");
        echo "<br></div>";
        //Comment Code Complete
        echo "</div><br>";
    }
?>
