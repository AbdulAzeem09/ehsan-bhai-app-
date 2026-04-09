<?php
class _sponsorpic
{
    public $dbclose = false;
	private $conn;
	public $ta;

	function __construct() {
		$this->ta = new _tableadapter("sponsor");
		$this->tas = new _tableadapter("aws_s3_key");
		$this->tass = new _tableadapter("aws_s3");
		$this->ta->dbclose = false;
	}

	function read_comp($id){
		return $this->ta->read("WHERE t.spProfile_idspProfile = " . $id);
		// echo $this->ta->sql; echo "=====>";
	}	
	

	function readPost($postid){
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid);
	}	
	
	function readawskey(){
		return $this->tas->read();
	}
	function check_data($company){
		 return $this->ta->read("WHERE t.sponsorTitle = '" .$company."'");
		
	}
	
	function readawskeyagain($ids){
		return $this->tass->read("WHERE id=".$ids."");
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
	//echo $this->ta->sql; die("-------");
    }
    //read all sponsor about my pid
    function readAll($pid){
    	return $this->ta->read("WHERE spProfile_idspProfile = $pid");
    }
    function read(){
      return $this->ta->read();
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
	
	function readExists()
	{
		return $this->ta->read("ORDER BY idspSponsor DESC LIMIT 1");
	}
}
?>
