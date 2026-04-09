<?php 
	class _shipdest{

		public $dbclose = false;
		private $conn;
		public $ta;
		function __construct() { 
			$this->ta = new _tableadapter("shipping_destination");
			$this->ta->dbclose = false;
		} 
		// READ ALL SHIPING DESTINATION
		function read(){
			return $this->ta->read("WHERE status != '-7' ");
		}
		
		
	}
?>