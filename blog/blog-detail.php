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
$uid = isset($_SESSION["uid"]) ? (int) $_SESSION["uid"] : 0;

$Id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$row = selectQ("SELECT * from blogs where id=?", "i", [$Id], "one");

$blogcategory = selectQ("SELECT * from blog_category", "i", "");


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <title> Home</title>

    <meta name="author" content="Platol">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="">

    <link rel="shortcut icon" href="<?php echo $BaseUrl ?>/blogcss/assets/images/favicon.png" type="image/x-icon">

    <!-- CSS Plugins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crete+Round&family=Work+Sans:wght@500;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/blogcss/assets/custom.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/blogcss/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/blogcss/assets/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/blogcss/assets/style.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/assets/css/landingpage/style.css"> <!-- new header css -->
    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/assets/css/landingpage/all.css"> <!-- fontawesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

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
                            <?php if (isset($uid)) { ?>
                                <li><a href="<?php echo $BaseUrl . '/timeline'; ?>" class="timeline btn-border-radius">My
                                        Timeline</a></li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>

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
                            <span>Search</span>
                            <svg width="22" height="22" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.5 15.5L19 19" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M5 11C5 14.3137 7.68629 17 11 17C12.6597 17 14.1621 16.3261 15.2483 15.237C16.3308 14.1517 17 12.654 17 11C17 7.68629 14.3137 5 11 5C7.68629 5 5 7.68629 5 11Z"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
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


                                <li class="nav-item dropdown">
                                    <!-- <a class="nav-link dropdown-toggle text-uppercase" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Rentals</a>
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

                                <!-- <div class="search-form">
                            <i class="fa fa-searchh"></i>
                            <input type="text" class="form-control form-input" placeholder="Search ..">
                            <span class="left-pan"><i class="bi bi-search"></i></span>
                          </div> -->

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

    <section class="padding-top">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="mb-5">
                        <?php $category = selectQ("SELECT * from blog_category where id=?", "i", [$row['category']], "one"); ?>
                        <h4 class="fw-bold d-flex justify-content-between"><a class='text-uppercase'
                                href="<?php echo $BaseUrl; ?>/blog/index.php?category=<?php echo $row['category']; ?>"><?php echo $category['name']; ?></a>
                                <a class='bck_btn '
                                href="<?php echo $BaseUrl; ?>/blog/index.php">Return to home</a>
                        </h4>
                        <h1 class="blog-title"><?php echo $row['title']; ?></h1>
                        <div class="content text-center">
                            <p><img src="<?php echo $row['image']; ?>" alt="The Parker Solar Probe"
                                    title="The Parker Solar Probe" class="img-fluid"></p>


                        </div>
                        <div class="content">

                            <p><?php echo $row['description']; ?> </p>

                        </div>
                    </div>

                    <?php
                    // Current date and time
                    $createdAt = $row['created_at'];
                    // Example date format from the database
                    
                    // Convert the database date format to the desired format
                    $formattedDateTime = date("d M, Y - h:ia", strtotime($createdAt));


                    ?>



                    <ul class="card-meta list-inline mb-2 text-start mt-2">
                        <li class="list-inline-item">
                            <span style="font-size: 14px;"><?php echo " Admin, $formattedDateTime"; ?></span>
                        </li>
                    </ul>
                </div>






            </div>

        </div>
    </section>


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
    <script src="<?php echo $BaseUrl ?>/blogcss/assets/script.js"></script>

</body>

</html>