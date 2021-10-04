<?php
session_start();

if(!isset($_SESSION['first_name']) AND !isset($_SESSION['last_name'])){
    header('Location: signin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
</head>
<body>

<?php include "headers/header.php"?>

    <div class="main-wrapper">


        <!-- <nav class="navigation">
            
        </nav> -->
        <section class="page">
        <form method="post" action = signin.php>
            
            <div class="informations property-description">
                        
                <h2>Description</h2>
                <div class="grid">
                    <input type="text" name="firstname" id="firstname"/>
                    <input type="text" name="lastname" id="lastname"/>
                    <input type="email" name="email" id="email"/>
                    <input type="tel" name="phone" id="phone"/>
                    <input type="email" name="asd" id="email"/>
                    <input type="tel" name="asd" id="phone"/>
                </div>

            </div>

            <input type="submit" value="Submit">


            
    
            <div class="separator"></div>
            
        </form>
        </section>
    </div>
</body>
</html>