
<?php 

 include('../../univ/baseurl.php');
    session_start();
	//print_r($_SESSION); die('');
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";  
	
    include_once ("../../authentication/check.php");
	//include '../../authentication/check.php';
  //print_r($_SESSION); die('1111111111');
  
 // header("$BaseUrl;/login.php");
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
//print_r($_SESSION); die('222222222222');

?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Business Account & Inventory | TheSharepage </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
   <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
   <div class="container-fluid">
      <div class="row flex-nowrap">
         <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
               <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                  <span class="fs-5 d-none d-sm-inline">Account & Inventory</span>
               </a>
               <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                  <li>
                     <a href="index.html" class="nav-link px-0 align-middle">
                        <i class="fas fa-tachometer-alt"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>                        
                     </li>
                     <li>
                        <a href="pos.php" target="_blank" rel="noopener noreferrer" class="nav-link px-0 align-middle">
                           <i class="fas fa-th"></i> <span class="ms-1 d-none d-sm-inline">POS</span> </a>                        
                        </li>                                      
                        <li>
                           <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                              <i class="fab fa-product-hunt"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                              <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                 <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Categories</span></a>
                                 </li>
                                 <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Attributes</span></a>
                                 </li>
                                 <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Brands</span></a>
                                 </li>
                                 <li>
                                    <a href="add-product.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Add Product</span></a>
                                 </li>
                                 <li>
                                    <a href="product-list.html" class="nav-link px-0"> <span class="d-none d-sm-inline">Product List</span></a>
                                 </li>
                              </ul>
                           </li>
                           <li>
                              <a href="#" class="nav-link px-0 align-middle">
                                 <i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                              </li>
                              <li>
                                 <a href="#" class="nav-link px-0 align-middle">
                                    <i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Suppliers</span> </a>
                                 </li>
                                 <li>
                                    <a href="#" class="nav-link px-0 align-middle">
                                       <i class="fas fa-store"></i> <span class="ms-1 d-none d-sm-inline">Store</span></a>
                                    </li>                      
                                 </ul>
                                 <hr>
                                 <div class="dropdown pb-4">
                                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                       <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                       <span class="d-none d-sm-inline mx-1">Jhone Dev</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                                       <li><a class="dropdown-item" href="#">Settings</a></li>
                                       <li><a class="dropdown-item" href="#">Profile</a></li>
                                       <li>
                                          <hr class="dropdown-divider">
                                       </li>
                                       <li><a class="dropdown-item" href="#">Sign out</a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="col py-3">
                              <div class="row mb-4">
                                 <div class="col-lg-12">
                                    <div class="d-flex border-primary border-top border-5 p-5 bg-light">
                                       <div><span class="border border-primary border-1 p-3 me-3 top-icon rounded"><i class="fas fa-home"></i> Home</span></div>
                                       <div><span class="border border-primary border-1 p-3 me-3 top-icon rounded"><i class="fas fa-home"></i> Store</span></div>
                                       <div><span class="border border-primary border-1 p-3 me-3 top-icon rounded"><i class="fas fa-home"></i> Add Products</span></div>
                                       <div><span class="border border-primary border-1 p-3 me-3 top-icon rounded"><i class="fas fa-home"></i> Product List</span></div>
                                       <div><span class="border border-primary border-1 p-3 me-3 top-icon rounded"><i class="fas fa-home"></i> Cartegories</span></div>
                                       <div><span class="border border-primary border-1 p-3 me-3 top-icon rounded"><i class="fas fa-home"></i> Brands</span></div>
                                       <div><span class="border border-primary border-1 p-3 me-3 top-icon rounded"><i class="fas fa-home"></i> POS</span></div>
                                       <div><span class="border border-primary border-1 p-3 me-3 top-icon rounded"><i class="fas fa-users"></i> Customers</span></div>
                                       <div><span class="border border-primary border-1 p-3 me-3 top-icon rounded"><i class="fas fa-users"></i> Suppliers</span></div>
                                    </div>                     
                                 </div>
                              </div>

                              <div class="row align-self-stretch">
                                 <div class="col-lg-8">                     
                                    <h4>Sales Chart</h4>
                                    <div class="d-flex flex-wrap border-success border-top border-5 p-5 bg-light me-3">
                                      <canvas id="myChart"></canvas>                    
                                   </div>                     
                                </div>
                                <div class="col-lg-4 top-product">
                                 <h4>Top Selling Products</h4>
                                 <div class="d-flex flex-wrap border-success border-top border-5 p-3 bg-light">
                                    <canvas id="myChart2"></canvas>
                                    <div class="d-flex align-items-start mb-4"> 
                                       <div class="aside">                          
                                          <img src="img/camera.png" class="img-sm img-fluid img-thumbnail rounded border">  <b class="badge bg-secondary rounded-pill">2</b> 
                                       </div> 
                                       <div class="info">                            
                                          <a href="#" class="title">Canon Cmera EOS, 10x zoom</a> 
                                          <div class="price text-muted">Total: $12.99</div> <!-- price .// --> 
                                       </div>                      
                                    </div>
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
                     <!------------------------------------------ Scripts Files ------------------------------------------>
                     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
                     <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
                     <script type="text/javascript" src="js/custom-chart.js"></script>
                     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>      
                     <script>
                      const myChart = new Chart(
                       document.getElementById('myChart'),
                       config1
                       );
                      const myChart2 = new Chart(
                        document.getElementById('myChart2'),
                        config2
                        );
                     </script>
                     <script type="text/javascript">
                        
/**
 * Simulate a click event.
 * @public
 * @param {Element} elem  the element to simulate a click on
 */
 function simulateClick(elem) {
   // Create our event (with options)
   var evt = new MouseEvent('click', {
      bubbles: true,
      cancelable: true,
      view: window
   });
   // If cancelled, don't dispatch our event
   var canceled = !elem.dispatchEvent(evt);
};

function prepareTabs(triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
        //alert('test-'+this.parentNode.tagName);
        tabTrigger.show()

        //console.log('>>>' + this.parentNode.tagName);
        //console.log('>>>>' + this.parentNode.parentNode.tagName);
        var sibling = this.parentNode.parentNode.firstChild;
        // Loop through each sibling and push to the array
        while (sibling) {
         if (sibling.tagName !== undefined) 
         {
                //console.log('>>>' + sibling.tagName);
                //console.log('--->' + sibling.classList);
                //console.log('>>' + sibling.firstChild.href);
                sibling.classList.remove('active');
             }
             sibling = sibling.nextSibling;
          }
          this.parentNode.classList.add('active');
          console.log('href = ' + this.href);
          simulateClick(document.querySelector(this.href));
       })
}

var triggerTabListTest = [].slice.call(document.querySelectorAll("#myTab a"));
triggerTabListTest.forEach(function (triggerEl) {
 prepareTabs(triggerEl);
});

</script>
</body>
</html>
<?php } ?>