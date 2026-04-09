	
	<?php 
	class _company_news
	{
		
		public $dbclose = false;
		private $conn;
		public $ta;
		
		function __construct() { 
			$this->ta = new _tableadapter("company_news");
			$this->ta->dbclose = false;
		} 

		//add conversation
		function create($data){
			
			return $this->ta->create($data);
		}
		
		public function readMyNews1($pid) {
			 $pid = $this->ta->escapeString($pid);
			return $this->ta->read("WHERE spProfiles_idspProfiles = $pid  ORDER BY idcmpanynews DESC");
		}
		//read all news that i am posted
		  public function readMyNews($pid) {

		 return $this->ta->read("WHERE spProfiles_idspProfiles = $pid  ORDER BY idcmpanynews DESC");
		}

		function read_news($pid){
		  $pid = $this->ta->escapeString($pid);
		  return $this->ta->read("WHERE spProfiles_idspProfiles = $pid  ORDER BY idcmpanynews DESC");
		}
		//remove news
		function removenews($newsid){
		
			$this->ta->remove("WHERE t.idcmpanynews= " . $newsid);
		}
		// add multiple news at a single time
		// ADD TO PLAY LIST
		function addMultiNews($title, $desc, $pid){
			$this->ta->create(array("cmpanynewsTitle" => $title, "cmpanynewsDesc" => $desc, "spProfiles_idspProfiles" => $pid));
			// echo $this->ta->sql;die('cccccccccc');
			
		}
		// READ NEWS FOR SPECEFIC
		function readNews($newsId , $offset = 0, $limit = 10, $searchKeyword = ''){
			 $query = "WHERE idcmpanynews = $newsId";
             if ($searchKeyword) {
             $query .= " AND draft_message LIKE '%$searchKeyword%'";
           }
             $query .= " LIMIT $offset, $limit";
		  	return $this->ta->read($query);
		} 
		
		    public function get_draft_count($pid) {
              $query = "WHERE idcmpanynews='$pid'";
              $result = $this->ta->read($query);
              return $result ? $result->num_rows : 0;
            }
		
		// UPDATE COMPANY NEWS
		function update($newsnsert,$id){
		
			$this->ta->update($newsnsert, " WHERE idcmpanynews='$id'"); 
	   }
		
		//function updateNews($title, $desc,$id){
			//$this->ta->update(array("cmpanynewsTitle" => $title, "cmpanynewsDesc" => $desc), "WHERE idcmpanynews = $id ");
		//}
	  function remove($draftid) {
             
       $this->ta->remove("WHERE idcmpanynews =" . $draftid);
	  
    }

 public function getPaginatedNews($pid, $limit, $offset) {
        $pid = $this->ta->escapeString($pid);
        $limit = (int)$limit;
        $offset = (int)$offset;
        return $this->ta->read("WHERE spProfiles_idspProfiles = $pid ORDER BY idcmpanynews DESC LIMIT $offset, $limit");
    }

    // Method to count total news for pagination
    public function countNews($pid) {
        $pid = $this->ta->escapeString($pid);
        $result = $this->ta->execute("SELECT COUNT(*) AS total FROM company_news WHERE spProfiles_idspProfiles = $pid");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Method to search news
    public function searchNews($pid, $searchTerm, $limit, $offset) {
        $pid = $this->ta->escapeString($pid);
        $searchTerm = $this->ta->escapeString($searchTerm);
        $limit = (int)$limit;
        $offset = (int)$offset;
        return $this->ta->read("WHERE spProfiles_idspProfiles = $pid AND cmpanynewsTitle LIKE '%$searchTerm%' ORDER BY idcmpanynews DESC LIMIT $offset, $limit");
    }

    // Method to count search results
    public function countSearchResults($pid, $searchTerm) {
        $pid = $this->ta->escapeString($pid);
        $searchTerm = $this->ta->escapeString($searchTerm);
        $result = $this->ta->execute("SELECT COUNT(*) AS total FROM company_news WHERE spProfiles_idspProfiles = $pid AND cmpanynewsTitle LIKE '%$searchTerm%'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }
	}
	?>
