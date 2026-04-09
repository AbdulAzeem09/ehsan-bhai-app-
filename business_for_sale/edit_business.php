<?php

/*error_reporting(E_ALL);
ini_set('display_errors', '1');
*/
?>
<?php
include('../univ/baseurl.php');
include('../univ/main.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "job-board/";
include_once("../authentication/check.php");
} else {

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
require_once('../stripe-php/encry_decrypt.php');

$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {
$ruser = mysqli_fetch_assoc($res);
$usercountry = $ruser["spUserCountry"];
$userstate = $ruser["spUserState"];
$usercity = $ruser["spUserCity"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../component/f_links.php'); ?>
<?php include('../component/links.php'); ?>

<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>:: The SharePage - The SharePage ::</title>

<!--  Favicon 
<link rel="shortcut icon" href="images/favicon.png">

<!-- CSS -->
<link rel="stylesheet" href="css/stylesheet.css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/paymentjs1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>
<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">

<script>
Stripe.setPublishableKey('<?php echo PUBLIC_KEY ?>');
</script>
<style>
.chosen-container-single .chosen-single {
height: 30px !important;
line-height: 32px !important;
}

.fontuser i {
position: absolute;
left: 90%;
top: 6px;
color: gray;
}

.header_mg {
margin-left: 150px !important;
}

@media screen and (max-width: 600px) {
.custom-pr {
padding-right: 15px;
}

.custom-pl {
padding-left: 15px;
}

.header_mg {
margin-left: 0px !important;
}
}

.chosen-container {
margin: 10px !important;
}

.fontuser {
position: relative;
}



.category {
position: relative;
}

.zoom1:hover {
-ms-transform: scale(1.05);
/* IE 9 */
-webkit-transform: scale(1.05);
/* Safari 3-8 */
transform: scale(1.05);
}

.category img {
position: absolute;
left: 90%;
top: 20px;

}

input[type=text] {
height: 34px;
}


.row {
margin-right: 0px;
}

@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Roboto+Slab:wght@400;700&display=swap');

#svg_form_time {
height: 15px;
max-width: 80%;
margin: 40px auto 20px;
display: block;
}

#svg_form_time circle,
#svg_form_time rect {
fill: white;
}

section {
padding: 50px;
max-width: 500px;
margin: 30px auto;
background: white;
background: rgba(255, 255, 255, 0.9);
backdrop-filter: blur(10px);
box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.3);
border-radius: 5px;
transition: transform 0.2s ease-in-out;
}

.button {
/*background: #7DBA41;*/
border-radius: 5px;
padding: 15px 25px;
display: inline-block;
margin: 10px;
font-weight: bold;
color: white;
cursor: pointer;
box-shadow: 0px 2px 5px rgb(0, 0, 0, 0.5);
border-radius: 30px;
}

.disabled {
display: none;
}

input {
width: 100%;
margin: 7px 0px;
display: inline-block;
padding: 12px 25px;
box-sizing: border-box;
border-radius: 5px;
border: 1px solid lightgrey;
font-size: 1em;
font-family: inherit;
background: white;
}

body {

line-height: 17px;

}

html {
height: 100%;
min-height: 800px;
}

.price {
list-style-type: none;
border: 1px solid #eee;
margin: 0;
padding: 0;
-webkit-transition: 0.3s;
transition: 0.3s;
}

.price .header {
background-color: #7DBA41;
color: white;
font-size: 25px;
}

.price li {
border-bottom: 1px solid #eee;
padding: 20px;
text-align: center;
}

.price .grey {
background-color: #eee;
font-size: 38px;
}

.row .price-cls {
padding-left: unset;
padding-right: unset;
border: 1px solid #c3c0c0;
}

.dropzone width: 98% margin: 1% border: 2px dashed #3498db !important border-radius: 5px transition: .2s .dropzone.dz-drag-hover border: 2px solid #3498db !important .dz-message.needsclick img width: 50px display: block margin: auto opacity: .6 margin-bottom: 15px span.plus display: none .dropzone.dz-started .dz-message display: inline-block !important width: 120px float: right border: 1px solid rgba(238, 238, 238, 0.36) border-radius: 30px height: 120px margin: 16px transition: .2s span.text display: none span.plus display: block font-size: 70px color: #AAA line-height: 110px .amex {
background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAeCAMAAABdem3zAAAAA3NCSVQICAjb4U/gAAACi1BMVEUAAAAAAAAAdKIAdqcGdqoDeqkDeKoDe6sFeqoFeqwCeqoGe6wGeasGeqwGe6wFeqwFeqwFeqsGe6oFeawEeqwEeqwFe6wHeaoFe6oFeasFe6wFeawHe6wIfKwJfKwKfa0Lfa0Mfq0Of64Pf64QgK8RgK8Sga8TgbAUgrAVgrAWg7EXg7EYhLEZhLIahbIbhbIdhrMfh7QgiLQhiLQjirUkirUli7YnjLYojLcqjbcsj7gtj7kukLkvkLkwkbkxkboykrozkro0k7s1k7s2lLs3lLw4lbw5lbw6lr07lr08l709l75Amb9Bmr9Dm8BFnMBHncFIncFJnsJKnsJLn8JMn8NNoMNOocRPocRQosRRosVUpMZVpMZWpcZXpcdYpsdZp8dap8dbqMheqclgqslhq8pjrMpkrMtnrsxpr8xqr81tsc5vss5wss9xs89ztNB0tdB1ttF6uNJ8udN9utN+utR/u9SAu9SBvNWCvNWDvdWEvdWGvtaHv9aIv9eKwNeMwdiPw9mQw9mRxNqTxdqUxtuVx9uWx9yXyNyYyNyZyd2ayd2byt2cyt6dy96fzN+gzN+hzd+izeCjzuCkzuCn0OGp0eKq0eKr0uOs0+Ot0+Ov1OSw1eSy1uWz1uW01+W32Oa62ui72+i82+i+3Om/3enC3urE3+vF4OvH4ezI4uzJ4u3K4+3L4+3N5O7O5e7P5e/R5u/S5/DT5/DV6PHW6fHX6fHY6vHa6/Lb7PPc7PPd7fPe7fTf7vTg7vTi7/Xj8PXk8fbm8vbn8vfo8/fp8/fq9Pjr9Pjs9fjt9fnu9vnv9vnw9/rx9/ry+Prz+Pv0+fv1+fv2+vz4+/z5+/37/P38/f7+/v7///+B6xdgAAAAHHRSTlMAARYaJ0FIT1pcYG6YmZyssrPDys3T2tvt9PX+1nJQbwAAAnFJREFUOMtjYOAWESMWiAqwMzBwyZAEOBn4SdMgzCBImgYJUjVI0UeDkoGBrq6BgZ6MhgECqAA56nJ6ICZIWN3AQAeuoevIrvOHDuy6ZLl1366ru3ft2nVl167dJ08cOXHo/P6Dl3Yd33Nm15mdJw+thGnQO2ei2nzDRaZp405Zmd2KxhYWW2TMTeUmJOWv0NOPKVJ1uNEi4329LByuoXKaabvZNZcQw8u5IUANrYuX7pA5eNSxJCk/OPfGBe2ZKotbnAw6kTSs8Axslpnh0mtRr74YqME7LGaHjI6G4uakfOfGG21q3c5hLf7TNDMQGhqUMjN9vFz6O2TCjgA11M+Zs13m4oXIvKT8bOs+i7DMNJks/xuhcggNKQ3b+vfGpS65kLTqVNyRpLi4uP1xl6d09jRPPF+blHC29WB+SsX5PXF1cA0lE/1lWiZOnFg2saZrIgxkgojiyr6JZTLxQFZ5ycSJpRTHdOAmMMiM2Agk103esGnTxiWzwELTVwOJyes29aFqiFtrCQR+x05FuVpaWqcfA3I8FlQDyandjpaWh5KtLI3RNCxTA8ZypHewb7vNrvWKk2QW7wiIzU3YteusXtXWrQvllm+diK5BRl6+4JyW2omJ2qkRiqtknN2VF+UCxWbmKCi5b3GU1fRE16B+4cK5RCe3pH6z6bP3nZOZsyYoMzftwsWrp4+skZt/4kA1mqfjVqgAgcORw/Z23kejg86r7JxXm1AIFOqzVdFLAEoahaNqiDgMBplZQGKNjC6QbD0MA3vmAomN5XTLcaQASQZe0jSIM3CQpoGPgZFHmgT1QkwMDAzMrOxEAjYWBgYAvI9h1MHdhQIAAAAASUVORK5CYII=") #fff;
}

