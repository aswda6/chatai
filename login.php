<?php
session_start();

function getUsers() {
    $file = 'users.json';
    if (!file_exists($file)) return [];
    $json = file_get_contents($file);
    return json_decode($json, true) ?: [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users = getUsers();

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            if ($user['password'] === $password) {
                // Login success
                $_SESSION['email'] = $email;
                header('Location: dashboard.html'); // or your logged-in page
                exit;
            } else {
                echo "<script>alert('Incorrect password.'); window.history.back();</script>";
                exit;
            }
        }
    }
    echo "<script>alert('Email not found. Please sign up first.'); window.history.back();</script>";
    exit;
}
?>
