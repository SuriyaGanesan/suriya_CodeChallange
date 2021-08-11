
<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'eventbooking');
Class Dbconnection {
      public $con;  
      public $error;  
      public function __construct()  
      {  
           $this->con = mysqli_connect("localhost", "root", "", "eventbooking");  
           if(!$this->con)  
           {  
                echo 'Database Connection Error ' . mysqli_connect_error($this->con);  
           } 
         
      }  
      
      //Employee Name display in grid with filters
     public function getAllEmployeeName($search_html) {
            if($search_html == ''){
               $sqlSelect = "SELECT employeeId,employee_name FROM tbl_employee ";
            }else{
               $sqlSelect = "SELECT employeeId,employee_name FROM tbl_employee WHERE employee_name LIKE '".$search_html."%'";
            }
            $query = mysqli_query($this->con, $sqlSelect);
            while($row = $query -> fetch_array(MYSQLI_ASSOC)){
             if(!empty($row)){
                $returnValue[] = $row;
              }
            }
             return $returnValue;   
        }
        
         //Select query for getting Event Name & Date Filters
        public function getAllEvntNameAndDate($search_html) {
            echo $search_html;
            if($search_html == ''){
                $sqlSelect = "SELECT eventId,eventName,eventDate FROM tbl_event ";
            }else{
                $sqlSelect = "SELECT eventId,eventName,eventDate FROM tbl_event  WHERE eventName = '".$search_html."' OR eventDate =  '".$search_html."'";
            }
            $query = mysqli_query($this->con, $sqlSelect);
             while($row = $query -> fetch_array(MYSQLI_ASSOC)){
             if(!empty($row)){
                $returnValue[] = $row;
              }
            }
           return $returnValue;   
        }

        //Insert query  
    public function insertEmployeeDetails($jsonFileData) {
        
        $sqlSelect = "SELECT * FROM tbl_employee where employee_name = '".$jsonFileData['employee_name']."' AND employee_mail = '".$jsonFileData['employee_mail']."' ";
        $query = mysqli_query($this->con,$sqlSelect);
        $result =  mysqli_fetch_array($query);
        
        if(empty($result)){
            $sql = "INSERT INTO tbl_employee(employee_name, employee_mail)
                    VALUES('".$jsonFileData['employee_name']."', '".$jsonFileData['employee_mail']."')";
            $query = mysqli_query($this->con, $sql);
            return $result =  mysqli_fetch_array($query);
        }
    }
    
     public function insertEventDetails($jsonFileData) {
        
        $sqlSelect = "SELECT * FROM tbl_event where eventId = '".$jsonFileData['event_id']."' ";
        $query = mysqli_query($this->con,$sqlSelect);
        $result =  mysqli_fetch_array($query);
      
        if(!isset($result)){
            $sql = "INSERT INTO tbl_event(eventId,eventName,eventDate,Fee,version)
                    VALUES('".$jsonFileData['event_id']."', '".$jsonFileData['event_name']."', '".$jsonFileData['event_date']."','".$jsonFileData['participation_fee']."','".$jsonFileData['version']."')";
            $query = mysqli_query($this->con, $sql);
            return $result =  mysqli_fetch_array($query);
        }
    }
    
     public function insertParticipantDetails($jsonFileData) {
        
        $sqlSelect = "SELECT * FROM tbl_employee where employee_name = '".$jsonFileData['employee_name']."'";
        $query = mysqli_query($this->con,$sqlSelect);
        $result =  mysqli_fetch_array($query);
       
        if(isset($result)){
                $sql1 = "Select * from tbl_participants where participantId = '".$jsonFileData['participation_id']."'";
                $chkDuplicateRecord = mysqli_query($this->con,$sql1);
                $resultRecords = mysqli_fetch_array($chkDuplicateRecord);
                
                if(!isset($resultRecords)){    
                        $sql = "INSERT INTO tbl_participants(participantId,employeeId,eventId,eventFee)
                    VALUES('".$jsonFileData['participation_id']."', '".$result['employeeId']."', '".$jsonFileData['event_id']."','".$jsonFileData['participation_fee']."')";
                $query = mysqli_query($this->con, $sql);
                return $result =  mysqli_fetch_array($query);
                    }
         }
    }
    
    //Getting all records from participants
     public function getAllPartcipantDetailsModel($SearchData,$searchTag) {
        
         $returnValue = array();
         $totalFeeprice = 0;
         if($SearchData == ''){
             
            $sqlSelect = "SELECT * FROM tbl_participants INNER JOIN tbl_employee ON tbl_employee.employeeId = tbl_participants.employeeId  INNER JOIN tbl_event ON tbl_event.eventId = tbl_participants.eventId ";
            $query = mysqli_query($this->con, $sqlSelect);
            while($row = $query -> fetch_array(MYSQLI_ASSOC)){
                if(!empty($row)){
                  $totalFeeprice += $row['eventFee'];
                   $returnValue[] = $row;
                }
            }
               return $returnValue; 
            }
         else {
             if($searchTag == 'EmpName'){
                 
               $sqlSelect = "SELECT * FROM tbl_participants INNER JOIN tbl_employee ON tbl_employee.employeeId = tbl_participants.employeeId  INNER JOIN tbl_event ON tbl_event.eventId = tbl_participants.eventId WHERE employee_name LIKE '%".$SearchData."%'";
               $query = mysqli_query($this->con, $sqlSelect);
              
             }else if($searchTag == 'EvntName') {
                $sqlSelect = "SELECT * FROM tbl_participants INNER JOIN tbl_employee ON tbl_employee.employeeId = tbl_participants.employeeId  INNER JOIN tbl_event ON tbl_event.eventId = tbl_participants.eventId where eventName LIKE '".$SearchData."%'";
                $query = mysqli_query($this->con, $sqlSelect);
               
             }else if($searchTag == 'EvntDate') {
                $sqlSelect = "SELECT * FROM tbl_participants INNER JOIN tbl_employee ON tbl_employee.employeeId = tbl_participants.employeeId  INNER JOIN tbl_event ON tbl_event.eventId = tbl_participants.eventId where eventDate LIKE '".$SearchData."%'";
                $query = mysqli_query($this->con, $sqlSelect);
               
             }else if($searchTag == ''){
                $sqlSelect = "SELECT * FROM tbl_participants INNER JOIN tbl_employee ON tbl_employee.employeeId = tbl_participants.employeeId  INNER JOIN tbl_event ON tbl_event.eventId = tbl_participants.eventId where eventDate LIKE '".$SearchData."%'";
                $query = mysqli_query($this->con, $sqlSelect);
                }
              
               while($row = $query -> fetch_array(MYSQLI_ASSOC)){
                if(!empty($row)){
                   $totalFeeprice += $row['eventFee'];
                   $returnValue[] = $row;
               }
            }
              return $returnValue; 
         }
     }
 }
 
 ?>