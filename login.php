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
                    echo "<a href='restaurang.php'>RESTAURANG</a>";
                    echo "<a href='logout.php' class='active'>LOGOUT</a>";
                }else {
                    echo "<a href='#' class='active'>LOGIN</a>";
                }
                ?>
            </nav>
        </header>
        <main>
            <section>
                <form action="#" method="post">
                    <label for="email">E-Mail:</label><br>
                    <input name="email" type="text" class="form"><br>
                    <label for="losenord">Lösenord:</label><br>
                    <input name="losenord" type="password" class="form"><br>
                    <button>Logga In</button>
                </form>
                <?php
if (isset($_POST["email"]) && isset($_POST["losenord"])){
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $losen = filter_input(INPUT_POST, "losenord", FILTER_SANITIZE_STRING);

    $conn = new mysqli($hostname, $user, $password, $database);

    /* kolla att vi har en fungerande anslutning */
    if ($conn->connect_error) {
        die("Kunde inte ansluta till databasen: " . $conn->connect_error);
    }

    /* nu söker vi efter användaren i tabbellen */
    $sql = "SELECT * FROM admin WHERE epost = '$email'";
    $result = $conn->query($sql);

    if (!$result) {
        die("något blev fel med sql satsen" . $conn->error);
    }else{
        /* hämta endast en träff */
        $user = $result->fetch_assoc();

        /* nu ska vi jämföra lösenordet med hashen */
        if (password_verify($losen, $user['losen'])) {
            echo "<script>alert('Du är inloggad!');</script>";
            $_SESSION['loggedin'] = true;
            $_SESSION['anamn'] = $user['fornamn'];
            header("Location: index.php");
        } else {
            echo "<script>alert('Lösen ordet är fel, var god och försök igen!');</script>";
            $_SESSION['loggedin'] = false;
        }
        
    }
}
?>
            </section>
        </main>
    </div>
</body>

</html>