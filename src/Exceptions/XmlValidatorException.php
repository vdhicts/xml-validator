<?php

namespace Vdhicts\XmlValidator\Exceptions;

use Exception;

class XmlValidatorException extends Exception
{
    public static function fileMissing(string $file): XmlValidatorException
    {
        return new self(
            sprintf('The provided file `%s` doesn\'t exists', $file)
        );
    }

    public static function fileNotReadable(string $file): XmlValidatorException
    {
        return new self(
            sprintf('The provided file `%s` isn\'t readable', $file)
        );
    }
}
