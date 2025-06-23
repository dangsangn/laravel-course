<?php
declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email) {
  return empty($username) || empty($pwd) || empty($email);
}

function is_email_invalid(string $email) {
  return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_username_taken(string $username, PDO $pdo) {
  if(get_username($username, $pdo)) {
    return true;
  }
  return false;
}

function is_email_taken(string $email, PDO $pdo) {
  if(get_email($email, $pdo)) {
    return true;
  }
  return false;
}

function create_user(PDO $pdo, string $username, string $pwd, string $email) {
  set_user($pdo, $username, $pwd, $email);
}