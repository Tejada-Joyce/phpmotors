<?php
if(!$_SESSION['loggedin']){
    header('Location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Account Information | PHP Motors</title>
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
            <h1>Update Account Information</h1>
            <h2 class="form">Update Account Info</h2>            
            <?php
            if (isset($_SESSION['message'])) { ?>
                <p class ="form-msg"> <?php  echo $_SESSION['message']; ?> </p>
            <?php } 
            unset($_SESSION['message']); ?>
            <form id="info" method="post" action="/phpmotors/accounts/index.php">
                
                <label for="clientFirstname">First Name</label>
                <input type="text" id="clientFirstname" placeholder="Enter First Name" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($_SESSION['clientData']['clientFirstname'])) {echo 'value= "'. $_SESSION['clientData']['clientFirstname'] . '"'; }?> required>

                <label for="clientLastname">Last Name</label>
                <input type="text" id="clientLastname" placeholder="Enter Last Name" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($_SESSION['clientData']['clientLastname'])) {echo 'value= "'. $_SESSION['clientData']['clientLastname'] . '"'; }?> required>

                <label for="clientEmail">Email</label>
                <input type="email" id="clientEmail" placeholder="Enter Email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData']['clientEmail'])) {echo 'value= "'. $_SESSION['clientData']['clientEmail'] . '"'; }?> required>

                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updateClient">
                <input type="submit" name="submit" value="Update Info" class="submitBt">
                <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">           
            </form>
            <h2 class="form">Update Password</h2>            
            <p class='form'>* Note your original password will be changed.</p>
            <?php
            if (isset($_SESSION['message2'])) { ?>
                <p class ="form-msg"> <?php  echo $_SESSION['message2']; ?> </p>
            <?php } 
            unset($_SESSION['message2']); ?>
            <form id="password" method="post" action="/phpmotors/accounts/index.php">                
                <label for="clientPassword">Password</label>
                <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</span>
                <input type="password" id="clientPassword" placeholder="Enter New Password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>

                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updatePass">
                <input type="submit" name="submit" value="Update Password" class="submitBt">
                <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>"> 
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
</body>

</html>