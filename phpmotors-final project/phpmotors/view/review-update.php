<?php
if(!$_SESSION['loggedin']){
    header('Location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if(isset($revInfo['invMake']) && isset($revInfo['invModel'])){ 
		            echo "Update $revInfo[invMake] $revInfo[invModel]";} 
	             elseif(isset($invMake) && isset($invModel)) { 
		            echo "Update $invMake $invModel"; }?> Review | PHP Motors</title>
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
            <h2 class="form"><?php if(isset($revInfo['invMake']) && isset($revInfo['invModel'])){ 
		                             echo "Update $revInfo[invMake] $revInfo[invModel] Review";} 
	                               elseif(isset($invMake) && isset($invModel)) { 
		                             echo "Update $invMake $invModel Review"; }?></h2>
            <?php
            if (isset($message)) {
                echo $message;
            } 
            ?>

            <p class="form">Reviewed on <?php if(isset($reviewDate)){echo date('F j, Y', strtotime($reviewDate));} elseif(isset($revInfo['reviewDate'])) {echo date('F j, Y', strtotime($revInfo['reviewDate'])); }?></p>
            <form id="updt-rev" method="post" action="/phpmotors/reviews/">
                
                <label for="reviewText">Review Text</label>
                <textarea id="reviewText" placeholder="Enter review" name="reviewText" required><?php if(isset($reviewText)){echo $reviewText;} elseif(isset($revInfo['reviewText'])) {echo $revInfo['reviewText']; }?></textarea>
                
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updateReview">
                <input type="submit" name="submit" value="Update Review" class="submitBt">
                <input type="hidden" name="reviewId" value="<?php if(isset($revInfo['reviewId'])){ echo $revInfo['reviewId'];} elseif(isset($reviewId)){ echo $reviewId; } ?>">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
</body>

</html>