<?php

/**
 * Contains Drupal\fapi_validation\Plugin\FapiValidationFilter\LowercaseFilter.
 */

namespace Drupal\fapi_validation\Plugin\FapiValidationFilter;

use Drupal\fapi_validation\FapiValidationFiltersInterface;

/**
 * @FapiValidationFilter(
 *   id = "lowercase"
 * )
 */
class LowercaseFilter implements FapiValidationFiltersInterface {

  /**
   * {@inheritdoc}
   */
  public function filter(string $value) {
    return function_exists('mb_strtolower') ? mb_strtolower($value) : strtolower($value);
  }

}
