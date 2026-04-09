<?php

class _coverletter {

    // property declaration
    // idspPostings, spPostingTitle, spPostingNotes, spPostingExpDt, spPostingPrice, spPostingEmail, spPostingPhone, spPostingVisibility, spPostingDate, spProfiles_idspProfiles, spCategories_idspCategory
    public $dbclose = false; 
    private $conn;
    public $ta;
    public $pic;
    public $tad;
    public $pid; 
	public $uid;


    function __construct() {
        $this->jobapply = new _tableadapter("job_coverletter");
        $this->jobforapply = new _tableadapter("job_apply");
        $this->applycoverletter = new _tableadapter("job_coverletter");
        
    }
    public function check_duplicate($spuid,$job_id) {
        $query = "WHERE job_id = '$job_id' and pid = '$spuid'";
        return $this->jobforapply->read($query);
     }
    public function updateJobApply($array,$id){ 
	
        return $this->jobforapply->update($array, " WHERE id = '$id'"); 
    }

    public function insertcoverletter($array2){
        return $this->applycoverletter->create($array2);  
    }

    public function insertJob($jobinsert) {
        // Insert the data into the job_apply table
        $result = $this->jobforapply->create($jobinsert);
        
        if (!$result) {
            // Check for SQL errors
            echo "Error: " . $this->jobforapply->getLastError();
        }

        return $result;
    }
    public function insertJobAlert($array){
        return $this->jobapply->create($array);  
    }
    public function read_coverletter($spuid) {
	    
        // Assuming jobapply is the method that fetches data from the table
        return $this->jobapply->read("WHERE spuid = '$spuid'");
    }
	  public function updatecoverletter($array,$id){ 
	
        return $this->jobapply->update($array, " WHERE id = '$id'"); 
   }
     public function edit_coverletter($pid) {
         return $this->jobapply->read("pid = '$pid'");
      }
      public function read_apply_by_id($spuid) {
          $query = "WHERE id = '$spuid'";
          return $this->jobforapply->read($query);
       }
      public function read_apply($spuid, $limit = null, $offset = null,  $start_date = '', $end_date = '') {
          $query = "WHERE uid = '$spuid'";

         if ($limit !== null && $offset !== null) {
          $query .= " LIMIT $limit OFFSET $offset";
          }

         return $this->jobforapply->read($query);
         }

public function get_coverletter_count($spuid) {
    $query = "WHERE uid = '$spuid'";


    return $this->jobforapply->read($query)->num_rows;
}


public function read_resume($spuid) {
	    
    // Assuming jobforapply is the method that fetches data from the table
    return $this->jobforapply->read("WHERE spuid = '$spuid'");
}
public function get_application_count($spuid) {
    $query = "WHERE uid = '$spuid'";
    $result = $this->jobforapply->read($query);
    return $result ? $result->num_rows : 0;
}


}
?>





