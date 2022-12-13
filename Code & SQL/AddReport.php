<!DOCTYPE html>

<html>

  <head>
      <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
    <title>Add Vehicle Page</title>
  
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
       
    </style>
    
    
  </head>

  <body>
    <h1>Add Report Page</h1>
    
    
    
    
    
    
           
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



    <button type="button" onclick="addReportDialog()">Add Report</button> 

    <div id="addReportDialogDiv" title="Add Report" style="display: none;">
    <br/>
    <p>Please select an option.</p>
    <br> 
    <button type="button" id="EditIncidentButton" onclick="addExistingOwnerDialog()">Edit Existing Incident</button> <button type="button" id="OwnerButton" onclick="addNewOwnerDialog()">Add New Incident</button> 
    <div id="fieldArea">
    <div id="Ownername"></div>
    <br>
    <br>
     <b>Vehicle Licence:</b> <input type="text" id="VL" name="VL" required  placeholder = "Vehicle Licence"
       minlength="2"  size="30">       
    <br>
    <br>
    <b>Vehicle Type:</b> <input type="text" id="VT" name="VT" required  placeholder = "Vehicle Type"
       minlength="2"  size="30">  
    <br>
    <br>
    <b>Vehicle Colour:</b> <input type="text" id="VC" name="VC" required  placeholder = "Vehicle Colour"
       minlength="2"  size="30">    
    </div>
    </div>





    <div id="xxxxxxxxaddReportDialogDiv" title="Add Report" style="display: none;">
    <br/>
    <p>Add new vehicle details, please first select an existing owner or add new vechicle owner.</p>
    <br> 
    <button type="button" id="xxxxxxxExistingOwnerButton" onclick="addExistingOwnerDialog()">Select Existing Incident</button> <button type="button" id="xxxxxxxxxxxOwnerButton" onclick="addNewOwnerDialog()">Add New Incident</button> 
    <div id="fieldArea">
    <div id="Ownername"></div>
    <br>
    <br>
     <b>Vehicle Licence:</b> <input type="text" id="VL" name="VL" required  placeholder = "Vehicle Licence"
       minlength="2"  size="30">       
    <br>
    <br>
    <b>Vehicle Type:</b> <input type="text" id="VT" name="VT" required  placeholder = "Vehicle Type"
       minlength="2"  size="30">  
    <br>
    <br>
    <b>Vehicle Colour:</b> <input type="text" id="VC" name="VC" required  placeholder = "Vehicle Colour"
       minlength="2"  size="30">    
    </div>
    </div>


    <div id="addNewOwnerDialog" title="Add New Owner" style="display: none;">
    <br/>
    <p>Please enter new Owner Details:</p>
    <br/>
    <div id="NewOwnerfieldArea">
    <b>First Name:</b> <input type="text" id="Fname" name="fname" placeholder = "First Name" required
       minlength="4"  size="30">
    <br>
    <br>
    <b>Last Name:</b> <input type="text" id="Lname" name="lname" required  placeholder = "Last Name"
       minlength="4"  size="30">   
    <br>
    <br>
    <b>Address :</b> <input type="text" id="Address" name="Address" required  placeholder = "Address"
       minlength="4"  size="30">
    <br>
    <br>
    <b>Driving Licence:</b> <input type="text" id="DL" name="DL" required  placeholder = "Driving Licence"
       minlength="4"  size="30">
    <br>
    <br>
     
    </div>
    </div>

    

    <div id="NewOwnerfieldArea">
    <b>Vehicle ID:</b> <input type="text" id="VehicleID" name="VehicleID" placeholder = "Vehicle ID" required
       minlength="4"  size="30">
    <br>
    <br>
    <b>People ID:</b> <input type="text" id="PeopleID" name="PeopleID" required  placeholder = "People ID"
       minlength="4"  size="30">   
    <br>
    <br>
    <b>Incident Date:</b> <input type="text" id="IncidentDate" name="IncidentDate" required  placeholder = "Incident Date"
       minlength="4"  size="30">
    <br>
    <br>
    <b>Incident Report:</b> <input type="text" id="IncidentReport" name="IncidentReport" required  placeholder = "Incident Report"
       minlength="4"  size="30">
    <br>
    <br>
    <b>Offence ID:</b> <input type="text" id="OffenceID" name="OffenceID" required  placeholder = "Offence ID"
       minlength="4"  size="30">
    <br>
    <br>
    </div>
    </div>


    <div id="addExistingOwnerDialog" title="Select Existing Owner" style="display: none;">
    <br/>
    <p>Please enter Search Details:</p>
    <br/>
    
    <div id="ExistingOwnerfieldArea">
    Incident ID: &nbsp;<input type="text" size="20" id="IncidentID" name= "Incident ID" Placeholder = "IncidentID"> 
    <br>
    Offence ID: <input type="text" name= "OffenceID" id="OffenceID" size="20" Placeholder = "Offence ID" > <br>
       <br>
       
    <br>
    

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

// Jquery function used when page is fully loaded, I am using it here for initialisation 


$( document ).ready(function() {


    $("#Lastname").on('change keydown paste input', function(){
        searchForPerson();
    });


    $("#Firstname").on('change keydown paste input', function(){
        searchForPerson();
    });

    $("#Driving").on('change keydown paste input', function(){
        searchForPerson();
    });



    $('#addVechicleDialog').dialog({
                autoOpen: false,
                width: 700,
            buttons: {
            "OK": function() {
                alert ("ok")
            },
            "Cancel": function() { 
                $(this).dialog("close"); 
            }
            }
        });
    


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
                $("#Ownername").html("<b>Owner:</b> " + splitname[0]);

                $(this).dialog("close");
            },
            "Cancel": function() { 
                $(this).dialog("close"); 
            }
            }
        });


        



});






function addVehicleDialog ()
{

   $('#addVechicleDialog').dialog('open');
   $("#Fname").val("")
   $("#Lname").val("")
   $("#DL").val("")
    

   $("#fieldArea").hide();
     

}



function addNewOwnerDialog ()
{

   $('#addNewOwnerDialog').dialog('open');

   $("#Fname").val("")
   $("#Lname").val("")
   $("#Address").val("")
   $("#DL").val("")
    

}


function addExistingOwnerDialog ()
{

   $('#addExistingOwnerDialog').dialog('open');

   $("#Firstname").val("")
   $("#Lastname").val("")
   $("#Driving").val("")

   $('#searhResultsBox > option').remove();
    

}



function saveNewOwner ()
{

    $.ajax({
        method: 'get',
        url: 'createIncident.php',
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



function searchForPerson ()
{

    $('#searhResultsBox > option').remove();
   
    $.ajax({
        method: 'get',
        url: 'selectIncident.php',
        data: {
            "Incident ID": $("#IncidentID").val(),
            "Offence ID": $("#OffenceID").val(),
            
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




 
</script>
</html>

