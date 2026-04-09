<?php
include ('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-groups/";
    include_once ("../authentication/check.php");
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
        <?php include ('../component/f_links.php'); ?>
        <link href="<?php echo $BaseUrl ?>/assets/css/date-time/bootstrap-datetimepicker.css" rel="stylesheet"
            media="screen">
        <link href="<?php echo $BaseUrl ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet"
            media="screen">
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/group_inner.css">

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
        <?php include ('../header.php'); ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">

                        <div class="group-wrapper">
                            <div class="side-bar" id="side-bar">
                                <?php include ('../component/left-group.php'); ?>
                            </div>

                            <div class="group-body-wrapper" id="ip6">
                                <div class="email " id="ip6">
                                    <div class="main-heading" id="id">
                                        <div class="top-heading">
                                            <ol class="mb-0">
                                                <li class="d-flex">
                                                    <a style="color: black;"
                                                        href="<?php echo $BaseUrl; ?>/grouptimelines/emailReport.php?groupid=<?php echo $_GET['groupid'] ?>&groupname=<?php echo $_GET['groupname'] ?>&emailCampaigns">Reports</a>
                                                    <p class="mb-0">/</p>
                                                    <a style="color: black;"
                                                        href="<?php echo $BaseUrl; ?>/grouptimelines/addEmail.php?groupid=<?php echo $_GET['groupid'] ?>&groupname=<?php echo $_GET['groupname'] ?>&emailCampaigns">
                                                        Email Campaign
                                                    </a>
                                                </li>

                                            </ol>
                                        </div>
                                    </div>
                                    <link rel='stylesheet'
                                        href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
                                    <div class="table-wrapper">
                                        <table id="example">
                                            <thead style="background-color: white !important;">
                                                <tr style="background-color: while !important;">
                                                    <th style="color:black"></th>
                                                    <th style="color:black">Campaign Name</th>
                                                    <th style="color:black">Date/Time</th>
                                                    <th style="color:black">Total Members Send</th>
                                                    <th style="color:black">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $g = new emailEmailCampaign;
                                                $result2 = $g->getemailEmailCampaign($_SESSION['uid'], 'Email');
                                                if ($result2 != false) {
                                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                        <tr>
                                                            <td style="padding-left: 20px;"></td>
                                                            <td><span class="read-more"><?php echo $row2['name']; ?></span></td>
                                                            <td><?php echo $row2['date']; ?><br><?php date('H:i', strtotime($row2['time'])); ?>
                                                            </td>
                                                            <td></td>
                                                            
                                                            <td class="action">
                                                                <img style="back-ground:white;" src="../assets/images/inner_group/dot-2.svg" alt="" class="option-icon"
                                                                    onclick="threeDot(this)">
                                                                <div class="more-links" id="three-dot" style="display: none;">
                                                                    <div class="link p-0" data-bs-toggle="modal"
                                                                        data-bs-target="#cam-view">
                                                                        <span class="img">
                                                                            <img src="../assets/images/inner_group/view.svg" alt="">
                                                                        </span>
                                                                        <span>View</span>
                                                                    </div>
                                                                    <div class="link p-0">
                                                                        <span class="img" style="padding-left: 4px;">
                                                                            <img src="../assets/images/inner_group/delete.svg" alt="">
                                                                        </span>
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </div>
                                                            </td>
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
        </section>
        <?php
        include ('../component/f_footer.php');
        include ('../component/f_btm_script.php');
        ?>
    </body>

    </html>

    <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

    <script type="text/javascript">
        $(document).ready(function () {

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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dataTablesInfo = document.getElementsByClassName("dataTables_info")[0];
        const dataTablesLength = document.getElementsByClassName("dataTables_length")[0];
        const dataTablesFilter = document.querySelector("#example_filter input[type='search']");

        dataTablesFilter.setAttribute('placeholder', 'Search here...');

        const div = document.createElement('div');
        div.classList.add('datafilter-search-icon');

        const img = document.createElement('img');

        img.src = '../assets/images/inner_group/search-3.svg';

        img.alt = 'Search icon';

        div.appendChild(img);

        dataTablesFilter.parentNode.appendChild(div);

        if (dataTablesInfo && dataTablesLength) {
            dataTablesInfo.style.display = 'none';
            dataTablesInfo.parentNode.insertBefore(dataTablesLength, dataTablesInfo);
            dataTablesInfo.parentNode.insertBefore(dataTablesLength, dataTablesInfo);
            dataTablesLength.style.display = 'block';
        }
    });

    function threeDot(dot) {
        // Get the parent element of the dot to scope the menu finding
        var parent = dot.closest('td');

        // Get the 'more-links' div within this parent
        var moreLinks = parent.querySelector('.more-links');

        // Find all open 'more-links' divs
        var openMenus = document.querySelectorAll('.more-links:not([style*="display: none"])');

        // Close all other open menus
        openMenus.forEach(function (menu) {
            if (menu !== moreLinks) {
                menu.style.display = 'none';
            }
        });

        // Toggle the display of the 'more-links' div for the clicked dot
        if (moreLinks.style.display === 'none' || moreLinks.style.display === '') {
            moreLinks.style.display = 'block';
        } else {
            moreLinks.style.display = 'none';
        }
    }

    // Optional: Close the menu when clicking outside of it
    document.addEventListener('click', function (event) {
        var isClickInside = event.target.closest('.action') || event.target.closest('.more-links');

        if (!isClickInside) {
            // Hide all 'more-links' divs
            document.querySelectorAll('.more-links').forEach(function (element) {
                element.style.display = 'none';
            });
        }
    });
</script>