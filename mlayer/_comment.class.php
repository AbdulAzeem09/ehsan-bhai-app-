<?php

class _comment
{
	public $dbclose = false;
	private $conn;
	public $ta;
	public $jc;

	function __construct()
	{
		$this->ta = new _tableadapter("comment");
		$this->tar = new _tableadapter("comment_reply");
		$this->jc = new _tableadapter("job_comment");
		$this->ta_like = new _tableadapter("splike");
		$this->ta->join = "INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles";
		$this->ta->dbclose = false;
	}

	function job_comments($data)
	{
		$this->jc->create($data);
	}

	function read_comments($postid, $userid)
	{
		return $this->jc->read("WHERE _post_id='" . $postid . "' AND user_id='" . $userid . "'");
		//echo $this->jc->sql;die('----');
	}

	function read_like($postid)
	{
		return $this->ta_like->read("WHERE spPostings_idspPostings=" . $postid);
	}

	function comment($data)
	{
		$this->ta->create($data);
	}

	function commentapi($data)
	{
		return $this->ta->createapi($data);
	}

	function read($postid)
	{
	  	$postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE spPostings_idspPostings=" . $postid);
		// echo $this->ta->sql;die();
	}

	function read_by_id($postid)
	{
	  	$postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.idComment=" . $postid);
		// echo $this->ta->sql;die();
	}

	function reply_res($postid)
	{
		return $this->tar->read("WHERE spPostings_idspPostings=" . $postid);
	}

	function read_a($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings=" . $postid . "  order by spPostings_idspPostings desc limit 1");
	}

	function deletecomment($commentid)
	{
		$this->ta->remove("WHERE t.idComment =" . $commentid);
	}

	function updatecpmment($comment, $commentid)
	{
		return $this->ta->update(array("comment" => $comment), "WHERE idComment='" . $commentid . "'");
	}
}
