<?php
function getScheme()
{
       return (getServer('HTTPS') == 'on') ? 'https' : 'http';
}

function getServer($key = null, $default = null)
{
	if (null === $key) {
		return $_SERVER;
	}

	return (isset($_SERVER[$key])) ? $_SERVER[$key] : $default;
}

function setQuery($spec, $value = null)
{
       if ((null === $value) && !is_array($spec)) {
               return;
       }
       if ((null === $value) && is_array($spec)) {
               foreach ($spec as $key => $value) {
                       setQuery($key, $value);
               }
               return true;
       }
       $_GET[(string) $spec] = $value;
       return true;
}

function getHttpHost()
{
	$host = getServer('HTTP_HOST');
	if (!empty($host)) {
		return $host;
	}

	$scheme = getScheme();
	$name   = getServer('SERVER_NAME');
	$port   = getServer('SERVER_PORT');

	if(null === $name) {
		return '';
	}
	elseif (($scheme == 'http' && $port == 80) || ($scheme == 'https' && $port == 443)) {
		return $name;
	} else {
		return $name . ':' . $port;
	}
}
	
function getRequestUri($requestUri = null)
{
        if ($requestUri === null) {
            if (isset($_SERVER['HTTP_X_REWRITE_URL'])) { // check this first so IIS will catch
                $requestUri = $_SERVER['HTTP_X_REWRITE_URL'];
            } elseif (
                // IIS7 with URL Rewrite: make sure we get the unencoded url (double slash problem)
                isset($_SERVER['IIS_WasUrlRewritten'])
                && $_SERVER['IIS_WasUrlRewritten'] == '1'
                && isset($_SERVER['UNENCODED_URL'])
                && $_SERVER['UNENCODED_URL'] != ''
                ) {
                $requestUri = $_SERVER['UNENCODED_URL'];
            } elseif (isset($_SERVER['REQUEST_URI'])) {
                $requestUri = $_SERVER['REQUEST_URI'];
                // Http proxy reqs setup request uri with scheme and host [and port] + the url path, only use url path
                $schemeAndHttpHost = getScheme() . '://' . getHttpHost();
                if (strpos($requestUri, $schemeAndHttpHost) === 0) {
                    $requestUri = substr($requestUri, strlen($schemeAndHttpHost));
                }
            } elseif (isset($_SERVER['ORIG_PATH_INFO'])) { // IIS 5.0, PHP as CGI
                $requestUri = $_SERVER['ORIG_PATH_INFO'];
                if (!empty($_SERVER['QUERY_STRING'])) {
                    $requestUri .= '?' . $_SERVER['QUERY_STRING'];
                }
            } else {
                return '';
            }
        } elseif (!is_string($requestUri)) {
            return '';
        } else {
            // Set GET items, if available
            if (false !== ($pos = strpos($requestUri, '?'))) {
                // Get key => value pairs and set $_GET
                $query = substr($requestUri, $pos + 1);
                parse_str($query, $vars);
                $this->setQuery($vars);
            }
        }

        return $requestUri;
    }
	
