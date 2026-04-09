
<?php

class _resumeget {

    // property declaration
    // idspPostings, spPostingTitle, spPostingNotes, spPostingExpDt, spPostingPrice, spPostingEmail, spPostingPhone, spPostingVisibility, spPostingDate, spProfiles_idspProfiles, spCategories_idspCategory
    public $dbclose = false;
    private $conn;
    public $ta;
    public $pic;
    public $tad;
    public $pid;
	public $spuid;
	public $query;

    function __construct() {
        $this->jobforapply = new _tableadapter("job_apply");
        $this->resume = new _tableadapter("spboard_resumes");
        $this->ta = new _tableadapter("spbrowseresume");
        $this->sa = new _tableadapter("spsaveresume");
        $this->fa = new _tableadapter("spfavresume");
        $this->jsf = new _tableadapter("job_fav_save");
	    //$this->brows->join = "LEFT JOIN job_apply ON spbrowseresume.resume = job_apply.id";
		//$this->brows->join = "LEFT JOIN job_apply as d ON t.resume = d.id";
    }
  
    public function resume($spuid) { 
        return $this->jobforapply->read("WHERE uid = '$spuid' and resume_deleted = 0");
    }

    public function get_sp_resume($spid) { 
        return $this->resume->read("WHERE pid = '$spid' and resume_deleted = 0");
        // echo $this->resume->sql;die();
    }

    public function create_sp_resume($data) { 
        return $this->resume->create($data);
    }
	
    public function browseresume($uid) {
        // Assuming $uid is safely escaped or sanitized elsewhere
        // $uid = $this->brows->escapeString($uid);
	    return $this->ta->read("LEFT JOIN job_apply as d ON t.resume  = d.id WHERE t.uid = " . $uid);
    }

    public function faveresume($uid) {
        // Assuming $uid is safely escaped or sanitized elsewhere
        // $uid = $this->brows->escapeString($uid);
	    return $this->fa->read("LEFT JOIN job_apply as d ON t.resume  = d.id WHERE t.uid = " . $uid);
    }

    public function saveresume($uid) {
        // Assuming $uid is safely escaped or sanitized elsewhere
        // $uid = $this->brows->escapeString($uid);
	    return $this->sa->read("LEFT JOIN job_apply as d ON t.resume  = d.id WHERE t.uid = " . $uid);
    }
   
    public function get_apply_count($uid) {
        $result = $this->jobforapply->read("WHERE uid = '$uid'");
        return $result ? $result->num_rows : 0;
    }

    public function browseAllResume($results_per_page, $offset, $keyword = null, $category = null){
        $country = $_SESSION['Countryfilter'];
        $state = $_SESSION['Statefilter'];
        $categoryWhere = ($category) ? " AND ep.spPostingJobType = $category" : "";
        $keywordWhere = ($keyword) ? " AND p.spProfileName LIKE '%$keyword%'" : "";
        return $this->resume->read(" 
            LEFT JOIN spemployment_profile as ep ON ep.spprofiles_idspProfiles = t.pid 
            LEFT JOIN subcategory as c ON c.idsubCategory = ep.spPostingJobType 
            LEFT JOIN spprofiles as u ON u.spUser_idspUser = t.uid 
            LEFT JOIN spprofiles as p ON p.idspProfiles = t.pid 
            WHERE t.status = 'active' 
            AND u.spProfilesCountry = '$country' 
            AND u.spProfilesState = '$state' 
            $categoryWhere $keywordWhere 
            AND p.profile_status = 'public' 
            AND p.spProfileType_idspProfileType = 5 
            AND u.spProfileType_idspProfileType = 4 
            GROUP BY p.idspProfiles
            LIMIT $offset, $results_per_page"
        );
    }

    public function browseAllResumeCount($keyword = null, $category = null){
        $country = $_SESSION['Countryfilter'];
        $state = $_SESSION['Statefilter'];
        $categoryWhere = ($category) ? " AND ep.spPostingJobType = $category" : "";
        $keywordWhere = ($keyword) ? " AND p.spProfileName LIKE '%$keyword%'" : "";
        return $this->resume->read("
            LEFT JOIN spemployment_profile as ep ON ep.spprofiles_idspProfiles = t.pid 
            LEFT JOIN subcategory as c ON c.idsubCategory = ep.spPostingJobType 
            LEFT JOIN spprofiles as u ON u.spUser_idspUser = t.uid 
            LEFT JOIN spprofiles as p ON p.idspProfiles = t.pid
            WHERE t.status = 'active' 
            AND u.spProfilesCountry = '$country' 
            AND u.spProfilesState = '$state'
            $categoryWhere $keywordWhere 
            AND p.profile_status = 'public' 
            AND p.spProfileType_idspProfileType = 5
            AND u.spProfileType_idspProfileType = 4
            GROUP BY p.idspProfiles"
        );
    }

    public function get_job_save_fav($pid, $spuid) {
        return $this->jsf->read("WHERE uid = '$spuid' and pid = '$pid'");
    }

