<?php 
class _spfreelancer_profile
{
    public $dbclose = false;
	private $conn;
	public $ta;
		public $tp;

	function __construct() { 
		$this->ta = new _tableadapter("spfreelancer_profile");
			$this->tap = new _tableadapter("spfreelancer");
			$this->tap1 = new _tableadapter("spuser");
			$this->tap3 = new _tableadapter("spprofiles");
		//$this->tp = new _tableadapter("spPortfolio_freelancer");
		$this->ta->dbclose = false;
	}


	
	function read_currency_new1($pid){
		   return $this->tap3->read("WHERE t.idspProfiles = " . $pid);
		//echo $this->tap->sql;die('=======');
	}
	function read_currency_new($uid){
		   return $this->tap1->read("WHERE t.idspUser = " . $uid);
		//echo $this->tap1->sql;die('===');
	}
	
	function create($data)
	{
		return  $this->ta->create($data);
	}
	 
	function removeProfiles($pid) { 
        $this->tap->remove("WHERE t.spProfiles_idspProfiles= " . $pid);
    }  
	
	function read($pid){
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid);
		//echo $this->ta->sql;
		//die("000000");
		
	}
	
	function read_now($pid){
		return $this->tap->read("WHERE t.spprofiles_idspProfiles = " . $pid);
		
	}
	
	function update($data, $pid){
	//die('====');
		return $this->ta->update($data, $pid);
		//echo $this->ta->sql;die('===');
	}
	//get the field which type of profile
	function getType($catid){
		return $this->ta->read("WHERE profiletype = '$catid'");
	}
	//get skill on 
	function getSkill($pid){
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid." AND spProfileFieldName = 'skill_'");
	}
	//chek field is add or not.
	function readField($pid, $spProfileFieldName){
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = $pid AND t.spProfileFieldName = '$spProfileFieldName' ");
	}
}
?>
