<?php

/**
 * Contains Drupal\fapi_validation\Plugin\FapiValidationValidator\MatchFieldValidator.
 */

namespace Drupal\fapi_validation\Plugin\FapiValidationValidator;

use Drupal\Core\Form\FormStateInterface;
use Drupal\fapi_validation\Annotation\FapiValidationValidator;
use Drupal\fapi_validation\FapiValidationValidatorsInterface;
use Drupal\fapi_validation\Validator;

/**
 * @FapiValidationValidator(
 *   id = "match_field",
 *   error_message = "%field value does not match other field."
 * )
 */
class MatchFieldValidator implements FapiValidationValidatorsInterface {

  /**
   * {@inheritdoc}
   */
  public function validate(Validator $validator, array $element, FormStateInterface $form_state) {
    $params = $validator->getParams();
    $value = $validator->getValue();

    return $form_state->hasValue($params[0]) && $value == $form_state->getValue($params[0]);
  }

}
