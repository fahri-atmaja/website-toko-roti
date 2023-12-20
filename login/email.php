<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login TOKO HJ KARJA</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="logo.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(logo.png);">
					<span class="login100-form-title-1">
						INV APP - Recovery Password
					</span>
				</div>

				<form class="login100-form validate-form" method="POST">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="username" id="username" placeholder="Masukan Email">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login">
							Recovery Account
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
<?php  
include "../class/class.php";
include '../classes/class.phpmailer.php';
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
	$query = mysql_query("SELECT * FROM admin WHERE email='$username'");
	$cek = mysql_num_rows($query);
	if($cek > 0){
	    $view = mysql_fetch_array($query);
			    $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->SMTPSecure = ‘tls’;
                $mail->Host = "localhost"; //hostname masing-masing provider email
                $mail->SMTPDebug = 2;
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = "fahri@webable.id"; //user email
                $mail->Password = "123asdqwe123"; //password email
                $mail->SetFrom("fahri@webable.id","INVENTORY APPS"); //set email pengirim
                $mail->Subject = "Pemberitahuan Email dari Website"; //subyek email
                $mail->AddAddress("$username","OWNER NOTIFICATION"); //tujuan email
    $body .='<html>
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        	<title>INVENTORY APPS</title>
        </head>
        <body>
        	Detail akun anda : <br>
        	Username  : '. $view['email'] .'<br>
        	Password     : '. $view['password'] .'<br>
        	Silahkan login di <a href="https://tokohjkarja.com" target="_BLANK">https://tokohjkarja.com</a>
            </body>
            </html>
                ';
    
    $mail->MsgHTML("$body");
    if($mail->Send()) echo "Message has been sent";
    else echo "Failed to sending message";
    echo "<script>alert('Silahkan cek inbox email anda atau dibagian spam email!');
				window.location.href = 'index.php';
				;</script>";
    }else{
        echo "<script>alert('Email tidak terdaftar, silahkan hubungi admin!');
				window.location.href = 'index.php';
				;</script>";
    }
  }
?>