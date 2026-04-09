<?php 
class _store_favorites
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spstorefavorites");
		$this->ta->dbclose = false;
	} 
	
	function addstorefavorites($data)
	{
		$this->ta->create($data);
		
	}

	// READ ALL FAVOURITE POST
	function read($postid){
		return $this->ta->read("WHERE spPostings_idspPostings=" .$postid);
	}
	
	function fav_c($data){
		//die('ss');
			return $this->ta->create($data);
			//echo $this->ta->sql;
			//die('ss');
			
			
		}
		
		
	function fav_d($postid,$uid,$pid)
	{
		return $this->ta->remove("WHERE spPostings_idspPostings=".$postid. " AND spUserid=" .$uid. " AND spProfiles_idspProfiles = ".$pid);
	}

    function removestorefavorites($postid,$uid,$pid)
	{
		// echo  $postid;
		// echo  $uid;
		// echo  $pid;
		// die('vvvvv');
	  return $this->ta->remove("WHERE spPostings_idspPostings=" .$postid. " AND spUserid=" .$uid. " AND spProfiles_idspProfiles = ".$pid);
		// echo $this->ta->sql;die('yyyyyyyyy');
	}

	 // MY FAVOURITE MUSIC
    function myfavourite_store($pid) {

        return $this->ta->read("WHERE spProfiles_idspProfiles=" .$pid);
    }

     /* function myfavourite_store($pid) {

        return $this->ta->read("INNER JOIN spproduct as d ON t.spPostings_idspPostings = d.idspPostings WHERE d.spProfiles_idspProfiles=" .$pid);

       
    }
*/

function chekFavourite($postid, $pid, $uid){
    $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE spPostings_idspPostings= '$postid ' AND spUserid= '$uid' AND spProfiles_idspProfiles = '$pid'");
	}



}
