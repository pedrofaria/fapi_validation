<?php

namespace Drupal\Tests\fapi_validation\Unit\Validators;

use Drupal\fapi_validation\Plugin\FapiValidationValidator\DecimalValidator;
use Drupal\fapi_validation\Validator;

/**
 * Tests generation of ice cream.
 *
 * @group fapi_validation
 * @group fapi_validation_validators
 */
class DecimalValidatorTest extends BaseValidatorTest {

  protected $plugin;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $this->plugin = new DecimalValidator();
  }

  public function testNegativeDecimalNoParams() {
    $validator = new Validator('decimal', '123.23');
    $this->assertTrue($this->plugin->validate($validator, [], $this->decoratedFormState));

    $validator = new Validator('decimal', '-123.23');
    $this->assertTrue($this->plugin->validate($validator, [], $this->decoratedFormState));
  }

  public function testIntegerNoParams() {
    $validator = new Validator('decimal', '1525');
    $this->assertTrue($this->plugin->validate($validator, [], $this->decoratedFormState));

    $validator = new Validator('decimal', '-1525');
    $this->assertTrue($this->plugin->validate($validator, [], $this->decoratedFormState));
  }

  public function testNegativeDecimal() {
    $validator = new Validator('decimal', '-123.23');

    $this->assertTrue($this->plugin->validate($validator, [], $this->decoratedFormState));
  }

}
