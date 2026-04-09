<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

class _timelineflag
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("flagtimelinepost");
		$this->mta = new _tableadapter("enquiry");
		$this->dta = new _tableadapter("data");


		$this->ta->dbclose = false;
	}
	// CREATE FLAG
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
/*	// DELETE ENQUIRY
	function delEnq($enqid){
		$this->ta->remove("WHERE enquiry_id= " . $enqid);
	}
	// READ MY FLAG (I AM FLAGGER)


	function readmyflag($pid){
		return $this->ta->read("INNER JOIN spcategories AS c ON t.spCategory_idspCategory = c.idspCategory INNER JOIN sppostings AS p ON t.spPosting_idspPosting = p.idspPostings WHERE spProfile_idspProfile = $pid AND flag_status = 0");
	}
*/

function mcreate($idata)
{
	return $this->mta->create($idata);
	//echo $this->mta->sql;
	//die("jai");

}

<<<<<<< HEAD

function dtacreate($idat)
{
	return $this->dta->data($idat);
	//echo $this->mta->sql;
	//die("jai");

}


function register($insertdatakjhk)
=======
function macreate($mdata)
>>>>>>> live_server
{
	return $this->mta->create($mdata);
	//echo $this->mta->sql;
	//die("jai");

}
function mjkhg()
{
	return $this->mta->read();
	 //echo $this->mta->sql;
	 //die("jai");

}
	
function mjax_readd()
{
	return $this->mta->read();
	 //echo $this->mta->sql;
	 //die("jai");

}
function delstudent($pid)
{
	//die('mmm555mm');
	//echo ($pid);
	 $this->mta->remove("WHERE eid=$pid");
	 echo $this->mta->sql;
	 //die("mukesh chauhan");


	 //$this->mta->remove("WHERE gid =$pid");
	 //$this->mta->remove("WHERE gid = " . $pid);
	 //echo $this->mta->sql;
	 //die("----");

}
    // function upmuk_11($data11, $uid)
    // {
    //      $this->mta->update($data11, "WHERE eid=$uid");
	// 	 echo $this->mta->sql;
	// 	 die("muikdsd");

    // }
	function upmuk_11($data1,$fid)
    {
        return $this->mta->update($data1, "WHERE eid=$fid");
		 //echo $this->mta->sql;
		 //die("muikdsd");

    }
	function uread_11($fid)
    {
		return $this->mta->read("WHERE eid=$fid");
		//echo $this->mta->sql;
		//die("mukesh");
    }
}
?>