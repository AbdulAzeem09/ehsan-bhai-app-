<?php
class _savepost{
 
    public $dbclose = false;
    private $conn;
    public $ta;
    public $taa;
    public $tas;
 
    function __construct() { 
        $this->ta = new _tableadapter("spsavepost");
        $this->ta->dbclose = false;
        $this->taa = new _tableadapter("spjobboard");
        $this->tas = new _tableadapter("jobboard_save");
        
    } 

    function create($postid, $pid, $uid) {
        $saveid = $this->ta->create(array("spPostings_idspPostings" => $postid, "spProfiles_idspProfiles" => $pid, "spUserid" => $uid));
       return $saveid;
		//echo $this->ta->sql;die('2222');
    }
    function savepost($postid, $pid, $uid){
        $postid = $this->ta->escapeString($postid);
        return $this->ta->read("WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $pid AND spUserid = $uid");
		
		//echo $this->ta->sql;
    }
    function remove($postid, $pid, $uid){
        $this->ta->remove("WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $pid AND spUserid = $uid");
    }
    function removpost($postid, $pid, $uid){
         return $this->ta->remove("WHERE spPostings_idspPostings = ".$postid." AND spProfiles_idspProfiles = ".$pid." AND spUserid = ".$uid);
        //echo $this->ta->sql;die('1111111');
    }

    function mySaveJob_new($category, $uid, $offset = 0, $limit = 10, $searchKeyword = ''){
        return $this->tas->read("WHERE t.spPostings_idspPostings =" . $uid . "  AND t.save_status = 1");
		 
    }
	
	function buildSearchCondition($searchKeyword) {
    $searchCondition = '';
    
    if (!empty($searchKeyword)) {
        $searchKeyword = $this->tas->escapeString($searchKeyword);
        $searchCondition = " AND (spPostingTitle LIKE '%$searchKeyword%' OR spPostingNotes LIKE '%$searchKeyword%')";
    }
    
    return $searchCondition;
}

    function readalldata($postid)

    {
        return $this->taa->read("where t.idspPostings ='$postid' "); 

    }
	 public function get_draft_count($uid) {
        $query = "WHERE spPostings_idspPostings='$uid'";
        $result = $this->tas->read($query);
        return $result ? $result->num_rows : 0;
    }
}

?>
