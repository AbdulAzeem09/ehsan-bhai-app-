<?php 
class _eventpic
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("speventpics");
		$this->tasg = new _tableadapter("spevent");
		$this->tatra = new _tableadapter("spevent_transection");
		$this->tagg = new _tableadapter("speventgallery");
		$this->tas = new _tableadapter("aws_s3_key");
		$this->tass = new _tableadapter("aws_s3");
		$this->ta->dbclose = false;
	}
	
	function remove_event_layout($data,$postid){
		$this->tasg->update($data, "WHERE idspPostings ='" . $postid . "'");
	}
	function read($postid){
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
	}
	
	function readGallery($postid){
		return $this->tagg->read("WHERE t.post_id = '$postid'");
	}
	function readlayout($postid){
		return $this->tasg->read("WHERE t.idspPostings = '$postid'");
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
	function removePostPiclayout($postid){
		$this->tasg->remove("WHERE t.idspPostings = $postid");
	}

	
	
	function create($postid , $data){
		 $this->ta->create(array("spPostings_idspPostings" => $postid , "spPostingPic" =>$data));
	}
	//create a pic for event
	function createPic($postid , $data, $fimg){
		 $this->ta->create(array("spPostings_idspPostings" => $postid , "spPostingPic" =>$data, "spFeatureimg" => $fimg));
	}
	//create a pic layout for event
	function createPiclayout($postid , $data){
		$this->tasg->update(array("spPostingPic" => $data), "WHERE idspPostings ='" . $postid . "'");
	}

	function create1($data){
		$this->tatra->create($data);
		//echo $this->tatra->sql;
		//die("++");
   }
	
	function remove($pospic){
		//echo $pospic; die('-----------------');
		$this->ta->remove("WHERE t.idspPostingPic = " . $pospic);
	}

	function remove_galley($pospic){
		//echo $pospic; die('-----------------');
		$this->tagg->remove("WHERE t.id = " . $pospic);
	}

	
	function remove_pics($pospic){
		//echo $pospic; die('-----------------');
		$this->ta->remove("WHERE t.idspPostingPic = " . $pospic);
	}
	function removeGallery($pospic){
		//echo $pospic; die('-----------------');
		$this->tagg->remove("WHERE t.image_name = '$pospic'");
	}
	//read feature image
	function readFeature($postid){
		$result = $this->ta->read("WHERE t.spFeatureimg = 1 AND t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		if($result != false){
			return $this->ta->read("WHERE t.spFeatureimg = 1 AND t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		}else{
			return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		}

	}


	function eventid($postid)
	{
		return $this->tasg->read("WHERE t.idspPostings = '$postid'");
		//echo $this->tasg->sql;
		//die("+++");
	}
	//update feature pic
	function updatePic($picid, $postid){
		$this->ta->update(array("spFeatureimg" => 0), "WHERE spPostings_idspPostings ='" . $postid . "'");
		return $this->ta->update(array("spFeatureimg" => 1), "WHERE idspPostingPic ='" . $picid . "'");
	}
	
	function getOrganizerName($name)
	{
		$name=explode(',',$name);
		
		if(count($name)==1)
		{
			return $name[0];
		}
		else
		{
			return $name;
		}
	}
}
