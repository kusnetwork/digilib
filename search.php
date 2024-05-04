<?php
	require_once("config/config.php");
	if(isset($_GET['q'])){
		mysql_connect($host,$user,$password);
		mysql_select_db($database);
		
		$param = mysql_escape_string($_GET['q']); 
		$query = mysql_query("SELECT nip, nama FROM dosen WHERE nama LIKE '%$param%'") or die(mysql_error());		
		if(mysql_num_rows($query) > 0){
			$data = array();
			while($row = mysql_fetch_object($query)){
				$data[] = $row;
			}
			die(json_encode($data)); 
		}
	}
?>
