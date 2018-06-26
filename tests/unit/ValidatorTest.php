<?php

namespace Vdhicts\Dicms\XmlValidator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\Dicms\XmlValidator;

class ValidatorTest extends TestCase
{
    private $xmlFileName = __DIR__ . '/../support/shiporder.xml';
    private $xmlFileNameInvalidToSchema = __DIR__ . '/../support/shiporder_invalid_to_schema.xml';
    private $xmlFileNameInvalid = __DIR__ . '/../support/shiporder_invalid_to_schema.xml';
    private $xsdFileName = __DIR__ . '/../support/shiporder.xsd';

    public function testClassExists()
    {
        $this->assertTrue(class_exists(XmlValidator\Validator::class));
    }

    public function testInitialisation()
    {
        $validator = new XmlValidator\Validator($this->xmlFileName);

        $this->assertInstanceOf(XmlValidator\Validator::class, $validator);
    }

    public function testXml()
    {
        $validator = new XmlValidator\Validator($this->xmlFileName);

        $this->assertTrue($validator->validate());
    }

    public function testXmlMatchingToSchema()
    {
        $validator = new XmlValidator\Validator($this->xmlFileName, $this->xsdFileName);

        $this->assertTrue($validator->validate());
    }

    public function testXmlNotMatchingToSchema()
    {
        $validator = new XmlValidator\Validator($this->xmlFileNameInvalidToSchema, $this->xsdFileName);

        $this->assertFalse($validator->validate());
    }

    public function testInvalidXml()
    {
        $validator = new XmlValidator\Validator($this->xmlFileNameInvalid);

        $this->assertFalse($validator->validate());
    }

    public function testInvalidXmlWithSchema()
    {
        $validator = new XmlValidator\Validator($this->xmlFileNameInvalid, $this->xsdFileName);

        $this->assertFalse($validator->validate());
    }

    public function testInvalidXmlFileName()
    {
        $this->expectException(XmlValidator\Exceptions\XmlValidatorException::class);

        new XmlValidator\Validator('randomFileName.xml');
    }

    public function testInvalidXsdFileName()
    {
        $this->expectException(XmlValidator\Exceptions\XmlValidatorException::class);

        new XmlValidator\Validator($this->xmlFileName, 'randomFileName.xsd');
    }
}
