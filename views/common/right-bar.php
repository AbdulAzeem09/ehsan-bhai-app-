<div class="short-section-wrapper">
        <div class="stores">
          <div class="main-heading">
            <div class="heading">Stores</div>
            <span onclick="toggleClassOfDiv('collapse1')" id="storearrowbutton" class="lft_head">
              <img id="storearrow" style="transform: rotate(180deg);" src="<?php echo $BaseUrl?>/assets/images/up-arrow.svg" alt="">
            </span>
          </div>
          <div id="collapse1" class="panel-collapse collapse show">
          <?php
            $products = $t->ProductList();
            if(isset($products['data']) && count($products['data']) > 0){
              foreach($products['data'] as $product){
                $productpic = $t->getProductPic($product['idspPostings']);
                $sellerInfo = $t->readUserId($product['spProfiles_idspProfiles']);
                if(isset($sellerInfo['data']) && isset($sellerInfo['data']['spProfileName'])){
                  $sellerName = $sellerInfo['data']['spProfileName'];
                }
          ?>
            <div class="prod">
              <div class="img">
                <img src="<?php if(isset($productpic['data']['spPostingPic'])) { echo $productpic['data']['spPostingPic']; } else { echo $BaseUrl."/assets/images/prod.svg"; }?>" alt="">
              </div>
              <div class="detail">
                <a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $product['idspPostings']; ?>" class="name-link">
                <div class="name"><?php if(isset($product['spPostingTitle'])) { if(strlen($product['spPostingTitle']) < 15) { echo $product['spPostingTitle']; } else { echo substr($product['spPostingTitle'], 0, 15) . '...'; } } else { echo "No-Title"; } ?></div>
                </a>
                <div class="price"><?php if(isset($product['retailSpecDiscount']) && $product['retailSpecDiscount'] != $product['spPostingPrice']) { echo "<span>$".$product['spPostingPrice']."</span>$".$product['retailSpecDiscount']; } else if(isset($product['spPostingPrice'])) { echo "$".$product['spPostingPrice']; } ?></div>
                <div class="by">By <?php if(isset($sellerName)) { echo $sellerName; }?></div>
              </div>
            </div>
            <?php
              }
            }
            ?>
            <div class="view-all">
              <a href="<?php echo $BaseUrl?>/store/storeindex.php">VIEW ALL</a>
            </div>
          </div>
        </div>
        <!--<div class="news-channel">
          <div class="main-heading">
            <div class="heading">News Channel</div>
              <span onclick="toggleClassOfDiv('collapse2')" id="channelarrowbutton" class="lft_head">
                <img id="channelarrow" style="transform: rotate(180deg);" src="<?php echo $BaseUrl?>/assets/images/up-arrow.svg" alt="">
              </span>
            </div>
            <div id="collapse2" class="panel-collapse collapse show">
              <div class="add" style="margin: 10px 0px;">
                <a href="<?php echo $BaseUrl?>/news/index.php?page=1">
                <img src="<?php echo $BaseUrl?>/assets/images/add-3.svg" alt="">
                </a>
                Add                     
              </div>
              <div class="news-channel-wrapper">
                <div class="news">
                  <img src="<?php echo $BaseUrl?>/assets/images/news-1.svg" alt="">
                </div>
              <div class="news">
                <img src="<?php echo $BaseUrl?>/assets/images/news-2.svg" alt="">
              </div>
              <div class="news">
                <img src="<?php echo $BaseUrl?>/assets/images/news-3.svg" alt="">
              </div>
              <div class="news">
                <img src="<?php echo $BaseUrl?>/assets/images/news-4.svg" alt="">
              </div>
            </div>
            <div class="view-all">
              <a href="">VIEW ALL</a>
            </div>
          </div>
        </div>-->
        <div class="freelancer">
          <div class="main-heading">
            <div class="heading">Freelancing Work</div>
              <span onclick="toggleClassOfDiv('collapse3')" id="freelancearrowbutton" class="lft_head">
                <img id="freelancearrow" style="transform: rotate(180deg);" src="<?php echo $BaseUrl?>/assets/images/up-arrow.svg" alt="">
              </span>
            </div>
            <div id="collapse3" class="panel-collapse collapse show">
              <?php
                $freelanceWorks = $t->FreelancerWorkList();
                if(isset($freelanceWorks['data']) && count($freelanceWorks['data']) > 0){
                  foreach($freelanceWorks['data'] as $freelance){
              ?>
              <div class="jobs">
                <div class="project-name-budget">
                  <div class="name"><?php if(isset($freelance['spPostingTitle'])) { if(strlen($freelance['spPostingTitle']) < 15) { echo $freelance['spPostingTitle']; } else { echo substr($freelance['spPostingTitle'], 0, 15) . '...'; } } else { echo "No-Title"; } ?></div>
                  <!--<div class="budget">Budget: <span>$<?php if(isset($freelance['spPostingPrice'])) { echo $freelance['spPostingPrice']; } else { echo "0"; } ?></span></div>-->
                </div>
                <div class="skills">
                  <div class="title">
                    Key Skills: 
                  </div>
                  <div class="text">
                    <?php if(isset($freelance['spPostingSkill'])) { echo $freelance['spPostingSkill']; }?>
                  </div>
                </div>
              </div>
              <?php
                }
              }
              ?>
              <div class="view-all">
                <a href="<?php echo $BaseUrl;?>/freelancer/projects.php?cat=ALL">VIEW ALL</a>
              </div>
            </div>
          </div>
          <div class="events">
            <div class="main-heading">
              <div class="heading">Events</div>
              <span onclick="toggleClassOfDiv('collapse4')" id="eventarrowbutton" class="lft_head">
                <img id="eventarrow" style="transform: rotate(180deg);" src="<?php echo $BaseUrl?>/assets/images/up-arrow.svg" alt="">
              </span>
            </div>
            <div id="collapse4" class="panel-collapse collapse show">
            <?php
              $events = $t->EventList();
              if(isset($events['data']) && count($events['data']) > 0){
                foreach($events['data'] as $event){
                  $foemattedDate = "";
                  if(isset($event['spPostingStartDate'])){
                    $dateTimestamp = strtotime($event['spPostingStartDate']);
                    $formattedDate = date('l, F j, Y', $dateTimestamp); 
                  }
                  $formattedTime = "";
                  if(isset($event['spPostingStartTime'])){
                    $time = DateTime::createFromFormat('H:i:s', $event['spPostingStartTime']);
                    $formattedTime = $time->format('g:i A');
                  }
                  $eventpic = $t->getEventPic($event['idspPostings']);
            ?>
              <div class="event">
                <div class="img-wrapper">
                  <img src="<?php if(isset($eventpic['data']) && isset($eventpic['data']['spPostingPic'])) { echo $eventpic['data']['spPostingPic']; } else { echo $BaseUrl."/assets/images/event.svg"; }?>" alt="">
                </div>
                <div class="detail">
                  <a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $event['idspPostings']; ?>" class="name-link">
                  <div class="name"><?php if(isset($event['spPostingTitle'])) { if(strlen($event['spPostingTitle']) < 15) { echo $event['spPostingTitle']; } else { echo substr($event['spPostingTitle'], 0, 15) . '...'; } } else { echo "No-Title"; } ?></div>
                  </a>
                  <div class="date"><?php echo $formattedDate; ?></div>
                  <div class="date"><?php echo $formattedTime; ?></div>
                  <div class="location">
                    <img src="<?php echo $BaseUrl?>/assets/images/location.svg" alt="">
                    <?php if(isset($event['eventaddress'])) { echo $event['eventaddress']; } ?>
                  </div>
                </div>
              </div>
              <?php
                }
              }
              ?>
              <div class="view-all">
                <a href="<?php echo $BaseUrl?>/events/">VIEW ALL</a>
              </div>
            </div>
          </div>
          <div class="videos">
            <div class="main-heading">
              <div class="heading">Videos</div>
              <span onclick="toggleClassOfDiv('collapse5')" id="videoarrowbutton" class="lft_head">
                <img id="videoarrow" style="transform: rotate(180deg);" src="<?php echo $BaseUrl?>/assets/images/up-arrow.svg" alt="">
              </span>
            </div>
            <div id="collapse5" class="panel-collapse collapse show">
            <?php
              $videos = $t->getVideoList();
              if(isset($videos['data']) && count($videos['data']) > 0){
                foreach($videos['data'] as $video){
            ?>
              <div class="vedio">
                <div class="img-wrapper">
                <?php if (!empty($video['video_thumbnail'])) { ?>
                  <img src="<?php echo $video['video_thumbnail']; ?>" alt="">
                <?php } else if(isset($video['video_file'])) {?>
                  <video class="effect-fade lazyloaded" controls style="height: 50px!important; width: 80px;">
                    <source src="<?php echo $video['video_file']; ?>" type="video/mp4">
                  </video>
                <?php } else {?>
                  <img src="<?php echo $BaseUrl?>/assets/images/video.svg" alt="">
                <?php } ?>
                </div>
                <div class="detail">
                  <a href="<?php echo $BaseUrl .'/videos/watch.php?video_id=' . $video['video_id']; ?>" class="name-link">
                  <div class="name">
                    <?php if(isset($video['video_title'])) {
                     if(strlen($video['video_title']) < 10) { 
                      echo $video['video_title']; 
                     }
                     else { 
                      echo substr($video['video_title'], 0, 10) . '..'; 
                     } 
                     } else { echo "No-Title"; } 
                     ?>
                   </div>
                  </a>
                  <div class="sub-text">
                  <?php if(isset($video['video_desc'])) { 
                    if(strlen($video['video_desc']) < 15) { 
                      echo $video['video_desc']; 
                    }
                    else { 
                      echo substr($video['video_desc'], 0, 15) . '...'; 
                    }
                  }?>
                  </div>
                </div>
              </div>
              <?php
                }
              }
              ?>
              <div class="view-all">
                <a href="<?php echo $BaseUrl?>/videos/index.php?page=1">VIEW ALL</a>
              </div>
            </div>
          </div>
          <div class="videos">
            <div class="main-heading">
              <div class="heading">Arts & Crafts</div>
              <span onclick="toggleClassOfDiv('collapse6')" id="artarrowbutton" class="lft_head">
                <img id="artarrow" style="transform: rotate(180deg);" src="<?php echo $BaseUrl?>/assets/images/up-arrow.svg" alt="">
              </span>
            </div>
            <div id="collapse6" class="panel-collapse collapse show">
            <?php
              $arts = $t->ArtandCraftList();
              if(isset($arts['data']) && count($arts['data']) > 0){
                foreach($arts['data'] as $art){
                  $artpic = $t->getArtandCraftPic($art['idspPostings']);
            ?>
              <div class="vedio">
                <div class="img-wrapper">
                  <a href="<?php echo $BaseUrl?>/artandcraft/detail.php?postid=<?php echo $art['idspPostings']; ?>"><img src="<?php if(isset($artpic['data']) && isset($artpic['data']['spPostingPic'])) { echo $artpic['data']['spPostingPic']; } else { echo $BaseUrl."/assets/images/art-craft.svg"; }?>" alt=""></a>
                </div>
                <div class="detail">
                  <a style="text-decoration:none !important;color:inherit !important;" href="<?php echo $BaseUrl?>/artandcraft/detail.php?postid=<?php echo $art['idspPostings']; ?>"><div class="name"><?php if(isset($art['spPostingTitle'])) { if(strlen($art['spPostingTitle']) < 15) { echo $art['spPostingTitle']; } else { echo substr($art['spPostingTitle'], 0, 15) . '...'; } } else { echo "No-Title"; } ?></div></a>
                  <div class="sub-text">
                    <?php if(isset($art['spPostingNotes'])) { echo $art['spPostingNotes']; } ?>
                  </div>
                </div>
              </div>
              <?php
                  }
                }
              ?>
              <div class="view-all">
                <a href="<?php echo $BaseUrl?>/artandcraft/search.php?txtSearchCategory=13&txtArtSearch=&btnArtSearch=Search">VIEW ALL</a>
              </div>
            </div>
          </div>
        </div>
