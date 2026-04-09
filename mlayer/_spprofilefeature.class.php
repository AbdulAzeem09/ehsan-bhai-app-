<?php 
class _spprofilefeature 
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
	
	$this->ban 	= new _tableadapter("spnews_ban");
	
	$this->ta10 = new _tableadapter("spnews_comment_attachment");
	
	
	$this->ta9 = new _tableadapter("news_comments");
	

   $this->ta8 = new _tableadapter("spnews_commentreply");
   
    
   
	$this->ta7 = new _tableadapter("spnews_about"); 
	
	$this->ta6 = new _tableadapter("spnews_reshare");
	
	$this->ta4 = new _tableadapter("spnews_bookmark");
	$this->ta5 = new _tableadapter("spnews_flagcomment");
	
	$this->ta3 = new _tableadapter("spnews_flagprofile");
	
	$this->ta2 = new _tableadapter("spprofiles");
	
	    $this->taa = new _tableadapter("spnews_follow");
		
	     $this->tn = new _tableadapter("spprofiletype");
		$this->ta = new _tableadapter("spprofile_feature");
			$this->ta15 = new _tableadapter("spnews_follow");

		
	  $this->ta15->join = "INNER JOIN news_comments as d ON d.pid = t.whom";	
		
		
		
		$this->ta->dbclose = false; 
	} 
	  
	  
	
	
	
	
	function readforshare($comment_id){   
		  
	
	   return $this->ta9->read("WHERE t.id=$comment_id");       
	
	
	}
	
	function readforReply($comment_id){   
		  
	
	   return $this->ta9->read("WHERE t.id=$comment_id");       
	
	
	}
	
	
	/*function readInWhoAndWhom($who,$whom){   
		  
	
	   return $this->ta15->read("WHERE t.who=$who  AND t.whom=$whom");       
	
	
	}
	  
	  
	  
	  
	  	function insertInWhoAndWhom($data){   
		  
	
	    $this->ta15->create($data);       
	
	
	}	
	
	*/
	
	
	
	
	function Update_news_attachment3($data3){   
		  
	
	    $this->ta10->create($data3);       
	
	
	}
		function Update_news_attachment2($data2){   
		  
	
	    $this->ta10->create($data2);       
	
	
	}
		function Update_news_attachment($data){   
		  
	
	    $this->ta10->create($data);       
	
	
	}
	function updatepostcomment($comment,$gid){
	  $gid = $this->ta9->escapeString($gid);
	  $this->ta9->update($comment," WHERE t.id=$gid");	
	}
	  	
		
		function readcommentforupdate($comment_id){   
		  
	
	   return $this->ta9->read("WHERE t.id=$comment_id");       
	
	
	}
	  
	  
	  
	  
	  function deletetachmentfiles($id){   
		  
	
	    $this->ta10->remove("WHERE t.id=$id");       
	
	//echo $this->ta10->sql;
	//die("DDDDDDDDDDDDDDDDDDDDD");
	} 
	
	
	
	function readattachmentforupdate($comment_id){   
		  
	
	   return $this->ta10->read("WHERE t.postid=$comment_id");       
	//echo $this->ta10->sql;
	//die("OOOOOOOOOOOOOOO");
	
	} 
	
	function readimageforupdate($comment_id,$type){
	  $comment_id = $this->ta10->escapeString($comment_id);
	  return $this->ta10->read("WHERE t.postid=$comment_id AND t.type=$type");       
	//echo $this->ta10->sql;
	//die("OOOOOOOOOOOOOOO");
	
	}
	  
	  
	  
	  function followedmemberloadmore($pid,$row,$rowperpage){   
		  
		  return  $this->ta15->read("WHERE t.who=$pid OR d.pid=$pid GROUP BY d.id ORDER BY d.id DESC limit $row,$rowperpage");   

	// return $this->ta9->read("WHERE d.who=$pid limit $row,$rowperpage");   
	
	//echo $this->ta15->sql;
	
		//die("@@@@@@@@@@@@@@@@@@@@@@@@");   
	}
	
	
	function followedmemberallcount($pid){   
		  
	
	  return $this->ta15->read("WHERE t.who=$pid OR d.pid=$pid");       
	
	echo $this->ta15->sql;
	
		die("@@@@@@@@@@@@@@@@@@@@@@@@");   
	}
	
	
	
	function followedmember($pid){   
		  
	
	  
	return  $this->ta15->read("WHERE t.who=$pid OR d.pid=$pid GROUP BY d.id ORDER BY d.id DESC limit 0,10");         
	
	echo $this->ta15->sql;
	
		die("@@@@@@@@@@@@@@@@@@@@@@@@");   
	}







	function readBysharedpId($sharedpid){   
		  
	
	return $this->ta2->read("WHERE t.idspProfiles = $sharedpid");   
	//echo $this->ta2->sql;
		//die("@@@@@@@@@@@@@@@@@@@@@@@@");  
	}



	function readcommentByParrentId($parrent_id){   
		  
	
	return $this->ta9->read("WHERE t.id = $parrent_id ");   
		//echo $this->ta9->sql;
		//die("@@@@@@@@@@@@@@@@@@@@@@@@");  
	}
	   
	  
	  
	  
	  
	  
	
	  
	
	function shareddelete($a,$b,$c,$shared){ 
		  
	
      $this->ta9->remove("WHERE t.id = $a AND t.userid = $b AND t.pid = $c AND t.shared = $shared"); 
		//echo $this->ta9->sql;
		//die("&&&&&&&&&&&&&&&&&&&&&&&");  
	}
	
	
	
	function comattachdel($id){ 
		  
	
      $this->ta10->remove("WHERE t.postid = $id"); 
		//echo $this->ta9->sql;
		//die("&&&&&&&&&&&&&&&&&&&&&&&");  
	}
	
	function sharedread($a,$b,$c,$shared){
		  
	
	return $this->ta9->read("WHERE t.parrent_id = $a AND t.userid = $b AND t.pid = $c AND t.shared = $shared"); 
		//echo $this->ta9->sql;
		//die("&&&&&&&&&&&&&&&&&&&&&&&");  
	}
	
	
	
	
	
	function comattachment($id){
		
	return $this->ta10->read("WHERE t.postid = $id"); 
		
	}
	
	
	function createcomsrdta($data){
		
	return $this->ta9->create($data); 
		
	}
	
	
	function createattachmendta($data3){
		
	 $this->ta10->create($data3); 
		
	}
	
	
	
	
	
	function comattachmentdata($lastid) {
		
		
		
		 
		return $this->ta10->read("WHERE t.postid = $lastid");
	  // echo $this->ta10->sql;  
	}
	
	function comsrdata($cid) {
		
		
		
		 return $this->ta9->read("WHERE t.id=$cid");
	   //$this->ta9->sql;
	}
	
	function replydatacount($cid) {
		
		
		
		 return $this->ta8->read("WHERE t.comment_id=$cid" );
	
	}
	
	
	
	
	
	function readaboutdata() {
		
     return $this->ta7->read();
	
}
	
	
	
		
function ban_world($link,$pid) {  
		
       return   $this->ban->read("WHERE t.pid= $pid AND t.newsid='$link'"); 
	  echo ($this->ban->sql); 
	  die("OOOOOOOOOOOOOOO");
	
}



