
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
    

  
      
       
 
      $Firstname = $_GET['Fname'];
      $Lastname = $_GET['Lname'];
      $DL = $_GET['DL'];
     




      
      
        $result  = $mysqli -> query("CALL sp_CheckNameCheckDLSearch('$Firstname','$Lastname', '$DL')");
        //echo "Returned rows are: " . $result -> num_rows;
        //echo "Returned rows are: " . $result2 -> num_rows;
        //$row = $result -> fetch_row() ;
       

        $NumRows = $result -> num_rows;
        $Idrows = array();
        $NameRows = array();
        
        while($row = $result -> fetch_row() ) 
          
        { 
         
          
          //$row = $result -> fetch_row() ;
          //$row = mysqli_fetch_array($result);


          $Idrows[] = $row[0];
          $NameRows[] = $row[1] . ' ' . $row[2] .' ['. $row[4] . ']';
            

          
          
          
          
      
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
    


      //$Response[] = array('Success' => $Success, 'Id' => $id);
      //echo json_encode($Response);

        $returnresult = new stdClass();
        $returnresult->Success = $Success;
        $returnresult->Ids= $Idrows;
        $returnresult->Names= $NameRows;
        echo json_encode($returnresult);

      




    ?>
      
    










 