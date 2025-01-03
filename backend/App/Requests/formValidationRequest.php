<?php
function validateInput($name, $surname, $email, $password, $conn) {
    session_start();

    // Store old input in session
    $_SESSION['old_input'] = [
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
    ];

    // Basic validation
    if (empty($name) || empty($surname) || empty($email) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: /");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: /");
        exit;
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters long.";
        header("Location: /");
        exit;
    }

    // Check if email already exists
    $emailCheckStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if (!$emailCheckStmt) {
        $_SESSION['error'] = "Database error.";
        header("Location: /");
        exit;
    }

    $emailCheckStmt->bind_param("s", $email);
    $emailCheckStmt->execute();
    $emailCheckStmt->store_result();

    if ($emailCheckStmt->num_rows > 0) {
        $_SESSION['error'] = "Email already exists. Please use a different email.";
        $emailCheckStmt->close();
        header("Location: /");
        exit;
    }

    $emailCheckStmt->close();
}
