<?php

namespace Vdhicts\XmlValidator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\XmlValidator\Exceptions\XmlValidatorException;
use Vdhicts\XmlValidator\Validator;
use Vdhicts\XmlValidator\ValidationResult;

class ValidatorTest extends TestCase
{
    private string $xmlFileName = __DIR__ . '/../support/shiporder.xml';
    private string $xmlFileNameInvalidToSchema = __DIR__ . '/../support/shiporder_invalid_to_schema.xml';
    private string $xmlFileNameInvalid = __DIR__ . '/../support/shiporder_invalid.xml';
    private string $xsdFileName = __DIR__ . '/../support/shiporder.xsd';

    public function testXml(): void
    {
        $validator = new Validator();

        $this->assertInstanceOf(ValidationResult::class, $validator->validate($this->xmlFileName));
    }

    public function testXmlMatchingToSchema(): void
    {
        $validator = new Validator();

        $result = $validator->validate($this->xmlFileName);

        $this->assertInstanceOf(ValidationResult::class, $result);
        $this->assertTrue($result->isValid());
    }

    public function testXmlNotMatchingToSchema(): void
    {
        $validator = new Validator();

        $result = $validator->validate($this->xmlFileNameInvalidToSchema, $this->xsdFileName);

        $this->assertInstanceOf(ValidationResult::class, $result);
        $this->assertFalse($result->isValid());
        $this->assertTrue(count($result->getErrors()) !== 0);
    }

    public function testInvalidXml(): void
    {
        $validator = new Validator();

        $result = $validator->validate($this->xmlFileNameInvalid);

        $this->assertFalse($result->isValid());
        $this->assertNotSame(count($result->getErrors()), 0);
    }

    public function testInvalidXmlWithSchema(): void
    {
        $validator = new Validator();

        $result = $validator->validate($this->xmlFileNameInvalid, $this->xsdFileName);

        $this->assertFalse($result->isValid());
        $this->assertNotSame(count($result->getErrors()), 0);
    }

    public function testInvalidXmlFileName(): void
    {
        $validator = new Validator();

        $this->expectException(XmlValidatorException::class);

        $validator->validate('randomFileName.xml');
    }

    public function testInvalidXsdFileName(): void
    {
        $validator = new Validator();

        $this->expectException(XmlValidatorException::class);

        $validator->validate($this->xmlFileName, 'randomFileName.xsd');
    }
}
