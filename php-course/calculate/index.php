<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .calculator {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        input[type="text"], select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 4px;
        }
        .error {
            background-color: #ffebee;
            color: #c62828;
        }
        .success {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h2>PHP Calculator</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <input type="text" name="a" placeholder="First number" required 
                       value="<?php echo isset($_POST['a']) ? htmlspecialchars($_POST['a']) : ''; ?>">
                <select name="operator" id="operator">
                    <option value="+" <?php echo (isset($_POST['operator']) && $_POST['operator'] == '+') ? 'selected' : ''; ?>>+</option>
                    <option value="-" <?php echo (isset($_POST['operator']) && $_POST['operator'] == '-') ? 'selected' : ''; ?>>-</option>
                    <option value="*" <?php echo (isset($_POST['operator']) && $_POST['operator'] == '*') ? 'selected' : ''; ?>>*</option>
                    <option value="/" <?php echo (isset($_POST['operator']) && $_POST['operator'] == '/') ? 'selected' : ''; ?>>/</option>
                </select>
                <input type="text" name="b" placeholder="Second number" required
                       value="<?php echo isset($_POST['b']) ? htmlspecialchars($_POST['b']) : ''; ?>">
            </div>
            <input type="submit" value="Calculate">
        </form>

        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $a = filter_input(INPUT_POST, 'a', FILTER_SANITIZE_NUMBER_FLOAT);
            $b = filter_input(INPUT_POST, 'b', FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = htmlspecialchars($_POST['operator']);
            
            // Validate inputs
            if($a === false || $b === false) {
                echo '<div class="result error">Please enter valid numbers</div>';
            } else {
                $c = 0;
                $error = false;
                
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
                        if($b == 0) {
                            $error = true;
                            echo '<div class="result error">Error: Division by zero is not allowed</div>';
                        } else {
                            $c = $a / $b;
                        }
                        break;
                }
                
                if(!$error) {
                    echo '<div class="result success">';
                    echo htmlspecialchars($a) . ' ' . $operator . ' ' . htmlspecialchars($b) . ' = ' . $c;
                    echo '</div>';
                }
            }
        }
        ?>
    </div>
</body>
</html>
