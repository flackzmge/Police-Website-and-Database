<!DOCTYPE html>

<html>
<?php session_start()   ?>
  <head>
      <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
    <title>Add Report Page</title>
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
    

    
       
 
      //$Firstname = trim($_POST['Firstname']);
      //$Lastname = trim($_POST['Lastname']);
      //$DL = trim($_POST['Driving']);
      
        //$result  = $mysqli -> query("CALL sp_CheckNameCheckDLSearch('$Firstname','$Lastname','$DL')");{
        //echo "Returned rows are: " . $result -> num_rows;
        //echo "Returned rows are: " . $result2 -> num_rows;
        //$row = $result -> fetch_row() ;
       


       // $rowcount = $result -> num_rows;
        
        //echo $rowcount;
        
         /* echo "<table border='10'>

          <tr>
          
          <th>First Name</th>
          
          <th>Last Name</th>
          
          <th>Driving Licence</th>
          
          <th>Vehicle Licence</th>

          <th>Vehicle Type</th>

          <th>Vehicle colour</th>
          
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
              echo "</tr>"; 
              
              
              
          
            }
            
          



          echo "</table>";
          "<hr>";


     
      }
      // Frees result memory
      $result -> free_result();
    
      
    
      $mysqli -> close(); */
    
        
      




    ?>
      
    <br/>


    <button type="button" onclick="addReportDialog()">Add New Incident Report</button> <button type="button" onclick="addVehicleDialog()">Edit Exisiting Incident Report</button>

    </div>
      </section>
    </main>
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div id="addReportDialogDiv" title="Incident Report" style="display: none;">
    <pre>
    <p id="ReportInfoText"> Please enter/edit report details</p>
    <pre>
    <div id="ReportfieldArea">
    <button type="button" id="VehicleButton" onclick="vehicleOptionsDialog()">Select Vehicle</button>  <p id="SelectedVehicle"></p>    
    <pre>
    <pre>
     <b>Incident Date:</b> <input type="date" id="IncidentDate" name="IncidentDate">  
    <pre>
    <pre>
    <b>Offence:</b> <select name="OffenceSelect" id="OffenceSelect">
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select> 

    <pre>
    <pre>
    <b>Incident Details:
   <pre>   
    </b> <textarea id="IncidentReport" name="IncidentReport" rows="4" cols="50"></textarea>    
    </div>
    </div>



    <div id="addExistingVechicleDialogDiv" title="Select Vechicle" style="display: none;">
    <pre>
    <p>Please enter Search Details:</p>
    <pre>
    
    <div id="ExistingVehiclefieldArea">
    <pre>

    Vechicle Licence: &nbsp;<input type="text" size="20" id="VLSearch" name= "VLSearch" Placeholder = "Vehicle Licence"> 
   
    <pre>
    <pre>
    

    <select name="vehicleSearchResultBox" id="vehicleSearchResultBox"size="8" width="200">
        <option>text1</option>
        <option>text2</option>
        <option>text3</option>
        <option>text4</option>
        <option>text5</option>
    </select>

    </div>
    </div>












   

    <div id="vehicleOptionsDiv" title="Vehicle Options" style="display: none;">
    <pre>
    <p id="VehicleOptionInfoText"> Please Select an Option</p>
    <pre>
    <div id="VehicleOptionfieldArea">
    <button type="button" onclick="addExistingVehicleDialog()">Select Existing Vehicle</button> <button type="button"  onclick="addVehicleDialog()">Add New Vehicle</button>   
    </div>
    </div>





    <div id="addVechicleDialog" title="Add Vehicle" style="display: none;">
   <pre>
    <p id="VechicleInfoText"> Add new Report, please first select an existing incident or add a new incident.</p>
   <pre>

    <button type="button" id="ExistingOwnerButton" onclick="addExistingOwnerDialog()">Select Existing Owner</button> <button type="button" id="OwnerButton" onclick="addNewOwnerDialog()">Add New Owner</button> 
    <div id="fieldArea">
    <div id="Ownername"></div>
    <pre>
    <pre>
     <b>Vehicle Licence:</b> <input type="text" id="VL" name="VL" required  placeholder = "Vehicle Licence"
       minlength="2"  size="30">       
       <pre>
       <pre>
    <b>Vehicle Type:</b> <input type="text" id="VT" name="VT" required  placeholder = "Vehicle Type"
       minlength="2"  size="30">  
       <pre>
       <pre>
    <b>Vehicle Colour:</b> <input type="text" id="VC" name="VC" required  placeholder = "Vehicle Colour"
       minlength="2"  size="30">    
    </div>
    </div>


    <div id="addNewOwnerDialog" title="Add New Owner" style="display: none;">
    <pre>
    <p>Please enter new Owner Details:</p>
    <pre>
    
    <div id="NewOwnerfieldArea">
    <b>First Name:</b> <input type="text" id="Fname" name="fname" placeholder = "First Name" required
       minlength="4"  size="30">
       <pre>
       <pre>
    <b>Last Name:</b> <input type="text" id="Lname" name="lname" required  placeholder = "Last Name"
       minlength="4"  size="30">   
       <pre>
       <pre>
    <b>Address :</b> <input type="text" id="Address" name="Address" required  placeholder = "Address"
       minlength="4"  size="30">
       <pre>
       <pre>
    <b>Driving Licence:</b> <input type="text" id="DL" name="DL" required  placeholder = "Driving Licence"
       minlength="4"  size="30">
       <pre>
       <pre>
     
    </div>
    </div>


    <div id="addExistingOwnerDialog" title="Select Existing Owner" style="display: none;">
    <pre>
    <p>Please enter Search Details:</p>
    <pre>
    
    <div id="ExistingOwnerfieldArea">
    First Name: &nbsp;<input type="text" size="20" id="Firstname" name= "Firstname" Placeholder = " First Name"> 
    Last Name: <input type="text" name= "Lastname" id="Lastname" size="20" Placeholder = "Last Name" > <br>
    <pre>
       <p> or </p> <pre>
    Driving Licence: <input type="text" name= "Driving" id="Driving" Placeholder = "Driving Licence" ><br>
    <pre>
    <pre>
    <pre>
    

    <select name="searhResultsBox" id="searhResultsBox"size="8" width="200">
        <option>text1</option>
        <option>text2</option>
        <option>text3</option>
        <option>text4</option>
        <option>text5</option>
    </select>

    </div>
    </div>
    

  
  </body>


