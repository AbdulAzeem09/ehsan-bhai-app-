<?php

include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['uid'])) {
    $_SESSION['afterlogin'] = "job-board/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
     $uid= $_SESSION['uid'];
     $pid= $_SESSION['pid'];
if (isset($_GET['page'], $_SESSION['pid'])) {
    $page = intval($_GET['page']);
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
    $offset = ($page - 1) * $limit;
    $pid = $_SESSION['pid'];

    $cl = new _company_news;
    $dsf = $cl->readMyNews($pid, $search, $limit, $offset);
    $totalNews = $cl->countMyNews($pid, $search);

    $totalPages = ceil($totalNews / $limit);

    $newsHtml = '';


    if ($dsf && $dsf->num_rows > 0) {
        while ($row = $dsf->fetch_assoc()) {
            $newsHtml .= "<tr>
                            <td style='padding-left: 20px; text-align: left;'>" . htmlspecialchars($row['cmpanynewsTitle']) . "</td>
                            <td class='des'>" . htmlspecialchars($row['cmpanynewsDesc']) . "</td>
                            <td>" . htmlspecialchars($row['cmpanynewsdate']) . "</td>
                            <td class='action'>
                                <img src='./images/dot-2.svg' alt='' class='dot' onclick='threeDot()'>
                                <div class='more-links' id='three-dot' style='display: none;'>
                                    <div class='link' data-bs-toggle='modal' data-bs-target='#company-news'>
                                        <span class='img'><img src='./images/view.svg' alt=''></span>
                                        <span>View</span>
                                    </div>
                                    <div class='link' data-bs-toggle='modal' data-bs-target='#update-news'>
                                        <span class='img'><img src='./images/edit.svg' alt=''></span>
                                        <span>Edit News</span>
                                    </div>
                                    <div class='link'>
                                        <span class='img' style='padding-left: 4px;'>
                                            <img src='./images/delete.svg' alt=''></span>
                                        <span>Remove</span>
                                    </div>
                                </div>
                            </td>
                          </tr>";
        }
    } else {
        $newsHtml .= '<tr><td colspan="5" style="text-align: center;">No News available</td></tr>';
    }

    $paginationHtml = '';
    for ($i = 1; $i <= $totalPages; $i++) {
        $paginationHtml .= "<div class='box exect " . ($i == $page ? 'active' : '') . "' data-page='$i'>$i</div>";
    }

    echo json_encode(['html' => $newsHtml, 'pagination' => $paginationHtml]);
}
}