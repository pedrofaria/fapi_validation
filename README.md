# Form API Validation

This module extends the form API to include convenient access to common for submission filters and validation checks. The core form API has no built in validators available to you, nor filters, and all have to be manually placed in a validation function. With this module you simply add the basic filers and/or validators you want to have in your form render area.

You can use the existent filters and rules or create your own. This module is fully extensible using hooks, allowing you to easily add your own and reuse them throughout the site. Abstraction at it's finest!


## Available Validators

|Rule|Usage|Description|
|----|-----|-----------|
|numeric|`numeric`|Must contains only numbers.|
|alpha|`alpha`|Must contains only alpha characters.|
|length|`length[<total>]`, `length[<min>, <max>]`, `length[<min>, *]`|
|chars|`chars[<char 1>, <char 2>, ..., <char N>]`|Accept only specified characters.|
|email|`email`|Valid email|
|url|`url`, `url[absolute]`|Valid URL. If absolute parameter is specified, the field value must have to be a full URL.|
|ipv4|`ipv4`|Valid IPv4|
|alpha_numeric|`alpha_numeric`|Accept only Alpha Numeric characters|
|alpha_dash|`alpha_dash`|Accept only Alpha characters and Dash ( - )|
|digit|`digit`|Checks wheter a string consists of digits only (no dots or dashes).|
|decimal|`decimal`, `decimal[<digits>,<decimals>]`| |
|regexp|`regexp[/^regular expression$/]`|PCRE Regular Expression|
|match_field|`match_field[otherfield]`|Check if the field has same value of otherfield.|
|range|`range[<min>, <max>]`|Check if the field value is in defined range.|

## Available Filters

|Filter|Description|
|------|-----------|
|`numeric`|Remove all non numeric characters.|
|`trim`|Remove all spaces before and after value.|
|`uppercase`|Transform all characters to upper case.|
|`lowercase`|Transform all characters to lower case.|
|`strip_tags`|Strips out ALL html tags.|
|`html_entities`|Decodes all previously encoded entities, and then encodes all entities.|

## Usage

Example:

```php
<?php
//...

$form['myfield'] = array(
  '#type' => 'textfield',
  '#title' => 'My Field',
  '#required' => TRUE,
  '#validators' => array(
    'email', 
    'length[10, 50]', 
    array('rule' => 'alpha_numeric', 'error' => 'Please, use only alpha numeric characters at %field.'),
    array('rule' => 'match_field[otherfield]', 'error callback' => 'mymodule_validation_error_msg'),
  ),
  '#filters' => array('trim', 'uppercase')
);

//...

function mymodule_validation_error_msg($rule, $params, $element, $form_state) {
  return t("My custom error message for %field", array("%field" => $element['#title']));
}
?>
```

## Developer

@TODO