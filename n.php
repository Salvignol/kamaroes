<?php
session_start();

if(!isset($_SESSION['first_name']) AND !isset($_SESSION['last_name']) AND !isset($_SESSION['id'])){
    header('Location: signin.php');
}

try
{
    $db = new PDO('mysql:host=localhost;dbname=kamaroes;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('Error: '. $e->getMessage()); 
}

$response = $db -> prepare('SELECT date_added FROM property WHERE user_id =:id');
$response->execute(array('id' => $_SESSION['id']));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/as.css"/>
    <title>Adverts</title>
</head>
<body>
    <?php include "headers/header_dashboard.php";?>
    
    <div class="main-wrapper">

        <section class="page">
            <h2>List of advertisements</h2>
            <table>

                <tr>
                    <th>Ref No.</th>
                    <th>Publication Date</th>
                    <th>Expiration Date</th>
                    <th>status</th>
                    <th>Description</th>
                    <th>views</th>
                    <th>Pictures</th>
                </tr>

                <?php
                
                while($data = $response->fetch()){
                        
                ?>

                <tr>
                    <td><?php echo $data['date_added'];?></td>
                    <td>Maria Anders</td>
                    <td>Germany</td>
                </tr>
                
                <?php
                    
                }

?>
                <tr>
                    <td><?php echo'brazza'?></td>
                    <td>Maria Anders</td>
                    <td>Germany</td>
                </tr>
                <tr>
                    <td>Centro comercial Moctezuma</td>
                    <td>Francisco Chang</td>
                    <td>Mexico</td>
                </tr>
            </table>
        </section>
    </div>

</body>
</html>