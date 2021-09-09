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
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <?php include "headers/header_dashboard.php"?>




            <!-- <script type="text/javascript">
                        document.getElementById('min_price').value = "<?php echo $_POST['min_price'];?>";
                        document.getElementById('max_price').value = "<?php echo $_POST['max_price'];?>";
                        document.getElementById('type').value = "<?php echo $_POST['type'];?>";
                        document.getElementById('bedroom').value = "<?php echo $_POST['bedroom'];?>";
                        document.getElementById('bathroom').value = "<?php echo $_POST['bathroom'];?>";
                        
            </script> -->


            

            
           
        </ul>
    </form>
    <div class="container">

        <div class="board">
            

    
        </div><!--board-->




    

    </div>
</body>
</html>