<?php 
	class _spmembership
	{
		public $dbclose = false;
		private $conn;
		public $ta;
		function __construct() { 
			$this->ta = new _tableadapter("spMembership");

			$this->pk= new _tableadapter("tbl_package");
			$this->tab = new _tableadapter("spmembership_transaction");
			$this->pt = new _tableadapter("sppackage_transaction");
			$this->wc = new _tableadapter("spcommission_withdraw");

			$this->super = new _tableadapter("super_vip");

			$this->spuserCom = new _tableadapter("spuser");
			$this->commSet = new _tableadapter("tbl_commission_setting");

			$this->sppro = new _tableadapter("spproduct");
			$this->speve = new _tableadapter("spevent");
			$this->spart = new _tableadapter("sppostingsartcraft");
			$this->spjob = new _tableadapter("spjobboard");
			$this->spreal = new _tableadapter("sprealstate");
			$this->vip = new _tableadapter("vip_commission");
			$this->tdc = new _tableadapter("tbl_usercommisonm");
			$this->tashi = new _tableadapter("shippo");
			$this->ta->dbclose = false;
		} 
		
		function update($mid , $mname , $mlimit , $mduration , $mamount)
		{
			$this->ta->update(array("spMembershipName" => $mname , "spMembershipPostlimit" => $mlimit ,"spMembershipDuration" =>$mduration ,"spMembershipAmount" => $mamount),"WHERE idspMembership=".$mid);
		}
		// READ ALL MEMBERSHIP
		function read(){
			return $this->ta->read();
		}
		
		function checksubscription($id,$pid){
		  return $this->tab->read("WHERE uid = $id AND pid=$pid order by id desc limit 1");
		}

	

		function read_package(){
			return $this->pk->read();
		}

		function read_event($pid){
			return $this->speve->read("WHERE spProfiles_idspProfiles = $pid "); 
		}

		function read_artcraft($pid){
			return $this->spart->read("WHERE spProfiles_idspProfiles = $pid "); 
		}

		function read_job($pid){
			return $this->spjob->read("WHERE spProfiles_idspProfiles = $pid "); 
		}

		function read_realestate($pid){
			return $this->spreal->read("WHERE spProfiles_idspProfiles = $pid "); 
		}




		function read_package_1($id){
			return $this->pk->read("WHERE id = $id "); 
		}

		function update_review($data,$id){
			$this->pt->update($data,"WHERE id = $id "); 
			 //echo $this->pk->sql;die('========');
		}

		function withraw_com($data){
			$this->wc->create($data);
			//echo $this->tdc->sql;die('========');
		}


		function ashish($uid){
			 return $this->wc->read("WHERE uid = $uid And status=1 ");

			//echo $this->wc->sql;die('========');
		}
		


		function create_comm($data){
			return $this->tdc->create($data);
			//echo $this->tdc->sql;die('========');
		}

		function create_shippo($data)
    {
        return $this->tashi->create($data);

    }

        function insert_comm($data){
			return $this->tdc->create($data);//my insert
			// echo $this->tdc->sql;die('========');
		}

		function insert_comm_second($data2){
		 return	$this->tdc->create($data2);
			// echo $this->tdc->sql;die('========');  
		}

		function insert_comm_third($data3){
			return	$this->tdc->create($data3);
			// echo $this->tdc->sql;die('========'); 
		}

		 function vip_com($pid){
			
			return  $this->vip->read("WHERE user_id = $pid ");
					//echo $this->tab->sql; die("--------------------");
			}
	
	 function super_vip1($pid){
			    return  $this->super->read("WHERE vip_id = $pid ");
				
			}

	 function user_roles_supr_vip($pid){
			    return $this->spuserCom->read("WHERE idspUser = $pid And role = 'super vip'");
			}

 function user_roles_vip($pid){
			    return $this->spuserCom->read("WHERE idspUser = $pid And role = 'vip'");
			}

    
	 function get_pack_data($uid,$id){
		//die('++++++');
		 return $this->pt->read("WHERE uid = $uid And membership_id=$id And is_reviewed=0");
		//echo $this->pt->sql; die("--------------------");
		
	}

	function readcommission($pid){
			
		return  $this->tdc->read("WHERE refred_user = $pid ");
		 //echo $this->tdc->sql;die('====11');
						
			}

			function readcommission_filter($pid,$start,$end){

				return $this->tdc->read("WHERE refred_user = $pid and date BETWEEN '$start 00:00:00'  AND '$end 00:00:00';");

			
		  //$this->tdc->read("WHERE refred_user = $pid and date >= $start and date <= $end");
		  //echo $this->tdc->sql;die('====11');
						
			}


		/*function super_vip($pid){
		
			return  $this->sc->read("WHERE vip_id = $pid");
			//echo $this->tab->sql; die("--------------------");
			}
			function vip_comm($pid){ 
		
				return  $this->vi->read("WHERE user_id = $pid");
				//echo $this->tab->sql; die("--------------------");
		  }*/
		
		function readpid($pid){
		
		return  $this->tab->read("WHERE pid = $pid ORDER BY id desc limit 1 ");
		//echo $this->tab->sql; die("--------------------");
		}
		
		function readpid_table($pid){
		
		return  $this->tab->read("WHERE pid = $pid ORDER BY id ASC ");
		//echo $this->tab->sql; die("--------------------");
		}
		function Delete_table($id){
			$this->tab->remove("WHERE t.id = $id");
		}
		
			function create($data){
			return $this->tab->create($data);
		}

		function create_package($data){
			//die('======');
			return $this->pt->create($data);
		}

		function readmembership($mid)
		{
			return $this->ta->read("WHERE idspMembership =".$mid);
		}

		function read_data($pid)
		{
			return $this->sppro->read("WHERE spProfiles_idspProfiles =".$pid);
			
		}
		
		function readmember($mid)
		{
			return $this->ta->read("WHERE idspMembership =$mid");
			// echo $this->ta->sql;die('+++++++++');
		}
		
		function readmembershiptype($pid)
		{
			return $this->ta->read("WHERE idspMembership in(SELECT spMembership_idspMembership from spProfiles where idspProfiles =".$pid.")");
		}


		function getReferrelUser($uid){
            return $this->spuserCom->read("WHERE idspUser = $uid");
        }

        function getReferrelUserByCode($code){
            return $this->spuserCom->read("WHERE userrefferalcode = '$code'");
        }

        function getuserCommission(){
            return $this->commSet->read("WHERE id =1");
        }
	}
?>
