<?php 
class _speventrating
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	
	function __construct() { 
		$this->ta = new _tableadapter("speventrating");
		$this->ta->dbclose = false;
	}
	
	function create($post,$profile,$rate)
	{
		 $this->ta->create(array("spPostings_idspPostings" => $post, "spProfiles_idspProfiles" => $profile,"spPostRating" =>$rate));
	}
	
	
	function read($pid,$postid){
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $pid ." AND spPostings_idspPostings =".$postid);
	}
	
	function review($postid){
		return $this->ta->read("WHERE spPostings_idspPostings =".$postid);
	}
	
	
	function updaterate($postid,$pid,$rate)
	{
		return $this->ta->update(array("spPostRating" => $rate), "WHERE spPostings_idspPostings =".$postid." AND spProfiles_idspProfiles = ".$pid);
	}
}
?>