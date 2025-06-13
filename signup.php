<?php
session_start();

function getUsers() {
    $file = 'users.json';
    if (!file_exists($file)) return [];
    $json = file_get_contents($file);
    return json_decode($json, true) ?: [];
}

function saveUsers($users) {
    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users = getUsers();

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            echo "<script>alert('You can\'t sign up because this email has an account.'); window.history.back();</script>";
            exit;
        }
    }

    // Add new user
    $users[] = ['email' => $email, 'password' => $password];
    saveUsers($users);

    // Proceed with OTP or success
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    // Redirect or send OTP logic here
    header('Location: index.html');
    exit;
}
?>
