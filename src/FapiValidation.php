<?php
namespace Drupal\fapi_validation;

/**
 * @FormElement('fapi_validation')
 */
class FapiValidation implements FormElementInterface
{
  public static function valueCallback(&$element, $input, FormStateInterface $form_state) {
    var_dump($element);
  }
}
