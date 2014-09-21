<!doctype html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CSCI E-15 Project 2 - Scott Pullen</title>

  <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
  <link rel="stylesheet" media="screen" href="css/application.css">
</head>
<body>
<?php
  function displayErrorClass($errorArr, $val) {
    if(isset($errorArr[$val]))
      echo 'has-error';
  }

  function displayErrorMessage($errorArr, $val) {
    if(isset($errorArr[$val]))
      echo '<span class="help-block">' . $errorArr[$val] . '</span>';
  }

  function displayChecked($cond) {
    if($cond)
      echo 'checked="checked"';
  }

  function displaySelected($val1, $val2) {
    if($val1 === $val2)
      echo 'selected="selected"';
  }

  $errors = array();

  $words = array('apple', 'banana', 'cat', 'dog', 'duck', 'horse', 'house', 'car', 'vehicle', 'blue', 'red', 'organge', 'station', 
                 'computer', 'programmer', 'develop', 'software', 'staple', 'battery', 'water', 'correct', 'wrong', 'right', 'space');

  $separators = array(
    'none' => '',
    'hyphen' => '-',
    'underscore' => '_',
    'dot' => '.',
    'pound' => '#'
  );

  $specialCharacters = '!@#$%&';
  $specialCharactersLength = strlen($specialCharacters);

  $password = array();

  $numberOfWords = 2;
  $separator = '';
  $includeNumber = false;
  $includeSpecialCharacter = false;
  $upperCaseFirstLetter = false;
  $camelCase = false;

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Number of words
    if(isset($_POST['number_of_words'])) {
      $numberOfWords = $_POST['number_of_words'];
      if(!is_numeric($numberOfWords)) {
        $errors['number_of_words'] = 'must be a valid number between 2 and 10.';
      } else {
        if($numberOfWords < 2 || $numberOfWords > 10) {
          $errors['number_of_words'] = 'must be between 2 and 10.';
        }
      }
    } else {
      $errors['number_of_words'] = 'must be a valid number between 2 and 10.';
    }

    // Separator
    if(isset($_POST['separator'])) {
      $separator = $_POST['separator'];
      // just in case someone tries to enter their own value
      if(!in_array($separator, $separators, true)){
        $errors['separator'] = 'must be a valid separator (-_.#).';
        $separator = ''; // reset
      }
    }

    if(isset($_POST['include_number']))
      $includeNumber = true;

    if(isset($_POST['include_special_character']))
      $includeSpecialCharacter = true;

    if(isset($_POST['upper_case_first_letter']))
      $upperCaseFirstLetter = true;

    if(isset($_POST['camel_case']))
      $camelCase = true;
  }

  if(count($errors) == 0) {
    // select random subset of words
    for($i = 0; $i < $numberOfWords; $i++) {
      $wordAt = rand(0, count($words) - 1);
      echo 'Word count: ' . count($words) . ', word at: ' . $wordAt . '<br>';
      $word = $words[$wordAt];
      array_push($password, $word);
      unset($words[$wordAt]);
    }

    // camel case rest of words in password if option selected
    for($i = 1; $i < count($password); $i++) {
      $password[$i] = ucfirst($password[$i]);
    }

    $password = join($password, $separator);

    if($upperCaseFirstLetter) {
      $password = ucfirst($password);
    }

    if($includeNumber)
      $password = $password . rand(0, 9);

    if($includeSpecialCharacter) {
      $characterAt = rand(0, ($specialCharactersLength - 1));
      $password = $password . substr($specialCharacters, $characterAt, 1);
    }

  } else {
    $password = '';
  }
?>
<div class="container">
  <div class="row">
    <div class="center">
      <h1>Password Generator</h1>
    </div>
    <hr>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="center">
        <h2 id="result"><?php echo $password; ?></h2>
      </div>
      <br>
      <form class="form-horizontal" role="form" method="post">
        <div class="form-group <?php displayErrorClass($errors, 'number_of_words'); ?>">
          <label for="number_of_words" class="col-md-2 col-sm-2 control-label">Number of words:</label>
          <div class="col-md-2 col-sm-2">
            <input type="number" class="form-control" min="2" max="10" name="number_of_words" value="<?php echo $numberOfWords; ?>">
          </div>
          <div class="col-md-6 col-sm-6">
            <?php displayErrorMessage($errors, 'number_of_words'); ?>
          </div>
        </div>
        <div class="form-group <?php displayErrorClass($errors, 'separator'); ?>">
          <label for="separator" class="col-md-2 col-sm-2 control-label">Word separator:</label>
          <div class="col-md-2 col-sm-2">
            <select class="form-control" name="separator">
              <?php
                foreach($separators as $separatorName => $separatorValue) {
                ?>
                  <option value="<?php echo $separatorValue; ?>" <?php displaySelected($separator, $separatorValue); ?>>
                    <?php echo ucfirst($separatorName) . ' ' . $separatorValue; ?>
                  </option>
                <?php
                }
              ?>
            </select>
          </div>
          <div class="col-md-6 col-sm-6">
            <?php displayErrorMessage($errors, 'separator'); ?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="include_number" <?php displayChecked($includeNumber); ?>> Include number?
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="include_special_character" <?php displayChecked($includeSpecialCharacter); ?>> Include special character?
                <span class="help-block">Special characters: !@#$%&</span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="upper_case_first_letter" <?php displayChecked($upperCaseFirstLetter); ?>> Upper case first letter?
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="camel_case" <?php displayChecked($camelCase); ?>> Camel case?
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <input type="submit" value="Generate" class="btn btn-primary">
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <p>
        This application generates a password. The password is built using ordinary words (no l337 speak) 
        along with some configurations on the output. The generated password is easy to remember, but is 
        hard for a computer to crack. The idea comes from <a href="http://xkcd.com/936/" target="_blank">xkcd</a>.
      </p>
      <div class="col-md-offset-2">
        <a href="http://xkcd.com/936/" target="_blank"><img src="http://imgs.xkcd.com/comics/password_strength.png"><a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/application.js"></script>
</body>
</html>