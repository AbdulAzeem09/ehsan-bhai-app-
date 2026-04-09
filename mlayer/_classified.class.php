<?php

class _classified
{

    // property declaration
    // idspPostings, spPostingTitle, spPostingNotes, spPostingExpDt, spPostingPrice, spPostingEmail, spPostingPhone, spPostingVisibility, spPostingDate, spProfiles_idspProfiles, spCategories_idspCategory
    public $dbclose = false;
    private $conn;
    public $ta;
    public $pic;
    public $tad;

    function __construct()
    {
        $this->ta = new _tableadapter("spclassified");
        $this->comm = new _tableadapter("clasified_category");
        $this->tad = new _tableadapter("spBuyPostings");
        $this->sp = new _tableadapter("sppostingsartcraft");


        // $this->ta->dbclose = false;

        //$this->ta->join = "INNER JOIN sppost_has_sporder as d ON t.idspPostings = d.spPostings_idspPostings INNER JOIN sporder as p ON d.spOreder_idspOreder = p.idspOrder";

        $this->pic = new _tableadapter("spPostingPics");
        $this->media = new _tableadapter("spPostingMedia");
    }

    function commser($com)
    {
        return $this->comm->read("WHERE clasifiedType = " . $com . " ORDER BY clasifiedTitle ASC ");
    }
    function readCountry_74($id)
    {
        return $this->ta->read("WHERE idspPostings = " . $id);
    }

    function removeProfiles($pid)
    {
        $this->ta->remove("WHERE t.spProfiles_idspProfiles= " . $pid);
    }


    function classifiedCategoryByType($ser)
    {

        return $this->comm->read("WHERE clasifiedType = " . $ser);
    }

    //function locall($country,$state,$city){

    // return $this->ta->read("WHERE t.spPostCountry = " . $country . " AND t.spPostState =" . $state ." AND t.spPostCity =" . $city );


    //}


    function readclassified($id)
    {
        return $this->ta->read("WHERE idspPostings = " . $id);
    }


    // update notes on the training module
    function updateNotes($notes, $postid)
    {
        $this->ta->update(array("spPostingNotes" => $notes), "WHERE idspPostings ='" . $postid . "'");
    }


    function hidecomment($postid)
    {
        return $this->ta->update(array("sppostingscommentstatus" => 0), "WHERE idspPostings ='" . $postid . "'");
    }

    function allowcomment($postid)
    {
        return $this->ta->update(array("sppostingscommentstatus" => 1), "WHERE idspPostings ='" . $postid . "'");
    }

