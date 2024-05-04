<?php
	//EDIT BUKU DI DAFTAR BUKU
	if(isset($_POST['edit'])) {
		extract($_POST);
		
		$db=new MySQL();
		$db->connect();
		if(isset($tb)) {
			$file = "img/" . $_FILES['image']['name'];
			$tmp = $_FILES['image']['tmp_name'];

			$db->execute("UPDATE tb_buku SET 
			judul = '$judul', kodePenerbit = '$kodePenerbit', kodePengarang = '$kodePengarang', tahun = '$tahun', edisi = '$edisi',
			issn_isbn = '$issn_isbn', seri = '$seri', abstraksi = '$abstraksi', kodeKategori = '$kodeKategori', tglUpdate = '$date', image = '$file',
			lastUpdateBy = '$idUser'
			WHERE kodeBuku = $kodeBuku");
			move_uploaded_file($tmp, $file);
			redirect("?page=daftar_buku","");
		} if(isset($tk)) {
			$db->execute("UPDATE tb_kategori SET 
				namaKategori = '$namaKategori'
				WHERE kodeKategori = $kodeKategori");			
			redirect("?page=daftar_kategori","");
		} if(isset($tpn)) {
			$db->execute("UPDATE tb_penerbit SET 
				nama = '$nama', alamat = '$alamat', telp = '$telp', email = '$email'
				WHERE kodePenerbit = $kodePenerbit");			
			redirect("?page=daftar_penerbit","");
		} if(isset($tpg)) {
			$db->execute("UPDATE tb_pengarang SET 
				nama = '$nama'
				WHERE kodePengarang = $kodePengarang");			
			redirect("?page=daftar_pengarang","");
		} if(isset($tup)) {
			if($password == "")
				$db->execute("UPDATE tb_petugas SET 
					nama = '$nama', username = '$username', email = '$email', tempatLahir = '$tpl', tanggalLahir = '$ttl', alamat = '$alamat'
					WHERE kodePetugas = $kodeP");			
			else
				$db->execute("UPDATE tb_petugas SET 
					nama = '$nama', username = '$username', password = '".md5($password)."', email = '$email', tempatLahir = '$tpl', tanggalLahir = '$ttl', alamat = '$alamat'
					WHERE kodePetugas = $kodeP");			
			redirect("?page=daftar_petugas","");
		} if(isset($tud)) {
			if($password == "")
				$db->execute("UPDATE tb_dosen SET 
					nama = '$nama', username = '$username', email = '$email', tempatLahir = '$tpl', tanggalLahir = '$ttl', alamat = '$alamat'
					WHERE kodeDosen = $kodeDosen");			
			else
				$db->execute("UPDATE tb_dosen SET 
					nama = '$nama', username = '$username', password = '".md5($password)."', email = '$email', tempatLahir = '$tpl', tanggalLahir = '$ttl', alamat = '$alamat'
					WHERE kodeDosen = $kodeDosen");			
			redirect("?page=daftar_dosen","");
		} if(isset($tum)) {
			if($password == "")
				$db->execute("UPDATE tb_mahasiswa SET 
					nama = '$nama', username = '$username', email = '$email', tempatLahir = '$tpl', tanggalLahir = '$ttl', alamat = '$alamat'
					WHERE kodeMhs = $kodeMhs");			
			else
				$db->execute("UPDATE tb_mahasiswa SET 
					nama = '$nama', username = '$username', password = '".md5($password)."', email = '$email', tempatLahir = '$tpl', tanggalLahir = '$ttl', alamat = '$alamat'
					WHERE kodeMhs = $kodeMhs");			
			redirect("?page=daftar_mahasiswa","");
		}
	}
	
	//TAMBAH BUKU DI DAFTAR BUKU
	if(isset($_POST['add'])) {
		extract($_POST);
		
		$db=new MySQL();
		$db->connect();
		if(isset($tb)) {
			$db->execute("INSERT INTO tb_buku VALUES
				('','$judul','$kodePenerbit','$kodePengarang','$tahun','$edisi','$issn_isbn','$seri','$abstraksi','$kodeKategori','$date','$date','','$kodePetugas')");
			redirect("?page=daftar_buku","");
		} else if(isset($tk)) {
			$db->execute("INSERT INTO tb_kategori VALUES ('','$namaKategori')");
			redirect("?page=daftar_kategori","");
		} if(isset($tpn)) {
			$db->execute("INSERT INTO tb_penerbit VALUES ('','$nama', '$alamat', '$telp', '$email')");
			redirect("?page=daftar_penerbit","");
		} if(isset($tpg)) {
			$db->execute("INSERT INTO tb_pengarang VALUES ('','$nama')");
			redirect("?page=daftar_pengarang","");
		} if(isset($tup)) {
			$db->execute("INSERT INTO tb_petugas 
				VALUES ('','$username','".md5($password)."','$nama','$email','$date','$date','tpl','$ttl','$alamat','')");
			redirect("?page=daftar_petugas","");
		} if(isset($tud)) {
			$db->execute("INSERT INTO tb_dosen
				VALUES ('','$username','".md5($password)."','$nama','$email','$date','$date','tpl','$ttl','$alamat','')");
			redirect("?page=daftar_dosen","");
		} if(isset($tum)) {
			$db->execute("INSERT INTO tb_mahasiswa 
				VALUES ('','$username','".md5($password)."','$nama','$email','$date','$date','tpl','$ttl','$alamat','','')");
			redirect("?page=daftar_mahasiswa","");
		}
	}
	
	//HAPUS BUKU DARI DAFTAR BUKU
	if(isset($_GET['o']) && $_GET['o'] == 'd') {
		extract($_GET);
		
		$db=new MySQL();
		$db->connect();
		if(isset($tb)) {
			$db->execute("DELETE FROM tb_buku WHERE kodeBuku = ".$id."");
			redirect("?page=daftar_buku","");
		} else if(isset($tk)) {
			$db->execute("DELETE FROM tb_kategori WHERE kodeKategori = ".$id."");
			redirect("?page=daftar_kategori","");
		} if(isset($tpn)) {
			$db->execute("DELETE FROM tb_penerbit WHERE kodePenerbit = ".$id."");
			redirect("?page=daftar_penerbit","");
		} if(isset($tpg)) {
			$db->execute("DELETE FROM tb_pengarang WHERE kodePengarang = ".$id."");
			redirect("?page=daftar_pengarang","");
		} if(isset($tup)) {
			$db->execute("DELETE FROM tb_petugas WHERE kodePetugas = ".$id."");
			redirect("?page=daftar_petugas","");
		} if(isset($tud)) {
			$db->execute("DELETE FROM tb_dosen WHERE kodeDosen = ".$id."");
			redirect("?page=daftar_dosen","");
		} if(isset($tum)) {
			$db->execute("DELETE FROM tb_mahasiswa WHERE kodeMhs = ".$id."");
			redirect("?page=daftar_mahasiswa","");
		}
	}
	
	//KONFIRMASI PEMINJAMAN
	if(isset($_GET['o']) && $_GET['o'] == 'k') {
		extract($_GET);
		
		$db=new MySQL();
		$db->connect();
		if(isset($tpjm)) {
			$db->execute("UPDATE tb_pinjam SET status = 2, kodePetugas = ".$idUser." WHERE kodePinjam = ".$id." ");
			redirect("?page=daftar_peminjaman","");
		} if(isset($tpgm)) {
			$db->execute("UPDATE tb_pinjam SET tglKembali = '".$date."' WHERE kodePinjam = ".$id." ");
			redirect("?page=daftar_pengembalian","");
		}
		
	}
?>
