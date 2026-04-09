

<div id="posts">
    <?php
    $groupshares = false;
    /*$p = new _postingview;*/
    $p = new _productposting;
    
    $res = $p->singlefriendstore($_GET["friendid"]);
    //$res = $p->all_group_store($_GET["friendid"]);
    $res = $p->getAllStoreProduct($_GET["friendid"]);
    //echo $p->ta->sql;
    if ($res != false) {
        printPosts($res);
    }
    

    // post-grid-item
    function printPosts($res) {
        include('../univ/baseurl.php');
        
           /* print_r($res);*/
            
        while ($rows = mysqli_fetch_assoc($res)) {
            ?>
            <div class="col-md-4" style="padding: 10px;">
                <div class="store_box br_radius_top">
                    <?php
                    $dt = new DateTime($rows['spPostingExpDt']);

                    $pic = new _postingpic;
                    $result = $pic->read($rows['idspPostings']);
                    //echo $pic->ta->sql;
                    if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                        if ($result != false) {
                            $rp = mysqli_fetch_assoc($result);
                            $picture = $rp['spPostingPic'];
                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                        } else
                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                    }else{
                        if ($result != false) {
                            $rp = mysqli_fetch_assoc($result);
                            $picture = $rp['spPostingPic'];
                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                        } else
                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                    }
                    ?>
                   
                    <?php 
                    if(!empty($rows['spPostingtitle'])){
                        if(strlen($rows['spPostingtitle']) < 15){
                            ?><h3><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='. $rows['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo $rows['spPostingtitle']; ?></a></h3><?php
                            
                        }else{
                            ?><h3><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='. $rows['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo substr($rows['spPostingtitle'], 0,10).'...'; ?></a><h3><?php
                        }
                    }else{
                        echo "<h3>&nbsp;</h3>";
                    }
                    ?>                    
                    <h4>
                        <?php
                        if ($rows['spPostingPrice'] != false) {
                            echo "<div class='postprice' style='display: inline-block;' data-price='" . $rows['spPostingPrice'] . "'>" . $rows['spPostingPrice'] . " </div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                        }else{
                            echo "Expires on ".$rows['spPostingExpDt'];
                        }
                        ?>
                        
                    </h4>
                    <h5><?php echo $dt->format('d M'); ?> @ <?php echo $rows['spPostingsCity']; ?></h5>
                    <a href="#" style="color:black;">By <?php echo ucwords($rows['spProfileName']);?></a>
                </div>
                <div class="store_box_footer br_radius_bottom">
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
                
            </div>
            <?php
            
        }
    }
    include("../publicpost/mailmodal.php");
    
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
        <div class="modal-content no-radius">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="commentModalLabel">Comments</h4>
            </div>
            <div class="modal-body">
                <div id="commentUploading"><!--comment loading--></div>
                <form action="../social/addcomment.php" method="post">
                    <div class="row">
                        
                        <div class="col-md-12" >
                            <div class="input-group">
                                <div class="input-group-addon commentprofile inputgroupadon">
                                    <div id="profilepictures"></div>
                                </div>
                                <input type="text" class="form-control" name="comment" id="comment"  placeholder="Type your comment here ..." style='height:45px;border-radius: 0px;'>
                            </div>

                            <input type="hidden" class="form-control" name="idComment" id="commentid">
                            <input type="hidden" id="postcomment" name="spPostings_idspPostings" >
                            <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
                            <input name="userid" type="hidden" value="<?php echo $_SESSION['uid'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer cmnt_del_fot">
                        <button type="button" class="btn btn_gray" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn_blue">Comment</button>
                    </div>
                </form>
            </div>
            
            
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
