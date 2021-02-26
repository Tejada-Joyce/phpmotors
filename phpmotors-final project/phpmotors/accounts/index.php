<?php

/*
* This is the Accounts Controller
*/

// Create or access a Session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the accounts model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
// Get the reviews model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the buildNavigation function
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
        break;
    case 'register':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
        break;
    case 'registerUser':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for an existing email address
        $existingEmail = checkExistingEmail($clientEmail);
        if($existingEmail) {
            $_SESSION['message'] = "That email address already exists. Do you want to login instead?";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        }

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = "Please provide information for all empty form fields.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if ($regOutcome === 1) {            
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering, $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $_SESSION['message'] = "Sorry $clientFirstname, but the registration failed. Please try again.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        }
        break;
    case 'signin':
        // Filter and store the data
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = "Please provide a valid email address and password.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
            $_SESSION['message'] = "Please check your password and try again.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Destroy the "firstname" cookie
        if (isset($_COOKIE['firstname'])) { 
            setcookie('firstname', 'phpmotors', time() - 3600, '/');
        } 

        $clientId =  $_SESSION['clientData']['clientId'];
        $reviews = getReviewsByClient($clientId);
        if(!count($reviews)){
            $_SESSION['message-rev'] = "Sorry. You haven't written any reviews.";
        } else {
            $reviewsList = buildClientReviewsList($reviews);
            $_SESSION['reviewsList'] = $reviewsList;
        }
        // Send them to the admin view
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        exit;
        break;
    case 'logout':
        session_destroy();
        header('Location: /phpmotors/');  
        break;
    case 'deliverUpdClientView':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
        break;
    case 'updateClient':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientEmail = checkEmail($clientEmail);

        // Check if the email address is different than the one in the session.         
        if($clientEmail != $_SESSION['clientData']['clientEmail']){    
            // Check for an existing email address        
            $existingEmail = checkExistingEmail($clientEmail);
            if($existingEmail) {
                $_SESSION['message'] = "That email address already exists. Enter a different one, please.";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
                exit;
            }
        } 

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $_SESSION['message'] = "Please provide information for all empty form fields.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
            exit;
        }

        // Send the data to the model
        $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Check and report the result
        if ($updateResult) {
            $_SESSION['message'] = "Congratulations, $clientFirstname! Your information has been updated.";
            // Query the client data based on the clientId
            $clientInfo = getClientInfo($clientId);
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientInfo);
            // Store the array into the session
            $_SESSION['clientData'] = $clientInfo;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = "Sorry, $clientFirstname. We couldn't update your account information. Please try again.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
            exit;
        }        
        break;
    case 'updatePass':
        $clientFirstname =  $_SESSION['clientData']['clientFirstname'];
        // Filter and store the data
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($checkPassword)) {
            $_SESSION['message2'] = "Please provide a password that meets the requirements.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
            exit;
        }    
                  
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model
        $updateResult = updatePassword($hashedPassword, $clientId);

        // Check and report the result
        if ($updateResult) {
            $_SESSION['message'] = "Congratulations, $clientFirstname! Your password has been updated.";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = "Sorry, $clientFirstname. We couldn't update your password.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
            exit;
        }           
        break;
    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
}

unset($_SESSION['message']);
unset($_SESSION['message2']);