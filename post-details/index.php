<?php
    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../component/f_links.php');?>
    </head>
    <body class="bg_gray">
        <?php
        
        $g = new _spgroup;
        if(isset($_GET['groupid'])){
            $result2 = $g->groupdetails($_GET["groupid"]);
            //echo $g->ta->sql;
            if ($result2 != false) {
                $row2 = mysqli_fetch_assoc($result2);
                $gimage = $row2["spgroupimage"];
                $spGroupflag = $row2['spgroupflag'];
            }
        }
        

        $pc = new _postingpic;
        $res = $pc->read($_GET["postid"]);
        //echo $pc->ta->sql;
        if ($res != false) {
            $postr = mysqli_fetch_assoc($res);
            $picture = $postr['spPostingPic'];
            //echo "<div style='width:100%; height:276px;text-align: center;' class='divimgborder'><img  alt='Posting Pic' class='img-thumbnail imagehover sppointer postingpicture originalimg img-responsive' data-toggle='modal' data-target='#imageModal' src=' ".($picture)."' ></div>" ;
        }

        include_once("../header.php");
        ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <?php include('../component/left-group.php');?>
                    </div>
                    <div class="col-md-10">
                        <?php include('../grouptimelines/top_banner_group.php');?>

                        <?php
                        $p = new _postingview;
                        $rd = $p->read($_GET["postid"]);
                        if ($rd != false) {
                            $row = mysqli_fetch_assoc($rd);

                            $price = $row['spPostingPrice'];
                            $catid = $row["idspCategory"];
                            $wholesaleflag = $row["spPostingsFlag"];
                            $button = $row["spCategoriesButton"];
                            $comment = $row["sppostingscommentstatus"];
                        }

                        //Services Company Name
                        $p = new _postfield;
                        $res = $p->readfield($_GET["postid"]);
                        if ($res != false) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                                if ($rows['spPostFieldLabel'] == "Company")
                                    $company = $rows['spPostFieldValue'];

                                if ($rows['spPostFieldLabel'] == "Discount")
                                    $discount = $rows['spPostFieldValue'];
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="about_banner">
                                    <div class="top_heading_group ">
                                        <div class="row">
                                            <div class="col-md-6">                                                
                                                <ol class="breadcrumb">
                                                    <li><a href='<?php echo $BaseUrl ?>/<?php echo $row['spCategoryFolder']; ?>' class="<?php echo (isset($catid) == 2 || isset($catid) == 5 ? "" : "hidden"); ?>"><h3><?php echo $row['spCategoryname']; ?></h3></a></li>
                                                </ol>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="product_detail">
                                        <div class="row">
                                            
                                            <div class="col-md-4">

                                                <div id="myCarousel" class="carousel slide <?php echo ((isset($catid) == 2 || isset($catid) == 5 || isset($catid) == 6 || isset($catid) == 10 || isset($catid) == 14 || isset($catid) == 13 || isset($picture) == null) ? "" : "hidden") ?> " data-ride="carousel" style="height: 276px;overflow: hidden;" >

                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <?php
                                                            if(isset($picture)){ ?>
                                                                <img src="<?php echo ($picture); ?>" alt="Posting Pic" class="originalimg postingpicture " data-toggle="modal" data-target="#imageModal" style="width: 100%;"> <?php
                                                            }else{ ?>
                                                                <img src="../img/no.png" alt="Posting Pic" class="originalimg postingpicture "  style="width: 100%;"> <?php
                                                            }
                                                            ?>
                                                            
                                                        </div>
                                                        <?php
                                                            $pc = new _postingpic;
                                                            $postpicres = $pc->read($_GET["postid"]);
                                                            //echo $pc->ta->sql;
                                                            if ($postpicres != false) {
                                                                while ($rows = mysqli_fetch_assoc($postpicres)) {
                                                                    $picture = $rows['spPostingPic'];
                                                                    ?>
                                                                    <div class="item">
                                                                        <img src="<?php echo ($picture); ?>" alt="Posting Pic" class="originalimg postingpicture " data-toggle="modal" data-target="#imageModal" style="width: 100%;">
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        
                                                    </div>
                                                    <?php
                                                    if(isset($picture)){ 
                                                        ?>
                                                        <!-- Left and right controls -->
                                                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                                          <span class="glyphicon glyphicon-chevron-left"></span>
                                                          <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                                          <span class="glyphicon glyphicon-chevron-right"></span>
                                                          <span class="sr-only">Next</span>
                                                        </a>
                                                        <?php
                                                    }?>
                                                </div>



                                            </div>
                                            <div class="col-md-8">

                                                <h2 class="product-title"><?php echo $row['spPostingtitle']; ?></h2>
                                                <div class="product-rating <?php echo ($catid == 12 || $catid == 2 || $catid == 5 ? "hidden" : ""); ?>">
                                                    <fieldset id='postrating' class="rating">
                                                        <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                                        <label  style="cursor:pointer" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                        <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                                        <label style="cursor:pointer" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                        <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                                        <label style="cursor:pointer" class = "full" for="star3" title="Meh - 3 stars"></label>
                                                        <input style="cursor:pointer" class="stars" type="radio" id="star2" name="rating" value="2" />
                                                        <label style="cursor:pointer" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                        <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                                        <label style="cursor:pointer" class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                    </fieldset> 
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 review_pan">
                                                        <?php
                                                    if ($catid != 12 && $catid != 2 && $catid != 5) {
                                                        $r = new _sppostrating;
                                                        $res = $r->read($_SESSION["pid"], $_GET["postid"]);
                                                        if ($res != false) {
                                                            $rows = mysqli_fetch_assoc($res);
                                                            $rat = $rows["spPostRating"];
                                                        } else
                                                            $rat = 0;

                                                        $result = $r->review($_GET["postid"]);
                                                        if ($result != false) {
                                                            $total = 0;
                                                            $count = $result->num_rows;
                                                            while ($rows = mysqli_fetch_assoc($result)) {
                                                                $total += $rows["spPostRating"];
                                                            }
                                                            $ratings = $total / $count;
                                                        }
                                                        //echo "<img src='../img/5star.png' width='100'><br>" ;
                                                        $r = new _sppostreview;
                                                        $result = $r->review($_GET["postid"]);
                                                        if ($result != false) {
                                                            $rows = mysqli_fetch_assoc($result);
                                                            $review = $result->num_rows;
                                                        } else
                                                            $review = 0;

                                                       
                                                        if (isset($ratings)) {
                                                            echo "<span id='review'>" . round($ratings, 2) . " </span><a href='../customer_reviews/?postid=" . $_GET["postid"] . "' ><span id='totalreview'>(" . $review . ")</span> Reviews </a>";
                                                        }

                                                        echo "<span class='" . (isset($comment) == 0 ? "hidden" : "") . "'>";
                                                        echo "<span class='verticalline '>/</span>";
                                                        echo "&nbsp;&nbsp;<a href='#' data-toggle='modal' id='writereview' data-target='#reviews'>Write Review</a>";
                                                        echo "</span>";
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                                <?php
                                                    $dt = new DateTime($row['spPostingDate']);
                                                    $postdate = strtotime($row['spPostingDate']);
                                                    $currentdate = strtotime(date('Y-m-d h:i:sa'));
                                                    $Diff = abs($currentdate - $postdate);
                                                    $numberDays = $Diff / 86400;
                                                    $numberDays = intval($numberDays);

                                                ?>
                                                <p class="product-desc"><?php echo $row['spPostingNotes'];?></p>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <?php
                                                                $price = 0;
                                                                if (isset($row['spPostingPrice'])){
                                                                    $price = $row['spPostingPrice'];
                                                                }
                                                                $productname = $row['spPostingtitle'];
                                                                //echo "<p>".$row['spPostingNotes']."</p>";
                                                                $postingnotes = $row['spPostingNotes'];

                                                                if ($price != false) {
                                                                    $pr = new _postfield;
                                                                    $re = $pr->readprice($_GET["postid"]);
                                                                    if ($re != false) {
                                                                        ?>
                                                                        <td>Price</td>
                                                                        <td>$<?php echo $row['spPostingPrice']; ?> /hour</td>
                                                                        <?php
                                                                    } else {
                                                                        if ($catid == 9) {
                                                                            $ticketprice = $row['spPostingPrice'];
                                                                            ?>
                                                                            <td>Ticket Price</td>
                                                                            <td>$<?php echo $row['spPostingPrice']; ?></td>
                                                                            <?php
                                                                        } else{?>
                                                                            <td>Price</td>
                                                                            <td>$<?php echo $row['spPostingPrice']; ?></td>
                                                                            <?php
                                                                        }
                                                                    }
                                                                } ?>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>Country</td>
                                                                <td><?php echo $row['spPostingsCountry']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>City</td>
                                                                <td><?php echo $row['spPostingsCity']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php
                                                                $catid = $row['idspCategory'];
                                                                if ($catid != 18 && $catid != 9 && $catid != 5 && $catid != 2 && $catid != 12 && $catid != 3) {
                                                                    if ($row['sppostingShippingCharge'] == 0) {
                                                                        ?>
                                                                        <td>Free Shipping</td>
                                                                        <td>&nbsp;</td>
                                                                        <?php
                                                                        
                                                                    } else{ ?>
                                                                        <td>Delevery Charge</td>
                                                                        <td>$<?php echo $row['sppostingShippingCharge'];?></td> <?php
                                                                    }
                                                                }
                                                                ?>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>Quantity Available</td>
                                                                <td>
                                                                    <?php
                                                                    //Quantity availability of this post
                                                                    $pr = new _postfield;
                                                                    $re = $pr->quantity($_GET["postid"]);
                                                                    //echo $pr->ta->sql;
                                                                    if ($re != false) {
                                                                        $i = 0;
                                                                        $rw = mysqli_fetch_assoc($re);
                                                                        $totalquantity = $rw["spPostFieldValue"];
                                                                    } else {
                                                                        if ($catid == 8 || $catid == 10 || $catid == 11 || $catid == 13 || $catid == 14)
                                                                            $totalquantity = INF;
                                                                        else
                                                                            $totalquantity = 1;
                                                                    }
                                                                    $or = new _order;
                                                                    $total = 0;
                                                                    $res = $or->quantityavailable($_GET["postid"]);
                                                                    if ($res != false) {
                                                                        while ($order = mysqli_fetch_assoc($res)) {
                                                                            if ($order["spOrderStatus"] == 0) {
                                                                                $soldquantity += $order["spOrderQty"];
                                                                            }
                                                                        }
                                                                    }

                                                                    if (isset($soldquantity)) {
                                                                        $available = $totalquantity - $soldquantity;
                                                                    }else{
                                                                        $available = 0;
                                                                    }

                                                                    //if($button == "Buy" && $catid != 3 )
                                                                    if ($catid == 1 || $catid == 9 || $catid == 15)
                                                                        echo $available;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                

                                                <hr>
                                                <div class="btn-group cart">
                                                    <!--<button type="button" class="btn btn-success">-->
                                                    <?php
                                                    if ($catid == 18) {
                                                        echo "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#quotation'><span class='fa fa-quote-left' aria-hidden='true'></span> Send Quotation</button>";
                                                    }
                                                    ?>          
                                                    <!--</button>-->
                                                </div>
                                                <div class="btn-group wishlist">
                                                    <button type="button" class="btn btn-danger">
                                                        Add to wishlist 
                                                    </button>
                                                </div>
                                            









                                            </div>
                                            
                                        </div>
                                        


                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php
                        $media = new _postingalbum;
                        $result = $media->read($_GET["postid"]);
                        //echo $media->ta->sql;
                        if ($result != false) {
                            if ($row['spCategoryFolder'] == "videos" || $row['spCategoryFolder'] == "trainings" || $row['spCategoryFolder'] == "recipes") {
                                $r = mysqli_fetch_assoc($result);
                                $picture = $r['spPostingMedia'];
                                echo "<div><video width='320' height='180' controls><source class='img-thumbnail imagehover sppointer postingpicture' src='data:video/mp4;base64, " . ($picture) . "'></video></div>";
                            } elseif ($row['spCategoryFolder'] == "music") {
                                $r = mysqli_fetch_assoc($result);
                                $picture = $r['spPostingMedia'];
                                echo "<div><audio width='320' height='180' controls><source class='img-thumbnail imagehover sppointer postingpicture' src='data:audio/mp4;base64, " . ($picture) . "'></audio></div>";
                            } elseif ($row['spCategoryFolder'] == "documents") {
                                $r = mysqli_fetch_assoc($result);
                                $picture = $r['spPostingMedia'];
                                echo " <div><iframe class='sppointer postingpicture' src='data:application/pdf;base64, " . ($picture) . "'></iframe></div>";
                            } elseif ($row['spCategoryFolder'] == "photos") {
                                $r = mysqli_fetch_assoc($result);
                                $picture = $r['spPostingMedia'];
                                echo "<div style='width:100%;height:276px'><img  alt='Posting Pic' class='img-thumbnail imagehover postingpicture' style='width:400px; height: 276px;' src=' " . ($picture) . "' ></div>";
                            }
                        } elseif ($row['spCategoryFolder'] != "videos" && $row['spCategoryFolder'] != "music" && $row['spCategoryFolder'] != "documents" && $row['spCategoryFolder'] != "photos") {
                            if (isset($catid) != 2 && isset($catid) != 5) {
                                $picture = null;
                                $pc = new _postingpic;
                                $res = $pc->read($_GET["postid"]);
                                if ($res != false) {
                                    $postr = mysqli_fetch_assoc($res);
                                    $picture = $postr['spPostingPic'];
                                    //echo "<div style='width:100%; height:276px;text-align: center;' class='divimgborder'><img  alt='Posting Pic' class='img-thumbnail imagehover sppointer postingpicture originalimg img-responsive' data-toggle='modal' data-target='#imageModal' src=' ".($picture)."' ></div>" ;
                                } else
                                    echo "<div style='width:100%; height:276px;text-align: center;' class='divimgborder'><img  alt='Posting Pic' src='../img/no.png' class='img-thumbnail imagehover sppointer post-highlight originalimg img-responsive'></div>";
                            }
                        } else{
                           // echo "<div style='width:100%; height:276px;text-align: center;' class='divimgborder'><img  alt='Empty-media' class='img-thumbnail imagehover sppointer post-highlight originalimg img-responsive'></div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        
 		 
        <!--Write Reviews-->
        <div class="modal fade" id="reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="exampleModalLabel"><b>Write Review</b></h3>
                    </div>
                    <div class="modal-body">
                        <form action="addreview.php" method="POST">
                            <input type="hidden" class="dynamic-pid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'] ?>"/>

                            <input type="hidden"  name="spPostings_idspPostings" value="<?php echo $_GET["postid"] ?>">

                            <input type="hidden"  name="spPostRating" id="spPostRating" value="<?php echo $rat; ?>">
                            <div class="form-group">
                                <textarea class="form-control" id="reviewtext" name="spPostReviewText" placeholder="Write your Review..." rows="5"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary writereview">Post</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div> 
        <!--Reviews Complete-->

        <!--modal for Enquery-->
        <div class="modal fade" id="enqueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="enquireModalLabel" align="center"><b>New message</b></h3>
                    </div>
                    <div class="modal-body">
                        <form action="../enquiry/addenquire.php" method="post">
                            <?php
                            $e = new _postenquiry;
                            $re = $e->read($_GET["postid"]);
                            if ($re != false) {
                                while ($rw = mysqli_fetch_assoc($re)) {
                                    $con = new _conversation;
                                    $result = $con->readconversation($rw["idspMessage"]);
                                    if ($result != false) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            
                                        }
                                    }
                                }
                            }
                            ?>
                            <input type="hidden" class="dynamic-pid" id="buyerProfileid" name="buyerProfileid" value="<?php echo $_SESSION['pid'] ?>"/>

                            <input type="hidden" id="sellerProfileid" name="sellerProfileid" value="<?php echo $row['idspProfiles']; ?>"/>

                            <input type="hidden" id="spPostings_idspPostings" name="spPostings_idspPostings" value="<?php echo $_GET["postid"] ?>">

                            <div class="form-group">
                                <label for="message-text" class="form-control-label contact">Message</label>
                                <textarea class="form-control" id="message-text" name="message" rows="5"></textarea>
                            </div>
                   
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary postenquiry">Send message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--complete-->
        <!--Modal for Quatation-->
        <div class="modal fade" id="quotation" tabindex="-1" role="dialog" aria-labelledby="quotationModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" align="center" id="quotationModalLabel"><b>Quotation</b></h3>
                    </div>
                    <form enctype="multipart/form-data" action="../buy-sell/sendquotation.php" method="post">
                        <div class="modal-body">

                            <input type="hidden" name="buyeremail_" value="<?php echo $row['spProfileEmail']; ?>"/>

                            <input type="hidden" name="buyername_" value="<?php echo $row['spProfileName']; ?>"/>

                            <input type="hidden" name="spQuotationBuyerid" value="<?php echo $row['idspProfiles']; ?>"/>

                            <input type="hidden" class="dynamic-pid" name="spQuotationSellerid" value="<?php echo $_SESSION['pid'] ?>"/>

                            <input type="hidden" name="spPostings_idspPostings" value="<?php echo $_GET["postid"] ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="productname" class="control-label contact">Product Name</label>
                                        <input type="text" class="form-control" id="productname" name="spQuotationProductName" value="<?php echo $productname; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantityavailable" class="control-label contact">Quantity Available</label>
                                        <input type="number" class="form-control" id="quantityavailable" name="spQuotationTotalQty">
                                    </div>
                                </div>

                            </div><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="deleverytime" class="control-label contact">Delivery Time</label>
                                        <input type="number" class="form-control" id="deleverytime" name="spQuotationDelevery" min="1" max="50">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="shippingcharges" class="control-label contact">Shipping Charges</label>
                                        <input type="number" class="form-control" id="shippingcharges" name="spQuotationShippingCharges" min="50">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="stockvalidity" class="control-label contact">Stock Validity</label>
                                        <input type="date" class="form-control" id="stockvalidity" name="spQuotationStockValidity">
                                    </div>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="productdetails" class="control-label contact">Product Details</label>
                                        <textarea class="form-control" id="productdetails" name="spQuotatioProductDetails"></textarea>
                                    </div>
                                </div>
                            </div><br>
                            <!--Price Testing-->
                            <div class="form-group">
                                <label for="spquotationPrice" class="contact">Price &nbsp; &nbsp;</label>
                                <label class="radio-inline contact"><input type="radio" id="fixedPrice" name="spQuotationPriceflag">Fixed Price</label>
                                <label class="radio-inline contact"><input type="radio" id="peritem" name="spQuotationPriceflag">Per/item</label>
                                <div class="cost"></div>
                            </div><br>
                            <!--Price Testing complete-->
                            <!--Quotation Picture-->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="postingpic" class="contact">Add Images</label>
                                        <input type="file" class="postingpic" name="spQuotationPic[]" multiple="multiple">
                                        <p class="help-block"><small>Browse</small></p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div id="imagePreview"></div>
                                        <div id="postingPicPreview">
                                            <div class="row">
                                                <div id="dvPreview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Quotation picture Complete-->
                            <!--Quatation Media-->
                            <div class="form-group">
                                <label for="addmedia" class="contact">Add Files</label>
                                <input type="file" id="addmedia" name="spQuotationMedia[]" multiple="multiple">
                                <p class="help-block"><small>Browse</small></p>
                            </div>
                            <!--Quatation Media Complete-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal For Quatation Complete-->
        <!--Modal for share to group or Friend-->

        <!--complete-->
        <!-- Big image Modal-->
        <div class="modal fade" id="imageModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style=""><?php echo $row['spPostingtitle'] ?></h4>
                    </div>
                    <div class="modal-body" style="background-color:white;">
                        <div style="text-align:center;"><img id="postpicture" src="<?php echo ($postr['spPostingPic']); ?>" alt="Posting Pic" class="img-rounded img-thumbnail originalimg"></div>				
                    </div>
                </div>
            </div>
        </div><!--Big image Modal Complete-->
 

        <div class="modal fade" id="myshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <form action="../social/share.php" method="POST">
                            <input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid'] ?>">
                            <input type="hidden" name="spPostings_idspPostings" value="<?php echo $_GET["postid"]; ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownShare" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select group or friend<span class="caret"></span></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownShare">
                                            <li id="groupshare" class="sppointer sharedd"><a href="#">Share in a group</a></li>
                                            <li id="friendshare" class="sppointer sharedd"><a href="#">Share to a friend</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-5  hidden" id="groupshow">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" id="spgroupshareid" name="spShareToGroup">
                                        <input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
                                    </div>
                                </div>

                                <div class="col-md-5 hidden" id="profileshow">
                                    <div class="input-group">
                                        <input type="hidden" id="spfriendshareid" name="spShareToWhom">
                                        <input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
                                    </div>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
                                <input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...">
                            </div>
                            <!--</form>-->
                            
                            <div class="modal-body">
                                <img id="modalpostingpic"  src="<?php echo ($postr['spPostingPic']); ?>" alt="Posting Pic" class="img-rounded img-thumbnail <?php echo (isset($postr['spPostingPic']) ? "" : "hidden"); ?>" style="width:300px; height:300px; margin-left:120px">

                                <img id="modalpostingpic"  src="../img/no.png" alt="Posting Pic" class="img-rounded img-thumbnail <?php echo (isset($postr['spPostingPic']) ? "hidden" : ""); ?>" style="width:300px; height:300px; margin-left:120px">

                            </div>
                            <div class="modal-footer">
                                <button type="" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="share" class="btn btn-primary">Share</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Bid System on freelancer Post-->
        <div class="modal fade" id="bid-system" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="bidModalLabel"><b>Bid on Project</b><span id="projecttitle" style="color:#1a936f;"></span></h3>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <label for="bidPrice" class="contact">Your bid for the project</label>
                            <div class="input-group" style="width:6cm;">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" class="form-control activity" id="bidPrice" name="bidPrice" data-filter="0" placeholder="Bid Price...." aria-describedby="basic-addon1">
                            </div><br>

                            <!--Hidden attribute-->
                            <input type="hidden" id="bidpost" name="spPostings_idspPostings" value="<?php echo $_GET["postid"]; ?>">

                            <input type="hidden" id="spPostFieldBidFlag" value="1">

                            <input type="hidden" class="freelancercat" value="<?php echo $catid; ?>">

                            <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
                            <!--Complete-->
                            <?php
                            $p = new _postfield;
                            $res = $p->readfield($_GET["postid"]);
                            if ($res != false) {
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    if ($rows["spPostFieldLabel"] == "Closing Date")
                                        $bidclosingdate = $rows["spPostFieldValue"];
                                }
                            }
                            ?>

                            <input type="hidden" class="closingdate" value="<?php echo $bidclosingdate; ?>" >

                            <label for="totalDays" class="contact">In how many days can you deliver a completed project?*</label>
                            <div class="input-group" style="width:6cm;">
                                <input type="text" class="form-control activity" id="totalDays" name="totalDays" placeholder="Total Days...." aria-describedby="basic-addon2" data-filter="0">
                                <span class="input-group-addon" id="basic-addon2" class="contact">Day(s)</span>
                            </div><br>


                            <label for="initialPercentage" class="contact">Initial milestone percentage required</label>
                            <div class="input-group" style="width:6cm;">
                                <input type="text" class="form-control activity" id="initialPercentage" name="initialPercentage" placeholder="Initial Percentage...." aria-describedby="basic-addon2" data-filter="0">
                                <span class="input-group-addon" id="basic-addon2">20-100%</span>
                            </div>

                            <div class="form-group" style="width:6cm;">
                                <label for="bidPrice" class="contact">Comment</label>
                                <textarea class="form-control activity" id="comment" name="comment" placeholder="Type Comment..."></textarea>
                            </div>


                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="placebid btn btn-primary" data-postid="<?php echo $_GET["postid"]; ?>" data-profileid="<?php echo $_SESSION['pid']; ?>" data-catid="<?php echo $catid; ?>">Place Bid</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <!--Bid System on freelancer Post has completed-->            
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
}
?>