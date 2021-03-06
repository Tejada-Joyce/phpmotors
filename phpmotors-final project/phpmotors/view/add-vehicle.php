<?php
// Build a classification drop-down select list using the $classifications array
$classificationList = '<select id="classificationId" name="classificationId" required>';
$classificationList .= '<option value="">Select</option>';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
            $classificationList .= ' selected';
        }
    }    
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';

// if(!$_SESSION['loggedin'] || !($_SESSION['clientData']['clientLevel'] > 1)){
//     header('Location: /phpmotors/');
// }
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Vehicle | PHP Motors</title>
    <meta name="author" content="Joyce Tejada">
    <!-- external style references in the proper cascading order -->
    <link href="https://fonts.googleapis.com/css2?family=Oxygen+Mono&display=swap" rel="stylesheet"> <!-- Google API font reference -->
    <link href="/phpmotors/css/normalize.css" rel="stylesheet"> <!-- normalize useragent/browser defaults -->
    <link href="/phpmotors/css/main.css" type="text/css" rel="stylesheet" media="screen">
</head>

<body>
    <div id="content">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
        </header>
        <nav>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>
        </nav>
        <main>
            <h2 class="form">Add Vehicle</h2>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form id="add-veh" method="post" action="/phpmotors/vehicles/index.php">
                <label for="classificationId">Car Classification:</label>
                <?php echo $classificationList; ?>            

                <label for="invMake">Make</label>
                <input type="text" id="invMake" placeholder="Enter Make" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";}  ?> required>

                <label for="invModel">Model</label>
                <input type="text" id="invModel" placeholder="Enter Model" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";}  ?> required>

                <label for="invDescription">Description</label>
                <textarea id="invDescription" placeholder="Enter Description" name="invDescription"  required><?php if(isset($invDescription)){echo "$invDescription";}  ?></textarea>
                
                <label for="invImage">Image</label>
                <input type="text" id="invImage" value="/phpmotors/images/vehicles/no-image.png" placeholder="Enter Image" name="invImage" <?php if(isset($invImage)){echo "value='$invImage'";}  ?> required>

                <label for="invThumbnail">Thumbnail</label>
                <input type="text" id="invThumbnail" value="/phpmotors/images/vehicles/no-image-tn.png" placeholder="Enter Thumbnail" name="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> required>

                <label for="invPrice">Price</label>
                <input type="number" id="invPrice" placeholder="Enter Price" name="invPrice" step=".01" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required>

                <label for="invStock">Stock</label>
                <input type="number" id="invStock" placeholder="Enter Stock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required>

                <label for="invColor">Color</label>
                <input type="text" id="invColor" placeholder="Enter Color" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";}  ?> required>

                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="addVehicle">
                <input type="submit" name="submit" value="Add Vehicle" class="submitBt">

            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
</body>

</html>