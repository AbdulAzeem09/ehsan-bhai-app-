<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
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
<h1>RFQ<small>[List]</small></h1>
</section>
<div class="box box-success">
<div class="box-body">
<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>Id</th>
<!-- <th >Postings ID</th> -->
<th>Product Name</th>
<th >Total Quotation</th>
<th >Product Details</th>
<th >Quotation Delevery</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
$sql =  "SELECT * FROM `spquotationrfq`"; 
$result2  = dbQuery($dbConn, $sql);
//$row2 = dbFetchAssoc($result2);
//print_r($aa);die('===');
//    $i=1;
while ($row = dbFetchAssoc($result2)) {
?>
<tr>
<td><?php echo $i++; ?></td>
<!-- <td><?php echo $row['spPostings_idspPostings'];   ?></td> -->
<?php
$sqlto =  "SELECT * FROM `spproduct` WHERE idspPostings =". $row['spPostings_idspPostings']; 
$resultto  = dbQuery($dbConn, $sqlto);
$rowtto = dbFetchAssoc($resultto);
?>
<td><?php echo $rowtto['spPostingTitle'];?></td>
<td title="<?php echo $row['spQuotationTotalQty']; ?>"> <?php  $new=$row['spQuotationTotalQty']; echo substr($new, 0, 30);?></td>
<td title="<?php echo $row['spQuotatioProductDetails']; ?>"><?php  $new=$row['spQuotatioProductDetails']; echo substr($new, 0, 30);   ?></td>
<td> <?php echo $row['spQuotationDelevery'];   ?></td>
</tr>
<?php
// $i++;
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

