<!DOCTYPE html>
<html lang="en-US">

<head>
  <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/inner_group.css">
  <?php include('../component/links.php'); ?>
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
  <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
  <style type="text/css">
    .carousel-control {
      position: absolute;
      top: 0;
      bottom: 16px !important;
      left: 0;
      width: 15%;
      font-size: 20px;
      color: #fff;
      text-align: center;
      text-shadow: 0 1px 2px rgba(0, 0, 0, .6);
      background-color: rgba(0, 0, 0, 0);
      filter: alpha(opacity=50);
      opacity: .5;
    }

    .carousel-inner>.item {

      display: block;

    }

    .rating-box {
      position: relative !important;
      vertical-align: middle !important;
      font-size: 18px;
      font-family: FontAwesome;
      display: inline-block !important;
      color: lighten(@grayLight, 25%);
      /*padding-bottom: 10px;*/
    }

    .rating-box:before {
      content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
    }

    .ratings {
      position: absolute !important;
      left: 0;
      top: 0;
      white-space: nowrap !important;
      overflow: hidden !important;
      color: Gold !important;

    }

    .ratings:before {
      content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
    }

    .flag:hover {
      color: #428bca !important;
    }

    .left_grid ul li a p {
      margin-left: 28px !important;
    }
  </style>
</head>

