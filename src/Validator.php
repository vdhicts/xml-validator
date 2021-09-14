<?php

namespace Vdhicts\XmlValidator;

use Vdhicts\XmlValidator\Exceptions\XmlValidatorException;
use XMLReader;

class Validator
{
    /**
     * @throws XmlValidatorException
     */
    private function validateFileName(string $fileName): void
    {
        if (!file_exists($fileName)) {
            throw XmlValidatorException::fileMissing($fileName);
        }

        if (!is_readable($fileName)) {
            throw XmlValidatorException::fileNotReadable($fileName);
        }
    }

    /**
     * Validates the XML file.
     * @param string $xmlFileName
     * @param string|null $xsdFileName
     * @return ValidationResult
     * @throws XmlValidatorException
     */
    public function validate(string $xmlFileName, string $xsdFileName = null): ValidationResult
    {
        // Validate the XML file name
        $this->validateFileName($xmlFileName);

        // Suppress libxml errors
        libxml_use_internal_errors(true);

        $xml = new XMLReader();
        $xml->open($xmlFileName);

        // When a XSD schema is provided, validate by the XSD schema
        if (!is_null($xsdFileName)) {
            // Validate the XSD file name
            $this->validateFileName($xsdFileName);

            // Set the XSD schema
            $xml->setSchema($xsdFileName);
        }

        // Perform a full read of the document to force validation
        while ($xml->read()) {
            // Do nothing, we need to trigger a full read of the document
        }

        return new ValidationResult(libxml_get_errors());
    }
}
