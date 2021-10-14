<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/session.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (SessionManager::login($_GET['data'])) {
        http_response_code(200);
        exit;
    } else {
        http_response_code(403);
        exit;
    }
}