<?php
namespace Drupal\fapi_validation;

class Validator {
  private $raw_validator;
  private $value;
  private $name;
  private $params = [];
  private $error_message;
  private $error_callback;

  public function __construct($raw_validator, string $value) {
    $this->raw_validator = $raw_validator;
    $this->value = $value;
    $this->parse();
  }

  private function parse() {
    if (is_array($this->raw_validator)) {
      if (isset($this->raw_validator['error'])) {
        $this->error_message = $this->raw_validator['error'];
      }

      if (isset($this->raw_validator['error callback'])) {
        $this->error_callback = $this->raw_validator['error callback'];
      }

      if (!isset($this->raw_validator['rule'])) {
        throw new \LogicException("You can't define a validator as array and don't define 'rule' key.");
      }

      $this->raw_validator = $this->raw_validator['rule'];
    }

    preg_match('/^(.*?)(\[(.*)\])?$/', $this->raw_validator, $rs);

    $this->name = $rs[1];

    if (isset($rs[3])) {
      if ($this->name == 'regexp') {
        $this->params = [$rs[3]];
      }
      else {
        $this->params = preg_split('/ *, */', $rs[3]);
      }
    }
  }

  public function getValue() {
    return $this->value;
  }

  public function getName() {
    return $this->name;
  }

  public function getParams() {
    return $this->params;
  }

  public function hasErrorMessageDefined() {
    return $this->error_message !== null;
  }

  public function getErrorMessage() {
    return $this->error_message;
  }

  public function hasErrorCallbackDefined() {
    return $this->error_callback !== null;
  }

  public function getErrorCallback() {
    return $this->error_callback;
  }
}
