$(function() {
  var $resultEl = $('#result');

  var $numberOfWords = $('#number_of_words');
  var $separator = $('#separator');
  var $includeNumber = $('#include_number');
  var $includeSpecialCharacter = $('#include_special_character');
  var $upperCaseFirstLetter = $('#upper_case_first_letter');
  var $camelCase = $('#camel_case');

  $('#password-config').on('submit', function(e) {
    e.preventDefault();

    var $self = $(this);
    var data = {
      number_of_words: $numberOfWords.val(),
      separator: $separator.val(),
      include_number: $includeNumber.is(':checked'),
      include_special_character: $includeSpecialCharacter.is(':checked'),
      upper_case_first_letter: $upperCaseFirstLetter.is(':checked'),
      camel_case: $camelCase.is(':checked')
    };

    $.ajax({
      url: 'generate.php',
      method: 'POST',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      data: JSON.stringify(data)
    }).
    done(function(resp) {
      $resultEl.text(resp);
    }).
    fail(function(resp) {
      console.log(resp);
    });
  });
});