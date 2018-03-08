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

    $seats = json_decode($_POST["seats"]);
    mysqli_autocommit($database, false);
    mysqli_begin_transaction($database, MYSQLI_TRANS_START_READ_WRITE);
    /*$syning = 1; //Get sýning id from server
    $available = 1; //Get int from server
    foreach ($seats as $seat_id) {
        $statement = "UPDATE ticket SET State=1 WHERE Seat =1";
        if (!($result = mysqli_query($database, $statement))) {
            mysqli_rollback($database);
            mysqli_close($database);
            http_response_code(500);
            return;
        }
    }
    mysqli_commit($database);
    mysqli_close($database);
    http_response_code(200);*/
    foreach ($seats as $seat_id) {
        // Prepare an update statement
        $sql = "UPDATE ticket SET syning_id=?, State=? WHERE id=?";

        if ($stmt = mysqli_prepare($database, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iii", $param_syning_id, $param_seat, $param_state);

            // Set parameters
            $param_syning_id = 1;
            $param_seat = $seat_id;
            $param_state = 1;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                echo "sucess";
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
    echo "done";
} else {
    http_response_code(400);//Bad request
}




?>