<?php
class _spAllStoreForm 
{

	public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	public $isc;
	public $qc;
	public $jl;
	public $sc;
	public $pt;
	public $ps;
	public $ft;
	public $lan;
	public $sn;
	public $snp;
	public $pg;
	public $ge;
	public $ms;
	public $ifs;
	public $po;
    public $ba;
    public $faq;
	
	function __construct() { 
	    $this->taaa 	= new _tableadapter("spprofiles_has_spgroup");
	    $this->taa 	= new _tableadapter("spgroup");
		$this->ta 	= new _tableadapter("industry_type");
		$this->tad 	= new _tableadapter("productstatus");
		$this->isc 	= new _tableadapter("in_sub_category");
		$this->qc 	= new _tableadapter("spQuotationComment");
		$this->jl 	= new _tableadapter("job_level");
		$this->sc 	= new _tableadapter("spprofilecontent");
		$this->pt 	= new _tableadapter("property_type");
		$this->ps 	= new _tableadapter("property_status");
		$this->ft 	= new _tableadapter("frame_type");
		$this->lan 	= new _tableadapter("music_language");
		$this->sn 	= new _tableadapter("tbl_sticky_notes");
		$this->snp 	= new _tableadapter("tbl_sticky_pin");
		$this->pg 	= new _tableadapter("tbl_page");
		$this->ge 	= new _tableadapter("tbl_general");
		$this->ms 	= new _tableadapter("tbl_module_show");
		$this->ifs 	= new _tableadapter("tbl_invite_friends"); 
		$this->po 	= new _tableadapter("tbl_posting_content");
		$this->ba 	= new _tableadapter("spadminstorebanner");
		$this->faq 	= new _tableadapter("faq");
		$this->sfaq 	= new _tableadapter("store_faq"); 
		$this->faqa 	= new _tableadapter("faq_q_a");
		$this->tas 	= new _tableadapter("subcategory");
		$this->faqattac 	= new _tableadapter("faq_attechment");


		$this->ta->dbclose = false;
	} 
	
	//read data by id
	function readdatabyid($getid){
		return $this->taa->read("WHERE idspgroup= $getid ");
	}
	
	function readdatabymulid($getid,$pid){
		return $this->taaa->read("WHERE spGroup_idspGroup= $getid AND  spProfiles_idspProfiles=$pid AND spApproveRegect = 1 "); 

    // echo  $this->taaa->sql;
	 //die("========");

	}
	
		function readdatabymulid_assitant($getid,$pid){
		return $this->taaa->read("WHERE spGroup_idspGroup= $getid AND  spProfiles_idspProfiles=$pid AND spApproveRegect = 1 AND spAssistantAdmin=1"); 

    // echo  $this->taaa->sql;
	 //die("========");

	}
	//end
	// READ ALL INDUSTRY TYPE
	function readIndustryType(){
		return $this->ta->read("ORDER BY industryTitle ASC ");
	}
	// READ ALL PRODUCT STATUS
	function readProductStatus(){
		return $this->tad->read("WHERE status != '-7' ORDER BY productStatusTitle ASC");
	}
	// READ ALL IN-SUB CATEGORY
	function readInSubCategory($subcat){
		return $this->isc->read("WHERE idsubCategory = $subcat");
	}
	function mkc(){
		return $this->tas->read("WHERE spCategories_idspCategory=1 and subCategoryStatus != 7");
		 //echo $this->tas->sql;

	}
	
	// ADD COMMENT IN THE DB
	function createQuoteComment($data){
		return $this->qc->create($data);
	}
	// READ COMMENT OF ALL SPECEFIC QUOTE
	function readComment($quoteid){
		return $this->qc->read("WHERE idspQuotation = $quoteid");
	}
	// READ ALL JOB LEVEL
	function readJobLevel(){
		return $this->jl->read();
	}
	// ==================CONTENT SHOW=================
	function readContent($pageid){
		return $this->sc->read("WHERE pageId = $pageid");
	}
	// ==================BANNER SHOW=================
	function readbanner($module){
		return $this->ba->read("WHERE modulename = '$module' ORDER BY id DESC");
	}
	// ==================PROPERTY TYPE=================
	function readPropertyType(){
		return $this->pt->read("WHERE status != '-7' ORDER BY propertyTypeTitle ASC");
	}

