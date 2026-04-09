<?php

class _spgroup
{

    // property declaration
    public $dbclose = false;
    private $conn;
    public $ta;
    public $ts;
    public $tad;

    function __construct()
    {
        $this->ta = new _tableadapter("spGroup");
        $this->spg = new _tableadapter("spGroup");
        $this->ta11 = new _tableadapter("spGroup");
        $this->tag = new _tableadapter("spGroup");
        $this->ts = new _tableadapter("spprofiletype");
        $this->tb = new _tableadapter("pos_customer");
        $this->tc = new _tableadapter("customer_membership");
        $this->ta->join = "INNER JOIN spProfiles_has_spGroup as d ON t.idspGroup = d.spGroup_idspGroup 
                        INNER JOIN spProfiles as p ON d.spProfiles_idspProfiles = p.idspProfiles";
        $this->tap = new _tableadapter("spGroup");

        $this->tad = new _tableadapter("spProfiles_has_spGroup");
        $this->tg = new _tableadapter("spprofiles"); // ganesh
        $this->taspg = new _tableadapter("spprofiles_has_spgroup");
        $this->mat = new _tableadapter("spprofiles_has_spgroup");
        $this->ta->dbclose = false;

        $this->sptb = new _tableadapter("spmembership_transaction");
        $this->bsp = new _tableadapter("spmembership");

        $this->gcate = new _tableadapter("group_category");
        $this->p = new _tableadapter("spprofiles");
        $this->inv = new _tableadapter("group_invitation");
        $this->sta = new _tableadapter("spprofiles");

        $this->banner = new _tableadapter("spGroup");
        $this->g_cat = new _tableadapter("group_category");
        $this->pc = new _tableadapter("sppostings"); 
        $this->g_album = new _tableadapter("group_albums"); 
        $this->g_album_p = new _tableadapter("group_album_media_files");  
        $this->announcement = new _tableadapter("group_announcement");
        $this->campaign = new _tableadapter("sms_email_campaigns");
        $this->campaign_eug = new _tableadapter("email_campaign_user_groups");
        $this->campaign_u = new _tableadapter("email_campaign_user");
    }

    //Get group owner -ganesh
    function group_owner($gid)
    {
        return $this->spg->read("WHERE idspGroup =$gid ");
        // echo $this->spg->sql;
    }

    //Creator of group
    function group_spd($pid)
    {
         return $this->sptb->read("WHERE uid =$pid ");
        //echo $this->sptb->sql;die('+++++++++sp');
    }
    function group_spd_1($memb)
    {
         return $this->bsp->read("WHERE idspMembership =$memb ");
        //echo $this->sptb->sql;die('+++++++++sp');
    }

    function get_group_details($pid,$gid)
    {
         return $this->taspg->read("WHERE spGroup_idspGroup=" . $gid . " AND spProfiles_idspProfiles=$pid ");
         //echo $this->taspg->sql;die('+++++++++');
    }

    function readdatabyspid($gid)
    {
        return $this->ta->read("WHERE idspGroup=" . $gid . "");
    }

    function read_profileName($pid)
    {
        return $this->p->read("WHERE idspProfiles=" . $pid . "");
    }

    // general members join request status
    function checkRequestStatus($gid, $pid)
    {    
         return $this->tad->read("WHERE spGroup_idspGroup=" . $gid . " AND spProfiles_idspProfiles=$pid AND spApproveRegect=0 ");
    }

    function checkSubadmin($gid, $pid)
    {
        return $this->tad->read("WHERE spGroup_idspGroup=" . $gid . " AND spProfiles_idspProfiles=$pid AND spApproveRegect=1 AND spAssistantAdmin=1 ");
    }

    function check_mygroup($gid, $pid)
    {
        return  $this->tad->read("WHERE spGroup_idspGroup=" . $gid . " AND spProfiles_idspProfiles=$pid AND spProfileIsAdmin=0");
        // echo $this->tad->sql;
    }

    function read_name($data)
    {
        return $this->tb->read("WHERE uid=$data");
        // echo $this->tb->sql;
        // die('==');
    }


    function publicgroup_nine()
    {
        return $this->ta->read("WHERE t.spgroupflag = 0 ORDER BY RAND() LIMIT 9", "", "DISTINCT idspGroup, spGroupName,spGroupTag , spGroupAbout, spgroupCategory");
    }
    
    function readdstatus($pid)
    {
        $this->taspg->read("WHERE spProfiles_idspProfiles=$pid AND spApproveRegect=2 ");
        echo $this->taspg->sql;
    }

    function checkcreator($gid, $uid)
    {
        return $this->tad->read("WHERE spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . ") AND spGroup_idspGroup=" . $gid . " AND spProfileIsAdmin =0");
    }

    function deletefreelancer($pid, $gid)
    {
        return $this->tad->remove("WHERE spGroup_idspGroup=" . $gid . " AND spProfiles_idspProfiles=" . $pid);
    }

