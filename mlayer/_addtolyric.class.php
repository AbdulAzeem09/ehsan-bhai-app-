<?php 
class _addtolyric
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("music_lyrics");
		$this->ta->dbclose = false;
	}
	
	
	function create($data)
	{
		$this->ta->create($data);
	}
	// my all lyrics
	function readMyLyric($pid, $category){
		return $this->ta->read("WHERE spProfiles_idspProfiles = $pid");
	}
	//update lyrics aprove
	function updateLyric($lyrivid, $aprove){
		$this->ta->update(array("lyric_flag_approve" => $aprove), "WHERE ml_id = '$lyrivid'");
	}
	// read lyric chek is active or not
	function chekLyric($postid, $title){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND lyrics = $title");
	}
	
}
?>