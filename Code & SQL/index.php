<!DOCTYPE html>

<html>

  <head>
    <title>Login Page</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"/>
    <link rel="stylesheet" href="./style.css"/>
  
  
    <style>   
       table, td {
       padding: 0.3rem;
       border: 1px solid black;
       border-collapse: collapse;
       text-align: left;
       background-color: #FFB74C; 
       color: #451ECC;
       font-family: Tahoma, Arial, Helvetica, sans-serif;}
       
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
    
   

  
    </div>
      
      <main>
      <section class="glass">
          <div class="dashboard">
        <form method="POST" id = "LoginForm">
        Username: &nbsp;<input type="text" name="Username" placeholder="Username" required><br>
        Password: <input type="text" name="Password" placeholder="Password" required > <br>
        Admin: <select name="Admin" id="Admin"> 
        <option value=1>Admin</option>
        <option value=0 selected>User </option>
        </select><br>
        <input type="submit" name ="Enter" value = "Enter"  required>
    </form>
          </div>
        </section>
      </main>
      <div class="circle1"></div>
      <div class="circle2"></div>
     
    
    
    
    
    </script>
    
           
    <?php
    // MySQL database information       
    $servername = "mysql.cs.nott.ac.uk";
    $username = "psxng3";
    $password = "NJJNIL";
    $dbname = "psxng3";    
    session_start();  
    
    
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
  
  
  // Free result set
  if ($row[0] == 0 && $Policeadmin == 0){
    $_SESSION["username"] =  $Policeusername;
    $_SESSION["Admin"] = $Policeadmin;
    header("location:Home.php");
  }
  if ($row[0] == 0 && $Policeadmin == 1){
    
    echo "<script>alert('You do not have Admin permissions');</script>";
    
  }
  if ($row[0] == 1  && $Policeadmin == 1 ){
    $_SESSION["username"] =  $Policeusername;
    $_SESSION["Admin"] = $Policeadmin;
    header("location:Home.php");
  }
  if ($row[0] == 1 && $Policeadmin == 0){
    echo "<script>alert('Try logging onto Admin buddy');</script>";
  }
  else if ($row[0] == -1) {
    echo "<script>alert('Wrong password');</script>";
  }
  $result -> free_result();
 // wipe the current value stored in result so it can be used to store another one 
}
// Close connection 
$mysqli -> close();

    }
 
     
   
   
 
      
      
      
    
       
    
 
     
    
      
   
    

    


  
     
    
    
   ?> 
  </main> 
  
  </body>
</html>

