<?php
	session_destroy();	
	
	header("Location: ". $CONF["PATH_FROM_ROOT"]);
	exit;
	
?>