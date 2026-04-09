<?php
//require_once('../common.php');
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
session_start();
include('../univ/baseurl.php');

if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "job-board/";
    include_once("../authentication/check.php");
} else {

    function sp_autoloader($class)
    {
    include '../mlayer/' . $class . '.class.php';

    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";

    if (empty($_SESSION['Countryfilter'])) {
        $p = new _spprofiles;
        $res = $p->read($_SESSION["pid"]);
        if ($res != false) {
            $puser = mysqli_fetch_assoc($res);
            $_SESSION['Countryfilter'] = $puser["spProfilesCountry"];
            $_SESSION['Statefilter'] = $puser["spProfilesState"];
            $_SESSION['Cityfilter'] = $puser["spProfilesCity"];
        }
    }

    if (isset($_POST['Change_Current_Location'])) {
        $_SESSION["Countryfilter"] = $_POST['spUserCountry'];
        $_SESSION["Statefilter"] = $_POST['spUserState'];
        $_SESSION["Cityfilter"] = $_POST['spUserCity'];
        echo "<script>window.location.href = '/job-board/index.php'</script>";
        die();
    }

    if (isset($_POST['Closeresetlocation'])) {
        unset($_SESSION['Countryfilter']);
        unset($_SESSION['Statefilter']);
        unset($_SESSION['Cityfilter']);
    } 

    $p = new _classified;

    $r = $p->read($_GET["postid"] ?? 0);
    if ($r != false) {
        while ($row = mysqli_fetch_assoc($r)) {
            $usercountry = $row['spPostCountry'];
            $userstate = $row['spUserState'];
            $usercity = $row['spUserCity'];
        }
    }

    ########## Job Details code #############
    $_GET["categoryid"] = $_GET['categoryID'] = "2";
    $_GET["categoryName"] = "Job Board";

    $f = new _spprofiles;
    $sl = new _shortlist;
    $page = "jobBoard";

    include_once("../views/common/header.php");

?>

<script>
$(document).ready(function() {

    var filters = {
        user: null,
        status: null,
        milestone: null,
        priority: null,
        tags: null
    };


    function updateFilters() {
        $('.task-list-row').hide().filter(function() {
            var
                self = $(this),
                result = true; // not guilty until proven guilty

            Object.keys(filters).forEach(function(filter) {
                if (filters[filter] && (filters[filter] != 'None') && (filters[filter] !=
                    'Any')) {
                    result = result && filters[filter] === self.data(filter);
                }
            });

            return result;
        }).show();

        tableRowCount()
    }

    function tableRowCount() {
        var numOfVisibleRows = $('tr:visible').length;
        if (numOfVisibleRows == 0) {
            document.getElementById('no_result').style.display = '';

        } else {
            document.getElementById('no_result').style.display = 'none';

        }

    }


    function changeFilter(filterName) {
        filters[filterName] = this.value;
        updateFilters();
    }

    // Assigned User Dropdown Filter
    $('#job-level-filter').on('change', function() {
        changeFilter.call(this, 'user');
    });

    // Task Status Dropdown Filter
    $('#job-type-filter').on('change', function() {
        changeFilter.call(this, 'status');
    });

    // Task Milestone Dropdown Filter
    $('#salary-filter').on('change', function() {
        changeFilter.call(this, 'milestone');
    });


    /*alert();*/

    $("#basic-addon2").click(function() {

        // alert("heree");

        var txtJobTitle = $("#txtJobTitle").val();
        var txtJobLoc = $("#txtJobLoc").val();

        //alert(txtJobTitle);

        if (txtJobTitle == "" || txtJobLoc == "") {

            $("#title_err").text("This Fileld is Required.");
            // $("#loc_err").text("Please Enter Location.");

            return false;

        } else {
            $("#job_search").submit();
        }

    });
    /* $('#horizontalTab').easyResponsiveTabs({
    type: 'default', //Types: default, vertical, accordion
    width: 'auto', //auto or any width like 600px
    fit: true, // 100% fit in a container
    closed: 'accordion', // Start closed if in accordion view
    activate: function(event) { // Callback function if tab is switched
    var $tab = $(this);
    var $info = $('#tabInfo');
    var $name = $('span', $info);
    $name.text($tab.text());
    $info.show();
    }
    }); */
});

function getaddress() {
    var address = $("#txtJobLoc").val();
    $.ajax({
        type: "POST",
        url: "../address.php",
        cache: false,
        data: {
            'address': address
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj
                .address + '</option>');
            $("#latitude").val(obj.latitude);
            $("#longitude").val(obj.longitude);

        }
    });
}
// Job Details code
function printContent(el) {
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
// Job Details code End
</script>

<div class="body-wrapper">
    <div class="job-wrapper">
        <div class="job-body-wrapper">
            <div class="top-name">
                Job
            </div>
            <div class="filters company-news-filter">
                <form class="job_search" id="job_search" method="post" action="/job-board/">
                    <div class="search-box">

                        <input type="text" placeholder="Search Job by keyword" name="txtJobTitle" id="txtJobTitle"
                            value="<?php echo $_POST['txtJobTitle'] ?? ""; ?>">
                        <div class="search-icon" id="basic-addon2">
                            <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/search-3.svg" alt="">
                        </div>

                    </div>
                </form>
                <?php 
                  if(trim($_SESSION['ptname'])=='Business'){
                  ?>
                    <a href='../job-employee/dashboard.php' class="add-btn"
                        style="text-align: center;padding: 7px;text-decoration: none;">
                        Dashboard
                    </a>
                <?php }else if(trim($_SESSION['ptname'])=='Employment'){ ?>
                    <a href='../job-seeker/dashboard.php' class="add-btn"
                        style="text-align: center;padding: 7px;text-decoration: none;">
                        Dashboard
                    </a>
                <?php }else{ ?>
                    <div>
                        <button class="add-btn" data-bs-toggle="modal" data-bs-target="#non-employees">
                            Post a Job
                        </button>
                        &nbsp;
                        <button class="add-btn" data-bs-toggle="modal" data-bs-target="#non-emp-bussiness">
                            Dashboard
                        </button>
                    </div>
                    <div class="modal" id="non-employees">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                               <p>Only Business profile can post a job. Please create or switch to your Business Profile.</p>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal" id="non-emp-bussiness">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                               <p>Please  switch to your Employment or Bussiness Profile to visit the dashboard.</p>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="filter-2 filters company-news-filter">
                <form class="job_search" id="job_search" action="/job-board/">
                    <div class="left">
                        <div class="input-group">
                            <label>Job Type</label>
                            <select name="jobtype" class="form-select">
                                <option value="">Job type</option>
                                <option <?php if ($_GET['jobtype'] == 'Remote') { echo 'selected';} ?> value="Remote">Remote</option>
                                <option <?php if ($_GET['jobtype'] == 'ON SITE') { echo 'selected';} ?> value="ON SITE">ON SITE</option>
                                <option <?php if ($_GET['jobtype'] == 'HYBRID') { echo 'selected';} ?> value="HYBRID">HYBRID</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Job Level</label>
                            <select name="joblevel" class="form-select">
                                <option value="">Job Level </option>
                                <option value="Full-time" <?php echo ( isset($_GET['joblevel']) && $_GET['joblevel'] =='Full-time' ? "selected" : '' ) ?>>Full-time</option>
                                <option value="Part-time" <?php echo ( isset($_GET['joblevel']) && $_GET['joblevel'] =='Part-time' ? "selected" : '' ) ?>>Part-time</option>
                                <option value="Contract" <?php echo ( isset($_GET['joblevel']) && $_GET['joblevel'] =='Contract' ? "selected" : '' ) ?>>Contract</option>
                                <option value="Temporary" <?php echo ( isset($_GET['joblevel']) && $_GET['joblevel'] =='Temporary' ? "selected" : '' ) ?>>Temporary</option>
                                <option value="Internship" <?php echo ( isset($_GET['joblevel']) && $_GET['joblevel'] =='Internship' ? "selected" : '' ) ?>>Internship</option>
                                <!-- <?php
                                    // $jl = new _spAllStoreForm;
                                    // $result2 = $jl->readJobLevel();
                                    // if ($result2) {
                                    //     while ($row2 = mysqli_fetch_assoc($result2)) {
                                    //     ?>
                                    //         <option <?php //if ($_GET['joblevel'] == $row2['jobLevelTitle']) { echo 'selected';} ?> value="<?php //echo $row2['jobLevelTitle']; ?>" <?php //if (isset($jobLevel)) {
                                    //         if ($jobLevel == $row2["jobLevelTitle"]) {
                                    //             echo 'selected';
                                    //         }
                                    //     } ?>><?php //echo $row2['jobLevelTitle']; ?></option>
                                    //         <?php
                                    //     }
                                    // }
                                ?> -->
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Salary Range</label>
                            <select name="salaryrange" class="form-select">
                                <option value="">Salary Range</option>
                                <option <?php if ($_GET['salaryrange'] == 'u100') {
                                echo 'selected';
                                } ?> value="u100">Under 100</option>
                                    <option <?php if ($_GET['salaryrange'] == 'o100') {
                                echo 'selected';
                                } ?> value="o100">Over 100</option>
                                    <option <?php if ($_GET['salaryrange'] == 'o500') {
                                echo 'selected';
                                } ?> value="o500">Over 500</option>
                                    <option <?php if ($_GET['salaryrange'] == 'o1000') {
                                echo 'selected';
                                } ?> value="o1000">Over 1000</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <button type="submit" value="" class="clear" name="searchforstorebtn"
                                style="border-radius: 75px">Filter</button>
                            <a href="<?php echo $BaseUrl . '/job-board'; ?>" style="margin-left:5px">Clear</a>
                        </div>
                        <div class="change-location">
                            <div class="change-location-btn" class="change-location-btn" data-bs-toggle="modal"
                                data-bs-target="#change-location">
                                Change Location</div>
                            <div class="location">
                                <?php
                            $usercountry = $_SESSION["Countryfilter"];
                            $userstate = $_SESSION["Statefilter"];
                            $usercity = $_SESSION["Cityfilter"];

                            $co = new _country;
                            $result3 = $co->readCountry();
                            if ($result3 != false) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if (isset($usercountry) && $usercountry == $row3['country_id']) {
                                $currentcountry = $row3['country_title'];
                                $currentcountry_id = $row3['country_id'];
                                }
                            }
                            }

                            if (isset($userstate) && $userstate > 0) {
                            $countryId = $currentcountry_id;
                            $pr = new _state;
                            $result2 = $pr->readState($countryId);
                            if ($result2 != false) {
                                while ($row2 = mysqli_fetch_assoc($result2)) { //print_r($row2);
                                //die('===');
                                if (isset($userstate) && $userstate == $row2["state_id"]) {
                                    $currentstate_id = $row2["state_id"];
                                    $currentstate = $row2["state_title"];
                                }
                                }
                            }
                            }
                            if (isset($usercity) && $usercity > 0) {
                            $stateId = $currentstate_id;
                            $co = new _city;
                            $result3 = $co->readCity($stateId);
                            //echo $co->ta->sql;
                            if ($result3 != false) {
                                while ($row3 = mysqli_fetch_assoc($result3)) { //print_r($row3);
                                if (isset($usercity) && $usercity == $row3['city_id']) {
                                    $currentcity = $row3['city_title'];
                                    $currentcity_id = $row3['city_id'];
                                }
                                }
                            }
                            };
                            ?>
                                <!--Current Location: -->
                            <?php
                            $currentLocation = '';
                            if ($currentcity) {
                            $currentLocation .= $currentcity . ', ';
                            }
                            if ($currentstate) {
                            $currentLocation .= $currentstate . ', ';
                            }
                            if ($currentcountry) {
                            $currentLocation .= $currentcountry;
                            }
                            echo $currentLocation;
                            ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="main-wrapper">
                <div class="job-list" id="post-data">
                    <!-- Start code -->
                    <input type="hidden" name="currentPage" id="currentPage" value="1">
                    <?php
                    $joblevelfilter = "";
                    $jobtypefilter = "";
                    $startenddate = "";
                    $salaryrangefilter = "";
                    $Countryfilter = "";
                    $Statefilter = "";
                    $Cityfilter = "";

                    $page_limit = 10;  
                    if (isset($_GET["currentPage"]))  
                    { 
                        $page_number  = $_GET["currentPage"]; 
                    } else { 
                        $page_number=1; 
                    };  
                    $initial_page = ($page_number-1) * $page_limit;

                    $limit = "100";
                    /*$p   = new _postingview;*/
                    $p   = new _jobpostings;
                    $pf  = new _postfield;

                    $txtJobTitle = $_POST['txtJobTitle'] ?? "";
                    //$txtJobLoc = $_POST['txtJobLoc'];

                    if (isset($_GET['salaryrange'])) {
                        if (!empty($_GET['salaryrange'])) {
                            $salaryrange = $_GET['salaryrange'];
                            $_SESSION["salaryrange"] = $_GET['salaryrange'];
                            if ($salaryrange == 'u100') {
                                $salaryrangefilter = "AND spPostingSlryRngFrm <= 100";
                            }
                            if ($salaryrange == 'o100') {
                                $salaryrangefilter = "AND spPostingSlryRngFrm >= 100";
                            }
                            if ($salaryrange == 'o500') {
                                $salaryrangefilter = "AND spPostingSlryRngFrm >= 500";
                            }
                            if ($salaryrange == 'o1000') {
                                $salaryrangefilter = "AND spPostingSlryRngFrm >= 1000";
                            }
                        }
                    }
                    else{
                        unset($_SESSION['salaryrange']);
                    }

                    if (isset($_GET['jobtype'])) {
                        if (!empty($_GET['jobtype'])) {
                            $jobtype = $_GET['jobtype'];
                            $_SESSION["jobtype"] = $_GET['jobtype'];
                            $jobtypefilter = "AND spPostingLocation = '$jobtype'";
                        }
                    } else{
                        unset($_SESSION['jobtype']);
                    }
                    if (isset($_GET['joblevel'])) {
                        if (!empty($_GET['joblevel'])) {
                            $joblevel = $_GET['joblevel'];
                            $_SESSION["joblevel"] = $_GET['joblevel'];
                            $joblevelfilter = "AND spPostingJobType = '$joblevel'";
                        }
                    } else{
                        unset($_SESSION['joblevel']);
                    }
                    //die("================================");

                    if (isset($_GET['searchforstorebtn'])) {
                        if (!empty($_GET['fromdate'])) {
                            //echo $_GET['todate']; die;
                            $fromdate = $_GET['fromdate'];
                            //$todate = $_GET['todate'];
                            $da = explode('/', $fromdate);
                            //$da1=explode('/',$todate);

                            $vdate1 = $da[2] . '-' . $da[1] . '-' . $da[0];
                            //$vdate2= $da1[2].'-'.$da1[1].'-'.$da1[0];
                            $vdate1 = substr($vdate1, 2); // "quick brown fox jumps over the lazy dog."

                            $startenddate = "AND spPostingDate LIKE '$vdate1%' ";
                            //$startenddate = "AND spPostingDate BETWEEN '$vdate1' AND '$vdate2'"; 
                        }
                        if (isset($_SESSION['Countryfilter'])) {
                            if (!empty($_SESSION['Countryfilter'])) {
                                $ccff = $_SESSION['Countryfilter'];
                                $Countryfilter = "AND spPostingsCountry = $ccff";
                            }
                        }

                        if (isset($_SESSION['Statefilter'])) {
                            if (!empty($_SESSION['Statefilter'])) {
                                $ssf = $_SESSION['Statefilter'];
                                $Statefilter = "AND spPostingsState = $ssf";
                            }
                        }

                        if (isset($_SESSION['Cityfilter'])) {
                            if (!empty($_SESSION['Cityfilter'])) {
                                $ciicff = $_SESSION['Cityfilter'];
                                $Cityfilter = "AND spPostingsCity = $ciicff";
                            }
                        }
                        $limit = "10000";
                        $category = 2; //{$Cityfilter}
                        // Briskbrain 1
                        $qry1 = "WHERE t.spPostingVisibility=-1 AND flag_status=2 AND t.spPostingExpDt >= CURDATE()  $startenddate $jobtypefilter $Countryfilter $Statefilter $Cityfilter $joblevelfilter $salaryrangefilter AND t.spCategories_idspCategory = " . $category. " ORDER BY spPostingDate DESC";
                        $res_total = $p->readJobs($qry1);
                        $qry = "WHERE t.spPostingVisibility=-1 AND flag_status=2 AND t.spPostingExpDt >= CURDATE()  $startenddate $jobtypefilter $Countryfilter $Statefilter $Cityfilter $joblevelfilter $salaryrangefilter AND t.spCategories_idspCategory = " . $category. " ORDER BY spPostingDate DESC LIMIT $initial_page, $page_limit";
                        $res = $p->readJobs($qry);      
                        //$res = $p->publicpost_jobBoardwithfilter($limit, 2, $startenddate, $jobtypefilter, $joblevelfilter, $salaryrangefilter, $Countryfilter, $Statefilter, $Cityfilter);

                        // echo $p->ta->sql;
                        // echo "<pre>"; 
                        // print_r($jobtypefilter);
                        // print_r($Countryfilter);
                        // print_r($Statefilter);
                        // print_r($Cityfilter);
                        // print_r($joblevelfilter);
                        // print_r($salaryrangefilter);
                        // die();
                    }
                    else {
                        if (!empty($_POST['txtJobTitle'])) {
                            //die("================================");

                            $_SESSION['jobtitle'] = $txtJobTitle;

                            if (isset($_SESSION['Countryfilter'])) {
                                if (!empty($_SESSION['Countryfilter'])) {
                                    $ccff = $_SESSION['Countryfilter'];
                                    $Countryfilter = "AND spPostingsCountry = $ccff";
                                }
                            }

                            if (isset($_SESSION['Statefilter'])) {
                                if (!empty($_SESSION['Statefilter'])) {
                                    $ssf = $_SESSION['Statefilter'];
                                    $Statefilter = "AND spPostingsState = $ssf";
                                }
                            }


                            if (isset($_SESSION['Cityfilter'])) {
                                if (!empty($_SESSION['Cityfilter'])) {
                                    $ciicff = $_SESSION['Cityfilter'];
                                    $Cityfilter = "AND spPostingsCity = $ciicff";
                                }
                            }
                            // Briskbrain 2
                            $qry1 = "WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $_SESSION['jobtitle']  . "%') AND t.spPostingExpDt >= CURDATE()  $Statefilter $Countryfilter GROUP by idspPostings ORDER BY spPostingDate DESC";
                            $res_total = $p->readJobs($qry1);
                            $qry = "WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $_SESSION['jobtitle']  . "%') AND t.spPostingExpDt >= CURDATE()  $Statefilter $Countryfilter GROUP by idspPostings ORDER BY spPostingDate DESC LIMIT $initial_page, $page_limit";
                            $res = $p->readJobs($qry);
                            $res = $p->readJobSearch($_POST['txtJobTitle'], $Countryfilter, $Statefilter, $Cityfilter);
                        }else {
                            if(!empty($_SESSION['Countryfilter']) && !empty($_SESSION['Statefilter']) && !empty($_SESSION['Cityfilter']) ){
                                if (isset($_SESSION['Countryfilter'])) {
                                    if (!empty($_SESSION['Countryfilter'])) {
                                        $ccff = $_SESSION['Countryfilter'];
                                        $Countryfilter = "AND spPostingsCountry = $ccff";
                                    }
                                }
                                if (isset($_SESSION['Statefilter'])) {
                                    if (!empty($_SESSION['Statefilter'])) {
                                        $ssf = $_SESSION['Statefilter'];
                                        $Statefilter = "AND spPostingsState = $ssf";
                                    }
                                }
                                $limit = -1;
                                $Countryfilter = $_SESSION['Countryfilter'];
                                $Statefilter = $_SESSION['Statefilter'];
                                // BriskBrain 3
                                $qry1 = "WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE() AND t.spPostingsCountry =  $Countryfilter AND t.spPostingsState =  $Statefilter ORDER BY spPostingDate DESC";
                                $res_total = $p->readJobs($qry1);
                                $qry = "WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE() AND t.spPostingsCountry =  $Countryfilter AND t.spPostingsState =  $Statefilter ORDER BY spPostingDate DESC LIMIT $initial_page, $page_limit";
                                $res = $p->readJobs($qry);
                                //$res = $p->publicpost_jobBoard_session($limit, $_SESSION['Countryfilter'], $_SESSION['Statefilter'], $_SESSION['Cityfilter']);
                            }else{
                                // BriskBrain 4
                                $Countryfilter  = $_SESSION['Countryfilter'];
                                $qry1 = "WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE() AND t.spPostingsCountry =  $Countryfilter ORDER BY spPostingDate DESC";
                                $res_total = $p->readJobs($qry1);
                                $qry = "WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE() AND t.spPostingsCountry =  $Countryfilter ORDER BY spPostingDate DESC LIMIT $initial_page, $page_limit";
                                $res = $p->readJobs($qry);
                                //$res_data = selectQ("SELECT * from spjobboard where spPostingsCountry=? and spPostingVisibility=-1 and spPostingExpDt >= CURDATE()", "i", [$Countryfilter]);
                            }
                        }
                    }
                    ?>
                    <div class="right-job-listing123">
                        <h3 id="no_result">
                            <?php
                            $job_count = $res_total->num_rows ?? 0;
                            $txtJobTitle = $_POST['txtJobTitle'] ?? "";

                            if ($txtJobTitle != "") {
                            $keyword = "'" . $txtJobTitle . "'";
                            } else {
                            $keyword = "";
                            }

                            if (!empty($currentcity)) {
                            $city = ' in ' . $currentcity . ', ';
                            } else {
                            $city = "";
                            }
                            if (!empty($currentstate)) {
                            $state = $currentstate;
                            } else {
                            $state = "";
                            }
                            if (!empty($currentcountry)) {
                            $country = ', ' . $currentcountry;
                            } else {
                            $country = "";
                            }
                            if ($job_count > 1) { // :  # jobs found matching keyword "keyword" in city and province name
                            echo $job_count . " jobs found matching the keyword " . $keyword .  '<br><span style="font-size:13px;">'. $city . '' . $state . '' . $country.'</span>';
                            }
                            if ($job_count == 1) {
                            echo $job_count . " job found matching the keyword " . $keyword . '<br><span style="font-size:13px;">'. $city . '' . $state . '' . $country.'</span>';
                            }?>
                        </h3>
                    </div>
                    <?php
                    //echo $p->ta->sql; die;  mostly-customized-scrollbar style="max-height:1000px; overflow:scroll;"
                    if ($res) {
                        $i = 0;
                        $jobID = 0;
                        while ($row = mysqli_fetch_assoc($res)) {
                            if ($row['spuser_idspuser'] != NULL) {
                                $st = new _spuser;
                                $st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
                                if ($st1 != false) {
                                $stt = mysqli_fetch_assoc($st1);
                                $account_status = $stt['deactivate_status'];
                                }
                            }
                            $idposting = $row['idspPostings'];
                            $pf = new _productposting;
                            $flagcmd = $pf->flagcount(2, $idposting);
                            $flagnums = $flagcmd->num_rows ?? false;
                            if ($flagnums == '9') {
                                $updatestatus = $pf->jobboardstatus($idposting);                                
                            }
                            $postingDate = $row["spPostingDate"];
                            $skill = $row["spPostingSkill"];
                            // ========================END======================
                            
                            if ($account_status != 1) {
                                
                                $i++;
                                if($i == 1)
                                {
                                    $jobID = $row['idspPostings'];
                                }                            
                            ?>
                                <div class="job<?php if($i == 1) echo " job-active";?>" class="post-id"
                                    id="<?php echo $row['idspPostings']; ?>">
                                    <div class="job-type">
                                        <?php echo $row['spPostingJobType']; ?>
                                    </div>
                                    <div class="salary">Salary <?php if ($row['spPostingSlryRngFrm'] > 0) {
                                            echo '$' . $row['spPostingSlryRngFrm'] . ' - $'. $row['spPostingSlryRngTo'] . ' '.$row['job_currency'];
                                            } ?></div>
                                    <?php
                                                // Creates DateTime objects
                                                $date = strtotime($row["spPostingDate"]);
                                                $date1 = date('Y-m-d');
                                                $date2 = $row["spPostingExpDt"];
                                                $date1_ts = strtotime($date1);
                                                $date2_ts = strtotime($date2);
                                                $diff = $date2_ts - $date1_ts;
                                                ?>
                                    <div class="title">
                                        <?php echo ucfirst($row['spPostingTitle']); ?>
                                    </div>
                                    <div class="description" style="word-break: break-word;font-size:14px;">
                                        <?php
                                                $string = strip_tags($row['spPostingNotes']);
                                                if (strlen($string) > 500) {
                                                // truncate string
                                                $stringCut = substr($string, 0, 500);
                                                $endPoint = strrpos($stringCut, ' ');

                                                //if the string doesn't contain any space then it will cut without word basis.
                                                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                $string .= '... ';
                                                }
                                                echo ucfirst($string); ?>
                                    </div>
                                    <!--div class="skills">
                                        <?php
                                                    $skills = explode(',', $row['spPostingSkill']);
                                                    foreach ($skills as $key => $value) {
                                                    ?>
                                        <div class="skill"><?php echo ucfirst($value); ?></div>
                                        <?php
                                                    } ?>
                                    </div-->
                                    <div class="location" style='font-size:14px;'>
                                        <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/location.svg" alt="">
                                        <?php
                                                    $usercountryn = $row["spPostingsCountry"];
                                                    $userstaten = $row["spPostingsState"];
                                                    $usercityn = $row["spPostingsCity"];

                                                    $co = new _country;
                                                    $result3 = $co->readCountry();
                                                    if ($result3 != false) {
                                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                                        if (isset($usercountryn) && $usercountryn == $row3['country_id']) {
                                                        $currentcountryn = $row3['country_title'];
                                                        $currentcountry_id = $row3['country_id'];
                                                        }
                                                    }
                                                    }
                                                    if (isset($userstaten) && $userstaten > 0) {
                                                    $countryId = $currentcountry_id;
                                                    $pr = new _state;
                                                    $result2 = $pr->readState($countryId);
                                                    if ($result2 != false) {
                                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                                        if (isset($userstaten) && $userstaten == $row2["state_id"]) {
                                                            $currentstate_id = $row2["state_id"];
                                                            $currentstaten = $row2["state_title"];
                                                        }
                                                        }
                                                    }
                                                    }
                                                    if (isset($usercityn) && $usercityn > 0) {
                                                    $stateId = $currentstate_id;
                                                    $co = new _city;
                                                    $result3 = $co->readCity($stateId);
                                                    //echo $co->ta->sql;
                                                        if ($result3 != false) {
                                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                                            if (isset($usercityn) && $usercityn == $row3['city_id']) {
                                                            $currentcityn = $row3['city_title'];
                                                            $currentcity_id = $row3['city_id'];
                                                            }
                                                        }
                                                        }
                                                    };
                                                    ?>
                                        <span>
                                            <?php
                                                    if (!empty($currentcityn)) {
                                                        echo $currentcityn;
                                                    }
                                                    if (!empty($currentstaten)) {
                                                        echo ', ' . $currentstaten;
                                                    }
                                                    if (!empty($currentcountryn)) {
                                                        echo ', ' . $currentcountryn;
                                                    }
                                                    ?>
                                        </span>
                                    </div>
                                    <div class="date-created">
                                        Date Created : <?php echo $row['spPostingDate'];?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    } else {
                        echo "<h3 style='text-align: center;padding-top: 16px;min-height: 300px;'>No Job Found!</h3>";
                    }?>
                </div>
                <div class="job-detail">

                </div>
            </div>
        </div>


    </div>
