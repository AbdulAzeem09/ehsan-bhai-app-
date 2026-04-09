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
	$upload_location = $_SERVER['DOCUMENT_ROOT'] . '/uploadimage/';

	if (isset($_FILES["choosefile"]["name"])) {
		$filename = $_FILES["choosefile"]["name"];
		$tempname = $_FILES["choosefile"]["tmp_name"];
	}

	$s3Class = new s3Class(3);
	$pathInfo = pathinfo($filename);
	$extension = $pathInfo['extension'];
	$bucket = $s3Class->addS3Image($tempname, $extension);
	$urll = $bucket['url'];

	if (isset($_POST['title'])) {
		$name = $_POST['title'];
	}

	if (isset($_POST['txtDesc'])) {
		$txtDesc = $_POST['txtDesc'];
	}
	if (isset($_POST['blogcategory'])) {
		$blogcategory = $_POST['blogcategory'];
	}

	$sql2 = insertQ("insert into blogs(title , image , description, category ) values(?, ?, ?, ?)", "ssss", [$name, $urll, $txtDesc, $blogcategory]);

	$_SESSION['count'] = 0;
	$_SESSION['data'] = "success";
	$_SESSION['errorMessage'] = "Added Successfully.";
	if ($sql2 > 0) {
		echo "success";
	} else {
		echo "fail";
	}


}

function ajax()
{
	$limit = 6;
	$i = 1;
	$page = isset($_POST['page']) ? $_POST['page'] : 1; // Current page

	$start = ($page - 1) * $limit;

	$res_data = selectQ("SELECT * from blogs LIMIT $start, $limit", "i", "");
	if ($res_data) {
		echo '<table id="example1" class="table table-bordered table-striped tbl-respon2">';
		echo '<thead><tr><th>Id</th><th style="width: 200px;">Title</th><th style="width: 200px;">Category</th><th>Image</th>
          <th  style="width: 400px;">Description</th><th style="width: 110px;">Action</th></tr></thead>';
		echo "<tbody>";
		foreach ($res_data as $row) {

			$category = selectQ("SELECT * from blog_category where id=?", "i", [$row['category']], "one");
			echo '<tr>
        <td class="">' . $i . '</td>
        <td>
        ' . $row["title"] . '
        </td>
        <td>
        ' . $category["name"] . '
        </td>

		<td>
		<img width="100" height="100" src="'.$row["image"].'">
	</td>

        <td>

           ' . substr_replace($row["description"], "...", 500) . '
        </td>
		
       

        <input type="hidden" name="hidId" id="id" value="' . $row["id"] . '">
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

	$counts = selectQ("SELECT COUNT(*) as count from blogs", "i", "");


	$total_pages = ceil($counts['0']['count'] / $limit);


	echo "<ul style='float:right; margin-right: 30px;' class='pagination '>"; // Added Bootstrap class for center alignment
	for ($i = 1; $i <= $total_pages; $i++) {
		echo "<li  class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>"; // Added Bootstrap classes for pagination
	}
	echo "</ul>";

}
//modify 
function modify($dbConn)
{



	$filename = '';
	include '../../univ/baseurl.php';
	$upload_location = $_SERVER['DOCUMENT_ROOT'] . '/uploadimage/';


	$filename = $_FILES["choosefile"]["name"];
	$tempname = $_FILES["choosefile"]["tmp_name"];


	if (isset($_FILES["choosefile"]["tmp_name"]) && $_FILES["choosefile"]["tmp_name"] != "") {
		$s3Class = new s3Class(3);
		$tempath = $path;
		$pathInfo = pathinfo($filename);
		$extension = $pathInfo['extension'];
		$bucket = $s3Class->addS3Image($tempname, $extension);
		$urll = $bucket['url'];
	}
	$hidId = mysqli_real_escape_string($dbConn, $_POST['hidId']);

	if (isset($_POST['title'])) {
		$name = $_POST['title'];
	}

	if (isset($_POST['txtDesc'])) {
		$txtDesc = $_POST['txtDesc'];
	}
	if (isset($_POST['blogcategory'])) {
		$blogcategory = $_POST['blogcategory'];
	}

	if (isset($_FILES["choosefile"]["tmp_name"]) && $_FILES["choosefile"]["tmp_name"] != "") {
		$sql = insertQ("UPDATE `blogs` SET title=?,  image=?, description=? , category=? WHERE id=?", "ssssi", [$name, $urll, $txtDesc, $blogcategory, $hidId]);
	} else {
		$sql = insertQ("UPDATE `blogs` SET title=?, description=? , category=?  WHERE id=?", "sssi", [$name, $txtDesc, $blogcategory, $hidId]);
	}

	$_SESSION['count'] = 0;
	$_SESSION['data'] = "success";
	$_SESSION['errorMessage'] = "Updated Successfully.";
	echo "success";

}

function deletee($dbConn)
{

	if (isset($_GET['conId']) && ($_GET['conId']) > 0) {
		$conId = $_GET['conId'];
	} else {
		redirect("index.php");
		exit();
	}

	$sql = insertQ("DELETE FROM blogs  WHERE id=?", "i", [$conId]);
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