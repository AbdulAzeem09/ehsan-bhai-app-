<?php 
class _spevent_type_price
{
    public $dbclose = false;
	private $conn;
	public $tal;
	
	function __construct() { 
		$this->tal = new _tableadapter("spevent_type_price");
		$this->tas = new _tableadapter("spevent_pricetype_order_history");
		$this->tal->dbclose = false;
		$this->tas->dbclose = false;
	}
	
	function update($data, $where){

        $this->tal->update($data, $where);
		 
	    }

	 function create($data){ 
        return $this->tal->create($data);
    }

	function create_price_history($data){
        return $this->tas->create($data);
    }

	function read_price($eid){
		return $this->tal->read("WHERE event_id = $eid order by event_price asc");	
		 //echo $this->tal->sql;
		 //die("mmm");	
	 
	//echo $this->tal->sql; die("---------");	
	}

	//read
	function read($eid){
	  $eid = $this->tal->escapeString($eid);
		return $this->tal->read("WHERE event_id = $eid order by event_price asc LIMIT 1");	
		 //echo $this->tal->sql;
		 //die("mmm");	
	 
	//echo $this->tal->sql; die("---------");	
	}
	function read1($gid){
		 return $this->tal->read("WHERE event_id = ");	
      // echo  $this->tal->sql;die('8888888');	
	}

	function read_pricetype_order_history($orderid, $eid){
		return $this->tas->read("WHERE orderid = $orderid and eventid = $eid");		
	}

	function readtypid($teid){
		return $this->tal->read("WHERE typeid = $teid");		
	}

	function remove($typeid) {
        $this->tal->remove("WHERE typeid = " . $typeid);
    }
	function delete_data($id) {
        $this->tal->remove("WHERE event_id = " . $id);
    }
}
?>
