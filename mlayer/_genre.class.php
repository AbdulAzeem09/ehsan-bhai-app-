<?php 
class _genre
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("sp_genre");
		$this->ta->dbclose = false;
	} 
	
	function create($data)
	{
		$this->ta->create($data);
	}
	
	function read()
	{
		return $this->ta->read();
	}
	
	function remove($genre_id)
	{
		$this->ta->remove("WHERE t.genre_id =" .$genre_id);
	}
	//read master detail name
	function readGenreName($genre_id){
		return $this->ta->read("WHERE t.genre_id = $genre_id");
	}
	/*
	function create($data){
		return $this->ta->create($data);
	}
	
	function read($gid)
	{
		return $this->ta->read("WHERE spGroup_idspGroup =".$gid);
	}
	
	function approve($mid)
	{
		return $this->ta->update(array("spGroupMessageFlag" => 0), "WHERE idspGroupMessage ='".$mid."'");
	}*/
	
	function update($data,$where){
		return $this->ta->update($data,$where);
	}
	
}
?>