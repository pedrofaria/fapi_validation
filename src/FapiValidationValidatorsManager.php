<?php
/**
 * @file
 * Contains Drupal\fapi_validation\FapiValidationValidatorsManager.
 */

namespace Drupal\fapi_validation;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Language\LanguageManager;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\fapi_validation\Validator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * A plugin manager for message plugins.
 */
class FapiValidationValidatorsManager extends DefaultPluginManager implements EventSubscriberInterface {

  /**
   * Constructs a MessageManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    $this->alterInfo('fapi_validation_validators_info');
    $this->setCacheBackend($cache_backend, 'fapi_validation_validators');

    parent::__construct(
      'Plugin/FapiValidationValidator',
      $namespaces,
      $module_handler,
      'Drupal\fapi_validation\FapiValidationValidatorsInterface',
      'Drupal\fapi_validation\Annotation\FapiValidationValidator'
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    // $events[KernelEvents::REQUEST][] = array('performValidation');
    return $events;
  }

  public function hasValidator(string $id) {
    return in_array($id, array_keys($this->getDefinitions()));
  }

  public function validate(&$element, &$form_state) {
    $def = $element['#validators'];

    foreach ($def as $raw_validation) {
      // Parse Validator
      $validator = new Validator($raw_validation, $form_state->getValue($element['#name']));

      if (!$this->hasValidator($validator->getName())) {
        // @TODO throw Validator not found
      }
      $plugin = $this->getDefinition($validator->getName());
      $instance = $this->createInstance($plugin['id']);

      if (!$instance->validate($validator, $element, $form_state)) {
        $error_message = \t($plugin['error_message'], ['%field' => $element['#title']]);
        $form_state->setErrorByName(implode('][', $element['#parents']), $error_message);
      }
    }
  }

}
