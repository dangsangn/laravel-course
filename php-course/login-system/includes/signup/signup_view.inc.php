<?php

declare(strict_types=1);

function render_signup_form() {
  $username = '';
  $email = '';

  if(isset($_SESSION['signup_data']) && !empty($_SESSION['errors_signup'])) {
    $signup_data = $_SESSION['signup_data'];
    $username = $signup_data['username'];
    $email = $signup_data['email'];
  }
  echo '<form action="includes/signup/signup.inc.php" method="post">
    <input type="text" name="username" placeholder="Username" value="' . $username . '">
    <input type="password" name="pwd" placeholder="Password">
    <input type="email" name="email" placeholder="Email" value="' . $email . '">
    <button type="submit" name="signup-submit">Signup</button>
  </form>';
}

function show_alerts() {
  if(isset($_SESSION['errors_signup'])) {
    $errors = $_SESSION['errors_signup'];
    echo "<br/>";

    foreach($errors as $error) {
      echo '<p style="color: red;">' . $error . '</p>';
    }

    unset($_SESSION['errors_signup']);
  } else if(isset($_GET['signup']) && $_GET['signup'] === 'success') {
    echo '<br/>';
    echo '<p style="color: green;">Signup successful!</p>';
  }
}
