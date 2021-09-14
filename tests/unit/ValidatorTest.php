<?php

namespace Vdhicts\XmlValidator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\XmlValidator\Exceptions\XmlValidatorException;
use Vdhicts\XmlValidator\Validator;
use Vdhicts\XmlValidator\ValidationResult;

class ValidatorTest extends TestCase
{
    private $xmlFileName = __DIR__ . '/../support/shiporder.xml';
    private $xmlFileNameInvalidToSchema = __DIR__ . '/../support/shiporder_invalid_to_schema.xml';
    private $xmlFileNameInvalid = __DIR__ . '/../support/shiporder_invalid.xml';
    private $xsdFileName = __DIR__ . '/../support/shiporder.xsd';

    public function testXml()
    {
        $validator = new Validator();

        $this->assertInstanceOf(ValidationResult::class, $validator->validate($this->xmlFileName));
    }

    public function testXmlMatchingToSchema()
    {
        $validator = new Validator();

        $result = $validator->validate($this->xmlFileName);

        $this->assertInstanceOf(ValidationResult::class, $result);
        $this->assertTrue($result->isValid());
    }

    public function testXmlNotMatchingToSchema()
    {
        $validator = new Validator();

        $result = $validator->validate($this->xmlFileNameInvalidToSchema, $this->xsdFileName);

        $this->assertInstanceOf(ValidationResult::class, $result);
        $this->assertFalse($result->isValid());
        $this->assertIsArray($result->getErrors());
    }

    public function testInvalidXml()
    {
        $validator = new Validator();

        $result = $validator->validate($this->xmlFileNameInvalid);

        $this->assertFalse($result->isValid());
        $this->assertIsArray($result->getErrors());
    }

    public function testInvalidXmlWithSchema()
    {
        $validator = new Validator();

        $result = $validator->validate($this->xmlFileNameInvalid, $this->xsdFileName);

        $this->assertFalse($result->isValid());
        $this->assertIsArray($result->getErrors());
    }

    public function testInvalidXmlFileName()
    {
        $validator = new Validator();

        $this->expectException(XmlValidatorException::class);

        $validator->validate('randomFileName.xml');
    }

    public function testInvalidXsdFileName()
    {
        $validator = new Validator();

        $this->expectException(XmlValidatorException::class);

        $validator->validate($this->xmlFileName, 'randomFileName.xsd');
    }
}
