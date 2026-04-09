<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<style>
  .header, .footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 16px;
    background-color:#fff;
  }

  .sidenav {
    display: flex; /* Will be hidden on mobile */
    flex-direction: column;
    grid-area: sidenav;
    background-color: #1758b4;
  }

  .sidenav__list {
    padding: 0;
    margin-top: 35px;
    list-style-type: none;
  }

  .sidenav__list-item {
    padding: 10px 10px 10px 20px;
    color: #ddd;
  }

  .nav-txt
  {
  	color: #fff;
  	padding: 20px 10px 10px 20px;
  }

  .sidenav__list-item:hover {
    background-color: rgba(255, 255, 255, 0.2);
    cursor: pointer;
  }


  .main-header {
    display: flex;
    justify-content: space-between;
    margin: 10px 25px;
    padding: 0px; /* Force our height since we don't have actual content yet */
    background-color: #ddd
    ;
    color: slategray;
  }

  .header__search input[type=text] {
  width: 300px;
  box-sizing: border-box;
  border: 2px solid #ddd;
  border-radius: 20px;
  font-size: 16px;
  background-color:#dee2e6;

 /* background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;*/
}

 .header__avatar .social-icon
 {
    list-style-type: none;
    display:inline-block;
    padding: 5px;
    font-size:10px; 

 }
  .social-icon .fa-facebook
  {
  	color:#3b5998; 
    padding-top: 20px;
  }
  .social-icon .fa-twitter
  {
  	color: #00acee;
  }
  .social-icon .fa-linked
  {
  	color: #0e76a8;
  }
  .social-icon .fa-google
  {
  	color: #EA4335;
  }

  
  .footers .play li
  {
    list-style-type: none;
    display:inline-block;
    font-size:30px;
    padding: 10px 10px;
    color:#1758b4
  }

  
  

   .main-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Where the magic happens */
    grid-auto-rows: 94px;
    grid-gap: 20px;
    margin: 20px;
  }
  
  .overviewcard {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    background-color: #fff;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    border-radius:8px;
  }

  .overviewcard__icon
  {
  	width: 65px;
  	height: 65px;	
  }

  .main-cards {
    column-count: 2;
    column-gap: 20px;
    margin: 20px;
  }
  .albums .card h6
  {
    font-size: 15px;
    color: #1758b4;
    padding: 4px;
  }
  .albums .card .card-body h5
  {
    font-size: 10px;
    margin: 1px 0px; 
    font-family: "lato";
  }
  .albums .card .card-body p
  {
  	font-size: 10px;
  }
  

  /*.card {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    background-color: #82bef6;
    margin-bottom: 20px;
    -webkit-column-break-inside: avoid;
    padding: 24px;
    box-sizing: border-box;
  }*/

  /* Force varying heights to simulate dynamic content */
  /*.card:first-child {
    height: 485px;
  }

  .card:nth-child(2) {
    height: 200px;
  }

  .card:nth-child(3) {
    height: 265px;
  }
*/
  .grid-container {
    display: grid;
    grid-template-columns: 1fr; /* Side nav is hidden on mobile */
    grid-template-rows: 50px 1fr 50px;
    grid-template-areas:
      'header'
      'main'
      'footer';
    height: 100vh;
  }
  
  .sidenav {
    display: none;
    grid-area: sidenav;
    background-color:#1758b4;
  }
  
  .main-cards {
    column-count: 1;
    column-gap: 20px;
    margin: 20px;
  }

  .dot {
  height: 25px;
  width: 25px;
  background-color: #bbb;
  border-radius: 50%;
  list-style-type: none;
  display:inline-block !important;
}

  .btnupload{
    border-radius: 10px;
    background: #1758b4;
    color: #ffffff;
    border: none;
    font-size: 20px;
  }
  
  /* Non-mobile styles, 750px breakpoint */
  @media only screen and (min-width: 46.875em) {
    /* Show the sidenav */
    .grid-container {
      grid-template-columns: 240px 1fr; /* Show the side nav for non-mobile screens */
      grid-template-areas:
        "sidenav header"
        "sidenav main"
        "sidenav footer";
    }

    .sidenav {
      display: flex;
      flex-direction: column;
    }
  }

  /* Medium-sized screen breakpoint (tablet, 1050px) */
  @media only screen and (min-width: 65.625em) {
    /* Break out main cards into two columns */
    .main-cards {
      column-count: 2;
    }
  }


  .menu-icon {
  position: fixed;
  display: flex;
  top: 5px;
  left: 10px;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  z-index: 1;
  cursor: pointer;
  padding: 12px;
  background-color: #DADAE3;
}

/* Make room for the menu icon on mobile */
.header__search {
  margin-left: 42px;
}

/* Mobile-first side nav styles */
.sidenav {
  grid-area: sidenav;
  display: flex;
  flex-direction: column;
  height: 105%;
  width: 240px;
  position: fixed;
  overflow-y: auto;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0 0 1px rgba(0, 0, 0, 0.08);
  z-index: 2; /* Needs to sit above the hamburger menu icon */
  background-color:#1758b4;
  transform: translateX(-245px);
  transition: all .6s ease-in-out;
  overflow: hidden;
}

/* The active class is toggled on hamburger and close icon clicks */
.sidenav.active {
  transform: translateX(0);
}

/* Only visible on mobile screens */
.sidenav__close-icon {
  position: absolute;
  visibility: visible;
  top: 8px;
  right: 12px;
  cursor: pointer;
  font-size: 20px;
  color: #ddd;
}

/* Non-mobile styles for side nav responsiveness, 750px breakpoint */
@media only screen and (min-width: 46.875em) {
  .sidenav {
    position: relative; /* Fixed position on mobile */
    transform: translateX(0);
  }

  .sidenav__close-icon {
    visibility: hidden;
  }
}

</style>