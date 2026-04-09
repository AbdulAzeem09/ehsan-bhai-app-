<?php 
class _spuser_device
{
    public $dbclose = false;
	private $conn;
	public $ta;
	function __construct() { 
		$this->ta = new _tableadapter("spuser_device");//spShipping
		$this->ta->dbclose = false;
	} 
	
	function create($data){
		return $this->ta->create($data);
	}
	
	function read($uid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
		return $this->ta->read("WHERE t.uid =".$uid);
	}

	function readdevice($uid,$device_id,$device_type)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
		return $this->ta->read("WHERE uid =$uid  And device_id = '$device_id' And device_type = '$device_type'");
	}

    function readproductview($uid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
		//return $this->ta->read("WHERE uid =".$uid);
	}
	
	function update($data, $pid){
		$this->ta->update($data, $pid);
	}

   function remove($uid,$device_id,$device_type) {
       
       $this->ta->remove("WHERE uid = $uid And device_id = '$device_id' And device_type = '$device_type'");
  	 
      } 
   
 
	
}

?>