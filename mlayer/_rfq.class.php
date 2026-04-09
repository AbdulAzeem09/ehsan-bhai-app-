<?php 
class _rfq
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	public $tcd;
	public $rfc;
	public $rfqf;
	public $rfqcon;
	public $tas;
	public $spq;
	
	public $tass;

	
	function __construct() { 
		$this->ta 	= new _tableadapter("rfq");
		$this->tas = new _tableadapter("aws_s3_key");
		$this->spq = new _tableadapter("spprofiles");
		$this->tass = new _tableadapter("aws_s3");
		$this->tad 	= new _tableadapter("rfq_profile");
		$this->tcd 	= new _tableadapter("rfq_comment");
		$this->rfc 	= new _tableadapter("rfq_conversation");
		$this->rfqf = new _tableadapter("rfq_favourite");
		$this->rfqcon = new _tableadapter("rfq_contact");
		$this->ta->dbclose = false;
	}
	// =======================RFQ=================================
	// ADD TO RFQ
	function createRfq($rfqTitle, $rfqCategory, $rfqQty, $rfqDelivered, $rfqCountry, $rfqState, $rfqCity, $rfqDesc, $pid, $catid, $rfqquote,$insertValuesSQL, $datetime){
		$id  = $this->ta->create(array("rfqTitle" => $rfqTitle, "rfqCategory" => $rfqCategory, "rfqQty" => $rfqQty, "rfqDelivered" => $rfqDelivered, "rfqCountry" => $rfqCountry, "rfqState" => $rfqState, "rfqCity" => $rfqCity, "rfqDesc" => $rfqDesc, "spProfile_idspProfiles" => $pid, "spCategory_idspCategory" => $catid,"spQuotereached" => $rfqquote, "rfqImage" => $insertValuesSQL,"created"=>$datetime));
		return $id;
	}
	
	function readawskey(){
		return $this->tas->read();
	}
	
	function readawskeyagain($ids){
		return $this->tass->read("WHERE id=".$ids."");
	}
	
