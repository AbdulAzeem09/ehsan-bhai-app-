<?php
class _freelancerposting
{
    public $dbclose = false;
    private $conn;
    public $ta;
    function __construct()
    {
        $this->ta = new _tableadapter("spfreelancer"); //spShipping
        $this->td = new _tableadapter("spfreelancer_profile");
        $this->bid = new _tableadapter("spfreelancer_placebid");
        $this->fta = new _tableadapter("freelance_project_status");
        $this->sta = new _tableadapter("spprofiles");
        $this->spu = new _tableadapter("spuser");
        $this->spf = new _tableadapter("spfreelancerfile");


        $this->ta->dbclose = false;
    }

    function read_new($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE idspPostings =" . $uid);
    }
    function currency_code1($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->spu->read("WHERE idspUser =" . $uid);
    }

    function create($data)
    {
        $postid = $this->ta->create($data);

        return $postid;
    }

    function myfreelancer($pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = " . $pid . " AND t.spCategories_idspCategory = 1", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }

    function read($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE idspPostings =" . $uid);
    }

    function profilesread($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->sta->read("WHERE idspProfiles =" . $uid);
        //echo $this->sta->sql;
        //die("ooooo");

    }

    function freelanceget($pid)
    {
        return   $this->td->read("WHERE spProfiles_idspProfiles =" . $pid);
        //echo $this->td->sql;
        //die();
        //return $this->ta->read("WHERE idspPostings =".$uid);
    }

    function update($data, $pid)
    {
        $this->ta->update($data, $pid);
    }

    function updatecompletestatus($postid, $status)
    {
        $date = date('Y-m-d H:i:s');
        return $this->ta->update(array("complete_status" => $status, "complete_date" => $date), "WHERE idspPostings ='" . $postid . "'");
    }

    function updatestartdate($postid)
    {
        $date = date('Y-m-d H:i:s');
        return $this->ta->update(array("accept_date" => $date), "WHERE idspPostings ='" . $postid . "'");
    }

    function auctionproductpost($catid)
    {


        return $this->ta->read("WHERE spPostingVisibility=0 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()");
    }

    function activeprevpost($postid)
    {
        return $this->ta->update(array("spPostingVisibility" => "-1"), "WHERE idspPostings ='" . $postid . "'");
    }


    function allauctionproduct($catid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()");
    }

    function allretailproduct($catid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Retail' AND spPostingExpDt >= CURDATE()");
    }

    function allwholesaleproduct($catid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Wholesaler' AND spPostingExpDt >= CURDATE()");
    }

    function auctionquantity($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid . " AND (spPostFieldLabel = 'Limited Quantity' OR spPostFieldLabel ='Ticket Capacity' OR spPostFieldLabel ='Supply Ability' OR spPostFieldName ='retailQuantity_')");
    }

