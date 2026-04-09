<?php
    include('../univ/baseurl.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../component/links.php');?>

        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/css/event_detail.css"> 
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
        
    </head>
    <body class="bg_gray">
        <?php
        session_start();

        function sp_autoloader($class) {
            include '../mlayer/' . $class . '.class.php';
        }

        spl_autoload_register("sp_autoloader");
        include_once("../header.php");
        ?>
        <?php
        $p = new _postingview;
        $rd = $p->read($_GET["postid"]);
        if ($rd != false) {
            $row = mysqli_fetch_assoc($rd);
            $price = $row['spPostingPrice'];
            $catid = $row["idspCategory"];
            $wholesaleflag = $row["spPostingsFlag"];
            $button = $row["spCategoriesButton"];
            $comment = $row["sppostingscommentstatus"];
            $notes = $row['spPostingNotes'];
        }
        $p = new _postfield;
        $res = $p->readfield($_GET["postid"]);
        if ($res != false) {
            while ($rows = mysqli_fetch_assoc($res)) {
                if ($rows['spPostFieldLabel'] == "Company")
                    $company = $rows['spPostFieldValue'];

                if ($rows['spPostFieldLabel'] == "Discount")
                    $discount = $rows['spPostFieldValue'];
                if ($rows['spPostFieldName'] == 'spPostingEventVenue_') {
                    $venue = $rows['spPostFieldValue'];
                }
                if ($rows['spPostFieldName'] == 'hallcapacity_') {
                    $capacity = $rows['spPostFieldValue'];
                }
                if ($rows['spPostFieldName'] == 'spPostingStartDate_') {
                    $start_date = $rows['spPostFieldValue'];
                }
                if ($rows['spPostFieldName'] == 'spPostingEndDate_') {
                    $end_date = $rows['spPostFieldValue'];
                }
                if ($rows['spPostFieldName'] == 'spPostingStartTime_') {
                    $start_time = $rows['spPostFieldValue'];
                }
                if ($rows['spPostFieldName'] == 'spPostingEndTime_') {
                    $end_time = $rows['spPostFieldValue'];
                }
            }
        }
        $pc = new _postingpic;
        $res = $pc->read($_GET["postid"]);
        if ($res != false) {
            $postr = mysqli_fetch_assoc($res);
            $picture = $postr['spPostingPic'];
        }

        $pr = new _postfield;
        $re = $pr->quantity($_GET["postid"]);
        //echo $pr->ta->sql;
        if ($re != false) {
            $i = 0;
            $rw = mysqli_fetch_assoc($re);
            $totalquantity = $rw["spPostFieldValue"];
        } else {
            if ($catid == 8 || $catid == 10 || $catid == 11 || $catid == 13 || $catid == 14)
                $totalquantity = INF;
            else
                $totalquantity = 1;
        }

        $or = new _order;
        $total = 0;
        $res = $or->quantityavailable($_GET["postid"]);
        //echo $or->ta->sql;
        if ($res != false) {
            while ($order = mysqli_fetch_assoc($res)) {
                if ($order["spOrderStatus"] == 0) {
                    $soldquantity += $order["spOrderQty"];
                }
            }
        }
        if(isset($soldquantity)){
            $available = $totalquantity - $soldquantity;
        }else{
            $available = 0;
        }
        
        $g = new _spgroup;
        $result2 = $g->groupdetails($_GET["groupid"]);
        //echo $g->ta->sql;
        if ($result2 != false) {
            $row2 = mysqli_fetch_assoc($result2);
            $gimage = $row2["spgroupimage"];
            $spGroupflag = $row2['spgroupflag'];
        }
        ?>

        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <?php include('../component/left-group.php');?>
                    </div>
                    <div class="col-md-10">
                        <?php include('top_banner_group.php');?>


                        <div class="row">    
                            <div class="col-md-12"> 
                                <div class="about_banner">  
                                    <div class="top_heading_group ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3>Events</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="<?php echo $BaseUrl;?>/post-ad/events/?groupid=<?php echo $_GET["groupid"]; ?>&groupname=<?php echo $_GET['groupname']; ?>&event&back=back&groupflag=gflag" class="btn btn-white pull-right"><i class="fa fa-plus"></i> Add New Event</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="main-details-container event_form">
                                        <div class="row">
                                            <div class="col-md-6 image-margn">
                                                <?php
                                                $pc = new _postingpic;
                                                $postpicres = $pc->read($_GET["postid"]);
                                                if ($postpicres != false) {
                                                    while ($rows = mysqli_fetch_assoc($postpicres)) {
                                                        $picture = $rows['spPostingPic'];
                                                        ?>                                                            
                                                        <div class="">
                                                            <img src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-responsive m_btm_20">
                                                            <h3 >Description</h3>
                                                            <p><?php echo $notes; ?></p>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-6">
                                                <h3><?php echo $row['spPostingtitle'] ?></h3>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td>Start Date</td>
                                                                <td><?php echo date('F j, Y', strtotime($start_date)) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>End Date</td>
                                                                <td><?php echo date('F j, Y', strtotime($end_date)) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Time (Start/End)</td>
                                                                <td><?php echo $start_time . ' / ' . $end_time ?></td>
                                                            </tr>
                                                             <tr>
                                                                <td>Ticket Price</td>
                                                                <td>$<?php echo $price ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Capacity</td>
                                                                <td><?php echo $capacity ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Location</td>
                                                                <td><?php echo $row['spPostingsCountry'] . ' - ' . $row['spPostingsCity'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Venue</td>
                                                                <td><?php echo $venue ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="details-actions-container">
                                                    <ul class="inline-list">
                                                        <li>
                                                            <form action="<?php echo ($available == 0 ? " " : "../cart/addorder.php"); ?>" method="post" >
                                                                <input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET["postid"] ?>">
                                                                <input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid'] ?>"/>
                                                                <input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo $price ?>"/>
                                                                <input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php echo $row['idspProfiles']; ?>"/>
                                                                <?php
                                                                if ($catid == 9) {
                                                                    if ($price > 0) {
                                                                        $buyerid = $_SESSION['pid'];
                                                                        $od = new _order;
                                                                        $res = $od->checkorder($_GET["postid"], $buyerid);
                                                                        if ($res != false) {
                                                                            echo "<button type='button' class='btn disabled' data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "'><span class='fa fa-shopping-cart' aria-hidden='true'></span> Added to cart</button>";
                                                                        } else{
                                                                            echo "<button type='submit' class='btn " . ($available == 0 ? "disabled" : "") . "' id='" . ($available == 0 ? "" : "addtocart") . "'  data-postid='" . $_GET["postid"] . "'  data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "'><span class='fa fa-shopping-cart' aria-hidden='true'></span>  Buy Ticket</button>";
                                                                        }
                                                                    }
                                                                    else {
                                                                        $buyerid = $_SESSION['pid'];
                                                                        $od = new _order;
                                                                        $res = $od->checkevent($_GET["postid"], $buyerid);
                                                                        if ($res != false) {
                                                                            echo "<button type='button' class='btn disabled' data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "'>Joined</button>";
                                                                        } else{
                                                                            echo "<button type='button' class='btn  joinevent' data-profileid='" . $_SESSION["pid"] . "'  data-postid='" . $_GET["postid"] . "' data-seller='" . $row['idspProfiles'] . "'>Join</button>";
                                                                        }
                                                                    }
                                                                }
                                                                ?>  
                                                            </form>
                                                        </li>                                                                
                                                        <li>
                                                            <button type="submit" class="btn sp-share" data-toggle="modal" data-target="#myshare" 888><span class="fa fa-share" aria-hidden="true"></span> Share</button>&nbsp;
                                                        </li>       
                                                        <li>
                                                            <button type="submit" class="btn "  id="enquire" data-toggle="modal" data-target="#enqueryModal"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo ($catid == 12 ? "Poke" : "Enquire") ?></button>&nbsp;
                                                        </li>
                                                        <li>
                                                            <button type="submit" class="btn" data-postid="<?php echo $_GET["postid"] ?>" id="addtofavourite"><span class="fa fa-heart-o" aria-hidden="true"></span> Add to favorites</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                                        
                    </div>
                </div>
            </div>       
  
            <div class="modal fade" id="myshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <form action="../social/share.php" method="POST">
                                <input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid'] ?>">
                                <input type="hidden" name="spPostings_idspPostings" value="<?php echo $_GET["postid"]; ?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownShare" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select group or friend<span class="caret"></span></button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownShare">
                                                <li id="groupshare" class="sppointer sharedd"><a href="#">Share in a group </a></li>
                                                <li id="friendshare" class="sppointer sharedd"><a href="#">Share to a friend</a></li>
												
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-5  hidden" id="groupshow">
                                        <div class="input-group">
                                            <input type="hidden" class="form-control" id="spgroupshareid" name="spShareToGroup">
                                            <input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
                                        </div>
                                    </div>

                                    <div class="col-md-5 hidden" id="profileshow">
                                        <div class="input-group">
                                            <input type="hidden" id="spfriendshareid" name="spShareToWhom">
                                            <input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
                                        </div>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
                                    <input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="fffSay something about this...">
                                </div>
                                <!--</form>-->
                       
                                <div class="modal-body">
                                    <img id="modalpostingpic"  src="<?php echo ($postr['spPostingPic']); ?>" alt="Posting Pic" class="img-rounded img-thumbnail <?php echo (isset($postr['spPostingPic']) ? "" : "hidden"); ?>" style="width:300px; height:300px; margin-left:120px">

                                    <img id="modalpostingpic"  src="../img/no.png" alt="Posting Pic" class="img-rounded img-thumbnail <?php echo (isset($postr['spPostingPic']) ? "hidden" : ""); ?>" style="width:300px; height:300px; margin-left:120px">

                                </div>
                                <div class="modal-footer">
                                    <button type="" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" id="share" class="btn btn-primary">Share</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="enqueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title" id="enquireModalLabel" align="center"><b>New message</b></h3>
                        </div>
                        <div class="modal-body">
                            <form action="../enquiry/addenquire.php" method="post">
                                <?php
                                $e = new _postenquiry;
                                $re = $e->read($_GET["postid"]);
                                if ($re != false) {
                                    while ($rw = mysqli_fetch_assoc($re)) {
                                        $con = new _conversation;
                                        $result = $con->readconversation($rw["idspMessage"]);
                                        if ($result != false) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                
                                            }
                                        }
                                    }
                                }
                                ?>
                                <input type="hidden" class="dynamic-pid" id="buyerProfileid" name="buyerProfileid" value="<?php echo $_SESSION['pid'] ?>"/>

                                <input type="hidden" id="sellerProfileid" name="sellerProfileid" value="<?php echo $row['idspProfiles']; ?>"/>
                                
                                <input type="hidden" id="spmessaging_date" name="spmessaging_date" value="<?php echo date('Y-m-d') ?>">
                                
                                <input type="hidden" id="spPostings_idspPostings" name="spPostings_idspPostings" value="<?php echo $_GET["postid"] ?>">

                                <div class="form-group">
                                    <label for="message-text" class="form-control-label contact">Message</label>
                                    <textarea class="form-control" id="message-text" name="message" rows="5"></textarea>
                                </div>
                        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary postenquiry">Send message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    
        </section>
        <?php include('../component/footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../component/btm_script.php'); ?>
    </body>
</html>
