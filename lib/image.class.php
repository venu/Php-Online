<?php
/* (C) ABK-Soft Ltd., 2004-2006
IMPORTANT: This is a commercial software product
and any kind of using it must agree to the ABK-Soft
Ltd. license agreement.
It can be found at http://abk-soft.com/license.doc
This notice may not be removed from the source code. */

class Image
{
	var $image = FALSE;
	var $image_type = 2; 
	
	function loadImage($path)
	/*
	This function loads the image you want to resize.
	The function will return TRUE on a succes and FALSE on failure
	*/
	{
	    if ( $this->image ) {
	        imagedestroy($this->image);
	    }
	    
	    $img_sz = getimagesize($path);
	    switch( $img_sz[2] ){
	        case 1: 
	            $this->image_type = "GIF";
	            if ( !($this->image = imageCreateFromGif($path)) ) {
	                return FALSE;
	            } else {
	                return TRUE;
	            }
	            break;
	        case 2: 
	            $this->image_type = "JPG";
	            if ( !($this->image = imageCreateFromJpeg($path)) ) {
	                return FALSE;
	            } else {
	                return TRUE;
	            }
	            break;
	        case 3: 
	            $this->image_type = "PNG";
	            if ( !($this->image = imageCreateFromPng($path)) ) {
	                return FALSE;
	            } else {
	                return TRUE;
	            }
	            break;
	        case 4: 
	            $this->image_type = "SWF";
	            if ( !($this->image = imageCreateFromSwf($path)) ) {
	                return FALSE;
	            } else {
	                return TRUE;
	            }
	            break;
	        default:
	            return FALSE;
	    }
	}
	
	function saveImage($path, $quality)
	/*
	Save the image, to either a new or an already existing file.
	The quality setting determines the quality of the image (0 to 100).
	The function will return TRUE on a succes and FALSE on failure
	*/
	{
	    if (!$this->image) {
	        return FALSE;
	    }
	    $fp = fopen($path, "w");
	    if (!$fp) {

	        return FALSE;
	    } else {
	        fclose($fp);
	        @chmod($path, 0777);
	        if (!imageJpeg($this->image, $path, $quality)) {
	            return FALSE;
	        } else {
	            return TRUE;
	        }
	    }
	}
	
	function clearImage()
	/*
	Clears the memory used for the image (if it is loaded)
	This function is required to ensure that there are no memory leaks!
	you have to run this function after your resizing is complete.
	The function always returns TRUE
	*/
	{
	    if ($this->image) {
	        imagedestroy($this->image);
	        $this->image = FALSE;
	        return TRUE;
	    } else {
	        return TRUE;
	    }
	}
	
	function getWidth()
	/*
	returns the width of the loaded image
	*/
	{
	    if (!$this->image) {
	        return 0;
	    }
	    return imageSX($this->image);
	}
	
	function getHeight()
	/*
	returns the Height of the loaded image
	*/
	{
	    if (!$this->image) {
	        return 0;
	    }
	    return imageSY($this->image);
	}
	
	function resizeW($newWidth)
	/*
	resizes an image accordingly to fit the newWidth and remain proportions
	*/
	{
	    if (!$this->image) {
	        return FALSE;
	    }
	    $oldWidth = imageSX($this->image);
	    $oldHeight = imageSY($this->image);
	    $newHeight = ($oldHeight / ($oldWidth / $newWidth));
	    
	    $imageNew = ImageCreateTrueColor($newWidth, $newHeight);    
	    imageCopyResampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
	    imageDestroy($this->image);
	    $this->image = $imageNew;
	    return TRUE;
	}
	
	function resizeH($newHeight)
	/*
	resizes an image accordingly to fit the newHeight and remain proportions
	*/ 
	{
	    if (!$this->image) {
	        return FALSE;
	    }
	    $oldWidth = imageSX($this->image);
	    $oldHeight = imageSY($this->image);
	    $newWidth = ($oldWidth / ($oldHeight / $newHeight));
	    
	    $imageNew = ImageCreateTrueColor($newWidth, $newHeight);    
	    imageCopyResampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
	    imageDestroy($this->image);
	    $this->image = $imageNew;
	    return TRUE;
	}
	    
