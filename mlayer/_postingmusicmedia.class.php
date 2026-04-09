<?php 
class _postingmusicmedia
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("sppostingmusicmedia");
		$this->ta->dbclose = false;
		
	}
	
	// INSERT VALUES OF MUSIC IN DB
	function create($mediaTitle, $Ext, $pid, $orgmediaTitle){
		$id = $this->ta->create(array("spProfile_idspProfile" =>$pid,"musicmediaTitle" =>$mediaTitle,"musicmediaExt" =>$Ext,"musicmediaOrgName" =>$orgmediaTitle));
		return $id;
	}

	// INSERT VALUES OF TRAINING IN DB
	function createTrain($mediaTitle, $Ext, $pid, $orgmediaTitle, $catid){
		$id = $this->ta->create(array("spProfile_idspProfile" =>$pid,"musicmediaTitle" =>$mediaTitle,"musicmediaExt" =>$Ext,"musicmediaOrgName" =>$orgmediaTitle ,"spCategory_idspCategory" =>$catid));
		return $id;
	}
	// CREATE PREVIEW TRAINING VIDEO
	function createPreview($mediaTitle, $Ext, $pid, $orgmediaTitle, $catid, $preview){
		$id = $this->ta->create(array("spProfile_idspProfile" =>$pid,"musicmediaTitle" =>$mediaTitle,"musicmediaExt" =>$Ext,"musicmediaOrgName" =>$orgmediaTitle ,"spCategory_idspCategory" =>$catid,"musicmediaFeature" => $preview ));
		return $id;
	}
	// CHECK PREVIEW VIDEO HA YA NI
	function chekPreview($pid, $catid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catid AND spPosting_idspPosting = 0 AND musicmediaFeature = 1 ");
	}
	// UPDATE PREVIEW VIDEO 
	function updatePreview($mediaTitle, $Ext, $pid, $orgmediaTitle, $catid, $preview){
		return $this->ta->update(array("musicmediaTitle" => $mediaTitle ,"musicmediaExt" =>$Ext,"musicmediaOrgName" =>$orgmediaTitle), "WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catid AND musicmediaFeature = 1");
	}

	// read the music path
	function readMusic($musicId){
		return $this->ta->read("WHERE idspmusicmedia = $musicId");
	}
	// UPDATE MUSIC IN POST ID WHICH IS ADDED
	function update($postid, $musicId){
		return $this->ta->update(array("spPosting_idspPosting" => $postid), "WHERE idspmusicmedia = $musicId");
	}
	// READ POSTING MEDIA MUSIC FROM HOME
	function readPostMusic($postid){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid");
	}

	// READ POSTING MEDIA MUSIC featured FROM HOME
	function readPostMusicFeat($postid){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND musicmediaFeature = 1");
	}
	
	
	// UPDATE TRAINING IN POST ID WHICH IS ADDED
	function updatevdo($postid, $pid){
		return $this->ta->update(array("spPosting_idspPosting" => $postid), "WHERE spProfile_idspProfile = $pid AND spPosting_idspPosting = 0 AND spCategory_idspCategory = 8");
	}
	// UPDATE FEATURED VIDEO 
	function updateFeature($featvdo){
		$this->ta->update(array("musicmediaFeature" => 1), "WHERE idspmusicmedia = $featvdo" );
	}
	// COUNT TOTAL PDF OR XL FILES
	function readPostMusicFile($postid){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND musicmediaExt != 'mp4' ");
	}
	function readPostMusicMedia($postid){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND musicmediaExt = 'mp4' ");	
	}

}
?>