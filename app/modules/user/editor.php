<?php
	$revision = (isset($_GET['revision'])) ? $_GET['revision'] : '';
	if(!isset($_GET['file']) || $_GET['file'] == ''){
		redirect();			
	}

	$file_name = ROOT_PATH . '/code/' . $_GET['file'] . $CONF["EXTENSION"];
	if (!is_file($file_name)) {
		redirect();	
	}
	
	require_once APPLICATION_PATH . '/models/Code.php';
	$codeObj = new Code();
	if(isset($_POST['code'], $_POST['action'])){
		switch($_POST['action']){
			case 'Run':
				if(!file_put_contents($file_name, trim($_POST['code']))){	
					redirect();	
				}
				break;
				
			case 'Download':
				if(!file_put_contents($file_name, trim($_POST['code']))){	
					redirect();	
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

				
			case 'Save':
				
				$data = array();
				$data['filename'] = $_GET['file'];
				$data['code'] = $_POST['code'];
				$data['user_id'] = $_SESSION['user']['id'];
				$revision_id = $codeObj->add($data);
				if($revision_id){
					if(!file_put_contents($file_name, trim($_POST['code']))){	
						redirect();	
					}
					
					header("Location: ".$CONF["PATH_FROM_ROOT"].'/editor/'.$_GET['file'].'/'.$revision_id);	
					exit;
				}else{
					$errors = render_errors($codeObj->getMessages());
					$smarty->assign('errors', $errors);	
				}
				break;
			
		}
	}
	
	
	//get the code
	if(!isset($_POST['code']) && $revision){
		$code_data = $codeObj->getCode($_GET['file'], $revision);
		if(!file_put_contents($file_name, $code_data['code'])){	
			redirect();
		}
		$smarty->assign('code', $code_data['code']);		
	}else{
		$smarty->assign('code', file_get_contents($file_name));			
	}
	
	
	
	//get list of added files
	$files = '';
	if(isset($_SESSION['user'])){
		$files = $codeObj->getMyList($_SESSION['user']['id']);
	}
	$smarty->assign('files', $files);
	
	
?>