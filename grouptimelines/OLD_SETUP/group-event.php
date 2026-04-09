<!DOCTYPE html>
<html lang="en-US">

<head>

    <!--This script for posting timeline data Start-->
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

    <style type="text/css">
        .upEventBox .bodyEventBox a {
            display: block;
            font-size: 18px;
            font-family: "Proxima Nova";
            font-weight: 700;
            width: 80%;
            line-height: 16px;
            min-height: 0px !important;
        }

        .seeproduct {
            display: none;
        }

        .loadpost {
            font-size: 18px;
            color: #202548;
            font-weight: bold;
            margin-right: 30%;
        }

        .loadpost:hover {
            text-decoration: underline !important;
            font-size: 18px;
            color: #4F95FF !important;
            font-weight: bold;

        }

        .event-descrip-section {
            height: 99px;
        }
    </style>
    <!--This script for posting timeline data End-->
</head>

<body onload="pageOnload('groupdd')">
    <?php


    $g = new _spgroup;
    $result = $g->groupdetails($group_id);
    //echo $g->ta->sql;
    if ($result != false) {
        $row = mysqli_fetch_assoc($result);
        $gimage = $row["spgroupimage"];
        $spGroupflag = $row['spgroupflag'];
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="events">
                <div class="heading-wrapper">
                    <div class="main-heading">
                        Events

                    </div>

                    <?php if ($row["spProfiles_idspProfiles"] == $_SESSION['pid']) { ?>
                        <div class="more-btn">
                            <a href="<?php echo $BaseUrl; ?>/post-ad/events/?groupid=<?php echo $group_id; ?>" class="btn btnPosting db_btn db_primarybtn pull-right btn-border-radius">
                                <img src="../assets/images/inner_group/add-4.svg" alt="">
                                <span>Add Event</span></a>
                        </div>
                    <?php } ?>
                </div>
                <div class="filters">
                    <div class="input-group">
                        <label>Date</span></label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Date</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Time Frame</span></label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Time Frame</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 25px; margin-bottom: 12px;">


                    <?php

                    include('group_shared_event.php');

                    $start = 0;
                    $limit = 2;
                    $count = 1;
                    $sp      = new _postshare;
                    $p      = new _spgroup_event;


                    $res    = $p->publicgroup_eventnew($group_id);


                    if ($res != false) {

                        $group_event = $res->num_rows;

                        while ($row = mysqli_fetch_assoc($res)) {


                            $groupid = $row['spgroupid'];
                            $groupname = $row['spgroupname'];
                            $venu = $row['spPostingEventVenue'];
                            $startDate = $row['spPostingStartDate'];
                            $startTime = $row['spPostingStartTime'];
                            $endTime = $row['spPostingEndTime'];

                            $dtstrtTime = strtotime($startTime);
                            $dtendTime = strtotime($endTime);

                    ?>
                            <div class="col-md-4">
                                <div class="upEventBox upcomingbox <?php echo ($count > 6) ? 'seeproduct' : ''; ?>" style="height: 430px;width: 90%; margin-left: 22px; background-color: #f7f7f7!important;border: 1px solid darkgrey;">

                                    <?php if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) { ?>

                                        <a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings'] . '&groupid=' . $group_id . '&groupname=' . $_GET['groupname']; ?>" class="eventcapitalize">

                                        <?php } else { ?>

                                            <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize">

                                            <?php } ?>

                                            <?php
                                            $pic = new _groupeventpic;

                                            $res2 = $pic->readFeature($row['idspPostings']);
                                            if ($res2 != false) {
                                                if ($res2->num_rows > 0) {
                                                    if ($res2 != false) {
                                                        echo 1;
                                                        $rp = mysqli_fetch_assoc($res2);
                                                        $pic2 = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "'  style='height:  180px !important;'>";
                                                    } else {
                                                        echo 2;
                                                        echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg' style='height:  180px !important;'>";
                                                    }
                                                } else {
                                                    echo 3;
                                                    $res2 = $pic->read($row['idspPostings']);
                                                    if ($res2 != false) {
                                                        $rp = mysqli_fetch_assoc($res2);
                                                        $pic2 = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' style='height:  180px !important;' src=' " . ($pic2) . "' >";
                                                    } else {
                                                        echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg' style='height:  180px !important;'>";
                                                    }
                                                }
                                            } else {

                                                $pic1 = new _eventpic;
                                                $res2 = $pic1->readFeature($row['idspPostings']);

                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' style='height:  180px !important;' src=' " . ($pic2) . "' >";
                                                } else {
                                                    echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg' style='height:  180px !important;'>";
                                                }
                                            }
                                            ?>
                                            </a>
                                            <div class="bodyEventBox">
                                                <?php
                                                if (!empty($startDate)) {
                                                    echo $start_date;
                                                    $dy = new DateTime($startDate);
                                                    $day = $dy->format('d');
                                                    $month = $dy->format('M');
                                                    $weak = $dy->format('D');
                                                } else {
                                                    $day = 0;
                                                    $month = "&nbsp;";
                                                    $weak = "&nbsp;";
                                                }
                                                ?>
                                                <?php if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) { ?>

                                                    <a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings'] . '&groupid=' . $group_id; ?>" class="eventcapitalize">

                                                    <?php } else { ?>

                                                        <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize">

                                                        <?php } ?>
                                                        <a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings'] . '&groupid=' . $group_id . '&groupname=' . $_GET['groupname']; ?>" class="eventcapitalize" style="height: 38px;font-size:16px;">

                                                            <?php
                                                            if (strlen($row['spPostingTitle']) < 40) {

                                                                echo $row['spPostingTitle'];
                                                            } else {

                                                                echo substr($row['spPostingTitle'], 0, 40) . "...";
                                                            } ?>
                                                        </a>
                                                        <div class="event-descrip-section">
                                                            <span class="eventcapitalize" style="margin-left: 0px;min-height: 20px!important;font-size:15px!important;"><i class="fa fa-map-marker"></i> <?php echo $venu; ?></span>
                                                            <p class="eventcapitalize" style="min-height: 18px!important;word-break:break-all;">
                                                                <?php
                                                                if (strlen($row['spPostingNotes']) < 80) {

                                                                    echo $row['spPostingNotes'];
                                                                } else {

                                                                    echo substr($row['spPostingNotes'], 0, 80) . "...";
                                                                } ?>
                                                            </p>
                                                        </div>

                                            </div>

                                            <div class="footEventBox footupcoming">
                                                <p style="font-size: 11px;">

                                                    <?php
                                                    $cancel_return = $BaseUrl . "/paymentstatus/payment_cancel.php";
                                                    $success_return = $BaseUrl . "/paymentstatus/groupevent_payment_success.php?postid=" . $row['idspPostings'] . "&sellid=" . $row['spProfiles_idspProfiles'] . "&groupid=" . $row['spgroupid'];
                                                    $paypal_url     = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
                                                    $merchant_email = 'developer-facilitator@thesharepage.com';

                                                    ?>

                                                <form action="<?php echo $paypal_url; ?>" method="post" class="form-inline text-right">
                                                    <input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
                                                    <!-- <input type='hidden' name='notify_url' value='http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php'> -->
                                                    <input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>" />
                                                    <input type="hidden" name="return" value="<?php echo $success_return; ?>">
                                                    <input type="hidden" name="rm" value="2" />
                                                    <input type="hidden" name="lc" value="" />
                                                    <input type="hidden" name="no_shipping" value="1" />
                                                    <input type="hidden" name="no_note" value="1" />
                                                    <input type="hidden" name="currency_code" value="USD">
                                                    <input type="hidden" name="page_style" value="paypal" />
                                                    <input type="hidden" name="charset" value="utf-8" />
                                                    <input type="hidden" name="cbt" value="Back to FormGet" />

                                                    <!-- Redirect direct to card detail Page -->

                                                    <input type="hidden" name="landing_page" value="billing">

                                                    <!-- Redirect direct to card detail Page End -->


                                                    <!-- Specify a Buy Now button. -->
                                                    <input type="hidden" name="cmd" value="_cart">
                                                    <input type="hidden" name="upload" value="1">
                                                    <?php



                                                    echo "<input type='hidden' name='item_name_1' value='" . $row['spPostingTitle'] . "'>";
                                                    echo "<input type='hidden' name='item_number' value='143' >";
                                                    echo "<input type='hidden' class='" . $row['idspPostings'] . "' name='amount_1' value='" . $row['spPostingPrice'] . "'>";

                                                    echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
                                                    ?>
                                                    <!--<button type="submit" class="btn butn_cancel pull-right " id="Buynow" style="border-radius: 25px;float:right;margin-top: -45px;width: 110px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Buy Ticket</button>-->

                                                    <a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings'] . '&groupid=' . $group_id . '&groupname=' . $_GET['groupname']; ?>" class="btn butn_cancel pull-right btn-border-radius" id="Buynow" style="float:right;margin-top: -45px;width: 110px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Buy Ticket </a>
                                                </form>
                                                <!----------------------------------------------------------------->
                                                <p style="font-size: 11px;"><span class="date" style="margin-left: 10px;"><i class="fa fa-calendar" style="font-size: 15px;"></i> <?php echo $startDate; ?> |
                                                        <?php echo date("h:i A", $dtstrtTime); ?> - <?php echo date("h:i A", $dtendTime); ?></span></p>
                                                </p>
                                            </div>
                                </div>
                            </div> <?php
                                    $count++;
                                }
                                $p      = new _spgroup_event;
                                $r1    = $p->readsharePost($group_id);



                                if ($group_event > 6) { ?>
                            <center>
                                <div class="loadingseemore"><a class="loadpost" id="fold_p">SEE MORE</a></div>
                            </center>
                    <?php }
                            } else {
                                //echo"<h3 class='text-center'>Group Event Not Available!</h3>";
                            }
                    ?>







                </div>


            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            // Load more data
            $('.loadpost').click(function() {
                //  alert();

                $(".seeproduct").show();
                $(".loadpost").hide();



            });
        });
    </script>

</body>

</html>