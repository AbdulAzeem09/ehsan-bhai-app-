<?php
//die('====================');
if (!defined('WEB_ROOT')) {
exit;
}
?>

<style>
.content {
min-height: 150px!important;
}
.select2 {
width: 400px!important;
}

</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Content Header (Page header) -->
<section class="content-header">
<h1> Freelancer Projects<small>[List]</small></h1>
</section>
<div class="box box-success">
<div class="box-body">
<!-- <div class="col-md-2"> -->
<div class="form-group"> 

<label>Projects</label>
<select name="cars" class="form-control" id="cars" onchange="changeLocation(this)" style="width: 15%;">
<option value="<?php  $_SERVER["DOCUMENT_ROOT"] ;?>/backofadmin/freelancer/index.php">Select Option</option>
    <option value="<?php  $_SERVER["DOCUMENT_ROOT"];?>/backofadmin/freelancer/index.php?Projects=Active" <?php if(isset($_GET['Projects']) && $_GET['Projects'] === 'Active') {
    echo 'selected';
} ?> >Active Projects</option>
    <option value="<?php  $_SERVER["DOCUMENT_ROOT"]; ?>/backofadmin/freelancer/index.php?Projects=Expire" <?php if(isset($_GET['Projects']) && $_GET['Projects'] === 'Expire') {
    echo 'selected';
} ?> >Expire Projects</option>
    <option value="<?php  $_SERVER["DOCUMENT_ROOT"] ;?>/backofadmin/freelancer/index.php?Projects=All" <?php if(isset($_GET['Projects']) && $_GET['Projects'] === 'All') {
    echo 'selected';
} ?> >All Projects</option>
</select>


</div>
<!-- </div> -->
<div class="table-responsive tbl-respon">

<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th >Title</th>
<th >Expirey</th>
<th >Price</th>
<th >Skills</th>
<th >Action</th>
</tr>
</thead>
<tbody>
<?php
if(isset($_GET['Projects']) && $_GET['Projects'] == 'Active') {
    $sql =  "SELECT * FROM spfreelancer Where spPostingExpDt>= CURDATE() ORDER BY `idspPostings` desc";
}else if(isset($_GET['Projects']) && $_GET['Projects'] == 'Expire') {
    $sql =  "SELECT * FROM spfreelancer Where spPostingExpDt<=CURDATE()  ORDER BY `idspPostings` desc";  
}else if(isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $sql =  "SELECT * FROM spfreelancer WHERE spProfiles_idspProfiles = $pid ORDER BY `idspPostings` desc";  
}else {
    $sql =  "SELECT * FROM spfreelancer ORDER BY `idspPostings` desc";
}
$result2  = dbQuery($dbConn, $sql);
while ($row = dbFetchAssoc($result2)) {

?>
<tr>
<td style="word-break: break-all;"><?php echo $row['spPostingTitle'];   ?></td>
<td><?php echo $row['spPostingExpDt'];   ?></td>
<td><?php $new1= $row['spPostingPrice']; $substr=substr($new1, 0, 30); echo $row['Default_Currency'] .' '. $substr ; ?></td>

<td><?php $new=$row['spPostingSkill']; echo substr($new, 0, 30);   ?></td>
<td><a href="<?php  $_SERVER["DOCUMENT_ROOT"] ?>/freelancer/project-detail.php?project=<?php echo $row['idspPostings'];?>" class="btn menu-icon vd_bg-green"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
</tr>
<?php
}

?>
</tbody>
</table>
</div>
</div>
<!--- End Table ---------------->
</div>
</section>
<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );
} );
</script>

<script>
function changeLocation(selectElement) {
    var selectedOption = selectElement.value;
    location.href = selectedOption;
}
</script>