function updatequote($deleveryprice, $qid) {
        $this->ta->update(array("rfqprice" => "$deleveryprice"), $qid);
    }
	// ADD ALL PROFILES WHICH IS USER CAN SEND REQUEST
	function createRfqWholesaler($rfqid , $key){
		return $this->tad->create(array("spRfq_idspRfq" => $rfqid, "spProfiles_idspProfiles"=> $key));
	}
	// READ ALL RFQ'S
	function readAllRfq($catid, $counts, $limits){
		return $this->ta->read("WHERE t.spCategory_idspCategory = " . $catid . " ORDER BY idspRfq DESC LIMIT $counts ,$limits");
		//echo $this->ta->sql;
		
	}

	function search_rfqtitle($category, $txtSearch,$start,$limitaa) {
        return $this->ta->read("WHERE t.rfqTitle  like ('%" . $txtSearch . "%') AND t.spCategory_idspCategory = " . $category . " ORDER BY t.idspRfq DESC limit $start,$limitaa");
    }

    function search_rfqcategory($category, $txtTitle,$start,$limitaa) {
        return $this->ta->read("WHERE t.rfqCategory  like ('%" . $txtTitle . "%') AND t.spCategory_idspCategory = " . $category . " ORDER BY t.idspRfq DESC limit $start,$limitaa");
    }
      function search_title_cat($category, $title,$start,$limitaa) {
        return $this->ta->read("WHERE t.rfqCategory  like ('%" . $category . "%') AND t.rfqTitle  like ('%" . $title . "%') ORDER BY t.idspRfq DESC limit $start,$limitaa");
    }


	function readrfqprofile($pid){
		return $this->ta->read("WHERE spProfile_idspProfiles = $pid ORDER BY idspRfq DESC");
	}

	// MY RFQ
	function myrfq($pid, $catid){
		return $this->ta->read("WHERE spProfile_idspProfiles = $pid AND spCategory_idspCategory = $catid");
	}
	// READ IMAGE RFQ
	function readRfq($idrfq){
		return $this->ta->read("WHERE idspRfq = $idrfq");
	}
	// REMOVE RFQ
	function removeRfq($idrfq){
		$this->ta->remove("WHERE idspRfq = $idrfq");
	}
	// READ SINGLE RFQ DETAIL
	function rfqRead($rfqid){
	  $rfqid = $this->ta->escapeString($rfqid);
		return $this->ta->read("WHERE idspRfq = $rfqid");
	}
	// SHOW MY ALL RECEIVED RFQ
	function myReceivedrfq($pid, $catid){
		return $this->ta->read("INNER JOIN rfq_comment AS c ON t.idspRfq = c.idspRfq WHERE t.spProfile_idspProfiles = $pid GROUP BY t.idspRfq ");
	}
	// SHOW MY ALL RESPONDED RFQ
	function myRespondedrfq($pid){
		return $this->ta->read("INNER JOIN rfq_comment AS c ON t.idspRfq = c.idspRfq WHERE c.spProfiles_idspProfiles = $pid AND t.spProfile_idspProfiles != $pid");
	}
	// SEARCH FORM CATEGORY AND TITLE
	function search($rfqCategory, $rfqTitle){
		return $this->ta->read("WHERE spCategory_idspCategory = 1 AND rfqCategory = '$rfqCategory' AND rfqTitle  like ('%" . $rfqTitle . "%')");
	}
	// SEARCH FORM ONLY CATEGORY
	function searchCat($rfqCategory){
		return $this->ta->read("WHERE spCategory_idspCategory = 1 AND rfqCategory = '$rfqCategory' ");
	}
	// SEARCH FORM ONLY TITLE
	function searchTitle($rfqTitle){
		return $this->ta->read("WHERE spCategory_idspCategory = 1 AND rfqTitle  like ('%" . $rfqTitle . "%')");
	}
	// ======================RFQ COMMENTS===================================
	// ADD COMMENTS IN RFQ DETAIL
	// function createRfqComment($data){
	// 	return $this->tcd->create($data);
	// }

	function createRfqContact($contact_title, $contact_desc, $idspRfqComment,$rfqcontactImg){
		return $this->rfqcon->create(array("idspRfqComment"=> $idspRfqComment, "contact_title"=> $contact_title, "contact_desc"=> $contact_desc, "rfqcontactImg"=> $rfqcontactImg));
	}

	function readRfqContact($rfqid){
	 return $this->rfqcon->read("INNER JOIN rfq_comment as d ON t.idspRfqComment  = d.idspRfqComment WHERE d.idspRfq = " . $rfqid);

	}

	 


	function createRfqComment($rfq_spProfiles_idspProfiles, $spProfiles_idspProfiles, $idspRfq, $rfqDesc, $rfqPrice, $rfqcProductName, $rfqcModelNum, $rfqcMinOrder, $rfqcMaxOrder, $rfqcLinkProduct,  $image_name, $rfqcvideoLink,$sellerEmailid,$buyerEmailid,$spTitle,$sellerName, $buyerName){


	  $id	= $this->tcd->create(array("rfq_spProfiles_idspProfiles" => $rfq_spProfiles_idspProfiles, "spProfiles_idspProfiles" => $spProfiles_idspProfiles, "idspRfq"=> $idspRfq, "rfqDesc"=> $rfqDesc, "rfqPrice"=> $rfqPrice, "rfqcProductName"=> $rfqcProductName, "rfqcModelNum"=> $rfqcModelNum, "rfqcMinOrder"=> $rfqcMinOrder, "rfqcMaxOrder"=> $rfqcMaxOrder, "rfqcLinkProduct"=> $rfqcLinkProduct, "rfqcImage"=> $image_name, "rfqcvideoLink"=> $rfqcvideoLink));
	
//   echo $this->tcd->sql;
//   die("======")
		$em = new _email;
		//$em->sendemail();
		// ===not complete
		$em->send_publicrfq_email($sellerEmailid, $buyerEmailid, $spTitle,$sellerName, $buyerName, $idspRfq);

		return $id;
		// echo $this->tcd->sql;
		//  die("mmmmmmmmmmmmmmmmmm");

		

	}
	// READ ALL RFQ COMMENT
	function readRfqComment($rfq){
		return $this->tcd->read("WHERE idspRfq = $rfq");
	}

		// READ ALL RFQ COMMENT
	function readRfqCommentdata($pid){
		return $this->tcd->read("INNER JOIN rfq AS c ON t.idspRfq = c.idspRfq WHERE t.spProfiles_idspProfiles = $pid ORDER BY idspRfqComment DESC");
	}
	
	function readRfqquotedetail($rfqid){
		return $this->tcd->read("WHERE idspRfqComment = $rfqid");
	}

	function readsubmittedRfqquote_1(){
		return $this->ta->read("ORDER BY idspRfq DESC");
		//echo $this->ta->sql; die('aaaaaaaaaa');
	 } 

	 function readsubmittedRfqquote(){
		return $this->ta->read("ORDER BY idspRfq DESC");
		//echo $this->ta->sql; die('aaaaaaaaaa');
	 } 

     function delete_data($rfqId){
		$this->ta->remove("WHERE idspRfq = $rfqId");
	}




	 function sp_rq(){
	 return $this->spq->read("WHERE idspProfiles = '332'");
	 	//echo $this->spq->sql; die('aaaaaaaaaa');
	 } 

	function removeRfqComment($rfqId){
		$this->tcd->remove("WHERE idspRfqComment = $rfqId");
	}

	
	// READ RFQ QUOTE COUNTINNG
	function readRfqQuoteRecCount($idrfq){
		return $this->tcd->read("WHERE idspRfq = $idrfq GROUP BY spProfiles_idspProfiles") ;
	}
	function chckQuote($idrfq, $pid){
	  $idrfq = $this->tcd->escapeString($idrfq);
		return $this->tcd->read("WHERE idspRfq = $idrfq AND spProfiles_idspProfiles = $pid");
	}
	// READ RFQ ON MY SINGLE POST
	function readMyQuote($idrfq){
		return $this->tcd->read("WHERE idspRfq = $idrfq");
	}
	// =========================RFQ CONVERSATION============================
	// CREATE RFQ CONVERSATION
	function createRfqConv($data){
		return $this->rfc->create($data);
	}
	// READ RFQ CONVERSATION
	function readRfqConv($idrfq){
		return $this->rfc->read("WHERE spRfq_idspRfq = $idrfq ");
	}
	// READ RFQ CONVERSATION RECEIVED
	function readRfqConvRec($idrfq, $pid_rec){
		return $this->rfc->read("WHERE spRfq_idspRfq = $idrfq AND (`idspProfile_receiver` = $pid_rec) OR (`idspProfile_sender` = $pid_rec) AND spRfq_idspRfq = $idrfq");
	}
	// ===========================RFQ FAVOURITE==============================
	// ADD TO FAVOURITE COMPANY
	function createFavrtCmpny($rfqId, $myPid, $cmPid){
		return $this->rfqf->create(array("spRfq_idspRfq" => $rfqId, "myPid_idspProfile" => $myPid, "favrtId_idspProfile" => $cmPid));
	}
	// REAAD FAVOURITE YES OR NO
	function readFavourtCmpy($rfqId, $cmPid, $myPid){
		return $this->rfqf->read("WHERE spRfq_idspRfq = $rfqId AND myPid_idspProfile = $myPid AND favrtId_idspProfile = $cmPid");
	}
	// REMOVE FAVOURITE COMPNAY
	function remoeFavrtCmpny($rfqId, $myPid, $cmPid){
		$this->rfqf->remove("WHERE spRfq_idspRfq = $rfqId AND myPid_idspProfile = $myPid AND favrtId_idspProfile = $cmPid");
	}

	

	// Upload Imge
    function uploadRfqPic($inputName, $uploadDir,$newW, $newH){
        $image     = $_FILES[$inputName];
        $imagePath = '';
        $thumbnailPath = '';
        $imgSize = getimagesize($image['tmp_name']);
        // if a file is given
        if (trim($image['tmp_name']) != '') {
            $ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];
            // generate a random new file name to avoid name conflict
            $imagePath = md5(rand() * time()) . ".$ext";
            list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 
            // make sure the image width does not exceed the
            // maximum allowed width
            if ($width > $newW) {
                $result  = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $newW, $newH);
                $imagePath = $result;
            } else {
                $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
            }
            // make sure the image height does not exceed the
            // maximum allowed height
            
            if ($height > $newH) {
                $result  = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $newW, $newH);
                $imagePath = $result;
            } else {
                $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
            }
        }
        //return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
        return $imagePath;
    }








    
}
?>
