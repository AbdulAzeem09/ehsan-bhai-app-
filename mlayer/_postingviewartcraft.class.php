<?php

class _postingviewartcraft {

// select t.idspPostings, ca.spCategoryname, t.spPostingtitle, t.spPostingDate, t.spPostingExpDt, t.spPostingNotes, t.spPostingPrice, s.idspProfiles, spPostingVisibility, p.spPostingPic
    // property declaration
    public $dbclose = false;
    private $conn;
    public $ta;
    public $music_video_user;

    function __construct() {
        //$this->ta = new _tableadapter("allpostdata");
        $this->music_video_user = new _tableadapter("spuser");
		$this->best = new _tableadapter("order_products_checkout");
		$this->ta = new _tableadapter("sppostingsartcraft");
		$this->taf = new _tableadapter("sppostingsartcraft");
		$this->tap = new _tableadapter("sppostingsartcraft");
		$this->tur = new _tableadapter("sppostingsartcraft");
        $this->tr = new _tableadapter("sppostingsartcraft");
        $this->sp = new _tableadapter("sprealstate");
        $this->art = new _tableadapter("artandcraft_favorites");
        $this->rb = new _tableadapter("room_booking");
        $this->ca = new _tableadapter("sppostingsartcraft");
       // $this->ta->join = "INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles";
        $this->sp->join = "INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles";
        $this->ta->dbclose = false;
        
        
    }
 
	function remove($pospic){
		$this->tr->remove("WHERE t.idspPostings = " . $pospic);
	}


    function art_favorite_list($pid)
    {
    	return $this->taf->read("INNER JOIN artandcraft_favorites as r on t.idsppostings = r.sppostings_idsppostings WHERE r.spprofiles_idspProfiles = ". $pid ." LIMIT 8");
     //echo $this->taf->sql;
     //die("nn");
    }


    function art_favorite_listreadmore($pid, $row, $rowperpage)
    {
    	return $this->taf->read("INNER JOIN artandcraft_favorites as r on t.idsppostings = r.sppostings_idsppostings WHERE r.spprofiles_idspProfiles = ". $pid ." LIMIT $row,$rowperpage ");
     //echo $this->taf->sql;
     //die("nn");
    }
	
    
    function art_favorite_list_num($pid)
    {
    	return $this->taf->read("INNER JOIN artandcraft_favorites as r on t.idsppostings = r.sppostings_idsppostings WHERE r.spprofiles_idspProfiles = ". $pid ." ");
     //echo $this->taf->sql;
     //die("nn");
    }






	function profile_listing($id){
		return $this->taf->read("WHERE spProfiles_idspProfiles = " . $id);
	}
	
	
    function search_artgallerynew($ad_type, $catid, $txtSearch) {
      $catid = $this->tr->escapeString($catid);
		if($ad_type==0){
	    return $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = $catid AND spPostingVisibility = -1", "ORDER BY spPostingDate DESC");		
		}
        return $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND ad_type = $ad_type AND t.spCategories_idspCategory = $catid AND spPostingVisibility = -1 ", "ORDER BY spPostingDate DESC");
    }  

    function search_artgallerynewsippingcharge($ad_type, $catid, $txtSearch,$sippingcharge) {
      $catid = $this->tr->escapeString($catid);
		if($ad_type==0){
    return    $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = $catid AND discountphoto>1  AND spPostingVisibility = -1 ", "ORDER BY spPostingDate DESC");			
	//echo 	$this->tr->sql;
		}
        return $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND ad_type = $ad_type AND t.spCategories_idspCategory = $catid AND sippingcharge=$sippingcharge AND spPostingVisibility = -1 ", "ORDER BY spPostingDate DESC");
    }  
	
	function search_artgippingcharge($ad_type, $catid, $txtSearch,$sippingcharge) {
	  $catid = $this->tr->escapeString($catid);
		if($ad_type==0){
    return    $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = $catid AND sippingcharge=$sippingcharge  AND spPostingVisibility = -1 ", "ORDER BY spPostingDate DESC");			
	//echo 	$this->tr->sql;
		}
        return $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND ad_type = $ad_type AND t.spCategories_idspCategory = $catid AND sippingcharge=$sippingcharge AND spPostingVisibility = -1 ", "ORDER BY spPostingDate DESC");
    }
	
	

    function search_artgallerynewshortprice($ad_type, $catid, $txtSearch, $spshort, $epshort) {
      $catid = $this->tr->escapeString($catid);
		if($ad_type==0){
		return  $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = $catid AND spPostingVisibility = -1  AND t.discountphoto BETWEEN $spshort AND $epshort  ", "ORDER BY spPostingDate DESC");
	
		}
       return  $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND ad_type = $ad_type AND t.spCategories_idspCategory = $catid AND spPostingVisibility = -1  AND t.discountphoto BETWEEN $spshort AND $epshort  ", "ORDER BY spPostingDate DESC");
  // echo $this->tr->sql; die;
  }

    function search_artgallerynewshortpricesippingcharge($ad_type, $catid, $txtSearch, $spshort, $epshort, $sippingcharge) {
      $catid = $this->tr->escapeString($catid);
		if($ad_type==0){
       return  $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = $catid AND spPostingVisibility = -1 AND sippingcharge = $sippingcharge AND t.discountphoto BETWEEN $spshort AND $epshort  ", "ORDER BY spPostingDate DESC");
			
		}
       return  $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND ad_type = $ad_type AND t.spCategories_idspCategory = $catid AND spPostingVisibility = -1 AND sippingcharge = $sippingcharge AND t.discountphoto BETWEEN $spshort AND $epshort  ", "ORDER BY spPostingDate DESC");
  // echo $this->tr->sql; die;
  }

    function search_artgallerynew12($ad_type, $catid, $txtSearch) {
		if($ad_type==0){
        return $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = $catid AND spPostingVisibility = -1 ", "ORDER BY spPostingDate DESC");
			
		}
        return $this->tr->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND ad_type = $ad_type AND t.spCategories_idspCategory = $catid AND spPostingVisibility = -1 ", "ORDER BY spPostingDate DESC");
    }
		
    function search_artgallerynew1($ad_type, $catNamee, $category, $txtSearch){
      $category = $this->ta->escapeString($category);
		if($ad_type==0){
       return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE  t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spPostingVisibility=-1 AND p.spPostFieldName = 'photos_' AND p.spPostFieldValue = '$catNamee' AND t.spCategories_idspCategory = " . $category, "ORDER BY RAND() ");
    //    echo $this->ta->sql;die("+++++++++++");
			
		}else{
       return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE  t.spPostingTitle  like ('%" . $txtSearch . "%') AND ad_type = $ad_type AND t.spPostingVisibility=-1 AND p.spPostFieldName = 'photos_' AND p.spPostFieldValue = '$catNamee' AND t.spCategories_idspCategory = " . $category, "ORDER BY RAND() ");
    //    echo $this->ta->sql;die("gggggg");
    }
	//echo $this->ta->sql;die("+++++++++++");  
	}
		
    function search_artgallerynew1sippingcharge($ad_type, $catNamee, $category, $txtSearch,$sippingcharge){
      $category = $this->ta->escapeString($category);
		if($ad_type==0){
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE  t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spPostingVisibility=-1 AND sippingcharge = $sippingcharge AND p.spPostFieldName = 'photos_' AND p.spPostFieldValue = '$catNamee' AND t.spCategories_idspCategory = " . $category, "ORDER BY RAND() ");
			
		}
		else{
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE  t.spPostingTitle  like ('%" . $txtSearch . "%') AND ad_type = $ad_type AND t.spPostingVisibility=-1 AND sippingcharge = $sippingcharge AND p.spPostFieldName = 'photos_' AND p.spPostFieldValue = '$catNamee' AND t.spCategories_idspCategory = " . $category, "ORDER BY RAND() ");
    }
	}	
    function search_artgallerynew1shortpricesippingcharge($ad_type, $catNamee, $category, $txtSearch, $spshort, $epshort,$sippingcharge){
      $category = $this->ta->escapeString($category);
		if($ad_type==0){
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE  t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spPostingVisibility=-1 AND AND sippingcharge = $sippingcharge p.spPostFieldName = 'photos_' AND p.spPostFieldValue = '$catNamee' AND t.spCategories_idspCategory = " . $category."  AND t.discountphoto BETWEEN $spshort AND $epshort ", "ORDER BY RAND() ");
			
		}
		else{
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE  t.spPostingTitle  like ('%" . $txtSearch . "%') AND ad_type = $ad_type AND t.spPostingVisibility=-1 AND AND sippingcharge = $sippingcharge p.spPostFieldName = 'photos_' AND p.spPostFieldValue = '$catNamee' AND t.spCategories_idspCategory = " . $category."  AND t.discountphoto BETWEEN $spshort AND $epshort ", "ORDER BY RAND() ");
  //echo $this->tr->sql; die; 
	}}
    function search_artgallerynew1shortprice($ad_type, $catNamee, $category, $txtSearch, $spshort, $epshort){
      $category = $this->ta->escapeString($category);
		if($ad_type==0){
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE  t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spPostingVisibility=-1 AND  p.spPostFieldName = 'photos_' AND p.spPostFieldValue = '$catNamee' AND t.spCategories_idspCategory = " . $category."  AND t.discountphoto BETWEEN $spshort AND $epshort ", "ORDER BY RAND() ");
			
		}else{
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE  t.spPostingTitle  like ('%" . $txtSearch . "%') AND ad_type = $ad_type AND t.spPostingVisibility=-1 AND  p.spPostFieldName = 'photos_' AND p.spPostFieldValue = '$catNamee' AND t.spCategories_idspCategory = " . $category."  AND t.discountphoto BETWEEN $spshort AND $epshort ", "ORDER BY RAND() ");
  //echo $this->ta->sql; die; 
	}}
	




	
    function bestselling($id) {
        return $this->best->read("WHERE t.spPostings_idspPostings = $id ");
    }
	
