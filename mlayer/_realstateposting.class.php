<?php

class _realstateposting
{

	// property declaration
	// idspPostings, spPostingTitle, spPostingNotes, spPostingExpDt, spPostingPrice, spPostingEmail, spPostingPhone, spPostingVisibility, spPostingDate, spProfiles_idspProfiles, spCategories_idspCategory
	public $dbclose = false;
	private $conn;
	public $ta;
	public $pic;
	public $tapic;
	public $tad;
	public $taddress;

	function __construct()
	{

		
		$this->ta = new _tableadapter("sprealstate");
		$this->tapic = new _tableadapter("sprealstatepics");
		$this->tb = new _tableadapter("user_d");
		$this->taff = new _tableadapter("flagpost");
		$this->tahost = new _tableadapter("realstate_hostingdetails");
		$this->taddress = new _tableadapter("spuser");
		$this->posterdata = new _tableadapter("spprofiles");
		$this->tad = new _tableadapter("spBuyPostings");
		$this->ta->dbclose = false;

		//$this->ta->join = "INNER JOIN sppost_has_sporder as d ON t.idspPostings = d.spPostings_idspPostings INNER JOIN sporder as p ON d.spOreder_idspOreder = p.idspOrder";

		$this->pic = new _tableadapter("spPostingPics");
		$this->media = new _tableadapter("spPostingMedia");
	}


	function myflagPostaaaabbbbb($pid)
	{
		return $this->ta->read("WHERE idspPostings = $pid ");
	}

	function read_now($pid)
	{
		return $this->ta->read("where t.spProfiles_idspProfiles = " . $pid);
	}

	function removeProfiles($pid)
	{
		$this->ta->remove("WHERE t.spProfiles_idspProfiles= " . $pid);
	}

	function readRoomRent($defcountry, $defstate, $defcity)
	{
		return  $this->ta->read("Where t.spPostingPropStatus='Active' AND  t.spPostingVisibility=-1 AND spPostListing= 'rent a room' AND t.spPostingAddress LIKE '%$defcountry%' AND t.spPostingAddress LIKE '%$defstate%'  AND t.spPostingAddress LIKE '%$defcity%'");
		//echo $this->ta->sql;
		//die('----');
	}

	function readEntireRoomRent($defcountry, $defstate, $defcity)
	{
		return $this->ta->read("Where t.spPostingPropStatus='Active' AND  t.spPostingVisibility=-1 AND spPostListing= 'Rent Entire Place' AND t.spPostingAddress LIKE '%$defcountry%' AND t.spPostingAddress LIKE '%$defstate%'  AND t.spPostingAddress LIKE '%$defcity%'");
	}

	function readSellProp( $state, $country, $City)
	{
		return $this->ta->read("Where t.spPostingPropStatus='Active' AND t.spPostingVisibility=-1 AND spPostListing= 'Sell' AND t.spPostingsCountry = '$country' AND t.spPostingsState = '$state'  AND spPostingsCity = '$City'");
		//echo $this->ta->sql;
	}


	function readOpenHouse($country, $state, $City)
	{
		return $this->ta->read("Where t.spPostingPropStatus='Active' AND t.spPostingVisibility=-1 AND spPostingOpenHouse= 'Yes' AND t.spPostingsCountry = '$country' AND t.spPostingsState = '$state'  AND spPostingsCity= $City ");
		 //echo $this->ta->sql;
	}

	function myflagPostaaaa($catid, $pid)
	{
		return $this->taff->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catid ORDER BY flag_date DESC ");
		//echo $this->taff->sql;
	}
	// update notes on the training module
	function updateNotes($notes, $postid)
	{
		return $this->ta->update(array("spPostingNotes" => $notes), "WHERE idspPostings ='" . $postid . "'");
	}

	function hostdetailsget($uid)
	{
		return $this->tahost->read("Where user_id=" . $uid . " ");
	}

	function host9($data)
	{
		return $this->tb->create($data);
	}

	function create_d($data)
	{
		return $this->tb->create($data);
	}
	function remove1($id)
	{
		$this->tb->remove("WHERE t.id = " . $id);
	}


	function read1($id)
	{
		return	$this->tb->read("WHERE t.id = " . $id);
	}
	function update1($arr, $id)
	{
		return  $this->tb->update($arr, "WHERE t.id = $id");
	}

	function updateread1($postid)
	{
		$this->ta->update(array("spPostingVisibility" => 0), "WHERE t.idspPostings = " . $postid);
	}



	

	function deleteread1($postid)
	{
		 $this->ta->remove("WHERE t.idspPostings = " . $postid);
	}

	function deletereadpic1($postid)
	{
		 $this->tapic->remove("WHERE t.idspPostings = " . $postid);
	}


	// function remove($postid)
	// {
	// 	$this->ta->remove("WHERE t.spPostings_idspPostings = " . $postid);
	// }


//$sql1 =  "DELETE FROM sprealstate WHERE idspPostings =" . $postid . "";
//dbQuery($dbConn, $sql1);
//$sql =  "DELETE FROM sprealstatepics WHERE spPostings_idspPostings =" . $postid . "";

	//$sql =  "UPDATE sprealstate SET spPostingVisibility='0' WHERE idspPostings =" . $postid . "";
	function hostdetailsinsert($data)
	{
		return $this->tahost->create($data);
	}


	function hostdetailsupdate($data, $postid)
	{
		return  $this->tahost->update($data, "WHERE user_id ='" . $postid . "'");
	}

	function activeTodraft($postid, $userid)
	{
		return  $this->ta->update(array("spPostingVisibility" => '-1'), "WHERE idspPostings = $postid AND spProfiles_idspProfiles= $userid");
	}

	//For getting the City and Country for the logged in user
	function GetAddress($uid)
	{
		// echo $uid;
		// exit;
		return $this->taddress->read("Where idspuser=" . $uid . " ");
	}

