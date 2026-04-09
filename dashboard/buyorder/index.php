<?php
    require_once("../../univ/baseurl.php" );
     session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="dashboard/";
    include_once ("../../authentication/islogin.php");
  
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
   

    $pageactive = 19;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- ===========PAGE SCRIPT==================== -->
        <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
        
    </head>
    <body class="bg_gray" >
        <?php
       
        include_once("../../header.php");
        ?>
        
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php
                        ;
                        include('../../component/left-dashboard.php');
                        ?>
                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">
                            
                            <!-- breadcrumb -->
                            <section class="content-header">
                                <h1>My Buying Product</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">My Buying Product</li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-success">
                                            <div class="box-header">
                                                
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped ">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Id</th>
                                                                <th>Product Title</th>
                                                                <th class="text-center">Qty</th>
                                                                <th>Transaction Id</th>
                                                                <th>Module</th>
                                                                <th>Date</th>
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $p = new _order;
                                                            $c = new _categories;

                                              $result = $p->purchase($_SESSION['pid']);
											 // var_dump($result);
                                                            //echo $p->ta->sql;
                                                            if ($result) {
                                                                $i = 1;
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $dt = new DateTime($row['sporderdate']);

                                                                    $result2 = $c->get_Category_Detail($row['spCategories_idspCategory']);
                                                                    if ($result2) {
                                                                        $row2 = mysqli_fetch_assoc($result2);
                                                                        $CatName = $row2['spCategoryName'];
                                                                        $catFold = $row2['spCategoryFolder'];
                                                                        
                                                                    }else{
                                                                        $CatName = "";
                                                                        $catFold = "";
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo $i;?></td>
                                                                        <td>
                                                                            <?php
                                                                            if ($row['spCategories_idspCategory'] == 1) {
                                                                                ?>
                                                                                <a href="<?php echo $BaseUrl.'/'.$catFold.'/detail.php?catid=1&postid='.$row['idspPostings']; ?>"><?php echo $row['spPostingTitle'];?></a>
                                                                                <?php
                                                                            }else{
                                                                                echo $row['spPostingTitle'];
                                                                            }
                                                                            ?>
                                                                            
                                                                        </td>
                                                                        <td class="text-center"><?php echo $row['spOrderQty'];?></td>
                                                                        <td><?php echo $row['txn_id']; ?></td>
                                                                        <td>
                                                                            <a href="<?php echo $BaseUrl.'/'.$catFold;?>"><?php echo $CatName; ?></a>                                                                        
                                                                        </td>
                                                                        <td><?php echo $dt->format('d M Y');?></td>
                                                                        <td class="menu-action text-center">
                                                                            <a href="<?php echo $BaseUrl.'/dashboard/buyorder/detail.php?orderid='.$row['idspOrder'];?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-green vd_green"> <i class="fa fa-eye"></i> </a>
                                                                            
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
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                




            </div>
        </section>

        
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
        <script>
            $(function() {
                $(':checkbox').checkboxpicker();
            });
        </script>
    </body>	
</html>
<?php
} ?>