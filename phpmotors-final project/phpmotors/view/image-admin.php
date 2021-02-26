<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Image Management | PHP Motors</title>
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
                <h1>Image Management</h1>
                <p>Welcome to the Image Management page! Choose one of the options presented below:</p>
                <h2>Add New Vehicle Image</h2>
                <?php
                if (isset($message)) {
                echo $message;
                } ?>

                <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                    <label for="invId">Vehicle</label>
                        <?php echo $prodSelect; ?>
                        <fieldset>
                            <label>Is this the main image for the vehicle?</label>                        
                            <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                            <label for="priYes" class="pImage">Yes</label>
                            
                            <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                            <label for="priNo" class="pImage">No</label>
                        </fieldset>
                    <label>Upload Image:</label>
                    <input type="file" name="file1">
                    <input type="submit" value="Upload" class="submitBt">
                    <input type="hidden" name="action" value="upload">
                </form>

                <hr>

                <h2>Existing Images</h2>
                <p class="form-msg">If deleting an image, delete the thumbnail too and vice versa.</p>
                <?php
                if (isset($imageDisplay)) {
                echo $imageDisplay;
                } ?>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?> 
            </footer> 
        </div>       
    </body>
</html>

<?php unset($_SESSION['message']); ?>