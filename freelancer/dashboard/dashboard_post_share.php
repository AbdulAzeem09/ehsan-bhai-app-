<!--  <div class="custom-col-md-3">
                            <div class="small-box bg-green green_aqua_radius">
                                <div class="inner">
                                    <?php
                                    $fa     = new _freelance_account;
                                    $result3 = $fa->readProBlnc($_SESSION['pid']);
                                    if($result3){
                                        $row3 = mysqli_fetch_assoc($result3);
                                        $myBlnc = $row3['fa_current_amount'];
                                    }
                                    ?>
                                  <h3>$<?php echo isset($myBlnc)?$myBlnc:'0';?></h3>
                                  <p>My Balance</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-ellipsis-v"></i>
                                </div>
                                <!-- <a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom" >More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>

                           <div class="custom-col-md-3">
                            <div class="small-box bg-yellow  green_aqua_radius">
                                <div class="inner">
                                    <?php
                                      $sf  = new _freelance_chat_project;
                                        //$res = $p->myExpireProduct(5, $_SESSION['pid']);
                                          $res = $sf->getbussinesConversation($_SESSION['pid']);
                                    if($res->num_rows > 0){
                                        /*$row3 = mysqli_fetch_assoc($result3);
                                        $myBlnc = $row3['fa_current_amount'];*/
                                      $hire =   $res->num_rows;
                                    }else{

                                        $hire = 0;
                                    }
                                    ?>
                                  <h3><?php echo isset($hire)?$hire:'0';?></h3>
                                  <p>Hire</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-ellipsis-v"></i>
                                </div>
                               <!--  <a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom" >More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>

                        <div class="custom-col-md-3">
                            <div class="small-box bg-orange green_aqua_radius">
                                <div class="inner">
                                    <?php
                                       $sf  = new _freelancerposting;

                                // print_r($_SESSION['pid']);

                                // $res = $p->client_publicpost(5, $_SESSION['pid']);

                                  $res = $sf->client_publicpost_posting(5, $_SESSION['pid']);

                                    if($res->num_rows > 0){
                                        /*$row3 = mysqli_fetch_assoc($result3);
                                        $myBlnc = $row3['fa_current_amount'];*/
                                      $bid =   $res->num_rows;
                                    }else{

                                        $bid = 0;
                                    }
                                    ?>
                                  <h3><?php echo isset($bid)?$bid:'0';?></h3>
                                  <p>Active Bid</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-ellipsis-v"></i>
                                </div>
                               <!--  <a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom" >More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                    

       <div class="custom-col-md-3">
                            <div class="small-box bg-blue green_aqua_radius">
                                <div class="inner">
                                    <?php
                                       $sf  = new _freelancerposting;

                                         $res = $sf->myProfileDraftFreelancer1(5, $_SESSION['pid']);

                                    if($res->num_rows > 0){
                                        /*$row3 = mysqli_fetch_assoc($result3);
                                        $myBlnc = $row3['fa_current_amount'];*/
                                      $draft =   $res->num_rows;
                                    }else{

                                        $draft = 0;
                                    }
                                    ?>
                                  <h3><?php echo isset($draft)?$draft:'0';?></h3>
                                  <p>Draft</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-ellipsis-v"></i>
                                </div>
                               <!--  <a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom" >More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>

                    <div class="custom-col-md-3">
                            <div class="small-box bg-aqua green_aqua_radius">
                                <div class="inner">
                                    <?php
                                      $sf  = new _freelancerposting;

                                    //   $res = $p->myCmpPro(5, $_SESSION['pid']);

                                         $res = $sf->myCmpleteincompletePro1(5, $_SESSION['pid']);
										 $com= $res->num_rows;
										// echo $table;
                                        

                                    if($res->num_rows > 0){
                                 
                                      $com =   $res->num_rows;
                                    
                                    }else{

                                        $com = 0;
                                    }
                                    ?>
                                  <h3><?php echo isset($com)?$com:'0';?></h3>
                                  <p>Completed</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-ellipsis-v"></i>
                                </div>
                               <!--  <a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom" >More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </div>
                    </div> -->
                    