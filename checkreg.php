<?php	
	session_start();				
	include("config/MySQL.php");
	include("config/functions.php");
				
	if(isset($_POST['register1'])) {
		$nrp = $_POST['nrp'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$type = 3;
		$email = $_POST['email'];
		$ver = md5($nrp);
		
		if($password == $password2) {
			$data=new MySQL();
			$data->connect();
			$data->execute("SELECT nrp FROM mahasiswa WHERE nrp = '".$nrp."' ");
			$dnrp = $data->get_dataset();
			$data->execute("INSERT mahasiswa VALUES 
				('".$nrp."', '', '', '', '', '".substr($nrp, 1, 1)."', '".$username."', '".md5($password)."', '".$ver."', '0', '".$email."')");
			if(count($dnrp))
				redirect("index.php?mode=register", "Username sudah digunakan");
			$_SESSION['reg'] = $nrp;
			
			/*
			//MAIL
			$to      = $email;
			$subject = "Verifikasi account Thesis Assistant";
			$message = "Terima Kasih telah mendaftar di Thesis Assistant. Kode verifikasi anda adalah: ".$ver;
			
			mail($to, $subject, $message);
			
			*/
			redirect("index.php?mode=register3", "");
		} else {
			redirect("index.php?mode=register", "Password tidak sama");	
		}
	}
	else if(isset($_POST['register2'])) {
		
	}
	else if(isset($_POST['register3'])) {
		$name = $_POST['name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$data=new MySQL();
		$data->connect();
		$data->execute("UPDATE mahasiswa SET nama = '".$name."', alamat = '".$address."', noTelp = '".$phone."' WHERE nrp = '".$_SESSION['reg']."' ");
		redirect("index.php", "Registrasi berhasil, silahkan login dengan account yang telah anda buat.");
	}
?>