	function getPosterData($uid)
	{
		// echo $uid;
		// exit;
		return $this->posterdata->read("Where idspProfiles=" . $uid . " ");
	}

	//get total counts of that (total listing, sale, rent, open house)
	function countTotalPost($category, $fieldName)
	{
		if ($fieldName == 'All') {
			return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spCategories_idspCategory = " . $category, "ORDER BY spPostingDate DESC");
		} else if ($fieldName == 'Sell') {
			return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spCategories_idspCategory = " . $category, " AND t.spPostListing = 'Sell' ORDER BY spPostingDate DESC");
		} else if ($fieldName == 'Rent') {
			return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spCategories_idspCategory = " . $category, "AND  t.spPostListing != 'Sell'  ORDER BY spPostingDate DESC");
		} else if ($fieldName == 'Open') {
			return $this->ta->read(" WHERE t.spPostingVisibility=-1 AND t.spCategories_idspCategory = " . $category, "AND  t.spPostingOpenHouse = 'Yes' ORDER BY spPostingDate DESC");
		} else {
			return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spCategories_idspCategory = " . $category, "ORDER BY spPostingDate DESC");
		}
	}


	function findAddress()
	{
	      
    $id = !empty($_GET['categoryID'])  ? $_GET['categoryID'] : 0;
    $txtAddress = !empty($_GET['txtAddress']) ? $_GET['txtAddress'] : "";
    $PropertyType = !empty($_GET['spPostingPropertyType']) ? $_GET['spPostingPropertyType'] : "";
    $pricefrom = !empty($_GET['pricefrom']) ? $_GET['pricefrom'] : "";
    $priceto = !empty($_GET['priceto']) ? $_GET['priceto'] : "";
    $spPostingBedroom = !empty($_GET['spPostingBedroom']) ? $_GET['spPostingBedroom'] : "";
    $spPostingBathroom = !empty($_GET['spPostingBathroom']) ? $_GET['spPostingBathroom'] : "";
    $Squrefootfrom = !empty($_GET['Squrefootfrom']) ? $_GET['Squrefootfrom'] : "";
    $Squrefootto = !empty($_GET['Squrefootto']) ? $_GET['Squrefootto'] : "";
    $spPostingTitle = !empty($_GET['spPostingTitle']) ? $_GET['spPostingTitle'] : "";
    $spPostingOpenHouse = !empty($_GET['spPostingOpenHouse']) ? $_GET['spPostingOpenHouse'] : "";
    $ltoh = !empty($_GET['ltoh']) ? $_GET['ltoh'] : "";
    $htol = !empty($_GET['htol']) ? $_GET['htol'] : "";
    $latest = !empty($_GET['latest']) ? $_GET['latest'] : "";
    $Country = !empty($_GET['country']) ? $_GET['country'] : "";
    $State = !empty($_GET['state']) ? $_GET['state'] : "";
    $City = !empty($_GET['city']) ? $_GET['city'] : "";
    $listingId = !empty($_GET['listingId']) ? $_GET['listingId'] : "";
    $community = !empty($_GET['community']) ? $_GET['community'] : "";
    
    if($Country){
      $countryObj = selectQ("select country_id from tbl_country where country_title=?", "s", [$_GET['country']], "one");
      if($countryObj){
        $Country = $countryObj['country_id'];
        if($State){
          $stateObj = selectQ("select state_id from tbl_state where country_id=? and state_title=?", "is", [$Country, $State], "one");
          if($stateObj){
            $State = $stateObj['state_id'];
            $cityObj = selectQ("select city_id from tbl_city where country_id=? and state_id=? and city_title=?", "iis", [$Country, $State, $City], "one");  
            if($cityObj){
              $City = $cityObj['city_id'];
            }
            
          }
        }
      }
    }
    
    if(!$City){
      $cityId = !empty($_GET['cityId']) ? $_GET['cityId'] : "";
      if($cityId){
        $Country =  $_SESSION['spPostCountry'];
        $City = $cityId; //for drop-down select cases
      }
    }

    $mainQuery = "select * from sprealstate as t  where t.spPostingVisibility=-1";
    
    $query = $params = $types = [];
    
    if ($txtAddress) {
      $query[] = "spPostingAddress like (?)";
      $params[] = "%$txtAddress%";
      $types[] = "s";
    }
    if ($PropertyType) {
      $query[] = "spPostingPropertyType = ?";
      $params[] = $PropertyType;
      $types[] = "s";
    }
    if ($pricefrom) {
      $query[] = "spPostingPrice >= ?";
      $params[] = $pricefrom;
      $types[] = "s";
    }
    if ($priceto) {
      $query[] = "spPostingPrice <= ?";
      $params[] = $priceto;
      $types[] = "s";
    }
    if ($spPostingBedroom) {
      $query[] = "spPostingBedroom >= ?";
      $params[] = $spPostingBedroom;
      $types[] = "i";
    }
    if ($spPostingBathroom) {
      $query[] = "spPostingBathroom >= ?";
      $params[] = $spPostingBathroom;
      $types[] = "i";
    }
    if ($Squrefootfrom) {
      $query[] = "spPostingSqurefoot >= ?";
      $params[] = $Squrefootfrom;
      $types[] = "i";
    }
    if ($Squrefootto) {
      $query[] = "spPostingSqurefoot >= ?";
      $params[] = $Squrefootto;
      $types[] = "i";
    }
    if ($spPostingTitle) {
      $query[] = "spPostingTitle like ?";
      $params[] = "%$spPostingTitle%";
      $types[] = "s";
    }
    if ($spPostingOpenHouse) {
      $query[] = "spPostingOpenHouse = ?";
      $params[] = $spPostingOpenHouse;
      $types[] = "s";
    }
    if($listingId){
      $query[] = "spPostListId = ?";
      $params[] = $listingId;
      $types[] = "s";    
    }
    if($community){
      $query[] = "community = ?";
      $params[] = $community;
      $types[] = "s";    
    }
    
    if(!$query && !$Country){ //default listing
      $Country =  $_SESSION['spPostCountry'];
      $State = $_SESSION['spPostState'];
      $City = $_SESSION['spPostCity'];                        
    }
    
    
    if($Country && is_numeric($Country)){
      $query[] = "spPostingsCountry = ?";
      $params[] = $Country;
      $types[] = "i";
    }
    if($State && $State != 0 && is_numeric($State)){
      $query[] = "spPostingsState = ?";
      $params[] = $State;
      $types[] = "i";
    }
    if($City && $City != 0 && is_numeric($City)){
      $query[] = "spPostingsCity = ?";
      $params[] = $City;
      $types[] = "i";
    }

    if($query){
      $query = " and ".implode(" and ", $query);
    }
    $mainQuery = $mainQuery." ".$query;
    
    if($ltoh){
      $mainQuery .= " order by CAST(spPostingPrice AS Float) ASC"; 
    }
    elseif($htol){
      $mainQuery .= " order by CAST(spPostingPrice AS Float) DESC";
    }
    else{
      $mainQuery .= " ORDER BY spPostingDate DESC";
    }
    
    //var_dump($mainQuery, $params);die;

    return selectQ($mainQuery, implode("", $types), $params);    	
	
	}

