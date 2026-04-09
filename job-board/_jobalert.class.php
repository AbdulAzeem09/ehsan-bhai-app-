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
        $this->ta = new _tableadapter("job_alert");
       
    }
    public function insertJobAlert(){
        return $this->ta->create( [ 'spuserId' => '1','postId' => '2','email' => '3' ] );
    }
}

?>