<script>


var currentOwnerId = "";
var currentVehicleId = "";

var currentOwnerName = "";
var currentVehicleName = "";


var vehicleIds = null;
var peopleIds = null;
var fullnames= null;
var vehicleLicences = null;




//This Jquery function only runs when the entire form has loaded, used here for intialisation
$( document ).ready(function() {


    //Register event that runs seachForPerspn function everytime something is typed into the Lastname field
    $("#Lastname").on('change keydown paste input', function(){
        searchForPerson();
    });

     //Register event that runs seachForPerspn function everytime something is typed into the Firstname field
    $("#Firstname").on('change keydown paste input', function(){
        searchForPerson();
    });

    //Register event that runs seachForPerspn function everytime something is typed into the Driving field
    $("#Driving").on('change keydown paste input', function(){
        searchForPerson ();
    });

    //Register event that runs seachForPerspn function everytime something is typed into the VLSearch field
    $("#VLSearch").on('change keydown paste input', function(){
        searchForVehicle ();
    });


    
    //Initialise the Vechicle Options JQuery dialog box
    $('#vehicleOptionsDiv').dialog({
                autoOpen: false,
                width: 700,
            buttons: {
            "OK": function() {
                saveNewVehicle()
            },
            "Cancel": function() { 
                $(this).dialog("close"); 
            }
            }
        });


        //Initialise the Add Existing Vechicle Options JQuery dialog box
        $('#addExistingVechicleDialogDiv').dialog({
                autoOpen: false,
                width: 700,
            buttons: {
            "OK": function() {
                var selectedValue = $('#vehicleSearchResultBox option:selected').val();
                
                if (selectedValue == undefined)
                {
                    alert ("Please select a name from the search results before selecting this option")
                    return
                }


               
               // alert (fullnames[0]);
               



                currentOwnerId = selectedValue;

                
            },
            "Cancel": function() { 
                $(this).dialog("close"); 
            }
            }
        });




    //Initialise the report Dialog  JQuery dialog box
    $('#addReportDialogDiv').dialog({
                autoOpen: false,
                width: 700,
            buttons: {
            "OK": function() {
                saveNewVehicle()
            },
            "Cancel": function() { 
                $(this).dialog("close"); 
            }
            }
        });
    




    //Initialise the Add  Vechicle Options JQuery dialog box
    $('#addVechicleDialog').dialog({
                autoOpen: false,
                width: 700,
            buttons: {
            "OK": function() {
                saveNewVehicle()
            },
            "Cancel": function() { 
                $(this).dialog("close"); 
            }
            }
        });
    

        //Initialise the Add New Owner Dialog JQuery dialog box
        $('#addNewOwnerDialog').dialog({
                autoOpen: false,
                width: 700,
            buttons: {
            "OK": function() {

                if ( $("#Fname").val() == "")
                {
                    alert ("Please enter Firstname before selecting this option")
                    return
                }
                if ( $("#Lname").val() == "")
                {
                    alert ("Please enter Last name before selecting this option")
                    return
                } 
                if ( $("#Address").val() == "")
                {
                    alert ("Please enter Address before selecting this option")
                    return
                }   
                if ( $("#DL").val() == "")
                {
                    alert ("Please enter Driving Licence before selecting this option")
                    return
                }                                               
                saveNewOwner();
                $(this).dialog("close");
            },
            "Cancel": function() { 
                $(this).dialog("close"); 
            }
            }
        });


        //Initialise the Add Existing Owner JQuery dialog box
        $('#addExistingOwnerDialog').dialog({
                autoOpen: false,
                width: 800,
            buttons: {
            "OK": function() {

                                               
                var selectedValue = $('#searhResultsBox option:selected').val();
                
                if (selectedValue == undefined)
                {
                    alert ("Please select a name from the search results before selecting this option")
                    return
                }


                currentOwnerId = selectedValue;

                var selected = $("#searhResultsBox").find(':selected').text();
              
                var splitname = selected.split(" [");

                $("#fieldArea").show();
                $("#OwnerButton").hide();
                $("#ExistingOwnerButton").hide();
                $("#VechicleInfoText").text("Please now enter the vehicle details")
                $("#Ownername").html("<b>Owner:</b> " + splitname[0]);
                $(this).dialog("close");
            },
            "Cancel": function() { 
                $(this).dialog("close"); 
            }
            }
        });


        
        populateOffenceDropDown ();


});