    function retailquantity($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid . " AND (spPostFieldLabel = 'Limited Quantity' OR spPostFieldLabel ='Ticket Capacity' OR spPostFieldLabel ='Supply Ability' OR spPostFieldName ='retailQuantity_')");
    }

    function wholesalequantity($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid . " AND (spPostFieldLabel = 'Limited Quantity' OR spPostFieldLabel ='Ticket Capacity' OR spPostFieldLabel ='Supply Ability' OR spPostFieldName ='retailQuantity_')");
    }

    // TOTAL NUMBER OF PRODUCT WHICH USER POST
    function publicpost_count($pid)
    {
        return $this->ta->read("WHERE spPostingVisibility = -1 AND spCategories_idspCategory = 1 AND spProfiles_idspProfiles = " . $pid, "ORDER BY spPostingDate DESC");
    }

    function seller_product($sellerid)
    {
        return $this->ta->read("where spPostingVisibility=-1 and spProfiles_idspProfiles ='$sellerid' AND spCategories_idspCategory = 1 GROUP BY idspPostings ORDER BY RAND() LIMIT 3");
    }

    function myretailproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Retail' AND spPostingExpDt >= CURDATE()");
    }


    function mywholesaleproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Wholesaler' AND spPostingExpDt >= CURDATE()");
    }


    function myauctionproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()");
    }

    function readprice($postid)
    {
        return $this->ta->read("WHERE t.spPostings_idspPostings =" . $postid . " AND spPostFieldName ='spPostingPriceHourly_ ' AND spPostFieldValue = 1");
    }

    function total_post_freelancer1($projectid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = 5 AND spPostingCategory = '$projectid' GROUP BY idspPostings ORDER BY spPostingDate DESC");

        /* return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings
         WHERE t.spPostingVisibility=-1 AND t.idspCategory = 5  AND p.spPostFieldName = 'spPostingCategory_' AND p.spPostFieldValue = '$projectid' GROUP BY idspPostings ORDER BY spPostingDate DESC");*/
    }

    function total_post_freelancer_name1($projectid)
    {
        $aa = date("Y-m-d");

        //die('===');
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = 5 AND  spPostingExpDt>='$aa' IN ($projectid) GROUP BY idspPostings ORDER BY spPostingDate DESC");
        //echo $this->ta->sql;
        // die("mukesh chauhan111");


        /*INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = 5  AND p.spPostFieldName = 'spPostingCategory_' AND p.spPostFieldValue IN ($projectid) GROUP BY idspPostings ORDER BY spPostingDate DESC");*/
        //echo $this
    }


    function total_post_freelancer_name1api($projectid, $offset, $limit)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = 5 AND spPostingCategory IN ($projectid) GROUP BY idspPostings", "ORDER BY spPostingDate DESC LIMIT " . $offset . ", " . $limit . "");


        /*INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = 5  AND p.spPostFieldName = 'spPostingCategory_' AND p.spPostFieldValue IN ($projectid) GROUP BY idspPostings ORDER BY spPostingDate DESC");*/
    }

    function search_project($txtSearch)
    {
        return $this->ta->read("WHERE  t.spPostingTitle  LIKE '%" . $txtSearch . "%' AND t.spPostingVisibility= -1  ", "ORDER BY spPostingDate DESC");
    }


    function publicpost_skill1($category, $pid, $skill)
    {
        // die('=====');
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory =" . $category, " AND spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY GROUP by idspPostings ORDER BY spPostingDate DESC");
    }

    function singletimelines1($postid)
    {
        $postid = $this->ta->escapeString($postid);
        return $this->ta->read("WHERE t.idspPostings = $postid");
        //echo $this->ta->sql;die('====');

    }



    function totalbids1($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid . " AND spProfiles_idspProfiles IS NOT NULL", "", "DISTINCT spProfiles_idspProfiles");
    }


    function chkProjectStatus1($postid)
    {
        return $this->ta->read("WHERE idspPostings = $postid");
    }

    function freelancer_status($postid)
    {
        $postid = $this->fta->escapeString($postid);
        return $this->fta->read("WHERE t.spPosting_idspPostings = $postid and t.fps_status = 'Accepted'");
        //echo $this->fta->sql;
        //die("mmm");


    }
    function freelancer_status_m($postid)
    {
        $postid = $this->fta->escapeString($postid);
        return $this->fta->read("WHERE t.spPosting_idspPostings = $postid and t.fps_status = 'Accepted'");
        //echo $this->fta->sql;
        //die("mmm");       


    }



    function freelancer_category($postcat)
    {
        return $this->sta->read("where t.idspprofiles = $postcat");
        //echo $this->fta->sql;
        //die("mmm");

    }

    function client_publicpost1($catid, $pid)
    {
        $pid = $this->ta->escapeString($pid);
        return $this->ta->read("WHERE spPostingVisibility = -1 AND spCategories_idspCategory = " . $catid, " AND spProfiles_idspProfiles = '$pid' AND complete_status=0 ORDER BY idspPostings DESC");
        //echo $this->ta->sql; die('jjjj');
    }

    function client_publicpost_posting($catid, $clientid)
    {
        return $this->ta->read("WHERE  spPostingVisibility=-1 AND spCategories_idspCategory  = " . $catid, " AND spProfiles_idspProfiles = '$clientid' AND complete_status = 0 ORDER BY spPostingDate DESC");
    }

    function clientbid_publicpost_posting($catid, $clientid)
    {
        return $this->ta->read("WHERE idspPostings NOT IN (SELECT spPosting_idspPostings FROM freelance_project_status) AND (spPostingVisibility=-1 OR spPostingVisibility=-2)  AND spCategories_idspCategory  = " . $catid, " AND spProfiles_idspProfiles = '$clientid' AND complete_status = 0 ORDER BY idspPostings DESC");
        // echo $this->ta->sql; die('========');
    }

    function freelancer_completed_incompleted_project($clientid)
    {
        return $this->ta->read("WHERE idspPostings IN (SELECT spPosting_idspPostings FROM freelance_project_status where spProfiles_idspProfiles = $clientid ) AND spPostingVisibility=-1   AND complete_status != 0 ORDER BY spPostingDate DESC");
    }

    function freelancer_completed_project($clientid)
    {
        return $this->ta->read("WHERE idspPostings IN (SELECT spPosting_idspPostings FROM freelance_project_status where spProfiles_idspProfiles = $clientid ) AND spPostingVisibility=-1   AND complete_status = 1 ORDER BY spPostingDate DESC");
    }



    function allbids1($pid, $postid)
    {
        return $this->ta->read("WHERE spProfiles_idspProfiles =" . $pid . " AND idspPostings =" . $postid);
    }


    // READ ALL POST FIELDS FROM THE SPPOSTFIELD TABLE
    function read1($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid);
    }
    function read2($postid)
    {
        $postid = $this->spf->escapeString($postid);
        return $this->spf->read("WHERE spPostings_idspPostings = " . $postid);
    }
    // =====THIS IS NEW TIME ZONE TESTING
    function get_timeago1($ptime)
    {
        date_default_timezone_set('Asia/Karachi');

        $estimate_time = time() - $ptime;
        if ($estimate_time < 1) {
            return 'less than 1 second ago';
        }
        $condition = array(
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  ' second'
        );
        foreach ($condition as $secs => $str) {
            $d = $estimate_time / $secs;
            if ($d >= 1) {
                $r = round($d);
                return '' . $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }

    function readFields1($postid)
    {
        return $this->ta->read("WHERE idspPostings =  $postid ");
    }

    function myAllProject1($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory  = " . $catid, " AND spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }

    function myExpireProduct1($catId, $pid)
    {
        return $this->ta->read("WHERE spProfiles_idspProfiles = $pid AND spCategories_idspCategory = $catId AND (spPostingVisibility != -3) AND spPostingExpDt < CURDATE() ORDER BY spPostingDate DESC");
        //echo $this->ta->sql; die("====");
    }

    function removeexpire($postid)
    {
        $this->ta->remove("WHERE t.idspPostings = " . $postid);
    }


    function deleteposter($postid)
    {
        $this->ta->remove("WHERE t.idspPostings = " . $postid);
    }



    function deleteactive($postid)
    {
        $this->ta->remove("WHERE t.idspPostings = " . $postid);
    }


    function readdata($id)

    {
        return $this->ta->read("where idspPostings = $id");
        //echo $this->ta->sql;
        //die("+++");

    }


    function activate($data, $id)
    {
        return $this->ta->update($data, "WHERE idspPostings = $id");
        //echo $this->ta->sql;
        //die("0000");
    }

    function deactivate($data, $id)
    {
        return $this->ta->update($data, "WHERE idspPostings = $id");
        //echo $this->ta->sql;
        //die("11110");
    }
    function field1($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid);
    }

    function myProfileDraftFreelancer1($category, $pid)
    {
        return $this->ta->read("WHERE spProfiles_idspProfiles =" . $pid . " AND spPostingVisibility= 0 AND spCategories_idspCategory = $category", "ORDER BY spPostingDate DESC");
        //echo $this->ta->sql; die("====");
    }
    function myProfileFavouriteFreelancer($category, $postid)
    {
        return $this->ta->read("WHERE idspPostings =" . $postid . " AND spCategories_idspCategory = $category");
        //echo $this->ta->sql; die("====");
    }

    /*  function myCmpPro1($catid, $pid){
       return $this->ta->read("WHERE spProfiles_idspProfiles = " . $pid." AND spCategories_idspCategory = $catid AND spPostingsStatus = 'Completed'");
    }*/

    function myCmpPro1($catid, $pid)
    {
        return $this->ta->read("WHERE spProfiles_idspProfiles = " . $pid . " AND spCategories_idspCategory = $catid ");
    }

    function myCmpletePro1($catid, $pid)
    {
        return $this->ta->read("WHERE spProfiles_idspProfiles = " . $pid . " AND spCategories_idspCategory = $catid AND complete_status = 1 ORDER BY spPostingDate DESC");
    }

    function myCmpleteincompletePro1($catid, $pid)
    {
        $this->ta->read("WHERE spProfiles_idspProfiles = " . $pid . " AND spCategories_idspCategory = $catid AND complete_status != 0 ORDER BY spPostingDate DESC");

        // echo $this->ta->sql; die()

    }

    function myflagPost1($catid, $pid)
    {
        return $this->ta->read("WHERE spProfiles_idspProfiles = $pid AND spCategories_idspCategory = $catid AND spPostingVisibility = 3 ORDER BY spPostingDate DESC ");
    }
    function myflagresponse1($catid, $pid)
    {
        return $this->ta->read("WHERE spProfiles_idspProfiles = $pid AND spCategories_idspCategory = $catid");
    }

    function myflagresponsenew($catid, $pid)
    {
        return $this->ta->read("INNER JOIN flagpost AS f ON t.idspPostings = f.spPosting_idspPosting WHERE f.spProfile_idspProfile = $pid AND f.spCategory_idspCategory = $catid");
    }

    function awardedproject($pid)
    {
        return $this->ta->read("INNER JOIN freelance_project_status AS f ON t.idspPostings = f.spPosting_idspPostings WHERE f.fps_status = 'accepted' AND f.employer_pid = $pid ORDER BY spPostingDate DESC");
        // $this->ta->sql; die("====");
    }

    /* function myflagresponse($catid, $pid){
        
        return $this->ta->read("INNER JOIN flagpost AS f ON t.idspPostings = f.spPosting_idspPosting WHERE d.idspProfiles = $pid AND t.idspCategory = $catid");
    }
*/

    //return time agko function 
    function spPostingDate1($firstTime, $lastTime = '')
    {
        date_default_timezone_set('Asia/Karachi');

        if ($lastTime) {
            $now = new DateTime(date('Y-m-d h:i:s', strtotime($lastTime)));
        } else {
            $now = new DateTime(date('Y-m-d h:i:s'));
        }
        $then = new DateTime(date('Y-m-d h:i:s', strtotime($firstTime)));
        $diff = $then->diff($now);
        $time_ago = array('years' => $diff->y, 'months' => $diff->m, 'days' => $diff->d, 'hours' => $diff->h, 'minutes' => $diff->i, 'seconds' => $diff->s);

        if ($time_ago['years'] > 0) {
            return $time_ago['years'] . ' year ago';
        } else if ($time_ago['months'] > 0) {
            return $time_ago['months'] . ' month ago';
        } else if ($time_ago['days'] > 0) {
            if ($time_ago['days'] == 1) {
                return $time_ago['days'] . ' day ago';
            } else {
                return $time_ago['days'] . ' days ago';
            }
        } else if ($time_ago['hours'] > 0) {
            return $time_ago['hours'] . ' hours ago';
        } else if ($time_ago['minutes'] > 0) {
            return $time_ago['minutes'] . ' min ago';
        } else {
            return $time_ago['seconds'] . ' sec just now';
        }
    }


    function myBidProject1($catid, $pid)
    {
        return $this->ta->read("INNER JOIN spfreelancer_placebid AS d ON t.idspPostings =d.spPostings_idspPostings where t.sppostingvisibility=-1 and t.spcategories_idspcategory = $catid AND t.spProfiles_idspProfiles != $pid AND d.spProfiles_idspProfiles = $pid GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }

    function myBidProject12($catid, $pid)
    {
        return $this->ta->read("INNER JOIN spfreelancer_placebid AS d ON t.idspPostings =d.spPostings_idspPostings INNER JOIN
  freelance_project_status AS e ON t.idspPostings = e.spPosting_idspPostings where t.sppostingvisibility=-1 and t.spcategories_idspcategory = $catid AND t.spProfiles_idspProfiles != $pid AND d.spProfiles_idspProfiles = $pid AND e.status = 0 GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }

    function myBidProject1212($catid, $pid)
    {
        return $this->ta->read("INNER JOIN spfreelancer_placebid AS d ON t.idspPostings =d.spPostings_idspPostings LEFT JOIN
  freelance_project_status AS e ON t.idspPostings = e.spPosting_idspPostings where t.spcategories_idspcategory = $catid AND d.spProfiles_idspProfiles = $pid ORDER BY spPostingDate DESC");
    }


    function myBidProject_hide_submit($catid, $postid)
    {
        return $this->ta->read("INNER JOIN spfreelancer_placebid AS d ON t.idspPostings =d.spPostings_idspPostings LEFT JOIN
  freelance_project_status AS e ON t.idspPostings = e.spPosting_idspPostings where t.spcategories_idspcategory = $catid AND t.idspPostings = $postid ");
    }


    /*function myBidProject($catid, $pid){
        return $this->ta->read("INNER JOIN sppostfield AS d ON t.idspPostings = d.spPostings_idspPostings where t.sppostingvisibility=-1 and t.spcategories_idspcategory = $catid AND  d.spPostFieldBidFlag = 1 AND t.spProfiles_idspProfiles != $pid AND d.spProfiles_idspProfiles = $pid AND t.spPostingsStatus != 'Completed' GROUP BY idspPostings ORDER BY spPostingDate DESC");   
    }*/


    function myfavourite_music1($pid, $category)
    {

        return $this->ta->read("INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles WHERE idspPostings in(select spPostings_idspPostings from spfreelancerfavorites WHERE spProfiles_idspProfiles =" . $pid . ") AND spcategories_idspcategory = $category");
    }

    //post complete
    function completeProject($postid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND complete_status = 1");
    }
    function completeincompletedProject($postid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND complete_status = 1 or complete_status = 2");
    }

    function flag_post1($category, $pid)
    {
        return $this->ta->read("INNER JOIN flagpost as f on t.idsppostings = f.spPosting_idspPosting WHERE spPostingVisibility = -1 AND spProfiles_idspProfiles= " . $pid . " AND spcategories_idspcategory =" . $category . " GROUP BY idsppostings");
    }

    // DELETE POSTINGS
    function remove($postid)
    {
        $this->ta->remove("WHERE t.idspPostings = " . $postid);
    }


    function readallbids($projectid, $order)
    {
        return $this->bid->read("WHERE spPostings_idspPostings =" . $projectid);
    }
}
