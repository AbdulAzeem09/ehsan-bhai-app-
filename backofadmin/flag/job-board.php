<?php

    $skill      = "";
    $jobType    = "";
    $jobLevel   = "";
    $location   = "";
    $salaryStrt = "";
    $salaryEnd  = "";
    $Experience = "";
    $howAply    = "";
    $noOfPos    = "";

    while ($row2 = dbFetchAssoc($result2)) {
        //$postingDate = $p-> spPostingDate($row["spPostingDate"]);

        
        if($noOfPos == ''){
            if($row2['spPostFieldName'] == 'spPostingNoofposition_'){
                $noOfPos = $row2['spPostFieldValue']; 
            }
        }
        if($howAply == ''){
            if($row2['spPostFieldName'] == 'spPostingApply_'){
                $howAply = $row2['spPostFieldValue']; 
            }
        }
        if($Experience == ''){
            if($row2['spPostFieldName'] == 'spPostingExperience_'){
                $Experience = $row2['spPostFieldValue']; 
            }
        }
        if($salaryEnd == ''){
            if($row2['spPostFieldName'] == 'spPostingSlryRngFrm_'){
                $salaryEnd = $row2['spPostFieldValue']; 
            }
        }
        if($salaryStrt == ''){
            if($row2['spPostFieldName'] == 'spPostingSlryRngTo_'){
                $salaryStrt = $row2['spPostFieldValue']; 
            }
        }                
        if($skill == ''){
            if($row2['spPostFieldName'] == 'spPostingSkill_'){
                $skill = explode(',', $row2['spPostFieldValue']);
            }
        }
        if($jobType == ''){
            if($row2['spPostFieldName'] == 'spPostingJobType_'){
                $jobType = $row2['spPostFieldValue'];
            }
        }
        if($jobLevel == ''){
            if($row2['spPostFieldName'] == 'spPostingJoblevel_'){
                $jobLevel = $row2['spPostFieldValue'];
            }
        }
        if($location == ''){
            if($row2['spPostFieldName'] == 'spPostingLocation_'){
                $location = $row2['spPostFieldValue'];
            }
        }
    }
    ?>
        <div class="row">
            <div class="col-md-12">
                <h2>Post Detail</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr >
                            <td style="width: 200px!important;">Title</td>
                            <td><?php echo $title; ?></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><?php echo $overview; ?></td>
                        </tr>
                        <tr>
                            <td>Company Name</td>
                            <td><?php echo $CmpnyName; ?></td>
                        </tr>
                        <tr>
                            <td>About Company</td>
                            <td><?php echo $CmpnyDesc; ?></td>
                        </tr>
                        <tr>
                            <td>Company Size: </td>
                            <td><?php echo $CmpSize; ?></td>
                        </tr>
                        <tr>
                            <td>Total Positions:  </td>
                            <td><?php echo $noOfPos; ?></td>
                        </tr>
                        <!-- <tr>
                            <td>How to apply: </td>
                            <td><?php echo $howAply;?></td>
                        </tr> -->
                        <tr>
                            <td>Job Type: </td>
                            <td><?php echo $jobType; ?></td>
                        </tr>
                        <tr>
                            <td>Job Level: </td>
                            <td><?php echo $jobLevel; ?></td>
                        </tr>
                        <tr>
                            <td>Salary: </td>
                            <td><?php echo $salaryEnd .' - '.$salaryStrt; ?></td>
                        </tr>
                        <tr>
                            <td>Closing Date: </td>
                            <td><?php echo $CloseDate; ?></td>
                        </tr>
                        <tr>
                            <td>Experience: </td>
                            <td><?php echo $Experience; ?></td>
                        </tr>
                        <tr>
                            <td>Location: </td>
                            <td><?php echo $location;?></td>
                        </tr>
                        <tr>
                            <td>Skills: </td>
                            <td>
                                <?php
                                if($skill != ''){
                                    if(count($skill) >0){
                                        foreach($skill as $key => $value){
                                            if($value != ''){
                                                echo $value.", ";
                                            }
                                           
                                        }
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>


                        