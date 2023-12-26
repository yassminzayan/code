<?php
// Execute a command and capture the output and errors
$output = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $command = isset($_POST['command']) ? htmlspecialchars($_POST['command']) : '';

    // Validate and restrict commands if necessary
    if ($command !== '') {
        // Execute the command and capture the output and errors
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // On Windows, use 'dir' instead of 'ls'
            exec("dir \"$command\" 2>&1", $output, $returnValue);
        } else {
            // On Unix-like systems, use 'ls'
            exec("ls \"$command\" 2>&1", $output, $returnValue);
        }
        
        // Separate standard output and errors
        $errors = array_filter($output, function($line) {
            return stripos($line, 'error') !== false;
        });

        $output = array_diff($output, $errors);
    } else {
        // Handle the case where the command is empty
        echo "Please enter a command.";
    }
}

// Display the output, errors, and error code
echo "<pre>Output:\n" . implode("\n", array_map('htmlspecialchars', $output)) . "</pre>";
echo "<pre>Errors:\n" . implode("\n", array_map('htmlspecialchars', $errors)) . "</pre>";
echo "<p>Return value: $returnValue</p>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Terminal</title>
</head>
<body>
    <h1>Web Terminal</h1>

    <form method="post" action="">
        <label for="command">Terminal Command:</label>
        <textarea name="command" rows="4" cols="50"></textarea>
        <button type="submit">Execute</button>
    </form>
</body>
</html>
