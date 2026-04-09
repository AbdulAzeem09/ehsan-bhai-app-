<?php 
class _artCategory
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("art_category");
			$this->tap = new _tableadapter("sppostingsartcraft");

			$this->ser = new _tableadapter("spclassified");
		$this->ta->dbclose = false;
	} 

	function read_state($pid)
    {
        return $this->tap->read("WHERE t.idspPostings= " . $pid);
    }

	function read_state_servics($pid)
    {
        return $this->ser->read("WHERE t.idspPostings= " . $pid);
    }

	function update_state($data,$id){
	  $id = $this->tap->escapeString($id);
		return $this->tap->update($data,"WHERE idspPostings='$id'");
		//echo $this->tap->sql;
		//die('=====');
		}


		function update_servics($data,$id){
			return $this->ser->update($data,"WHERE idspPostings='$id'");
			//echo $this->tap->sql;
			//die('=====');
			}
	
	function removeProfiles($pid) { 
        $this->tap->remove("WHERE t.spProfiles_idspProfiles= " . $pid);
    }  
	
	//read all category
	function readAll(){
		return $this->ta->read();
	}
	
	function read_now($pid)
	{
		return $this->tap->read("where t.spProfiles_idspProfiles = " . $pid );
	}

	
}
?>
