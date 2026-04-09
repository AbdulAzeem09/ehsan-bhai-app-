<?php
class _freelance_project_status
{
	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{
		$this->ta = new _tableadapter("spfreelancerfavorites");
		$this->tad = new _tableadapter("spfreelancer_fav");
		$this->spf = new _tableadapter("spfreelancer");
		$this->ta->dbclose = false;


		
	}

    function deletefavourite($postid)
	{
		return $this->ta->remove("WHERE id = '$postid' ");
	
	}
}







	
	