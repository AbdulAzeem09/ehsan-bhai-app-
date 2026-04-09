<?php 
class _grouppostingpic
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("sppostingpics");
		$this->tapic = new _tableadapter("spproductpics");
		$this->tareal = new _tableadapter("sprealstatepics");
		$this->tars = new _tableadapter("sprealstatepics");
		$this->tacpic = new _tableadapter("spclassifiedpics");
		$this->cover = new _tableadapter("sptraining_cover_images");
		$this->taepic = new _tableadapter("speventpics");
		$this->taartpic = new _tableadapter("sppostingpicsartcraft");
		$this->tas = new _tableadapter("aws_s3_key");
		$this->tass = new _tableadapter("aws_s3");
		$this->ta->dbclose = false;
	}
	
	
	function read($postid){
		  return  $this->tapic->read("WHERE spPostings_idspPostings = ".$postid ,"ORDER BY spPostings_idspPostings ASC ");
		 echo $this->tapic->sql;
		die('fffffffffffff');
	}


		function read_timeline($postid){
		  return  $this->ta->read("WHERE spPostings_idspPostings = ".$postid ,"ORDER BY spPostings_idspPostings ASC ");
		 //echo $this->tapic->sql;
		//die('fffffffffffff');
	}


	function readpicall($postid){
		return $this->tacpic->read("WHERE t.spPostings_idspPostings = " . $postid ." AND t.spFeatureimg = 1"," ORDER BY spPostings_idspPostings ASC"); 
		 //echo $this->tacpic->sql;
		// die("mmm");
	}
	function read_cover_images($id)
    {
        return $this->cover->read("WHERE postid=$id");
    }
	function readFeatureeventpic($postid){
		$result = $this->taepic->read("WHERE t.spFeatureimg = 1 AND t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		if($result != false){
			return $this->taepic->read("WHERE t.spFeatureimg = 1 AND t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		}else{
			return $this->taepic->read("WHERE t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		}

	}


	function readartpic($postid){
		return $this->taartpic->read("WHERE t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
	// echo $this->taartpic->sql;
	// die();
	} 




	function readpic($postid){
		return $this->ta->read("WHERE idspPostings = $postid ORDER BY spPostings_idspPostings ASC");
	} 
	
	function readawskey(){
		return $this->tas->read();
//echo  $this->tas->sql;
//die("-------");
	}
	
	function readawskeyagain($ids){
		return $this->tass->read("WHERE id=".$ids."");

		//echo  $this->tass->sql;

		//die("################");
	}
	
	function removePostPic($postid){
		$this->ta->remove("WHERE t.spPostings_idspPostings = $postid");
	}

	
	
	function create($postid , $data){
		 $this->ta->create(array("spPostings_idspPostings" => $postid , "spPostingPic" =>$data));
	}

		function readimage($profileid ){
		return $this->ta->read("INNER JOIN spPostings AS g ON g.idspPostings = t.spPostings_idspPostings WHERE g.spProfiles_idspProfiles = " . $profileid." ");
	}
	
	function readimagelimit($profileid ){
		return $this->ta->read("INNER JOIN spPostings AS g ON g.idspPostings = t.spPostings_idspPostings WHERE g.spProfiles_idspProfiles = " . $profileid." LIMIT 16 ");
	}
	
	function readmoreimage($profileid, $row,$rowperpage){
		return $this->ta->read("INNER JOIN spPostings AS g ON g.idspPostings = t.spPostings_idspPostings WHERE g.spProfiles_idspProfiles = " . $profileid." LIMIT $row,$rowperpage ");
	}
	//create a pic for event
	function createPic($postid , $data, $fimg){
		 $this->ta->create(array("spPostings_idspPostings" => $postid , "spPostingPic" =>$data, "spFeatureimg" => $fimg));
	}
	function remove($pospic){
		$this->ta->remove("WHERE t.idspPostingPic = " . $pospic);  
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
	function readrealpic($postid){
		$result = $this->tareal->read("WHERE t.spFeatureimg = 1 AND t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		if($result != false){
			return $this->tareal->read("WHERE t.spFeatureimg = 1 AND t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		}else{
			return $this->tareal->read("WHERE t.spPostings_idspPostings = " . $postid ," ORDER BY spPostings_idspPostings ASC");
		}

	}


	//update feature pic
	function updatePic($picid, $postid){
		$this->tars->update(array("spFeatureimg" => 0), "WHERE spPostings_idspPostings ='" . $postid . "'");
		return $this->tars->update(array("spFeatureimg" => 1), "WHERE idspPostingPic ='" . $picid . "'");
	}
}
?>