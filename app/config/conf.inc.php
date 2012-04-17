<?php
// SYSTEM ERROR MESSAGES //////////////////////////////////////////////////////////////
	$CONF["404_NOT_FOUND_ERROR_MESSAGE"] =	"404, Page not found";
	$CONF["NO_ACCESS_MESSAGE"] =	"Sorry. You are not allowed to access this page";

// GENERAL SITE CONFIGURATIONS ////////////////////////////////////////////////////////


	$CONF["EXTENSION"] = ".venuphp+";
	
	
	require(LIBRARY_PATH . '/utilities.php');
	
	switch(APPLICATION_ENV){	
		case  'development':
			ini_set("display_errors", 1);
			error_reporting(E_ALL | E_STRICT);
			require(APPLICATION_PATH . "/config/conf_dev.inc.php");	
			break;	
			
		case  'staging':
			ini_set("display_errors", 1);
			error_reporting(E_ALL | E_STRICT);
			require(APPLICATION_PATH . "/config/conf_stag.inc.php");	
			break;	
			
		default:
			ini_set("display_errors", 0);
			error_reporting(0);
			set_exception_handler('exceptionHandler'); //set_exception_handler;		
			require(APPLICATION_PATH . "/config/conf_prod.inc.php");
	}	
	
	
?>