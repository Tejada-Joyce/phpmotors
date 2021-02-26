<a href="/phpmotors/" title="View the PHP Motors home page"><img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo"></a>
<?php 

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = TRUE){
    if(isset($_SESSION['clientData']['clientFirstname'])){
        echo "<a href='/phpmotors/accounts/' title='Go to Admin View'><span>Welcome " . $_SESSION['clientData']['clientFirstname'] . "!</span></a>";
    }
} else {
    if(isset($cookieFirstname)){ 
        echo "<span>Welcome $cookieFirstname!</span>";
    }
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = TRUE){
    echo '<a href="/phpmotors/accounts/index.php?action=logout" title="Logout">Logout</a>';
} else {
    echo '<a href="/phpmotors/accounts/index.php?action=login" title="Login to account">My Account</a>';
}
?>