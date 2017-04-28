<?php

namespace Drupal\Tests\fapi_validation\Unit\Plugin\FapiValidationValidator;

use Drupal\fapi_validation\Plugin\FapiValidationValidator\AlphaDashValidator;
use Drupal\fapi_validation\Validator;

/**
 * Tests generation of ice cream.
 *
 * @group fapi_validation
 * @group fapi_validation_validators
 */
class AlphaDashValidatorTest extends BaseValidator {

  protected $plugin;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $this->plugin = new AlphaDashValidator();
  }

  public function dataValidTestProvider()
  {
    return [
      ['SimpleAlpha-Dash'],
      ['Text'],
      ['-'],
      ['-text'],
      ['text-with-many-dashes-']
    ];
  }

  public function dataInvalidTestProvider()
  {
    return [
      ['SimpleAlpha-With-!!@$@!Invalid'],
      [' '],
      ['text space'],
      [' text-dash'],
      [''],
      ['text-dash ']
    ];
  }

  /**
   * Testing valid string.
   *
   * @dataProvider dataValidTestProvider
   */
  public function testValidString($stringText) {
    $validator = new Validator('alpha_dash', $stringText);

    $this->assertTrue($this->plugin->validate($validator, [], $this->decoratedFormState));
  }

  /**
   * Testing invalid string.
   *
   * @dataProvider dataInvalidTestProvider
   */
  public function testInvalidString($stringText) {
    $validator = new Validator('alpha', $stringText);

    $this->assertFalse($this->plugin->validate($validator, [], $this->decoratedFormState));
  }

}
