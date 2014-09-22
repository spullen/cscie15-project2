<?php
  require 'password_generator.php';

  $json = file_get_contents('php://input');
  $options = json_decode($json, true);

  $pg = new PasswordGenerator($options);

  header('Content-Type: application/json');
  if($pg->isValid()) {
    echo json_encode($pg->generate());
  } else {
    echo json_encode($pg->errors);
  }
?>