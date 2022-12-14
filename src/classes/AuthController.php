<?php
declare(strict_types=1);

require_once 'classes/Database.php';

class AuthController
{
    public function register(array $input): void
    {
        if (empty($input['username']) || empty($input['email']) || empty($input['password'])) {
            throw new Exception('Form data not validated.');
        }

        $username = htmlspecialchars($input['username']);
        $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
        $password = password_hash($input['password'], PASSWORD_DEFAULT);

        $db = new Database();
        if (!$db->query(
            "INSERT INTO users(username, email, password) VALUES (?, ?, ?)",
            [
                $username,
                $email,
                $password
            ]
        )) {
            throw new Exception('Error during registration.');
        }

        $id = $db->getLastInsertId();

        $_SESSION['user'] = [
            'id' => $id,
            'username' => $username,
            'email' => $email
        ];

        http_response_code(302);
        header('location: index.php');
    }

    public function showRegistrationForm(): void
    {
        include 'public/views/includes/header.view.php';
        include 'public/views/registration.view.php';
        include 'public/views/includes/footer.view.php';
    }

    public function login(array $input)
    {
        if (empty($input) || empty($input['username']) || empty($input['password'])) {
            throw new Exception('Form data not validated.');
        }

        // Sanitize/validate input
        $username = htmlspecialchars($input['username']);
        $password = htmlspecialchars($input['password']);

        $db = new Database();
        if (!$user = $db->query(
            "SELECT * FROM users WHERE username = ?",
            [
                $username,
            ]
        )->fetch()) {
            throw new Exception('Failed login attempt : connection error.');
        }

        if (!password_verify($password, $user['password'])) {
            throw new Exception("Failed login attempt : wrong password");
        }

        $_SESSION['user'] = [
            "id" => $user["id"],
            'username' => $user['username'],
            'email' => $user['email']
        ];

        // Then, we redirect to the home page
        http_response_code(302);
        header('location: index.php');
    }

    public function showLoginForm()
    {
        include 'public/views/includes/header.view.php';
        include 'public/views/login.view.php';
        include 'public/views/includes/footer.view.php';
    }

    public function logout()
    {
        unset($_SESSION['user']);

        header('location: index.php');
    }
}