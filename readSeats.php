
<?php
/**
 * Created by PhpStorm.
 * User: Patur
 * Date: 08-Mar-18
 * Time: 10:38
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "havnarbio";


$conn = new mysqli($servername, $username, $password, $dbname);


if($conn->connect_error){
    die("Connection failed: " .$conn->connect_error);
}
$sql = "SELECT * FROM ticket where State=1";
$result = $conn->query($sql);
$tickets = array();

$index = 0;

while($row = mysqli_fetch_assoc($result)){ // loop to store the data in an associative array.
    $tickets[$index] = $row;
    $index++;
}

header('Content-Type: application/json');
echo json_encode($tickets);