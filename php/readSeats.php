
<?php
/**
 * Created by PhpStorm.
 * User: Krist
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

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cinema Seating Plan Canvas</title>
    <script src="jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/foundation.min.css" />
    <link rel="stylesheet" href="css/main.css" />

</head>
<body>
<canvas id="canvas1" width="500" height="355"></canvas>
<script>

    var tickets = <?php echo json_encode($tickets); ?>;

    const STATE_GREEN = "rgb(13,114,0)";
    const STATE_BLUE = "rgb(0,0,255)";
    const STATE_WHITE = "rgb(255,255,255)";



    const SEAT_WIDTH = 22;
    const SEAT_HEIGHT = 22;
    var seats = [ ];
    var infoSeats = [ ];
    var canvas = document.getElementById("canvas1");
    var ctx = canvas.getContext("2d");
    function createSeats() {
        //Creating the seats
        var seatId = 1;
        for (var i = 1; i < 320; i += 40) {
            for (var j = 1; j < 300; j += 30) {
                seats.push({pos: [j, i], state: STATE_GREEN, id: seatId, available: 0});
                seatId++;
            }
        }
        infoSeats.push({pos:[340, 1], state: STATE_GREEN});
        infoSeats.push({pos:[340,30], state: STATE_WHITE});
        infoSeats.push({pos:[340,60], state: STATE_BLUE});
        addMovieTitle();
        draw();
        canvas.addEventListener('click', function (e) {
            var seatMinX;
            var seatMaxX;
            var seatMinY;
            var seatMaxY;
            for(var i = 0; i < seats.length; i++) {
                seatMinX = seats[i].pos[0];
                seatMaxX = seats[i].pos[0] + 30;
                seatMinY = seats[i].pos[1];
                seatMaxY = seats[i].pos[1] + 30;
                if(seatMinX < e.pageX && e.pageX < seatMaxX) {
                    if(seatMinY < e.pageY && e.pageY < seatMaxY) {
                        if(seats[i].state !== STATE_WHITE && seats[i].state === STATE_BLUE){
                            seats[i].state = STATE_GREEN
                        }
                        else if(seats[i].state !== STATE_WHITE && seats[i].state === STATE_GREEN){
                            seats[i].state = STATE_BLUE;
                        }
                        draw();
                        addPrice();
                    }
                }
            }
        }, false);
    }
    function draw() {
        ctx.clearRect(0,0,canvas.width, canvas.height); //Clearing the canvas for redrawing
        seats.forEach(function(x) {
            ctx.fillStyle = x.state;
            ctx.strokeRect(x.pos[0], x.pos[1], SEAT_WIDTH, SEAT_HEIGHT);
            ctx.fillRect(x.pos[0], x.pos[1], SEAT_WIDTH, SEAT_HEIGHT);
        });
        infoSeats.forEach(function(x) {
            ctx.fillStyle = x.state;
            ctx.strokeRect(x.pos[0], x.pos[1], SEAT_WIDTH, SEAT_HEIGHT);
            ctx.fillRect(x.pos[0], x.pos[1], SEAT_WIDTH, SEAT_HEIGHT);
        });

        if(tickets.length > 0){
            tickets.forEach(function(x){
                seats.forEach(function(y){
                        if (x.Seat == y.id) {
                            //y.state = STATE_WHITE;
                            ctx.fillStyle = STATE_WHITE;
                            ctx.strokeRect(y.pos[0], y.pos[1], SEAT_WIDTH, SEAT_HEIGHT);
                            ctx.fillRect(y.pos[0], y.pos[1], SEAT_WIDTH, SEAT_HEIGHT);
                        }
                    })
            })
        }



        ctx.strokeRect(5,320,280,25);
        ctx.fillStyle = "black";
        ctx.font = ("20px Arial");
        ctx.fillText("Screen", 108,340);
        ctx.fillText("Available", 370, 20);
        ctx.fillText("Sold", 370, 49);
        ctx.fillText("Selected", 370, 79);
    }
    function submitSeats() {

        var selected = seats.filter(function (it) {
            return it.state === STATE_BLUE
        }).map(function (it) {
            return it.id;
        });
        for (var i = 0; i < seats.length; i++) {
            if (seats[i].state === STATE_BLUE) {
                seats[i].state = STATE_WHITE;
                seats[i].available = 1;
                //Send id og available to server
            }
        }
        $.post("bookSeats.php", {seats: selected})
            .fail(function (xhr) {
                alert(xhr.status);
            })
            .done(function (data, status, xhr) {
                alert(status + ':' + xhr.status);
                alert("Tín bílegging er skrásett");
                draw();
            });


    }
    function addPrice() {
        var tempPrice = 0;
        for (var i = 0; i < seats.length; i++) {
            if (seats[i].state === STATE_BLUE) {
                tempPrice += 90;
            }
        }
        var text = "Tín samlaði prísur er: ";
        var price = text.concat(tempPrice.toString());
        $("#totalPrice").text(price);
    }
    function addMovieTitle() {
        var title; //Get movie title from database
        $("#movieTitle").text(title);
    }
    window.addEventListener("load",createSeats, false);
</script>
<form method="post" action="bookSeats.php"></form>
<button id="submit" onclick="submitSeats()">Keyp</button>
<p id="totalPrice"></p>

</body>
</html>