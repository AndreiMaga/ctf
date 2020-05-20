<?php
session_start();

function solve($user_sha){
    if($_SESSION["sha"] === $user_sha){
        add_points(time());
    }
}

function add_points($end_time){
    require_once "../config.php";
    $dificulty = $_SESSION["dificulty"];
    $x = $end_time - $_SESSION["start_time"];
    if($x <= $dificulty){
        $points = $dificulty;
    }else{
        $points = $dificulty/($x - $dificulty);
    }

    $points = intval($points * 10);

    $sql = "update users set points = points +". $points ." where username = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $_SESSION["Username"]);

        if(mysqli_stmt_execute($stmt)){
            // points added
            $_SESSION["Points"] += $points;
            header("location: ../ctf.php");
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);

}


function insert_clock(){
    echo "<script src= \"../js/timer.js\"></script>";
}
?>