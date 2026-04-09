<?php 
class _direcctory_gallery
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("direcctory_gallery");
		$this->ta->dbclose = false;
		
	}
	
	// INSERT VALUES OF BUSINESS GALLERY IN DB
	function create($galleryImg, $pid){
		$id = $this->ta->create(array("gallery_img" =>$galleryImg, "spProfiles_idspProfiles" =>$pid));
		return $id;
	}
	// BUSINESS-GALLERY VIEW IN DIRECTORY
	function mygallery($pid){
		return $this->ta->read("WHERE spProfiles_idspProfiles = $pid ");
	}
	// BUSINESS-GALLERY REMOVE
	function removeGallery($glrId){
		$this->ta->remove("WHERE gallery_id = $glrId");
	}
	// READ GALLERRY BY GALLERY ID
	function reaadGallery($glrId){
		return $this->ta->read("WHERE gallery_id = $glrId");
	}

}
?>