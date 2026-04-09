<?php
session_start();
if (isset($_SESSION['deactivateStatus']) && $_SESSION['deactivateStatus'] == 1) {
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      window.onload = function() {
        Swal.fire({
          title: 'Your account is deactivated!',
          text: 'Go to settings to enable it.',
          icon: 'warning',
          showCancelButton: false,
          confirmButtonText: 'Go to Settings',
          allowOutsideClick: false, // Don't allow closing by clicking outside
          allowEscapeKey: false // Don't allow closing with Escape key
        }).then((result) => {
          if (result.isConfirmed) {
            // Navigate to dashboard/settings
            window.location.href = '/SHAREPAGE_CODES/dashboard/settings';
          }
        });
      };
    </script>
    <?php
}
?>




<?php

$signup = 0;
if(isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1){
  $signup = 1;
}
$page = "subscription";
include_once("../views/common/header.php");
$user = selectQ("SELECT * from spuser where idspUser=?", "i", [$_SESSION['uid']], 'one');
?>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Poppins", sans-serif !important;
    background-color: #f7f8fc !important;
}

a {
    text-decoration: none !important;
}

.buss_pln,
.buss_pro,
.buss_summ {
    background-color: #fff;
    box-shadow: 1px 1px 7px 0px #0000001A;

}
.buss_pro{
    padding: 12px 20px;
}
.buss_pro .pro_img>img{
    width: 40%;
    border-radius: 50%;
}
.ref_cde h5{
    font-size: 14px;
    line-height: 20px;
}
i.fa-regular.fa-copy , i.fa-solid.fa-plus {
    background-color: #7649B3;
    color: #fff;
    padding: 5px;
    border-radius: 5px;
}
.pro_dwn .form-group{
    width: 84%;
}
.pro_dwn .inpt_tg{
padding: 2px 5px !important;
font-size: 12px;
}
.pro_btn{
    background-color: #df6f00 !important;
    color: #fff !important;
    font-size: 13px !important;
}
.pro_sub{
    display: grid;
    row-gap: 13px;
}
i.fa-solid.fa-heart, .fa-solid.fa-envelope, .fa-solid.fa-users-line{
    color: #df6f00;
    font-size: 15px;
}
.soc_icn span{
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
}
.ref_cde_sub span{
font-size: 14px;
font-weight: 600;
line-height: 20px;
}

.buss_pln h2 {
    font-size: 36px;
    font-weight: 600;
    line-height: 24px;

}

.buss_pln h3.head {
    font-size: 50px;
    font-weight: 400;
    color: #FB8308;
    font-family: "Rancho", sans-serif !important;
}

.card-header {
    background-color: #3E2048 !important;
}

.card-header h4.head_title {
    font-weight: 500;
    font-size: 28px;
    line-height: 36px;
}

.card-header.d-grid.py-3 {
    position: relative;
    height: 130px;
    border-radius: 15px 15px 0 0;
}

