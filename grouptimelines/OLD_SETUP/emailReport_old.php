<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-groups/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <?php include('../component/f_links.php'); ?>
        <link href="<?php echo $BaseUrl ?>/assets/css/date-time/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
        <link href="<?php echo $BaseUrl ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    </head>

    <body class="bg_gray" onload="pageOnload('groupdd')">
        <?php

        $g = new _spgroup;
        $result = $g->groupdetails($_GET["groupid"]);
        //echo $g->ta->sql;
        if ($result != false) {
            $row = mysqli_fetch_assoc($result);
            $gimage = $row["spgroupimage"];
            $spGroupflag = $row['spgroupflag'];
        }
        if (isset($_GET['groupid']) && isset($_GET['groupname'])) {
            $txtgroupid = $_GET['groupid'];
            $txtgroupname = $_GET['groupname'];
        }
        ?>

        <?php include('../header.php'); ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <?php include('../component/left-group.php'); ?>
                    </div>
                    <div class="col-md-10">
                        <?php include('top_banner_group.php'); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="about_banner">
                                    <div class="top_heading_group ">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <ol class="breadcrumb">
                                                    <li><a href="<?php echo $BaseUrl; ?>/grouptimelines/addEmail.php?groupid=<?php echo $_GET['groupid'] ?>&groupname=<?php echo $_GET['groupname'] ?>&emailCampaigns">
                                                            <h3>Email Campaign</h3>
                                                        </a></li>
                                                    <li><a href="<?php echo $BaseUrl; ?>/grouptimelines/emailReport.php?groupid=<?php echo $_GET['groupid'] ?>&groupname=<?php echo $_GET['groupname'] ?>&emailCampaigns">Reports</a></li>
                                                </ol>
                                            </div>

                                        </div>
                                    </div>
                                    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table_light_green_head text-center" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Campaign Name</th>
                                                            <th>Date/Time</th>
                                                            <th>Total Members Send</th>
                                                            <th>Action</th>
                                                            <!-- <th>Report</th> -->

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $g = new emailEmailCampaign;
                                                        $result2 = $g->getemailEmailCampaign($_SESSION['uid'], 'Email');
                                                        if ($result2 != false) {
                                                            while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><?php echo $row2['name']; ?></td>
                                                                    <td><?php echo $row2['date']; ?><br><?php date('H:i', strtotime($row2['time'])); ?></td>
                                                                    <td></td>
                                                                    <?php
                                                                    if ($row2['status'] == 'pending') { ?>
                                                                        <td class="pend_status">
                                                                            <i class="fa fa-clock-o"></i> <?php echo $row2['status']; ?>
                                                                        </td>
                                                                    <?php
                                                                    }
                                                                    if ($row2['status'] == 'Ok') { ?>
                                                                        <td class="ok_stautus">
                                                                            <i class="fa fa-thumbs-up"></i> <?php echo "sent";
                                                                                                            ?>
                                                                        </td>
                                                                    <?php
                                                                    }
                                                                    if ($row2['status'] == 'progress') { ?>
                                                                        <td class="ok_stautus">
                                                                            <i class="fa fa-thumbs-up"></i> <?php echo $row2['status'];
                                                                                                            ?>
                                                                        </td>
                                                                    <?php
                                                                    } ?>

                                                                    <?php
                                                                    if ($row2['status'] == 'Ok') { ?>
                                                                        <!--  <td class="text-center">
<a href="<?php echo $BaseUrl; ?>/grouptimelines/singleEmailReport.php?groupid=<?php echo $txtgroupid; ?>&groupname=<?php echo $txtgroupname ?>&emailCampaigns&emailreport=<?php echo $row2['job_id'] ?>" data-id="<?php echo $row2['id']; ?>">View Reports</a> -->
                                                                        <!-- <span class="btn btn-primary report" id="report" data-datac="<?php /// echo $campaign->job_id; 
                                                                                                                                            ?>" ><a data-id="<?php //echo $campaign->job_id; 
                                                                                                                                                                ?>"> Report </a></span> -->
                                                                        <!-- </td> --> <?php
                                                                                    }
                                                                                        ?>
                                                                </tr>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <?php
        include('../component/f_footer.php');
        include('../component/f_btm_script.php');
        ?>
    </body>

    </html>

    <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('#example').DataTable({
                select: false,
                "columnDefs": [{
                    className: "Name",
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                }]
            }); //End of create main table

        });
    </script>
<?php
} ?>