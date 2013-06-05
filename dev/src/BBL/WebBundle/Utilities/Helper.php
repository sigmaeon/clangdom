<?php
namespace BBL\WebBundle\Utilities;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Helper{

	public static function checkSpecials($string)
	{
		$chars = array('?', '<', '>', '!', '^', '`', '|', '{', '}', '#', '/');
		foreach($chars as $char)
		{
			if(strpos($string, $char) !== false) return false;
		}
		return true;
	}
	
	/**
	 * Checks if the extension of an Uploaded File is contained in an array of strings
	 * 
	 * @param UploadedFile $file A Uploaded file which should be checked
	 * @param array $array A array with Strings to compair
	 * @return returns true if a string equals the extension
	 * 
	 */
	public static function checkExtension(UploadedFile $file, $array)
	{
		foreach($array as $ext)
		{
			if($file->guessExtension() == $ext) return true;
		}
		
		return false;
		
	}
	
}
