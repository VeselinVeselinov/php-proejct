<?php 

if (session_status() == PHP_SESSION_NONE) {
    include 'dbh.inc.php';
}

if(isset($_SESSION['userId'])){
    if(isset($_POST['update-account-submit'])) {

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
        
        $resultUsername = $mysql->query("SELECT DISTINCT username FROM users WHERE username='" . $username . "' AND username != '" . $_SESSION["username"] . "'");
        $resultEmail = $mysql->query("SELECT DISTINCT email FROM users WHERE email='" . $email . "' AND email != '" . $_SESSION["email"] . "'");

        if($rowEmail = $resultEmail->fetch_assoc()) {
            $_SESSION['email_error'] = 'Eлектронaта поща '. $email .' вече съществува!';
            header("Location: ../update_user.php?failure = invalid-email");
        }
        else if($rowUsername = $resultUsername->fetch_assoc()) {
            $_SESSION['username_error'] = 'Потребителското име '. $username .' вече съществува!';
            header("Location: ../update_user.php?failure = invalid-username");
        }
        if($password_users !== $repeatPassword) {
            $_SESSION['repeatPassword_error'] = 'Двете пароли не съвпадат';
            header("Location: ../update_user.php?failure = invalid-password");
        }
        else {

            $user_id = $_SESSION["userId"];
            
            $queryUpdate = "update users set username='$username', password_users='$password_users', email='$email',
                phone='$phone', address_users='$address_users', firstName='$firstName',
                lastName='$lastName' where user_id=".$user_id;
    
            if($mysql->query($queryUpdate))  
            { 
                $_SESSION['feedback-success'] = "Успешно обновихте свойте данни. ";
                header("Location: ../update_user.php?Update-account=success");
            }
            
            $mysql->close();
        }
    }
}
else{
    $_SESSION['feedback-failure'] = "Моля влезте в системата за да актуализирате свойте данни. ";
    header('Location: ../index.php?failure=nouser');
}
?>
