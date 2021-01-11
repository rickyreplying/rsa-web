<?php
include_once("config.php");

$namabooking = $_POST['namabooking'];
$teleponbooking = $_POST['teleponbooking'];
$tanggalbooking= $_POST['tanggalbooking'];
$jambooking= $_POST['jambooking'];
$noRangka = $_POST['noRangka'];

$sql1 = "INSERT INTO booking (namaBooking, noTelponBooking, tglBooking, jamBooking, noRangka) 
VALUES ('$namabooking', '$teleponbooking', '$tanggalbooking', '$jambooking', '$noRangka')";
if (mysqli_query($conn, $sql1)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
mysqli_close($conn);
?>


