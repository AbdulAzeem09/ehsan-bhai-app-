<?php 
class _postingalbum
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $spf;
		
	function __construct() { 
	    $this->taa = new _tableadapter("spgroup_video"); 
		$this->ta = new _tableadapter("sppostingmedia");
		$this->spf = new _tableadapter("sppostingmedia_folder");
		$this->tas = new _tableadapter("aws_s3_key");
		$this->tass = new _tableadapter("aws_s3");
		
		//$this->ta->join = "INNER JOIN sppostingalbum as d ON t.spPostingAlbum_idspPostingAlbum = d.idspPostingAlbum INNER JOIN spprofiles as p ON t.spProfiles_idspProfiles = p.idspProfiles";
		
		// $this->ta->join = "INNER JOIN sppostingalbum as d ON t.spPostingAlbum_idspPostingAlbum = d.idspPostingAlbum";
		
		// Join changed due to 377 task. As spf_id is passing during insert of file.
		$this->ta->join = "LEFT JOIN sppostingalbum as d ON t.spf_id = d.idspPostingAlbum";
		$this->ta->dbclose = false;
		
	}
	
	//group_video code

	function insertfile($dt)
	{
	$this->taa->create($dt);
	}
	
	function readdatabygid($data)
	{
	 return $this->taa->read("WHERE group_id=".$data."");
	}
	function deletedatabyid($data)
	{
	 return $this->taa->remove("WHERE id=".$data."");
	}
	//group_video_code_end
	
	function checkprofile($uid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles where spUser_idspUser=".$uid.")");
	}
	
	function readawskey(){
		return $this->tas->read();
	}
	
	function readawskeyagain($ids){
		return $this->tass->read("WHERE id=".$ids."");
	}
	
	function checkitem($postid , $albumid)
	{
		return $this->ta->read("WHERE spPostingAlbum_idspPostingAlbum=".$albumid ." AND spPostings_idspPostings=".$postid);
	}
	
	function myplaylist($albumid)
	{
		return $this->ta->read("WHERE spPostingAlbum_idspPostingAlbum=".$albumid);
	}
	
	function groupfile($gid, $spfid){
		return $this->ta->read("WHERE sppostingGroupid=".$gid. " AND t.spf_id = '$spfid' AND spPostingMedia_delete = 0","","t.*");
	}
	function readfolder($folder){
		return $this->spf->read("WHERE spf_id = ".$folder);
	}
	//show trash folder
	function group_trash_file($groupid){
		return $this->spf->read("WHERE sppostingGroupid = '$groupid' AND spf_delete = '1'");
	}
	//show miscellanceous
	function group_misc_file($groupid){
		return $this->ta->read("WHERE sppostingGroupid = '$groupid' AND spPostingMedia_delete = '0' AND spf_misc = 'misc'");
	}
	//show trash files from folder
	function trash_files($folderId){
		return $this->ta->read("WHERE t.spf_id = '$folderId' AND spPostingMedia_delete = 1");
	}
	//SHOW TRASH MISC FILES 
	function misc_trash_files($groupid){
		return $this->ta->read("WHERE t.sppostingGroupid = '$groupid' AND t.spf_misc = 'misc' AND spPostingMedia_delete = 1");
	}
	//restore folder from trash
	function restore_folder($SpfId){
		$this->spf->update(array("spf_delete" => 0), "WHERE spf_id = '$SpfId'");
	}
	//restore files from trash
	function restore_files($restorefile){
		$this->ta->update(array("spPostingMedia_delete" => 0), "WHERE idspPostingMedia = '$restorefile'");
	}
	//GET FOLDER PATH
	function folder_path($spfid){
		return $this->spf->read("WHERE spf_id = '$spfid'");

	}
	function removefolderdel($id){
		return  $this->spf->remove("WHERE spf_id = $id");
			//echo $this->spf->sql;
			//die("mukesh chai8hgsv");

	}
	//read resume for the media id
	function resume($mid){
		return $this->ta->read("WHERE spf_id=".$mid);
	}
	
	
	function readresumes($uid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles where spUser_idspUser=".$uid.")");
	}
	
	function updateresume($data ,$mediatitle,$mediaid)
	{
		$this->ta->update(array("spPostingMedia" =>$data , "sppostingmediaTitle" => $mediatitle) ,"WHERE idspPostingMedia ='".$mediaid."'" );
	}

	function updatemedia($mediatitle,$mediaid)
	{
		$result= $this->ta->update(array("sppostingmediaTitle" => $mediatitle) ,"WHERE idspPostingMedia ='".$mediaid."'" );
		echo $result;
	}
	function update_folder_title($txtGroupId , $txtFolderId, $txtFolderTitle){
		$this->spf->update(array("spf_title" =>$txtFolderTitle) ,"WHERE spf_id ='".$txtFolderId."'" );
	}
	//delete files from folder
	function removemedia($mediaid){
		$this->ta->update(array("spPostingMedia_delete" => 1), "WHERE idspPostingMedia = '".$mediaid."'");
		//$this->ta->remove("WHERE t.idspPostingMedia= " . $mediaid);
	}
	//delete folders
	function allfolder_dell($delfolder){
		$this->spf->update(array("spf_delete" => '1'),"WHERE spf_id = '$delfolder'");

		//$this->ta->remove("WHERE t.spf_id = " . $delfolder);
		//$this->spf->remove("WHERE t.spf_id = " . $delfolder);
	}
	
	function create($postid , $albmid, $mediaTitle, $Ext, $pid,$name){ 	
		$id = $this->ta->create(array("spPostings_idspPostings" => $postid ,"spPostingAlbum_idspPostingAlbum" =>$albmid,"spProfiles_idspProfiles" =>$pid,"sppostingmediaTitle" =>$mediaTitle,"sppostingmediaExt" =>$Ext,"original_name"=>$name));
		return $id;
	}
	
	function addresume($data ,$mediatitle,$pid, $albmid , $ext ,$orext)
	{
		$mediaid = $this->ta->create(array("spPostingMedia" =>$data, "spProfiles_idspProfiles" => $pid,"spPostingAlbum_idspPostingAlbum" =>$albmid , "sppostingmediaTitle" =>$mediatitle ,"sppostingmediaExtension" =>$ext , "sppostingmediaExt"=>$orext));
		return $mediaid;
	}
	
	function addfile($data ,$mediatitle,$pid, $albmid , $ext ,$orext,$groupid, $InsertFolder)
	{
		$mediaid = $this->ta->create(array("spPostingMedia" =>$data, "spProfiles_idspProfiles" => $pid,"spPostingAlbum_idspPostingAlbum" =>$albmid , "sppostingmediaTitle" =>$mediatitle ,"sppostingmediaExtension" =>$ext , "sppostingmediaExt"=>$orext , "sppostingGroupid"=>$groupid, "spf_id" =>$InsertFolder));
		return $mediaid;
	}
	//INSERT MISC FILES IN GROP
	function addmiscfile($data , $mediatitle,$pid , $albmid , $ext , $orext ,$groupid, $InsertMisc){
		$mediaid = $this->ta->create(array("spPostingMedia" =>$data, "spProfiles_idspProfiles" => $pid,"spPostingAlbum_idspPostingAlbum" =>$albmid , "sppostingmediaTitle" =>$mediatitle ,"sppostingmediaExtension" =>$ext , "sppostingmediaExt"=>$orext , "sppostingGroupid"=>$groupid, "spf_misc" =>$InsertMisc));
		return $mediaid;
	}
	function mfolder_create($data)
	{
		return $this->spf->create($data);
		// echo $this->spf->sql;
		// die('mmm');

	}
	//insert values in folder file
	function insert_folder($txtFoldTitle, $pid, $createdate, $groupid, $CreateFolder){
		$mediaid = $this->spf->create(array("spf_title" => $txtFoldTitle, "spProfiles_idspProfiles" => $pid, "spf_date" => $createdate, "sppostingGroupid" => $groupid, "spf_status" => "1", "spf_folder_name" => $CreateFolder));
		return $mediaid;
	}
	//show all folder detail
	function allfolder($groupid){
		return $this->spf->read("WHERE sppostingGroupid = '$groupid' AND spf_delete = 0");
	} 
	function read($postid){
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid);
	}
	//COUNT FOLDER AND FILES
	function countfile($spf_id){
		$result = $this->ta->read("WHERE spf_id = '$spf_id' AND spPostingMedia_delete = 0");
		if($result){
			return mysqli_num_rows($result);
		}else{
			return 0;
		}
	}
	//COUNT MISC FILES IN FOLDER
	function countMiscFile($groupid){
		$result = $this->ta->read("WHERE sppostingGroupid = '$groupid' AND spPostingMedia_delete = 0 AND spf_misc = 'misc'");
		if($result){
			return mysqli_num_rows($result);
		}else{
			return 0;
		}
	}
	//COUNT MISC TRASH FILE IN FOLDER
	function countMiscTrashFile($groupid){
		$result = $this->ta->read("WHERE sppostingGroupid = '$groupid' AND spPostingMedia_delete = 1 AND spf_misc = 'misc'");
		if($result){
			return mysqli_num_rows($result);
		}else{
			return 0;
		}
	}
	//COUNT TRASH FOLDER
	function countTrashFolder($groupid){   
		$result = $this->spf->read("WHERE sppostingGroupid = '$groupid' AND spf_delete = 1");
		if($result){
			return mysqli_num_rows($result);     
		}else{  
			return 0;
		}
	}
	//COUNT TRASH FOLDER AND FILES
	function countTrashFile($groupid, $folder){
		$result = $this->ta->read("WHERE sppostingGroupid = '$groupid' AND spf_id = '$folder' AND spPostingMedia_delete = 1");
		if($result){
			return mysqli_num_rows($result);   
		}else{
			return 0;
		}
	}
	function profileimg($profileid , $data , $albmid)
	{
		return $this->ta->create(array("spProfiles_idspProfiles" => $profileid , "spPostingMedia" =>$data,"spPostingAlbum_idspPostingAlbum" =>$albmid));
	}
	
	function profilepicture($profileid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid);
	}

	
	function profileresume($uid){
		//return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid . " AND sppostingmediaTitle IS NOT NULL");
		return $this->ta->read("WHERE t.spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles where spUser_idspUser=".$uid.") AND sppostingmediaTitle IS NOT NULL AND sppostingGroupid IS NULL");
	}
	//get resume for specfic profiles
	function getProfileResume($pid){ 
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = $pid AND t.spPostingMedia_delete = 0 AND spPostingAlbumDescription = 'Only for Resume' AND sppostingmediaTitle IS NOT NULL AND sppostingGroupid IS NULL");
	}
	
	function picture($profileid )
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid);
	}
	
	
	function readimage($profileid ){
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid." AND sppostingmediaTitle IS NULL AND spPostings_idspPostings IS NULL");
	}
	//READ MUSIC FILES
	function readSong($postid){
		return $this->ta->read("WHERE t.spPostings_idspPostings = '$postid' AND t.sppostingmediaTitle != '' ");
	}

	
}
