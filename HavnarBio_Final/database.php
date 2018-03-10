<?php
//connection to the database
$db = mysqli_connect('localhost','root','','havnarbio')
or die('Error connecting to MySQL server.');
//select a database to work with
if($db->connect_error) {
    die("Connection failed..." . $db->connect_error);
} else {
    //echo "connected";
}

// if data is found
if(isset($_GET['id']) && isset($_GET['id']) != ''){
    $id = $_GET['id'];

    // select variables from database, based on id
    $sql = "SELECT name, information, trailer, prod FROM filmur WHERE ID = ".$id;
    if($result = mysqli_query($db, $sql)){
        $returns = [];

        // add information to array
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $returns = $row;
            }
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }

        // encode to jason and echo back.
        header('Content-type:application/json');
        echo json_encode($returns);
    }
}
?>