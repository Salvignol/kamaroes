
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


if(isset($_POST['min_price']) AND isset($_POST['max_price']) AND isset($_POST['bedroom']) AND isset($_POST['bathroom'])){
    
        

        $response = $db->prepare(
            'SELECT * 
            FROM property 
            WHERE price BETWEEN :min_price AND :max_price
            AND bedroom = :bedroom
            AND bathroom = :bathroom'
            );
        $response->execute(array(
            'min_price' => $_POST['min_price'], 
            'max_price' => $_POST['max_price'],
            'bedroom' => $_POST['bedroom'], 
            'bathroom' => $_POST['bathroom']
        ));

       
    
    
    
    
        
} else {
    $response = $db->query('SELECT * FROM property' );
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/home.css">
    <title>Document</title>
    
    
</head>
<body>

    <section id="search">

    <?php include "headers/header.php"?>

    <form method="post" action="home.php">
        <ul class="navigation-bar__container form__container">
                
            <div class="dropdown">
                <div class="dropdown-button">
                    <?php 
                    if(isset($_POST['min_price']) AND isset($_POST['max_price'])){
                        echo $_POST['min_price'].' - '.$_POST['max_price'];
                    } else {
                        echo 'Price';
                    }
                ?>
                </div>
                <div class="dropdown-content">
                    <select name="min_price" id="min_price">
                        <option value="50000">50K</option>
                        <option value="100000">100K</option>
                        <option value="150000">150K</option>
                        <option value="200000">200K</option>
                        <option value="250000">250K</option>
                        <option value="300000">300K</option>
                        <option value="350000">350K</option>
                        <option value="400000">400K</option>
                        <option value="450000">450K</option>
                    </Select>

                    <script type="text/javascript">
                        document.getElementById('min_price').value = "<?php echo $_POST['min_price'];?>";
                    </script>
                    <select name="max_price" id="max_price">
                        <option value="50000">50K</option>
                        <option value="100000">100K</option>
                        <option value="150000">150K</option>
                        <option value="200000">200K</option>
                        <option value="250000">250K</option>
                        <option value="300000">300K</option>
                        <option value="350000">350K</option>
                        <option value="400000">400K</option>
                        <option value="450000">450K</option>
                    </Select>
                    
                </div>
            </div>

            <div class="dropdown">
                <button class="dropdown-button"><?php echo $_POST['type'] ?? 'Type';?></button>
                <div class="dropdown-content">
                    <select name="type" id="type">
                        <option value="apartments">Apartments</option>
                        <option value="house">House</option>
                        <option value="land">Land</option>
                        <option value="warehouse">Warehouse</option>
                    </Select>
                    
                </div>
            </div>

            <div class="dropdown">
                <button class="dropdown-button"><?php echo $_POST['bedroom'] ?? '';?> Beds and <?php echo $_POST['bathroom']?? '';?> Baths</button>
                <div class="dropdown-content">

                    <div class="bedroom">
                    <select name="bedroom" id="bedroom">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5+</option>
                        </Select>
                    </div>

                    <div class="bathroom">
                    <select name="bathroom" id="bathroom">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5+</option>
                        </Select>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropdown-button">Lot Size</button>
                <div class="dropdown-content">
                    <Select>
                        <option value="">50K</option>
                        <option value="">100K</option>
                        <option value="">150K</option>
                        <option value="">250K</option>
                        <option value="">300K</option>
                    </Select>
                    <Select>
                        <option value="">50K</option>
                        <option value="">100K</option>
                        <option value="">150K</option>
                        <option value="">250K</option>
                        <option value="">300K</option>
                    </Select>
                    
                </div>
            </div>

            <script type="text/javascript">
                        document.getElementById('min_price').value = "<?php echo $_POST['min_price'];?>";
                        document.getElementById('max_price').value = "<?php echo $_POST['max_price'];?>";
                        document.getElementById('type').value = "<?php echo $_POST['type'];?>";
                        document.getElementById('bedroom').value = "<?php echo $_POST['bedroom'];?>";
                        document.getElementById('bathroom').value = "<?php echo $_POST['bathroom'];?>";
                        
                    </script>

            <input class="dropdown-button" type="submit" value="Filter">

            

            
           
        </ul>
    </form>

    <div class="main-wrapper ">

        <section class="page">
            <div class="listing">

            <?php
            

                while($data = $response->fetch())
            
                {    
                
            ?>

                <a class="listing_item" href="details.php?ref=1">
                    <div class="listing_item_img">asdasd</div>
                    <div class="listing_item_infos">
                        <span><?php echo $data['type'].': '.$data['city'];?></span>
                        <span><?php echo $data['bedroom'];?> bedrooms, </span>
                        <span>CFA <?php echo $data['price'];?></span>
                    </div>
                
                </a>

            <?php
                
            
            }
            
            ?>
                
                
            
        </section>

        

    </div>

    <footer>
        
    </footer>

</body>
</html>