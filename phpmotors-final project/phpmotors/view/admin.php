<?php
if(!$_SESSION['loggedin']){
    header('Location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Client Admin | PHP Motors</title>
        <meta name="author" content="Joyce Tejada">
        <!-- external style references in the proper cascading order -->    
        <link href="https://fonts.googleapis.com/css2?family=Oxygen+Mono&display=swap" rel="stylesheet"> <!-- Google API font reference -->
        <link href="/phpmotors/css/normalize.css" rel="stylesheet"> <!-- normalize useragent/browser defaults -->
        <link href="/phpmotors/css/main.css" type="text/css" rel="stylesheet" media="screen">    
    </head>
    <body>
        <div id="content">
            <header> 
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?> 
            </header>         
            <nav>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/nav.php'; ?> 
            </nav> 
            <main>
                <h1><?php 
                    echo $_SESSION['clientData']['clientFirstname'];
                    echo ' ';
                    echo $_SESSION['clientData']['clientLastname'];?></h1>
                <p> You are logged in.</p>
                <?php
                if (isset($_SESSION['message'])) { ?>
                    <p class ="msg"> <?php  echo $_SESSION['message']; ?> </p>
                <?php } 
                unset($_SESSION['message']); ?>
                <ul>
                    <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                    <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                    <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
                </ul>
                <h2>Account Management</h2>
                <p>Use this link to update account information:</p>
                <p><a class="admin" href="/phpmotors/accounts/index.php?action=deliverUpdClientView" title="Go to Update Account">Update Account Information</a></p>

                <?php     
                if( $_SESSION['clientData']['clientLevel'] > 1){    
                    $message = '<h2>Inventory Management</h2>';
                    $message .= '<p>Use this link to manage the inventory:</p>';
                    $message .= '<p><a class="admin" href="/phpmotors/vehicles/" title="Go to Vehicles Management">Vehicles Management</a></p>';                
                    echo $message;
                } 
                ?>
                <h2>Manage Your Product Reviews</h2>
                <?php
                if (isset($_SESSION['message-rev'])) { ?>
                    <p class ="msg"> <?php  echo $_SESSION['message-rev']; ?> </p>
                <?php } ?>
                <!-- unset($_SESSION['message-rev']); ?> -->
                <?php 
                if(isset($_SESSION['reviewsList'])){
                    echo $_SESSION['reviewsList'];
                }
                ?>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?> 
            </footer> 
        </div>     
    </body>
</html>