</div>

<!-- End #main -->

<!-- Current Location Modal End -->
<!-- Model Start change location -->
<div class="modal change-location-modal" id="change-location" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <div class="loc-info">
                        <div class="title">Current Location</div>
                        <div class="location"><?php echo $currentLocation; ?></div>
                    </div>
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Location</h1>
                </div>
                <div class="modal-body">

                    <div class="input-group in-1-col">
                        <label>Country<span style="color: red">*</span></label>
                        <select class="form-select" name="spUserCountry" id="spUserCountry">
                            <option value="">Select Country</option>
                            <?php
                                $co = new _country;
                                $result3 = $co->readCountry();
                                if ($result3 != false) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                ?>
                            <option value='<?php echo $row3['country_id']; ?>'
                                <?php echo (isset($_SESSION["Countryfilter"]) && $_SESSION["Countryfilter"]  == $row3['country_id']) ? 'selected' : ''; ?>>
                                <?php echo $row3['country_title']; ?></option>
                            <?php
                                }
                                }
                                ?>
                        </select>
                    </div>

                    <div class="input-group in-1-col loadUserState">
                        <label>State<span style="color: red">*</span></label>
                        <select class="form-select" name="spUserState" id="spUserState">
                            <option>Select State</option>
                            <?php
                                if (isset($_SESSION["Statefilter"]) && $_SESSION["Statefilter"] > 0) {
                                $countryId = $_SESSION["Countryfilter"];
                                $pr = new _state;
                                $result2 = $pr->readState($countryId);
                                if ($result2 != false) {
                                while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                            <option value='<?php echo $row2["state_id"]; ?>'
                                <?php echo (isset($_SESSION["Statefilter"]) && $_SESSION["Statefilter"] == $row2["state_id"]) ? 'selected' : ''; ?>>
                                <?php echo $row2["state_title"]; ?> </option>
                            <?php
                                }
                                }
                                }
                                ?>
                        </select>
                    </div>
                    <div class="input-group in-1-col loadCity">
                        <label>City</label>
                        <select id="spUserCity" class="form-select" name="spUserCity">
                            <option>Select City</option>
                            <?php
                                if (isset($_SESSION["Cityfilter"]) && $_SESSION["Cityfilter"] > 0) {
                                    $stateId = $_SESSION["Statefilter"];
                                    $co = new _city;
                                    $result3 = $co->readCity($stateId);
                                    if ($result3 != false) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                            <option value='<?php echo $row3['city_id']; ?>'
                                <?php echo (isset($_SESSION["Cityfilter"]) && $_SESSION["Cityfilter"]==$row3['city_id']) ? 'selected' : ''; ?>>
                                <?php echo $row3['city_title']; ?></option> <?php
                                    }
                                    }
                                } ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" name="Change_Current_Location" value="Change"
                        style="color: white ; background-color: #7649B3;" class="btn btn-primary">CHANGE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 

                            
