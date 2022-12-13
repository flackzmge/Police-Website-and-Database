<!DOCTYPE html>

<html>
<?php session_start();  ?>
  <head>
    <title>Change Password</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"/>
    <link rel="stylesheet" href="./style.css"/>
    
    
    
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
    echo "<li><a href='index.php'>Log Off </a></li><br><br>"  ;
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
    
    <form method="POST">
        Username: &nbsp;<input type="text" name="Username" Placeholder = "Username" required><pre>
        First Name:&nbsp; <input type="text" name="fname" Placeholder = "First Name" required><pre>
        Last Name:&nbsp; <input type="text" name="lname" Placeholder = "Last Name" required><pre>
        Address:&nbsp; <input type="text" name="Address" Placeholder = "Address" required><pre>
        Password:&nbsp; <input type="text" name="Password" Placeholder = "Password" required><pre>
        Admin:&nbsp; <select name="Admin" id="Admin">
        <option value=1>Admin</option>
        <option value=0 selected>User </option>
        </select><br>
        <input type="submit" name = "Enter" value = "Enter">
       </form>
    <hr>
    
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
        $Policefname = trim($_POST['fname']);
        $Policelname = trim($_POST['lname']);
        $PoliceAddress = trim($_POST['Address']);
        $Policepassword = trim($_POST['Password']);
        $Policeadmin = trim($_POST['Admin']);



        // Store Query in result
        $result = $mysqli -> query("SELECT AddPoliceUser('$Policeusername','$Policefname','$Policelname', '$PoliceAddress', '$Policepassword',  '$Policeadmin')"); {
        //echo "Returned rows are: " . $result -> num_rows;
        $row = $result -> fetch_row() ;
        //echo $row[0];
        // Free result set
        if ($row[0] == 0){
          echo "<script>alert('User not Added');</script>";
        }
        else if ($row[0] == 1){
          echo "<script>alert('Police User added');</script>";
        }
        
        // Frees result memory
        $result -> free_result();
      
        }
      
        $mysqli -> close();
      
          }
     
 
 
 
  
      ?>
    
    
     

       
  </body>
</html>

