<?php
  header('Content-Type: application/json');

  require 'password_generator.php';
  $pg = new PasswordGenerator($_POST);

  if($pg->isValid()) {
    echo json_encode($pg->generate());
  } else {
    echo json_encode($pg->errors);
  }
?>