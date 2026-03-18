<?php

namespace Vdhicts\XmlValidator;

readonly class ValidationResult
{
    public function __construct(
        private array $errors = []
    ) {
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