.visa {
background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAeCAMAAABdem3zAAAAA3NCSVQICAjb4U/gAAABvFBMVEUAAADQ0NDa2tra2trZ2dnY2Nja2trt7e3t7e0mM3onNHspNXkqN30rN30sOH4tN3ovO4AwPIAyPoE1QYM3Q4Q4Q4U4RIU5RYY8R4g9SIhCTYtDToxGUY5HUo5JU49JVJBOWJJQW5RSXJVTXZZVX5dXYZhYYplaY5pfaJ1kbaBlbqFoaZFocaNpcqNqc6RtdqZvd6dzcpV0fKp2f6x5ga18g698hK99hK99hbB+hrCAh7GDi7OHjrWIj7aJkLeNk7mNlLqOlbqRl7yUmr6WnL6YnsCbocKepMSjqMekqceprsqrsMysscytss2uss2xts+xttC0uNG1udK1utK2utK3u9O6vdS7v9W8wNa9wda9wdfBxNnDx9rEx9vFyNzFydvHy93Kzd/Mz+DR0+LS1OPT1uTVnV/V1+XX2ebY2NjZuJbZ2+faoVza3Ojc3+rf4evf4ezi5O7j5e7n6fHp6/Lq6/Lr7PPsmC3snTfs7fPunjnu7/Tu7/Xw8fbx8vfy8/f09fj09fn19vn29/r3z5332LH39/r42LD42bL42bP5+fv76tX77dz7+/v7+/387dv9/f7+9ev//v3///9+dhG/AAAACXRSTlMAGxuq7e7u+vsOT6YMAAABbklEQVQ4y+WUV1cTYRQAlwSIsxoLltgLKgZ7AwV777FiL9gT1x4FGxpb0Gg0On/YBx83D+wz8z7nu+fe800QpNKtpTHSmk4FQUt7pu4YqWfaW4L0BBOQSQdt9SRCvS0omYjSOBZ+fB0d/f5T/VQoDHi6cF4b1/Zt6d9fUZ+cLFyMvfDny6vhN3/1EOwegW4/LAHgpb6bBpNr8ZE2PBz+rQvIvrgJ2+2DdaeOba7pXoBbceHAxHvfHIRNHoHjLobLqlZnkIeDcaHIlAeuh6Jb4bb9EG58rh6G4nTWNNnSHFYNZcnrcsKK1d4Qpl63MY9lrmRmE6GHcCdc0Q7mqt5ZAfM9C7uKvfA0LlyASSzUt7Daz+pIyGw7+c+JuPAxCxzV+7DHrq5tOzqhbxA6crlcSE+TS+dhVk0vwRk7AFhb64a76lIWva7EhKEoKqvvo6jqs6sD526UNYoeq5ajR78a4/k/JM5M4pAlTGUqSBrjf5znrWNE0ZcCAAAAAElFTkSuQmCC") #fff;
}

.mastercard {
background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAeCAMAAABdem3zAAAAA3NCSVQICAjb4U/gAAACc1BMVEUAAADQ0NDa2tra2trZ2dnY2Nja2trt7e3t7e3MAADMAQHMBATNCQnOCwvODAzODg7PDwnPERHRGxvSFgfSHh7SHx/SIB7THhDTJCTTJibTJyfUKSnVIAXVLS3VMDDWMjLWNTXWNjbXIQDXLyLXNS7XNzfXOzvYLxbYPT3YPj7Y2NjZOy/ZRUXaSEjaSUnbLQDbLgDbS0vbTU3cSj/cU1PdNADdSjTdVVXdVlbeNwDeW1vfYmLgUDPgZWXgZmbgaGjhXkvhamrhbW3ia2Lib2/jXDfja1njdXXkeHjkeXnke3vlgIDlgYHmg4PmhITmhobnh4fniIjni4voVgDojIzokJDqXADqaiTqlpbqmJjqmZnqmprrnJzrn5/tpqbuqqrura3urq7vsbHvsrLvs7PwbADwbQDwtLTwtbXwt7fxvLzycgDyjULyvr7yv7/zdQDzmVvzn2fzxMTzxcXzx8f2fwD21tb3gQD3x6/3ybL32Nj4hAD43t7439/44OD5iQD54eH54uL65ub65+f76+v7+/v88vL89PT99/f9+Pj9+fn+lwD+/f3/mQD/mgT/nQv/nw//oRT/oRX/oRb/ohj/qCf/qSn/qSr/qy3/rDH/rjX/rjb/sT7/sj//s0L/tEX/tUf/tUj/tkn/t0v/uVD/uVH/u1X/vFj/vVr/vl7/v2H/w2n/xGz/x3P/yHb/yXr/zob/z4j/0Iv/1Zj/1pr/153/2J7/26X/3q7/4LL/4LP/4bX/4bb/5cD/5sL/58P/58T/58X/6sz/7NH/7dL/8d7/8t//9OX/9eb/9ef/9ur/9+v/+vT/+/X//Pj//fz///90HdR0AAAACXRSTlMAGxuq7e7u+vsOT6YMAAABmElEQVQ4y2NgYGJm0SISsDAzMTAwsrG3XiAStLKzMTIwc1wgAbAzM7C2kqKhlZVB6wJJQItSDS3R5orSmo7pPUD2+d2r506bvWzLKdwaOr14OSFAMuXCzqm9ENC//hwODc2KnHDAVdCLALNOYNXQLo9QzylgGoykY+YZbBqckNSrpKamdSPpWINFQw03kgZhJSUlSyQNfUcxNfjzyfFISUDUi5WCQO+EOZOgGmZswNSgY3VBpyPOxJZf1d4uWdxZW9k45+SBtStWTVowffH8o/MxNUgHNsY0entmxrW5R6VnhNb6NlVu6p247uCOs3sOH941DYuG9MTa3JCiGp+S+CzdrrziBOuK5b1L9x8/tG3vko0bsWjQafCKaIhNqon0qyvzqApyKZMtPLZl8/bTR1Zv3Xd6JRYnBeiJChkJGqppWIgoKKi7mTnIVC9YPHnhnHlTJiyaM3EDgWANz87OLicQrCgRx6VvYJBPIOJQk4ZNWD3BpIGS+DhdCSc+0pM3JAOpkpCBaJOnSS5mSC7ISCwqgYUriYUxAINRRW57ksG5AAAAAElFTkSuQmCC") #fff;
}

