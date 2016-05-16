<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$info = ee('App')->get('coldpress');

class Coldpress {
	public $return_data = '';

	function Coldpress() {
		$rootP = explode("/", SYSPATH );	
		$rootP = array_slice($rootP, 0, 6);
		$rootP = implode("/", $rootP);
		$imageP = ee()->TMPL->tagdata;		
		$fname = explode("/", $imageP);
		$fname = array_slice($fname, 4);
		$fname = implode("", $fname);
		$source_url = $rootP.$imageP;
		$compressedP =  PATH_THIRD."coldpress/compressed/";
		$compressed_url = $compressedP.$imageP;
		$compressed_folder =  $rootP."/coldpressed_img/";	
		$compressed_file = $compressed_folder.$fname;

		if (!is_writable($compressed_folder)){
			echo "Cannot write to the server as user: ".get_current_user();
			exit();
		} 
		
		if (!file_exists($compressed_folder)) {
		    mkdir($compressed_folder, 0777, true);
		}
		
		if (!file_exists($compressed_file)) {		
			//if the file has 5 digits, XX.XXX KB or greater more aggressive compression
			$flen = filesize($source_url); 
		    if($flen > 5){	
			    $quality = "60";
		    }else{
			    $quality = "75";
		    }
	
			$fi = getimagesize($source_url);
		    if ($fi['mime'] == 'image/jpeg') {
			    $image = imagecreatefromjpeg($source_url);
			    imagejpeg($image, $compressed_file, $quality);	
		    }elseif ($fi['mime'] == 'image/gif'){
			    $image = imagecreatefromgif($source_url);
			    $background = imagecolorallocate($image, 0, 0, 0);
			    imagecolortransparent($image, $background);
		    }elseif ($fi['mime'] == 'image/png'){
			    $image = imagecreatefrompng($source_url);
			    $background = imagecolorallocate($image, 0, 0, 0);	    
			    imagecolortransparent($image, $background);
			    imagealphablending($image, false);
			    imagesavealpha($image, true);
			    $quality = (100-$quality)*.1;
			    imagepng($image, $compressed_file, $quality);	
		    }
		}

		$this->return_data = base_url()."coldpressed_img/".$fname;
	}
}
/* End of file pi.coldpress.php */ 
/* Location: /__ee_admin/user/addons/coldpress/pi.coldpress.php */
?>