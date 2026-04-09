<?php 
class _sppostreview
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spPostReview");
		$this->ta->dbclose = false;

		$this->prod = new _tableadapter("sppostings");
		$this->tap = new _tableadapter("spProduct"); 
		$this->taj = new _tableadapter("spjobboard");
		$this->tar = new _tableadapter("sprealstate");
		$this->taf = new _tableadapter("spfreelancer");
		$this->tac = new _tableadapter("spclassified");
		$this->train = new _tableadapter("sptraining");
		$this->taevent = new _tableadapter("spevent");
		$this->v = new _tableadapter("spvideo");
		$this->tart = new _tableadapter("sppostingsartcraft");
		$this->tagrp = new _tableadapter("spGroup");
		$this->gcate = new _tableadapter("group_category");


		$this->prod->dbclose = false;
	}
	
	function create($data)
	{
		 $this->ta->create($data);
	}
	//COMPLETE INFO OF A PROFILE
	function review_profile($postid){
		return $this->ta->read("INNER JOIN spprofiles AS f ON t.spProfiles_idspProfiles = f.idspProfiles WHERE t.spPostings_idspPostings =".$postid);
	}
	
	function review($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE spPostings_idspPostings =".$postid);
	}
	
	function topreview($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings =".$postid. " limit 3");
	}
	
	function read($postid,$pid){
		return $this->ta->read("WHERE spPostings_idspPostings =".$postid. " AND spProfiles_idspProfiles =".$pid);
	}
	
	
	/*function remove($postid,$pid){
		$this->ta->remove("WHERE spPostings_idspPostings =".$postid. " AND spProfiles_idspProfiles =".$pid);
	}*/
	
	function remove($postid,$pid,$reviewid){
		$this->ta->remove("WHERE sppostreviewid =".$reviewid);
	}
	
	
	function updatereview($postid,$pid,$text,$rating)
	{
		return $this->ta->update(array("spPostReviewText" => $text , "spPostRating" => $rating), "WHERE spPostings_idspPostings =".$postid." AND spProfiles_idspProfiles = ".$pid);
	}
	
	/*function updatereview($postid,$pid,$text,$rating,$reviewid)
	{
		return $this->ta->update(array("spPostReviewText" => $text , "spPostRating" => $rating), "WHERE sppostreviewid =".$reviewid);
	}*/
	
	function limitallpersonalproduct_searchall($catid, $pid, $txtSearch)
    {

        return $this->tap->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND spPostingExpDt >= CURDATE() AND spPostingsFlag='2' AND spPostingTitle  like ('%" . $txtSearch . "%') ORDER BY idspPostings ");
          /// echo  $this->tap->sql; die('55555555555');
    }
	function publicpost_jobBoard_session_searchall($txtSearch) {
        //die('pppppppppp');
		return $this->taj->read("WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE()  AND spPostingTitle  like ('%" . $txtSearch . "%') ORDER BY idspPostings ");       
         //echo $this->taj->sql;
		 //die("9099");
    }

	function showAllPropertyviewall_realstate($txtSearch)
	{

		
		return $this->tar->read("where t.sppostingvisibility = -1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') ORDER BY idspPostings desc");
		// echo $this->tar->sql; die("+++++++"); 
		
		
		}

		function total_post_freelancerserachdata($txtSearch)
 {
	return $this->taf->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = 5 
	    AND t.spPostingTitle  like ('%" . $txtSearch . "%') GROUP BY idspPostings ORDER BY spPostingDate DESC");
	   //echo $this->taf->sql;
	   //die("++++");
 }


 function publicpost_music_keyword_searchall($txtSearch)
    {
		return $this->tac->read("WHERE t.spPostingVisibility=-1 AND t.spPostingExpDt > CURDATE() AND t.spPostingTitle  like ('%" . $txtSearch . "%') ORDER BY idspPostings desc");
       // echo  $this->tac->sql;
        // die("+++++++++");
    }
		


	function read_all_trainingsearch($txtSearch)
    {
        return $this->train->read("WHERE status=1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') ORDER BY id desc");
        ///echo $this->train->sql;
        //die('==');
    }

	function homepage_events_top_pagsearchall($txtSearch)
    {

        //$catstr = str_replace(",","','",$category);


        return $this->taevent->read("WHERE t.spPostingVisibility=-1  AND t.spPostingExpDt >= CURDATE() AND t.spPostingTitle  like ('%" . $txtSearch . "%') ORDER BY idspPostings desc");
        //echo $this->taevent->sql;
        //.die('===========');
    }

	function search_artgallerynewsearchall($txtSearch) {
		
		return $this->tart->read("WHERE t.spPostingVisibility = -1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') ORDER BY idspPostings desc");	
		//echo $this->tart->sql;
		//die("++++");	
		
        
    }

	function read_category($gid)
    {
        return $this->gcate->read("WHERE id =" . $gid);
    }



	
    function profilegroupmembersearchall($txtSearch)
    {
        return $this->tagrp->read("where t.spgroupstatus!= 2 AND t.spGroupName  like ('%" . $txtSearch . "%') ORDER BY idspGroup desc");
        //echo $this->tagrp->sql;
        //die('--------------------');
    }





	

	
	function myUploadedVidsearch($txtSearch){
		return $this->v->read("WHERE video_status != 2 AND t.video_title  like ('%" . $txtSearch . "%') ORDER BY video_id desc"); 
	///echo $this->v->sql;die('57777');
    }
	

	
	function updaterate($postid,$pid,$rating)
	{
		
		return $this->ta->update(array("spPostRating" => $rating), "WHERE spPostings_idspPostings =".$postid." AND spProfiles_idspProfiles = ".$pid);
	}


	function productlist($name){
		$result = $this->prod->read("WHERE t.spPostingTitle  like ('%" . $name . "%') ");
		if ($result != false) {
			while($rs = $result->fetch_assoc()) {
				$data[] = array('label'=>$rs['spPostingTitle']);
				// $data[] =$rs['spCategoryName'];				
			}
			echo json_encode($data);
		}
		else
			echo "no data";
	}

	//SEARCH POSTING REVIEW
	function searchproduct($categoryId, $txtSearch){
		if($categoryId == ""){
			return $result = $this->prod->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') LIMIT 15");
		}else{
			return $result = $this->prod->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND spCategories_idspCategory = ".$categoryId." LIMIT 15");
		}
	}
	//SEARCH POSTING HOME
	function searchproducthome($txtSearch){
		return $result = $this->prod->read("WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') ");
	}
	//SEARCH STORE PUBLIC POST
	function searchStore($txtSearch){
		return $result = $this->prod->read("INNER JOIN spprofiles AS d ON t.spProfiles_idspProfiles = d.idspProfiles WHERE t.spPostingTitle  like ('%" . $txtSearch . "%') AND spCategories_idspCategory = 1");
	}
	

}
?>