.discover {
background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAeCAMAAABdem3zAAAAA3NCSVQICAjb4U/gAAACLlBMVEUAAADQ0NDa2tra2trZ2dnY2Nja2trt7e3t7e3vzbDvzbEBAQECAgIDAwMTExMUFBQWFhYYGBgZGRkeHh4jIyMmJiYnJycpKSksLCwtLS0uLi4wMDAzMzM0NDQ3Nzc6Ojo8PDw/Pz9CQkJDQ0NHR0dJSUlKSkpMTExOTk5PT09RUVFWVlZYWFhcXFxgYGBiYmJjY2Nra2tsbGxtbW1wcHBxcXF0dHR1dXV2dnZ3d3d4eHh8fHx9fX1+fn6AgICBgYGCgoKDg4OLi4uMjIyPj4+VlZWWlpabm5udnZ2enp6fn5+hoaGjo6OoqKirq6usrKyvr6+wsLCysrKzs7O4uLi7u7u8vLy9vb2/v7/AwMDBwcHExMTGxsbHx8fJycnLy8vQ0NDR0dHS0tLU1NTW1tbY2NjZ2dnb29vd3d3f39/h4eHi4uLn5+fo6Ojp6enr6+vs7Ozt7e3v7+/x8fHy8vL1giD1giH1gyP1hCT1iS31ii71izD1jDL2kTv2kjz2kz/2lED2lkP2lkT2l0X2mUn2pmH2pmL3m033n1X3oVf3pF73pV739/f4q2n4q2r4rWz4r3D4r3H4sXT4s3f5uoT5u4b5vov5+fn6xJb6yJ36yqD6zKT6+vr7zqj70a372Ln7+/v83sT838b84Mj84sv848785M/85dD89O78/Pz959X96Nb969z9/f3+8+r+9e7+9u/+9/H++PP++vb++vf+/Pn+/Pr+/fz+/v7////OeAUcAAAAC3RSTlMAGxuq7e7u+vv7+w/+RoMAAAGnSURBVDjLY2BgYmZJJRKwMDMxMDCysS/YSSRYwM7GyMDMsZMEwM7MwLqAFA0LWBlSd5IEUumkwc7A0HPBTuvcTAN13535FuqWJTsXdrdP2+IZuHOnR6iNgYHVDgMDsySEBin3QE2NnWJpKk6x8T1iDsku6UvKSktL+4Kld84RzBb3Co9ZyRPnJYikIXHnAr5ssTR9hYCVIfIg8UmlILBCOMFfa6e4jWvQWh5/e0kUDTuFMsTSpvvI6gUog8QngzVsdDRVC9spbu7st5bbmL8ASUNEipEi0ElRRQEyhYL+K/2Tl5cD1U/cmSMgsXOneHRe3krenSpuCA26ckp2xTu1s2xFZSJ3JqiJqKbvXNrbOWPrzp0m3jt36sjJyS2Q35ms0rNz53wSg3VRI2kaVlc1kKRhVU0pSRoWVZaSpGF2RSkpGjZNAMcM0RoW15aSomE9JOKJ1bB1VnUpCRq2z6srLSVew+ZZyMoJalgzpbq0lGgNG+Z2lGKAplQcxcy6uV3lpVhAKyuWgmzLwqktpTgAJzNaUblt2cz+xnocoLmNiw1YuJJYGAMAEKBGzN/0FVAAAAAASUVORK5CYII=") #fff;
}

.expiry-date-group {
float: left;
width: 50%
}

.expiry-date-group input {
width: calc(100% + 1px);
border-top-right-radius: 0;
border-bottom-right-radius: 0;
}

.expiry-date-group input:focus {
position: relative;
z-index: 10;
}

.security-code-group {
float: right;
width: 50%
}

.security-code-group input {
border-top-left-radius: 0;
border-bottom-left-radius: 0;
}

.zip-code-group {
clear: both;
}

#PayButton {
outline: 0 !important;
height: 42px;
font-size: 16px;
background-color: #54C7C3 !important;
border: none;
}

#PayButton:hover {
background-color: #6DCECB !important;
}

#PayButton:active {
background-color: #4FBCB9 !important;
}

#PayButton:disabled {
background: rgba(84, 199, 195, .5) !important;
color: #FFF !important;
}

#Checkout {
z-index: 100001;
background: ;

min-width: 300px;
height: 100%;
min-height: 100%;
background: 0 0 #ffffff;
border-radius: 8px;
border: 1px solid #dedede;
margin-left: auto;
margin-right: auto;
display: block;
}

#Checkout>h1 {
margin: 0;
padding: 20px;
text-align: center;
background: #EEF2F4;
color: #5D6F78;
font-size: 24px;
font-weight: 300;
border-bottom: 1px solid #DEDEDE;
border-top-left-radius: 8px;
border-top-right-radius: 8px;
}

#Checkout>form {
margin: 0 25px 25px;
}

label {
color: #46545C;
margin-bottom: 2px;
}

.input-container {
position: relative;
}

.input-container input {
padding-right: 25px;
}

.input-container>i,
a[role="button"] {
color: #d3d3d3;
width: 25px;
height: 30px;
line-height: 30px;
font-size: 16px;
position: absolute;
top: 2px;
right: 2px;
cursor: pointer;
text-align: center;
}

.input-container>i:hover,
a[role="button"]:hover {
color: #777;
}

.amount-placeholder {
font-size: 20px;
height: 34px;
}

.amount-placeholder>button {
float: right;
width: 60px;
}

.amount-placeholder>span {
line-height: 34px;
}

.card-row {
text-align: center;
margin: 20px 25px 10px;
}

.card-row span {
width: 48px;
height: 30px;
margin-right: 3px;
background-repeat: no-repeat;
display: inline-block;
background-size: contain;
}

.card-image {
background-repeat: no-repeat;
padding-right: 50px;
background-position: right 2px center;
background-size: auto 90%
}

