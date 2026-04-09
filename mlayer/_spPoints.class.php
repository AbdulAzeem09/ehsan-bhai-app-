<?php
class _spPoints 
{

	public $dbclose = false; 
	private $conn;
	public $ta;
	public $tad;
	public $fav;
	public $red;
	public $do;
	public $test;
	
	function __construct() { 
		$this->ta = new _tableadapter("tbl_point");
		$this->tad = new _tableadapter("sppoints");
		$this->red = new _tableadapter("testing");
		$this->do = new _tableadapter("tbl_dollar");
		$this->fav = new _tableadapter("spfavorite_media");
		$this->test = new _tableadapter("crud_test");
		$this->ta->dbclose = false;
	} 




	function insert_fav($data){
		//die('=====');
		$id = $this->fav->create($data);
		return $id;
		
	}
	function insert_test($data){
		//die('=====');
		$id = $this->test->create($data);
		return $id;
		
	}

	function delete($id){
		//die('=====');
		$this->test->remove("where t.id=".$id);
		//echo $this->test->sql;die('+++');
		
		
	}


	function  editdata($id){
      

		return $this->test->read("where t.id=".$id);

		
		


	}

	function getdata(){
		return $this->test->read();
	}



	function delete_fav($id){
		//die('============11');
		$this->fav->remove("where t.media_id=".$id);
		//echo $this->fav->sql;
		//die('============');

	}


	function read_fav($id,$uid){
		// /return $this->ta->read("WHERE t.point_id = $id");
		return $this->fav->read("WHERE t.media_id = $id And uid=$uid");
		 //echo $this->fav->sql;
		 //die('==========');

	}


	
	function read($id){
		// /return $this->ta->read("WHERE t.point_id = $id");
		return $this->ta->read("WHERE t.point_id = " . $id);
	}
		
	
	function readpoint($id){
		return $this->ta->read("WHERE t.point_id = " . $id);
	}

	function readpoint_all($id){
		return $this->tad->read("WHERE t.uid = " . $id);
		//echo $this->ta
	}
	function delete1($id){
		// /return $this->ta->read("WHERE t.point_id = $id");
		 $this->red->remove("WHERE t.uid = " . $id);
	}
	
	function update2($data,$id){
		// /return $this->ta->read("WHERE t.point_id = $id");
		return $this->red->update($data,"WHERE t.uid = " . $id);
	}
	// ==================END=============================
	// ===ADD POINTS OF THE USER
	function create($data){
		$id = $this->tad->create($data);
		return $id;
	}
	function insert($data){
		$id = $this->red->create($data);
		return $id;
	}

	function create_point($data){
		$id = $this->tad->create($data);
		return $id;
	}
	// READ ALL POINTS
	function readmypoint($uid){
		return $this->tad->read("WHERE t.spUser_idspUser = " . $uid);
	}

	function get_data(){
		return $this->red->read();
	}
	// ==================END=============================
	// ===ADD DOLLAR RATE
	function getlastrate(){
		return $this->do->read("ORDER BY dollar_id DESC LIMIT 1");		
	}

	// ==================END=============================
}
?>
	