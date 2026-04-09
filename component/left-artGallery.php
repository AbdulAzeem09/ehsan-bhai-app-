 <?php
 if($_GET['for']=='art'){ ?>
	     <div class="leftArt">
        <h3>Categories</h3>

        <?php
            $m = new _subcategory;
            $p = new _postingviewartcraft;
            $catid = 13;
            $result = $m->art_subcategoryalllist($catid);
            if($result){
                while($rows = mysqli_fetch_assoc($result)){
				//echo $rows["idspArtgallery"];
                    $count = 0;
                    $res = $p->sameCategoryPiccateart($rows["idspArtgallery"], 13);
                    //echo $p->ta->sql;
                    if($res != false){
                        $count = $res->num_rows;
                    }else{
                        $count = 0;
                    } 
                    ?>
                    <a href="<?php echo $BaseUrl.'/artandcraft/shop-top-category.php?catId='.$rows['idspArtgallery'];?>&for=<?=$_GET['for'];?>&page=1" class="<?php echo ($_GET['catId'] == $rows['idspArtgallery'])?'active':'';?>"><i class=""></i> <?php echo $rows["spArtgalleryTitle"];?> <span>(<?php echo $count;?>)</span></a>
                    <?php
                    //echo "<option value='".$rows["idsubCategory"]."'>".$rows["subCategoryTitle"]."</option>";
                }
            }
        ?>

    </div>
 <?php } 
  if($_GET['for']=='craft'){  ?>

    <div class="leftArt">
        <h3>Categories</h3>

        <?php
            $m = new _subcategory;
            $p = new _postingviewartcraft;
            $catid = 13;
            $result = $m->craft_categoryalllist($catid);
            if($result){
                while($rows = mysqli_fetch_assoc($result)){
                    $count = 0;
                    $res = $p->sameCategoryPiccatecraft($rows["idspCraftgallery"], 13);
                    //echo $p->ta->sql;
                    if($res != false){
                        $count = $res->num_rows;
                    }else{
                        $count = 0;
                    } 
                    ?>
                    <a style="text-transform:uppercase" href="<?php echo $BaseUrl.'/artandcraft/shop-top-category.php?catId='.$rows['idspCraftgallery'];?>&for=<?=$_GET['for'];?>&page=1" class="<?php echo ($_GET['catId'] == $rows['idspCraftgallery'])?'active':'';?>"><i class=""></i> <?php echo $rows["spCraftgalleryTitle"];?> <span>(<?php echo $count;?>)</span></a>
                    <?php
                    //echo "<option value='".$rows["idsubCategory"]."'>".$rows["subCategoryTitle"]."</option>";
                }
            }
        ?>

    </div>

<?php	 
 }
 ?>   