.cvc-preview-container {
overflow: hidden;
}

.cvc-preview-container.two-card div {
width: 48%;
height: 80px;
}

.cvc-preview-container.two-card div.amex-cvc-preview {
float: right;
}

.cvc-preview-container.two-card div.visa-mc-dis-cvc-preview {
float: left;
}

.cvc-preview-container div {
height: 160px;
}

.amex-cvc-preview {
background: url("data:image/png;base64,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") center center/contain no-repeat;
}

.visa-mc-dis-cvc-preview {
background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOYAAACOCAMAAAASE4S+AAAAAXNSR0IArs4c6QAAAadQTFRFAAAAzbFj+NyAyLNg+N2DzbRk+96CzrVj+96AzrNj+92By7Rl+92AzbRl/eCDzrRl/t+DzrVl/t+CzbVm/t+C3MFt3MFv/N2B/N6CzrRm/uCDzrRm/uCC7M93/N6CAAAAAQEBAgIBBAQCBQUDBwcECQgFDAsGDg0HEA4IEQ8JFRMLFxUMIBwQIR0RJSETKyYWLikYLyoYMCsZMSsZNC4bNzEcOTIdQDkhQTkhQzsiRT0jRj4kSkEmTEMnWE4tWU8uWk8uXFEvXVIwXlMwX1QxaV02bWA4bmE5cWQ6eGo+eWs+fW5Afm9Bi3pHjHtIkH9KmIZOmYdPnIlQnYpRo5BUppJVqJRWqpZXq5dYrJdYrZhZuaNfvaZhvqdiwKljwapjxK1lybFnyrJoy7NozrVm1Ltq171u2L5v2b9s2b9t2sBt3cNy3zEx3zIx38Rz4MVz4cZ04kI552NI6GVJ6Mx36s5368957dF674xb79J78NN78dV78tV789Z99Nd99dh+9rZv9th+9tl+99l/+duA+sx5+sx6+t2B+92B/N6B/d+C/uCD////AikOogAAAB90Uk5TACQkJSU9PT4+Q0NERJqav7/AwNjY4uLi4u7u8/P6+u6knPAAAAJkSURBVHja7d3pTxNBGMfxQbwAW06Pcj0tntQT8b7v+0JFxaserQcuKlQUFbFUaqvjH+1uG0lMfEETie4z39+bJ/tik/1kjt3MbDLGBFkWbeu0CtPZFq03v7KwxSpO04KKcmm7VZ32xeW2VK70nUF7tlj1afJnH+tA6k3UBWbUrHKBudJ0u8DsNtaJwIQJEyZMmDBhwoQJEyZMmPPCFCcCEyZMmDBhwoQJEyZMmDBhwoQJEyZMmDBhwoQJ010m+5swYcKECRMmTJgwYcKECRMmTJgwYcIMFfPHP8/vz5PLjnpzzmg2F07mxIhXVUYmwsjMVan0nbkQMrOeN1aY+zAsjHleNoRMf1x+rWa6KfjjM4RMvxdWN63+4QaYMGHC/EvM6b0HgpI6tvtoyq9vz+4/clcf89sJ2eiXIZGEyJD9sEl6RAa1MVPbpczsk8vT52SHHZCDUxelXxtzW/x4wPx+6cxn+0A2208PX9pB2aONef7xk3JrBjkth4Jysnf9fX1T0Czzmqx+6pcvcel/pJd5RRLXg1p6d0vWvdHKHJCeG2XljLVb5aZS5r2E3A6uTiUu2Km1klLK3CXxZDK5xd6RNYd3St+MTuaryr94G6y92iuy77X+b9rSi/d8usOEyZIXC5gsR7O5MN9bRexvwoQJEyZMmDBhwoQJEyZMmDBhwoT5vzNLLihLJu8CM2+6XGB2meUuMFeYyEf9ysmIqcsUtSuLmQZjGp8pdxafNxtjamIZ1f12MhOrDQ6uXhRLD4/nVb4/S/nx4XRsSeUY8prGtOI0186eKl8Xae3QSOxojTSUgT8BEvkXyqDHONgAAAAASUVORK5CYII=") center center/contain no-repeat;
}

.submit-button-lock {
height: 20px;
margin-top: -2px;
margin-right: 7px;
vertical-align: middle;
background: url("data:image/png;base64,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NQxdFfpzGC4sNKwm7Hm4VXh+eHcELWJFREPEu0iPyNLIR4uNFksWd0bJR8VF1UdNRXtFl0VLl1gsWbPkRoxajCCmPRYfGxV7JHZyqffS3UuH4+ziCuPuLjNclrPs2nK15anLz66QX8FZcSoeGx8d3xD/iRPCqeVMrvRfuXflBNeTu4f7kufGK+eN8V34ZfyRBJeEsoTRRJfEXYljSa5JFUnjAk9BteB1sl/ygeSplJCUoykzqdGpzWmEtPi000IlYYqwK10zPSe9L8M0ozBDuspp1e5VE6JA0ZFMKHNZZruYjv5M9UiMJJslg1kLs2qy3mdHZZ/KUcwR5vTkmuRuyx3J88n7fjVmNXd1Z752/ob8wTXuaw6thdauXNu5Tnddwbrh9b7rj20gbUjZ8MtGy41lG99uit7UUaBRsL5gaLPv5sZCuUJR4b0tzlsObMVsFWzt3WazrWrblyJe0fViy+KK4k8l3JLr31l9V/ndzPaE7b2l9qX7d+B2CHfc3em681iZYlle2dCu4F2t5czyovK3u1fsvlZhW3FgD2mPZI+0MqiyvUqvakfVp+qk6oEaj5rmvep7t+2d2sfb17/fbX/TAY0DxQc+HhQcvH/I91BrrUFtxWHc4azDz+ui6rq/Z39ff0TtSPGRz0eFR6XHwo911TvU1zeoN5Q2wo2SxrHjccdv/eD1Q3sTq+lQM6O5+AQ4ITnx4sf4H++eDDzZeYp9qukn/Z/2ttBailqh1tzWibakNml7THvf6YDTnR3OHS0/m/989Iz2mZqzymdLz5HOFZybOZ93fvJCxoXxi4kXhzpXdD66tOTSna6wrt7LgZevXvG5cqnbvfv8VZerZ645XTt9nX297Yb9jdYeu56WX+x+aem172296XCz/ZbjrY6+BX3n+l37L972un3ljv+dGwOLBvruLr57/17cPel93v3RB6kPXj/Mejj9aP1j7OOiJwpPKp6qP6391fjXZqm99Oyg12DPs4hnj4a4Qy//lfmvT8MFz6nPK0a0RupHrUfPjPmM3Xqx9MXwy4yX0+OFvyn+tveV0auffnf7vWdiycTwa9HrmT9K3qi+OfrW9m3nZOjk03dp76anit6rvj/2gf2h+2P0x5Hp7E/4T5WfjT93fAn88ngmbWbm3/eE8/syOll+AAAAYFBMVEUAAAD///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////98JRy6AAAAH3RSTlMAAgYMEyIzOUpTVFViY3N2gJmcnaipq7fX3ebx+Pn8eTEuDQAAAI9JREFUKM/N0UkOglAQRdFHDyK90n64+9+lAyQgookjuaNKTlJJpaQlO2n6sW8SW/uCjrku2EloWDLhi3gDa4O3pTtA5Tt+BXDbiDsBmSQpAyZ3pRhoLUmS1QLxSilQPOcCSFfKgfxgPgfZ9ch7Y21LCcdd5wVH5SckEzkXc0ylpPJnMpETmX/d9eUpH1/5AKrsQVrz7YPBAAAAAElFTkSuQmCC") center center/contain no-repeat;
width: 14px;
display: inline-block;
}

