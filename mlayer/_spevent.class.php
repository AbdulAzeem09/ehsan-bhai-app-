<?php
class _spevent
{
public $dbclose = false;
private $conn;
public $ta;
function __construct()
{
  $this->ta = new _tableadapter("spevent"); 
  $this->event_data = new _tableadapter("event_data");
  $this->event_gallery = new _tableadapter("event_gallery");
  $this->event_co_host = new _tableadapter("event_co_host");
  $this->event_tickets = new _tableadapter("event_tickets");
  $this->event_interested = new _tableadapter("event_interested");
  $this->event_registration = new _tableadapter("event_registration");
  $this->user_event_tickets = new _tableadapter("user_event_tickets");
  $this->ta->dbclose = false;
  $this->tafav = new _tableadapter("speventfavorites");
  $this->tad = new _tableadapter("speventpics");
  $this->tab = new _tableadapter("spbid");
  $this->taff = new _tableadapter("speventgallery");
  $this->tatra = new _tableadapter("spevent_transection");
  $this->tasp = new _tableadapter("spuser");
  $this->tbl = new _tableadapter("spevent_type_price");
  $this->txn = new _tableadapter("spproof_event_wallet");
  $this->tad->dbclose = false;
  $this->tai = new _tableadapter("events_imgs");
  $this->stpe = new _tableadapter("spevent_cancellation");
  $this->taisss = new _tableadapter("spevent");
  $this->real = new _tableadapter("sprealstate");
  $this->mod = new _tableadapter("speventwallet");
  $this->tai->dbclose = false;
}




function del_event($id)
{
  
return $this->ta->remove("WHERE t.idspPostings=".$id);
 //echo $this->stpe->sql; die('====');
}

function deletedata_cancel($id)
{
  //echo $txnid;die("ssssssss");
return $this->stpe->remove("WHERE t.id=".$id);
 //echo $this->stpe->sql; die('====');
}

function read_canceldata($txnid)
{
  return $this->stpe->read( "where txn_id=".$txnid);
//echo $this->stpe->sql; die('==3333==');
}


function spuser_read($spuserid)
{
return $this->tasp->read( "where idspUser=".$spuserid);
}




function ticket_type_price($event_id)
{
return $this->tbl->read( "where typeid=".$event_id);
}

function insertmodal($data)
{
return $this->mod->create($data);
//echo $this->mod->sql; die('====');
}



function sp_read($data)
{
return $this->ta->read( "where idspPostings=".$data);
}

function create($data)
{
return $this->ta->create($data);
}

function Refund($id)
{
 return $this->tatra->read("where id = ". $id);
//echo $this->tatra->sql; die('====');
}


function removeProfiles($pid)
{
$this->ta->remove("WHERE t.spProfiles_idspProfiles= " . $pid);
}

function event_favorite($category, $pid)
{
return $this->ta->read("INNER JOIN speventfavorites AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spCategories_idspCategory = $category  AND p.spProfiles_idspProfiles = $pid  order by t.spPostingDate  DESC LIMIT 10 ");
//echo $this->ta->sql;  die("--------"); 
}

function create_txn($data)
{
return $this->txn->create($data);
}

function createGallery($data)
{
return $this->taff->create($data);
}

// Active events of group
function getActiveEventsOfGroup($groupId, $visilty, $catid)
{
return $this->ta->read("WHERE t.spPostingVisibility = " . $visilty . " AND t.groupid = " . $groupId . " AND t.spCategories_idspCategory = $catid", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
}

function getActiveEventsrecord($pId, $visilty, $catid)
{
  $pId = $this->ta->escapeString($pId);
return $this->ta->read("WHERE t.spPostingVisibility = " . $visilty . " AND t.spProfiles_idspProfiles = " . $pId . " AND t.spCategories_idspCategory = $catid", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
}


function read_now($pid)
{
return $this->ta->read("where t.spProfiles_idspProfiles = " . $pid);
}

function createeventapi($event)
{
return $this->ta->create($event);
}

function read_favorite_event($id)
{

return $this->tafav->read("WHERE t.spPostings_idspPostings=$id");
}

function post($data)
{
$postid = $this->ta->create($data);
return $postid;
}


function createEventData($data){
$postid = $this->event_data->create($data);
return $postid;
}

function create_intrest($data){
$intId  = $this->event_interested->create($data);
return $intId;
}

function read_intrested_data($id,$user_id)
{
return $this->event_interested->read('WHERE t.post_id = '.$id.' AND t.user_id  = '.$user_id.'');
}
function event_intresed_data($id,$user_id)
{
return $this->event_interested->read('WHERE t.post_id = '.$id.' AND t.user_id  = '.$user_id.'');
}

function event_registration($data){
return $this->event_registration->create($data);
}

function event_registration_read($id,$user_id){
return $this->event_registration->read('WHERE t.post_id = '.$id.' AND t.user_id  = '.$user_id.'');
}

function update_intrested_data($data,$id,$user_id)
{
return  $this->event_interested->update($data, "WHERE t.post_id = $id AND t.user_id  = $user_id");
}

function read_event_data()
{
return $this->event_data->read();
}
function read_event_first_data($id)
{
return $this->event_data->read("WHERE t.id = $id");
}

function event_online_data()
{
return $this->event_data->read("WHERE t.event_platform_title = 'Online_event'");
}

function event_online_data_with_city_filter($data)
{
return $this->event_data->read("WHERE t.event_platform_title = 'Online_event' AND t.city = $data");
}



function event_all_data()
{
return $this->event_data->read("WHERE Date(`start_date`) >= '".date('Y-m-d')."'");
}

function event_all_data_with_city_filter($data)
{
return $this->event_data->read("WHERE Date(`start_date`) >= '".date('Y-m-d')."' AND t.city = $data");
}
function event_all_data_with_online_filter()
{
return $this->event_data->read("WHERE Date(`start_date`) >= '".date('Y-m-d')."' AND t.event_platform_title = 'Online_event'");
}




function event_todays_data()
{
return $this->event_data->read("WHERE Date(`start_date`)='".date('Y-m-d')."'");
}

function event_todays_data_with_city_filter($data)
{
return $this->event_data->read("WHERE Date(`start_date`)='".date('Y-m-d')."' AND t.city = $data");
}
function event_todays_data_with_online_filter()
{
return $this->event_data->read("WHERE Date(`start_date`)='".date('Y-m-d')."'  AND t.event_platform_title = 'Online_event'");
}



function event_weekend_data()
{
return $this->event_data->read("WHERE Date(`start_date`)='".date( 'Y-m-d', strtotime( 'next Saturday' ) )."'");
}
function event_weekend_data_with_city_filter($data)
{
return $this->event_data->read("WHERE Date(`start_date`)='".date( 'Y-m-d', strtotime( 'next Saturday' ) )."' AND t.city = $data");
}
function event_weekend_data_with_online_filter()
{
return $this->event_data->read("WHERE Date(`start_date`)='".date( 'Y-m-d', strtotime( 'next Saturday' ) )."' AND t.event_platform_title = 'Online_event'");
}




function event_free_data()
{
return $this->event_data->read("WHERE t.event_type=1");
}
function event_free_data_with_city_filter($data)
{
return $this->event_data->read("WHERE t.event_type=1 AND t.city = $data");
}
function event_free_data_with_online_filter()
{
return $this->event_data->read("WHERE t.event_type=1 AND t.event_platform_title = 'Online_event'");
}



function event_music_data()
{
return $this->event_data->read("WHERE t.event_description LIKE  '%music%'");
}
function event_music_data_with_city_filter($data)
{
return $this->event_data->read("WHERE t.event_description LIKE  '%music%' AND t.city = $data");
}
function event_music_data_with_online_filter()
{
return $this->event_data->read("WHERE t.event_description LIKE  '%music%' AND  t.event_platform_title = 'Online_event'");
}


function event_food_drink_data()
{
return $this->event_data->read("WHERE t.event_description LIKE  '%food%' OR t.event_description LIKE  '%drink%'");
}
function event_food_drink_data_with_city_filter($data)
{
return $this->event_data->read("WHERE t.event_description LIKE  '%food%' OR t.event_description LIKE  '%drink%' AND t.city = $data");
}
function event_food_drink_data_with_online_filter()
{
return $this->event_data->read("WHERE t.event_description LIKE  '%food%' OR t.event_description LIKE  '%drink%' AND t.event_platform_title = 'Online_event'");
}


function event_charity_causes_event_data()
{
return $this->event_data->read("WHERE t.event_description LIKE  '%charity%' OR t.event_description LIKE  '%causes%'");
}

function event_charity_causes_event_data_with_city_filter($data)
{
return $this->event_data->read("WHERE t.event_description LIKE  '%charity%' OR t.event_description LIKE  '%causes%' AND t.city = $data");
}

function event_charity_causes_event_data_with_online_filter()
{
return $this->event_data->read("WHERE t.event_description LIKE  '%charity%' OR t.event_description LIKE  '%causes%' AND  t.event_platform_title = 'Online_event'");
}




function read_event_intrested_data()
{
return $this->event_data->read("WHERE t.event_platform_title = 'Online_event'");
}

function event_user_intres_data($id, $uid)
{
return $this->event_interested->read("WHERE t.user_id = $uid AND t.post_id= $id");
}

function event_user_intres_data_with_city($id, $uid)
{
return $this->event_interested->read("WHERE t.user_id = $uid AND t.post_id= $id");
}

function eventGallery($data){
$postid = $this->event_gallery->create($data);
return $postid;
}
function event_co_host($data){
$postid = $this->event_co_host->create($data);
return $postid;
}
function event_tickets($data){
$postid = $this->event_tickets->create($data);
return $postid;
}

function event_tickets_read($id){
$post = $this->event_tickets->read("WHERE t.post_id = '$id'");
return $post;
}

function user_event_tickets_Store($input){
$post = $this->user_event_tickets->create($input);
return $post;
}
function user_event_tickets_read($uid,$id){
$post = $this->user_event_tickets->read("WHERE t.user_id = $uid AND t.post_id= $id");
return $post;
}



function read($postid)
{
//die('ppppppppppppp');
return $this->ta->read("WHERE idspPostings = " . $postid);
//echo $this->ta->sql; die("----");
//return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
//return $this->ta->read("WHERE uid =".$uid);
}

function readaddfeaturning($postid)
{
//die('ppppppppppppp');
return $this->taisss->read("WHERE idspPostings = " . $postid);
}
function update($data, $pid)
{
//die('===========');
return $this->ta->update($data, $pid);
}

function updateEvnt($data, $pid)
{
return   $this->ta->update($data, "WHERE t.idspPostings = $pid");
// echo $this-ta->sql;
//die("++++++++++++++++");

}

function getall_event()
{

return $this->ta->read("WHERE t.spPostingVisibility=-1");
}

function publicpost_eventnew($category)
{

//print_r($category);
return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE()", "ORDER BY spPostingDate DESC");
//return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND t.spPostingVisibility=-1 AND t.spPostingExpDt < CURDATE()", "ORDER BY spPostingDate DESC");
}

function homepage_events($category)
{

$catstr = str_replace(",", "','", $category);

return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.eventcategory in('" . $catstr . "') AND t.spPostingExpDt >= CURDATE()", "ORDER BY spPostingDate DESC");
//echo $this->ta->sql; die('===========');

}

function homepage_events_top_pag($country, $state, $city, $start, $limit)
{

//$catstr = str_replace(",","','",$category);


return $this->ta->read("WHERE t.spPostingVisibility=-1  AND t.spPostingExpDt >= CURDATE() AND spPostingsCountry = $country AND spPostingsState = $state", "ORDER BY spPostingDate DESC LIMIT $start, $limit ");
//echo $this->ta->sql;
//die('===========');
}


function homepage_events_top_pag_reminder($date_e)
{

//$catstr = str_replace(",","','",$category);


return $this->ta->read("where t.spPostingVisibility=-1 AND t.spPostingStartDate = '$date_e'");
//echo $this->ta->sql;
//die('===========');

}

function reminder_transaction_data($data_store)
{
return $this->tatra->read("where t.postid=$data_store");
//echo $this->tatra->sql;
//die("++++");
}

function reminder_spuser_data($buyer_id)
{
return $this->tasp->read("where t.idspUser=$buyer_id");
//echo $this->tasp->sql;
//die("++++");
}




function feature_event($country, $state, $city, $start, $limit)
{
return  $this->ta->read("WHERE t.spPostingVisibility=-1  AND t.spPostingExpDt >= CURDATE() AND spPostingsCountry = $country AND spPostingsState = $state and is_feature=1", "ORDER BY spPostingDate DESC LIMIT $start, $limit ");
}

function homepage_events_top($country, $state, $city)
{
return  $this->ta->read("WHERE t.spPostingVisibility=-1  AND t.spPostingExpDt >= CURDATE() AND spPostingsCountry = $country AND spPostingsState = $state", "ORDER BY spPostingDate DESC LIMIT 8 ");
//  echo   $this->ta->sql;
//die("==========");
}


function homepage_events_top_feature($country, $state, $city)
{
return  $this->ta->read("WHERE t.spPostingVisibility=-1  AND t.spPostingExpDt >= CURDATE() AND spPostingsCountry = $country AND spPostingsState = $state and is_feature=1 ", "ORDER BY spPostingDate DESC LIMIT 10 ");
}

function get_filter_event($where, $country, $state, $city)
{
return  $this->ta->read("WHERE $where AND t.spPostingExpDt >=  CURDATE() AND spPostingsCountry = $country AND spPostingsState = $state", "ORDER BY spPostingDate DESC LIMIT 8 ");
echo $this->ta->sql;
}


function homepage_events_top1($country, $state)
{
return $this->ta->read("WHERE t.spPostingVisibility=-1  AND t.spPostingExpDt >= CURDATE() AND spPostingsCountry = $country AND spPostingsState = $state  ", "ORDER BY spPostingDate DESC LIMIT 8 ");
}
function homepage_events_top2($country)
{
return $this->ta->read("WHERE t.spPostingVisibility=-1  AND t.spPostingExpDt >= CURDATE() AND spPostingsCountry = $country ", "ORDER BY spPostingDate DESC LIMIT 8 ");
echo $this->ta->sql;
die("+++++");
}



function homepage_events_top1_feature($country, $state)
{
return $this->ta->read("WHERE t.spPostingVisibility=-1  AND t.spPostingExpDt >= CURDATE() AND spPostingsCountry = $country AND spPostingsState = $state and is_feature=1 ", "ORDER BY spPostingDate DESC LIMIT 10 ");
}
function homepage_events_top2_feature($country)
{
return $this->ta->read("WHERE t.spPostingVisibility=-1  AND t.spPostingExpDt >= CURDATE() AND spPostingsCountry = $country and is_feature=1", "ORDER BY spPostingDate DESC LIMIT 10 ");
echo $this->ta->sql;
die("+++++");
}




function publicpost_eventnewapi($offset, $limit)
{

//print_r($category);
return $this->ta->read("WHERE t.spPostingVisibility=-1 AND  t.spPostingExpDt >= CURDATE()", " ORDER BY spPostingDate DESC LIMIT " . $offset . ", " . $limit . "");
//return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND t.spPostingVisibility=-1 AND t.spPostingExpDt < CURDATE()", "ORDER BY spPostingDate DESC");
}

function showdailywiseevent($date, $category)
{
return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category, " AND t.spPostingStartDate = '$date' ORDER BY spPostingDate DESC");
}
//    function showDailyWiseEvents($data)
//    {
//        $date = strtotime($data);
//        return $this->event_data->read("WHERE  Date(`start_date`)='".date( 'Y-m-d', $date)."'");
//    }

function publicpost($start, $category = "*")
{
if ($category == "*")
return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory != 16 ", "AND flag_status=2 AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC LIMIT 20");
else
return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category, "AND flag_status=2 AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC LIMIT 15");
}

function searchEvent($category, $txttitle, $date, $catName, $loc, $countery, $state)
{
if ($category != '' and $txttitle != '' and $date != '' and $catName != '' and $loc != '' and $countery != '' and $state != '') {

return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $txttitle . "%')  AND t.spPostingStartDate = '$date' and sppostingscountry = $countery and sppostingsstate = $state ORDER BY spPostingDate DESC");
} else if ($category != '' and $txttitle != '' and $date != '') {

return $this->ta->read(" WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $txttitle . "%')  AND t.spPostingStartDate = '$date'  and sppostingscountry = $countery and sppostingsstate = $state ORDER BY spPostingDate DESC");
// echo $this->ta->sql; die('========='); 

} else {

return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $txttitle . "%') AND and sppostingscountry = $countery and sppostingsstate = $state and t.spCategories_idspCategory = " . $category,  "ORDER BY spPostingDate DESC");
}
}

