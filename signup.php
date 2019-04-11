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
                <a href="index.php">HOME</a><a href="reviews.php">REVIEWS</a><a href="#" class="active">SIGNUP</a><a
                    href="login.php">LOGIN</a>
            </nav>
        </header>
        <main>
            <section>
                <form action="#" method="post">
                    <label for="fornamn">Förnamn:</label><br>
                    <input name="fornamn" type="text" class="form" required><br>
                    <label for="efternamn">Efternamn:</label><br>
                    <input name="efternamn" type="text" class="form" required><br>
                    <label for="losenord">Lösenord:</label><br>
                    <input name="losenord" type="password" id="losen" class="form required"><br>
                    <label for="replosen">Repetera Lösenord:</label><br>
                    <input name="replosen" type="password" id="replos" class="form" required><br>
                    <label for="email">E-Mail:</label><br>
                    <input name="email" type="text" class="form" required><br>
                    <button>Registrera</button>
                </form>
                <?php
if (isset($_POST["fornamn"]) && isset($_POST["efternamn"]) && isset($_POST["losenord"]) && isset($_POST["email"])){
    $fnamn = filter_input(INPUT_POST, "fornamn", FILTER_SANITIZE_STRING);
    $enamn = filter_input(INPUT_POST, "efternamn", FILTER_SANITIZE_STRING);
    $losen = filter_input(INPUT_POST, "losenord", FILTER_SANITIZE_STRING); 
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    
    $conn = new mysqli($hostname, $user, $password, $database);
    
    /* kolla att vi har en fungerande anslutning */
    if ($conn->connect_error) {
        die("Kunde inte ansluta till databasen: " . $conn->connect_error);
    }
    
    /* räkna fram hashet på lösenordet */
    $hash = password_hash($losen, PASSWORD_DEFAULT);
    
    /* Anslutningen fungerar. Nu skjuter vi in data i tabellen */
    $sql = "INSERT INTO admin (fornamn, efternamn, epost, losen) VALUES ('$fnamn', '$enamn', '$email', '$hash');";
    $result = $conn->query($sql);
    
    /* kunde sql satsen köras */
    if (!$result) {
        die("något blev fel med sql satsen" . $conn->error);
    }else{
        /* ge användaren alert att man har lyckats skapa ett konto */
        echo "<script>alert('Användaren är registrerad!');</script>";
    }
    
    
}
?>
            </section>
        </main>
    </div>
    <script src="./js/script.js"></script>
</body>

</html>