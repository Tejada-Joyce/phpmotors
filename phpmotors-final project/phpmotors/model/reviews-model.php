<?php
/*
* This is the Reviews Model
*/

// Insert a review
function addReview($reviewText, $clientId, $invId)  {    
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews 
                (reviewText, invId, clientId)
            VALUES 
                (:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// Get reviews for a specific inventory item
function getReviewsByVeh($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT r.reviewId, 
                   r.reviewText, 
                   r.reviewDate, 
                   r.invId, 
                   r.clientId, 
                   c.clientFirstname, 
                   c.clientLastname 
            FROM reviews r
            JOIN clients c
                ON r.clientId = c.clientId
            JOIN inventory i
                ON i.invId = r.invId
            WHERE r.invId = :invId
            ORDER BY r.reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $revInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $revInfo;
}

// Get reviews written by a specific client
function getReviewsByClient($clientId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT r.reviewId, 
                   r.reviewText, 
                   r.reviewDate, 
                   r.invId, 
                   r.clientId, 
                   i.invMake, 
                   i.invModel 
            FROM reviews r
            JOIN clients c
                ON r.clientId = c.clientId
            JOIN inventory i
                ON i.invId = r.invId
            WHERE r.clientId = :clientId
            ORDER BY r.reviewDate'; 
            // ORDER BY i.invMake';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $revInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $revInfo;
}

// Get a specific review
function getReviewInfo($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT r.reviewId, 
                   r.reviewText, 
                   r.reviewDate, 
                   r.invId, 
                   r.clientId, 
                   i.invMake, 
                   i.invModel 
            FROM reviews r
            JOIN clients c
            ON r.clientId = c.clientId
            JOIN inventory i
            ON i.invId = r.invId
            WHERE r.reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $revInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $revInfo;
}

// Update a specific review
function updateReview($reviewText, $reviewId) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews
            SET
                reviewText = :reviewText
            WHERE
                reviewId = :reviewId';          
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// Delete a specific review
function deleteReview($reviewId)  {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews
            WHERE reviewId = :reviewId';                
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}