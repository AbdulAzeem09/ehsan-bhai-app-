<?php  if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;} ?>

<?php 
$start  = 0;
if(isset($_GET['page']) && $_GET['page'] == 1){
    $pageCount = $_GET['page']-1;
    $start = 24 * $pageCount;    
}

$limitaa = 24; 
$au = new _productposting;
$result = $au->allretailproduct_retails(1, $_SESSION['pid'], $start, $limitaa);

?>


<div class="store">
    <div class="heading-wrapper">
        <div class="main-heading">
            Store
        </div>
        <div class="more-btn">
            <div class="btn">
                <img src="./images/add-4.svg" alt="">
                <span>Sell Product</span>
            </div>
        </div>
    </div>
    <div class="products-wrapper">
        <?php if($result != false){
            while($row3 = mysqli_fetch_assoc($result)){
                if($row3['spuser_idspuser']!=NULL){
                    $st= new _spuser;
                    $st1=$st->readdatabybuyerid($row3['spuser_idspuser']);
                    if($st1!=false){
                      $stt=mysqli_fetch_assoc($st1);
                      $account_status=$stt['deactivate_status'];
                  }
                }
                // $postingexpire = $row3['spPostingExpDt'];
                $price=$row3['spPostingPrice'];
                $default_currency= $row3['default_currency'];
                if($row3['sellType']=='Retail'){
                   if($row3['retailQuantity']!=''){
                         $discount   = $row3['retailQuantity'];
                   }
                   else{
                         $discount   = $row3['retailQuantity'];
                   }
                }
                if($row3['sellType']=='Wholesaler'){
                   $discount   = $row3['spPostingPrice'];
                }
                /// echo $special_discount;
                $spec_dis=(((int)$price * (int)$discount)/100);
                $disc_price=$price-$spec_dis;
                $dt = new DateTime($row3['spPostingDate']);
                if($account_status!=1){             
            ?>
            <div class="product">
                <!-- <div class="main-icons">
                    <img src="./images/fav.svg" alt="">
                    <img src="./images/eye.svg" alt="">
                </div> -->
                <div class="img-wrapper">
                <?php
                    $pic = new _productpic;
                    $result4 = $pic->read($row3['idspPostings']);
                    if ($row3['spCategories_idspCategory'] != 5 && $row3['spCategories_idspCategory'] != 2) {        
                    
                        if ($result4 != false) {
                            if(mysqli_num_rows($result4) > 0){
                                $rp = mysqli_fetch_assoc($result4);
                                $picture = $rp['spPostingPic'];
                    
                                echo "<img alt='Posting Pic' style='height: 100%; width: 100%;' class='img-fluid' src=' " . ($picture) . "' > ";
                            }
                    } else{
                        echo "<img alt='Posting Pic' style='height: 100%; width: 100%;' src='../assets/images/blank-img/no-store.png' class='img-fluid'>";
                    }
                    }else{
                        echo "<img alt='Posting Pic' style='height: 100%; width: 100%;' src='../assets/images/blank-img/no-store.png' class='img-fluid'>";
                    }
                    ?>
                </div>
                <div class="detail">
                    <div class="title">
                        The north coat
                    </div>
                    <div class="price">
                        $260 <span>$360</span>
                    </div>
                    <div class="star">
                        <span>
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z"
                                    fill="#FB8308" />
                            </svg>
                        </span>
                        <span>
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z"
                                    fill="#FB8308" />
                            </svg>
                        </span>
                        <span>
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z"
                                    fill="#FB8308" />
                            </svg>
                        </span>
                        <span>
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z"
                                    fill="#FB8308" />
                            </svg>
                        </span>
                        <span>
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z"
                                    fill="#FB8308" />
                            </svg>
                        </span>
                        <span>
                            (65)
                        </span>
                    </div>
                </div>
                <div class="button-wrapper">
                    <a href="<?php echo BASE_URL.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>">
                        <div class="btn">
                            <span>
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.3125 25.3125C10.8303 25.3125 11.25 24.8928 11.25 24.375C11.25 23.8572 10.8303 23.4375 10.3125 23.4375C9.79473 23.4375 9.375 23.8572 9.375 24.375C9.375 24.8928 9.79473 25.3125 10.3125 25.3125Z"
                                        stroke="#3E2048" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M23.4375 25.3125C23.9553 25.3125 24.375 24.8928 24.375 24.375C24.375 23.8572 23.9553 23.4375 23.4375 23.4375C22.9197 23.4375 22.5 23.8572 22.5 24.375C22.5 24.8928 22.9197 25.3125 23.4375 25.3125Z"
                                        stroke="#3E2048" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M2.8125 4.6875H6.5625L9.375 20.625H24.375" stroke="#3E2048"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M9.375 15.625H23.9906C24.099 15.6251 24.2041 15.5876 24.288 15.5189C24.3718 15.4502 24.4293 15.3545 24.4506 15.2482L26.1381 6.81074C26.1517 6.74271 26.15 6.6725 26.1332 6.60518C26.1164 6.53786 26.0849 6.47511 26.0409 6.42147C25.9969 6.36782 25.9415 6.32461 25.8788 6.29496C25.816 6.26531 25.7475 6.24995 25.6781 6.25H7.5"
                                        stroke="#3E2048" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            Buy
                        </div>
                    </a>
                </div>
            </div>
        <?php } }} ?>
    </div>
</div>