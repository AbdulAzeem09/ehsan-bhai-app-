<?php

class _updatemedia
{
	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{
		$this->ta = new _tableadapter("sppostingmedia");
		$this->tas = new _tableadapter("aws_s3_key");
		$this->tass = new _tableadapter("aws_s3");

		// Join changed due to 377 task. As spf_id is passing during insert of file.
		$this->ta->join = "LEFT JOIN sppostingalbum as d ON t.spf_id = d.idspPostingAlbum";
		$this->ta->dbclose = false;
	}

	function readawskey()
	{
		return $this->tas->read();
	}

	function readawskeyagain($ids)
	{
		return $this->tass->read("WHERE id=" . $ids . "");
	}

	function updatemedia($data, $FileExt, $postid, $name)
	{
		
		return $this->ta->update(array("sppostingmediaTitle" => $data, "sppostingmediaExt" => $FileExt, "original_name" => $name), "WHERE idspPostingMedia ='" . $postid . "'");
	//echo $this->ta->sql; die('sssssss1111');    
	}
}
