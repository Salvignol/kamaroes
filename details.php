<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/apartement.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css"/>
    
    <title>Document</title>
    <script>
        document.addEventListener( 'DOMContentLoaded', function () {
  new Splide( '.splide', {
      autoWidth: true,
      type   : 'loop',
      perPage: 3,
      width: '100%',
      focus: 'center',
      gap:'1em'
  } ).mount();
} );
    </script>
    
</head>
<body>
    <?php include "headers/header.php"?>

    <div class="main-wrapper ">

        <section class="page ">

            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list"style="height: 500px">
                        <li class="splide__slide" ><img src="assets/images/whiteclay.jpg" alt=""></li>
                        <li class="splide__slide" ><img src="assets/images/netflix.jpg" alt=""></li>
                        <li class="splide__slide" ><img src="assets/images/mi2.jpg" alt=""></li>
                    </ul>
                </div>
            </div>
            
            <div class="carousel">
            <div class="sponsor"><p>Powered by  </p><a target="_blank" href="https://splidejs.com/"> Splide</a></div>
            <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
            Delectus aspernatur omnis fugiat assumenda saepe similique non ipsam nulla aliquid! Quos maxime et 
            nostrum reiciendis asperiores officiis, necessitatibus, numquam quasi laboriosam sint, alias distinctio 
            assumenda dolor optio nesciunt eius ut totam tempora placeat amet ea.</p>
            </div>

            
        
        

        </section>
       

        <section class="page">

            <div class="page__summary">
            
                <div class="page__summary__information">

                    <div class="informations description">

                        <h2>Description</h2>

                        <div class="grid">

                            <div class="grid_item">
                                <i class="fas fa-bed fa-2x"></i>
                                <p id="wifi" name="wifi"> 4 Bedrooms </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-sink fa-2x"></i>
                                <p id="kitchen" name="kitchen"> 1 Kitchen </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-shower fa-2x"></i>
                                <p id="cooling" name="cooling" value="cooling"> 2 Bathrooms </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-layer-group fa-2x"></i>
                                <p id="balcony" name="balcony" value="balcony"> 1 Floors </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-door-open fa-2x"></i>
                                <p id="laundry" name="laundry" value="laundry"> 1 Empty Rooms </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-car fa-2x"></i>
                                <p id="pool" name="pool" value="pool"> 1 garages </p>
                            </div>
                            
                        </div><!--grid-->              
    
                    </div><!--informations property-features-->

                    <div class="informations property-features">

                        <h2>Features</h2>

                        <div class="grid">

                            <div class="grid_item">
                                <i class="fas fa-wifi fa-2x"></i>
                                <p id="wifi" name="wifi" value="wifi"> WI-FI </p>
                            </div>

                            <div class="grid_item">
                                <i class="far fa-snowflake fa-2x"></i>
                                <p id="cooling" name="cooling" value="cooling"> Cooled rooms </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-wind fa-2x"></i>
                                <p id="balcony" name="balcony" value="balcony"> Balcony </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-tshirt fa-2x"></i>
                                <p id="laundry" name="laundry" value="laundry"> Laundry </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-swimming-pool fa-2x"></i>
                                <p id="pool" name="pool" value="pool"> Pool </p>
                            </div>
                            
                        </div><!--grid-->              
    
                    </div><!--informations property-features-->


                    <div class="informations amenities">

                        <h2>Amenities</h2>

                        <div class="grid">


                            <div class="grid_item">
                                <i class="fas fa-dumbbell fa-2x"></i>
                                <p id="gym" name="gym"> Gym  </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-glass-cheers fa-2x"></i>
                                <p id="restaurant" name="restaurant"> Restaurant  </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-leaf fa-2x"></i>
                                <p id="park" name="park"> Park  </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-compact-disc fa-2x"></i>
                                <p id="club" name="club"> Club  </p>
                            </div>

                            <div class="grid_item">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                                <p id="supermarket " name="supermarket"> Supermarket   </p>
                            </div>
                        </div>

                    </div>
                    
                    <div class="page__summary__button">
                        <button class="page__summary__button__call">Call</button>
                        <button class="page__summary__button__email">E-mail</button>
                    </div>
                    
                </div>

            </div>

        </section>

            <section class="page">

            
                <div class="chat">
                    <form class="chat__form">

                        

                        <div class="chat__form__inputs">
                            <input type="text">
                            <input type="text">
                        </div>
                        
                        <input type="text">
                        <textarea name="test" id="test" cols="30" rows="10"></textarea>
                        
                        <div class="chat__from__buttons">
                            <button class="chat__form__buttons__send-button">Send</button>
                        </div>

                    </form>

                    <div class="chat__warnings">
                        <span class="chat__form__title">Send an Email to Mr.X</span>
                        <!-- <img src="../innside/apt2.webp" alt="warning sign"/> -->
                        <div >Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Ipsam perspiciatis vero corporis illo, doloremque impedit dolorem quod veritatis fugit blanditiis consequuntur velit. 
                        
                        </div>
                    </div>
                </div>
            </section>

    </div>

    <footer>
        
    </footer>
    <script src="js/script.js"></script>
</body>
</html>