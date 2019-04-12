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
                <a href="#" class="active">HOME</a><a href="reviews.php">REVIEWS</a><a href="signup.php">SIGNUP</a><?php
                if ($_SESSION['loggedin']) {
                    echo "<a href='restaurang.php'>RESTAURANG</a>";
                }else {
                    echo "<a href='login.php'>LOGIN</a>";
                }
                ?>
            </nav>
        </header>
        <main>
            <section>
                <input name="search" type="text"><button>Search</button><br>
                <img src="Images/map.png" alt="">
            </section>
        </main>
    </div>
</body>

</html>