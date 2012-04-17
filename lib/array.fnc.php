<?php


	function in_iarray($needle, $haystack) {

		

		foreach($haystack as $key => $value) {

			if (strtolower($needle) == strtolower($value)) return true;

		}

		return false;

	}

	

	function in_multiarray($array, $needle) {

		foreach($array as $key => $val) {

			if (is_array($val)) {

				if (in_multiarray($val, $needle)) return true;

			} else {

				if ($val == $needle) return true;

			}

		}

		return false;

	}
	
	
	function array_remove($string, $array) 
	{

		foreach ($array as $key => $value) 
		{

			if (is_array($value)) 
			{

				array_remove($string, $value);

			} 
			else 
			{
				if ($value == $string) {

					unset($array[$key]);

				}

			}

		}

		return $array;

	}


?>