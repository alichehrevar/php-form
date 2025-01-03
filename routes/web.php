<?php

// routes/web.php

// Parse the request URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Define routes
switch ($requestUri) {
    case '/':
        // Serve the frontend
        require_once __DIR__ . '/../frontend/pages/index.php';
        break;

    case '/signup_process':
        // Serve the signup process
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../backend/App/Http/Controllers/signup_process.php';
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
        break;

    default:
        // Handle 404
        http_response_code(404);
        echo "404 Not Found";
        break;
}