    function checkfreelancer($pid, $uid)
    {
        return $this->ta->read("WHERE t.idspGroup in (SELECT spGroup_idspGroup from spProfiles_has_spGroup WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . "))AND d.spProfiles_idspProfiles=" . $pid . " AND spGroupName='Favourite_Freelancer'");
    }

    function updategrouppic($gid, $image)
    {
        $this->ta->update(array("spgroupimage" => $image), "WHERE idspGroup ='" . $gid . "'");
        // $this->ta->sql; die('------');
    }

    function updategrouplogo($gid, $image)
    {
        $this->ta->update(array("spgrouplogo" => $image), "WHERE idspGroup ='" . $gid . "'");
        // $this->ta->sql; die('------');
    }

    function insrtpic($data){
       $this->ta->create($data);
        // echo $this->ta->sql; die('------');
    }

    function updategrppic($gid, $data)
    {
        $this->ta->update($data, "WHERE idspGroup ='" . $gid . "'");
    }

    function updategroupUG($data, $id)
    {
        return $this->ta->update($data, "WHERE idspGroup ='" . $id . "'");
    }

    function updategroupdata($gid, $aboutgrp, $location)
    {
        $this->ta->update(array("spGroupAbout" => $aboutgrp, "spgroupLocation" => $location), "WHERE idspGroup ='" . $gid . "'");
    }

    function totalgroup()
    {
        return $this->ta->read();
    }

    function friendprofile($uid, $friendid)
    {
        //return $this->ta->read("WHERE d.spProfiles_idspProfiles in (Select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.")))");

        return $this->ta->read("WHERE t.idspGroup in (SELECT spGroup_idspGroup from spProfiles_has_spGroup WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . ")) AND d.spProfiles_idspProfiles=" . $friendid);
        //echo $this->ta->sql;die('======');
    }

    function groupdetails($gid)
    {
         return  $this->ta->read("WHERE t.idspGroup =" . $gid);   

       // echo $this->ta->sql; die;  
    }

    function spprofilestypedata($spprofile)
    {
         return  $this->ts->read("WHERE t.idspProfileType =" . $spprofile);   

      //echo $this->ts->sql; die("hfvsdhf");  
    }
 

    function groupCreatedDate($grid)
    {
        return $this->ta->read("WHERE t.idspGroup =" . $grid);
    }

    function groupdetailspublic($gid)
    {
        return $this->ta->read("WHERE t.idspGroup =" . $gid);
        //  echo $this->ta->sql; die('tttt'); 
    }

    function groupdetailsprivate($gid)
    {
        return $this->ta->read("WHERE t.idspGroup =" . $gid . " AND t.spgroupflag = 1");
    }

    function my_groupdetails($uid)
    {
        return $this->ta->read("WHERE t.spUser_idspUser =" . $uid . " AND t.spgroupflag = 1 AND t.spgroupflag = 0");
    }
    function groupdetailspublicprivate($gid)
    {
        return $this->ta->read("WHERE t.idspGroup = ' $gid ' AND  t.spgroupflag = 0");
    }

    function spApproveRegec($gid)
    {
        return $this->tad->read("WHERE spApproveRegect =" . 0 . " AND spGroup_idspGroup =" . $gid);
       // echo $this->tad->sql;
    }

    function ismember($gid, $pid)
    {        
        // $order = "", $columns = "*", $join = "!", $debug=false
        return $this->tad->read(" WHERE spProfiles_idspProfiles =" . $pid . " AND spGroup_idspGroup =" . $gid .  " AND spApproveRegect = 1","","*","!",false );
    }

    function isMemberInvited($gid, $pid)
    {
        return $this->inv->read("WHERE receiver = $pid and group_id= $gid");
    }

    function read_category($gid)
    {
        return $this->gcate->read("WHERE id =" . $gid);
    }

    function read_all_category()
    {
        return $this->gcate->read("WHERE delete_status =0");
    }

    function read_bannerimage($gid)
    {
        return $this->banner->read("WHERE t.idspGroup =" . $gid);
    }

    function read_title()
    {
        return $this->g_cat->read("WHERE t.status = 0");
    }
    


    function checkmember($gid, $uid)
    {
        return $this->ta->read("WHERE p.spUser_idspUser =" . $uid . " AND t.idspGroup =" . $gid);
    }

    function get_spflage($flag)
    {
        return $this->ta11->read("WHERE idspGroup = $flag ");
        //echo $this->ta11->sql;die('++++++++11111');
    }

    function is_blockedMember($gid, $pid)
    {
        return    $this->tad->read(" WHERE spProfiles_idspProfiles=" . $pid . " AND spGroup_idspGroup =" . $gid ." AND spApproveRegect = 4 "); 
    }
    function is_rejectedMember($gid, $pid)
    {
        return $this->tad->read("WHERE spProfiles_idspProfiles=" . $pid . " AND spGroup_idspGroup =" . $gid ." AND spApproveRegect = 3");       
    }
    
    function blockMember($gid, $pid)
    {
        return $this->tad->update(array("spApproveRegect" => 4), "WHERE spProfiles_idspProfiles=" . $pid . " AND spGroup_idspGroup =" . $gid);
    }

    function unblockMember($gid, $pid)
    {
        return $this->tad->update(array("spApproveRegect" => 1), "WHERE spProfiles_idspProfiles=" . $pid . " AND spGroup_idspGroup =" . $gid);
    }


    function updategrouptype($gid, $type)
    {
        $this->ta->update(array("spgroupflag" => $type), "WHERE idspGroup =" . $gid);
    }


    function rejectrequest($gid, $pid)
    {
        return $this->tad->update(array("spApproveRegect" => 3), "WHERE spProfiles_idspProfiles=" . $pid . " AND spGroup_idspGroup =" . $gid);
    }

    function acceptrequest($gid, $pid)
    {
        return $this->tad->update(array("spApproveRegect" => 1), "WHERE spProfiles_idspProfiles=" . $pid . " AND spGroup_idspGroup =" . $gid);
    }

    function creterequest($gid, $pid)
    {
        $qry = $this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $gid, "spProfileIsAdmin" => 0 , "spAssistantAdmin" => 0, "spApproveRegect" => 0, "requestsend" => 0, "spGroup_newMember_Date"=>date("Y-m-d") ));
        if($qry){
            return $qry;
        }
    }

    function get_group_about($gid)
    {
        //where, order, columns, join, debug
        $where = "WHERE t.idspGroup =$gid ";
        $order = "order by t.idspGroup ";
        $columns = "t.spGroupRules, t.spgroupruletitle, t.spGroupName, t.spGroupAbout, t.spgroupLocation, t.spgroupimage, t.spUserCity, t.spUserState, t.spUserCountry ";
        $join = "";

        return $this->tag->read($where, $order, $columns, $join);
    }

    function grpmember($gid)
    {
        return $this->tad->read("WHERE spGroup_idspGroup =" . $gid . " AND spApproveRegect = 1");
    }

    function allgrpmember($gid)
    {
        return $this->tad->read("WHERE t.spGroup_idspGroup =" . $gid);
    }

    //get all new members
    function newgrpmember($gid)
    {
        $date = date('Y-m-d');
        return $this->tad->read("WHERE t.spGroup_idspGroup =" . $gid . " AND t.spGroup_newMember_Date = '$date'");
    }

    function publicgroup()
    {
        return $this->ta->read("WHERE t.spgroupflag = 0", "", "DISTINCT idspGroup, spGroupName,spGroupTag , spGroupAbout");
    }


    function publicgroup_suggest($intrest)
    {
        return $this->tap->read("WHERE t.spgroupflag = 0  AND  " . $intrest . " ", "", "DISTINCT idspGroup, spGroupName,spGroupTag , spGroupAbout");
    }
    function read_group_status($id)
    {
        return $this->tap->read("WHERE idspGroup=$id");
    }

    function read_group_status_1($uid,$id)
    {
        return $this->mat->read("WHERE spGroup_idspGroup=$id AND spProfiles_idspProfiles=$uid");
         //echo  $this->mat->sql;die('+++++');
    }

    function read_grop_profile($id)
    {
          return $this->mat->read("WHERE spGroup_idspGroup=$id AND spProfileIsAdmin=0");
         //echo  $this->mat->sql;die('+++++');
    }

    function read_profile_id($id)
    {
        return $this->p->read("WHERE idspProfiles=$id ");
         //echo  $this->mat->sql;die('+++++');
    }

    function groupdetails_suggest($intrest)
    {
        return $this->tap->read("WHERE t.idspGroup =" . $intrest);
    }

    function create($data)
    {
        return  $this->ta->create($data);
        // $this->ta->create($data);
    }

    function create1($groupid, $pid)
    {
        return $this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $groupid, "spProfileIsAdmin" => 1, "spApproveRegect" => 1, "spAssistantAdmin" => 0, "spGroup_newMember_Date" =>  date("Y-m-d")));
        
    }


    function admin_Member($pid, $gid)
    {
        return $this->tad->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spGroup_idspGroup =" . $gid);
    }

    function readGroupName($gid)
    {
        return $this->ta->read("WHERE t.idspGroup = " . $gid, "", "DISTINCT idspGroup, spGroupName");
    }
    //add a member in group
    function addmember($data)
    {
        return $this->tad->create($data);
    }
    function checkRequest($pid, $gid)
    {
        return $this->tad->read("Where spProfiles_idspProfiles=$pid AND spGroup_idspGroup=$gid");
    }

    //checking
    function readGroup($pid)
    {
        return $this->tad->read("WHERE spProfiles_idspProfiles =" . $pid);
    }

    //complete
    function asprofile($pid)
    {
        return $this->ta->read("WHERE d.spProfiles_idspProfiles =" . $pid);
    }

    function removeMember($pid, $gid)
    {
        $res = $this->tad->remove("WHERE t.spProfiles_idspProfiles= " . $pid . " AND t.spGroup_idspGroup= " . $gid);
        if($res > 0){
            try{
                //if invitation exist delete that too
                $inv_id =  $this->inv->read("WHERE receiver = $pid and group_id= $gid");
                if($inv_id){
                    $inv_id = mysqli_fetch_all($inv_id,MYSQLI_ASSOC)[0] ;             
                    $inv_id = $inv_id['id'];
                    $this->inv->remove(" WHERE id= $inv_id");
                }
                //if invitation exist delete that too end
            }catch(\Exception $e){}
            return true ;
        } else {
            return false;
        }
    }

    function acceptPost($pid, $gid) // post id , group id
    {
        $res = $this->pc->update(array("t.post_status" => 2)," WHERE t.idspPostings= " . $pid . " AND t.groupid= " . $gid);
        if($res){
            return $res ;
        } else {
            return false;
        }
    }

    function rejectPost($pid, $gid) // post id , group id
    {
        $res = $this->pc->update(array("t.post_status" => 0)," WHERE t.idspPostings= " . $pid . " AND t.groupid= " . $gid);
        if($res){
            return $res ;
        } else {
            return false;
        }
    }

    function makeAssistant($pid, $gid)
    {
        return $this->tad->update(array("t.spAssistantAdmin" => 1, 
                                 "t.spApproveRegect"=>1,
                                  "t.spProfileIsAdmin"=>0  ), 
        " WHERE t.spProfiles_idspProfiles ='" . $pid . "' and t.spGroup_idspGroup = '" . $gid . "'");
    }

    function removeAssistant($pid, $gid)
    {
        return $this->tad->update(array("t.spAssistantAdmin" => 0, 
                                 "t.spApproveRegect"=>1,
                                  "t.spProfileIsAdmin"=>0  ), 
        "WHERE t.spProfiles_idspProfiles ='" . $pid . "' and t.spGroup_idspGroup = '" . $gid . "'");
    }

    function accpetrequest($pid, $gid, $flag)
    {
        return $this->tad->update(array("t.spApproveRegect" => ".$flag.", "t.spProfileIsAdmin" => 1), "WHERE t.spProfiles_idspProfiles ='" . $pid . "' and t.spGroup_idspGroup = '" . $gid . "'");
    }

    function reject_Request($pid, $gid)
    {
        return $this->tad->remove("WHERE t.spProfiles_idspProfiles =$pid and t.spGroup_idspGroup =$gid ");
    }

    function read($pid)
    {
        return $this->ta->read("WHERE idspGroup =" . $pid);
    }

    function pendingRequests($gid)
    {
        return $this->tad->read("WHERE spGroup_idspGroup =" . $gid . " AND spProfileIsAdmin=0");
    }
    function read2($pid)
    {
        return $this->ts->read("WHERE idspProfileType  =$pid");
        // echo $this->ts->sql;die;
    }

    function removeGroup($gid)
    {
        $this->ta->remove("WHERE t.idspGroup = " . $gid);
    }

    function update($gid, $data)
    {
        return $this->ta->update($gid, $data);
    }

    function abt_upd($grpid, $grpabt)
    {
        $data = array('t.spGroupAbout' => filter_var($grpabt, FILTER_SANITIZE_STRING) );
        return $this->tag->update($data, " WHERE t.idspGroup = $grpid");
    }

    function rule_upd($grpid, $grprule, $grpruletitle)
    {
        $data = array('t.spGroupRules'=> filter_var($grprule, FILTER_SANITIZE_STRING) , 't.spgroupruletitle' => filter_var($grpruletitle, FILTER_SANITIZE_STRING) );
        return $this->tag->update($data, " WHERE t.idspGroup = $grpid");
    }

    function grp_privacy_upd($grpid, $privacy)
    {
        $data = array('t.spgroupflag'=>$privacy);
        return $this->tag->update($data, " WHERE t.idspGroup = $grpid");
    }

    function members($gid)
    {
        return $this->ta->read("WHERE t.idspGroup = " . $gid . "  ORDER BY t.idspGroup DESC");
        //echo $this->ta->sql;
    } 

    function members_pending($gid)
    {
        return $this->ta->read("WHERE t.idspGroup = " . $gid . " AND spApproveRegect = 4  ORDER BY t.idspGroup DESC");
        // echo $this->ta->sql;  die("====");
    }

    //-- ganesh
    function group_members_pending($gid)
    {
        //where, order, columns, join, debug
        $where = " WHERE u.spGroup_idspGroup = $gid and u.spApproveRegect=0 ";
        $order = " ORDER BY t.idspProfiles DESC;";
        $columns = " t.idspProfiles, t.spProfileName, t.spProfileEmail,t.spProfilePic, v.spProfileTypeName as profile_type ";
        $join = " join spprofiles_has_spgroup as u on t.idspProfiles = u.spProfiles_idspProfiles
                join spprofiletype as v on t.spProfileType_idspProfileType=v.idspProfileType  " ;
        return $this->tg->read($where, $order, $columns, $join);
    }

    function members_pending_reply($gid, $pid)
    {
        return $this->ta->read("WHERE t.idspGroup = " . $gid . "  AND d.spProfiles_idspProfiles = " . $pid . " AND spApproveRegect = 2  ORDER BY t.idspGroup DESC");
    }

    function pendingRequestsOfGroup($gid)
    {
        return $this->ta->read("WHERE t.idspGroup = " . $gid . " AND spApproveRegect = 0", "ORDER BY t.idspGroup DESC", "COUNT(*) AS pendingMembers");
    }

    //-- ganesh
    function joinedMembersOfGroup($gid)
    {
        //where, order, columns, join, debug
        $where = " WHERE u.spGroup_idspGroup = $gid and u.spApproveRegect=1 ";
        $order = " ORDER BY t.idspProfiles DESC;";
        $columns = " t.idspProfiles, t.spProfileName, t.spProfileEmail,t.spProfilePic, v.spProfileTypeName as profile_type, u.spProfileIsAdmin as isAdmin, u.spAssistantAdmin as isAsstAdmin, g.spProfiles_idspProfiles as groupOwnerId ";
        $join = " join spprofiles_has_spgroup as u on t.idspProfiles = u.spProfiles_idspProfiles
                 join spprofiletype as v on t.spProfileType_idspProfileType=v.idspProfileType   
                 join spgroup as g on u.spGroup_idspGroup = g.idspGroup  " ; 
       return $this->tg->read($where, $order, $columns, $join);   
    }

    public function group_pending_timelines_count($groupid){
        if($groupid > 0) {
            //where, order, columns, join, debug
            $where = " where t.groupid = $groupid and post_status = 1 ";
            $order = ' ';
            $columns = "count(idspPostings) total ";
            $join = '' ;
            return $this->pc->read($where, $order, $columns, $join );         
        }
    }

    //-- ganesh
    function rejectedMembersOfGroup($gid)
    {
        //where, order, columns, join, debug
        $where = " WHERE u.spGroup_idspGroup = $gid and u.spApproveRegect=3 ";
        $order = " ORDER BY t.idspProfiles DESC;";
        $columns = " t.idspProfiles, t.spProfileName, t.spProfileEmail,t.spProfilePic , v.spProfileTypeName as profile_type ";
        $join = " join spprofiles_has_spgroup as u on t.idspProfiles = u.spProfiles_idspProfiles 
                 join spprofiletype as v on t.spProfileType_idspProfileType=v.idspProfileType" ;
        return $this->tg->read($where, $order, $columns, $join ); 
    }

    //-- ganesh
    function blockedMembersOfGroup($gid)
    {
        //where, order, columns, join, debug
        $where = " WHERE u.spGroup_idspGroup = $gid and u.spApproveRegect=4 ";
        $order = " ORDER BY t.idspProfiles DESC;";
        $columns = " t.idspProfiles, t.spProfileName, t.spProfileEmail,t.spProfilePic , v.spProfileTypeName as profile_type ";
        $join = " join spprofiles_has_spgroup as u on t.idspProfiles = u.spProfiles_idspProfiles
                join spprofiletype as v on t.spProfileType_idspProfileType=v.idspProfileType " ;
        return $this->tg->read($where, $order, $columns, $join ); 
    }

    function joinrequest($gid)
    {
        return $this->ta->read("WHERE t.idspGroup = " . $gid . " AND d.spApproveRegect = 0 ORDER BY t.idspGroup DESC");
        // echo $this->ta->sql;
    }

    function profilemembers($pid)
    {
        return $this->ta->read("WHERE d.spprofiles_idspprofiles  = " . $pid . " AND (d.spApproveRegect IS NULL OR d.spApproveRegect = 1) order by d.spProfileIsAdmin");
    }

    function profilememberslimit($pid)
    {
        return $this->ta->read("WHERE d.spprofiles_idspprofiles  = " . $pid . " AND (d.spApproveRegect IS NULL OR d.spApproveRegect = 1) order by d.spProfileIsAdmin", "LIMIT 5");
    }

    function readmyretailgroupstore($pid)
    {
        return $this->ta->read("INNER JOIN spProduct as s on t.spGroupName = s.spgroup where d.spprofiles_idspprofiles = " . $pid . " and s.sellType = 'Retail' ORDER BY s.idspPostings DESC");
    }

    function readmyretailgroupstorelimit($pid)
    {
        return $this->ta->read("INNER JOIN spProduct as s on t.spGroupName = s.spgroup where d.spprofiles_idspprofiles = " . $pid . " and s.sellType = 'Retail' ORDER BY s.idspPostings DESC", "LIMIT 5");
        //echo $this->ta->sql;
    }

    function readmywholesalegroupstore($pid)
    {
        return $this->ta->read("INNER JOIN spProduct as s on t.spGroupName = s.spgroup where d.spprofiles_idspprofiles = " . $pid . " and s.sellType = 'Wholesaler' ORDER BY s.idspPostings DESC");
    }

    function readmywholesalegroupstorelimit($pid)
    {
        return $this->ta->read("INNER JOIN spProduct as s on t.spGroupName = s.spgroup where d.spprofiles_idspprofiles = " . $pid . " and s.sellType = 'Wholesaler' ORDER BY s.idspPostings DESC", "LIMIT 5");
         //echo $this->ta->sql;
    }

    function readmyauctiongroupstore($pid)
    {
        return $this->ta->read("INNER JOIN spProduct as s on t.spGroupName = s.spgroup where d.spprofiles_idspprofiles = " . $pid . " and s.sellType = 'Auction' ORDER BY s.idspPostings DESC");
    }

    function readmyauctiongroupstorelimit($pid)
    {
        return $this->ta->read("INNER JOIN spProduct as s on t.spGroupName = s.spgroup where d.spprofiles_idspprofiles = " . $pid . " and s.sellType = 'Auction' ORDER BY s.idspPostings DESC", "LIMIT 5");
        //echo $this->ta->sql;
    }

    function grouplist($name)
    {
        $result = $this->ta->read("WHERE t.spGroupName  like ('%" . $name . "%')", "", "DISTINCT idspGroup, spGroupName");
        if ($result != false) {
            while ($rs = $result->fetch_assoc()) {
                $data[] = array('value' => $rs['idspGroup'], 'label' => $rs['spGroupName']);
            }
            echo json_encode($data);
        } else
            echo "no data";
    }

    function mygrouplist($name, $uid, $pid)
    {
        $result = $this->ta->read("WHERE t.spGroupName  like ('%" . $name . "%')  AND idspGroup in (Select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . ")) AND d.spApproveRegect=1 AND d.spProfiles_idspProfiles =" . $pid . "", "", "DISTINCT idspGroup, spGroupName");
        if ($result != false) {
            while ($rs = $result->fetch_assoc()) {
                $data[] = array('value' => $rs['idspGroup'], 'label' => $rs['spGroupName']);
            }
            echo json_encode($data);
        } else
            echo "no data";
    }

    function sharedgroup($gid)
    {
        return $this->ta->read("WHERE t.idspGroup = " . $gid, "", "DISTINCT idspGroup, spGroupName");
    }

    function group($pid)
    {
        return $this->ta->read("WHERE idspGroup in (Select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles=" . $pid . ")", "", "DISTINCT idspGroup, spGroupName ,spApproveRegect");
    }

    function readMember($pid, $gid)
    {        
        $order = ""; 
        $columns = "*"; 
        $join = "!"; 
        $debug = false;
        return $this->tad->read("WHERE t.spProfiles_idspProfiles= " . $pid . " AND t.spGroup_idspGroup= " . $gid, $order, $columns, $join);
    }

    function allgroup($uid)
    {
        return $this->ta->read("WHERE p.spUser_idspUser =" . $uid . " AND d.spProfileIsAdmin = 0");
    }

    function allmygroup($pid)
    {
        return $this->ta->read("WHERE d.spProfiles_idspProfiles = $pid AND d.spProfileIsAdmin = 0");
    }

    //show all group. jo ap ny join ni kiya howay.
    function notgroupmember($uid)
    {
        return $this->ta->read("WHERE t.idspGroup NOT IN (SELECT spGroup_idspGroup from spProfiles_has_spGroup WHERE spProfiles_idspProfiles NOT IN (SELECT idspProfiles from spProfiles WHERE spUser_idspUser <>" . $uid . ")) And spgroupflag != 1", "", "DISTINCT idspGroup, spGroupName,spgroupflag");
        // echo $this->ta->sql;
    }

    //show all group. jo ap ny join kiya howay.
    function groupmember($uid)
    {
        //return $this->ta->read("where d.spProfiles_idspProfiles = '$uid' AND d.spApproveRegect = 1 AND d.spProfileIsAdmin = 0");
        return  $this->ta->read("WHERE t.idspGroup in (SELECT spGroup_idspGroup from spProfiles_has_spGroup WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . "))", "", "DISTINCT idspGroup, spGroupName,spgroupflag");
        //echo $this->ta->sql;
    }


    // function groupmember_new($pid)
    // {
    //     //return $this->ta->read("where d.spProfiles_idspProfiles = '$uid' AND d.spApproveRegect = 1 AND d.spProfileIsAdmin = 0");
    //       return $this->ta->read("WHERE t.idspGroup in (SELECT spGroup_idspGroup from spProfiles_has_spGroup WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles WHERE idspProfiles =" . $pid . "))", "", "DISTINCT idspGroup, spGroupName,spgroupflag");
    //     //echo $this->ta->sql;
    //     //die('==111111111222');
    // }

    function profilegroupmember($pid, $txtTitle = "", $status = "", $status2 = "")
    {
        $query = "Where d.spProfiles_idspProfiles = '$pid' AND d.spApproveRegect = 1 AND d.spProfileIsAdmin = 1 ";
        if(!empty($txtTitle)){
            $query .= " AND t.spGroupName  like ('%" . $txtTitle . "%') ";
        }
        if($status && $status != "all"){
            $status = ($status === "public") ? 0 : 1;
            $query .= " AND t.spgroupflag = $status ";
        }

        if($status2 && $status2 != "all"){
            $query .= " AND t.status = '".$status2."' ";
        }

        $query .= " ORDER BY `idspGroup` DESC ";
        return $this->ta->read($query);
    }

    function profilegroupmember11($pid)
    {
        return $this->ta->read("where d.spProfiles_idspProfiles = '$pid' AND d.spApproveRegect = 1 AND d.spProfileIsAdmin = 0 ORDER BY `idspGroup` DESC ");
    }

    function getMemberLiveGroups($pid)
    {
        $result = $this->ta->read("where t.spProfiles_idspProfiles = '$pid' AND d.spApproveRegect = 1 AND d.spProfileIsAdmin = 1 and t.status = 'active' ORDER BY `idspGroup` DESC ");
        return $result->num_rows ?? 0;
    }

    function profilegroupmember_d($pid, $txtTitle = "", $status = "", $status2 = "")
    {
        $cpid = $_SESSION['pid'];
        $query = "where d.spProfiles_idspProfiles = '$pid' AND d.spApproveRegect = 1 AND t.status='active' AND t.spProfiles_idspProfiles != '$cpid' ";
        if(!empty($txtTitle)){
            $query .= " AND t.spGroupName  like ('%" . $txtTitle . "%') ";
        }
        if($status && $status != "all"){
            $status = ($status === "public") ? 0 : 1;
            $query .= " AND t.spgroupflag = $status ";
        } 

        if($status2 && $status2 != "all"){
            $query .= " AND t.status = '".$status2."' ";
        }
        
        $query .= " ORDER BY `idspGroup` DESC ";
        return $this->ta->read($query);
        // echo $this->ta->sql;
    }

    function getMyCityGroup($pid, $city)
    {
        return $this->ta->read("where d.spProfiles_idspProfiles = '$pid' AND d.spApproveRegect = 1 AND d.spProfileIsAdmin = 0 AND t.spUserCity = '$city' LIMIT 3");
        echo $this->ta->sql;
    }

    function getMyCityallGroup($pid, $city)
    {
        return $this->ta->read("where d.spProfiles_idspProfiles = '$pid' AND d.spApproveRegect = 1 AND d.spProfileIsAdmin = 0 AND t.spUserCity = '$city'");
    }

    function joingroupmember($pid)
    {
        return $this->ta->read("where d.spProfiles_idspProfiles = '$pid' AND d.spProfileIsAdmin = 1 AND spApproveRegect=1");
    }

    function joingroupmemberall($pid, $txtTitle = "", $status = "", $status2 = "")
    {
        $query = "where d.spProfiles_idspProfiles = '$pid' AND t.spProfiles_idspProfiles != '$pid' AND spApproveRegect=1 AND t.status='active' ";
        if(!empty($txtTitle)){
            $query .= " AND t.spGroupName  like ('%" . $txtTitle . "%') ";
        }
        if($status && $status != "all"){
            $groupStatus = ($status === "public") ? 0 : 1;
            $query .= " AND t.spgroupflag = $groupStatus ";
        }

        if($status2 && $status2 != "all"){
            $query .= " AND t.status = '".$status2."' ";
        }

        return $this->ta->read($query);
    }

    function readpendingrequest($pid, $type = null, $txtTitle = "", $status = "", $status2 = "")
    {
        if(is_null($type)){
            return $this->tad->read(" where t.spProfiles_idspProfiles = $pid AND t.spApproveRegect=0 ");
        }else{
            $where = " where t.receiver = $pid AND t.invitation_status = 0 ";
            if(!empty($txtTitle)){
                $where .= " AND g.spGroupName  like ('%" . $txtTitle . "%') ";
            }
            if($status && $status != "all"){
                $groupStatus = ($status === "public") ? 0 : 1;
                $where .= " AND g.spgroupflag = $groupStatus ";
            }    

            if($status2 && $status2 != "all"){
                $where .= " AND g.status = '".$status2."' ";
            }

            $order = " ORDER BY t.id DESC; ";
            $columns = " * ";
            $join = " join spgroup as g on t.group_id = g.idspGroup  " ;
            
            return $this->inv->read($where, $order, $columns, $join);
            // echo $this->inv->sql;
        }
    }

    function reject_d($id)
    {
        return $this->taspg->remove("WHERE id = $id");
        //echo $this->taspg->sql;
    }

    function suggestedgroupmember($pid)
    {
        return $this->ta->read("where d.spProfiles_idspProfiles != '$pid' AND d.spApproveRegect = 0 AND d.spProfileIsAdmin = 0");
    }

    function groupmember_title($txtTitle, $address, $status)
    {
        $query = "WHERE t.spGroupName  like ('%" . $txtTitle . "%') ";
        if($status && $status != "all"){
            $query .= " t.spgroupflag = '".$status."' ";
        } 

        $query .= " GROUP BY idspGroup ORDER BY t.idspGroup  DESC";
        return $this->ta->read($query);
    }

    function suggest_group($pid = null, $category = [], $txtTitle = "", $status = "", $status2 = ""){
        if($pid){
            $query = "Where t.spProfiles_idspProfiles != '$pid' AND t.spgroupCategory in (".implode(",", $category).") ";
            if(!empty($txtTitle)){
                $query .= " AND t.spGroupName  like ('%" . $txtTitle . "%') ";
            }
            if($status && $status != "all"){
                $groupStatus = ($status === "public") ? 0 : 1;
                $query .= " AND t.spgroupflag = $groupStatus ";
            }   

            if($status2 && $status2 != "all"){
                $query .= " AND t.status = '".$status2."' ";
            }

            $query .= " AND t.status='active' GROUP BY idspGroup ORDER BY t.idspGroup  DESC";
            return $this->ta->read($query);
        }
        return $this->ta->read(" AND t.status='active' GROUP BY idspGroup ORDER BY t.idspGroup  DESC");
    }


    function groupmember_title_1($spgroupcategory,$txtTitle, $userLocation)
    {
        /* return $this->ta->read("WHERE  t.spGroupName  like ('%" . $txtTitle . "%') AND t.idspGroup in (SELECT spGroup_idspGroup from spProfiles_has_spGroup WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . "))", "", "DISTINCT idspGroup, spGroupName,spgroupflag");*/
        // return $this->ta->read("WHERE t.spgroupflag = 0 AND t.spGroupName  like ('%" . $txtTitle . "%') AND t.spgroupLocation like ('%".$userLocation."%') GROUP BY idspGroup ORDER BY t.idspGroup DESC");
        return $this->ta->read("WHERE t.spGroupName  like ('%" . $txtTitle . "%') and spgroupCategory='$spgroupcategory' GROUP BY idspGroup ORDER BY t.idspGroup DESC");
    }

    function groupmember_status_1($status, $txtTitle)
    {
        $status = $status === "public" ? 0 : 1;
        $query = "WHERE t.spGroupName  like ('%" . $txtTitle . "%') AND t.status = 'active' AND spgroupflag='$status' ";
        $query .= " GROUP BY idspGroup  ORDER BY t.idspGroup DESC";
        return $this->ta->read($query);
    }

    function groupmember_category($category, $userLocation)
    {
        // return $this->ta->read("WHERE t.spgroupflag = 0 AND t.spgroupLocation like ('%".$userLocation."%') AND t.spgroupCategory  like ('%" . $category . "%') GROUP BY idspGroup ORDER BY t.idspGroup DESC");
        return $this->ta->read("WHERE t.spgroupCategory  like ('%" . $category . "%') GROUP BY idspGroup ORDER BY t.idspGroup DESC");
    }

    function groupmember_status($status)
    {
        $query = "WHERE t.status = 'active' ";
        $status = $status === "public" ? 0 : 1;
        if($status && $status != "all"){
            $groupStatus = ($status === "public") ? 0 : 1;
            $query .= " AND t.spgroupflag = $groupStatus ";
        }   

        $query .= " GROUP BY idspGroup ORDER BY t.idspGroup DESC";
        return $this->ta->read($query);
    }

    // READ ALL RFQ'S
    function readAll_groupmember()
    {
        $query = "WHERE t.status='active' GROUP BY idspGroup ORDER BY t.idspGroup DESC";
        return $this->ta->read($query);
    }

    function groupmember_title_cat($category, $title, $userLocation)
    {
        // return $this->ta->read("WHERE t.spgroupflag = 0 AND t.spgroupCategory  like ('%" . $category . "%') AND t.spGroupName  like ('%" . $title . "%') AND t.spgroupLocation like ('%".$userLocation."%') GROUP BY idspGroup ORDER BY t.idspGroup DESC");
        // return $this->ta->read("WHERE t.spgroupflag = 0 AND t.spgroupCategory  like ('%" . $category . "%') AND t.spGroupName  like ('%" . $title . "%') GROUP BY idspGroup ORDER BY t.idspGroup DESC");
        return $this->ta->read("WHERE t.spgroupCategory  =  $category  AND t.spGroupName  like ('%" . $title . "%') GROUP BY idspGroup ORDER BY t.idspGroup DESC");
    }

    //show all group which is my profile is added
    function groupmemberprofile($pid)
    {
        return $this->ta->read("WHERE t.idspGroup in (SELECT spGroup_idspGroup from spProfiles_has_spGroup WHERE spProfiles_idspProfiles = $pid)", "", "DISTINCT idspGroup, spGroupName,spgroupflag");
    }

    //add member to group from timeline frnd
    function addmemberGroup($pid, $gid, $admin, $aprove, $assAdmin, $date)
    {
        return $this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $gid, "spProfileIsAdmin" => $admin, "spApproveRegect" => $aprove, "spAssistantAdmin" => $assAdmin, "spGroup_newMember_Date" => $date));
    }


    function newaddmemberGroup($pid, $gid, $admin, $aprove, $assAdmin, $date, $reqestsend)
    {
        return $this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $gid, "spProfileIsAdmin" => $admin, "spApproveRegect" => $aprove, "spAssistantAdmin" => $assAdmin, "spGroup_newMember_Date" => $date, "requestsend" => $reqestsend));
    }

    //chek user added or not
    function chkAlreadyAdded($pid, $gid)
    {
        return $this->tad->read("WHERE spProfiles_idspProfiles = $pid AND spGroup_idspGroup = $gid");
    }

    function readfreelancers($uid)
    {
        return $this->ta->read("WHERE p.spUser_idspUser=" . $uid . " AND d.spProfileIsAdmin = 0");
    }

    function createFreelancer($pid)
    {
        $id = $this->ta->create(array("spGroupName" => "Favourite_Freelancer", "spGroupTag" => "Favourite freelancer", "spGroupAbout" => "It contains favourite freelancer", "spgroupflag" => 0));
        $this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $id, "spProfileIsAdmin" => 0, "spApproveRegect" => 1));
        return $id;
    }

    function addfreelancer($gid, $pid)
    {
        $this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $gid, "spProfileIsAdmin" => 1, "spApproveRegect" => 1));
    }

    function publicgroupauto($name)
    {
        $result = $this->ta->read("WHERE t.spGroupName  like ('%" . $name . "%') AND t.spgroupflag = 0", "", "DISTINCT idspGroup, spGroupName");
        if ($result != false) {
            while ($rs = $result->fetch_assoc()) {
                $data[] = array('value' => $rs['idspGroup'], 'label' => $rs['spGroupName']);
            }
            echo json_encode($data);
        } else
            echo "no data";
    }

    //show group admin through group id. --ganesh
    function readgroupAdmin($gid)
    {
        //where, order, columns, join, debug
        $where = " WHERE u.spGroup_idspGroup = $gid and u.spProfileIsAdmin=1 and u.spApproveRegect=1 ";
        $order = " ORDER BY t.idspProfiles DESC;";
        $columns = " t.idspProfiles, t.spProfileName, t.spProfileEmail,t.spProfilePic, v.spProfileTypeName as profile_type, u.spProfileIsAdmin as isAdmin, u.spAssistantAdmin as isAsstAdmin, g.spProfiles_idspProfiles as groupOwnerId ";
        $join = " join spprofiles_has_spgroup as u on t.idspProfiles = u.spProfiles_idspProfiles
                join spprofiletype as v on t.spProfileType_idspProfileType=v.idspProfileType  
                join spgroup as g on u.spGroup_idspGroup = g.idspGroup " ;

        return $this->tg->read($where, $order, $columns, $join  );
    }

    //show group assist admin through group id. --ganesh
    function readgroupAsstAdmin($gid)
    {
        //where, order, columns, join, debug
        $where = " WHERE u.spGroup_idspGroup = $gid and u.spAssistantAdmin=1 and u.spApproveRegect=1 ";
        $order = " ORDER BY t.idspProfiles DESC;";
        $columns = " t.idspProfiles, t.spProfileName, t.spProfileEmail,t.spProfilePic, v.spProfileTypeName as profile_type, u.spProfileIsAdmin as isAdmin, u.spAssistantAdmin as isAsstAdmin, g.spProfiles_idspProfiles as groupOwnerId ";
        $join = " join spprofiles_has_spgroup as u on t.idspProfiles = u.spProfiles_idspProfiles 
                  join spprofiletype as v on t.spProfileType_idspProfileType=v.idspProfileType
                  join spgroup as g on u.spGroup_idspGroup = g.idspGroup " ;

        return $this->tg->read($where, $order, $columns, $join );
    }


    //show public group jo ap ny join ni kiya howay.
    function public_not_join($gid, $pid)
    {
        return $this->tad->read("WHERE spGroup_idspGroup = '$gid' AND spProfiles_idspProfiles = '$pid' ");
    }

    function publicgroup_two()
    {
        return $this->ta->read("WHERE t.spgroupflag = 0 ORDER BY RAND()", "", "DISTINCT idspGroup, spGroupName,spGroupTag , spGroupAbout, spgroupCategory");
        // echo $this->ta->sql;
        // die("00000");
    }
    function skk_gg($gid)
    {
         return $this->mat->read("WHERE spGroup_idspGroup = $gid AND spProfileIsAdmin = 0");
         //echo $this->mat->sql;
         //die("mukesh");
    }
    function smmkk($fid)
    {
        return $this->sta->read("WHERE idspProfiles = $fid");
          //echo $this->sta->sql;
         // die("mukesh");
    }

    function isGroupAdmin($pid, $gid) 
    {
       return $this->tad->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spGroup_idspGroup =" . $gid . " AND t.spProfileIsAdmin = 1"); 
       //echo $this->tad->sql;;
    }


    function setGroupAdmin($pid, $gid) 
    {
        return $this->tad->update(array("t.spAssistantAdmin" => 0, "t.spApproveRegect"=>1, "t.spProfileIsAdmin"=>1  ), "WHERE spProfiles_idspProfiles=" . $pid . " AND spGroup_idspGroup =" . $gid);
    }

    function removeGroupAdmin($pid, $gid)
    {
        return $this->tad->update(array("t.spAssistantAdmin" => 0, "t.spApproveRegect"=>1, "t.spProfileIsAdmin"=>0  ), "WHERE spProfiles_idspProfiles=" . $pid . " AND spGroup_idspGroup =" . $gid);
    }

    function srchProfile($txt, $gid)
    {
        $columns = " t.idspProfiles pid, t.spProfileName pname, t.spProfilePic pfpc, d.spProfileTypeName ptype";
        $where = " WHERE spAccountStatus = 1 and d.idspProfileType != 5 and spprofilesPublished = 1 and profile_status='public' and spProfileName like '".$txt."%'";
        $order = " ORDER BY t.spProfileName ASC LIMIT 150;";
        $join = " INNER JOIN spProfileType as d ON t.spProfileType_idspProfileType = d.idspProfileType" ;
        return $this->p->read($where, $order, $columns, $join);
        // echo $this->p->sql;die();
    }

    // function srchProfile($txt, $gid)
    // {
    //     $columns = " t.idspProfiles pid, t.spProfileName pname, t.spProfilePic pfpc, u.invitation_status, u.group_id  ";
    //     $where = " WHERE spAccountStatus=1 and spprofilesPublished=1 and (profile_status='public' or u.group_id = $gid) and spProfileName like '".$txt."%'";
    //     $order = " ORDER BY t.spProfileName ASC LIMIT 150;";
    //     $join = " left join group_invitation u on t.idspProfiles = u.receiver " ;
    //     return $this->p->read($where, $order, $columns, $join);
    //     // echo $this->p->sql;die();
    // }

    function invite_toGroup($invitees, $sender, $groupid) 
    {
        $insrts = '';
        //check if exist already remove that id else insert new
        foreach ($invitees as $invt) {
            $res =  $this->inv->read("WHERE receiver = $invt and group_id= $groupid");
            if( $res && mysqli_num_rows($res) > 0){
                if(($key = array_search($invt, $invitees)) !== false) {
                    unset($invitees[$key]);
                }
            }
            else{
                $newdata = array("sender" => $sender, "receiver" => $invt, "group_id" => $groupid, "message_status" => 0, "send_date" => date("Y-m-d"), "update_date" => date("Y-m-d"), "invitation_status" => 0);
                $insrts.= $this->inv->create($newdata).",";
                $pprofile = $this->getGroupPersonalProfileWithGroup($groupid, $invt);
                if($pprofile && !empty($pprofile['spProfileEmail'])){
                    $email = new _email;
                    $message = "<p>You have received invitation to join for group ".$pprofile['group_name']."</p> 
                    <a href='".BASE_URL."/grouptimelines/?groupid=".$groupid."&groupname=".$pprofile['group_name']."&timeline&page=1'>View Group</a>
                    ";
                    $subject = 'Received invitation To Join Group '. $pprofile['group_name'];
                    $email->sendCommonMail($pprofile['spProfileName'], $pprofile['spProfileEmail'], $subject,$message);
                }
                 
            }
        }
         
        // return those ids which are newly inserted
        return array_values($invitees); 
    }

    function action_grp_invitation($id, $action)
    {       
        if ($action == 'accept'){
            //1st get groupid and profile id
            $gid_pid = $this->get_invitation_gid_pid($id);
            $gid_pid = mysqli_fetch_all($gid_pid,MYSQLI_ASSOC)[0] ;             
            $pid = $gid_pid['receiver'];
            $gid = $gid_pid['group_id'];

            //2nd check pid exist in that group or not then add member to group
            $res = $this->readMember($pid, $gid);
            //return $res;

            if($res == false)
            { 
                //1st create approved member
                $qry = $this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $gid, "spProfileIsAdmin" => 0 , "spAssistantAdmin" => 0, "spApproveRegect" => 1, "requestsend" => 0, "spGroup_newMember_Date"=>date("Y-m-d") ));                                        
                //2nd respond that action is done
                $data = array('message_status'=>1, 'invitation_status'=>1, 'update_date'=>date("Y-m-d"));
                return $this->inv->update($data, " WHERE id=$id");

            } 
            else {
                // if in case user is pending for approval by admin, auto approve him as he was invted by user/member along with new members own request to join
                $this->acceptrequest($gid, $pid);
                // else means already exist in group so
                // pretend (1 indicates ) that user is added to group
                return 1;
            }

        }   
        if ($action == 'reject'){          
             return $this->inv->remove(" WHERE id=$id");
        } 
    }

    private function get_invitation_gid_pid($id){
        return $this->inv->read(" WHERE id=$id");
    }


    function SearchGrouplist($name, $uid, $pid)
    {
        /* $result = $this->ta->read("WHERE t.spGroupName  like ('%" . $name . "%') AND idspGroup in (Select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " .$pid." )", "","DISTINCT idspGroup, spGroupName");
          if ($result != false) {
          while($rs = $result->fetch_assoc()) {
          $data[] = array('value'=>$rs['idspGroup'], 'label'=>$rs['spGroupName']);
          }
          echo json_encode($data);
          }
          else
          echo "no data"; */

        $result = $this->ta->read("WHERE t.spGroupName  like ('%" . $name . "%')  AND idspGroup in (Select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . "))  AND d.spApproveRegect=1 AND d.spProfiles_idspProfiles =" . $pid . "", "", "DISTINCT idspGroup, spGroupName");
        $data = [];
        if ($result != false) {
            while ($rs = $result->fetch_assoc()) {
                $data[] = array('id' => $rs['idspGroup'], 'text' => $rs['spGroupName']);
            }
        }
        return $data;
    }


    public function getGroupPersonalProfileWithGroup($groupid, $pid = null){
        $res = $this->group_owner($groupid);
        $gowner = $g_personal_profile = null;
        if ($res) {
            $group = mysqli_fetch_assoc($res);
            $gpid = $group['spProfiles_idspProfiles'];
            if($pid){
                $gpid = $pid;
            }           
            if(!empty($gpid)){
                $gprofile = $this->p->read("WHERE t.idspProfiles =" . $gpid . "");
                $gprofile = ($gprofile) ?  mysqli_fetch_assoc($gprofile) : null;
            }

            if($gprofile){
                $res = $this->p->read("WHERE t.spUser_idspUser =" . $gprofile['spUser_idspUser']. " AND t.spProfileType_idspProfileType = 4");
                $g_personal_profile = ($res) ?  mysqli_fetch_assoc($res) : null;
                $g_personal_profile['group_name'] = $group['spGroupName'];
            }
        }

        return $g_personal_profile;
    }
    
    function createGroupAlbum($data)
    {
        return $this->g_album->create($data);
    }

    function updateGroupAlbum($data, $id)
    {
        return $this->g_album->update($data, " WHERE idspPostingAlbum=$id");;
    }

    function getAlbum($aid){
        return $this->g_album->read("WHERE t.idspPostingAlbum =" . $aid ."");
    }

    function removeAlbum($aid){
        return $this->g_album->remove("WHERE t.idspPostingAlbum =" . $aid ."");
    }

    function getGroupAlbums($gpid, $type){
        return $this->g_album->read("WHERE t.groupId =" . $gpid . " AND t.type = '" .$type. "'");
    }

    function getAlbumItem($aid){
        return $this->g_album_p->read("WHERE t.id =" . $aid ."");
    }

    function getAlbumItemByAlbumId($aid){
        return $this->g_album_p->read("WHERE t.album_id =" . $aid ."");
    }

    function removeAlbumItem($aid){
        return $this->g_album_p->remove("WHERE t.id =" . $aid ."");
    }

    function albumItemCount($albumId){
        $response = $this->g_album_p->read("WHERE t.album_id =" . $albumId . "");
        return ($response) ? $response->num_rows : 0;
    }

    function getGroupAlbumsItems($albumId){
        return $this->g_album_p->read("WHERE t.album_id =" . $albumId . "");
    }

    function createAnnouncement($data){
        return $this->announcement->create($data);
    }

    function getGroupAnnouncements($gid, $role, $keyword = ''){
        if($role == "owner"){
            $sql = "WHERE group_id = " . $gid; 
        }else{
            $sql = "WHERE group_id = " . $gid ." AND announcemt_date = '".date('Y-m-d')."' ";
        }

        if(!empty($keyword)){
            $sql .= " AND (title LIKE '%".$keyword."%' OR message LIKE '%".$keyword."%' )";
        }
        return $this->announcement->read($sql);
    }
    
    
    function readAnnouncement($aid){
        return $this->announcement->read("WHERE id = " . $aid);
    }
        
    function removeAnnouncement($postid) {
        return $this->announcement->remove("WHERE id = " . $postid);
    }

    function updateAnnouncement($data, $id)
    {
        return $this->announcement->update($data, " WHERE id=$id");
    }

    // $this->campaign;
    // $this->campaign_eug;
    // $this->campaign_u;
    function getGroupCampaign($gid){
        $columns = " t.id, t.type, t.name, t.text, t.date, t.time, t.status, u.group_id ";
        $where = " WHERE u.group_id = $gid ";
        $order = " ORDER BY t.id ASC LIMIT 10;";
        $join = " left join email_campaign_user_groups u on t.id = u.campaign_id " ;
        return $this->campaign->read($where, $order, $columns, $join);
    }

    function createCampaign($data){
        foreach($data['users'] as $user){
            $email_campgain_data = [
                'type' => $data['type'],
                'name' => $data['title'],
                'text' => $data['message'],
                'date' => $data['date'],
                'time' => $data['time'],
                'user_id' => 0,
                'status' => 'pending',
                'user_or_group' => $data['user_or_group'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $cid = $this->campaign->create($email_campgain_data);
            $email_user_group = [
                'campaign_id' => $cid,
                'group_id' => $data['grpid'],
                'user_id' => $user,
                'file_user_id' => 0,
                'created_by' => $_SESSION['pid'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $cugid = $this->campaign_eug->create($email_user_group);
            $this->campaign->update(array("user_id" => $cugid), "WHERE id ='" . $cid . "'");
        }

        return true;

    }

    function countMutualMemberGroup($gid, $pid)
    {
        $where = " WHERE u.spGroup_idspGroup = $gid and u.spApproveRegect=1 and t.idspProfiles != $pid and p.spProfiles_has_spProfileFlag = 1 ";
        $order = " GROUP BY t.idspProfiles ORDER BY t.idspProfiles DESC;";
        $columns = " t.idspProfiles ";
        $join = " join spprofiles_has_spgroup as u on t.idspProfiles = u.spProfiles_idspProfiles
                join spprofiletype as v on t.spProfileType_idspProfileType=v.idspProfileType   
                join spgroup as g on u.spGroup_idspGroup = g.idspGroup  
                join spprofiles_has_spprofiles as p on t.idspprofiles IN (p.spProfiles_idspProfileSender, p.spProfiles_idspProfilesReceiver) 
                " ; 
        $result = $this->tg->read($where, $order, $columns, $join);
        return $result->num_rows ?? 0;
    }
}
