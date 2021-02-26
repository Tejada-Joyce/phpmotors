<?php

/*
* This is the main controller
*/

// Create or access a Session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/main-model.php';

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// echo '<pre>'.print_r($classifications, true).'</pre>';  
// exit;  

// Build a navigation bar using the buildNavigation function
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'something':

        break;

    default:
        include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/home.php';
}

unset($_SESSION['message']);