<?php 
class _storegroupbanner
{
    public $dbclose = false;
    private $conn;
    public $ta;
    function __construct() { 
        $this->ta = new _tableadapter("storegroup_banner");//spShipping
		$this->tas = new _tableadapter("aws_s3_key");
		$this->tass = new _tableadapter("aws_s3");
        $this->ta->dbclose = false;
    } 

   
    function create($data)
	{
		$id = $this->ta->create($data);
	}

	function read($uid) {
        return $this->ta->read("WHERE idspUser = " . $uid);
    }
	
	
	function readawskey(){
		return $this->tas->read();
	}
	
	function readawskeyagain($ids){
		return $this->tass->read("WHERE id=".$ids."");
	}
	
	function updatebannerpic($pid, $data) {
        $this->ta->update(array("spStorebanner" => $data), "WHERE idspProfiles ='" . $pid . "'");
    }

    function readprofile($pid) {
        return $this->ta->read("WHERE idspProfiles = " . $pid);
    }

}

?>
