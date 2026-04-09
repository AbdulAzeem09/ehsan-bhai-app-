<?php
    if ($res != false) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) {
            $pid        = $row['idspProfiles'];
            $name       = $row["spProfileName"];
            $picture    = $row['spProfilePic'];
            $about      = $row["spProfileAbout"];
            $phone      = $row["spProfilePhone"];
            $country    = $row["spProfilesCountry"];
            $state      = $row["spProfilesState"];
            $city       = $row["spProfilesCity"];
            $profiletype        = $row["spProfileType_idspProfileType"];
            $profileTypeName    = $row['spProfileTypeName'];
            $icon       = $row["spprofiletypeicon"];
            $ptypeid    = $row["idspProfileType"];
            $email      = $row["spProfileEmail"];
            $location   = $row["spprofilesLocation"];
            $language   = $row["spprofilesLanguage"];
            $pf = new _profilefield;
            $query = $pf->read($row["idspProfiles"]);
            
            $cmpnyName = "";
            $cmpnyTagline = "";
            $cmpnyAddress = "";
            if ($query != false) {

                while ($row2 = mysqli_fetch_assoc($query)) {
                    if($cmpnyName == ''){
                        if($row2['spProfileFieldName'] == 'companyname_' || $row2['spProfileFieldName'] == 'companyname'){
                            $cmpnyName = $row2['spProfileFieldValue'];
                        }
                    }
                    if($cmpnyAddress == ''){
                        if($row2['spProfileFieldName'] == 'companyaddress_' ||  $row2['spProfileFieldName'] == 'companyaddress'){
                            $cmpnyAddress = $row2['spProfileFieldValue'];
                        }
                    }
                    if($cmpnyTagline == ''){
                        if($row2['spProfileFieldName'] == 'companytagline_' ||  $row2['spProfileFieldName'] == 'companytagline'){
                            $cmpnyTagline = $row2['spProfileFieldValue'];
                        }
                    }
                }
            }
            
            // SHOW ALL COUNTRY , STATE, CITY
            $st  = new _state;
            $c   = new _country;
            $ci  = new _city;
            // county name
            $result3 = $c->readCountryName($country);
            if($result3 != false){
                $row3 = mysqli_fetch_assoc($result3);
            }
            // provision name
            $result2 = $st->readStateName($state);
            if($result2 != false){
                $row5 = mysqli_fetch_assoc($result2);
            }
            // city name
            $result4 = $ci->readCityName($city);
            if($result4 != false){
                $row4 = mysqli_fetch_assoc($result4);
            }
            if (isset($row4['city_title'])) {
                $addr = $row4['city_title'].' '.$row3['country_title'];
            }else{
                $addr = "";
            }
            
            array_push($googleMap, $addr)

            ?>
            <div class="col-md-12">
                <div class="bg_white dirctrylist m_btm_20">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="<?php echo $BaseUrl.'/business-directory/detail.php?business='.$row['idspProfiles'];?>">
                            <img alt="Profile Pic" onerror="this.src='../img/default-profile.png'" class="img-responsive" src="<?php echo ((isset($picture))?" ". ($picture)."":"../img/default-profile.png");?>">
                            </a>
                            
                        </div>
                        <div class="col-md-8">
                            <div class="" style="padding: 10px 0px;">
                                <a href="<?php echo $BaseUrl.'/business-directory-services/details.php?business='.$row['idspProfiles'];?>" class="title"><?php echo $cmpnyName; ?></a>
                                <span class="addres">
                                    <?php if ($cmpnyAddress != '') { ?>
                                    <p> 
                                        <?php
                                            $pr = new _spprofiles;
                                            $country = 0;
                                            $state = 0;
                                            $city = 0;
                                            $profile_country = '';
                                            $profile_state='';
                                            $profile_city='';
                                            $result  = $pr->read($pid);
                                            $sprows = mysqli_fetch_assoc($result);
                                            $country = $sprows["spProfilesCountry"];
                                            $state = $sprows['spProfilesState'];
                                            $city = $sprows["spProfilesCity"];
                                            $profile_additional_address = $sprows["address"];
                                            $co = new _country;
                                            $result3 = $co->readCountryName($country);
                                            if ($result3) {
                                            $rowcon = mysqli_fetch_assoc($result3);
                                            $profile_country =  $rowcon['country_title'];
                                            }

                                            $stateObj = new _state;
                                            $result4 = $stateObj->readStateName($state);

                                            if ($result4) {
                                            $rowstate = mysqli_fetch_assoc($result4);
                                            $profile_state =  $rowstate['state_title'];
                                            }

                                            $cityObj = new _city;
                                            $result5 = $cityObj->readCityName($city);
                                            if ($result5) {
                                            $rowcity = mysqli_fetch_assoc($result5);
                                            $profile_city =  $rowcity['city_title'];
                                            }
                                            if ($profile_additional_address != '' || $profile_city != '' || $profile_state != '' || $profile_country != '') {
                                                echo '<i class="fa fa-home"></i> ';
                                            

                                                if ($profile_additional_address != '') {
                                                    
                                                    echo $profile_additional_address.','; 
                                                }
                                                if ($profile_city != '') {
                                                    echo $profile_city.','; 
                                                }
                                                if ($profile_state != '') {
                                                    echo $profile_state.','; 
                                                }
                                                if ($profile_country != '') {
                                                    echo $profile_country.'.'; 
                                                }
                                            }
                                        ?>
                                    </p>
                                    <?php  } ?>
                                </span>
                                <p class="detail">
                                    <?php 
                                    if(strlen($cmpnyTagline) < 200){
                                        echo $cmpnyTagline;
                                    }else{
                                        echo substr($cmpnyTagline, 0,200)."...";
                                    } 
                                    ?>   
                                </p>
                               <!--  Business Profile rating -->
                                <div class="btn_Fav_res " >
                                    <?php
                                        $fd = new _favouriteBusiness;
                                        $result_fav = $fd->chkFavAlready($row['idspProfiles'], $_SESSION['pid'], 1);
                                        if($result_fav){
                                            ?>
                                            <a href="javascript:void(0)" class="removeToProfileFav" data-favourite="1" data-company="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                                <span id="addtofavouriteeve"><i class="fa fa-heart"></i></span>
                                                
                                            </a>
                                            <?php
                                        }else{
                                            ?>
                                            <a href="javascript:void(0)" class="addToProfileFav" data-favourite="1" data-company="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                                <span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span>
                                                
                                            </a>
                                            <?php
                                        }
                                        
                                    $fd = new _favouriteBusiness;
                                    $result_fav = $fd->chkFavAlready($row['idspProfiles'], $_SESSION['pid'], 2);
                                    if($result_fav){
                                        ?>
                                        <a href="javascript:void(0)" class="removeToResorc" data-favourite="2" data-company="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                            <span id="addtofavouriteeve"><i class="fa fa-star "></i></span>
                                            
                                        </a>
                                        <?php
                                    }else{
                                        ?>
                                        <a href="javascript:void(0)" class="addtoResorc" data-favourite="2" data-company="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                            <span id="addtofavouriteeve"><i class="fa fa-star-o"></i></span>
                                            
                                        </a>
                                        <?php
                                    }
                                    ?>                                                                          
                                </div>
                                <!--  Business Profile rating end-->
                                <!-- <p class="detail">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, </p> -->
                                <div class="detail_btn">
                                    <a href="<?php echo $BaseUrl.'/business-directory-services/details.php?business='.$row['idspProfiles'];?>" class="btn " >View Business Page</a>
                                    <a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['idspProfiles'];?>" class="btn " >View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <script>
                                function initMap() {
                                    var geocoder = new google.maps.Geocoder();

                                    <?php
                                    $count = 1;
                                    if(count($googleMap) > 0){
                                        foreach ($googleMap as $key => $value) { ?>

                                            var map<?php echo $count;?> = new google.maps.Map(document.getElementById('map<?php echo $count;?>'), {
                                                zoom: 5,
                                                center: {lat: -34.397, lng: 150.644}
                                            });
                                            var add<?php echo $count;?> = "<?php echo $value; ?>"; 
                                            geocodeAddress(geocoder, map<?php echo $count;?>, add<?php echo $count;?>);
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                    // =======
                                }
                            </script>
                            <div class="mapbox">
                                <div id="map<?php echo $i;?>" style="width: 100%;height: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        }
    }else{
        echo "<h3 style='text-align: center;font-weight: bold;'>There are no Businesses found with your searched words, please search again.</h3>";
    }
?>
