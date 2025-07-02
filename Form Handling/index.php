<!-- HTML5 doctype declaration -->
<!DOCTYPE html>
<!-- Start of HTML document with language set to English -->
<html lang="en">
<head>
    <!-- Set character encoding -->
    <meta charset="UTF-8">
    <!-- Responsive design for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>Stylish Calculator</title>
    <!-- Internal CSS for calculator styling -->
    <style>
        /* Body background and centering */
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        /* Calculator container styling */
        .calculator {
            background: #fff;
            padding: 2.5rem 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            width: 340px;
        }
        /* Calculator title styling */
        .calculator h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #3a3a3a;
            letter-spacing: 1px;
        }
        /* Spacing between form groups */
        .form-group {
            margin-bottom: 1.2rem;
        }
        /* Label styling */
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }
        /* Input and select styling */
        .form-group input, .form-group select {
            width: 100%;
            padding: 0.7rem;
            border: 1px solid #d1d1d1;
            border-radius: 0.7rem;
            font-size: 1rem;
            outline: none;
            transition: border 0.2s;
        }
        /* Highlight input/select on focus */
        .form-group input:focus, .form-group select:focus {
            border: 1.5px solid #74ebd5;
        }
        /* Calculate button styling */
        .btn-calc {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(90deg, #74ebd5 0%, #ACB6E5 100%);
            border: none;
            border-radius: 0.7rem;
            color: #fff;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 0.5rem;
        }
        /* Button hover effect */
        .btn-calc:hover {
            background: linear-gradient(90deg, #ACB6E5 0%, #74ebd5 100%);
        }
        /* Result display styling */
        .result {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #f1f8fc;
            border-radius: 0.7rem;
            text-align: center;
            font-size: 1.2rem;
            color: #2d6a8c;
            box-shadow: 0 2px 8px rgba(116, 235, 213, 0.08);
        }
    </style> <!-- End of internal CSS -->
</head>
<body> <!-- Start of body -->
    <!-- Calculator form, POST method for processing -->
    <form class="calculator" method="post">
        <!-- Calculator title -->
        <h2>Calculator</h2>
        <!-- First number input -->
        <div class="form-group">
            <label for="num1">First Number</label>
            <!-- Input for first number, keeps value after submit -->
            <input type="number" step="any" name="num1" id="num1" required value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : '' ?>">
        </div>
        <!-- Operation selection dropdown -->
        <div class="form-group">
            <label for="operation">Operation</label>
            <select name="operation" id="operation" required>
                <!-- Each option keeps selected after submit -->
                <option value="add" <?php if(isset($_POST['operation']) && $_POST['operation']==='add') echo 'selected'; ?>>Addition (+)</option>
                <option value="subtract" <?php if(isset($_POST['operation']) && $_POST['operation']==='subtract') echo 'selected'; ?>>Subtraction (-)</option>
                <option value="multiply" <?php if(isset($_POST['operation']) && $_POST['operation']==='multiply') echo 'selected'; ?>>Multiplication (×)</option>
                <option value="divide" <?php if(isset($_POST['operation']) && $_POST['operation']==='divide') echo 'selected'; ?>>Division (÷)</option>
            </select>
        </div>
        <!-- Second number input -->
        <div class="form-group">
            <label for="num2">Second Number</label>
            <!-- Input for second number, keeps value after submit -->
            <input type="number" step="any" name="num2" id="num2" required value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : '' ?>">
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn-calc">Calculate</button>
        <?php
        // Initialize result variable
        $result = '';
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get first number from POST, default to 0
            $num1 = isset($_POST['num1']) ? (float)$_POST['num1'] : 0;
            // Get second number from POST, default to 0
            $num2 = isset($_POST['num2']) ? (float)$_POST['num2'] : 0;
            // Get selected operation
            $operation = $_POST['operation'] ?? '';
            // Perform calculation based on operation
            switch ($operation) {
                case 'add':
                    $result = $num1 + $num2; // Addition
                    break;
                case 'subtract':
                    $result = $num1 - $num2; // Subtraction
                    break;
                case 'multiply':
                    $result = $num1 * $num2; // Multiplication
                    break;
                case 'divide':
                    if ($num2 == 0) {
                        $result = 'Error: Division by zero'; // Handle division by zero
                    } else {
                        $result = $num1 / $num2; // Division
                    }
                    break;
                default:
                    $result = 'Invalid operation'; // Invalid operation fallback
            }
            // Display the result in a styled div
            echo '<div class="result"><strong>Result: </strong>' . htmlspecialchars($result) . '</div>';
        }
        ?>
    </form> <!-- End of calculator form -->
</body> <!-- End of body -->
</html> <!-- End of HTML document -->
