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
		if(is_array($error)){
			echo "Parse Error: at line no ". $error['line'] ."<br>";
			echo "Message: ". $error['msg'] ."<br>";
			exit;	
		}
		
		$error = php_check_runtime($file_name, true);
		if(is_array($error)){
			echo "Errors: at line no ". $error['line'] ."<br>";
			echo "Message: ". $error['method'] ." has been disabled for security reasons<br>";
			exit;	
		}
		
		require_once ($file_name);	
	}catch(Exception $e){
		echo $message = "Message: " . $e->getMessage() . "<br>";
        //echo $message .= "Trace:<br>" . $e->getTraceAsString() . "<br>";
	}
	exit;
?>