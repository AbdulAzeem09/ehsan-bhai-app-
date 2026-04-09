<style>

#myList li{ display:none;
}
#loadMore {
    color:green;
    cursor:pointer;
    margin-left:45px;

}
#loadMore:hover {
    color:black;
}
#showLess {
    color:red;
    cursor:pointer;
    margin-left:45px;
}
#showLess:hover {
    color:black;
}
</style>

<div class="left_Entertain">

    <div class="head_left_enter text-center">
        <h2><img src="<?php echo $BaseUrl; ?>/assets/images/entertain/filter.png" alt="" /> Filter</h2>
    </div>
    <div class="body_left_enter" id="body_left_vdo">
        <form action="<?php echo $BaseUrl . '/trainings/category.php' ?>" method="GET">
            <h3>Category</h3>
            <ul id="myList">
                <?php
                $m = new _subcategory;
                $catid = 8;
                $result = $m->read($catid);
                if ($result) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                        //echo $_GET['catName'];
                        //echo $rows['subCategoryTitle'];
                        //print_r($rows);
                        //die("-====");
                ?>
                        <!-- <li class="<?php echo (isset($_GET['catName']) && strtolower($_GET['catName']) == strtolower($rows['subCategoryTitle'])) ? 'active' : ''; ?>" ><label><a href="<?php echo $BaseUrl . '/trainings/category.php?catName=' . $rows['subCategoryTitle'] . '&id=' . $rows['idsubCategory']; ?>"><i class="fa fa-square-o"></i> <?php echo $rows['subCategoryTitle']; ?></a></label></li>-->

                        <?php

                        $selected = '';
                        foreach ($_GET['subCategory_id'] as $valueiid) {
                            if ($valueiid == $rows["subCategoryTitle"]) {

                                $selected = 'checked="checked"';
                            }
                        }
                        ?>

                        <li class="<?php echo (isset($_GET['catName']) && strtolower($_GET['catName']) == strtolower($rows['subCategoryTitle'])) ? 'active' : ''; ?>"><label> <input type="checkbox" name="subCategory_id[]" <?php echo $selected; ?> value="<?php echo $rows['subCategoryTitle']; ?>"> <?php echo $rows['subCategoryTitle']; ?></label></li>




                <?php
                    }
                }
                ?>

            </ul>
            <div id="loadMore">Load more</div>
           <div id="showLess">Show less</div>
            <script>
        $(document).ready(function () {
    size_li = $("#myList li").size();
    x=15;
    $('#myList li:lt('+x+')').show();
    $('#loadMore').click(function () {
        x= (x+5 <= size_li) ? x+5 : size_li;
        $('#myList li:lt('+x+')').show();
        if(size_li == x){
          $('#loadMore').hide();
        } else {
          $('#loadMore').show();
        }

    });
    $('#showLess').click(function () {
        x=(x-5<0) ? 3 : x-5;
        $('#myList li').not(':lt('+x+')').hide();
        if(size_li == x){
          $('#loadMore').hide();
        } else {
          $('#loadMore').show();
        }

    });
});
    </script>






            <hr class="vdoBar">
            <a href="<?php echo $BaseUrl ?>/trainings/category.php" type="button" style="margin-top: -10px;margin-left: 60px;" class="btn btn-danger btn-lg  btn-border-radius">Reset</a>
            <input type="submit" style="margin-top: -10px;margin-left: 20px;" class="btn btn-primary btn-lg  btn-border-radius" name="filter_btn" value="Filter">

        </form>
    </div>
</div>