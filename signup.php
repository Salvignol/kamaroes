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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/authentication.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="image"></div>
        <div class="signin">
        <form method="post" action="signup.php">

            <div class="authentication">
                <div class="authentication_names">
                    <input type="text" name="firstname" placeholder="First Name" value="<?php echo $_POST['firstname'] ?? '';?>"/>
                    
                    

                    
                    <input type="text" name="lastname" placeholder="Last Name" value="<?php echo $_POST['lastname'] ?? '';?>"/>
                </div>
                <input type="text" name="email" placeholder="Email Adress" />
                <p>
                    <?php if(isset($error['email']))
                    {
                        echo $error['email'];
                    }?>
                </p>
                <input type="password" name="password" placeholder="Password" />
                <input type="password" name="password_confirm" placeholder="Password" />
                <p>
                    <?php if(isset($error['password']))
                    {
                        echo $error['password'];
                    }
                    ?>
                </p>
            </div>
                
            <div class="buttons">
               <input class="login" type="submit" value="Sign Up"/>
            </div>

            <p>Already on Afrolada <a href="signin.php">Log in</a></p>


    
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