<?php

function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

// Build a navigation bar using the $classifications array
function buildNavigation($classifications){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles?action=classification&classificationName=".urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
}

//Format number as currency
function formatDollars($number){
    return '$'. number_format($number, 2, '.', ',');
}

//Build a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= '<div>';
     $dv .= "<a href='/phpmotors/vehicles?action=vehicle&invId=".urlencode($vehicle['invId']) . "' title='View $vehicle[invMake] $vehicle[invModel] detail'><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= '</div>';
     $dv .= '<div>';
     $dv .= '<hr>';
     $dv .= "<h2><a href='/phpmotors/vehicles?action=vehicle&invId=".urlencode($vehicle['invId']) . "' title='View $vehicle[invMake] $vehicle[invModel] detail'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
     $dv .= "<span>". formatDollars($vehicle['invPrice']) ."</span>";
     $dv .= '</div>';
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

//Build a display of the vehicle's information
function buildVehicleDisplay($vehicle){    
    // $fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY);
    // $formattedCurrency = preg_replace('/,00$/', '', $fmt->formatCurrency($vehicle['invPrice'], 'USD'));
    $dv = "<div class='flexbox1'>";
    $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= "<div class='details'>";
    $dv .= "<p class='price'>Price: ". formatDollars($vehicle['invPrice']) ."</p>";
    $dv .= "<h3>$vehicle[invMake] $vehicle[invModel] Details</h3>";
    $dv .= "<p class='desc'>$vehicle[invDescription]</p>";    
    $dv .= "<p class='det'>Color: $vehicle[invColor]</p>";
    $dv .= "<p class='det'># in Stock: $vehicle[invStock]</p>";
    $dv .= "</div>";
    $dv .= "</div>";
    return $dv;
}

/* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= '<div>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= '</div>';
     $id .= '<div>';
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</div>';
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
        return;
    }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);
    
        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);
    
        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }
    
        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }
    
        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
    
        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
} // ends resizeImage function

function buildThumbnailsDisplay($thumbnails) {
    $thumbList = '<h3>Thumbnail Images</h3>';
    $thumbList .= '<ul>';
    foreach ($thumbnails as $thumbnail) {
     $thumbList .= '<li>';
     $thumbList .= "<img src='$thumbnail[imgPath]' alt='Thumbnail Image'>";
     $thumbList .= '</li>';    
    }
    $thumbList .= '</ul>';
    return $thumbList;
}


//Build a list of vehicles with review by client
function buildClientReviewsList($reviews){    
    $reviewsList = '<ul>';
    foreach ($reviews as $review) {
     $reviewsList .= "<li> $review[invMake] $review[invModel] (Reviewed on " . date('F j, Y', strtotime($review['reviewDate'])) . "): ";
     $reviewsList .= "<a href='/phpmotors/reviews?action=modi&reviewId=".urlencode($review['reviewId']) . "' title='Click to edit'>Edit</a>";
     $reviewsList .= "| <a href='/phpmotors/reviews?action=dele&reviewId=".urlencode($review['reviewId']) . "' title='Click to delete'>Delete</a>";
     $reviewsList .= '</li>';    
    }
    $reviewsList .= '</ul>';
    return $reviewsList;
}

//Build a vehicle reviews list
function buildVehicleReviewsList($reviews){   
    $reviewsList = '<ul id="reviews">';
    foreach ($reviews as $review) {
     $reviewsList .= "<li class='container'>" . substr($review['clientFirstname'],0,1) ."$review[clientLastname] wrote on " . date('F j, Y', strtotime($review['reviewDate'])) . ": <span>";
     $reviewsList .= $review['reviewText'];
     $reviewsList .= '</span></li>';    
    }
    $reviewsList .= '</ul>';
    return $reviewsList;
} 

function buildReviewForm($client, $vehicle, $messageVeh){
    $form = "<h2 class='form'>Review the $vehicle[invMake] $vehicle[invModel]</h2>";
    if (isset($messageVeh)) {
        $form .= $messageVeh;
    } 
    $form .= "<form id='add-rev' method='post' action='/phpmotors/reviews/'>";
    $form .= "<label for='screen'>Screen Name:</label>";
    $form .= "<input type='text' id='screen' name='screen' value = '" . substr($client['clientFirstname'],0,1) . "$client[clientLastname]' readonly>";
    $form .= "<label for='reviewText'>Review:</label>";
    $form .= "<textarea id='reviewText' name='reviewText' placeholder='Enter Review'  required></textarea>";
    $form .= "<input type='hidden' name='action' value='addReview'>";
    $form .= "<input type='submit' name='submit' value='Submit Review' class='submitBt' id='rev'>";
    $form .= "<input type='hidden' name='invId' value='$vehicle[invId]'>";
    $form .= "<input type='hidden' name='clientId' value='$client[clientId]'>";
    $form .= "</form>";
    return $form;
}