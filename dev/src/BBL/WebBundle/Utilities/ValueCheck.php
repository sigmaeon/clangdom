<?php
namespace BBL\WebBundle\Utilities;

class ValueCheck {

	public static function checkSpecials($string)
	{
		$chars = array('?', '<', '>', '!', '^', '`', '|', '{', '}', '#', '/');
		foreach($chars as $char)
		{
			if(strpos($string, $char) !== false) return false;
		}
		return true;
	}
	
}
