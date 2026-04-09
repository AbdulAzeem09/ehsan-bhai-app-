<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/aws/aws-autoloader.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/mlayer/_tableadapter.class.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/mlayer/_comment.class.php';
use Aws\S3\S3Client;
class Timeline extends Base{
  
 
  /**
   * To get all the profiles of the user
   *
  **/
  public function UserInfo($pid){
    $sql = 'SELECT spp.spProfileName, spp.spProfilePic, sppt.spProfileTypeName, spu.userrefferalcode FROM spprofiles AS spp inner join spprofiletype as sppt on spp.spprofiletype_idspprofiletype = sppt.idspprofiletype inner join spuser as spu on spu.idspUser = spp.spUser_idspUser where spp.idspProfiles = ?';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
   /**
   * To get list of the products
   *
  **/
  public function ProductList(){
    $sql = 'SELECT * from spproduct where spcategories_idspcategory = ? and  sppostingvisibility = ? and sppostingexpdt >= curdate() ORDER BY idspPostings ASC LIMIT 4';
    $params = [1, -1];
    $out = selectQ($sql, "ii", $params);
    return ['data' => $out];
  }
  
  /**
   * To get picture of the products
   *
  **/
  public function getProductPic($id){
    $sql = 'SELECT * from spproductpics where sppostings_idsppostings = ?  order by sppostings_idsppostings asc';
    $params = [$id];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get list of the products
   *
  **/
  public function FreelancerWorkList(){
    $sql = 'SELECT * from spfreelancer where spPostingVisibility = ? and complete_status = ? and spPostingExpDt >= curdate() ORDER BY idspPostings ASC LIMIT 4';
    $params = [-1, 0];
    $out = selectQ($sql, "ii", $params);
    return ['data' => $out];
  }
  
  /**
   * To get list of the events
   *
  **/
  public function EventList(){
    $sql = 'SELECT * from spevent where spPostingVisibility = ? and spPostingExpDt >= curdate() ORDER BY idspPostings ASC LIMIT 4';
    $params = [-1];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }

  /**
   * To get picture of the event
   *
  **/
  public function getEventPic($id){
    $sql = 'SELECT * from speventpics where spfeatureimg = ?  and sppostings_idsppostings = ? order by spPostings_idspPostings asc';
    $params = [1, $id];
    $out = selectQ($sql, "ii", $params);
    if(empty($out)){
      $sql = 'SELECT * from speventpics where sppostings_idsppostings = ? order by spPostings_idspPostings asc';
      $params = [$id];
      $out = selectQ($sql, "i", $params);
    }
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get list of videos
   *
  **/
  public function getVideoList(){
    $sql = 'SELECT * from spvideo where video_visibility = ?  order by video_id asc LIMIT 3';
    $params = [1];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }
  
  /**
   * To get list of the art and craft
   *
  **/
  public function ArtandCraftList(){
    $sql = 'SELECT * from sppostingsartcraft where spPostingVisibility = ? and spPostingExpDt >= curdate() ORDER BY idspPostings ASC LIMIT 3';
    $params = [-1];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }
  
  /**
   * To get list of the art and craft
   *
  **/
  public function getArtandCraftPic($id){
    $sql = 'SELECT * from sppostingpicsartcraft where spfeatureimg = ? and spPostings_idspPostings = ? ORDER BY spPostings_idspPostings ASC';
    $params = [1, $id];
    $out = selectQ($sql, "ii", $params);
    if(empty($out)){
      $sql = 'SELECT * from sppostingpicsartcraft where spPostings_idspPostings = ? ORDER BY spPostings_idspPostings ASC';
      $params = [$id];
      $out = selectQ($sql, "i", $params);
    }
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }

  public function checkIsAllowed($gid){
    function sp_autoloader($class)
    {
        include './mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $g = new _spgroup;
    $lpid = $_SESSION['pid'] ?? null;
    if(is_null($lpid)){
      return false;
    }
  
    if($lpid){
      $checkaccess = $g->ismember($gid, $lpid);
      if($checkaccess != false){
        $checkdata = mysqli_fetch_assoc($checkaccess);
        if($checkdata['spApproveRegect'] == 1 && ($checkdata['spProfiles_idspProfiles'] == $lpid)){
          //access allowed        
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }
  }
  
  /**
   * To add post by the user
   *
  **/
  public function postPost(){
    $maxChars = 1000; // Maximum character limit
    $maxEmojis = 10;  // Maximum emoji limit
    // Get submitted content (assuming you are using POST method)
    $submittedContent = $_POST['spPostingNotes'] ?? '';
    // Trim whitespace
    $submittedContent = trim($submittedContent);

    // Validate total number of characters
    $totalChars = mb_strlen($submittedContent, 'UTF-8'); // Count characters in UTF-8 encoding

    // General regex for matching emojis
    $emojiRegex = '/[\x{1F600}-\x{1F64F}|\x{1F300}-\x{1F5FF}|\x{1F680}-\x{1F6FF}|\x{1F700}-\x{1F77F}|\x{2600}-\x{26FF}|\x{2700}-\x{27BF}|\x{24C2}-\x{1F251}]/u';
    preg_match_all($emojiRegex, $submittedContent, $matches);

    // Check if matches were found and count the emojis
    $emojiCount = isset($matches[0]) ? count($matches[0]) : 0;

    // Check for character limit violation
    if ($totalChars > $maxChars) {
      $_POST['spPostingNotes'] = '';
    }

    // Check for emoji limit violation
    if ($emojiCount > $maxEmojis) {
      $_POST['spPostingNotes'] = '';
    }
  
    if(!isset($_POST['spProfiles_idspProfiles'])){
      errorOut("User not found.");
    }
    if(isset($_POST['groupid'])){
      $grpid = $_POST['groupid'];
      if($this->checkIsAllowed($grpid) == false){
        errorOut("You are not allowed to post on group timeline.");
      }
    }

    if($_POST['spCategories_idspCategory'] == 16) {
      if(!empty(trim($_POST['spPostingNotes']))){
        $arr = [];
        $arr[] = isset($_POST['groupid']) ? $_POST['groupid'] : 0;
        $arr[] = isset($_POST['spCategories_idspCategory']) ? (int) trim($_POST['spCategories_idspCategory']) : 0;
        $arr[] = isset($_POST['spPostingVisibility']) ? (int) trim($_POST['spPostingVisibility']) : -1;
        $arr[] = isset($_POST['spProfiles_idspProfiles']) ? (int) trim($_POST['spProfiles_idspProfiles']) : 0;
        $arr[] = date("Y-m-d H:i:s");
        $arr[] = html_entity_decode(htmlspecialchars(trim($_POST['spPostingNotes'])));
        $arr[] = isset($_POST['post_status']) ? $_POST['post_status'] : 2;

        $sql = "insert into sppostings (groupid, spCategories_idspCategory, spPostingVisibility, spProfiles_idspProfiles, spPostingDate, spPostingNotes, post_status) values (?, ?, ?, ?, ?, ?, ?)";
        $type = "iiiissi";
        if(isset($_POST['birtday']) && $_POST['birtday'] == 1){
          $arr[] = $_POST['birtday'];
          $arr[] = isset($_POST['bday_pid']) ? $_POST['bday_pid'] : 0;
          $sql = "insert into sppostings (groupid, spCategories_idspCategory, spPostingVisibility, spProfiles_idspProfiles, spPostingDate, spPostingNotes, post_status, bday_post, bday_pid) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $type = "iiiissiii";
        }
        $postid = insertQ($sql, $type, $arr);
        return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'postid' => $postid]];
      } else {
        errorOut('Please Post Something.');
      }
    }
    
  }
  
  /**
   * To add post by picture
   *
  **/
  public function postPic(){
    $pid = $_SESSION["pid"];
    $page = isset($_POST['page']) ? trim($_POST['page']) : "";
    if(isset($_POST['spPostings_idspPostings']) || $pid){
      $postid = $_POST['spPostings_idspPostings'] ?? null;
      $access = $this->checkPostAccess($postid);
      if(isset($access['data']) && isset($access['data']['idspPostings']) && $access['data']['idspPostings'] == $postid || $pid) {
        $sql = 'SELECT * FROM aws_s3_key';
        $params = [];
        $aws = selectQ($sql, "", $params);
        if(!empty($aws)){
          $key_name = $aws[0]['key_name'];
			    $secret_name = $aws[0]['secret_name'];
			    $uploads_dir = $_SERVER['DOCUMENT_ROOT'].'/uploadimage/';  
	        $name = $_FILES["spPostingPic"]["name"]; 
	        $tmp_name = $_FILES["spPostingPic"]["tmp_name"];
          move_uploaded_file($tmp_name, "$uploads_dir/$name"); 
		      $file = $uploads_dir.$name; 			    
          $region_name = 'ca-central-1'; 
			    $bucketName = 'thesharepage';
          $s3 = new S3Client([
            'version' => 'latest',
            'region' => $region_name,
            'credentials' => [
              'key'    => $key_name,
              'secret' => $secret_name
            ]
          ]);

          $file_Path4 = $file ;
          $key = random_int(1000000000, 9999999999);
          
          try {
            $result = $s3->putObject([
              'Bucket' => $bucketName,
              'Key'    => $key,
              'Body'   => fopen($file_Path4, 'r'),
              'ACL'    => 'public-read',
            ]);
          } catch (Aws\S3\Exception\S3Exception $e) {
            echo "There was an error uploading the file.\n";
            echo $e->getMessage();
          }
          
          $data='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;
          if ($page === 'createprofile') {
            $_SESSION['profile_pic'] = $data;
          }
          unlink($file);
          if(isset($_POST['spFeatureimg'])){
		        $FeatureImg = $_POST['spFeatureimg'];
	        }else{
		        $FeatureImg = 0;
	        }
	        
	        if(isset($_POST['postedit']) && $_POST['postedit'] == true){
		        if (isset($_POST['del'])) {
			        if($_POST['del'] == 0){
				        insertQ('delete from sppostingpics where spPostings_idspPostings = ?', 'i', [$postid]);
			        }
		        }
	        }
          if ($page != 'createprofile') {
	          insertQ('insert into sppostingpics (spPostings_idspPostings, spPostingPic, spFeatureimg) values (?, ?, ?)', 'isi', [$_POST["spPostings_idspPostings"], $data, $FeatureImg]);
	        }
	        if($page === 'editprofile'){
	          insertQ('UPDATE spprofiles SET spProfilePic = ? WHERE idspProfiles = ?', 'si', array($data, $pid));
	        }

          return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'url' => $data]];
        }
      } else {
        errorOut("Post unaccessible. G3");
      }
    } else {
      errorOut("Post not found. PIC");
    }
  }
  
  /**
   * To get list of the post to show in timeline with pagination
   *
  **/
  public function offsetglobaltimelinesProfiletimelineskiplimit($row, $rowperpage, $groupid = 0){
    if($groupid == 0){
      // for main timeline
      $sql = 'SELECT * FROM sppostings AS t left join spgroup as spg on t.groupid = spg.idspgroup where (t.groupid = ?) and spcategories_idspcategory = ? and (sppostingvisibility = ? or sppostingvisibility in (select spgroup_idspgroup from spprofiles_has_spgroup where spprofiles_idspprofiles in (select idspprofiles from spprofiles where idspprofiles =?)) ) and (t.spprofiles_idspprofiles = ? or t.spprofiles_idspprofiles in (select sps.spprofiles_idspprofilesreceiver from `spprofiles_has_spprofiles` sps where sps.spprofiles_has_spprofileflag = ? and ? in ( sps.spprofiles_idspprofilesender,sps.spprofiles_idspprofilesreceiver)) or t.spprofiles_idspprofiles in (select sps1.spprofiles_idspprofilesender from `spprofiles_has_spprofiles` sps1 where sps1.spprofiles_has_spprofileflag = ? and ? in (sps1.spprofiles_idspprofilesender,sps1.spprofiles_idspprofilesreceiver)) or t.spprofiles_idspprofiles in ( SELECT following FROM spuser_follow WHERE follower = ? AND status = ? ) or idsppostings in(select timelineid from share where spsharetowhom = ? ) ) union all select * from sppostings as t left join spgroup as spg on t.groupid = spg.idspgroup where t.idsppostings in (select timelineid from share where spsharetowhom = ?) ORDER BY idspPostings DESC LIMIT ?, ?';
      $params = [0, 16, -1, $_SESSION["pid"], $_SESSION["pid"], 1, $_SESSION["pid"], 1, $_SESSION["pid"],  $_SESSION["pid"], 1, $_SESSION["pid"], $_SESSION["pid"], $row, $rowperpage];
      $out = selectQ($sql, "iiiiiiiiiiiiiii", $params);
      return ['data' => $out];
    }
    else if($groupid > 0) {
      //for group timeline
      $sql = 'SELECT *, sps.spProfilePic as picture, sps.spProfileName as profilename FROM sppostings AS t  
      left join spprofiles sps on t.spProfiles_idspProfiles = sps.idspProfiles
      where (t.groupid = ?) and (sppostingvisibility = ? ) and post_status = ?   ORDER BY idspPostings DESC LIMIT ?, ?';
      $params = [$groupid, $groupid, 2, $row, $rowperpage];
      $out = selectQ($sql, "iiiii", $params);
      return ['data' => $out];
    }

  }

  public function total_group_pending_timelines_count($groupid){
    if($groupid > 0) { //--- ganesh   
      $sql = 'SELECT count(idspPostings) total FROM sppostings as t where t.groupid = ? and post_status = ?   ORDER BY idspPostings DESC ';
      $params = [$groupid, 1];
      $out = selectQ($sql, "ii", $params);  
      //print_r( debugQ($sql,$params)); exit; //-- ganesh
      return $out[0]['total'];
    }
  }

    /**
   * To get list of group pending timeline with pagination
   *
  **/
  public function group_pending_timelines($row, $rowperpage, $groupid){
    if($groupid > 0) { //--- ganesh
      //for group timeline
      $sql = 'SELECT * FROM sppostings AS t left join spuser as spu on t.spProfiles_idspProfiles = spu.idspUser where sppostingvisibility = ?  and post_status = ?   ORDER BY idspPostings DESC LIMIT ?, ?';
      $params = [$groupid, 1, $row, $rowperpage];
      $out = selectQ($sql, "iiii", $params); 
      return ['data' => $out];
    }
  }
  
  /**
   * To get the total count of post to show in timeline
   *
  **/
  public function globaltimelineposttotalcount(){
    $pid = $_SESSION['pid'];
    $sql = 'SELECT COUNT(idspPostings) AS total_count FROM ( SELECT t.idspPostings FROM sppostings AS t LEFT JOIN spgroup AS spg ON t.groupid = spg.idspgroup WHERE (t.groupid = ?) AND spcategories_idspcategory = ? AND ( sppostingvisibility = ? OR sppostingvisibility IN ( SELECT spgroup_idspgroup FROM spprofiles_has_spgroup WHERE spprofiles_idspprofiles IN ( ? ) ) ) AND ( t.spprofiles_idspprofiles = ? OR t.spprofiles_idspprofiles IN ( SELECT sps.spprofiles_idspprofilesreceiver FROM spprofiles_has_spprofiles sps WHERE sps.spprofiles_has_spprofileflag = ? AND ? IN (sps.spprofiles_idspprofilesender, sps.spprofiles_idspprofilesreceiver) ) OR t.spprofiles_idspprofiles IN ( SELECT sps1.spprofiles_idspprofilesender FROM spprofiles_has_spprofiles sps1 WHERE sps1.spprofiles_has_spprofileflag = ? AND ? IN (sps1.spprofiles_idspprofilesender, sps1.spprofiles_idspprofilesreceiver) ) OR t.spprofiles_idspprofiles IN ( SELECT following FROM spuser_follow WHERE follower = ? AND status = ? ) OR idsppostings IN (SELECT timelineid FROM share WHERE spsharetowhom = ?) ) UNION ALL SELECT t.idspPostings FROM sppostings AS t LEFT JOIN spgroup AS spg ON t.groupid = spg.idspgroup WHERE t.idsppostings IN (SELECT timelineid FROM share WHERE spsharetowhom = ?)) AS combined_data';
    $params = [0, 16, -1, $pid, $pid, 1, $pid, 1, $pid, $pid, 1, $pid, $pid];
    $out = selectQ($sql, "iiiiiiiiiiiii", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the block list
   *
  **/
  public function checkBlock($by, $to){
    $sql =  "SELECT * FROM spprofile_feature where idspprofile_by = ? and idspprofile_to = ? and spfeature_block = ?";
    $params = [$by, $to, 1];
    $out = selectQ($sql, "iii", $params);
    return ['data' => $out];
  }
  
  /**
   * To get the block list
   *
  **/
  public function shareList($pid){
    $sql =  "SELECT * FROM share WHERE  spShareToWhom = ?";
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }

  /**
   * To get the single timleline post
   *
  **/
  public function singletimelinespost($postid,$groupid=0){
    if( $groupid > 0) {
      $sql =  "SELECT * FROM sppostings AS t left join spgroup as spg on t.groupid = spg.idspgroup where t.idsppostings = ?  and t.spcategories_idspcategory = ? and t.groupid=? and t.post_status = ?";
      $params = [$postid,  16, $groupid, 2];
      $out = selectQ($sql, "iiii", $params);
      return ['data' => $out];
    }
    else if(isset($postid) && $groupid == 0 ){
      $access = $this->checkPostAccess($postid,$groupid);
      if(isset($access['data']) && isset($access['data']['idspPostings']) && $access['data']['idspPostings'] == $postid) { 
        $sql =  "SELECT * FROM sppostings AS t left join spgroup as spg on t.groupid = spg.idspgroup where t.idsppostings = ? and post_status=? and t.spcategories_idspcategory = ?";
        $params = [$postid, 2, 16];         
        $out = selectQ($sql, "iii", $params);
        return ['data' => $out];
      } 
      else { 
        errorOut("Post unaccessible. G4");  
      }
    }
  }

   /**
   * To get the single timleline post
   *
  **/
  public function getPost($postid, $groupid = 0){
    if(isset($postid)){
      $access = $this->checkPostAccess($postid, $groupid);
      if(isset($access['data']) && isset($access['data']['idspPostings']) && $access['data']['idspPostings'] == $postid) {
        $sql =  "SELECT * FROM sppostings as t where t.idsppostings = ? and t.post_status=? and t.spcategories_idspcategory = ? order by idspPostings desc limit 1 ";
        $params = [$postid, 2, 16];
        $out = selectQ($sql, "iii", $params);
        $obj = null;
        if($out != false){
          $obj = $out[0];
        }
        return ['data' => $obj];
      } else {
        return ['data' => null];
      }
    } else {
      return ['data' => null];
    }
  }
  
  /**
   * To get the profile details
   *
  **/
  public function readprofiles($pid){
    $sql =  "SELECT * FROM spprofiles where idspprofiles = ?";
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  public function readdatabybuyerid($uid){
    $sql =  " SELECT * FROM spuser AS t where idspuser = ?";
    $params = [$uid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the share data
   *
  **/
  public function shareData($pid){
    $sql =  "SELECT * FROM share WHERE  timelineid = ?";
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the share data
   *
  **/
  public function readUserId($uid){
    $sql =  "SELECT * FROM spprofiles AS t inner join spprofiletype as d on t.spprofiletype_idspprofiletype = d.idspprofiletype where idspprofiles = ?";
    $params = [$uid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the time duration
   *
  **/
  public function spPostingDate($time){
    $postDateTime = new DateTime($time);
    $currentTime = new DateTime();
    $interval = $postDateTime->diff($currentTime);
    if ($interval->y > 0) {
      return $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
    } elseif ($interval->m > 0) {
      return $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
    } elseif ($interval->d > 0) {
      return $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
    } elseif ($interval->h > 0) {
      return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '');
    } elseif ($interval->i > 0) {
      return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '');
    } elseif ($interval->s > 0) {
      return $interval->s . ' second' . ($interval->s > 1 ? 's' : '');
    } else {
        return 'Just now';
    }
  }
  
  /**
   * To get the timeline post with image
   *
  **/
  public function readImagePost($pid, $useraccess = 0, $groupid=0){
    if(isset($pid)){
      $access = $this->checkPostAccess($pid,$groupid);
      if((isset($access['data']) && isset($access['data']['idspPostings']) && $access['data']['idspPostings'] == $pid) || $useraccess == 1) {
        $sql =  "SELECT * FROM sppostingpics where sppostings_idsppostings = ? ORDER BY spPostings_idspPostings ASC";
        $params = [$pid];
        $out = selectQ($sql, "i", $params);
        return ['data' => $out];
      } else {
        errorOut("Post unaccessible. G5");
      }
    } else {
      errorOut("Post not found.");
    }
  }
  
  /**
   * To check for links in the post and give it as link and if there is youtoube link give it in a frame
   *
  **/
  public function turnUrlIntoHyperlink($string){
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

        $search  = $newLinks;
        $replace = '<a href="' . $link . '" title="' . $newLinks . '" target="_blank">' . $link . '</a>';
        $isyoutube = $this->videoType($newLinks);
        if ($isyoutube) {
          parse_str(parse_url($newLinks, PHP_URL_QUERY), $my_array_of_vars);
          $string = str_replace($search, '', $string);
          $string .= '<iframe style="width: 100%;" height="315" src="https://www.youtube.com/embed/' . $my_array_of_vars['v'] . '" frameborder="0" allowfullscreen></iframe>';
        } else {
          $string = str_replace($search, $replace, $string);
        }
      }
    }
    return $string;
  }

  /**
   * To check for links in the post and give it as link and if there is youtoube link give it in a frame
   *
  **/
  public function videoType($url){
    if (strpos($url, 'youtube') > 0) {
      return 1;
    } else {
      return 0;
    }
  }

  /**
   * To check if the given post is saved by the user
   *
  **/
  public function savepost($postid, $pid, $uid){
    if(isset($postid)){
      $access = $this->checkPostAccess($postid);
      if(isset($access['data']) && isset($access['data']['idspPostings']) && $access['data']['idspPostings'] == $postid) {
        $sql = 'SELECT COUNT(*) AS total_rows FROM spsavepost WHERE spPostings_idspPostings = ?  AND spProfiles_idspProfiles = ? AND spUserid = ?';
        $params = [$postid, $pid, $uid];
        $out = selectQ($sql, "iii", $params);
        if(!empty($out)){
          $out = $out[0];
        }
        return ['data' => $out];
      } else {
        errorOut("Post unaccessible.");
      }
    } else {
      errorOut("Post not found.");
    }
  }
  
  /**
   * To post media of the post
   *
  **/
  public function postMedia(){
    if(isset($_POST["spPostings_idspPostings"])){
      $postid = $_POST["spPostings_idspPostings"];
      $groupid = $_POST['groupid'] ?? 0;
      $access = $this->checkPostAccess($postid, $groupid);
      if(isset($access['data']) && isset($access['data']['idspPostings']) && $access['data']['idspPostings'] == $postid) {
        if($_FILES['spPostingDocument']['size'] != 0){
          $File_Name = strtolower($_FILES['spPostingDocument']['name']);
	        $name = $_FILES["spPostingDocument"]["name"];
	        $tmp_name = $_FILES["spPostingDocument"]["tmp_name"];
	      }
	      if($_FILES['spPostingMedia']['size'] != 0){
          $File_Name = strtolower($_FILES['spPostingMedia']['name']);
	        $name = $_FILES["spPostingMedia"]["name"];
	        $tmp_name = $_FILES["spPostingMedia"]["tmp_name"];
	      }
        
        $sql = 'SELECT * FROM aws_s3_key';
        $params = [];
        $aws = selectQ($sql, "", $params);
        if(!empty($aws)){
          $key_name = $aws[0]['key_name'];
			    $secret_name = $aws[0]['secret_name'];
			    
			    $sql = 'SELECT * FROM aws_s3 where id = ?';
          $params = [13];
          $awsagain = selectQ($sql, "i", $params);
          
			    if(!empty($awsagain)){
            $region_name = $awsagain[0]['region_name'];
			      $bucketName = $awsagain[0]['bucketName'];
            $s3 = new S3Client([
              'version' => 'latest',
              'region' => $region_name,
              'credentials' => [
                'key'    => $key_name,
                'secret' => $secret_name
              ]
            ]);

            $key = uniqid('video_', true) . '.' . pathinfo($File_Name, PATHINFO_EXTENSION);
            try {
              $result = $s3->putObject([
                'Bucket' => $bucketName,
                'Key'    => $key,
                'SourceFile'   => $tmp_name,
                'ACL'    => 'public-read',
              ]);
            } catch (Aws\S3\Exception\S3Exception $e) {
              echo "There was an error uploading the file.\n";
              echo $e->getMessage();die();
            }

            $data ='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;

	          $File_Ext = substr($File_Name, strrpos($File_Name, '.'));
	          $FileExt = str_replace('.', '', $File_Ext);
	          $pid = $_POST['spProfiles_idspProfiles'];
	          $albumid = $_POST["spPostingAlbum_idspPostingAlbum_"];
	          insertQ('insert into sppostingmedia (spPostings_idspPostings, spPostingAlbum_idspPostingAlbum, spProfiles_idspProfiles, sppostingmedia, sppostingmediaTitle, sppostingmediaExtension, sppostingmediaExt, sppostingGroupid, spPostingMedia_delete, original_name) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 'isissssiis', [$postid, $albumid, $pid,'', $data, $FileExt, $FileExt, $groupid, 0, $name]);
            return ['format' => 'skipSuccess', 'data' => $data];
          } else {
            errorOut("AWS credentials not found.");
          }
        }
      } else {
        errorOut("Post unaccessible. - G1");
      }
    } else {
      errorOut("Invalid postid.");
    }
  }
  
  /**
   * To get albumid
   *
  **/
  public function getAlbumId($pid){
    if(isset($pid)){
      $sql =  "SELECT * FROM sppostingalbum as t INNER JOIN spprofiles as d ON t.spProfiles_idspProfiles = d.idspProfiles WHERE t.spProfiles_idspProfiles = ? and spPostingAlbumName = ?";
      $params = [$pid, 'Timeline'];
      $out = selectQ($sql, "is", $params);

      if(!empty($out)){
        $out = $out[0];
      }
      return ['data' => $out];
    } else {
      errorOut("user not found.");
    }
  }
  
  /**
   * To get album
   *
  **/
  public function readAlbum($postid){
    $sql =  "SELECT * FROM sppostingmedia AS t left join sppostingalbum as d on t.spf_id = d.idsppostingalbum where t.sppostings_idsppostings = ? ";
    $params = [$postid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To post album
   *
  **/
  public function addAlbum($pid){
    if(isset($pid)){
      $sql =  "INSERT INTO sppostingalbum (spPostingAlbumName, spPostingAlbumDescription, spProfiles_idspProfiles) VALUES (?, ?, ?)";
      $params = ['Timeline', 'Only for Timeline', $pid];
      $out = insertQ($sql, "ssi", $params);
      return ['data' => $out];
    } else {
      errorOut("user not found.");
    }
  }

  /**
   * To post comment for posts
   *
  **/
  function insertComment() {
    
    $postId = isset($_POST['pid']) ? (int)$_POST['pid'] : 0;
    $comment = isset($_POST['comment']) ? $_POST['comment'] : "";
    
    if(!$postId){
      errorOut("Invalid postId");
    }
    if(!$comment){
      errorOut("Invalid comment");
    }
    
    $sql = 'SELECT idspPostings FROM sppostings where idspPostings = ?';
    $post = selectQ($sql, "i", [$postId]);
    if(!$post){
      errorOut("Invalid post");
    }  
     
    $arr = [
      $postId,
      $_SESSION['pid'],
      $_SESSION['uid'],
      $comment,
      date('Y-m-d H:i:s')
    ];

    $out = insertQ('insert into comment (spPostings_idspPostings, spProfiles_idspProfiles, userid, comment, commentdate) values (?, ?, ?, ?, ?)', 'iiiss', $arr);
    
    $total = $this->getCommentsCount($postId);
    
    
    return ['data' => ['postId' => $out, 'total' => $total['total']] ];
  }
  
  /**
   * To display new post to the timeline
   *
  **/
  function postTimeline() { 
    if(isset($_SESSION['pid'])){
      $pid = $_SESSION['pid'];
      $groupid = isset($_POST['groupid'])?$_POST['groupid']:0;
      if(isset($_POST['postid'])){
        $postid = $_POST['postid'];
        $access = $this->checkPostAccess($postid,$groupid);

        if(isset($access['data']) && isset($access['data']['idspPostings']) && $access['data']['idspPostings'] == $postid) {
          $sql = 'SELECT * FROM sppostings AS t LEFT JOIN spgroup AS spg ON t.groupid = spg.idspgroup WHERE (t.groupid = ?) AND spcategories_idspcategory = ? AND (sppostingvisibility = ? OR sppostingvisibility IN ( SELECT spgroup_idspgroup FROM spprofiles_has_spgroup WHERE spprofiles_idspprofiles IN ( SELECT idspprofiles FROM spprofiles WHERE idspprofiles = ? ) ) ) AND (t.spprofiles_idspprofiles = ? OR t.spprofiles_idspprofiles IN ( SELECT sps.spprofiles_idspprofilesreceiver FROM spprofiles_has_spprofiles sps WHERE sps.spprofiles_has_spprofileflag = ? AND ? IN ( sps.spprofiles_idspprofilesender, sps.spprofiles_idspprofilesreceiver ) ) OR t.spprofiles_idspprofiles IN ( SELECT sps1.spprofiles_idspprofilesender FROM spprofiles_has_spprofiles sps1 WHERE sps1.spprofiles_has_spprofileflag = ? AND ? IN ( sps1.spprofiles_idspprofilesender, sps1.spprofiles_idspprofilesreceiver ) ) OR t.spprofiles_idspprofiles IN ( SELECT following FROM spuser_follow WHERE follower = ? AND status = ? ) OR idsppostings IN ( SELECT timelineid FROM share WHERE spsharetowhom = ? ) ) AND idspPostings = ?';
          $params = [0, 16, -1, $pid, $pid, 1, $pid, 1, $pid, $pid, 1, $pid, $postid];
        
          // for group timeline
          if($groupid > 0){
            $sql = 'SELECT * FROM sppostings AS t LEFT JOIN spgroup AS spg ON t.groupid = spg.idspgroup WHERE (t.groupid = ?) AND spcategories_idspcategory = ? AND (sppostingvisibility = ? OR sppostingvisibility IN ( SELECT spgroup_idspgroup FROM spprofiles_has_spgroup WHERE spprofiles_idspprofiles IN ( SELECT idspprofiles FROM spprofiles WHERE idspprofiles = ? ) ) ) AND (t.spprofiles_idspprofiles = ? OR t.spprofiles_idspprofiles IN ( SELECT sps.spprofiles_idspprofilesreceiver FROM spprofiles_has_spprofiles sps WHERE sps.spprofiles_has_spprofileflag = ? AND ? IN ( sps.spprofiles_idspprofilesender, sps.spprofiles_idspprofilesreceiver ) ) OR t.spprofiles_idspprofiles IN ( SELECT sps1.spprofiles_idspprofilesender FROM spprofiles_has_spprofiles sps1 WHERE sps1.spprofiles_has_spprofileflag = ? AND ? IN ( sps1.spprofiles_idspprofilesender, sps1.spprofiles_idspprofilesreceiver ) ) OR t.spprofiles_idspprofiles IN ( SELECT following FROM spuser_follow WHERE follower = ? AND status = ? ) OR idsppostings IN ( SELECT timelineid FROM share WHERE spsharetowhom = ? ) ) AND idspPostings = ?';
            $params = [$groupid, 16, $groupid, $pid, $pid, 1, $pid, 1, $pid, $pid, 1, $pid, $postid];
          }

          $post = selectQ($sql, "iiiiiiiiiiiii", $params);
          if(!empty($post)){
            $post = $post[0];
          }

          $blocklist = $this->checkBlock($pid, $post['spProfiles_idspProfiles']);

          if(empty($blocklist['data'])){
            $shares = $this->shareList($pid);
            if(isset($shares['data']) && count($shares['data']) > 0){
              foreach($shares['data'] as $share){
                $shareby = $share['spShareByWhom'];
                $_GET["timelineid"] = $share['timelineid'];
                $proid = $share['spPostings_idspPostings'];
              }
            }
            
            $post['spPostingNotes'] = $this->turnUrlIntoHyperlink($post['spPostingNotes']);
            $obj = $post;
            
            $singlepost = $this->singletimelinespost($post['idspPostings'], $groupid);
            if(isset($singlepost['data']) && count($singlepost['data']) > 0){
              foreach($singlepost['data'] as $row) {
                $post_pid = $row['spProfiles_idspProfiles'];
                $sp1 = $this->readprofiles($row['spProfiles_idspProfiles']);
                if(isset($sp1['data']) && isset($sp1['data']['spUser_idspUser']) && $sp1['data']['spUser_idspUser'] != ""){
                  $st1 = $this->readdatabybuyerid($sp1['data']['spUser_idspUser']);
                  if(isset($st1['data'])){
                    if ($st1['data']['deactivate_status'] == 1) {
                      return ['format' => 'skipSuccess', 'data' => '{}'];
                    }
                  }
                }
                $shareData = $this->shareData($post['idspPostings']);
                if(isset($shareData['data'])){
                  $sharedesc = $shareData['data']['spShareComment'] ?? "";
                  $shareproid = $shareData['data']['spPostings_idspPostings'] ?? "" ;
                }

                $postObject = $this->getPost($post['idspPostings'], $groupid);
                if($postObject){
                  $obj['spProfiles_idspProfiles'] = $postObject['data']["spProfiles_idspProfiles"];
                  $userData = $this->readUserId($postObject['data']["spProfiles_idspProfiles"]);
                }
                if(isset($userData['data'])){
                  $picture = $userData['data']["spProfilePic"];
                  $profilename = $userData['data']["spProfileName"];
                }
                $time = $this->spPostingDate($post["spPostingDate"]);
              }
              
              $timlinepostpic = $this->readImagePost($post['idspPostings'], 0, $groupid);
              $album = $this->readAlbum($post['idspPostings']);
              if($post['bday_post'] == 1){
                $bdayUser = $this->UserInfo($post['bday_pid']);
                if(isset($bdayUser['data']) && isset($bdayUser['data']['spProfileName'])){
                  $obj['bdayPid'] = $post['bday_pid'];
                  $obj['bdayUser'] = $bdayUser['data']['spProfileName'];
                }
              }
              if(isset($album['data']) && !empty($album['data'])){
                $obj['media']['picture'] = $album['data']['spPostingMedia'];
                $obj['media']['sppostingmediaTitle'] = $album['data']['sppostingmediaTitle'];
                $obj['media']['original_name'] = $album['data']['original_name'];
                $obj['media']['sppostingmediaExt'] = $album['data']['sppostingmediaExt'];
              }
              if(isset($picture)){
                $obj['picture'] = $picture;
              }
              if(isset($profilename)){
                $obj['profilename'] = $profilename;
              }
              if(isset($time)){
                $obj['time'] = $time;
              }
              if(isset($timlinepostpic)){
                $obj['timlinepostpic'] = $timlinepostpic;
              }
              $likeCount = $this->getLikesCount($post['idspPostings']);
              $isLiked = false;
              $obj['likeCount'] = 0;
              if(isset($likeCount['total'])){
                $obj['likeCount'] = $likeCount['total'];
                $isLiked = $this->checkIfLiked($post['idspPostings']);
              }
              $obj['isLiked'] = $isLiked;

              $obj['isSaved'] = $this->checkIfSaved($post['idspPostings']);
              $obj['isFlaged'] = $this->chedkIfFlaged($post['idspPostings']);

              $obj['commentsCount'] = 0;
              $commentsCount = $this->getCommentsCount($post['idspPostings']);
              $isCommented = false;
              if(isset($commentsCount['total'])){
                $obj['commentsCount'] = $commentsCount['total'];
                $isCommented = $this->checkIfCommented($post['idspPostings']);
              }
              $obj['isCommented'] = $isCommented;
              $loveCount = $this->getLovesCount($post['idspPostings']);
              $isLoved = false;
              $obj['loveCount'] = 0;
              if(isset($loveCount['total'])){
                $obj['loveCount'] = $loveCount['total'];
                $isLoved = $this->checkIfLoved($post['idspPostings']);  
              }
              $obj['isLoved'] = $isLoved;
              $shareCount = $this->getSharesCount($post['idspPostings']);
              $isShared = false;
              $obj['shareCount'] = 0;
              if(isset($shareCount['total'])){
                $obj['shareCount'] = $shareCount['total'];
                $isShared = $this->checkIfShared($post['idspPostings']);  
              }
              $obj['isShared'] = $isShared;

             // print_r($obj); echo 'line 843'; exit;
              return ['format' => 'skipSuccess', 'data' => $obj];
            } else {
              return ['format' => 'skipSuccess', 'data' => '{}'];
            }
          } else {
            return ['format' => 'skipSuccess', 'data' => '{}'];
          }
        } else {
          errorOut("post unaccessible. G2");
        }
      } else {
        errorOut("post not found. P1");
      }
      
    } else {
      errorOut("user not found. U1");
    }
    
  }
  
  /**
   * To get the share data
   *
  **/
  public function getHiddenPost($pid){
    $sql =  "SELECT * FROM spposthide AS t where spprofiles_idspprofiles = ? order by idspposthide desc";
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }


  
  /**
   * To get more post using pagination
   *
  **/
  public function moreTimeline() {
    $row = $_POST['row'] ?? 0;
    $profile = $_POST['profile'] ?? "";
    $groupid = $_POST['groupid'] ?? 0;
    $pagename = $_POST['pagename'] ?? "";
    $rowperpage = 11;
    $hiddenPost = [];

    $hiddenPostsData = $this->getHiddenPost($_SESSION['pid']);
    if(isset($hiddenPostsData['data']) && count($hiddenPostsData['data']) > 0){
      foreach($hiddenPostsData['data'] as $hidden){
        array_push($hiddenPost, $hidden['spPostings_idspPostings']);
      }
    }
    $timelinePosts = $this->offsetglobaltimelinesProfiletimelineskiplimit($row, $rowperpage, $groupid);
    $fullData = [];
    if(isset($timelinePosts['data']) && count($timelinePosts['data']) > 0){
      foreach($timelinePosts['data'] as $timelinepost){
        $isBlocked = $this->checkBlock($_SESSION['pid'], $timelinepost['spProfiles_idspProfiles']);
        if (empty($isBlocked['data'])) {
          if(in_array($timelinepost['idspPostings'], $hiddenPost)){
          }else{
            $pstid = $timelinepost['idspPostings'];
            $spid = $_SESSION['pid'];
            $sql3 = "SELECT * FROM share WHERE  spShareToWhom = ?";
            $params = [$spid];
            $share = selectQ($sql3, "i", $params);
            if(!empty($shares)){
              foreach($shares as $share){
                $shareby = $share['spShareByWhom'];
                $_GET["timelineid"] = $share['timelineid'];
                $proid = $share['spPostings_idspPostings'];
              }
            }
            $timelinepost['spPostingNotes'] = $this->turnUrlIntoHyperlink($timelinepost['spPostingNotes']);
            $obj = $timelinepost;

            $singlepost = $this->singletimelinespost($timelinepost['idspPostings'], $groupid);
            if(isset($singlepost['data']) && count($singlepost['data']) > 0){
              foreach($singlepost['data'] as $row) {
                $sp1 = $this->readprofiles($row['spProfiles_idspProfiles']);
                if(isset($sp1['data']) && isset($sp1['data']['spUser_idspUser']) && $sp1['data']['spUser_idspUser'] != ""){
                  $st1 = $this->readdatabybuyerid($sp1['data']['spUser_idspUser']);
                  if(isset($st1['data'])){
                    if ($st1['data']['deactivate_status'] == 1) {
                      continue;
                    }
                  }
                }
                $shareData = $this->shareData($timelinepost['idspPostings']);
                if(!empty($shareData['data'])){
                  $sharedesc = $shareData['data']['spShareComment'] ?? "";
                  $shareproid = $shareData['data']['spPostings_idspPostings'] ?? "";
                }
                
                $postObject = $this->getPost($timelinepost['idspPostings'],$groupid);
                if(!empty($postObject['data'])){
                  $obj['spProfiles_idspProfiles'] = $postObject['data']["spProfiles_idspProfiles"];
                  $userData = $this->readUserId($postObject['data']["spProfiles_idspProfiles"]);
                }
                if(isset($userData['data'])){
                  $picture = $userData['data']["spProfilePic"];
                  $profilename = $userData['data']["spProfileName"];
                }
                $time = $this->spPostingDate($timelinepost["spPostingDate"]);
              }
              
              $timlinepostpic = $this->readImagePost($timelinepost['idspPostings'], 0, $groupid);

              $album = $this->readAlbum($timelinepost['idspPostings']);
              if($timelinepost['bday_post'] == 1){
                $bdayUser = $this->UserInfo($timelinepost['bday_pid']);
                if(isset($bdayUser['data']) && isset($bdayUser['data']['spProfileName'])){
                  $obj['bdayPid'] = $timelinepost['bday_pid'];
                  $obj['bdayUser'] = $bdayUser['data']['spProfileName'];
                }
              }
              if(isset($album['data']) && !empty($album['data'])){
                $obj['media']['picture'] = $album['data']['spPostingMedia'];
                $obj['media']['sppostingmediaTitle'] = $album['data']['sppostingmediaTitle'];
                $obj['media']['original_name'] = $album['data']['original_name'];
                $obj['media']['sppostingmediaExt'] = $album['data']['sppostingmediaExt'];
              }
              if(isset($picture)){
                $obj['picture'] = $picture;
              }
              if(isset($profilename)){
                $obj['profilename'] = $profilename;
              }
              if(isset($time)){
                $obj['time'] = $time;
              }
              if(isset($timlinepostpic)){
                $obj['timlinepostpic'] = $timlinepostpic;
              }
              $likeCount = $this->getLikesCount($timelinepost['idspPostings']);
              $isLiked = false;
              $obj['likeCount'] = 0;

              if(isset($likeCount['total'])){
                $obj['likeCount'] = $likeCount['total'];
                $isLiked = $this->checkIfLiked($timelinepost['idspPostings']);
              }
              $obj['isLiked'] = $isLiked;

              $obj['isSaved'] = $this->checkIfSaved($timelinepost['idspPostings']);
              $obj['isFlaged'] = $this->chedkIfFlaged($timelinepost['idspPostings']);

              $obj['commentsCount'] = 0;
              $commentsCount = $this->getCommentsCount($timelinepost['idspPostings']);
              $isCommented = false;
              if(isset($commentsCount['total'])){
                $obj['commentsCount'] = $commentsCount['total'];
                $isCommented = $this->checkIfCommented($timelinepost['idspPostings']);
              }
              $obj['isCommented'] = $isCommented;
              $loveCount = $this->getLovesCount($timelinepost['idspPostings']);
              $isLoved = false;
              $obj['loveCount'] = 0;
              if(isset($loveCount['total'])){
                $obj['loveCount'] = $loveCount['total'];
                $isLoved = $this->checkIfLoved($timelinepost['idspPostings']);  
              }
              $obj['isLoved'] = $isLoved;
              $shareCount = $this->getSharesCount($timelinepost['idspPostings']);
              $isShared = false;
              $obj['shareCount'] = 10;
              if(isset($shareCount['total'])){
                $obj['shareCount'] = $shareCount['total'];
                $isShared = $this->checkIfShared($timelinepost['idspPostings']);  
              }
              $obj['isShared'] = $isShared;
              $obj['isFollowing'] = false;              
              //$obj['isFollowing'] = $this->checkFollowing($timelinepost['spProfiles_idspProfiles']);
              //print_r($timelinepost); echo "<br>File ".__FILE__."<br>Line-". __LINE__ .'<br>'; exit; //--- ganesh
            }
            $fullData[] = $obj;
          }
        }
      }
      $count = 0;
      $totalCount = $this->globaltimelineposttotalcount();
      if($totalCount['data'] && isset($totalCount['data']['total_count'])){
        $count = $totalCount['data']['total_count'];
      }
      return ['format' => 'skipSuccess', 'data' => ['post' => $fullData, 'count' => $count]];
    }
    
  }

  public function pendingTimeline() {
    $row = $_POST['row'];
    $groupid = $_POST['groupid'];
    $pagename = $_POST['pagename'];
    $rowperpage = 11;
    $hiddenPost = [];

    $timelinePosts = $this->group_pending_timelines($row, $rowperpage,$groupid);
    $fullData = [];
    if(isset($timelinePosts['data']) && count($timelinePosts['data']) > 0){
      foreach($timelinePosts['data'] as $timelinepost){                                               
        $userData = $this->readUserId($timelinepost["spProfiles_idspProfiles"]);
        if(isset($userData['data'])){
          $picture = $userData['data']["spProfilePic"];
          $profilename = $userData['data']["spProfileName"];
        }
        $time = $this->spPostingDate($timelinepost["spPostingDate"]);      
        $timelinepost['spPostingNotes'] = $this->turnUrlIntoHyperlink($timelinepost['spPostingNotes']);

        $obj = $timelinepost;
        $timlinepostpic = $this->readImagePost($timelinepost['idspPostings'], 0, $groupid);
        
        $album = $this->readAlbum($timelinepost['idspPostings']);
        if(isset($album['data']) && !empty($album['data'])){
          $obj['media']['picture'] = $album['data']['spPostingMedia'];
          $obj['media']['sppostingmediaTitle'] = $album['data']['sppostingmediaTitle'];
          $obj['media']['original_name'] = $album['data']['original_name'];
          $obj['media']['sppostingmediaExt'] = $album['data']['sppostingmediaExt'];
        }

        if(isset($picture)){
          $obj['picture'] = $picture;
        }
        if(isset($profilename)){
          $obj['profilename'] = $profilename;
        }
        if(isset($time)){
          $obj['time'] = $time;
        }
        if(isset($timlinepostpic)){
          $obj['timlinepostpic'] = $timlinepostpic;
        }
        $fullData[] = $obj;          
      }
      $count = 0;
      $totalCount = $this->total_group_pending_timelines_count($groupid);     
      if($totalCount && $totalCount >=0){
        $count = $totalCount;
      }
      return ['format' => 'skipSuccess', 'data' => ['post' => $fullData, 'count' => $count]];
    }
    return ['format' => 'skipSuccess', 'data' => ['post' => [], 'count' => 0]];
  }
  
  /**
   * check if the user follows the given user
   *
  **/
  public function checkFollowing($followId){
    if(isset($followId)){
      $arr = [];
      $arr[] = $_SESSION['pid'];
      $arr[] = $followId;
      $arr[] = 1;
      $out = selectQ('SELECT * FROM spuser_follow WHERE follower = ? AND following = ? AND status = ?', 'iii', $arr);
      if(!empty($out)){
        return true;
      } else {
        return false;
      }
    } else {
      return false;
      // errorOut("Invalid Users");
    }
  }
  
    /**
     * Post saving and unsaving
     *
     * This function handles the logic for saving and unsaving posts.
     * It expects data to be submitted via POST method.
     * If the 'save' parameter is present in the POST data, the post is saved.
     * If the 'unsave' parameter is present, the corresponding saved post is unsaved.
     * The function then executes the appropriate database operation accordingly.
     *
     * @return array An array indicating the success of the operation and the DATA affected.
     **/
    public function savepostes(){
        $pid = $_SESSION['pid'];
        $uid = $_SESSION['uid'];
        $post = isset($_POST['save']) ? (int) $_POST['save'] : 0;
        if($post){
            $arr = array($post, $pid, $uid);
            $result = insertQ('INSERT INTO spsavepost (spPostings_idspPostings, spProfiles_idspProfiles, spUserid) VALUES (?, ?, ?)', 'iss', $arr);
            return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $post]];
        }
        $postid = isset($_POST['unsave']) ? (int) $_POST['unsave'] : 0;
        if($postid){
            $arr1 = array($postid, $pid, $uid);
            $result = insertQ('DELETE FROM spsavepost WHERE spPostings_idspPostings = ? AND spProfiles_idspProfiles = ? AND spUserid = ?', 'iii', $arr1);
            return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $postid]];
        }
    }

    /**
     * Post saving and unsaving
     *
     * This function handles the logic for saving and unsaving posts.
     * It expects data to be submitted via POST method.
     * If the 'save' parameter is present in the POST data, the post is saved.
     * If the 'unsave' parameter is present, the corresponding saved post is unsaved.
     * The function then executes the appropriate database operation accordingly.
     *
     * @return array An array indicating the success of the operation and the DATA affected.
     **/
    public function saveFlagpostes(){
      $pid = $_SESSION['pid'];
      $uid = $_SESSION['uid'];
      $post = isset($_POST['save']) ? (int) $_POST['save'] : 0;
      if($post){
          $arr = array(
            $_POST['why_flag'], 
            $_POST['spPosting_idspPosting'], 
            $_POST['flagpostprofileid'], 
            $_POST['flagpostuserid'] ?? 0,
            $pid, 
            $uid
          );
          $result = insertQ('INSERT INTO flagtimelinepost (why_flag,spPosting_idspPosting, flagpostprofileid, flagpostuserid, spProfile_idspProfile, userid) VALUES (?, ?, ?, ?, ?, ?)', 'siiiii', $arr);

          $count = selectQ("SELECT COUNT('*') as total FROM `flagtimelinepost` WHERE spPosting_idspPosting = ? ", 'i', [$_POST['spPosting_idspPosting']]);
          if($count && isset($count[0]['total']) && $count[0]['total'] >= 5){
            insertQ('UPDATE sppostings SET post_status = ? WHERE idspPostings = ?', 'ii', array(0, $_POST['spPosting_idspPosting']));
          }
          
          return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $post]];
      }
      $postid = isset($_POST['unsave']) ? (int) $_POST['unsave'] : 0;
      if($postid){
          $arr1 = array($postid, $pid, $uid);
          $result = insertQ('DELETE FROM flagtimelinepost WHERE spPosting_idspPosting = ? AND spProfile_idspProfile = ? AND userid = ?', 'iii', $arr1);
          return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $postid]];
      }
    }
    
    /**
     * Function to delete a post
     *
     * This function takes the post ID from the $_POST array,
     * constructs an array with the post ID, and then executes
     * a SQL query to delete the post from the database.
     *
     * @return array An array indicating the success of the deletion operation
     */
    public function deletePosts(){
        $post = isset($_POST['postid']) ? (int) $_POST['postid'] : 0;
        $arr1 = array($post);
        $result = insertQ('DELETE FROM sppostings WHERE idspPostings = ?', 'i', $arr1);
        return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $post]];
    }
    
    /**
     * To get comments count based on postId
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function getCommentsCount($postId){
      $sql3 = "SELECT count(idComment) as total FROM comment WHERE  spPostings_idspPostings = ?";
      $params = [$postId];
      $share = selectQ($sql3, "i", $params);
      return $share[0];
    } 

    /**
     * To check if the user have commented the post
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function checkIfCommented($postId){
      $sql3 = "SELECT idComment FROM comment WHERE  spPostings_idspPostings = ? and spProfiles_idspProfiles = ? limit 1";
      $params = [$postId, $_SESSION["pid"]];
      $share = selectQ($sql3, "ii", $params);
      if($share){
        return true;
      }
      else{
        return false;
      }
    } 

    /**
     * To check if the user have commented the post
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function getCommented($postId, $limit){
      $sql3 = "SELECT * FROM comment WHERE  spPostings_idspPostings = ? order by idComment desc limit ?";
      $params = [$postId, $limit];
      $comments = selectQ($sql3, "ii", $params);
      return $comments;
    } 

    /**
     * To get like for a post
     *
     * @return array An array
     */        
    public function addLike(){

      $postId = isset($_POST['pid']) ? (int) $_POST['pid'] : 0;
      $reactionId = isset($_POST['reactionId']) ? (int) $_POST['reactionId'] : 0;
      
      if(!$postId){
        errorOut("Invalid postId");
      }
      if(!$reactionId){
        errorOut("Invalid Reaction");
      }
      
      $sql = 'SELECT idspPostings FROM sppostings where idspPostings = ?';
      $post = selectQ($sql, "i", [$postId]);
      if(!$post){
        errorOut("Invalid post");
      }
      
      $sql = 'SELECT id FROM splike where spPostings_idspPostings = ? and spProfiles_idspProfiles=? and Reaction_id=?';
      $comments = selectQ($sql, "iii", [$postId, $_SESSION["pid"], $reactionId]);
      if($comments){
        insertQ('delete from splike where id = ?', 'i', [$comments[0]['id']]);        
        $total = $this->getLikesCount($postId);
        return ['data' => ['likeId' => $comments[0]['id'], 'action' => 'deleted', 'total' => $total['total']]];
      }
      else{
        $arr = [$postId, $_SESSION["pid"], $_SESSION["uid"], $reactionId];
        $likeId = insertQ('insert into splike(spPostings_idspPostings, spProfiles_idspProfiles, uid, Reaction_id) values (?, ?, ?, ?)', 'iiii', $arr);
        $total = $this->getLikesCount($postId);
        return ['data' => ['likeId' => $likeId, 'total' => $total['total']]];        
      }
      
    }

    /**
     * To get the likes count based on postId
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function getLikesCount($postId){
      $sql3 = "SELECT count(id) as total FROM splike WHERE  spPostings_idspPostings = ?";
      $params = [$postId];
      $share = selectQ($sql3, "i", $params);
      return $share[0];
    } 

    /**
     * To check if user have liked the post
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function checkIfLiked($postId){
      $sql3 = "SELECT id FROM splike WHERE  spPostings_idspPostings = ? and spProfiles_idspProfiles = ?";
      $params = [$postId, $_SESSION["pid"]];
      $share = selectQ($sql3, "ii", $params);
      if($share){
        return true;
      }
      else{
        return false;
      }
    } 

    /**
     * To check if user have saved the post
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function checkIfSaved($postId){
      $sql3 = "SELECT spPostings_idspPostings FROM spsavepost WHERE  spPostings_idspPostings = ? and spProfiles_idspProfiles = ?";
      $params = [$postId, $_SESSION["pid"]];
      $result = selectQ($sql3, "ii", $params);
      if($result){
        return true;
      }
      else{
        return false;
      }
    } 

    /**
     * To check if user have flaged the post
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function chedkIfFlaged($postId){
      $sql3 = "SELECT flag_id FROM flagtimelinepost WHERE spPosting_idspPosting = ? and spProfile_idspProfile = ?";
      $params = [$postId, $_SESSION["pid"]];
      $result = selectQ($sql3, "ii", $params);
      if($result){
        return true;
      }
      else{
        return false;
      }
    }

    /**
     * To get love for a post
     *
     * @return array An array
     */        
    public function addLove(){

      $postId = isset($_POST['pid']) ? (int) $_POST['pid'] : 0;
      
      if(!$postId){
        errorOut("Invalid postId");
      }
      
      $sql = 'SELECT idspPostings FROM sppostings where idspPostings = ?';
      $post = selectQ($sql, "i", [$postId]);
      if(!$post){
        errorOut("Invalid post");
      }
      
      $sql = 'SELECT id FROM spfavorites where spPostings_idspPostings = ? and spProfiles_idspProfiles=?';
      $likes = selectQ($sql, "ii", [$postId, $_SESSION["pid"]]);
      if($likes){
        insertQ('delete from spfavorites where id = ?', 'i', [$likes[0]['id']]);
        
        $total = $this->getLovesCount($postId);
        
        return ['data' => ['loveId' => $likes[0]['id'], 'action' => 'deleted', 'total' => $total['total']]];
      }
      else{
        $arr = [$postId, $_SESSION["pid"], $_SESSION["uid"]];
        $likeId = insertQ('insert into spfavorites(spPostings_idspPostings, spProfiles_idspProfiles, spUserid) values (?, ?, ?)', 'iii', $arr);
        
        $total = $this->getLovesCount($postId);
        
        return ['data' => ['loveId' => $likeId, 'total' => $total['total']]];        
      }
      
    }
    
    /**
     * To get the loves count based on postId
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function getLovesCount($postId){
      $sql3 = "SELECT count(id) as total FROM spfavorites WHERE  spPostings_idspPostings = ?";
      $params = [$postId];
      $share = selectQ($sql3, "i", $params);
      return $share[0];
    } 

    /**
     * To check if the user have loved the post
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function checkIfLoved($postId){
      $sql3 = "SELECT id FROM spfavorites WHERE  spPostings_idspPostings = ? and spProfiles_idspProfiles = ? limit 1";
      $params = [$postId, $_SESSION["pid"]];
      $share = selectQ($sql3, "ii", $params);
      if($share){
        return true;
      }
      else{
        return false;
      }
    } 
        
    /**
     * To get the shares count based on postId
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function getSharesCount($postId){
      $sql3 = "SELECT count(id) as total FROM spmessaging WHERE  spPostings_idspPostings = ?";
      $params = [$postId];
      $share = selectQ($sql3, "i", $params);
      return $share[0];
    }


    /**
     * To get the shares count based on postId
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function getCommentReplyCount($cId){
      $sql3 = "SELECT count(id) as total FROM comment_reply WHERE  idComment = ?";
      $params = [$cId];
      $commnetReply = selectQ($sql3, "i", $params);
      return $commnetReply[0]['total'] ?? 0;
    }
    /**
     * Function to edit a post
     *
     * This function retrieves the post ID and content from the $_POST array.
     * It then updates the 'spPostingNotes' field in the 'sppostings' table
     * based on the provided post ID, setting it to the received content.
     *
     * @return array An array indicating the success of the edit operation
     */
    public function editpost(){
        $post = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        if($post <= 0){
          errorOut("postid not found.");
        }
        $result = insertQ('UPDATE sppostings SET spPostingNotes = ? WHERE idspPostings = ?', 'si', array($content, $post));
        return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $post],'page'=>$_REQUEST['pagename']];


    }

    /**
     * Function to edit a post
     *
     * This function retrieves the post ID and content from the $_POST array.
     * It then updates the 'spPostingNotes' field in the 'sppostings' table
     * based on the provided post ID, setting it to the received content.
     *
     * @return array An array indicating the success of the edit operation
     */
    public function editComment(){
      $commnetId = isset($_POST['id']) ? (int) $_POST['id'] : 0;
      $content = isset($_POST['content']) ? $_POST['content'] : '';
      if($commnetId <= 0){
        errorOut("commentId not found.");
      }
      $result = insertQ('UPDATE comment SET comment = ? WHERE idComment = ?', 'si', array($content, $commnetId));
      return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $commnetId]];
    }

    /**
     * Function to edit a post
     *
     * This function retrieves the post ID and content from the $_POST array.
     * It then updates the 'spPostingNotes' field in the 'sppostings' table
     * based on the provided post ID, setting it to the received content.
     *
     * @return array An array indicating the success of the edit operation
     */
    public function editReplyComment(){
      $commnetId = isset($_POST['id']) ? (int) $_POST['id'] : 0;
      $content = isset($_POST['content']) ? $_POST['content'] : '';
      if($commnetId <= 0){
        errorOut("Reply comment Id not found.");
      }
      $result = insertQ('UPDATE comment_reply SET replycomment = ? WHERE id = ?', 'si', array($content, $commnetId));
      return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $commnetId]];
    }

    

    /**
     * To check if the user have shared the post
     *
     * @param Int - $postId
     * @return array An array
     */    
    public function checkIfShared($postId){
      $sql3 = "SELECT id FROM spmessaging WHERE  spPostings_idspPostings = ? and buyerProfileid = ? limit 1";
      $params = [$postId, $_SESSION["pid"]];
      $share = selectQ($sql3, "ii", $params);
      if($share){
        return true;
      }
      else{
        return false;
      }
    }
    
    /**
     * To check if the user has access to the post
     *
     * @param Int - $pid
     * @return array An array
     */    
    public function checkPostAccess($pid, $groupid = 0){
      $sql = 'SELECT t.idspPostings FROM sppostings AS t left join spgroup as spg on t.groupid = spg.idspgroup where (t.groupid = ?) and spcategories_idspcategory = ? and t.idspPostings = ? and (sppostingvisibility = ? or sppostingvisibility in (select spgroup_idspgroup from spprofiles_has_spgroup where spprofiles_idspprofiles = ?) ) and (t.spprofiles_idspprofiles = ? or t.spprofiles_idspprofiles in (select sps.spprofiles_idspprofilesreceiver from `spprofiles_has_spprofiles` sps where sps.spprofiles_has_spprofileflag = ? and ? in ( sps.spprofiles_idspprofilesender,sps.spprofiles_idspprofilesreceiver)) or t.spprofiles_idspprofiles in (select sps1.spprofiles_idspprofilesender from `spprofiles_has_spprofiles` sps1 where sps1.spprofiles_has_spprofileflag = ? and ? in (sps1.spprofiles_idspprofilesender,sps1.spprofiles_idspprofilesreceiver)) or t.spprofiles_idspprofiles in ( SELECT following FROM spuser_follow WHERE follower = ? AND status = ? ) or idsppostings in(select timelineid from share where spsharetowhom = ? and timelineid = ?)) union all select t.idspPostings from sppostings as t left join spgroup as spg on t.groupid = spg.idspgroup where t.idsppostings in (select timelineid from share where spsharetowhom = ? and timelineid = ?)';

      $params = [0, 16, $pid, -1, $_SESSION["pid"], $_SESSION["pid"], 1, $_SESSION["pid"], 1, $_SESSION["pid"], $_SESSION["pid"], 1, $_SESSION["pid"], $pid, $_SESSION["pid"], $pid];
    
      // update param in case of group //--ganesh
      if( $groupid > 0){
       $params = [$groupid, 16, $pid, $groupid, $_SESSION["pid"], $_SESSION["pid"], 1, $_SESSION["pid"], 1, $_SESSION["pid"], $_SESSION["pid"], 1, $_SESSION["pid"], $pid, $_SESSION["pid"], $pid];
      }
      
      $out = selectQ($sql, "iiiiiiiiiiiiiiii", $params);       
      // print_r(debugQ($sql,$params)); exit; //---- ganesh
      // print_r($out); exit;

      if(!empty($out)){
        $out = $out[0];
      }
      return ['data' => $out];
    }
    
    /**
     * To groups list of the user
     *
     * @param String - $name
     * @return array An array
     */    
    public function getGroupsList(){
      if(isset($_GET['searchTerm'])){
        $sql = "SELECT DISTINCT idspGroup, spGroupName FROM spgroup AS t INNER JOIN spprofiles_has_spgroup AS d ON t.idspgroup = d.spgroup_idspgroup INNER JOIN spprofiles AS p ON d.spprofiles_idspprofiles = p.idspprofiles WHERE t.spgroupname  LIKE CONCAT('%', ?, '%')  AND idspgroup IN (SELECT spgroup_idspgroup FROM spprofiles_has_spgroup WHERE spprofiles_idspprofiles IN(SELECT idspprofiles FROM spprofiles WHERE spuser_idspuser =?))  AND d.spapproveregect=? AND d.spprofiles_idspprofiles =?";
        $params = [$_GET['searchTerm'], $_SESSION['uid'], 1, $_SESSION['pid']];
        $out = selectQ($sql, "siii", $params);
        return ['format' => 'skipSuccess', 'data' => $out];
      } else {
        errorOut("search field empty");
      }
    }
    
    /**
     * To friends list of the user
     *
     * @param String - $name
     * @return array An array
     */    
    public function getFriendsList(){
      if(isset($_GET['searchTerm'])){
        $sql = "SELECT * FROM spprofiles AS t INNER JOIN spprofiletype AS d ON t.spprofiletype_idspprofiletype = d.idspprofiletype WHERE t.spprofilename LIKE CONCAT('%', ?, '%') AND (idspprofiles in (SELECT sps.spprofiles_idspprofilesreceiver FROM spprofiles_has_spprofiles sps WHERE sps.spprofiles_has_spprofileflag = ? AND ? IN (sps.spprofiles_idspprofilesender,sps.spprofiles_idspprofilesreceiver)) OR idspprofiles IN (SELECT sps1.spprofiles_idspprofilesender FROM spprofiles_has_spprofiles sps1 WHERE sps1.spprofiles_has_spprofileflag = ? and ? IN (sps1.spprofiles_idspprofilesender,sps1.spprofiles_idspprofilesreceiver))) AND idspprofiles != ?";
        $params = [$_GET['searchTerm'], 1, $_SESSION['pid'], 1, $_SESSION['pid'], $_SESSION['pid']];
        $out = selectQ($sql, "siiiii", $params);
        return ['format' => 'skipSuccess', 'data' => $out];
      } else {
        errorOut("search field empty");
      }
    }
    
    /**
     * To share post
     *
     * @param String - $name
     * @return array An array
     */    
    public function addShare(){
      if(isset($_POST['spPostings_idspPostings']) && $_POST['spPostings_idspPostings'] != ""){
        if(isset($_POST["spShareToWhom"]) || isset($_POST["spShareToGroup"])){
          $flag = 0;
          if(!isset($_POST["spShareToWhom"])){
            $_POST["spShareToWhom"]=0;
          }
          if(!isset($_POST["spShareToGroup"])){
            $_POST["spShareToGroup"] = 0;
          }

          $sql = "SELECT * FROM share WHERE spPostings_idspPostings = ? AND spShareByWhom = ? AND spShareToWhom = ? AND spShareToGroup = ?";
          $out = selectQ($sql, "iiii", [$_POST["spPostings_idspPostings"], $_POST["spShareByWhom"], $_POST["spShareToWhom"], $_POST["spShareToGroup"]]);
          if(!empty($out)){
            $flag++;
          }

          if (isset($_POST["spShareToWhom"]) && is_array($_POST["spShareToWhom"]) && $flag == 0) {
				    $friends_ids = $_POST["spShareToWhom"];
				    foreach($friends_ids as $frnd_id){
					    $arr1 = [];
					    $arr1[] = $_POST["spShareByWhom"];
					    $arr1[] = $frnd_id;
					    $arr1[] = $_POST["spPostings_idspPostings"];
					    $arr1[] = "Shared a Post Click Here";
					    $arr1[] = "Timeline";
              $notId = insertQ('insert into spmessaging (buyerProfileid, sellerProfileid, spPostings_idspPostings, message, module) values (?, ?, ?, ?, ?)', 'iiiss', $arr1);

              $arr3 = [];
              $arr3[] = $_POST["spPostings_idspPostings"];
					    $arr3[] = $_POST['spPostings_idspPostings'];
					    $arr3[] = 0;
					    $arr3[] = $_POST["spShareByWhom"];
					    $arr3[] = $frnd_id;
					    $arr3[] = 0;
					    $arr3[] = isset($_POST['spShareComment']) ? $_POST['spShareComment'] : "";
              $share = insertQ('insert into share (spPostings_idspPostings, timelineid, spCategories_idspCategory, spShareByWhom, spShareToWhom, spShareToGroup, spShareComment) values (?, ?, ?, ?, ?, ?, ?)', 'iiiiiis', $arr3);
					  }
          }

          if (isset($_POST["spShareToGroup"]) && is_array($_POST["spShareToGroup"]) && $flag == 0) {
				    $groups_ids = $_POST["spShareToGroup"];
				    foreach($groups_ids as $group_id){
              $arr1 = [];
					    $arr1[] = $_POST["spShareByWhom"];
					    $arr1[] = $group_id;
					    $arr1[] = $_POST["spPostings_idspPostings"];
					    $arr1[] = "Shared a Post Click Here";
					    $arr1[] = "Timeline";
              $notId = insertQ('insert into spmessaging (buyerProfileid, sellerProfileid, spPostings_idspPostings, message, module) values (?, ?, ?, ?, ?)', 'iiiss', $arr1);

					    $arr2 = [];
					    $arr2[] = $_POST["spPostings_idspPostings"];
					    $arr2[] = $_POST['spPostings_idspPostings'];
					    $arr2[] = 0;
					    $arr2[] = $_POST["spShareByWhom"];
					    $arr2[] = 0;
					    $arr2[] = $group_id;
					    $arr2[] = isset($_POST['spShareComment']) ? $_POST['spShareComment'] : "";
              $share = insertQ('insert into share (spPostings_idspPostings, timelineid, spCategories_idspCategory, spShareByWhom, spShareToWhom, spShareToGroup, spShareComment) values (?, ?, ?, ?, ?, ?, ?)', 'iiiiiis', $arr2);
					  }
          }
          return ['format' => 'skipSuccess', 'data' => 1];
        } else {
          errorOut("Group and Reciever cannot be empty");
        }
      } else {
        errorOut("Invalid post");
      }
    }
    
    /**
     * To get the count of the user's post
     *
    **/
    public function getUserPostCount($pid){
      $sql = 'SELECT count(idspPostings) as total_count FROM sppostings AS t left join spgroup as spg on t.groupid = spg.idspgroup where t.sppostingvisibility= ? and t.spcategories_idspcategory = ? and t.spprofiles_idspprofiles =? and t.bday_pid =?';
      $params = [-1, 16, $pid, $pid];
      $out = selectQ($sql, "iiii", $params);
      if(!empty($out)){
        $out = $out[0];
      }
      return ['data' => $out];
    }
    
    /**
     * check the given job is saved
     *
    **/
    public function getUserPost(){
      $skip = isset($_POST['skip']) ? $_POST['skip'] : 0;
      $profileid = isset($_POST['profileid']) ? trim($_POST['profileid']) : "";
      $access = isset($_POST['access']) ? trim($_POST['access']) : 0;
      if(!empty($profileid)){
        $sql = 'SELECT * FROM sppostings AS t left join spgroup as spg on t.groupid = spg.idspgroup where t.sppostingvisibility= ? and t.spcategories_idspcategory = ? and (t.spprofiles_idspprofiles =? or t.bday_pid =?) order by idspPostings desc limit ?, ?';
        $params = [-1, 16, $profileid, $profileid, $skip, 10];
        $out = selectQ($sql, "iiiiii", $params);
        $fullData = [];
        if(count($out) > 0){
          foreach($out as $post){            
            $post['spPostingNotes'] = $this->turnUrlIntoHyperlink($post['spPostingNotes']);
            $obj = $post;
            $postObject = $this->getPost($post['idspPostings']);
            if($postObject){
              $obj['spProfiles_idspProfiles'] = $postObject['data']["spProfiles_idspProfiles"];
              $userData = $this->readUserId($postObject['data']["spProfiles_idspProfiles"]);
            }
            if(isset($userData['data'])){
              $picture = $userData['data']["spProfilePic"];
              $profilename = $userData['data']["spProfileName"];
            }
            $time = $this->spPostingDate($post["spPostingDate"]);
            $timlinepostpic = $this->readImagePost($post['idspPostings'], $access);
            if($post['bday_post'] == 1){
              $bdayUser = $this->UserInfo($post['bday_pid']);
              if(isset($bdayUser['data']) && isset($bdayUser['data']['spProfileName'])){
                $obj['bdayPid'] = $post['bday_pid'];
                $obj['bdayUser'] = $bdayUser['data']['spProfileName'];
              }
            }
            $album = $this->readAlbum($post['idspPostings']);
            if(isset($album['data']) && !empty($album['data'])){
              $obj['media']['picture'] = $album['data']['spPostingMedia'];
              $obj['media']['sppostingmediaTitle'] = $album['data']['sppostingmediaTitle'];
              $obj['media']['original_name'] = $album['data']['original_name'];
              $obj['media']['sppostingmediaExt'] = $album['data']['sppostingmediaExt'];
            }
            if(isset($picture)){
              $obj['picture'] = $picture;
            }
            if(isset($profilename)){
              $obj['profilename'] = $profilename;
            }
            if(isset($time)){
              $obj['time'] = $time;
            }
            if(isset($timlinepostpic)){
              $obj['timlinepostpic'] = $timlinepostpic;
            }
            $likeCount = $this->getLikesCount($post['idspPostings']);
            $isLiked = false;
            $obj['likeCount'] = 0;
            if(isset($likeCount['total'])){
              $obj['likeCount'] = $likeCount['total'];
              $isLiked = $this->checkIfLiked($post['idspPostings']);
            }
            $obj['isLiked'] = $isLiked;

            $obj['isSaved'] = $this->checkIfSaved($post['idspPostings']);
            $obj['isFlaged'] = $this->chedkIfFlaged($post['idspPostings']);

            $obj['commentsCount'] = 0;
            $commentsCount = $this->getCommentsCount($post['idspPostings']);
            $isCommented = false;
            if(isset($commentsCount['total'])){
              $obj['commentsCount'] = $commentsCount['total'];
              $isCommented = $this->checkIfCommented($post['idspPostings']);
            }
            $obj['isCommented'] = $isCommented;
            $loveCount = $this->getLovesCount($post['idspPostings']);
            $isLoved = false;
            $obj['loveCount'] = 0;
            if(isset($loveCount['total'])){
              $obj['loveCount'] = $loveCount['total'];
              $isLoved = $this->checkIfLoved($post['idspPostings']);  
            }
            $obj['isLoved'] = $isLoved;
            $shareCount = $this->getSharesCount($post['idspPostings']);
            $isShared = false;
            $obj['shareCount'] = 0;
            if(isset($shareCount['total'])){
              $obj['shareCount'] = $shareCount['total'];
              $isShared = $this->checkIfShared($post['idspPostings']);  
            }
            $obj['isShared'] = $isShared;
            $fullData[] = $obj;
          }
        }
        $postCount = $this->getUserPostCount($profileid);
        $count = 0;
        if(isset($postCount['data']) && isset($postCount['data']['total_count'])){
          $count = $postCount['data']['total_count'];
        }
        return ['format' => 'skipSuccess', 'data' => ['count' => $count, 'post' => $fullData]];
      } else {
         errorOut("Invalid User");
      }
    }
    
}

