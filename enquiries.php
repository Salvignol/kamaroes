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
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/as.css"/>
    <title>Enquiries</title>
</head>
<body>
    <?php include "headers/header_dashboard.php";?>
    
    <div class="main-wrapper">

        <section class="page">
            <h2>Unanswer Enquiries</h2>
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
                <tr>
                    <td>Alfreds Futterkiste</td>
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

        <section class="page">
            <h2>Answered Enquiries</h2>
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
                <tr>
                    <td>Alfreds Futterkiste</td>
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