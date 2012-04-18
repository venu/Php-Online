<?php
	require_once (APPLICATION_PATH . '/modules/user/parseErrors.php');
	
	if(!isset($_GET['file']) || $_GET['file'] == ''){
		header("Location: ". $CONF["PATH_FROM_ROOT"]);
		exit;		
	}

	$file_name = ROOT_PATH . '/code/' . $_GET['file'] . $CONF["EXTENSION"];
	if (!is_file($file_name)) {
		header("Location: ". $CONF["PATH_FROM_ROOT"]);
		exit;
	}
	
	try{
		$error = php_check_syntax($file_name, true);
		if(is_array($error) && isset($error['line'])){
			echo "Parse Error: at line no ". $error['line'] ."<br>";
			echo "Message: ". $error['msg'] ."<br>";
			exit;	
		}
		
		$error = php_check_runtime($file_name, true);
		if(is_array($error) && isset($error['line'])){
			echo "Error: at line no ". $error['line'] ."<br>";
			echo "Message: ". $error['method'] ." has been disabled for security reasons<br>";
			exit;	
		}
		
		require_once ($file_name);	
		//echo implode(" ",$error);
	}catch(Exception $e){
		echo $message = "Error: at line no " . $e->getLine() . "<br>";
		echo $message = "Message: " . $e->getMessage() . "<br>";
	}
	exit;
?>