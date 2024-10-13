<?php
require_once '../includes/db.php';

function performLogin($username, $password) {
    $pdo = get_connection();
    $sql = "SELECT id, username, password FROM users WHERE username = :username";
    
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        $param_username = $username;
        
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                if ($row = $stmt->fetch()) {
                    $id = $row["id"];
                    $hashed_password = $row["password"];
                    if (password_verify($password, $hashed_password)) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}

// Define your test cases
$testCases = [
    ['user@example.com', 'Pass1234!', true, true],
    ['user@example.com', 'Pass1234!', true, false],
    ['username', 'Pass1234!', false, true],
    ['', 'Pass1234!', true, false],
    ['user@example.com', 'short', false, false],
    ['user@example.com', 'VeryLongPasswordThatExceedsLimits!', true, false],
    ['incorrect-email-format', 'Pass1234!', false, false],
    ['user@example.com', 'Pass1234!', null, false],
];

// Execute test cases
foreach ($testCases as $index => $testCase) {
    $result = performLogin($testCase[0], $testCase[1]);
    $expectedOutcome = $testCase[2];
    $testPassed = ($result === $expectedOutcome);

    echo "Test Case #".($index+1)." with data (Username: '{$testCase[0]}', Password: '{$testCase[1]}') ";
    echo $testPassed ? "PASSED" : "FAILED";
    echo !$testPassed ? " - Expected outcome was " . ($expectedOutcome ? "success" : "failure") : "";
    echo "<br>\n";
}
?>
