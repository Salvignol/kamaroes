<style>

.nav{
        justify-content: space-between;
    }

    .navigation-bar__container{
        display: flex;
    }

    header {    
        position: static;
        /* border: green 2px dotted; */
        
    }

    .nav{
        width: 100%;
        border-radius: 0;
        box-shadow: none;
    }

    a{
        display: block;
    }

    .navigation-bar__item:hover{
        background: white;
        color: black;

    }


    .dropdown-button{
        color: var(--ternary);
    }

    .dropdown-button:hover{
        color: white;
        background: var(--secondary);
    }

@media only screen and (min-width: 768px) {

    .nav{
        justify-content: space-between;
    }

    .navigation-bar__container{
        display: flex;
    }

    header {    
        position: static;
    }

    .nav{
        width: 100%;
        border-radius: 0;
        box-shadow: none;
    }

    a{
        display: block;
    }

    .dropdown-button{
        color: var(--ternary);
    }

    .dropdown-button:hover{
        color: white;
        background: var(--secondary);
    }

}


</style>

<header class="navigation-bar">
    <div class="nav">

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
    </div>

</header>