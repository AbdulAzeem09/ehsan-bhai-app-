        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">


<div id="posts">
    <?php
    $groupshares = false;
    $p = new _postingview;
    //echo $_GET["publictimeline"];
    //echo $_GET["categoryID"];
    switch ($_GET["publictimeline"]) {  
        case 1:
            if (isset($_GET["categoryID"])) {
                //if($_GET["categoryID"] ==1 && $_GET["spPostingsFlag"]==1)//Rfq-buy
                //$res = $p-> buypost($_GET["categoryID"]);

                if ($_GET["categoryID"] == 1 && $_GET["spPostingsFlag"] == 0) {//Wholesell post
                    if (isset($_GET["profileid"])) {
                        $res = $p->mywholesellpost($_GET["profileid"], $_GET["categoryID"]);
                        //echo $p->ta->sql;
                    } else
                        $res = $p->sellpost($_GET["categoryID"]);
                }
                elseif ($_GET["categoryID"] == 1 && $_GET["spPostingsFlag"] == 2)//retail
                    $res = $p->retailpost($_GET["categoryID"]);
                else{
                    $res = $p->publicpost($start, $_GET["categoryID"]);
				}
            }
            else {
                $res = $p->publicpost(isset($start));
            }
            break;
        case 2:
            $res = $p->timelines($_SESSION['uid']);
            break;
        case 3:
            $res = $p->myfavorite($_SESSION['uid']);
            break;
        case 4:
            $res = $p->friendsPublicPosting($_SESSION['uid']);
            break;
        case 5:
            $res = $p->readPrivateStore($_GET['gid']);
            $groupshares = $p->readgroupshare($_SESSION['pid']);
            break;
        case 6:
            $res = $p->myallpost($_SESSION['uid']); //My Store
            break;
        case 8:
            $res = $p->singlefriendstore($_GET["friendid"]);
            break;
    }
    //echo $p->ta->sql;
    if ($res != false) {
        printPosts($res);
    }
    if ($groupshares != false) {
        echo printPosts($groupshares);
    }

    // post-grid-item
    function printPosts($res) {
        include('../univ/baseurl.php');
        

        while ($rows = mysqli_fetch_assoc($res)) {
            ?>
            <div class="col-md-3">
                <div class="store_box" id="ip7">
                    <?php
                    $dt = new DateTime($rows['spPostingExpDt']);

                    $pic = new _postingpic;
                    $result = $pic->read($rows['idspPostings']);
                    //echo $pic->ta->sql;
                    ?>
                    <a href="<?php echo $BaseUrl.'/post-details/?postid='. $rows['idspPostings'].'&groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&store'; ?>" style="margin: 0px;">
                    <?php
                    if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                        if ($result != false) {
                            $rp = mysqli_fetch_assoc($result);
                            $picture = $rp['spPostingPic'];
                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                        } else{
                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                        }
                    }else{
                        if ($result != false) {
                            $rp = mysqli_fetch_assoc($result);
                            $picture = $rp['spPostingPic'];
                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                        } else
                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                    }
                    ?>
                    </a>
                    <?php 
                    if(!empty($rows['spPostingtitle'])){
                        if(strlen($rows['spPostingtitle']) < 15){
                            ?><h3 class="hv"><a href="<?php echo $BaseUrl.'/post-details/?postid='. $rows['idspPostings'].'&groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&store'; ?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo $rows['spPostingtitle']; ?></a></h3><?php
                            
                        }else{
                            ?><h3 class="hv"><a href="<?php echo $BaseUrl.'/post-details/?postid='. $rows['idspPostings'].'&groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&store'; ?>"><?php echo substr($rows['spPostingtitle'], 0,15).'...'; ?></a><h3><?php
                        }
                    }else{
                        echo "<h3>&nbsp;</h3>";
                    }
                    ?>                    
                    <h4>
                        <?php
                        if ($rows['spPostingPrice'] != false) {
                            echo "<div class='postprice' style='display: inline-block;' data-price='" . $rows['spPostingPrice'] . "'>" . $rows['spPostingPrice'] . " Dollar</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                        }else{
                            echo "Expires on ".$rows['spPostingExpDt'];
                        }
                        ?>
                        
                    </h4>
                    <h5><?php echo $dt->format('d M'); ?> @ <?php echo $rows['spPostingsCity']; ?></h5>
                    <a href="#">By <?php echo $rows['spProfileName'];?></a>
                </div>
                <div class="store_box_footer " >
                    <ul>
                        <li>
                            <?php
                            //post share start
                            if(isset($picture)){
                                echo "<a href='#' data-toggle='modal' data-target='#myshare'><span data-toggle='tooltip' data-placement='bottom' title='Share' class='icon-share fa fa-share-alt sp-share' style='margin-left:10px;' data-postid='" . $rows['idspPostings'] . "' src=' " . ($picture) . "'></span></a>";
                            }else{
                                echo "<a href='#' data-toggle='modal' data-target='#myshare'><span data-toggle='tooltip' data-placement='bottom' title='Share' class='icon-share fa fa-share-alt sp-share' style='margin-left:10px;' data-postid='" . $rows['idspPostings'] . "' src='../img/no.png'></span></a>";
                            } 
                            //post share end?>
                        </li>
                        <li> <?php
                            //POST LIKE START
                            $pl = new _postlike;
                            $r = $pl->readnojoin($rows['idspPostings']);
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
                            }//POST like END
                            ?>
                        </li>
                        <li>
                            <?php
                            echo "<span data-toggle='modal' data-placement='bottom' class='icon-email emailto' data-target='#mailto'  data-postid='" . $rows['idspPostings'] . "'><i class='fa fa-envelope'  data-toggle='tooltip' data-placement='bottom' title='Email' ></i></span>";
                            ?>
                        </li>
                        <li>
                            <?php
                            //FAVORITES START
                            $pl = new _favorites;
                            $re = $pl->read($rows['idspPostings']);
                            if ($re != false) {
                                $i = 0;
                                while ($rw = mysqli_fetch_assoc($re)) {
                                    if ($rw['spUserid'] == $_SESSION['uid']) {
                                        echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-star removefavorites' data-postid='" . $rows['idspPostings'] . "'></span>";
                                        $i++;
                                    }
                                }
                                if ($i == 0) {
                                    echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-star-o sp-favorites' data-postid='" . $rows['idspPostings'] . "'></span>";
                                }
                            } else {
                                echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-star-o sp-favorites'  data-postid='" . $rows['idspPostings'] . "'></span>";
                            }
                            //FAVORITES END
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="store_box_btn" id="ip8">

                    <?php
                    $m = new _postfield;
                    $rm = $m->read($rows['idspPostings']);
                    //echo $m->ta->sql;
                    if ($rm != false) {
                        $str = "";
                        while ($rs = mysqli_fetch_assoc($rm)) {
                            if ($rs["spPostFieldLabel"] == "Closing Date") {
                                $closingdate = $rs["spPostFieldValue"];
                            }
                            $str .= $rs['spPostFieldValue'] . ",";
                        }
                    }
                    //Buy-Bid Start
                    if ($_GET["publictimeline"] != 6) {
                        if (isset($_GET["categoryName"]) == "Freelancers") {
                            $m = new _postfield;
                            $rm = $m->totalbids($rows['idspPostings']);
                            if ($rm != false) {
                                $total = $rm->num_rows;
                            }
                            
                            if ($rm->num_rows > 0){
                                echo "<a ><b>Bids </b><b class='bidcount'>" . $rm->num_rows . "</b></a>";
                            }else{
                                echo "<a ><b>Bids </b><b class='bidcount'>0</b></a>";
                            }
                            echo "<a role='button' class='btn bidbutton' data-toggle='modal' data-target='#bid-system' data-catname='" . $rows['spPostingtitle'] . "' data-postid='" . $rows['idspPostings'] . "' data-catid='" . $rows['idspCategory'] . "' data-closingdate='" . $closingdate . "' ><span class='fa fa-hand-paper-o'> </span>" . $rows['spCategoriesButton'] . "</a>";
                        }else {
                            if (isset($_GET["spPostingsFlag"]) == 1){
                                echo "<a href='../post-details/?postid=" . $rows['idspPostings'] . "&buypostid=" . $_GET["spPostingsFlag"] . "&groupid=".$_GET['groupid']."&groupname=".$_GET['groupname']."&store' role='button' class='btn'><span class='fa fa-quote-right'></span> Quote Now</a>";
                            }else {
                                if ($rows['idspCategory'] != 5) {
                                    echo "<a href='../post-details/?postid=" . $rows['idspPostings'] . "&groupid=".$_GET['groupid']."&groupname=".$_GET['groupname']."&store' role='button'  class='btn add_member_btn'>" . $rows['spCategoriesButton'] . "</a>";
                                } else{
                                   echo "<a role='button' class='btn bidbutton' data-closingdate='" . $closingdate . "' data-toggle='modal' data-target='#bid-system' data-catname='" . $rows['spPostingtitle'] . "' data-postid='" . $rows['idspPostings'] . "' data-catid='" . $rows['idspCategory'] . "'><span class='fa fa-hand-paper-o'> </span>" . $rows['spCategoriesButton'] . "</a>";
                                }
                            }
                        }
                    }else {
                        //Buy-BidComplete
                        //Testing--------
                        echo "<div class=' " . ($_GET["publictimeline"] == "6" ? "" : "hidden") . "'>";
                        //Edit My Poste from my-post
                        echo "<a href='../post-ad/?postid=" . $rows['idspPostings'] . "&categoryid=" . $rows['idspCategory'] . "&categoryname=" . $rows['spCategoryname'] . "' class='edit' > <span class='fa fa-pencil' aria-hidden='true'></span> Edit</a>";
                        //Complete

                        if ($rows["spPostingVisibility"] != 0) {
                            if ($rows["spPostingsBought"] == 1 || $rows["spPostingsBought"] == 3)
                                echo "<div class='searchtimelines' data-profileid='" . $rows["spPostingsBuyerid"] . "' ><span class='fa fa-credit-card'></span> Bought&nbsp;</div>";

                            elseif ($rows["spPostingExpDt"] >= date("Y-m-d"))
                                echo "<div style='color:gray;'><span class='fa fa-ok'></span> Active&nbsp;</div>";

                            elseif ($rows["spPostingExpDt"] < date("Y-m-d"))
                                echo "<div style='color:gray;' ><span class='fa fa-remove'></span> Expired &nbsp;</div>";
                        }
                        elseif ($rows["spPostingVisibility"] == 0) {
                            echo "<div style='color:gray;' ><span class='fa fa-save-file'></span> Draft</div>";
                        }

                        echo "</div>"; //row message
                    } ?>

                </div>
            </div>
            <?php
            //"&buypostid=".$_GET["spPostingsFlag"]."
            //echo "<div class='searchable addclass post-list-item post ".($rows['spPostingPrice'] != false ? "priced" : "free")." ".($rows['sppostingShippingCharge'] != false ?"delcharge":"freedel")."'>";
            /*
            THIS IS HIDE FOR SOME NON REASON
            echo "<div class='searchable addclass post-list-item post " . ($rows['idspCategory'] == 8 ? ($rows['spPostingPrice'] != false ? "priced hidden" : "free") : "") . " " . ($rows['sppostingShippingCharge'] != false ? "delcharge" : "freedel") . "'>";

            echo "<a href='../post-details/?postid=" . $rows['idspPostings'] . "&back=back' style='text-decoration:none;'><div class='thumbnail imagehover post-highlight' style='margin-bottom:10px;'>"; //post-highlight'page-header'
            echo "<div style='margin-bottom:5px;'>";
            $pic = new _postingpic;
            $result = $pic->read($rows['idspPostings']);
            THIS IS HIDE FOR SOME NON REASON
            */
            /*
            THIS IS IMAGE OF STORE
            if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                if ($result != false) {
                    $rp = mysqli_fetch_assoc($result);
                    $picture = $rp['spPostingPic'];
                    echo "<img alt='Posting Pic' class='img-thumbnail originalimg post-img' src=' " . ($picture) . "' >";
                } else
                    echo "<img alt='Posting Pic' src='../img/no.png' class='post-img img-thumbnail originalimg'>";
            }
            */
            /*
            THIS IS CATEGORY OF STORE
            if (isset($_GET["categoryID"]) == 1 && isset($_GET["spPostingsFlag"]) == 0)
                echo "<span style='font-size:125%;' class='categoryname pull-right'> Wholesale </span>";

            elseif (isset($_GET["categoryID"]) == 1 && isset($_GET["spPostingsFlag"]) == 2)
                echo "<span style='font-size:125%;' class='categoryname pull-right'> Retail </span>";

            else {
                echo "<span style='font-size:125%;' class='categoryname pull-right'>" . $rows['spCategoryname'] . " </span>";
            }*/

            //echo "<div class='shiftlist caption'>";
            //THIS IS TITLE AND SHOW DESCRIPTION
            //echo "<div class='commentoverflow title' style='font-size:18px;color:#1a936f;'> " . isset($rows['spPostingtitle']) . "</div>";
            //echo "<p class='line-clamp'>" . $rows['spPostingNotes'] . "</p>";
            /*
            THIS IS SHOW PRICE AND SHIPING METHOD
            if ($rows['spPostingPrice'] != false) {
                echo "<div class='postprice' style='display: inline-block;' data-price='" . $rows['spPostingPrice'] . "'>Price $ " . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'><div class='shippingstatus'></div><span style='font-weight:bold;' class='shipping'>" . ($rows['sppostingShippingCharge'] != 0 ? "Delivery Charge" : "FREE Delivery") . "</span></span>";
            }
            */
            //echo "<div>Expires on <time>" . $rows['spPostingExpDt'] . "</time></div>";
            /*
            SHOW CITY AND COUNTRY
            if ($rows['spPostingsCity'])
                echo "<div class='city' data-cityevents='" . $rows['spPostingsCity'] . "'>City " . $rows['spPostingsCity'] . "</div>";
            if ($rows['spPostingsCountry'])
                echo "<div class='country'>Country " . $rows['spPostingsCountry'] . "</div>";
            */
            /*
            //Reviews of post//
            if ($rows['idspCategory'] != 2 && $rows['idspCategory'] != 5 && $rows['idspCategory'] != 12) {
                $rvw = new _sppostreview;
                $rw = $rvw->review($rows['idspPostings']);
                if ($rw != false) {

                    $rws = mysqli_fetch_assoc($rw);
                    $review = $rw->num_rows;
                    echo "<div class='postreviews' data-postreviews='" . $review . "'>Total Reviews :" . $review . "</div>";
                } else
                    echo "<div class='postreviews' data-postreviews='0'>Total Reviews : 0</div>";

                //Complete
                $r = new _sppostrating;
                $rating = $r->review($rows['idspPostings']);
                if ($rating != false) {
                    $counter = 0;
                    $count = $rating->num_rows;
                    while ($rwrating = mysqli_fetch_assoc($rating)) {
                        $counter += $rwrating["spPostRating"];
                    }
                    $ratings = $counter / $count;
                    echo "<div class='postrating' data-postrating='" . $ratings . "'>Total Rating :" . $ratings . "</div>";
                } else
                    echo "<div class='postrating' data-postrating='0'>Total Rating : 0</div>";
            }
            */
            //Rating of post
            //Complete
            //echo "<div >Poster <span class='glyphicon glyphicon-user'></span>&nbsp; &nbsp;<span class='searchtimelines' data-profileid='".$rows["idspProfiles"]."'>" .$rows['spProfileName']."</span></div>";

            /*
            THIS IS HIDE FOR SOME NON REASON
            if ($_GET["publictimeline"] == 5) {//Group Name on Group Store
                $g = new _spgroup;
                $result = $g->readGroupName($rows["spPostingVisibility"]);
                if ($result != false) {
                    while ($ro = mysqli_fetch_assoc($result)) {
                        echo "<div  class='groupname' data-groupname='" . $ro["spGroupName"] . "'>Group " . $ro["spGroupName"] . "</div>";
                    }
                } else {
                    $s = new _postshare;
                    $result = $s->readgroupshare($rows['idspPostings']);
                    if ($result != false) {
                        while ($ro = mysqli_fetch_assoc($result)) {
                            $g = new _spgroup;
                            $result = $g->readGroupName($ro["spShareToGroup"]);
                            if ($result != false) {
                                while ($ro = mysqli_fetch_assoc($result)) {
                                    echo "<div  class='groupname' data-groupname='" . $ro["spGroupName"] . "'>Group " . $ro["spGroupName"] . "</div>";
                                }
                            }
                        }
                    }
                }
            } 
            THIS IS HIDE FOR SOME NON REASON
            */
            //Group Name on Group Store Complete
            /*
            THIS IS HIDE FOR SOME NON REASON
            //echo "</div></div></a>"; //page header and shiftlist
            echo "<div class='row'>";
            $m = new _postfield;
            $rm = $m->read($rows['idspPostings']);
            //echo $m->ta->sql;
            if ($rm != false) {
                $str = "";
                echo "<div class='searchingval commentoverflow' style='display:none;'>";
                while ($rs = mysqli_fetch_assoc($rm)) {
                    if ($rs["spPostFieldLabel"] == "Closing Date") {
                        $closingdate = $rs["spPostFieldValue"];
                    }
                    $str .= $rs['spPostFieldValue'] . ",";
                }
                echo $str . "</div>";
            }

            //echo "<div class='col-md-8'></div>";
            echo "<div class='col-md-4' style='padding-bottom:5px;'>"; //col-md-4

            if ($_GET["publictimeline"] == 6) {
                $e = new _postenquiry;
                $re = $e->read($rows["idspPostings"]);
                if ($re != false) {
                    echo "<div dropdown'><button class='btn btn-default btn-sm dropdown-toggle pull-right' type='button' id='dropdownenquiry' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>" . ($rows["idspCategory"] == 12 ? "Poke" : "Enquiries") . " <span class='badge'>" . $re->num_rows . "</span><span class='caret'></span></button>";

                    echo "<ul class='dropdown-menu' aria-labelledby='dropdownenquiry' style='margin-top:10px;margin-left:40px;'>";
                    while ($rw = mysqli_fetch_assoc($re)) {

                        echo "<li><a href='#' data-toggle='modal' data-target='#conversatation' data-messageid='" . $rw['idspMessage'] . "' class='conv-enquire commentoverflow'><span class='icon-enquery fa fa-phone-alt'></span> " . $rw['message'] . "</a></li>";
                    }
                    echo "</ul></div>";
                }
            } 
            THIS IS HIDE FOR SOME NON REASON
            */
            //echo "</div>"; //col-md-4
            //echo "</div>"; //row closed before col-md-8
            //echo "</div></div></a>";//page header and shiftlist

            //echo "<hr class='hrline'>"; //line code

            //socializing code
           // echo "<div class='row'>";
           //echo "<div class='col-md-6' style='margin-top:6px;'>"; //SharePage Liked post
            /*
            //POST LIKE START
            $pl = new _postlike;
            $r = $pl->readnojoin($rows['idspPostings']);
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
            }//SharePage like complete
            //POST LIKE END
            */
            /*
            POST SHARE START
            if(isset($picture)){
                echo "<a href='#' data-toggle='modal' data-target='#myshare'><span data-toggle='tooltip' data-placement='bottom' title='Share' class='icon-share fa fa-share sp-share' style='margin-left:10px;' data-postid='" . $rows['idspPostings'] . "' src=' " . ($picture) . "'></span></a>";
            }else{
                echo "<a href='#' data-toggle='modal' data-target='#myshare'><span data-toggle='tooltip' data-placement='bottom' title='Share' class='icon-share fa fa-share sp-share' style='margin-left:10px;' data-postid='" . $rows['idspPostings'] . "' src='../img/no.png'></span></a>";
            }
            POST SHARE END
            */
            
            //mail model strt
            //Testing
            //echo "<span data-toggle='modal' data-placement='bottom' title='Email' class='icon-email glyphicon glyphicon-envelope emailto' style='margin-left:10px;' data-target='#mailto'  data-postid='" . $rows['idspPostings'] . "'></span>";
            //Testing Complete
            //mail model end
            /*
            FAVORITES START
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
            FAVORITES END
            */
            //echo "</div>";

            //Buy-Bid Start
            /*
            THIS CODE FOR BUTTON IS BUY OR BID OR QUOTE START
            echo "<div class='col-md-6' style='margin-top:6px;'>";
            if ($_GET["publictimeline"] != 6) {
                if (isset($_GET["categoryName"]) == "Freelancers") {
                    $m = new _postfield;
                    $rm = $m->totalbids($rows['idspPostings']);
                    if ($rm != false) {
                        $total = $rm->num_rows;
                    }
                    echo "<div class='row bidsys'>";
                    echo "<div class='col-md-4'></div>";
                    if ($rm->num_rows > 0)
                        echo "<div class='col-md-4'><span class='pull-right' style='color:#000066;'><b>Bids </b><b class='bidcount'>" . $rm->num_rows . "</b></span></div>";
                    else
                        echo "<div class='col-md-4'><span class='pull-right' style='color:#000066;'><b>Bids </b><b class='bidcount'>0</b></span></div>";

                    echo "<div class='col-md-4'><span role='button' class='btn btn-success btn-sm bidbutton pull-right' data-toggle='modal' data-target='#bid-system' data-catname='" . $rows['spPostingtitle'] . "' data-postid='" . $rows['idspPostings'] . "' data-catid='" . $rows['idspCategory'] . "' data-closingdate='" . $closingdate . "' ><span class='fa fa-hand-paper-o'> </span>" . $rows['spCategoriesButton'] . "</span></div>";
                    echo "</div>";
                }
                else {
                    if (isset($_GET["spPostingsFlag"]) == 1)
                        echo "<a href='../post-details/?postid=" . $rows['idspPostings'] . "&buypostid=" . $_GET["spPostingsFlag"] . "' role='button' style='margin-left:10px;' class='btn btn-success  btn-sm pull-right'><span class='fa fa-quote-right'></span> Quote Now</a>";

                    else {
                        if ($rows['idspCategory'] != 5) {
                            echo "<a href='../post-details/?postid=" . $rows['idspPostings'] . "' role='button' style='margin-left:10px;' class='btn btn-success  btn-sm buybutton pull-right'>" . $rows['spCategoriesButton'] . "</a>";
                        } else
                            echo "<span role='button' class='btn btn-success btn-sm bidbutton pull-right' data-closingdate='" . $closingdate . "' data-toggle='modal' data-target='#bid-system' data-catname='" . $rows['spPostingtitle'] . "' data-postid='" . $rows['idspPostings'] . "' data-catid='" . $rows['idspCategory'] . "'><span class='fa fa-hand-paper-o'> </span>" . $rows['spCategoriesButton'] . "</span>";
                    }
                }
            }
            //Buy-BidComplete
            //Testing--------
            else {
                echo "<div class='row" . ($_GET["publictimeline"] == "6" ? "" : "hidden") . "'>";
                //Edit My Poste from my-post
                echo "<a href='../post-ad/?postid=" . $rows['idspPostings'] . "&categoryid=" . $rows['idspCategory'] . "&categoryname=" . $rows['spCategoryname'] . "' class='edit pull-right' style='padding-right:5px;'> <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</a>";
                //Complete

                if ($rows["spPostingVisibility"] != 0) {
                    if ($rows["spPostingsBought"] == 1 || $rows["spPostingsBought"] == 3)
                        echo "<div class='searchtimelines pull-right' data-profileid='" . $rows["spPostingsBuyerid"] . "' style='cursor:pointer; color:gray;'><span style='margin-left:12px;' class='glyphicon glyphicon-credit-card'></span> Bought&nbsp;</div>";

                    elseif ($rows["spPostingExpDt"] >= date("Y-m-d"))
                        echo "<div style='color:gray;' class='pull-right'><span class='glyphicon glyphicon-ok'></span> Active&nbsp;</div>";

                    elseif ($rows["spPostingExpDt"] < date("Y-m-d"))
                        echo "<div style='color:gray;'class='pull-right'><span class='glyphicon glyphicon-remove'></span> Expired &nbsp;</div>";
                }
                elseif ($rows["spPostingVisibility"] == 0) {
                    echo "<div style='color:gray;' class='pull-right'><span class='glyphicon glyphicon-save-file'></span> Draft&nbsp;</div>";
                }

                echo "</div>"; //row message
            }

            echo "</div></div>";
            THIS CODE FOR BUTTON IS BUY OR BID OR QUOTE END
            */
            //Commenet code 
            /*
            THIS IS HIDE FOR SOME NON REASON
            if ($_GET["publictimeline"] == 7 || $_GET["publictimeline"] == 2) {
                echo "<hr class='hrline' style='margin-top:10px;'></hr>";
                $c = new _comment;
                $result = $c->read($rows['idspPostings']);

                if ($result != false) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        $profilename = $row["spProfileName"];
                        $comment = $row["comment"];
                        $picture = $row["spProfilePic"];
                    }
                    echo "<a href='#' data-toggle='modal' data-target='#mycomment'><span  style='margin-left:10px;' class='morecomment' data-postid='" . $rows['idspPostings'] . "' >View previous comments</span></a>";

                    echo "<div class='row'>";
                    if (isset($picture))
                        echo "<div class='col-md-5 commentoverflow'><img alt='profilepic'  class='img-circle' src=' " . ($picture) . "' style='width: 40px; height: 40px;'><span style='color:#1a936f;'>" . $profilename . "</span></div>";
                    else
                        echo "<div class='col-md-5 commentoverflow'><img alt='profilepic'  class='img-circle' src='../img/default-profile.png' style='width: 40px; height: 40px;'><span style='color:#1a936f;'> " . $profilename . "</span></div>";


                    echo "<div class='col-md-7 commentoverflow' style='margin-top:8px;'><span style='color:gray;' >" . $comment . "</span></div>";
                    echo "</div>";
                }
                include("../social/commentform.php");
            }
            //Comment Complete/////////////////////////////////////////////////////////////
            echo "</div></div>";
            THIS IS HIDE FOR SOME NON REASON
            */
        }
    }
    include("mailmodal.php");
    
    ?>
