<!DOCTYPE html>

<html>
<?php session_start()   ?>
  <head>
  <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home Page</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"/>
    <link rel="stylesheet" href="./style.css"/>
  
    <style>   
       
       th {
            padding: 0.3rem;
            background-color: #CC6E1E; 
            color: #FFB74C; }
       
       h1 {
            font-family: Charcoal, sans-serif;
            color: #451ECC; } 
       
       p, form {
            font-family: Arial, Helvetica, sans-serif;
            color: #451ECC}
        
        form{
          position: relative;
        }
       
    </style>
    
    
  </head>

  <body>

      

    
  
      
    <main>
    <nav>
    <img src="police-crest-2018.jpg" alt="Girl in a jacket" width="100" height="50">
    <ul>
  <?php
   if ($_SESSION['Admin'] == 0){
    echo "<li><a href='Home.php'>Home</a></li> <br><br>";
    echo "<li><a href='VehicleL_SearchPage.php'>VL Search</a></li><br><br>";
    echo "<li><a href='Name_DL_SearchPage.php'>N DL Search</a></li><br><br>";
    echo "<li><a href='VehicleOptions.php'>New Vehicle Details</a></li><br><br>";
    echo "<li><a href='ReportOptions.php'>File Report </a></li><br><br>";
    echo "<li><a href='ChangePassword.php'>Change Password </a></li><br><br>";
    echo "<li><a href='index.php'>Log Off </a></li><br><br>";
    }else
  if($_SESSION['Admin'] == 1){
  echo "<li><a href='Home.php'>Home</a></li><br>";
  echo "<li><a href='VehicleL_SearchPage.php'>VL Search</a></li><br><br>";
  echo "<li><a href='Name_DL_SearchPage.php'>N DL Search</a></li><br><br>";
  echo "<li><a href='VehicleOptions.php'>New Vehicle Details</a></li><br><br>";
  echo "<li><a href='ReportOptions.php'>File Report </a></li><br><br>";
  echo "<li><a href='ChangePassword.php'>Change Password </a></li><br><br>";
  echo "<li><a href='AddPolice.php'>Add Police User </a></li><br><br>";
  echo "<li><a href='Fines.php'>Add Fines </a></li><br><br>";
  echo "<li><a href='index.php'>Log Off </a></li><br><br>";
}
  ?>
</ul>
</nav>

    <section class="glass">
        <div class="dashboard">
          
        </div>
      </section>
    </main>
    <div class="circle1"></div>
    <div class="circle2"></div>
    
    
    
    
    
           
    <?php
    // MySQL database information       
    $servername = "mysql.cs.nott.ac.uk";
    $username = "psxng3";
    $password = "NJJNIL";
    $dbname = "psxng3";    
    //session_start();  
    
    
    // Check connection
    $mysqli = new mysqli($servername,$username,$password,$dbname);

    // Check connection
    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}
    
    // If the enter button is clicked
    if(isset($_POST['Enter'])){
     
      //$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

      $Policeusername = trim($_POST['Username']);
      $Policepassword = trim($_POST['Password']);
      $Policeadmin = trim($_POST['Admin']);
      
    


// Perform query
$result = $mysqli -> query("SELECT CheckPassword('$Policeusername','$Policepassword')"); {
  #echo "Returned rows are: " . $result -> num_rows;
  $row = $result -> fetch_row() ;

}

    }
  
  
  
 
     
   
   
 
      
      
      
    
       
    
 
     
    
      
   
    

    


  
     
    
    
   ?> 
  </main> 
  
  </body>
</html>

