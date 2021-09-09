<?php

$error = array('email' => '', 'password' => '');
$post = array('email' => '');
if(isset($_POST['email']) AND isset($_POST['password' ])){

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=kamaroes;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Error: '. $e->getMessage()); 
    }

    $response = $db->prepare('SELECT id, first_name, last_name, email, hashed_password FROM users WHERE email = :email');
    $response -> execute(array('email' => $_POST['email']));
    $data = $response->fetch();

    if(isset($data['email']) AND $data['email'] == $_POST['email']){
        
        $post['email'] = $_POST['email'];
        
    }
    else
    {
        $error['email'] = 'email already used';
    }

    if(!password_verify($_POST['password' ], $data['hashed_password'])){
        $error['password'] = 'Wrong Password';
    } else {
        session_start();
        $_SESSION['email'] = $post['email'];
        $_SESSION['id'] = $data['id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['last_name'] = $data['last_name'];

        header('Location: dashboard.php');

    }

    $response -> closeCursor();

}
?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/authentication.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="image"></div>
        <div class="signin">
        <form method="post" action = signin.php>

            <div class="authentication">
                <input type="text" name="email" placeholder="Email Adress" />
                <input type="password" name="password" placeholder="Password" />
            </div>
                
            <div class="buttons">
               <input class="login" type="submit" value="Login"/>
            </div>

            <p>Forgot Password?</p>
            <p>Not a member yet? <a href="signup.php">Sign up</a></p>
            
    
            <div class="separator"></div>
            
            
            <div class="login-buttons">
                <button class="login-button"> Login with Google </button>
                <button class="login-button"> Login with Apple </button>
                <button class="login-button"> Login with Facebook </button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>