<?php 
class _favouriteBusiness
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("favouriteBusiness");
		$this->ta->dbclose = false;
	} 
	// ADD TO PROFILE BUSINESS
	function addfavbus($data){
		$this->ta->create($data);
	}
	// CHEK POST IS FAVOURITE OR NOT
	function chkFavAlready($cmpny, $pid, $fav){
		//die;
		$cmpny = $this->ta->escapeString($cmpny);
		return $this->ta->read("WHERE idspProfiles_spProfileCompany = $cmpny AND spProfiles_idspProfiles = $pid AND isfavourite = $fav");
		
	}
	function create_heart_11($data11){
		return $this->ta->create($data11);

	}
	function delete_heart_11($data11){
$idspProfiles_spProfileCompany=$data11['idspProfiles_spProfileCompany'];
$spProfiles_idspProfiles=$data11['spProfiles_idspProfiles'];

return $this->ta->remove("WHERE idspProfiles_spProfileCompany =$idspProfiles_spProfileCompany AND spProfiles_idspProfiles=$spProfiles_idspProfiles AND isfavourite=1");
		//  echo $this->ta->sql;
		//  die("mm");

	}
	
	
	//recourse favorite

	function create_heart_11_rec($data11_rec){
		return $this->ta->create($data11_rec);
		//echo $this->ta->sql;
		//die("djk");

	}
	function delete_heart_11_rec($data11_rec){
$idspProfiles_spProfileCompany=$data11_rec['idspProfiles_spProfileCompany'];
$spProfiles_idspProfiles=$data11_rec['spProfiles_idspProfiles'];

return $this->ta->remove("WHERE idspProfiles_spProfileCompany =$idspProfiles_spProfileCompany AND spProfiles_idspProfiles=$spProfiles_idspProfiles AND isfavourite=2");
		  //echo $this->ta->sql;
		  //die("mm");

	}
	
	
	
	// REMOVE FROM LIST
	function removefavoritDir($cmpny, $pid, $fav){
		return $this->ta->remove("WHERE idspProfiles_spProfileCompany = $cmpny AND spProfiles_idspProfiles = $pid AND isfavourite = $fav");

		
	}
	function removefavoritDir11($id){
		return $this->ta->remove("WHERE idspFavbus = $id");
	}
	// THIS IS RESOURCE FILES
	function readmyFavourite($pid, $fav){
		return $this->ta->read("WHERE spProfiles_idspProfiles = $pid AND isfavourite = $fav");
	}
	// UPDATE NOTES IN RESOURCE
	function updateNotes($notes, $idspFavbus){
		return $this->ta->update(array("notes" => $notes), "WHERE idspFavbus='".$idspFavbus."'");
	}
	// READ RESOURCE BY ID
	function readResource($resouce){
		return $this->ta->read("WHERE idspFavbus = $resouce");
	}





}
?>
