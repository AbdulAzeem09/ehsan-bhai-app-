<?php
class _subcategory
{

	public $dbclose = false;
	private $conn;
	public $ta;
	public $crta;
	public $ab;

	function __construct()
	{
		$this->ta = new _tableadapter("subcategory");
		$this->ab = new _tableadapter("pos_category");
		$this->ta11 = new _tableadapter("masterdetails");
		$this->ta22 = new _tableadapter("masterdetails");
		$this->ta_review = new _tableadapter("freelancer_project_review");
		$this->tm = new _tableadapter("masterdetails");
		$this->tart = new _tableadapter("art_category");
		$this->crta = new _tableadapter("craft_category");
		$this->tads = new _tableadapter("art_subcategory");
		$this->tadsc = new _tableadapter("craft_subcategory");
		$this->ta->dbclose = false;
	}

	// READ THE SUB CATEGORY FOR SPECIFIC MODULE
	function read($catiId)
	{
		return $this->ta->read("WHERE subCategoryStatus != '-7' AND spCategories_idspCategory=" . $catiId, "ORDER BY subCategoryTitle ASC");
		// echo $this->ta->sql;
	}


	function deletecat($id){
		return $this->ta->remove("WHERE t.idsubCategory=" .$id);
	}


	function read11()
	{
		return $this->ta11->read("WHERE t.master_idmaster=24");
		//echo $this->ta11->sql;
		//die("mukesh chauhn");
	}
	function read22()
	{
		return $this->ta22->read("WHERE t.master_idmaster=24");
		//echo $this->ta22->sql;
		//die("mukesh chauhn");
	}


  //select * from masterdetails where master_idmaster=23


	
	function read_cat($catiId)
	{
		return $this->tm->read("WHERE master_idmaster=$catiId");
		//echo $this->ta->sql;
	}

	function read_catrgory($cat, $catid)
	{
		return	$this->tm->read("WHERE master_idmaster=$catid AND masterDetails like '$cat%'");
		//echo $this->tm->sql;
		//die("+++");
	}

	function read_cat_id($catiId)
	{
		return $this->tm->read("WHERE idmasterDetails=$catiId");
		//echo $this->ta->sql;
	}


	function new_read($catiId, $cat)
	{
		return $this->ta->read("WHERE subCategoryStatus != '-7' AND spCategories_idspCategory=" . $catiId .  " AND idsubCategory =" . $cat);
		//echo  $this->ta->sql; die("-------------");
	}
	function read_review_rating_user($postid)
	{
		return $this->ta_review->read("WHERE t.to_person=$postid and project_owner = 0");
	    //echo $this->ta_review->sql;
		// die("mmm");
	}

	function read_review_rating_usernewprofile($postid)
	{
		return $this->ta_review->read("WHERE t.to_person=$postid and project_owner = 0");
	    //echo $this->ta_review->sql;
		// die("mmm");
	}



	function readArtcate()
	{
		return $this->tart->read();
		//echo $this->tart->sql;
	}



	function art_categorylist($catiId)
	{
		return $this->tart->read("WHERE idspArtgallery =" . $catiId);
	}

    // function shashi()
	// {
	// 	return $this->crta->read();
	// 	//echo $this->crta->sql;
	// 	 //die("mmm");
	// }


	function rain()
	{
		return $this->ab->read();
		//echo $this->crta->sql;
		 //die("mmm");
	}





	function craft_categorylist($catiId)
	{
		return $this->crta->read("WHERE id =" . $catiId);
		//echo $this->tadsc->sql;
	}

	function craft_categoryalllist()
	{
		return $this->tadsc->read("ORDER BY spCraftgalleryTitle ASC");
		//	echo $this->tadsc->sql;
	}


	function art_subcategorylist($catiId)
	{
		return $this->tads->read("WHERE idspArtcategory =" . $catiId);
		// echo $this->tads->sql;

	}

	function art_subcategoryalllist()
	{
		return $this->tads->read("ORDER BY spArtgalleryTitle ASC");
		//echo $this->tads->sql;

	}


	function readcat($id, $catid)
	{
		return $this->ta->read("WHERE idsubCategory = $id AND spCategories_idspCategory = " . $catid . " ");
	}
	// SHOW THE NAME OF THE CATEGORY
	function showName($id)
	{
		return $this->ta->read("WHERE idsubCategory = $id");
		//echo $this->ta->sql; die('=====');
	}
	function showNameall()
	{
		return $this->ta->read();
	}


	// READ CATEGORY BY ALPHABETICALY
	function readAlpha($id, $alpha)
	{
	  $alpha = $this->ta->escapeString($alpha); 
		return $this->ta->read("WHERE spCategories_idspCategory  = $id AND subCategoryStatus != '-7' AND subCategoryTitle  like ('" . $alpha . "%' )");
	}

	function showall_id($id)
	{
		return $this->ta->read("WHERE spcategories_idspcategory = $id");
		//echo $this->ta->sql;
	}

	// function showall_idss($id)
	// {
	// return $this->ta->read("WHERE spCategories_idspCategory = $id");
	// //echo $this->ta->sql;
	// }


	function showall_Nameall($id)
	{
		return $this->ta->read("WHERE idsubCategory IN ($id)");
	}

	function getAllGenre()
	{
		return $this->ta->read("WHERE subCategoryStatus != '-7' AND spCategories_idspCategory='23' ORDER BY subCategoryTitle ASC");
	}

	function readCraftCat()
	{
		return $this->crta->read();
	}
}
