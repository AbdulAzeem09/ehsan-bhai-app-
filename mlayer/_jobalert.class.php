<?php
class _jobalert {

    // property declaration
    // idspPostings, spPostingTitle, spPostingNotes, spPostingExpDt, spPostingPrice, spPostingEmail, spPostingPhone, spPostingVisibility, spPostingDate, spProfiles_idspProfiles, spCategories_idspCategory
    public $dbclose = false;
    private $conn;
    public $ta;
    public $pic;
    public $tad;

    function __construct() {
        $this->jobalert = new _tableadapter("job_alert");
    }

    public function insertJobAlert($array){
        return $this->jobalert->create($array);  
    }

    public function readJobAlert($query){
        return $this->jobalert->read($query);
        // echo $this->jobalert->sql; die("--------------");
    }
}

?>





