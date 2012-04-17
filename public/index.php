<?php  
	//Load Environment
	define('ENV_MODE','development');
	
	// Define path to application directory
	defined('APPLICATION_PATH')  || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));
	
	// Define path to lib directory
	defined('LIBRARY_PATH')  || define('LIBRARY_PATH', realpath(dirname(__FILE__) . '/../lib'));
	
	// Define path to root directory
	defined('ROOT_PATH')  || define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
	
	// Define path to root directory
	defined('PUBLIC_PATH')  || define('PUBLIC_PATH', realpath(dirname(__FILE__)));
	
	set_include_path(implode(PATH_SEPARATOR, array(
		realpath(APPLICATION_PATH . '/../lib'),
		get_include_path(),
	)));
	
	// Include bootsrap.php which includes all the necessary files and does the routing
	require (APPLICATION_PATH . "/bootstrap.php");	
?>