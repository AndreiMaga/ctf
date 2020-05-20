<?php
if (!isset($_SESSION)) {
        session_start();
}
if (!isset($_SESSION["Username"])) {
        echo "<script> window.location = 'index.php' </script>";
        exit();
}
?>

<div id="sideNav" class="sidenav">
        <p class="username"><?php echo isset($_SESSION) ? $_SESSION["Username"] : "" ?></p>
        <p class="title"><?php echo isset($_SESSION) ? $_SESSION["Title"] : "" ?></p>
        <p class="points"><?php echo isset($_SESSION) ? $_SESSION["Points"] : "" ?></p>
        <hr>
        <a href="ctf.php">Capture the <i class="fas fa-flag"></i></a>
        <a href="about.php">About <i class="fas fa-info"></i></a>
        <a href="contact.php">Contact <i class="fas fa-phone"></i></a>
</div>
