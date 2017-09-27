<?php
$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");

    include('connectToDatabase.php');

    session_start(); // Starting Session

    /*
     * 0 - no error
     * 1 - blank username or password
     * 2 - wrong username or password
     */

    if (!isset($_SESSION['loginError'])) {
        $_SESSION['loginError'] = 0;
    }

    if (isset($_POST['submit'])) {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['loginError'] = 1;
            header("location: login.php");
        } else {
        // Define $username and $password
            $email = $_POST['email'];
            $password = $_POST['password'];
            $hashed_password = hash('sha256', $password);

            $query = mysqli_query($conn, "select role from users where password='$hashed_password' AND username='$email'");
            $rows = mysqli_num_rows($query);
            $roles=mysqli_fetch_row($query);
            $privilege= $roles[0] ;

            if ($rows == 1) {
                $_SESSION['login_user'] = $email; // Initializing Session
                $_SESSION['login_user_role'] = $privilege;

                header("location: portal.php"); // Redirecting To Other Page
            } else {
                $_SESSION['loginError'] = 2;
                header("location: login.php"); //
            }
        }
    }
?>