<style>

header {    
    background: black;
    color: #fff;   
    
}

a{
    display: block;
}

.navigation-bar__item:hover{
    background: white;
    color: black;

}

.form__container{
    width: 100%;
    background: black; 
    align-items: center;
   
}

.dropdown-button{
    color: #fff;
}

.dropdown-button:hover{
    color: white;
    background: var(--secondary);
}

</style>

<header class="navigation-bar">
    <ul class="navigation-bar__container">

    </ul>
    
    <ul class="navigation-bar__container">
        <a href="home.php"><li class="navigation-bar__item">Go to Kamaroes</li></a>
        
        <?php 
            if(isset($_SESSION['first_name']) AND isset($_SESSION['last_name'])) /*OR isset($_COOKIE['email']) AND isset($_COOKIE['id'])*/{
        ?>
        
        <div class="dropdown header_dropdown">
                <button class="dropdown-button "><?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']?></button>
                <div class=" dropdown-content ">
                        <a href="dashboard.php">Dashboard</a>
                        <a href="profile.php">Profile</a>
                        <a href="Log Out.php">Log Out</a>
                </div>
            </div>

        <?php
            }
            else
            {
        ?>
        <li class="navigation-bar__item">SIGIN</li>
        <?php
            }
        ?>
                    
        </ul>

</header>

<header >
    <ul class="navigation-bar__container form__container">

    <div class="dropdown">
        <a class="dropdown-button" href="profile.php">Profile</a>    
    </div>
        <div class="dropdown">
            <a class="dropdown-button">Dashboard</a>
            <!-- <div class="dropdown-content">
                <select name="min_price" id="min_price">
                    <option value="50000">50K</option>
                </Select>
                    
            </div> -->
        </div>

            <div class="dropdown">
                <a class="dropdown-button" href="adverts.php">Adverts</a>    
            </div>



            <div class="dropdown">
                <a href="enquiries.php" class="dropdown-button">Enquiries</a>
            </div>

            <div class="dropdown">
                <a href="poster.php" class="dropdown-button">+ List new Property</a>
            </div>


            <script type="text/javascript">
                        document.getElementById('min_price').value = "<?php echo $_POST['min_price'];?>";
                        document.getElementById('max_price').value = "<?php echo $_POST['max_price'];?>";
                        document.getElementById('type').value = "<?php echo $_POST['type'];?>";
                        document.getElementById('bedroom').value = "<?php echo $_POST['bedroom'];?>";
                        document.getElementById('bathroom').value = "<?php echo $_POST['bathroom'];?>";
                        
            </script>

           
        </ul>
    </header>