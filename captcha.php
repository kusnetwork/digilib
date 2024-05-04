<?
session_start();
$textrandom=strtoupper(substr(md5(rand(0, date("his"))), 0, 5)); //ini untuk mendapatkan huruf/angka secara random
$_SESSION['session_captcha']=$textrandom; //ini untuk menyimpan di session
$image=imagecreate(60, 30);    //ini untuk ukuran per pixel
$warnalatar=imagecolorallocate($image, 0, 130, 228); //ini untuk warna latar berwarna hitam, bisa diganti dengan code warna anda
$warnatext=imagecolorallocate($image, 255, 255, 255); //ini untuk warna text
imagestring($image, 5, 5, 8, $textrandom, $warnatext); //ini untuk membuat secara keseluruhan image
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // header header ini dibuat untuk menghilangkan cache image
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-type: image/jpeg');
imagejpeg($image); //ini untuk membuat extension image menjadi jpeg
imagedestroy($image); //ini untuk menampilkan gambar yang dari atas sudah terbentuk
?>