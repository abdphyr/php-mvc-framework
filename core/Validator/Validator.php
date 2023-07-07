<?php

namespace Abd\Mvc\Validator;

abstract class Validator implements IValidator
{
  public array $errors = [];

  abstract public function body();

  public function addError(string $attribute, string $rule, $param = null)
  {
    $message = self::ERROR_MESSAGES[$rule] ?? '';
    $message = str_replace("{{$rule}}", $param, $message);
    $this->errors[$attribute][] = $message;
  }

  public function validate($myrules, $table = null): bool
  {
    foreach ($myrules as $attribute => $rules) {
      $value = $this->body()[$attribute];
      $rules = explode("|", $rules);
      foreach ($rules as $rule) {
        $rule = explode(":", $rule);
        $ruleName = $rule[0];

        if ($ruleName === self::RULE_REQUIRED && !$value) {
          $this->addError($attribute, self::RULE_REQUIRED);
        }

        if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $this->addError($attribute, self::RULE_EMAIL);
        }

        if ($ruleName === self::RULE_MIN && strlen($value) < (int)$rule[1]) {
          $this->addError($attribute, self::RULE_MIN, $rule[1]);
        }

        if ($ruleName === self::RULE_MAX && strlen($value) > (int)$rule[1]) {
          $this->addError($attribute, self::RULE_MAX, $rule[1]);
        }

        if ($ruleName === self::RULE_MATCH && $value !== $this->body()[$rule[1]]) {
          $this->addError($attribute, self::RULE_MATCH, $rule[1]);
        }

        if ($ruleName === self::RULE_UNIQUE) {
          $statement = prepare("SELECT * FROM $table WHERE $attribute = :attr");
          $statement->bindValue(':attr', $value);
          $statement->execute();
          $record = $statement->fetchObject();
          if ($record) {
            $this->addError($attribute, self::RULE_UNIQUE, $attribute);
          }
        }
      }
    }
    return !empty($this->errors);
  }

  public function errors()
  {
    return $this->errors;
  }
}
