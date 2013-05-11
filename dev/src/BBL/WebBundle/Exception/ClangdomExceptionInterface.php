<?php
namespace BBL\WebBundle\Exception;

/*
 * interface for Clangdom-Exceptions
 */
interface ClangdomExceptionInterface
{
	
	/*
	 * Return Statuscode
	 */
	public function getStatusCode();
	
	/*
	 * returns Response-Headers
	 */
	public function getHeaders();
}