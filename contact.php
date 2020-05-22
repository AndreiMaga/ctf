<html lang="en">

<?php
    require_once "config.php";
    function sendFeedback(){
        global $link;
        $sql = "insert into feedback (username, points, email, subject, description) values (?,?,?,?,?)";
        if($stmt = mysqli_prepare($link, $sql)){
            $username = $_SESSION["Username"];
            $points = $_SESSION["Points"];
            $email = mysqli_escape_string($link,trim($_POST["Email"]));
            $subject = mysqli_escape_string($link,trim($_POST["Subject"]));
            $text = mysqli_escape_string($link,trim($_POST["Text"]));
            mysqli_stmt_bind_param($stmt, "sisss", $username, $points, $email, $subject, $text);

            if(mysqli_stmt_execute($stmt)){
                header("location: ctf.php");
            }
            mysqli_stmt_close($stmt);
        }
    }


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        sendFeedback();
    }

?>

<head>
    <meta charset="UTF-8">
    <title>Angon</title>
    <link rel="stylesheet" href="vendor/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>
    <?php require "sidenav.php" ?>

    <div id="main">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="feedback" name="feedback">
            <input type="text" placeholder="Email" name="Email">
            <br>
            <input type="text" placeholder="Subject" name="Subject">
            <br>
            <span class="textarea" role="textbox" name="Text" contenteditable></span>
            <br>
            <button class="submit">Send</button>
        </form>
    </div>
</body>

</html>