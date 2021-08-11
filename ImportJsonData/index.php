<?php

include_once("Dbconnection.php");
$db=new Dbconnection();
include_once("ParticipationClass.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <h1>Event Booking -Code challenge </h1>
  <link rel="stylesheet" href="style.css">
</head><!-- comment -->
 
<?php

 $participant = new ParticipationClass();

 //Read json file and Decode to array
 $jsondata = file_get_contents('CodeChallenge.json');
 $jsonFileData = json_decode($jsondata, true);
  
 //Inserting Jsonfile Data to Database
 $praticipantDetails = $participant->StoreParticipantData($jsonFileData);
 $getAllParticipantRecords = array();

 
 $totalFee = 0;
 $search_inputName = filter_input(INPUT_GET, 'inputName');
 $search_EventName = filter_input(INPUT_GET, 'inputEventName');
 $search_Date = filter_input(INPUT_GET, 'inputEventDate');
 
 //retrieving Data from Database
 if(isset($search_inputName) != ''){
    $getAllEmployeeName = $participant->getEmployeeData('');
    $getAllEvntNameAndDate = $participant->getEventData('');
    $getAllParticipantRecords = $participant->getParticipantData($search_inputName,'EmpName');
   
 }else if(isset($search_EventName)!= ''){
      $getAllEmployeeName = $participant->getEmployeeData('');
      $getAllEvntNameAndDate = $participant->getEventData('');
      $getAllParticipantRecords = $participant->getParticipantData($search_EventName,'EvntName');
 }else if(isset($search_Date)!= ''){
      $getAllEvntNameAndDate = $participant->getEventData('');
      $getAllParticipantRecords = $participant->getParticipantData($search_Date,'EvntDate');
      $getAllEmployeeName = $participant->getEmployeeData('');
 }else{
    $search_html = "";
    $getAllParticipantRecords = $participant->getParticipantData('','');
    $getAllEmployeeName = $participant->getEmployeeData($search_html);
    $getAllEvntNameAndDate = $participant->getEventData($search_html);
 }
     ?> 

      <table id="myTable">
	  <tr>
              <th>Name 
                  <select type="dropdown" id="empName" placeholder="Serach" onchange="filterByName();">
                      <option>Select Emp Name</option>
                      <?php foreach ($getAllEmployeeName as $row){ 
                          ?>
                      <option id="<?php echo $row['employeeId'] ?>" value="<?php echo $row['employee_name'] ?>"> <?php echo $row['employee_name'] ?></option> 
                      <?php } ?></select> </th>
	     <th>Event Name 
                    <select type="dropdown" id="evntName" placeholder="Serach" onchange="filterByEvntName();">
                       <option>Select Event Name</option>
                        <?php foreach ($getAllEvntNameAndDate as $row){ 
                          ?>
                      <option id="<?php echo $row['eventId'] ?>" value="<?php echo $row['eventName'] ?>"> <?php echo $row['eventName'] ?></option> 
                     <?php } ?></select> </th>
             </th>
	     <th>Event Date
                   <select type="dropdown" id="eventDate" placeholder="Serach" onchange="filterByEvntDate();">
                       <option>Select Event Date</option>
                       <?php foreach ($getAllEvntNameAndDate as $row){ 
                           ?>
                      <option id="<?php echo $row['eventId'] ?>" value="<?php echo $row['eventDate'] ?>"> <?php echo $row['eventDate'] ?></option> 
                    <?php } ?></select> </th>
             </th>
             <th>Version</th>
             <th>Fees<i class="fas fa-sort<?php echo $column == 'participation_fee' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                       
         </tr>
                <?php for($i=0 ; $i < sizeof($getAllParticipantRecords); $i++) { 
                    $totalFee += $getAllParticipantRecords[$i]['eventFee'];
                    ?>
                <tr>
                    <td><?php echo $getAllParticipantRecords[$i]['employee_name']; ?></td>
                    <td><?php echo $getAllParticipantRecords[$i]['eventName']; ?></td>
                    <td><?php echo $getAllParticipantRecords[$i]['eventDate']; ?></td>
                    <td><?php echo $getAllParticipantRecords[$i]['version']; ?></td>
                    <td><?php echo $getAllParticipantRecords[$i]['eventFee']; ?></td>
                       
                </tr> 
                <?php  } ?>
       <tr><td>Total Fees Amount</td><td></td><td></td><td></td><td><?php  echo $totalFee; ?></td></tr>
</table> 
    </body>
<script>
    function filterByName(){
       var input = document.getElementById("empName").value;
       window.location.href = '/ImportJsonData/index.php?inputName=' + input;
    }
    function filterByEvntName(){
       var input = document.getElementById("evntName").value;
        window.location.href = '/ImportJsonData/index.php?inputEventName=' + input;
    }
    function filterByEvntDate(){
       var input = document.getElementById("eventDate").value;
       window.location.href = '/ImportJsonData/index.php?inputEventDate=' + input;
    }
  

</script>  
