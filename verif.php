<?php

if(isset($_POST['email'])){
    //isset($_POST['firstname']) AND isset($_POST['lastname' ]) AND AND isset($_POST['password' ]) AND isset($_POST['password_confirm' ]
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=kamaroes;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Error: '. $e->getMessage()); 
    }

    $response = $db->query('SELECT email FROM users');

    while ($data = $response->fetch()){
        if ($data['email'] == $_POST['email']){
            header('location: signup.php?message=Email already used');
        }
    }

    if($_POST['password' ] != $_POST['password_confirm']){
        header('location: signup.php?messago=password doesn\'t match');
    }

}


?>