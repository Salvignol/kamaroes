<?php

$error = array('email' => '', 'password' => '');
$post = array('firstname' => '', 'lastname' => '', 'email' => '', 'passwordHashed' => '' );

if(isset($_POST['firstname']) AND isset($_POST['lastname' ]) AND isset($_POST['email']) AND isset($_POST['password' ]) AND isset($_POST['password_confirm' ])){
    
    $post['firstname'] = $_POST['firstname'];
    $post['lastname'] = $_POST['lastname'];



    try
    {
        $db = new PDO('mysql:host=localhost;dbname=kamaroes;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Error: '. $e->getMessage()); 
    }

    $response = $db->prepare('SELECT email FROM users WHERE email = :email');
    $response -> execute(array('email' => $_POST['email']));
    $data = $response->fetch();

    if(isset($data['email']) AND $data['email'] == $_POST['email']){
        $error['email'] = 'email already used';
    }
    else
    {
        $post['email'] = $_POST['email'];
    }

    if($_POST['password' ] != $_POST['password_confirm']){
        $error['password'] = 'Password doesn\'t match';
    }
    else
    {
        $post['passwordHashed'] = password_hash($_POST['password' ], PASSWORD_DEFAULT);
    }

    $response -> closeCursor();

    if($post['firstname'] !='' AND $post['lastname'] !='' AND $post['email'] !='' AND $post['passwordHashed'] !=''){
        $req = $db->prepare(
            'INSERT INTO users(first_name, last_name, email, hashed_password, signup_date) VALUES(:firstname, :lastname, :email, :password ,CURDATE())');
        $req -> execute(array(
            'firstname' => $post['firstname'],
            'lastname' => $post['lastname'],
            'email' => $post['email'],
            'password' => $post['passwordHashed']
        ));

        session_start();

        $_SESSION['first_name'] = $post['firstname'];
        $_SESSION['last_name'] = $post['lastname'];


        header('location: i.php');
    }

}

?>



<!DOCTYPE html>
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
                <form method="post" action="signup.php">
                    
                    <h1>Sign up</h1>

                    <div class="authentication">

                        <!--names-->
                        <div class="input-container">
                            <div class="inputs">
                                <label for="firstname">First name</label>
                                <input type="text" name="firstname" placeholder="First Name" value="<?php echo $_POST['firstname'] ?? '';?>"/>
                            </div>

                            <div class="inputs">
                                <label for="lastname">Last name</label>
                                <input type="text" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $_POST['lastname'] ?? '';?>"/>
                            </div>
                        </div>

                        <div class="inputs">
                            <label for="email">E-mail</label>
                            <input type="text" id="email" name="email" placeholder="Email Adress" />
                        </div>

                        
                        <!-- <p>
                            <?php if(isset($error['email']))
                            {
                                echo $error['email'];
                            }?>
                        </p> -->

                        <!--passwords-->
                        <div class="input-container">
                            <div class="inputs">
                                <label for="firstname">Password</label>
                                <input type="password" name="password" placeholder="Password" />
                            </div>

                            <div class="inputs">
                                <label for="password_confirm"> Confirm password </label>
                                <input type="password" id="password_confirm" name="password_confirm" placeholder="Password" />
                            </div>
                        </div>
                        
                        <!-- <p>
                            <?php if(isset($error['password']))
                            {
                                echo $error['password'];
                            }
                            ?>
                        </p> -->
                        <div class="buttons">
                        <input class="login" type="submit" value="Sign Up"/>
                    </div>

                   
                    <p class="redirecting-message">Already on Kamaroes <a href="signin.php">Log in</a></p>

                    <div class="sepa">
                        <div class="line"></div>
                        <p class="or">or</p>
                        <div class="line"></div>
                    </div>
                    </div>
                        
                   
                    
                    <div class="login-buttons">

                        <!-- <div class="g-signin2" data-onsuccess="onSignIn"></div> -->

                        <div onclick="startApp();" class="image-logo">
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

        <script src="js/google-signin.js"></script>

        <script src="https://apis.google.com/js/api:client.js"></script>

       
    </div>
</body>
</html>