
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
    

  
      
       
      //Get Offence paramter value from Ajax call
      $VL= $_GET['Offence'];



      
        //Get full list of Offences
        $result  = $mysqli -> query("select * from Offence");
      

        $NumRows = $result -> num_rows;
        $Idrows = array();
        $NameRows = array();
        
        //Read each return row and populate array
        while($row = $result -> fetch_row() ) 
          
        { 
         

          $Idrows[] = $row[0];
          $NameRows[] = $row[1];
            

 
        }


      
        
        



    
    
      $mysqli -> close();

    
    
      $Success = true;
      $id = $row[0];



      if ($NumRows  < 1)
      {
        $Success = false;
      }
    


        //Build class f used to return results to complete Ajax call

        $returnresult = new stdClass();
        $returnresult->Success = $Success;
        $returnresult->Ids= $Idrows;
        $returnresult->Names= $NameRows;
        echo json_encode($returnresult);

      




    ?>
      
    










 