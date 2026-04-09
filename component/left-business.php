<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

?>

<style>
    .clearFilter {
        float: right;
        padding: 0px 10px 0px 0px;
    }
</style>
<div class="left_Entertain">
    <div class="head_left_enter text-center">
        <h2><img src="<?php echo $BaseUrl; ?>/assets/images/entertain/filter.png" alt="" />Category Filter</h2>
    </div>
    <div class="body_left_ser" style="height:80vh;">
        <ul style="height:65vh;overflow:auto;">
            <label><input type="checkbox" name="select-all" id="select-all" /> Select All</label for="select-all">

            <form id="category-filter-form" action="<?php echo $BaseUrl . '/business-directory/business.php?business[]=';?>">
                <?php
                $m = new _masterdetails;
                $masterid = 8;
                $count = 0;
                $result = $m->read($masterid);

                if ($result != false) {
                    while ($rows = mysqli_fetch_assoc($result)) {

                ?>
                    <li class="cat-li"><label>

                            <?php
                            $selected = '';
                            if(!empty($_GET['business'])){
                                foreach ($_GET['business'] as $valueiid) {
                                    if ($valueiid == $rows["idmasterDetails"]) {
                                        $selected = 'checked="checked"';
                                    }
                                }
                            }
                            ?>
                            <input class="cat_chk" name="business[]" <?php echo $selected; ?> type="checkbox" value="<?php echo $rows["idmasterDetails"] ?>">
                            <span style="font-weight: 400;font-size: 14px;font-family: 'Proxima Nova'; color: #333;">
                                <?php echo ucwords(strtolower($rows["masterDetails"])); ?>
                            </span>

                        </label></li>
                <?php
                    }
                }
                ?>
            </form>
        </ul>
        
        <div class="text-center">
            <input class='btn btn-success common_btn' onclick="$('#category-filter-form').submit();" style='margin-top:5px' type='button' name='submit' value='Filter'>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".cat-li1").click(function() {
        var url = '<?php echo $BaseUrl ?>/business-directory/business.php?'
        var arg = '';
        $(".cat-li").find(".cat_chk").each(function(key, value) {
            if ($(this).is(":checked")) {
                if (key == 0)
                    arg = arg + "business[]=" + $(this).val();
                else
                    arg = arg + "&business[]=" + $(this).val();
                // console.log($(this).val());
            }

        })
        url = url + arg;
    });

    $('#viewbtn').click(function() {
        if ($(".cat-li").hasClass("hide")) {
            $(this).addClass("hide");
            $(".cat-li").removeClass("hide");
            $("#viewbtnn").css("margin-top", "-20px");
        }
    });
</script>
<script>
    $('#select-all').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });
</script>