function bookmarkeddata_world($link,$pid) { 
		
        return $this->ban->read("WHERE t.pid= $pid AND t.news_id='$link'"); 
	  echo ($this->ban->sql); 
	
}
	
	
function bookmarkeddata($pid) { 
		
     return $this->ta4->read("WHERE t.pid= $pid"); 
	
}
	
	function readsharedata($b,$c,$a) {
		
     return $this->ta6->read("WHERE uid= $b AND pid=$c AND comment_id=$a");
	
}

function readsharedata22($a) {
		
     return $this->ta6->read("WHERE comment_id=$a");
	
}
	
	
	function deletesharedata($b,$c,$a) {
		
    $this->ta6->remove("WHERE uid= $b AND pid=$c AND comment_id=$a");
	
}
	
	
	//function removebookmark($pid){
	//	$this->ta4->remove("WHERE t.pid= $pid");
		//echo $this->taa->sql;
		//
		//die("%%%%%%%%%%%%%%%%%%%%%%%%");
	//}
	
	
	
	function createflag($data){
		
		$this->ta3->create($data);
	}
	
	
	
	function createsharedata($data){
		
		$this->ta6->create($data);
	}
	
	
	
	
	
	function createpostflag($data){
		
		$this->ta5->create($data);
	}
	
	
	function readfollowersdata($who) {
		
     return $this->ta2->read("WHERE t.idspProfiles= $who");
		
		//echo $this->ta2->sql;
	
	}
	function readfollowingdata($whom) {  
		
       return $this->ta2->read("WHERE t.idspProfiles= $whom "); 
		
		//echo $this->tn->sql;
		//die("****************");
	}
	
	
	function followsname($gid) {
	     $gid = $this->ta2->escapeString($gid);
       return $this->ta2->read("WHERE t.idspProfiles= $gid");
		
		//echo $this->tn->sql;
		//die("****************");
	}
	
	function followingname($gid) {
	  $gid = $this->ta2->escapeString($gid);
	  return $this->ta2->read("WHERE t.idspProfiles= $gid");
		
		//echo $this->tn->sql;
		//die("****************");
	}
	
	
	
	
	
	
	
	
	
	
	
	function removefollow($sid, $gid){
		$this->taa->remove("WHERE who = $sid AND whom = $gid");
		//echo $this->taa->sql;
		//
		//die("%%%%%%%%%%%%%%%%%%%%%%%%");
	}
	
	function readfollowing($getid) {
	  $getid = $this->taa->escapeString($getid);
	  return $this->taa->read("WHERE t.who= $getid limit 0,4");
		
		echo $this->taa->sql;
		//die("****************");
	}
	
	function readfollowingloadmoredata($getid, $row,$rowperpage) {
	   $getid = $this->taa->escapeString($getid);
	   return $this->taa->read("WHERE t.who= $getid limit $row,$rowperpage");   
		
		//echo $this->taa->sql; 
		//die("****************");
	}
	
	function readforallcount($getid) {
	  $getid = $this->taa->escapeString($getid);
	  return $this->taa->read("WHERE t.who= $getid");
		
		//echo $this->taa->sql;
		//die("****************");
	}
	
	
	function readfollowers($getid) {
		   $getid = $this->taa->escapeString($getid);
       return $this->taa->read("WHERE whom= $getid limit 1,4");  
		
		//echo $this->tn->sql;
		//die("****************");
	}function readfollowerloadmoredata($getid,$row,$rowperpage) {
				   $getid = $this->taa->escapeString($getid);
       return $this->taa->read("WHERE whom= $getid limit $row,$rowperpage");
		
		//echo $this->tn->sql;
		//die("****************");
	}
	function readfollowersallcount($getid) {
	     $getid = $this->taa->escapeString($getid);
       return $this->taa->read("WHERE whom= $getid");
		
		//echo $this->tn->sql;
		//die("****************");
	}
	
	
	function createfolloers($data){
		
		$this->taa->create($data);
	} 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function readfollow($sesid,$getid) {
	  $getid = $this->taa->escapeString($getid);
	  return $this->taa->read("WHERE t.who= $sesid AND t.whom= $getid");
		
		//echo $this->tn->sql;
		//die("****************");
	}
	
	
	function readprotyp($idspProfileType) {
        return $this->tn->read("WHERE idspProfileType = $idspProfileType");
		
		//echo $this->tn->sql;
		//die("****************");
	}
	//create when user favourtie profile of another person
	function createfavourite($by, $to){
		$this->ta->create(array("idspProfile_by" =>$by, "idspProfile_to" =>$to, "spfeature_favourite"=>1));
	}
	//chek krna ha favourtie ha ya ni
	function chkFavourite($by, $to){
		return $this->ta->read("WHERE idspProfile_by = $by AND idspProfile_to = $to AND spfeature_favourite = 1");
	}
	//remove favourite from profile
	function removefavourite($by, $to){
		$this->ta->remove("WHERE idspProfile_by = $by AND idspProfile_to = $to AND spfeature_favourite = 1");
	}
	//create user block
	function createblock($by, $to){
		$this->ta->create(array("idspProfile_by" =>$by, "idspProfile_to" =>$to, "spfeature_block"=>1));
	}
	//chek user is block or not
	function chkBlock($by, $to){
		return $this->ta->read("WHERE idspProfile_by = $by AND idspProfile_to = $to AND spfeature_block = 1"); 
	}
	//unblock
	function removeblock($by, $to){
		$this->ta->remove("WHERE idspProfile_by = $by AND idspProfile_to = $to AND spfeature_block = 1");
	}
	//report submit against user
	function reportSubmit($by, $to, $radReport){
		$this->ta->create(array("idspProfile_by" =>$by, "idspProfile_to" =>$to, "spfeature_des"=>$radReport));
	}
	//get my all block users
	function getmyblockuser($by){
		return $this->ta->read("WHERE idspProfile_by = $by AND spfeature_block = 1");
	}
}
?>
