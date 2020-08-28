<?php

// Add a name space declaration as the first line of the file.
namespace About\Validation;


class Validate {
  public $validation = [];
  public $errors = [];
  private $data = [];

  public function notEmpty($value) {
    if(!empty($value)) {
      return true;
    }
    return false;
  }

  // check value if input email against email validation
  public function email($value) {
    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
      return true;
    }
    return false;
  }

  // check input data against the rules of the field being input
  public function check($data) {
    $this->data = $data;
    foreach(array_keys($this->validation) as $fieldName) {
      $this->rules($fieldName);
    }
  }

  // set validation rules for fields in form
  public function rules($field) {
    // Loop through each form field and test that field for errors.
    foreach($this->validation[$field] as $rule) {
      if($this->{$rule['rule']}($this->data[$field]) === false) {
        $this->errors[$field] = $rule;
      }
    }
  }

  // Set a truthy/falsy value or a boolean on error. This will tell the system how to proceed after the form is processed.
  /**
   * Detects and returns an error message for a given field
   * @param  string $field
   * @return mixed
   */
  public function error($field) {
    if(!empty($this->errors[$field])) {
      return $this->errors[$field]['message'];
    }
    return false;
  }

  /**
  * Returns the user-submitted value for a given key
  * @param  string $key
  * @return string
  */
  // key() returns the index element of the current array position.
  public function userInput($key) {
    // if data[$key] is not empty, update data[$key] value; else update data[$key] to 'null'
    return (!empty($this->data[$key]) ? $this->data[$key] : null);
  }
}

?>