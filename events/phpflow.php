<html lang="en-US">
    
    <head>

    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

       
        
    </head>    
<body class="bg_gray">

  <section class="main_box">            
            <div class="container">
                    

                <div class="row">


                    <div class="col-sm-12">
                    <div class="bg_white detailEvent m_top_10">

      

                 <div class="row">
                     <div class="showeventrating">

                        <div style="text-align: -webkit-center;  padding-bottom: 60px; padding-top: 12px;">


                            <img src="<?php echo $BaseUrl;?>/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 70px;"><p style="font-size: 30px;">The SharePage</p></div>



                 <div style="position: absolute; top: 150px; right: 52px;"><p style="font-size: 23px; padding-left: 3px;"> Booked on</p></div>

<div class="row">
<div class="col-md-6">                                 
 <table class="table" id="Eventtableid">
   
    <tbody>
      <tr>
        <td class="pdftablehead">Posted BY</td>
        <td>Doe</td>
        
      </tr>
      <tr>
        <td class="pdftablehead">Event Title</td>
        <td>Moe</td>
      
      </tr>
      <tr>
        <td class="pdftablehead">Event Venue</td>
        <td>Dooley</td>
        
      </tr>
    </tbody>
  </table>

  </div>
  <div class="col-md-6">
      <table class="table">
   
    <tbody>
      <tr>
        <td class="pdftablehead">Quantity</td>
        <td>Doe</td>
        
      </tr>
      <tr>
        <td class="pdftablehead">Tickets Price(Each Person)</td>
        <td>Moe</td>
      
      </tr>
      <tr>
        <td class="pdftablehead">Total Price</td>
        <td>Dooley</td>
        
      </tr>
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
                               
</section>

 <script type="text/javascript">
            
            

        $("#btnPDF").on("click", function () {



           
            alert();
            html2canvas($('#Eventtableid')[0], {

                onrendered: function (canvas) {

                    // alert();
                    //$(".showdiv").show();
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{

                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            });
        });
</script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
</body>
</html>