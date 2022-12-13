<!DOCTYPE html>

<html>
<?php session_start()   ?>
  <head>
    <title>Name and Driving Licence Search Page</title>
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
        <form method="POST">
       Vehicle Licence: &nbsp;<input type="text" name=" Licence" Placeholder = " Vehicle Licence"required> 
       
        <input type="submit" name = "Enter" value = "Enter">
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
     
     
     if(isset($_POST['Enter'])){
      
       
 
        $VehicleLicence = trim($_POST['Licence']);

        $result  = $mysqli -> query("CALL sp_VehicleLicenceSearch('$VehicleLicence')"); {
       
       


        $rowcount = $result -> num_rows;
        

          // Setting up table
          echo "<table border='10'>

          <tr>
          
          <th>First Name</th>
          
          <th>Last Name</th>
          
          <th>Driving Licence</th>
          
          <th>Vehicle Type</th>

          <th>Vehicle Colour</th>
          
          </tr>";
          
          
          //$col = array();
          // While $row is equal to the row of result 
          while($row = $result -> fetch_row() ) 
          
            { 
              
              //$row = $result -> fetch_row() ;
              
              "<tr>";
              echo "<td>".$row[0]."</td>";
              echo "<td>".$row[1]."</td>";
              echo "<td>".$row[2]."</td>";
              echo "<td>".$row[3]."</td>";
              echo "<td>".$row[4]."</td>";
              echo "</tr>"; 
          
            }
          



          echo "</table>";
          "<hr>";

          
        // Frees result memory
        $result -> free_result();
      
        }
         // Closes connection 
        $mysqli -> close();
      
          
        }
 
 
 
  
      ?>
    </form>
        </div>
      </section>
    </main>
    <div class="circle1"></div>
    <div class="circle2"></div>
    
    
    
    

 
    
    
    


    <hr>
    
    
    </script>
    
           
    
      
     
  
  </body>
</html>

