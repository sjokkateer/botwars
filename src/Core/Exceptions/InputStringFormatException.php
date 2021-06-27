<?php

namespace App\Core\Exceptions;

class InputStringFormatException extends \Exception
{
    public function __construct(string $stdInString)
    {
        parent::__construct("Processing of '$stdInString' resulted in lack of game data.");
    }
}
