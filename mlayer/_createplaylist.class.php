<?php 
class _createplaylist
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $ata;
	
	function __construct() { 
		$this->ta = new _tableadapter("createplaylist");
		$this->ata = new _tableadapter("music_album");
		$this->mp = new _tableadapter("music_playlist");
		$this->ta->dbclose = false;
		$this->ata->dbclose = false;
	}
	
	//	CREATE NEW PLAYLIST
	function create($pid, $title, $category){
		$id = $this->ta->create(array("spProfile_idspProfile" => $pid, "list_title" => $title, "spCategory_idspCategory" => $category));
		return $id;
	}

	// CHECK TITLE IS EXIST OR NOT
	function chkExist($pid, $title, $category){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND list_title = '$title' AND spCategory_idspCategory = $category ");
	}
	
	// READ ALL LIST OF MY PROFILE
	function readList($pid, $category){
	//die('======');
	//echo $start.'  '.$limitaa;
		 return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $category   ");
		//echo $this->ta->sql;
		
	}
	function readList11($pid, $category,$start,$limitaa){
		 return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $category LIMIT $start,$limitaa  ");
	}
	function readList12($pid, $category){
		 return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $category ");
	}
	function readList_d($pid, $category){
		 return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $category");
	}
	function addIN_playlist($data){
		return  $this->mp->create($data);
		//echo  $this->mp->sql;
		//die('===');
	}
	function removeFrom_playlist($pid,$vid,$playListId){
		return  $this->mp->remove("where mp_id=$pid AND mav_id=$vid AND playlist_id=$playListId");
		//echo  $this->mp->sql;
		//die('===');
	}
	
	function check_playlist($pid,$vid,$playListId){
		return  $this->mp->read("where mp_id=$pid AND mav_id=$vid AND playlist_id=$playListId");
		//echo  $this->mp->sql;
		//die('===');
	}
	
	// REMOVE FROM MUSIC
	function removemusic($postid, $pid){
		$this->ta->remove("WHERE spPosting_idspPosting = $postid AND spProfile_idspProfile = $pid");
	}
	// UPDATE FROM MUSIC
	function update_list($data, $id){
		$this->ta->update($data, "WHERE list_id = $id");
	}
	
	
	function updatePlaylist($data, $id){
		$this->ta->update($data, "WHERE list_id = $id");
	}
	
	
	// remove single play list
	function removeplaylist($playListId, $pid){
		$this->ta->remove("WHERE list_id = $playListId AND spProfile_idspProfile = $pid");
	}
	// READ LIST NAME
	function readListName($listId){
		return $this->ta->read("WHERE list_id = $listId");
	}

	// READ ALL LIST OF MY PROFILE
	function readAlbum($pid, $category,$start,$limitaa){
		return $this->ata->read("WHERE spProfiles_idspProfiles = $pid AND spUser_idspUser = $category LIMIT $start,$limitaa");		
	}
	function readAlbum11($pid, $category){
		return $this->ata->read("WHERE spProfiles_idspProfiles = $pid AND spUser_idspUser = $category ");		
	}
	function delete_album($id){
		return $this->ata->remove("WHERE ma_id =$id");		
	}
	
	// R

	//	CREATE NEW ALBUM
	function create_album($pid, $title, $category){
		$id = $this->ata->create(array("spProfiles_idspProfiles" => $pid, "album_name" => $title, "spUser_idspUser" => $category));
		return $id;
	}

	// create video album
	function create_video_album($data){
		$id = $this->ata->create($data);
		return $id;
	}
function update_video_album($id, $data){
		$id = $this->ata->update($data, "WHERE ma_id=".$id);
		return $id;
	}

	//	UPDATE ALBUM
	function update_album($data, $id){
		$id = $this->ata->update($data, "WHERE ma_id=".$id);
		return $id;
	}
	
	// CHECK TITLE IS EXIST OR NOT
	function chkExistAlbum($pid, $title){
		return $this->ata->read("WHERE spProfiles_idspProfiles = $pid AND album_name = '$title' ");
	}

	// remove single play list
	function removealbum($playListId, $pid){
		$this->ata->remove("WHERE ma_id = $playListId AND spProfiles_idspProfiles = $pid");
	}

	// total videos in album

	function myAlbumVideos($pid, $uid)
	{
		return  $this->ata->read("where t.spProfiles_idspProfiles = $pid and t.spUser_idspUser = $uid GROUP BY sv.video_albumID ORDER By sum(sv.video_views) DESC"," LIMIT 5","t.*,count(sv.video_albumID) as total_video, sum(sv.video_views) as total_video_views ","INNER JOIN spvideo sv ON sv.video_albumID = t.ma_id ");
		//echo $this->ata->sql;
	}

	function get_album($albumId) {
		return $this->ata->read("where ma_id = $albumId");
	}

}
?>