<?php
namespace BBL\WebBundle\Exception;

/*
 * Clangdom-Exception
 */
class UnauthorizedClangdomException extends ClangdomException
{
	 public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(401, $message, $previous, array(), $code);
    }
    
}