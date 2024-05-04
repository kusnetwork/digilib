<?php
	copy($_FILES['file']['tmp_name'], '../../media/'.$_FILES['file']['name']);
	$array = array(
		'filelink' => "media/".$_FILES['file']['name'],
		'filename' => $_FILES['file']['name']
	);
	 
	echo stripslashes(json_encode($array));	
?>