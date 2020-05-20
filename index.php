<html>
<?php

    session_start();
    
    if(isset($_SESSION["Username"]) && isset($_SESSION["Title"]) && isset($_SESSION["Points"])){
        header("location: ctf.php");
        exit;
    }
    require_once "config.php";

    $username = $password = "";
    $username_err = $password_err = "";

    function userexists() {
        global $username, $link;
        $sql = "SELECT id FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_close($stmt);
                    return TRUE; // user exists
                }
                else{
                    mysqli_stmt_close($stmt);
                    return FALSE; // user dosen't exist
                }
            }else{
                mysqli_stmt_close($stmt);
                return TRUE; // asume the user exists if the query failed
            }
        }
    }

    function validatePassword () {
        global $password, $password_err, $link;
        if(empty(trim($_POST["Password"]))){
            $password_err = "Please enter a password.";
            return 0;
        }elseif(strlen(trim($_POST["Password"])) < 6){
            $password_err = "Password must have at least 6 characters.";
            return 1;
        }else{
            $password = mysqli_escape_string($link, trim($_POST["Password"]));
            return 2;
        }
    }

    function validateUsername() {
        global $username, $username_err, $link;

        if(empty(trim($_POST["Username"]))){
            $username_err = "Please enter a user.";
            return 0;
        }elseif(strlen(trim($_POST["Password"])) < 4){
            $username_err = "Username must have at least 4 charachers.";
            return 1;
        }
        else{
            $username = mysqli_escape_string($link, trim($_POST["Username"]));
            return 2;
        }
    }

    function login(){
        global $password, $username, $link , $title, $points, $password_err;
        if(validateUsername() == 2 && validatePassword() == 2 && userexists()){
            $sql = "select username, password, title, points from users where username = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = $username;

                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        mysqli_stmt_bind_result($stmt, $username, $hashed_password, $title, $points);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                $_SESSION["Username"] = $username;
                                $_SESSION["Title"] = $title;
                                $_SESSION["Points"] = $points;
                                header("location: ctf.php");
                            }
                            else{
                                $password_err = "The password entered was not valid.";
                            }
                        }
                    }
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);

        }
    }

    function register(){
        global $username, $link, $password;
        if(validateUsername() == 2 && validatePassword() == 2 && !userexists()){
            
            $sql = "insert into users (username, password, title, points) values (? ,?, ?, ?)";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "sssi", $param_username, $param_password, $param_title, $param_points);
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_BCRYPT);
                $param_title = "Newbie";
                $param_points = 0;
                if(mysqli_stmt_execute($stmt)){
                    header("location: ctf.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
            $_SESSION["Username"] = $username;
            $_SESSION["Title"] = "Newbie";
            $_SESSION["Points"] = 0;
        } // else it has an error
        mysqli_close($link);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["login"])){
            login();
        }
        elseif(isset($_POST["register"])){
            register();
        }
    }

?>
<head>
    <meta charset="UTF-8">
    <title>Angon</title>
    <link rel="stylesheet" href="vendor/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="login" class="login">
            <input type="hidden" name="login" value="login">
            <i class="fas fa-user"></i><input class="<?php echo (!empty($username_err)) ? 'has-error' : '' ?>" type="text" placeholder="Username" name="Username">
            <br>
            <i class="fas fa-key"></i><input class="<?php echo (!empty($password_err)) ? 'has-error' : '' ?>" type="password" placeholder="Password" name="Password">
            <br>
            <input type="submit" class="submit" value="Login">
        </form>
        <span><i id="show-login" class="fas fa-angle-double-right fa-3x show-login" onclick="handleShowLogin()"></i></span>
    </div>

    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="register" class="register">
            <input type="hidden" name="register" value="register">
            <i class="fas fa-user"></i><input class="<?php echo (!empty($username_err)) ? 'has-error' : '' ?>" type="text" placeholder="Username" name="Username">
            <br>
            <i class="fas fa-key"></i><input class="<?php echo (!empty($password_err)) ? 'has-error' : '' ?>" type="password" placeholder="Password" name="Password">
            <br>
            <input type="submit" class="submit" value="Register">
        </form>
        <span><i id="show-register" class="fas fa-angle-double-left fa-3x show-register" onclick="handleShowRegister()"></i></span>
    </div>

    <footer>By registering you agree to the ridiculously long terms that you didn't bother to read</footer>

    <script src="js/index.js"></script>
</body>
</html>
