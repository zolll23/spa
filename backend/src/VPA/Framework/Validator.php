<?php

declare(strict_types=1);

namespace VPA\Framework;

use Spa\Domains\Comments\CommentDto;
use VPA\DI\Injectable;

#[Injectable]
class Validator
{
    private array $rules = [];
    private array $errors = [];

    /**
     * @param CommentDto $commentDto
     * @param array $rules
     *
     * @return array|bool
     */
    public function validate(CommentDto $commentDto, array $rules): array|bool
    {
        $this->rules = $rules;
        $data = $commentDto->toArray();
        foreach ($data as $field => $value) {
            $this->validateField($field, $value);
        }
        if (!empty($this->errors)) {
            return $this->errors;
        }
        return false;
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return void
     */
    private function validateField(string $field, mixed $value)
    {
        $rules = $this->rules[$field] ?? [];
        foreach ($rules as $rule) {
            switch ($rule) {
                case 'required':
                    $this->ruleRequired($field, $value);
                    break;
                case 'email':
                    $this->ruleEmail($field, $value);
                    break;
            }
        }
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return void
     */
    private function ruleRequired(string $field, mixed $value)
    {
        if (empty($value)) {
            $this->addError("Field {$field} cannot be a empty");
        }
    }

    /**
     * @param string $field
     * @param mixed  $value
     * @return void
     */
    private function ruleEmail(string $field, mixed $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError("Field {$field} must be valid email address");
        }
    }

    /**
     * @param string $message
     *
     * @return void
     */
    private function addError(string $message)
    {
        $this->errors[] = $message;
    }

    /**
     * @return string
     */
    public function errorsAsString(): string
    {
        return implode("<br>", $this->errors);
    }
}
