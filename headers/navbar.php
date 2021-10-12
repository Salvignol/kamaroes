<style>


.navigation{
    border-right: rgba(200,200,200,0.5) 1px solid;
    position: sticky;
    top: 0;

  display: flex;
  
  justify-content: start;
  align-items: center;
  height: 100vh;
  width: 16rem;

  transition: width .3s ease-out;
}

.label{
    
    
    padding: 0 1rem;
    
    
}

.nav-menu{
    
    display: grid;
    grid-template-columns: auto;
    justify-content: center;
    align-content: center;
    row-gap: 2rem;
}



.nav-menu i {
    color: gray;
    padding: 1rem;
    font-size: 1.2em;
    border-radius: 50%;
    /* border: 3px dotted yellow; */
    transition: background-color .3s ease-out;
}



.sss{
    /* border: 3px dotted yellow; */
    display: flex;
    justify-content: flex-start;
    align-items: center;
    color: black;
    white-space: nowrap;
    overflow: hidden;
    transition: color .2s ease-out;
    
}

.sss:hover{
    color: var(--secondary);
}




</style>

<nav class="navigation">

    <!-- <ul class="nav-menu">
   
        <a href="profile.php">close</a>    
           
    </ul> -->

    <ul class="nav-menu">

        <div class="sss">
            <i class="far fa-user-circle"></i><a href=""><p class=label>Profile</p></a>
        </div>

        <div class="sss">
            <i class="far fa-chart-bar"></i><a href="dashboard.php"><p class=label>Dashboard</p></a>
        </div>

        <div class="sss">
            <i class="fas fa-bullhorn"></i><a href="adverts.php"><p class=label>Adverts</p></a>
        </div>

        <div class="sss">
            <i class="fas fa-envelope-open-text"></i><a href="enquiries.php"><p class=label>Enquiries</p></a>
        </div>

        <div class="sss">
            <i class="far fa-plus-square"></i><a href="poster.php"><p class=label>List an Add</p></a>
        </div>
   
        

        
        
        
           
    </ul>
    

</nav>