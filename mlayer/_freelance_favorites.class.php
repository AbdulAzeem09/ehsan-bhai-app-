<?php 
class _freelance_favorites
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
	$this->ta = new _tableadapter("spfreelancerfavorites");
	$this->tb = new _tableadapter("realstate_favorites");
		$this->ta->dbclose = false;
	} 
	
	function addfavorites($data)
	{
		$this->ta->create($data);
	}
	function addfavorites_realstate($data)
	{
		$this->tb->create($data);
	}
	

    function chekFavourite($postid, $pid, $uid){
		return $this->ta->read("WHERE spPostings_idspPostings= '$postid ' AND spUserid= '$uid' AND spProfiles_idspProfiles = '$pid'");
	}
	function read_favourite_project($pid){
		return $this->ta->read("WHERE spProfiles_idspProfiles = $pid");
		 //echo $this->ta->sql;
		// die('==');
	}
	
	// READ ALL FAVOURITE POST
	function read($postid){
		return $this->ta->read("WHERE spPostings_idspPostings=" .$postid);
	}
	
	function reads($pid){
		return $this->ta->read("WHERE  spProfiles_idspProfiles = ".$pid);
		//echo $this->ta->sql;
	}

	function myfavourite($pid){
		return $this->ta->read("WHERE spProfiles_idspProfiles=" .$pid);
	}

    function removefavorites1($postid,$uid)
	{
		return $this->ta->remove("WHERE spPostings_idspPostings=" .$postid. " AND spUserid=" .$uid);
		
	}
function removefavorites_realstate($postid,$uid)
	{
		return $this->tb->remove("WHERE spPostings_idspPostings=" .$postid. " AND spUserid=" .$uid);
	}

}
