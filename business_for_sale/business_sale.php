div class="col-md-12">
                    <div class="carousel">
                    <?php 
                        $de= new _businessrating;
                        $de1= $de->read_all_business_limit();
                        //print_r($de1);
                        if($de1!=false){
                        while($row=mysqli_fetch_assoc($de1)){
                        //echo $row['country'].'=====';
                        $de2=$de->read_files($row['idspbusiness']);
                        //print_r($de2);
                        
                        if($row['uid']!=NULL){
                                         $st= new _spuser;
                                    $st1=$st->readdatabybuyerid($row['uid']);
                                    if($st1!=false){
                                    $stt=mysqli_fetch_assoc($st1);
                                    $account_status=$stt['deactivate_status'];
                                    }
                                        }
                                        
                        $co = new _country;
    $co1=$co->readCountryName($row['country']);
    if($co1!=false){
    $co2=mysqli_fetch_assoc($co1);
    $country=$co2['country_title'];
    }
    
    
    $ci = new _city;
    $co2=$ci->readCityName($row['city']);
    if($co2!=false){
    $co3=mysqli_fetch_assoc($co2);
    $city=$co3['country_title'];
    }
    
    
                        $img='';
                        if($de2!=false){
                        $ro=mysqli_fetch_assoc($de2);
                        //print_r($ro);
                        $img=$ro['filename'];
                        }
                        //echo $img;
                        if($account_status!=1){
                        ?>
                    
                    <a href="business_detail.php?postid=<?php echo $row['idspbusiness'];?>">
                            <div class="col-md-4" style="padding: 20px;">
                    <div class="row zoom1" style="border-radius: 30px;border:  solid 2px;background-color: white;">
                                    <div class="col-md-6 cardimg" style="padding: 0px; margin:5px;">
                                    <?php if($img!=false){?>
                                    
                                    <img class="form-control" src="<?php echo $BaseUrl.'/business_for_sale/uploads/'.$img;?>" alt="">
                                        
                                    <?php } else{?>
                                    <img class="form-control" src="download.jpg" alt="">
                                    <?php } ?>
                                    </div>
                                    <div class="col-md-5">

                                        <div class="row" style="padding-top: 10px;padding-left: 20px;">
                                            <label>
                                                <p style="line-height:17px;"><b>

                                                    <?php echo $row['listing_headline'];?></br>
                                                        <label style="color: #468E4F;"><?php echo $row['location'];?></label></br>
                                                        <?php if($row['business_type']==1){echo "Franchise";}else{echo "Independent Sale";}?>
                                                    </b></p>
                                            </label><b><?php echo $country;?></b>,<b>
                                            <?php echo $city;?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        
                        <?php }}} ?>

                    </div>
                    </div>