<?php 
class _addtomusic
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("addtomusic");
		$this->ta->dbclose = false;
	}
	
	//add to board in art gallery
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	// ADD TO PLAY LIST
	function addtoList($postid, $pid, $listTitle, $category){
		$this->ta->create(array("spProfile_idspProfile" => $pid, "spPosting_idspPosting" => $postid, "playlistTitle" => $listTitle, "spCategory_idspCategory" => $category));
	}
	// add too play list songs
	function addToPlaylist($postid, $pid, $playListId, $catid){
		$this->ta->create(array("spProfile_idspProfile" => $pid, "spPosting_idspPosting" => $postid, "idspPlaylist" => $playListId, "spCategory_idspCategory" => $catid));
	}
	//chek already added or not
	function chkExist($postid, $pid, $category, $title){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND spProfile_idspProfile = $pid AND spCategory_idspCategory = $category AND playlistTitle = $title");
	}
	// CHEK SONG ALREADY ADDED OR NOT
	function chkExistSongs($postid, $pid, $catId, $listId){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND spProfile_idspProfile = $pid AND spCategory_idspCategory = $catId AND idspPlaylist = $listId");
	}
	// READ ALL MY MUSIC
	function readMyMusic($pid, $category){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $category");		
	}
	// REMOVE FROM MUSIC
	function removemusic($songId, $pid){
		$this->ta->remove("WHERE idaddtomusic = $songId AND spProfile_idspProfile = $pid");
	}
	// REMOVE ALL SONGS FROM PLAY LIST
	function removeSongsList($playListId,  $pid){
		$this->ta->remove("WHERE idspPlaylist = $playListId AND spProfile_idspProfile = $pid");
	}

	// my all single playlist
	function readMyPlayList($pid,$catid, $playList){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catid AND playlistTitle = '$playList' ");
	}
	// COUNT TOTAL PLAY LIST IN SPECIAL SONGS
	function countPlayList($listId){
		return $this->ta->read("WHERE idspPlaylist = $listId");
	}
	// READ ALL PLAYLIST SONGS
	function readMyPlayListSong($pid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND idspPlaylist != 0");
	}
	
}
?>