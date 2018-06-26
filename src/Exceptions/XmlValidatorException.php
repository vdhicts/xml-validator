<?php

namespace Vdhicts\Dicms\XmlValidator\Exceptions;

use Exception;

class XmlValidatorException extends Exception
{
    /**
     * Returns an exception when the file is missing.
     * @param string $file
     * @return XmlValidatorException
     */
    public static function fileMissing(string $file): XmlValidatorException
    {
        return new self(
            sprintf('The provided file `%s` doesn\'t exists', $file)
        );
    }

    /**
     * Returns an exception when the file isn't readable.
     * @param string $file
     * @return XmlValidatorException
     */
    public static function fileNotReadable(string $file): XmlValidatorException
    {
        return new self(
            sprintf('The provided file `%s` isn\'t readable', $file)
        );
    }
}
