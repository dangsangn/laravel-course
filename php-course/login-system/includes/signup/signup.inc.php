<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $pwd = $_POST['pwd'];
  $email = $_POST['email'];

  try {
    require_once('../dbh.inc.php');
    require_once('signup_model.inc.php');
    require_once('signup_contr.inc.php');

    // Error handling
    $errors = [];
    if(is_input_empty($username, $pwd, $email)) {
      $errors['empty_input'] = 'Fill in all fields!';
    }
    if(is_email_invalid($email)) {
      $errors['email_invalid'] = 'Invalid email!';
    }
    if(is_username_taken($username, $pdo)) {
      $errors['username_taken'] = 'Username already taken!';
    }
    if(is_email_taken($email, $pdo)) {
      $errors['email_taken'] = 'Email already taken!';
    }

    require_once('../session_config.inc.php');
    if($errors) {
      $_SESSION['errors_signup'] = $errors;

      $signup_data = [
        'username' => $username,
        'pwd' => $pwd,
        'email' => $email
      ];
      $_SESSION['signup_data'] = $signup_data;
      
      header('Location: ../../index.php');
      exit();
    }

    create_user($pdo, $username, $pwd, $email);
    header('Location: ../../index.php?signup=success');
    $pdo = null;
    $stmt = null;
    exit();
  } catch (PDOException $e) {
    echo('Error: ' . $e->getMessage());
    header('Location: ../../index.php?error=stmtfailed');
  }

  
}