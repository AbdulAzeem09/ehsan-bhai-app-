<?php

class _postings
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
        $this->ta = new _tableadapter("spPostings");
        $this->def = new _tableadapter("spuser");
        $this->train = new _tableadapter("sptraining");
        $this->train_des_v = new _tableadapter("sptraining_descr_video");
        $this->req = new _tableadapter("sptrainin_request_course");
        $this->pay = new _tableadapter("sptraining_payment");
        $this->wallet = new _tableadapter("sptrainig_wallet");
        $this->cover = new _tableadapter("sptraining_cover_images");
        $this->preview = new _tableadapter("sptraining_preview_video");
        $this->video = new _tableadapter("sptraining_video");
        $this->attach = new _tableadapter("sptraining_attachment");
        $this->tas = new _tableadapter("spPostings");
        $this->tas->join = "INNER JOIN share as d ON t.idspPostings = d.spPostings_idspPostings ";
        $this->tag = new _tableadapter("spgroup");
        $this->tp = new _tableadapter(" flagtimelinepost");

        ///////////
        $this->ta->join = "LEFT JOIN spgroup as spg ON t.groupid = spg.idspGroup";
        //  $this->ta->join = "LEFT JOIN spprofiles_has_spgroup as shs ON t.groupid = shs.idspGroup";
        /// //////
        $this->tad = new _tableadapter("spBuyPostings");
        $this->ta->dbclose = false;

        //$this->ta->join = "INNER JOIN sppost_has_sporder as d ON t.idspPostings = d.spPostings_idspPostings INNER JOIN sporder as p ON d.spOreder_idspOreder = p.idspOrder";

        $this->pic = new _tableadapter("spPostingPics");
        $this->media = new _tableadapter("spPostingMedia");
    }
    // update notes on the training module
    function updateNotes($notes, $postid)
    {
        $this->ta->update(array("spPostingNotes" => $notes), "WHERE idspPostings ='" . $postid . "'");
    }

    function dolar_training($uid)
    {
        return $this->def->read("WHERE idspUser = " . $uid);
        //echo  $this->def->sql;
        //die('==');

    }
    function getrecord($profileid)
    {
        return $this->ta->read("WHERE idspPostings = " . $profileid);
    }

    function updateNotes_group($notes, $postid)
    {
        $this->ta->update($notes, "WHERE idspPostings ='" . $postid . "'");
    }

    function default_currency($id)
    {
        return $this->def->read("WHERE idspUser=$id");
    }

    function training_payment($data)
    {
        $this->pay->create($data);
    }

    function training_payment_wallet($data)
    {
        $this->wallet->create($data);
    }

    function find_project($project)
    {
        return $this->train->read("WHERE spPostingTitle LIKE '%$project%' AND status=1");
    }
    function request_course($data)
    {
        $this->req->create($data);
    }

    function read_requested_course()
    {
        return $this->req->read();
    }

    function remove2($id)
    {
        $this->req->remove("WHERE id=$id");
    }


    function read_purchase_postid($postid)
    {
        return $this->pay->read("WHERE postid=$postid");
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

    function read_purchase_buyer($postid, $pid)
    {
        return $this->pay->read("WHERE postid=$postid AND buyer_pid=$pid");
    }
    function post($data)
    {
        $postid = $this->ta->create($data);
        return $postid;
    }

    function create_training($data)
    {
        $postid = $this->train->create($data);
        return $postid;
    }
    function read_active_training($uid, $pid)
    {
        return $this->train->read("WHERE spuser_idspuser=$uid AND spprofiles_idspprofiles=$pid AND status=1");
        //echo  $this->train->sql;
        
    }

    function read_active_training_pid($pid)
    {
        return $this->train->read("WHERE  spprofiles_idspprofiles=$pid AND status=1");
    }

    function read_pending_training($uid, $pid)
    {
        return $this->train->read("WHERE spuser_idspuser=$uid AND spprofiles_idspprofiles=$pid AND status=0");
        // echo  $this->train->sql;
        //die('=====');
    }

    function read_draft_training($uid, $pid)
    {
        return $this->train->read("WHERE spuser_idspuser=$uid AND spprofiles_idspprofiles=$pid AND status=2");
        // echo  $this->train->sql;
        //die('=====');
    }

    function read_my_purchase_training($pid)
    {
        return $this->pay->read("WHERE buyer_pid=$pid");
    }


    function read_all_training()
    {
        return $this->train->read("WHERE status=1");
        //echo $this->train->sql;
        //die('==');
    }

    function read_all_home()
    {
        return $this->train->read("WHERE status=1 LIMIT 8");
        //echo $this->train->sql;
        //die('==');
    }
    function read_all_training_category($name)
    {
        return $this->train->read("WHERE trainingcategory in('$name') AND status=1");
        //echo  $this->train->sql;
        //die('==');

    }


    function similar_training($name, $id)
    {
        return $this->train->read("WHERE trainingcategory='$name' AND id=$id ORDER BY id DESC");
    }
    function read_training_pid($pid)
    {
        $pid = $this->train->escapeString($pid);
        return $this->train->read("WHERE spprofiles_idspprofiles=$pid");
    }



    function read_training($id)
    {
        return $this->train->read("WHERE id=$id");
    }

    function createservice($title, $notes, $city, $country, $pid, $phone)
    {
        //$postid = $p->create(array("spPostingTitle" => $data["businesssubcategory_"] ,"spPostingNotes" => $data["spProfileAbout"] ,"spPostingVisibility" => -1 ,"spCategories_idspCategory" => 7 ,"spPostingsCity" => $data["spProfilesCity"] , "spPostingsCountry" =>$data["spProfilesCountry"], "spProfiles_idspProfiles" => $pid));
        $expirydate = date('Y-m-d', strtotime("+30 days"));

        $postid = $this->ta->create(array("spPostingTitle" => $title, "spPostingNotes" => $notes, "spPostingVisibility" => -1, "spCategories_idspCategory" => 7, "spPostingsCity" => $city, "spPostingsCountry" => $country, "spProfiles_idspProfiles" => $pid, "spPostingExpDt" => $expirydate, "spPostingPhone" => $phone));
        return $postid;
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
        $pid = $this->ta->escapeString($pid);
        return $this->ta->read("WHERE t.idspPostings = " . $pid . " AND t.spPostingsStatus = 0");
    }

    function readposting($pid)
    {
        return $this->tp->read("WHERE t.spPosting_idspPosting = $pid ");
    }

    function read_group($pid)
    {
        return $this->tag->read("WHERE t.idspgroup = " . $pid . " ");
    }

    function update($pid, $data)
    {
        $this->ta->update($pid, $data);
       // echo $this->ta->sql; die('xxxxxxxx');
    }

    function update_training($data, $id)
    {
        return $this->train->update($data, "WHERE id=$id");
    }

    function remove_training($id)
    {
        $this->train->remove("WHERE id=$id");
    }
    function create_training_cover_images($files)
    {
        $this->cover->create($files);
    }
    function read_cover_images($id)
    {
        return $this->cover->read("WHERE postid=$id");
    }
    function delete_cover_image($id)
    {
        return $this->cover->remove("WHERE id=$id");
    }
    function create_training_preview_video($files)
    {
        $this->preview->create($files);
    }
    function read_preview_video($id)
    {
        return $this->preview->read("WHERE postid=$id");
    }

    function delete_preview_video($id)
    {
        return $this->preview->remove("WHERE id=$id");
    }

    function delete_preview_video_postid($id)
    {
        return $this->preview->remove("WHERE postid=$id");
    }
    function create_training_video($files)
    {
        $this->video->create($files);
    }

    function create_training_video_des($files)
    {
        return $this->train_des_v->create($files);

        //echo $this->train_des_v->sql; die('==========');    

    }
    function delete_training_video_des($id)
    {
        return $this->train_des_v->remove("WHERE postid=$id");
    }
    function read_video($id)
    {
        return $this->video->read("WHERE postid=$id");
    }

    function read_video_tr($id)
    {
        return $this->train_des_v->read("WHERE postid=$id");
    }

    function delete_video($id)
    {
        return $this->video->remove("WHERE id=$id");
    }

    function delete_video_tr($id)
    {
        return $this->train_des_v->remove("WHERE id=$id");
    }

    function delete_video_postid($id)
    {
        return $this->video->remove("WHERE postid=$id");
    }


    function create_training_attachment($files)
    {
        $this->attach->create($files);
    }

    function read_attachment($id)
    {
        return $this->attach->read("WHERE postid=$id");
    }
    function delete_attachment($id)
    {
        return $this->attach->remove("WHERE id=$id");
    }
    function delete_attachment_postid($id)
    {
        return $this->attach->remove("WHERE postid=$id");
    }

    // DELETE POSTINGS
    function remove($postid)
    {

        $this->ta->remove("WHERE t.idspPostings = " . $postid);
        //echo  $this->ta->sql; die("----------");
    }



    // ================dashboard
    // TRASH POST
    function trashpost($postid)
    {
        $this->ta->update(array("spPostingVisibility" => -3), "WHERE t.idspPostings = " . $postid);
    }

    function flagposts($postid)
    {
        $this->ta->update(array("post_status" => 1), "WHERE t.idspPostings = " . $postid);
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
        echo $buyerid;
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

    //my project detail
    function singletimelines($postid)
    {
        //return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
        return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND spPostingsStatus = ''");
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

    function offsetglobaltimelinesProfiletimelinelimit($start, $pid)
    {
        return $this->ta->read("WHERE  (t.groupid = 0) 
            AND spcategories_idspcategory = 16 
            AND (spPostingVisibility = -1 
                OR spPostingVisibility IN (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles IN (Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))
                )
            AND (t.spprofiles_idspprofiles = " . $pid . " 
                OR  t.spprofiles_idspprofiles IN (SELECT sps.spProfiles_idspProfilesReceiver FROM `spprofiles_has_spprofiles` sps WHERE sps.spProfiles_has_spProfileFlag = 1 
                    AND " . $pid . " IN (
                    sps.spProfiles_idspProfileSender,sps.spProfiles_idspProfilesReceiver))
                OR t.spprofiles_idspprofiles IN (SELECT sps1.spProfiles_idspProfileSender FROM `spprofiles_has_spprofiles` sps1 WHERE sps1.spProfiles_has_spProfileFlag = 1 
                    AND " . $pid . " IN (sps1.spProfiles_idspProfileSender,sps1.spProfiles_idspProfilesReceiver))
                OR idsppostings in(select timelineid from share where spsharetowhom = " . $pid . " )
                )
            AND t.spPostingDate >= '" . $start . "' 
            UNION ALL
            SELECT * FROM sppostings AS t LEFT JOIN spgroup AS spg ON t.groupid = 
            spg.idspgroup WHERE t.idspPostings IN (SELECT timelineid FROM SHARE WHERE 
            spsharetowhom = " . $pid . ")", "ORDER BY idspPostings DESC LIMIT 11");


        
    }

    function offsetglobaltimelinesProfiletimeline122($start, $pid, $row, $rowperpage)
    {
         return $this->ta->read("WHERE  (t.groupid = 0) 
            AND spcategories_idspcategory = 16 
            AND (spPostingVisibility = -1 
                OR spPostingVisibility IN (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles IN (Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))
                )
            AND (t.spprofiles_idspprofiles = " . $pid . " 
                OR  t.spprofiles_idspprofiles IN (SELECT sps.spProfiles_idspProfilesReceiver FROM `spprofiles_has_spprofiles` sps WHERE sps.spProfiles_has_spProfileFlag = 1 
                    AND " . $pid . " IN (
                    sps.spProfiles_idspProfileSender,sps.spProfiles_idspProfilesReceiver))
                OR t.spprofiles_idspprofiles IN (SELECT sps1.spProfiles_idspProfileSender FROM `spprofiles_has_spprofiles` sps1 WHERE sps1.spProfiles_has_spProfileFlag = 1 
                    AND " . $pid . " IN (sps1.spProfiles_idspProfileSender,sps1.spProfiles_idspProfilesReceiver))
                OR idsppostings in(select timelineid from share where spsharetowhom = " . $pid . " )
                )
            AND t.spPostingDate >= '" . $start . "' 
            UNION ALL
            SELECT * FROM sppostings AS t LEFT JOIN spgroup AS spg ON t.groupid = 
            spg.idspgroup WHERE t.idspPostings IN (SELECT timelineid FROM SHARE WHERE 
            spsharetowhom = " . $pid . ")", "ORDER BY spPostingDate DESC LIMIT $row, $rowperpage");

             $this->ta->sql; die('===');
    }

   



    function offsetglobaltimelinesProfiletimeline1($start, $pid)
    {
        return $this->ta->read("WHERE  (t.groupid = 0) 
            AND spcategories_idspcategory = 16 
            AND (spPostingVisibility = -1 
                OR spPostingVisibility IN (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles IN (Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))
                )
            AND (t.spprofiles_idspprofiles = " . $pid . " 
                OR  t.spprofiles_idspprofiles IN (SELECT sps.spProfiles_idspProfilesReceiver FROM `spprofiles_has_spprofiles` sps WHERE sps.spProfiles_has_spProfileFlag = 1 
                    AND " . $pid . " IN (
                    sps.spProfiles_idspProfileSender,sps.spProfiles_idspProfilesReceiver))
                OR t.spprofiles_idspprofiles IN (SELECT sps1.spProfiles_idspProfileSender FROM `spprofiles_has_spprofiles` sps1 WHERE sps1.spProfiles_has_spProfileFlag = 1 
                    AND " . $pid . " IN (sps1.spProfiles_idspProfileSender,sps1.spProfiles_idspProfilesReceiver))
                OR idsppostings in(select timelineid from share where spsharetowhom = " . $pid . " )
                )
            AND t.spPostingDate >= '" . $start . "' 
            UNION ALL
            SELECT * FROM sppostings AS t LEFT JOIN spgroup AS spg ON t.groupid = 
            spg.idspgroup WHERE t.idspPostings IN (SELECT timelineid FROM SHARE WHERE 
            spsharetowhom = " . $pid . ")", "ORDER BY spPostingDate DESC ");
    }

    function offsetglobaltimelinesProfiletimeline($start, $pid, $offset)
    {

        // Latest query on 01-09-2021 (Sid) -- Previous query running was third last
        // first it will check for group nd category, then it will find the post on base of user and his friends at (spprofiles_has_spprofiles) and in the end it will search for posts shared to user account.
        return $this->ta->read("WHERE  (t.groupid = 0) 
            AND spcategories_idspcategory = 16 
            AND (spPostingVisibility = -1 
                OR spPostingVisibility IN (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles IN (Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))
                )
            AND (t.spprofiles_idspprofiles = " . $pid . " 
                OR  t.spprofiles_idspprofiles IN (SELECT sps.spProfiles_idspProfilesReceiver FROM `spprofiles_has_spprofiles` sps WHERE sps.spProfiles_has_spProfileFlag = 1 
                    AND " . $pid . " IN (
                    sps.spProfiles_idspProfileSender,sps.spProfiles_idspProfilesReceiver))
                OR t.spprofiles_idspprofiles IN (SELECT sps1.spProfiles_idspProfileSender FROM `spprofiles_has_spprofiles` sps1 WHERE sps1.spProfiles_has_spProfileFlag = 1 
                    AND " . $pid . " IN (sps1.spProfiles_idspProfileSender,sps1.spProfiles_idspProfilesReceiver))
                OR idsppostings in(select timelineid from share where spsharetowhom = " . $pid . " )
                )
            AND t.spPostingDate >= '" . $start . "' 
            UNION ALL
            SELECT * FROM sppostings AS t LEFT JOIN spgroup AS spg ON t.groupid = 
            spg.idspgroup WHERE t.idspPostings IN (SELECT timelineid FROM SHARE WHERE 
            spsharetowhom = " . $pid . ")", "ORDER BY spPostingDate DESC Limit 0," . $offset);
        //level-1
        // return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
        //level-2

        // return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 ) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select spPostings_idspPostings from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= ".$start."", "ORDER BY spPostingDate DESC");

        // return $this->ta->read("WHERE  (t.groupid = 0) AND (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spprofiles_idspprofiles = ".$pid." or t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 or spProfiles_idspProfiles = ".$pid." AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select timelineid from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= '".$start."' UNION ALL
        //           SELECT * FROM sppostings AS t LEFT JOIN spgroup AS spg ON t.groupid = 
        //           spg.idspgroup WHERE t.idspPostings IN (SELECT timelineid FROM SHARE WHERE 
        //           spsharetowhom = " . $pid . ")", "ORDER BY spPostingDate DESC Limit 0,".$offset);


        // LAST QUERY WITHOUT CATEGORY (14-MAY-19)
        //return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17 OR idspCategory = 9)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");

        //return $this->ta->read("INNER JOIN spposthide AS h ON t.idspPostings != h.spPostings_idspPostings WHERE h.spProfiles_idspProfiles = $pid AND (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
    }
    /*old?09/06/2020*/
    function allgrouptimelinesPost($postid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND t.spcategories_idspcategory = 16 AND t.post_status = 1");
    }

    function allgroup_by_shared_Post($postid)
    {
        return $this->tas->read("WHERE d.spShareToGroup = " . $postid . " AND t.spcategories_idspcategory = 16 AND t.post_status = 2 ORDER BY t.idspPostings DESC");
    }

    function allgrouptimelinesPostPending($postid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND t.spcategories_idspcategory = 16  AND t.post_status = 0 ");
        echo $this->ta->sql;
    }

    function readtimelinesbylimit($pid)
    {
        return  $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spcategories_idspcategory = 16 AND t.spProfiles_idspProfiles =" . $pid . " ORDER BY spPostingDate DESC LIMIT 10");
        //echo $this->ta->sql;
    }
    function loadmoredata($row, $rowperpage, $pid)
    {
        return  $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spcategories_idspcategory = 16 AND t.spProfiles_idspProfiles =" . $pid . " ORDER BY spPostingDate DESC limit $row,$rowperpage");
    }
    function readtimelines($pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spcategories_idspcategory = 16 AND t.spProfiles_idspProfiles =" . $pid . " ORDER BY spPostingDate DESC");
        echo $this->ta->sql;
    }
    /* function allgrouptimelinesPost($postid,$groupid) {
         return $this->ta->read("WHERE t.idspPostings = " .$postid. " or t.spPostingVisibility = " .$groupid. " AND  t.spcategories_idspcategory = 16");
    }*/
    function singletimelinespost($postid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $postid . " And post_status=2 AND t.spcategories_idspcategory = 16");
    }

    function singletimelinespost_group($groptid)
    {
        return $this->ta->read("WHERE t.groupid = " . $groptid . " And post_status=2 AND t.spcategories_idspcategory = 16");

        // echo  $this->ta->sql; die('==========');      

    }

    function singletimelinespostpending($postid)
    {
        return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND t.spcategories_idspcategory = 16");
    }

    function spPostingDate($firstTime, $lastTime = '')
    {
      //  date_default_timezone_set('Asia/Karachi');
     // date_default_timezone_set('Asia/Kolkata');
       $timezone = date_default_timezone_get();
//             date_default_timezone_set($timezone);

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

    // ======YOUTUBE TIMELINE VIDEO AND LINK START
    function videoType($url)
    {
        if (strpos($url, 'youtube') > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function getTimeLinePostUsr($pid)
    {
        return  $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spcategories_idspcategory = 16 AND t.idspPostings =" . $pid . "");
        //echo $this->ta->sql;
    }
}
