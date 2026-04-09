<?php 
class _pos_po
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	public $ts;
	
	function __construct() { 
		$this->ta = new _tableadapter("pos_po");
		$this->tab = new _tableadapter("pos_po_new");
		$this->tad = new _tableadapter("tbl_contact_issue_topic");     
		$this->ts = new _tableadapter("tbl_social");
		$this->mem = new _tableadapter("membership_pos");
		$this->cur = new _tableadapter("spuser"); 
		/*
        $this->add = new _tableadapter("adddata"); */
 $this->ta1 = new _tableadapter(" pos_membership_barcode_manually ");
	$this->read1 = new _tableadapter("pos_membership_barcode"); 
	$this->ins = new _tableadapter("spbuisnesssale"); 
	$this->da = new _tableadapter("file_manager");
	$this->ev = new _tableadapter("spgoogle_event ");
	

        
		
		$this->ta->dbclose = false; 
	}
	function insetEvent($data)
	{
		return $this->ev->create($data);
	}
	function readEvent($uid){
	return $this->ev->read("WHERE id=$uid");
	//echo  $this->ev->sql; die('-----');
	}
	
	
	
	function insert_data($data)
	{
		$id = $this->ta->create($data);
		return $id;
		
	}
	
	function insertApi($data)
	{
		return $this->cur->create($data);
		//echo  $this->cur->sql; die('-----');
		
	}
	
	function readApi($uid){
	return $this->cur->read("WHERE idspUser=$uid");
	//echo  $this->cur->sql; die('-----');
	}
	
	function updateApi($data,$id){
	return $this->cur->update($data,"WHERE idspUser=$id");
	//echo  $this->cur->sql; die('-----');
	}
	
	function insert_data_1($data)
	{
		$id = $this->tab->create($data);
		return $id;
		
	}
	
	function create_membership($data)
	{
		$id = $this->mem->create($data);
		return $id;
		
	}
	function currency($uid){
	return $this->cur->read("WHERE idspuser=$uid");
	
	}
	
	
	function read_membership($uid){
	return $this->mem->read("WHERE spuser_idspuser=$uid");
	}
	
	function read_data_po($uid){
	return $this->tab->read("WHERE uid=$uid");
	}
	
	function read_membership_id($id){
	return $this->mem->read("WHERE id=$id");
	}
	
	function read_data_id_new($id){
	return $this->tab->read("WHERE id=$id");
	}
	
	function update_membership($data,$id){
	return $this->mem->update($data,"WHERE id=$id");
	}
	
	function update_new($data,$id){
	return $this->tab->update($data,"WHERE id=$id");
	}
	
	function delete_membership($id){
	$this->mem->remove("WHERE id=$id");
	}
	
	function remove_new($id){
	$this->tab->remove("WHERE id=$id"); 
	}
	// ===========TABLE CONTACT ISSUE==============
	function read_data($pid){
		return $this->ta->read("WHERE pid = $pid");  
	}
	
	function read_data_id($id){
		return $this->ta->read("WHERE id = $id");  
	}
	
	function remove($id){
		return $this->ta->remove("WHERE id = $id");   
	}
	
	
	function update($data,$res){
		 $this->ta->update($data," WHERE id = $res "); 
//echo  $this->ta->sql; die('-----');
		
	}


	// ===========TABLE SOCIAL==============
	function readSocial(){
		return $this->ts->read();
	}
	
		 

	function insert_data_4($data2)
	{
		return $this->ta1->create($data2);
		//echo  $this->ta1->sql; die('-----');	
	}
	function dataInsert($data1)
	{
		return $this->ins->create($data1);
		//echo  $this->ins->sql; die('-----');	
	}
	
	function dataInsert4($data2)
	{
		return $this->da->create($data2);
		//echo  $this->ins->sql; die('-----');	
	}
	
	function dataInsert1($data1)
	{
		return $this->da->create($data1);
		//echo  $this->ins->sql; die('-----');	
	}
	function dataRead($path){
	return $this->da->read("WHERE path='$path'");
		//echo $this->da->sql; die('-----');

	}
	function dataDelete($id){
	return $this->da->remove("WHERE id=$id");
	}
	
	function formUpdate($data1,$id){
		
	return $this->da->update($data1,"WHERE id=$id");
     //echo $this->read1->sql; die('-----');	
	
	}
	/*
	function read_data_2($id){
	return $this->add->read("WHERE id=$id");
	}
	function read_data_5(){
	return $this->add->read();
	}*/
	function read($ids){
	return $this->read1->read("WHERE t.customerr_user_id=$ids");
	//echo $this->read1->sql; die('-----');
	}
	function read_qty_d($ids,$barcode){
		//echo $barcode;
		//die('========');
	return $this->read1->read("WHERE t.customerr_user_id=$ids AND barcode='$barcode'");
	//echo $this->read1->sql; die('-----');
	}
	
	function update1($data1,$ids,$barcode){
		//die('-==');
	return $this->read1->update($data1, " WHERE customerr_user_id=$ids AND barcode='$barcode'");
     //echo $this->read1->sql; die('-----');	
	}
	
	
	
	
	
	/*
	function read_data_4(){
	return $this->add->read();
	}
	
	function remove_data_2($id){
	$this->add->remove("WHERE id=$id"); 
	}*/
	

}
?>