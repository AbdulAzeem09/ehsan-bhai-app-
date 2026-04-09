<?php 
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    if (!isset($_SESSION['pid'])) {
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin'] = "../timeline/";
    }

    $_GET["categoryID"] = 13;
    



?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
       
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        
    </head>

    <body class="bg_gray">
        <?php 
        $header_photo = "header_photo";
        include_once("../header.php");
        ?>
        <section class="innerArtBanner">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <h1>My Art Gallery</h1>
                    </div>
                    <?php include('top-search.php');?>
                </div>
            </div>
        </section>
        <section class="bg_white" style="border-bottom: 2px solid #CCC">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="art_scnd_levl">
                            <li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=1';?>">Visual Artist</a></li>
                            <li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=2';?>">Graphics Designer</a></li>
                            <li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=3';?>">Contemporary</a></li>
                            <li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=4';?>">Animation</a></li>
                            <li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=5';?>">Musician</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section> 
        <div class="space"></div> 
        <section class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 topbread">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/photos';?>"><i class="fa fa-home"></i></a></li>
                                
                                <li class="breadcrumb-item active" aria-current="page">My Photos</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <?php include('top-dashboard.php');?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center myEnqueryTab">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Id</th>
                                        <th style="text-align: left;">Title</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                    $p = new _postingview;
                                    $result = $p->singleFriendProduct($_SESSION['pid'], 13);
                                    
                                    if ($result) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $dt = new DateTime($row['spPostingDate']);
                                           ?>
                                           <tr>
                                                <td style="text-align: center;"><?php echo $i; ?></td>
                                                <td style="text-align: left;"><a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings']; ?>"><?php echo $row['spPostingtitle']; ?></a></td>
                                                <td>$<?php echo $row['spPostingPrice']; ?></td>
                                                <td><?php echo $dt->format('d M Y'); ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo $BaseUrl.'/post-ad/photos/?postid='.$row['idspPostings'];?>"><i class="fa fa-edit"></i></a>
                                                    <a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings']; ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                           <?php
                                           $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </section>
        
        <div class="space"></div>
        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
	</body>
</html>
