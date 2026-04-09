<?php
class _freelance_project_status
{
	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{
		$this->ta = new _tableadapter("freelance_project_status");
		$this->tad = new _tableadapter("spfreelancer_fav");
		$this->spf = new _tableadapter("spfreelancer");
		$this->ta->dbclose = false;


		
	}

	function getstatus($postid)
	{
		return $this->ta->read("WHERE spPosting_idspPostings = '$postid' ");
	}






	
	function read_project($postid)
	{
		return $this->spf->read("WHERE idspPostings = $postid");
	}


	function checkStatusExist($postid, $pid)
	{
    $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE spPosting_idspPostings = '$postid' AND spProfiles_idspProfiles = $pid");
	}
	//get my all assighn projects
	/*	function myAssignProject($pid){
		return $this->ta->read("WHERE spProfiles_idspProfiles = '$pid' AND txn_id !=  ORDER BY fps_id DESC");
	}*/
	

	function myAssignProject($pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles = '$pid'  ORDER BY fps_id DESC");
	}
	//get the value of freelancer project
	function readFreelanceProject($postid)
	{
		return $this->ta->read("WHERE spPosting_idspPostings = '$postid' AND fps_status = 'Acepted' AND status =1");
	}
	//chek project kis ko assign howa ha
	function chekProjectAssign($pid, $postid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles = $pid AND spPosting_idspPostings = $postid AND fps_status = 'Acepted'");
	}
	//chek project reject to ni howa
	function chekProjectReject($postid)
	{
		return $this->ta->read("WHERE spPosting_idspPostings = $postid AND fps_status = 'Rejected'");
	}
	//read aprove project id acept
	function readAceptid_accpted($postid, $profleid)
	{
	  $postid = $this->ta->escapeString($postid);
		//echo $postid; exit;
		return  $this->ta->read("WHERE spPosting_idspPostings = $postid AND spProfiles_idspProfiles = $profleid AND fps_status = 'Accepted'");
		//echo   $this->ta->sql; die('==============');

	}


	function readAceptid($postid, $profleid)
	{
	  $postid = $this->ta->escapeString($postid);
		//echo $postid; exit;
		return $this->ta->read("WHERE spPosting_idspPostings = $postid AND spProfiles_idspProfiles = $profleid ");
		//echo   $this->ta->sql; die('==============');

	}



	function readid($uid, $pid)
	{
		//echo $postid; exit;
		return $this->tad->read("WHERE user_id=$uid AND prof_id=$pid");
		//echo $this->tad->sql;die;
	}





	function readAceptproject($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		return	$this->ta->read("WHERE spPosting_idspPostings = $postid AND fps_status = 'Accepted' ");
		//echo $this->ta->sql;die('11111111');
	}
	// update txn
	function updateTxn($postid, $txn_id)
	{
		return $this->ta->update(array("txn_id" => $txn_id), "WHERE spPosting_idspPostings ='" . $postid . "'");
	}
	function updatestatus($postid, $status)
	{
		return $this->ta->update(array("status" => $status), "WHERE spPosting_idspPostings ='" . $postid . "'");
	}
	// read product and with tn account
	function readFreeCode($postid)
	{
		return $this->ta->read("WHERE spPosting_idspPostings = '$postid' AND txn_id = '' ");
	}


   function removefavfree($id)
    {
        $this->tad->remove("WHERE t.id= " . $id);
    }





}
