   
    <?php
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    ?>

    <select class="form-control spPostField" id="medium_" name="medium_">
        <?php
        //$category = $_POST['category'];
        if(isset($_POST['category']) && $_POST['category'] != ''){
            $categoryId = $_POST['category'];
            $co = new _spAllStoreForm;
            $result3 = $co->readInSubCategory($categoryId);
            //echo $co->ta->sql;
            if($result3){
                while ($row3 = mysqli_fetch_assoc($result3)) {
                    echo "<option value='".$row3['insubcatTitle']."'>".$row3['insubcatTitle']."</option>";
                }
            }
        }
        ?>
    
    </select>
