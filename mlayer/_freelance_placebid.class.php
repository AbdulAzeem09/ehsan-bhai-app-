<?php 
class _freelance_placebid
{
    public $dbclose = false;
    private $conn;
    public $ta;
    function __construct() { 
        $this->ta = new _tableadapter("spfreelancer_placebid"); //spShipping
        $this->taf = new _tableadapter("spfreelancer");
         $this->tas = new _tableadapter("spprofiles"); 
        $this->ta->dbclose = false;
    } 


    // CREATE NEW POSTINGS
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
	function updatebid($data){
		$datas = array(
				"bidPrice"=>$data["bidPrice"],
				"totalDays"=>$data["totalDays"],
				"coverLetter"=>$data["coverLetter"]
				);
		$id = $data["placebidid"];
				
		return $this->ta->update($datas, "WHERE id ='".$id."'");
	}

	function deletebid($id) {
        $this->ta->remove("WHERE t.id = " . $id);
    }
	
	function readallbids($projectid,$order)
	{
	 $projectid = $this->ta->escapeString($projectid);
	 return $this->ta->read("WHERE spPostings_idspPostings =".$projectid.' '.$order);
	}

function readallbids_home($projectid)
	{
	 return $this->ta->read("WHERE spPostings_idspPostings =".$projectid);
	}

	

 function bidsp($projectid)
	{
		$projectid = $this->ta->escapeString($projectid);
		return $this->ta->read("WHERE spPostings_idspPostings =".$projectid);
	}




function totalbids1($postid)
   {
        return $this->ta->read("WHERE spPostings_idspPostings = " . $postid ." AND spProfiles_idspProfiles IS NOT NULL", "", "DISTINCT spProfiles_idspProfiles");

    }  
   
    function allbids1($pid,$postid)
    {
        return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid." AND spPostings_idspPostings =".$postid);
    }
	
	function readprofilebids($pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
	}



	function read_project($id)
	{
		//die('aaaaaaaaaaaa');
	   return $this->taf->read("WHERE idspPostings =".$id);
        //echo $this->taf->sql; die;
	}

function read_spprofile($id)
	{
		
	    return $this->tas->read("WHERE idspProfiles =".$id);
       echo $this->tas->sql; die;
	}


 }
 ?>   
