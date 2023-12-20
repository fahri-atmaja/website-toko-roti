<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Inventory Baso Aci</title>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <script src="js/prefixfree.min.js"></script>
  </head>
  <body>
      <img src="logo.jpg" alt="" width="200" height="170">
      <h3><span><b>Sistem Informasi Manajemen Aset (SIMAS) </b></span></h3>
	  <h3><span><b>Baso Aci Ambarawa</b></span></h3>
  <section class="stark-login">
    <form method="POST">	
      <div id="fade-box">
        <input type="text" name="username" id="username" placeholder="Masukan Email" required>
        <input type="password" name="password" placeholder="Masukan Password" required>
        <button name="login">Log In SIMAS</button> 
      </div>
    </form>
        <div class="hexagons">
        </div>      
  </section> 
  <div id="circle1">
    <div id="inner-cirlce1">
      <h1></h1>
    </div>
  </div>
    <script src="js/index.js"></script>
	<div id="footer"><p>Copyright &copy; <?php echo date('Y'); ?> - Baso Aci Ambarawa</p></div>
</div>
  </body>
  

</html>
<?php  
include "../class/class.php";
  if (isset($_POST['login'])) {
    $cek = $admin->login_admin($_POST['username'],$_POST['password']);
    if ($cek == true) {
      echo "<script>window.location='../index.php';</script>";
    }//jika salah atau tidak benar maka login ulang
    else{
      echo "<script>alert('Login Gagal, Password / Email Salah!');</script>";
    }
  }
?>
