<?php
session_start();


include ('../univ/baseurl.php');
require_once '../backofadmin/library/config.php';
require_once '../backofadmin/library/functions.php';


// if (!isset($_SESSION['login_user']) || $_SESSION['login_user'] == '') {
//     redirect($BaseUrl . '/login.php');
// }

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$search = isset($_POST["search"]) ? $_POST["search"] : '';

$categoryid = isset($_GET['category']) ? (int) $_GET['category'] : 0;
//pagination 
$limit = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;


if ($search) {
    $res_data = selectQ("SELECT * FROM blogs WHERE " . (!empty($search) ? "title LIKE ?" : "1"), "s", (!empty($search) ? ['%' . $search . '%'] : []));

} elseif ($categoryid) {
    $res_data = selectQ("SELECT * from blogs where category=?", "i", [$categoryid], "");

} else {
    $res_data = selectQ("SELECT * from blogs LIMIT $start, $limit", "i", "");
}

$blogcategory = selectQ("SELECT * from blog_category", "i", "");

$counts = selectQ("SELECT COUNT(*) as count from blogs", "i", "");
$total_pages = ceil($counts['0']['count'] / $limit);
// Total number of pages



?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <title> Home</title>

    <meta name="author" content="Platol">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="">
    <!-- <link rel="stylesheet" href="<?php echo $BaseUrl ?>/assets/css/landingpage/all.css"> -->



    <link rel="shortcut icon" href="<?php echo $BaseUrl ?>/blogcss/assets/images/favicon.png" type="image/x-icon">

    <!-- CSS Plugins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Crete+Round&family=Work+Sans:wght@500;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/blogcss/assets/custom.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/blogcss/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/blogcss/assets/tabler-icons.min.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/blogcss/assets/style.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/assets/css/landingpage/style.css"> <!-- new header css -->
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
    button.left-pan {
        position: absolute;
        right: 17px;
        top: 13px;
        padding: 2px;
        border-left: 1px solid #d1d5db;
        border-right: none;
        border-top: none;
        border-bottom: none;
        background: white;
    }

    .pagination .page-item.active .page-link {
        box-shadow: none;
        color: #fff;
        background-color: #202548;
    }

    .pagination .page-link.active,
    .pagination .page-link:focus,
    .pagination .page-link:hover {
        box-shadow: none;
        color: #fff;
        background-color: #202548;
    }
</style>

