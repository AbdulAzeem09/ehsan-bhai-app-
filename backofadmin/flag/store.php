<?php

    $quantity       = "";
    $subcategory    = "";
    $industryType   = "";
    $discount       = "";
    $shipping       = "";
    $statuspost     = "";
    $mediaSize      = "";
    $sellType       = "";

    while ($row2 = dbFetchAssoc($result2)) {
        //$postingDate = $p-> spPostingDate($row["spPostingDate"]);

        
        if($quantity == ''){
            if($row2['spPostFieldName'] == 'retailQuantity_'){
                $quantity = $row2['spPostFieldValue']; 
            }
        }
        if($subcategory == ''){
            if($row2['spPostFieldName'] == 'subcategory_'){
                $subcategory = $row2['spPostFieldValue']; 
            }
        }
        if($industryType == ''){
            if($row2['spPostFieldName'] == 'industryType_'){
                $industryType = $row2['spPostFieldValue']; 
            }
        }
        if($discount == ''){
            if($row2['spPostFieldName'] == 'retailDiscount_'){
                $discount = $row2['spPostFieldValue']; 
            }
        }
        if($shipping == ''){
            if($row2['spPostFieldName'] == 'retailShipping_'){
                $shipping = $row2['spPostFieldValue']; 
            }
        }                
        if($statuspost == ''){
            if($row2['spPostFieldName'] == 'retailStatus_'){
                $statuspost = $row2['spPostFieldValue'];
            }
        }
        if($mediaSize == ''){
            if($row2['spPostFieldName'] == 'imagesize_'){
                $mediaSize = $row2['spPostFieldValue'];
            }
        }
        if($sellType == ''){
            if($row2['spPostFieldName'] == 'sellType_'){
                $sellType = $row2['spPostFieldValue'];
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
                            <td><?php echo $spPrice; ?></td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td><?php echo $quantity; ?></td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td><?php echo $subcategory; ?></td>
                        </tr>
                        <tr>
                            <td>Industry Type</td>
                            <td><?php echo $industryType; ?></td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td><?php echo $discount; ?></td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td><?php echo $shipping; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?php echo $statuspost; ?></td>
                        </tr>
                        <tr>
                            <td>Media Size</td>
                            <td><?php echo $mediaSize; ?></td>
                        </tr>
                        <tr>
                            <td>Sell Type</td>
                            <td><?php echo $sellType; ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>


                        