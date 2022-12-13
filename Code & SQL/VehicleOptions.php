<!DOCTYPE html>

<html>
<?php session_start()   ?>
  <head>
      <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
    <title>Add Vehicle Page</title>
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
    

    
       
 
      
        
      




    ?>
      
    <br/>



    <button type="button" onclick="addVehicleDialog()">Add Vehicle</button> 

    </div>
      </section>
    </main>
    <div class="circle1"></div>
    <div class="circle2"></div>
    
    <div id="addVechicleDialog" title="Add Vehicle" style="display: none;">
    <br/>
    <p id="VechicleInfoText">Add new vehicle details, please first select an existing owner or add new vechicle owner.</p>
    <br>
    

    

    
    <button type="button" id="ExistingOwnerButton" onclick="addExistingOwnerDialog()">Select Existing Owner</button> <button type="button" id="OwnerButton" onclick="addNewOwnerDialog()">Add New Owner</button> 
    <div id="fieldArea">
    <div id="Ownername"></div>
    <pre>
     <b>Vehicle Licence:</b> <input type="text" id="VL" name="VL" required  placeholder = "Vehicle Licence"
       minlength="2"  size="30">       
       <pre>
    <b>Vehicle Type:</b> <input type="text" id="VT" name="VT" required  placeholder = "Vehicle Type"
       minlength="2"  size="30">  
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
    <b>Last Name:</b> <input type="text" id="Lname" name="lname" required  placeholder = "Last Name"
       minlength="4"  size="30">   
       <pre>
    <b>Address :</b> <input type="text" id="Address" name="Address" required  placeholder = "Address"
       minlength="4"  size="30">
       <pre>
    <b>Driving Licence:</b> <input type="text" id="DL" name="DL" required  placeholder = "Driving Licence"
       minlength="4"  size="30">
    <br>
    <br>
     
    </div>
    </div>


    <div id="addExistingOwnerDialog" title="Select Existing Owner" style="display: none;">
    <pre>
    <p>Please enter Search Details:</p>
    <br/>
    
    <div id="ExistingOwnerfieldArea">
    First Name: &nbsp;<input type="text" size="20" id="Firstname" name= "Firstname" Placeholder = " First Name"> 
    Last Name: <input type="text" name= "Lastname" id="Lastname" size="20" Placeholder = "Last Name" > <br>
    <pre>
       <p> or </p><pre>
    Driving Licence: <input type="text" name= "Driving" id="Driving" Placeholder = "Driving Licence" ><br>
       <br>
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
        searchForPerson();
    });

    //Initial Add Report Dialog box
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
    


    //Initialise Add Vehicle Dialog box
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
    

        //Initialise Add Owner Dialog box
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
                saveNewOwner(); //Call function which sends field values to MySQL via Ajax call 
                $(this).dialog("close");
            },
            "Cancel": function() { 
                $(this).dialog("close"); 
            }
            }
        });


        //Initialise Add Existing Owner Dialog box
        $('#addExistingOwnerDialog').dialog({
                autoOpen: false,
                width: 800,
            buttons: {
            "OK": function() {

                //Get value selected from option box                            
                var selectedValue = $('#searhResultsBox option:selected').val();
                
                //Validate for no option selecte
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


        



});





//Display Add Report Dialog box
function addReportDialog ()
{

   $('#addVechicleDialog').dialog('open');
   $("#IncidentDate").val("")
   $("#IncidentReport").val("")
 

   //$("#fieldArea").hide();
     

}

//Display Add Vehichle Dialog box
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


//Display  Add new Owner Dialog box
function addNewOwnerDialog ()
{

   $('#addNewOwnerDialog').dialog('open');

   $("#Fname").val("")
   $("#Lname").val("")
   $("#Address").val("")
   $("#DL").val("")
    

}


//Display add Existing Owner Dialog box
function addExistingOwnerDialog ()
{

   $('#addExistingOwnerDialog').dialog('open');

   $("#Firstname").val("")
   $("#Lastname").val("")
   $("#Driving").val("")

   $('#searhResultsBox > option').remove();
    

}


//Save Vehicle details from Dialog box to MySQL Vehicle table using Ajax call
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

    

 
</script>
</html>

