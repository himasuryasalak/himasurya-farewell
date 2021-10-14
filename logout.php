<?php
require_once __DIR__ . '/vendor/autoload.php';

setcookie('X-FRWL-SESSION', 'LOGOUT');

header('Location: /');