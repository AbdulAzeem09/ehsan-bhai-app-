<?php
if (!defined('WEB_ROOT')) {
exit;
}
?>
<!-- Content Header (Page header) -->


<section class="row content-header top_heading">
<div class="col-md-10">
<h1>B Listings</h1>
</div>
<div id="demo" class="col-md-2 float-right">
</div>
</section>
<!-- Main content -->


<section class="content">
<style>

select[data-multi-select-plugin] {
display: none !important;
}

.multi-select-component {
position: relative;
display: flex;
flex-direction: row;
flex-wrap: wrap;
height: auto;
width: 90%;
padding: 3px 8px;
font-size: 14px;
line-height: 1.42857143;
padding-bottom: 0px;
color: #555;
background-color: #fff;
border: 1px solid #ccc;
border-radius: 4px;
-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
-webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
-o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}

.autocomplete-list {
border-radius: 4px 0px 0px 4px;
}

.multi-select-component:focus-within {
box-shadow: inset 0px 0px 0px 2px #78ABFE;
}

.multi-select-component .btn-group {
display: none !important;
}

.multiselect-native-select .multiselect-container {
width: 100%;
}

.selected-wrapper {
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
display: inline-block;
border: 1px solid #d9d9d9;
background-color: #ededed;
white-space: nowrap;
margin: 1px 5px 5px 0;
height: 22px;
vertical-align: top;
cursor: default;
}

.selected-wrapper .selected-label {
max-width: 514px;
display: inline-block;
overflow: hidden;
text-overflow: ellipsis;
padding-left: 4px;
vertical-align: top;
}

.selected-wrapper .selected-close {
display: inline-block;
text-decoration: none;
font-size: 14px;
line-height: 1.49em;
margin-left: 5px;
padding-bottom: 10px;
height: 100%;
vertical-align: top;
padding-right: 4px;
opacity: 0.2;
color: #000;
text-shadow: 0 1px 0 #fff;
font-weight: 700;
}

.search-container {
display: flex;
flex-direction: row;
}

.search-container .selected-input {
background: none;
border: 0;
height: 20px;
width: 60px;
padding: 0;
margin-bottom: 6px;
-webkit-box-shadow: none;
box-shadow: none;
}

.search-container .selected-input:focus {
outline: none;
}

.dropdown-icon.active {
transform: rotateX(180deg)
}

.search-container .dropdown-icon {
display: inline-block;
padding: 10px 5px;
position: absolute;
top: 5px;
right: 5px;
width: 10px;
height: 10px;
border: 0 !important;
/* needed */
-webkit-appearance: none;
-moz-appearance: none;
/* SVG background image */
background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2212%22%20height%3D%2212%22%20viewBox%3D%220%200%2012%2012%22%3E%3Ctitle%3Edown-arrow%3C%2Ftitle%3E%3Cg%20fill%3D%22%23818181%22%3E%3Cpath%20d%3D%22M10.293%2C3.293%2C6%2C7.586%2C1.707%2C3.293A1%2C1%2C0%2C0%2C0%2C.293%2C4.707l5%2C5a1%2C1%2C0%2C0%2C0%2C1.414%2C0l5-5a1%2C1%2C0%2C1%2C0-1.414-1.414Z%22%20fill%3D%22%23818181%22%3E%3C%2Fpath%3E%3C%2Fg%3E%3C%2Fsvg%3E");
background-position: center;
background-size: 10px;
background-repeat: no-repeat;
}

.search-container ul {
position: absolute;
list-style: none;
padding: 0;
z-index: 3;
margin-top: 29px;
width: 100%;
right: 0px;
background: #fff;
border: 1px solid #ccc;
border-top: none;
border-bottom: none;
-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
}

.search-container ul :focus {
outline: none;
}

.search-container ul li {
display: block;
text-align: left;
padding: 8px 29px 2px 12px;
border-bottom: 1px solid #ccc;
font-size: 14px;
min-height: 31px;
}

.search-container ul li:first-child {
border-top: 1px solid #ccc;
border-radius: 4px 0px 0 0;
}

.search-container ul li:last-child {
border-radius: 4px 0px 0 0;
}


.search-container ul li:hover.not-cursor {
cursor: default;
}

.search-container ul li:hover {
color: #333;
background-color: rgb(251, 242, 152);
;
border-color: #adadad;
cursor: pointer;
}

/* Adding scrool to select options */
.autocomplete-list {
max-height: 300px;
overflow-y: auto;
}
</style>
<!-- start any work here. -->
<div class="box box-success">
<div class="box-body">
<div class="row">

<div class="col-md-12" style="margin-top:10px;">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<!-- partial:index.partial.html -->
<table id="example" class="display" cellspacing="0" width="100%" >
<thead>
<tr>
<th class="text-center">Id</th>
<th class="text-center">Id</th>
<th class="text-center">Price</th>
<th class="text-center">Duration (Days)</th>
<th class="text-center">Status</th>
<th class="text-center">Status</th>
<th class="text-center">Action</th>
</tr>
</thead>



<tbody>
<?php
$sqlmanagecurrency =  "SELECT * FROM `spbuisnesspostings`";
$managecurrency  = dbQuery($dbConn, $sqlmanagecurrency);
$i=1;
while($rowmanagecurrency = mysqli_fetch_array($managecurrency)){
?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td class="text-center"><?php echo $i; ?></td>
<td class="text-center">USD&nbsp;<?php echo $rowmanagecurrency['price']; ?></td>
<td class="text-center"><?php echo $rowmanagecurrency['duration']; ?></td>

<td class="text-center">
<?php if($rowmanagecurrency['status']==1){
if($rowmanagecurrency['exp_date']<date('Y-m-d')){
echo "Inactive";
}
else{
    echo "Active";
}
}
else if($rowmanagecurrency['status']==2){

echo "Inactive";}
else if($rowmanagecurrency['status']==3){

echo "Cancelled";}
else{echo "Draft";}


?>
</td>
<td class="text-center">
<?php if($rowmanagecurrency['status']==1){
   echo "<a href='deletepic1.php?actId=" . $rowmanagecurrency['idspbusiness'] . "' class='btn menu-icon vd_bg-green'>Active</a>";
    //echo "Active";
}
if($rowmanagecurrency['status']==2){
    echo "<a href='deletepic1.php?inactId=" . $rowmanagecurrency['idspbusiness'] . "' class='btn menu-icon vd_bg-red'>Inactive</a>";
}


?>
</td>
<td class="text-center">

<a href="<?php echo WEB_ROOT.'/backofadmin/content/edit_business1.php?postid='.$rowmanagecurrency['idspbusiness']; ?>"><i class="fa fa-edit"></i></a>
<!--<a href="<?php echo WEB_ROOT.'business_for_sale/deletepic.php?postid='.$rowmanagecurrency['idspbusiness']; ?>" data-postid="<?php echo $rowmanagecurrency['idspbusiness']; ?>" class="delpost" ><i class="fa fa-trash"></i></a>-->

<a href="javascript:deleteB_Listings(<?php echo $rowmanagecurrency['idspbusiness']; ?>)" data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>														
</td>  
</tr>
<?php $i++; } ?>

</tbody>

</table>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>


</div>


</div>
</div>
</div>
</section>