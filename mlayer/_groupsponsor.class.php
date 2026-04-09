<?php 
class _groupsponsor
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("groupsponsor");
		$this->text = new _tableadapter("group_announcement");
		$this->inters = new _tableadapter("spgroup_intrest");
		$this->ta->dbclose = false;
	}
	
	function read(){
		return $this->ta->read();
	}
	
	function removeINT($user,$pro) {
		return $this->inters->remove("WHERE user_id = $user AND profile_id = $pro");
    }

	function get_id($pid){
		return $this->inters->read("WHERE profile_id = $pid");
		
	}
	
	function readInterest($user,$pro){
		return $this->inters->read("WHERE user_id = $user AND profile_id = $pro");
	}
	
	function createInt($postid){
		 $this->inters->create($postid);
	}
	
	function create22($postid){
		 $this->text->create($postid);
	}
	
	function readPost22($postid){
		return $this->text->read("WHERE group_id = " . $postid);
	}
	 
	function remove22($postid) {
        $this->text->remove("WHERE id = " . $postid);
    }
		
	function readPost($postid){
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid);
	}

	//this is old version of create sponsor
	function create($postid , $data, $title, $web){
		 $this->ta->create(array("spPostings_idspPostings" => $postid , "sponsorImg" =>$data, "sponsorTitle" =>$title, "sponsorWebsite" =>$web));
	}
	//create post field 
	function createsp($data){
		$id = $this->ta->create($data);
		return $id;
	}
	//update pic
	function updatepic($sponId, $data) {
        $this->ta->update(array("sponsorImg" => $data), "WHERE idspSponsor ='" . $sponId . "'");
    }
    //read all sponsor about my pid
    function readAll($pid){
    	return $this->ta->read("WHERE spProfile_idspProfile = $pid");
    }

      function readAllsponsor($gid){
    	return $this->ta->read("WHERE spgroupid = $gid");
    }

    function readSponsor($spid){
    	return $this->ta->read("WHERE idspSponsor = $spid");
    }
    
    //update post
    function updateSponsor($sponid, $data){
		$this->ta->update($sponid, $data);
	}

	 function remove($postid) {
        $this->ta->remove("WHERE idspSponsor = " . $postid);
    }
}
?>