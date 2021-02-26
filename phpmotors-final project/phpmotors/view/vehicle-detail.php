<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo "$vehicle[invMake] $vehicle[invModel]"?> | PHP Motors</title>
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
                <h1 id="vehicle"><?php //echo "$vehicle[invMake] $vehicle[invModel]"?>
                                <?php if(isset($vehicle['invMake']) && isset($vehicle['invModel'])){ 
		                             echo "$vehicle[invMake] $vehicle[invModel]";} 
	                                elseif(isset($invMake) && isset($invModel)) { 
		                             echo "$invMake $invModel"; }?></h1>
                <p class="note">See the vehicle's reviews at the bottom of the page.</p>
                <?php
                if (isset($message)) {
                    echo $message; 
                } 
                ?>
                <div class = "flexbox2">
                    <div id="thumbnails">
                        <?php 
                        if(isset($thumbnailsDisplay)){
                            echo $thumbnailsDisplay;
                        } 
                        ?>
                    </div>
                    <div>  
                        <?php 
                        if(isset($vehicleDisplay)){
                            echo $vehicleDisplay;
                        } 
                        ?>
                    </div>    
                </div>
                <h2>Customer Reviews</h2>
                <?php
                if (isset($message2)) {
                    echo $message2; 
                } 

                if (isset($reviewForm)) {
                    echo $reviewForm; 
                } 
                
                if (isset($reviewsDisplay)) {
                    echo $reviewsDisplay;                     
                } 
                ?>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?> 
            </footer> 
        </div>       
    </body>
</html>
