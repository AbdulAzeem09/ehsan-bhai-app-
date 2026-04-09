<?php

    $fixedPrice       = "";
    $closingDate    = "";
    $category   = "";
    $subcategory       = "";
    $skill       = "";
    $experince     = "";
    


    while ($row2 = dbFetchAssoc($result2)) {
        //$postingDate = $p-> spPostingDate($row["spPostingDate"]);

        
        if($fixedPrice == ''){
            if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
                $fixedPrice = $row2['spPostFieldValue']; 
            }
        }
        if($closingDate == ''){
            if($row2['spPostFieldName'] == 'spClosingDate_'){
                $closingDate = $row2['spPostFieldValue']; 
            }
        }
        if($category == ''){
            if($row2['spPostFieldName'] == 'spPostingCategory_'){
                $category = $row2['spPostFieldValue']; 
            }
        }
        if($subcategory == ''){
            if($row2['spPostFieldName'] == 'spPostInSubCategory_'){
                $subcategory = $row2['spPostFieldValue']; 
            }
        }
        if($skill == ''){
            if($row2['spPostFieldName'] == 'spPostingSkill_'){
                $skill = explode(',', $row2['spPostFieldValue']) ; 
            }
        }                
        if($experince == ''){
            if($row2['spPostFieldName'] == 'spPostExperienceLevl_'){
                $experince = $row2['spPostFieldValue'];
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
                            <td>Price</td>
                            <td><?php echo $spPrice; ?> USD</td>
                        </tr>
                        <tr>
                            <td>Closing Date</td>
                            <td><?php echo $closingDate; ?></td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td><?php echo $category; ?></td>
                        </tr>
                        <tr>
                            <td>Sub Category</td>
                            <td><?php echo $subcategory; ?></td>
                        </tr>
                        <tr>
                            <td>Skills</td>
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
                        <tr>
                            <td>Experience</td>
                            <td><?php echo $experince; ?></td>
                        </tr>
                        


                    </table>
                </div>
            </div>
        </div>


                        