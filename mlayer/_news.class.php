<?php 
class _news
{
    public $dbclose = false;
	private $conn;
	public $n;
	public $nc;
	public $c;
	public $cat;
	public $b;


	function __construct() { 
	
	   $this->block = new _tableadapter("spnews_block_profile");
	   
	   $this->bucket = new _tableadapter("spnews_bucket");
	   
	   $this->settings = new _tableadapter("spnews_notisettings");
	   
	     $this->taa = new _tableadapter("spnews_follow");
	   
	   $this->temp = new _tableadapter("sptemp_filesnews");
	   
	   
	   $this->na = new _tableadapter("spnews_comment_attachment");
	
		$this->pf 	= new _tableadapter("spnews_flagprofile");
		
		
		$this->uv 	= new _tableadapter("spnews_uservefy");
		
		$this->n 	= new _tableadapter("rss_data");
		$this->nf 	= new _tableadapter("rss_addchannel");
		$this->np	= new _tableadapter("spuser");
		$this->ns 	= new _tableadapter("tbl_country");
		$this->ns 	= new _tableadapter("tbl_country");
		$this->nc 	= new _tableadapter("news_comments");
    	$this->nd	= new _tableadapter("spnews_notification");
		$this->c    = new _tableadapter('tbl_country');
		$this->cat  = new _tableadapter('news_categories');
		$this->mc  = new _tableadapter('rss_dataId'); 
		$this->cn  = new _tableadapter('spnews_announcement');
		$this->ct  = new _tableadapter('spprofiles');
		$this->cas  = new _tableadapter('spnews_notification');
		$this->b  = new _tableadapter('tbl_bookmark_news');
				$this->ban 	= new _tableadapter("spnews_ban");
				
				$this->cr 	= new _tableadapter("spnews_commentreply");
				 $this->cr->join = "INNER JOIN news_comments as n ON n.id = t.comment_id";  

		$this->n->dbclose = false;  
		$this->nc->dbclose = false;
		$this->c->dbclose = false;
		$this->cat->dbclose = false;
		$this->b->dbclose = false; 
	}
	
	
	 function readReplySearchComment($searchcomment){   
		  
	
	    return $this->cr->read("WHERE t.reply_message LIKE '%$searchcomment%'");      
       
	   
	
	} 
	
	
	
    function insertInWhoAndWhom($data){   
		  
	
	    $this->taa->create($data);       
	
	
	}	


	function read_bucket_news($pid) {
	  $pid = $this->bucket->escapeString($pid);
	  return $this->bucket->read("WHERE t.pid = $pid"); 
	}

	
	function readselfdata($who,$whom) { 
		
			 return $this->taa->read("WHERE t.who = $who AND t.whom=$whom"); 
		  
		
	} 
	
	
	function name_of__blocklist($whom) { 
		
			 return $this->ct->read("WHERE t.idspProfiles = $whom"); 
		  
		
	} 
	
	function profile_block($data) { 
		
			 $this->block->create($data); 
		  
		
	} 
	
	
	
	function profile_Unblock($pid,$gid){    
		  
	
	  $this->block->remove("WHERE who = $pid AND whom = $gid");        
   
	}
	
	
	function removefollowunfollow($pid,$gid){     
		  
	
	  $this->taa->remove("WHERE who = $pid AND whom = $gid");        
   
	}
	
	
	function removeblock($pid,$gid){    
		  
	
	  $this->block->remove("WHERE who = $pid AND whom = $gid");          
   
	}
	
	
	
	
	
	function read_profile_block($pid,$gid){
	  $pid = $this->block->escapeString($pid);
	  $gid = $this->block->escapeString($gid);
	  return $this->block->read("WHERE who= $pid AND whom= $gid");
	  
      // echo $this->block->sql;
	   //die("PPPPPPPPPPPPPPP");
	}
	
	function read_blocklist($pid){    
		  
	
	  return $this->block->read("WHERE who=$pid");
	  
      // echo $this->block->sql;
	   //die("PPPPPPPPPPPPPPP");
	}
	
	
	
	function followers($pid,$gid){
	  $gid = $this->taa->escapeString($gid);
	  return $this->taa->read("WHERE who = $pid AND whom = $gid");        
	
	//echo $this->taa->sql;
	
		//die("@@@@@@@@@@@@@@@@@@@@@@@@");   
	}
	
	
	
	function updateposettings($data,$uid,$pid){   
		  
	
	    $this->settings->update($data," WHERE t.uid=$uid AND t.pid=$pid");       
	
	
	}
	function updateposettings111($data1,$uid,$pid){   
		  
	
	    $this->settings->update($data1," WHERE t.uid=$uid AND t.pid=$pid");       
	  
	
	}  
	function updateposettings222($data2,$uid,$pid){     
		  
	
	    $this->settings->update($data2," WHERE t.uid=$uid AND t.pid=$pid");       
	
	
	}
	function updateposettings333($data3,$uid,$pid){   
		  
	
	    $this->settings->update($data3," WHERE t.uid=$uid AND t.pid=$pid");       
	
	
	}
	
	
	