//Used to populated the Offence Dropdown list my making a Ajax Call to the PHP page OffenceForAjax
//Which the list from the MySQL Offence tablel
function populateOffenceDropDown ()
{

    //Clear the contents of the Offence dropdown
    $('#OffenceSelect > option').remove();
   
    $.ajax({
        method: 'get',
        url: 'offenceForAjax.php',
        data: {
            "Offence": "Offence",
            
        },
        success: function(result) {
           
            var jsonResult = $.parseJSON(result);
            

        

            if (jsonResult.Success)
            {

               
                //Pooulate dropdown with list retrieved from database
                for (i=0;i<=jsonResult.Names.length;i++)
                {
                 
                    $('#OffenceSelect').append($('<option></option>').val(jsonResult.Ids[i]).text(jsonResult.Names[i])); 
                }

               
            }
                
            else
            {
                //alert ("A problem Occurred while creating an Owner")
            }
                
            

        }
    });



}






//Open Vehicle options dialog bpx
function vehicleOptionsDialog ()
{

   $('#vehicleOptionsDiv').dialog('open');

     

}


//Open Report Dialog box and clear fields
function  addReportDialog ()
{

   $('#addReportDialogDiv').dialog('open');
   $("#Fname").val("")
   $("#Lname").val("")
   $("#DL").val("")
    
   $("#VL").val("")
   $("#VT").val("")
   $("#VC").val("")

   $("#fieldArea").hide();
     

}

//Open the Vechicle Dialog box and clear fields
function addVehicleDialog ()
{

   $('#addVechicleDialog').dialog('open');
   $("#Fname").val("")
   $("#Lname").val("")
   $("#DL").val("")
    
   $("#VL").val("")
   $("#VT").val("")
   $("#VC").val("")

   $("#fieldArea").hide();
     

}


//Open Existing Vehicle Dialog box
function addExistingVehicleDialog ()
{

   $('#addExistingVechicleDialogDiv').dialog('open');

   $("#VLSearch").val("")
   $('#vehicleSearchResultBox > option').remove();
    

}




//Add new Owener Dialog box
function addNewOwnerDialog ()
{

   $('#addNewOwnerDialog').dialog('open');

   $("#Fname").val("")
   $("#Lname").val("")
   $("#Address").val("")
   $("#DL").val("")
    

}


