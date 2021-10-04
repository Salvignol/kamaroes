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
                    
                    
                    <div class="inputs">
                        <label for="category">Category:</label>
                        <select name="category" id="category">
                            <option value="house" selected disabled>None</option>
                            <option value="house">House</option>
                            <option value="apartment">Apartment</option>
                            <option value="office">Office</option>
                            <option value="land">Land</option>
                        </select>
                        
                    </div>

                    <div class="inputs">
                        <label for="transaction">Transaction:</label>
                        <select name="transaction" id="transaction" >
                            <option value="house" selected disabled>None</option>
                            <option value="rental">To rent</option>
                            <option value="sale">For Sale</option>
                        </select>
                    </div>

                    <textarea  class="description" name="description" id="description" cols="30" rows="10"></textarea>

                </div>
            </div>

            <div class="informations transaction sale">
                <h2>Sales</h2>

                <div class="grid">
                    
                    <div class="inputs noBuild unit">
                        <label for="unit">Unit:</label>
                        <input type="text" name="unit" id="unit" value="1"/>
                        <p class="error"><?php echo $errors['rent'];?></p>   
                    </div>

                    <div class="inputs noBuild byUnit">
                        <label for="byUnit">By Uniy:</label>
                        <input type="text" name="byUnit" id="byUnit" value="1"/>
                        <p class="error"><?php echo $errors['rent'];?></p>   
                    </div>

                    <div class="inputs price">
                        <label for="price">Price:</label>
                        <input type="text" name="price" id="price" value="1" />
                        <p class="error"><?php echo $errors['price'];?></p>   
                    </div>
                </div>
            </div>

            <div class="informations transaction rental">
                        
                <h2>Rental</h2>

                    <div class="grid">

                    <div class="inputs rent">
                        <label for="rent">Rent/Month:</label>
                        <input type="text" name="rent" id="rent" value="1"/>
                        <p class="error"><?php echo $errors['rent'];?></p>   
                    </div>

                    <div class="inputs noLand down_payment">
                        <label for="down_payment">Down Payment/Month:</label>
                        <input type="text" name="down_payment" id="down_payment" value="1"/>
                        <p class="error"><?php echo $errors['rent'];?></p>   
                    </div>

                    <div class="inputs noLand deposit">
                        <label for="deposit">Deposit:</label>
                        <input type="text" name="deposit" id="deposit" value="1"/>
                        <p class="error"><?php echo $errors['rent'];?></p>   
                    </div>

                    <div class="inputs noBuild unit">
                        <label for="unit">Unit:</label>
                        <input type="text" name="unit" id="unit" value="1"/>
                        <p class="error"><?php echo $errors['rent'];?></p>   
                    </div>
                    
                </div>
            </div>

            <div class="informations property house">
                        
                <h2>House</h2>

                    <div class="grid">

                    

                    <div class="inputs furnished">
                        <label for="furnished">House Type:</label>
                        <select name="furnished" id="furnished">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div class="inputs titled">
                        <label for="titled">Titled:</label>
                        <select name="titled" id="titled">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>


                    <div class="inputs furnished">
                        <label for="furnished">Furnished:</label>
                        <select name="furnished" id="furnished">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>


                    <div class="inputs bedrooms">
                        <label for="bedrooms">Bedrooms:</label>
                        <input type="text" name="bedrooms" id="bedrooms" value="1"/>
                        <p class="error"><?php echo $errors['bedrooms'];?></p>

                        
                    </div>

                    <div class="inputs kitchen">
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

            <div class="informations property apartment">
                        
                <h2>Apartment</h2>

                    <div class="grid">

                    <div class="inputs furnished">
                        <label for="furnished">Apartment Type:</label>
                        <select name="furnished" id="furnished">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>


                    <div class="inputs furnished">
                        <label for="furnished">Furnished:</label>
                        <select name="furnished" id="furnished">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>


                    <div class="inputs bedrooms">
                        <label for="bedrooms">Bedrooms:</label>
                        <input type="text" name="bedrooms" id="bedrooms" value="1"/>
                        <p class="error"><?php echo $errors['bedrooms'];?></p>

                        
                    </div>

                    <div class="inputs kitchen">
                        <label for="kitchen">Kitchen:</label>
                        <input type="text" name="kitchen" id="kitchen" value="1"/>
                        <p class="error"><?php echo $errors['kitchen'];?></p>

                        
                    </div>
                   

                    <div class="inputs bathrooms">
                        <label for="bathrooms">Bathrooms:</label>
                        <input type="text" name="bathrooms" id="bathrooms" value="1"/>
                        <p class="error"><?php echo $errors['bathrooms'];?></p>
                    </div>
                    
                    
                    <div class="inputs level">
                        <label for="level">Floor Level:</label>
                        <input type="text" name="level" id="level" value="0"/>
                        <p class="error"><?php echo $errors['floors'];?></p>
                    </div>

                    
                    
                    <div class="inputs rooms">
                        <label for="rooms">Empty rooms:</label>
                        <input type="text" name="rooms" id="rooms" value="0"/>
                        <p class="error"><?php echo $errors['rooms'];?></p>
                    </div>

                    

                    <div class="inputs parking">
                        <label for="parking">Parking:</label>
                        <select name="parking" id="parking">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
                        <p class="error"><?php echo $errors['garages'];?></p>
                    </div>

                    <div class="inputs">
                        <label for="size">size:</label>
                        <input type="text" name="size" id="size" placeholder="m2"/>
                        
                    </div>

                    
                </div>
            </div>

             <div class="informations property office">
                        
                <h2>Office</h2>

                    <div class="grid">

                    <div class="inputs office-location">
                        <label for="furnished">Apartment Type:</label>
                        <select name="furnished" id="furnished">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>


                    <div class="inputs furnished">
                        <label for="furnished">Furnished:</label>
                        <select name="furnished" id="furnished">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
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

                    
                    <div class="inputs parking">
                        <label for="parking">Parking:</label>
                        <select name="parking" id="parking">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
                        <p class="error"><?php echo $errors['garages'];?></p>
                    </div>

                    <div class="inputs">
                        <label for="size">size:</label>
                        <input type="text" name="size" id="size" placeholder="m2"/>
                        
                    </div>

                    
                </div>
            </div>

            <div class="informations property land">
                        
                <h2>Land</h2>

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
                        <p class="error"><?php echo $errors['rooms'];?></p>
                    </div>

                    <div class="inputs fee">
                        <label for="fee">Fee:</label>
                        <input type="text" name="fee" id="fee" value="0"/>
                        <p class="error"><?php echo $errors['rooms'];?></p>
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
                        <p class="error"><?php echo $errors['rooms'];?></p>
                    </div>

                    <div class="inputs rooms">
                        <label for="rooms">Empty rooms:</label>
                        <input type="text" name="rooms" id="rooms" value="0"/>
                        <p class="error"><?php echo $errors['rooms'];?></p>
                    </div>


                    
                </div>
            </div>

            

            

            <div class="informations noLand features">

                <h2>Featuress</h2>

                <div class="grid">
                    <label for="wifi"> <input type="checkbox" id="wifi" name="wifi" value="wifi"/> WI-FI  </label>
                    <label for="cooling"> <input type="checkbox" id="cooling" name="cooling" value="cooling"/> Cooled rooms  </label>
                    <label for="balcony"> <input type="checkbox" id="balcony" name="balcony" value="balcony"/> Balcony  </label>
                    <label for="laundry"> <input type="checkbox" id="laundry" name="laundry" value="laundry"/> Laundry  </label>
                    <label for="pool"> <input type="checkbox" id="pool" name="pool" value="pool"/> Pool  </label>
                </div>               
  
            </div>

            <div class="informations land amenities">

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

        var category = document.getElementById('category');
        var transaction = document.getElementById('transaction');

        var properties = document.getElementsByClassName("property");
        var transactions = document.getElementsByClassName("transaction");
        var noLand = document.getElementsByClassName("noLand");
        var noBuild = document.getElementsByClassName("noBuild");

        var billing = document.querySelectorAll('.billing');


        // alert(properties[0].className.includes("house"));
        // alert(transaction.length);
        // alert(noLand.length);
        // console.log('asd');
        // alert(noBuild.length);

        category.addEventListener('change', function(){

            let identifier = 'informations property '+ category.value;

            for (let i = 0; i < properties.length; i++) {
                if(identifier == properties[i].className){
                    properties[i].style.display = 'grid';
                } else {
                    properties[i].style.display = 'none';
                }
                
                // console.log(informations[i].className);
            }

            for (let i = 0; i < noLand.length; i++) {
                if(identifier == 'informations property land'){
                    noLand[i].style.display = 'none';
                } else {
                    if(noLand[i].className.includes("inputs")){
                        noLand[i].style.display = 'flex';
                    } else {
                        noLand[i].style.display = 'grid';
                    }
                    
                }
            }

            for (let i = 0; i < noBuild.length; i++) {
                if(identifier != 'informations property land'){
                    noBuild[i].style.display = 'none';
                } else {
                    if(noBuild[i].className.includes("inputs")){
                        noBuild[i].style.display = 'flex';
                    } else {
                        noBuild[i].style.display = 'grid';
                    }
                    
                }
            }
        });

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