.pln_img {
    bottom: -43px;
    background-color: #FFBE00;
    width: 100px;
    height: 100px;
    padding: 20px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    box-shadow: 0px 0px 20px 0px #00000033;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}

.card-body {
    background-color: #F7F8FC;
    border-radius: 0 0 15px 15px;
}

.card-body .pricing-card-title {
    font-size: 50px;
    font-weight: 500;
    line-height: 36px;
    color: #08B564;
    padding-top: 70px;
}

.buss_pln_bx p.sub_cnt {
    font-size: 24px;
    line-height: 26px;
    font-weight: 400;
}

.card-body .sub_btn {
    background-color: #7649B3;
    padding: 10px 45px;
    border-radius: 100px;
}

.card-body .sub_btn:hover {
    background-color: #7649B3;
}

.alrt_img {
    height: 60px;
    width: 70px;
    background-color: white;
    border-radius: 50%;
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.alrt_sec .alrt_box {
    background-color: #FFEBDD;
}

.alrt_sec h4 {
    font-size: 18px;
    line-height: 24px;
    font-weight: 600;
}

.alrt_sec p {
    font-size: 15px;
    line-height: 22px;
    font-weight: 500;
}

.buss_pln .buss_pln_bck>button {
    padding: 3px 63px;
    border-radius: 30px;
    font-size: 22px;
    line-height: 32px;
    font-weight: 600;
    border: 2px solid #3E2048;
    background-color: white;
    color: #3E2048;

}

.buss_pln .buss_pln_lst_sec .h3_head {
    font-size: 28px;
    line-height: 36px;
    font-weight: 600;
}

.buss_pln .buss_pln_lst_sec .pln_rte .rte {
    color: #08B564;
    font-size: 50px;
    font-weight: 500;
    line-height: 36px;
}

.buss_pln .buss_pln_lst_sec .p_cnt {
    font-size: 24px;
    line-height: 40px;
    font-weight: 400;
}

.hr_tag {
    width: 6%;
    height: 6px;
    background-color: #ff8100;
    border: none;
    opacity: 1;
}

.chk_pay_img {
    border: 1px solid #EEEEEE;
    padding: 7px;
    border-radius: 5px;
}

.scnd_sec .h2_head {
    font-size: 50px;
    font-weight: 600;
    line-height: 75px;
}

.chk_sec_head {
    font-size: 26px;
    line-height: 36px;
    font-weight: 500;
}

.chk_lbl>label,
.bill_box>label,
.buss_summ form label {
    font-size: 18px;
    font-weight: 400;
    line-height: 20px;
}

label>span {
    color: red;
}

.bill_clm_box {
    display: grid;
    column-gap: 17px;
    row-gap: 10px;
    grid-template-columns: repeat(2, 1fr);
}

.cntry_clm_2 {
    display: grid;
    column-gap: 17px;
    row-gap: 10px;
    grid-template-columns: repeat(4, 1fr);
}

.chk_sec_head1 {
    font-size: 28px;
    line-height: 36px;
    font-weight: 500;
}

.sav_crd>li>label {
    line-height: 35px;
    font-size: 18px;
    font-weight: 400;
}


input[type="checkbox" i]:focus-visible {
    outline-offset: unset !important;
    outline: unset !important;
}

/*radio button custom design*/
.radio_btn {
    width: 27px !important;
    height: 27px !important;
}

.chk_bx {
    border-radius: 50% !important;
}

.rd_btn {
    position: relative;
}

.tick_mark {
    position: absolute;
}

.tick_mark::before {
    position: absolute;
    left: -19px;
    top: -47px;
    width: 20px;
    height: 20px;
    content: "\f00c";
    font-size: 18px;
    font-weight: 700;
    font-family: 'FontAwesome';
    color: #fff;
    display: none;
}

.form-check-input:checked[type=radio] {
    background-image: unset !important;
}

.form-check-input:checked {
    background-color: #08B564 !important;
    border: unset !important;
}

.form-check-input:focus {
    border-color: unset !important;
    box-shadow: unset !important;
}

.form-check-input:checked~.tick_mark::before {
    display: block;
}

.buss_summ h4 {
    /* padding: 10px 0; */
    font-size: 22px;
    font-weight: 500;
    line-height: 36px;
    background-color: #3E2048;
    color: white;
}

.buss_summ .code_cpn>button {
    border-radius: 5px !important;
    background-color: #7649B3;
    color: #fff;
    font-size: 18px;
    line-height: 32px;
    font-weight: 600;
    z-index: 0;
}
.buss_summ .code_cpn>input{
    border-radius: 5px !important;
}

.tl_amt h5 {
    font-size: 20px;
    font-weight: 400;
    line-height: 36px;
}

.tl_amt p {
    font-size: 20px;
    font-weight: 500;
    line-height: 36px;
    color: #08B564;
}

.ply_btn>button {
    font-size: 20px;
    font-weight: 600;
    line-height: 32px;
    letter-spacing: 0.01em;
    border: unset !important;
    background-color: #FB8308;
    color: #fff;
    padding: 10px 44px;
}
.ply_btn>a{
    text-decoration: underline !important;
}
.three_btn .skip{
    background-color: #3E2048;
    color: #fff;
}
.three_btn .skip:hover{
    background-color: #3c1e46;
    color: #fff;
}
.three_btn .save{
    background-color: #08B564;
    color: #fff;
}
.three_btn .save:hover{
    background-color: #069a55;
    color: #fff;
}
.three_btn .drft{
    background-color: #FB8308;
    color: #fff;
}
.three_btn .drft:hover{
    background-color: #df6f00;
    color: #fff;
}
/*popup*/
.overlay {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7);
    transition: opacity 500ms;
    visibility: hidden;
    opacity: 0;
  }
  .overlay:target {
    visibility: visible;
    opacity: 1;
  }
  
  .popup {
    margin: 70px auto;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    width: 30%;
    position: relative;
    transition: all 5s ease-in-out;
  }
  
  .popup h2 {
    margin-top: 0;
    color: #333;
    font-family: Tahoma, Arial, sans-serif;
  }
  .popup .close {
    position: absolute;
    top: -4px;
    right: 13px;
    transition: all 200ms;
    font-size: 30px;
    font-weight: bold;
    text-decoration: none;
    color: #333;
  }
  .popup .close:hover {
    color: #06D85F;
  }
  .popup .content {
    max-height: 30%;
    overflow: auto;
  }
  .pop_btn_ok{
    background-color: #3c1e46 !important;
    border: unset !important;
  }
  .pop_btn_cnl{
    background-color: #df6f00 !important; 
    border: unset !important;
  }
  .inpt_tg{
    background-color: #F9FAFB !important;
  }
@media screen and (max-width: 1440px){
    .pro_dwn .form-group{
        width: 80%;
    }
    .buss_pro {
        padding: 12px 6px;
    }
    .buss_pln h3.head, .buss_pln .buss_pln_lst_sec .pln_rte .rte , .scnd_sec .h2_head{
        font-size: 37px;
    }
    .card-header h4.head_title, .buss_pln .buss_pln_lst_sec .h3_head, .chk_sec_head, .chk_sec_head1{
        font-size: 22px;
    }
    .card-header.d-grid.py-3{
        height: 100px;
    }
    .card-body .pricing-card-title {
        font-size: 34px;
        padding-top: 53px;
    }
    .alrt_img{
        height: 48px;
    }
    .alrt_sec p{
        font-size: 13px;
    }
    .card-body .sub_btn{
        padding: 7px 30px;
    }
    .pln_img{
        width: 80px;
        height: 80px;
    }
.buss_pln_bx p.sub_cnt , .alrt_sec h4 ,.chk_lbl>label, .bill_box>label {
    font-size: 17px;
}
.buss_pln_bx p.sub_cnt{
    padding-top: 0 !important;
}
.buss_pln .buss_pln_lst_sec .p_cnt, .buss_summ h4{
    font-size: 19px;
}
.buss_summ form label{
    font-size: 14px;
}
.tl_amt h5, .tl_amt p{
    font-size: 16px;
    line-height: 25px;
}
.buss_summ .code_cpn>button , .buss_summ .code_cpn>input{
    font-size: 12px;
    line-height: 18px;
}
.ply_btn>button{
    font-size: 10px;
    padding: 4px 20px;
}
.buss_pln_bx {
    margin: 20px 0;
}
}
@media screen and (max-width: 768px){

    .buss_pro {
        padding: 12px 25px;
    }
section.col-12.buss_pln ,.buss_summ form {
    padding: 10px 40px !important;
    margin: 10px 0 !important;
}
.buss_pln h3.head, .buss_pln .buss_pln_lst_sec .pln_rte .rte, .scnd_sec .h2_head {
    font-size: 26px;
}
.buss_pln h3.head{
    margin: 0 !important;
}
.alrt_sec p {
    font-size: 11px;
    line-height: 16px;
}
.alrt_sec .alrt_box{
    padding: 10px 5px !important;
}
.alrt_img {
    height: 30px;
    width: 86px;
    padding: 6px;
}
.hr_tag{
    width: 17%;
}
.card-header h4.head_title, .buss_pln .buss_pln_lst_sec .h3_head, .chk_sec_head, .chk_sec_head1 {
    font-size: 17px;
}
.buss_pln_lst_sec .pln_rte .rte{
    font-size: 23px;
}
.buss_pln .buss_pln_lst_sec .p_cnt{
    font-size: 13px;
}
.buss_pln h3.head, .buss_pln .buss_pln_lst_sec .pln_rte .rte, .scnd_sec .h2_head {
    font-size: 26px;
    line-height: 35px;
}
.radio_btn {
    width: 23px !important;
    height: 23px !important;
}
.tick_mark::before {
    position: absolute;
    left: -19px;
    top: -48px;
    font-size: 15px;
}
.chk_lbl {
    padding: 8px 0 !important;
}
}
@media screen and (max-width: 480px) {
    .cntry_clm_2, .bill_clm_box{
        grid-template-columns: repeat(1, 1fr);
        row-gap: 0px;
    }
    .buss_pln_bx p.sub_cnt, .alrt_sec h4, .chk_lbl>label, .bill_box>label ,.sav_crd>li>label{
        font-size: 16px;
    }
    .buss_pln .buss_pln_lst_sec .h3_head{
        font-size: 14px;
        line-height: 20px;
    }
    .buss_pln .buss_pln_lst_sec .p_cnt {
        font-size: 11px;
    }
   .buss_pln .buss_pln_lst_sec .pln_rte .rte, .scnd_sec .h2_head {
        font-size: 21px;
    }
    .inpt_tg {
        font-size: 13px !important;
    }
  }
 
 

</style>


        <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
      </div>
      <div class="col-xl-8 col-lg-12 col-md-12 col-12 order-xl-2 order-lg-3 order-3 ">
          <section class="col-12 buss_pln px-lg-5 py-lg-3 p-1">
              <div class="">
                  <h3 class="pt-2 pb-2 head">Choose the perfect plan for your business needs:</h3>
              </div>
              <div class="container">
              <div class="row justify-content-center">
                  <?php
                    $userPackage = selectQ("select * from spmembership_transaction where uid = ? and pid = ? order by id desc", "ii", [$_SESSION['uid'], $_SESSION['pid']], "one");
                    $packages = selectQ("select * from spmembership", "", []);
                    if(count($packages) > 0) {
                    
                      foreach($packages as $package){
                      ?>
                        <div class="col-lg-4 mb-3 package-card" data-id="<?php echo $package['idspMembership']; ?>" data-name="<?php echo $package['spMembershipName']; ?>" data-amount="<?php echo $package['spMembershipAmount']; ?>" data-desc="<?php echo $package['spMembershipDesc']; ?>">
                          <div class="buss_pln_bx">
                            <div class="card-header d-grid justify-content-center py-3">
                              <h4 class="my-0 head_title text-white text-uppercase" style="font-size: 1rem;"><?php echo $package['spMembershipName']; ?></h4>
                              <div class="pln_img">
                                <img src="<?php echo $BaseUrl.($package['spMembershipIcon'] ?? "/assets/images/plan1.png"); ?>" class="img-fluid" alt="">
                              </div>
                            </div>
                            <div class="card-body p-2 text-center">
                              <h1 class="card-title pricing-card-title">$<?php echo $package['spMembershipAmount']; ?></h1>
                              <p class="sub_cnt pt-2"><?php echo $package['spMembershipDesc']; ?></p>
                              <div class="features-box" style="text-align:left;">
                                <ul class="p-4">
                                  <?php if($package['idspMembership'] == 12) { ?>                                 
                                    <li>1 Posting</li>
                                    
                                  <?php } if($package['idspMembership'] == 20) { ?>
                                    <li>Unlimited postings for 30 days.</li>
                        
                                  <?php } if($package['idspMembership'] == 21) { ?>
                                    <li>Unlimited postings for 365 days</li>
                        
                                  <?php } ?>
                                </ul>
                              </div>

                              <?php if(isset($userPackage['membership_id']) && $userPackage['membership_id'] == $package['idspMembership']){ ?>
                                  <button type="button" class=" btn btn-lg mt-3 text-white sub_btn" style="background-color:#FB8308 !important;">Purchased</button>
                              <?php } else {?>
                                  <button type="button" class=" btn btn-lg mt-3 text-white sub_btn pbtn">Select</button>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      <?php
                      }                          
                    }
                  ?>
              </div>
              </div>
              <div class="row ">
                  <div class="col-md-12 mt-3  alrt_sec">
                      <div class="alrt_box rounded-3 d-flex align-items-center p-3 " role="alert">
                          <div class="alrt_img">
                              <img src="<?php echo $BaseUrl ?>/assets/images/Vector(3).png" class="img-fluid" alt="">
                          </div>
                          <div class="ps-3">
                              <h4>GREAT NEWS!</h4>
                              <p class="m-0">Earn 15% referral commissions for each business referral and a free
                                  Subscription by referring
                                  7 businesses. Also you will earn 5% commissions from 2nd and 3rd tier referrals
                                  as well!</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="pt-5 buss_pln_lst_sec" style="display:none">
                  <h3 class="h3_head">Selected Plan</h3>
                  <hr class="m-0 hr_tag">
                  <div class="row pln_rte pt-3">
                      <div class=" col-lg-8 col-10 align-items-center d-flex ">
                          <span class="d-flex">
                              <p class="m-0  p_cnt"><span class="h3_head pe-3"></span></p>
                          </span>
                      </div>
                      <div class="col-lg-4 col-2">
                          <span id="packageId" style="display:none"></span>
                          <h3 class="text-end rte"></h3>
                      </div>

                  </div>
              </div>
          </section>
          <section class=" col-12 buss_pln scnd_sec px-lg-5 py-lg-3 p-1 mt-3">
              <div id="usedcard">
                  <h2 class="text-center h2_head">Checkout</h2>
                  <?php
                    $savedCards = selectQ("SELECT * from spcarddetail where uid=?", "i", [$_SESSION['uid']]);
                    if(count($savedCards) > 0){
                  ?>
                    <div class="pt-lg-1 pb-lg-5 pt-1 pb-1  chk_pay">
                    <h3 class="chk_sec_head">Use Saved Card</h3>
                    <hr class="m-0 hr_tag">
                  <?php
                      foreach($savedCards as $card){
                  ?>
                    <div class="form-check pt-1 pb-1">
                      <?php
                        $cardNumber = isset($card['cardNumber']) ? decryptMessage($card['cardNumber']) : "";
                        if($cardNumber){
                          $formattedCardNumber = substr($cardNumber, 0, 2) . str_repeat('*', 10) . substr($cardNumber, -4);
                          $formattedCardNumber = chunk_split($formattedCardNumber, 4, ' ');
                          $formattedCardNumber = rtrim($formattedCardNumber);
                        }
                      ?>
                      <input class="form-check-input radio_btn me-2" type="radio" name="savedCardInfo" id="<?php echo "card_".$card['id'];?>" data-id="<?php echo $card['id'];?>" data-name="<?php echo $card['customerName'];?>" data-number="<?php echo $cardNumber;?>" data-month="<?php echo $card['cardExpMonth'];?>" data-year="<?php echo $card['cardExpYear'];?>">
                      <img src="<?php echo $BaseUrl ?>/assets/images/hdfc.png" class="img-fluid chk_pay_img" alt="">
                      <label class="form-check-label ps-1" for="savedCardInfo">
                          <?php if(isset($card['customerName'])) { echo $card['customerName']; } ?>
                      </label> <br>
                      <span class="ps-5 text-muted"><?php if(isset($formattedCardNumber)) { echo $formattedCardNumber; } ?></span>
                      <div class="tick_mark"></div>
                    </div>
                  <?php
                      }
                  ?>
                  </div>
                  <?php
                    }
                  ?>
              </div>
              <div class="pb-lg-3 pb-1">
                  <h3 class="chk_sec_head">Add Card</h3>
                  <hr class="m-0 hr_tag">
                  <form action="<?php echo $BaseUrl;?>/membership/membership_purchase.php" id="checkOutFrom" method="post">
                      <div class="row">

                          <div class="col-lg-6 col-12">
                              <div class="py-3 d-grid chk_lbl">
                                  <input type="hidden" name="card_id" id="card_id" value="0">
                                  <input type="hidden" name="currency_code" value="$">
                                  <label for="cardNumber" class="form-label">Card
                                      Number<span>* </span><span id="card_name_error"></span></label>
                                  <input type="text" class="form-control inpt_tg py-2" id="cardNumber" name="cardNumber"
                                      placeholder="XXXX  XXXX  XXXX  XXXX" maxlength="19">
                              </div>
                          </div>
                          <div class="col-lg-3 col-6">
                              <div class="py-3 d-grid chk_lbl">
                                  <label for="expiryDate" class="form-label">Expiry
                                      Date<span>* </span><span id="expiry_date_error"></span></label>
                                  <input type="text" class="form-control inpt_tg py-2" id="expiryDate" name="expiryDate"
                                      placeholder="MM/YY" maxlength="5">
                              </div>
                          </div>
                          <div class="col-lg-3 col-6">
                              <div class="py-3 d-grid chk_lbl">
                                  <label for="cardCVC" class="form-label">Security
                                      Code<span>* </span><span id="security_code_error"></span></label>
                                  <input type="text" class="form-control inpt_tg py-2" id="cardCVC" name="cardCVC"
                                      placeholder="Ex. 311" maxlength="3">
                              </div>
                          </div>
                          <div class="col-lg-6 col-12">
                              <div class=" py-3 d-grid chk_lbl">
                                  <label for="customerName" class="form-label">Card Holder Full
                                      Name<span>* </span><span id="customer_name_error"></span></label>
                                  <input type="text" class="form-control inpt_tg py-2" id="customerName" name="customerName"
                                      placeholder="Enter Holder Name">
                              </div>
                          </div>

                      </div>
                  <ul class="list-inline sav_crd">
                      <li class="list-inline-item">
                          <input class="form-check-input radio_btn chk_bx" type="checkbox" value=""
                              id="saveCardBtn" name="saveCardBtn">
                          <label class="form-check-label ps-2" for="saveCardBtn">Save card for next
                              payment.</label>

                      </li>

                  </ul>
                  </form>
              </div>
          </section>
          <section class=" col-12 buss_pln scnd_sec px-lg-5 py-lg-3 p-1 mt-3">
              <form action="" id="personalInfo">
                  <div class="pt-lg-1 pb-lg-5 pt-1 pb-2">
                      <h3 class="chk_sec_head1">Personal Information</h3>
                      <hr class="m-0 hr_tag">
                      <div class="bill_clm_box">
                          <input type="hidden" name="spUserId" value="<?php echo $_SESSION['uid']; ?>">
                          <div class="py-3 d-grid chk_lbl">
                              <label for="spUserFirstName" class="form-label">Your
                                  Name<span>* </span><span id="name_error"></span></label>
                              <input type="text" class="form-control inpt_tg py-2" id="spUserFirstName" name="spUserFirstName"
                                  placeholder="Enter First Name" value="<?php if(isset($user['spUserFirstName'])) { echo $user['spUserFirstName'];  } ?>">
                          </div>

                          <div class="py-3 d-grid chk_lbl">
                              <label for="spUserPhone" class="form-label">Phone<span>* </span><span id="phone_error"></span></label>
                              <input type="text" class="form-control inpt_tg py-2" id="spUserPhone" name="spUserPhone"
                                  placeholder="Enter Phone" value="<?php if(isset($user['spUserPhone'])) { echo $user['spUserPhone'];  } ?>">
                          </div>
                      </div>
                      <div class="bill_clm_box">
                          <div class="py-3 d-grid chk_lbl">
                              <label for="spUserEmail" class="form-label">Email<span>* </span><span id="email_error"></span></label>
                              <input type="email" class="form-control inpt_tg py-2" id="spUserEmail" name="spUserEmail"
                                  placeholder="Enter Email" value="<?php if(isset($user['spUserEmail'])) { echo $user['spUserEmail'];  } ?>">
                          </div>
                      </div>


                  </div>
              <div class="pb-3">
                      <h3 class="chk_sec_head1">Billing Address</h3>
                      <hr class="m-0 hr_tag">
                      <div class="d-grid py-3 bill_box">
                          <label for="billAddress" class="form-label">Street
                              Address<span>* </span><span id="address_error"></span></label>
                          <input type="text" class="form-control inpt_tg py-2" id="billAddress" name="billAddress"
                              placeholder="Enter First Name" value="<?php if(isset($user['address'])) { echo $user['address'];  } ?>">
                      </div>
                      <div class="form-group text-start py-lg-1 py-0 cntry_clm_2">
                          <div class="bill_box">
                              <label for="spUserCountry" class=" my-2 text-capitalize">Country<span>*</span></label>
                              <select class="form-select inpt_tg" aria-label="Default select example"
                                  placeholder="chooes" id="spUserCountry" name="spUserCountry">
                                  <option value="0">Select Country</option>
                                  <?php 
                                    $countries = selectQ("select * from tbl_country", "", []); 
                                    if(count($countries) > 0){
                                      foreach($countries as $country){
                                      ?>
                                        <option value="<?php echo $country['country_id'];?>"<?php echo (isset($user['spUserCountry']) && $user['spUserCountry'] == $country['country_id'])?'selected':''; ?>><?php echo $country["country_title"];?></option>
                                      <?php
                                      }
                                    }
                                  ?>
                              </select>
                          </div>
                          <div class="bill_box form-group loadUserState">
                              <label for="spUserState" class="my-2 text-capitalize">State<span>*</span></label>
                              <select class="form-select inpt_tg" id="spUserState" aria-label="Default select example" name="spUserState">
                              <option value="0">Select State</option>
                                  <?php 
                                    if(isset($user['spUserCountry']) && $user['spUserCountry'] > 0){
                                      $states = selectQ("select * from tbl_state where country_id =?", "i", [$user['spUserCountry']]); 
                                      foreach($states as $state){
                                      ?>
                                        <option value="<?php echo $state['state_id'];?>"<?php echo ( $user['spUserState'] == $state['state_id'])?'selected':''; ?>><?php echo $state["state_title"];?></option>
                                      <?php
                                      }
                                    }
                                  ?>
                              </select>
                          </div>
                          <div class="bill_box form-group loadCity">
                              <label for="spUserCity" class="my-2 text-capitalize">City<span>*</span></label>
                              <select class="form-select inpt_tg" id="spUserCity" aria-label="Default select example" name="spUserCity">
                              <option value="0">Select City</option>
                              <?php 
                                if(isset($user['spUserState']) && $user['spUserState'] > 0){
                                  $cities = selectQ("select * from tbl_city where state_id =?", "i", [$user['spUserState']]); 
                                  foreach($cities as $city){
                              ?>
                                <option value="<?php echo $city['city_id'];?>"<?php echo ( $user['spUserCity'] == $city['city_id'])?'selected':''; ?>><?php echo $city["city_title"];?></option>
                              <?php
                                  }
                                }
                              ?>
                              </select>
                          </div>
                          <div class="bill_box form-group ">
                              <label for="postalCode" class="my-2 text-capitalize">Postal Code</label>
                              <input type="text" class="form-control inpt_tg py-2" id="postalCode" name="postalCode"
                                  placeholder="Enter Postal Code" value="<?php if(isset($user['spUserPostalCode'])) { echo $user['spUserPostalCode'];  } ?>">
                          </div>
                      </div>
                  </form>
              </div>
              <div class="btn-toolbar three_btn" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2" role="group" aria-label="First group">
                      <button type="button" class="btn skip " onclick="window.location.href = '<?php echo $BaseUrl; ?>/registration-steps.php?pageid=7';" style="display:none">Skip</button>
                  </div>
                  <div class="btn-group me-2" role="group" aria-label="Second group" style="display:none">
                      <button type="button" class="btn drft">Add Draft</button>

                  </div>
                  <!-- <div class="btn-group" role="group" aria-label="Third group">
                      <button type="button" class="btn save" id="saveBtn">Save</button>
                  </div>-->
              </div>
          </section>
      </div>
      <div class="col-xl-2 col-lg-6 col-md-12 col-12  order-xl-3 order-lg-2 order-2">
          <div class="alert alert-success pull-right" style="display:none;width: 500px;" id="div4" >Coupon Applied Successfully!</div>
          <div class="buss_summ">
              <h4 class="text-center py-1">Order Summary</h4>
              <form action="" class="px-3 pb-4" onSubmit="return false;">
                  <label for="" class="pb-2">Enter Coupon Code <br><span id="coupon_error"></span></label>
                  <div class="input-group code_cpn">
                      <input type="hidden" name="couponId" id="couponId" value="">
                      <input type="hidden" name="couponPercentage" id="couponPercentage" value="0">
                      <input type="text" class="form-control inpt_tg me-2" id="couponCode" placeholder=" Enter Code">
                      <button class="btn btn-outline-secondary text-uppercase" id="couponCodeBtn" type="button">Apply</button>
                  </div>
                  <div class="d-flex justify-content-between pt-3 tl_amt">
                      <h5 class="m-0">Subtotal</h5>
                      <p class="m-0" id="subTotal">$0</p>
                  </div>
                  <div class="d-flex justify-content-between tl_amt">
                      <h5 class="m-0">Discount</h5>
                      <p class="m-0" id="discount">$0</p>
                  </div>
                  <hr>
                  <div class="d-flex justify-content-between tl_amt">
                      <h5 class="m-0">Total</h5>
                      <p class="m-0" id="total">$0</p>
                  </div>
                  <div class="text-center  ply_btn pt-3">
                      <button class="rounded-pill  text-uppercase mb-2" onclick="stripePay(event)" id="payNow">Pay now</button><br>
                      <span id="securityMessage" style="color: red;"></span>
                      <p><span id="securityMessage" style="color: green;font-weight: 600;font-size: 14px;">All prices are in CAD</span></p>
                  </div>
                  <div id="popup1" class="overlay">
                      <div class="popup">
                          <a class="close" href="#">&times;</a>
                          <div class="content">
                              Your ad will be saved in your Draft Folder (under the specific module), you can pay
                              later and activate your ad.
                          </div>
                          <div class="btn-toolbar pt-3" role="toolbar" aria-label="Toolbar with button groups">
                              <div class="btn-group me-2" role="group" aria-label="First group">
                                  <button type="button"
                                      class="btn btn-primary text-uppercase pop_btn_ok">ok</button>
                              </div>
                              <div class="btn-group me-2 ps-2" role="group" aria-label="Second group">
                                  <button type="button"
                                      class="btn btn-secondary text-uppercase pop_btn_cnl">cancel</button>
                              </div>
                          </div>
                      </div>
                  </div>
                    <label for="verificationInput" class="chk_sec_head" id="verificationInputLabel" style="display: none;">Please enter the code sent to your phone</label>
                    <input type="text" id="verificationInput" style="display: none;" placeholder="Enter Verification Code" class="form-control inpt_tg me-2">
                      <button id="verifyButton" style="display: none; background-color: #7649B3; color: white;" class="btn btn-outline-secondary text-uppercase" onclick="return false;">Verify</button>
              </form>
          </div>
      </div>
    </div>
  </section>
  </div>
  <?php
  include_once("../views/common/footer.php");
  ?>
</body>
<style>
  .features-box {
    max-height: 240px;
    min-height: 240px;
    height: 240px;
    overflow-y: overlay;
    scrollbar-width: thin;
    font-size: 14px;
  }
  #loader {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
  }
  @media screen and (max-width: 1440px){
    .card-body .pricing-card-title {
      font-size: 50px;
      font-weight: 600;
    }
  }

  .card-body .pricing-card-title {
    font-size: 1rem;
    padding-top: 53px;
    font-weight: 600;
  }
</style>
<script>
  Stripe.setPublishableKey('<?php echo PUBLIC_KEY?>');
  document.getElementById('cardNumber').addEventListener('input', function(event) {
    let inputValue = event.target.value.replace(/\D/g, ''); // Remove non-digit characters
    let formattedValue = '';

    for (let i = 0; i < inputValue.length; i++) {
      if (i > 0 && i % 4 === 0) {
        formattedValue += '-';
      }
      formattedValue += inputValue.charAt(i);
    }

    event.target.value = formattedValue;
  });
  
  document.getElementById('expiryDate').addEventListener('input', function(event) {
    let inputValue = event.target.value.replace(/\D/g, '');

    if (inputValue.length > 2) {
      inputValue = inputValue.slice(0, 2) + '/' + inputValue.slice(2);
    }
    event.target.value = inputValue;

  });
  
  document.getElementById('cardCVC').addEventListener('input', function(event) {
    let inputValue = event.target.value.replace(/\D/g, '');
    event.target.value = inputValue;
  });
  
  document.getElementById('billAddress').addEventListener('keydown', function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
    }
  });

  document.getElementById('customerName').addEventListener('input', function(event) {
    let inputValue = event.target.value.replace(/[^\sa-zA-Z]/g, '');
    event.target.value = inputValue;
  });

  $('#verifyButton').click(function() {
    verifyOTPWithServer();
  });

  function verifyOTPWithServer(enteredOTP) {  
    var enteredOTP = $('#verificationInput').val();
    $.ajax({
        url: "/api.php?class=OtpVerification&action=verification",
        type: 'POST',
        data: { enteredOTP: enteredOTP },
        success: function(response) {
            var response = JSON.parse(response); 
            if (response.status === "success") {
                proceedWithPayment();
            } else {
                $('#securityMessage').text(response.error || "OTP verification failed.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error verifying OTP:", error);
        }
    });
  }

  var cardcvv = "";
  function stripePay(event) {
    event.preventDefault(); 
    $('#securityMessage').text("");
    var couponPercentage = $("#couponPercentage").val();
    cardcvv = originalCVV; 
    var personalValidationResult = validatePersonal();
    if (personalValidationResult !== 0) {
        return;
    } else {
      if(ValidCheckout() !== true){
        return false;
      }
      var form_data = new FormData(document.getElementById('personalInfo'));
      form_data.append('cardcvc', cardcvv);
      form_data.append('cardNumber', $("#cardNumber").val());
      form_data.append('expiryDate', $("#expiryDate").val());
      form_data.append('customerName', $("#customerName").val());
      form_data.append('couponId', $("#couponId").val());
      $.ajax({
          url: "/api.php?class=SecurityCheck&action=pay",
          type: 'POST',
          data: form_data,
          contentType: false,
          processData: false,
          success: function(response) {
              try {
                  var jsonResponse = JSON.parse(response); 
                  if (jsonResponse.status == "success") {
                      if(jsonResponse.percentage != undefined){
                        $("#couponPercentage").val(jsonResponse.percentage);
                      }
                      $('#verificationInputLabel').show();
                      $('#verificationInput').show();
                      $('#verifyButton').show();
                  } else {
                      $('#securityMessage').text(jsonResponse.error ||"Security check failed");
                  }
              } catch (error) {
                  console.error("Error parsing JSON:", error);
              }
          },
          error: function(xhr, status, error) {
              console.log(error);
          }
      });
    }
  }

  function proceedWithPayment() {
    //event.preventDefault();
    var couponPercentage = 0;
    var personalValidationResult = validatePersonal();
    if (personalValidationResult !== 0) {
      return ;
    }
    var form_data = new FormData(document.getElementById('personalInfo'));
    form_data.append('couponId', $("#couponId").val());
    $.ajax({
    url: 'update_personal_details.php',
    type: 'POST',
    data: form_data,
    contentType: false,
    processData: false,
    success: function(response) {
      couponPercentage = response;
      if(ValidCheckout() == true && couponPercentage != 100) {
        document.getElementById('loader').style.display = 'block';
        var expiryDate = $("#expiryDate").val();
        var month = expiryDate.slice(0, 2);
        var year = expiryDate.slice(3, 5);
        Stripe.createToken({
          number:$('#cardNumber').val(),
          cvc:cardcvv,
          exp_month : month,
          exp_year : year
        }, stripeResponseHandler);
         return false;
       } else if(ValidCheckout() == true && couponPercentage == 100) {
         document.getElementById('loader').style.display = 'block';
         stripeResponseHandler("", "");
       }
     },
     error: function(xhr, status, error) {
       console.log(error);
     }
    });
  }

  function validatePersonal(){
    var error = 0;
    var firstName = $("#spUserFirstName").val();
    var phone = $("#spUserPhone").val();
    var email = $("#spUserEmail").val();
    var address = $("#billAddress").val();
    var country = $('#spUserCountry option:selected').val();
    var state = $('#spUserState option:selected').val();
    var city = $('#spUserCity option:selected').val();
    var postalCode = $("#postalCode").val();
    if(firstName == ""){
      error = 1;
      $("#name_error").text("Please Enter Name");
      $("#spUserFirstName").focus();
    } else {
      $("#name_error").text("");
    }
    if(phone == ""){
      error = 1;
      $("#phone_error").text("Please Enter Phone Number");
      $("#spUserPhone").focus();
    } else {
      $("#phone_error").text("");
    }
    if(email == ""){
      error = 1;
      $("#email_error").text("Please Enter Email");
      $("#spUserEmail").focus();
    } else {
      $("#email_error").text("");
    }
    if(address == ""){
      error = 1;
      $("#address_error").text("Please Enter Address");
      $("#billAddress").focus();

    } else {
      $("#address_error").text("");
    }
    if(country == "0"){
      error = 1;
      $('label[for="spUserCountry"]').addClass('text-danger');
      $("#spUserCountry").focus();
    } else {
      $('label[for="spUserCountry"]').removeClass('text-danger');
    }
    if(state == "0"){
      error = 1;
      $('label[for="spUserState"]').addClass('text-danger');
      $("#spUserState").focus();
    } else {
      $('label[for="spUserState"]').removeClass('text-danger');
    }
    return error;
  }

  var originalCVV = "";
  function stripeResponseHandler(status, response) {
    var hostUrl = window.location.host;
    var hostSchema = window.location.protocol;
    var MAINURL = hostSchema+'//'+hostUrl;
    if(response.error) {
      document.getElementById('loader').style.display = 'none';
      Swal.fire({
        title: 'Payment Failed',
        text: response.error.message,
        icon: 'error',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Continue',
      });
    } else {
      var stripeToken = "";
      if(response['id'] != undefined){
        stripeToken = response['id'];
      }
      var packageId = $("#packageId").text();
      var couponId = $("#couponId").val();
      //var saveCardValue = $('#saveCardBtn').is(':checked') ? 'true' : 'false';
      var form_data = $('#checkOutFrom').serializeArray();
      //form_data.push({ name: 'saveCardBtn', value: saveCardValue });
      form_data.push({name: 'stripeToken', value: stripeToken});
      form_data.push({name: 'packageId', value: packageId});
      form_data.push({name: 'couponId', value: couponId});
      var serializedData = $.param(form_data);
      //alert(JSON.stringify(form_data));
      $.ajax({
        url: 'membership_purchase.php',
        type: 'POST',
        data: serializedData,
        success: function(response) {
          document.getElementById('loader').style.display = 'none';
          if(response.status == 1){
            Swal.fire({
              title: 'Payment Successful',
              icon: 'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Continue',
            }).then((result) => {
              if (result.isConfirmed) {
                if(response.url != undefined && response.url!= null){
                  window.location.href = MAINURL + response.url;
                } else {
                  window.location.href = MAINURL;
                }
              }
            });
          } else {
            Swal.fire({
              title: 'Payment Failed',
              text: response.message,
              icon: 'error',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Continue',
            });
          }
        },
        error: function(xhr, status, error) {
          //console.log(error);
        }
      });
    }
  }

  $(document).ready(function() {
    var showDiv4 = true;
    var hostUrl = window.location.host;
    var hostSchema = window.location.protocol;
    var MAINURL = hostSchema+'//'+hostUrl;

    $(document).on("input", "#cardNumber", function() {
      var cardNumber = $(this).val();
      if(cardNumber.length > 0){
        $("#card_name_error").text("");
      }
    });

    $(document).on("input", "#expiryDate", function() {
      var expiryDate = $(this).val();
      if(expiryDate.length > 0){
        $("#expiry_date_error").text("");
      }
    });

    $(document).on("input", "#cardCVC", function() {
      var cvcNumber = $(this).val();
      var cvv_expression = /^[0-9]{3}$/; 
        if (cvcNumber.length === 3 && cvv_expression.test(cvcNumber)) {
          originalCVV = cvcNumber; 
          $(this).val("***"); 
        }
        else {
         originalCVV = ""; 
        }
         $("#security_code_error").text(""); 
     });


    $(document).on("input", "#customerName", function() {
      var customerName = $(this).val();
      if(customerName.length > 0){
        $("#customer_name_error").text("");
      }
    });

    $("#spUserCountry").on("change", function () {
      var countryId = this.value;
      $.post(MAINURL+"/helpers/location/loadUserState.php", {
        countryId: countryId
      }, function (r) {
        $(".loadUserState").html(r);
      });
      var state = 0;
      $.post(MAINURL+"/helpers/location/loadUserCity.php", {
        state: state
      }, function (r) {
        $(".loadCity").html(r);
      });
    });
    
    $("#spUserState").on("change", function () {
      var state = this.value;
      $.post(MAINURL+"/helpers/location/loadUserCity.php", {state: state}, function (r) {
        $(".loadCity").html(r);
      });
    });
    
     
    $(document).on('click', 'input[name="savedCardInfo"]', function() {
      var cardId = $(this).data('id');
      var cName = $(this).data('name');
      $('#cardNumber').val($(this).data('number'));
      $('#expiryDate').val($(this).data('month') + '/' + $(this).data('year'));
      $('#customerName').val(cName);
      $('#card_id').val($(this).data('id'));
      $('#saveCardBtn').prop('checked', false); 
      $('#saveCardBtn').prop('disabled', true);
    });
    $('#cardNumber, #expiryDate, #cardCVC, #customerName').on('input', function() {
      $('#saveCardBtn').prop('disabled', false);
    });
    
    $("#couponCodeBtn").on("click", function () {
      $("#coupon_error").text("");
      var couponCode = $("#couponCode").val();
      var packageId = $("#packageId").text();
      if(couponCode == ""){
        $("#coupon_error").text("Please Enter Code");
        $("#couponCode").focus();
        return false;
      }
      /*if(packageId == ""){
        $("#coupon_error").text("Please Select a Package");
        $("#couponCode").focus();
        return false;
      }*/
      $.ajax({
        url: 'check_couponcode.php',
        type: 'POST',
        data: { "couponCode": couponCode, "packageId": packageId },
        dataType: 'json',
        success: function(response) {
          //var jsonResponse = JSON.parse(response);
          if(response.status == 0){
            $("#discount").text("$0");
            $("#coupon_error").text(response.message);
          }
          if(response.status == 1){
            if(response.couponId !== undefined){
              $("#couponId").val(response.couponId);
            }
            if(response.couponPercentage !== undefined){
              $("#couponPercentage").val(response.couponPercentage);
            }
            if(response.message){
              $("#div4").text(response.message);
              document.getElementById("div4").style.display = "block";
              setTimeout(function() {
                document.getElementById("div4").style.display = "none";
              }, 2000);
            } else {
              $("#div4").text("Coupon Applied Successfully!");
              $("#discount").text("$"+response.discount);
              $("#total").text("$"+response.discount_price);
              if(showDiv4) {
                document.getElementById("div4").style.display = "block";
                setTimeout(function() {
                  document.getElementById("div4").style.display = "none";
                }, 2000);
              }
            }
            showDiv4 = true;
          }
        },
        error: function(xhr, status, error) {
          showDiv4 = true;
          console.log(error);
        }
      });
      
    });
    
  });
  
  function ValidCheckout() {
    $("#coupon_error").text("");
    var valid = true;
    var packageId = $("#packageId").text();
    var cardNumber = $("#cardNumber").val();
    var expiryDate = $("#expiryDate").val();
    var securityCode = $("#cardCVC").val();
    var customerName = $("#customerName").val();
    var selectedCard = document.querySelector('input[name="savedCardInfo"]:checked');
    var validateName = /^[a-z ,.'-]+$/i;
    var validateMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    var validateYear = /^17|18|19|20|21|22|23|24|25|26|27|28|29|30|31$/;
    var cvv_expression = /^[0-9]{3,3}$/;
    var couponPercentage = $("#couponPercentage").val();
  
    if(packageId == ""){
      valid = false;
      $("#coupon_error").text("Please Select a Package");
    } else {
      $("#coupon_error").text("");
    }
    if(couponPercentage != 100){
      if(cardNumber == ""){
        valid = false;
        $("#card_name_error").text("Please Enter Card Number");
        $("#cardNumber").focus();
      } else {
        $("#card_name_error").text("");
      }
      if(expiryDate == "" || expiryDate.length != 5){
        valid = false;
        $("#expiry_date_error").text("Please Enter Expiry Dates");
        $("#expiryDate").focus();
      } else {
        let today = new Date();
        let inputDate = new Date('20' + expiryDate.slice(3, 5), expiryDate.slice(0, 2) - 1);
        if (!validateMonth.test(expiryDate.slice(0, 2))) {
          valid = false;
          $("#expiry_date_error").text("Invalid month");
          $("#expiryDate").focus();
        } else if(!validateYear.test(expiryDate.slice(3, 5))) {
          valid = false;
          $("#expiry_date_error").text("Invalid year");
          $("#expiryDate").focus();
        } else if (inputDate < today) {
          valid = false;
          $("#coupon_error").text("Card Expired");
        } else {
          $("#expiry_date_error").text("");
        }
      }
      if(securityCode == ""){
        valid = false;
        $("#security_code_error").text("Please Enter Security Code");
        $("#cardCVC").focus();
      } else {
        $("#security_code_error").text("");
      }
      if(customerName == ""){
        valid = false;
        $("#customer_name_error").text("Please Enter Card Holder Name");
        $("#customerName").focus();
      } else {
        $("#customer_name_error").text("");
      }
      //var form_data = new FormData(document.getElementById('checkOutFrom'));
    }
    return valid;
    
  };

  var input = document.getElementById('billAddress');
  var autocomplete = new google.maps.places.Autocomplete(input);
  document.addEventListener("DOMContentLoaded", function() {
    var packageCards = document.querySelectorAll('.package-card');
    var selectedPlanDesc = document.querySelector('.p_cnt');
    var selectedPlanAmount = document.querySelector('.rte');
    var selectedPlanId = document.querySelector('#packageId');
    var subTotal = document.querySelector('#subTotal');
    var total = document.querySelector('#total');

    packageCards.forEach(card => {
      var selectButton = card.querySelector('.pbtn');
      if(selectButton) {
        selectButton.addEventListener('click', function() {
          var packageName = card.getAttribute('data-name');
          var packageAmount = card.getAttribute('data-amount');
          var packageDesc = card.getAttribute('data-desc');
          var packageId = card.getAttribute('data-id');
          selectedPlanDesc.innerHTML = '<span class="h3_head pe-3">'+packageName+'</span>'+packageDesc;
          selectedPlanAmount.textContent ='$'+packageAmount;
          selectedPlanId.innerHTML = packageId;
          subTotal.innerHTML = '$'+packageAmount;
          total.innerHTML = '$'+packageAmount;
          var couponCode = $("#couponCode").val();
          if(couponCode != ""){
            showDiv4 = false;
            $("#couponCodeBtn").click();
          }
          //$("#discount").text("$0");
          //$("#couponCode").val("");
          document.querySelector('.buss_pln_lst_sec').style.display = 'block';
        });
      }
      
    });
    
    var saveCardCheckbox = document.getElementById("saveCardBtn");
    saveCardCheckbox.addEventListener("change", function() {
      var valid = true;
      var cardNumber = $("#cardNumber").val();
      var expiryDate = $("#expiryDate").val();
      var securityCode = $("#cardCVC").val();
      var customerName = $("#customerName").val();
      var validateName = /^[a-z ,.'-]+$/i;
      var validateMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
      var validateYear = /^17|18|19|20|21|22|23|24|25|26|27|28|29|30|31$/;
      var cvv_expression = /^[0-9]{3,3}$/;
      if(cardNumber == ""){
        valid = false;
        $("#card_name_error").text("Please Enter Card Number");
        $("#cardNumber").focus();
      } else {
        $("#card_name_error").text("");
      }
      if(expiryDate == "" || expiryDate.length != 5){
        valid = false;
        $("#expiry_date_error").text("Please Enter Expiry Dates");
        $("#expiryDate").focus();
      } else {
        let today = new Date();
        let inputDate = new Date('20' + expiryDate.slice(3, 5), expiryDate.slice(0, 2) - 1);
        if (!validateMonth.test(expiryDate.slice(0, 2))) {
          valid = false;
          $("#expiry_date_error").text("Invalid month");
          $("#expiryDate").focus();
        } else if(!validateYear.test(expiryDate.slice(3, 5))) {
          valid = false;
          $("#expiry_date_error").text("Invalid year");
          $("#expiryDate").focus();
        } else if (inputDate < today) {
          valid = false;
          $("#coupon_error").text("Card Expired");
        } else {
          $("#expiry_date_error").text("");
        }
      }
      if(securityCode == ""){
        valid = false;
        $("#security_code_error").text("Please Enter Security Code");
        $("#cardCVC").focus();
      } else {
        $("#security_code_error").text("");
      }
      if(customerName == ""){
        valid = false;
        $("#customer_name_error").text("Please Enter Card Holder Name");
        $("#customerName").focus();
      } else {
        $("#customer_name_error").text("");
      }
      if (valid == true && this.checked) {
        $('#cardCVC').val(originalCVV);


        var form_data = $('#checkOutFrom').serialize();
        $.ajax({
          type: 'POST',
          url: 'add_card.php',
          data: form_data,
          dataType: 'json',
          success: function(response) {
            if(response.status == 0){
              Swal.fire({
                title: 'Card Saving Failed',
                text: response.message,
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Continue',
              });
            } else {
              if(response.card_id != undefined){
                $('#card_id').val(response.card_id);
              }
              $('#saveCardBtn').prop('checked', false);
              $('#saveCardBtn').prop('disabled', true);
              $("#usedcard").load(" #usedcard > *");
            }
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
          }
        });
          $('#cardCVC').val("");
      } else {
        $('#saveCardBtn').prop('checked', false);
        return false;
      }
    });

  });
</script>
</html>
