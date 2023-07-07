<?php

namespace Abd\Mvc\Validator;

interface IValidator
{
  public const RULE_REQUIRED = 'required';
  public const RULE_EMAIL = 'email';
  public const RULE_MAX = 'max';
  public const RULE_MIN = 'min';
  public const RULE_MATCH = 'match';
  public const RULE_UNIQUE = 'unique';

  public const ERROR_MESSAGES = [
    self::RULE_REQUIRED => "This filed is required",
    self::RULE_EMAIL => "This field must be valid email address",
    self::RULE_MIN => "Min length of this field must be {min}",
    self::RULE_MAX => "Max length of this field must be {max}",
    self::RULE_MATCH => "This filed must be the same as {match}",
    self::RULE_UNIQUE => "Record with this {unique} already exists"
  ];

  public function validate(array $myrules): bool;
  public function addError(string $attribute, string $rule);
  public function errors();
}
