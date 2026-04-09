<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">  
<!--This script for sticky left and right sidebar END-->
<!--CSS FOR MULTISELECTOR-->
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.inner_top_form button {
    margin-top: 5px !important;
    border-radius: 0px !important;
    padding: 11.5px 12px !important;
}
* {
    font-size: 14px;
}

    #indent{
        padding:9px;
    }
    .seemore a:hover {
        font-size: 16px;

        color: #0a0a0a;
        text-decoration: underline !important;
    }
    .carousel-control-next, .carousel-control-prev {
        position: absolute;
        top: 0;
        bottom: 0;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 5%;
        padding: 0;
        color: #fff;
        text-align: center;
        background: 0 0;
        border: 0;
        opacity: .5;
        transition: opacity .15s ease;
    }

    @media (max-width: 767px) {
        .carousel-inner .carousel-item > div {
            display: none;
        }
        .carousel-inner .carousel-item > div:first-child {
            display: block;
        }
    }

    .storHeading{
        position: relative;
        bottom: 50px;
        font-size: 26px;
        background-color: white;
        min-width: 40%;
        text-align: center;
        border-radius: 0px 14px 0px 0px;
        width: 50px;
    }

    .carousel-control-prev-icon {
       background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
   }

   .carousel-control-next-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
  }

  .rating-box {
    position: relative !important;
    vertical-align: middle !important;
    font-size: 18px;
    font-family: FontAwesome;
    display: inline-block !important;
    color: lighten(@grayLight, 25%);
/*padding-bottom: 10px;*/
}

.rating-box:before {
    content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
}

.ratings {
    position: absolute !important;
    left: 0;
    top: 0;
    white-space: nowrap !important;
    overflow: hidden !important;
    color: Gold !important;

}

.ratings:before {
    content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
}

.flag:hover {
    color: #428bca !important;
}

.storeUpdateBtn {
    position: absolute;
    top: -14px;
    right: -9px;
    background-color: #ffffff;
    border-radius: 21px;
    padding: 1px 9px;
}

.storeUpdateBtnIcn {
    font-size: 21px;
}

.storeBannerEditBtn {
    position: absolute !important;
    font-size: 26px;
    background-color: white;
    min-width: 5%;
    right: 0;
    top: 0;
    text-align: center;
    text-transform: capitalize;
    border-radius: 0px 10px 0px 13px;
}

.storeBannerEditBtnAnchor {
    background: #fff;
    padding: 0px 8px;
    border-radius: 0px 10px 0px 18px;
    color: #1c6121 !important;
    font-size: 30px;
    position: absolute;
    right: 0;
}


.zoom1:hover {
    -ms-transform: scale(1.05);
/* IE 9 */
-webkit-transform: scale(1.05);
/* Safari 3-8 */
transform: scale(1.05);
}

#profileDropDown li.active {
    background-color: #0f8f46 !important;
}

#profileDropDown li.active a {
    color: #fff !important;
}
.navbar-nav li {
    padding: 10px 5px;
}
.navbar-nav  li  a {
  padding: 10px 10px !important;
  
}
.navbar-nav  li  a:hover {
    background-color: #0f8f46 !important;
    color: #fff!important; 
    border-radius: 5px;
}
.shadow{
    border: 1px solid #ccc;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
}
.btn-store{
    background-color: var(--storeColor);
    color: white;
    padding: 8px;
}

/**** Side Bar *****/
a {
    color: var(--storeColor);
    text-decoration: none;
}
h1,
h2,
h3,
h4,
h5,
.h1,
.h2,
.h3,
.h4,
.h5 {
    line-height: 1.5;
    font-weight: 400;
    font-family: "Poppins", Arial, sans-serif;   
}
.ftco-section {
    padding: 7em 0;
}
.ftco-no-pt {
    padding-top: 0;
}
.ftco-no-pb {
    padding-bottom: 0;
}
.heading-section {
    font-size: 28px;
    color: #000;
}
.heading-section small {
    font-size: 18px;
}
.img {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}
.btn-header-search {    
    border-left: solid #959595;
}
.wrapper {
    width: 100%;
}
#leftsidebar {
    min-width: 270px;
    max-width: 270px;
    background: var(--storeColor);
    color: #fff;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
    position: relative;
    z-index: 100;
}
#leftsidebar .h6 {
    color: #fff;
}
#leftsidebar.active {
    margin-left: -270px;
}
#leftsidebar h1 {
    margin-bottom: 20px;
    font-weight: 700;
    font-size: 30px;
}
#leftsidebar h1 .logo {
    color: #fff;
}
#leftsidebar h1 .logo span {
    font-size: 14px;
    color: #44bef1;
    display: block;
}
#leftsidebar ul.components {
    padding: 0;
}
#leftsidebar ul li {
    font-size: 16px;
}
#leftsidebar ul li > ul {
    margin-left: 10px;
}
#leftsidebar ul li > ul li {
    font-size: 14px;
}
#leftsidebar ul li a {
    padding: 10px 0;
    display: block;
    color: rgba(255, 255, 255, 0.6);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}
