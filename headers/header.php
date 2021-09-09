<style>


.navigation-bar__item:hover{
    background: white;
    color: black;

}



.dropdown-button:hover{
    color: white;
    background: var(--secondary);

    
}

.link{
        border: 2px dotted blue;
       
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
                        <a class="link" href="dashboard.php">Dashboard</a>
                        <a class="link" href="profile.php">Profile</a>
                        <a class="link" href="Log Out.php">Log Out</a>
                </div>
            </div>

        <?php
            }
            else
            {
        ?>
        <button class="dropdown-button "><a href="signin.php">SIGN IN</a></button>
        <?php
            }
        ?>
                    
        </ul>

</header>