<?php
  require 'password_generator.php';

  $json = file_get_contents('php://input');
  $options = json_decode($json, true);

  $pg = new PasswordGenerator($options);

  header('Content-Type: application/json');
  if($pg->isValid()) {
    http_response_code();
    echo json_encode($pg->generate());
  } else {
    http_response_code(422);
    echo json_encode($pg->errors);
  }
?>