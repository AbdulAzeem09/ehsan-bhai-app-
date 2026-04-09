<?php 

?>



<?php 

error_reporting(0);
class _state
{
    public $dbclose = false;
	private $conn;
	public $ta;
    public $ca;
	function __construct() { 
		$this->ta = new _tableadapter("tbl_state");
		$this->st = new _tableadapter("spcustomers_basket");
		$this->ca = new _tableadapter("realenquiry");
		$this->ra = new _tableadapter("sprealstate");
		$this->pa = new _tableadapter("spprofiles");
		$this->fa = new _tableadapter("tbl_shipping");
		$this->ka = new _tableadapter("tbl_country");
		$this->ma = new _tableadapter("tbl_state");
		$this->da = new _tableadapter("tbl_city");
		 
				$this->ta->dbclose = false;

	}
	
	
	function readstore($pid){
		return $this->st->read("WHERE spByuerProfileId =$pid AND spOrderStatus=1"); 
	}
	
	//read
	function readState($id){
		return $this->ta->read("WHERE country_id = $id ORDER BY state_title ASC");
		echo $this->fa->sql;die("hghgjh");		
	}
	// read name
	function readStateName($id){
		return $this->ta->read("WHERE state_id = $id");
	}
	
	 function readclassified($id){
 return  $this->fa->read("WHERE spUser_idspUser = " .$id );
		//echo $this->fa->sql;die;
    }
	
    	function new_remove($pid) { 
       return $this->ca->remove("WHERE t.idsprealEnquiry= " . $pid);
    }  
	function form_update($pid){
      return $this->ca->read("WHERE t.idsprealEnquiry= " . $pid);
		//echo   $this->ca->sql; die;
    }  
	function update_form($data, $where){
		$this->ca->update($data, "WHERE idsprealEnquiry = $where ");
		//echo $this->ca->sql;die;
	}
		function form_create($data){
      return $this->ca->create($data);
		}
			function read_title($postid){
	return $this->ra->read("WHERE t.idspPostings = " . $postid);
	
		
	} 
		function read_form($postid){
	return $this->pa->read("WHERE t.idspProfiles = " . $postid);
		//echo $this->pa->sql;die;
	} 
		function sell_form($postid){
	return $this->ca->read("WHERE t.idsprealEnquiry = " . $postid);
		//echo $this->pa->sql;die;
	} 
	function read_country($id){
  return $this->ka->read("WHERE country_id = " .$id );
		//echo $this->ka->sql;die;
    }
    function read_state($aid){
		return $this->ma->read("WHERE state_id=" .$aid);
	}
function read_city($cid){ 
	return $this->da->read("WHERE city_id=" .$cid);
}
 function select_country()
 {
	return $this->ka->read();
	//echo $this->ka->sql;die('==========8888888888');
 }

	
	//function readStateName22($id){
		
		
		//return $this->ta->read("WHERE state_id = $id");
	//}
	
}


?>