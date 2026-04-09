<?php
class _productpic
{
	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{
		$this->ta = new _tableadapter("spproductpics");
		$this->tas = new _tableadapter("aws_s3_key");
		$this->tasp = new _tableadapter("store_bulk_image");
		$this->tass = new _tableadapter("aws_s3");
		$this->ta->dbclose = false;
	}


	function read($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid . "   ORDER BY spPostings_idspPostings ASC");
		// echo $this->ta->sql; 
		// die;
	}
	function read_0($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid . " AND spFeatureimg=0  ORDER BY spPostings_idspPostings ASC");
		// echo $this->ta->sql; 
		// die;
	}
	function read_1($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid . " AND spFeatureimg=1 ORDER BY spPostings_idspPostings ASC");
		// echo $this->ta->sql; 
		// die;
	}



	function readawskey()
	{
		return $this->tas->read();
	}

	function imageInsert($imgdata)
	{
		return $this->tasp->create($imgdata);
		//echo $this->tasp->sql;  die("----------------------");
	}


	function readbulk($pid, $uid)
	{
		return $this->tasp->read("WHERE  sppid= $pid AND spuid = $uid ORDER BY t.id DESC");
		//echo $this->tasp->sql;  die("----------------------");
	}


	function readawskeyagain($ids)
	{
		return $this->tass->read("WHERE id=" . $ids . "");

		//echo $this->tass->sql;  die("----------------------");
	}

	function removePostPic($postid)
	{
		$this->ta->remove("WHERE t.spPostings_idspPostings = $postid");
	}

	function create($postid, $data)
	{
		$this->ta->create(array("spPostings_idspPostings" => $postid, "spPostingPic" => $data));
	}

	function createpic_data($data)
	{
		return  $this->ta->create($data);
	}
	//create a pic for event
	function createPic($postid, $data, $fimg)
	{
		$this->ta->create(array("spPostings_idspPostings" => $postid, "spPostingPic" => $data, "spFeatureimg" => $fimg));
	}
	function remove($pospic)
	{
		$this->ta->remove("WHERE t.idspPostingPic = " . $pospic);
	}
	//read feature image
	function readFeature($postid)
	{
		$result = $this->ta->read("WHERE t.spFeatureimg = 1 AND t.spPostings_idspPostings = " . $postid, " ORDER BY spPostings_idspPostings ASC");
		if ($result != false) {
			return $this->ta->read("WHERE t.spFeatureimg = 1 AND t.spPostings_idspPostings = " . $postid, " ORDER BY spPostings_idspPostings ASC");
		} else {
			return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid, " ORDER BY spPostings_idspPostings ASC");
		}
	}
	//update feature pic
	function updatePic($picid, $postid)
	{
		$this->ta->update(array("spFeatureimg" => 0), "WHERE spPostings_idspPostings ='" . $postid . "'");
		return $this->ta->update(array("spFeatureimg" => 1), "WHERE idspPostingPic ='" . $picid . "'");
	}


	function updatePic_pos($picid, $postid)
	{
		$this->ta->update($picid, "WHERE spPostings_idspPostings ='" . $postid . "'");
	}
}
