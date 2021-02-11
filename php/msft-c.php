<?php



header('Content-Type: application/json');
$link = mysqli_connect("localhost", "root", "root", "rep");
//"SELECT * FROM glav WHERE dat BETWEEN '".$_POST['start_date']." 00:00:00' AND '".$_POST['end_date']." 23:59:59'";
/* check connection */ 
if (!$link) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if ($result = mysqli_query($link, "SELECT * FROM Report")) {
   $sub_array = array();
   while( $row = mysqli_fetch_assoc( $result ) ) { 
      $dt   = new DateTime($row['dateStart']);
      array_push($sub_array, [date_timestamp_get($dt) * 1000, (float) $row['dosatorSum1']]);
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





// $link = mysqli_connect("localhost", "root", "root", "rep");
// //"SELECT * FROM glav WHERE dat BETWEEN '".$_POST['start_date']." 00:00:00' AND '".$_POST['end_date']." 23:59:59'";
// /* check connection */ 
// if (!$link) {
//     printf("Connect failed: %s\n", mysqli_connect_error());
//     exit();
// }
// if ($result = mysqli_query($link, "SELECT * FROM Report WHERE dateStart BETWEEN '".$_POST['dateFrom']."' AND '".$_POST['dateTo']."'")) {
//    $sub_array = array();
//    while( $row = mysqli_fetch_assoc( $result ) ) { 
//       array_push($sub_array, [$row['dateStart'], (float) $row['dosatorSum1']]);
//    }
//    $userData = $sub_array;
//         $data['status'] = 'ok';
//         $data['result'] = $userData;
//         echo json_encode($data, JSON_UNESCAPED_UNICODE);
//    /* очищаем результирующий набор */
//    mysqli_free_result($result);
// }
// /* close connection */
// mysqli_close($link);
?>