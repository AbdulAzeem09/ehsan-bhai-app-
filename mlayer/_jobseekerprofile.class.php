<?php 
class _jobseekerprofile
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("jobseekerprofile");
		$this->ta = new _tableadapter("spjobboard");
		$this->ta = new _tableadapter("jobboard_save");
		//$this->ta->join = "INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles";
		$this->ta->dbclose = false;
	}
	
	 function jobsave($data)
    {
        // Join the spjobboard and jobboard_save tables using RIGHT JOIN
      //  $this->ta->join = "LEFT JOIN jobboard_save as jbs ON spjobboard.spProfiles_idspProfiles = jbs.spPostings_idspPostings";
        
        // Assuming you need to read or fetch data after the join
         $result = $this->ta->read("WHERE spjobboard.spProfiles_idspProfiles = " . $data['some_value']);
        
        // Process the result as needed
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            // Handle the fetched data
            return $row;
        } else {
            // Handle no result found
            return false;
        }
    }
	
	function create($data)
	{
		$id = $this->ta->create($data);
		return $id;
	}
	
	function update($data,$pid)
	{
		$this->ta->update($data, $pid);
	}
	
	function read($pid)
	{
		return $this->ta->read("where spProfiles_idspProfiles = " . $pid );
	}
}
?>