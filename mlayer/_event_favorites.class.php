<?php 
class _event_favorites
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("speventfavorites");
		$this->ta_v = new _tableadapter("spfavorites");
				$this->fa_v = new _tableadapter("spfreelancerfavorites");

		$this->ta->dbclose = false;
	} 
	
	function addeventfavoritestimeline($data)
	{
		$this->ta_v->create($data);
	}
	function removeeventfavorites_del($postid,$uid,$pid)
	{
		return $this->ta_v->remove("WHERE spPostings_idspPostings=" .$postid. " AND spUserid=" .$uid. " AND spProfiles_idspProfiles = ".$pid);
		
	}
	function addeventfavoritesdetail($data)  
	{
		$this->ta->create($data);  
	}
	function removeeventfavoritesdetail_del($postid,$uid,$pid)
	{
		return $this->ta->remove("WHERE spPostings_idspPostings=" .$postid. " AND spUserid=" .$uid. " AND spProfiles_idspProfiles = ".$pid);
		
	}
	function addeventfavoritesfreelancer($data)  
	{
		$this->fa_v->create($data);  
	}
	function removeeventfavoritesfreelancer_del($postid,$uid,$pid)
	{
		return $this->fa_v->remove("WHERE spPostings_idspPostings=" .$postid. " AND spUserid=" .$uid. " AND spProfiles_idspProfiles = ".$pid);
		
	}
	
	
	function addeventfavorites($data)
	{
		$this->ta->create($data);
	}
	

	// READ ALL FAVOURITE POST
	function read($postid){
		return $this->ta->read("WHERE spPostings_idspPostings=" .$postid);
	}

    function removeeventfavorites($postid,$uid,$pid)
	{
		return $this->ta->remove("WHERE spPostings_idspPostings=" .$postid. " AND spUserid=" .$uid. " AND spProfiles_idspProfiles = ".$pid);
		
	}

	 // MY FAVOURITE MUSIC
    function myfavourite_event($pid) {

        return $this->ta->read("WHERE spProfiles_idspProfiles=" .$pid);
    }

function chekFavourite($postid, $pid, $uid){
		return $this->ta->read("WHERE spPostings_idspPostings= '$postid ' AND spUserid= '$uid' AND spProfiles_idspProfiles = '$pid'");
	}

}
