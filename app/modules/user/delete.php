<?php
	if(!isset($_SESSION['user'])){
		header("Location: ". $CONF["PATH_FROM_ROOT"]);
		exit;
	}
	
	if(isset($_GET['file'])){
						
		require_once APPLICATION_PATH . '/models/Code.php';
		$codeObj = new Code();
		$codeObj->remove($_GET['file'], $_SERVER['user']['id']);
	
		try{
			unlink($file_name);
			$_SESSION['flash'][] = "Successfully deleted";
			header("Location: ". $CONF["PATH_FROM_ROOT"]);
			exit;
		}catch(Exception $e){}
	}
	
	header("Location: ". $CONF["PATH_FROM_ROOT"]);
	exit;
	
?>