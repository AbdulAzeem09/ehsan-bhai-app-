<?php 
class _register
{
    // property declaration
	// idspPostings, spPostingTitle, spPostingNotes, spPostingEmail, spPostingPhone, spPostingVisibility, spSubCategories_idspSubCategory, spProfiles_idspProfiles, spCities_idspCity
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spUser");
		$this->ta->dbclose = false;
	} 
	
	function post($data){
		return $this->ta->create($data);
	}
}
?>