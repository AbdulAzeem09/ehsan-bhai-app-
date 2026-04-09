<?php 
class _storebanner
{
    public $dbclose = false;
    private $conn;
    public $ta;
    function __construct() { 
        $this->ta = new _tableadapter("store_banner");//spShipping
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

    function readbanner($pid) {
        return $this->ta->read("WHERE idspProfiles = " . $pid);
    }

    function getStoreBannerByProfileId($pid) {
        return $this->ta->read("WHERE idspProfiles = " . $pid);
    }
	
	function updatebannerpic($pid, $data) {
        $this->ta->update(array("spStorebanner" => $data), "WHERE idspProfiles ='" . $pid . "'");
    }

    function updatebannerpic_store($pid, $data) {
        $this->ta->update(array("company_banner" => $data), "WHERE idspProfiles ='" . $pid . "'");
    }

    function readprofile($pid) {
        return $this->ta->read("WHERE idspProfiles = " . $pid);
    }
	
	function readawskey(){
		return $this->tas->read();
	}
	
	function readawskeyagain($ids){
		return $this->tass->read("WHERE id=".$ids."");
	}

}

?>
