<?php 
class _realstatepic
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		
		$this->ta = new _tableadapter("sprealstatepics");

		$this->sp = new _tableadapter("sprealstate");
		$this->tas = new _tableadapter("aws_s3_key");
		$this->tass = new _tableadapter("aws_s3");
		$this->ta->dbclose = false;
	}
	
	
	function read($postid){
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
	}	
	
	function readawskey(){
		return $this->tas->read();
	}
	
	function readawskeyagain($ids){
		return $this->tass->read("WHERE id=".$ids."");
	}
	
	function removePostPic($postid){
		$this->ta->remove("WHERE t.spPostings_idspPostings = $postid");
	}
	
	function create($postid , $data){
		 $this->ta->create(array("spPostings_idspPostings" => $postid , "spPostingPic" =>$data));
	}
	
	
	//create a pic for event
	function createPic($postid , $data, $fimg){
		 $this->ta->create(array("spPostings_idspPostings" => $postid , "spPostingPic" =>$data, "spFeatureimg" => $fimg));
		  //echo $this->ta->sql; die("------");
		 
	}
	function remove($pospic){
		$this->ta->remove("WHERE t.idspPostingPic = " . $pospic);
	}
	//read feature image
	function readFeature($postid){
	  $postid = $this->ta->escapeString($postid);
		$result = $this->ta->read("WHERE t.spFeatureimg = 1 AND t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		if($result != false){
			return $this->ta->read("WHERE t.spFeatureimg = 1 AND t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		}else{
			return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		}

	}
	//update feature pic
	function updatePic($picid, $postid){
		$this->ta->update(array("spFeatureimg" => 0), "WHERE spPostings_idspPostings ='" . $postid . "'");
		return $this->ta->update(array("spFeatureimg" => 1), "WHERE idspPostingPic ='" . $picid . "'");
	}

	function update_img($data, $postid){
		$this->sp->update($data, "WHERE idspPostings= $postid ");
		 //echo $this->sp->sql; die("------");
		
	}
}
?>
