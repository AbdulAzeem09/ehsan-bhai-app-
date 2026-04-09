<?php 
class _followmusic
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("follow_music");
		$this->fl = new _tableadapter("spnews_follow");
		$this->ta->dbclose = false;
	}
	
	//	ADD TO FOLLOWING
	function addtofollow($pid, $follower, $catid){
		$this->ta->create(array("spProfile_idspProfile" => $pid, "spCategory_idspCategory" => $catid, "spFollowr_idspProfile" => $follower));
	}
	
	function follow($data){
		$this->fl->create($data);
	}
	// READ FOLOW KIA HA K NI
	function readFolow($pid, $follower){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spFollowr_idspProfile = $follower");
	}
	
	function readFoloww($whom, $who){
		return $this->fl->read("WHERE whom = $whom AND who = $who");
	}
	// UNFOLLOW THE ARTIST
	function unfollow($pid, $follower, $catid){
		$this->ta->remove("WHERE spProfile_idspProfile = $pid AND spFollowr_idspProfile = $follower AND spCategory_idspCategory = $catid ");
	}
	
		function unfolloww($whom, $who){
		$this->fl->remove("WHERE whom = $whom AND who = $who ");
	}
	
	// READ MY ALL FOLLOWERS
	function readMyFollower($pid, $catid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catid");
	}
	
}
?>