<?php 
class _addtolyric
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spPostinglyrics");
		$this->ta->dbclose = false;
	}
	
	
	function create($data)
	{
		$this->ta->create($data);
	}
	// my all lyrics
	function readMyLyric($pid, $category){
		return $this->ta->read("WHERE spPost_idspProfile = $pid AND lyric_flag = 0 AND spCategory_idspCategory = $category");
	}
	//update lyrics aprove
	function updateLyric($lyrivid, $aprove){
		$this->ta->update(array("lyric_flag" => $aprove), "WHERE idspLyrics = '$lyrivid'");
	}
	// read lyric chek is active or not
	function chekLyric($postid){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND lyric_flag = 1");
	}
	
}
?>