	    function create_settings_data($data) {
			 $this->settings->create($data);
		  
		 //$this->settings->sql;
		//die("UUUUUUUUUUUUUUUUU");
	} 
		function read_settings($gid) {
		  $gid = $this->settings->escapeString($gid);
		  return  $this->settings->read("WHERE t.pid=$gid"); 

	} 
	
	
	
		
		
		
	
	function read_settings_data($uid,$pid) { 
       return $this->settings->read("WHERE t.uid = $uid AND t.pid=$pid");
    } 
	
	
	
	function deletepreviewfiles($id) { 
       return $this->temp->remove("WHERE t.id = $id ");
    } 
	
	
	
	function read_tempfiles($relation_id,$type) { 
       return $this->temp->read("WHERE t.id = $relation_id AND t.file_type=$type");
    } 
	
	
	
	
	
	
	function delete_tempfiles($lastpid) { 
         $this->temp->remove("WHERE t.pid = $lastpid");
    } 
	
	
	
	function delete_news_tempfiles($relation_id) { 
        $this->temp->remove("WHERE t.relation_id = $relation_id");
    }  	
	
	
	
	
	 function read_tempdata($randnum) {  
			   return $this->temp->read("WHERE t.relation_id = $randnum");
				//echo $this->temp->sql;
	      // die("OOOOOOOOOOOOOOOOO");  
} 
	
	
	           
			   
			   function read_user_veryfy($uid3,$pid3,$status) {
		 
		
			  return $this->uv->read("WHERE uid=$uid3 AND pid=$pid3 AND status=$status");   
		 
		//echo $this->uv->sql;
		//die("kkkkkkkkkkkkk");
	} 

			   
			   
	function removeProfiles($pid) { 
        $this->nc->remove("WHERE t.pid= " . $pid);
    }  		   
			   
			   
			   
			   
	
	
	function create_user_veryfy($data) {
			 $this->uv->create($data);
		  
		//echo $this->na->sql;
		//die("kkkkkkkkkkkkk"); 
	} 
	
	
	

	
	
	function read_news_attachment($data) {
			  return $this->na->read("WHERE postid=$data"); 
		 
	} 
	
	   function create_news_uploadfiles($data) {
		   
			return  $this->na->create($data);   
		 
	} 
	
	
	function create_news_attachment($data) {
			return $this->temp->create($data);
		 
		//echo $this->na->sql;
		//die("kkkkkkkkkkkkk");
	} 
	
	function create_news_attachment2($data2) {
			 return $this->temp->create($data2);
		 
		//echo $this->na->sql;
		//die("kkkkkkkkkkkkk");
	}   
	 function create_news_attachment3($data3) {  
			  return $this->temp->create($data3);
		 
		//echo $this->na->sql;
		//die("kkkkkkkkkkkkk");
	} 
	
	/*function add_news_comment($data) {
			  $this->nc->create($data);
		 
		//echo $this->nc->sql;
		//die("kkkkkkkkkkkkk");
	} */
	
	
	
	
 
	function flaggeddata($pid,$gid) {
	  $gid = $this->pf->escapeString($gid);
	  return $this->pf->read("where user_pid=$pid AND flag_pid=$gid"); 
	//echo $this->n->sql;
	//die("**************");
	}
	
	
	
	function readflaggeddata($pid) {
		return $this->pf->read("where user_pid=$pid"); 
	//echo $this->n->sql;
	//die("**************");
	}
	
	function readflagname($flagpid) {
		return $this->ct->read("where idspProfiles=$flagpid"); 
	//echo $this->n->sql;
	//die("**************");
	}
	
	
	
	
	function readsw($website_link,$rss_status) {
		return $this->n->read("where rss_status = '$rss_status' AND website_link='$website_link'");
	//echo $this->n->sql;
	//die("**************");
	}
	 function spcategory($category) {
	return $this->cat->read("where id = '$category'");
		  
	}
	
	function readcounty($country) {
	return $this->ns->read("where country_id  = '$country'");
		  
	}
	
	function readcounty_news(){
	return $this->ns->read("where country_id  ");
		  
	}
	
	
	
		function readprofilebanner($pid) {
		  $pid = $this->ct->escapeString($pid);
		  return $this->ct->read("WHERE t.idspProfiles = " . $pid);
	
	}
	
	
	
//function readd($country,$state,$start,$limit)
 //{
	//return $this->n->read("where country = '$country' AND news_State='$state' limit //$start,$limit");
		 //$this->n->sql;
		// die("99999999999999999999");
	//}
	function readd()
 {
	 return $this->n->read("WHERE t.rss_status =1 ");
	 
		 //$this->n->sql;
		// die("99999999999999999999");
	}
	
	function readsp($idspuser) {
	return	 $this->np->read("where idspUser = '$idspuser'");
		 
	}
	
	function readch($rss_status,$pids,$start,$limit) {
	 	return  $this->n->read("where t.rss_status ='$rss_status' AND t.pid='$pids' limit $start,$limit ");
	  
	}
	
