<?php
declare(strict_types=1);

session_start();

require_once 'public/db/connection.php';

if (empty($_POST)) {
    displayRegistrationForm();
} else {
    if (empty($validatedInput = validateInput($_POST))) {
        throw new Exception("Form data not validated.");
    }

    if (!addUserToDB($validatedInput, $pdo)) {
        throw new Exception("Error during registration.");
    }

    $id = $pdo->lastInsertId();
    loginRegisteredUser($id, $validatedInput['username'], $validatedInput['email']);

    http_response_code(302);
    header('location: index.php');
}


// 1 - Afficher formulaire
function displayRegistrationForm(): void
{
    include 'public/views/includes/header.view.php';
    include 'public/views/registration.view.php';
    include 'public/views/includes/footer.view.php';
}

// 2 - Valider données
function validateInput(array $input): array|false
{
    if (empty($input['username']) || empty($input['email']) || empty($input['password'])) return false;

    $username = htmlspecialchars($input['username']);
    $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($input['password'], PASSWORD_DEFAULT);

    return [
        'username' => $username,
        'email' => $email,
        'password' => $password
    ];
}

// 3 - Ajouter un utilisateur à la DB
function addUserToDB(array $input, PDO $pdo): bool
{
    $stmt = $pdo->prepare("INSERT INTO users(username, email, password) VALUES (:username, :email, :password)");

    $stmt->bindParam(':username', $input['username']);
    $stmt->bindParam(':email', $input['email']);
    $stmt->bindParam(':password', $input['password']);

    return $stmt->execute();
}

// 4 - Connecter utilisateur
function loginRegisteredUser(string $id, string $username, string $email): void
{
    $_SESSION['user'] = [
        'id' => $id,
        'username' => $username,
        'email' => $email
    ];
}