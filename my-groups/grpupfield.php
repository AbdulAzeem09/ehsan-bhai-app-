<?php
$g = new _spgroup;
if (isset($_POST["gid"])) {
    $result = $g->groupdetails($_POST["gid"]);
    if ($result != false) {
        $row = mysqli_fetch_assoc($result);
        $gname = $row["spGroupName"];
        $gtag = $row["spGroupTag"];
        $gdes = $row["spGroupAbout"];
        $gtype = $row["spgroupflag"];
        $gimage = $row["spgroupimage"];
        $gcategory = $row["spgroupCategory"];
        $glocation = $row["spgroupLocation"];
    }
}

if (isset($_POST["gid"])) {
    echo "<input type='hidden' id='idspGroup' name='idspGroup' value='" . $_POST["gid"] . "'></input>";
}
?>

<div class="form-group">
    <label for="group-name" class="control-label">Create New Group</label>
    <input type="text" class="form-control" id="spGroupName" name="spGroupName" value="<?php if (isset($gname)) {
    echo $gname;
} ?>">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="sel1">Group Category</label>
            <select class="form-control" id="grpcategory" name="spgroupCategory" value="<?php echo $gcategory; ?>">
                <option value="Group1">Group1</option>
                <option value="Group2">Group2</option>
                <option value="Group3">Group3</option>
                <option value="Group4">Group4</option>
                <option value="Group5">Group5</option>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Location/City</label>
            <input type="text" class="form-control" id="locationcity" name="spgroupLocation" placeholder="Enter your location..." value="<?php if (isset($glocation)) {
    echo $glocation;
} ?>">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="spGroupTagline">Short Description (Max 50 words)</label>
    <!--<input type="text" class="form-control" id="spGroupTagline" name="spGroupTag">-->
    <textarea rows="3" class="form-control" id="spGroupTagline" name="spGroupTag" placeholder="Enter text here..." value="<?php echo $gtag; ?>"><?php if (isset($gtag)) {
    echo $gtag;
} ?></textarea>
</div>
<div class="form-group">
    <label for="spGroupAbout">Long Description  (Max 500 words)</label>
    <textarea class="form-control" rows="5" id="spGroupAbout" name="spGroupAbout" placeholder="Enter text here..." value="<?php echo $gdes; ?>"><?php if (isset($gdes)) {
    echo $gdes;
} ?></textarea>
</div>


<!--Group Banner image Testing -->
<div class="form-group">
    <label for="grpbnrimg">Group Banner image</label>
    <input type="file" class="grpbnrimg" name="spgroupimage[]" multiple="multiple"/>

    <img src="<?php echo ($gimage); ?>" alt="Banner Image" class="img-rounded grpbannerpic" style="width: 64px; height: 64px;margin-top:5px;">
</div>	
<!--Testing Complete-->


<div class="col-md-12">
    <div class="row">
        <div class="col-md-9">
            <!--Testing-->
            <div class="btn-group">
                <button type="button" class="btn btn-success">Select Group Type</button>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="gtype">Private</span><span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span></button>

                <ul class="dropdown-menu">
                    <li><a href="#" class="groupflag" data-groupflag="1">Private</a></li>
                    <li><a href="#" class="groupflag" data-groupflag="0">Public</a></li>
                </ul>
            </div>
            <!--complete-->

        </div>
        <input type="hidden" class="spgroupflag" name="spgroupflag" value="1"/>

        <div class="col-md-3"><button id="<?php echo (isset($_POST["gid"]) ? "submitRename" : "spgroupSubmit"); ?>" type="submit" class="btn btn-success pull-right"><?php echo (isset($_POST["gid"]) ? "Save" : "Add"); ?></button></div>


    </div>
</div>