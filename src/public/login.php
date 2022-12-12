<?php
declare(strict_types=1);

session_start();

require_once 'public/db/connection.php';

if (empty($input = validateInput($_POST))) {
    displayLoginForm();
} else {
    attemptLogin($input, $pdo);
}

function validateInput(array $input) : array|false
{
    // Check if input exists
    if (empty($input)) return false;
    if (empty($input['username']) || empty($input['password'])) return false;

    // Sanitize/validate input
    $username = htmlspecialchars($input['username']);
    $password = htmlspecialchars($input['password']);

    return [
        'username' => $username,
        'password' => $password,
    ];
}

function attemptLogin(array $input, PDO $pdo): void
{
    // Query to get the user associated with the login used
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");

    // If query fails
    if (!$stmt->execute([$input['username']])) {
        throw new Exception("Failed login attempt : connection error");
    }

    // If there is no user with that login
    if (empty($user = $stmt->fetch(PDO::FETCH_ASSOC))) {
        throw new Exception("Failed login attempt : user does not exist");
    }

    // If the password does not match
    if (!password_verify($input['password'], $user['password'])) {
        throw new Exception("Failed login attempt : wrong password");
    }

    // If all verifications passed, we log the user by storing its data in session
    $_SESSION['user'] = [
        "id" => $user["id"],
        'username' => $user['username'],
        'email' => $user['email']
    ];

    // Then, we redirect to the home page
    http_response_code(302);
    header('location: index.php');
}

function displayLoginForm(): void
{
    include 'public/views/includes/header.view.php';
    include 'public/views/login.view.php';
    include 'public/views/includes/footer.view.php';
}