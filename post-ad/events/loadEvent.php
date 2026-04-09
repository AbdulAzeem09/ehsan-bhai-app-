
<?php
    //include('../../unive/baseurl.php');
    session_start();
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>
    <!--CSS FOR MULTISELECTOR-->
    <link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        //USER ONE
        $(function () {
            $('#rightmenu').multiselect({
                includeSelectAllOption: true
            });
            
        });
    </script>
    <label for="sponsorId_">Select Sponsor(<a href="javascript:void(0)" data-toggle="modal" data-target="#sponsorAddModal">Add Sponsor</a>)</label>
    <select id="rightmenu" class="sp_Sponsor form-control spPostField " name="sponsorId_" multiple="multiple" style="width: 100%;">
        <?php
        $sp = new _sponsorpic;
        $result2 = $sp->readAll($_SESSION['pid']);
        //echo $sp->ta->sql;
        if($result2 != false){
            while ($row2 = mysqli_fetch_assoc($result2)) {
                echo "<option value='".$row2['idspSponsor']."'>".$row2['sponsorTitle']."</option>";
            }
        }
        ?>
    </select>