	function findRoomByAddress($category, $spPostingAddress, $sqlquerydate, $sqlquerydatetitle, $duration)
	{
		//echo $sqlquerydatetitle; die;
		return $this->ta->read(" WHERE t.spPostingVisibility=-1 
            AND t.spPostListing  like ('%Rent%')
            AND t.spCategories_idspCategory = " . $category, " 
            AND  spPostingAddress like ('%$spPostingAddress%')
			" . $sqlquerydate . "
			" . $sqlquerydatetitle . "
			AND spPostDurstion = " . $duration . "
            ORDER BY spPostingDate DESC");

		//echo $this->ta->sql;
		//die('+++++++++');
	}




	function findRoomByLongTerm($category, $spPostingAddress, $sqlquerydate, $sqlquerydatetitle, $duration)
	{
		//echo $sqlquerydatetitle; die;
		return $this->ta->read(" WHERE t.spPostingVisibility=-1 
            AND t.spPostListing  like ('%Rent%')
            AND t.spCategories_idspCategory = " . $category, " 
            AND  spPostingAddress like ('%$spPostingAddress%')
			" . $sqlquerydate . "
			" . $sqlquerydatetitle . "
			AND spPostDurstion = " . $duration . "
            ORDER BY spPostingDate DESC");

		//echo $this->ta->sql; die("--------------------------");
	}


	function findByStateCity($category, $txtaddres)
	{
		return $this->ta->read(" WHERE t.spPostingVisibility=-1 
            AND t.spCategories_idspCategory = " . $category, " 
			$txtaddres
			ORDER BY spPostingDate DESC");
	}

	function findRoomByStateCity($category, $sqlquerydate, $sqlquerydatetitle)
	{
		//echo $sqlquerydatetitle; die;
		return $this->ta->read(" WHERE t.spPostingVisibility=-1 
            AND t.spPostListing  like ('%Rent%')
            AND t.spCategories_idspCategory = " . $category . " 
			" . $sqlquerydate . "
			" . $sqlquerydatetitle . "
            ORDER BY spPostingDate DESC");
	}

	function searchMultiFielPro($txtAddress, $txtListid, $txtProType, $txtMinPrice, $txtMaxPrice)
	{
		if (!empty($txtAddress) && !empty($txtListid) && !empty($txtProType) && !empty($txtMinPrice) && !empty($txtMaxPrice)) {
			return $this->ta->read(" WHERE t.spPostingVisibility=-1 AND t.spCategories_idspCategory = 3 AND (sppostingaddress like ('%" . $txtAddress . "%')) OR (spPostListId  like ('%" . $txtListid . "%')) OR (spPostingPropertyType  like ('%" . $txtProType . "%')) AND (t.spPostingPrice BETWEEN $txtMinPrice and $txtMaxPrice) GROUP BY idspPostings order by sppostingdate desc");
		} else {
			return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spCategories_idspCategory = 3 AND (sppostingaddress like ('%" . $txtAddress . "%')) OR (spPostingPropertyType = like ('%" . $txtProType . "%')) GROUP BY idspPostings order by sppostingdate desc");
		}
	}

	//    function mycatProduct($catid, $pid){
	//     return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $pid . " AND t.spCategories_idspCategory = $catid", "AND t.spPostingVisibility = -1 AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
	// }

	function mycatProduct($catid, $pid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $pid . " AND t.spCategories_idspCategory = $catid", "AND t.spPostingVisibility = -1 ORDER BY spPostingDate DESC");
	}

	function readCustomPostFilter($postid, $fieldName, $filter)
	{
		return $this->ta->read("WHERE spPostings_idspPostings = $postid AND spPostFieldName = '$fieldName' AND spPostFieldValue = 'Sell' AND spPostFieldIsFilter = '$filter'");
	}

	function getAgentList($category, $pid)
	{
		return $this->ta->read(" t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category, "AND t.spProfiles_idspProfiles = $pid  ORDER BY spPostingDate DESC");
	}

	function showAllProperty($category, $type, $defcountry, $defstate, $defcity)
	{

    $stateQuery = !empty($defstate) ? " AND t.spPostingsState =$defstate "  : "";
		if($defcity){
			return $this->ta->read("where t.sppostingvisibility = -1 and  t.spPostingPropStatus='Active' AND t.spPostingsCountry =$defcountry  $stateQuery ORDER BY CASE WHEN t.spPostingsCity = '$defcity' THEN 0 ELSE 1 END ");
	//	echo $this->ta->sql; die("+++++++"); 
	}else{
		 return $this->ta->read("where t.sppostingvisibility = -1 and  t.spPostingPropStatus='Active'  AND t.spPostingsCountry =$defcountry $stateQuery ");
		//echo $this->ta->sql; die("+++++++"); 
	}

	}


	function showAllPropertyviewall($category, $type, $defcountry, $defstate)
	{

		// if($defcity){
		//   return $this->ta->read("where t.sppostingvisibility = -1 and  t.spPostingPropStatus='Active' AND flag_status=2 AND t.spPostListing = '$type' AND t.spPostingsCountry =$defcountry AND t.spPostingsState =$defstate  AND t.spPostingsCity=$defcity ORDER BY idspPostings DESC");
		//  echo $this->ta->sql; die("+++++++"); 
	//}else{
		 return $this->ta->read("where t.sppostingvisibility = -1 and  t.spPostingPropStatus='Active' AND flag_status=2 AND t.spPostListing = '$type' AND t.spPostingsCountry =$defcountry AND t.spPostingsState =$defstate  ORDER BY idspPostings DESC");
		//echo $this->ta->sql; die("+++++++"); 
	//}

	}

	function showAllAdd($category, $type, $defcountry, $defstate, $defcity)
	{

		if($defcity){
		  return $this->ta->read("where t.sppostingvisibility = -1 and  t.spPostingPropStatus='Active' AND flag_status=2 AND t.spPostListing = '$type' AND t.spPostingsCountry =$defcountry AND t.spPostingsState =$defstate  AND t.spPostingsCity=$defcity ORDER BY idspPostings DESC LIMIT 4");
		 echo $this->ta->sql; die("+++++++"); 
	}else{
		 return $this->ta->read("where t.sppostingvisibility = -1 and  t.spPostingPropStatus='Active' AND flag_status=2 AND t.spPostListing = '$type' AND t.spPostingsCountry =$defcountry AND t.spPostingsState =$defstate  ORDER BY idspPostings DESC LIMIT 4");
		echo $this->ta->sql; die("+++++++"); 
	}

	}

	function showAllPropertylimit($category, $type, $start, $limit)
	{
		return $this->ta->read("where t.sppostingvisibility = -1 and t.spCategories_idspCategory = $category  AND t.spPostListing = '$type' AND t.spPostingPropStatus='Active'  ORDER BY idspPostings DESC  LIMIT " . $start . ", " . $limit . "");
	}

	function showAllPropertybytype($proptype, $defcountry, $defstate, $defcity)
	{
		return   $this->ta->read("where t.spPostingPropertyType = '$proptype' AND t.spPostingAddress LIKE '%$defcountry%' AND t.spPostingAddress LIKE '%$defstate%'  AND t.spPostingAddress LIKE '%$defcity%'");
	}


	function hidecomment($postid)
	{
		return $this->ta->update(array("sppostingscommentstatus" => 0), "WHERE idspPostings ='" . $postid . "'");
	}


	function allowcomment($postid)
	{
		return $this->ta->update(array("sppostingscommentstatus" => 1), "WHERE idspPostings ='" . $postid . "'");
	}

	function businesspost($profileid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid);
	}

	function totalview($postid, $total)
	{
		return $this->ta->update(array("sppostingsViews" => $total), "WHERE idspPostings ='" . $postid . "'");
	}

	function year()
	{
		//year(sppostingsTransactionDate)
		return $this->ta->read("WHERE spPostingsBought = 1", "GROUP BY  year(sppostingsTransactionDate)");
	}

	function categoryrevanue($month)
	{
		return $this->ta->read("WHERE month(sppostingsTransactionDate)=" . $month . " AND spPostingsBought = 1", "GROUP BY spCategories_idspCategory", "sum(spPostingPrice) as sum , spCategories_idspCategory");
	}

	function monthlyrevanue($year)
	{
		return $this->ta->read("WHERE year(sppostingsTransactionDate) =" . $year, "GROUP BY sppostingsTransactionDate", "sum(spPostingPrice) as sum , sppostingsTransactionDate");
	}

	function updatevisibility($postid, $visibility)
	{
		return $this->ta->update(array("spPostingVisibility" => $visibility), "WHERE idspPostings ='" . $postid . "'");
	}

	//deactive all post
	function profilePostDeactive($pid)
	{
		// echo $pid;
		// exit;
		$sql = $this->ta->update(array("spPostingVisibility" => "1"), "WHERE spProfiles_idspProfiles ='" . $pid . "'");
		echo $sql;
		exit;
	}

	//Active all post
	function profilePostActive($pid)
	{
		return $this->ta->update(array("spPostingVisibility" => "-1"), "WHERE spProfiles_idspProfiles ='" . $pid . "'");
	}


	function readJobSearch($title, $loc)
	{

		if ($title != '' and $loc != '') {

			return $this->ta->read(" WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $title . "%') AND  t.spPostingLocation like ('%" . $loc . "%')   AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
		} elseif ($title != '' and $loc == '') {


			return $this->ta->read(" WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $title . "%')   AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
			# code...
		} elseif ($title == '' and $loc != '') {
			# code...
			return $this->ta->read(" WHERE t.spPostingVisibility = -1 AND  t.spPostingLocation like ('%" . $loc . "%')   AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
		}
	}


	function post($data)
	{
		return $this->ta->create($data);
		//echo $this->ta->sql;
	}

	function createservice($title, $notes, $city, $country, $pid, $phone)
	{
		//$postid = $p->create(array("spPostingTitle" => $data["businesssubcategory_"] ,"spPostingNotes" => $data["spProfileAbout"] ,"spPostingVisibility" => -1 ,"spCategories_idspCategory" => 7 ,"spPostingsCity" => $data["spProfilesCity"] , "spPostingsCountry" =>$data["spProfilesCountry"], "spProfiles_idspProfiles" => $pid));
		$expirydate = date('Y-m-d', strtotime("+30 days"));

		$postid = $this->ta->create(array("spPostingTitle" => $title, "spPostingNotes" => $notes, "spPostingVisibility" => -1, "spCategories_idspCategory" => 7, "spPostingsCity" => $city, "spPostingsCountry" => $country, "spProfiles_idspProfiles" => $pid, "spPostingExpDt" => $expirydate, "spPostingPhone" => $phone));
		return $postid;
	}

	function readPrivate($profileid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
	}

	function readActive($profileid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid . " AND t.spPostingVisibility >= 0");
	}

	function readPublic($profileid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $profileid . " AND t.spPostingVisibility= -1");
	}

	function read($pid)
	{
		return $this->ta->read("WHERE t.idspPostings = " . $pid . " ");
	}

	function update($pid, $data)
	{
		$this->ta->update($pid, $data);
		//echo  $this->ta->sql; die("-----------------");  
	}

	// DELETE POSTINGS
	function remove($postid)
	{
		$this->ta->remove("WHERE t.idspPostings = " . $postid);
	}


	// ================dashboard
	// TRASH POST
	function trashpost($postid)
	{
		$this->ta->update(array("spPostingVisibility" => -3), "WHERE t.idspPostings = " . $postid);
	}


	// RESTORE POST
	function trashRestorepost($postid)
	{
		$this->ta->update(array("spPostingVisibility" => -1), "WHERE t.idspPostings = " . $postid);
	}


	function myTrashPost($pid, $catId)
	{
	}
	// =========================

	function find_apartment($category, $prop_type, $country, $state, $city)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category . " AND t.spPostingPropertyType = 'Condo' AND t.spPostingsCountry=" . $country . " AND t.spPostingsState=" . $state . " AND t.spPostingsCity=" . $city . " ORDER BY spPostingDate DESC");
	}

	function find_detached_houses($category, $prop_type, $country, $state, $city)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category . " AND t.spPostingPropertyType = 'Detached Houses' AND t.spPostingsCountry=" . $country . " AND t.spPostingsState=" . $state . " AND t.spPostingsCity=" . $city . " ORDER BY spPostingDate DESC");
	}

