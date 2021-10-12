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
    <meta name="google-signin-client_id" content="471738037773-82u1a78lucblatebde31kdt7tg2b3123.apps.googleusercontent.com">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/authentication.css">
    <title>Document</title>
</head>
<body>
<div class="main-wrapper">
        <div class="container">
            <div class="image"></div>
            <div class="form-container">
                <form method="post" action = signin.php>
                    
                    <h1>Sign in</h1>

                    <div class="authentication">

                        <!--names-->
                        <div class="inputs">
                                <label for="email">E-mail</label>
                                <input type="text" id="email" name="email" placeholder="Email Adress" />
                        </div>
                        
                        <div class="inputs">
                                <label for="password">Password</label>
                                <input type="password" name="password" placeholder="Password" />
                            </div>
                        <!-- <p>
                            <?php if(isset($error['email']))
                            {
                                echo $error['email'];
                            }?>
                        </p> -->

                        
                    <div class="buttons">
                        <input class="login" type="submit" value="Log in"/>
                    </div>

                    <p class="redirecting-message">Not a member yet? <a href="signup.php">Join us</a></p>


                    <div class="sepa">
                        <div class="line"></div>
                        <p class="or">or</p>
                        <div class="line"></div>
                    </div>
                    
                    <div class="login-buttons">
                        

                        <div class="image-logo">
                            <img src="assets/images/search.png" alt="">
                            <p>Sign in with Google</p>
                        </div>

                        <div class="image-logo">
                            <img src="assets/images/facebook.png" alt="">
                            <p>Sign in with Google</p>
                        </div>

                        
                    </div>
                </form>
            </div>
        </div><!--container-->
    </div>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
</body>


</html>