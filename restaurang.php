<?php
/*
* PHP version 7
* @category   Signup system
* @author     Lukas Kirby <lukas.kirby@hotmail.com>
* @license    PHP CC
*/

/* aktivera felmeddelanden */
/* error_reporting(E_ALL);
ini_set("display_errors", 1); */

include_once "{$_SERVER["DOCUMENT_ROOT"]}/../config/config-db.inc.php";

session_start();
if (!isset($_SESSION['loggedin'])){
    $_SESSION['loggedin'] = false;
}
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ElevRate</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>ElevRate</h1>
            <nav>
                <a href="index.php">HOME</a><a href="reviews.php">REVIEWS</a><a href="signup.php">SIGNUP</a><?php
                if ($_SESSION['loggedin']) {
                    echo "<a href='restaurang.php' class='active'>RESTAURANG</a>";
                }else {
                    echo "<a href='login.php'>LOGIN</a>";
                }
                ?>
            </nav>
        </header>
        <main>
            <section>
                <form action="#" method="post">
                    <label for="renamn">Restaurang Namn:</label><br>
                    <input name="renamn" type="text" class="form" required><br>
                    <label for="lat">Latitude:</label><br>
                    <input name="lat" type="text" class="form" required><br>
                    <label for="lon">Longitude:</label><br>
                    <input name="lon" type="text" id="losen" class="form required"><br>
                    <button>Registrera</button>
                </form>
                <?php
if (isset($_POST["renamn"]) && isset($_POST["lat"]) && isset($_POST["lon"])){
    $renamn = filter_input(INPUT_POST, "renamn", FILTER_SANITIZE_STRING);
    $lat = filter_input(INPUT_POST, "lat", FILTER_SANITIZE_STRING);
    $lon = filter_input(INPUT_POST, "lon", FILTER_SANITIZE_STRING);
    
    $conn = new mysqli($hostname, $user, $password, $database);
    
    /* kolla att vi har en fungerande anslutning */
    if ($conn->connect_error) {
        die("Kunde inte ansluta till databasen: " . $conn->connect_error);
    }
    
    /* Anslutningen fungerar. Nu skjuter vi in data i tabellen */
    $sql = "INSERT INTO restaurang (rnamn, lat, lon) VALUES ('$renamn', '$lat', '$lon');";
    $result = $conn->query($sql);
    
    /* kunde sql satsen köras */
    if (!$result) {
        die("något blev fel med sql satsen" . $conn->error);
    }else{
        /* ge användaren alert att man har lyckats skapa ett konto */
        echo "<script>alert('Restaurang ifylld!');</script>";
    }
    
    
}
?>
            </section>
        </main>
    </div>
    <script src="./js/script.js"></script>
</body>

</html>