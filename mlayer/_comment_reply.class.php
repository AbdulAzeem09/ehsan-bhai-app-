<?php
class _comment_reply
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 

		$this->ta = new _tableadapter("comment_reply");
		$this->ta->join = "INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles";
		$this->ta->dbclose = false;
	} 
	
	function comment($data){
		$this->ta->create($data);
	}

	function commentapi($data){
		return $this->ta->createapi($data);
		
	}
	
	function read($postid)
	{
		return $this->ta->read("WHERE idComment=" .$postid);
	}
	
	function deletecomment($commentid)
	{
		$this->ta->remove("WHERE t.id =" .$commentid);
	}
	
	function updatecpmment($comment, $commentid)
	{
		return $this->ta->update(array("replycomment" => $comment), "WHERE id='".$commentid."'");
	}

}
?>