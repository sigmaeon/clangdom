<?php
namespace BBL\WebBundle\Exception;

/*
 * Clangdom-Exception
 */
class EntityNotFoundClangdomException extends ClangdomException
{
	 public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(400, $message, $previous, array(), $code);
    }
    
}