</div>
<!--conversation Modal-->
<div class="modal fade" id="conversatation" tabindex="-1" role="dialog" aria-labelledby="enquireModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="enquireModalLabel">New message</h4>
            </div>
            <div class="modal-body">
                <form action="../enquiry/conversation.php" method="post">
                    <input type="hidden" id="spMessaging_idspMessage" name="spMessaging_idspMessage">
                    <input type="hidden" id="spConversationFlag" name="spConversationFlag" value="1"/>
                    <p id="buyerEnquiry">Message loading...</p>
                    <div class="form-group">
                        <label for="message" class="form-control-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" name="spConversation"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send message</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--complete-->

<!--comment-->

<div class="modal fade" id="mycomment" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content no-radius sharestorepos">
            <form action="../social/addcomment.php" id="popcoment" method="post">
                <div class="modal-header">
                    <h4 class="modal-title" id="commentModalLabel">Comments</h4>
                </div>
                <div class="modal-body">
                    <div id="commentUploading"><!--comment loading--></div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <span class="showerrorcoment"></span>
                        </div>
                        <div class="col-md-12" >
                            <div class="input-group">
                                <div class="input-group-addon commentprofile inputgroupadon">
                                    <div id="profilepictures"></div>
                                </div>

                                <input type="text" class="form-control" name="comment" id="comment"  placeholder="Type your comment here ..." style='height:45px;border-radius: 0px;margin-bottom: 0px;'>
                            </div>

                            <input type="hidden" class="form-control" name="idComment" id="commentid">
                            <input type="hidden" id="postcomment" name="spPostings_idspPostings" >
                            <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
                            <input name="userid" type="hidden" value="<?php echo $_SESSION['uid'] ?>">
                        </div>
                    </div>
                    
                
                </div>
                <div class="modal-footer cmnt_del_fot">
                    <button type="button" class="btn btn_gray" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn_blue ">Comment</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!--comentcomplete-->

