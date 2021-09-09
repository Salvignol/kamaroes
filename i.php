
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

if (isset($_SESSION['email']) AND isset($_SESSION['id']) AND isset($_SESSION['first_name']) AND isset($_SESSION['last_name']) OR isset($_COOKIE['email']) AND isset($_COOKIE['id'])){
    
    //echo $_SESSION['first_name'];

    

} else {

    //echo 'none';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/index.css"/>
    
    <title>Document</title>
</head>
<body>

<section id="search">

    <?php include "headers/header.php"?>

    <div class="main-wrapper">
        <form method="post" action="home.php">
            
            <input type="text" name="town" id="town" placeholder="Town"/>
            <input type="submit" value="Go"/>
        </form>

        
    
    </div>

</section>

<footer></footer>

</body>



</html>