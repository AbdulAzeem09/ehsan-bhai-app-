<?php


/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/


require_once("../univ/baseurl.php");
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "dashboard/";
    include_once("../authentication/islogin.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $pageactive = 86;
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include('../component/f_links.php'); ?>
        <!--This script for posting timeline data End-->
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../component/dashboard-link.php'); ?>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!-- ===========PAGE SCRIPT==================== -->
        <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
        <style>
            .tagLine-max-char {

                font-size: smaller;
                font-weight: 600;

            }

            .dataTables_filter {
                margin-bottom: 3px;
            }

            .dataTables_empty {
                text-align: center !important;
            }

            .main {
                padding: 2%;
                background-color: #fff;
                margin: 1%;
                text-align: center;

            }
        </style>
    </head>

    <body class="bg_gray" onload="pageOnload('details')">
        <?php

        include_once("../header.php");
        ?>

        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php
                        include('../component/left-dashboard.php');
                        ?>
                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">

                            <div class="main">
                                <h2>POS Subscription Balance : </h2>
                                <br>
                                <div>
                                    <?php
                                    $p = new _pos;
                                    $data11 = $p->read_barcode11($_SESSION['uid']);
                                    if ($data11) {
                                        //die('==');
                                        $total_quntity = 0;
                                        while ($row_b11 = mysqli_fetch_assoc($data11)) {
                                            //echo $row_b11['barcode']."<br>";
                                            $d = $p->read_name_qty($row_b11['barcode']);
                                            if ($d) {
                                                //die('==');

                                                while ($r = mysqli_fetch_assoc($d)) {
                                                    echo "<b>" . $r['name_qty'] . "</b> = ";
                                                    echo $row_b11['quantity'] . "<br>";
                                                    $total_quntity += $row_b11['quantity'];
                                                }
                                            }
                                        }
                                        //die('====');
                                    }
                                    ?>
                                    <br>
                                    <div><span><b>Total Quantity :</b> <?php echo $total_quntity; ?></span></div>
                                </div>
                            </div>
                            <div class="col-12">

                                <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
                                    <thead>
                                        <tr>
                                            <!-- <th>Name</th> -->
                                            <th>Date</th>
                                            <!--<th>Color</th>
                           	<th>Size</th>-->
                                            <th>Previous Quantity </th>
                                            <th>Quantity Refill</th>
                                            <th>Membership Name</th>
                                            <th>Action</th>
                                            <!--<th>Purchase Price</th>
                           <th>Cost</th>
                           <th>Sale Price</th>-->
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $p = new _pos;

                                        $result = $p->read_mem_bar_id_customer_n($_SESSION['uid'], $_SESSION['pid'], $_SESSION['uid']);
                                        //print_r($result);
                                        //die('==');

                                        if ($result) {
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ///print_r($row);
                                                //die('==');
                                                $id =    $row['barcode'];
                                                $customer_id = $row['customer_id'];
                                                //echo $id;
                                                //die('==');
                                                $res1 = $p->read_member_bar($id);
                                                //print_r($res1);
                                                //die('======');
                                                if ($res1 == True) {

                                                    $row_2 = mysqli_fetch_assoc($res1);
                                                    $name = $row_2['name_qty'];
                                                    $price = $row_2['price_qty'];
                                                }


                                                $res2 = $p->read_peyment($customer_id);
                                                if ($res2 == True) {

                                                    $row_3 = mysqli_fetch_assoc($res2);
                                                    $salesperson_id = $row_3['salesperson_id'];

                                                    $us1 = $p->read_users_id($salesperson_id);
                                                    if ($us1 != false) {
                                                        $row_1 = mysqli_fetch_assoc($us1);
                                                        $user_name = ucfirst($row_1['user_name']);
                                                    }
                                                }
                                                //echo "<pre>"; 
                                                //print_r($row); //die("--------------------------");

                                        ?>
                                                <tr>
                                                    <!-- <td><?php //echo $name; 
                                                                ?></td> -->
                                                    <td><?php echo $row['date']; ?> <?php echo $price; ?></td>
                                                    <!--<td>N/A</td>
                           	<td>N/A</td>-->
                                                    <td><?php echo $row['current_qty']; ?></td>
                                                    <td><?php echo $row['quantity']; ?></td>
                                                    <td><?php echo $name; ?></td>

                                                    <td>
                                                        <?php echo $row['event']; ?>

                                                    </td>
                                                    <!-- <td> %<?php echo $row['cost_in']; ?></td>
                          	<td>$<?php echo $row['sellingPrice_in']; ?>.00</td>-->
                                                    <!-- <td>
						   <a href="<?php echo $BaseUrl . '/store/pos-dashboard/edit-product.php?postid=' . $row['idspPostings']; ?>"><i class="fas fa-edit me-1"></i></a>|
					 <a onclick="deletefun(<?php echo $row['idspPostings']; ?>)" class="text-danger"> <i class="fas fa-trash"></i></a>  
					</td>-->
                                                </tr>
                                        <?php }
                                        } ?>

                                    </tbody>


                                </table>

                            </div>



                        </div>
                    </div>





                </div>
        </section>


        <?php include('../component/f_footer.php'); ?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../component/f_btm_script.php'); ?>

        <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
                            <!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->



    </body>

    </html>
<?php
} ?>


<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table_id').DataTable({
            buttons: {
                buttons: ['copy', 'csv', 'excel']
            }
        });
    });
</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script type="text/javascript">
    function deletefun(id) {

        var my_path1 = $("#my_path1").val();

        Swal.fire({
            title: 'Are you sure?',
            text: "It will deleted permanently !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "delete.php",
                    data: {
                        postid: id
                    },
                    success: function(response) {

                        window.location.href = "customer-list.php";

                    }

                });
            }
        })



    }
</script>