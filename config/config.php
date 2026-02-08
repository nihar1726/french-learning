<?php
// config/config.php

// Site settings
define('SITE_NAME', 'French Learning Hub');
define('SITE_URL', 'http://localhost/french-learning');

// Path settings
define('ROOT_PATH', dirname(__DIR__));

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Session settings
ini_set('session.cookie_httponly', 1);
session_start();
?>