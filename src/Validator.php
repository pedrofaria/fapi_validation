<?php
namespace Drupal\fapi_validation;

class Validator {
  private $raw_validator;
  private $value;
  private $name;
  private $params = [];

  public function __construct(string $raw_validator, string $value) {
    $this->raw_validator = $raw_validator;
    $this->value = $value;
    $this->parse();
  }

  private function parse() {
    preg_match('/^(.*?)(\[(.*)\])?$/', $this->raw_validator, $rs);

    $this->name = $rs[1];

    if (isset($rs[3])) {
      if ($this->name == 'regexp') {
        $$this->params = [$rs[3]];
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
}
