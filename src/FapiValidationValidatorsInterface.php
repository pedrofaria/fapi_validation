<?php
/**
 * @file
 * Contains Drupal\fapi_validation\FapiValidationValidatorsInterface.
 */

namespace Drupal\fapi_validation;

use Drupal\Core\Form\FormStateInterface;
use Drupal\fapi_validation\Validator;

interface FapiValidationValidatorsInterface {

  /**
   * Returns a message from the plugin.
   *
   * @return boolean
   */
  // public function validate($value, array $params, array $element = null, FormStateInterface $form_state = null);
  public function validate(Validator $validator, array $element, FormStateInterface $form_state);

}
