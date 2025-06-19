<?php
  $dsn = "mysql:host=localhost;dbname=laravel_course";
  $username = "root";
  $password = "123456789";

  try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
