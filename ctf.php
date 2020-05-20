<html lang="en">
<?php
    session_start();
    if(!isset($_SESSION["Username"])){
        header("location : index.php");
    }

    $number_of_levels = 2;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        for ($i=1; $i < $number_of_levels + 1; $i++) {
            if(isset($_POST["level" . $i])){
                echo "<script> window.location = 'levels/level". $i .".php' </script>";
                exit();
            }
        }
    }

?>
<head>
    <meta charset="UTF-8">
    <title>Angon</title>
    <link rel="stylesheet" href="vendor/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/ctf.css">
</head>
<body>
    <?php require "sidenav.php" ?>
    <div id="main">
        <div class="level">
            <p class="level-name">LEVEL 1</p>
            <p class="level-desc">The start.</p>
            <form method="post">
                <input type="hidden" name="level1">
                <button class="submit" >ENTER</button>
            </form>
        </div>
        <div class="level">
            <p class="level-name">LEVEL 2</p>
            <p class="level-desc">Not the same.</p>
            <form method="post">
                <input type="hidden" name="level2">
                <button class="submit" >ENTER</button>
            </form>
        </div>
    </div>
</body>
</html>