#leftsidebar ul li a span {
    color: #44bef1;
}
#leftsidebar ul li a:hover {
    color: #fff;
}
#leftsidebar ul li.active > a {
    background: transparent;
    color: #fff;
}
@media (max-width: 991.98px) {
    #leftsidebar {
        margin-left: -270px;
    }
    #leftsidebar.active {
        margin-left: 0;
    }
}
#leftsidebar .custom-menu {
    display: inline-block;
    position: absolute;
    top: 20px;
    right: 0;
    margin-right: -20px;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
}
@media (prefers-reduced-motion: reduce) {
    #leftsidebar .custom-menu {
        -webkit-transition: none;
        -o-transition: none;
        transition: none;
    }
}
#leftsidebar .custom-menu .btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    position: relative;
}
#leftsidebar .custom-menu .btn i {
    margin-right: -40px;
    font-size: 14px;
}
#leftsidebar .custom-menu .btn.btn-primary {
    background: transparent;
    border-color: transparent;
}
#leftsidebar .custom-menu .btn.btn-primary:after {
    z-index: -1;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    content: "";
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    background: var(--storeColor);
    border-radius: 10px;
}
#leftsidebar .custom-menu .btn.btn-primary:hover,
#leftsidebar .custom-menu .btn.btn-primary:focus {
    background: transparent !important;
    border-color: transparent !important;
}
a[data-toggle="collapse"] {
    position: relative;
}

@media (max-width: 991.98px) {
    #leftsidebarCollapse span {
        display: none !important;
    }
}
#rightcontent {
    width: 100%;
    padding: 0;
    min-height: 100vh;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}
.btn.btn-primary {
    background: var(--storeColor);
    border-color: var(--storeColor);
}


.seemore a:hover {
    font-size: 16px;

    color: #2ba805;
    text-decoration: underline !important;
}

.carousel-control {
    position: absolute;
    top: 0;
    bottom: 16px !important;
    left: 0;
    width: 15%;
    font-size: 20px;
    color: #fff;
    text-align: center;
    text-shadow: 0 1px 2px rgba(0, 0, 0, .6);
    background-color: rgba(0, 0, 0, 0);
    filter: alpha(opacity=50);
    opacity: .5;
}
.rating-box {
    position: relative !important;
    vertical-align: middle !important;
    font-size: 18px;
    font-family: FontAwesome;
    display: inline-block !important;
    color: lighten(@grayLight, 25%);
    /*padding-bottom: 10px;*/
}

.rating-box:before {
    content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
}

.ratings {
    position: absolute !important;
    left: 0;
    top: 0;
    white-space: nowrap !important;
    overflow: hidden !important;
    color: Gold !important;

}

.ratings:before {
    content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
}

.flag:hover {
    color: #428bca !important;
}

.storeUpdateBtn {
    position: absolute;
    top: -14px;
    right: -9px;
    background-color: #ffffff;
    border-radius: 21px;
    padding: 1px 9px;
}

.storeUpdateBtnIcn {
    font-size: 21px;
}

.storeBannerEditBtn {
    position: relative;
    background-color: white;
    min-width: 5%;
    right: 0;
    top: 0;      
}

.storeBannerEditBtnAnchor {
    background: #fff;
    padding: 0px 8px;
    border-radius: 0px 0px 0px 15px;
    color: #1c6121 !important;
    font-size: 30px;
    position: absolute;
    right: 0;
}

#profileDropDown li.active {
    background-color: #0f8f46;

}

#profileDropDown li.active a {
    color: white;
}



.timeline-topstatus.right_sidebar {
    padding-top: 20px;
}

#slider-distance {
    width: 100% !important;
}

#profileDropDown li.active {
    background-color: #0f8f46;
}

#profileDropDown li.active a {
    color: white;
}


.zoom1:hover {
    -ms-transform: scale(1.05);
/* IE 9 */
-webkit-transform: scale(1.05);
/* Safari 3-8 */
transform: scale(1.05);
}
</style>
