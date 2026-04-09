<?php

class _spprofiles
{

    // property declaration
    // idspProfiles, spProfileName, spProfileEmail, spProfilePhone, spProfilePic, spUser_idspUser, spProfileType_idspProfileType
    public $dbclose = false;
    private $conn;
    public $ta;
    public $tad;
    public $job;
    public $tar;

    function __construct() 
    {
        $this->buss_album     = new _tableadapter("buss_manage_gal_album");
        $this->buss_gall     = new _tableadapter("buss_manage_gallery");
        $this->buss_menu     = new _tableadapter("spbuss_new_menu");
        $this->buss_menu_img     = new _tableadapter("spbuss_new_menu_img");
        $this->ban     = new _tableadapter("spnews_ban");
        $this->tab_bus     = new _tableadapter("spbusines_tabs");
        $this->aur     = new _tableadapter("spprofiletype");
        $this->bucket     = new _tableadapter("spnews_bucket");
        $this->rb     = new _tableadapter("spnews_bookmarkreply");
        $this->ff     = new _tableadapter("spevent_cancellation");
        $this->multi    = new _tableadapter("add_menu");
        $this->bkmark     = new _tableadapter("spnews_bookmark");
        $this->report     = new _tableadapter("spnews_report");
        $this->cr     = new _tableadapter("spnews_commentreply");
        $this->taj = new _tableadapter("spjobboard");
        $this->taac = new _tableadapter("sppostingsartcraft");
        $this->tare = new _tableadapter("sprealstate");
        $this->tafr = new _tableadapter("spfreelancer");
        $this->tavi = new _tableadapter("spvideo");
        $this->taser = new _tableadapter("spclassified");
        $this->tabus = new _tableadapter("spbuisnesspostings");
        $this->subAmount = new _tableadapter("tbl_set_commission");
        $this->sc     = new _tableadapter("spnews_commentlike");
        $this->sbu    = new _tableadapter("spbusiness_profile");
        $this->scate    = new _tableadapter("masterDetails");
        $this->sbu1    = new _tableadapter("spbusiness_profile");
        $this->scate1    = new _tableadapter("masterDetails");
        $this->nc     = new _tableadapter("news_comments");
        $this->ta = new _tableadapter("spProfiles");
        $this->ta9 = new _tableadapter("masterdetails");
        $this->taa2 = new _tableadapter("masterdetails");
        $this->tac = new _tableadapter("masterdetails");
        $this->tar = new _tableadapter("spProfiles");
        $this->tadd = new _tableadapter("spPostings");
        $this->tm = new _tableadapter("rss_data");
        $this->tn = new _tableadapter("spprofiletype");
        $this->tgrp = new _tableadapter("spprofiletype");
        $this->taw = new _tableadapter("tbl_user");
        $this->tast = new _tableadapter("spstore_refund_order");
        $this->taim = new _tableadapter("refund_store_image");
        $this->taname = new _tableadapter("spProfiles");
        $this->tanames = new _tableadapter("spnews_follow");
        $this->tap = new _tableadapter("spproduct");
        $this->ta_type = new _tableadapter("spprofiletype");
        $this->bid = new _tableadapter("spbid");
        $this->ta->join = "INNER JOIN spProfileType as d ON t.spProfileType_idspProfileType = d.idspProfileType";
        $this->tad = new _tableadapter("spProfiles_has_spGroup");
        $this->job = new _tableadapter("jobseekerProfile");
        $this->tas = new _tableadapter("aws_s3_key");
        $this->tass = new _tableadapter("aws_s3");
        $this->job_n = new _tableadapter("job_notes");
        $this->follows = new _tableadapter("spnews_follow");
        $this->nps = new _tableadapter("spnews_notification");
        $this->flage = new _tableadapter("flagged_jobprofile");
        $this->bonus = new _tableadapter("spbonuswallet");
        $this->ref = new _tableadapter("spuser");
        $this->del_pro = new _tableadapter("spprofiles_deleted");
        $this->tap1 = new _tableadapter("pos_membership_qty");
        $this->tap2 = new _tableadapter("pos_membership_duration");
        $this->ss44 = new _tableadapter("sppoint_withdraw");
        $this->ta_h = new _tableadapter("spfreelancer_profile");
        $this->ta_n = new _tableadapter("notification_temp");
        $this->pro_img = new _tableadapter("profile_image");
        $this->ta_e = new _tableadapter("spevent");
        $this->ta_tra = new _tableadapter("sptraining");
        $this->sp = new _tableadapter("spprofiles");
        $this->tapw = new _tableadapter("warehouse");
        $this->tae = new _tableadapter("spemailcontent");
        $this->ta->dbclose = false;
    }


    function random_image($dir='../assets/ramiges'){
        $files = glob($dir . '/*.*');
        $file = array_rand($files);
        return $files[$file];
    }

        
    function read_invite_desc()
        {
        
            return $this->tae->read( "WHERE id = 1");     
            //echo '$this->ta_e->sql'; 
            //die("**************"); 
        }

    function spprofilename($profile_id)
    {
       
        return $this->ta->read( "WHERE idspProfiles = " . $profile_id);
        //echo $this->ta_e->sql; 
        //die("**************"); 
    }


    function readdata($data)
    {
       
        return $this->ta_e->read( "WHERE idspPostings = " . $data);
        //echo $this->ta_e->sql; 
        //die("**************"); 
    }



    function shan_bb44($data, $uid)
    {
        //die('++++++');
        return $this->ref->update($data, "WHERE idspUser = " . $uid);
        //echo $this->ref->sql; 
        //die("**************"); 
    }


    function readnameprod($pid)
    {
        return $this->tap->read("WHERE t.idspPostings = $pid");
    }



    function re_warehouse($id)
    {
      $id = $this->tapw->escapeString($id);
      return $this->tapw->read("WHERE id = $id");
    }



    function read_reffer($id)
    {
        //die('++++++');
        return $this->ref->read("WHERE idspUser =$id");
        //echo $this->ref->sql; 
        //die("**************"); 
    }

    function profiletypedata($gid)
    {

        return $this->tgrp->read("where t.idspProfileType = $gid");
        //echo $this->tgrp->sql;  
        //die("++++");
    }

    function get_currency($id)
    {
        return $this->ref->read("WHERE idspUser =$id"); //currency
        // echo $this->ref->sql;die('xxxxxxxxxxxxx') ;  
    }

    function image_pro($id)
    {
        return $this->pro_img->read("WHERE ptid =$id"); //currency
        // echo $this->ref->sql;die('xxxxxxxxxxxxx') ;  
    }

    function person($rec)
    {
        return  $this->aur->read("where idspProfileType= $rec");
        // echo $this->sp->sql; 

    }

    function get($id)
    {
        return  $this->sp->read("WHERE idspProfiles = $id");
        // echo $this->sp->sql; 
    }

    function shan_am44($data)
    {
        $this->ss44->create($data);
    }

    function shan_am99($uid)
    {
        //die('++++++');
        return $this->ss44->read("WHERE uid= $uid And status=1");
        //echo $this->ss44->sql; 
        //
    }

    function shan_cc44($uid)
    {
        return $this->ref->read("WHERE idspUser = " . $uid);
        //echo $this->ref->sql; 
        //die("**************"); 
    }

    function read_description($id)
    {
        return $this->ta_n->read("WHERE id = " . $id);
        //echo $this->ref->sql; 
        //die("**************"); 
    }

    function read_description_f($id)
    {
        return $this->ta_n->read("WHERE id = " . $id);
        //echo $this->ref->sql; 
        //die("**************"); 
    }

    function read_description_fnum($id)
    {
        return $this->ta_n->read("WHERE id = " . $id);
        //echo $this->ref->sql; 
        //die("**************"); 
    }


    function changePassword_description($id)
    {
        return $this->ta_n->read("WHERE id = " . $id);
        //echo $this->ref->sql; 
        //die("**************"); 
    }

    function inviteFrd_description($id)
    {
        return $this->ta_n->read("WHERE id = " . $id);
        //echo $this->ref->sql; 
        //die("**************"); 
    }

    function eventBuy_description($id)
    {
        return $this->ta_n->read("WHERE id = " . $id);
        //echo $this->ref->sql; 
        //die("**************"); 
    }


    function read_hourly_new($id_s)
    {
        return $this->ta_h->read("WHERE t.spprofiles_idspProfiles = " . $id_s);
        // echo $this->del_pro->sql; 
        //     die("**************"); 
    }

    function create_bonus($data)
    {
        $this->bonus->create($data);
    }



    function create_album($data)
    {
        return  $this->buss_album->create($data);
    }

    function read_album($pid)
    {
        return  $this->buss_album->read("WHERE pid = " . $pid);
    }


    function read_album_title($title)
    {
        return  $this->buss_album->read("WHERE album =  '$title' ");
    }


    function update_album($data, $id)
    {


        return $this->buss_album->update($data, "WHERE id = $id");
    }


    function delete_album($id)
    {
        return  $this->buss_album->remove("WHERE id = " . $id);
    }

    function create_gall($data)
    {
        return  $this->buss_gall->create($data);
    }

    function read_gall($pid)
    {
        $pid = $this->buss_gall->escapeString($pid);
        return  $this->buss_gall->read("WHERE pid = " . $pid);
    }


