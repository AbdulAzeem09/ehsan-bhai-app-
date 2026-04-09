 

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">




<style>
    .parallax-overlay{
        z-index:0px !important;
    }
    .parallax{
        z-index:0px !important;
    }
    
    input.form-control {
    height: 34px;
}
        .cardimg img {
            margin: 0px !important;
            height: 169px !important;
            width: 100% !important;
            border-radius: 30px !important;
        }
        .custom-pr
        {
            padding-right:0px;
        }
        .custom-pl{
            padding-left:0px;
        }
        .header_mg{
            margin-left:150px !important;
        }
        /* On screens that are 600px or less, set the background color to olive */
        @media screen and (max-width: 600px) {
            .custom-pr
            {
                padding-right:15px; 
            }
            .custom-pl{
                padding-left:15px;
            }
            .header_mg{
                margin-left:0px !important;
            }
        }

        .cadtext {
            margin-top: 9px;
        }

        .cadtext row {
            padding-top: 10px;
            padding-left: 20px;
        }

        .cadtext row p {
            line-height: 23px;
        }

        .fontuser {
            position: relative;
        }

        .fontuser i {
            position: absolute;
            left: 90%;
            top: 6px;
            color: gray;
        }

        .category {
            position: relative;
        }

        .category img {
            position: absolute;
            left: 90%;
            top: 20px;

        }

        .row {
            margin-right: 0px;
        }
        body {
   
    line-height: 17px;
    
}
.zoom1:hover {
  -ms-transform: scale(1.05); /* IE 9 */
  -webkit-transform: scale(1.05); /* Safari 3-8 */
  transform: scale(1.05); 
  font-size:17px;
}

        .sweet-alert fieldset {
    border: none !important;
    position: relative !important;
    display: none !important;
}
        
    </style>


<div class="row">
<div class="col-md-12">
                    <div class="carousel">
                    <?php 
                        $de= new _businessrating;
                        $de1= $de->read_business_active($_SESSION['uid'], $_SESSION['pid']);
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
                    
                    <a href="<?php echo $BaseUrl;?>/business_for_sale/business_detail.php?postid=<?php echo $row['idspbusiness'];?>">
                            <div class="col-md-3" style="padding: 20px;">
                    <div class="row zoom1" style="border-radius: 30px;border:  solid 2px;background-color: #ddd7d7;">
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
                </div>