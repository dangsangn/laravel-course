<?php
require_once('../dbh.inc.php');
require_once('signin_model.inc.php');
require_once('signin_contr.inc.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $pwd = $_POST['pwd'];

  try {
    // Error handling
    $errors = [];
    if(is_input_empty($username, $pwd, $email)) {
      $errors['empty_input'] = 'Fill in all fields!';
    }
    if(is_username_taken($username, $pdo)) {
      $errors['username_taken'] = 'Username already taken!';
    }

    require_once('../session_config.inc.php');
    if($errors) {
      $_SESSION['errors_signup'] = $errors;

      $signup_data = [
        'username' => $username,
        'email' => $email
      ];
      $_SESSION['signup_data'] = $signup_data;
      
      header('Location: ../../index.php');
      die();
    }

    create_user($pdo, $username, $pwd, $email);
    header('Location: ../../index.php?signup=success');
    $pdo = null;
    die();
  } catch (PDOException $e) {
    echo('Error: ' . $e->getMessage());
    header('Location: ../../index.php?error=stmtfailed');
    die();
  }

  
}