    function update_gall($data, $id)
    {


        return $this->buss_gall->update($data, "WHERE id = $id");
    }


    function delete_gall($id)
    {
        return  $this->buss_gall->remove("WHERE id = " . $id);
    }


    function create_menu($data)
    {
        return  $this->buss_menu->create($data);
    }

    function create_menu2($data)
    {
        return $this->multi->create($data);
    }


    function create_menu3($data, $id, $id1)
    {
        return $this->multi->update($data, "WHERE menu_id = $id And id= $id1");
        //echo $this->multi->sql; die('===66'); 
    }



    function read_menu_id_serv($id)
    {
        $id = $this->multi->escapeString($id);
        return  $this->multi->read("WHERE menu_id = " . $id);
    }

    function read_data($id)
    {
        return $this->multi->read("WHERE id = " . $id);
        //echo $this->multi->sql; die('===6666');    
    }

    function read_menu($pid)
    {
        return  $this->buss_menu->read("WHERE pid = " . $pid);
    }


    function read_menu_status($pid)
    {
        $pid = $this->buss_menu->escapeString($pid);
        return  $this->buss_menu->read("WHERE status = 1 AND pid = " . $pid);
    }

    function read_menu1()
    {
        return $this->buss_menu->read();
        //echo $this->buss_menu->sql;die('===');
    }

    function read_menu_by_id($id)
    {
        $id = $this->buss_menu->escapeString($id);
        return  $this->buss_menu->read("WHERE id = " . $id);
    }

    function delete_menu($id)
    {
        return  $this->buss_menu->remove("WHERE id = " . $id);
    }

    function delete1($id)
    {
        return  $this->multi->remove("WHERE menu_id = " . $id);
    }


    function update_menu($data, $id)
    {

        $id = $this->buss_menu->escapeString($id);
        return $this->buss_menu->update($data, "WHERE id = $id");
    }

    function update_dynamic($data, $id)
    {


        return $this->buss_menu->update($data, "WHERE id = $id");
        //echo $this->buss_menu->sql;die('===00033');
    }

    function update_menu_1($data)
    {


        return $this->multi->create($data);
        //echo $this->multi->sql;die('=====333'); 
    }

    function create_menu4($data)
    {


        return $this->multi->create($data);
        //echo $this->multi->sql;die('=====333'); 
    }


    function create_menu_img($data)
    {
        return $this->buss_menu_img->create($data);
    }

    function read_menu_id($id)
    {
        return  $this->buss_menu_img->read("WHERE menu_id = " . $id);
    }

    function delete_menu_img($id)
    {
        return  $this->buss_menu_img->remove("WHERE id = " . $id);
    }

    function delete_image1($id)
    {
        return  $this->multi->remove("WHERE id = " . $id);
    }

    function business_tabs($data)
    {
        $this->tab_bus->create($data);
    }

    function remove_business_tab($b, $c)
    {

        return $this->tab_bus->remove("WHERE uid=$b AND pid=$c ");
    }


    function read_business_tab_mark($b, $c)
    {

        return $this->tab_bus->read("WHERE uid=$b AND pid=$c ");
    }

    function read_business_tab($pid)
    {
        $pid = $this->tab_bus->escapeString($pid);
        return $this->tab_bus->read("WHERE pid=$pid AND status = 1");
    }

    function reactive_insert($data)
    {
        return $this->taname->create($data);
    }

    function reactive_delete($id)
    {
        $this->del_pro->remove("WHERE idspProfiles=$id");
        //echo $this->del_pro->sql;
        //die("**************");
    }


    function deletedata($id)
    {
        $this->ff->remove("WHERE id=$id");
        //echo $this->del_pro->sql;
        //die("**************");
    }



    function create_spproduct($data)
    {

        return $this->tap->create($data);
        //echo $this->tap->sql;
        //die("**************");
    }

    function check_barcode($code)
    {
        return $this->tap->read("WHERE t.barcode = '$code'");
        // echo  $this->tap->sql;
        //die("**************");
    }

    function update_mem_qty_product($data, $id)
    {
        return $this->tap->update($data, "WHERE idspPostings = $id");
    }

    function updatebutton_new_1($rr, $id)
    {
        return $this->ff->update($rr, "WHERE id = $id");
    } 
    
    function read_bonus_refer($uid)
    {
        return $this->ref->read("WHERE idspuser=$uid");
    }

    function readshashi()
    {
        return $this->ff->read();
    }


    function update_ref($data, $uid)
    {
        return $this->ref->update($data, "WHERE idspuser=$uid");
    }

    function read_profile_type($id)
    {
        return $this->ta_type->read("WHERE idspProfileType = $id");
    }

    function create_deleted_profile($data)
    {
        $this->del_pro->create($data);
    }

    function read_deleted_profile($id)
    {
        return $this->del_pro->read("WHERE spuser_idspuser=$id");
        //echo $this->del_pro->sql;die('=====');;

    }

    function read_reactive($id)
    {
        return $this->del_pro->read("WHERE idspProfiles=$id");
        //echo $this->del_pro->sql;die('=====');;

    }

    function read_deleted_profile_1111($id)
    {
        return $this->del_pro->read("WHERE idspProfiles=$id");
    }

    function delete_permanent($id)
    {
        $this->del_pro->remove("WHERE idspProfiles=$id");
    }

    function createBANdata($data)
    {



        $this->ban->create($data);
        //echo $this->n->sql;die;
        //die("**************");
    }

    function readBANdata($b, $c, $a)
    {



        return $this->ban->read("WHERE uid=$b AND pid=$c AND newsid='$a'");
        //echo $this->n->sql;die;
        //die("**************");
    }

    function create_reactive_profile($data)
    {
        $this->taname->create($data);
    }

    function readBANnewsdata($pid2)
    {



        return $this->ban->read("WHERE pid=$pid2");
        // echo $this->ban->sql;die('===========');
        // die("**************");
    }

    function change_bid_status($data, $id)
    {
        return $this->bid->update($data, "WHERE id = $id");
    }

    function deleteBANdata($b, $c, $a)
    {

        $this->ban->remove("WHERE uid=$b AND pid=$c AND newsid='$a'");
        //echo $this->ban->sql;
        //die("QQQQQQQQQQQQQQQ");

    }

    function read_post_store($id)
    {
        return $this->tap->read("WHERE spuser_idspuser=$id AND (spPostingDate <= (NOW() - INTERVAL 90 DAY))");
    }

    function read_post_product($id)
    {
        return $this->tap->read("WHERE spuser_idspuser = $id AND spPostingVisibility = -1 ");
    }

    function read_post_product_pos1($uid, $pid,$id)
    {
      $id = $this->tap->escapeString($id);
        return $this->tap->read("WHERE spuser_idspuser = $uid AND spProfiles_idspProfiles = $pid and warehouse_id=$id ORDER BY idspPostings DESC");
       // echo $this->tap->sql; die("dddddddddd");
    }



    function read_post_product_pos2($uid, $pid,$id)
    {
      $id = $this->tap->escapeString($id);
      return $this->tap->read("WHERE spuser_idspuser = $uid AND spProfiles_idspProfiles = $pid and vendor_in =$id ORDER BY idspPostings DESC");
       // echo $this->tap->sql; die("dddddddddd");
    }


    function read_post_product_pos($uid, $pid)
    {
        return $this->tap->read("WHERE spuser_idspuser = $uid AND spProfiles_idspProfiles = $pid  ORDER BY idspPostings DESC");
       // echo $this->tap->sql; die("dddddddddd");
    }



    function read_data_warehouse($uid, $pid, $wid)
    {
        return $this->tap->read("WHERE spuser_idspuser = $uid AND spProfiles_idspProfiles = $pid AND warehouse_id = $wid");
        //echo $this->tap->sql; die("dddddddddd");
    }

    function read_post_product_pos_filter($uid, $pid, $keyword, $supplier_name, $category_name)
    {
        return $this->tap->read("WHERE spuser_idspuser = $uid AND spProfiles_idspProfiles = $pid  AND vendor_in = $supplier_name AND subcategory = '$category_name'  AND spPostingTitle LIKE '%$keyword%' ORDER BY idspPostings DESC");
    }

    function read_post_product_pos_filter_byKeyword($uid, $pid, $keyword)
    {
        return $this->tap->read("WHERE spuser_idspuser = $uid AND spProfiles_idspProfiles = $pid  AND spPostingTitle LIKE '%$keyword%' ORDER BY idspPostings DESC");
    }

    function read_post_product_pos_filter_bySupplier($uid, $pid, $supplier_name)
    {
        return $this->tap->read("WHERE spuser_idspuser = $uid AND spProfiles_idspProfiles = $pid  AND vendor_in = $supplier_name  ORDER BY idspPostings DESC");
    }

    function read_post_product_pos_filter_byCategory($uid, $pid, $category_name)
    {
        return $this->tap->read("WHERE spuser_idspuser = $uid AND spProfiles_idspProfiles = $pid  AND subcategory = '$category_name'  ORDER BY idspPostings DESC");
    }

    function read_post_freelancer($id)
    {
        return $this->tafr->read("WHERE spuser_idspuser=$id  AND (spPostingDate <= (NOW() - INTERVAL 90 DAY))");
    }


