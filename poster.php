<?php

// First verify session variables are here

session_start();

if(!isset($_SESSION['first_name']) AND !isset($_SESSION['last_name']) AND !isset($_SESSION['id'])){
    header('Location: signin.php');
}

// Connection to the database
try
{
    $db = new PDO('mysql:host=localhost;dbname=kamaroes;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Error: '.$e->getMessage());
}



$description = array();
$features = array();
$errors = array(
    'price' => '', 
    'rent' => '', 
    'down_payment' => '', 
    'bedrooms' => '',
    'kitchen' => '', 
    'bathrooms' => '', 
    'floors' => '', 
    'rooms' => '',
    'garages' => '',
    'pic1' => '');
$folderName = "";

if(isset($_POST['city']) AND isset($_POST['category']) AND isset($_POST['transaction'])){
    echo 'Yes';


    if(isset($_POST['furnished'])){
        if($_POST['furnished'] == 'yes'){
             $description['furnished'] = 1;
             echo $description['furnished'];
        } else {
            $description['furnished'] = 0;
        }
    }

    if(isset($_POST['price'])){
        if($_POST['price'] <= 0 OR $_POST['price'] > 10000000000){
             $errors['price'] = 'Price should be inferior to CFA 10 Billion';
        } else {
            $description['price'] = $_POST['price'];
            $errors['price'] = NULL;
        }
    }

    if(isset($_POST['rent'])){
        if($_POST['price'] <= 0 OR $_POST['price'] > 10000000){
             $errors['rent'] = 'Price should be inferior to CFA 10 Million';
        } else {
            $description['rent'] = $_POST['rent'];
            $errors['rent'] = NULL;
        }
    }

    if(isset($_POST['bedrooms'])){
        if($_POST['bedrooms'] <= 0 OR $_POST['bedrooms'] > 100){
             $errors['bedrooms'] = 'Enter valid number';
        } else {
            $description['bedrooms'] = $_POST['bedrooms'];
            $errors['bedrooms'] = NULL;
        }
    }

    if(isset($_POST['kitchen'])){
        if($_POST['bedrooms'] <= 0 OR $_POST['kitchen'] > 100){
             $errors['kitchen'] = 'Enter valid number';
        } else {
            $description['kitchen'] = $_POST['kitchen'];
            $errors['kitchen'] = NULL;
        }
    }

    if(isset($_POST['bathrooms'])){
        if($_POST['bathrooms'] <= 0 OR $_POST['bathrooms'] > 100){
             $errors['bathrooms'] = 'Enter valid number';
        } else {
            $description['bathrooms'] = $_POST['bathrooms'];
            $errors['bathrooms'] = NULL;
        }
    }

    if(isset($_POST['rooms'])){
        if($_POST['rooms'] < 0 OR $_POST['rooms'] > 100){
             $errors['rooms'] = 'Enter valid number';
        } else {
            $description['rooms'] = $_POST['rooms'];
            $errors['rooms'] = NULL;
        }
    }

    if(isset($_POST['floors'])){
        if($_POST['floors'] < 0 OR $_POST['floors'] > 100){
             $errors['floors'] = 'Enter valid number';
        } else {
            $description['floors'] = $_POST['floors'];
            $errors['floors'] = NULL;
        }
    }

    if(isset($_POST['garages'])){
        if($_POST['garages'] < 0 OR $_POST['garages'] > 100){
             $errors['garages'] = 'Enter valid number';
        } else {
            $description['garages'] = $_POST['garages'];
            $errors['garages'] = NULL;
        }
    }

    if(isset($_POST['wifi'])){
        $features['wifi'] = 1;
        echo $features['wifi'];
    }

    if(isset($_POST['cooling'])){
        $features['cooling'] = 1;
        echo $features['cooling'];
    }

    if(isset($_POST['balcony'])){
        $features['balcony'] = 1;
        echo $features['balcony'];
    }

    if(isset($_POST['laundry'])){
        $features['laundry'] = 1;
        echo $features['laundry'];
    }

    if(isset($_POST['pool'])){
        $features['pool'] = 1;
        echo $features['pool'];
    }

    if(isset($_FILES['pic1']) AND $_FILES['pic1']['error'] == 0){
        if ($_FILES['pic1']['size'] <= 1000000)
        {
            $fileInfo = pathinfo($_FILES['pic1']['name']);
            $extension_upload = $fileInfo['extension'];
            $valid_extensions = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $valid_extensions))
                {
                    $uniqueID = uniqid($_SESSION['first_name'].'_'.$_SESSION['last_name']);
                    if (!checkUniqueID($uniqueID)) {
                        $uniqueID = uniqid($_SESSION['first_name'].'_'.$_SESSION['last_name']);
                    }
                    
                    
                    $folderName = 'uploads/images/'.$uniqueID;
                    
                    mkdir($folderName);

                    move_uploaded_file($_FILES['pic1']['tmp_name'], $folderName.'/'.basename($_FILES['pic1']['name']));
                        echo "L'envoi a bien été effectué !";



                }
        }
    } else {
        $errors['pic1'] = 'At leat 1 image';
    }

    

    


    if(!$errors['price'] AND !$errors['rent'] AND !$errors['down_payment'] AND !$errors['bedrooms'] AND !$errors['bathrooms'] AND !$errors['rooms'] AND !$errors['floors'] AND !$errors['garages'] AND !$errors['pic1']){

        

        $response = $db->prepare(
            'INSERT 
            INTO 
            property(city, user_id, type, mode, price, bedroom, bathroom, free_rooms, garages, floors, furnished, dir_name)
            VALUES(:city, :user_id, :type, :mode, :price, :bedroom, :bathroom, :free_rooms, :garages, :floors, :furnished, :dirname )');
        
       
        $response->execute(array(
            'city' => $_POST['city'],
            'user_id' => $_SESSION['id'],
            'type' => $_POST['type'],
            'mode' => $_POST['mode'],
            'price' => $description['price'],
            'bedroom' => $description['bedrooms'] ?? NULL,
            'bathroom' => $description['bathrooms'],
            'free_rooms' => $description['rooms'],
            'garages' => $description['garages'],
            'floors' => $description['floors'],
            'furnished' => $description['furnished'],
            'dirname' => $folderName

        ));

        echo "posted";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/poster.css">
    <title>Dashboard</title>
</head>
<body>

   

    
    <div class="main-wrapper">
        <?php include "headers/header.php"?>
    
        <div class="container">
        <?php include "headers/navbar.php"?>
            
            <form enctype="multipart/form-data" method="post" action="poster.php">

                <div class="informations property-description">
                            
                    <h2>Description</h2>

                        <div class="grid">

                            <div class="inputs">
                                <label for="city">City:</label>
                                <select name="city" id="city">
                                <?php 
                                $cities = $db->query('SELECT * FROM city');
                                while($data = $cities->fetch())
                                {
                                ?>
                                    <!-- <option disabled selected="selected">None</option> -->
                                    <option value="<?php echo $data['id'];?>"><?php echo ucwords(str_replace("_"," ",$data['city']));?></option>
                                <?php
                                };
                                $cities->closeCursor();
                                ?>
                                </select>
                            </div>
                            

                            <div class="inputs">
                                <label for="neigborhood">Neigbourhood:</label>
                                <input type="text" name="neigbourhood" id="neigbourhood" placeholder="enter here"/>
                                <p class="error">none</p>   
                            </div>

                            <div class="inputs">
                                <label for="neigborhood">Neigbourhood:</label>
                                <input type="text" name="neigbourhood" id="neigbourhood" placeholder="enter here"/>
                                <p class="error">none</p>   
                            </div>

                            <!-- <textarea  class="description" name="description" id="description" cols="30" rows="10"></textarea> -->

                        </div><!--grid-->

                        <div class="grid2 ">
                            <div class="inputs">
                                <label for="transaction">Transaction:</label>
                                <select name="transaction" id="transaction" >
                                    <option value="house" selected disabled>None</option>
                                    <option value="rental">To rent</option>
                                    <option value="sale">For Sale</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid2">
                            <div class="inputs">
                            <label for="category">Category:</label>
                                <select name="category" id="category">
                                    <option value="villa" selected disabled>None</option>
                                    <optgroup label="House Type">
                                        <option value="villa">Villa</option>
                                        <option value="duplex">Duplex</option>
                                        <option value="detached">Detached</option>
                                        <option value="semi_detached">Semi Detached</option>
                                    </optgroup>

                                    <optgroup label="Apartment Type">
                                        <option value="studio">Villa</option>
                                        <option value="alcove_studio">Alcove Studio</option>
                                        <option value="traditional">Traditional/Convertible</option>
                                        <option value="loft">Condo</option>
                                        <option value="condo">High-Rise</option>
                                    </optgroup>

                                    <optgroup label="Office Type">
                                        <option value="traditional">Traditional Office</option>
                                        <option value="open">Open Office</option>
                                    </optgroup>

                                    <option value="land">Land</option>
                                </select>
                            </div>
                        </div>
                    </div>


                <div class="informations property">

                    <h2>Property</h2>

                    <div class="grid2">
                        <h3>Sale</h3>

                        <div class="inputs price">
                            <label for="price">Price:</label>
                            <input type="text" name="price" id="price" value="1" />
                            <p class="error">none</p>   
                        </div>
                    </div>

                    <div class="grid">
                             <h3>Rental</h3>

                            <div class="inputs rent">
                                <label for="rent">Rent/Month:</label>
                                <input type="text" name="rent" id="rent" value="1"/>
                                <p class="error">none</p>   
                            </div>

                            <div class="inputs rent">
                                <label for="rent">Rent/Month:</label>
                                <input type="text" name="rent" id="rent" value="1"/>
                                <p class="error">none</p>   
                            </div>

                           

                    </div>

                    <div class="grid2">
                        <div class="inputs noLand down_payment">
                            <label for="down_payment">Down Payment/Month:</label>
                            <input type="text" name="down_payment" id="down_payment" value="1"/>
                            <p class="error">none</p>   
                        </div>

                        
                    </div>
                    <div class="grid2">
                        <div class="inputs noLand deposit">
                            <label for="deposit">Deposit:</label>
                            <input type="text" name="deposit" id="deposit" value="1"/>
                            <p class="error">none</p>   
                        </div>
                    </div>

                    <div class="grid">
                        <h3>Rooms</h3>

                        <?php 
                        $rooms = $db->query('SELECT * FROM room');
                        while($data = $rooms->fetch())
                        {
                        ?>

                        <div class="inputs <?php echo $data['room'];?>">
                            <label class="checkboxLabel" for="<?php echo $data['room'];?>"> <input class="custom-checkbox" type="checkbox" id="<?php echo $data['room'];?>" name="<?php echo $data['room'];?>" value="<?php echo $data['room'];?>"/> <?php echo ucwords(str_replace("_"," ",$data['room']));?>  </label>
                            <label class="textLabel" for="<?php echo $data['room'];?>-amount">Amount:</label><input class="custom-text" type="text" disabled="disabled" name="<?php echo $data['room'];?>-amount" id="<?php echo $data['room'];?>-amount" placeholder="0"/>
                            <p class="error">none</p>
                        </div>

                        

                        <?php
                        };
                        $rooms->closeCursor();
                        ?>

                        <script>
                            let bedd = document.querySelector('.bedoorm-checkbox');
                            // bedd.style.background = "orange";

                            // bedd.style.display = "none";

                            /* Disable Text inputs with class name "custom-text" 
                            if checkbox with class name "custom-checkbox" is unckecked
                            (To optimise later)
                            */

                            var checkboxes = document.getElementsByClassName('custom-checkbox'); // Get all the Chexboxes
                            var textInputs = document.getElementsByClassName('custom-text'); // Get all the Chexboxes
                            
                            // for every checkboxes add "change" event listner to see if chexbox is checked or not
                            for (let i = 0; i <checkboxes.length; i++) {
                                checkboxes[i].addEventListener('change', function(){

                                    /* 
                                    If checked, go trough every text inputs (textInputs array) 
                                    and see if text inputs have the current checkbox id + "amount".
                                    */
                                    if (this.checked) {
                                        for (let j = 0; j < textInputs.length; j++) {
                                            if (textInputs[j].id == checkboxes[i].id + '-amount'){
                                                textInputs[j].disabled = false;
                                            }
                                            
                                        }
                                    } else {
                                        for (let j = 0; j < textInputs.length; j++) {
                                            if (textInputs[j].id == checkboxes[i].id + '-amount'){
                                                textInputs[j].disabled = true;
                                            }
                                            
                                        }
                                    }
                                });
                                
                            }



                        </script>

                    </div>

                    

                    <div class="grid">
                        <h3>Features</h3>

                        <?php
                            $features = $db->query('SELECT * FROM feature');
                            while($data = $features->fetch())
                            {
                        ?>

                        <div class="inputs <?php echo $data['feature'];?>">
                            <label class="checkboxLabel" for="<?php echo $data['feature'];?>"> <input type="checkbox" id="<?php echo $data['feature'];?>" name="<?php echo $data['feature'];?>" value="<?php echo $data['feature'];?>"/> <?php echo ucwords(str_replace("_"," ",$data['feature']));?>  </label>
                            <label class="textLabel" for="<?php echo $data['feature'];?>-amount">Amount:</label><input type="text" name="<?php echo $data['feature'];?>-amount" id="<?php echo $data['feature'];?>-amount" value="0"/>
                            <p class="error">none</p>
                        </div>

                        <?php
                            };
                            $features->closeCursor();
                        ?>
                    </div>               
    
               

                

                    <div class="grid">
                        <h3>Amenities</h3>

                        <?php
                            $amenities = $db->query('SELECT * FROM amenity');
                            while($data = $amenities->fetch())
                            {
                        ?>

                        <label for="<?php echo $data['amenity'];?>"> <input type="checkbox" id="<?php echo $data['amenity'];?>" name="<?php echo $data['amenity'];?>" value="<?php echo $data['amenity'];?>"/> <?php echo ucwords(str_replace("_"," ",$data['amenity']));?>  </label>
                        
                        <?php
                            };
                            $amenities->closeCursor();
                        ?>

                        <!-- <label for="restaurant"> <input type="checkbox" id="restaurant" name="restaurant" value="restaurant"/> Restaurant  </label>
                        <label for="park"> <input type="checkbox" id="park" name="park" value="park"/> Park  </label>
                        <label for="club"> <input type="checkbox" id="club" name="club" value="club"/> Club  </label>
                        <label for="supermarket "> <input type="checkbox" id="supermarket " name="supermarket " value="supermarket "/> Supermarket   </label> -->
                    </div>

                

                </div>

               
                


                

                <div class="informations land">
                            
                    <h2>Land</h2>

                    <div class="grid">
                        <h3>Sale</h3>
                        
                        <div class="inputs unit">
                            <label for="unit">Unit:</label>
                            <input type="text" name="unit" id="unit" value="1"/>
                            <p class="error">none</p>   
                        </div>

                        <div class="inputs byUnit">
                            <label for="byUnit">By Uniy:</label>
                            <input type="text" name="byUnit" id="byUnit" value="1"/>
                            <p class="error">none</p>   
                        </div>
                    </div>

                    <div class="grid2">
                        <div class="inputs price">
                            <label for="price">Price:</label>
                            <input type="text" name="price" id="price" value="1" />
                            <p class="error">none</p>   
                        </div>
                    </div>

                    <div class="grid">
                             <h3>Rental</h3>

                            <div class="inputs rent">
                                <label for="rent">Rent/Month:</label>
                                <input type="text" name="rent" id="rent" value="1"/>
                                <p class="error">none</p>   
                            </div>

                            <div class="inputs noLand down_payment">
                                <label for="down_payment">Down Payment/Month:</label>
                                <input type="text" name="down_payment" id="down_payment" value="1"/>
                                <p class="error">none</p>   
                            </div>

                            <div class="inputs noLand deposit">
                                <label for="deposit">Deposit:</label>
                                <input type="text" name="deposit" id="deposit" value="1"/>
                                <p class="error">none</p>   
                            </div>

                            <div class="inputs noBuild unit">
                                <label for="unit">Unit:</label>
                                <input type="text" name="unit" id="unit" value="1"/>
                                <p class="error">none</p>   
                            </div>
                    </div>

                    <div class="grid">

                   

                        <div class="inputs">
                            <label for="size">size:</label>
                            <input type="text" name="size" id="size" placeholder="m2"/> 
                        </div>

                        <div class="inputs">
                            <label for="land-title">Land Title No:</label>
                            <input type="text" name="land-title" id="land-title" placeholder="000000"/> 
                        </div>


                    
                        
                    </div>
                </div>

                <div class="informations noLand bills">
                            
                    <h2>Bills</h2>

                        <div class="grid">

                        <div class="inputs electricity">
                            <label for="electricity">Electricity:</label>
                        </div>
                        
                        
                        <div class="inputs billing">
                            <label for="billing">Billing:</label>
                            <select name="billing__electricity" id="billing__electricity">
                                <option value="usage" selected>Usage</option>
                                <option value="fee">Flat Fee</option>
                            </select>
                        </div>

                        
                        
                        <div class="inputs usage">
                            <label for="usage">Usage:</label>
                            <input type="text" name="usage" id="usage" value="0"/>
                            <p class="error">None</p>
                        </div>


                        <div class="inputs water">
                            <label for="water">Water:</label>
                            <!-- <input type="radio" id="html" name="fav_language" value="HTML"><label for="html">HTML</label><br>
                            <input type="radio" id="html" name="fav_language" value="HTML"><label for="html">HTML</label><br> -->
                        </div>

                        <div class="inputs billing">
                            <label for="billing">Billing:</label>
                            <select name="billing__water" id="billing__water">
                                <option value="usage" selected>Usage</option>
                                <option value="fee">Flat Fee</option>
                            </select>
                        </div>

                        <div class="inputs rooms">
                            <label for="rooms">Empty rooms:</label>
                            <input type="text" name="rooms" id="rooms" value="0"/>
                            <p class="error">None</p>
                        </div>

                       
                        
                    </div>
                </div>



                <div class="informations">

                    <h2>Pictures Upload</h2>

                    <div class="grid">
                        <div class="inputs">
                            <label for="pic1">Showcased Image:</label>
                            <input type="file" name="pic1" id="pic1"/>
                        </div>

                        <!-- <div class="inputs">
                            <label for="pic1">Showcased Image:</label>
                            <input type="file" name="pic1" id="pic1"/>
                        </div>

                        <div class="inputs">
                            <label for="pic1">Showcased Image:</label>
                            <input type="file" name="pic1" id="pic1"/>
                        </div>

                        <div class="inputs">
                            <label for="pic1">Showcased Image:</label>
                            <input type="file" name="pic1" id="pic1"/>   
                        </div>

                        <div class="inputs">
                                <label for="pic1">Showcased Image:</label>
                                <input type="file" name="pic1" id="pic1"/>
                        
                        </div>

                        <div class="inputs">
                                <label for="pic1">Showcased Image:</label>
                                <input type="file" name="pic1" id="pic1"/>
                        
                        </div> -->


                    </div>

                    

                    

                </div>


                
                <input type="submit" value="Post"/>
                
                
                
            </form>

            <div class="image"></div>


        </div><!--container-->
    </div>
    <script>

        var category = document.getElementById('category');
        var transaction = document.getElementById('transaction');

        var properties = document.getElementsByClassName("property");
        var transactions = document.getElementsByClassName("transaction");

        var billing = document.querySelectorAll('.billing');

        

        // alert(properties[0].className.includes("house"));
        // alert(transaction.length);
        // alert(noLand.length);
        // console.log('asd');
        // alert(noBuild.length);

        transaction.addEventListener('change', function(){
            
            let identifier = 'informations transaction '+transaction.value;

            for (let i = 0; i < transactions.length; i++) {
                if(identifier == transactions[i].className){
                    transactions[i].style.display = 'grid';
                } else {
                    transactions[i].style.display = 'none';
                }
                // console.log(informations[i].className);
            }
        });

        



    </script>

</body>
</html>