$f = new _spprofilehasprofile;
$p = new _spprofiles;
$myFrndList1 = $f->readallfriend($_SESSION['pid']);
$myFrndList2 = $f->readallfriendWithReverse($_SESSION['pid']);

$flists = [];

if ($myFrndList1) {
    while ($rows = mysqli_fetch_assoc($myFrndList1)) {
        $profile = $p->read($rows['spProfiles_idspProfilesReceiver']);
        $profile = mysqli_fetch_assoc($profile);
        $flists[$profile['idspProfiles']] = $profile['spProfileName'];
    }
}

if ($myFrndList2) {
    while ($rows = mysqli_fetch_assoc($myFrndList2)) {
        $profile = $p->read($rows['spProfiles_idspProfileSender']);
        $profile = mysqli_fetch_assoc($profile);
        $flists[$profile['idspProfiles']] = $profile['spProfileName'];
    }
}
// echo "<pre>"; print_r($flists);die();
?>

<!-- Current Location Modal End -->
<!-- Model End Change Location -->

<!-- Job details model -->
<!-- Modal -->
<div id="fwdjob" class="modal fade change-location-modal" role="dialog">
    <div class="modal-dialog sharestorepos">
        <!-- Modal content-->
        <div class="modal-content no-radius">
            <form method="post" action="sendEmail.php" id="frd_frm">
                <input type="hidden" value="<?php echo $_SERVER['REQUEST_URI'] ?>" id="txtlink" name="txtlink" />
                <input type="hidden" value="<?php echo $postId; ?>" id="postid" name="postid" />
                <input type="hidden" value="<?php echo $_SESSION['pid']; ?>" id="sender_id" name="sender_id" />
                <div class="modal-header">
                    <h4 class="modal-title">Job Forward</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input type="email" name="txtemail" class="form-control" />
                        <p style="text-align: center;">Or</p>
                        <label for="">Select Friend</label>
                        <select class="mySelect form-control" name="txtFriend[]" multiple style="width:100%;">
                            <option value="" disabled>Select Friends</option>
                            <?php
                                foreach($flists as $key => $fprofile){
                            ?>
                                <option value="<?php echo $key; ?>"><?php echo $fprofile; ?></option>
                            <?php } ?>
                        </select>

                        <span id="email_err" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label>Enter Message</label>
                        <textarea name="txtmsg" rows="4" cols="40" class="form-control">I am sharing a job from TheSharePage.com that I thought may be of interest to you.
                        </textarea>
                        <!-- <input type="email" name="txtemail"  id="txtemail" class="form-control" list="friendname" /> -->

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModel('fwdjob');">Cancel</button>
                    <button type="submit" style="color: white ; background-color: #7649B3;" class="btn btn-primary"
                        id="sub_email">Forward</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="flagPost" class="modal fade change-location-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form method="post" action="addtoflag.php" id="flagpost_frm" class="sharestorepos">
            <div class="modal-content no-radius">
                <input type="hidden" name="spPosting_idspPosting" id="spPosting_idspPosting"
                    value="<?php echo $postId; ?>">
                <input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile"
                    value="<?php echo $_SESSION['pid']; ?>">
                <input type="hidden" name="spCategory_idspCategory" value="2"> <?php //echo $_GET['categoryID'] ?>
                <div class="modal-header">
                    <h4 class="modal-title">Flag Post</h4>
                </div>
                <div class="modal-body">
                    <div class="radio">
                        <label><input type="radio" name="why_flag" value="Duplicate post" checked=""> Duplicate
                            post</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="why_flag" value="Posting Violation"> Posting Violation</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="why_flag" value="Suspicious Post"> Suspicious Post</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="why_flag" value="Copied My Post"> Copied My Post</label>
                    </div>
                    <br>
                    <!-- <label>Why flag this post?</label> -->
                    <textarea class="form-control" name="flag_desc" id="flag_desc"
                        placeholder="Add Comments"></textarea>

                    <span id="fdesc_err" style="color: red;"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style='height:auto;' onclick="closeModel('flagPost');">Cancel</button>
                    <button type="button" id="flag_sub1" onclick="flag_sub()"
                        style="color: white ; background-color: #7649B3;height:auto;" class="btn btn-primary" value="Flag Now">Flag
                        Now</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Apply Now -->
