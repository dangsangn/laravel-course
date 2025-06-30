<?php
    require_once 'includes/signup/signup_view.inc.php';
    require_once 'includes/signin/signin_view.inc.php';
    require_once 'includes/session_config.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
</head>
<body>
    <h1>Sign In</h1>
    <form action="includes/signin.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="signin-submit">Sign In</button>
    </form>

    <div style="height: 1px; background-color: black; margin: 20px 0;"></div>

    <h1>Sign Up</h1>
    <?php
        render_signup_form();
    ?>

    <?php 
        show_alerts();
    ?>

    
</body>
</html>