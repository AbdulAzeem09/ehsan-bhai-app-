
<?php


//	error_reporting(E_ALL);
//ini_set('display_errors', 'On');
	?>
<div class="left_Entertain">
    <div class="head_left_enter text-center">
        <h2><img src="<?php echo $BaseUrl;?>/assets/images/entertain/filter.png" alt="" /> Filter</h2>
    </div>
	<style>
	#myList li{ display:none;
}
#loadMore {
    color:black;
    cursor:pointer;
	margin-left: 40px;
}
#loadMore:hover {
    color:black;
}
#showLess {
    color:red;
    cursor:pointer;
	margin-left: 40px;
}
#showLess:hover {
    color:black;
}


	#myList2 li{ display:none;
}
#loadMore2 {
    color:black;
    cursor:pointer;
	margin-left: 40px;
}
#loadMore2:hover {
    color:black;
}
#showLess2 {
    color:red;
    cursor:pointer;
	margin-left: 40px;
	
}
#showLess2:hover {
    color:black;
}

#btnn{
	margin-left:77px;
	margin-top:10px;
}
	</style>
    <div class="body_left_ser">
	<form method="GET" action="?catName=yes">
	
	<input style="margin-left:8px;" type="text" value="<?php if($_GET['keyword']){echo $_GET['keyword'];} ?> " name="keyword" class="form-control" placeholder="Keyword " ><br>
		<h3>Community</h3>
		<ul id="myList">
            <?php 
                $selectedCat = "";
                if(isset($_GET['catName'])) {
                    $selectedCat = $_GET['catName'];
                }
				
            ?>
			<?php
									$p   = new _classified;
									$commservice = $p->commser(1);
		
		if($commservice){
             while ($roww = mysqli_fetch_assoc($commservice)){ ?>
			                                

 <a href="<?php //echo $BaseUrl.'/services/allads.php?catName='.$roww['clasifiedTitle'];?>"><?php //echo $roww['clasifiedTitle']?></a>
                                    

			
									
			
			
            <li><label><input type="checkbox" name="<?php  echo $roww['clasifiedTitle'];?>" value="<?php echo $roww['clasifiedTitle'];?>"  <?php echo (isset($_GET[$roww['clasifiedTitle']]) && $_GET[$roww['clasifiedTitle']] == $roww['clasifiedTitle']) ? 'checked' :''; ?>> <?php  echo ucwords(strtolower($roww['clasifiedTitle']));?></label></li>
           
             <?php  }
		}		?>
        </ul>
		<div id="loadMore">Load more</div>
<div id="showLess" style="display:none">Show less</div>
        <hr>
        <h3>Services</h3>
        <ul id="myList2">
                   <?php
									$p   = new _classified;
									$commservice = $p->commser(0);
		
		if($commservice){
             while ($roww = mysqli_fetch_assoc($commservice)){ ?>
			                                

 <a href="<?php //echo $BaseUrl.'/services/allads.php?catName='.$roww['clasifiedTitle'];?>"><?php //echo $roww['clasifiedTitle']?></a>
                                    

			
									
			
			
            <li><label><input type="checkbox" name="<?php echo $roww['clasifiedTitle'];?>" value="<?php echo $roww['clasifiedTitle'];?>"  <?php echo (isset($_GET[$roww['clasifiedTitle']]) && $_GET[$roww['clasifiedTitle']] == $roww['clasifiedTitle']) ? 'checked' :''; ?>> <?php  echo ucwords(strtolower($roww['clasifiedTitle']));?></label></li>
           
             <?php  }
		}		?>
        </ul>
				<div id="loadMore2">Load more</div>
<div id="showLess2" style="display:none">Show less</div>
<button class="btn" id="btnn" style="background-color:#17a3af; color:white;">SEARCH</button>
      
	  </form>
        <hr>
    </div>
</div>



<script>
	$(document).ready(function () {
    size_li = $("#myList li").size();
	//alert(size_li);
	
	
    x=10;
    $('#myList li:lt('+x+')').show();
    $('#loadMore').click(function () {
        x= (x+5 <= size_li) ? x+5 : size_li;
        $('#myList li:lt('+x+')').show();
		
		var aa= size_li-x;
		$('#showLess').show();
		//alert(aa);
		if(aa==0){
		
		$('#loadMore').hide();
	}
		
    });
    $('#showLess').click(function () {
        x=(x-5<0) ? 5 : x-5;
        $('#myList li').not(':lt('+x+')').hide();
		var aa= size_li+x;
		if(aa!=0){
		$('#loadMore').show();
	}
		
		//alert(x);
		if(x<=6){
			//alert('gggh');
		$('#showLess').hide();
		$('#loadMore').show();
	}
		
    });
});
</script>

<script>
	$(document).ready(function () {
    size_li = $("#myList2 li").size();
	//alert(size_li);
    x=10;
    $('#myList2 li:lt('+x+')').show();
    $('#loadMore2').click(function () {
        x= (x+5 <= size_li) ? x+5 : size_li;
        $('#myList2 li:lt('+x+')').show();
		$('#showLess2').show();
		var bb= size_li-x;
		
		//alert(bb);
		if(bb==0){
		
		$('#loadMore2').hide();
	}
    });
    $('#showLess2').click(function () {
        x=(x-5<0) ? 5 : x-5;
        $('#myList2 li').not(':lt('+x+')').hide();
		
		var bb= size_li+x;
		//alert(bb);
		if(bb!=0){
		$('#loadMore2').show();
	}
		//alert(x);
			if(x<=6){
			//alert('gggh');
		$('#showLess2').hide();    
		$('#loadMore2').show();   
	}
    });
});
</script>