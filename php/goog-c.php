<?php

header('Content-Type: application/json');
include('db.php');
//"SELECT * FROM glav WHERE dat BETWEEN '".$_POST['start_date']." 00:00:00' AND '".$_POST['end_date']." 23:59:59'";
/* check connection */ 
if (!$link) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if ($result = mysqli_query($link, "SELECT * FROM dozator2 WHERE dateStart BETWEEN '".$_GET['dateFrom']."' AND '".$_GET['dateTo']."'")) {
   $sub_array = array();
   while( $row = mysqli_fetch_assoc( $result ) ) { 
      $dt   = new DateTime($row['dateStart']);
      array_push($sub_array, [date_timestamp_get($dt) * 1000, (float) $row['number']]);
   }
   $userData = $sub_array;
        $data = $userData;
       echo json_encode($data);

   /* очищаем результирующий набор */
   mysqli_free_result($result);
}

/* close connection */
mysqli_close($link);
// $result = mysqli_query($link, "SELECT * FROM Report WHERE dateStart BETWEEN '".$_GET['dateFrom']."' AND '".$_GET['dateTo']."'")
?>