	function counrynews($rss_ids) {
	 	return  $this->n->read("where t.rss_id ='$rss_ids'");
	 echo $this->n->sql;
		die("PPPPPPPPPPP");
	}
	function read2($rss_status,$pids) {
	 	  return $this->n->read("where t.rss_status = '$rss_status'AND t.pid='$pids' ORDER BY rss_id DESC");
		// echo $this->n->sql;
		 //die("PPPPPPPPPPP");
	}
	function readChannels($pidss) {
		return $this->n->read("where t.pid='$pidss'");
	 // echo $this->n->sql;
	  //die("PPPPPPPPPPP");
 }
	function readCategory() {
		return $this->cat->read();
	}
	
	function readrssIds($start,$limit) {
	return $this->mc->read("limit $start,$limit");  
	
		//echo $this->mc->sql;
		//die("OOOOOOOOOOOOOO");
	}
	
	function readrssIds2222() {
	return $this->mc->read();  
	
		//echo $this->mc->sql;
		//die("OOOOOOOOOOOOOO");
	}
	
	
	
	function readannounce() {
		return $this->cn->read("order by create_ondate desc limit 1,3");
	}
	function readannounceloadmore($row,$rowperpage) {    
		return $this->cn->read("order by create_ondate desc limit $row,$rowperpage");
	}
	function readannounceallcount() {
		return $this->cn->read("order by create_ondate desc");
	}
	
	
	
	function readnotification($pids) { 
		return $this->cas->read("where receiver_pid=$pids ORDER BY t.id DESC limit 1,3");
	//	echo $this->cas->sql; die("---");
	}
	
	function readnotificationloadmore($pids,$row,$rowperpage) {
		return $this->cas->read("where receiver_pid=$pids ORDER BY t.id DESC limit $row,$rowperpage");
	}
	
	
	function readnotificationallcount($pids) {
		return $this->cas->read("where receiver_pid=$pids ORDER BY t.id DESC");
	}
	
	
	
	
	
	function spprofilesdata($pids) {
		return $this->ct->read("where idspProfiles=$pids");
	}
	 

	function add_news_comment($data) {
			  $this->nc->create($data);
		 
		//echo $this->nc->sql;
		//die("kkkkkkkkkkkkk");
	} 
	function news_notifications($data) {
			  $this->nd->create($data);
		 
		//echo $this->nc->sql;
		//die("kkkkkkkkkkkkk");
	} 
	
	
	function readcommentdata2($pids) {
		
		
		
		return $this->nc->read(" INNER JOIN spnews_follow on spnews_follow.whom=news_comments.pid WHERE spnews_follow.who=$pids ORDER BY t.id DESC" );
	//echo $this->nc->sql;die;
	//die("**************");
	}
	

function add_news_comment_read($data) {
		return $this->nc->read();
		//echo $this->nc->sql;
		//die("kkkkkkkkkkkkk");
	} 

function read_comment_read($data) {
		return $this->nc->read("WHERE pid = '$data'"); 
		
	} 

function add_channel($data) {
		return	$this->n->create($data);
	} 

function read_channel($pid){    
	  return $this->n->read("WHERE pid=$pid");
	  
      // echo $this->block->sql;
	   //die("PPPPPPPPPPPPPPP");
	}





	function read_news_comment($id) {
		return $this->nc->read("WHERE news_id = '$id'");
	}

	function readNewsByCountry($country,$news_type) {
		return $this->n->read("where country = '$country' AND news_type = '$news_type' AND t.rss_status = 1");
//echo $this->n->sql;
//die("ddddddddddddddddddddddddd"); 
	}
	
	
	// read rss country
	function readRssCountry() {
		return $this->n->read("LEFT JOIN tbl_country as tc ON tc.country_id  = t.country WHERE t.rss_status = 1 AND t.country != 0 GROUP BY t.country ORDER By tc.country_title ASC");		
	}

	// read rss country
	function readCategoryByCountry($country,$news_type){
	return $this->n->read("LEFT JOIN news_categories as nc ON nc.id  = t.category WHERE t.rss_status = 1 AND t.news_type = '$news_type' AND t.country = '$country' GROUP BY t.category");		
	
	///echo $this->n->sql;
	//die("ddddddddddddddddddddddddd"); 
	}

	function readByMyCountry($country,$category,$news_type) {
		return $this->n->read("where country = '$country' AND category = '$category' AND t.news_type = '$news_type' AND t.rss_status = 1");
	}

	function bookmark_news($data) { 
		return	$this->b->create($data);
	} 

	function read_bookmark_news($uid,$pid,$news_added_to,$order) {
	return $this->b->read("where uid = $uid AND pid = $pid AND news_added_to = '$news_added_to' ORDER By t.id $order");
		//echo $this->b->sql;
		
	} 
	
	function readbookmarknews($uid,$pid) {
	return $this->b->read("where uid = $uid AND pid = $pid");
		//echo $this->b->sql;
		
	} 
	
	function removebookmarknews($id) {
	 $this->b->remove("where id = $id");
		//echo $this->b->sql;
		
	} 
	
	
	
}
