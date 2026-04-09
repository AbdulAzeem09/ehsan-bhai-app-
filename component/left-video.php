
<div class="left_Entertain">
    <div class="head_left_enter text-center">
        <h2><img src="<?php echo $BaseUrl;?>/assets/images/entertain/filter.png" alt="" /> Filter</h2>
    </div>
    <div class="body_left_enter" id="body_left_vdo">
	<!--
		<h3>Videos</h3>
		<ul>
            <li class="<?php echo (isset($_GET['catName']) && $_GET['catName'] == 'New_Music')?'active': '';?>" ><label><a href="<?php echo $BaseUrl.'/videos/category.php?catName=New_Music';?>"><i class="fa fa-square-o"></i> New Musics</a></label></li>      
            <li class="<?php echo (isset($_GET['catName']) && $_GET['catName'] == 'Popular')?'active': '';?>" ><label><a href="<?php echo $BaseUrl.'/videos/category.php?catName=Popular';?>"><i class="fa fa-square-o"></i> Popular</a></label></li>      
            <li class="<?php echo (isset($_GET['catName']) && $_GET['catName'] == 'Artist')?'active': '';?>" ><label><a href="<?php echo $BaseUrl.'/videos/category.php?catName=Artist';?>"><i class="fa fa-square-o"></i> Artist</a></label></li> 
            
            <li class="<?php echo (isset($_GET['catName']) && $_GET['catName'] == 'Trending')?'active': '';?>" ><label><a href="<?php echo $BaseUrl.'/videos/category.php?catName=Trending';?>"><i class="fa fa-square-o"></i> Trending</a></label></li>          
        </ul>
        <hr class="vdoBar">-->
        <h3>Category</h3>
        <ul>
            <?php
                /*$m = new _subcategory;
                $catid = 10;
                $result = $m->read($catid);
                if($result){
                    while($rows = mysqli_fetch_assoc($result)){ ?>
                        <li class="<?php echo (isset($_GET['catName']) && $_GET['catName'] == $rows["subCategoryTitle"])?'active': '';?>" ><label><a href="<?php echo $BaseUrl.'/videos/category.php?catName='.$rows["subCategoryTitle"]; ?>"><i class="fa fa-square-o"></i> <?php echo $rows["subCategoryTitle"];?></a></label></li>
                        
                        <?php
                    }
                }*/
				
				$m = new _music;
				$res = $m->get_music_category();
				if($res){
                    while($rows = mysqli_fetch_assoc($res)){ ?>
                        <li class="<?php echo (isset($_GET['catName']) && $_GET['catName'] == $rows["category_id"])?'active': '';?>" ><label><a href="<?php echo $BaseUrl.'/videos/category.php?catName='.$rows["category_id"]; ?>"><i class="fa fa-square-o"></i> <?php echo $rows["cat_name"];?></a></label></li>
                        
                        <?php
                    }
                }
            ?>

                                     
        </ul>
      
        <hr class="vdoBar">
    </div>
</div>