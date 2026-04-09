<?php
  include('../univ/baseurl.php');
  if(isset($_GET['catid']) && $_GET['catid'] >0){

  }else{
    header('location:'.$BaseUrl);
  }
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
    </head>

    <body class="bg_gray">
    	<?php
        session_start();
        if(!isset($_SESSION['pid']))
        { 
          include_once ("../authentication/check.php");
          $_SESSION['afterlogin']="my-posts/";
        }
        function sp_autoloader($class)
        {
          include '../mlayer/' . $class . '.class.php';
        }
        spl_autoload_register("sp_autoloader");
        //this is for store header
        $header_store = "header_store";

        include_once("../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 no-padding">
                        <?php include('../component/left-store.php');?>
                    </div>
                    <div class="col-md-10">
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="top_banner">
                                    <img src="assets/images/icon/store/category-banner.jpg" class="img-responsive" alt="" />
                                    
                                </div>
                            </div>
                        </div>
                        <div class="store_searchbox m_btm_10">
                            <form>
                                <div class="">
                                    <input type="text" class="form-control" placeholder="Search For Products" />
                                    <button type="submit" class="btn store_search_btn">Search</button>
                                </div>                                
                            </form>
                        </div>
                        <div class="breadcrumb_box m_btm_10">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item"><a href="#">Category</a></li>
                              <li class="breadcrumb-item active">Category-Item</li>                              
                            </ol>
                        </div>
                        
                        

                        <div class="row no-margin ">
                            
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>

                            
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>
                            <div class="col-xs-5ths">
                                <div class="featured_box text-center subcategory_box">
                                    <a href="#">
                                        <img src="assets/images/icon/store/subcategory/scat.jpg" class="img-responsive">
                                    </a>
                                    <h4>Smart Bags</h4>
                                    <h5 >$330,000</h5>
                                    <h6 class="name">Marina XoXO</h6>
                                    <p class="date">3 September | 12:38 p.m.</p>
                                </div>
                            </div>


                        

                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
