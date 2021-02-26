<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | PHP Motors</title>
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
            <h2 class="form">Sign In</h2>
            <?php
            if (isset($_SESSION['message'])) { ?>
                <p class ="form-msg"> <?php  echo $_SESSION['message']; ?> </p>
            <?php } 
            unset($_SESSION['message']); ?>
            <form id="login" method="post" action="/phpmotors/accounts/">
                
                <label for="clientEmail">Email</label>
                <input type="email" id="clientEmail" placeholder="Enter Email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>

                <label for="clientPassword">Password</label>
                <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</span>
                <input type="password" id="clientPassword" placeholder="Enter Password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>

                <input type="hidden" name="action" value="signin">
                <input type="submit" name="submit" value="Sign In" class="submitBt">
            </form>
            <p class="form">Not a member yet? <a href="/phpmotors/accounts/index.php?action=register" title="Register">Sign up</a>.</p>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
</body>

</html>