.align-middle {
vertical-align: middle;
}

input {
box-shadow: none !important;
}

input:focus {
border-color: #b0e5e3 !important;
background-color: #EEF9F9 !important;
}

.payment-options-cls {
margin-top: 20px;
}

.checkboxes label:before {
display: none;
}

.checkboxes input {
height: 15px;
}

input.button {
background: #7dba41;
border-radius: 5px;
padding: 0px 25px;
display: inline-block;
margin: 10px;
font-weight: bold;
color: #fff;
cursor: pointer;
box-shadow: 0px 2px 5px rgb(0 0 0 / 50%);
border-radius: 30px;
}

.price .grey {
background-color: #eee;
font-size: 21px;
}

.price .header {

font-size: 21px;
}
</style>
</head>

<body>

<?php include_once("../header.php"); ?>

<?php

$sa = new _businessrating;

$sal = $sa->read_duration();
//print_r($sal);
if ($sal != false) {
$row = mysqli_fetch_assoc($sal);
//print_r($row);

}
?>
<?php
$postid = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
$sa = new _businessrating;
$sal = $sa->read_id_business($postid);
//print_r($sal);
$i = 1;
if ($sal != false) {
$row = mysqli_fetch_assoc($sal);
//print_r($row);
$headline = $row['listing_headline'];
}
?>

<div class="clearfix" style="color: white;"></div>

<!-- Banner -->
<div class="row" style="background-color: white;height: 2px;">

<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Titlebar -->
<div class="parallax titlebar" data-background="images/business.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.8" data-img-width="800" data-img-height="505">
<div id="titlebar">
<div class="container">
<div class="row">
<div class="col-md-12" style="text-align: left;">
<h2>Edit Business Form</h2>
<!-- Breadcrumbs -->
<nav id="breadcrumbs">
<ul>
<li><a href="index.php?page=1">Home</a></li>
<li><?php echo $headline; ?>
</li>
</ul>
</nav>
</div>
</div>
</div>
</div>
</div>

<!-- Content -->
<div class="container" style="background: linear-gradient(to bottom, #7dba41 0%, #468e4f 100%);" data-color-opacity="0.72">

<div class="row">

<div id="svg_wrap"></div>


<h1 style="color: white;text-align: center;">Edit Business Detail</h1>

<?php
if ($_GET['draft'] == 1) {
?>
<form action="update_business.php?draft=1&postid=<?php echo $postid; ?>" method="post" novalidate enctype="multipart/form-data" id="paymentForm">
<?php } else { ?>
<form action="update_business.php?postid=<?php echo $postid; ?>" method="post" novalidate enctype="multipart/form-data" id="paymentForm">
<?php } ?>

<section>
<p>Business Type&nbsp;&nbsp;<span style="color:red;" id="b_type">*</span></p>
<select class="select-single-item" name="Type" id="type">
<option>Select type</option>
<option value="1" name="franchise" <?php if ($row['business_type'] == 1) {
echo 'selected';
} ?>>Franchise</option>
<option value="2" name="sale" <?php if ($row['business_type'] == 2) {
echo 'selected';
} ?>>Independent sale</option>
</select>

</section>

<section>
<p>Business Detail</p>
<!-- <h5>Status of the business  </h5> 
<select class="select-single-item" name="Status" >
<option>Select Status</option>
<option value="1" name="for_sale" <?php if ($row['business_status'] == 1) {
echo 'selected';
} ?>>For sale</option>
<option value="2" name="under_offer" <?php if ($row['business_status'] == 2) {
echo 'selected';
} ?>>under offer</option>
<option value="3" name="sold" <?php if ($row['business_status'] == 3) {
echo 'selected';
} ?>>sold</option>
</select>-->
<label for="">Select Category <span style="color:red" id="category">*</span></label>
<select class="select-single-item" name="category" id="cat">

<option value="0">Select category </option>
<?php $m = new _subcategory;

$result = $m->read22();
$jobType=$row['business_category'];
/*echo $m->ta->sql;*/
if($result){
while($rows = mysqli_fetch_assoc($result)){ ?>
<option value='<?php echo $rows["idmasterDetails"]; ?>' <?php if(isset($jobType)){
if($jobType == $rows['idmasterDetails']){echo "selected";}}?>><?php echo ucwords(strtolower($rows["masterDetails"])); ?></option>
<?php
}
}
?>
<!-- <option value="1" name="manufacturing" <?php if ($row['business_category'] == 1) {
echo 'selected';
} ?>>Manufacturing</option>
<option value="2" name="hotel" <?php if ($row['business_category'] == 2) {
echo 'selected';
} ?>>Hotel</option>
<option value="3" name="website" <?php if ($row['business_category'] == 3) {
echo 'selected';
} ?>>Website Design</option> -->
</select>
<!--<input type="text" name="business_hours" placeholder="Enter Business operation hours" value="<?php echo $row['business_hours']; ?>">
<input type="text" name="business_days" placeholder="Enter Business open days " value="<?php echo $row['business_days']; ?>">
<input type="text" name="business_operation" placeholder="Enter Business operation  " value="<?php echo $row['business_operation']; ?>">-->
<input type="text" name="year" id="yr" placeholder="Enter Year established " value="<?php echo $row['year_established']; ?>">
<input type="text" name="headline" id="head" placeholder="Enter Listing headline " value="<?php echo $row['listing_headline']; ?>">
<input type="text" name="description" id="desc" placeholder="Enter Description" value="<?php echo $row['description']; ?>">
<!--<input type="text" name="website_address" placeholder="Enter Website address  " value="<?php //echo $row['website_address'];
?>">-->


</section>

<section>
<p>Business Location Details</p>
<p>Country <span style="color:red" id="country">*</span></p>
<select class="select-single-item1" name="country" id="spUserCountry">
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($row['country']) && $row['country'] == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>


<span class="loadUserState">
<p>State <span style="color:red" id="state">*</span></p>
<select class="select-single-item" name="state" id="spUserState">
<?php
$pr = new _state;
$result2 = $pr->readState($row['country']);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) {
echo $row2['state_id']; ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($row['state']) && $row['state'] == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>

<?php }
}	?>

</select>
</span>