	    function publicpostartandcraft($start, $category = "*", $artcraft,$limit) {
        if ($category == "*") {
            return $this->ta->read("WHERE t.ad_type = $artcraft AND t.spPostingVisibility = -1 AND t.spCategories_idspCategory != 16 ", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC LIMIT $start, $limit");
		} else{
            return $this->ta->read("WHERE t.ad_type = $artcraft AND t.spPostingVisibility = -1 ORDER BY spPostingDate DESC LIMIT $start, $limit");
		}	}
	    function publicpostartandcraftcount($category = "*", $artcraft) {
        if ($category == "*"){ 
            return $this->ta->read("WHERE t.ad_type = $artcraft AND t.spPostingVisibility = -1 AND t.spCategories_idspCategory != 16 ");
        }else{
            return $this->ta->read("WHERE t.ad_type = $artcraft AND t.spPostingVisibility = -1 ");
		}}
    // THIS IS FROM START AND TESTING EACH AND EVERY MODULE ONE BY ONE AND REMOVE EXTRA DATA
    // THISS IS STORE TESTING.
    // STORE SHOW LIMIT WHICH USER SEND AND CATEGORY ON HOME
    function publicpost_store_pro($category, $limit) {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory = " . $category, "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC LIMIT $limit");
    }
    function getrelatedpro($pid) {
        return $this->ta->read(" where spProfiles_idspProfiles= ".$pid." AND saveasdraft=0 ORDER BY spPostingDate ASC");
    }
    // SHOW HOME PRODUCCT 
    function publicpost_random($category, $limit) {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $category, "ORDER BY t.idspPostings DESC LIMIT $limit");
    }
    // SHOW ALL PRODUCT ON HOME THROUGHT CATEGORY AND NO LIMIT
    function publicpost_all_post($category){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory = " . $category);
    }
    //my sote product with specefic profile
    function myStoreProduct($pid){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND d.idspProfiles = " . $pid . " AND t.idspCategory = 1", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }


    // =========DASHBOARD=================
    // ACTIVE PRODUCTS
    function myActPost($pid, $visilty, $catid){
        return $this->ta->read("WHERE t.spPostingVisibility = ".$visilty." AND d.idspProfiles = " . $pid . " AND t.idspCategory = $catid", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }
    // MY EXPIRE PRODUCT
    function myExpireProduct($catId, $pid){
		//echo $pid;
	 //$this->ta->read("WHERE saveasdraft = 0 ORDER BY spPostingDate DESC");
		
        return $this->tap->read("WHERE spProfiles_idspProfiles = $pid   AND t.spPostingExpDt < CURDATE() ORDER BY spPostingDate DESC");
		//echo $this->tap->sql;die;
    }
    // MY TRASH POSTING
    function myTrashPost($pid, $visilty, $catid){
        return $this->ta->read("WHERE t.spPostingVisibility = ".$visilty." AND d.idspProfiles = " . $pid . " AND t.idspCategory = $catid", "ORDER BY spPostingDate DESC");
    }
    // MY DRAFT PRODUCTS PROFILE AND CATEGORY WISE
    function readMyDraftprofile($catid, $pid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
        return $this->ta->read("WHERE d.idspProfiles =" . $pid . " AND t.idspcategory = $catid AND t.spPostingVisibility = 0", "ORDER BY spPostingDate DESC");
    }


    // =========DASHBOARD END=============
    // ======HOW MANY POST IS POSTED=====
    // chek posted how many post a profile in a day
    function chekposting($catid, $pid){
        $result = $this->ta->read("WHERE d.idspProfiles = $pid AND t.idspcategory = $catid AND cast(sppostingdate as Date) = cast(NOW() as Date) ");
        //echo $this->ta->sql;
        if ($result) {
            $totPost = $result->num_rows;
            if ($totPost >= 10) {
                // RETURN TRUE
                return true;
            }else{
                return false;
            }
        }else{

        }
    }
    // ============END===================



    // SHOW ALL PRODUCT BY VISIBITLTY AND MODULE WISE
    function myProductVis($pid, $visilty, $catid){
        return $this->ta->read("WHERE t.spPostingVisibility = ".$visilty." AND d.idspProfiles = " . $pid . " AND t.idspCategory = $catid", "ORDER BY spPostingDate DESC");
    }
    function myflagPost($catid, $pid){
        return $this->ta->read("WHERE d.idspProfiles = $pid AND t.spCategories_idspCategory = $catid AND t.spPostingVisibility = 3 ORDER BY spPostingDate DESC ");
    }
    // MY FLAG RESPONSE
    function myflagresponse($catid, $pid){
        return $this->ta->read("INNER JOIN flagpost AS f ON t.idspPostings = f.spPosting_idspPosting WHERE d.idspProfiles = $pid AND t.idspCategory = $catid");
    }
    // SHOW MY ALL CATEGORY WISE AND PROFILE WISE PRODUCT
    // function mycatProduct($catid, $pid){
    //     return $this->ta->read("WHERE d.idspProfiles = " . $pid . " AND t.idspCategory = $catid", "AND t.spPostingVisibility = -1 AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    // }
    function mycatProduct($catid, $pid){
        return $this->ta->read("WHERE d.idspProfiles = " . $pid . " AND t.idspCategory = $catid", "AND t.spPostingVisibility = -1 AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");    
    }
    // READ THE SINGLE POST THROUGH POST ID
  /*  function singletimelines($postid) {
        return $this->ta->read("WHERE t.idspPostings = " . $postid. " AND t.idspCategory = 16"  );
    }*/


    function singletimelinespost($postid) {
        return $this->ta->read("WHERE t.idspPostings = " . $postid." AND t.idspCategory = 16"  );
    }

     function singletimelines($postid) {
        $postid = $this->ta->escapeString($postid);
        return $this->ta->read("WHERE t.idspPostings = ".$postid." "); 
    }

     function singletimelinesspProfiles_idspProfiles($postid) {
        return $this->ta->read("WHERE t.spProfiles_idspProfiles = ".$postid." ");
    }

    function similarCourses($Course_type,$postid){
        return $this->ta->read("INNER JOIN sppostfield as pt ON pt.spPostings_idspPostings = t.idspPostings WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = 8 AND pt.spPostFieldName = 'trainingcategory_' AND pt.spPostFieldValue = '".$Course_type."' AND t.idspPostings != '".$postid."' ORDER BY t.idspPostings DESC");
    }

    function Course_type($postid){
        return $this->ta->read("INNER JOIN sppostfield as pt ON pt.spPostings_idspPostings = t.idspPostings WHERE idspPostings = '".$postid."' AND pt.spPostFieldName = 'trainingcategory_'","","pt.spPostFieldValue");
    }

    function findProject($txtSearch){
        return $this->ta->read("INNER JOIN sppostfield as pt ON pt.spPostings_idspPostings = t.idspPostings WHERE t.spPostingVisibility = -1  AND pt.spPostFieldName = 'spPostingCompany_' AND t.spCategories_idspCategory = 8  AND t.spPostingTitle LIKE  ('%" . $txtSearch . "%')ORDER BY t.idspPostings DESC;");
    }

     function singleRealPost($postid) {
        return $this->sp->read("WHERE t.idspPostings = ".$postid." ");
    }


    function single_product_detail($postid){
        return $this->sp->read("INNER JOIN sprealstatepics as p ON t.idspPostings = p.spPostings_idspPostings INNER JOIN sppostfield as pf ON t.idspPostings = pf.spPostings_idspPostings WHERE t.spCategories_idspCategory = 3  AND t.spPostingVisibility = -1 AND pf.spPostFieldValue = 'Rent A Room' AND t.idspPostings = ".$postid."");
    }


    function renter_id($postid){
        return $this->sp->read("INNER JOIN sprealstatepics as p ON t.idspPostings = p.spPostings_idspPostings INNER JOIN sppostfield as pf ON t.idspPostings = pf.spPostings_idspPostings WHERE t.spCategories_idspCategory = 3  AND t.spPostingVisibility = -1 AND pf.spPostFieldValue = 'Rent A Room' AND t.idspPostings = ".$postid."","","t.spProfiles_idspProfiles");
    }

     // MY DRAFT PRODUCTS
    function readMyDraft($pid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
    return $this->ta->read("WHERE spProfiles_idspProfiles = " . $pid . " AND spPostingVisibility = -1 AND saveasdraft = 1 ORDER BY spPostingDate DESC");
	//	echo $this->ta->sql;die;
    }

    
    // show all product if isset category BUT THIS IS AN OPTIONAL PRODUCT
	
	
	
	
    function publicpost( $category = "*") {
        if ($category == "*")
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory != 16 ", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC ");
        else
            return $this->ta->read("WHERE t.spPostingVisibility = -1 ORDER BY spPostingDate DESC ");
    }
	
	
	function getcount($id){
        return  $this->ca->read('where  spProfiles_idspProfiles = ' . $id);
        // echo $this->ca->sql;die('xxxxx');
    }
	
    function publicpostprofileid($postprofileid, $category = "*") {
        if ($category == "*")
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = $postprofileid AND t.spCategories_idspCategory = 13 ", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC ");
        else
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = $postprofileid ORDER BY spPostingDate DESC ");
    }
	
    function publicpostprofileidcount($postprofileid, $category = "*") {
        if ($category == "*")
            return $this->tur->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = $postprofileid AND t.spCategories_idspCategory = 13 ", "AND t.spPostingExpDt >= CURDATE() ");
        else
            return $this->tur->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = $postprofileid");
    }
	
	
	
    function publicpostallcount($category = "*") {
        if ($category == "*")
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory != 16 ");
        else
            return $this->ta->read("WHERE t.spPostingVisibility = -1");
    }
    //ALL WHOLESALE PROFILES
    function allwholeSaleProfiles(){
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings where t.sppostingvisibility=-1 and t.idspcategory = 1 and t.sppostingsflag = 0 AND f.spPostFieldValue = 'Wholesaler' GROUP BY t.idspProfiles");
    }
    // TOTAL NUMBER OF PRODUCT WHICH USER POST
    function publicpost_count($pid){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspcategory = 1 AND t.idspProfiles = " . $pid, "ORDER BY spPostingDate DESC");
    }
    // SHOW SINGLE FRIEND STORE
    function singlefriendstore($pid) {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspcategory = 1 AND t.idspProfiles =" . $pid, "ORDER BY spPostingDate DESC");
    }
    // SHOW ALL PRODUCT OF SINGLE USERS
    function singleFriendProduct($save, $pid, $catid){
	//	die('pppppppppppppppp');
		
		
	return $this->ta->read("WHERE saveasdraft = $save AND spProfiles_idspProfiles=$pid ORDER BY spPostingDate DESC");

		
        //return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspcategory = $catid AND t.idspProfiles = $pid ORDER BY spPostingDate DESC");
    }
    // SHOW ALL PRODUCT OF SINGLE USERS
    function singleFriendProductactiveart($save, $pid, $catid){
	//	die('pppppppppppppppp');
		
		
 return $this->ta->read("WHERE t.spPostingVisibility = -3 AND saveasdraft = $save AND spProfiles_idspProfiles=$pid ORDER BY spPostingDate DESC ");
//echo $this->ta->sql;die;
		
        // $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspcategory = $catid AND t.idspProfiles = $pid ORDER BY spPostingDate DESC");
		
    }
    // READ MY ALL PROFILE PRODUCT WHICH I POSTED NO METTER ITS ACTIVE OR IN ACTIVE OR DISABLED
    function readMyAllProfileProduct($catid, $pid){
        return $this->ta->read("WHERE t.idspcategory = $catid AND t.idspProfiles = $pid");
    }
	function readMyAllProfileProduct1($catid, $pid){
         return  $this->taf->read("WHERE spCategories_idspCategory = $catid AND spProfiles_idspProfiles = $pid");
		//echo $this->taf->sql;die;
    }
	function readMyProduct1(){
         return  $this->taf->read();
		//echo $this->taf->sql;die;
    }
	
