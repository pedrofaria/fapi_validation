<?php

namespace Drupal\Tests\fapi_validation\Unit\Filters;

use Drupal\Tests\UnitTestCase;
use Drupal\fapi_validation\Plugin\FapiValidationFilter\LowercaseFilter;

/**
 * Tests generation of ice cream.
 *
 * @group fapi_validation
 * @group fapi_validation_filters
 */
class LowercaseFilterTest extends UnitTestCase {

  public function testValidString() {
    $plugin = new LowercaseFilter;
    $this->assertEquals('test', $plugin->filter('TesT'));
  }

}
