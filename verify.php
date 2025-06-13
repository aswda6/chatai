<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_otp = $_POST['otp'];

    if ($user_otp == $_SESSION['otp']) {
        // OTP is correct – redirect to next page
        echo "<script>alert('OTP verified successfully!'); window.location.href='success.html';</script>";
        exit;
    } else {
        // OTP is incorrect – show error
        echo "<script>alert('Incorrect OTP. Please try again.'); window.location.href='verify.html';</script>";
        exit;
    }
} else {
    echo "Invalid request";
}