    function read_post_real_state($id)
    {
        return $this->tare->read("WHERE spuser_idspuser=$id AND (spPostingDate <= (NOW() - INTERVAL 90 DAY))");
    }


    function read_post_job_board($id)
    {
        return $this->taj->read("WHERE spuser_idspuser=$id AND (spPostingDate <= (NOW() - INTERVAL 90 DAY))");
    }

    function read_post_art_craft($id)
    {
        return $this->taac->read("WHERE spuser_idspuser=$id  AND (spPostingDate <= (NOW() - INTERVAL 90 DAY))");
        echo $this->taac->sql;
    }

    //function readviewscommentdata222333($msg) {


    //die("**************");
    //  $this->nc->read("WHERE t.comment LIKE '$msg%'" );     
    //echo $this->nc->sql;

    //}




    function readbucketnnnnewsddd($uid, $pid)
    {
        return $this->bucket->read("where uid = $uid AND pid = $pid");
        //echo $this->bucket->sql;

    }


    function readprice($uid, $pid)
    {
        return $this->tap->read("where idspPostings = $uid AND spCategories_idspCategory = $pid");
        //echo $this->b->sql;

    }


    function readprice_1($id)
    {
        $id = $this->tap->escapeString($id);
        return $this->tap->read("where idspPostings = $id ");
        //echo $this->b->sql;

    }

    function readprice_barcode($bar)
    {
        return $this->tap->read("where barcode = '$bar' ");
        //echo $this->b->sql;

    }

    function readprice_barcode_quanity($bar)
    {
        return $this->tap1->read("where t.barcode = $bar ");
        //echo $this->b->sql;

    }

    function readprice_barcode_duration($bar)
    {
        return $this->tap2->read("where t.barcode = $bar ");
        //echo $this->b->sql;

    }



    function readcommentdata22()
    {



        return  $this->nc->read(" ORDER BY t.id DESC ");
        //echo $this->n->sql;die;
        //die("**************");
    }


    function readcommentdatasearch($msgg)
    {



        return  $this->nc->read("WHERE t.comment LIKE '$msgg%' ORDER BY t.id DESC ");
        //echo $this->n->sql;die;
        //die("**************");
    }



    function loadmoredata($row, $rowperpage)
    {



        return  $this->nc->read(" ORDER BY t.id DESC limit $row,$rowperpage");
        //echo $this->n->sql;die;
        //die("**************");
    }


    function createpostmessage($data)
    {



        $lastid = $this->nc->create($data);
        return $lastid;
        //echo $this->n->sql;die;
        //die("**************");
    }

    function read_comments($pid)
    {
        return $this->nc->read("WHERE pid=$pid");

        // echo $this->block->sql;
        //die("PPPPPPPPPPPPPPP"); 
    }


    function readBusDirProfile_cmpname($cmpnyName)
    {

        return  $this->ta->read("INNER JOIN spbusiness_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = 1 AND p.companyname = '$cmpnyName' ");

        //echo  $this->ta->sql; die('===========');

    }


    function readprofilebanner($pid)
    {
        return $this->ta->read("WHERE t.idspProfiles = $pid");
    }

    function readprofileid($pid)
    {
        return $this->ta->read("WHERE idspProfiles = $pid");
    }

    function readprofileid22($pid)
    {
        return $this->taname->read("WHERE idspProfiles = $pid");
        //echo $this->taname->sql;
    }


    function readprofileid2($pid)
    {
        return $this->ta->read("WHERE idspProfiles = $pid");
    }



    function updateprofiles222($profilename, $propics, $bid)
    {
        $this->ta->update("spProfileName=$profilename,spProfilePic=$propics WHERE idspProfiles =$bid");
        //echo $this->ta->sql;
        //die("uuuuuuuuuuuuuuuuu");
    }

    function upstatus($status, $pid)
    {
        $this->ta->update(array("chat_status" => $status), "WHERE idspProfiles='" . $pid . "'");
    }

    function deletereplydata($id)
    {



        $this->cr->remove("WHERE t.id=$id");
        //echo $this->n->sql;die;
        //die("**************");
    }



    function commentcreatedata($data)
    {



        return $this->cr->create($data);
        //echo $this->n->sql;die;
        //die("**************");
    }

    function createreportdata($data)
    {



        $this->report->create($data);
        //echo $this->n->sql;die;
        //die("**************");
    }

    function insertpics($data)
    {

        $this->report->create($data);
    }


    function createbookmarkdata($data)
    {



        $this->bkmark->create($data);
        //echo $this->n->sql;die;
        //die("**************");
    }

    function createbucketdata($data)
    {



        $this->bucket->create($data);
        //echo $this->n->sql;die;
        //die("**************");
    }




    function createreplybookmarkdata($data)
    {



        $this->rb->create($data);
        //echo $this->n->sql;die;
        //die("**************");
    }




    function createbookmarknews($data)
    {



        $this->bkmark->create($data);
        //echo $this->n->sql;die;
        //die("**************");
    }



    function readreplydata($cid)
    {



        return $this->cr->read("WHERE t.comment_id=$cid ORDER BY t.id DESC");
    }


    function readreplydataappend($cid, $lastid)
    {



        return $this->cr->read("WHERE t.comment_id=$cid And id=$lastid ORDER BY t.id DESC");
        //echo $this->cr->sql;
        //die("&&&&&&&&&&&&&&&&&&&&&&&&");
    }





    function readcommentbypid($ppid)
    {

        return $this->ta->read("WHERE idspProfiles=$ppid");
    }

    function readreplybypid($ppid)
    {

        return $this->ta->read("WHERE idspProfiles=$ppid");
    }


    function readsinglecomment($postid)
    {



        return  $this->nc->read("WHERE id=$postid");
        //echo $this->nc->sql;die;
        //die("**************");
    }


    function readcommentdata()
    {



        return  $this->nc->read(" ORDER BY t.id DESC limit 0,10");
        //echo $this->nc->sql;die;
        //die("**************");
    }



    function readcommentdata2($pid)
    {



        return  $this->nc->read("where pid=$pid  ORDER BY t.id DESC limit 0,10");
        //echo $this->n->sql;die;
        //die("**************");
    }


    function readcommentdata222($row, $rowperpage)
    {



        return  $this->nc->read("ORDER BY t.id DESC limit $row,$rowperpage");
        //echo $this->n->sql;die;
        //die("**************");
    }





    function readcommentdata3($pid)
    {
      $pid = $this->nc->escapeString($pid);
        return  $this->nc->read("where pid=$pid  ORDER BY t.id DESC limit 0,10");
        //echo $this->n->sql;die;
        //die("**************");
    }

    function readcommentdata333($row, $rowperpage)
    {



        return  $this->nc->read(" ORDER BY t.id DESC limit $row,$rowperpage");
        //echo $this->n->sql;die;
        //die("**************");
    }



    function readcommentnews($pid)
    {



        return  $this->nc->read("WHERE pid=$pid");
        //echo $this->n->sql;die;
        //die("**************");
    }

    function realflagdata($id)
    {
        return $this->tare->read("WHERE idspPostings = $id");
        //echo $this->tare->sql;
        //die("++");

    }

    function videoflagdata($id)
    {
        return $this->tavi->read("WHERE video_id = $id");
        //echo $this->tare->sql;
        //die("++");

    }

    function servicesflagdata($id)
    {
        return $this->taser->read("WHERE idspPostings = $id");
        //echo $this->taser->sql;
        //die("++");

    }

    function businessflagdata($id)
    {
        return $this->tabus->read("WHERE idspbusiness = $id");
        //echo $this->tabus->sql;
        //die("++");

    }

    function jobboardflagdata($id)
    {
        return $this->taj->read("WHERE idspPostings = $id");
        //echo $this->taj->sql;
        //die("++");

    }



    function freelancerflagdata($id)
    {
        return $this->tafr->read("WHERE idspPostings = $id");
        //echo $this->tafr->sql;
        //die("++");

    }

    function eventflagdata($id)
    {
        return $this->ta_e->read("WHERE idspPostings = $id");
        //echo $this->ta_e->sql;
        //die("++");

    }

    function trainingflagdata($id)
    {
        return $this->ta_tra->read("WHERE id = $id");
        //echo $this->ta_tra->sql;
        //die("++");

    }



    function artcraftflagdata($id)
    {
        return $this->taac->read("WHERE idspPostings = $id");
        //echo $this->tare->sql;
        //die("++");

    }


    function read_now($pid)
    {
        return $this->tap->read("where t.spProfiles_idspProfiles = " . $pid);
    }


    function readlikedata($uid, $pid, $comment_id)
    {



        return $this->sc->read("WHERE userid=$uid AND profileid=$pid AND comment_id=$comment_id");
        //echo $this->sc->sql;
        //die("**************");
    }


    function readforlike($comment_id)
    {



        return $this->nc->read("WHERE id=$comment_id");
    }


    function readbookmarkdata($uid, $pid, $comment_id)
    {



        return $this->bkmark->read("WHERE uid=$uid AND pid=$pid AND comment_id=$comment_id");
        //echo $this->sc->sql;
        //echo $this->sc->sql;
        //die("**************");
    }

