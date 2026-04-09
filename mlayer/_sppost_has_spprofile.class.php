<?php 
class _sppost_has_spprofile
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $pa;

	
	function __construct() {  
		

	
	
		$this->ta = new _tableadapter("spPostings_has_spProfiles");
		$this->ta->join = "INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles";
		$this->ta->dbclose = false;
	}

	function create($postid , $applier ,$categoryid , $activitydate , $closingdate ,$resumeid , $coverletter)	{
		return $this->ta->create(array("spProfiles_idspProfiles" => $applier, "spPostings_idspPostings" => $postid , "spCategoryid" => $categoryid ,"spActivityDate" => $activitydate , "spEndDate" => $closingdate , "sppostingResume" => $resumeid ,"sppostingscoverletter" =>$coverletter));
	}
	// ===END



	
	function rejectbid($postid,$profileid)
	{
		return $this->ta->remove("WHERE t.spPostings_idspPostings=" .$postid." AND spProfiles_idspProfiles =".$profileid);
	}
	
	function selectresume($resumeid , $postid ,$profileid)
	{
		return $this->ta->update(array("spSelectResume" => 1), "WHERE sppostingResume =".$resumeid . " AND spPostings_idspPostings =".$postid ." AND spProfiles_idspProfiles =".$profileid);
	}
	
	function deselectresume($resumeid , $postid ,$profileid)
	{
		return $this->ta->update(array("spSelectResume" => 0), "WHERE sppostingResume =".$resumeid . " AND spPostings_idspPostings =".$postid ." AND spProfiles_idspProfiles =".$profileid);
	}
	
	function job($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings =" .$postid);
	}
	
	function buycoupons($postid , $profile , $enddate , $categoryid)
	{
		return $this->ta->create(array("spProfiles_idspProfiles" => $profile, "spPostings_idspPostings" => $postid , "spEndDate" => $enddate, "spCategoryid" => $categoryid));
	}
	
	function allactivity($date)
	{
		return $this->ta->read("WHERE spStartDate='".$date."'");
	}
	
	function allactivitydate($date)
	{
		return $this->ta->read("WHERE spEndDate='".$date."'");
	}
	
	function myactivity($uid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles where spUser_idspUser =".$uid.") AND spStartDate IS NOT NULL AND spCategoryid = 9 AND spStartDate > CURDATE()","GROUP BY spStartDate");
	}
	
	function mydeadline($uid) 
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles where spUser_idspUser =".$uid.") AND spCategoryid != 9","GROUP BY spEndDate");
	}
	
	function eventregistration($postid , $profile , $startdate , $enddate , $categoryid)
	{
		return $this->ta->create(array("spProfiles_idspProfiles" => $profile, "spPostings_idspPostings" => $postid ,  "spStartDate" => $startdate , "spEndDate" => $enddate, "spCategoryid" => $categoryid));
	}
	
	
	
	function read($postid , $applier)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE spProfiles_idspProfiles=".$applier. " AND spPostings_idspPostings =" .$postid);
	}
	
	function appliedjob($uid){
			return $this->ta->read("WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles where spUser_idspUser =".$uid.")");
	}

	//get all jobs which i have to apply
	function myapplyJobs($pid, $postid){
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE spProfiles_idspProfiles = $pid AND spPostings_idspPostings = $postid");
	}
	//get all bids on my project


	
	

}
?>
