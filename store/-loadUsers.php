
<?php
    include('../univ/baseurl.php');

    session_start();
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $catTitle = $_POST['catid'];


?>
    <!--CSS FOR MULTISELECTOR-->
    <link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script type="text/javascript">
        //USER ONE
        $(function () {
            $('#users').multiselect({
                includeSelectAllOption: true
            });
            
        });
    </script>
    <?php
    $pf    = new _postfield;
    $prf    = new _spprofiles;

    $result = $pf->readAllSameCategoryProfile($catTitle, $_SESSION['pid']);
    //echo $pf->ta->sql;
    ?>
    <label style="display: block;">Wholesalers</label>
    <select id="users" name="spWholesaler[]" multiple="multiple" class="form-control" style="width: 100%;"> 
        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $result2 = $prf->read($row['spProfiles_idspProfiles']);
                if ($result2) {
                    $row2 = mysqli_fetch_assoc($result2);
                }
                ?>
                <option value="<?php echo $row['spProfiles_idspProfiles'];?>"><?php echo $row2['spProfileName'];?></option>
                <?php
            }
        }
        ?>
    </select>
   


    


    