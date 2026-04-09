    <div class="seller_info bradius-15">
        <div class="row no-margin">
            <div class="col-md-2 no-padding">
                <?php
                    $p = new _spprofiles;
                    $result = $p->read($SellId);
                    if ($result != false) {
                        $row = mysqli_fetch_assoc($result);
                        if (isset($row["spProfilePic"]))
                            echo "<img alt='profilepic' class='img-responsive sellerPic' src=' " . ($row["spProfilePic"]) . "'  >";
                        else
                            echo "<img alt='profilepic' class='img-responsive sellerPic' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px;' >";
                    }
                    $pr         = new _spprofilehasprofile;
                    $result6    = $pr->frndLeevel($_SESSION['pid'], $SellId);
                    //echo $pr->ta->sql;
                    //echo $result3;
                    if($result6 == 0){
                      $level = '1st';
                    }else if($result6 == 1){
                      $level = '1st';
                    }else if($result6 == 2){
                      $level = '2nd';
                    }else if($result6 == 3){
                      $level = '3rd';
                    }else{
                      $level = 'Not Define';
                    }
                ?>
                
            </div>
            <div class="col-md-10">
                <h4><a href="<?php echo $BaseUrl.'/friends/?profileid='.$SellId;?>"><?php echo ucwords($SellName);?> <small><?php echo $level;?></small></a></h4>
                <p class="pro_qty"><a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?friend='.$SellId;?>">(<?php echo $SelProduct;?> Products)</a></p>
            </div>
        </div>
        <div class="row no-margin">
            <div class="col-md-12 no-padding">
                <p class="active_site">&nbsp;</p>
                <p class="adds">Seller Details</p>
                <p><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/phone.png"> <?php echo $SellPhone; ?></p>
                <p><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/email.png"> <?php echo wordwrap($SellEmail , 26, "<br />\n", true);?></p>
                <p><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/location.png"> <?php echo $SellAdres.', '.$SellCounty;?></p>

                <?php
                if ($myuserid != $_SESSION['uid']) {
                    ?>
                    <p class="sel_chat" ><i class="fa fa-commenting"></i> <a href="javascript:void(0)" onclick="javascript:chatWith('<?php echo $_SESSION['pid']; ?>')">Lets Chat</a></p>
                    <?php
                }
                ?>     


                
                <p class="sel_chat"><i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp;<a href="<?php echo $BaseUrl.'/store/user-product.php?userid='.$SellId; ?>">Visit Store</a></p>
            </div>
        </div>
    </div>
    <div class=" pro_detail_box m_top_10 bradius-15">
        <ul class="pro_add">
            <?php
            $rc = new _country; 
            $result_cntry = $rc->readCountryName($Country);
            if ($result_cntry) {
                $row4 = mysqli_fetch_assoc($result_cntry);
                $countryName = $row4['country_title'];
            }

            $rcty = new _city;
            $result_cty = $rcty->readCityName($City);
            if ($result_cty) {
                $row5 = mysqli_fetch_assoc($result_cty);
                $cityName = $row5['city_title'];
            }
            ?>                                                    
            <li><?php echo (isset($cityName) && $cityName != '')?$cityName : ''; ?> , <?php echo (isset($countryName) && $countryName != '')?$countryName :''; ?> | Added on <?php echo $dt->format('d M Y'); ?>,<br>
                Ad ID: <strong>AEF-<?php echo $_GET['postid'];?></strong></li>
        </ul>
    </div>
    <div class="saftey_box m_btm_15  bg-white bradius-15">
        <h2>Safety Tips for Buyers</h2>
        <ol>
            <li>Meet seller at a safe location</li>
            <li>Check the item before you buy</li>
            <li>Pay only after collecting item</li>
        </ol>
    </div>
    