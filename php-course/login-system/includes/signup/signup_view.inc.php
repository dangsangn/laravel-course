<?php

declare(strict_types=1);

function render_signup_form() {
  
  echo '<form action="includes/signup/signup.inc.php" method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="pwd" placeholder="Password">
    <input type="email" name="email" placeholder="Email">
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
