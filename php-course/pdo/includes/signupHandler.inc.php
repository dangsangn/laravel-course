<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
      require_once 'dbh.inc.php';

      $username = trim($_POST['username'] ?? "");
      $password = trim($_POST['password'] ?? "");
      $email = trim($_POST['email'] ?? "");

      if(empty($username) || empty($password) || empty($email)) {
        header("Location: ../index.php?error=emptyinput");
      }

      $options = [
        'cost' => 12
      ];
      $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

      $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
      $stmt = $pdo->prepare($sql);

      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $hashedPassword);

      $stmt->execute();

      echo "User created successfully";

      $pdo = null;
      $stmt = null;

      header("Location: ../index.php?error=none");
      exit();
      
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      header("Location: ../index.php?error=stmtfailed");
      exit();
    }
  }