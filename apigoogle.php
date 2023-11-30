<?php

session_start();

require_once 'vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId('158206345264-i7qnk3a5vv00h40veptg3hhvfocv947t.apps.googleusercontent.com');

$google_client->setClientSecret('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');

$google_client->setRedirectUri('http://localhost/tallermecanico/index.php');

$google_client->addScope('email');

$google_client->addScope('profile');