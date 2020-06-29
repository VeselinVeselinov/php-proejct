<?php
if(isset($_POST['register-submit'])) {

    require "dbh.inc.php";

    $username = addslashes($_POST["username"]);
    $password_users = addslashes($_POST["password_users"]);
    $repeatPassword = addslashes($_POST["repeatPassword"]);
    $email = addslashes($_POST["email"]);
    $phone = addslashes($_POST["phone"]);
    $address_users = addslashes($_POST["address_users"]);
    $firstName = addslashes($_POST["firstName"]);
    $lastName = addslashes($_POST["lastName"]);

    $mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
    $mysql->set_charset('utf8');
    
    $resultUsername = $mysql->query("SELECT username FROM users WHERE username='" . $username . "'");
    $resultEmail = $mysql->query("SELECT email FROM users WHERE email='" . $email . "'");

    if($rowEmail = $resultEmail->fetch_assoc()) {
        $_SESSION['email_error'] = 'Eлектронaта поща '. $email .' вече съществува!';
        header("Location: ../register.php?failure = invalid-email");
    }
    else if($rowUsername = $resultUsername->fetch_assoc()) {
        $_SESSION['username_error'] = 'Потребителското име '. $username .' вече съществува!';
        header("Location: ../register.php?failure = invalid-username");
    }
    else if($password_users !== $repeatPassword) {
        $_SESSION['repeatPassword_error'] = 'Двете пароли не съвпадат';
        header("Location: ../register.php?failure = invalid-password");
    } 
    else {

        $queryRegister = "insert into users(username, password_users, email, phone, address_users, active, role_users, firstName, lastName) 
        values ('". $username . "', '". $password_users . "', '". $email . "', '". $phone . "', '". $address_users . "',
        1, 'client', '". $firstName . "', '". $lastName . "')";

        if(mysqli_query($mysql, $queryRegister))  
        {  
            echo '<script>alert("Регистрацията е успешна")</script>';
            header("Location: ../index.php?register=success");
        } 
    
        $result = $mysql->query($queryRegister);
        $mysql->close();
    }
}  
?>