<body class="bg_gray" onload="pageOnload('store')">
  <?php

  $g = new _spgroup;
  $result2 = $g->groupdetails($group_id);
  //echo $g->ta->sql;
  if ($result2 != false) {
    $row2 = mysqli_fetch_assoc($result2);
    $gimage = $row2["spgroupimage"];
    $spGroupflag = $row2['spgroupflag'];
  }
  ?>
  <div class="row">
    <div class="col-md-12">
      <div class="store">
        <div class="heading-wrapper">
          <div class="main-heading">
            Store
          </div>
          <div class="more-btn">
            <div class="btn">
              <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post">
                <img src="../assets/images/inner_group/add-4.svg" alt="">
                <span style="color: white;">Sell Product</span></a>
            </div>
          </div>
        </div>


        <!-- Retail Open -->
        <div class="products-wrapper" id="Retail">
          <div class="product">

            <?php

            $p = new _productposting;


            $res = $p->all_share_product(1, $_SESSION['pid'], $group_id);


            $active = 0;

            if ($res != false) {

              while ($rows = mysqli_fetch_assoc($res)) {

            ?>
                <input type="hidden" name="count" id="count" value="<?php echo $res->num_rows; ?>">

                <div class="item <?php echo ($active == 0) ? 'active' : ''; ?>">
                  <div class="img-wrapper">


                    <?php
                    $pic = new _productpic;
                    $result = $pic->read($rows['idspPostings']);
                    if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                      if ($result != false) {
                        $rp = mysqli_fetch_assoc($result);
                        $picture = $rp['spPostingPic'];
                        echo "<img alt='Posting Pic' style='width: 100% ; height : 100%' src=' " . ($picture) . "' >";
                      } else
                        echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='width: 100% ; height : 100%'>";
                    } else {
                      if ($result != false) {
                        $rp = mysqli_fetch_assoc($result);
                        $picture = $rp['spPostingPic'];
                        echo "<img alt='Posting Pic' style='width: 100% ; height : 100%' src=' " . ($picture) . "' >";
                      } else
                        echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='width: 100% ; height : 100%'>";
                    }
                    ?>


                    <!-- <a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>"></a> -->
                  </div>

                  <ul style="padding-left: 0px;display: grid; margin-bottom:0%">

                    <li style="padding-left: 10px;">
                      <h4 style="margin-bottom:0;background-color: unset;float: left;padding: 0px;">>

                        <?php

                        if (!empty($rows['spPostingTitle'])) {
                          if (strlen($rows['spPostingTitle']) < 15) {
                        ?><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
                                                                                                                                                                                                                                                                                          } else {
                                                                                                                                                                                                                                                                                            ?><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0, 15)) . '...'; ?></a><?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "&nbsp;";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ?>

                      </h4>
                    </li>

                    <li style="padding-left: 10px;">
                      <h5 style="margin-bottom:0;float: left;">

                        <?php
                        if ($rows['spPostingPrice'] != false) {
                          echo "<div class='postprice' style='' data-price='" . $rows['spPostingPrice'] . "'>" . "  " . $rows['default_currency'] . "  " . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                        } else {
                          echo "Expires on" . $rows['spPostingExpDt'];
                        }
                        ?>


                      </h5>
                    </li>
                    <li style="padding-left: 10px;">
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        (65)
                      </span>
                    </li>

                    <?php


                    $mr = new _spstorereview_rating;

                    $resultsum1 = $mr->readstorerating($rows['idspPostings']);

                    if ($resultsum1 != false) {



                      $totalmyreviews1 = $resultsum1->num_rows;

                      while ($rowreview1 = mysqli_fetch_assoc($resultsum1)) {

                        $sumrevrating1 += $rowreview1['rating'];

                        $rateingarr1[] =  $rowreview1['rating'];
                      }

                      $count1 = count($rateingarr1);

                      $reviewaveragerate1 = $sumrevrating1 / $count1;

                      $totalreviewrate1  = round($reviewaveragerate1, 1);
                    }


                    ?>

                    <a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>"><b>Detailed</b></a>

                    <li>
                      <div class="button-wrapper">
                        <a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">
                          <div class="btn">
                            <span>
                              <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.3125 25.3125C10.8303 25.3125 11.25 24.8928 11.25 24.375C11.25 23.8572 10.8303 23.4375 10.3125 23.4375C9.79473 23.4375 9.375 23.8572 9.375 24.375C9.375 24.8928 9.79473 25.3125 10.3125 25.3125Z" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M23.4375 25.3125C23.9553 25.3125 24.375 24.8928 24.375 24.375C24.375 23.8572 23.9553 23.4375 23.4375 23.4375C22.9197 23.4375 22.5 23.8572 22.5 24.375C22.5 24.8928 22.9197 25.3125 23.4375 25.3125Z" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.8125 4.6875H6.5625L9.375 20.625H24.375" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.375 15.625H23.9906C24.099 15.6251 24.2041 15.5876 24.288 15.5189C24.3718 15.4502 24.4293 15.3545 24.4506 15.2482L26.1381 6.81074C26.1517 6.74271 26.15 6.6725 26.1332 6.60518C26.1164 6.53786 26.0849 6.47511 26.0409 6.42147C25.9969 6.36782 25.9415 6.32461 25.8788 6.29496C25.816 6.26531 25.7475 6.24995 25.6781 6.25H7.5" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                            </span>
                            Buy
                          </div>
                        </a>
                      </div>
                    </li>
                  </ul>

                </div>



            <?php
                $active++;
              }
            } else {

              echo "<script>document.getElementById('Retail').style.display = 'none';</script>";
            }
            ?>



          </div>


        </div>

        <!-- Retail Close -->

        <!-- Wholesale Open -->

        <div class="products-wrapper" id="Wholesale">
          <div class="product">
            <?php


            $resw = $p->mywholesalegroupproductlimit(1, $_GET["groupname"]);



            $active = 0;
            if ($resw != false) {
              while ($rowsw = mysqli_fetch_assoc($resw)) {

            ?>



                <div class="item <?php echo ($active == 0) ? 'active' : ''; ?>">
                  <div class="img-wrapper">

                    <?php
                    $pic = new _productpic;
                    $result = $pic->read($rowsw['idspPostings']);
                    if ($rowsw['idspCategory'] != 5 && $rowsw['idspCategory'] != 2) {
                      if ($result != false) {
                        $rp = mysqli_fetch_assoc($result);
                        $picture = $rp['spPostingPic'];
                        echo "<img alt='Posting Pic' style='width: 100% ; height : 100%' src=' " . ($picture) . "' style='width: 100% ; height : 100%'>";
                      } else
                        echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='width: 100% ; height : 100%'>";
                    } else {
                      if ($result != false) {
                        $rp = mysqli_fetch_assoc($result);
                        $picture = $rp['spPostingPic'];
                        echo "<img alt='Posting Pic' style='width: 100% ; height : 100%' src=' " . ($picture) . "' >";
                      } else
                        echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='width: 100% ; height : 100%'>";
                    }
                    ?>

                  </div>
                  <ul style="padding-left: 0px;display: grid; margin-bottom:0%">

                    <li style="padding-left: 10px;">
                      <h4 style="margin-bottom:0;background-color: unset;float: left;padding: 0px;">

                        <?php

                        if (!empty($rowsw['spPostingTitle'])) {
                          if (strlen($rowsw['spPostingTitle']) < 15) {
                        ?><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords($rowsw['spPostingTitle']); ?></a><?php
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                              ?><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords(substr($rowsw['spPostingTitle'], 0, 15)) . '...'; ?></a><?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          echo "&nbsp;";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ?>

                      </h4>
                    </li>
                    <li style="padding-left: 10px;">
                      <h5 style="float: left;">

                        <?php
                        if ($rowsw['spPostingPrice'] != false) {
                          echo "<div class='postprice text-center' style='' data-price='" . $rowsw['spPostingPrice'] . "'>$" . $rowsw['spPostingPrice'] . "/Pieces</div><span class='" . ($rowsw['idspCategory'] == 5 || $rowsw['idspCategory'] == 18 || $rowsw['idspCategory'] == 9 || $rowsw['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                        } else {
                          echo "Expires on " . $rowsw['spPostingExpDt'];
                        }
                        ?>


                      </h5>

                      <?php


                      $mr = new _spstorereview_rating;

                      $resultsum3 = $mr->readstorerating($rowsw['idspPostings']);

                      if ($resultsum3 != false) {



                        $totalmyreviews3 = $resultsum3->num_rows;

                        while ($rowreview3 = mysqli_fetch_assoc($resultsum3)) {

                          $sumrevrating3 += $rowreview3['rating'];

                          $rateingarr3[] =  $rowreview3['rating'];
                        }

                        $count3 = count($rateingarr3);

                        $reviewaveragerate3 = $sumrevrating3 / $count3;

                        $totalreviewrate3  = round($reviewaveragerate3, 1);
                      }


                      ?>
                    </li>
                    <li style="padding-left: 10px;">
                      <h5 style="margin-bottom:0;float: left;">Min order: <?php echo $rowsw['minorderqty'];  ?> Pieces</h5>

                    </li>
                    <li style="padding-left: 10px;">
                      <p class="rating_box">

                      <div class="rating-box">
                        <?php if ($totalreviewrate3 >= "5") {
                          echo '<div class="ratings" style="width:100%;"></div>';
                        } else  if ($totalreviewrate3 >= "4" && $totalreviewrate3 < "5") {
                          echo '<div class="ratings" style="width:92%;"></div>';
                        } else  if ($totalreviewrate3 >= "4") {
                          echo '<div class="ratings" style="width:80%;"></div>';
                        } else  if ($totalreviewrate3 > "3" && $totalreviewrate3 < "4") {
                          echo '<div class="ratings" style="width:72%;"></div>';
                        } else  if ($totalreviewrate3 >= "3") {
                          echo '<div class="ratings" style="width:60%;"></div>';
                        } else  if ($totalreviewrate3 > "2" && $totalreviewrate3 < "3") {
                          echo '<div class="ratings" style="width:51%;"></div>';
                        } else  if ($totalreviewrate3 >= "2") {
                          echo '<div class="ratings" style="width:38%;"></div>';
                        } else  if ($totalreviewrate3 > "1" && $totalreviewrate3 < "2") {
                          echo '<div class="ratings" style="width:29%;"></div>';
                        } else  if ($totalreviewrate3 >= "1") {
                          echo '<div class="ratings" style="width:16%;"></div>';
                        } else  if ($totalreviewrate3 <= "0") {
                        }

                        ?>

                      </div>

                      </p>
                    </li>
                    <li style="padding-left: 10px;">
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        (65)
                      </span>
                    </li>
                    <li>
                      <div class="button-wrapper">
                        <a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>">
                          <div class="btn">
                            <span>
                              <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.3125 25.3125C10.8303 25.3125 11.25 24.8928 11.25 24.375C11.25 23.8572 10.8303 23.4375 10.3125 23.4375C9.79473 23.4375 9.375 23.8572 9.375 24.375C9.375 24.8928 9.79473 25.3125 10.3125 25.3125Z" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M23.4375 25.3125C23.9553 25.3125 24.375 24.8928 24.375 24.375C24.375 23.8572 23.9553 23.4375 23.4375 23.4375C22.9197 23.4375 22.5 23.8572 22.5 24.375C22.5 24.8928 22.9197 25.3125 23.4375 25.3125Z" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.8125 4.6875H6.5625L9.375 20.625H24.375" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.375 15.625H23.9906C24.099 15.6251 24.2041 15.5876 24.288 15.5189C24.3718 15.4502 24.4293 15.3545 24.4506 15.2482L26.1381 6.81074C26.1517 6.74271 26.15 6.6725 26.1332 6.60518C26.1164 6.53786 26.0849 6.47511 26.0409 6.42147C25.9969 6.36782 25.9415 6.32461 25.8788 6.29496C25.816 6.26531 25.7475 6.24995 25.6781 6.25H7.5" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                            </span>
                            Buy
                          </div>
                        </a>
                      </div>
                    </li>

                  </ul>

                </div>

            <?php
                $active++;
              }
            } else {

              echo "<script>document.getElementById('Wholesale').style.display = 'none';</script>";
            }
            ?>

          </div>
        </div>
        <!-- wholesaler close  -->

        <!-- Auction open -->

        <div class="products-wrapper" id="Auction">
          <div class="product">
            <?php
            $resA = $p->myauctiongroupproductlimit(1, $_GET["groupname"]);
            $active = 0;
            if ($resA != false) {
              while ($rows = mysqli_fetch_assoc($resA)) {


            ?>
                <div class="item <?php echo ($active == 0) ? 'active' : ''; ?>">

                  <div class="img-wrapper">
                    <?php
                    $pic = new _productpic;
                    $result = $pic->read($rows['idspPostings']);
                    if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                      if ($result != false) {
                        $rp = mysqli_fetch_assoc($result);
                        $picture = $rp['spPostingPic'];
                        echo "<img alt='Posting Pic'  src=' " . ($picture) . "' style='width: 100% ; height : 100%' >";
                      } else
                        echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='width: 100% ; height : 100%' >";
                    } else {
                      if ($result != false) {
                        $rp = mysqli_fetch_assoc($result);
                        $picture = $rp['spPostingPic'];
                        echo "<img alt='Posting Pic' src=' " . ($picture) . "' style='width: 100% ; height : 100%' >";
                      } else
                        echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='width: 100% ; height : 100%' >";
                    }
                    ?>

                  </div>
                  <ul style="padding-left: 0px;display: grid; margin-bottom:0%">

                    <li style="padding-left: 10px;">
                      <h4 style="margin-bottom:0;background-color: unset;float: left;padding: 0px;">

                        <?php

                        if (!empty($rows['spPostingTitle'])) {
                          if (strlen($rows['spPostingTitle']) < 15) {
                        ?><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                              ?><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0, 15)) . '...'; ?></a><?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "&nbsp;";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ?>

                      </h4>

                    <li style="padding-left: 10px;">
                      <h5 style="margin-bottom:0;float: left;">

                        <?php
                        if ($rows['spPostingPrice'] != false) {
                          echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>$" . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                        } else {
                          echo "Expires on " . $rows['spPostingExpDt'];
                        }
                        ?>


                      </h5>
                    </li>
                    <li style="padding-left: 10px;">
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14.173 7.17173C15.2437 6.36184 14.6709 4.65517 13.3284 4.65517H10.8992C10.2853 4.65517 9.74301 4.25521 9.56168 3.66868L8.83754 1.32637C8.4309 0.0110567 6.5691 0.0110564 6.16246 1.32637L5.43832 3.66868C5.25699 4.25521 4.71469 4.65517 4.10078 4.65517H1.62961C0.291419 4.65517 -0.284081 6.35274 0.778218 7.16654L2.89469 8.78792C3.35885 9.1435 3.55314 9.75008 3.38196 10.3092L2.61296 12.8207C2.21416 14.1232 3.72167 15.1704 4.80301 14.342L6.64861 12.9281C7.15097 12.5432 7.84903 12.5432 8.35139 12.9281L10.1807 14.3295C11.2636 15.159 12.7725 14.1079 12.3696 12.8046L11.59 10.2827C11.4159 9.71975 11.613 9.10809 12.0829 8.75263L14.173 7.17173Z" fill="#FB8308" />
                        </svg>
                      </span>
                      <span>
                        (65)
                      </span>
                    </li>
                    <input type="hidden" id="auctionexpid<?php echo $rows['idspPostings'] ?>" value="<?php echo $rows['idspPostings'] ?>">

                    <input type="hidden" id="auctionexp<?php echo $rows['idspPostings'] ?>" value="<?php echo $rows['spPostingExpDt'] ?>">

                    <script type="text/javascript">
                      $(document).ready(function() {
                        get_auctionexpdata("<?php echo $rows['idspPostings']; ?>");


                      });
                    </script>

                    <li style="padding-top: 8px; padding-left: 10px;">
                      <span id="auction_enddate<?php echo $rows['idspPostings'] ?>"></span>
                    </li>
                    <li>
                      <div class="button-wrapper">
                        <a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">
                          <div class="btn">
                            <span>
                              <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.3125 25.3125C10.8303 25.3125 11.25 24.8928 11.25 24.375C11.25 23.8572 10.8303 23.4375 10.3125 23.4375C9.79473 23.4375 9.375 23.8572 9.375 24.375C9.375 24.8928 9.79473 25.3125 10.3125 25.3125Z" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M23.4375 25.3125C23.9553 25.3125 24.375 24.8928 24.375 24.375C24.375 23.8572 23.9553 23.4375 23.4375 23.4375C22.9197 23.4375 22.5 23.8572 22.5 24.375C22.5 24.8928 22.9197 25.3125 23.4375 25.3125Z" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.8125 4.6875H6.5625L9.375 20.625H24.375" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.375 15.625H23.9906C24.099 15.6251 24.2041 15.5876 24.288 15.5189C24.3718 15.4502 24.4293 15.3545 24.4506 15.2482L26.1381 6.81074C26.1517 6.74271 26.15 6.6725 26.1332 6.60518C26.1164 6.53786 26.0849 6.47511 26.0409 6.42147C25.9969 6.36782 25.9415 6.32461 25.8788 6.29496C25.816 6.26531 25.7475 6.24995 25.6781 6.25H7.5" stroke="#3E2048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                            </span>
                            Buy
                          </div>
                        </a>
                      </div>
                    </li>

                  </ul>


                </div>
            <?php
                $active++;
              }
            } else {

              echo "<script>document.getElementById('Auction').style.display = 'none';</script>";
            }
            ?>

          </div>

        </div>



      </div>


      <!-- Auction close -->

    </div>

  </div>
  <!--SHARE MODEL-->


  <script type="text/javascript">
    function get_auctionexpdata(id) {


      var auction_exp = $("#auctionexp" + id).val()

      var countDownDate = new Date(auction_exp).getTime();


      var x = setInterval(function() {

        var now = new Date().getTime();

        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);



        if (days > 0 && hours > 0 && minutes > 0 && seconds > 0) {

          document.getElementById("auction_enddate" + id).innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

          document.getElementById("oldbidtime").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

          document.getElementById("lowbidtime").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        } else if (days <= 0 && hours > 0 && minutes > 0 && seconds > 0) {

          document.getElementById("auction_enddate" + id).innerHTML = hours + "h " +
            minutes + "m " + seconds + "s ";

          document.getElementById("oldbidtime").innerHTML = hours + "h " +
            minutes + "m " + seconds + "s ";

          document.getElementById("lowbidtime").innerHTML = hours + "h " +
            minutes + "m " + seconds + "s ";

        } else if (days <= 0 && hours <= 0 && minutes > 0 && seconds > 0) {

          document.getElementById("auction_enddate" + id).innerHTML = minutes + "m " + seconds + "s ";

          document.getElementById("oldbidtime").innerHTML = minutes + "m " + seconds + "s ";

          document.getElementById("lowbidtime").innerHTML = minutes + "m " + seconds + "s ";

        } else if (days <= 0 && hours <= 0 && minutes <= 0 && seconds > 0) {

          document.getElementById("auction_enddate" + id).innerHTML = seconds + "s ";

          document.getElementById("oldbidtime").innerHTML = seconds + "s ";

          document.getElementById("lowbidtime").innerHTML = seconds + "s ";

        }


        if (days == 0 && hours == 0 && minutes <= 5) {

          $('#auction_end').show();
          $('#AuctionPrice').hide();
          $('.placebidAuction').hide();
          $('#bidmsg').hide();
        }
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("auction_enddate" + id).innerHTML = "EXPIRED";
        }
      }, 1000);


    }
  </script>
  <script type="text/javascript">
    $(document).ready(function() {

    });
  </script>
</body>

</html>