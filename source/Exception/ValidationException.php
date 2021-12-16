<?php

namespace Source\Exception;

use Throwable;

class ValidationException extends AppException
{
    private array $errors;

    public function __construct(array $errors, string $message = null,
        int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}