    // MY TOTAL ACTIVE POST PROFILE VIESE
    function profileactivepost($catid, $pid){
        return $this->ta->read("WHERE t.idspcategory = $catid AND t.spPostingVisibility = -1 AND t.idspprofiles = $pid AND t.spPostingsBought IS NULL AND t.spPostingExpDt >= CURDATE()");
    }
    // ======YOUTUBE TIMELINE VIDEO AND LINK START
    function videoType($url) {
        if (strpos($url, 'youtube') > 0) {
            return 1;
        }else {
            return 0;
        }
    }
    function turnUrlIntoHyperlink($string){
        //The Regular Expression filter
        $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";

        // Check if there is a url in the text
        if(preg_match_all($reg_exUrl, $string, $url)) {
            // Loop through all matches
            foreach($url[0] as $newLinks){
                if(strstr( $newLinks, ":" ) === false){
                    $link = 'http://'.$newLinks;
                }else{
                    $link = $newLinks;
                }

                // Create Search and Replace strings
                $search  = $newLinks;
                $replace = '<a href="'.$link.'" title="'.$newLinks.'" target="_blank">'.$link.'</a>';

                $isyoutube = $this->videoType($newLinks);
                if ($isyoutube) {
                    // ===SHOW YOUTUBE VIDEO
                    parse_str( parse_url($newLinks, PHP_URL_QUERY ), $my_array_of_vars );
                    $string = str_replace($search, '', $string);
                    $string .= '<iframe style="width: 100%;" height="315" src="https://www.youtube.com/embed/'.$my_array_of_vars['v'].'" frameborder="0" allowfullscreen></iframe>';
                }else{
                    // ===SHOW ONLY LINKS
                    $string = str_replace($search, $replace, $string);
                }

            }
        }
        //Return result
        return $string;
    }
    // SHOW HOME PAGE CONTENT
    function post() {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory != 16 AND t.idspCategory != 5 ORDER BY RAND() limit 5");
    }

    // ======END






