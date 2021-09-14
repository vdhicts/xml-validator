<?php

namespace Vdhicts\XmlValidator;

class ValidationResult
{
    private array $errors;

    public function __construct(array $errors = [])
    {
        $this->errors = $errors;
    }

    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}