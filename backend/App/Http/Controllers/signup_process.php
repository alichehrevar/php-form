<?php
session_start();
require_once __DIR__ . '/../../../config/db_loader.php';
require_once __DIR__ . '/../../Requests/formValidationRequest.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // get all form data
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

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

    // Validate input
    validateInput($name, $surname, $email, $password, $conn);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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