<?php
include_once("Dbconnection.php");


Class ParticipationClass 
{  
    public $obj;  
    public function __construct()  
     { 
        $this->obj =new Dbconnection();
     }
    
    //Inserting Jsonfile  Data
    function StoreParticipantData($data){
        for($i= 0;$i < count($data); $i++){
            $employeeDetails = $this->obj->insertEmployeeDetails($data[$i]);
            $eventDetails = $this->obj->insertEventDetails($data[$i]);
            $participantDetails = $this->obj->insertParticipantDetails($data[$i]);
        }
    }
    
    //Select query Based on Grid Filter
    function getParticipantData($SearchData,$searchTag){
      if($SearchData =='' &&$searchTag == '') {
             $result =  $this->obj->getAllPartcipantDetailsModel('','');
       }else{
            $result =  $this->obj->getAllPartcipantDetailsModel($SearchData,$searchTag);
       }
       return $result;
    }
    
    //Getting Employee Table Details
     function getEmployeeData($search_html){
       $result =  $this->obj->getAllEmployeeName($search_html);
       return $result;
    }
    
    //Getting Event Table Details
    function getEventData($search_html){
       $result =  $this->obj->getAllEvntNameAndDate($search_html);
       return $result;
    }
}