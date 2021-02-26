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
    <title>Add Classification | PHP Motors</title>
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
            <h2 class="form">Add Car Classification</h2>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form id="carClass" method="post" action="/phpmotors/vehicles/index.php">
                <label for="classificationName">Classification Name</label>
                <input type="text" id="classificationName" name="classificationName" required>

                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="addClassification">
                <input type="submit" name="submit" value="Add Classification" class="submitBt">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
</body>

</html>