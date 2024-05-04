<?php
	date_default_timezone_set("Asia/Jakarta");
	$namahari=date('l');
	$jam =date("h:i:s");
	$tgl =date('d');
	$bln =date('m');
	$thn =date('Y');
	
	if ($namahari == "Sunday") $namahari = "Minggu";
	else if ($namahari == "Monday") $namahari = "Senin";
	else if ($namahari == "Tuesday") $namahari = "Selasa";
	else if ($namahari == "Wednesday") $namahari = "Rabu";
	else if ($namahari == "Thursday") $namahari = "Kamis";
	else if ($namahari == "Friday") $namahari = "Jumat";
	else if ($namahari == "Saturday") $namahari = "Sabtu";
	
	switch($bln){		
		case 1 : $bln='Januari'; break;
		case 2 : $bln='Februari'; break;
		case 3 : $bln='Maret'; break;
		case 4 : $bln='April'; break;
		case 5 : $bln='Mei'; break;
		case 6 : $bln="Juni"; break;
		case 7 : $bln='Juli'; break;
		case 8 : $bln='Agustus'; break;
		case 9 : $bln='September'; break;
		case 10 : $bln='Oktober'; break;		
		case 11 : $bln='November'; break;
		case 12 : $bln='Desember'; break;
		default: $bln='UnKnown'; break;
	}
	$today= $namahari.", ".$tgl." ".$bln." ".$thn;
?>