<?php

include('../../univ/baseurl.php');
session_start();

if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "store/";

    include_once("../../authentication/islogin.php");
} else {
    function sp_autoloader($class)
    {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $active = 2;

    $_GET["categoryid"] = "1";
    $pid = $_SESSION['pid'];
    $uid = $_SESSION['uid'];

    // print_r($_SESSION);
    // die();
?>




    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Accounts List | TheSharepage-POS </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
        <style>
            .me-3 {
                padding-left: 0px;
                padding-right: 0px;
                margin-right: 14rem !important;
                margin-bottom: 3px;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row flex-nowrap">

                <?php include('left_side_landing.php'); ?>
                <div class="col py-3">
                    <div class="row mb-4">
                        <div class="d-flex justify-content-between border-bottom mb-3">

                            <?php if ($_SESSION['msg'] == "1") {
                                unset($_SESSION['msg']); ?>
                                <div class="alert alert-success" id="success" role="alert"> Created
                                    Successfully .
                                </div>

                            <?php } ?>

                            <?php if ($_SESSION['msg'] == "2") {
                                unset($_SESSION['msg']); ?>
                                <div class="alert alert-success" id="p_success" role="alert"> Updated
                                    Successfully .
                                </div>

                            
                            <?php } ?>


                            <?php if ($_SESSION['msg'] == "3") {
                                unset($_SESSION['msg']); ?>
                                <div class="alert alert-success" id="p_success" role="alert">Delete
                                    Successfully .
                                </div>

                            <?php } ?>





                            <h3>Accounts List</h3>
                            <a href="add_account.php" class="btn btn-main mb-3"><span class="d-none d-sm-inline"><i class="fas fa-plus"></i> Accounts</span></a>

                        </div>

                        <div class="col-12">

                            <table id="table_id" class="display" data-order='[[ 0, "desc" ]]' data-page-length='25'>
                                <thead>
                                    <tr>
                                        <th>ID</th>

                                        <th>Accounts Name</th>
                                        <!-- <th>Accounts Detail</th> -->


                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $p = new _pos;
                                    $result = $p->read_account();
                                    if ($result) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {

                                    ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>

                                                <td><?php echo $row['account_name']; ?></td>
                                                <!-- <td><?php echo $row['account_detail']; ?></td> -->


                                                <td style="padding: 8px 6px;">
                                                    <a href="<?php echo $BaseUrl . '/store/pos-dashboard/edit_account.php?id=' . $row['id']; ?>" class="btn btn-main"><i class="fas fa-edit"></i></a>
                                                    <a onclick="deletefun(<?php echo $row['id']; ?>)" class=" btn btn-danger"> <i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 footer">
                            <span>Copyrights &copy; 2022 TheSharePage, All Reights Reserved</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>











        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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
                Swal.fire({
                    title: 'Are You Sure You Want to Delete?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonText: 'No',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "delete_account.php?id=" + id;

                    }
                });

            }
        </script>
        <script>
            setTimeout(function() {
                $("#success").hide();
            }, 5000);
            setTimeout(function() {
                $("#no_member").hide();
            }, 5000);
            setTimeout(function() {
                $("#p_success").hide();
            }, 5000);
        </script>

        <script>
            <?php
            if (isset($_SESSION['conf'])) {
                unset($_SESSION['conf']);
            ?>
                Swal.fire({
                    title: 'File uploaded successfully',
                });
                // swal('File uploaded successfully');

            <?php   }
            ?>
        </script>

    </body>

    </html>

<?php } ?>