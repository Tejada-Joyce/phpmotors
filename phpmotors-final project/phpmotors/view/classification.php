<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $classificationName; ?> Vehicles | PHP Motors</title>
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
                <h1><?php echo $classificationName; ?> Vehicles</h1>
                <?php
                if (isset($message)) {
                    echo $message; 
                } 
                ?>
                <?php 
                if(isset($vehicleDisplay)){
                    echo $vehicleDisplay;
                    // echo var_dump($vehicles);
                } 
                ?>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?> 
            </footer> 
        </div>       
    </body>
</html>