    function businesspost($profileid)
    {
        return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid);
    }

    function totalview($postid, $total)
    {
        return $this->ta->update(array("sppostingsViews" => $total), "WHERE idspPostings ='" . $postid . "'");
    }

    function year()
    {
        //year(sppostingsTransactionDate)
        return $this->ta->read("WHERE spPostingsBought = 1", "GROUP BY  year(sppostingsTransactionDate)");
    }

    function categoryrevanue($month)
    {
        return $this->ta->read("WHERE month(sppostingsTransactionDate)=" . $month . " AND spPostingsBought = 1", "GROUP BY spCategories_idspCategory", "sum(spPostingPrice) as sum , spCategories_idspCategory");
    }

    function monthlyrevanue($year)
    {
        return $this->ta->read("WHERE year(sppostingsTransactionDate) =" . $year, "GROUP BY sppostingsTransactionDate", "sum(spPostingPrice) as sum , sppostingsTransactionDate");
    }

    function updatevisibility($postid, $visibility)
    {
        return $this->ta->update(array("spPostingVisibility" => $visibility), "WHERE idspPostings ='" . $postid . "'");
    }
    //show all services which i posted
    function myposted_service($pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = " . $pid . " AND t.spPostingExpDt > CURDATE()  ORDER BY spPostingDate DESC");
        // echo $this->ta->sql;
        // die;
    }

    function deactiv_service($pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = 0 AND t.spProfiles_idspProfiles = " . $pid . " AND t.spPostingExpDt > CURDATE()  ORDER BY spPostingDate DESC");
        // echo $this->ta->sql;
        // die;
    }

    function activated($pid)
    {
        $this->ta->update(array("spPostingVisibility" => -1), "WHERE idspPostings = $pid ");
        $this->ta->update(array("spPostingVisibility" => -1), " WHERE idspPostings = $pid ");
        //echo $this->ta->sql; die('----------------');


    }

    function allposted_service($pid)
    {
        return $this->ta->read("WHERE  spProfiles_idspProfiles =$pid");
        echo $this->ta->sql;
        // die;
    }

    function flag_name($profileid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $profileid);
        //echo $this->ta->
    }


    // update postings
    function updateFlag($postid)
    {
        $this->ta->update(array("spPostingVisibility" => 3), "WHERE idspPostings = $postid ");
    }


    //my drafts jobs 
    function myDraftJob($category, $pid)
    {
        return $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spPostingVisibility = 0 AND t.spCategories_idspCategory = $category", "ORDER BY spPostingDate DESC");
    }

    function publicpost_music_allads($category, $u_state, $u_country, $order)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostState=" . $u_state . " AND t.spPostCountry=" . $u_country . " AND t.spPostingExpDt > CURDATE()  AND t.spCategories_idspCategory = " . $category, "ORDER BY spPostingDate $order ");
        echo $this->ta->sql;
    }

    /* function publicpost_music($category, $order){
      return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt > CURDATE()  AND t.spCategories_idspCategory = " . $category, "ORDER BY spPostingDate $order");

    }*/

    function publicpost_music($category, $country, $state, $city, $order)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt > CURDATE()  AND t.spPostCountry = " . $country . " AND t.spPostState =" . $state . " AND t.spPostCity =" . $city, "ORDER BY spPostingDate $order");
    }

    function publicpost_music_all()
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt > CURDATE()  ORDER BY spPostingDate DESC");

        //echo $this->ta->sql; die("---------------");

    }

    function publicpost_music_keyword($country, $state, $city, $keyw)
    {
        return  $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt > CURDATE() AND t.spPostingsCountry = '" . $country . "'  AND t.spPostingsState = '" . $state . "' AND t.spPostingsCity = '" . $city . "' AND spPostingTitle LIKE '%" . $keyw . "%'  ORDER BY spPostingDate DESC");
        //  echo  $this->ta->sql;
        //  die("+++++++++");
    }



    function serviceByCountryStateCity($category, $u_state, $u_country, $u_city, $order)
    {
        $category = $this->ta->escapeString($category);
        
        return  $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingsState=" . $u_state . " AND t.spPostingsCity=" . $u_city . " AND t.spPostingsCountry=" . $u_country . "  AND t.spPostingExpDt > CURDATE()  AND t.spPostSerComty ='" . $category . "' ORDER BY spPostingDate $order ");
        //echo  $this->ta->sql;
        //die("+++++++++");
    }




    //read search
    function search($title, $category, $u_country, $u_state, $city, $order)
    {
        $category = $this->ta->escapeString($category);
        $title = $this->ta->escapeString($title);
        
        return  $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingsState=" . $u_state . " AND t.spPostingsCountry=" . $u_country . " AND spPostingsCity=$city AND t.spPostingExpDt > CURDATE()  AND t.spPostingTitle LIKE '%" . $title . "%' AND t.spPostSerComty = '" . $category, "' ORDER BY spPostingDate $order");
        //echo $this->ta->sql;
        //die('=========');
    }

    function findByStateCity($category, $userState, $userCity)
    {
        return $this->ta->read(" WHERE t.spPostingVisibility=-1 
            AND t.spCategories_idspCategory = " . $category . " 
            AND t.spPostState=" . $userState . "
            AND t.spPostCity=" . $userCity . " ORDER BY spPostingDate DESC");
    }

    function findByState($category, $userState)
    {
        return $this->ta->read(" WHERE t.spPostingVisibility=-1 
            AND t.spCategories_idspCategory = " . $category . " 
            AND t.spPostState=" . $userState . " ORDER BY spPostingDate DESC");
    }
    //deactive all post
    function profilePostDeactive($pid)
    {
        return $this->ta->update(array("spPostingVisibility" => "1"), "WHERE spProfiles_idspProfiles ='" . $pid . "'");
    }

    //Active all post
    function profilePostActive($pid)
    {
        return $this->ta->update(array("spPostingVisibility" => "-1"), "WHERE spProfiles_idspProfiles ='" . $pid . "'");
    }


    function post($data)
    {
        return $postid = $this->ta->create($data);
        // $this->ta->sql; die("----------------");
        // return $postid;
    }

    function postt($data)
    {
        $postid = $this->ta->create($data);
        //  $this->ta->sql;
        return $postid;
    }


    function createservice($title, $notes, $city, $country, $pid, $phone)
    {
        //$postid = $p->create(array("spPostingTitle" => $data["businesssubcategory_"] ,"spPostingNotes" => $data["spProfileAbout"] ,"spPostingVisibility" => -1 ,"spCategories_idspCategory" => 7 ,"spPostingsCity" => $data["spProfilesCity"] , "spPostingsCountry" =>$data["spProfilesCountry"], "spProfiles_idspProfiles" => $pid));
        $expirydate = date('Y-m-d', strtotime("+30 days"));

        $postid = $this->ta->create(array("spPostingTitle" => $title, "spPostingNotes" => $notes, "spPostingVisibility" => -1, "spCategories_idspCategory" => 7, "spPostingsCity" => $city, "spPostingsCountry" => $country, "spProfiles_idspProfiles" => $pid, "spPostingExpDt" => $expirydate, "spPostingPhone" => $phone));
        return $postid;
    }

    // show all category with specfic name   t.spPostSerComty = '".$catNamee."'     $condition1 .= ' OR t.spPostSerComty = musicians';
    function sameServCategory($catNamee, $u_country, $u_state, $city)
    {
        $catNamee = $this->ta->escapeString($catNamee);
        
        return  $this->ta->read(" WHERE t.spPostingVisibility=-1 AND spPostingsCity=$city AND t.spPostingsState='" . $u_state . "' AND t.spPostingsCountry='" . $u_country . "' AND t.spPostingExpDt > CURDATE()  AND t.spPostSerComty= '" . $catNamee . "' ORDER BY spPostingDate DESC");

        //echo $this->ta->sql;
        //die("-------");
    }

    function sameServCategory1($catNamee, $country, $state, $city, $keyw)
    {
        //function sameServCategory1($catNamee, $category ){
        //return $this->ta->read(" WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt > CURDATE()  AND  $catNamee AND t.spCategories_idspCategory = '". $category."' ORDER BY spPostingDate DESC");

        return $this->ta->read(" WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt > CURDATE()  AND  $catNamee AND t.spPostCountry = '" . $country . "'  AND t.spPostState = '" . $state . "' AND t.spPostCity = '" . $city . "' AND spPostingTitle LIKE '%" . $keyw . "%'  ORDER BY spPostingDate DESC");
    }

    function readPrivate($profileid)
    {
        return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
    }

    function readActive($profileid)
    {
        return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid . " AND t.spPostingVisibility >= 0");
    }

    function readPublic($profileid)
    {
        return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid . " AND t.spPostingVisibility= -1");
    }

    function read($pid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $pid);
    }


    function  readcreaft($pid)
    {
    	  $pid = $this->sp->escapeString($pid);
        return $this->sp->read("WHERE t.idspPostings = " . $pid);
    }



    function update($pid, $data)
    {
        $this->ta->update($pid, $data);
    }

    // DELETE POSTINGS
    function remove($postid)
    {
        $this->ta->remove("WHERE t.idspPostings = " . $postid);
    }


    // ================dashboard
    // TRASH POST
    function trashpost($postid)
    {
        $this->ta->update(array("spPostingVisibility" => -3), "WHERE t.idspPostings = " . $postid);
    }


    // RESTORE POST
    function trashRestorepost($postid)
    {
        $this->ta->update(array("spPostingVisibility" => -1), "WHERE t.idspPostings = " . $postid);
    }


    function myTrashPost($pid, $catId)
    {
    }
    // =========================


    function checkout($postid, $buyerid)
    {
        return $this->ta->update(array("spPostingsBuyerid" => $buyerid, "spPostingsBought" => 1, "sppostingsTransactionDate" => date("Y-m-d")), "WHERE idspPostings ='" . $postid . "'");
    }

    function wholesaleFinished($postid)
    {
        return $this->ta->update(array("spPostingsBought" => 3), "WHERE idspPostings ='" . $postid . "'");
    }

    function accepbid($postid, $bidderid)
    {
        return $this->ta->update(array("spPostingsBuyerid" => $bidderid, "spPostingsBought" => 2), "WHERE idspPostings ='" . $postid . "'");
    }
    //project for freelancer completed or cancel
    function projectStatus($postid, $spPostingStatus)
    {
        return $this->ta->update(array('spPostingsStatus' => $spPostingStatus), "WHERE idspPostings = '$postid'");
    }
    //project for freelancer completed or cancel
    function cancelprojectStatus($postid, $spPostingStatus, $canceldesc)
    {
        return $this->ta->update(array('spPostingsStatus' => $spPostingStatus, 'spPostingsCancelDesc' => $canceldesc), "WHERE idspPostings = '$postid'");
    }
    //chek project status is completed or canceld
    function chkProjectStatus($postid)
    {
        return $this->ta->read("WHERE idspPostings = '$postid' AND spPostingsStatus != ' '");
    }
    //favourite events
    function removeFavourit($portid)
    {
    return $this->ta->remove("WHERE idspPostings = $portid");

    }

    function event_favorite($category, $pid)
    {
        return $this->ta->read("INNER JOIN spclassifiedfav as r on t.idsppostings = r.sppostings_idsppostings WHERE t.spCategories_idspCategory = $category AND  r.spprofiles_idspProfiles = $pid GROUP by idspPostings ORDER BY spPostingDate DESC");
    }


    function event_favorite_service($pid)
    {
        return $this->ta->read("INNER JOIN spclassifiedfav as r on t.idsppostings = r.sppostings_idsppostings WHERE r.spprofiles_idspProfiles = $pid GROUP by idspPostings ORDER BY spPostingDate DESC");
    }



    function sortlist_favorite($category, $pid)
    {
        return $this->ta->read("INNER JOIN spclassifiedfav as r on t.idsppostings = r.sppostings_idsppostings WHERE t.spCategories_idspCategory = $category AND  r.spprofiles_idspProfiles = $pid AND sortlisted = 1 GROUP by idspPostings ORDER BY spPostingDate DESC");
    }


    //client freelancer project
    function client_publicpost($catid, $clientid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND spCategories_idspCategory  = " . $catid, " AND spProfiles_idspProfiles = '$clientid' AND spPostingsStatus = '' ORDER BY spPostingDate DESC");
    }
    //successfull project in freelancer
    function success_publicpost($catid, $clientid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $catid, " AND t.idspProfiles = '$clientid' AND spPostingsStatus = 'Completed' ORDER BY spPostingDate DESC");
    }
    // show all service which is expired and i posted
    function myposted_expire_service($pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = " . $pid . " AND t.spPostingExpDt < CURDATE()  ORDER BY spPostingDate DESC");


        // return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = $pid AND t.spCategories_idspCategory = " . $category, "AND t.spPostingExpDt < CURDATE()  ORDER BY spPostingDate DESC");
    }

    function myServEnq($pid)
    {
        return $this->ta->read("INNER JOIN addservenquiry as r on t.idsppostings = r.spPosting_idspPosting WHERE t.sppostingvisibility = -1 AND t.spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }

    function myServEnq1($pid)
    {
        return $this->ta->read("INNER JOIN addservenquiry as r on t.idsppostings = r.spPosting_idspPosting WHERE t.sppostingvisibility = -1 AND t.spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }

    function myEnq($category, $pid)
    {
        return $this->ta->read("INNER JOIN addservenquiry as r on t.idsppostings = r.spPosting_idspPosting WHERE  r.sender_id = '$pid' ORDER BY spPostingDate DESC");
    }
    // MY DRAFT PRODUCTS PROFILE AND CATEGORY WISE
    function readMyDraftprofile($pid)
    {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
        return $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spPostingVisibility = 0", "ORDER BY spPostingDate DESC");

        // echo $this->ta->sql;die('++++11');
    }
    //my project detail
    function singletimelines($postid)
    {
         $postid = $this->ta->escapeString($postid);
        //return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
        return $this->ta->read("WHERE t.idspPostings = " . $postid . "");
    }
    //archive project which is completed or canceled
    function archiveprojed($catid, $pid)
    {
        //return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
        return $this->ta->read("WHERE spCategories_idspCategory  = " . $catid . " AND spProfiles_idspProfiles = '$pid' AND spPostingsStatus != ''");
    }
    //post complete
    function completeProject($postid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND spPostingsStatus = 'Completed'");
    }
    //my all freelancer projects
    function myAllProject($catid, $pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND spCategories_idspCategory  = " . $catid, " AND spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }
    //my complete projects
    function myCmpPro($catid, $pid)
    {
        return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $pid . " AND spCategories_idspCategory = $catid AND spPostingsStatus = 'Completed'");
    }
    //my all project where i bid
    function myBidProject($catid, $pid)
    {
        return $this->ta->read("INNER JOIN sppostfield AS d ON t.idspPostings = d.spPostings_idspPostings where t.sppostingvisibility=-1 and t.spcategories_idspcategory = $catid AND  d.spPostFieldBidFlag = 1 AND t.spProfiles_idspProfiles != $pid AND d.spProfiles_idspProfiles = $pid AND t.spPostingsStatus != 'Completed' GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }
    //my profile drafts
    function myProfileDraftFreelancer($category, $pid)
    {
        return $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spPostingVisibility= 0 AND t.spCategories_idspCategory = $category", "ORDER BY spPostingDate DESC");
    }

    function activeprevpost($postid)
    {
        return $this->ta->update(array("spPostingVisibility" => "-1"), "WHERE idspPostings ='" . $postid . "'");
    }


    function grouptimelines($gid)
    {
        return $this->ta->read("WHERE spcategories_idspcategory = 17 AND t.spPostingVisibility = " . $gid, "ORDER BY spPostingDate DESC");
    }

    function globaltimelinesProfile($start, $pid)
    {
        //level-1
        // return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
        //level-2

        return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select spPostings_idspPostings from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");

        // LAST QUERY WITHOUT CATEGORY (14-MAY-19)
        //return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17 OR idspCategory = 9)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");

        //return $this->ta->read("INNER JOIN spposthide AS h ON t.idspPostings != h.spPostings_idspPostings WHERE h.spProfiles_idspProfiles = $pid AND (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
    }


    function globaltimelinesProfileapi($offset, $limit, $pid)
    {

        return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spprofiles_idspprofiles = " . $pid . " or t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 or spProfiles_idspProfiles = " . $pid . " AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select timelineid from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= '" . $start . "'", " ORDER BY spPostingDate DESC LIMIT " . $offset . ", " . $limit . "");
    }

    function globaltimelinesProfiletimeline($start, $pid)
    {
        //level-1
        // return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
        //level-2

        // return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 ) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select spPostings_idspPostings from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= ".$start."", "ORDER BY spPostingDate DESC");
        return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 or spProfiles_idspProfiles = " . $pid . " AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select timelineid from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= '" . $start . "'", "ORDER BY spPostingDate DESC");
        // LAST QUERY WITHOUT CATEGORY (14-MAY-19)
        //return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17 OR idspCategory = 9)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");

        //return $this->ta->read("INNER JOIN spposthide AS h ON t.idspPostings != h.spPostings_idspPostings WHERE h.spProfiles_idspProfiles = $pid AND (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
    }


    function offsetglobaltimelinesProfiletimeline($start, $pid, $offset)
    {
        //level-1
        // return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
        //level-2

        // return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 ) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select spPostings_idspPostings from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= ".$start."", "ORDER BY spPostingDate DESC");
        return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spprofiles_idspprofiles = " . $pid . " or t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 or spProfiles_idspProfiles = " . $pid . " AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select timelineid from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= '" . $start . "'", "ORDER BY spPostingDate DESC Limit 0," . $offset);
        // LAST QUERY WITHOUT CATEGORY (14-MAY-19)
        //return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17 OR idspCategory = 9)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");

        //return $this->ta->read("INNER JOIN spposthide AS h ON t.idspPostings != h.spPostings_idspPostings WHERE h.spProfiles_idspProfiles = $pid AND (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
    }
    /*old?09/06/2020*/
    function allgrouptimelinesPost($postid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND t.spcategories_idspcategory = 16");
    }


    function readtimelines($pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spcategories_idspcategory = 16 AND t.spProfiles_idspProfiles =" . $pid . " ORDER BY spPostingDate DESC LIMIT 12");
    }
    /* function allgrouptimelinesPost($postid,$groupid) {
         return $this->ta->read("WHERE t.idspPostings = " .$postid. " or t.spPostingVisibility = " .$groupid. " AND  t.spcategories_idspcategory = 16");
    }*/
    function singletimelinespost($postid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND t.spcategories_idspcategory = 16");
    }

    function spPostingDate($firstTime, $lastTime = '')
    {
        /*date_default_timezone_set('Asia/Karachi');*/
        //date_default_timezone_set('Asia/Kolkata');
        /*$timezone = date_default_timezone_get();
             date_default_timezone_set($timezone);*/

        if ($lastTime) {
            $now = new DateTime(date('Y-m-d h:i:s', strtotime($lastTime)));
        } else {
            $now = new DateTime(date('Y-m-d h:i:s'));
        }
        $then = new DateTime(date('Y-m-d h:i:s', strtotime($firstTime)));
        // print_r($then);
        $diff = $then->diff($now);
        $time_ago = array('years' => $diff->y, 'months' => $diff->m, 'days' => $diff->d, 'hours' => $diff->h, 'minutes' => $diff->i, 'seconds' => $diff->s);
        // print_r($time_ago);
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






    function time_Ago($time)
    {

        // Calculate difference between current 
        // time and given timestamp in seconds 
        $diff     = time() - $time;

        // Time difference in seconds 
        $sec     = $diff;

        // Convert time difference in minutes 
        $min     = round($diff / 60);

        // Convert time difference in hours 
        $hrs     = round($diff / 3600);

        // Convert time difference in days 
        $days     = round($diff / 86400);

        // Convert time difference in weeks 
        $weeks     = round($diff / 604800);

        // Convert time difference in months 
        $mnths     = round($diff / 2600640);

        // Convert time difference in years 
        $yrs     = round($diff / 31207680);

        // Check for seconds 
        if ($sec <= 60) {
            return $sec . "seconds ago";
        }

        // Check for minutes 
        else if ($min <= 60) {
            if ($min == 1) {
                return "1 minute ago";
            } else {
                return $min . "minutes ago";
            }
        }

        // Check for hours 
        else if ($hrs <= 24) {
            if ($hrs == 1) {
                return "an hour ago";
            } else {
                return $hrs . "hours ago";
            }
        }

        // Check for days 
        else if ($days <= 7) {
            if ($days == 1) {
                return "Yesterday";
            } else {
                return $days . "days ago";
            }
        }

        // Check for weeks 
        else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "a week ago";
            } else {
                return $weeks . "weeks ago";
            }
        }

        // Check for months 
        else if ($mnths <= 12) {
            if ($mnths == 1) {
                return "a month ago";
            } else {
                return $mnths . "months ago";
            }
        }

        // Check for years 
        else {
            if ($yrs == 1) {
                return "one year ago";
            } else {
                return $yrs . "years ago";
            }
        }
    }

    function to_time_ago($time)
    {

        // Calculate difference between current 
        // time and given timestamp in seconds 
        $diff = time() - $time;

        if ($diff < 1) {
            return 'less than 1 second ago';
        }

        $time_rules = array(
            12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60       => 'month',
            24 * 60 * 60           => 'day',
            60 * 60                   => 'hour',
            60                       => 'minute',
            1                       => 'second'
        );

        foreach ($time_rules as $secs => $str) {

            $div = $diff / $secs;

            if ($div >= 1) {

                $t = round($div);

                return $t . ' ' . $str .
                    ($t > 1 ? 's' : '') . ' ago';
            }
        }
    }
    // =====THIS IS NEW TIME ZONE TESTING
    function get_timeago($ptime)
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

    function turnUrlIntoHyperlink($string)
    {
        //The Regular Expression filter
        $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";

        // Check if there is a url in the text
        if (preg_match_all($reg_exUrl, $string, $url)) {
            // Loop through all matches
            foreach ($url[0] as $newLinks) {
                if (strstr($newLinks, ":") === false) {
                    $link = 'http://' . $newLinks;
                } else {
                    $link = $newLinks;
                }

                // Create Search and Replace strings
                $search  = $newLinks;
                $replace = '<a href="' . $link . '" title="' . $newLinks . '" target="_blank">' . $link . '</a>';

                $isyoutube = $this->videoType($newLinks);
                if ($isyoutube) {
                    // ===SHOW YOUTUBE VIDEO
                    parse_str(parse_url($newLinks, PHP_URL_QUERY), $my_array_of_vars);
                    $string = str_replace($search, '', $string);
                    $string .= '<iframe style="width: 100%;" height="315" src="https://www.youtube.com/embed/' . $my_array_of_vars['v'] . '" frameborder="0" allowfullscreen></iframe>';
                } else {
                    // ===SHOW ONLY LINKS
                    $string = str_replace($search, $replace, $string);
                }
            }
        }
        //Return result
        return $string;
    }
}
