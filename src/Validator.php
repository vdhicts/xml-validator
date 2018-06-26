<?php

namespace Vdhicts\Dicms\XmlValidator;

use Vdhicts\Dicms\XmlValidator\Exceptions;
use XMLReader;

class Validator
{
    /**
     * Holds the XML file location.
     * @var string
     */
    private $xmlFileName;

    /**
     * Holds the XSD file location.
     * @var string|null
     */
    private $xsdFileName = null;

    /**
     * Validator constructor.
     * @param string $xmlFile
     * @param string|null $xsdFile
     * @throws Exceptions\XmlValidatorException
     */
    public function __construct(string $xmlFile, string $xsdFile = null)
    {
        $this->setXmlFileName($xmlFile);
        $this->setXsdFileName($xsdFile);
    }

    /**
     * Returns the XML file name.
     * @return string
     */
    public function getXmlFileName(): string
    {
        return $this->xmlFileName;
    }

    /**
     * Stores the XML file name.
     * @param string $xmlFileName
     * @throws Exceptions\XmlValidatorException
     */
    private function setXmlFileName(string $xmlFileName): void
    {
        if (! file_exists($xmlFileName)) {
            throw Exceptions\XmlValidatorException::fileMissing($xmlFileName);
        }

        if (! is_readable($xmlFileName)) {
            throw Exceptions\XmlValidatorException::fileNotReadable($xmlFileName);
        }

        $this->xmlFileName = $xmlFileName;
    }

    /**
     * Returns the XSD file name.
     * @return null|string
     */
    public function getXsdFileName(): ?string
    {
        return $this->xsdFileName;
    }

    /**
     * Stores the XSD file name.
     * @param string|null $xsdFileName
     * @throws Exceptions\XmlValidatorException
     */
    private function setXsdFileName(string $xsdFileName = null): void
    {
        if (is_null($xsdFileName)) {
            $this->xsdFileName = null;
            return;
        }

        if (! file_exists($xsdFileName)) {
            throw Exceptions\XmlValidatorException::fileMissing($xsdFileName);
        }

        if (! is_readable($xsdFileName)) {
            throw Exceptions\XmlValidatorException::fileNotReadable($xsdFileName);
        }

        $this->xsdFileName = $xsdFileName;
    }

    /**
     * Validates the XML file.
     * @return bool
     */
    public function validate(): bool
    {
        // Suppress libxml errors
        libxml_use_internal_errors(true);

        $xml = new XMLReader();
        $xml->open($this->getXmlFileName());

        // When the schema is provided, validate by the schema
        if (! is_null($this->getXsdFileName())) {
            $xml->setSchema($this->getXsdFileName());
        }

        // Perform a full read of the document to force validation
        while ($xml->read()) {

        };

        // Determine if the full read was successful by counting the errors
        return ! $this->hasErrors();
    }

    /**
     * Determines if any XML errors are raised.
     * @return bool
     */
    public function hasErrors(): bool
    {
        return count($this->getErrors()) !== 0;
    }

    /**
     * Returns an array of LibXMLError objects or an empty array.
     * @return array
     */
    public function getErrors(): array
    {
        return libxml_get_errors();
    }
}
