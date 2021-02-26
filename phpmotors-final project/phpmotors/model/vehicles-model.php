<?php
/*
* This is the Vehicles Model
*/


//This function will insert a new classification to the carclassifications table.
function newClassification($classificationName) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO carclassification 
                (classificationName)
            VALUES 
                (:classificationName)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//This function will insert a new vehicle to the inventory table.
function newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId)  {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory 
                (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
            VALUES 
                (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
}

// Get vehicle information by invId
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

// Get vehicle information by invId
function getVehicleInfo($invId){
    $db = phpmotorsConnect();
    // $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $sql = 'SELECT 
            i.invId, 
            i.invMake, 
            i.invModel, 
            i.invDescription, 
            im.imgPath,
            i.invPrice, 
            i.invStock, 
            i.invColor, 
            i.classificationId
            FROM inventory i 
            INNER JOIN images im
                ON i.invId = im.invId 
            WHERE i.invId = :invId
            AND im.imgPath NOT LIKE "%-tn%"
            AND im.imgPrimary = 1';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

//This function will update a vehicle.
function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId)  {
    $db = phpmotorsConnect();
    $sql = 'UPDATE inventory
            SET
                invMake = :invMake,
                invModel = :invModel,
                invDescription = :invDescription,
                invImage = :invImage,
                invThumbnail = :invThumbnail,
                invPrice = :invPrice,
                invStock = :invStock,
                invColor = :invColor,
                classificationId = :classificationId
            WHERE
                invId = :invId';          
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//This function will delete a vehicle.
function deleteVehicle($invId)  {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory
            WHERE invId = :invId';                
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//This function will get a list of vehicles based on the classification.
// function getVehiclesByClassification($classificationName) {
//     $db = phpmotorsConnect();
//     $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
//     $stmt = $db->prepare($sql);
//     $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
//     $stmt->execute();
//     $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     $stmt->closeCursor();
//     return $vehicles;
// }

function getVehiclesByClassification($classificationName) {
    $db = phpmotorsConnect();
    $sql = 'SELECT 
            i.invId, 
            i.invMake, 
            i.invModel, 
            i.invDescription, 
            im.imgPath,
            i.invPrice, 
            i.invStock, 
            i.invColor, 
            i.classificationId
            FROM inventory i 
            INNER JOIN images im
                ON i.invId = im.invId 
            INNER JOIN carclassification c
                ON i.classificationId = c.classificationId 
            WHERE i.classificationId = ( SELECT classificationId
                                         FROM carclassification
                                         WHERE classificationName = :classificationName)
            AND im.imgPath LIKE "%-tn%"
            AND im.imgPrimary = 1';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}
//This function will get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}

//This function will get the thumbnail images for a specific vehicles
function getVehicleThumbnails($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT imgPath 
            FROM images 
            WHERE invId = :invId 
            AND imgPath LIKE "%-tn%"
            ORDER BY imgPrimary DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $thumbnails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $thumbnails;
}