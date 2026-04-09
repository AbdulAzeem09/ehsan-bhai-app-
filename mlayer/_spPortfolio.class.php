<?php 
class _spPortfolio
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("	freelancer_newfield");
			$this->tab = new _tableadapter("spportfolio_image");   
		$this->ta->dbclose = false;
	}
	
	
	function create($data){
	
	return	$this->ta->create($data);
		
	}
	
	function imageInsert($imgdata){
	
		$this->tab->create($imgdata);
		
	}
	
	function readimg($portid){
	
		return $this->tab->read("WHERE portfolio_id = $portid ");  
	//echo $this->tab->sql;die('=======');
		
	}
	
	function readimg_limit($portid){
	
	return	$this->tab->read("WHERE portfolio_id = $portid LIMIT 1");

		 // $this->tab->sql;  die("====");  




	}
	
	function delete_img($imgid){
	
	return	$this->tab->remove("WHERE id = $imgid ");  
		
	}
	
	function readport($pid ,$uid){
	
		return $this->ta->read("WHERE spPid = $pid AND spUid = $uid ORDER BY id DESC "); 
		//echo $this->ta->sql;  die("====");   
		
	}
	
	function editport($id){
	
		return $this->ta->read("WHERE id = $id  ");  
		
	}
	
	function get_profile_portfolio($id, $profile){  
	
		return $this->ta->read(" WHERE spPid = $id AND $profile	= 1 ");  
		
	}
	// my all lyrics
	/*function readMyLyric($pid, $category){
		return $this->ta->read("WHERE spProfiles_idspProfiles = $pid");
	}
	//update lyrics aprove
	function updateLyric($lyrivid, $aprove){
		$this->ta->update(array("lyric_flag_approve" => $aprove), "WHERE ml_id = '$lyrivid'");
	}
	// read lyric chek is active or not
	function chekLyric($postid, $title){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND lyrics = $title");
	}*/
	
}
?>