<span class="loadCity">
<p>City </p>
<select class="select-single-item" name="city" id="spUserCity">
<?php
$co = new _city;
$result3 = $co->readCity($row['state']);
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($row['city']) && $row['city'] == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
							}
						}
								?>

</select>
</span>

<input type="text" name="Location" placeholder="Enter Location" value="<?php echo $row['location']; ?>">
<!--<input type="text" name="City_expansion" placeholder="Enter City expansion"value="<?php echo $row['city_expansion']; ?>">-->

</section>

<section>
<p>Real Estate Included? <span style="color:red" id="rs">*</span></p>


<div class="row" style="text-align: left;">
<div class="checkboxes">
<input id="check-2" type="radio" value="1" name="real_estate" <?php if ($row['real_state_included'] == 1) {
echo 'checked';
} ?>>
<label for="check-2">Yes</label>
<input id="check-3" type="radio" value="0" name="real_estate" <?php if ($row['real_state_included'] == 0) {
echo 'checked';
} ?>>
<label for="check-3">No</label>
</div>
</div>
<h5 style="text-align: left;">Includes Inventory <span style="color:red" id="inv">*</span></h5>
<div class="row" style="text-align: left;">
<div class="checkboxes margin-bottom-20">
<input id="check-2" type="radio" value="1" name="inventory" <?php if ($row['inventory_includes'] == 1) {
echo 'checked';
} ?>>
<label for="check-2">Per Annum if applicable</label>
<input id="check-3" type="radio" value="0" name="inventory" <?php if ($row['inventory_includes'] == 0) {
echo 'checked';
} ?>>
<label for="check-3">Per sq. ft</label>
</div>
</div>
<h5 style="text-align: left;">Includes Furniture/fixtures? <span style="color:red" id="furn">*</span> </h5>
<div class="row" style="text-align: left;">
<div class="checkboxes in-row margin-bottom-20">
<input id="check-2" type="radio" value="1" name="furniture_fixture" <?php if ($row['includes_furnitures'] == 1) {
echo 'checked';
} ?>>
<label for="check-2">Furniture</label>
<input id="check-3" type="radio" value="0" name="furniture_fixture" <?php if ($row['includes_furnitures'] == 0) {
echo 'checked';
} ?>>
<label for="check-3">fixtures</label>
</div>
</div>
<input type="number" name="furniture_fix" placeholder="Enter Value of  Furniture/fixtures" value="<?php echo $row['furniture_value'] ?>">

<h5 style="text-align: left;">Point of Sale software Available? <span style="color:red" id="soft">*</span> </h5>
<div class="row" style="text-align: left;">
<div class="checkboxes margin-bottom-20">
<input id="check-2" type="radio" value="1" name="sale_software" <?php if ($row['sale_software'] == 1) {
echo 'checked';
} ?>>
<label for="check-2">Review listing</label>
<input id="check-3" type="radio" value="0" name="sale_software" <?php if ($row['sale_software'] == 0) {
echo 'checked';
} ?>>
<label for="check-3">Save as draft</label>
</div>
</div>

<h5 style="text-align: left;">Training Support Provided <span style="color:red" id="tr_support">*</span></h5>
<div class="row" style="text-align: left;">
<div class="checkboxes margin-bottom-20">
<input id="check-5" type="radio" value="1" name="tr_support" <?php if ($row['training_support'] == 1) {
echo 'checked';
} ?>>
<label for="check-2">Yes</label>
<input id="check-5" type="radio" value="0" name="tr_support" <?php if ($row['training_support'] == 0) {
echo 'checked';
} ?>>
<label for="check-3">No</label>
</div>
</div>

<h5 style="text-align: left;">Upload Images Of Business(Max 5)</h5>

<?php
$sa = new _businessrating;
$fil = $sa->read_files($postid);
//print_r($fil);



?>

<input type="file" name="sale_file[]" class="form-control" style="display:inline-block;" multiple />

<div class="form-group">
<label for="postingPicPreview">Picture Preview</label>
<div id="imagePreview"></div>
<div id="postingPicPreview">
<div class="row">
<div id="dvPreview">
<?php
//$i = 1;
$pic = new _businessrating;
if ($postid) {
$res = $pic->read_files($postid);

if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
$picture = $rows['filename'];
//echo $picture;
if ($picture) {
echo "<div class='col-md-4 imagepost'><span class='fa fa-remove img_file dynamicimg closed' style='margin-right:10px;'   data-work='event' data-aws='6' data-src='" . $rows['filename'] . "'  data-pic='" . $rows['id'] . "'></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_" . $i . "' src='" . $BaseUrl . '/business_for_sale/uploads/' . ($picture) . "'/> <a href='" . $BaseUrl . '/business_for_sale/uploads/' . ($picture) . "' download> Downlaod</a></br><label style='font-size: 10px;' class='updateFeature' data-postid='" . $postid . "' data-picid='" . $rows['id'] . "'></div>";
}
$i++;
}
}
}
?>
</div>

</div>
</div>
<script>
$(document).ready(function() {
$(".img_file").click(function() {
var id = $(this).attr("data-pic");
//alert(id);

$.ajax({
url: "deletepic.php",
cache: false,
data: {
'data-id': id
},
success: function(html) {

}
});
});
});
</script>


</div>



<h5 style="text-align: left;">Upload Supporting Documents</h5>

<?php
$su = new _businessrating;
$sup = $sa->read_support_files($postid);
//print_r($sup);



?>

<input type="file" name="supp_file[]" class="form-control" style="display:inline-block;" accept=".jpg, .jpeg, .png, .doc, .docx,.mp4" multiple />

<div class="form-group">
<label for="postingPicPreview">Picture Preview</label>
<div id="imagePreview"></div>
<div id="postingPicPreview">
<div class="row">
<div id="dvPreview">
<?php
//$i = 1;
$pic1 = new _businessrating;
if ($postid) {
$res1 = $pic1->read_support_files($postid);
//var_dump($res1);
if ($res1 != false) {
while ($rows1 = mysqli_fetch_assoc($res1)) {
//print_r($rows1);
$picture1 = $rows1['filename'];
//echo $picture1;
echo "<div class='col-md-4 imagepost' id='support_" . ($rows1['id']) . "'><span class='fa fa-remove support dynamicimg closed' style='margin-right:10px;'   data-work='event' data-aws='6' data-src='" . $rows1['filename'] . "'  data-pic1='" . $rows1['id'] . "'></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_" . $i . "' src='" . $BaseUrl . '/business_for_sale/uploads/' . ($picture1) . "'/></br><a href='" . $BaseUrl . '/business_for_sale/uploads/' . ($picture1) . "' download> Downlaod</a><label style='font-size: 10px;' class='updateFeature' data-postid='" . $postid . "' data-picid='" . $rows1['id'] . "'></div>";
$i++;
}
}
}
?>
</div>