	function resizeWH($maxWidth, $maxHeight, $stretch=FALSE, $str = "", $font_size = 0, $img_type = "")
	/*
	resizes an image accordingly to fit the maxWidth and maxHeight.
	By default it retains proportions. If however stretch is set to TRUE it
	will stretch the image to the maxWidth and maxHeight.
	*/ 
	{
	    if (!$this->image) {
	        return FALSE;
	    }
	    $oldWidth = imageSX($this->image);
	    $oldHeight = imageSY($this->image);
	    $newWidth= $maxWidth;
	    $newHeight= $maxHeight;     
		if($newWidth >= $oldWidth && $newHeight >= $oldHeight)   {
			$newHeight = $oldHeight;
			$newWidth= $oldWidth;
		} elseif (!$stretch) {
	        $ratio = $oldWidth / $oldHeight;
	        if (($maxWidth  / $maxHeight) < $ratio) {
	            $newHeight = ($oldHeight / ($oldWidth / $maxWidth));
	        } else {
	            $newWidth = ($oldWidth / ($oldHeight / $maxHeight));
	        }
	    }
	    
	    $imageNew = ImageCreateTrueColor($newWidth, $newHeight);
	    imageCopyResampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
	    
	    $imageNew = ImageCreateTrueColor($newWidth, $newHeight);    
		
	    imageCopyResampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);

		$dest=$imageNew;

		$w_dest = $newWidth;
		$h_dest = $newHeight;

		if ($font_size>0)
		{
			$size = $font_size; // ������ ������ 
			$x_text = $w_dest-imagefontwidth($size)*strlen($str)-3; 
			$y_text = $h_dest-imagefontheight($size)-3; 

			// ���������� ����� ������ �� ����� ���� �������� ����� 
			$white = imagecolorallocate($dest, 255, 255, 255); 
			$black = imagecolorallocate($dest, 0, 0, 0); 
			$gray = imagecolorallocate($dest, 127, 127, 127); 
			if (imagecolorat($dest,$x_text,$y_text)>$gray) $color = $black; 
			if (imagecolorat($dest,$x_text,$y_text)<$gray) $color = $white; 

			// ������� ����� 
			imagestring($dest, $size, $x_text-1, $y_text-1, $str,$white-$color); 
			imagestring($dest, $size, $x_text+1, $y_text+1, $str,$white-$color); 
			imagestring($dest, $size, $x_text+1, $y_text-1, $str,$white-$color); 
			imagestring($dest, $size, $x_text-1, $y_text+1, $str,$white-$color); 

			imagestring($dest, $size, $x_text-1, $y_text,   $str,$white-$color); 
			imagestring($dest, $size, $x_text+1, $y_text,   $str,$white-$color); 
			imagestring($dest, $size, $x_text,   $y_text-1, $str,$white-$color); 
			imagestring($dest, $size, $x_text,   $y_text+1, $str,$white-$color); 

			imagestring($dest, $size, $x_text,   $y_text,   $str,$color); 
		}
	    
