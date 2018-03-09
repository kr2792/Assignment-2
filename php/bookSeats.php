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

//Checking if the post is empty
if (!empty($_POST["seats"])) {
    //Attempt to connect to MySQL database
    if (!($database = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME))) {
        http_response_code(500); //Send error code
        return;
    }
        //Attempting to select the database
    if (!mysqli_select_db($database, "havnarbio")) {
        http_response_code(500); //SEnd error code if unsuccesfull
        return;
    }

    //Getting the array into a new array
    $seats = $_POST["seats"];
    mysqli_autocommit($database, false); //Making auto commit false
    $syning = 1;
    $available = 1;
    //Updating each seat in the array
    foreach ($seats as $seat_id) {
        $statement = "UPDATE ticket SET State=1 WHERE Seat=".$seat_id;
        //Checking if the query is succesfull
        if (!($result = mysqli_query($database, $statement))) {
            //If the query fails, rollback, close the connection and send error code
            mysqli_rollback($database);
            mysqli_close($database);
            http_response_code(500);
            return;
        }
    }
    mysqli_commit($database); //Commit the database
    mysqli_close($database); //Close the database
    http_response_code(200); //Sending a success code.
} else {
    http_response_code(400);//Bad request
}
?>