</div>
</div>
<script>
$(document).ready(function() {
$(".support").click(function() {
var id1 = $(this).attr("data-pic1");
//alert(id);

$.ajax({
url: "deletepicsupport.php",
cache: false,
data: {
'data-id1': id1
},
success: function(html) {
$('#support_' + id1).html('');
}
});
});
});
</script>


</div>


<!--		<div id="dropzone">
<div class="dropzone needsclick" id="demo-upload">
<div class="dz-message needsclick">
<span class="text">
<img src="http://www.freeiconspng.com/uploads/------------------------------iconpngm--22.png" alt="Camera" />
Drop files here or click to upload.
</span>
<span class="plus">+</span>
</div>
</div>
</div>


<!-- Google Font -->
<!--<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<!-- Plugin -->
<!--<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" />
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>


-->




<!--<form action="file-upload" class="dropzone"></form>-->

</section>

<section>
<p>Other</p>
<input type="text" name="business_size" placeholder="Enter Business size in square feet" value="<?php echo $row['business_size']; ?>">

<input type="number" name="sales_revenue" placeholder="Enter Sales revenue " value="<?php echo $row['sales_revenue']; ?>">
<input type="number" name="cash_flow" placeholder="Enter Cash flow " value="<?php echo $row['cash_flow']; ?>">
<input type="text" name="competition" placeholder="Enter Competition" value="<?php echo $row['competition']; ?>">
<input type="text" name="training_support" placeholder="Enter Training support provided" value="<?php echo $row['training_support']; ?>">
<input type="number" name="lease" placeholder="Enter Lease per month " value="<?php echo $row['lease_per_month']; ?>">
<input type="text" name="selling_reason" placeholder="Enter Reasons for selling" value="<?php echo $row['selling_reason']; ?>">
<input type="number" name="inventory_amount" placeholder="Enter Inventory amount " value="<?php echo $row['inventory_amount']; ?>">
</section>


<div class="row" style="text-align: center;">
<div class="btn btn-danger button zoom1" id="cancel"><a href="dashboard/draft.php" style="color:white;">Cancel</a></div>
<input type="submit" name="submit" value="Update" id="update" class="button zoom1">
<?php if ($_GET['draft'] == 1) { ?>
<!--<button type="submit" class="button" name="payNow" id="payNow"  style="border-radius: 25px;" onclick="stripePay(event)" value="Pay Now">
<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Publish & Pay Now</button>-->
<input type="submit" name="POST" value="Pay & Post" class="button zoom1">
<?php } ?>
</form>


<!--<section style="max-width: 839px !important;display:none;">
<div class=""> 

<div class="row">

<!--<div class="col-md-4 price-cls">
<div >
<ul class="price">
<li class="header"><input type="radio" name="duration" value="<?php echo $i; ?>"/><?php echo $row['duration'] . ' Days'; ?></li>
<li class="grey"> <span style="margin-top: 5px;"> <?php echo 'USD ' . $row['price']; ?> </span></li>
<li class="grey"><a href="#" class="button" style="background-color: #eb6f33; border-radius: 30px;">Buy Now →</a></li>
</ul>
</div>
</div>-->

<!--<div class="col-md-4 price-cls">
<div >
<ul class="price" >
<li class="header">Three Months</li>
<li class="grey"><span style="margin-top: 5px;">$399</span></li>
<li class="grey"><a href="#" class="button" style="background-color: #eb6f33; border-radius: 30px;">Buy Now →</a></li>
</ul>
</div>
</div>

<div class="col-md-4 price-cls">
<div >
<ul class="price">
<li class="header">One Months</li>
<li class="grey"><span style="margin-top: 5px;">$299</span></li>
<li class="grey"><a href="#" class="button" style="background-color: #eb6f33; border-radius: 30px;">Buy Now →</a></li>
</ul>
</div>
</div>
</div>
<!--<form action="business_payment.php" method="POST" id="paymentform">
<div class="form-group">
<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
<input type="text" name="customerName" id="customerName" style="width:300px;" class="form-control" value="" required>
<span id="errorCustomerName" class="text-danger"></span>
</div>

<div class="form-group">
<label>Card Number <span class="text-danger">*</span></label>
<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="cardNumber" id="cardNumber" style="width:300px;" class="form-control" maxlength="20" >
<span id="errorCardNumber" class="text-danger"></span> 
</div>
<div class="form-group">
<div class="row">
<div class="col-md-3">
<label>Expiry Month</label>
<input type="text" name="cardExpMonth" style="width:110px;" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);">
<span id="errorCardExpMonth" class="text-danger"></span>
</div>
<div class="col-md-3">
<label>Expiry Year</label>
<input type="text" name="cardExpYear" id="cardExpYear" style="width:110px;" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);">
<span id="errorCardExpYear" class="text-danger"></span>
</div>
<div class="col-md-3">
<label>CVC</label>
<input type="text" name="cardCVC" id="cardCVC" style="width:90px;" class="form-control"  maxlength="4" onkeypress="return validateNumber(event);">
<span id="errorCardCvc" class="text-danger"></span>
</div>
</div>
</div>
<button type="submit" class="btn " name="payNow" id="payNow"  style="border-radius: 25px;" onclick="stripePay(event)" value="Pay Now">
<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now</button>
</form>-->
<!--<div class="row">

<div class="payment-options-cls">
<div id="Checkout" class="inline">
<h1>Pay Invoice</h1>
<div class="card-row">
<span class="visa"></span>
<span class="mastercard"></span>
<span class="amex"></span>
<span class="discover"></span>
</div>
<form>
<div class="form-group">
<label for="PaymentAmount">Payment amount</label>
<div class="amount-placeholder">
<span>$</span>
<span>500.00</span>
</div>
</div>
<div class="form-group">
<label or="NameOnCard">Name on card</label>
<input id="NameOnCard" class="form-control" type="text" maxlength="255"></input>
</div>
<div class="form-group">
<label for="CreditCardNumber">Card number</label>
<input id="CreditCardNumber" class="null card-image form-control" type="text"></input>
</div>
<div class="expiry-date-group form-group">
<label for="ExpiryDate">Expiry date</label>
<input id="ExpiryDate" class="form-control" type="text" placeholder="MM / YY" maxlength="7"></input>
</div>
<div class="security-code-group form-group">
<label for="SecurityCode">Security code</label>
<div class="input-container" >
<input id="SecurityCode" class="form-control" type="text" ></input>
<i id="cvc" class="fa fa-question-circle"></i>
</div>
<div class="cvc-preview-container two-card hide">
<div class="amex-cvc-preview"></div>
<div class="visa-mc-dis-cvc-preview"></div>
</div>
</div>
<div class="zip-code-group form-group">
<label for="ZIPCode">ZIP/Postal code</label>
<div class="input-container">
<input id="ZIPCode" class="form-control" type="text" maxlength="10"></input>
<a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="left" data-content="Enter the ZIP/Postal code for your credit card billing address."><i class="fa fa-question-circle"></i></a>
</div>
</div>
<button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
<span class="submit-button-lock"></span>
<span class="align-middle">Pay $500.00</span>
</button>
</form>
</div>
</div> 

