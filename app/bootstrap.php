<?php 
	//start session
	session_start();

	//load configaration
	require("config/conf.inc.php");	
	
	
	// Connect to DB
	require('Zend/Db.php');
	require('Zend/Db/Table/Abstract.php');
	$db = Zend_Db::factory('Pdo_Mysql', array(
		'host'     => $CONF["MYSQL_HOSTNAME"],
		'username' => $CONF["MYSQL_USERNAME"],
		'password' => $CONF["MYSQL_PASSWORD"],
		'dbname'   => $CONF["MYSQL_DATABASE"]
	));
	Zend_Db_Table_Abstract::setDefaultAdapter($db);	
	
	//set default timezone
	date_default_timezone_set($CONF["SITE_TIMEZONE"]);
	

	// Smarty Instantiation and intialization of public variables
	require(LIBRARY_PATH . '/smarty-app/libs/Smarty.class.php');
	$smarty = new Smarty;
	$smarty->template_dir = APPLICATION_PATH . '/views';
	$smarty->config_dir = 'configs';
	$smarty->cache_dir = LIBRARY_PATH . '/smarty/cache';
	$smarty->compile_dir = LIBRARY_PATH . '/smarty/templates_c';
	$smarty->assign('CONF', $CONF);
	$smarty->assign("public_path", $CONF["PATH_FROM_ROOT"]);		
	
	
	// Dispatch the request to correponding action	
	$file = 'user/home';
	$page = 'home';
	if (isset($_GET['p']) && $_GET['p'] != '')	{ 
		$file = 'user/' . $_GET['p'];
		$page = $_GET['p'];
	}
	
	$smarty->assign('module', 'user');
	$smarty->assign('page', $page);
	if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){
		$smarty->assign('error', $_SESSION['msg']);
		unset($_SESSION['msg']);
	}
	
	$is_ajax = 0;
	if( ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' ) || isset($_REQUEST['ajax'])) {
		$is_ajax = 1;
	}
	

	
	// Application related code
	if (!is_file(APPLICATION_PATH . '/modules/'. $file .'.php')) {
		$template_name = PUBLIC_PATH .'/404.html';
		$smarty->assign("template_name",$template_name);
	}else {
		require_once ('modules/'. $file .'.php');
		$template_name = $file.'.tpl';
		$smarty->assign("template_name",$template_name);
	}
	
	
	if( $is_ajax) {
		$smarty->display("aj_frame.tpl");			
	}else{
		$smarty->display("user_frame.tpl");			
	}
	
?>
	