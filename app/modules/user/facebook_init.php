<?php

	require 'facebook/src/facebook.php';

	$facebook = new Facebook(array(
	  'appId'  => $CONF['FB_APP_ID'],
	  'secret' => $CONF['FB_APP_SECRET'],
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		if(!isset($_SESSION['user'])){	
			$me =  $facebook->api('/me');
			register($me);
		}else{
				
			if($_SESSION['user']['fb_id'] != $user){
				$_SESSION = array();
				$me =  $facebook->api('/me');
				register($me);
			}
		}
		
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
		session_destroy();
	  }
	}else{
		session_destroy();	
	}	
	
	
	//store it persistance
	function register($me){
		require APPLICATION_PATH . '/models/User.php';
		$userObj = new User();
		$data_add['name'] = $me['name'];
		$data_add['fb_id'] = $me['id'];
		$data = $userObj->register($data_add);
		if($data != false){
			$_SESSION['user'] = $data;
		}	
	}
	
	//logout URL
	$logoutUrl = '';
	if(isset($_SESSION['user'])){
		$logoutUrl = $facebook->getLogoutUrl();
	}
	$smarty->assign('logoutUrl', $logoutUrl);
	
	
?>