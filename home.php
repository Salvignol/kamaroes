
<?php

session_start();

try
{
    $db = new PDO('mysql:host=localhost;dbname=kamaroes;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('Error: '. $e->getMessage()); 
}

$response = $db->query('SELECT * FROM property');






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/home.css">
    
    <title>Document</title>
    
    
</head>
<body>

    <section id="search">

    <?php include "headers/header.php"?>

    <form method="post" action="home.php">
        <div class="features">
    
        </div>
    </form>

    <div class="main-wrapper ">

        <section class="page">
            <div class="listing">

            <?php
            

                while($data = $response->fetch())
            
                {    
                
            ?>

                <a class="item" href="details.php?ref=1">
                    <div class="item_image">
                        <img src="assets/images/mi.jpg" alt="">
                    </div>
                    <div class="item_glance">
                        <div class="item_infos">
                            <p class="price">CFA <?php echo number_format($data['price'], $decimals = 0, $decimal_separator = ".", $thousands_separator = ",");?></p>

                            <div class="other">
                                <p class="category"><?php echo $data['type'];?> </p>
                                <p class="type"><?php echo $data['mode'];?></p>
                            </div>
                        </div>

                        <div class="location"><p><?php echo ucwords($data['city']).', Placeholder Neighbouhood';?></p></div>

                        <div class="basic">
                            <div class="basic_item">
                                <i class="fas fa-bed fa-lg"></i> <p id="wifi" name="wifi"> 4 </p>
                            </div>

                            <div class="basic_item">
                                <i class="fas fa-shower fa-lg"></i> <p id="wifi" name="wifi"> 4 </p>
                            </div>
                            
                            <div class="basic_item">
                                <i class="<i fas fa-ruler fa-lg"></i> <p id="wifi" name="wifi"> 4 </p>
                            </div>
                        </div>



                    </div>
                
                </a>

            <?php
                
            
            }
            
            ?>
                
                
            
        </section>

        <div class="maps__container">
            <div class="maps" id="maps"></div>
        </div>
       
        

        

    </div>

    <footer>
        
    </footer>

    <script src="js/maps.js"></script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhhm3d1QKJsj5PcEvxtpiDRxm7imNEAR4&callback=initMap&libraries=&v=weekly"
      async
    ></script>

</body>
</html>