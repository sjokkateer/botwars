<?php

namespace App\Core\Exceptions;

class StdInReadingException extends \Exception
{
    public function __construct(string $stdInString)
    {
        parent::__construct("Something went wrong reading the stdin value read: '$stdInString'.");
    }
}
