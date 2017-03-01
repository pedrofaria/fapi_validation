<?php
namespace Drupal\fapi_validation;

use Drupal\Core\Form\FormStateInterface;

class FapiValidationService {
  /**
   * Process element validators and filters.
   *
   * Allows both #validators and #filters values. Run on form rendering. Only adds filters and
   * validators on form submission if the values have been provided. Saves us from appending a
   * check to every single item on submission.
   */
  static public function process(array $element, FormStateInterface $form_state) {
    if ((isset($element['#filters']) || isset($element['#validators'])) && !is_array($element['#element_validate'])) {
      $element['#element_validate'] = [];
    }

    if (isset($element['#filters']) && is_array($element['#filters'])) {
      // Check if element validate is already empty, and if so make variable for merging in values
      // an empty array and put at first place.
      $element['#element_validate'] = array_merge(['\Drupal\fapi_validation\FapiValidationService::filter'], $element['#element_validate']);
    }

    if (isset($element['#validators']) && is_array($element['#validators'])) {
      $element['#element_validate'][] = '\Drupal\fapi_validation\FapiValidationService::validate';
    }

    return $element;
  }

  static public function filter(array $element, FormStateInterface $form_state) {
    # code...
  }

  static public function validate(array $element, FormStateInterface $form_state)
  {
    var_dump($element['#validators']); exit;
  }
}
