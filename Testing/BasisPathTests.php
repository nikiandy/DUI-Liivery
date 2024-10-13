<?php
function checkInputsEmpty($username, $password) {
    return empty($username) || empty($password);
}

function validateCredentials($username, $password) {
    return $username === "validUser" && $password === "validPass";
}

function determineLoyaltyLevel($username) {
    if ($username === "loyalUser") return 2;
    return 0;
}

function applyDiscount($loyaltyLevel) {
    if ($loyaltyLevel > 0) return 0.1 * $loyaltyLevel;
    return 0;
}

function proceedToCheckout() {
    return true;
}

function provideFeedbackOnError($message) {
    echo $message;
}

function processLogin($username, $password) {
    if (checkInputsEmpty($username, $password)) {
        provideFeedbackOnError("Username and password cannot be empty");
        return;
    }

    if (!validateCredentials($username, $password)) {
        provideFeedbackOnError("Invalid username or password");
        return;
    }

    $loyaltyLevel = determineLoyaltyLevel($username);
    $discount = applyDiscount($loyaltyLevel);
    
    if (proceedToCheckout()) {
        echo "Checkout successful with discount: " . ($discount * 100) . "%";
    } else {
        provideFeedbackOnError("Checkout failed");
    }
}

// Test Cases
echo "Path 1: ";
processLogin("", "");

echo "\nPath 2: ";
processLogin("notValidUser", "notValidPass");

echo "\nPath 3: ";
processLogin("validUser", "invalidPass");

echo "\nPath 4: ";
processLogin("user", "validPass");

echo "\nPath 5: ";
processLogin("loyalUser", "validPass");
?>