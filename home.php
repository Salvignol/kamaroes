
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

        <div class="banners">
            <div class="banner">
                <img src="assets/images/wildBannerAd.png" alt="">
            </div>
            <div class="banner">
                <img src="assets/images/2707.jpg" alt="">
            </div>
            
        </div>

            <section class="page">
                <div class="listing">
                    <div class="listing__results">
                        <h3 class="results__title"> Apartment to Rent in Bastos, Yaounde</h3>
                        <div class="options">
                            <p class="results__number">1566 properties found on Kamaroes </p>
                            
                        </div>
                    </div>

                <?php
                
                $i = 0; 
                $j = 0;
                    while($data = $response->fetch())
                    {   
                        if ($i < 5) {
                            include 'components/item.php';
                            $i++;
                        }else{
                            include 'components/item.php';
                            include 'components/ad.php';
                            include 'components/ad.php';
                            include 'components/ad.php';
                            $i=0;
                        }
                        $j++;
                    } 

                    if($i != 0 AND $j < 6){
                        include 'components/ad.php';
                        include 'components/ad.php';
                        include 'components/ad.php';
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