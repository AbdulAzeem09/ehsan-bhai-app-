<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$company_id = $_POST['company_id'];
     $sf  = new _spprofiles;

                                // print_r($_SESSION['pid']);

                                // $res = $p->client_publicpost(5, $_SESSION['pid']);

                                  $res = $sf->read($company_id);

                                        //echo $sf->ta->sql;

                                        $i = 1;
                                        if($res){
           
     

        $row_fi = mysqli_fetch_assoc($res);
                                                //$dt = new DateTime($row['spPostingExpDt']);
                                               
                                             //  echo "<pre>";
                                               //print_r($rows);
      $fi = new _spbusiness_profile;
        $result_fi = $fi->read($row_fi['idspProfiles']);
        //echo $fi->ta->sql;
        if($result_fi){
            $ProjectName    = '';
            $perhour        = '';
            $skill          = '';
            $CmpnyName      = "";
            $CmpnyDesc      = "";
            $CmpSize        = "";
            $YearFounded    = "";


            while($rows = mysqli_fetch_assoc($result_fi)){

 $savedata[]= array(
                                         "spprofiles_idspProfiles"=> $rows['spprofiles_idspProfiles'],
                                      "companyname"=> $rows['companyname'],
                                      "companyEmail"=> $rows['companyEmail'],
                                      "skill"=> $rows['skill'],
                                      "companyPhoneNo"=> $rows['companyPhoneNo'],
                                      "companyExtNo"=> $rows['companyExtNo'],
                                      "businesscategory"=> $rows['businesscategory'],
                                      "companytagline"=> $rows['companytagline'],
                                      "companyProductService"=> $rows['companyProductService'],
                                      "BussinessOverview"=> $rows['BussinessOverview'],
                                      "languageSpoken"=> $rows['languageSpoken'],
                                      "CompanySize"=> $rows['CompanySize'],
                                      "cmpyRevenue"=> $rows['cmpyRevenue'],
                                      "yearFounded"=> $rows['yearFounded'],
                                      "CompanyOwnership"=> $rows['CompanyOwnership'],
                                      "CompanyWebsite"=> $rows['CompanyWebsite'],
                                      "operatinghours"=> $rows['operatinghours'],
                                      "stockSymbol"=> $rows['stockSymbol'],
                                      "cmpnyStockLink"=> $rows['cmpnyStockLink'],
                                      "spDynamicWholesell"=> $rows['spDynamicWholesell'],
                                      "companyaddress"=> $rows['companyaddress'],
                                      "spProfilesAboutStore"=> $rows['spProfilesAboutStore'],
                                      "spshippingtext"=> $rows['spshippingtext'],
                                      "spProfilerefund"=> $rows['spProfilerefund'],
                                      "spProfilepolicy"=> $rows['spProfilepolicy'],
                                    ); 



            }


          }


              











                          

          $data = array("status" => 200, "message" => "success","data"=>$savedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  