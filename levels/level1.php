<html lang="en">

<?php



include "common.php";

if (!isset($_SESSION["Username"])) {
    echo "<script> window.location = '../index.php' </script>";
    exit();
}


function create_game()
{
    $_SESSION["dificulty"] = 10;
    $_SESSION["sha"] = hash("sha256", "" . time());
    $_SESSION["start_time"] = time();
    echo "<!--" . $_SESSION["sha"] . "-->\n";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["sha"])) {
        solve($_POST["sha"]);
    }
}

?>

<head>
    <meta charset="UTF-8">
    <title>Angon</title>
    <link rel="stylesheet" href="../vendor/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="../css/sidenav.css">
    <link rel="stylesheet" href="../css/levels.css">

</head>

<body>
    <div id="sideNav" class="sidenav">
        <p class="username"><?php echo isset($_SESSION) ? $_SESSION["Username"] : "" ?></p>
        <p class="title"><?php echo isset($_SESSION) ? $_SESSION["Title"] : "" ?></p>
        <p class="points"><?php echo isset($_SESSION) ? $_SESSION["Points"] : "" ?></p>
        <hr>
        <a href="../">Capture the <i class="fas fa-flag"></i></a>
        <a href="../about.php">About <i class="fas fa-info"></i></a>
        <a href="../contact.php">Contact <i class="fas fa-phone"></i></a>
    </div>
    <div id="main">
        <form action="" method="post">
            <input type="text" name="sha" placeholder="SHA-256">
            <br>
            <input class="submit" type="submit" value="Submit">
        </form>
        <?php create_game() ?>
        <?php insert_clock() ?>
    </div>

</body>

</html>