<!--bid system-->
<div class="modal fade" id="bid-system" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="bidModalLabel">Bid on Project <span id="projecttitle" style="color:#1a936f;"></span></h4>
            </div>
            <div class="modal-body">
                <form>
                    <label for="bidPrice">Your bid for the project</label>
                    <div class="input-group" style="width:6cm;">
                        <span class="input-group-addon" id="basic-addon1">$</span>
                        <input type="text" class="form-control activity" id="bidPrice" name="bidPrice" data-filter="0" placeholder="Bid Price...." aria-describedby="basic-addon1">
                    </div><br>

                    <!--Hidden attribute-->
                    <input type="hidden" id="bidpost" name="spPostings_idspPostings">

                    <input type="hidden" id="spPostFieldBidFlag" value="1">

                    <input type="hidden" class="closingdate">

                    <input type="hidden" class="freelancercat">

                    <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
                    <!--Complete-->


                    <label for="totalDays">In how many days can you deliver a completed project?*</label>
                    <div class="input-group" style="width:6cm;">
                        <input type="text" class="form-control activity" id="totalDays" name="totalDays" placeholder="Total Days...." aria-describedby="basic-addon2" data-filter="0">
                        <span class="input-group-addon" id="basic-addon2">Day(s)</span>
                    </div><br>


                    <label for="initialPercentage">Initial milestone percentage required</label>
                    <div class="input-group" style="width:6cm;">
                        <input type="text" class="form-control activity" id="initialPercentage" name="initialPercentage" placeholder="Initial Percentage...." aria-describedby="basic-addon2" data-filter="0">
                        <span class="input-group-addon" id="basic-addon2">20-100%</span>
                    </div><br>

                    <div class="form-group" style="width:6cm;">
                        <label for="bidPrice">Comment</label>
                        <textarea class="form-control activity" id="comment" name="comment" placeholder="Type Comment..."></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary placebid">Place Bid</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--completed-->
