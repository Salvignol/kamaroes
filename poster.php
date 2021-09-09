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

if(isset($_POST['city']) AND isset($_POST['type']) AND isset($_POST['mode'])){
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/poster.css">
    <title>Dashboard
        
    </title>
</head>
<body>

    <?php include "headers/header_dashboard.php"?>


    
    <div class="container">

        <div class="image"></div>
        
        <form enctype="multipart/form-data" method="post" action="poster.php">

        
            
            <div class="informations property-description">
                        
                <h2>Description</h2>

                    <div class="grid">

                    <div class="inputs">
                        <label for="city">City:</label>
                        <select name="city" id="city">
                            <!-- <option disabled selected="selected">None</option> -->
                            <option value="yaounde" selected>Yaounde</option>
                            <option value="douala">Douala</option>
                            <option value="bertoua">Bertoua</option>
                        </select>
                    </div>
                       

                    <div class="inputs">
                        <label for="neigborhood">Neigborhood:</label>
                        <select name="neigborhood" id="neigborhood" disabled>
                            <option value="rent">To Rent</option>
                            <option value="sale">For Sale</option>
                        </select>
                    </div>

                    <div class="inputs">
                        <label for="neigborhood">Neigborhood:</label>
                        <select name="neigborhood" id="neigborhood" disabled>
                            <option value="rent">To Rent</option>
                            <option value="sale">For Sale</option>
                        </select>
                    </div>
                    
                    <textarea  class="description" name="description" id="description" cols="30" rows="10"></textarea>
                    <div class="inputs">
                        <label for="type">Type:</label>
                        <select name="type" id="type">
                            <option value="house">House</option>
                            <option value="apartment">Apartment</option>
                            <option value="office">Office</option>
                            <option value="land">Land</option>
                        </select>
                        
                    </div>

                    <div class="inputs furnished">
                        <label for="furnished">Furnished:</label>
                        <select name="furnished" id="furnished">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    
                    

                    <div class="inputs">
                        <label for="mode">Mode:</label>
                        <select name="mode" id="mode" >
                            <option value="rent">To rent</option>
                            <option value="sale">For Sale</option>
                        </select>
                    </div>

                    <div class="inputs price">
                        <label for="price">Price:</label>
                        <input type="text" name="price" id="price" value="1" />
                        <p class="error"><?php echo $errors['price'];?></p>   
                    </div>

                    <div class="inputs rent">
                        <label for="rent">Rent/Month:</label>
                        <input type="text" name="rent" id="rent" value="1"/>
                        <p class="error"><?php echo $errors['rent'];?></p>   
                    </div>

                    <div class="inputs down_payment">
                        <label for="down_payment">Down Payment/Month:</label>
                        <input type="text" name="down_payment" id="down_payment" value="1"/>
                        <p class="error"><?php echo $errors['rent'];?></p>   
                    </div>

                    <div class="inputs bedrooms">
                        <label for="bedrooms">Bedrooms:</label>
                        <input type="text" name="bedrooms" id="bedrooms" value="1"/>
                        <p class="error"><?php echo $errors['bedrooms'];?></p>

                        
                    </div>

                    <div class="inputs bedrooms">
                        <label for="kitchen">Kitchen:</label>
                        <input type="text" name="kitchen" id="kitchen" value="1"/>
                        <p class="error"><?php echo $errors['kitchen'];?></p>

                        
                    </div>
                   

                    <div class="inputs bathrooms">
                        <label for="bathrooms">Bathrooms:</label>
                        <input type="text" name="bathrooms" id="bathrooms" value="1"/>
                        <p class="error"><?php echo $errors['bathrooms'];?></p>
                    </div>
                    
                    
                    <div class="inputs floors">
                        <label for="floors">Floors:</label>
                        <input type="text" name="floors" id="floors" value="1"/>
                        <p class="error"><?php echo $errors['floors'];?></p>
                    </div>

                    
                    
                    <div class="inputs rooms">
                        <label for="rooms">Empty rooms:</label>
                        <input type="text" name="rooms" id="rooms" value="0"/>
                        <p class="error"><?php echo $errors['rooms'];?></p>
                    </div>

                    

                    <div class="inputs garages">
                        <label for="garages">garages:</label>
                        <input type="text" name="garages" id="garages" value="0"/>
                        <p class="error"><?php echo $errors['garages'];?></p>
                    </div>

                    <div class="inputs">
                        <label for="size">size:</label>
                        <input type="text" name="size" id="size" placeholder="m2"/>
                        
                    </div>

                    
                </div>
            </div>

            

            <div class="informations property-features">

                <h2>Featuress</h2>

                <div class="grid">
                    <label for="wifi"> <input type="checkbox" id="wifi" name="wifi" value="wifi"/> WI-FI  </label>
                    <label for="cooling"> <input type="checkbox" id="cooling" name="cooling" value="cooling"/> Cooled rooms  </label>
                    <label for="balcony"> <input type="checkbox" id="balcony" name="balcony" value="balcony"/> Balcony  </label>
                    <label for="laundry"> <input type="checkbox" id="laundry" name="laundry" value="laundry"/> Laundry  </label>
                    <label for="pool"> <input type="checkbox" id="pool" name="pool" value="pool"/> Pool  </label>
                </div>               
  
            </div>

            <div class="informations amenities">

                <h2>Amenities</h2>

                <div class="grid">
                    <label for="gym"> <input type="checkbox" id="gym" name="gym" value="gym"/> Gym  </label>
                    <label for="restaurant"> <input type="checkbox" id="restaurant" name="restaurant" value="restaurant"/> Restaurant  </label>
                    <label for="park"> <input type="checkbox" id="park" name="park" value="park"/> Park  </label>
                    <label for="club"> <input type="checkbox" id="club" name="club" value="club"/> Club  </label>
                    <label for="supermarket "> <input type="checkbox" id="supermarket " name="supermarket " value="supermarket "/> Supermarket   </label>
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


    </div><!--container-->

    <script>

        const landBound = [
            [document.getElementById("bedrooms"),document.querySelector('.bedrooms')],
            [document.getElementById("furnished"),document.querySelector('.furnished')],
            [document.getElementById("bathrooms"),document.querySelector('.bathrooms')],
            [document.getElementById("floors"),document.querySelector('.floors')],
            [document.getElementById("rooms"),document.querySelector('.rooms')],
            [document.getElementById("garages"),document.querySelector('.garages')]

        ];

        

        

        const furnishedBound = [
            [document.getElementById("bedrooms"),document.querySelector('.bedrooms')]

        ];

        type.addEventListener('change', function(){
            if(type.value == 'land'){

                for(let i = 0; i < landBound.length; i++ ){
                    landBound[i][0].disabled = true;
                    landBound[i][1].style.display = "none";
                }

            } else {
                for(let i = 0; i < landBound.length; i++ ){
                    if(landBound[i][0].id == "bedrooms"){
                        if(furnished.value == "no"){
                            landBound[i][0].disabled = true;
                            landBound[i][1].style.display = "none";
                        }
                        if(furnished.value == "yes"){
                            landBound[i][0].disabled = false;
                            landBound[i][1].style.display = "flex";
                        }
                        
                    } else {
                        landBound[i][0].disabled = false;
                        landBound[i][1].style.display = "flex";
                    }

                }
                
            }
        });
        furnished.addEventListener('change', function(){
            if(furnished.value == 'no'){

                for(let i = 0; i < furnishedBound.length; i++ ){
                    furnishedBound[i][0].disabled = true;
                    furnishedBound[i][1].style.display = "none";
                }

            } else {
                for(let i = 0; i < furnishedBound.length; i++ ){
                    furnishedBound[i][0].disabled = false;
                    furnishedBound[i][1].style.display = "flex";

                }
                
            }
        });

        const rentBound = [
            
            [document.getElementById("rent"),document.querySelector('.rent')],
            [document.getElementById("down_payment"),document.querySelector('.down_payment')]

        ];

        let saleBound = [
            [document.getElementById("price"),document.querySelector('.price')]
        ];

        var mode = document.getElementById("mode");

        mode.addEventListener('change', function(){
            if(mode.value == 'rent'){
                

                for(let i = 0; i < saleBound.length; i++ ){
                    saleBound[i][0].disabled = true;
                    saleBound[i][1].style.display = "none";
                }

                for(let i = 0; i < rentBound.length; i++ ){
                    rentBound[i][0].disabled = false;
                    rentBound[i][1].style.display = "flex";
                }

            } else {

                for(let i = 0; i < saleBound.length; i++ ){
                    saleBound[i][0].disabled = false;
                    saleBound[i][1].style.display = "flex";
                }

                for(let i = 0; i < rentBound.length; i++ ){
                    rentBound[i][0].disabled = true;
                    rentBound[i][1].style.display = "none";
                }
                
            }
        });
        
        
    </script>

</body>
</html>