	    imageDestroy($this->image);
	    $this->image = $imageNew;
	    return TRUE;
	}
	
	function resizeCropped($width, $height, $str, $font_size)
	/*
	resizes an image to the width and height arguments.
	If needed parts of the image will be cropped to remain proportions
	** note this is a function I quickly hacked in, I hope it works ok,
	    but I haven't had a chance to properly test it, or to review the code I wrote here yet
	*/
	{
	    if (!$this->image) {
	        return FALSE;
	    }
	    $oldWidth = imageSX($this->image);
	    $oldHeight = imageSY($this->image);
	    
	    $ratioW = $oldWidth / $width;
	    $ratioH = $oldHeight / $height;
	    if ($ratioH > $ratioW) {
	        // some parts from the height will have to be cut off
	        $newWidth = $oldWidth;
	        $newHeight = $height * $ratioW;
	        $srcX = 0;
	        $srcY = 0;
	        #$srcY = +($oldHeight - $newHeight) / 2;
	    } else {
	        // some parts from the width will have to be cut off
	        $newWidth = $width * $ratioH;
	        $newHeight = $oldHeight;
	        #$srcX = 0;
	        $srcX = +($oldWidth - $newWidth) / 2;
	        $srcY = 0;
	    }
	    $imageNew = ImageCreateTrueColor($newWidth, $newHeight);    
	    imageCopyResampled($imageNew, $this->image, 0, 0, $srcX, $srcY, $oldWidth, $oldHeight, $oldWidth, $oldHeight);
	    imageDestroy($this->image);
	    $this->image = $imageNew;
	    
	    // Now we are actually going to resample the image to the correct size        
	    $oldWidth = $newWidth;
	    $oldHeight = $newHeight;
	    $newWidth = $width;
	    $newHeight = $height;
	            
	    $imageNew = ImageCreateTrueColor($newWidth, $newHeight);    
		imageCopyResampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);

		$dest=$imageNew;

		$w_dest = $newWidth;
		$h_dest = $newHeight;

		if ($font_size>0)
		{
			$size = $font_size; // ������ ������ 
			$x_text = $w_dest-imagefontwidth($size)*strlen($str)-3; 
			$y_text = $h_dest-imagefontheight($size)-3; 

			// ���������� ����� ������ �� ����� ���� �������� ����� 
			$white = imagecolorallocate($dest, 255, 255, 255); 
			$black = imagecolorallocate($dest, 0, 0, 0); 
			$gray = imagecolorallocate($dest, 127, 127, 127); 
			if (imagecolorat($dest,$x_text,$y_text)>$gray) $color = $black; 
			if (imagecolorat($dest,$x_text,$y_text)<$gray) $color = $white; 

			// ������� ����� 
			imagestring($dest, $size, $x_text-1, $y_text-1, $str,$white-$color); 
			imagestring($dest, $size, $x_text+1, $y_text+1, $str,$white-$color); 
			imagestring($dest, $size, $x_text+1, $y_text-1, $str,$white-$color); 
			imagestring($dest, $size, $x_text-1, $y_text+1, $str,$white-$color); 

			imagestring($dest, $size, $x_text-1, $y_text,   $str,$white-$color); 
			imagestring($dest, $size, $x_text+1, $y_text,   $str,$white-$color); 
			imagestring($dest, $size, $x_text,   $y_text-1, $str,$white-$color); 
			imagestring($dest, $size, $x_text,   $y_text+1, $str,$white-$color); 

			imagestring($dest, $size, $x_text,   $y_text,   $str,$color); 
		}

	    imageDestroy($this->image);
	    $this->image = $imageNew;
	    
	    return TRUE;    
	}
	
	function resizeWH_transparent( $width = 0, $height = 0, $proportional = true, $dest_file ){
		if ( $height <= 0 && $width <= 0 ) {
			return false;
		}
		
		$image = $this->image;
		
		$final_width = 0;
		$final_height = 0;
		
		$width_old = imageSX($this->image);
		$height_old = imageSY($this->image);
		// list($width_old, $height_old) = $info;
		
		if ($proportional) {
			if ($width == 0) $factor = $height/$height_old;
			elseif ($height == 0) $factor = $width/$width_old;
			else $factor = min ( $width / $width_old, $height / $height_old);   
			
			$final_width = round ($width_old * $factor);
			$final_height = round ($height_old * $factor);
		}
		else {
			$final_width = ( $width <= 0 ) ? $width_old : $width;
			$final_height = ( $height <= 0 ) ? $height_old : $height;
		}
		
		/*switch ( $info[2] ) {
			case IMAGETYPE_GIF:
			$image = imagecreatefromgif($file);
			break;
			case IMAGETYPE_JPEG:
			$image = imagecreatefromjpeg($file);
			break;
			case IMAGETYPE_PNG:
			$image = imagecreatefrompng($file);
			break;
			default:
			return false;
		}*/
		
		$image_resized = imagecreatetruecolor( $final_width, $final_height );
		
		if ( ($this->image_type == 'GIF') || ($this->image_type == 'PNG') ) {
			$trnprt_indx = imagecolortransparent($image);
			
			// If we have a specific transparent color
			if ($trnprt_indx >= 0) {
				// Get the original image's transparent color's RGB values
				$trnprt_color    = imagecolorsforindex($image, $trnprt_indx);
				
				// Allocate the same color in the new image resource
				$trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
				
				// Completely fill the background of the new image with allocated color.
				imagefill($image_resized, 0, 0, $trnprt_indx);
				
				// Set the background color for new image to transparent
				imagecolortransparent($image_resized, $trnprt_indx);
			} 
			// Always make a transparent background color for PNGs that don't have one allocated already
			elseif ($this->image_type == 'PNG') {
			
				// Turn off transparency blending (temporarily)
				imagealphablending($image_resized, false);
				
				// Create a new transparent color for image
				$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
				
				// Completely fill the background of the new image with allocated color.
				imagefill($image_resized, 0, 0, $color);
				
				// Restore transparency blending
				imagesavealpha($image_resized, true);
			}
		}
		
		imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
		
		switch ( $this->image_type) {
			case 'GIF':
			imagegif($image_resized, $dest_file);
			break;
			case 'JPG':
			imagejpeg($image_resized, $dest_file);
			break;
			case 'PNG':
			imagepng($image_resized, $dest_file);
			break;
			default:
			return false;
		}
		
		return true;
	}
}



?>