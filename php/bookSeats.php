<?php
/**
 * Created by PhpStorm.
 * User: patur
 * Date: 3/7/2018
 * Time: 8:57 PM
 */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'havnarbio');

$tempSeat ="";

if (!empty($_POST["seats"])) {
    //Attempt to connect to MySQL database
    if (!($database = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME))) {
        http_response_code(500);
        return;
    }

    if (!mysqli_select_db($database, "havnarbio")) {
        http_response_code(500);
        return;
    }


    $seats = $_POST["seats"];
    mysqli_autocommit($database, false);
    //mysqli_begin_transaction($database, MYSQLI_TRANS_START_READ_WRITE);
    $syning = 1; //Get sýning id from server
    $available = 1; //Get int from server
    foreach ($seats as $seat_id) {
        $statement = "UPDATE ticket SET State=1 WHERE Seat=".$seat_id;
        if (!($result = mysqli_query($database, $statement))) {
            mysqli_rollback($database);
            mysqli_close($database);
            http_response_code(500);
            return;
        }
    }
    mysqli_commit($database);
    mysqli_close($database);
    http_response_code(200);
} else {
    http_response_code(400);//Bad request
}
?>