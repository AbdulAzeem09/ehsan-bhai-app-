
<?php 
class _classified_fav
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spclassifiedfav");
		//$this->ta->dbclose = false;
		$this->fa = new _tableadapter("spproduct");
		$this->ca = new _tableadapter("realenquiry");
	} 
	
	function addclassfavorites($data)
	{
	return $this->ta->create($data);
	}

	// READ ALL FAVOURITE POST
	function read($postid){
		return $this->ta->read("WHERE spPostings_idspPostings=" .$postid);
	}

    function removeclassfavorites($postid,$uid,$pid)
	{
		return $this->ta->remove("WHERE spPostings_idspPostings=" .$postid. " AND spUserid=" .$uid. " AND spProfiles_idspProfiles = ".$pid);
	}
	
    
    	function new_remove($pid) { 
       return  $this->fa->remove("WHERE t.idspPostings= " . $pid);
    }  

	 // MY FAVOURITE MUSIC
    function myfavourite_job($pid) {

        return $this->ta->read("WHERE spProfiles_idspProfiles=" .$pid);
    }
	
	


    function addcomment($id,$comment){
    	
        return $this->ta->update(array("comment" => $comment), "WHERE id ='" . $id . "'");

    }

        function addsortcomment($id,$comment){
    	
        return $this->ta->update(array("sortlist_comment" => $comment), "WHERE id ='" . $id . "'");

    }

        function sortlist($id){
    	
        return $this->ta->update(array("sortlisted" => 1), "WHERE id ='" . $id . "'");

    }

            function removesortlist($id){
    	
        return $this->ta->update(array("sortlisted" => 0), "WHERE id ='" . $id . "'");
		//echo $this->ta->sql;

    } 
	   function readclassified($id){
        return $this->ca->read("WHERE spProfile_idspProfile = " .$id );
    }


     /* function myfavourite_store($pid) {

        return $this->ta->read("INNER JOIN spproduct as d ON t.spPostings_idspPostings = d.idspPostings WHERE d.spProfiles_idspProfiles=" .$pid);

       
    }
*/

function chekFavourite($postid, $pid, $uid){
		return $this->ta->read("WHERE spPostings_idspPostings= '$postid ' AND spUserid= '$uid' AND spProfiles_idspProfiles = '$pid'");
	}




}
?>
