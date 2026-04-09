    
    <div class="row no-margin">
        <?php

        $spo = new _sponsorpic;
        $count = 0;
        $splinkp = new _spevent;

         if(isset($_GET['postid']))
			{
			 
			 $result6 = $splinkp->read($_GET['postid']);                                                      
			 
			 if($result6 != false){
                  
				  while ($row6 = mysqli_fetch_assoc($result6)) {
                                                                                     
                        if($row6['ass_person_ids'] != '')
							{
                                $allSponsor = explode(",",$row6['sponsorId']);

								for($i=0; $i<count($allSponsor); $i++)
								{
								
									
					if($allSponsor[$i] != ''){
                    $sponsorId = $allSponsor[$i];
                    $result8 = $spo->readSponsor($sponsorId);
                    if($result8 != false){
                        $row8 = mysqli_fetch_assoc($result8);

                            ?>
                            <div class="col-md-4">
                                <div class="row sponsorBox m_btm_20" style="display: block!important;">
                                    <div class="col-md-3">
                                        <img src="<?php echo ($row8['sponsorImg']);?>" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <h3><?php echo $row8['sponsorTitle'];?></h3>
     
                                    </div>
                                </div>
                            </div>
                            <?php
                            $count++;
                     
                    }
                } 

								
								}
                                                                 
                             }
                        }
                   }
				   else{
                                                  echo"<h3 class='text-center'>No record Found!</h3>";
                                                }
          }


        ?>
    </div>