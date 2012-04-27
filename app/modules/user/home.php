<?php
	if(isset($_POST['code']) && $_POST['code']!=''){
		while (true) {
			$file = rand_string();;
			$filename = ROOT_PATH . '/code/' . $file . $CONF["EXTENSION"];
			if (!file_exists($filename)) break;
		}
		
		try{
			if(file_put_contents($filename, trim($_POST['code']))){	
				header("Location: ".$CONF["PATH_FROM_ROOT"]."/editor/". $file);
				exit;
			}else{
				header("Location: ". $CONF["PATH_FROM_ROOT"]);
				exit;	
			}
		}catch(Exception $e){
			header("Location: ". $CONF["PATH_FROM_ROOT"]);
			exit;
		}
	}
	
	//get list of added files
	$files = '';
	if(isset($_SESSION['user'])){
		require_once APPLICATION_PATH . '/models/Code.php';
		$codeObj = new Code();
		$files = $codeObj->getMyList($_SESSION['user']['id']);
	}
	$smarty->assign('files', $files);
?>