<?php

require "dbh.inc.php";

if(isset($_POST['login-submit'])){
    
    $mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
    $mysql->set_charset('utf8'); 

    $username = addslashes($_POST["username"]);
    $password = addslashes($_POST["password"]);

    if (empty($username) || empty($password)) {

        header("Location: ../index.php?error=emptyInput");
        exit();
    }

    else {

        $result = $mysql->query("select * from users where username='". $username . "' and password_users='" . $password . "' and active != 0");
        $mysql->close();

        if ($row = $result->fetch_assoc())
        {
            $_SESSION["username"]=$row["username"];
            $_SESSION["userId"]=$row["user_id"];
            $_SESSION["firstName"]=htmlspecialchars($row["firstName"]);
            $_SESSION["lastName"]=htmlspecialchars($row["lastName"]);
            $_SESSION["role_users"]=htmlspecialchars($row["role_users"]);
            $_SESSION['email'] = htmlspecialchars($row["email"]);

            header("Location: ../index.php?logged");
            exit();
        }

        else {

            $_SESSION['feedback-failure'] = "Невалидно потребителско име или грешна парола! ";
            header("Location: ../index.php?nouser");
            exit();
        }
    }
}

?>