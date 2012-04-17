<?php

function makeThumbnail($o_file, $t_ht)
{
   $image_info = getImageSize($o_file) ; // see EXIF for faster way

   switch ($image_info['mime']) {
       case 'image/gif':
           if (imagetypes() & IMG_GIF)  { // not the same as IMAGETYPE
               $o_im = imageCreateFromGIF($o_file) ;
           } else {
               $ermsg = 'GIF images are not supported<br />';
           }
           break;
       case 'image/jpeg':
           if (imagetypes() & IMG_JPG)  {
               $o_im = imageCreateFromJPEG($o_file) ;
           } else {
               $ermsg = 'JPEG images are not supported<br />';
           }
           break;
       case 'image/png':
           if (imagetypes() & IMG_PNG)  {
               $o_im = imageCreateFromPNG($o_file) ;
           } else {
               $ermsg = 'PNG images are not supported<br />';
           }
           break;
       case 'image/wbmp':
           if (imagetypes() & IMG_WBMP)  {
               $o_im = imageCreateFromWBMP($o_file) ;
           } else {
               $ermsg = 'WBMP images are not supported<br/>';
           }
           break;
       default:
           $ermsg = $image_info['mime'].' images are not supported<br />';
           break;
   }

   if (!isset($ermsg)) 
   {
       $o_wd = imagesx($o_im); 
       $o_ht = imagesy($o_im);
	  
	   $t_wd=$t_ht;
	   if($o_wd<$t_wd &&$o_ht<$t_ht )
	   {
	   		$t_ht=$o_ht;
			
			$t_wd=$o_wd;
	   }
	   else
	   {
		   // thumbnail width = target * original width / original height
		   $w = round($o_wd * $t_ht / $o_ht) ;
		   $h = round($o_ht * $t_wd / $o_wd) ;
		    
		   if($t_ht > $o_ht)
		   {
			   if(($t_ht-$h)<($t_wd-$w))
			   {
					$t_wd=& $w;
			   }
			   else
			   {
					$t_ht =& $h;
			   }

		   }
		   else
		   {
		   	   $t_wd=& $w;
		   }
	   }
       $t_im = imageCreateTrueColor($t_wd,$t_ht);
		
       imageCopyResampled($t_im, $o_im, 0, 0, 0, 0, $t_wd, $t_ht, $o_wd, $o_ht);
        return $t_im;

   }
   return isset($ermsg)?$ermsg:NULL;
}

function resize_values($o_wd,$o_ht ,$t_wd,$t_ht)
{
	   if($o_wd<$t_wd &&$o_ht<$t_ht )
	   {
	   		$t_ht=$o_ht;
			
			$t_wd=$o_wd;
	   }
	   else
	   {
		   // thumbnail width = target * original width / original height
		   $w = round($o_wd * $t_ht / $o_ht) ;
		   $h = round($o_ht * $t_wd / $o_wd) ;
		    
		   if($t_ht > $o_ht)
		   {
			   if(($t_ht-$h)<($t_wd-$w))
			   {
					$t_wd=& $w;
			   }
			   else
			   {
					$t_ht =& $h;
			   }

		   }
		   else
		   {
		   	   $t_wd=& $w;
		   }
	   }
	   
	   return array($t_wd,$t_ht);
}
?>
