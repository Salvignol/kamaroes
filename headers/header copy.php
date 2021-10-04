<style>

header{
    /* border: 2px dotted green; */
    z-index: 99;
    position: fixed;
    bottom: 0;
}

.nav {    
    width: 100%;
    background: white;
    padding-bottom: 2.5rem;
    /* box-shadow: 0px 5px 15px -5px rgba(50,50,50,0.8); */
}

a{
    display: block;
}

.navigation-bar__container{
    display: none;
    grid-template-columns: repeat(5, auto);
    
}

.mobile__nav {
    width: 100%;
    display: grid;
    justify-content: space-evenly;
}

.nav ul a i {
    color: var(--ternary);
    padding: 1.5rem;
    font-size: 1.3em
    
}


.nav ul a i:hover{
    color: var(--secondary);
}

.navigation-bar__item:hover{
    background: white;
    color: black;

}


.dropdown-button{
    color: var(--ternary);
    border-radius: .5rem;
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

    .mobile__nav {
        display: none;
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

    .navigation-bar__item:hover{
        background: white;
        color: black;

    }


    .dropdown-button{
        color: var(--ternary);
        border-radius: .5rem;
    }

    .dropdown-button:hover{
        color: white;
        background: var(--secondary);
    }

}


</style>

<header class="navigation-bar">
    <div class="nav">


        <ul class="navigation-bar__container mobile__nav">
            <a href=""><i class="far fa-user-circle"></i></a>
            <a href="dashboard.php"><i class="far fa-chart-bar"></i></a>
            <a href="home.php"><i class="far fa-building"></i></a>
            <a href=""><i class="fas fa-plus"></i></a>
            <a href=""><i class="fas fa-sliders-h"></i></a>
        </ul>

    
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