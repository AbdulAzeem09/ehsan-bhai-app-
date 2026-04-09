<?php
class _flagpost
{
    public $dbclose = false;
	   private $conn;
    public $ta;
    public $pic;
    public $tad;
    public $pid;
	public $spuid;
	public $query;

	function __construct() {
		$this->ta = new _tableadapter("flagpost");
		$this->tabds = new _tableadapter("rfqflag");
		$this->taspp = new _tableadapter("spproduct");
		$this->ta_fav = new _tableadapter("spjobfavorites");
		$this->ta_heart = new _tableadapter("spfreelancer_fav");
		$this->ta_h = new _tableadapter("sppostingsartcraft");
        $this->ta_fav1 = new _tableadapter("spfreelancerfavorites");
		$this->flag_ta = new _tableadapter("flagged_jobprofile");
		$this->spsave = new _tableadapter("spjobboard");
		$this->ta->dbclose = false;
	}
	
   function read_fav_project($profid,$uid,$projid){
		return $this->ta_fav1->read("WHERE spProfiles_idspProfiles =$profid AND spPostings_idspPostings=$projid AND spUserid=$uid" );
		//die('22');
		//	echo $this->ta_fav->sql;
	}

	function readsppos($ida){
		return $this->ta_h->read("WHERE idspPostings= $ida");
		//echo $this->ta_h->sql;
		}

	// CREATE FLAG
	function create($data){
		
		return $this->ta->create($data);
	 
		//echo $this->ta->sql;
		//die('=================');
	}
	
	//flag read
	function readflag($pid , $cat){
       return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $cat ");
	   
	   //echo $this->ta->sql;
	   
      }

	  function flagd($ida){
		return $this->ta->remove("WHERE flag_id= $ida");
		}


	  function readproductname($id){
	  return $this->taspp->read("WHERE idspPostings = $id");
	  
	  }

	function deletflag($flid){
	return $this->ta->remove("WHERE flag_id= " . $flid);
	}

	  function get_data($id,$pid){
		 return $this->ta->read("WHERE spPosting_idspPosting = $id AND spProfile_idspProfile=$pid");
		 echo $this->ta->sql;die('++++');
		
		
		}

	  function readflag3($uid , $cat){
         return $this->ta->read("WHERE spProfile_idspProfile = $uid AND spCategory_idspCategory = $cat ");
	   
	   echo $this->ta->sql;
	   
      }

	  
	   function readflagrfq($pid , $cat){
		return $this->ta->read("WHERE t.spProfile_idspProfile = $pid AND t.spCategory_idspCategory = $cat ");
	   
	   //echo $this->ta->sql;
	 //  die("%%%%%%%%%%%%%%%%%%%%%%");   
	   
      }
    function readflag2($uid,$spids){
       $spids = $this->ta->escapeString($spids);
       return $this->ta->read("WHERE spProfile_idspProfile = $uid AND spPosting_idspPosting=$spids");
       
      }

		function create_fav($data){
		return $this->ta_fav->create($data);

	}
	function create_heart($data1){
		return $this->ta_heart->create($data1);

	}

	function read_fav($profid,$uid,$projid){

		return $this->ta_fav->read("WHERE spProfiles_idspProfiles =$profid AND spPostings_idspPostings=$projid AND spUserid=$uid" );
		//die('22');
	//	echo $this->ta_fav->sql;
	}

	function read_heart($profid1,$uid1,$flid){

		return $this->ta_heart->read("WHERE freelancer_id =$flid AND prof_id=$profid1 and user_id=$uid1");
		    // echo $this->ta_heart->sql;
		    // die('22');
	}
	function del_heart($profid1,$uid1,$flid){
		 return $this->ta_heart->remove("WHERE freelancer_id =$flid AND prof_id=$profid1 and user_id=$uid1");
	//die('33');
	//echo $this->ta_fav->sql;
	}

	function del_fav($profid,$uid,$projid){
		  return $this->ta_fav->remove("WHERE spProfiles_idspProfiles =$profid AND spPostings_idspPostings=$projid AND spUserid=$uid" );
     	//die('33');
	   //echo $this->ta_fav->sql;
	}

	function createflagprofile($data){
		$this->flag_ta->create($data);
	}

		function readmyflagPro($uid){
     return $this->flag_ta->read("WHERE userid = ". $uid);

    }
	function readmyflagPro_d($uid,$pid){
    return  $this->flag_ta->read("WHERE userid = $uid and profileid=$pid");
//echo $this->flag_ta->sql;
//die('========');
    }

		function deleteflag($fid){
		return $this->flag_ta->remove("WHERE id= " . $fid);
	}

	// DELETE ENQUIRY
	function delEnq($enqid){
		return $this->ta->remove("WHERE enquiry_id= " . $enqid);
	}
	// READ MY FLAG (I AM FLAGGER)


	function readmyflag($pid){
		return $this->ta->read("INNER JOIN spcategories AS c ON t.spCategory_idspCategory = c.idspCategory INNER JOIN sppostings AS p ON t.spPosting_idspPosting = p.idspPostings WHERE spProfile_idspProfile = $pid AND flag_status = 0");
	}

	function myflagPost($catidooo, $pid){
     return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catidooo ");
	 //echo $this->ta->sql;
	 //die('kkkkkkkkk');
    }


	function myflagPost_frelance($catidooo, $pid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catidooo ");
		//echo $this->ta->sql;
		//die('kkkkkkkkk');
	   }

	   function myflagPost_training($catidooo, $pid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catidooo ");
		//echo $this->ta->sql;
		//die('kkkkkkkkk');
	   }

	   
	function myflagPost_event($catidooo, $pid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catidooo ");
	   //echo $this->ta->sql;
	   //die('kkkkkkkkk');
	  }

	  function myflagPost_jobbard($catidooo, $pid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catidooo ");
	   //echo $this->ta->sql;
	   //die('kkkkkkkkk');
	  }

function myflagPost_b($catid, $pid){
     return $this->ta->read("WHERE spProfile_idspProfile = $pid AND spCategory_idspCategory = $catid ");
	 //echo $this->ta->sql;
	 //die('kkkkkkkkk');
    }

    function myflagresponsenew($catid, $postid){
        return $this->ta->read("WHERE t.spPosting_idspPosting = $postid AND t.spCategory_idspCategory = $catid");
    }
    function getflagecount($user_id,$profile_id){
        return $this->flag_ta->read("WHERE t.userid=$user_id AND t.profileid=$profile_id");
        // echo $this->flag_ta->sql;die;
    }


function getflagjob($pid) {
	
	 return $this->flag_ta->read("LEFT JOIN spjobboard as d ON t.userid = d.idspPostings WHERE t.profileid = " . $pid);
  //  return $this->flag_ta->read(
      //  "LEFT JOIN spjobboard AS d ON t.profileid = d.spProfiles_idspProfiles 
     //  WHERE t.profileid = " . $this->flag_ta->escapeString($pid) . " 
      //  AND t.pid = " . $this->flag_ta->escapeString($pid)
 //   );
}

}
?>
