<div class="row">
    <div class="col-md-12">
        <form class="form-inline m_btm_20 inner_Search_bus" method="post" action="search.php">
            <div class="form-group " style="width: 100%;display: inline-flex;">
                <input type="text" name="txtSearchBox" value="<?php echo $_POST['txtSearchBox'] ?? ""; ?>" class="form-control" required="" placeholder="Search">
                &nbsp;
                <select class="form-control" name="txtForm">
                    <option value="1" <?php if(isset($_POST['txtForm']) && $_POST['txtForm'] == 1) { echo "selected";} ?>>Search By Business</option>
                    <option value="2" <?php if(isset($_POST['txtForm']) && $_POST['txtForm'] == 2) { echo "selected";} ?>>Search By Profile</option>
                </select>&nbsp;
                <input type="submit" name="btnSearch" class="btn common_btn btn_bus_dircty btn-border-radius" value="Search" style="margin-top: 0px; background-color:#e39b0f;width: 15%;">
            </div>
        </form>
    </div>
</div>