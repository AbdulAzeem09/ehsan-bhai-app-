<?php 
class _exhibition
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("sppostingexhibition");
		$this->ta->dbclose = false;
	}
	
	
	//read all exhibition
	function readAll(){
		return $this->ta->read("WHERE t.spStartDate >= CURDATE()");
	}
	//Exhibition create
	function create($spExhibitionTitle,$image_base64, $spStartDate, $spEndDate, $spExhibitionVenu, $spExhibitionDesc, $spProfile_idspProfile){
		$id = $this->ta->create(array("spExhibitionTitle" => $spExhibitionTitle, "spExhibitionimg" => $image_base64,"spExhibitionDesc" => $spExhibitionDesc, "spStartDate"=>$spStartDate, "spEndDate"=>$spEndDate, "spExhibitionVenu"=>$spExhibitionVenu, "spProfile_idspProfile"=>$spProfile_idspProfile));
		return $id;
	}
	//read upcomming event
	function readUpcoming(){
		return $this->ta->read("WHERE t.spStartDate >= CURDATE()");
	}
	//read recent event
	function readRecent(){
		return $this->ta->read("WHERE t.spStartDate = CURDATE()");
	}
	//read previous event
	function readPrevious(){
		return $this->ta->read("WHERE t.spStartDate < CURDATE()");
	}
	//read exehibition name
	function readName($exe){
		return $this->ta->read("WHERE t.idspexhibition = $exe");
	}
	
}
?>