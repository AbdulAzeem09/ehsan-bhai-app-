
<?php 
class _job_favorites
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spjobfavorites");
				$this->user = new _tableadapter("spprofiles");

		$this->ta->dbclose = false;
	} 
	
	function addjobfavorites($data)
	{
		return $this->ta->create($data);
	}



	function get_username($postid){
	return	 $this->user->read("WHERE idspProfiles=" .$postid);
	}


	// READ ALL FAVOURITE POST
	function read($postid){
		return $this->ta->read("WHERE spPostings_idspPostings=" .$postid);
	}

    function removejobfavorites($postid,$uid,$pid)
	{
		return $this->ta->remove("WHERE spPostings_idspPostings=" .$postid. " AND spUserid=" .$uid. " AND spProfiles_idspProfiles = ".$pid);
	}

	 // MY FAVOURITE MUSIC
    function myfavourite_job($pid,$name) {

        return $this->ta->read("WHERE t.seeker_name  like ('%" . $name . "%') AND spProfiles_idspProfiles=" .$pid);
    }
	function myfavourite_job1($pid) {

        return $this->ta->read("WHERE spProfiles_idspProfiles=" .$pid);
		//echo $this->ta->sql;die('--');
    }

    /* function myfavourite_store($pid) {

        return $this->ta->read("INNER JOIN spproduct as d ON t.spPostings_idspPostings = d.idspPostings WHERE d.spProfiles_idspProfiles=" .$pid);       
    }
	*/

	function chekFavourite($postid, $pid, $uid){
		return $this->ta->read("WHERE spPostings_idspPostings= '$postid ' AND spUserid= '$uid' AND spProfiles_idspProfiles = '$pid'");
	}



}

?>
