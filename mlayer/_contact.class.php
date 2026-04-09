<?php
class _contact
{
	public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	public $ts;

	function __construct()
	{
		$this->ta = new _tableadapter("tbl_contact");
		$this->tad = new _tableadapter("tbl_contact_issue_topic");
		$this->ts = new _tableadapter("tbl_social");
		$this->ta_review = new _tableadapter("freelancer_project_review");
		$this->ta->dbclose = false;
	}


	function read_review_rating($postid)
	{
	  $postid = $this->ta_review->escapeString($postid);
		return  $this->ta_review->read("WHERE t.postid=$postid");
		//echo $this->ta_review->num_rows;  die('sssss');
		//echo $this->ta_review->sql;
		//die("hhhh");
	}

	function read_review_rating_button($postid,$pid)
	{
	  $postid = $this->ta_review->escapeString($postid);
		return  $this->ta_review->read("WHERE t.postid=$postid and t.pid=$pid");
		//echo $this->ta_review->num_rows;  die('sssss');
		//echo $this->ta_review->sql;
		//die("hhhh");
	}
	function create_review($data)
	{
		return $this->ta_review->create($data);
	}

	function create($data)
	{
		$id = $this->ta->create($data);
		return $id;
	}
	

	// ===========TABLE CONTACT ISSUE==============
	function readIsue()
	{
		return $this->tad->read();
	}


	// ===========TABLE SOCIAL==============
	function readSocial()
	{
		return $this->ts->read();
	}
}
