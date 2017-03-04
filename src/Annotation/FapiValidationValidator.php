<?php
/**
 * @file
 * Contains Drupal\fapi_validation\Annotation\FapiValidationValidator.
 */

namespace Drupal\fapi_validation\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * A FAPI Validation Validator annotation.
 *
 * @Annotation
 */
class FapiValidationValidator extends Plugin {

  /**
   * The validator name.
   *
   * @var string
   */
  protected $name;

  /**
   * The error message
   *
   * @var string
   */
  protected $error_message;

}
