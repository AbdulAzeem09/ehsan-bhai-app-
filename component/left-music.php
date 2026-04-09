<div class="left_Entertain">
    <div class="head_left_enter text-center">
        <h2><img src="<?php echo $BaseUrl;?>/assets/images/entertain/filter.png" alt="" /> Filter</h2>
    </div>
    <div class="body_left_enter">
		<h3>Music</h3>
		<ul>
            <li class="<?php echo (isset($_GET['catName']) && $_GET['catName'] == 'New_Music')?'active': '';?>" ><label><a href="<?php echo $BaseUrl.'/music/category.php?catName=New_Music';?>"><i class="fa fa-square-o"></i> New Musics</a></label></li>      
            <li class="<?php echo (isset($_GET['catName']) && $_GET['catName'] == 'Popular')?'active': '';?>" ><label><a href="<?php echo $BaseUrl.'/music/category.php?catName=Popular';?>"><i class="fa fa-square-o"></i> Popular</a></label></li>      
            <li class="" ><label><a href="<?php echo $BaseUrl.'/music/all-artist.php';?>"><i class="fa fa-square-o"></i> Artist</a></label></li> 
            
            <li class="<?php echo (isset($_GET['catName']) && $_GET['catName'] == 'Trending')?'active': '';?>" ><label><a href="<?php echo $BaseUrl.'/music/category.php?catName=Trending';?>"><i class="fa fa-square-o"></i> Trending</a></label></li>          
        </ul>
        <hr>
        <h3>Category</h3>
        <ul>
            <?php
                $m = new _subcategory;
                $catid = 14;
                $result = $m->read($catid);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){ ?>
                        <li class="<?php echo (isset($_GET['catName']) && $_GET['catName'] == $row['subCategoryTitle'])?'active': '';?>" >
                            <label>
                                <a href="<?php echo $BaseUrl.'/music/category.php?catName='.$row['subCategoryTitle']; ?>">
                                    <i class="fa fa-square-o"></i> <?php echo ucwords(strtolower($row['subCategoryTitle']));?>
                                </a>
                            </label>
                        </li>
                        <?php
                    }
                }
            ?>
                                    
        </ul>
      
        <hr>
    </div>
</div>