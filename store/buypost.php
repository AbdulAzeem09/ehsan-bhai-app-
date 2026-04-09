  
  <div class="col-md-4 no-padding">
      <a href="<?php echo $BaseUrl.'/'.$folder.'/category.php?catName='.$StoreTitle;?>">
          <div class="s_m_box text-center bg_store_green no_mrgn_left">
              <h2>Best seller category</h2>
              <h4><?php echo $storeofmonth;?></h4>
          </div>
      </a>
  </div>
  <div class="col-md-4 no-padding">
    <?php
    //echo $p->ta->sql;
    if($res != false){
      $res_r = $res;
      $heighestRating = 0;
      $heightId = 0;
      while ($num = mysqli_fetch_assoc($res_r)) {

        $r = new _sppostrating;
        $result_r = $r->review($num["idspPostings"]);
        //echo $r->ta->sql."<br>";
        if ($result_r != false) {
            $total = 0;
            $count = $result_r->num_rows;
            while ($rows_r = mysqli_fetch_assoc($result_r)) {
                $total += $rows_r["spPostRating"];
            }
            $ratings = $total / $count;
            //echo $ratings."-".$num['idspPostings']."<br>";

            if($ratings > $heighestRating){
              $heighestRating = $ratings;
              $heightId = $num["idspPostings"];
            }
        }
      }
    }
    //echo $heightId;

    $result_rating = $p->read($heightId);
    if($result_rating != false){
      //echo $p->ta->sql;
      $name_p = mysqli_fetch_assoc($result_rating);
      $FeaturedSeller = $name_p['spProfileName'];

    }else{
      $FeaturedSeller = "No Top Created Person";
    }
    ?>
      <a href="<?php echo $BaseUrl.'/friends/?profileid='.$name_p['idspProfiles'];?>">
          <div class="s_m_box text-center bg_store_orange">
            
              <h2>Featured Seller</h2>
              <h4>
                <?php
                echo $FeaturedSeller;
                ?>
              </h4>
          </div>
      </a>
  </div>
 
  <div class="col-md-4 no-padding">
      <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>">
          <div class="s_m_box text-center bg_store_blue no_mrgn_right">
              <h2>Buy Post</h2>
              <h4><?php echo $res->num_rows ?></h4>
          </div>
      </a>
  </div>