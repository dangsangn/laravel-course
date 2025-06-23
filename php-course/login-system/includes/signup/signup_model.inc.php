<?php

declare(strict_types=1);

function get_username(string $username, PDO $pdo) {
  $query = "SELECT username FROM users WHERE username = :username";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':username', $username);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function get_email(string $email, PDO $pdo) {
  $query = "SELECT email FROM users WHERE email = :email";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function set_user(PDO $pdo, string $username, string $pwd, string $email) {
  $query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
  $stmt = $pdo->prepare($query);

  $option = [
    'cost' => 12
  ];
  $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $option);

  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $hashedPwd);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
}