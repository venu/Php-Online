<?php
	if(!isset($_GET['file']) || $_GET['file'] == ''){
		header("Location: ". $CONF["PATH_FROM_ROOT"]);
		exit;		
	}

	$file_name = ROOT_PATH . '/code/' . $_GET['file'] . $CONF["EXTENSION"];
	if (!is_file($file_name)) {
		header("Location: ". $CONF["PATH_FROM_ROOT"]);
		exit;
	}
	
	if(isset($_POST['code'], $_POST['action'])){
		switch($_POST['action']){
			case 'Run':
				if(!file_put_contents($file_name, trim($_POST['code']))){	
					header("Location: ". $CONF["PATH_FROM_ROOT"]);
					exit;	
				}else{
					header("Location: ".$CONF["PATH_FROM_ROOT"].'/editor/'.$_GET['file']);	
					exit;
				}
				break;
				
			case 'Download':
				if(!file_put_contents($file_name, trim($_POST['code']))){	
					header("Location: ". $CONF["PATH_FROM_ROOT"]);
					exit;	
				}else{
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename='.$_GET['file'].'.php');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file_name));
					ob_clean();
					flush();
					readfile($file_name);
					exit;
				}
				break;
				
			case 'Delete':
				if(!file_put_contents($file_name, trim($_POST['code']))){	
					header("Location: ". $CONF["PATH_FROM_ROOT"]);
					exit;	
				}else{
					unlink($file_name);
					header("Location: ". $CONF["PATH_FROM_ROOT"]);
					exit;
				}
				break;
			
		}
	}
	
	$smarty->assign('code', file_get_contents($file_name));		
?>