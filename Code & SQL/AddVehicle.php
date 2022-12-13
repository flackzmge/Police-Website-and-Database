
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
    

  
      
       
      //Get parameter values from Ajax call
      $Vlicence = $_GET['Vlicence'];
      $Vtype = $_GET['Vtype'];
      $Vcolour = $_GET['Vcolour'];
      $PeopleID = $_GET['PeopleID'];
      
     
      




      
      
        $result  = $mysqli -> query("SELECT AddNewVehicle('$Vlicence','$Vtype','$Vcolour','$PeopleID')");
     
        $row = $result -> fetch_row() ;
       

      
    
      $mysqli -> close();

    
    
      $Success = true;
      $id = $row[0];



      if ($id  == 0)
      {
        $Success = false;
      }
    

   
        //Build class which returns search result to complete Ajax call
        $returnresult = new stdClass();
        $returnresult->Success = $Success;
        $returnresult->Id= $id;
        echo json_encode($returnresult);

      




    ?>
      
    










 