<div class="space-lg"></div>
<div id="Notabussiness" class="modal fade change-location-modal" role="dialog">
    <div class="modal-dialog" style="text-align: center;">
        <!-- Modal content-->
        <div class="modal-content no-radius sharestorepos bradius-10">
            <div class="modal-header br_radius_top bg-white">

            </div>
            <div class="modal-body nobusinessProfile">
                <h1><i class="fa fa-info" style="color:red;" aria-hidden="true"></i></h1>
                <h2> Only EMPLOYMENT profile can apply to a job, Please create or switch to your Employment Profile to
                    apply to this job.</h2>
                <!-- <a href="<?php echo $BaseUrl . '/my-profile'; ?>" class="btn" style = "background: #31abe3!important;">Switch/Create Profile</a> -->
                <a href="<?php echo $BaseUrl . '/my-profile'; ?>">
                    <div class="switchprofile">
                        <a href="" style="color: white ; background-color: #7649B3;" class="btn btn-primary">SWITCH
                            PROFILE</a>
                </a>
            </div>
        </div>
        <div class="modal-footer br_radius_bottom bg-white">
            <!--<button type="button" style="background: #31abe3!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>-->
        </div>
    </div>
</div>
</div>
<!-- Job Details model end -->

</div>
<?php
   // include_once("../views/common/footer.php");
    ?>
