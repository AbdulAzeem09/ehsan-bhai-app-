<html>
   <head>
   </head>
   <body>
      <?php
         $id= $_GET['id'];
         
         if(isset($_GET['action']) && $_GET['action']=='newsletter')
         {
         $newsresult = selectQ("select * from spnewsletter_template where id=$id","s","");
         $result=$newsresult[0];
         ?>
      <div class="row">
         <div class="col-md-2"></div>
         <div class="col-md-8">
            <div class="card">
               <div class="row">
                  <div class="col-md-12">
                     <?php
                        echo $result['newsletter_content'];
                        ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-2"></div>
      </div>
      <?php
         }
         else{
         
          
         
         $result = selectQ("select * from sentnewslteller_history where id=$id","s","");
         $result=$result[0];
         ?>
      <div class="row">
         <div class="col-md-2"></div>
         <div class="col-md-8">
            <div class="card">
               <div class="row " style="color:white;background-color:black; height:70px;margin-top:10px;text-align:center">
                  <div class="col-md-12">
                     <h2><?php  echo $result['newsletter_name']; ?></h2>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <?php
                        echo $result['newslettercontent'];
                        ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-2"></div>
      </div>
      <?php  } ?>
   </body>
</html>