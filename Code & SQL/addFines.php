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
    

  
      
       
 
    $FineAmount = $_GET['FineAmount'];
     $FinePoints = $_GET['FinePoints'];
     $IncidentID = $_GET['IncidentID'];
     




      
      
        $result  = $mysqli -> query("SELECT AddFines('$FineAmount' ,'$FinePoints' ,'$IncidentID')");
        //echo "Returned rows are: " . $result -> num_rows;
        //echo "Returned rows are: " . $result2 -> num_rows;
        $row = $result -> fetch_row() ;
       


       // $rowcount = $result -> num_rows;
        
        




     

      // Frees result memory
      //$result -> free_result(
      
    
      $mysqli -> close();

    
    
      $Success = true;
      $id = $row[0];



      if ($id  <= 0)
      {
        $Success = false;
      }
    


      //$Response[] = array('Success' => $Success, 'Id' => $id);
      //echo json_encode($Response);

        $returnresult = new stdClass();
        $returnresult->Success = $Success;
        $returnresult->Id= $id;
        echo json_encode($returnresult);

      




    ?>
      
    










 