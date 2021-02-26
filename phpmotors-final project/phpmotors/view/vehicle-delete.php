<?php
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
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
            <h2 class="form"><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		                             echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	                         ?></h2>
            <?php
            if (isset($message)) {
                echo $message; 
            } 
            ?>
            <p class='form'>Confirm Vehicle Deletion. The delete is permanent.</p>
            <form id="veh-del" method="post" action="/phpmotors/vehicles/index.php">                       

                <label for="invMake">Make</label>
                <input type="text" id="invMake" name="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> readonly>

                <label for="invModel">Model</label>
                <input type="text" id="invModel" name="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> readonly>

                <label for="invDescription">Description</label>
                <textarea id="invDescription" name="invDescription" readonly><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                       
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="submit" name="submit" value="Delete Vehicle" class="submitBt">
                <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">

            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
</body>

</html>