</div>
<?php
    include_once("../views/common/share-modal.php");
    ?>
<div class="ajax-load text-center" style="display:none">
    <p><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/loader.gif">Loading More Jobs</p>
</div>

<?php if($jobID != 0) { ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            url: "/job-board/loadJobDetail.php",
            type: "POST",
            data: {
                postid: <?php echo $jobID;?>
                //profileid: ide
            },
            success: function(response) {
                $(".job-detail").html(response);
            }
        });

        $(".job").click(function() {
            jobid = $(this).attr('id');
            if ($(window).width() > 600) {                            
                $('#post-data div').removeClass('job-active');
                $('#' + jobid).addClass('job-active');
                $.ajax({
                    url: "/job-board/loadJobDetail.php",
                    type: "POST",
                    data: {
                        postid: jobid
                        //profileid: ide
                    },
                    success: function(response) {
                        $(".job-detail").html(response);
                    }
                });
            
            }else{
                window.location.href = "job-detail.php?postid=" + jobid;
            }
        });
    });
    </script>
<?php  } ?>

<script type="text/javascript">
    $(window).scroll(function() {
        /* console.log('start');
        console.log($(window).scrollTop() + $(window).height())
        console.log( $(document).height()-1);
        console.log('start'); */
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 1) {
            var currentPage = $("#currentPage").val();
            if (currentPage != -1) {
                var nextpage = parseInt(currentPage) + 1;
                $("#currentPage").val(nextpage);
                loadMoreData(nextpage);
            }
        }
    });

    function loadMoreData(currentPage) {
        $.ajax({
                url: 'loadMoreData.php?currentPage=' + currentPage,
                type: "get",
                beforeSend: function() {
                    $('.ajax-load').show();
                }
            })
            .done(function(data) {
                $('.ajax-load').hide();
                if (data == 'NO') {
                    $("#currentPage").val(-1);
                    $("#post-data").append(
                        "<h3 style='text-align: center;padding-top: 16px;min-height: 300px;'>No Job Found!</h3>");

                } else {
                    $("#post-data").append(data);
                }

            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('server not responding...');
            });
    }
