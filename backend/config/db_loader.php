<?php

// Global Configuration Loader
function loadEnv() {
    static $env = null;
    if ($env === null) {
        // Load environment variables
        if (file_exists(__DIR__ . '/../../.env')) {
            $env = parse_ini_file(__DIR__ . '/../../.env');
        } else {
            die("The .env file was not found.");
        }
    }
    return $env;
}

function getDbConfig() {
    $env = loadEnv();
    return [
        'servername' => $env['DB_HOST'],
        'username' => $env['DB_USERNAME'],
        'password' => $env['DB_PASSWORD'],
        'dbname' => $env['DB_DATABASE'],
    ];
}