// ACTIVE PRODUCTS
function myActPost($pid, $visilty, $catid)
{
return $this->ta->read("WHERE t.spPostingVisibility = " . $visilty . " AND t.spProfiles_idspProfiles = " . $pid . " AND t.spCategories_idspCategory = $catid", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
//echo $this->ta->sql; die('=========='); 

}

function myActPost_active($pid, $visilty)
{
return $this->ta->read("WHERE t.spPostingVisibility = " . $visilty . " AND t.spProfiles_idspProfiles = " . $pid . " AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
//echo $this->ta->sql; die('=========='); 

}




function spevent_read($pid)
{
return $this->stpe->read("WHERE t.event_owner_id = ".  $pid);
//echo $this->stpe->sql; die('=========='); 

}
function spevent_update($pid)
{
return $this->stpe->read("WHERE t.txn_id = ".  $pid);
//echo $this->stpe->sql; die('=========='); 

}




function updatemodal($data, $postid)
{

  return  $this->stpe->update($data, "WHERE t.txn_id = " . $postid);
echo $this->stpe->sql; die('=========='); 
}


function spevent_red($id)
{

return $this->stpe->read("WHERE t.id = " . $id);
//echo $this->ta->sql; die('=========='); 
}


function spevent_red_data($id)
{

return $this->stpe->read("WHERE t.txn_id = " . $id);
//echo $this->ta->sql; die('=========='); 
}











function all_event()
{
return $this->ta->read("order by idspPostings desc");
// echo $this-ta->sql;
// die("++++++++++++++++");
}


function singletimelines($postid)
{
  $postid = $this->ta->escapeString($postid);
  //return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
  return $this->ta->read("WHERE t.idspPostings =  $postid");
}

function readFeaturPost($postid)
{
  $postid = $this->ta->escapeString($postid);
  return $this->ta->read("WHERE idspPostings = $postid");
}

function readSponsorPost($postid)
{
  $postid = $this->ta->escapeString($postid);
  return $this->ta->read('WHERE idspPostings = "' . $postid . '" AND sponsorid !="" ');
}

// MY EXPIRE PRODUCT
function myExpireProduct($catId, $pid)
{
return $this->ta->read("WHERE t.spProfiles_idspProfiles = $pid AND t.spCategories_idspCategory = $catId AND t.spPostingVisibility != -3 AND t.spPostingExpDt < CURDATE() ORDER BY spPostingDate DESC");
}


// MY DRAFT PRODUCTS PROFILE AND CATEGORY WISE
function readMyDraftprofile($catid, $pid)
{
//return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
return $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spCategories_idspCategory = $catid AND t.spPostingVisibility = 0", "ORDER BY spPostingDate DESC");
 //echo $this->ta->sql;
}

// TRASH POST
function trashpost($postid)
{
$this->ta->update(array("spPostingVisibility" => -3), "WHERE t.idspPostings = " . $postid);
}

function update_feature($data, $postid)
{
$this->ta->update($data, "WHERE t.idspPostings = " . $postid);
}






function update_feature_1($data, $postid)
{
$this->real->update($data, "WHERE t.idspPostings = " . $postid);
}



function update_feature_bid($data, $postid)
{
$this->tab->update($data, "WHERE t.id = " . $postid);
}


function update_real_feature($data, $postid)
{
$this->real->update($data, "WHERE t.idspPostings = " . $postid);
}

// DELETE POSTINGS
function remove($postid)
{
$this->ta->remove("WHERE t.idspPostings = " . $postid);
}
function delete_value($postid)
{
$this->ta->remove("WHERE t.idspPostings = " . $postid);
}

function myflagPost($catid, $pid)
{
return $this->ta->read("WHERE spProfiles_idspProfiles = $pid AND spCategories_idspCategory = $catid AND spPostingVisibility = 3 ORDER BY spPostingDate DESC ");
}


function readeventPost($pid)
{
return $this->ta->read("WHERE spProfiles_idspProfiles = $pid");
}

function all_event_pid($pid)
{
return  $this->ta->read("WHERE spProfiles_idspProfiles = $pid order by idspPostings desc");
//echo $this->ta->sql; die('===========');

}

function eventExists()
{
return $this->ta->read("ORDER BY t.idspPostings DESC LIMIT 1");
}
function eventImgs()
{
return $this->tai->read();
}
}