</script>

<script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
<script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>
<script type="text/javascript">

    //==========ON CHANGE LOAD COUNTRY IN ACCOUNT SETTING=======
    $("#spUserCountry").on("change", function () {
        //alert('===1');
        var countryId = this.value;
        $.post("loadUserState.php", {
        countryId: countryId
        }, function (r) {
        //alert(r);
            $(".loadUserState").html(r);
        });
        $("#spUserCity").html('');
    
    });
    //==========ON CHANGE LOAD COUNTRY IN ACCOUNT SETTING=======


    //==========ON CHANGE LOAD CITY==========

    $("#spUserState").on("change", function() {
        var state = this.value;
        $.post("loadUserCity.php", {
            state: state
        }, function(r) {
            //alert(r);
            $(".loadCity").html(r);
        });
    });
    //==========ON CHANGE LOAD CITY==========

    // Job Details code
    function flags() {
        document.getElementById('flags').innerText = 'you have already flagged this post from another profile';
    } 

    $(document).ready(function() {
        <?php
            if (isset($_SESSION['email_status'])) : ?>
                <?php if($_SESSION['email_status'] == "success"){ ?>
                    toastr.success("<?= $_SESSION['email_msg_forword'] ?>");
                <?php }elseif($_SESSION['email_status'] == "error") { ?>
                    toastr.error("<?= $_SESSION['email_msg_forword'] ?>");
                <?php } ?>
            <?php unset($_SESSION['email_status']); unset($_SESSION['email_msg_forword']); ?> 
        <?php endif; ?>
        /*flag validate*/

        $("#flag_sub").click(function() {
            return 0;
            var desc = $("#flag_desc").val();
            //alert(desc);
            if (desc == "") {
                $("#fdesc_err").text("Please Enter Description.");
                return false;
            } else {
                $("#flagpost_frm").submit();
            }
        });
        /*Forward validate*/

        $("#sub_email").click(function() {
            var txtemail = $("#txtemail").val();
            //alert(desc);

            if (txtemail == "") {
                $("#email_err").text("Please Enter Email.");
                return false;
            } else {
                $("#frd_frm").submit();
            }
        });
    });

    function flag_sub() {
        var desc = $("#flag_desc").val();
        //alert(desc);
        if (desc == "") {
            $("#fdesc_err").text("Please Enter Description.");
            return false;
        } else {
            $("#flagpost_frm").submit();
        }
    }

    function myFun(id) {
        // swal({
        // title: "Do you want to Save ?",
        // type: "warning",
        // confirmButtonClass: "sweet_ok",
        // confirmButtonText: "Yes",
        // cancelButtonClass: "sweet_cancel",
        // cancelButtonText: "Cancel",
        // showCancelButton: true,
        // },
        // function(isConfirm) {
        // if (isConfirm) {

        $.ajax({
            url: "/job-board/savejob.php",
            type: "GET",
            data: {
                save: id
                //profileid: ide
            },
            success: function(response) {
                $("#savefun" + id).html('<a onclick="myUnsave(' + id + ')">Unsave</a>');
            }

        });
        // }kk
        // });kkkkk
    }

    function myUnsave(id) {
        // swal({
        // title: "Do you want to Unsave ?",
        // type: "warning",
        // confirmButtonClass: "sweet_ok",
        // confirmButtonText: "Yes",
        // cancelButtonClass: "sweet_cancel",
        // cancelButtonText: "Cancel",
        // showCancelButton: true,
        // },
        // function(isConfirm) {
        // if (isConfirm) {
        $.ajax({
            url: "/job-board/savejob.php",
            type: "GET",
            data: {
                unsave: id
                //profileid: ide
            },
            success: function(response) {
                $("#savefun" + id).html('<a onclick="myFun(' + id + ')">Save</a>');
            }
        });
        // }kk
        // });kk
    }

    function openModel(action, id) { 
        if (action == 'fwdjob') {
            jQuery('#postid').val(id);
            // jQuery('#txtlink').val('<?php //echo $BaseUrl . "/job-board/job-detail.php?postid=";?>' + id);
        } else if (action == 'flagPost') {
            jQuery('#spPosting_idspPosting').val(id);
        }
        jQuery('#' + action).modal('show');
    }

    function closeModel(action) {
        jQuery('#' + action).modal('hide');
    }
</script>
<?php include "../views/common/footer.php"; ?>
</body>

</html>
<?php
}
?>
