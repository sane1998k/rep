<?php


$link = mysqli_connect("localhost", "root", "root", "rep");
//"SELECT * FROM glav WHERE dat BETWEEN '".$_POST['start_date']." 00:00:00' AND '".$_POST['end_date']." 23:59:59'";
/* check connection */ 
if (!$link) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if ($result = mysqli_query($link, "SELECT * FROM Report WHERE dateStart BETWEEN '".$_POST['dateFrom']."' AND '".$_POST['dateTo']."'")) {
   $sub_array = array();
   while( $row = mysqli_fetch_assoc( $result ) ) { 
      array_push($sub_array, [$row['dateStart'], (float) $row['dosatorSum2']]);
   }
   $userData = $sub_array;
        $data['status'] = 'ok';
        $data['result'] = $userData;
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
   /* очищаем результирующий набор */
   mysqli_free_result($result);
}
/* close connection */
mysqli_close($link);
?>