    function readbucketdata22($uid, $pid, $comment_id)
    {



        return $this->bucket->read("WHERE uid=$uid AND pid=$pid AND newsid='$comment_id'");
        //echo $this->sc->sql;
        //echo $this->sc->sql;
        //die("**************");
    }


    function readreplybookmarkdata($uid, $pid, $comment_id)
    {



        return $this->rb->read("WHERE uid=$uid AND pid=$pid AND reply_id=$comment_id");

        //echo $this->rb->sql;
        //echo $this->sc->sql;
        //die("**************");
    }




    function readbucketknews($uid, $pid)
    {



        return $this->bucket->read("WHERE uid=$uid AND pid=$pid");
        //echo $this->bkmark->sql;
        //die("**************");
    }


    function readbookmarknews($uid, $pid, $comment_id)
    {



        return $this->bkmark->read("WHERE uid=$uid AND pid=$pid AND news_id='$comment_id'");
        echo $this->bkmark->sql;
        die("**************");
    }

    function readbookmarknewsdata($news_id, $pid)
    {



        return $this->bkmark->read("WHERE news_id='$news_id' AND pid=$pid ");

        //echo $this->bkmark->sql;
        //die("**************"); 
    }



    function readbucketnewsdata($news_id, $pid)
    {



        return $this->bucket->read("WHERE newsid='$news_id' AND pid=$pid ");

        //echo $this->bkmark->sql;
        //ie("**************");
    }

    function readworldbookmarknewsdata($news_id, $pid)
    {



        return $this->bkmark->read("WHERE news_id='$news_id' AND pid=$pid ");

        //echo $this->bkmark->sql;
        //ie("**************");
    }



    function readlikedata22($comment_id)
    {



        return $this->sc->read("WHERE  comment_id=$comment_id");
        //echo $this->sc->sql;
        //die("**************");
    }


    function deletelikedata($uid, $pid, $comment_id)
    {



        $this->sc->remove("WHERE userid=$uid AND profileid=$pid AND comment_id=$comment_id");
        //echo $this->n->sql;die;
        //die("**************");
    }



    function deletebucketdata($uid, $pid, $comment_id)
    {



        $this->bucket->remove("WHERE uid=$uid AND pid=$pid AND newsid='$comment_id'");
        //echo $this->n->sql;die;
        //die("**************");
    }


    function deletebookmarkdata($uid, $pid, $comment_id)
    {



        $this->bkmark->remove("WHERE uid=$uid AND pid=$pid AND comment_id=$comment_id");
        //echo $this->n->sql;die;
        //die("**************");
    }


    function deletereplybookmarkdata($uid, $pid, $comment_id)
    {



        $this->rb->remove("WHERE uid=$uid AND pid=$pid AND reply_id=$comment_id");
        //echo $this->n->sql;die;
        //die("**************");
    }


    function deletebookmarknews($uid, $pid, $comment_id)
    {



        $this->bkmark->remove("WHERE uid=$uid AND pid=$pid AND news_id='$comment_id'");
        //echo $this->bkmark->sql;
        //die("**************");
    }



    function deletecommentdata($cid)
    {



        $this->nc->remove("WHERE id=$cid");
        //echo $this->n->sql;die;
        //die("**************");
    }



    function likecreatedata($data)
    {



        $this->sc->create($data);
        //echo $this->n->sql;die;
        //die("**************");
    }




    // READ PROFILE BY PROFILE ID

    function job_notes($emp_id, $seeker_id)
    {
        return $this->job_n->read("WHERE t.employer_id = " . $emp_id . " AND t.jobseeker_id = " . $seeker_id . "");
    }

    function imageInsert($data)
    {
        return  $this->taim->create($data);
        // echo $this->taim->sql;die('========');
    }

    public function readp($pid)
    {
        return $this->tap->read("WHERE idspPostings = " . $pid);
    }

    public function read_bid($pid)
    {
        return $this->bid->read("WHERE spPostings_idspPostings = " . $pid);
    }

    public function read_bid_status($pid)
    {
        $pid = $this->bid->escapeString($pid);
        return $this->bid->read("WHERE spPostings_idspPostings = " . $pid . " AND status = 1 ");
    }

    function read_img($pid)
    {
        return $this->taname->read("WHERE idspProfiles = $pid");
    }

    function update_notes($data, $uid)
    {
        return $this->job_n->update($data, "WHERE id  =" . $uid . "");
    }

    function insert_notes($data)
    {

        return $this->job_n->create($data);
        //echo $this->job_n->sql;die('ddddddddddddddddd');
    }


    function insertdata($data)
    {
        return $this->ff->create($data);
        //echo $this->job_n->sql;die('ddddddddddddddddd');
    }

    function create_image($data)
    {

        return $this->pro_img->create($data);
    }


    function insert_follow($data)
    {

        $id = $this->follows->create($data);
    }

    function readimg($bid)
    {
        return $this->taim->read("WHERE basket_id =  $bid");
    }


    function read($pid)
    {
        $pid = $this->ta->escapeString($pid);
        return   $this->ta->read("WHERE t.idspProfiles = " . $pid);

        //     echo $this->ta->sql;
        // die('---------**************'); 
    }

    function readByEmail($email)
    {
        $email = $this->ta->escapeString($email);
        return $this->ta->read('WHERE t.spProfileEmail LIKE "'.$email.'"');
        // echo $this->ta->sql;
        // die('---------**************'); 
    }

    function read_seller($pid)
    {
        return  $this->ta->read("WHERE t.idspProfiles = " . $pid);

        // echo $this->ta->sql;
        // die('---------**************'); 
    }


    function readuserdata($pid)
    {
        return $this->tar->read("WHERE t.idspProfiles = " . $pid);

        //echo $this->tar->sql;
        //die('---------'); 
    }

    function profile_name($pid)
    {
        return $this->ta->read("WHERE t.idspProfiles = " . $pid);
    }




    function read_like($pid, $likedata)
    {
        return $this->ta->read("WHERE t.idspProfiles = " . $pid);
    }

    function read9($pid, $like)
    {
        return $this->ta->read("WHERE t.idspProfiles = $pid AND t.spProfileName LIKE '%$like%'");
        // echo $this->ta->sql; 
        //die('---------');  
    }

    function read7($pid, $like)
    {
        return  $this->ta->read("WHERE t.idspProfiles = $pid AND t.spProfileName LIKE %$like%");
    }

    function read10($pid, $like)
    {
        return  $this->ta->read("WHERE t.idspProfiles = $pid AND t.spProfileName LIKE %$like%");
    }


    function spread($pid)
    {
        return   $this->tn->read("WHERE idspProfiletype = " . $pid);
    }

    function read_all()
    {
        return   $this->tn->read();
    }

    function readname($pid)
    {
        return $this->taname->read("WHERE t.idspProfiles = $pid");
        //echo $this->taname->sql;
        //die('========');
    }

    function sprecord($pid)
    {
        return $this->taname->read("WHERE t.spProfileName LIKE '$pid%' limit 1,5");
        //echo $this->taname->sql;
        //die('========');

    }

    function sprecordAllcount($pid)
    {
        return $this->taname->read("WHERE t.spProfileName LIKE '$pid%'");
        //echo $this->taname->sql;
        //die('========');

    }

    function sprecordLoadmore($pid, $row, $rowperpage)
    {
        return $this->taname->read("WHERE t.spProfileName LIKE '$pid%' limit $row,$rowperpage");
        //ho $this->taname->sql;
        //e('========');

    }

    function spdataa($pid, $userid)
    {
        return $this->tanames->read("WHERE t.who=$pid AND t.whom=$userid");
    }




    function read_cure($pid)
    {
        return $this->ta->read("WHERE t.idspProfiles = " . $pid);
    }

    function updatestatus($da, $bid)
    {
        return $this->tast->update($da, "WHERE basket_id =$bid");
        //echo $this->tast->sql;
    }


    function readst($bid)
    {
        return $this->tast->read("WHERE basket_id = $bid");
        //echo $this->tast->sql;

    }

    function readawskey()
    {
        return $this->tas->read();
    }

    function readawskeyagain($ids)
    {
        return $this->tass->read("WHERE id=" . $ids . "");
    }

    function updateMasterProfile($data, $uid, $profileType = 4)
    {
        return $this->ta->update($data, "WHERE spUser_idspUser  =" . $uid . " AND spProfileType_idspProfileType = " . $profileType . "");
    }

    function getAllOtherProfilesByUID($uid)
    {
        return $this->ta->read("WHERE t.spUser_idspUser = " . $uid . " AND t.spProfileType_idspProfileType <> 4");
    }

    function getMasterProfileData($uid, $profileType = 4)
    {
        return $this->ta->read("WHERE spUser_idspUser  =" . $uid . " AND spProfileType_idspProfileType = " . $profileType . "");
    }

    function updateAllOtherProfiles($data, $pid)
    {
        $this->ta->update($data, "WHERE idspProfiles  =" . $pid . "");
    }

    function updateStoreName($data, $pid)
    {
        $this->ta->update($data, "WHERE idspProfiles  =" . $pid . "");
    }

    function updatebannerimg($data, $pid)
    {
        $this->taname->update($data, "WHERE idspProfiles  =" . $pid . "");
    }


