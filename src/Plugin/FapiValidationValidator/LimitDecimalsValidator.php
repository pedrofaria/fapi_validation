<?php

/**
 * Contains Drupal\fapi_validation\Plugin\FapiValidationValidator\LimitDecimalsValidator.
 */

namespace Drupal\fapi_validation\Plugin\FapiValidationValidator;

use Drupal\Core\Form\FormStateInterface;
use Drupal\fapi_validation\Annotation\FapiValidationValidator;
use Drupal\fapi_validation\FapiValidationValidatorsInterface;
use Drupal\fapi_validation\Validator;

/**
 * @FapiValidationValidator(
 *   id = "limit_decimals",
 *   error_message = "Use only alpha characters at %field."
 * )
 */
class LimitDecimalsValidator implements FapiValidationValidatorsInterface {

  /**
   * {@inheritdoc}
   */
  public function validate(Validator $validator, array $element, FormStateInterface $form_state) {
    $params = $validator->getParams();
    $value = $validator->getValue();

    if ( !is_numeric($value) ) {
      return FALSE;
    }
    if (count($params) > 0) {
      $value = (float) $value;
      $pattern = '/^[^\.]*\.?[0-9]{0,' . $params[0] . '}$/';
      return (bool) preg_match($pattern, (string) $value);
    }
    return TRUE;
  }
}
