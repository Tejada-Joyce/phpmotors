<?php
// if(!$_SESSION['loggedin'] || !($_SESSION['clientData']['clientLevel'] > 1)){
//     header('Location: /phpmotors/');
// }
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('Location: /phpmotors/');
    exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicle Management | PHP Motors</title>
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
            <h1>Vehicle Management</h1>
            <ul>
                <li><a href="/phpmotors/vehicles?action=deliverClassficationView" title="Add Classification">Add Classification</a></li>
                <li><a href="/phpmotors/vehicles?action=deliverVehicleView" title="Add Vehicle">Add Vehicle</a></li>
            </ul>
            <?php
                if (isset($message)) { 
                    echo $message; 
                } 
                if (isset($classificationList)) { 
                    echo '<h2>Vehicles By Classification</h2>'; 
                    echo '<p>Choose a classification to see those vehicles</p>'; 
                    echo $classificationList; 
                }
            ?>
            <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
    <script src="/phpmotors/js/inventory.js"></script>
</body>

</html>

<?php unset($_SESSION['message']); ?>