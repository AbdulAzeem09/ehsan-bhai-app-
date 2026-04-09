<?php

require_once("../../univ/baseurl.php");
include '../../mlayer/_country.class.php';
include '../../mlayer/_state.class.php';
include '../../mlayer/_city.class.php';


session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "dashboard/";
    include_once("../../authentication/islogin.php");

} else {
    function sp_autoloader($class)
    {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $pageactive = 71;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php include('../../component/f_links.php'); ?>
        <!--This script for posting timeline data End-->
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- ===========PAGE SCRIPT==================== -->
        <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
        <style>


            body {

                background-color: #eee;
            }

            #example_length, #example_info, #example_paginate {
                display: none !important;
            }

            table th, table td {
                text-align: center;
            }

            table tr:nth-child(even) {
                background-color: #e4e3e3
            }

            th {
                background: #333;
                color: #fff;
            }

            .pagination {
                margin: 0;
            }

            .pagination li:hover {
                cursor: pointer;
            }

            .header_wrap {
                padding: 30px 0;
            }

            .num_rows {
                width: 20%;
                float: left;
            }

            .tb_search {
                width: 20%;
                float: right;
            }

            .pagination-container {
                width: 70%;
                float: left;
                /*display: none;*/
            }

            .rows_count {
                width: 20%;
                float: right;
                text-align: right;
                color: #999;
            }


            .tagLine-max-char {

                font-size: smaller;
                font-weight: 600;

            }

            .dataTables_filter {
                margin-bottom: 3px;
                /*display: none;*/
            }

            .dataTables_empty {
                text-align: center !important;
            }

        </style>
    </head>
    <body class="bg_gray" onload="pageOnload('details')">
    <?php

    // include_once("../../views/common/header.php");

    include_once("../../header.php");
    include('../../classes/base.php');
    include_once('../../mlayer/_country.class.php');
    include_once('../../mlayer/_state.class.php');
    include_once('../../mlayer/_city.class.php');




    //    $t = new EditProfile();
    //    $row  = $edit->fetchUserData($_SESSION["pid"]);

    ?>

    <section class="">
        <div class="container-fluid no-padding">
            <div class="row">
                <!-- left side bar -->
                <div class="col-md-2 no_pad_right">
                    <?php
                    ;
                    include('../../component/left-dashboard.php');
                    ?>
                </div>
                <!-- main content -->
                <div class="col-md-10 no_pad_left">
                    <div class="rightContent">

                        <!-- breadcrumb -->
                        <!--   <section class="content-header">
<h1>My Selling Product</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl . '/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">My Selling Product</li>
</ol>
</section>-->


                        <style>
                            .smalldot {
                                width: 100px;
                                overflow: hidden;
                                display: inline-block;
                                text-overflow: ellipsis;
                                white-space: nowrap;
                            }

                            /* Style the tab */
                            .tab {
                                overflow: hidden;
                                border: 1px solid #ccc;
                                background-color: #f1f1f1;
                            }

                            /* Style the buttons that are used to open the tab content */
                            .tab button {
                                background-color: inherit;
                                float: left;
                                border: none;
                                outline: none;
                                cursor: pointer;
                                padding: 14px 16px;
                                transition: 0.3s;
                            }

                            /* Change background color of buttons on hover */
                            .tab button:hover {
                                background-color: #ddd;
                            }

                            /* Create an active/current tablink class */
                            .tab button.active {
                                background-color: #ccc;
                            }

                            /* Style the tab content */
                            .tabcontent {
                                display: none;
                                padding: 6px 12px;
                                border: 1px solid #ccc;
                                border-top: none;
                            }

                            td, th {
                                border: 1px solid #dddddd;

                            }

                        </style>


                        <div class="content">
                            <div class="col-sm-12 ">

                                <div class="row">


                                    <div class="col-sm-12 ">
                                        <div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">

                                            <div class="panel-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active" id="tab1warning">

                                                        <link rel='stylesheet'
                                                              href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

                                                        <style type="text/css">
                                                            .paginate_button {
                                                                border-radius: 0 !important;
                                                            }
                                                        </style>
                                                        <?php $u = new _spuser;
                                                        $res = $u->read($_SESSION["uid"]);
                                                        //echo $u->ta->sql;
                                                        if ($res != false) {
                                                            $ruser = mysqli_fetch_assoc($res);
                                                            $userrefferalcode = $ruser["userrefferalcode"];
                                                        }


                                                        $reffral = $u->readrefferaluser($userrefferalcode);

                                                        //echo $u->ta->sql;
                                                        if ($reffral != false) {
                                                            $aa = 'example1';

                                                        } else {
                                                            $aa = '';
                                                        }
                                                        ?>
                                                        <div class="col-sm-12 no-padding">
                                                            <span style="text-align:center;"><h4>My Referrals</h4></span>


                                                            <div class="container-fluid">

                                                                <div class="table-responsive1">
                                                                    <table class="table table-striped table-class"
                                                                           id="example" style="width: 100%;">
                                                                        <!-- <table class="table tbl_store_setting display" id="<?php echo $aa; ?>" cellspacing="0" width="100%" > -->
                                                                        <thead>
                                                                        <tr>

                                                                            
                                                                            <th style="font-size: 15px !important;">User
                                                                                Name
                                                                            </th>
                                                                            <th style="font-size: 15px !important;">
                                                                                Registered On
                                                                            </th>
                                                                            <th style="font-size:15px !important;">Location</th>


                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        $limit = 10;
                                                                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                                                        $page = max($page, 1);
                                                                        $offset = ($page - 1) * $limit;

                                                                        $u = new _spuser;
                                                                        $res = $u->read($_SESSION["uid"]);
                                                                        if ($res != false) {
                                                                            $ruser = mysqli_fetch_assoc($res);
                                                                            $userrefferalcode = $ruser["userrefferalcode"];
                                                                        }

                                                                        // Get total number of referral users
                                                                        $conn = _data::getConnection();
                                                                        $total_sql = "SELECT COUNT(*) as total FROM spuser WHERE refferalcodeused = '$userrefferalcode'";
                                                                        $total_res = mysqli_query($conn, $total_sql);
                                                                        $total_row = mysqli_fetch_assoc($total_res);
                                                                        $total = $total_row['total'];
                                                                        $total_pages = ceil($total / $limit);

                                                                        // Fetch paginated data
                                                                        $reffral = $u->readrefferaluserPaginated($userrefferalcode, $limit, $offset);

                                                                        if ($reffral) {
                                                                            $i = $offset + 1;
                                                                            while ($refuser = mysqli_fetch_assoc($reffral)) {
                                                                                $pro = new _spprofiles;
                                                                                $prores = $pro->readDefaultProfile($refuser['idspUser']);
                                                                                if ($prores) {
                                                                                    $profiledata = mysqli_fetch_assoc($prores);
                                                                                }
                                                                                ?>
                                                                                <tr>
                                                                                
                                                                                    <td>
                                                                                        <a href="<?php echo $BaseUrl . '/friends/?profileid=' . $profiledata['idspProfiles']; ?>">
                                                                                            <?php echo ucfirst($refuser['spUserName']); ?></a>
                                                                                    </td>
                                                                                    <td><?php echo date("Y-m-d H:i:s", strtotime($refuser['spUserRegDate'])); ?></td>
                                                                                    <td>
                                                                                        <?php
                                                                                        $countryName = $stateName = $cityName = 'N/A';

                                                                                        $c = new _country();
                                                                                        $s = new _state();
                                                                                        $ct = new _city();

                                                                                        // Check and fetch country name
                                                                                        if (!empty($refuser['spUserCountry'])) {
                                                                                            $countryRes = $c->readCountryName($refuser['spUserCountry']);
                                                                                            if ($countryRes && $countryRow = mysqli_fetch_assoc($countryRes)) {
                                                                                                $countryName = !empty($countryRow['country_title']) ? $countryRow['country_title'] : 'N/A';
                                                                                            }
                                                                                        }

                                                                                        // Check and fetch state name
                                                                                        if (!empty($refuser['spUserState'])) {
                                                                                            $stateRes = $s->readStateName($refuser['spUserState']);
                                                                                            if ($stateRes && $stateRow = mysqli_fetch_assoc($stateRes)) {
                                                                                                $stateName = !empty($stateRow['state_title']) ? $stateRow['state_title'] : 'N/A';
                                                                                            }
                                                                                        }

                                                                                        // Check and fetch city name
                                                                                        if (!empty($refuser['spUserCity'])) {
                                                                                            $cityRes = $ct->readCityName($refuser['spUserCity']);
                                                                                            if ($cityRes && $cityRow = mysqli_fetch_assoc($cityRes)) {
                                                                                                $cityName = !empty($cityRow['city_title']) ? $cityRow['city_title'] : 'N/A';
                                                                                            }
                                                                                        }

                                                                                        echo htmlspecialchars("$countryName, $stateName, $cityName");
                                                                                        ?>
                                                                                    </td>


                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <tr>
                                                                                <td colspan="3" class="text-center">No
                                                                                    Referral User Found
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        </tbody>

                                                                    </table>

                                                                    <?php if ($total_pages > 1): ?>
                                                                        <nav aria-label="Page navigation"
                                                                             style="text-align: center; margin-top: 10px;">
                                                                            <ul class="pagination justify-content-center">
                                                                                <?php if ($page > 1): ?>
                                                                                    <li class="page-item">
                                                                                        <a class="page-link"
                                                                                           href="?page=<?php echo $page - 1; ?>"
                                                                                           aria-label="Previous">
                                                                                            <span aria-hidden="true">&laquo;</span>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php endif; ?>

                                                                                <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                                                                                    <li class="page-item <?php if ($p == $page) echo 'active'; ?>">
                                                                                        <a class="page-link"
                                                                                           href="?page=<?php echo $p; ?>"><?php echo $p; ?></a>
                                                                                    </li>
                                                                                <?php endfor; ?>

                                                                                <?php if ($page < $total_pages): ?>
                                                                                    <li class="page-item">
                                                                                        <a class="page-link"
                                                                                           href="?page=<?php echo $page + 1; ?>"
                                                                                           aria-label="Next">
                                                                                            <span aria-hidden="true">&raquo;</span>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php endif; ?>
                                                                            </ul>
                                                                        </nav>
                                                                    <?php endif; ?>
                                                                    s

                                                                    <!--		Start Pagination -->
                                                                    <div class='pagination-container'>
                                                                        <nav>
                                                                            <ul class="pagination">
                                                                                <!--	Here the JS Function Will Add the Rows -->
                                                                            </ul>
                                                                        </nav>
                                                                    </div>

                                                                </div> <!-- 		End of Container -->


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
                                                    <!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
                                                    <!--<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script> -->



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
    </section>


    <?php include('../../component/f_footer.php'); ?>
    <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
                                                    <?php include('../../component/f_btm_script.php'); ?>


                                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
                                                    <script type="text/javascript">
                                                        $(document).ready(function () {
                                                            var table = $('#example').DataTable({
                                                                paging: true, // Enable pagination
                                                                select: false,
                                                               
                                                            });

                                                            $('#example tbody').on('click', 'tr', function () {
// Handle row click event here
                                                            });
                                                        });
                                                    </script>


                                                    <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
                                                    <!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


    </body>
    </html>
    <?php
} ?>


<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<script>

    getPagination('#table-id');
    $('#maxRows').trigger('change');

    function getPagination(table) {

        $('#maxRows').on('change', function () {
            $('.pagination').html('');						// reset pagination div
            var trnum = 0;									// reset tr counter
            var maxRows = parseInt($(this).val());			// get Max Rows from select option

            var totalRows = $(table + ' tbody tr').length;		// numbers of rows
            $(table + ' tr:gt(0)').each(function () {			// each TR in  table and not the header
                trnum++;									// Start Counter
                if (trnum > maxRows) {						// if tr number gt maxRows

                    $(this).hide();							// fade it out
                }
                if (trnum <= maxRows) {
                    $(this).show();
                }// else fade in Important in case if it ..
            });											//  was fade out to fade it in
            if (totalRows > maxRows) {						// if tr total rows gt max rows option
                var pagenum = Math.ceil(totalRows / maxRows);	// ceil total(rows/maxrows) to get ..
//	numbers of pages
                for (var i = 1; i <= pagenum;) {			// for each page append pagination li
                    $('.pagination').append('<li data-page="' + i + '">\
<span>' + i++ + '<span class="sr-only">(current)</span></span>\
</li>').show();
                }											// end for i


            } 												// end if row count > max rows
            $('.pagination li:first-child').addClass('active'); // add active class to the first li


//SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
            showig_rows_count(maxRows, 1, totalRows);
//SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

            $('.pagination li').on('click', function (e) {		// on click each page
                e.preventDefault();
                var pageNum = $(this).attr('data-page');	// get it's number
                var trIndex = 0;							// reset tr counter
                $('.pagination li').removeClass('active');	// remove active class from all li
                $(this).addClass('active');					// add active class to the clicked


//SHOWING ROWS NUMBER OUT OF TOTAL
                showig_rows_count(maxRows, pageNum, totalRows);
//SHOWING ROWS NUMBER OUT OF TOTAL


                $(table + ' tr:gt(0)').each(function () {		// each tr in table not the header
                    trIndex++;								// tr index counter
// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
                    if (trIndex > (maxRows * pageNum) || trIndex <= ((maxRows * pageNum) - maxRows)) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    } 				//else fade in
                }); 										// end of for each tr in table
            });										// end of on click pagination list
        });
// end of on select change

// END OF PAGINATION

    }


    // SI SETTING
    $(function () {
// Just to append id number for each row
        default_index();

    });

    //ROWS SHOWING FUNCTION
    function showig_rows_count(maxRows, pageNum, totalRows) {
//Default rows showing
        var end_index = maxRows * pageNum;
        var start_index = ((maxRows * pageNum) - maxRows) + parseFloat(1);
        var string = 'Showing ' + start_index + ' to ' + end_index + ' of ' + totalRows + ' entries';
        $('.rows_count').html(string);
    }


    // All Table search script
    function FilterkeyWord_all_table() {

// Count td if you want to search on all table instead of specific column

        var count = $('.table').children('tbody').children('tr:first-child').children('td').length;

// Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("search_input_all");
        var input_value = document.getElementById("search_input_all").value;
        filter = input.value.toLowerCase();
        if (input_value != '') {
            table = document.getElementById("table-id");
            tr = table.getElementsByTagName("tr");

// Loop through all table rows, and hide those who don't match the search query
            for (i = 1; i < tr.length; i++) {

                var flag = 0;

                for (j = 0; j < count; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {

                        var td_text = td.innerHTML;
                        if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
//var td_text = td.innerHTML;
//td.innerHTML = 'shaban';
                            flag = 1;
                        } else {
//DO NOTHING
                        }
                    }
                }
                if (flag == 1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        } else {
//RESET TABLE
            $('#maxRows').trigger('change');
        }
    }
</script>


