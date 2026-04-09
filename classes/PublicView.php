<?php

class PublicView extends Base{
  
  /**
   * To get the profile details of the user
   *
  **/
  public function readProfileInfo($pid){
    $sql = 'select profile.*, profiletype.*, user.*, profile.spProfileName AS profile_name, profile.spProfilePic AS profile_pic from spprofiles as profile inner join spprofiletype as profiletype on profile.spprofiletype_idspprofiletype = profiletype.idspprofiletype inner join spuser as user on profile.spUser_idspUser = user.idspUser  where profile.idspProfiles = ? order by profiletype.idspProfileType';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the business profile details of the user
   *
  **/
  public function readBusinessInfo($pid){
    $sql = 'select * from spbusiness_profile where spprofiles_idspProfiles = ? order by id desc limit 1';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the freelancer category of the user by categoryid
   *
  **/
  public function readCategoryById($cid){
    $sql = 'select * from subcategory where idsubCategory = ?';
    $params = [$cid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the user's eductaion details
   *
  **/
  public function getUserEducation(){
    $profileid = isset($_POST['profileid']) ? trim($_POST['profileid']) : "";
    if(!empty($profileid)){
      $sql = 'select * from employment_education where idspProfiles = ?';
      $params = [$profileid];
      $out = selectQ($sql, "i", $params);
      return ['format' => 'skipSuccess', 'data' => $out];
    } else {
      errorOut("Invalid User");
    }
  }
  
  /**
   * To get the user's family members
   *
  **/
  public function getUserFamilyMembers(){
    $profileid = isset($_POST['profileid']) ? trim($_POST['profileid']) : "";
    if(!empty($profileid)){
      $sql = 'select * from add_family_relation where pid = ?';
      $params = [$profileid];
      $out = selectQ($sql, "i", $params);
      return ['format' => 'skipSuccess', 'data' => $out];
    } else {
      errorOut("Invalid User");
    }
  }
  
  /**
   * To get the users's work experiences
   *
  **/
  public function getUserExperience(){
    $profileid = isset($_POST['profileid']) ? trim($_POST['profileid']) : "";
    $skip = isset($_POST['skip']) ? $_POST['skip'] : 0;
    $limit = isset($_POST['limit']) ? $_POST['limit'] : 2;
    if(!empty($profileid)){
      $sql = 'select exp.*, city.city_title, state.state_title, country.country_title from employment_experience as exp left join tbl_city as city on exp.city = city.city_id left join tbl_state as state on exp.state = state.state_id left join tbl_country as country on exp.country = country.country_id where exp.idsp_pid = ? limit ?,?';
      $params = [$profileid, $skip, $limit];
      $out = selectQ($sql, "iii", $params);
      $count = 0;
      $ExpCount = $this->getUserExperienceCount($profileid);
      if($ExpCount['data']){
        $count = $ExpCount['data']['total_count'];
      }
      return ['format' => 'skipSuccess', 'data' => ['experience' => $out, 'count' => $count]];
    } else {
      errorOut("Invalid User");
    }
  }
  
  /**
   * To get the user's experience count
   *
  **/
  public function getUserExperienceCount($pid){
    $sql = 'select count(id) as total_count from employment_experience where idsp_pid = ?';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the freelancer profile details of the user
   *
  **/
  public function readFreelancerInfo($pid){
    $sql = 'select * from spfreelancer_profile where spprofiles_idspprofiles = ? order by id desc limit 1';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the employement profile details of the user
   *
  **/
  public function readEmployeeInfo($pid){
    $sql = 'select * from spemployment_profile as t 
      LEFT JOIN spprofiles as p ON p.idspProfiles  = t.spprofiles_idspProfiles  
      LEFT JOIN subcategory as c ON c.idsubCategory  = t.spPostingJobType
      WHERE t.spprofiles_idspProfiles = ? order by id desc limit 1';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the family profile details of the user
   *
  **/
  public function readFamilyInfo($pid){
    $sql = 'select * from spfamily_profile where spprofiles_idspProfiles = ? order by id desc limit 1';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }

  public function getDefaultResume($pid){
    $sql = 'SELECT * FROM spboard_resumes AS t where pid = ? and default_resume = 1';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    if(count($out) == 0){
      $sql = 'SELECT * FROM spboard_resumes AS t where pid = ? LIMIT 1';
      $params = [$pid];
      $out = selectQ($sql, "i", $params);
      if(!empty($out)){
        $out = $out[0];
      }
    }
    
    return $out;
  }
  
  /**
   * To get the count of the user's project
   *
  **/
  public function getUserJobCount($profileid){
    if(isset($profileid)){
      $sql = 'SELECT count(*) as total_count FROM spjobboard where spprofiles_idspprofiles = ? and sppostingvisibility = ? and flag_status= ?';
      $params = [$profileid, -1, 2];
      $out = selectQ($sql, "iii", $params);
      if(!empty($out)){
        $out = $out[0];
      }
      return ['data' => $out];
    } else {
      errorOut("Invalid User");
    }
  }
  
  /**
   * To list the jobs posted by the user
   *
  **/
  public function listPostedJobs(){
    $skip = isset($_POST['skip']) ? $_POST['skip'] : 0;
    $profileid = isset($_POST['profileid']) ? trim($_POST['profileid']) : "";
    if(!empty($profileid)){
      $sql = 'SELECT * FROM spjobboard where spprofiles_idspprofiles = ? and sppostingvisibility = ? and flag_status= ? order by idsppostings desc limit ?,?';
      $params = [$_POST['profileid'], -1, 2, $skip, 10];
      $out = selectQ($sql, "iiiii", $params);
      $total = [];
      if(count($out) > 0){
        foreach($out as $job){
          $data = $job;
          if($job['idspPostings']){
            $saved = $this->checkSavedJob($job['idspPostings']);
            if($saved){
              $data['issaved'] = 1;
            } else {
              $data['issaved'] = 0;
            }
            $data['location'] = [];
            if($job['spPostingsCity']){
              $city = $this->getCityName($job['spPostingsCity']);
              if(isset($city['data'])){
                $data['location'][] = $city['data']['city_title'];
              }
            }
            if($job['spPostingsState']){
              $state = $this->getStateName($job['spPostingsState']);
              if(isset($state['data'])){
                $data['location'][] = $state['data']['state_title'];
              }
            }
            if($job['spPostingsCountry']){
              $country = $this->getCountryName($job['spPostingsCountry']);
              if(isset($country['data'])){
                $data['location'][] = $country['data']['country_title'];
              }
            }
          }
          $total[] = $data;
        }
      }
      $count = 0;
      $jobCount = $this->getUserJobCount($profileid);
      if(isset($jobCount['data']) && isset($jobCount['data']['total_count'])){
        $count = $jobCount['data']['total_count'];
      }
      return ['format' => 'skipSuccess', 'data' => ['count' => $count, 'job' => $total]];
    } else {
      errorOut("Invalid profileId");
    }
  }
  
  /**
   * To get the country based on country id
   *
  **/
  public function getCountryName($cid){
    $sql = 'SELECT * FROM tbl_country where country_id = ?';
    $params = [$cid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the state based on the state id
   *
  **/
  public function getStateName($sid){
    $sql = 'SELECT * FROM tbl_state where state_id = ?';
    $params = [$sid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the city based on the city id
   *
  **/
  public function getCityName($cid){
    $sql = 'SELECT * FROM tbl_city where city_id = ?';
    $params = [$cid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * check the given job is saved
   *
  **/
  public function checkSavedJob($jid){
    $sql = 'SELECT * FROM jobboard_save where spprofiles_idspprofiles = ? and sppostings_idsppostings = ? and save_status = ?';
    $params = [$_SESSION['pid'], $jid, 1];
    $out = selectQ($sql, "iii", $params);
    if(!empty($out)){
      return true;
    } else {
      return false;
    }
  }
  
  /**
   * To save the job
   *
  **/
  public function saveJob(){
    if(isset($_POST['postid'])){
      $arr = [];
      $arr[] = $_POST["postid"];
      $arr[] = $_SESSION['pid'];
      $arr[] = 1;
      $savedJob = insertQ('insert into jobboard_save (spPostings_idspPostings, spProfiles_idspProfiles, save_status) values (?, ?, ?)', 'iii', $arr);
      return ['format' => 'skipSuccess', 'data' => $savedJob];
    } else {
      errorOut("Invalid post");
    }
  }
  
  /**
   * To save the job
   *
  **/
  public function unsaveJob(){
    if(isset($_POST['postid'])){
      $arr = [];
      $arr[] = $_POST["postid"];
      $arr[] = $_SESSION['pid'];
      $savedJob = insertQ('delete from jobboard_save where spPostings_idspPostings = ? and spProfiles_idspProfiles = ?', 'ii', $arr);
      return ['format' => 'skipSuccess', 'data' => $savedJob];
    } else {
      errorOut("Invalid post");
    }
  }
  
  /**
   * To get the user's media
   *
  **/
  public function getUserMedia(){
    $skip = isset($_POST['skip']) ? $_POST['skip'] : 0;
    $profileid = isset($_POST['profileid']) ? trim($_POST['profileid']) : "";
    if(!empty($profileid)){
      $sql = 'SELECT * FROM sppostingpics AS t inner join sppostings as g on g.idsppostings = t.sppostings_idsppostings where g.spprofiles_idspprofiles = ? order by idspPostingPic desc limit ?,?';
      $params = [$profileid, $skip, 16];
      $out = selectQ($sql, "iii", $params);
      $count = 0;
      $mediaCount = $this->getUserMediaCount($profileid);
      if(isset($mediaCount['data']) && isset($mediaCount['data']['total_count'])){
        $count = $mediaCount['data']['total_count'];
      }
      return ['format' => 'skipSuccess', 'data' => ['count' => $count, 'media' => $out]];
    } else {
       errorOut("Invalid User");
    }
  }
  
  /**
   * To get the user's projects
   *
  **/
  public function getUserProject(){
    $skip = isset($_POST['skip']) ? $_POST['skip'] : 0;
    $profileid = isset($_POST['profileid']) ? trim($_POST['profileid']) : "";
    if(!empty($profileid)){
      $sql = 'SELECT * FROM spfreelancer AS t where sppostingvisibility = ? and spcategories_idspcategory = ? AND spProfiles_idspProfiles = ? AND complete_status=? ORDER BY idspPostings DESC limit ?, ?';
      $params = [-1, 5, $profileid, 0, $skip, 10];
      $out = selectQ($sql, "iiiiii", $params);
      $count = 0;
      $projectCount = $this->getUserProjectCount($profileid);
      if(isset($projectCount['data']) && isset($projectCount['data']['total_count'])){
        $count = $projectCount['data']['total_count'];
      }
      return ['format' => 'skipSuccess', 'data' => ['count' => $count, 'project' => $out]];
    } else {
       errorOut("Invalid User");
    }
  }
  
  /**
   * To get the user's real-estate
   *
  **/
  public function getUserRealestate(){
    $skip = isset($_POST['skip']) ? $_POST['skip'] : 0;
    $profileid = isset($_POST['profileid']) ? trim($_POST['profileid']) : "";
    if(!empty($profileid)){
      $sql = 'SELECT * FROM sprealstate WHERE sppostingvisibility = ? AND sppostlisting = ? AND spprofiles_idspprofiles = ? AND (sppostingpropstatus = ? OR sppostingpropstatus = ? OR sppostingpropstatus IS NULL) ORDER BY sppostingdate DESC LIMIT ?, ?';
      $params = [-1, 'sell', $profileid, 'active', '', $skip, 10];
      $out = selectQ($sql, "isissii", $params);
      $count = 0;
      $propertyCount = $this->getUserRealestateCount($profileid);
      if(isset($propertyCount['data']) && isset($propertyCount['data']['total_count'])){
        $count = $propertyCount['data']['total_count'];
      }
      return ['format' => 'skipSuccess', 'data' => ['count' => $count, 'property' => $out]];
    } else {
       errorOut("Invalid User");
    }
  }
  
   /**
   * To get the user's real-estate count
   *
  **/
  public function getUserRealestateCount($profileid){
    if(isset($profileid)){
      $sql = 'SELECT count(idspPostings) as total_count FROM sprealstate WHERE sppostingvisibility = ? AND sppostlisting = ? AND spprofiles_idspprofiles = ? AND (sppostingpropstatus = ? OR sppostingpropstatus = ? OR sppostingpropstatus IS NULL)';
      $params = [-1, 'sell', $profileid, 'active', ''];
      $out = selectQ($sql, "isiss", $params);
      if(!empty($out)){
        $out = $out[0];
      }
      return ['data' => $out];
    } else {
       errorOut("Invalid User");
    }
  }
  
   /**
   * To get the user's products
   *
  **/
  public function getUserProduct(){
    $skip = isset($_POST['skip']) ? $_POST['skip'] : 0;
    $profileid = isset($_POST['profileid']) ? trim($_POST['profileid']) : "";
    if(!empty($profileid)){
      $sql = 'SELECT * FROM spproduct where sppostingvisibility = ? and spprofiles_idspprofiles = ? and spcategories_idspcategory = ? ORDER BY spPostingDate DESC LIMIT ?, ?';
      $params = [-1, $profileid, 1, $skip, 10];
      $out = selectQ($sql, "iiiii", $params);
      $count = 0;
      $productCount = $this->getUserProductCount($profileid);
      if(isset($productCount['data']) && isset($productCount['data']['total_count'])){
        $count = $productCount['data']['total_count'];
      }
      return ['format' => 'skipSuccess', 'data' => [ 'count' => $count, 'product' => $out ]];
    } else {
       errorOut("Invalid User");
    }
  }
  
  /**
   * To get the user's product count
   *
  **/
  public function getUserProductCount($profileid){
    if(isset($profileid)){
      $sql = 'SELECT count(idspPostings) as total_count FROM spproduct where sppostingvisibility = ? and spprofiles_idspprofiles = ? and spcategories_idspcategory = ?';
      $params = [-1, $profileid, 1];
      $out = selectQ($sql, "iii", $params);
      if(!empty($out)){
        $out = $out[0];
      }
      return ['data' => $out];
    } else {
       errorOut("Invalid User");
    }
  }
  
  /**
   * To get the user's projects count
   *
  **/
  public function getUserProjectCount($profileid){
    if(isset($profileid)){
      $sql = 'SELECT count(idspPostings) as total_count FROM spfreelancer where sppostingvisibility = ? and spcategories_idspcategory = ? AND spProfiles_idspProfiles = ? AND complete_status=?';
      $params = [-1, 5, $profileid, 0];
      $out = selectQ($sql, "iiii", $params);
      if(!empty($out)){
        $out = $out[0];
      }
      return ['data' => $out];
    } else {
       errorOut("Invalid User");
    }
  }
  
  /**
   * To get the count of the user's media
   *
  **/
  public function getUserMediaCount($pid){
    $sql = 'SELECT count(idspPostingPic) as total_count FROM sppostingpics AS t inner join sppostings as g on g.idsppostings = t.sppostings_idsppostings where g.spprofiles_idspprofiles = ?';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the count of the user's document
   *
  **/
  public function getUserDocCount($pid){
    $sql = "SELECT count(idspPostingMedia) as total_count FROM sppostingmedia AS t left join sppostingalbum as d on t.spf_id = d.idsppostingalbum where t.spProfiles_idspProfiles = ? and t.spPostingMedia_delete = ? and t.sppostingmediaExt in ('pdf', 'doc', 'docx', 'xls', 'txt')";
    $params = [$pid, 0];
    $out = selectQ($sql, "ii", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To check if the user is blocked
   *
  **/
  public function checkBlock($pid, $friendid){
    $sql = "SELECT * FROM spprofile_feature WHERE idspprofile_by = ? and idspprofile_to = ? and spfeature_block = ?";
    $params = [$pid, $friendid, 1];
    $out = selectQ($sql, "iii", $params);
    if(!empty($out)){
      return true;
    } else {
      return false;
    }
  }
  
  /**
   * To check if two users are friends
   *
  **/
  public function checkFriend($sender, $receiver){

    $sql = "SELECT * FROM spprofiles_has_spprofiles WHERE (spprofiles_idspprofilesreceiver = ? AND spprofiles_idspprofilesender= ?) OR (spprofiles_idspprofilesreceiver = ? AND spprofiles_idspprofilesender= ?)";
    $params = [$sender, $receiver, $receiver, $sender];
    $out = selectQ($sql, "iiii", $params);
    
    if(!empty($out)){
      return $out ;//true;
    } else {
      return false ; //false;
    }
  }


  public function checkFriendGroup($sender, $receiver){

    $sql = "SELECT * FROM spprofiles_has_spprofiles WHERE (spprofiles_idspprofilesreceiver = ? AND spprofiles_idspprofilesender= ?) OR (spprofiles_idspprofilesreceiver = ? AND spprofiles_idspprofilesender= ?)";
    $params = [$sender, $receiver, $receiver, $sender];
    $out = selectQ($sql, "iiii", $params);
    
    if(!empty($out)){
      return true;
    } else {
      return false ; //false;
    }
  }

  
  /**
   * To get the user's document
   *
  **/
  public function getUserDocs(){
    $skip = isset($_POST['skip']) ? $_POST['skip'] : 0;
    $profileid = isset($_POST['profileid']) ? trim($_POST['profileid']) : "";
    if(!empty($profileid)){
      $sql = "SELECT * FROM sppostingmedia AS t LEFT JOIN sppostingalbum AS d ON t.spf_id = d.idsppostingalbum WHERE t.spProfiles_idspProfiles =? AND t.spPostingMedia_delete = ? AND t.sppostingmediaExt IN ('pdf', 'doc', 'docx', 'xls', 'txt') ORDER BY t.idspPostingMedia DESC LIMIT ?, ?";
      $params = [$profileid, 0, $skip, 16];
      $out = selectQ($sql, "iiii", $params);
      $count = 0;
      $docCount = $this->getUserDocCount($profileid);
      if(isset($docCount['data']) && isset($docCount['data']['total_count'])){
        $count = $docCount['data']['total_count'];
      }
      return ['format' => 'skipSuccess', 'data' => [ 'count' => $count, 'doc' => $out ]];
    } else {
       errorOut("Invalid User");
    }
  }
  
  /**
   * To block a user
   *
  **/
  public function blockUser(){
    $userby = isset($_POST['userby']) ? trim($_POST['userby']) : "";
    $userto = isset($_POST['userto']) ? trim($_POST['userto']) : "";
    if(!empty($userby) && !empty($userto)){
      $arr = [];
      $arr[] = $userby;
      $arr[] = $userto;
      $arr[] = 1;
      $block = insertQ('insert into spprofile_feature (idspProfile_by, idspProfile_to, spfeature_block) values (?, ?, ?)', 'iii', $arr);
      return ['format' => 'skipSuccess', 'data' => $block];
    } else {
       errorOut("Invalid Users");
    }
  }
  
  /**
   * To send friend request
   *
  **/
  public function addFriend(){
    $sender = isset($_POST['sender']) ? trim($_POST['sender']) : "";
    $receiver = isset($_POST['receiver']) ? trim($_POST['receiver']) : "";
    if(!empty($sender) && !empty($receiver)){
      $arr = [];
      $arr[] = $sender;
      $arr[] = $receiver;
      $request = insertQ('insert into spprofiles_has_spprofiles (spProfiles_idspProfileSender, spProfiles_idspProfilesReceiver, Profile_request_date) values (?, ?, NOW())', 'ii', $arr);
      return ['format' => 'skipSuccess', 'data' => $request];
    } else {
       errorOut("Invalid Users");
    }
  }
  
  /**
   * To follow a user
   *
  **/
  public function follow(){
    $follower = isset($_POST['follower']) ? trim($_POST['follower']) : "";
    $following = isset($_POST['following']) ? trim($_POST['following']) : "";
    if(!empty($follower) && !empty($following)){
      $arr = [];
      $arr[] = $follower;
      $arr[] = $following;
      $arr[] = 1;
      $follow = insertQ('insert into spuser_follow (follower, following, status, created_date) values (?, ?, ?, NOW())', 'iii', $arr);
      return ['format' => 'skipSuccess', 'data' => $follow];
    } else {
       errorOut("Invalid Users");
    }
  }
  
   /**
   * To unfollow a user
   *
  **/
  public function unfollow(){
    $follower = isset($_POST['follower']) ? trim($_POST['follower']) : "";
    $following = isset($_POST['following']) ? trim($_POST['following']) : "";
    if(!empty($follower) && !empty($following)){
      $arr = [];
      $arr[] = $follower;
      $arr[] = $following;
      $follow = insertQ('delete from spuser_follow where follower = ? and following = ?', 'ii', $arr);
      return ['format' => 'skipSuccess', 'data' => $follow];
    } else {
       errorOut("Invalid Users");
    }
  }
  
  /**
   * To accept friend request
   *
  **/
  public function acceptFriend(){
    $sender = isset($_POST['sender']) ? trim($_POST['sender']) : "";
    $receiver = isset($_POST['receiver']) ? trim($_POST['receiver']) : "";
    if(!empty($sender) && !empty($receiver)){
      $arr = [];
      $arr[] = 1;
      $arr[] = $sender;
      $arr[] = $receiver;
      $request = insertQ('update spprofiles_has_spprofiles set spProfiles_has_spProfileFlag = ? where spProfiles_idspProfileSender = ? and spProfiles_idspProfilesReceiver = ?', 'iii', $arr);
      return ['format' => 'skipSuccess', 'data' => $request];
    } else {
       errorOut("Invalid Users");
    }
  }
  
  /**
   * To unblock a user
   *
  **/
  public function removeRequest(){
    $sender = isset($_POST['sender']) ? trim($_POST['sender']) : "";
    $receiver = isset($_POST['receiver']) ? trim($_POST['receiver']) : "";
    if(!empty($sender) && !empty($receiver)){
      $arr = [];
      $arr[] = $sender;
      $arr[] = $receiver;
      $block = insertQ('delete from spprofiles_has_spprofiles where spProfiles_idspProfileSender = ? and spProfiles_idspProfilesReceiver = ?', 'ii', $arr);
      return ['format' => 'skipSuccess', 'data' => $block];
    } else {
       errorOut("Invalid Users");
    }
  }
  
  /**
   * To unfriend a user
   *
  **/
  public function unfriend() {
    $sender = isset($_POST['sender']) ? trim($_POST['sender']) : "";
    $receiver = isset($_POST['receiver']) ? trim($_POST['receiver']) : "";
    if (!empty($sender) && !empty($receiver)) {
      $arr = [];
      $arr[] = $sender;
      $arr[] = $receiver;
      $arr[] = $receiver;
      $arr[] = $sender;
      $sql = 'DELETE FROM spprofiles_has_spprofiles WHERE (spProfiles_idspProfileSender = ? AND spProfiles_idspProfilesReceiver = ?) OR (spProfiles_idspProfileSender = ? AND spProfiles_idspProfilesReceiver = ?)';
      $block = insertQ($sql, 'iiii', $arr);
      return ['format' => 'skipSuccess', 'data' => $block];
    } else {
      errorOut("Invalid Users");
    }
  }
  
  /**
   * To unblock a user
   *
  **/
  public function unBlockUser(){
    $userby = isset($_POST['userby']) ? trim($_POST['userby']) : "";
    $userto = isset($_POST['userto']) ? trim($_POST['userto']) : "";
    if(!empty($userby) && !empty($userto)){
      $arr = [];
      $arr[] = $userby;
      $arr[] = $userto;
      $arr[] = 1;
      $block = insertQ('delete from spprofile_feature where idspProfile_by = ? and idspProfile_to = ? and spfeature_block = ?', 'iii', $arr);
      return ['format' => 'skipSuccess', 'data' => $block];
    } else {
       errorOut("Invalid Users");
    }
  }
  
  /**
   * To get the user's portfolio
   *
  **/
  public function getUserPorfolio(){
    $userid = isset($_POST['userid']) ? trim($_POST['userid']) : "";
    $profiletype = isset($_POST['profiletype']) ? trim($_POST['profiletype']) : "";
    if(!empty($userid)){
      if(!empty($profiletype)){
        $sql = 'SELECT * FROM freelancer_newfield where spUid = ? and '.$profiletype.' = 1';
        $params = [$userid];
        $out = selectQ($sql, "i", $params);
        $fullData = [];
        if($out && count($out) > 0){
          foreach($out as $porfolio){
            $sql = 'SELECT * FROM spportfolio_image where portfolio_id = ?';
            $params = [$porfolio['id']];
            $pic = selectQ($sql, "i", $params);
            if($pic){
              $porfolio['image'] = $pic[0]['image'];
            }
            $fullData[] = $porfolio;
          }
        }
        return ['format' => 'skipSuccess', 'data' => $fullData];
      } else {
       errorOut("Invalid Profile type");
      }
    } else {
       errorOut("Invalid User");
    }
  }
  
}
?>
