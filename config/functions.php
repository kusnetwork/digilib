<?php
	function redirect($url,$message){
		if(!empty($message)){
			echo "
			<meta http-equiv='refresh' content='0;url=$url'>
			<script type='text/javascript' language='javascript'>alert('$message');
			</script>";
		}else{
			echo "<meta http-equiv='refresh' content='0;url=$url'>";
		}
	}
	function dateku($date) {
		$day = substr($date, 8, 2);
		$year = substr($date, 0, 4);
		switch(substr($date, 5, 2)){		
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
		return $day." ".$bln." ".$year;	
	}
	
	$date=date('Y-m-d H:i:s');
?>