</div>
</div>

</section> -->


<!-- <a href="business-listing.html"><div class="button" id="submit">Agree and send application</div></a> -->




</div>

</div>


<!-- Footer -->
<div class="margin-top-65"></div>
<!--<div id="" style="background-color: #202447;color: white;">
<div class="container">
<div class="row" style="color: white;">
</br>
<div class="col-md-4 col-sm-12 col-xs-12">
<h1 style="color: white;">THE SharePage</h1>
<p>BusinessesForSale.com is the world's
most popular website for buying or selling a
business. BusinessesForSale.com is the
world's most popular website for buying or
selling a business.
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: white;"><b>HELPFUL LINKS</b></h4>
Contact us</br>
Company Info
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: white;"><b>GUIDE</b></h4>
Navigation</br>

</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: white;"><b>OUR POLICIES</b></h4>
Copyrights</br>
Privacy Policy
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: white;"><b>MORE RESOURCES</b></h4>
Investment Oppoutunutues</br>

</div>
</div>
</br>
<div class="row">
<img style="height: 30px;width: 30px;" src="images/web 0021.png" alt="">&nbsp;&nbsp;&nbsp;
<img style="height: 30px;width: 30px;" src="images/web 0022.png" alt="">&nbsp;&nbsp;&nbsp;
<img style="height: 30px;width: 30px;" src="images/web 0023.png" alt="">&nbsp;&nbsp;&nbsp;
<img style="height: 30px;width: 30px;" src="images/web 0024.png" alt="">&nbsp;&nbsp;&nbsp;
</div>
<div class="row">
<div class="col-md-12">
<div class="copyrights" style="color: white;"><b>© Thesharepage by <a href="codelocksolutions.com">Codelock</a>, 2021 All rights reserved</b></div>
</div>
</div>
</div>
</div>-->

</div>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- Footer / End -->

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


<!-- Wrapper / End -->

<!-- Scripts>-->

<script src="http://codelocksolutions.in/track_site/jquerythesharepage.js">
< /script <
script src = "scripts/chosen.min.js" >
</script>
<script src="scripts/magnific-popup.min.js"></script>
<script src="scripts/owl.carousel.min.js"></script>
<script src="scripts/rangeSlider.js"></script>
<script src="scripts/sticky-kit.min.js"></script>
<script src="scripts/slick.min.js"></script>
<script src="scripts/masonry.min.js"></script>
<script src="scripts/mmenu.min.js"></script>
<script src="scripts/tooltips.min.js"></script>
<script src="scripts/custom_jquery.js"></script>
<!--<script src="scripts/dropzone.js"></script>-->
<script>
//	$(".dropzone").dropzone({
//dictDefaultMessage: "<i class='sl sl-icon-cloud-upload'></i> Drag & Drop Files Here",
//	});
$(document).ready(function() {
/*
var base_color = "rgb(230,230,230)";
var active_color = "rgb(237, 40, 70)";



var child = 1;
var length = $("section").length - 1;
$("#prev").addClass("disabled");
$("#submit").addClass("disabled");

$("section").not("section:nth-of-type(1)").hide();
$("section").not("section:nth-of-type(1)").css('transform','translateX(100px)');

var svgWidth = length * 200 + 24;
$("#svg_wrap").html(
'<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' +
svgWidth +
' 24" xml:space="preserve"></svg>'
);

function makeSVG(tag, attrs) {
var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
for (var k in attrs) el.setAttribute(k, attrs[k]);
return el;
}

for (i = 0; i < length; i++) {
var positionX = 12 + i * 200;
var rect = makeSVG("rect", { x: positionX, y: 9, width: 200, height: 6 });
document.getElementById("svg_form_time").appendChild(rect);
// <g><rect x="12" y="9" width="200" height="6"></rect></g>'
var circle = makeSVG("circle", {
cx: positionX,
cy: 12,
r: 12,
width: positionX,
height: 6
});
document.getElementById("svg_form_time").appendChild(circle);
}

var circle = makeSVG("circle", {
cx: positionX + 200,
cy: 12,
r: 12,
width: positionX,
height: 6
});
document.getElementById("svg_form_time").appendChild(circle);

$('#svg_form_time rect').css('fill',base_color);
$('#svg_form_time circle').css('fill',base_color);
$("circle:nth-of-type(1)").css("fill", active_color);


$(".button").click(function () {
$("#svg_form_time rect").css("fill", active_color);
$("#svg_form_time circle").css("fill", active_color);
var id = $(this).attr("id");
if (id == "next") {
$("#prev").removeClass("disabled");
if (child >= length) {
$(this).addClass("disabled");
$('#submit').removeClass("disabled");
}
if (child <= length) {
child++;
}
} else if (id == "prev") {
$("#next").removeClass("disabled");
$('#submit').addClass("disabled");
if (child <= 2) {
$(this).addClass("disabled");
}
if (child > 1) {
child--;
}
}
var circle_child = child + 1;
$("#svg_form_time rect:nth-of-type(n + " + child + ")").css(
"fill",
base_color
);
$("#svg_form_time circle:nth-of-type(n + " + circle_child + ")").css(
"fill",
base_color
);
var currentSection = $("section:nth-of-type(" + child + ")");
currentSection.fadeIn();
currentSection.css('transform','translateX(0)');
currentSection.prevAll('section').css('transform','translateX(-100px)');
currentSection.nextAll('section').css('transform','translateX(100px)');
$('section').not(currentSection).hide();
});
*/
$("#update").click(function() {
var b_type = $('#type').val();
//alert(b_type);
var cat = $('#cat').val();
//alert(cat);
var year = $('#yr').val();
//alert(year);
var headline = $('#head').val();
var desc = $('#dsc').val();
var country = $('#spUserCountry').val();
var state = $('#spUserState').val();
//alert(state);
var city = $('#spUserCity').val();

if (b_type == 'Select type') {
$("#b_type").text("This Field is Required");
var fal = 1;
}
if (cat == 0) {
$("#category").text("This Field is Required");
var fal = 1;
}
if (year == '') {
//alert('sfkjjk');
$("#year").text("This Field is Required");
var fal = 1;
}
if (headline == "") {
$("#headline").text("This Field is Required");
var fal = 1;
}
if (desc == "") {
$("#desc").text("This Field is Required");
var fal = 1;
}
if (state == null) {
//alert('sfkjjk');
$("#state").text("This Field is Required");
var fal = 1;
}
/*if(city==null){
$("#city").text("This Field is Required");
var fal=1;
}*/
if (fal == 1) {
return false;
}
});

});



$("#spUserCountry").on("change", function() {
var countryId = this.value;
$.post("loadUserState.php", {
countryId: countryId
}, function(r) {
$(".loadUserState").html(r);
});
var state = 0;
$.post("loadUserCity.php", {
state: state
}, function(r) {
$(".loadCity").html(r);
});
});
</script>

</body>


</html>
<?php } ?>
