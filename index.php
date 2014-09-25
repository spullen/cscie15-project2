<?php require 'password_generator.php'; ?>
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

  $password = '';
  $pg = new PasswordGenerator($_POST);

  if($pg->isValid()) {
    $password = $pg->generate();
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
      <form id="password-config" class="form-horizontal" role="form" method="post">
        <div class="form-group <?php displayErrorClass($pg->errors, 'number_of_words'); ?>">
          <label for="number_of_words" class="col-md-2 col-sm-2 control-label">Number of words:</label>
          <div class="col-md-2 col-sm-2">
            <input type="number" class="form-control" min="<?= PasswordGenerator::minNumberOfWords ?>" max="<?= PasswordGenerator::maxNumberOfWords ?>" id="number_of_words" name="number_of_words" value="<?= $pg->numberOfWords ?>">
          </div>
          <div class="col-md-6 col-sm-6 error-container">
            <?php displayErrorMessage($pg->errors, 'number_of_words'); ?>
          </div>
        </div>
        <div class="form-group <?php displayErrorClass($pg->errors, 'separator'); ?>">
          <label for="separator" class="col-md-2 col-sm-2 control-label">Word separator:</label>
          <div class="col-md-2 col-sm-2">
            <select class="form-control" id="separator" name="separator">
              <?php
                foreach(PasswordGenerator::separators() as $separatorName => $separatorValue) {
                ?>
                  <option value="<?= $separatorValue ?>" <?php displaySelected($pg->separator, $separatorValue); ?>>
                    <?php echo ucfirst($separatorName) . ' ' . $separatorValue; ?>
                  </option>
                <?php
                }
              ?>
            </select>
          </div>
          <div class="col-md-6 col-sm-6 error-container">
            <?php displayErrorMessage($pg->errors, 'separator'); ?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" id="include_number" name="include_number" <?php displayChecked($pg->includeNumber); ?>> Include number?
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" id="include_special_character" name="include_special_character" <?php displayChecked($pg->includeSpecialCharacter); ?>> Include special character?
                <span class="help-block">Special characters: !@#$%&</span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" id="upper_case_first_letter" name="upper_case_first_letter" <?php displayChecked($pg->upperCaseFirstLetter); ?>> Upper case first letter?
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" id="camel_case" name="camel_case" <?php displayChecked($pg->camelCase); ?>> Camel case?
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <input type="submit" value="Generate" class="btn btn-primary"> <span id="loading-spinner" style="display: none;"><img src="img/spinner.gif"></span>
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