    function readlimit($pid)
    {	  
        $pid = $this->ta->escapeString($pid);
        return $this->ta->read("WHERE t.idspProfiles = " . $pid);
        echo $this->ta->sql;
    }
    //read freelancers FOR CHECK THIS PROFILE IS FREELANCE OR NOT
    function readfreelancer($pid)
    {
        return $this->ta->read("WHERE idspProfiles =" . $pid . " AND spProfileType_idspProfileType");
    }
    // READ RESUME BY PROFILE
    function readjobseeker($pid)
    {
        return $this->ta->read("WHERE idspProfiles =" . $pid . " AND spProfileType_idspProfileType = 5");
    }

    function readbussinessdata($uid)
    {
        return $this->ta->read("WHERE spUser_idspUser = " . $uid . " AND spProfileType_idspProfileType = 1");
    }

    function readBusiness($pid)
    {
        return $this->ta->read("WHERE idspProfiles =" . $pid . " AND spProfileType_idspProfileType=1 OR spProfileType_idspProfileType=3 ");
    }

    function readEmployment($pid)
    {
        return $this->ta->read("WHERE idspProfiles =" . $pid . " AND spProfileType_idspProfileType=5");
    }


    // =============END===========


    function update($data, $uid)
    {
        $this->ta->update($data, $uid);
    }



    //chk my profile is jobboard or not
    function readMyProfileType($ptype, $pid)
    {
        return $this->ta->read("WHERE spProfileType_idspProfileType BETWEEN 1 AND $ptype AND idspProfiles = $pid");
    }

    function profilestore($pid)
    {
        return $this->ta->read("WHERE idspProfiles =" . $pid . " AND spDynamicWholesell IS NOT NULL");
    }

    function storename($storename)
    {
        return $this->ta->read("WHERE t.spDynamicWholesell = '" . $storename . "'");
    }

    function checkmembership($mid, $uid)
    {
        return $this->ta->read("WHERE t.spMembership_idspMembership = " . $mid . " AND spUser_idspUser =" . $uid);
    }

    function publish($pid)
    {
        return $this->ta->update(array("spprofilesPublished" => 1), "WHERE idspProfiles ='" . $pid . "'");
    }

    function conceal($pid)
    {
        return $this->ta->update(array("spprofilesPublished" => 0), "WHERE idspProfiles ='" . $pid . "'");
    }

    function checkstore($uid)
    {
        return $this->ta->read("WHERE spUser_idspUser =" . $uid . " AND spDynamicWholesell IS NOT NULL");
    }

    function profileforresume($uid)
    {
        return $this->ta->read("WHERE spUser_idspUser =" . $uid);
    }


    function profilenameant($bid)
    {

        return $this->ta->read("WHERE spUser_idspUser  =" . $bid);
        //echo $this->ta->sql;
        //die("+++++++++++++++++++");
    }

    function profile($uid)
    {
        return $this->taw->read("WHERE user_id =" . $uid);
    }

    function totalprofiles()
    {
        return $this->ta->read();
    }
    //deactivate my profile
    function deactivate($pid)
    {
        return $this->ta->update(array("spAccountStatus" => 0), "WHERE idspProfiles ='" . $pid . "'");
    }
    //activate my profile
    function activate($pid)
    {
        return $this->ta->update(array("spAccountStatus" => 1), "WHERE idspProfiles ='" . $pid . "'");
    }

    function frienddetails($sender, $receiver, $uid)
    {
        return $this->ta->read("WHERE (idspProfiles =" . $sender . " AND spUser_idspUser !=" . $uid . ") OR (idspProfiles =" . $receiver . " AND spUser_idspUser !=" . $uid . ")");
    }

    function checkprofile($uid, $pid)
    {
        return $this->ta->read("WHERE spUser_idspUser =" . $uid . " AND idspProfiles =" . $pid);
    }

    function checkprofile1($pid, $postid)
    {
        return $this->tadd->read("WHERE idspPostings =" . $postid . " AND spProfiles_idspProfiles =" . $pid);
    }

    function updateprofilepic($pid, $data, $spnames)
    {
        $this->ta->update(array("t.spProfilePic" => $data, "t.alias_name" => $spnames), "WHERE idspProfiles ='" . $pid . "'");
        //echo $this->ta->sql;die("+++"); 
    }

    function updateprofilepic2($pid, $data)
    {
        $this->ta->update(array("t.spProfilePic" => $data), "WHERE idspProfiles ='" . $pid . "'");
        //echo $this->ta->sql;die("+++"); 
    }

    function updateprofilesp($name,$url, $pid)
    {
        $this->ta->update(array("t.spProfileName" => $name, "t.spProfilePic" =>$url), "WHERE idspProfiles ='" . (int)$pid . "'");
        //echo $this->ta->sql;die("+++"); 
    }


    function updatebannerpic($pid, $data)
    {
        $this->ta->update(array("t.banner_image" => $data), "WHERE idspProfiles ='" . $pid . "'");
        //echo $this->ta->sql;die("+++"); 
    }

    function readMember($uid, $gid)
    {
        return $this->ta->read("WHERE idspProfiles in (select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup=" . $gid . ") AND spUser_idspUser =" . $uid);
    }



