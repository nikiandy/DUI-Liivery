<?php
require_once '../classes/Users/User.php';

// Test Case for User class
echo "Running UserTest...\n";
$user = new User(1, 'testUser', 'test@example.com');
assert($user->getId() === 1, new Exception("User ID should be 1"));
assert($user->getUsername() === 'testUser', new Exception("Username should be 'testUser'"));
assert($user->getEmail() === 'test@example.com', new Exception("Email should be 'test@example.com'"));
echo "UserTest completed.\n";
?>