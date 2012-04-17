<?php
	if(isset($_POST['code']) && $_POST['code']!=''){
		while (true) {
			$file = rand_string();;
			$filename = ROOT_PATH . '/code/' . $file . $CONF["EXTENSION"];
			if (!file_exists($filename)) break;
		}
		
		if(file_put_contents($filename, trim($_POST['code']))){	
			header("Location: editor/". $file);
			exit;
		}else{
			header("Location: ". $CONF["PATH_FROM_ROOT"]);
			exit;	
		}
	}
?>