//`op` Existing Owner Dialogbox
function addExistingOwnerDialog ()
{

   $('#addExistingOwnerDialog').dialog('open');

   $("#Firstname").val("")
   $("#Lastname").val("")
   $("#Driving").val("")

    //Clear search resultion option box
   $('#searhResultsBox > option').remove();
    

}


//Save Vehicle Details to MySQL database using Ajax
function saveNewVehicle ()
{



    $.ajax({
        method: 'get',
        url: 'AddVehicle.php',
        data: {
            "Vlicence": $("#VL").val(),
            "Vtype": $("#VT").val(),
            "Vcolour" : $("#VC").val(),   
            "PeopleID" : currentOwnerId   
            
        },
        success: function(result) {
           
            var jsonResult = $.parseJSON(result);
            //currentOwnerId = jsonResult.Id;

            if (jsonResult.Success)
            {
                alert ("You have Successfully Created a Vehicle");

            }
                
            else
            {
                alert ("A problem Occurred while creating a Vehicle")
            }
                
            $("#addVechicleDialog").dialog("close"); 

        }
    });



}


//This function usses Ajax to search the MySQL person table based on the contents of the Fname, Lname and DL fields
function searchForPerson ()
{

    $('#searhResultsBox > option').remove();
   
    $.ajax({
        method: 'get',
        url: 'selectOwner.php',
        data: {
            "Fname": $("#Firstname").val(),
            "Lname": $("#Lastname").val(),
            "DL" : $("#Driving").val(),
            
        },
        success: function(result) {
           
            var jsonResult = $.parseJSON(result);
            

        

            if (jsonResult.Success)
            {

               
                for (i=0;i<=jsonResult.Names.length;i++)
                {
                    $('#searhResultsBox').append($('<option>').text(jsonResult.Names[i]).val(jsonResult.Ids[i]));
                }

               
               // $("#fieldArea").show();
               // $("#OwnerButton").hide();
               // $("#ExistingOwnerButton").hide();
               // $("#Ownername").html("<b>Owner:</b> " + $("#Fname").val() + " " +$("#Lname").val());
            }
                
            else
            {
                //alert ("A problem Occurred while creating an Owner")
            }
                
            $("#addNewOwnerDialog").dialog("close"); 

        }
    });



}

//Saves owner details to MySQL using Ajax
function saveNewOwner ()
{

    $.ajax({
        method: 'get',
        url: 'addOwner.php',
        data: {
            "Fname": $("#Fname").val(),
            "Lname": $("#Lname").val(),
            "Address" : $("#Address").val(),
            "DL" :  $("#DL").val()
            
        },
        success: function(result) {
           
            var jsonResult = $.parseJSON(result);
            currentOwnerId = jsonResult.Id;

            if (jsonResult.Success)
            {
                alert ("You have Successfully Created an Owner");
                $("#fieldArea").show();
                $("#OwnerButton").hide();
                $("#ExistingOwnerButton").hide();
                $("#Ownername").html("<b>Owner:</b> " + $("#Fname").val() + " " +$("#Lname").val());
            }
                
            else
            {
                alert ("A problem Occurred while creating an Owner")
            }
                
            $("#addNewOwnerDialog").dialog("close"); 

        }
    });



}


//Search for Vehicle Details using Ajax
function searchForVehicle ()
{

   

    $('#vehicleSearchResultBox > option').remove();
   
    $.ajax({
        method: 'get',
        url: 'searchVehicleForAjax.php',
        data: {
            "VL": $("#VLSearch").val()
            
        },
        success: function(result) {
           
            var jsonResult = $.parseJSON(result);
            

        

            if (jsonResult.Success)
            {

                for (i=0;i<jsonResult.Names.length;i++)
                {
                    $('#vehicleSearchResultBox').append($('<option>').text(jsonResult.Names[i]).val(i));
                }

                vehicleIds = jsonResult.Vehicles;
                peopleIds = jsonResult.People;
                fullnames= jsonResult.FullNames;
                vehicleLicences = jsonResult.VehicleLicences;
            }
                
            else
            {
                //alert ("A problem Occurred while creating an Owner")
            }
                
           // $("#addNewOwnerDialog").dialog("close"); 

        }
    });



}


 function selectOwner ()
 {

 }

 function selectVehicle()
 {

 }






</script>
</html>

