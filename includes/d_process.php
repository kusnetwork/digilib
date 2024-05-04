<?php
	//MASUKKAN BUKU KE DAFTAR PINJAMAN
	if(isset($_POST['pinjam'])) {
		$kodeBuku = $_POST['kodeBuku'];
		$kodePeminjam = $_POST['kodePeminjam'];
		$type = $_POST['type'];
		$tglPinjam = $date;
		$kodePinjam = date('Ymd')."".$type."".$kodePeminjam;
		
		$db=new MySQL();
		$db->connect();
		$db->execute("SELECT kodePinjam FROM tb_pinjam WHERE kodePinjam = ".$kodePinjam."");
		$existId = $db->get_dataset();
		count($existId);
		if(count($existId) > 0) {
			$db->execute("INSERT INTO tb_pinjamdetail VALUES ('','$kodePinjam','$kodeBuku') ");
		} else {
			$db->execute("INSERT INTO tb_pinjam VALUES ('$kodePinjam','','$kodePeminjam','$type','$tglPinjam','','','') ");
			$db->execute("INSERT INTO tb_pinjamdetail VALUES ('','$kodePinjam','$kodeBuku') ");
		}
		redirect("index.php","");
	}
	
	//HAPUS BUKU DARI DAFTAR PINJAMAN
	if(isset($_GET['o']) && $_GET['o'] == 'd') {
		$kodePinjamDetail = $_GET['id'];
		
		$db=new MySQL();
		$db->connect();
		$db->execute("DELETE FROM tb_pinjamdetail WHERE kodePinjamDetail = ".$kodePinjamDetail."");
		
		redirect("index.php?page=pinjaman","");
	}
	
	//PROSES DARI DAFTAR PINJAMAN
	if(isset($_GET['o']) && $_GET['o'] == 'pp') {
		$kodePinjam = $_GET['id'];
		
		$db=new MySQL();
		$db->connect();
		$db->execute("UPDATE tb_pinjam SET status = 1 WHERE kodePinjam = ".$kodePinjam."");
		
		redirect("index.php","");
	}
?>