<body>
    <header class="header ">
        <div class="container-fluid">
            <nav class="row">
                <div class="col-md-3 logo">
                    <a href="<?php echo $BaseUrl; ?>">
                        <img src="../image/logosharepage 1.png" alt="logo">
                        <span class="a">The SharePage</span>
                    </a>
                </div>
                <div class="col-md-9">
                    <div class="row justify-content-lg-end">
                        <div id="slide-bar">
                            <div id="toggle" class="d-flex"></div>
                        </div>
                        <ul id="sidebar" class=" menu">
                            <li><a href="#" class="active">Home</a></li>
                            <li><a href="<?php echo $BaseUrl; ?>/page/?page=investment_opportunities">Investment
                                    Opportunities</a></li>
                            <li><a href="<?php echo $BaseUrl; ?>/page/?page=referral__commissions">Earning
                                    Opportunities</a></li>
                            <li><a href="<?php echo $BaseUrl; ?>/page/howtos.php?page=howtos">How To</a></li>
                            <?php if (isset($_SESSION['uid'])) { ?>
                                <li><a href="<?php echo $BaseUrl . '/timeline'; ?>" class="timeline btn-border-radius">My
                                        Timeline</a></li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
                <!-- <div class="col-md-2 bar">
                    <div class="bar-1"></div>
                    <div class="bar-2"></div>
                    <div class="bar-3"></div>
                </div> -->
            </nav>
        </div>
    </header>
    <div class="header-height-fix"></div>
    <header class="header-nav ">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <a class="logo" href="/"> The SharePage Blog</a>
                </div>
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <button class="search-toggle d-inline-block d-lg-none ms-auto me-1 me-sm-3" data-toggle="search"
                            aria-label="Search Toggle">


                        </button>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navHeader" aria-controls="navHeader" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>


                        <div class="collapse navbar-collapse" id="navHeader">
                            <ul class="navbar-nav mx-auto flex-wrap">
                                <?php foreach ($blogcategory as $category) { ?>
                                    <li class="nav-item ">
                                        <a class='nav-link text-uppercase'
                                            href='<?php echo $BaseUrl; ?>/blog/index.php?category=<?php echo $category['id']; ?>'><?php echo $category['name']; ?></a>
                                    </li>
                                <?php } ?>
                                <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-uppercase" href="#" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">Rentals</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class='dropdown-item text-uppercase' href='#'>Author</a></li>
                                        <li><a class='dropdown-item text-uppercase' href='#'>Author Single</a></li>
                                        <li><a class='dropdown-item text-uppercase' href='#'>Tags</a></li>
                                        <li><a class='dropdown-item text-uppercase' href='#'>Tag Single</a></li>
                                        <li><a class='dropdown-item text-uppercase' href="#">Categories</a></li>
                                        <li><a class='dropdown-item text-uppercase' href="#">Category Single</a></li>
                                        <li><a class='dropdown-item text-uppercase' href='#'>404 Page</a></li>
                                        <li><a class='dropdown-item text-uppercase' href='#'>Privacy</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="row height d-none d-md-flex justify-content-center align-items-center">

                            <div class="col-md-4">

                                <div class="search-form">
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <i class="fa fa-searchh"></i>

                                        <input type="text" name="search" value="<?php if ($search) {
                                            echo $search;
                                        } ?>" class="form-control form-input" placeholder="Search ..">
                                        <button type="submit" class="left-pan"><i class="bi bi-search"></i></button>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>


                <div class="col-12 custom-border mt-3">
                    <!-- Content Goes Here -->
                </div>


            </div>
        </div>
    </header>

    <div class="search-block">
        <div data-toggle="search-close">
            <span class="bi bi-x text-primary"></span>
        </div>

        <input type="text" id="js-search-input" placeholder="Type to search blog.." aria-label="search-query">

    </div>



    <!-- blog warpper start -->
    <section class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <h3 class="text-uppercase custom-subheading">Latest Blog</h3>
                </div>
            </div>
            <div class="row gy-5 gx-4 g-xl-5">
                <?php foreach ($res_data as $blog) { ?>
                    <div class="col-md-4">
                        <article class="card post-card h-100 border-0 bg-transparent">
                            <div class="card-body">
                                <a class='d-block' href='blog-detail.php?id=<?php echo $blog['id']; ?>'
                                    title='The AGI hype train is running out of steam'>
                                    <div class="">
                                        <img class="w-100 h-auto rounded img-fluid" src="<?php echo $blog['image']; ?>"
                                            alt="The AGI hype train is running out of steam" width="970" height="500">
                                    </div>
                                </a>
                                <a class='d-block mt-3' href='blog-detail.php?id=<?php echo $blog['id']; ?>'
                                    title='The AGI hype train is running out of steam'>
                                    <h3 class="mb-3 custom-post-title">
                                        <?php echo $blog['title']; ?>
                                    </h3>
                                </a>
                                <ul class="card-meta list-inline mb-2">
                                    <li class="list-inline-item">
                                        <?php
                                        // Current date and time
                                        $createdAt = $blog['created_at']; // Example date format from the database
                                    
                                        // Convert the database date format to the desired format
                                        $formattedDateTime = date("d M, Y - h:ia", strtotime($createdAt));


                                        ?>

                                        <span style="font-size: 14px;"><?php echo " Admin, $formattedDateTime"; ?></span>
                                    </li>
                                </ul>
                                <p><?php 
                                $description =  strip_tags($blog["description"]); 
                                 echo substr_replace($description, "...", 160); ?></p>
                                
                            </div>
                        </article>
                    </div>
                <?php } ?>

            </div>

        </div>
        <?php
        echo "<ul class='pagination justify-content-center'>"; // Added Bootstrap class for center alignment
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li  class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>"; // Added Bootstrap classes for pagination
        }
        echo "</ul>";
        ?>
    </section>
    <!-- blog warpper end -->
    <?php
    include ('../component/f_footer.php');
    include ('component/btm_script.php'); ?>
    <script>
        //side menu bar
        const toggle = document.getElementById('toggle');
        const sidebar = document.getElementById('sidebar');

        document.onclick = function (e) {
            if (e.target.id !== 'sidebar' && e.target.id !== 'toggle') {
                toggle.classList.remove('active')
                sidebar.classList.remove('active')
            }
        }
        toggle.onclick = function () {
            toggle.classList.toggle('active');
            sidebar.classList.toggle('active');

        }
    </script>

    <!-- JS Plugins -->
    <script src="<?php echo $BaseUrl ?>/blogcss/assets/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo $BaseUrl ?>/blogcss/assets/lightense.min.js"></script>

    <!-- Main Script -->
    <script src="assets/script.js"></script>

</body>

</html>