<?php

/*
* This is the Vehicles Controller
*/

// Create or access a Session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the vehicles model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
// Get the uploads model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/uploads-model.php';
// Get the reviews model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';
// Get the accounts model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the buildNavigation function
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'deliverClassficationView':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
        break;
    case 'deliverVehicleView':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
        break;
    case 'addClassification':
        // Filter and store the data
        $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);

        // Check for missing data
        if (empty($classificationName)) {
            $message = '<p class="form-msg">Please provide information for the empty form field.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = newClassification($classificationName);

        // Check and report the result
        if ($regOutcome === 1) {
            header('Location:/phpmotors/vehicles/index.php');
            exit;
        } else {
            $message = "<p class='form-msg'>Sorry. We couldn't add this name. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
            exit;
        }
        break;
    case 'addVehicle':
        // Filter and store the data
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);


        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p class="form-msg">Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        // Check and report the result
        if ($regOutcome === 1) {
            $message = "<p class='form-msg'>The $invMake $invModel was added successfully!</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        } else {
            $message = "<p class='form-msg'>Sorry. We couldn't add this vehicle. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        }
        break;
    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-update.php';
        exit;   
        break;
    case 'updateVehicle':
        // Filter and store the data
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p class="form-msg">Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-update.php';
            exit;
        }

        // Send the data to the model
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

        // Check and report the result
        if ($updateResult) {
            $message = "<p class='msg'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='form-msg'>Sorry. We couldn't update this vehicle. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-update.php';
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-delete.php';
        exit;  
        break;
    case 'deleteVehicle':
		// Filter and store the data
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        // Send the data to the model
        $deleteResult = deleteVehicle($invId);

        // Check and report the result
        if ($deleteResult) {
            $message = "<p class='msg'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='msg'>Sorry. We couldn't delete this vehicle. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/vehicles/');
            exit;        
        }				
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
            $message = "<p class='msg'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        // echo $vehicleDisplay;
        // exit;
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/classification.php';
        break;
    case 'vehicle':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $vehicle = getVehicleInfo($invId);
        $thumbnails = getVehicleThumbnails($invId);
        $reviews = getReviewsByVeh($invId);

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = TRUE){
            $client = getClientInfo($_SESSION['clientData']['clientId']);
        }
        
        if(!count($vehicle)){
            $message = "<p class='msg'>Sorry, no information could be found.</p>";
        } else {
            $vehicleDisplay = buildVehicleDisplay($vehicle);  
            $thumbnailsDisplay = buildThumbnailsDisplay($thumbnails);    
            if (!count($reviews)){
                if(!isset($_SESSION['loggedin'])){
                    $message2 = "<p class='note'>There are no reviews for this vehicle yet. <a href='/phpmotors/accounts/index.php?action=login' title='Login to account'>Login</a> and be the first to write a review.</p>";
                } else {
                    $message2 = "<p class='note'>There are no reviews for this vehicle yet. Be the first to write a review." ;                    
                    $reviewForm = buildReviewForm($client, $vehicle, null);
                }
            } else {
                if(!isset($_SESSION['loggedin'])){
                    $message2 = "<p class='note'>You must <a href='/phpmotors/accounts/index.php?action=login' title='Login to account'>login</a> to write a review." ;
                    $reviewsDisplay = buildVehicleReviewsList($reviews);  
                } else {
                    $reviewForm = buildReviewForm($client, $vehicle, null);
                    $reviewsDisplay = buildVehicleReviewsList($reviews);
                }
            }      
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);

        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-management.php';
}

unset($_SESSION['message']);