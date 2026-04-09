<?php 
class _spgroup_event
{
    public $dbclose = false;
    private $conn;
    public $ta;

    function __construct() { 
        $this->ta = new _tableadapter("sp_groupevent");
        $this->ta->dbclose = false;
        $this->tad = new _tableadapter("sp_groupeventpics");
        $this->tad->dbclose = false;
        $this->tae = new _tableadapter("spevent");
        $this->tav = new _tableadapter("spevent");
        $this->tav->join = "INNER JOIN share as d ON t.idspPostings = d.spPostings_idspPostings";
        $this->tae->dbclose = false;
    } 
    
    function create($data){
        return $this->ta->create($data);
    }

    function createEvnetBanner($data){
        return $this->tad->create($data);
    }

    function readEventBanner($eid)
    {
        return $this->tad->read("WHERE spPostings_idspPostings = " . $eid );
    }

    function post($data) {
        $postid = $this->ta->create($data);
        return $postid;
    }
    
    function read($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid );
    }
    
    function update($data, $pid){
        $this->ta->update($data, $pid);
    }
    
    function createeventapi($event)
    {
        return $this->ta->create($event);
    }

    function getall_event(){
        return $this->ta->read("WHERE t.spPostingVisibility=-1");
    }

    function publicgroup_event($gid){
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spgroupid = $gid AND t.spPostingExpDt >= CURDATE()" , "ORDER BY spPostingDate DESC");
        //return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND t.spPostingVisibility=-1 AND t.spPostingExpDt < CURDATE()", "ORDER BY spPostingDate DESC");
    }
	
	function publicgroup_eventnew($gid){
        return $this->tae->read("WHERE t.spPostingVisibility=-1 AND t.groupid = $gid AND t.spPostingExpDt >= CURDATE()" , "ORDER BY spPostingDate DESC");
    }

    function publicpost_eventnew($category){
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE()" , "ORDER BY spPostingDate DESC");
        //return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND t.spPostingVisibility=-1 AND t.spPostingExpDt < CURDATE()", "ORDER BY spPostingDate DESC");
    }


    function publicpost_eventnewapi($offset,$limit){
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND  t.spPostingExpDt >= CURDATE()" , " ORDER BY spPostingDate DESC LIMIT ".$offset.", ".$limit."");
        //return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND t.spPostingVisibility=-1 AND t.spPostingExpDt < CURDATE()", "ORDER BY spPostingDate DESC");
    }

       function showdailywiseevent($date, $category) {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category, " AND t.spPostingStartDate >= '$date' ORDER BY spPostingDate DESC");
    }

    function publicpost($start, $category = "*") {
        if ($category == "*")
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory != 16 ", " AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC LIMIT 20");
        else
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category, " AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC LIMIT 15");
    }

    function searchEvent($category, $txttitle, $date, $catName, $loc) {
        if($category != '' AND $txttitle != '' AND $date != '' AND $catName != '' AND $loc != ''){
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $txttitle . "%') AND t.spCategories_idspCategory = $category AND t.spPostingStartDate = '$date' ORDER BY spPostingDate DESC");
        }else if($category != '' AND $txttitle != '' AND $catName != ''){
            return $this->ta->read(" WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $txttitle . "%') AND t.spCategories_idspCategory = $category AND t.spCategories_idspCategory = '$catName' ORDER BY spPostingDate DESC");
        }else{
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $txttitle . "%') AND t.spCategories_idspCategory = " . $category, "ORDER BY spPostingDate DESC");    
        }
    }

    function searchEventByDate($startDate, $endDate) {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingStartDate = '$startDate' AND t.spPostingEndDate = '$endDate' ORDER BY spPostingDate DESC");
    }

    // ACTIVE PRODUCTS
    function myActPost($pid, $visilty, $catid){
        return $this->ta->read("WHERE t.spPostingVisibility = ".$visilty." AND t.spProfiles_idspProfiles = " . $pid . " AND t.spCategories_idspCategory = $catid", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }


    // Past expired events of group
    function getExpiredEventsOfGroup($groupId, $visilty, $catid){
        return $this->ta->read("WHERE t.spPostingVisibility = ".$visilty." AND t.spgroupid = " . $groupId . " AND t.spCategories_idspCategory = $catid", "AND t.spPostingExpDt <= CURDATE() ORDER BY spPostingDate DESC");
    }

    // Active events of group
    function getActiveEventsOfGroup($groupId, $visilty, $catid){
        return $this->ta->read("WHERE t.spPostingVisibility = ".$visilty." AND t.spgroupid = " . $groupId . " AND t.spCategories_idspCategory = $catid", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }

    // DELETE events of group
    function removeEventOfGroup($evntId,$groupId) {
        $this->ta->remove("WHERE t.idspPostings = " . $evntId. " AND t.groupId = ". $groupId);
    }


    function singletimelines($postid) {
        //return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
        return $this->ta->read("WHERE t.idspPostings =  $postid");
    }

    function readFeaturPost($postid){
        return $this->ta->read("WHERE idspPostings = $postid");
    }

    function readSponsorPost($postid){
        return $this->ta->read('WHERE idspPostings = "'.$postid.'" AND sponsorid !="" ');
    }

       // MY EXPIRE PRODUCT
    function myExpireProduct($catId, $pid){
        return $this->ta->read("WHERE t.spProfiles_idspProfiles = $pid AND t.spCategories_idspCategory = $catId AND t.spPostingVisibility != -3 AND t.spPostingExpDt < CURDATE() ORDER BY spPostingDate DESC");
    }


      // MY DRAFT PRODUCTS PROFILE AND CATEGORY WISE
    function readMyDraftprofile($catid, $pid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
        return $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spCategories_idspCategory = $catid AND t.spPostingVisibility = 0", "ORDER BY spPostingDate DESC");
    }

    // TRASH POST
    function trashpost($postid) {
        $this->ta->update(array("spPostingVisibility" => -3),"WHERE t.idspPostings = " . $postid);
    }

    // DELETE POSTINGS
    function remove($postid) {
        $this->ta->remove("WHERE t.idspPostings = " . $postid);
    }

    function myflagPost($catid, $pid){
        return $this->ta->read("WHERE spProfiles_idspProfiles = $pid AND spCategories_idspCategory = $catid AND spPostingVisibility = 3 ORDER BY spPostingDate DESC ");
    }

    function readeventPost($pid){
        return $this->ta->read("WHERE spProfiles_idspProfiles = $pid");
    }
	
	function readsharePost($gid){
       return $this->tav->read(" WHERE t.spPostingVisibility=-1 AND d.spShareToGroup = $gid AND t.spCategories_idspCategory = 9 AND t.spPostingExpDt >= CURDATE()" , "ORDER BY spPostingDate DESC ");
		//echo $this->tav->sql;
    }

}

?>