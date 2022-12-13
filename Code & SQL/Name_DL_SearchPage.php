<!DOCTYPE html>

<html>

  <head>
      <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
    <title>Name and Driving Licence Search Page</title>
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
  
    <style>   
       
      
       
     
       
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
        <form method="POST">
       First Name: &nbsp;<input type="text" name= "Firstname" Placeholder = " First Name"> 
       Last Name: <input type="text" name= "Lastname" Placeholder = "Last Name" > <pre>
       <pre>
       <p> or </p> <pre>
        Driving Licence: <input type="text" name= "Driving" Placeholder = "Driving Licence" > <pre>
       <br>
        <input type="submit" name = "Enter" value = "Enter"/>

     
  


    </form>
    <hr>
    
    
    </script>
    
           
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
    


    if(isset($_FILES['image'])){

      echo "Image Saved to Datbase";
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or JPG file.";
      }

      $data = file_get_contents($_FILES['image']['name']);
      $data = base64_encode($data);
      
      $RecordID = $_COOKIE["imageid"];

      $result  = $mysqli -> query("UPDATE People SET Image = '$data' WHERE People_ID = '$RecordID'");{


      }

     


   }








    // If enter is pressed
    if(isset($_POST['Enter'])){
      
       
       // Setting variables = to input in the forms
      $Firstname = trim($_POST['Firstname']);
      $Lastname = trim($_POST['Lastname']);
      $DL = trim($_POST['Driving']);
      
        $result  = $mysqli -> query("CALL sp_CheckNameCheckDLSearch('$Firstname','$Lastname','$DL')");{
        //echo "Returned rows are: " . $result -> num_rows;
        //echo "Returned rows are: " . $result2 -> num_rows;
        //$row = $result -> fetch_row() ;

        
       


        $rowcount = $result -> num_rows;
        
        
        
          echo "<table border='10'>

          <tr>
          
          <th>People ID</th>
          
          <th>First Name</th>
          
          <th>Last Name</th>
          
          <th>Address</th>

          <th>Driving Licence</th>

          <th>Licence Image</th>
          
          </tr>";
          
          
          //$col = array();
          while($row = $result -> fetch_row() ) 
          
            { 
             
              
              //$row = $result -> fetch_row() ;
              //$row = mysqli_fetch_array($result);
              
              "<tr>";
              echo "<td>".$row[0]."</td>";
              echo "<td>".$row[1]."</td>";
              echo "<td>".$row[2]."</td>";
              echo "<td>".$row[3]."</td>";
              echo "<td>".$row[4]."</td>";
              if ($row[5] == null || $row[5] == "")
              {
                echo "<td><button type='button'  onclick='addLicenceImage(".$row[0].")'>Add Licence Image</button></td>";
              }
              else
              {
                echo "<td><img width='150' height='100%' src='data:image/jpg;base64," . $row[5] . "'/></td>";
              }
              echo "</tr>"; 
              
              
              
          
            }
            
          



          echo "</table>";
          "<hr>";
          


     
      }
      // Frees result memory
      $result -> free_result();
    
      }
    
      $mysqli -> close();
    
        
      




    ?>

        <div id="LoadImageDiv" title="Add Vehicle" style="display: none;">
          <form action="" method="POST" enctype="multipart/form-data">
          <br>
          <br>
          <b>Please select an image file</b>
          <br>
         <input type="file" name="image" /><input type="submit" name = "SaveImage" value = "Load Image">
        </form>
  
        </div>
    
        </div>
      </section>
    </main>
    <div class="circle1"></div>
    <div class="circle2"></div>
    
 

    <br/>



    /* <button type="button" id="clickMe">CLICK ME TO RUN PHP</button> 

    <button type="button" id="clickMe">CLICK ME TO RUN PHP</button> */
  
  </body>


<script>




/*
window.onload = function() {
    if (window.jQuery) {  
        // jQuery is loaded  
        alert("Yeah!");
    } else {
        // jQuery is not loaded
        alert("Doesn't Work");
    }
}
*/

var scriptString = 'THIS IS MY STRING';

//This function add an the Id of record to have an image 
//added to it into a cookie so that it can read by PHP code. 
//It also shows the file upload control on the form so that it can be used to load the image
function addLicenceImage (id)
{

  $("#LoadImageDiv").show();
  createCookie("imageid", id, "10");


}



//The function creates a time limiited cookie
function createCookie(name, value, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  }
  else {
    expires = "";
  }
  document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}



 
</script>
</html>

