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
  $numberOfWords = 3;
  $wordSeparator = '';
  $includeNumber = false;
  $includeSpecialCharacter = false;
  $upperCaseFirstLetter = false;
  $camelCase = false;

  $separators = array(
    'none' => '',
    'hyphen' => '-',
    'underscore' => '_',
    'dot' => '.',
    'pound' => '#'
  );
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
        <h2 id="result">SDSDSDSDSD</h2>
      </div>
      <br>
      <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
          <label for="number_of_words" class="col-md-2 col-sm-2 control-label">Number of words:</label>
          <div class="col-md-6 col-sm-6">
            <input type="number" class="form-control" min="3" name="number_of_words" value="<?php echo $numberOfWords; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="separator" class="col-md-2 col-sm-2 control-label">Word separator:</label>
          <div class="col-md-6 col-sm-6">
            <select class="form-control" name="separator">
              <?php
                foreach($separators as $separatorName => $separatorValue) {
                ?>
                  <option value="<?php echo $separatorValue; ?>" <?php if($wordSeparator === $separatorValue) { echo 'selected="selected"'; } ?>>
                    <?php echo ucfirst($separatorName) . ' ' . $separatorValue; ?>
                  </option>
                <?php
                }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="include_number" <?php if($includeNumber) { echo 'checked="checked"'; } ?>> Include number?
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="include_special_character" <?php if($includeSpecialCharacter) { echo 'checked="checked"'; } ?>> Include special character?
                <span class="help-block">Special characters: !@#$%&</span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="upper_case_first_letter" <?php if($upperCaseFirstLetter) { echo 'checked="checked"'; } ?>> Upper case first letter?
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="camel_case" <?php if($camelCase) { echo 'checked="checked"'; } ?>> Camel case?
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