<?php
include "classes/class.phpmailer.php";
$mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->SMTPSecure = ‘tls’;
    $mail->Host = "localhost"; //hostname masing-masing provider email
    $mail->SMTPDebug = 2;
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = "pmb@undaris.ac.id"; //user email
    $mail->Password = "und4r15!$"; //password email
    $mail->SetFrom("pmb@undaris.ac.id","INVENTORY APPS"); //set email pengirim
    $mail->Subject = "Pemberitahuan Email dari Website"; //subyek email
    $mail->AddAddress("fahrizalaziz54@gmail.com","OWNER NOTIFICATION"); //tujuan email
    $body .='<html>
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        	<title>INVENTORY APPS</title>
        </head>
        <body>
        	test notification
            </body>
            </html>
                ';
    
    $mail->MsgHTML("$body");
    // $mail->MsgHTML("Selamat!! Anda sudah terdaftar sebagai calon mahasiswa undaris. Berikut detail login anda untuk melengkapi biodata dan pembayaran<br>
    //                 Email : $fixemail <br>
    //                 Kode Login : $hasil1<br>
    //                 Silahkan login di https://pmb.undaris.ac.id/calonmahasiswa/login.php
    //                 ");
    if($mail->Send()) echo "Message has been sent";
    else echo "Failed to sending message";
							    if ($simpan){
                                echo "Tampil";
                            }else{
                            	echo "Gagal Simpan";
                            }
    ?>