	// ==================PROPERTY STATUS=================
	function readPropertyStats(){
		return $this->ps->read("WHERE status != '-7' ");
	}

	// ==================PROPERTY STATUS=================
	function readFrameType(){
		return $this->ft->read("WHERE status != '-7' ORDER BY spFrameTitle ASC");
	}
	// ==================MUSIC LANGUAGE==================
	function readMusicLanguage(){
		return $this->lan->read("ORDER BY spMusicTitle ASC");
	}

	function readFAQ(){
			return $this->faq->read("ORDER BY position ASC");

	//	return $this->faq->read("WHERE module = '$module' ORDER BY id DESC");
	}
	
	//function readFAQ($module){
			//return $this->faq->read("ORDER BY position ASC");

		//return $this->sfaq->read("WHERE module = '$module' ORDER BY id DESC"); 
//	}

	// ==================END=============================
	// ==================STICKY NOTES====================
	// create sticky notes
	function createSticky($pid, $title, $desc, $type){
		$this->sn->create(array("spStickyTitle" => $title, "spStickyDes" => $desc,"spProfile_idspProfile" => $pid,"spStickyVault" => $type));
	}


    function deleteind($id){
		$this->ta->remove("WHERE t.idspIndustry= " . $id);
	}

	function deletequa($id){
		$this->tad->remove("WHERE t.idspProductStatus= " . $id);
	}




	// READ ALL STICKY NOTES BY PROFILE ID
	function readSticky($pid, $type){
		return $this->sn->read("WHERE spProfile_idspProfile = $pid AND spStickyVault = $type");
	}
	function readStickyLimit($pid, $limit){
		return $this->sn->read("WHERE spProfile_idspProfile = $pid AND spStickyVault = 0 ORDER BY idspSticky DESC LIMIT $limit");
	}
	// READ SINGLE STICKY NOTE BY ID
	function readSinglSticky($id){
		return $this->sn->read("WHERE idspSticky = $id");
	}
	// UPDATE STICKY NOTES
	function updateSticky($pid, $title, $desc, $id){
		$this->sn->update(array("spStickyTitle" => $title, "spStickyDes" => $desc,"spProfile_idspProfile	" => $pid), "WHERE idspSticky = $id ");
	}
	// DELETE STICKY NOOTES
	function deletSticky($id){
		$this->sn->remove("WHERE t.idspSticky= " . $id);
	}
	// ==================END=============================
	// ==================STICKY NOTES PIN================
	function generateotp($pid, $otp, $validby){
		$this->snp->create(array("spProfile_idspProfile	" => $pid, "spstickyOtp" => $otp,"spstickyValidationBy	" => $validby));
	}
	// chek otp is created of not
	function chekOtp($pid){
		return $this->snp->read("WHERE spProfile_idspProfile = $pid");
	}
	// chek pin is correct or not
	function chekPinisCorect($pid, $otp){
		return $this->snp->read("WHERE spProfile_idspProfile = $pid AND spstickyOtp = '$otp' ");
		// echo $this->snp->sql;
	}
	//pin create

	
function btnCreatePinsticky($txtPin, $pid, $txtClue){
		$this->snp->create(array("spProfile_idspProfile	" => $pid, "pin" => $txtPin,"spstickyClue	" => $txtClue));
	}



	// pin update
	function updatesticypin($txtPin, $pid, $txtClue){   
		$this->snp->update(array("pin" => $txtPin, "spstickyisEnable" => 1, "spstickyClue" => $txtClue), "WHERE spProfile_idspProfile = $pid ");
	}
	// UPDATE OTP WHEN USER GENERATE AGAIN AND AGAIN
	function updateotp($pid, $randCode){
		$this->snp->update(array("spstickyOtp"=>$randCode), "WHERE spProfile_idspProfile = $pid");
	}
	// read pin is enable
	function readPinisActive($pid){
		return $this->snp->read("WHERE spProfile_idspProfile = $pid AND spstickyisEnable = 1");
	}
	// read pin is valid
	function readpinvalid($pid, $pin){
		return $this->snp->read("WHERE spProfile_idspProfile = $pid AND pin = $pin");
	}
	
