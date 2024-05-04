<?php
	session_start();
	session_destroy();
	include("config/functions.php");
	redirect("index.php","Anda telah logout");
?>