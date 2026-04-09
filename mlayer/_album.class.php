<?php 
class _album
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $da;
	public $ba;
	
	function __construct() { 
		$this->ta = new _tableadapter("sppostingalbum");
		$this->da = new _tableadapter("a_demo");
		$this->ba = new _tableadapter("b_demo1");
		$this->ta->join = "INNER JOIN spprofiles as d ON t.spProfiles_idspProfiles = d.idspProfiles";
		$this->ta->dbclose = false;
	}
	
	function b_insert($n){
		$this->ba->create($n);
		// echo $this->ba->sql;
		// die("=======");
	}

	function data_read(){
		return	$this->ba->read();
	}

	function read_data2($id){
		return $this->da->read("where id =$id");
	}

	function email_validation($email){
		return $this->da->read("where email ='$email'");
		
	}

	function update_data($id ,$data){
		return $this->da->update($data,"where id=$id");
	}

	function delete_data1($id){
		$this->ba->remove("where id=$id");

	}

	function a_insert($d){
		return $this->da->create($d);
		//echo $this->da->sql;
		//die("====");
	}

	function read_data(){
		return $this->da->read();
	}

	function delete_data($id){
		$this->da->remove("where id=$id");
	}

	// read album by profile id
	function readMyalbum($pid, $catid){
		return $this->ta->read("where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where idspProfiles=".$pid.") AND sppostingalbumFlag = $catid");
	}

	function readalbum($pid)
	{
		$result = $this->ta->read("WHERE t.spProfiles_idspProfiles = $pid");
		return $result;
	}
	
	function readimagealmb($pid)
	{
		return  $this->ta->read("where spProfiles_idspProfiles = " . $pid . " AND spPostingAlbumName ='Profine Image'");
		echo $this->ta->sql;
	}
	
	function myalbum($uid)
	{
		return $this->ta->read("where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where spUser_idspUser=".$uid.") AND sppostingalbumFlag NOT IN (13,6,8,0)");
	}
	
	//Resume Album create
	function resumealbum($pid){
		$id = $this->ta->create(array("spPostingAlbumName" => "Resume", "spPostingAlbumDescription" => "Only for Resume","spProfiles_idspProfiles" => $pid));
		return $id;
	}
	
	//Resume album read
	function readresume($pid){
		return $this->ta->read("where spProfiles_idspProfiles = " . $pid . " AND spPostingAlbumName ='Resume'");
	}
	
	function create($data)
	{
		$id = $this->ta->create($data);
		return $id;
	}
	
	function read($uid)
	{
		return $this->ta->read("where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where spUser_idspUser=".$uid.") AND sppostingalbumFlag = 1");
	}
	
	function video($uid)
	{
		return $this->ta->read("where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where spUser_idspUser=".$uid.") AND sppostingalbumFlag = 10");
	}

	// read album by user id
	function music($uid)
	{
		return $this->ta->read("where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where spUser_idspUser=".$uid.") AND sppostingalbumFlag = 14");
	}
	
	
	function document($uid)
	{
		return $this->ta->read("where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where spUser_idspUser=".$uid.") AND sppostingalbumFlag = 6");
	}
	
	function training($uid)
	{
		return $this->ta->read("where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where spUser_idspUser=".$uid.") AND sppostingalbumFlag = 8");
	}
	
	
	function photos($uid)
	{
		return $this->ta->read("where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where spUser_idspUser=".$uid.") AND sppostingalbumFlag = 13");
	}
	
	function readdetails($albumid)
	
	{
		return $this->ta->read("where t.idspPostingAlbum = " . $albumid );
	}
	
	function update($albumid, $data){
		$this->ta->update($albumid, $data);
	}
	
	// update album
	function updateAlbum($albumName,$albumid, $ispublic){
		//$this->ta->update($albumName, $albumid);
		$this->ta->update(array("spPostingAlbumName" => $albumName, "spPostingPublic" => $ispublic), "WHERE idspPostingAlbum = $albumid ");
	}
	
	function removeAlbum($albumid){
		$this->ta->remove("WHERE t.idspPostingAlbum= " . $albumid);
	}
	
	function timelinealbum($pid)
	{
		$id = $this->ta->create(array("spPostingAlbumName" => "Timeline", "spPostingAlbumDescription" => "Only for Timeline","spProfiles_idspProfiles" => $pid));
		return $id;
	}
	
	
	function profilealbum($pid)
	{
		$id = $this->ta->create(array("spPostingAlbumName" => "Profine Image", "spPostingAlbumDescription" => "Only for Profile Images", "spProfiles_idspProfiles" => $pid));
		return $id;
	}
}
?>