<!--
Allan Midjord
create.php
hackerboys

This php file creates a new movie
and inserts it into the database havnarbio

-->



<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$name = $length = $release_date = $information = $genre = $censur = "";
$name_err = $length_err = $release_date_err = $information_err = $genre_err = $censur_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = 'Please enter a movie title.';

        // if the input IS only integers then it is not a valid title
    } elseif (ctype_digit($input_name)) {
        $name_err = 'Please enter a valid title.';
    } else {
        $name = $input_name;
    }

    // Validate length
    $input_length = trim($_POST["length"]);
    if (empty($input_length)) {
        $length_err = "Please enter the length of the movie.";
        // if the input is not an integer
    } elseif (!ctype_digit($input_length)) {
        $length_err = 'Please enter a positive integer value for length.';
    } else {
        $length = $input_length;
    }

    // Validate release date
    $input_release_date = trim($_POST["release_date"]);
    if (empty($input_release_date)) {
        $release_date_err = 'Please enter release date in the format: [xxxx-xx-xx].';
    } else {
        $release_date = $input_release_date;
    }

    // Validate information
    $input_information = trim($_POST["information"]);
    if (empty($input_information)) {
        $information_err = 'Please enter some information about the movie.';
    } else {
        $information = $input_information;
    }

    // Validate genre
    $input_genre = trim($_POST["genre"]);
    if (empty($input_genre)) {
        $genre_err = 'Please enter genre/s.';
    } else {
        $genre = $input_genre;
    }

    // Validate censur
    $input_censur = trim($_POST["censur"]);
    if (empty($input_censur)) {
        $censur_err = "Please enter age restriction.";
        // if the input is NOT an integer
    } elseif (!ctype_digit($input_censur)) {
        $censur_err = 'Please enter a positive integer value for the age restriction.';
    } else {
        $censur = $input_censur;
    }


    // Check input errors before inserting in database
    if (empty($name_err) && empty($length_err) && empty($release_date_err) && empty($information_err) && empty($genre_err) && empty($censur_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO filmur (name, length, release_date, information, genre, censur  ) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sisssi", $param_name,
                $param_length,
                $param_release_date,
                $param_information,
                $param_genre,
                $param_censur);

            // Set parameters
            $param_name = $_POST["name"];
            $param_length = $_POST["length"];
            $param_release_date = $_POST["release_date"];
            $param_information = $_POST["information"];
            $param_genre = $_POST["genre"];
            $param_censur = $_POST["censur"];


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: index.php?Success");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
                mysqli_error($link);

            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>


    <script>
        $(document).ready(function(){
            $("p").click(function(){
                $(this).hide();
            });
        });
    </script>



</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Create movie</h2>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

<!--                     Name-->
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err;?></span>
                    </div>

<!--                     length-->
                    <div class="form-group <?php echo (!empty($length_err)) ? 'has-error' : ''; ?>">
                        <label>length</label>
                        <textarea name="length" class="form-control"><?php echo $length; ?></textarea>
                        <span class="help-block"><?php echo $length_err;?></span>
                    </div>

<!--                     release date-->
                    <div class="form-group <?php echo (!empty($release_date_err)) ? 'has-error' : ''; ?>">
                        <label>release date</label>
                        <input type="text" name="release_date" class="form-control" value="<?php echo $release_date; ?>">
                        <span class="help-block"><?php echo $release_date_err;?></span>
                    </div>

<!--                     information-->
                    <div class="form-group <?php echo (!empty($information_err)) ? 'has-error' : ''; ?>">
                        <label>information</label>
                        <input type="text" name="information" class="form-control" value="<?php echo $information; ?>">
                        <span class="help-block"><?php echo $information_err;?></span>
                    </div>

<!--                     Genre-->
                    <div class="form-group <?php echo (!empty($genre_err)) ? 'has-error' : ''; ?>">
                        <label>Genre</label>
                        <input type="text" name="genre" class="form-control" value="<?php echo $genre; ?>">
                        <span class="help-block"><?php echo $genre_err;?></span>
                    </div>

<!--                     censur-->
                    <div class="form-group <?php echo (!empty($censur_err)) ? 'has-error' : ''; ?>">
                        <label>censur</label>
                        <input type="text" name="censur" class="form-control" value="<?php echo $censur; ?>">
                        <span class="help-block"><?php echo $censur_err;?></span>
                    </div>



                    <p> click on this text to hide it using jQuery</p>


                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>



                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
