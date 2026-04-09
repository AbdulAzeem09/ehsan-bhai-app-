<?php 
include('../../univ/baseurl.php');
    session_start(); 
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_POST); die();
$p = new _pos;  

if(isset($_POST['pos_login'])){
	//print_r($_POST);
	$res = $p->login_pos($_POST['spUserEmail'],$_POST['spUserPassword']);
	 
	
	if($res != false){
	
	$row = mysqli_fetch_assoc($res);
	
	$_SESSION['uid'] = $row['uid'];
	$_SESSION['pid'] = $row['pid'];
	$_SESSION['pos_userid'] = $row['user_id'];
	
	if($_SESSION['pos_userid'] != ''){ 
		
		$us1=$p->read_users_id($_SESSION['pos_userid']);
              if($us1!=false){
		$row_1 = mysqli_fetch_assoc($us1);
         $_SESSION['user_name'] = $row_1['user_name'];	 	
												  
	  }
		
	}
	
	
	
	?>
	<script>
window.location.replace("<?php echo $BaseUrl; ?>/store/pos-dashboard/index.php");  
</script>
		
	<?php }else{?>
		<script>
window.location.replace("<?php echo $BaseUrl; ?>/store/pos-dashboard/login-pos.php?msg=notverify");  
</script>
		
	<?php }
	
}

?>
<!-- CSS only -->
 <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>Business Account & Inventory | TheSharepage</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
   <link
   rel="stylesheet"
   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css"
   integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg=="
   crossorigin="anonymous"
   referrerpolicy="no-referrer"
   />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css" />
   
   

<style>
    /* Google fonts */
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Italiana&display=swap');
        /* font-family: 'Cormorant Garamond', serif;
        font-family: 'Italiana', serif; */

        *{
            box-sizing: border-box;
        }

        body {
           min-height: 100vh; 
           background-color: #F7F5F3;
           /*flex*/
           display: flex;
           justify-content: stretch;
           align-items: center;
        }
        
        h1 {
            font-size: 48px;
            font-family: 'Italiana', serif;
            font-weight: 400;
            margin-bottom: 64px;
            color: #554A3D;
        }

        input, span, label, button, a {
            font-family: 'Cormorant Garamond', serif;
            color: #554A3D;
        }

        a {
            text-decoration: none;
            font-size: 16px;
            font-weight: 400;
            margin-top: 8px;
            /*flex*/
            display: flex;  
            justify-content: flex-end;
        }

        fieldset {
            border: none;
            /*flex*/
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 18px;
            font-weight: 600;
        }

        fieldset input:first-of-type {
            margin: 8px 0px 40px;
        }

        input {
            width: 100%;
            height: 40px;
            border: none;
            background-color: #E8E3DC;
            border-radius: 10px;
            /*flex*/
            display: flex;
            justify-content: center;
            align-items: center;
        }

        button {
            width: 192px;
            height: 48px;
            border: none;
            background-color: transparent;
            text-transform: capitalize;
            font-weight: 700;
            font-size: 20px;
            border-radius: 10px;
        }

        .left {
            width: 35%;
            padding: 24px;
        }

        .right {
            width: 65%;
            height: 100vh;
            background-image: url(https://images.pexels.com/photos/7911758/pexels-photo-7911758.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2); 
            background-size: cover;
            background-position: center;
            /* Picture credits: Rodion Kutsaiev: https://www.pexels.com/es-es/foto/ligero-arte-abstracto-arquitectura-7911758/ */
        }

        .primaryBtn {
            color: #F7F5F3;
            background-color: #85A2AB;
            margin: 40px auto 56px;
        }

        .primaryBtn:hover {
            background-color: #516369;
        }

        .separator {
            width: 100%;
            height: 1px;
            margin: 0px auto 56px; 
            background-color: #BBB4A7;
        }

        span {
            font-size: 18px;
            font-weight: 700;
            /*flex*/
            display: flex;
            justify-content: center;
        }

        .secondaryBtn {
            color: #554A3D;
            border: 1px solid #85A2AB;
            margin: 8px auto;
        }

        .secondaryBtn:hover {
            color: #516369;
            border-color: #516369;
        }
</style>   

  <div class="left">
  <?php   if($_GET['msg']== "notverify"){ ?>

<div class="alert alert-danger"  id="no_member"role="alert"> 
  Invalid Email or Password !
</div>
<?php } ?>  
        <h1>Welcome</h1>
        <form action="" method="post">
            <fieldset>
			<input type="hidden" name="pos_status" value='1'> 
                <label for="username">Username or Email</label>
                <input type="text" name="spUserEmail" id="uu">
                <label for="passowrd">Password</label>
                <input type="password" name="spUserPassword">
                <a href="#">Forgot your password?</a>
                <button name="pos_login" class="primaryBtn">Sign in</button>
                <div class="separator"></div>
                <!--<span>Don't have an account yet?</span>
                <button class="secondaryBtn">Sign up</button>-->
            </fieldset>
        </form>
    </div>
    <div class="right"></div>





<script>
setTimeout(function () {
                    $("#no_member").hide();
                 }, 3000);
</script>