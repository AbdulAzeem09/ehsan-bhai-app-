    
    <div class="row">
        <div class="col-md-6 topbread">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/photos/';?>"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $module;?></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6">
            <form class="form-inline text-right topSearchFormArt">
                <div class="form-group">
                    <label>Search</label>
                    <div class="form-group ">
                        <div class="mainArtSrch">
                            <select class="form-control" style="width: 25%;">
                                <option value="visual Artist">Visual Artist</option>
                                <option value="Graphics Designer">Graphics Designer</option>
                                <option value="Contemporary">Contemporary</option>
                                <option value="Animation">Animation</option>
                                <option value="Musician">Musician</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Search images" name="">
                        </div>
                    </div>
                    <button type="submit" class="btn">Advanced Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <?php
        $p = new _spprofiles;
        $result = $p->getArtGalleryCat(3, $catName);
        //echo $p->ta->sql;
        if($result != false){
            while ($row = mysqli_fetch_assoc($result)) {
                $pv = new _postingview;
                $result2 = $pv->totalArtistArt($row['idspProfiles'], $_GET["categoryID"]);
                //echo $pv->ta->sql;
                $total = 0;
                if($result2 != false){
                    $total = $result2->num_rows;
                }else{
                    $total = 0;
                }
                //$postofThatArt = ;
                ?>
                <div class="col-md-2">
                    <a href="<?php echo $BaseUrl.'/photos/artist-product.php?cat='.$moduleId.'&artist='.$row['idspProfiles'];?>">
                        <div class="boxArtistAll text-center">
                            <img src="<?php echo ($row["spProfilePic"]);?>" class="img-responsive">
                            <h3><?php echo $row['spProfileName'];?></h3>
                            <h4><?php echo ucwords(strtolower($row['spProfileFieldValue']));?></h4>
                            <span>Art Items: <?php echo $total;?></span>
                        </div>
                    </a>
                </div><?php
            }
        }
        ?>
            
    </div>