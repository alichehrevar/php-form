<?php
session_start();
require_once __DIR__ . '/../../../config/db_loader.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // get all form data
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

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

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Get database configuration
    $dbConfig = getDbConfig();

    // Create connection
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    // Check connection
    if ($conn->connect_error) {
        $_SESSION['error'] = "Database connection failed.";
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
        $conn->close();
        header("Location: /");
        exit;
    }

    $emailCheckStmt->close();

    // Insert data into users table
    $stmt = $conn->prepare("INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        $_SESSION['error'] = "Failed to prepare the database statement.";
        header("Location: /");
        exit;
    }

    $stmt->bind_param("ssss", $name, $surname, $email, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Data saved successfully!";
        unset($_SESSION['old_input']);
        header("Location: /");
    } else {
        error_log("Database error: " . $stmt->error);
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: /");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Unauthorized access!";
}