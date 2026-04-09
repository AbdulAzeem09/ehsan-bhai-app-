<?php 
class _firstlogin
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("tbl_first_login");
		$this->ta->dbclose = false;
	}
	
	// CHEK MODULE SHOW OR NOT
	function chkModuleSeting($uid){
		$result = $this->ta->read("WHERE spUser_idspUser = $uid AND popupVisible = 0");
		
		if ($result) {
			// VISIBLE THE DIALOG BOX;
			return 1;
		}else{
			$result2 = $this->ta->read("WHERE spUser_idspUser = $uid AND popupVisible = 1");
			if ($result2) {
				// ALREADY DONE THE MODULE
				return 0;
			}else{
				// CREATE THE ACOUNT AND VISIBLE THE BOX
				$id = $this->ta->create(array("spUser_idspUser" => $uid));
				return 1;
			}
		}
	}
	// UPDATE USER VISIBILTY 0 TO 1
	function updateVis($uid){
		$this->ta->update(array("popupVisible" => 1), "WHERE spUser_idspUser = $uid ");
	}
	
}
?>