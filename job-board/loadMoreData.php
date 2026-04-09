<?php
//require_once('../common.php');
include('../univ/baseurl.php');
session_start();
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
          $p   = new _jobpostings;
          $pf  = new _postfield;

          if (isset($_SESSION['salaryrange'])) {
            if (!empty($_SESSION['salaryrange'])) {
              $salaryrange = $_SESSION['salaryrange'];
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
          if (isset($_SESSION['jobtype'])) {
            if (!empty($_SESSION['jobtype'])) {
              $jobtype = $_SESSION['jobtype'];
              $jobtypefilter = "AND spPostingLocation = '$jobtype'";
            }
          }
          if (isset($_SESSION['joblevel'])) {
            if (!empty($_SESSION['joblevel'])) {
              $joblevel = $_SESSION['joblevel'];
              $joblevelfilter = "AND spPostingJoblevel = '$joblevel'";
            }
          }
          //die("================================");
          if (isset($_GET['searchforstorebtn'])) {
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
          // Briskbrain 1
          $qry = "WHERE t.spPostingVisibility=-1 AND flag_status=2 AND t.spPostingExpDt >= CURDATE()  $startenddate $jobtypefilter $Countryfilter $Statefilter {$Cityfilter} $joblevelfilter AND t.spCategories_idspCategory = " . $category. "ORDER BY spPostingDate DESC LIMIT $initial_page, $page_limit";
          $res = $p->readJobs($qry); 
          //echo $p->ta->sql; die('==='); 
          }
          else {
            if (!empty( $_SESSION['jobtitle'])) {
            //die("================================");

           

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
          $qry = "WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $_SESSION['jobtitle'] . "%') AND t.spPostingExpDt >= CURDATE()  $Statefilter $Countryfilter GROUP by idspPostings ORDER BY spPostingDate DESC LIMIT $initial_page, $page_limit";
          $res = $p->readJobs($qry);
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
              $qry = "WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE() AND t.spPostingsCountry =  $Countryfilter AND t.spPostingsState =  $Statefilter ORDER BY spPostingDate DESC LIMIT $initial_page, $page_limit";
              $res = $p->readJobs($qry);
              }else{
                $Countryfilter  = $_SESSION['Countryfilter'];
                 // BriskBrain 4
                 $Countryfilter  = $_SESSION['Countryfilter'];
                 $qry = "WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE() AND t.spPostingsCountry =  $Countryfilter ORDER BY spPostingDate DESC LIMIT $initial_page, $page_limit";
                 $res = $p->readJobs($qry);
              }
            }
          }
          //echo $p->ta->sql; die;
          if ($res) {
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
              $flagnums = $flagcmd->num_rows;
              if ($flagnums == '9') {
                $updatestatus = $pf->jobboardstatus($idposting);
              }
              $postingDate = $row["spPostingDate"];
              $skill = $row["spPostingSkill"];
              // ========================END======================
              
              if ($account_status != 1) {
                ?>
                <div class="job" class="post-id" id="<?php echo $row['idspPostings']; ?>">
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
                    <div class="description" style="word-break: break-word;">
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
                    <div class="skills">
                        <?php
                            $skills = explode(',', $row['spPostingSkill']);
                            foreach ($skills as $key => $value) {
                            ?>
                            <div class="skill"><?php echo ucfirst($value); ?></div>
                            <?php
                            } ?>
                    </div>
                    <div class="location">
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
                        Date Created : <?php echo $date1;?>
                    </div>
                </div>
                  
                <?php
              }
            }
          } else {
            echo "NO";
            exit;
          }          
        }
          ?>
<script type="text/javascript">
        $(document).ready(function(){ 
            $(".job").click(function() {
                jobid =  $(this).attr('id');
                $('#post-data div').removeClass('job-active');                
                $('#'+jobid).addClass('job-active');
                $.ajax({
                    url: "/job-board/loadJobDetail.php",
                    type: "POST",
                    data: {
                    postid: jobid
                    //profileid: ide
                    },
                    success: function(response) {
                        console.log(response);
                        $(".job-detail").html(response);
                    }
                });
            });
        });
        
    </script>