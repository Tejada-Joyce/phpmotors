<?php

/*
* This is the Reviews Controller
*/

// Create or access a Session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the reviews model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';
// Get the vehicles model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
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
    // Add a new review
    case 'addReview':
        // Filter and store the data
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);    
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $vehicle = getVehicleInfo($invId);
        $thumbnails = getVehicleThumbnails($invId);
        $client = getClientInfo($clientId);
        $vehicleDisplay = buildVehicleDisplay($vehicle);  
        $thumbnailsDisplay = buildThumbnailsDisplay($thumbnails); 
        $reviews = getReviewsByVeh($invId);
        $reviewsDisplay = buildVehicleReviewsList($reviews); 

        // Check for missing data
        if (empty($reviewText)) {
            $messageVeh = '<p class="form-msg">Please provide information for all empty form fields.</p>';  
            $reviewForm = buildReviewForm($client, $vehicle, $messageVeh);
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
            exit;
        }

        // Send the data to the model
        $insertOutcome = addReview($reviewText, $clientId, $invId);

        // Check and report the result
        if ($insertOutcome === 1) {     
            $messageVeh = '<p class="form-msg">Congratulations, your review was added.</p>'; 
            $reviewForm = buildReviewForm($client, $vehicle, $messageVeh); 
            // Update the list of reviews       
            $reviews = getReviewsByVeh($invId);
            $reviewsDisplay = buildVehicleReviewsList($reviews); 

            // Update the list of reviews in the admin page
            $clientReviews = getReviewsByClient($clientId);
            $reviewsList = buildClientReviewsList($clientReviews);
            $_SESSION['reviewsList'] = $reviewsList; 
            unset($_SESSION['message-rev']);
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
            // header('Location:/phpmotors/vehicles?action=vehicle&invId='. urlencode($invId) .'/');
            exit;
        } else {
            $messageVeh = "<p class='form-msg'>Sorry. We couldn't add your review. Please try again.</p>";
            $reviewForm = buildReviewForm($client, $vehicle, $messageVeh); 
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
            exit;
        }
        break;
    // Deliver a view to edit a review.
    case 'modi':        
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $revInfo = getReviewInfo($reviewId);
        if(count($revInfo)<1){
            $message = '<p class="form-msg">Sorry, no review information could be found.</p>';
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-update.php';
        exit;   
        break;
    // Handle the review update.
    case 'updateReview':
        // Filter and store the data
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);     
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        $revInfo = getReviewInfo($reviewId);
        $clientId = $revInfo['clientId'];
        
        // Check for missing data
        if (empty($reviewText)) {
            $message = '<p class="form-msg">You cannot leave a review empty. Please try again.</p>';
            $reviewText = $revInfo['reviewText'];
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-update.php';
            exit;
        }

        // Send the data to the model
        $updateResult = updateReview($reviewText, $reviewId);

        // Check and report the result
        if ($updateResult) {
            $_SESSION['message'] = "Congratulations, your review was successfully updated.";
            $reviews = getReviewsByClient($clientId);
            $reviewsList = buildClientReviewsList($reviews);
            $_SESSION['reviewsList'] = $reviewsList;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p class='form-msg'>Sorry. We couldn't update your review. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-update.php';
            exit;
        }
        break;
    // Deliver a view to confirm deletion of a review.
    case 'dele':         
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $revInfo = getReviewInfo($reviewId);
        if(count($revInfo)<1){
            $message = '<p class="form-msg">Sorry, no review information could be found.</p>';
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-delete.php';
        exit; 
        break;
    // Handle the review deletion.
    case 'deleteReview':
        // Filter and store the data
        $reviewText = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);    
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        
        $revInfo = getReviewInfo($reviewId);
        $clientId = $revInfo['clientId'];

        // Send the data to the model
        $deleteResult = deleteReview($reviewId);

        // Check and report the result
        if ($deleteResult) {
            $_SESSION['message'] = "Congratulations, your review was successfully deleted.";   
            $reviews = getReviewsByClient($clientId);
            if(!count($reviews)){
                $_SESSION['message-rev'] = "Sorry. You haven't written any reviews.";
                unset($_SESSION['reviewsList']);
            } else {
                $reviewsList = buildClientReviewsList($reviews);
                $_SESSION['reviewsList'] = $reviewsList;
            }         
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = "Sorry. We couldn't delete this vehicle. Please try again.";        
            header('Location: /phpmotors/accounts/');
            exit;        
        }				
        break;
    default:
        if(!$_SESSION['loggedin']){
            header('Location: /phpmotors/');
        } else {
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        }
}

unset($_SESSION['message']);
unset($_SESSION['message-rev']);