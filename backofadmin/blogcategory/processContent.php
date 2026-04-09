<?php

require_once '../library/config.php';
require_once '../library/functions.php';
include '../../univ/baseurl.php';
include_once '../../mlayer/_realstatepic.class.php';
include_once '../../mlayer/_tableadapter.class.php';

checkUser();
$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {

	case 'add':
		add($dbConn);
		break;
	case 'ajax':
		ajax($dbConn);
		break;
	case 'modify':
		modify($dbConn);
		break;
	case 'delete':
		deletee($dbConn);
		break;
	default:
		redirect('index.php');
}

//Add 
function add($dbConn)
{
	$filename = '';
	include '../../univ/baseurl.php';




	if (isset($_POST['name'])) {
		$name = $_POST['name'];
	}

	$sql2 = insertQ("insert into blog_category(name ) values(?)", "s", [$name]);
	$_SESSION['count'] = 0;
	$_SESSION['data'] = "success";
	$_SESSION['errorMessage'] = "Added Successfully.";
	redirect("index.php?view=list");

}
//modify 
function modify($dbConn)
{

	include '../../univ/baseurl.php';
	$hidId = mysqli_real_escape_string($dbConn, $_POST['hidId']);
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
	}
	$sql = insertQ("UPDATE `blog_category` SET name=? WHERE id=?", "si", [$name, $hidId]);
	$_SESSION['count'] = 0;
	$_SESSION['data'] = "success";
	$_SESSION['errorMessage'] = "Updated Successfully.";
	redirect("index.php?view=list");

}
function ajax()
{
	$limit = 6;
	$i = 1;
	$page = isset($_POST['page']) ? $_POST['page'] : 1; // Current page

	$start = ($page - 1) * $limit;

	$res_data = selectQ("SELECT * from blog_category LIMIT $start, $limit", "i", "");
	if ($res_data) {
		echo '<table id="example1" class="table table-bordered table-striped tbl-respon2">';
		echo '<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
			   
				<th style="width: 110px;">Action</th>
			</tr>
		</thead>
		';
		echo "<tbody>";
		foreach ($res_data as $row) {
			echo '<tr>
			<td class="">' . $i . '</td>
			
			<td>
			' . $row["name"] . '
			</td>
			<td class="menu-action text-center">
				<a href="javascript:modifyContnt(' . $row["id"] . ')" data-original-title="Edit"
					data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i
						style="padding:4px;" class="fa fa-pencil"></i> </a>
				<a href="processContent.php?action=delete&&conId=' . $row["id"] . '"
					data-original-title="Delete" data-toggle="tooltip" data-placement="top"
					class="btn menu-icon vd_bg-red"><i style="padding:4px;" class="fa fa-trash"></i></a>
	
			</td>
		</tr>';
			$i++;
		}
		echo "</tbody></table>";
	} else {
		echo "No results found";
	}

	$counts = selectQ("SELECT COUNT(*) as count from blog_category", "i", "");
	

	$total_pages = ceil($counts['0']['count'] / $limit);


	echo "<ul style='float:right; margin-right: 30px;' class='pagination '>"; // Added Bootstrap class for center alignment
	for ($i = 1; $i <= $total_pages; $i++) {
		echo "<li  class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>"; // Added Bootstrap classes for pagination
	}
	echo "</ul>";

}
function deletee($dbConn)
{

	if (isset($_GET['conId']) && ($_GET['conId']) > 0) {
		$conId = $_GET['conId'];
	} else {
		redirect("index.php");
		exit();
	}

	$sql = insertQ("DELETE FROM blog_category  WHERE id=?", "i", [$conId]);
	$_SESSION['count'] = 0;
	$_SESSION['data'] = "success";
	$_SESSION['errorMessage'] = "Delted Successfully";
	redirect("index.php?view=list");

}


?>

<script>
	$(document).ready(function () {
		$('#example1').DataTable({
			"paging": false // Hide pagination controls
		});
	});
</script>