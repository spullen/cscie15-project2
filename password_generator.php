<?php
class PasswordGenerator {
  const specialCharacters = '!@#$%&';

  public $errors = array();
  public $words = array('apple', 'banana', 'cat', 'dog', 'duck', 'horse', 'house', 'car', 'vehicle', 'blue', 'red', 'orange', 'station', 
                        'computer', 'programmer', 'develop', 'software', 'staple', 'battery', 'water', 'correct', 'wrong', 'right', 'space');
  public $numberOfWords = 2;
  public $separator = '';
  public $includeNumber = false;
  public $includeSpecialCharacter = false;
  public $upperCaseFirstLetter = false;
  public $camelCase = false;

  public function __construct($params) {
    if(isset($_POST['number_of_words']))
      $this->numberOfWords = $_POST['number_of_words'];

    if(isset($_POST['separator']))
      $this->separator = $_POST['separator'];

    if(isset($_POST['include_number']))
      $this->includeNumber = true;

    if(isset($_POST['include_special_character']))
      $this->includeSpecialCharacter = true;

    if(isset($_POST['upper_case_first_letter']))
      $this->upperCaseFirstLetter = true;

    if(isset($_POST['camel_case']))
      $this->camelCase = true;
  }

  public function isValid() {
    if(!is_numeric($this->numberOfWords)) {
      $this->errors['number_of_words'] = 'must be a valid number between 2 and 10.';
    } else {
      if($this->numberOfWords < 2 || $this->numberOfWords > 10) {
        $this->errors['number_of_words'] = 'must be between 2 and 10.';
      }
    }

    // just in case someone tries to enter their own value
    if(!in_array($this->separator, self::separators(), true)){
      $this->errors['separator'] = 'must be a valid separator (-_.#).';
      $this->separator = ''; // reset
    }

    return count($this->errors) == 0;
  }

  public function generate() {
    $result = array();

    // select random subset of words
    for($i = 0; $i < $this->numberOfWords; $i++) {
      $word = array_rand($this->words);
      array_push($result, $this->words[$word]);
      unset($this->words[$word]);
    }

    // camel case rest of words in result if option selected
    if($this->camelCase) {
      for($i = 1; $i < count($result); $i++) {
        $result[$i] = ucfirst($result[$i]);
      }
    }

    $result = join($result, $this->separator);

    if($this->upperCaseFirstLetter) {
      $result = ucfirst($result);
    }

    if($this->includeNumber)
      $result = $result . rand(0, 9);

    if($this->includeSpecialCharacter) {
      $characterAt = rand(0, (strlen(self::specialCharacters) - 1));
      $result = $result . substr(self::specialCharacters, $characterAt, 1);
    }

    return $result;
  }

  // arrays can't be const, so next best thing
  public static function separators() {
    return array(
      'none' => '',
      'hyphen' => '-',
      'underscore' => '_',
      'dot' => '.',
      'pound' => '#'
    );
  }
}
?>