	function readpindata($pid){
		return $this->snp->read("WHERE spProfile_idspProfile = $pid");
	}
	// ==================END=============================
	// ==================[PAGE CONTENT]==================
	function readPage($pageid){
		return $this->pg->read("WHERE page_id = $pageid");
	}
	// READ ALL PAGES OF FOOTER
	function readFootPage($fhid, $limit){
		return $this->pg->read("WHERE fh_id = $fhid AND status = 1 LIMIT $limit");
		 //echo $this->pg->sql;
	}
	// READ PAGE BY TITLE
	function readPageTitle($paget){
	  $paget = $this->pg->escapeString($paget);
		return $this->pg->read("WHERE page_title = '$paget' ");
	}



	// ==================END=============================
	// ==================GENERAL MODULE==================
	// CHEK GENERL IS ADDED OR NOT
	function chekExistOrNot($pid, $uid){
		return $this->ge->read("WHERE spProfile_idspProfile = $pid AND spUser_idspUser = $uid");
	}
	// create the generl 
	function createPhneGeneral($pid, $uid, $phone){
		$this->ge->create(array("spUser_idspUser" => $uid, "spProfile_idspProfile" => $pid,"spGenPhone" => $phone));
	}
	// update the general
	function updatePhneGeneral($pid, $uid, $phone){
		$this->ge->update(array("spGenPhone" => $phone), "WHERE spUser_idspUser = $uid AND spProfile_idspProfile = $pid ");
	}
	// create the generl 
	function createEmailGeneral($pid, $uid, $email){
		$this->ge->create(array("spUser_idspUser" => $uid, "spProfile_idspProfile" => $pid,"spGenEmail" => $email));
	}
	function updateEmailGeneral($pid, $uid, $email){
		$this->ge->update(array("spGenEmail" => $email), "WHERE spUser_idspUser = $uid AND spProfile_idspProfile = $pid ");
	}
	// read all general
	function readProfile($uid, $pid){
		return $this->ge->read("WHERE spProfile_idspProfile = $pid AND spUser_idspUser = $uid");
	}
	// read profile wise exixt or not
	function readProfileWise($pid){
		return $this->ge->read("WHERE spProfile_idspProfile = $pid");
	}
	// ==================END=============================
	// ==================MODULE SHOWW====================
	function chekModExit($pid, $uid){
		return $this->ms->read("WHERE spProfile_idspProfile = $pid AND spUser_idspUser = $uid");
	}
	// create module
	function createModShow($pid, $uid){
		$this->ms->create(array("spUser_idspUser" => $uid, "spProfile_idspProfile" => $pid));
	}
	// update module show
	function updateModShow($data, $pid, $uid){
		$this->ms->update($data, "WHERE spUser_idspUser = $uid AND spProfile_idspProfile = $pid");
	}
	// readall module show
	function readAllModuleShow($pid, $uid){
		return $this->ms->read("WHERE spUser_idspUser = $uid AND spProfile_idspProfile = $pid");
	}
	// ==================END=============================
	// ==================INVITE FRIENDS==================
	// insert data in db
	function createInvite($data){
		return $this->ifs->create($data);
	}
	// ==================END=============================
	// ==================POSTING FORM ===================
	function getformcontent($moid){
		return $this->po->read("WHERE module_id = $moid");
	}


		function getqanq($id){
		return $this->faqa->read("WHERE module_id = $id ");
	//echo $this->faq->sql;
	}


function faqaattac($id){
		return $this->faqattac->read("WHERE question_id = $id ");
	//echo $this->faq->sql;
	}

	// ==================END=============================
}