function getBaseUrl($baseUrl = null)
{
	if ($baseUrl === null) {
		$filename = (isset($_SERVER['SCRIPT_FILENAME'])) ? basename($_SERVER['SCRIPT_FILENAME']) : '';

		if (isset($_SERVER['SCRIPT_NAME']) && basename($_SERVER['SCRIPT_NAME']) === $filename) {
			$baseUrl = $_SERVER['SCRIPT_NAME'];
		} elseif (isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) === $filename) {
			$baseUrl = $_SERVER['PHP_SELF'];
		} elseif (isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $filename) {
			$baseUrl = $_SERVER['ORIG_SCRIPT_NAME']; // 1and1 shared hosting compatibility
		} else {
			// Backtrack up the script_filename to find the portion matching
			// php_self
			$path    = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '';
			$file    = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : '';
			$segs    = explode('/', trim($file, '/'));
			$segs    = array_reverse($segs);
			$index   = 0;
			$last    = count($segs);
			$baseUrl = '';
			do {
				$seg     = $segs[$index];
				$baseUrl = '/' . $seg . $baseUrl;
				++$index;
			} while (($last > $index) && (false !== ($pos = strpos($path, $baseUrl))) && (0 != $pos));
		}

		// Does the baseUrl have anything in common with the request_uri?
		$requestUri = getRequestUri();

		if (0 === strpos($requestUri, $baseUrl)) {
			// full $baseUrl matches
			return $baseUrl;
		}

		if (0 === strpos($requestUri, dirname($baseUrl))) {
			// directory portion of $baseUrl matches
			$baseUrl = rtrim(dirname($baseUrl), '/');
			return $baseUrl;
		}

		$truncatedRequestUri = $requestUri;
		if (($pos = strpos($requestUri, '?')) !== false) {
			$truncatedRequestUri = substr($requestUri, 0, $pos);
		}

		$basename = basename($baseUrl);
		if (empty($basename) || !strpos($truncatedRequestUri, $basename)) {
			// no match whatsoever; set it blank
			return '';
		}

		// If using mod_rewrite or ISAPI_Rewrite strip the script filename
		// out of baseUrl. $pos !== 0 makes sure it is not matching a value
		// from PATH_INFO or QUERY_STRING
		if ((strlen($requestUri) >= strlen($baseUrl))
			&& ((false !== ($pos = strpos($requestUri, $baseUrl))) && ($pos !== 0)))
		{
			$baseUrl = substr($requestUri, 0, $pos + strlen($baseUrl));
		}
	}

	return rtrim($baseUrl, '/');
}
	
	
function exceptionHandler($exception) {

    // these are our templates
    $traceline = "#%s %s(%s): %s(%s)";
    $msg = "PHP Fatal error:  Uncaught exception '%s' with message '%s' in %s:%s\nStack trace:\n%s\n  thrown in %s on line %s";

    // alter your trace as you please, here
    $trace = $exception->getTrace();
    foreach ($trace as $key => $stackPoint) {
        // I'm converting arguments to their type
        // (prevents passwords from ever getting logged as anything other than 'string')
        $trace[$key]['args'] = array_map('gettype', $trace[$key]['args']);
    }

    // build your tracelines
    $result = array();
    foreach ($trace as $key => $stackPoint) {
        $result[] = sprintf(
            $traceline,
            $key,
            $stackPoint['file'],
            $stackPoint['line'],
            $stackPoint['function'],
            implode(', ', $stackPoint['args'])
        );
    }
    // trace always ends with {main}
    $result[] = '#' . ++$key . ' {main}';

    // write tracelines into main template
    $msg = sprintf(
        $msg,
        get_class($exception),
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine(),
        implode("\n", $result),
        $exception->getFile(),
        $exception->getLine()
    );

    // log or echo as you please
	error_log($msg , 3 , ROOT_PATH . "/log/error.log");

}


function rand_string($length=6) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
	$code = "";
	while (strlen($code) < $length) {
		$code .= $chars[mt_rand(0,strlen($chars)-1)];
	}
	return $code;
}

function rand_num($n=5){
	return rand(0, pow(10, $n));
}

function sql_safe($s)
{
	if (get_magic_quotes_gpc())
		$s = stripslashes($s);

	return mysql_real_escape_string($s);
}


function render_errors($messages){
	if ($messages){
		$html = '<div class=\'errorMsg\'><ul>';
		foreach ($messages as $msg){
			if(is_array($msg)){
				foreach ($msg as $k=>$v){
					$html .=  '<li>'. $v . '</li>';
				}
			}else{
				$html .=  $msg ;
			}
		}
		return $html .= '</ul></div>';	
	}		
	
	return '';
} 


function redirect($path = ''){
	global $CONF;
	
	header("Location: ". $CONF["PATH_FROM_ROOT"] . $path);
	exit;	
}
?>