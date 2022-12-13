
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
    

  
      
       
      //Get VL parameter value from Ajax call
      $VL= $_GET['VL'];




      
        $result  = $mysqli -> query("CALL sp_VehicleSearch('$VL')");
       
       

        $NumRows = $result -> num_rows;
        $Idrows = array();
        $NameRows = array();
        $PeopleRows = array();
        $Vehicles = array();
        $FullNames = array();
        $VehicleLicences = array();
        
        $index = 0;

        //Populate Arrays with search results
        while($row = $result -> fetch_row() ) 
          
        { 
         
          
          //$row = $result -> fetch_row() ;
          //$row = mysqli_fetch_array($result);


          $Idrows[] = $index;
          $NameRows[] = $row[1] . ' - ' . $row[2] .' - '. $row[3] .' - '. $row[7] .' '. $row[8];
          $PeopleRows[] = $row[4];
          $Vehicles[] = $row[0];
          $FullNames[] = $row[7] .' '. $row[8];
          $VehicleLicences[] = $row[3];
          $index = $index + 1;

            

          
          
          
          
      
        }


       // $rowcount = $result -> num_rows;
        
        



       
     

      // Frees result memory
      //$result -> free_result(
      
    
      $mysqli -> close();

    
    
      $Success = true;
      $id = $row[0];



      if ($NumRows  < 1)
      {
        $Success = false;
      }
    


      
        //Build class with return values returned to complete Ajax call
        $returnresult = new stdClass();
        $returnresult->Success = $Success;
        $returnresult->Ids= $Idrows;
        $returnresult->Names= $NameRows;
        $returnresult->People= $PeopleRows;
        $returnresult->Vehicles= $Vehicles;
        $returnresult->Fullnames= $FullNames;
        $returnresult->VehicleLicences= $VehicleLicences;
        //$returnresult->People= $NameRows;
        echo json_encode($returnresult);

      




    ?>
      
    










 