    function readFriends($uid)
    {
        //return $this->ta->read("WHERE idspProfiles in (Select spProfiles_idspProfiles from spprofiles_has_spgroup where spGroup_idspGroup in (select spGroup_idspGroup from spprofiles_has_spgroup where spProfiles_idspProfiles = " .$pid." )) AND idspProfiles !=" . $pid);
        return $this->ta->read("WHERE idspProfiles in (Select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . "))) AND spUser_idspUser !=" . $uid);
    }

    function readallfriend($pid)
    {
        return $this->ta->read("WHERE idspProfiles in (Select spProfiles_idspProfiles from spprofiles_has_spgroup where spGroup_idspGroup in (select spGroup_idspGroup from spprofiles_has_spgroup where spProfiles_idspProfiles = " . $pid . " )) AND idspProfiles !=" . $pid);
    }

    function channelremove($pid)
    {
        return $this->tm->remove("WHERE t.rss_id= " . $pid);
    }

    function removeProfiles($pid)
    {
        $this->ta->remove("WHERE t.idspProfiles= " . $pid);
    }

    function removeProfiles_pos($id)
    {
        $this->tap->remove("WHERE idspPostings= " . $id);
    }

    function removeProduct($pid)
    {
        $this->tap->remove("WHERE t.spProfiles_idspProfiles = " . $pid);
    }

    function removefollow($pid, $sid)
    {
        $this->follows->remove("WHERE t.who=$pid AND t.whom=$sid");
    }

    function delnotification($sid)
    {
        $this->nps->remove("WHERE t.id=$sid");
    }

    function readProfiles($uid)
    {
        return $this->ta->read("WHERE t.spUser_idspUser = " . $uid, " ORDER BY d.idspProfileType");

       // echo $this->ta->sql;
    }

    function readProfiles2($uid)
    {
        return $this->ta->read("WHERE t.spUser_idspUser = " . $uid);
    }

    function readProfileOnConsultation($uid)
    {
        $sql = 'select profile.idspProfiles, profile.spProfilesDefault, profile.spProfileName, profile.spProfileEmail, profile.spProfilePhone, profile.spProfilePic, profiletype.idspProfileType, profiletype.spProfileTypeName from spprofiles as profile inner join spprofiletype as profiletype on profile.spprofiletype_idspprofiletype = profiletype.idspprofiletype where profile.spuser_idspuser = ? order by profiletype.idspProfileType';
        $params = [$uid];
        $out = selectQ($sql, "i", $params);
        return ['data' => $out];
    }

    function readProfile_name($id)
    {
        return $this->tn->read("WHERE t.idspProfileType = " . $id);
    }


    function readprofile_type($pid)
    {
        return $this->ta->read("WHERE t.idspProfiles = " . $pid, " ORDER BY d.idspProfileType");
    }

    //read business or freelancer profiles
    function readBusFreeProfiles($uid)
    {
        return $this->ta->read("WHERE t.spUser_idspUser = " . $uid, " AND t.spProfileType_idspProfileType BETWEEN 1 AND 2 ORDER BY d.idspProfileType ");
    }
    //read default profile for login
    function readDefaultProfile($uid)
    {
        return $this->ta->read("WHERE t.spUser_idspUser= " . $uid . " AND spProfilesDefault = 1");
        //echo $this->ta->sql;
    }

    function readallProfile($uid)
    {
        return $this->ta->read("WHERE t.spProfilesDefault= 1");
        //echo $this->ta->sql;
    }


    function readDefaultProfile_causal($uid)
    {
        return $this->ta->read("WHERE t.spUser_idspUser= " . $uid . " AND spProfilesDefault = 0  LIMIT 1");
    }
    //read business profiles
    function readBusProfiles($limit)
    {
        return $this->ta->read("INNER JOIN spprofilefield AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = 1 AND p.spProfileFieldName = 'companyname_' ORDER BY RAND() LIMIT $limit");
    }
    //chek profile name is avalable of not
    function avalableProfileName($uid, $pName)
    {
        $r = $this->ta->read("WHERE t.spUser_idspUser = $uid AND spProfileName = '$pName'");
        if ($r != false)
            return 0;
        else
            return 1;
    }


    function updateProfiles($data, $pid)
    {
        $this->ta->update($data, $pid);
    }

    function create($data)
    {
        $pid = $this->ta->create($data);

        if ($data["spProfileType_idspProfileType"] == 1 && $data["defaultbusiness_"] == 1) {
            $p = new _postings; //Creating post
            //$postid = $p->createservice($data["businesssubcategory_"], $data["spProfileAbout"], $data["spProfilesCity"], $data["spProfilesCountry"], $pid, $data["spProfilePhone"]);
            $postid = $p->createservice($data["businesscategory_"], $data["spProfileAbout"], $data["spProfilesCity"], $data["spProfilesCountry"], $pid, $data["spProfilePhone"]);

            $pf = new _postfield; //Creating post field

            $pf->create(array("spPostFieldLabel" => "Category", "spPostFieldName" => "servicecategory_", "spPostFieldValue" => $data["businesscategory_"], "spPostFieldIsFilter" => 1, "spPostings_idspPostings" => $postid, "spCategories_idspCategory" => 7));

            //$pf->create(array("spPostFieldLabel" => "Subcategory", "spPostFieldName" => "spPostingSubcategory_", "spPostFieldValue" => $data["businesssubcategory_"], "spPostFieldIsFilter" => 1, "spPostings_idspPostings" => $postid, "spCategories_idspCategory" => 7));

            $pf->create(array("spPostFieldLabel" => "Company", "spPostFieldName" => "spPostingCompany_", "spPostFieldValue" => $data["companyname_"], "spPostFieldIsFilter" => 1, "spPostings_idspPostings" => $postid, "spCategories_idspCategory" => 7));

            $pf->create(array("spPostFieldLabel" => "Address", "spPostFieldName" => "spPostingLocation_", "spPostFieldValue" => $data["companyaddress_"], "spPostFieldIsFilter" => 1, "spPostings_idspPostings" => $postid, "spCategories_idspCategory" => 7));

            //$pf->create(array("spPostFieldLabel" => $data["Company URL"],"spPostFieldName" => ,"spPostFieldValue" => $data[""], "spPostFieldIsFilter" => 1, "spPostings_idspPostings" => $postid, "spCategories_idspCategory" => 7));

            $pf->create(array("spPostFieldLabel" => "Contact Name", "spPostFieldName" => "spPostingContactName_", "spPostFieldValue" => $data["spProfileName"], "spPostFieldIsFilter" => 1, "spPostings_idspPostings" => $postid, "spCategories_idspCategory" => 7));
        }

        try{
            $albm = new _album;
            $albumid = $albm->profilealbum($pid); //Create Album
        }catch(\Exception $e){}
        return $pid;
    }

    function upload($data, $pid)
    {
        foreach ($data as $column => $picArray)
            foreach ($picArray["tmp_name"] as $filename)
                return $this->ta->blobload($column, $filename, "WHERE t.idspProfiles= " . $pid);
    }

    //testing
    function getDefault($uid)
    {
        $r = $this->ta->read("WHERE spUser_idspUser= " . $uid . " AND spProfilesDefault=1", "", "idspProfiles");
        if ($r != false) {
            return mysqli_fetch_row($r)[0];
        } else {
            $r = $this->ta->read("WHERE spUser_idspUser =" . $uid . " ", "limit 1", "idspProfiles");
            if ($r != false) {
                return mysqli_fetch_row($r)[0];
            }
        }
    }

    function getDefaultName($uid)
    {
        $r = $this->ta->read("WHERE spUser_idspUser= " . $uid . " AND spProfilesDefault=1", "", "spProfileName");
        if ($r != false) {
            return mysqli_fetch_row($r)[0];
        } else {
            $r = $this->ta->read("WHERE spUser_idspUser =" . $uid . " ", "limit 1", "spProfileName");
            if ($r != false) {
                return mysqli_fetch_row($r)[0];
            }
        }
    }

    function setDefault($uid, $pid)
    {
        $this->ta->update(array("spProfilesDefault" => 0), "WHERE spUser_idspUser ='" . $uid . "'");
        $this->ta->update(array("spProfilesDefault" => 1), "WHERE idspProfiles ='" . $pid . "'");
    }

    //testing complete

    function readprofilepic($ptid, $uid)
    {
        $result = $this->ta->read("WHERE  t.spProfileType_idspProfileType = " . $ptid . " AND t.spUser_idspUser = " . $uid);
        if ($result != false) {
            return $result;
        }

        /* else{
          return $this->ta->read("WHERE  t.spProfilesDefault = " .'1' . " AND t.spUser_idspUser = " . $uid);
          } */
    }

    function plist($name, $ptid, $uid)
    {
        $result = $this->ta->read("WHERE t.spProfileName  like ('%" . $name . "%') AND t.spProfileType_idspProfileType = " . $ptid . " AND t.spUser_idspUser !=" . $uid);
        if ($result != false) {
            while ($rs = $result->fetch_assoc()) {
                $data[] = array('value' => $rs['idspProfiles'], 'label' => $rs['spProfileName']);
            }
            echo json_encode($data);
        } else
            echo "no data";
    }
    //

    function friendlistapi($name, $uid)
    {
        //old query is this.
        //$result = $this->ta->read("WHERE t.spProfileName  like ('%" . $name . "%') AND (idspProfiles in (Select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in (select idspProfiles from spprofiles where spUser_idspUser = " . $uid . " ) AND spProfiles_has_spProfileFlag = 1) OR idspProfiles in (Select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in (select idspProfiles from spprofiles where spUser_idspUser = " . $uid . " ) AND spProfiles_has_spProfileFlag = 1))");
        $result = $this->ta->read("WHERE idspProfiles in (Select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in (select idspProfiles from spprofiles where spUser_idspUser = " . $uid . " ) AND spProfiles_has_spProfileFlag = 1) OR idspProfiles in (Select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in (select idspProfiles from spprofiles where spUser_idspUser = " . $uid . " ) OR idspProfiles in(select idspProfiles from spProfiles where spUser_idspUser = " . $uid . ") AND spProfiles_has_spProfileFlag = 1))");
        /* if ($result != false) {
            while ($rs = $result->fetch_assoc()) {
                $data[] = array('value' => $rs['idspProfiles'], 'icon' => $rs['spprofiletypeicon'], 'label' => $rs['spProfileName']);
            }
            echo json_encode($data);
        } else
            echo "no data";*/
    }


    function friendlist($name, $uid)
    {
        //old query is this.
        //$result = $this->ta->read("WHERE t.spProfileName  like ('%" . $name . "%') AND (idspProfiles in (Select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in (select idspProfiles from spprofiles where spUser_idspUser = " . $uid . " ) AND spProfiles_has_spProfileFlag = 1) OR idspProfiles in (Select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in (select idspProfiles from spprofiles where spUser_idspUser = " . $uid . " ) AND spProfiles_has_spProfileFlag = 1))");
        $result = $this->ta->read("WHERE t.spProfileName  like ('%" . $name . "%') AND (idspProfiles in (Select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in (select idspProfiles from spprofiles where spUser_idspUser = " . $uid . " ) AND spProfiles_has_spProfileFlag = 1) OR idspProfiles in (Select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in (select idspProfiles from spprofiles where spUser_idspUser = " . $uid . " ) OR idspProfiles in(select idspProfiles from spProfiles where spUser_idspUser = " . $uid . ") AND spProfiles_has_spProfileFlag = 1))");


        if ($result != false) {
            while ($rs = $result->fetch_assoc()) {
                $data[] = array('value' => $rs['idspProfiles'], 'icon' => $rs['spprofiletypeicon'], 'label' => $rs['spProfileName'] . ' ( ' . $rs['spProfileTypeName'] . ' )');
            }
            echo json_encode($data);
        } else
            echo "no data";
    }

    function categoryprofiles($catid, $uid)
    {
        return $this->ta->read("WHERE t.spUser_idspUser=" . $uid . " AND spProfileType_idspProfileType in(Select spProfileType_idspProfileType from spCategory_has_spProfiletypes where spCategories_idspCategory =" . $catid . ")");
    }

    function setmembership($mid, $duration, $pid)
    {
        $subscriptiondate = date("Y-m-d");
        $renewaldate = date('Y-m-d', strtotime("+365 days"));
        $this->ta->update(array("spMembership_idspMembership" => $mid, "spProfileSubscriptionDate" => $subscriptiondate, "spProfilesRenewalDate" => $renewaldate), "WHERE idspProfiles ='" . $pid . "'");
        return 1;
    }

    function wholeselldirectory($pid, $foldername)
    {
        $this->ta->update(array("spDynamicWholesell" => $foldername), "WHERE idspProfiles ='" . $pid . "'");
    }

    function setaboutstore($pid, $about)
    {
        return $this->ta->update(array("spProfilesAboutStore" => $about), "WHERE idspProfiles ='" . $pid . "'");
    }
    //freelancer profiles
    function freelancers($uid)
    {
        return $this->ta->read("WHERE spProfileType_idspProfileType = 2 AND spUser_idspUser !=" . $uid);
    }

    function jobseekers($uid)
    {
        return $this->ta->read("WHERE spProfileType_idspProfileType = 5 AND spUser_idspUser !=" . $uid);
    }
    //get all the user against the specefic user
    //profile type profiles
    function profileTypePerson($ptype, $uid)
    {
        return $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = $ptype and spuser_idspuser != '$uid' ORDER BY idspProfiles DESC ");
    }

    function profileTypePerson_location($ptype, $uid, $country, $state, $city)
    {
        return $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = $ptype and spuser_idspuser != '$uid' and spProfilesCountry=$country and spProfilesState=$state and spProfilesCity=$city ORDER BY idspProfiles DESC ");
        // echo $this->ta->sql;
        //die('==');
    }

    function profileTypePerson_data($ptype, $uid)
    {
        return $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = $ptype and spuser_idspuser != '$uid'  ORDER BY idspProfiles DESC ");
        // echo $this->ta->sql;
        //die('==');
    }


    function profileTypePerson_data_1($ptype, $uid, $limit, $offset, $Country, $state, $city)
    {
         $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where  spuser_idspuser != '$uid'  AND t.spProfilesCountry = $Country AND t.spProfilesState = $state ORDER BY idspProfiles DESC LIMIT " . $offset . ", " . $limit . "");
        //echo $this->ta->sql;
       // die('==');   
    }

    function all_job_count($ptype, $uid, $limit, $offset, $Country, $state, $city)
    {
        return $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where  spuser_idspuser != '$uid'  AND t.spProfilesCountry = $Country AND t.spProfilesState = $state AND t.spProfilesCity = $city  ORDER BY idspProfiles DESC LIMIT " . $offset . ", " . $limit . "");
        //echo $this->ta->sql;
        //die('==');   
    }

    function empTypePerson($pid)
    {
        return $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE idspProfiles = " . $pid . " ORDER BY idspProfiles DESC");
    }

    //profile type profiles
    function profileTypePersonbycat($ptype, $uid, $cat, $limit, $offset)
    {
        $cat = $this->ta->escapeString($cat);
        return $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where  spuser_idspuser != '$uid' AND p.spPostingJobType = '$cat' ORDER BY idspProfiles DESC LIMIT " . $offset . ", " . $limit . "");
    }


    function profileTypePersonbycat_1($ptype, $uid, $cat, $limit, $offset, $Country, $state, $city)
    {
        $cat = $this->ta->escapeString($cat);   
        return $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = $ptype and spuser_idspuser != '$uid' AND t.spProfilesCountry = $Country AND t.spProfilesState = $state AND t.spProfilesCity = $city AND p.spPostingJobType = '$cat' ORDER BY idspProfiles DESC LIMIT " . $offset . ", " . $limit . "");
    }

    function all_job_count_to($ptype, $uid, $limit, $offset, $Country, $state, $city, $title)
    {
        return $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = $ptype and spuser_idspuser != '$uid' AND t.spProfilesCountry = $Country AND t.spProfilesState = $state AND t.spProfilesCity = $city  AND spPostingJobType = '$title'  ORDER BY idspProfiles DESC LIMIT " . $offset . ", " . $limit . "");
    }

    function myfreelancer($uid)
    {
        return $this->ta->read("WHERE idspProfiles in (Select spProfiles_idspProfiles from spProfiles_has_spGroup where (spGroup_idspGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")) AND spGroup_idspGroup in(select idspGroup from spgroup where spGroupName ='Favourite_Freelancer'))) AND spUser_idspUser !=" . $uid);
    }

    function myaccount($uid)
    {
        return $this->ta->read("WHERE spUser_idspUser =" . $uid . " AND spProfileType_idspProfileType = 5");
    }

    function profilelist($name, $uid)
    {
        $result = $this->ta->read("WHERE t.spProfileName  like ('%" . $name . "%') AND t.spUser_idspUser !=" . $uid . " AND (spAccountStatus != 0) AND (spprofilesPublished = 1) ");
        // echo $this->ta->sql;
        if ($result != false) {
            while ($rs = $result->fetch_assoc()) {
                $data[] = array('value' => $rs['idspProfiles'], 'label' => $rs['spProfileName'] . " (" . $rs['spProfileTypeName'] . ")");
                // $data[] =$rs['spCategoryName'];
            }
            echo json_encode($data);
        } else
            echo "no data";
    }

    //READ PROFILE TYPES FOR SEARCHING
    function searchprofile($categoryId, $txtSearch)
    {
        if (empty($categoryId)) {
            return $result = $this->ta->read("WHERE t.spProfileName  like ('%" . $txtSearch . "%') AND t.spProfileType_idspProfileType != 6 AND t.spProfileType_idspProfileType != 5 and t.is_active = 1 and t.profile_status='public'");
        } else {
            return $result = $this->ta->read("WHERE t.spProfileName  like ('%" . $txtSearch . "%') AND t.spProfileType_idspProfileType = " . $categoryId . "  and t.is_active = 1 and t.profile_status='public'");
        }
    }

    function getProfileImage($pid)
    {
        $result = $this->ta->read("WHERE idspProfiles = '$pid'");
        if ($result != false) {
            $row = mysqli_fetch_assoc($result);
            return $row['spProfilePic'];
        }
    }


    function getProfileName($pid)
    {
        $result = $this->ta->read("WHERE idspProfiles = '$pid'");
        if ($result != false) {
            $row = mysqli_fetch_assoc($result);
            return $name = $row['spProfileName'];
        }
    }
    //get specific category profile freelancer
    /*   function get_category_freelancers($uid, $catid){
        return $this->ta->read("INNER JOIN spprofilefield AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = 2 and spuser_idspuser != '$uid' AND spProfileFieldValue = '$catid' AND spProfileFieldName = 'profiletype_'");
    }*/

    function get_category_freelancers($uid, $catid)
    {
        return $this->ta->read("INNER JOIN spfreelancer_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = 2 and spuser_idspuser != '$uid' AND profiletype = '$catid' ");
    }

    function get_category_freelancers_like($catid, $name)
    {
        return $this->ta->read("INNER JOIN spfreelancer_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = 2  AND profiletype = '$catid' AND spProfileName LIKE '%$name%' ");
        // echo $this->ta->sql;
        //  die("jiikjdnnnnnnnnnnnn");
    }


    function get_category_jobseeker($uid, $catid)
    {
        return $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = 5 and spuser_idspuser != '$uid' AND spPostingJobType = '$catid'");
    }

    function get_all_category_freelancers()
    {
        return  $this->ta->read("INNER JOIN spfreelancer_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = 2 ");
        // echo $this->ta->sql;
    }

    function get_all_category_freelancers_like($name)
    {
        $name = $this->ta->escapeString($name);   
        return $this->ta->read("INNER JOIN spfreelancer_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = 2 AND spProfileName LIKE '%$name%' ");
        // echo $this->ta->sql;
    }

    function get_all_category_jobseeker($uid)
    {
        return $this->ta->read("INNER JOIN spemployment_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = 5 and spuser_idspuser != '$uid'");
    }


    function get_all_category_freelancers_offset($uid, $limit, $offset)
    {
        return $this->ta->read("INNER JOIN spfreelancer_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = 2 and spuser_idspuser != '$uid'  LIMIT " . $offset . ", " . $limit . " ");
    }


    function get_category_freelancers_offset($uid, $catid, $limit, $offset)
    {
        return $this->ta->read("INNER JOIN spfreelancer_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles where spprofiletype_idspprofiletype = 2 and spuser_idspuser != '$uid' AND profiletype = '$catid' LIMIT " . $offset . ", " . $limit . "");
    }

    function alluserprofile($uid)
    {
        return $this->ta->read("WHERE spUser_idspUser ='$uid'");
    }



    //my freelancer account
    function myfreelanceraccount($uid)
    {
        return $this->ta->read("WHERE  spProfileType_idspProfileType = 2 AND spUser_idspUser ='$uid'");
    }
    //chek user has business profile or not.
    function chekProfileIsBusiness($uid)
    {
        return $this->ta->read("WHERE (spProfileType_idspProfileType = 1 OR spProfileType_idspProfileType = 3) AND spUser_idspUser = $uid");
    }
    //chek dynamic user has which profile and type
    function mySpeceficAccount($ptype, $uid)
    {
        return $this->ta->read("WHERE  spProfileType_idspProfileType = $ptype AND spUser_idspUser = $uid ");
    }
    //chek user profile busines or freelancer
    function isBusinessProfile($pid)
    {
        return $this->ta->read("WHERE spProfileType_idspProfileType = 1 AND  idspProfiles = $pid");
    }
    //read user id
    function readUserId($pid)
    {
        $pid = $this->ta->escapeString($pid);
        return $this->ta->read("WHERE idspProfiles = $pid");
        //echo $this->ta->sql;die('====555');

    }

    // function readUserId01($cat)
    // {
    //     return $this->ta9->read("WHERE idmasterDetails=$cat");
    //    //echo $this->ta9->sql;die('====555');

    // }
    // function readcat($cat22)
    // {
    //     return $this->taa2->read("where idmasterDetails=$cat22");
    //      //echo $this->taa2->sql;
    //      //die("mukersh cvhaihfje");
    // }

    function readcat11($cato)
    {
        return $this->tac->read("where idmasterDetails=$cato");
        //echo $this->tac->sql;
        //die("mukesh chauhanh");

    }


    function readUserId11($pid)
    {
        return $this->sbu->read("WHERE spprofiles_idspProfiles = $pid");
        //echo $this->ta->sql;die('====555');

    }

    function readUserId22($pid)
    {
        return $this->scate->read("WHERE idmasterDetails = $pid");
        //echo $this->ta->sql;die('====555');

    }

    function readUserId111($pid)
    {
        return $this->sbu1->read("WHERE spprofiles_idspProfiles = $pid");
        //echo $this->ta->sql;die('====555');

    }

    function readUserId222($pid)
    {
        return $this->scate1->read("WHERE idmasterDetails = $pid");
        //echo $this->ta->sql;die('====555');

    }
    //get today birth days
    function getTodayBirthday($pid)
    {
        return $this->ta->read("INNER JOIN spUser SU ON SU.idspUser = t.spUser_idspUser WHERE  t.idspProfiles = " . $pid . " AND DAY(t.spProfilesDob) = DAY(CURRENT_DATE()) AND MONTH(t.spProfilesDob) = MONTH(CURRENT_DATE())", "", "*");
    }
    //get specific month result
    function getMonthBirthday($pid, $month)
    {
        return $this->ta->read("INNER JOIN spUser SU ON SU.idspUser = t.spUser_idspUser WHERE t.idspProfiles = $pid AND MONTH(t.spProfilesDob) = $month", "", "*");
    }
    //get all art gallery profile types
    function getArtGalleryCat($ptid, $catName)
    {
        return $this->ta->read("INNER JOIN spprofilefield as f ON t.idspProfiles = f.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = $ptid AND f.spProfileFieldName = 'category_' AND f.spProfileFieldValue = '$catName'");
    }

    // show all business profiles with business category
    function readBusDirProfile($category, $limit)
    {
        //return $this->ta->read("INNER JOIN spprofilefield AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = 1 AND p.spProfileFieldName = 'businesscategory_' AND spProfileFieldValue = '$category' ORDER BY idspProfiles DESC LIMIT $limit");
        return  $this->ta->read("INNER JOIN spprofilefield AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = 1 AND p.spProfileFieldName = 'businesscategory_' AND $category ORDER BY idspProfiles DESC LIMIT $limit");

        //echo  $this->ta->sql; die('===========');

    }


    function readBusDirProfile_cat($category, $limit)
    {
        return  $this->ta->read("INNER JOIN spbusiness_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = 1 AND  $category ORDER BY idspProfiles ASC LIMIT $limit");
    }



    function readBusDirProfile_search($condition, $limit, $country, $state, $city)
    {
        return  $this->ta->read("INNER JOIN spbusiness_profile AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = 1 AND  $condition AND t.spProfilesCountry=$country AND t.spProfilesState= $state AND t.spProfilesCity =$city ORDER BY idspProfiles ASC LIMIT $limit");
    }




    function readBusDirProfile_search_all($country, $state, $city)
    {
        return $this->ta->read("INNER JOIN spprofilefield AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = 1 AND p.spProfileFieldName = 'businesscategory_'  AND t.spProfilesCountry=$country AND t.spProfilesState= $state AND t.spProfilesCity =$city  ORDER BY idspProfiles  DESC");
    }




    function readBusDirProfile_all()
    {
        //return $this->ta->read("INNER JOIN spprofilefield AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = 1 AND p.spProfileFieldName = 'businesscategory_' AND spProfileFieldValue = '$category' ORDER BY idspProfiles DESC LIMIT $limit");
        return $this->ta->read("INNER JOIN spprofilefield AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = 1 AND p.spProfileFieldName = 'businesscategory_'  ORDER BY idspProfiles  DESC");
        echo $this->ta->sql;
        die;
    }



    // show all business profiles
    function readBusDirPro($limit)
    {
        return $this->ta->read("INNER JOIN spprofilefield AS p ON t.idspProfiles = p.spprofiles_idspProfiles WHERE t.spProfileType_idspProfileType = 1 AND p.spProfileFieldName = 'businesscategory_' OR p.spProfileFieldName = 'businesscategory'  ORDER BY idspProfiles DESC LIMIT $limit");
    }
    // search profile by business name


    /***************************** combined the search by company name and profile name **********************/
    function searchByBoth($searchTerm)
    {
        $queryCountry = $_SESSION['spPostCountry_search'];

        return $this->ta->read("
        LEFT JOIN spbusiness_profile AS BP 
            ON t.idspProfiles = BP.spprofiles_idspProfiles 
        LEFT JOIN spprofilefield AS p 
            ON t.idspProfiles = p.spprofiles_idspProfiles 
        WHERE spprofiletype_idspprofiletype = 1 
            AND (
                (p.spProfileFieldName = 'companyname' AND p.spProfileFieldValue LIKE '%$searchTerm%')
                OR (t.spProfileName LIKE '%$searchTerm%')
            )
            AND t.spProfilesCountry IS NOT NULL
            AND t.spProfilesCountry = $queryCountry
        GROUP BY t.idspProfiles
        ORDER BY 
            CASE 
                WHEN p.spProfileFieldValue LIKE '$searchTerm%' THEN 0
                WHEN t.spProfileName LIKE '$searchTerm%' THEN 1
                WHEN p.spProfileFieldValue LIKE '%$searchTerm%' THEN 2
                WHEN t.spProfileName LIKE '%$searchTerm%' THEN 3
                ELSE 4
            END,
            t.spProfileName ASC
    ");
    }


    function searchByCmpnyName($cmpnyName)
    {
        $queryCountry = $_SESSION['spPostCountry_search'];
//        var_dump($temp);
//        die();


        return $this->ta->read("
    INNER JOIN spbusiness_profile AS BP 
        ON t.idspProfiles = BP.spprofiles_idspProfiles 
    INNER JOIN spprofilefield AS p 
        ON t.idspProfiles = p.spprofiles_idspProfiles 
    WHERE spprofiletype_idspprofiletype = 1 
        AND spProfileFieldValue LIKE ('%" . $cmpnyName . "%')  
        AND p.spProfileFieldName = 'companyname'
        AND t.spProfilesCountry IS NOT NULL
        AND t.spProfilesCountry = $queryCountry
    ORDER BY 
        CASE 
            WHEN spProfileFieldValue LIKE '" . $cmpnyName . "%' THEN 0
            WHEN spProfileFieldValue LIKE '%" . $cmpnyName . "%' THEN 1
            ELSE 2
        END,
        spProfileFieldValue ASC
");


        echo $this->ta->sql;
    }
    // SEARCH PROFILE BY NAME
    function searchByProfileName($profileName)
    {
        return $this->ta->read("WHERE spprofiletype_idspprofiletype = 1 AND spProfileName like ('%" . $profileName . "%') ");
    }
    // read All Profiles
    function readMyAllProfile($uid, $pid)
    {
        return $this->ta->read("WHERE spUser_idspUser = $uid AND t.idspProfiles != $pid AND idspProfiles != 2 AND idspProfiles != 5 AND spProfileType_idspProfileType != 2 AND spProfileType_idspProfileType != 5");
    }

    function get_user_id($profile)
    {
        return $this->ta->read("WHERE idspProfiles = " . $profile);
    }

    function friendNamelist($name, $uid, $pid)
    {
        //old query is this.
        //$result = $this->ta->read("WHERE t.spProfileName  like ('%" . $name . "%') AND (idspProfiles in (Select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in (select idspProfiles from spprofiles where spUser_idspUser = " . $uid . " ) AND spProfiles_has_spProfileFlag = 1) OR idspProfiles in (Select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in (select idspProfiles from spprofiles where spUser_idspUser = " . $uid . " ) AND spProfiles_has_spProfileFlag = 1))");
        $result = $this->ta->read(
            "WHERE t.spProfileName  like ('%" . $name . "%')
                AND (idspProfiles IN (SELECT sps.spProfiles_idspProfilesReceiver FROM
                        `spprofiles_has_spprofiles` sps
                        WHERE sps.spProfiles_has_spProfileFlag = 1 AND " . $pid . "
                        IN (sps.spProfiles_idspProfileSender,sps.spProfiles_idspProfilesReceiver))
                    OR idspProfiles IN (SELECT sps1.spProfiles_idspProfileSender FROM
                        `spprofiles_has_spprofiles` sps1
                        WHERE sps1.spProfiles_has_spProfileFlag = 1 AND " . $pid . "
                        IN (sps1.spProfiles_idspProfileSender,sps1.spProfiles_idspProfilesReceiver))
                    )
                AND idspProfiles != " . $pid
        );
        $data = [];
        $imgString = '';
        $imgString = json_encode($imgString);
        if ($result != false) {
            while ($rs = $result->fetch_assoc()) {

                $p_type = '  ( ' . $rs['spProfileTypeName'] . '  Profile)';
                $data[] = array('id' => $rs['idspProfiles'], 'text' => $rs['spProfileName'] . $p_type);
            }
        }
        return $data;
    }

    function flageCountByProfileId($profileid)
    {
        return  $this->flage->read("WHERE t.profileid=" . $profileid);
        // echo $this->flage->sql;
    }

    function getSubAmount()
    {
        return  $this->subAmount->read("WHERE id=1");
    }
}
