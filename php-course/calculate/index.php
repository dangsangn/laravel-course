<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="text" name="a" placeholder="please enter a number" required>
    <select name="operator" id="operator">
      <option value="+">+</option>
      <option value="-">-</option>
      <option value="*">*</option>
      <option value="/">/</option>
    </select>
    <input type="text" name="b" placeholder="please enter a number" required>
    <input type="submit" value="Calculate">
  </form>

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $a = filter_input(INPUT_POST, 'a', FILTER_SANITIZE_NUMBER_FLOAT);
    $b = filter_input(INPUT_POST, 'b', FILTER_SANITIZE_NUMBER_FLOAT);
    $operator = htmlspecialchars($_POST['operator']);
    $c = 0;
    switch($operator){
      case '+':
        $c = $a + $b;
        break;
      case '-':
        $c = $a - $b;
        break;
      case '*':
        $c = $a * $b;
        break;
      case '/':
        $c = $a / $b;
        break;
    }
    echo "The result is $c";
  }
  ?>

</body>
</html>