    function allpost($pid) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspProfiles =" . $pid);
    }

    function videolimit() {
        return $this->ta->read("WHERE t.idspCategory = 10 AND spPostingPrice IS NULL ORDER BY spPostingDate DESC LIMIT 12");
    }

    function video() {
        return $this->ta->read("WHERE t.idspCategory = 10 AND spPostingPrice IS NULL ORDER BY spPostingDate DESC");
    }

    function music() {
        return $this->ta->read("WHERE t.idspCategory = 14");
    }

    //for Admin details 
    function totalsoldpost() {
        return $this->ta->read("WHERE t.spPostingsBought = 1 OR t.spPostingsBought = 3");
    }

    function totalactivepost() {
        return $this->ta->read("WHERE t.spPostingsBought IS NULL AND t.spPostingExpDt >= CURDATE()");
    }

    function totalexpiredpost() {
        return $this->ta->read("WHERE t.spPostingsBought IS NULL AND t.spPostingExpDt < CURDATE()");
    }

    function totalposts() {
        return $this->ta->read("WHERE t.idspCategory != 16 AND t.idspCategory != 17");
    }

    
    //show only single profile data
    function getAllStoreProduct($pid){
        return $this->ta->read("INNER JOIN spprofiles_has_spgroup AS g ON g.spProfiles_idspProfiles = t.idspProfiles WHERE t.spPostingVisibility = -1 AND t.idspCategory = 1 AND t.idspProfiles =" . $pid, "GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }
    function readtimelines($pid) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = 16 AND t.idspProfiles =" . $pid." ORDER BY spPostingDate DESC LIMIT 12");
    }

    function soldpost($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought = 1 OR t.spPostingsBought = 3");
    }

    function activepost($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND t.spPostingExpDt >= CURDATE()");
    }

    function activeuserpost($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND t.spPostingExpDt >= CURDATE() AND t.idspCategory = 9");
    }

    function activesharepost($uid) {
        return $this->ta->read(" INNER JOIN spshare AS s ON t.idspPostings = s.spPostings_idspPostings WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND (t.idspCategory = 17 OR t.idspCategory = 16)");
    }

    function expiredpost($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND t.spPostingExpDt < CURDATE()");
    }

    function event($gid) {
        //return $this->ta->read("WHERE t.spPostingVisibility =".$gid. " AND t.idspCategory = 9");

        return $this->ta->read("WHERE (t.spPostingVisibility =" . $gid . " AND t.idspCategory = 9) OR (t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup =" . $gid . ") AND t.idspCategory = 9)");
    }

    function asemployer($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought = 2");
    }

    function asfreelancer($uid) {
        return $this->ta->read("WHERE t.spPostingsBought = 2 AND t.spPostingsBuyerid in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . ")");
    }

    //read active draft/group
    function readPrivate($uid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility > 0 AND t.spPostingExpDt >= CURDATE();");
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingVisibility > 0 AND t.spPostingExpDt >= CURDATE()", "ORDER BY spPostingDate DESC");
    }

    //Read Group sold
    function readGroupSold($uid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility > 0 AND t.spPostingsBought = 1");
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingVisibility > 0 AND t.spPostingsBought = 1", "ORDER BY spPostingDate DESC");
    }
   

    //read Expired group
    function readPrivateExpried($uid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility > 0 AND t.spPostingExpDt < CURDATE();");
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingVisibility > 0 AND t.spPostingsBought IS NULL AND t.spPostingExpDt < CURDATE()", "ORDER BY spPostingDate DESC");
    }

    // private Draft
    function readPrivateDraft($uid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingVisibility=0", "ORDER BY spPostingDate DESC");
    }

    // DEPENDENCY = spPostingsBought can be only 1 or null;
    function readPublic($uid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=-1 AND t.spPostingsBought IS NULL AND t.spPostingExpDt >= CURDATE()");
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingVisibility=-1 AND t.spPostingsBought IS NULL AND t.spPostingExpDt >= CURDATE()", "ORDER BY spPostingDate DESC");
    }

    //Read Public Sold
    function readPublicSold($uid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=-1 AND t.spPostingsBought = 1");
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingVisibility=-1 AND t.spPostingsBought = 1", "ORDER BY spPostingDate DESC");
    }
    
    //show category on single WHOLESALE post
    function single_wholesale($catName, $pid){
        return $this->ta->read("INNER JOIN sppostfield as f on t.idsppostings = f.spPostings_idspPostings where t.sppostingvisibility=-1 and t.idspcategory = 1 and t.sppostingsflag = 0 and t.idspprofiles ='$pid' and f.sppostfieldlabel = 'subcategory' AND f.sppostfieldvalue = '$catName' group by t.idsppostings");
    }
    //show category on single public post
    function single_publicpost($catName){
        return $this->ta->read("INNER JOIN sppostfield as f on t.idspPostings = f.spPostings_idspPostings where t.sppostingvisibility=-1 and t.idspcategory = 1 AND f.spPostFieldName = 'Subcategory_' AND f.spPostFieldValue = '$catName' AND t.spPostingExpDt >= CURDATE() GROUP BY t.idspPostings ORDER BY spPostingDate DESC");
    }
    //show category on single my store
    function single_my_post($catName, $uid){
        return $this->ta->read("INNER JOIN sppostfield as f on t.idspPostings = f.spPostings_idspPostings where t.sppostingvisibility=-1 and t.idspcategory = 1 AND f.spPostFieldLabel = 'Subcategory' AND d.spUser_idspUser = '$uid' AND f.spPostFieldValue = '$catName' GROUP BY t.idspPostings ORDER BY spPostingDate DESC");
    }
    //FILTERS ON STORE
    //public post condition filter
    function publicpost_condition($cond){
        return $this->ta->read("INNER JOIN sppostfield as p ON p.spPostings_idspPostings = t.idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = 1 AND p.spPostFieldValue = '$cond' AND t.spPostingExpDt >= CURDATE() GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }
    //MY ALL STORE CONDITION FILTER
    function myall_store_condition($uid, $cond) {
        return $this->ta->read("INNER JOIN sppostfield as p ON p.spPostings_idspPostings = t.idspPostings WHERE d.spUser_idspUser = " . $uid . " AND t.idspCategory =1 AND p.spPostFieldValue = '$cond' " , "GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }
    //group store CONDITION FILTER
    function all_group_store_condition($pid, $cond) {
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.idspCategory = 1 AND p.spPostFieldValue = '$cond' AND t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "GROUP By idspPostings ORDER BY spPostingDate DESC");
    }
    //friend store CONDITION FILTER
    function store_friends_Posting_condition($uid, $cond) {
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = 1 AND p.spPostFieldValue = '$cond' AND t.idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }
    //RETAIL store CONDITION FILTER
    function retailpost_condition($cond) {
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = 1 AND p.spPostFieldValue = '$cond' AND spPostingsFlag = 2 AND t.spPostingExpDt >= CURDATE()");
    }
    //PRICE RANGE START TO END
    //PUBLIC STORE PRICE RANGE FILTER
    function publicpost_prange($start, $end){
        return $this->ta->read("WHERE spPostingPrice BETWEEN $start AND $end AND t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }
    //MY STORE TO SHOW PRICE RANGE FILTER
    function myall_store_prange($uid, $start, $end) {
        return $this->ta->read("WHERE spPostingPrice BETWEEN $start AND $end AND d.spUser_idspUser = " . $uid . " AND t.idspCategory =1", "ORDER BY spPostingDate DESC");
    }
    //group store SHOW PRICE RANGE FILTER
    function all_group_store_prange($pid, $start, $end) {
        return $this->ta->read("WHERE spPostingPrice BETWEEN $start AND $end AND t.idspCategory = 1 AND t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "ORDER BY spPostingDate DESC");
    }
    //friend store SHOW PRICE RANGE FILTER
    function store_friends_Posting_prange($uid, $start, $end) {
        return $this->ta->read("WHERE spPostingPrice BETWEEN $start AND $end AND t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "ORDER BY spPostingDate DESC");
    }
    //retail store 
    function retailpost_prange($start, $end) {
        return $this->ta->read("WHERE spPostingPrice BETWEEN $start AND $end AND t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.spPostingExpDt >= CURDATE() AND spPostingsFlag = 2");
    }
    //GET ALL COUNTRY
    function getCountry(){
        return $this->ta->read("WHERE spPostingsCountry <> '' GROUP BY spPostingsCountry ORDER BY idspPostings ASC");
    }
    //PUBLIC STORE COUNTRY FILTER
    function publicpost_country($country){
        return $this->ta->read("WHERE spPostingsCountry = '$country' AND t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.spPostingExpDt >= CURDATE()  ORDER BY spPostingDate DESC");
        //return $this->ta->read("WHERE spPostingsCountry = '$country' AND t.spPostingVisibility=-1 AND t.idspCategory = 1  ORDER BY spPostingDate DESC");
    }
    //MY STORE COUNTRY FILTER
    function myall_store_country($uid, $country) {
        return $this->ta->read("WHERE spPostingsCountry = '$country' AND d.spUser_idspUser = " . $uid . " AND t.idspCategory =1", "ORDER BY spPostingDate DESC");
    }
    //group store COUNTRY FILTER
    function all_group_store_country($pid, $country) {
        return $this->ta->read("WHERE spPostingsCountry = '$country' AND t.idspCategory = 1 AND t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "ORDER BY spPostingDate DESC");
    }
    //friend store COUNTRY FILTER
    function store_friends_Posting_country($uid, $country) {
        return $this->ta->read("WHERE spPostingsCountry = '$country' AND t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "ORDER BY spPostingDate DESC");
    }
    //retail store COUNTRY FILTER
    function retailpost_country($country) {
        return $this->ta->read("WHERE spPostingsCountry = '$country' AND t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.spPostingExpDt >= CURDATE() AND spPostingsFlag = 2");
    }
    //Manufacturer post
    function manufacturePost(){
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings where t.sppostingvisibility=-1 and t.idspcategory = 1 and t.sppostingsflag = 0 AND f.spPostFieldValue = 'manufacturer' GROUP BY idspPostings");
    }
    //distributor post
    function distributorPost(){
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings where t.sppostingvisibility=-1 and t.idspcategory = 1 and t.sppostingsflag = 0 AND f.spPostFieldValue = 'distributors' GROUP BY idspPostings");
    }
    //PersonalSale post
    function personalSalePost(){
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings where t.sppostingvisibility=-1 and t.idspcategory = 1 and t.sppostingsflag = 0 AND f.spPostFieldValue = 'PersonalSale' GROUP BY idspPostings");
    }





    // =================FREELANCE MODULE======================
    // MY FREEELANCE FAAVOURITE PROJECT
    function freelance_favourite($category , $uid){
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.sppostingvisibility=-1 and t.idspcategory = $category AND spPostingsStatus != 'completed' AND idsppostings in(select sppostings_idsppostings from spfavorites where spuserid = $uid) GROUP by idspPostings ORDER BY spPostingDate DESC");
    }
    //my favourite post project
    function publicpost_favorite($category, $pid, $skill, $uid){
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.sppostingvisibility=-1 and t.idspcategory = $category AND spPostingsStatus != 'completed' AND idsppostings in(select sppostings_idsppostings from spfavorites where spuserid = $uid) GROUP by idspPostings ORDER BY spPostingDate DESC");
    }
    //client freelancer project
    function client_publicpost($catid, $pid){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory = " . $catid, " AND t.idspProfiles = '$pid' AND t.spPostingExpDt >= DATE(NOW()) ORDER BY spPostingDate DESC LIMIT 10");
    }
    //get total freelace project on left pan
    function total_post_freelancer($projectid) {
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings
         WHERE t.spPostingVisibility=-1 AND t.idspCategory = 5  AND p.spPostFieldName = 'spPostingCategory_' AND p.spPostFieldValue = '$projectid' GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }

    

    function total_post_freelancer_name($projectid){

        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = 5  AND p.spPostFieldName = 'spPostingCategory_' AND p.spPostFieldValue IN ($projectid) GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }





    
     //function total_post_freelancer_name($projectid){

        //return $this->ta->read("WHERE spPostFieldValue IN ($projectid)");

        /*return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = 5  AND p.spPostFieldName = 'spPostingCategory_' AND p.spPostFieldValue IN ($projectid) GROUP BY idspPostings ORDER BY spPostingDate DESC");*/
    //}

    
    /*function total_post_all_freelancer() {
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings 

        WHERE t.spPostingVisibility=-1 AND t.idspCategory = 5  AND p.spPostFieldName = 'spPostingCategory_' GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }
*/
    //projects show their skills
    function publicpost_skill($category, $pid, $skill) {
        //return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, " AND spPostingsStatus != 'completed' AND MATCH(spPostFieldValue) AGAINST('$skill' IN NATURAL LANGUAGE MODE) AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY GROUP by idspPostings ORDER BY spPostingDate DESC");
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, " AND spPostingsStatus != 'completed' AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY GROUP by idspPostings ORDER BY spPostingDate DESC");
    }
    //all jobs which is posted
    function alljobposted($category){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory = $category ");
    }
    //projects show their skills
    function jobBoard_skill($category, $pid, $skill) {
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, " AND MATCH(spPostFieldValue) AGAINST('$skill' IN NATURAL LANGUAGE MODE) AND t.spPostingVisibility = -1  AND t.spPostingExpDt >= CURDATE() AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY GROUP by idspPostings ORDER BY spPostingDate DESC");
    }
    //ALL JOBS WHICH IS SHOW
    function jobBoard_post($category, $pid) {
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, " AND t.spPostingVisibility = -1  AND t.spPostingExpDt >= CURDATE() AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY GROUP by idspPostings ORDER BY spPostingDate DESC");
    }
    //projects show by sorting
    function jobBoard_sortby($category, $pid, $sortby) {
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, " AND t.spPostingVisibility = -1  AND t.spPostingExpDt >= CURDATE()  GROUP by idspPostings ORDER BY $sortby");
    }
   
    //JOB BOARD limit ten
    function publicpost_jobBoard($limit, $category) {
       return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC LIMIT $limit");
    }
    //dashboard ajax based show jobs 
    function dashboar_jobBoard($limit, $category, $ids){
        return $this->ta->read("WHERE t.idspPostings IN ($ids) AND t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC LIMIT $limit");
    }
    //company search
    function publicpost_left_company($limit, $category) {
       return $this->ta->read("INNER JOIN spprofilefield AS p ON d.idspProfiles = p.spprofiles_idspProfiles WHERE t.spPostingVisibility=-1 AND p.spProfileFieldName = 'companyname_' AND t.idspCategory = " . $category, "GROUP by d.idspProfiles ORDER BY spPostingDate DESC LIMIT $limit");
    }
    // read total job which is open
    function readOpenJobs($pid){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory = 2 AND t.idspProfiles = $pid AND t.spPostingExpDt >= CURDATE()");
    }
    //read company size for job board through profile id
    function readCmpnySize($pid){
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.idspCategory = 2 AND t.idspProfiles = $pid AND p.spPostFieldName = 'spPostingCompanySize_' GROUP BY t.idspPostings");
    }
    //read company size for job board through post id
    function readPostCmpnySize($postid){
        return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.idspCategory = 2 AND t.idspPostings = $postid AND p.spPostFieldName = 'spPostingCompanySize_' GROUP BY t.idspPostings");
    }
    




    //job show on the bases of search
    function readJobSearch($category, $title, $city, $loc, $joblevel,$SalaryFrom, $SalaryTo){
        if($SalaryFrom != ''){
            return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings where t.sppostingvisibility = -1 AND p.spPostFieldName = 'spPostingSlryRngFrm_' AND p.spPostFieldValue >= '$SalaryFrom' and t.idspcategory = $category AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
        }else if($SalaryTo != ''){
            return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings where t.sppostingvisibility = -1 AND p.spPostFieldName = 'spPostingSlryRngTo_' AND p.spPostFieldValue <= '$SalaryTo' and t.idspcategory = $category AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
        }else if($title != '' AND $loc != '' AND $joblevel != ''){
            return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $title . "%') AND p.spPostFieldName = 'spPostingLocation_' AND p.spPostFieldValue = '$loc' OR p.spPostFieldName = 'spPostingJoblevel_' AND p.spPostFieldValue = '$joblevel' AND t.idspCategory = " . $category, " AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
        }else if($title != '' AND $city != ''){
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $title . "%') AND t.spPostingsCity  like ('%" . $city . "%') AND t.idspCategory = " . $category, " AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
        }else if($title != '' AND $loc != ''){
            return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $title . "%') AND p.spPostFieldName = 'spPostingLocation_' AND p.spPostFieldValue = '$loc' AND t.idspCategory = " . $category, " AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
        }else if($title != ''){
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $title . "%') AND t.idspCategory = " . $category, " AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
        }else if($city != ''){
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingsCity  like ('%" . $city . "%') AND t.idspCategory = " . $category, " AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
        }else if($loc != ''){
            return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND p.spPostFieldName = 'spPostingLocation_' AND p.spPostFieldValue = '$loc' AND t.idspCategory = " . $category, " AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
        }else if($joblevel != ''){
            return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND p.spPostFieldName = 'spPostingJoblevel_' AND p.spPostFieldValue = '$joblevel' AND t.idspCategory = " . $category, " AND t.spPostingExpDt >= CURDATE() GROUP by idspPostings ORDER BY spPostingDate DESC");
        }else{
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingExpDt >= CURDATE() AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
        }

    }
    //get month wise jobs
    function monthwise($year, $month){
        if($year != '' AND count($month) > 0){
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory = 2 AND ( $month ) AND year(t.spPostingDate) = $year  ORDER BY spPostingDate DESC");
        }else if($year != ''){
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingDate BETWEEN '$year-01-01' AND '$year-12-31' AND t.idspCategory = 2 ORDER BY spPostingDate DESC");
        }else{
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory = 2 ORDER BY spPostingDate DESC");
        }
        
    }
    //my profile jobs
    function myProfilejobpost($pid) {
        return $this->ta->read("WHERE d.idspProfiles =" . $pid . " AND t.spPostingVisibility = -1 AND t.idspCategory = 2 AND t.spPostingExpDt >= CURDATE()");
    }
    //my de-active jobs
    function myDeactiveProfilejob($pid){
        return $this->ta->read("WHERE d.idspProfiles =" . $pid . " AND t.idspCategory = 2 AND t.spPostingExpDt < CURDATE()");
    }
    //my drafts jobs 
    function myDraftJob($category, $pid){
        return $this->ta->read("WHERE d.idspProfiles =" . $pid . " AND t.spPostingVisibility = 0 AND t.idspCategory = $category", "ORDER BY spPostingDate DESC");
    }
    //my save jobs
    function mySaveJob($category, $pid){
        return $this->ta->read("INNER JOIN jobboard_save AS j ON t.idspPostings = j.spPostings_idspPostings WHERE j.spProfiles_idspProfiles =" . $pid . " AND t.spPostingVisibility = -1 AND j.save_status = 1 AND t.idspCategory = $category", "ORDER BY spPostingDate DESC");
    } 
    //FOR JOB-BOARD DASHBOARD
    //my all jobs which is active or not
    function myAllJobsPosted($category,$pid){
        return $this->ta->read("WHERE d.idspProfiles = $pid AND t.idspCategory = $category ORDER BY spPostingDate DESC");
    }
    //get all aplicants who aply on my jobs
    function getAllAplicant($category, $pid){
        return $this->ta->read("INNER JOIN sppostings_has_spprofiles AS h ON t.idspPostings = h.spPostings_idspPostings where d.idspprofiles = $pid and t.idspcategory = $category order by sppostingdate desc");
    }
    //get all aplicants who short listed
    function getAllShortList($category, $pid){
        return $this->ta->read("INNER JOIN freelance_shortlist AS f ON t.idspPostings = f.spPosting_idspPostings WHERE d.idspprofiles = $pid and t.idspcategory = $category order by sppostingdate desc");
    }
    //all my jobs which i have applied
    function myAppliedJob($pid){
        return $this->ta->read("INNER JOIN sppostings_has_spprofiles AS s ON t.idspPostings = s.spPostings_idspPostings WHERE s.spProfiles_idspProfiles = $pid AND t.sppostingvisibility = -1 and t.idspcategory = 2");
    }




    //order by asc or desc by price public post
    function publicpost_price($orderby){
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.spPostingExpDt >= CURDATE() ORDER BY t.spPostingPrice $orderby");
    }
    
    //show all public post of events
    function publicpost_event($category){
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
        //return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND t.spPostingVisibility=-1 AND t.spPostingExpDt < CURDATE()", "ORDER BY spPostingDate DESC");
    }
    //show all past events
    function pastEvent($category, $today, $pid){
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.idspCategory = $category AND f.spPostFieldName = 'spPostingEndDate_' AND f.spPostFieldValue < CURDATE() ORDER BY spPostingDate ASC ");
    }
    //show all drafts events
    function draftEvent($category){
        return $this->ta->read("WHERE t.spPostingVisibility = 0 AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
    }
    //show all my organizer id
    function getOrganzerPost($category, $pid){
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.idspCategory = " . $category, "AND f.spPostFieldName = 'spPostingEventOrgId_' AND f.spPostFieldValue = $pid GROUP by t.idspPostings ORDER BY spPostingDate DESC");
    }
    //show all agent listing
    function getAgentList($category, $pid){
        return $this->sp->read("where t.sppostingvisibility = -1 and t.spCategories_idspCategory = '".$category."'  AND t.spPostListing = 'sell' AND t.spProfiles_idspProfiles= '".$pid."' AND t.spPostingPropStatus='Active'   ORDER BY idspPostings DESC");
    }
    //show all my co-host posted id
    function getCoHostPost($category, $pid){
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.idspCategory = " . $category, "AND f.spPostFieldName = 'spPostingCohost_' AND f.spPostFieldValue = $pid GROUP by t.idspPostings ORDER BY spPostingDate DESC");
    }
    //show search events
    function searchEvent($category, $txttitle, $date, $catName, $loc) {
        if($category != '' AND $txttitle != '' AND $date != '' AND $catName != '' AND $loc != ''){
            return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $txttitle . "%') AND t.idspCategory = $category AND f.spPostFieldName = 'spPostingStartDate_' AND f.spPostFieldValue = '$date' ORDER BY spPostingDate DESC");
        }else if($category != '' AND $txttitle != '' AND $catName != ''){
            return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $txttitle . "%') AND t.idspCategory = $category AND f.spPostFieldName = 'eventcategory_' AND f.spPostFieldValue = '$catName' ORDER BY spPostingDate DESC");
        }else{
            return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $txttitle . "%') AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");    
        }
        
    }

    function publicpost_two_event(){
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = 9 ORDER BY RAND() LIMIT 2");
    }
    function publicpost_two(){
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = 1 ", "ORDER BY RAND() LIMIT 2");
    }
    //SEARCH VALUES ALL
    //PUBLIC POST SEARCH
    function search_publicpost($start, $category, $txtSearch) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
    }
    //MY ALL STORE SEARCCH
    function search_myall_store($uid, $txtSearch) {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.idspCategory =1", "ORDER BY spPostingDate DESC");
    }
    //All group store search
    function search_all_group_store($pid, $txtSearch) {
        return $this->ta->read("WHERE t.idspCategory = 1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "ORDER BY spPostingDate DESC");
    }
    //friend store SEARCH
    function search_store_friends_Posting($uid, $txtSearch) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('%" . $txtSearch . "%')  AND t.idspCategory = 1 AND t.idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "ORDER BY spPostingDate DESC");
    }

    //STORE OF THE MONTH
    //PUBLIC STORE
    function store_of_month($store, $uid, $pid){
        $catid = 1;
        $p = new _postfield;
        $q = new _postingview;
        $result = $p->readlabel($catid);
        //echo $p->ta->sql;
        if ($result != false){
            $catCount = 0;
            $catName = 0;
            $total = 0;
            while($row2 = mysqli_fetch_assoc($result)){
                if($row2['spPostFieldLabel'] == 'Subcategory'){
                    $values = $p->readvalues($catid, $row2['spPostFieldLabel']);
                    //echo $p->ta->sql;
                    if($values != false){
                        while($vals = mysqli_fetch_assoc($values)){
                            $categoryTitle = $vals['spPostFieldValue'];
                            if($store == 1){
                                //public store
                                $result3 = $q->single_publicpost($categoryTitle);
                                
                            }else if($store == 6){
                                //my post
                                $result3 = $q->single_my_post($categoryTitle, $uid);
                                
                            }else if($store == 5){
                                //group store
                                $result3 = $q->single_group_main_Posting($categoryTitle, $pid);

                            }else if($store == 4){
                                //friends store
                                $result3 = $q->single_store_friends_Posting($categoryTitle, $uid);
                            }else if($store == 2){
                                //retail store
                                $result3 = $q->single_retail_store($categoryTitle);
                            }

                            //count total and name
                            if($result3 != false){
                                $total = $result3->num_rows;
                                if($total > $catCount){
                                    $catCount = $total;
                                    $catName = $categoryTitle;
                                }
                            }

                        }
                    }
                }
            }
        } 
        return $catName;
        //$catCount
    }

//read public Expired
    function readPublicExpired($uid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=-1 AND t.spPostingExpDt < CURDATE();");
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingsBought IS NULL AND t.spPostingVisibility=-1 AND t.spPostingExpDt < CURDATE()", "ORDER BY spPostingDate DESC");
    }
    function readTrain($pid) {
        return $this->tr->read("INNER JOIN `sppostfield`as d ON d.spPostings_idspPostings = t.idspPostings WHERE d.spPostings_idspPostings = ".$pid."");
    }

    function readPro($pid) {
        return $this->ta->read("WHERE t.idspPostings = " . $pid, "ORDER BY spPostingDate DESC");
    }

    function read($pid) {
		//die('-------');
        return $this->sp->read("WHERE t.idspPostings = " . $pid, "ORDER BY spPostingDate DESC");
    }
    //show all single group store
    function single_group_Store($gid) {
        return $this->ta->read("WHERE spPostingVisibility =" . $gid, " AND idspCategory = 1 ORDER BY spPostingDate DESC");
    }
    function readPrivateStore($gid) {
        //return $this->ta->read("WHERE spPostingVisibility in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . ")", "ORDER BY spPostingDate DESC");
        //return $this->ta->read("WHERE spPostingVisibility in (select spGroup_idspGroup from spprofiles_has_spgroup where spProfiles_idspProfiles = " . $pid . ") or t.idspPostings in (select idspPostings from share where groupid in (select groupid from profile_has_group where profileid = pid))", "ORDER BY spPostingDate DESC");
        return $this->ta->read("WHERE spPostingVisibility =" . $gid, "ORDER BY spPostingDate DESC");
    }
    function single_group_main_Posting($catName, $pid){
        return $this->ta->read("inner join sppostfield as f on t.idsppostings = f.sppostings_idsppostings WHERE t.idspCategory = 1 AND f.sppostfieldlabel = 'subcategory' AND f.sppostfieldvalue = '$catName' AND t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "GROUP By idspPostings ORDER BY spPostingDate DESC");
    }
    //show group store from store own asc or desc
    function all_group_store_order_by($pid, $orderby) {
        return $this->ta->read("WHERE t.idspCategory = 1 AND t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "ORDER BY t.spPostingPrice $orderby");
    }
    //show group store from store own
    function all_group_store($pid) {
        return $this->ta->read("WHERE t.idspCategory = 1 AND t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }
    //show group store from store own randomly
    function all_group_store_random($pid) {
        return $this->ta->read("WHERE t.idspCategory = 1 AND t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "ORDER BY RAND()");
    }
    //show group store
    function readgroupshare($pid) {
        return $this->ta->read("WHERE  t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "ORDER BY spPostingDate DESC");
    }
    //SELLER PRODUCT SHOWN
    function seller_product($sellerid){
        return $this->ta->read("inner join sppostfield as f on t.idsppostings = f.sppostings_idsppostings where t.sppostingvisibility=-1 and t.idspprofiles ='$sellerid' AND idspCategory = 1 GROUP BY t.idspPostings ORDER BY RAND() LIMIT 3");
    }

    function friendsPublicPosting($uid) {
        //return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspProfiles in(select spProfiles_idspProfiles from spprofiles_has_spgroup where spGroup_idspGroup in (select  spGroup_idspGroup from spprofiles_has_spgroup where spProfiles_idspProfiles = " .$pid."))");
        //return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid."))) AND spUser_idspUser !=" .$uid);

        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory !=16 AND t.idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "ORDER BY spPostingDate DESC");
    }
    //friend store show home. asc or desc
    function store_friends_Posting_order_by($uid, $orderby) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "ORDER BY t.spPostingPrice $orderby");
    }
    //friend store show home.
    function store_friends_Posting($uid) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }
    //friend store show home randomly
    function store_friends_Posting_randm($uid) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "ORDER BY RAND()");
    }
    //friend store to chow category
    function single_store_friends_Posting($catName, $uid){
        return $this->ta->read("INNER JOIN sppostfield as f on t.idsppostings = f.sppostings_idsppostings WHERE f.sppostfieldlabel = 'subcategory' and f.sppostfieldvalue = '$catName' AND t.spPostingVisibility=-1 AND t.idspCategory = 1 AND t.idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }
    //retail single store of the month
    function single_retail_store($catName){
        return $this->ta->read("inner join sppostfield as f on t.idsppostings = f.sppostings_idsppostings where t.sppostingvisibility=-1 and t.idspcategory = 1 and f.sppostfieldlabel = 'subcategory' and f.sppostfieldvalue = '$catName' and sppostingsflag = 2 group by t.idsppostings");
    }

    function myallpost($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.idspCategory != 16", "ORDER BY spPostingDate DESC");
    }
    //MY ALL STORE TO SHOW RECORD asc or desc
    function myall_store_order_by($uid, $orderby) {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.idspCategory =1", "ORDER BY t.spPostingPrice $orderby");
    }
    //MY ALL STORE TO SHOW RECORD
    function myall_store($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.idspCategory =1", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }
    //MY ALL STORE TO SHOW RECORD RANDOMLY
    function myall_store_random($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.idspCategory =1", "ORDER BY RAND()");
    }
    
    //my store product active specefic profile
    function myStoreProduct_Active($pid){
        return $this->ta->read("WHERE d.idspProfiles = " . $pid . " AND t.idspCategory =1 AND t.spPostingExpDt <= DATE(NOW())", "ORDER BY spPostingDate DESC"); 
    }
    //my store product Inactive specefic profile
    function myStoreProduct_Inactive($pid){
        return $this->ta->read("WHERE d.idspProfiles = " . $pid . " AND t.idspCategory =1 AND t.spPostingExpDt > DATE(NOW())", "ORDER BY spPostingDate DESC"); 
    }
    function upcoming($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.idspCategory = 9");
    }
    // this is main chart of all product show by user
    function countPosts($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.idspCategory != 16 AND t.idspCategory != 17", "GROUP BY spCategoryname", "count(idspPostings) as count,spCategoryname");
    }
    // THIS IS MAIN CHART OF ALL PRODUCT SHOW BY PROFILE WISE
    function countPostsprofile($pid) {
        return $this->ta->read("INNER JOIN spcategories AS c ON t.idspCategory = c.idspCategory WHERE d.idspProfiles = " . $pid . " AND t.idspCategory != 16 AND t.idspCategory != 17 AND c.spCategoryStatus = 1", "GROUP BY spCategoryname", "count(idspPostings) as count,t.spCategoryname");
    }

    function myfavoritepost($uid) {
        return $this->ta->read("WHERE idspPostings in(select spPostings_idspPostings from spfavorites WHERE spUserid =" . $uid . ")", "GROUP BY spCategoryname", "count(idspPostings) as count,spCategoryname");
    }

    function myfavorite($uid) {
        return $this->ta->read("WHERE idspPostings in(select spPostings_idspPostings from spfavorites WHERE spUserid =" . $uid . ")", "ORDER BY spPostingDate DESC");
    }

    function timelines($uid) {
        return $this->ta->read("WHERE idspPostings in(select spPostings_idspPostings from spShare WHERE spShareToWhom in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . "))", "ORDER BY spPostingDate DESC");
    }

    

    function buypost($catid) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $catid . " AND spPostingsFlag = 1");
    }

    function sellpost($catid) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $catid . " AND spPostingsFlag = 0");
    }
    //retail store assc or desc
    function retailpost_order_by($orderby) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = 1 AND spPostingsFlag = 2 AND t.spPostingExpDt >= CURDATE() ORDER BY t.spPostingPrice $orderby");
    }
    //retail store show
    function retailpost($catid) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $catid . " AND t.spPostingExpDt >= CURDATE() AND spPostingsFlag = 2 AND t.spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC");
    }
    //retail store show randomly
    function retailpost_random($catid) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $catid . " AND spPostingsFlag = 2 ORDER BY RAND()");
    }
    //SINGLE PERSON WHOLESALE POSTING
    function mywholesellpost($pid, $catid) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $catid . " AND t.spPostingsFlag = 0 AND t.idspProfiles =" . $pid ." ORDER BY idspPostings DESC" );
        //return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $catid." AND t.spPostingsFlag = 0 AND d.spUser_idspUser =(select spUser_idspUser from spProfiles where idspProfiles = ".$pid.")");
    }
        //all_mywholesellpost

    function all_mywholesellpost($catid)
    {

       
      return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $catid . " AND t.spPostingExpDt >= CURDATE() AND spPostingsFlag = 0 AND t.spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC");
    }

    //ALL WHOLESALE POSTING
    function allwholesellpost(){
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings where t.sppostingvisibility=-1 and t.idspcategory = 1 and t.sppostingsflag = 0 AND f.spPostFieldValue = 'Wholesaler' GROUP BY idspPostings ORDER BY spPostingDate DESC ");
    }
    /* this is backup of old query on timeline form
    function globaltimelines($start, $uid) {
        
        //return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.")))","ORDER BY spPostingDate DESC");
        return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . " )) OR d.spUser_idspUser=" . $uid . ")", "ORDER BY spPostingDate DESC");
    }*/
    //order by ASC or DESc
    function globaltimelinesProfile_ordr($order, $pid){
        return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate $order");
    }
    //timeline show all
    //note here is category only 16 or 17 but main ny aik new add ki ha 9 for events
    function globaltimelinesProfile($start, $pid) {
        //level-1
        // return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
        //level-2

        return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17 OR idspCategory = 9 OR idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select spPostings_idspPostings from spShare WHERE spShareToWhom = " . $pid . " )  OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");
       
        // LAST QUERY WITHOUT CATEGORY (14-MAY-19)
        //return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17 OR idspCategory = 9)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", "ORDER BY spPostingDate DESC");

        //return $this->ta->read("INNER JOIN spposthide AS h ON t.idspPostings != h.spPostings_idspPostings WHERE h.spProfiles_idspProfiles = $pid AND (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
    }

     function globaltimelinesProfileapi($offset,$limit, $pid) {

        return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17 OR idspCategory = 9 OR idspcategory = 1)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR idspPostings in(select spPostings_idspPostings from spShare WHERE spShareToWhom = " . $pid . " )  OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL 7 DAY", " ORDER BY spPostingDate DESC LIMIT ".$offset.", ".$limit."");
       

    }
    //timeline show with limited time decide
    function globaltimelineDate($day, $pid) {
        if($day == 0){
            return $this->ta->read("WHERE (spCategories_idspCategory = 16 OR spCategories_idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");    
        }else{
            return $this->ta->read("WHERE (spCategories_idspCategory = 16 OR spCategories_idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ") AND t.spPostingDate >= DATE(NOW()) - INTERVAL $day DAY", "ORDER BY spPostingDate DESC");
        }
    }
    //pagingnation for gallery
    function pagingnation($start, $perpage, $pid){
        return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_has_spProfileFlag = 1 AND spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", " limit $start ,$perpage ");    

       

      /*  return $this->ta->read("INNER JOIN spfavorites AS f ON t.idspPostings = f.spPostings_idspPostings WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", " limit $start ,$perpage ");    */


    }

    //favourite post to all profile
    function globaltimelinesFavourite_ordr($order, $pid) {
        return $this->ta->read("INNER JOIN spfavorites AS f ON t.idspPostings = f.spPostings_idspPostings WHERE (spCategories_idspCategory = 16 OR spCategories_idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate $order");
    }
    //favourite post to all profile
    function globaltimelinesFavourite($start, $pid) {
        return $this->ta->read("INNER JOIN spfavorites AS f ON t.idspPostings = f.spPostings_idspPostings WHERE (spCategories_idspCategory = 16 OR spCategories_idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.spProfiles_idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.spProfiles_idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
    }
    //save post to all profile
    function globaltimelinesSavePost_ordr($order, $pid) {
        return $this->ta->read("INNER JOIN spsavepost AS s ON t.idspPostings = s.spPostings_idspPostings WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate $order");
    }
    //save post to all profile
    function globaltimelinesSavePost($start, $pid) {
        return $this->ta->read("INNER JOIN spsavepost AS s ON t.idspPostings = s.spPostings_idspPostings WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where idspProfiles =" . $pid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE idspProfiles  =" . $pid . " )) OR d.idspProfiles =" . $pid . ")", "ORDER BY spPostingDate DESC");
    }
    function globaltimelines($start, $uid) {
        
        return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . " )) OR d.spUser_idspUser=" . $uid . ")", "ORDER BY spPostingDate DESC");
    }
    function globaltimelines_two($start, $uid) {
        return $this->ta->read("WHERE (idspCategory = 16 OR idspCategory = 17)  AND (spPostingVisibility = -1 OR spPostingVisibility in(select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . "))) AND (t.idspProfiles in (select spProfiles_idspProfilesReceiver from spprofiles_has_spprofiles where spProfiles_idspProfileSender in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . " )) OR t.idspProfiles in (select spProfiles_idspProfileSender from spprofiles_has_spprofiles where spProfiles_idspProfilesReceiver in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . " )) OR d.spUser_idspUser=" . $uid . ")", " AND spPostingNotes != '' ORDER BY RAND() LIMIT 2");
    }

   

    function grouptimelines($gid) {
        return $this->ta->read("WHERE idspCategory = 17 AND t.spPostingVisibility = " . $gid, "ORDER BY spPostingDate DESC");
    }

    function allgrouptimelines($postid) {
        return $this->ta->read("WHERE t.idspPostings = " . $postid);
    }

    function allgrouptimelinesPost($postid) {
         return $this->ta->read("WHERE t.idspPostings = " . $postid. " AND t.idspCategory = 16");
    }

    function freelancer($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.idspCategory = 5");
    }

    function jobboard($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.idspCategory = 2");
    }

    function myjobpost($uid) {
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.idspCategory = 2");
    }

    function myfavouritejob($uid) {
        return $this->ta->read("WHERE idspPostings in(select spPostings_idspPostings from spfavorites WHERE spUserid =" . $uid . ") AND idspCategory = 2");
    }

    function comingExpiredPosts($pid,$expirydate) {
        $current_date = date('Y-m-d');
        $conn = _data::getConnection();
        $sql = "select * from allpostdata where idspProfiles = '" . $pid . "' and spPostingExpDt >= '" . $current_date . "' and spPostingExpDt <= '".$expirydate."'";        
        $query = mysqli_query($conn, $sql);
        return $query;
    }
    //return time agko function 
    function spPostingDate($firstTime,$lastTime = ''){
        date_default_timezone_set('Asia/Karachi');
        //date_default_timezone_set('Asia/Kolkata');
    //echo date_default_timezone_get();
        if ($lastTime) {
            $now = new DateTime(date('Y-m-d h:i:s', strtotime($lastTime)));
        }else{
            $now = new DateTime(date('Y-m-d h:i:s'));
        }
        $then = new DateTime(date('Y-m-d h:i:s', strtotime($firstTime)));
        $diff = $then->diff($now);
        $time_ago = array('years' => $diff->y, 'months' => $diff->m, 'days' => $diff->d, 'hours' => $diff->h, 'minutes' => $diff->i, 'seconds' => $diff->s);
        
        if ($time_ago['years'] > 0) {
            return $time_ago['years']. ' year ago';
        }else if ($time_ago['months'] > 0) {
            return $time_ago['months']. ' month ago';
        }else if ($time_ago['days'] > 0) {
            if($time_ago['days'] == 1){
                return $time_ago['days']. ' day ago';
            }else{
                return $time_ago['days']. ' days ago';
            }
        }else if ($time_ago['hours'] > 0) {
            return $time_ago['hours']. ' hours ago';
        }else if ($time_ago['minutes'] > 0) {
            return $time_ago['minutes']. ' min ago';
        }else{
           // return $time_ago['seconds']. ' sec just now';
            return 'Just now';
        }
    }
    // =====THIS IS NEW TIME ZONE TESTING
    function get_timeago( $ptime ){
        date_default_timezone_set('Asia/Karachi');

        $estimate_time = time() - $ptime;
        if( $estimate_time < 1 ){
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
        foreach( $condition as $secs => $str ){
            $d = $estimate_time / $secs;
            if( $d >= 1 ){
                $r = round( $d );
                return '' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
    // ==============END=================
    function auction($type, $uid){
        if($type == 'auction'){
            return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings where t.sppostingvisibility=-1 and t.idspcategory = 1 AND p.spPostFieldValue = '$type' GROUP BY idspPostings ORDER BY spPostingDate DESC");
        }else if($type == 'buypost'){
            return $this->ta->read("INNER JOIN sppostfield AS p ON t.idspPostings = p.spPostings_idspPostings where d.spuser_idspuser = '$uid' AND t.sppostingvisibility=-1 and t.idspcategory = 1 AND p.spPostFieldValue <> 'auction' GROUP BY idspPostings ORDER BY spPostingDate DESC");
        }
    }

    //my draft project 
    function myDraftFreelancer($category, $uid) {
        return $this->ta->read("WHERE d.spUser_idspUser =" . $uid . " AND t.spPostingVisibility= 0 AND t.idspCategory = $category", "ORDER BY spPostingDate DESC");
    }
    //art-Gallery
    function artistPost($artist, $category) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspProfiles = $artist AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
    }
    //art gallery same category pic
    function sameCategoryPic($catNamee, $category){
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND p.spPostFieldName = 'photos_' AND p.spPostFieldValue = '$catNamee' AND t.spCategories_idspCategory = " . $category, "ORDER BY RAND()");
    }
	
    function sameCategoryPiccateart($catNamee, $category){
        return $this->ta->read("WHERE spPostingVisibility=-1 AND subcategoryforart = '$catNamee' AND spCategories_idspCategory = " . $category, "ORDER BY RAND()");
    }
	
    function sameCategoryPiccatecraft($catNamee, $category){
        return $this->ta->read("WHERE spPostingVisibility=-1 AND subcategoryforcraft = '$catNamee' AND spCategories_idspCategory = " . $category, "ORDER BY RAND()");
    }
	
   /* function sameCategoryPicNEW($catNamee, $category, $work){
		if($work=='art'){
			$work = 'subcategoryforart';
		}
		if($work=='craft'){
			$work = 'subcategoryforcraft';
		}
       return  $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND p.spPostFieldName = 'photos_' AND t.$work = '$catNamee' AND t.spCategories_idspCategory = " . $category, "ORDER BY RAND() ");
		//echo $this->ta->sql;
    }	*/
	  function sameCategoryPicNEW($id, $catNamee,  $work){
	  $catNamee = $this->ta->escapeString($catNamee);
		if($work=='art'){
			$work = 'subcategoryforart';
		  return  $this->ta->read("WHERE spCategories_idspCategory=$id AND $work=$catNamee ");
		}
		if($work=='craft'){
			$work = 'subcategoryforcraft';
		  return  $this->ta->read("WHERE ad_type=2");
		}
    
      return  $this->ta->read("WHERE spCategories_idspCategory=$id AND $work=$catNamee ");   
		//echo $this->ta->sql;
    } 
	
    function publicpostallcountcat($catNamee, $category, $work){
    $catNamee = $this->ta->escapeString($catNamee);
		if($work=='art'){
			$work = 'subcategoryforart';
		}
		if($work=='craft'){
			$work = 'subcategoryforcraft';
		}
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND p.spPostFieldName = 'photos_' AND p.$work = '$catNamee' AND t.spCategories_idspCategory = " . $category, "ORDER BY RAND()");
    }
	
    // SHOW ALL MUSIC ARTIST
    function totalArtistMusic($catid){
        return $this->ta->read("WHERE t.idspCategory = $catid GROUP By t.idspProfiles");
    }
    //total artist post show
    function totalArtistArt($pid, $catid){
        return $this->ta->read("WHERE t.idspProfiles  = $pid AND t.idspCategory = $catid");
    }
    //show art events all
    function showEventsArt($Visibility, $category) {
        return $this->ta->read("WHERE t.spPostingVisibility = $Visibility AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
    }
    //read all exhibition specfic 
    function showExhibitionArt($eventVisibility, $catid, $exe){
        return $this->ta->read("INNER JOIN sppostfield AS f ON t.idspPostings = f.spPostings_idspPostings where t.sppostingvisibility = $eventVisibility and t.idspcategory = $catid AND f.spPostFieldName = 'spExhibitionId_' AND f.spPostFieldValue = $exe");
    }
    //SEARCCH ART GALLERY
    function search_artgallery($catid, $txtSearch) {
        return $this->ta->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.idspCategory = $catid AND spPostingVisibility = -1", "ORDER BY spPostingDate DESC");
    }
    //SEARCCH FREE MUSIC SONGS
    function search_free($catid) {
        return $this->ta->read("WHERE t.spPostingPrice < 1 AND t.idspCategory = $catid AND spPostingVisibility = -1", "ORDER BY spPostingDate DESC");
    }
    //show daily wise events.
    function showdailywiseevent($date, $category) {
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.idspCategory = " . $category, " AND f.spPostFieldName = 'spPostingStartDate_' AND f.spPostFieldValue >= '$date' ORDER BY spPostingDate DESC");
    }
    //read upcomming event
    function readUpcoming(){
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings where t.sppostingvisibility=-1 and t.idspcategory = 9 AND f.spPostFieldName = 'eventcategory_' AND f.spPostFieldValue = 'CRAFT SHOW' ORDER BY spPostingDate DESC");
    }
    //show all event join art gallery
    function joinEvent($postid) {
        //return $this->ta->read("WHERE t.idspPostings = " . $postid);
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings where f.spPostFieldValue = '$postid' ORDER BY spPostingDate DESC");
    }

    //favourite events
    function event_favorite($pid, $uid)
    {
        return $this->art->read("WHERE spProfiles_idspProfiles=" . $pid . " AND spUserid=" . $uid);

        //echo  $this->art->sql;
        //die('======');
    }
    //real Estate
    //show all sell property home
    function showAllProperty($category, $type){
        return $this->ta->read("INNER JOIN sppostfield AS f ON t.idspPostings = f.spPostings_idspPostings where t.sppostingvisibility = -1 and t.idspcategory = $category AND f.spPostFieldName = 'spPostListing_' AND f.spPostFieldValue = '$type' AND f.spPostFieldIsFilter = 1  ORDER BY idspPostings DESC");
    }
    //get total counts of that (total listing, sale, rent, open house)
    function countTotalPost($category, $fieldName){
        if($fieldName == 'All'){
            return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
        }else if($fieldName == 'Sell'){
            return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "AND f.spPostFieldName = 'spPostListing_' AND f.spPostFieldValue = 'Sell' AND f.spPostFieldIsFilter = '1' ORDER BY spPostingDate DESC");
        }else if($fieldName == 'Rent'){
            return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "AND f.spPostFieldName = 'spPostListing_' AND f.spPostFieldValue != 'Sell' AND f.spPostFieldIsFilter = '1' ORDER BY spPostingDate DESC");
        }else if($fieldName == 'Open'){
            return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "AND f.spPostFieldName = 'spPostingOpenHouse_' AND f.spPostFieldValue = 'Yes' ORDER BY spPostingDate DESC");
        }else{
            return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
        }
    }
    //get all agents list from real estate
    function getAgetsReal($category){
        return $this->ta->read("INNER JOIN sppostfield AS f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "AND f.spPostFieldName = 'spPostingSoldBy_' AND f.spPostFieldValue = 'Agent' GROUP BY t.idspProfiles ORDER BY spPostingDate DESC");
    }
    //get single agent random
    function getAgentListRand($category){
        return $this->ta->read("INNER JOIN sppostfield AS f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "AND f.spPostFieldName = 'spPostingSoldBy_' AND f.spPostFieldValue = 'Agent' ORDER BY RAND()");   
    }
    //search property by address
    function findAddress($category, $txtaddres){
        return $this->ta->read("INNER JOIN sppostfield AS f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "AND f.spPostFieldName = 'spPostingAddress_' AND f.spPostFieldValue like ('%" . $txtaddres . "%') ORDER BY spPostingDate DESC");   
    }
    //search form of all property width multiple field
    function searchMultiFielPro($txtAddress, $txtListid, $txtProType, $txtMinPrice, $txtMaxPrice){
        if(!empty($txtAddress) && !empty($txtListid) && !empty($txtProType) && !empty($txtMinPrice) && !empty($txtMaxPrice)){
            return $this->ta->read("INNER JOIN sppostfield AS f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = 3 AND (f.sppostfieldname = 'sppostingaddress_' and f.sppostfieldvalue like ('%".$txtAddress ."%')) OR (f.sppostfieldname = 'spPostListId_' and f.sppostfieldvalue like ('%".$txtListid ."%')) OR (f.sppostfieldname = 'spPostingPropertyType_' and f.sppostfieldvalue like ('%".$txtProType."%')) AND (t.spPostingPrice BETWEEN $txtMinPrice and $txtMaxPrice) GROUP BY idspPostings order by sppostingdate desc");
        }else{
            return $this->ta->read("INNER JOIN sppostfield AS f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = 3 AND (f.sppostfieldname = 'sppostingaddress_' and f.sppostfieldvalue like ('%".$txtAddress ."%')) OR (f.sppostfieldname = 'spPostingPropertyType_' and f.sppostfieldvalue like ('%".$txtProType."%')) GROUP BY idspPostings order by sppostingdate desc");
        }
    }
    //all room
    function real_room($category){
        return $this->ta->read("INNER JOIN sppostfield AS f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = $category AND (f.sppostfieldname = 'spPostListing_' and f.sppostfieldvalue != 'Sell' AND f.spPostFieldIsFilter = '1')  GROUP BY idspPostings order by sppostingdate desc");
    }
    //all room
    function real_rent_room($category, $type){
        return $this->ta->read("INNER JOIN sppostfield AS f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = $category AND (f.sppostfieldname = 'spRoomRent_' and f.sppostfieldvalue = '$type')  GROUP BY idspPostings order by sppostingdate desc");
    }


    function get_all_rent_room($category, $type){
        return $this->sp->read("INNER JOIN sppostfield as pf ON t.idspPostings = pf.spPostings_idspPostings WHERE t.spCategories_idspCategory = 3  AND t.spPostingVisibility = -1 AND pf.spPostFieldValue = 'Rent A Room'");
}
    //get all post that i have to post "SELL"
    function myAllSellReal($category, $pid, $type){
        return $this->ta->read("INNER JOIN sppostfield AS f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility = -1 AND t.idspCategory = " . $category, "AND f.spPostFieldName = 'spPostListing_' AND f.spPostFieldValue = '$type' AND t.idspProfiles = '$pid' AND f.spPostFieldIsFilter = 1 ORDER BY spPostingDate DESC");
    }
    //get my all enquiry
    function myEnquery($category, $pid){
        return $this->ta->read("INNER JOIN realenquiry as r on t.idsppostings = r.spposting_idspposting WHERE t.sppostingvisibility = -1 and t.idspcategory = $category AND t.idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }
    //get my all Booking
    function readBooking($category, $pid){
        return $this->ta->read("INNER JOIN room_booking as r on t.idsppostings = r.spposting_idspposting WHERE t.sppostingvisibility = -1 and t.idspcategory = $category AND t.idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }



    function getMyBooking($pid){
        return $this->rb->read("INNER JOIN sprealstate as sp on t.spPosting_idspPosting = sp.idspPostings WHERE spProfile_idspProfile = '$pid' ");
    }


    function myReceivedBooking($pid){
        return $this->rb->read("INNER JOIN sprealstate as sp on t.spPosting_idspPosting = sp.idspPostings WHERE sp.spProfiles_idspProfiles = $pid ");
    }
    // MUSIC MODUELE
    // read post
    
    function publicpost_music($limit, $order, $logid){
        return $this->music_video_user->read("
        , music_audio_video AS aaa, spprofiles_has_spprofiles AS bbb 
WHERE aaa.spUser_idspUser = t.idspUser AND  bbb.spProfiles_idspProfileSender = $logid 
OR bbb.spProfiles_idspProfilesReceiver = $logid
        ORDER BY aaa.mav_id $order LIMIT $limit");
    }
    // READ POST VIDEO MY VIDEOS
    function publicpost_video_pid($limit, $category, $order, $pid){
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspProfiles = $pid AND t.idspCategory = " . $category, "ORDER BY spPostingDate $order LIMIT $limit");
    }
    //read random post
    function publicpost_music_rand($limit, $category, $order){
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "ORDER BY $order LIMIT $limit");
    }
    // show all artist for music
    function music_artist_name($limit3, $category){
        return $this->ta->read("INNER JOIN sppostfield as f ON t.idspPostings = f.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = '$category' AND f.spPostFieldLabel = 'Artist name' ");
    }
    // show all category with specfic name
    function sameMusicCategory($catNamee, $category){
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND p.spPostFieldName = 'musiccategory_' AND p.spPostFieldValue = '$catNamee' AND t.idspCategory = " . $category, "ORDER BY RAND()");
    }
    // show all category with specfic name
    function sameMusicArtist($artistName, $catid){
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND p.spPostFieldName = 'spPostArtistName_' AND p.spPostFieldValue like ('" .$artistName . "%') AND t.idspCategory = " . $catid, "ORDER BY RAND()");
    }
    // all free music
    function freeMusic($start, $category) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingPrice < 1 AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
    }
    // total songs
    function totalSongs($artistId, $category){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory = $category AND t.idspProfiles = $artistId");
    }

    //Get My total trainings
    function totalTrain($artistId, $category){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = $category AND t.spProfiles_idspProfiles = $artistId");
    }
    // artist music
    function artistMusic($artistId, $limit, $category){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory = $category AND t.idspProfiles = $artistId ORDER BY spPostingDate DESC LIMIT $limit");
    }
    // GET ALL MY MUSIC SONGS
    function myAllSongs($pid, $category){
        return $this->ta->read("WHERE t.sppostingvisibility = -1 and t.spCategories_idspCategory = $category AND t.spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }

    // GET ALL MY ACTIVE TRAININGS
    function myAllTrain($pid, $category){
        return $this->ta->read("WHERE t.sppostingvisibility = -1 and t.spCategories_idspCategory = $category AND t.spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }
    // GET MY ALL PRIVATE SONGS
    function myAllPrivateSongs($pid, $category, $private){
        return $this->ta->read("WHERE t.sppostingvisibility = $private and t.idspcategory = $category AND t.idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }
    // MY FAVOURITE MUSIC
    function myfavourite_music($pid, $category) {
        return $this->ta->read("WHERE idspPostings in(select spPostings_idspPostings from spfavorites WHERE spProfiles_idspProfiles =" . $pid . ") AND t.spCategories_idspCategory = $category");
    }

    
    // MY FAVOURITE LIKES
    function mylike_freelance($pid) {
        return $this->ta->read("WHERE idspPostings in(select spPostings_idspPostings from splike WHERE spProfiles_idspProfiles =" . $pid . ") ");
    }
    // most rating songs
    function publicpost_mostRating($category) {
        return $this->ta->read("INNER JOIN sppostrating as r on t.idspPostings = r.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
    }
    // read all album which is posted
    function readAlbumPost($postid, $albumName) {
        //return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
        return $this->ta->read("INNER JOIN spPostfield as f on t.idspPostings = f.spPostings_idspPostings WHERE t.idspPostings = $postid AND f.spPostFieldLabel = 'Album' AND f.spPostFieldValue = '$albumName' ");
    }
    // READ ALL ALBUM SONGS WHICH IS I AM CREATED
    function readAlbumSong($albumName, $pid) {
        //return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
        return $this->ta->read("INNER JOIN spPostfield as f on t.idspPostings = f.spPostings_idspPostings WHERE t.idspProfiles = $pid AND f.spPostFieldLabel = 'Album' AND f.spPostFieldValue = '$albumName' ");
    }
    // READ ALL ALBUM VIDEOS WHICH IS I AM CREATED
    function readAlbumVideo($albumName, $pid) {
        //return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
        return $this->ta->read("INNER JOIN spPostfield as f on t.idspPostings = f.spPostings_idspPostings WHERE t.idspProfiles = $pid AND f.spPostFieldName = 'videoalbum_' AND f.spPostFieldValue = '$albumName' ");
    }
    //SEARCCH MUSIC
    function search_music($catid, $txtSearch) {
        return $this->ta->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.idspCategory = $catid AND spPostingVisibility = -1", "ORDER BY spPostingDate DESC");
    }

    // read all album which is posted
    function myLoadSong($pid, $category, $albumName) {
        return $this->ta->read("INNER JOIN spPostfield as f on t.idspPostings = f.spPostings_idspPostings WHERE t.sppostingvisibility = -1 and t.idspcategory = $category AND t.idspProfiles = '$pid' AND f.spPostFieldLabel = 'Album' AND f.spPostFieldValue = '$albumName' ");

        //return $this->ta->read("INNER JOIN spPostfield as f on t.idspPostings = f.spPostings_idspPostings WHERE t.idspPostings = $postid AND f.spPostFieldLabel = 'Album' AND f.spPostFieldValue = '$albumName' ");
    }
    function searchByAlpha($category, $alpha){
        return $this->ta->read("WHERE t.spPostingtitle like '$alpha%' AND t.spPostingVisibility=-1 AND t.idspCategory = " . $category, "ORDER BY spPostingDate DESC");
    }

    // show all category with specfic name
    function sameTrainCategory($catNamee, $category){
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND p.spPostFieldName = 'trainingcategory_' AND p.spPostFieldValue = '$catNamee' AND t.spCategories_idspCategory = " . $category, "ORDER BY RAND()");
    }
    // READ ALL INSTRUCTORS
    function readInstructor($catid,$limit){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = " . $catid, "GROUP BY t.spProfiles_idspProfiles ORDER BY spPostingDate DESC LIMIT $limit");
    }
     // show all category with specfic name
    function sameServCategory($catNamee, $category){
        return $this->ta->read("INNER JOIN sppostfield as p ON t.idspPostings = p.spPostings_idspPostings WHERE t.spPostingVisibility=-1 AND p.spPostFieldName = 'spPostSerComty_' AND p.spPostFieldValue = '$catNamee' AND t.idspCategory = " . $category, "ORDER BY RAND()");
    }
    //show all services which i posted
    function myposted_service($category, $pid){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspCategory = " . $category, "AND t.spPostingExpDt > CURDATE()  ORDER BY spPostingDate DESC");
    }
    // show all service which is expired and i posted
    function myposted_expire_service($category, $pid){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.idspProfiles = $pid AND t.idspCategory = " . $category, "AND t.spPostingExpDt < CURDATE()  ORDER BY spPostingDate DESC");
    }
    //get my all enquiry
    function myServEnq($category, $pid){
        return $this->ta->read("INNER JOIN addenquiry as r on t.idsppostings = r.spPosting_idspPosting WHERE t.sppostingvisibility = -1 and t.idspcategory = $category AND t.idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }
    // update postings
    function updateFlag($postid){
        $this->ta->update(array("spPostingVisibility" => 3), "WHERE idspPostings = $postid ");
    }
    // FLAG POST
    function flag_post($category, $pid){
        return $this->ta->read("INNER JOIN flagpost as f on t.idspPostings = f.spPosting_idspPOsting WHERE t.spPostingVisibility = 3 AND t.idspProfiles= $pid AND t.idspCategory = $category");
    }
    
}

?>