	function find_duplexes($category, $prop_type, $country, $state, $city)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category . " AND t.spPostingPropertyType = 'Duplex' AND t.spPostingsCountry=" . $country . " AND t.spPostingsState=" . $state . " AND t.spPostingsCity=" . $city . " ORDER BY spPostingDate DESC");
	}

	function find_town_houses($category, $prop_type, $country, $state, $city)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category . " AND t.spPostingPropertyType = 'Town House' AND t.spPostingsCountry=" . $country . " AND t.spPostingsState=" . $state . " AND t.spPostingsCity=" . $city . " ORDER BY spPostingDate DESC");
	}

	function find_land($category, $prop_type, $country, $state, $city)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category . " AND t.spPostingPropertyType = 'Land/lot' AND t.spPostingsCountry=" . $country . " AND t.spPostingsState=" . $state . " AND t.spPostingsCity=" . $city . " ORDER BY spPostingDate DESC");
	}


	//get all post that i have to post "SELL"
	function myAllSellReal($category, $pid, $type)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category . " AND t.spProfiles_idspProfiles = " . $pid . " AND t.spPostListing= 'Sell' AND t.spPostingPropStatus = 'Active'  ORDER BY spPostingDate   DESC");
	}

	//get all rent entire place property
	function myAllRentEntire($category, $pid, $type)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostListing = '" . $type . "' AND t.spRoomRent = '" . $defaultType . "' AND  t.spCategories_idspCategory = " . $category, " AND t.spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
	}

	//get all active property
	function myAllSellActiveProperty($category, $pid, $type)
	{
	  $pid = $this->ta->escapeString($pid);
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostListing = '" . $type . "' AND t.spCategories_idspCategory = " . $category . " AND t.spProfiles_idspProfiles = " . $pid . " ORDER BY spPostingDate DESC");
		//echo $this->ta->sql;
		//die("++++");
	}

	function myAllSellActiveProperty_1($pid, $type)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostListing = '" . $type . "' AND t.spProfiles_idspProfiles = " . $pid . " AND (t.spPostingPropStatus = 'Active' OR t.spPostingPropStatus = '' OR t.spPostingPropStatus IS NULL) ORDER BY spPostingDate DESC");
		//echo $this->ta->sql;
		//die("++++");
	}

  function myAllSellActiveProperty_2($pid, $type)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostListing = '" . $type . "' AND t.spProfiles_idspProfiles = " . $pid . " AND t.spPostingPropStatus = 'Expired' ORDER BY spPostingDate DESC");
		//echo $this->ta->sql;
		//die("++++");
	}

	function myAllSellActiveProperty_3($pid, $type)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostListing = '" . $type . "' AND t.spProfiles_idspProfiles = " . $pid . " AND t.spPostingPropStatus = 'Sold' ORDER BY spPostingDate DESC");
		//echo $this->ta->sql;
		//die("++++");
	}

	function myRentalProperty($category, $pid, $type)
	{
		return	  $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingPropStatus = 'Active' AND t.spCategories_idspCategory = " . $category . " AND t.spProfiles_idspProfiles = " . $pid . " AND t.spPostListing = 'Rent' ORDER BY spPostingDate DESC");
	}

	function myPropertyWithType($category, $pid, $type, $defaultType)
	{
		
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostListing = '" . $type . "' AND t.spRoomRent = '" . $defaultType . "' AND  t.spCategories_idspCategory = " . $category, " AND t.spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
		//echo $this->ta->sql;
	}


	function myPropertyWithTyperent_entire($category, $pid, $type, $defaultType)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostListing = '" . $type . "' AND t.spRoomRent = '" . $defaultType . "' AND  t.spCategories_idspCategory = " . $category, " AND t.spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
		//echo $this->ta->sql;
	}

	function checkout($postid, $buyerid)
	{
		return $this->ta->update(array("spPostingsBuyerid" => $buyerid, "spPostingsBought" => 1, "sppostingsTransactionDate" => date("Y-m-d")), "WHERE idspPostings ='" . $postid . "'");
	}

	function wholesaleFinished($postid)
	{
		return $this->ta->update(array("spPostingsBought" => 3), "WHERE idspPostings ='" . $postid . "'");
	}

	function accepbid($postid, $bidderid)
	{
		return $this->ta->update(array("spPostingsBuyerid" => $bidderid, "spPostingsBought" => 2), "WHERE idspPostings ='" . $postid . "'");
	}
	//project for freelancer completed or cancel
	function projectStatus($postid, $spPostingStatus)
	{
		return $this->ta->update(array('spPostingsStatus' => $spPostingStatus), "WHERE idspPostings = '$postid'");
	}
	//project for freelancer completed or cancel
	function cancelprojectStatus($postid, $spPostingStatus, $canceldesc)
	{
		return $this->ta->update(array('spPostingsStatus' => $spPostingStatus, 'spPostingsCancelDesc' => $canceldesc), "WHERE idspPostings = '$postid'");
	}
	//chek project status is completed or canceld
	function chkProjectStatus($postid)
	{
		return $this->ta->read("WHERE idspPostings = '$postid' AND spPostingsStatus != ' '");
	}


	//client freelancer project
	function client_publicpost($catid, $clientid)
	{
		return $this->ta->read("WHERE t.spPostingVisibility=-1 AND spCategories_idspCategory  = " . $catid, " AND spProfiles_idspProfiles = '$clientid' AND spPostingsStatus = '' ORDER BY spPostingDate DESC");
	}
	//successfull project in freelancer
	function success_publicpost($catid, $clientid)
	{
		return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $catid, " AND t.idspProfiles = '$clientid' AND spPostingsStatus = 'Completed' ORDER BY spPostingDate DESC");
	}

	//my project detail
	function singletimelines($postid)
	{
        $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.idspPostings = " . $postid . "");
	}
	//archive project which is completed or canceled
	function archiveprojed($catid, $pid)
	{
		//return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
		return $this->ta->read("WHERE spCategories_idspCategory  = " . $catid . " AND spProfiles_idspProfiles = '$pid' AND spPostingsStatus != ''");
	}
	//post complete
	function completeProject($postid)
	{
		return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND spPostingsStatus = 'Completed'");
	}
	//my all freelancer projects
	function myAllProject($catid, $pid)
	{
		return $this->ta->read("WHERE t.spPostingVisibility=-1 AND spCategories_idspCategory  = " . $catid, " AND spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
	}
	//my complete projects
	function myCmpPro($catid, $pid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $pid . " AND spCategories_idspCategory = $catid AND spPostingsStatus = 'Completed'");
	}
	//my all project where i bid
	function myBidProject($catid, $pid)
	{
		return $this->ta->read("INNER JOIN sppostfield AS d ON t.idspPostings = d.spPostings_idspPostings where t.sppostingvisibility=-1 and t.spCategories_idspCategory = $catid AND  d.spPostFieldBidFlag = 1 AND t.spProfiles_idspProfiles != $pid AND d.spProfiles_idspProfiles = $pid AND t.spPostingsStatus != 'Completed' GROUP BY idspPostings ORDER BY spPostingDate DESC");
	}

	function myAppliedJob($pid)
	{
		return $this->ta->read("INNER JOIN sppostings_has_spprofiles AS s ON t.idspPostings = s.spPostings_idspPostings WHERE s.spProfiles_idspProfiles = $pid AND t.sppostingvisibility = -1 and t.spCategories_idspCategory = 2 ORDER BY spPostingDate DESC");
	}


	//my profile drafts
	function myProfileDraftFreelancer($category, $pid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spPostingVisibility= 0 AND t.spCategories_idspCategory = $category", "ORDER BY spPostingDate DESC");
	}

	function activeprevpost($postid)
	{
		return $this->ta->update(array("spPostingVisibility" => "-1"), "WHERE idspPostings ='" . $postid . "'");
	}


	function grouptimelines($gid)
	{
		return $this->ta->read("WHERE spcategories_idspcategory = 17 AND t.spPostingVisibility = " . $gid, "ORDER BY spPostingDate DESC");
	}

	function globaltimelinesProfile($start, $pid)
	{
		//level-1
		// return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
		//level-2

		return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select spPostings_idspPostings from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");

		// LAST QUERY WITHOUT CATEGORY (14-MAY-19)
		//return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17 OR idspCategory = 9)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");

		//return $this->ta->read("INNER JOIN spposthide AS h ON t.idspPostings != h.spPostings_idspPostings WHERE h.spProfiles_idspProfiles = $pid AND (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
	}


	function globaltimelinesProfileapi($offset, $limit, $pid)
	{

		return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spprofiles_idspprofiles = " . $pid . " or t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 or spProfiles_idspProfiles = " . $pid . " AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select timelineid from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= '" . $start . "'", " ORDER BY spPostingDate DESC LIMIT " . $offset . ", " . $limit . "");
	}

	function globaltimelinesProfiletimeline($start, $pid)
	{
		//level-1
		// return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
		//level-2

		// return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 ) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select spPostings_idspPostings from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= ".$start."", "ORDER BY spPostingDate DESC");
		return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 or spProfiles_idspProfiles = " . $pid . " AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select timelineid from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= '" . $start . "'", "ORDER BY spPostingDate DESC");
		// LAST QUERY WITHOUT CATEGORY (14-MAY-19)
		//return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17 OR idspCategory = 9)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");

		//return $this->ta->read("INNER JOIN spposthide AS h ON t.idspPostings != h.spPostings_idspPostings WHERE h.spProfiles_idspProfiles = $pid AND (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
	}


	function offsetglobaltimelinesProfiletimeline($start, $pid, $offset)
	{
		//level-1
		// return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
		//level-2

		// return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 ) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select spPostings_idspPostings from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= ".$start."", "ORDER BY spPostingDate DESC");
		return $this->ta->read("WHERE (spcategories_idspcategory = 16 OR spcategories_idspcategory = 17 OR spcategories_idspcategory = 9 OR spcategories_idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spprofiles_idspprofiles = " . $pid . " or t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 or spProfiles_idspProfiles = " . $pid . " AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select timelineid from share WHERE spShareToWhom = " . $pid . " )  OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) ) AND t.spPostingDate >= '" . $start . "'", "ORDER BY spPostingDate DESC Limit 0," . $offset);
		// LAST QUERY WITHOUT CATEGORY (14-MAY-19)
		//return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17 OR idspCategory = 9)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");

		//return $this->ta->read("INNER JOIN spposthide AS h ON t.idspPostings != h.spPostings_idspPostings WHERE h.spProfiles_idspProfiles = $pid AND (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
	}
	/*old?09/06/2020*/
	function allgrouptimelinesPost($postid)
	{
		return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND t.spcategories_idspcategory = 16");
	}


	function readtimelines($pid)
	{
		return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spcategories_idspcategory = 16 AND t.spProfiles_idspProfiles =" . $pid . " ORDER BY spPostingDate DESC LIMIT 12");
	}
	/* function allgrouptimelinesPost($postid,$groupid) {
			return $this->ta->read("WHERE t.idspPostings = " .$postid. " or t.spPostingVisibility = " .$groupid. " AND  t.spcategories_idspcategory = 16");
		}*/
	function singletimelinespost($postid)
	{
		return $this->ta->read("WHERE t.idspPostings = " . $postid . " AND t.spcategories_idspcategory = 16");
	}

	//JOB BOARD limit ten
	function publicpost_jobBoard($limit, $category)
	{
		return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE() AND t.spCategories_idspCategory = " . $category, "ORDER BY spPostingDate DESC LIMIT $limit");
	}

	// read total job which is open
	function readOpenJobs($pid)
	{
		return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = 2 AND t.spProfiles_idspProfiles = $pid AND t.spPostingExpDt >= CURDATE()");
	}

	//ALL JOBS WHICH IS SHOW
	function jobBoard_post($category, $pid)
	{
		return $this->ta->read(" WHERE t.spPostingVisibility=-1 AND t.spCategories_idspCategory = " . $category . "  AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
	}

	// MY TOTAL ACTIVE POST PROFILE VIESE
	function profileactivepost($catid, $pid)
	{
		return $this->ta->read("WHERE t.spCategories_idspCategory = $catid AND t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = $pid AND t.spPostingExpDt >= CURDATE()");
	}

	// MY EXPIRE PRODUCT
	function myExpireProduct($catId, $pid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = $pid AND t.spCategories_idspCategory = $catId AND t.spPostingVisibility != -3 AND t.spPostingExpDt < CURDATE() ORDER BY spPostingDate DESC");
	}

	// MY DRAFT PRODUCTS PROFILE AND CATEGORY WISE
	function readMyDraftprofile($catid, $pid)
	{
		//return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
		return $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spCategories_idspCategory = $catid AND t.spPostingVisibility = 0", "ORDER BY spPostingDate DESC");
	}
	//favourite events
	function event_favorite($category, $pid,$data1)
	{
		return $this->ta->read("WHERE idspPostings='$data1' ");
	}


	//my profile jobs
	function myProfilejobpost($pid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spPostingVisibility = -1 AND t.spCategories_idspCategory = 2 AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
	}

	//my save jobs
	function mySaveJob($category, $pid)
	{
		return $this->ta->read("INNER JOIN jobboard_save AS j ON t.idspPostings = j.spPostings_idspPostings WHERE j.spProfiles_idspProfiles =" . $pid . " AND t.spPostingVisibility = -1 AND j.save_status = 1 AND t.spCategories_idspCategory = $category", "ORDER BY spPostingDate DESC");
	}

	//my drafts jobs 
	function myDraftJob($category, $pid)
	{
		return  $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spPostingVisibility = 0 AND t.spCategories_idspCategory = $category", "ORDER BY spPostingDate DESC");
	}

	//my rent rooms spPostingsState
	function myRentRooms($City, $State, $Country)
	{
		return $this->ta->read("WHERE t.spPostingsCity =" . $City . " AND t.spRoomRent='Rent A Room' AND t.spPostingVisibility = -1 AND t.spPostingsState = $State AND t.spPostingsCountry = $Country", "ORDER BY spPostingDate DESC");
		 //echo $this->ta->sql;
	}

	function myEnquery($category, $pid)
	{
		return $this->ta->read("INNER JOIN realenquiry as r on t.idsppostings = r.spposting_idspposting WHERE t.sppostingvisibility = -1 and t.spCategories_idspCategory = $category AND t.spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
	}

	function myflagPost($catid, $pid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles = $pid AND t.spCategories_idspCategory = $catid AND t.spPostingVisibility = 3 ORDER BY spPostingDate DESC ");
	}
	function spPostingDate($firstTime, $lastTime = '')
	{
		/*date_default_timezone_set('Asia/Karachi');*/
		//date_default_timezone_set('Asia/Kolkata');
		/*$timezone = date_default_timezone_get();
			date_default_timezone_set($timezone);*/

		if ($lastTime) {
			$now = new DateTime(date('Y-m-d h:i:s', strtotime($lastTime)));
		} else {
			$now = new DateTime(date('Y-m-d h:i:s'));
		}
		$then = new DateTime(date('Y-m-d h:i:s', strtotime($firstTime)));
		// print_r($then);
		$diff = $then->diff($now);
		$time_ago = array('years' => $diff->y, 'months' => $diff->m, 'days' => $diff->d, 'hours' => $diff->h, 'minutes' => $diff->i, 'seconds' => $diff->s);
		// print_r($time_ago);
		if ($time_ago['years'] > 0) {
			return $time_ago['years'] . ' year ago';
		} else if ($time_ago['months'] > 0) {
			return $time_ago['months'] . ' month ago';
		} else if ($time_ago['days'] > 0) {
			if ($time_ago['days'] == 1) {
				return $time_ago['days'] . ' day ago';
			} else {
				return $time_ago['days'] . ' days ago';
			}
		} else if ($time_ago['hours'] > 0) {
			return $time_ago['hours'] . ' hours ago';
		} else if ($time_ago['minutes'] > 0) {
			return $time_ago['minutes'] . ' min ago';
		} else {
			return $time_ago['seconds'] . ' sec just now';
		}
	}






	function time_Ago($time)
	{

		// Calculate difference between current 
		// time and given timestamp in seconds 
		$diff     = time() - $time;

		// Time difference in seconds 
		$sec     = $diff;

		// Convert time difference in minutes 
		$min     = round($diff / 60);

		// Convert time difference in hours 
		$hrs     = round($diff / 3600);

		// Convert time difference in days 
		$days     = round($diff / 86400);

		// Convert time difference in weeks 
		$weeks     = round($diff / 604800);

		// Convert time difference in months 
		$mnths     = round($diff / 2600640);

		// Convert time difference in years 
		$yrs     = round($diff / 31207680);

		// Check for seconds 
		if ($sec <= 60) {
			return $sec . "seconds ago";
		}

		// Check for minutes 
		else if ($min <= 60) {
			if ($min == 1) {
				return "1 minute ago";
			} else {
				return $min . "minutes ago";
			}
		}

		// Check for hours 
		else if ($hrs <= 24) {
			if ($hrs == 1) {
				return "an hour ago";
			} else {
				return $hrs . "hours ago";
			}
		}

		// Check for days 
		else if ($days <= 7) {
			if ($days == 1) {
				return "Yesterday";
			} else {
				return $days . "days ago";
			}
		}

		// Check for weeks 
		else if ($weeks <= 4.3) {
			if ($weeks == 1) {
				return "a week ago";
			} else {
				return $weeks . "weeks ago";
			}
		}

		// Check for months 
		else if ($mnths <= 12) {
			if ($mnths == 1) {
				return "a month ago";
			} else {
				return $mnths . "months ago";
			}
		}

		// Check for years 
		else {
			if ($yrs == 1) {
				return "one year ago";
			} else {
				return $yrs . "years ago";
			}
		}
	}

	function to_time_ago($time)
	{

		// Calculate difference between current 
		// time and given timestamp in seconds 
		$diff = time() - $time;

		if ($diff < 1) {
			return 'less than 1 second ago';
		}

		$time_rules = array(
			12 * 30 * 24 * 60 * 60 => 'year',
			30 * 24 * 60 * 60       => 'month',
			24 * 60 * 60           => 'day',
			60 * 60                   => 'hour',
			60                       => 'minute',
			1                       => 'second'
		);

		foreach ($time_rules as $secs => $str) {

			$div = $diff / $secs;

			if ($div >= 1) {

				$t = round($div);

				return $t . ' ' . $str .
					($t > 1 ? 's' : '') . ' ago';
			}
		}
	}
	// =====THIS IS NEW TIME ZONE TESTING
	function get_timeago($ptime)
	{
		date_default_timezone_set('Asia/Karachi');

		$estimate_time = time() - $ptime;
		if ($estimate_time < 1) {
			return 'less than 1 second ago';
		}
		$condition = array(
			12 * 30 * 24 * 60 * 60  =>  'year',
			30 * 24 * 60 * 60       =>  'month',
			24 * 60 * 60            =>  'day',
			60 * 60                 =>  'hour',
			60                      =>  'minute',
			1                       =>  ' second'
		);
		foreach ($condition as $secs => $str) {
			$d = $estimate_time / $secs;
			if ($d >= 1) {
				$r = round($d);
				return '' . $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
			}
		}
	}

	function turnUrlIntoHyperlink($string)
	{
		//The Regular Expression filter
		$reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";

		// Check if there is a url in the text
		if (preg_match_all($reg_exUrl, $string, $url)) {
			// Loop through all matches
			foreach ($url[0] as $newLinks) {
				if (strstr($newLinks, ":") === false) {
					$link = 'http://' . $newLinks;
				} else {
					$link = $newLinks;
				}

				// Create Search and Replace strings
				$search  = $newLinks;
				$replace = '<a href="' . $link . '" title="' . $newLinks . '" target="_blank">' . $link . '</a>';

				$isyoutube = $this->videoType($newLinks);
				if ($isyoutube) {
					// ===SHOW YOUTUBE VIDEO
					parse_str(parse_url($newLinks, PHP_URL_QUERY), $my_array_of_vars);
					$string = str_replace($search, '', $string);
					$string .= '<iframe style="width: 100%;" height="315" src="https://www.youtube.com/embed/' . $my_array_of_vars['v'] . '" frameborder="0" allowfullscreen></iframe>';
				} else {
					// ===SHOW ONLY LINKS
					$string = str_replace($search, $replace, $string);
				}
			}
		}
		//Return result
		return $string;
	}
}