    public function browseSavedResume( $uid, $keyword = null, $category = null){
        $country = $_SESSION['Countryfilter'];
        $state = $_SESSION['Statefilter'];
        $categoryWhere = ($category) ? " AND ep.spPostingJobType = $category" : "";
        $keywordWhere = ($keyword) ? " AND p.spProfileName LIKE '%$keyword%'" : "";
        return $this->resume->read("
            LEFT JOIN spemployment_profile as ep ON ep.spprofiles_idspProfiles = t.pid 
            LEFT JOIN subcategory as c ON c.idsubCategory = ep.spPostingJobType 
            LEFT JOIN job_fav_save as sf ON sf.pid = t.pid  
            LEFT JOIN spprofiles as u ON u.spUser_idspUser = t.uid 
            LEFT JOIN spprofiles as p ON p.idspProfiles = t.pid 
            WHERE t.status = 'active' 
            AND u.spProfilesCountry = '$country' 
            AND u.spProfilesState = '$state'
            $categoryWhere $keywordWhere 
            AND p.profile_status = 'public' 
            AND p.spProfileType_idspProfileType = 5 
            AND u.spProfileType_idspProfileType = 4
            AND sf.uid = '$uid' 
            AND sf.save = 1
            GROUP BY p.idspProfiles"
        );
    }

    public function browseSaveResumeCount($uid, $keyword = null, $category = null){
        $country = $_SESSION['Countryfilter'];
        $state = $_SESSION['Statefilter'];
        $categoryWhere = ($category) ? " AND ep.spPostingJobType = $category" : "";
        $keywordWhere = ($keyword) ? " AND p.spProfileName LIKE '%$keyword%'" : "";
        return $this->resume->read("
            LEFT JOIN spemployment_profile as ep ON ep.spprofiles_idspProfiles = t.pid 
            LEFT JOIN subcategory as c ON c.idsubCategory = ep.spPostingJobType 
            LEFT JOIN job_fav_save as sf ON sf.pid = t.pid  
            LEFT JOIN spprofiles as u ON u.spUser_idspUser = t.uid 
            LEFT JOIN spprofiles as p ON p.idspProfiles = t.pid 
            WHERE t.status = 'active' 
            AND u.spProfilesCountry = '$country' 
            AND u.spProfilesState = '$state' 
            $categoryWhere $keywordWhere 
            AND p.profile_status = 'public' 
            AND p.spProfileType_idspProfileType = 5 
            AND u.spProfileType_idspProfileType = 4
            AND sf.uid = '$uid' 
            AND sf.save = 1
            GROUP BY p.idspProfiles"
        );
    }

    public function browseFavResume( $uid, $keyword = null, $category = null){
        $country = $_SESSION['Countryfilter'];
        $state = $_SESSION['Statefilter'];
        $categoryWhere = ($category) ? " AND ep.spPostingJobType = $category" : "";
        $keywordWhere = ($keyword) ? " AND p.spProfileName LIKE '%$keyword%'" : "";
        return $this->resume->read("
            LEFT JOIN spemployment_profile as ep ON ep.spprofiles_idspProfiles = t.pid 
            LEFT JOIN subcategory as c ON c.idsubCategory = ep.spPostingJobType 
            LEFT JOIN job_fav_save as sf ON sf.pid  = t.pid  
            LEFT JOIN spprofiles as u ON u.spUser_idspUser = t.uid 
            LEFT JOIN spprofiles as p ON p.idspProfiles = t.pid 
            WHERE t.status = 'active' 
            AND u.spProfilesCountry = '$country' 
            AND u.spProfilesState = '$state'
            $categoryWhere $keywordWhere 
            AND p.profile_status = 'public' 
            AND p.spProfileType_idspProfileType = 5 
            AND u.spProfileType_idspProfileType = 4
            AND sf.uid = '$uid' 
            AND sf.fav = 1
            GROUP BY p.idspProfiles"
        );
    }

    public function browseFavResumeCount($uid, $keyword = null, $category = null){
        $country = $_SESSION['Countryfilter'];
        $state = $_SESSION['Statefilter'];
        $categoryWhere = ($category) ? " AND ep.spPostingJobType = $category" : "";
        $keywordWhere = ($keyword) ? " AND p.spProfileName LIKE '%$keyword%'" : "";
        return $this->resume->read("
            LEFT JOIN spemployment_profile as ep ON ep.spprofiles_idspProfiles = t.pid 
            LEFT JOIN subcategory as c ON c.idsubCategory = ep.spPostingJobType 
            LEFT JOIN job_fav_save as sf ON sf.pid = t.pid  
            LEFT JOIN spprofiles as u ON u.spUser_idspUser = t.uid 
            LEFT JOIN spprofiles as p ON p.idspProfiles = t.pid 
            WHERE t.status = 'active' 
            AND u.spProfilesCountry = '$country' 
            AND u.spProfilesState = '$state'
            $categoryWhere $keywordWhere 
            AND p.profile_status = 'public' 
            AND p.spProfileType_idspProfileType = 5 
            AND u.spProfileType_idspProfileType = 4
            AND sf.uid = '$uid' 
            AND sf.fav = 1
            GROUP BY p.idspProfiles"
        );
    }

    public function insertResumeSaveFav($array){
        return $this->jsf->create($array);  
    }

    public function updateResumeSaveFav($array, $where){
        return $this->jsf->update($array, $where);  
    }
}


?>





