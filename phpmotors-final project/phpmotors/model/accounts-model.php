<?php
/*
* This is the Accounts Model
*/


//This function will handle site registrations.
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO clients 
                (clientFirstname, clientLastname,clientEmail, clientPassword)
            VALUES 
                (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//This function will check for an existing email address.
function checkExistingEmail($clientEmail){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT clientEmail
            FROM clients
            WHERE clientEmail = :clientEmail';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    // The next line runs the prepared statement 
    $stmt->execute();
    // The next line gets a single row from the database if a match is found
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    // The next line closes the interaction with the database 
    $stmt->closeCursor();
    // If the array is empty, return a zero "0"; otherwise, return a "1".
    if(empty($matchEmail)){
        return 0;
    } else {
        return 1;
    }
}

// Get client data based on an email address
function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}

//This function will update a vehicle.
function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients
            SET
                clientFirstname = :clientFirstname,
                clientLastname = :clientLastname,
                clientEmail = :clientEmail
            WHERE
                clientId = :clientId';          
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// Get client data based on an email address
function getClientInfo($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientInfo;
}

function updatePassword($clientPassword, $clientId) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients
            SET
                clientPassword = :clientPassword
            WHERE
                clientId = :clientId';          
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}