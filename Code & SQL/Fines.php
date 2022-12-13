<!DOCTYPE html>

<html>

  <head>
  <?php session_start()   ?> 
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
    <title>Name and Driving Licence Search Page</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./style.css" />
  
    <style>   
       
       
       h1 {
            font-family: Charcoal, sans-serif;
            color: #451ECC; } 
       
       p, form {
            font-family: Arial, Helvetica, sans-serif;
            color: #451ECC}
       
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

        $result  = $mysqli -> query("SELECT Incident.Incident_ID, People.People_Firstname, People.People_Lastname, Incident.Incident_Date, Incident.Incident_Report, Offence.Offence_ID, Offence_description FROM Incident LEFT JOIN People ON Incident.People_ID = People.People_ID LEFT JOIN Offence ON Offence.Offence_ID = Incident.Offence_ID " ); {
  
        $rowcount = $result -> num_rows;
        
          // Setting up table
          echo "<table border='10'>

          <tr>

          <th>Incident ID</th>
          
          <th>First Name</th>
          
          <th>Last Name</th>
          
          <th>Incident Date</th>
          
          <th>Incident Report</th>

          <th>Offence ID</th>

          <th>Offence Description</th>

          <th>Add Fines</th>

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
              echo "<td>".$row[5]."</td>";
              echo "<td>".$row[6]."</td>";
              echo "<td> <button type'button'  onclick='addFineDialog(".$row[0].")'>Add Fine</button></td>";
              echo "</tr>"; 
          
            }
          



          echo "</table>";
          "<hr>";
        
        // Frees result memory
        $result -> free_result();
      
        }
         // Closes connection 
        $mysqli -> close();

 
 
  
      ?>
       

        </div>
      </section>
    </main>
    <div class="circle1"></div>
    <div class="circle2"></div>
    

    
           
   
    <div id="addFineDialogDiv" title="Add Fine" style="display: none;">
    <br/>
    <p id="FineInfoText">Please enter the details of the fine</p>
    <br> 
    <div id="fieldArea">
    <br>
     <b>Fine Amount:</b> <input type="text" id="FA" name="FA" required  placeholder = "Fine Amount"
       minlength="2"  size="30">       
    <br>
    <br>
    <b>Fine Points:</b> <input type="text" id="FP" name="FP" required  placeholder = "Fine Points"
       minlength="2"  size="30">      
    </div>
    </div>


  
     
  
  </body>

  <script>

//Global variables used to hold owner Id and Incident Id selected from Dialog boxes,
// and then passed as parameters for Ajax call to save detaiks
var currentOwnerId = "";
var currentIncidentId = "";


$( document ).ready(function() {


    
    //Initialise Ajax Add Fine Dialog box
    $('#addFineDialogDiv').dialog({
                autoOpen: false,
                width: 700,
            buttons: {
            "OK": function() {
              if ( $("#FA").val() == "")
                {
                    alert ("Please enter the Fine Amount before selecting this option")
                    return
                }
                if ( $("#FP").val() == "")
                {
                    alert ("Please enter the Fine Points before selecting this option")
                    return
                }               
              saveIncident();
            },
            "Cancel": function() { 
                $(this).dialog("close"); 
            }
            }
        });
    
        
        



});





  // Show add Find Dialog Box
 function addFineDialog (incident)
{

  currentIncidentId = incident;

   $('#addFineDialogDiv').dialog('open');
   $("#FA").val("")
   $("#FP").val("")
    


   //$("#fieldArea").hide();
     

}






//Save Fine Details of Incident to MySQL using Ajax Call 
function saveIncident ()
{


    $.ajax({
        method: 'get',
        url: 'addFines.php',
        data: {
            "FineAmount": $("#FA").val(),
            "FinePoints": $("#FP").val(),
            "IncidentID" : currentIncidentId,  
            
        },
        success: function(result) {
           
            var jsonResult = $.parseJSON(result);
            
            //Check if the call was successful
            if (jsonResult.Success)
            {
                alert ("You have Successfully added a fine");

            }      
            else
            {
                // Check which type of error occurred based on return value from Ajax call
                if (jsonResult.Id == -1)
                {
                  alert ("The fine you have entered is too high for the offence recorded against the Incident")
                  return false;
                }
                else if (jsonResult.Id == -2)
                {
                  alert ("The points you have entered are too high for the offence recorded again the Incident")
                  return false;
                }
                else{
                  alert ("A problem Occurred while creating a Vehicle")
                }

               
            }
                
            

        }
    });



}









 
</script>
</html>


