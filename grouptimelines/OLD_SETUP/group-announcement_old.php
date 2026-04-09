<?php
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
    include_once("../authentication/check.php");
    $_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&timeline";
}

/*$pid=$_SESSION['pid'];
$getid=$_GET['groupid'];
$obj2=new _spAllStoreForm;	
$ress2=$obj2->readdatabymulid($getid,$pid);

//print_r($ress2);

//die("+++++++++++++");

if($ress2 ==false){
//die("=======");
header("location:$BaseUrl/my-groups/?msg=notaccess");

}*/
?>
<!DOCTYPE html>
<html lang="en-US">

<head>

    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

    <?php include('../component/links.php'); ?>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/prettyPhoto.css">
</head>

<style>
    div:where(.swal2-container).swal2-center>.swal2-popup {
        height: 297px;
        font-size: 15px;
    }
</style>


<body class="bg_gray" onload="pageOnload('groupdd')">
    <?php

    include_once("../header.php");

    $g = new _spgroup;
    $result = $g->groupdetails($group_id);
    if ($result != false) {
        $row = mysqli_fetch_assoc($result);
        $userid = $row['spProfiles_idspProfiles'];
        $gimage = $row["spgroupimage"];
        $spGroupflag = $row['spgroupflag'];
    }
    ?>

    <section class="landing_page">
        <div class="container">
            <div class="row">
                <div class="col-md-2 no-padding">
                    <?php include('../component/left-group.php'); ?>
                </div>
                <div class="col-md-10">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="about_banner" id="ip6">
                                <div class="top_heading_group " id="ip6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span id="size1">Group <small>[Announcement]</small></span>

                                        </div>
                                        <div class="col-md-6">
                                            <a class="pull-right" href="<?php echo $BaseUrl ?>/grouptimelines/?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname'] ?>&timeline&page=1">Back</a>
                                        </div>
                                        <?php
                                        $pid = $_SESSION['pid'];

                                        if ($pid == $userid) {

                                        ?>
                                            <div class="col-md-6">

                                                <li> <a data-toggle="modal" data-target="#myModal22" class="btn btn-primary  btn-border-radius" style="float:right"> Add Announcement </a></li>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET['id'])) {
                                    $deleteobj2 = new _groupsponsor;
                                    $deleteobj2->remove22($_GET['id']);
                                }
                                ?>


                                <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
                                <?php
                                $obj2 = new _groupsponsor;
                                $result = $obj2->readPost22($group_id);
                                ?>
                                <div style="padding:18px">
                                    <table id="example" class="display" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>

                                                <th>Date</th>
                                                <th>Date</th>

                                                <th>Title</th>
                                                <th>Message</th>
                                                <?php
                                                if ($pid == $userid) {
                                                ?>
                                                    <th>Action</th>

                                                <?php } ?>
                                            </tr>
                                        </thead>



                                        <tbody>
                                            <?php
                                            if ($result != false) {
                                                while ($row2 = mysqli_fetch_assoc($result)) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row2['announcemt_date']); ?></td>
                                                        <td><?php echo htmlspecialchars($row2['announcemt_date']); ?></td>
                                                        <td><?php echo htmlspecialchars($row2['title']); ?></td>
                                                        <td><?php echo htmlspecialchars($row2['message']); ?></td>
                                                        <?php if ($pid == $userid) { ?>
                                                            <td>
                                                                <a data-toggle="modal" data-target="#myModal33" id="announcement" href="" data-date="<?php echo htmlspecialchars($row2['announcemt_date']); ?>" data-title="<?php echo htmlspecialchars($row2['title']); ?>" data-message="<?php echo htmlspecialchars($row2['message']); ?>">
                                                                    <i title="Edit" class="fa fa-eye"></i>
                                                                </a> |
                                                                <a style="cursor: pointer;" onclick="delete_play('<?php echo $BaseUrl; ?>/grouptimelines/group-announcement.php?groupid=<?php echo $group_id; ?>&groupname=sfererete&announcement&status=delete&id=<?php echo $row2['id']; ?>')">
                                                                    <i title="Delete" class="fa fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="5">No announcement found</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>


                                    </table>
                                </div>
                                <div class="container">
                                    <div class="modal fade" id="myModal33" role="dialog">
                                        <div class="modal-dialog">


                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">ANNOUNCEMENT</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="" id="id2">
                                                    <div>
                                                        <label for="" class="form-label">Date</label>
                                                        <input class="form-control" name="date" id="date" disabled>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="" class="form-label">Title</label>
                                                        <input type="text" class="form-control" name="title" id="title" disabled>
                                                    </div>
                                                    <div></br>
                                                        <label for="" class="form-label">Message </label>
                                                        <textarea class="form-control" name="textarea" id="message" disabled> </textarea>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="row no-margin" style="padding: 10px;">
                                    <?php
                                    $p = new _postings;
                                    $p2 = new _postings;
                                    $start = 0;
                                    //$res = $p->globaltimelinesProfile($start, $_SESSION["pid"]);

                                    $conn = _data::getConnection();

                                    $gid = $group_id;
                                    /* $sql = "SELECT s.spPostings_idspPostings FROM share AS s INNER JOIN allpostdata AS f ON f.idspPostings = s.spPostings_idspPostings WHERE spShareToGroup = $gid AND f.idspCategory = 16 AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings FROM allpostdata AS t inner join spprofiles as d on t.idspprofiles = d.idspprofiles where idspcategory = 17 and t.sppostingvisibility = $gid ORDER BY spPostings_idspPostings DESC";*/

                                    $sql = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid WHERE spShareToGroup = $gid AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid ORDER BY timelineid DESC";

                                    /*echo $sql;*/
                                    $res = mysqli_query($conn, $sql);


                                    $pg = new _spgroup;
                                    $rpvt = $pg->readgroupAdmin($group_id);
                                    if ($rpvt != false) {
                                        while ($row = mysqli_fetch_assoc($rpvt)) {


                                            $admin = $row['idspProfiles'];
                                        }
                                    }

                                    if ($res != false) {
                                        while ($timeline = mysqli_fetch_assoc($res)) {

                                            /*print_r($timeline);*/

                                            $_GET["timelineid"] = $timeline['timelineid'];
                                            $res2 = $p2->singletimelines($_GET["timelineid"]);
                                            //echo $p2->ta->sql;
                                            if ($res2 != false) {
                                                while ($rows = mysqli_fetch_assoc($res2)) {

                                                    /*print_r($rows);*/
                                                    $pr = new _spprofiles;
                                                    $NameOfProfile = $pr->getProfileName($rows['spProfiles_idspProfiles']);
                                                    $dt = new DateTime($rows['spPostingDate']);

                                                    $pic = new _postingpic;
                                                    $result = $pic->read($rows['idspPostings']);
                                                    //echo $pic->ta->sql;
                                                    if ($result != false) {
                                                        while ($rp = mysqli_fetch_assoc($result)) {
                                                            $pict = $rp['spPostingPic'];
                                                        }
                                                    } else {
                                                        $pict = NULL;
                                                    }
                                                    if ($pict == NULL) {
                                                    } else { ?>


                                    <?php
                                                    }
                                                }
                                            }
                                        }
                                    }


                                    ?>





                                </div>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <form action="" method="POST">
        <div class="container">

            <!-- Trigger the modal with a button -->


            <!-- Modal -->
            <div class="modal fade" id="myModal22" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title" style="display: inline-block">POST AN ANNOUNCEMENT</h3>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="" id="id2">
                            <div>
                                <label for="" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date">
                            </div>
                            <br>
                            <div>
                                <label for="" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div></br>
                                <label for="" class="form-label"> Announcement Detail</label>
                                <textarea class="form-control" name="textarea"> </textarea>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-danger btn-border-radius" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-default btn-primary btn-border-radius">Submit</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>
    <?php include('../component/footer.php'); ?>
    <?php include('../component/btm_script.php'); ?>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery.prettyPhoto.js"></script>
    <script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>

    <script src="<?php echo $baseurl ?>/assets/js/sweetalert.js"></script>


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


            $('#example tbody').on('click', 'tr', function() {

                // alert(table.row( this ).data()[0]);

            });
        });
    </script>


    <script>
        var _gaq = [
            ['_setAccount', 'UA-XXXXX-X'],
            ['_trackPageview']
        ];
        (function(d, t) {
            var g = d.createElement(t),
                s = d.getElementsByTagName(t)[0];
            g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g, s)
        }(document, 'script'));
        // Colorbox Call
        $(document).ready(function() {
            $("[rel^='lightbox']").prettyPhoto();
        });

        $(document).ready(function() {
            $('#table_id').DataTable();
        });

        $('#announcement').click(function() {
            var date = $(this).attr('data-date');
            var title = $(this).attr('data-title');
            var message = $(this).attr('data-message');

            $('#date').val(date);
            $('#title').val(title);
            $('#message').val(message);

        });
    </script>



    <script type="text/javascript">
        function delete_play(url) {
            // alert(url);
            //alert('hello');
            Swal.fire({
                title: 'Are you sure you want to delete ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes',
                cancelButtonColor: '#FF0000',
                cancelButtonText: 'No',


            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
    <!-- image gallery script end -->
</body>

</html>
<script src="<?php echo $baseurl ?>/assets/js/sweetalert.js"></script>