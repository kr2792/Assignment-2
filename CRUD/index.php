<!--
Allan Midjord
index.php
hackerboys
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Movie Details</h2>
                    <a href="create.php" class="btn btn-success pull-right">Add movie</a>
                </div>
                <?php
                // Include config file
                require_once 'config.php';

                // Attempt select query execution
                $sql = "SELECT * FROM filmur";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";

                        echo "<th>Title</th>";
                        echo "<th>Length</th>";
                        echo "<th>Release date</th>";
                        echo "<th>Information</th>";
                        echo "<th>Genre</th>";
                        echo "<th>Censur</th>";
                        echo "<th>ID</th>";
                        echo "<th>Actions</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        while($row = mysqli_fetch_array($result)){

                            $url = 'http://localhost:63342/htdocs/Assignment-2-master/Assignment-2-master/delete.php?ID=';

                            echo '<tr>';
                            echo '<td>'. $row["name"] . '</td>';
                            echo '<td>'. $row["length"] . '</td>';
                            echo '<td>'. $row["release_date"] . '</td>';
                            echo '<td>'. $row["information"] . '</td>';
                            echo '<td>'. $row["genre"] . '</td>';
                            echo '<td>'. $row["censur"] . '</td>';
                            echo '<td>'. $row["ID"] . '</td>';
                            echo "<td><a class='btn btn-danger btn-sm' href='{$url}{$row["ID"]}'>Delete</a></td>";
                            echo '</tr>';

                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }

                // Close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
