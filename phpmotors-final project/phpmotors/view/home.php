<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home | PHP Motors</title>
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
                <h1>Welcome to PHP Motors!</h1>
                    <div id="car-deal">
                        <div id = "car-details">
                            <h2>DMC Delorean</h2>
                            <ul>
                                <li>3 Cup Holders</li>
                                <li>Superman Doors</li>
                                <li>Fuzzy dice!</li>
                            </ul>
                        </div>    
                        <a href="#" title="Go to Buy Car" id="cta" role="button">Own Today</a>
                        <img src="/phpmotors/images/vehicles/delorean.jpg" alt="Delorean">
                    </div>
                <div id="car-info">
                    <div class="car-info-items">
                        <h2>Delorean Upgrades</h2>
                        <div class = "grid">
                          <div class = "item">
                              <div class="img-container">
                                <img src="/phpmotors/images/upgrades/flux-cap.png" alt= "Flux Capacitator">
                              </div>
                              <a href="#" title="Go to Flux Capacitator">Flux Capacitator</a>
                          </div>
                          <div class = "item">
                              <div class="img-container">
                                <img src="/phpmotors/images/upgrades/flame.jpg" alt= "Flame Decals">
                              </div>
                              <a href="#" title="Go to Flame Decals">Flame Decals</a>               
                          </div>
                          <div class = "item">
                            <div class="img-container">
                              <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt= "Bumper Stickers">
                            </div>
                            <a href="#" title="Go to Bumper Stickers">Bumper Stickers</a>                
                          </div>
                          <div class = "item">
                            <div class="img-container">
                              <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt= "Hub Caps">
                            </div>
                            <a href="#" title="Go to Hub Caps">Hub Caps</a>
                          </div>            
                      </div>
                    </div>    
                    <div class="car-info-items" id="reviews">
                        <h2>DMC Delorean Reviews</h2>
                        <ul>
                            <li>"So fast it's almost like traveling in time." (4/5)</li>
                            <li>"Coolest ride on the road." (4/5)</li>
                            <li>"I'm feeling Marty McFly." (5/5)</li>
                            <li>"The most futuristic ride of our day." (4.5/5)</li>
                            <li>"80's livin and I love it!" (4/5)</li>
                        </ul>
                    </div>
                </div>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
            </footer>    
        </div>        
    </body>
</html>
