<?php  
    
    if(isset($_POST['delete-account-submit'])) {
        require 'dbh.inc.php';

        $username = addslashes($_POST["username"]);
        $password_users = addslashes($_POST["password_users"]);
        $repeatPassword = addslashes($_POST["repeatPassword"]);
        
        if($password_users !== $repeatPassword) {
            $_SESSION['repeatPassword_error'] = 'Двете пароли не съвпадат!';
            header("Location: ../delete_user.php?failure = invalid-password");
        }
        else {
            $mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
            $mysql->set_charset('utf8');

            $result_user = $mysql->query(
                "select * from users where username='". $username . "' and password_users='" . $password_users . "'");

            if ($row_user = $result_user->fetch_assoc()) {
                $user_id =$row_user["user_id"];

                if(isset($_SESSION["userId"])) {

                    if($user_id === $_SESSION["userId"]) {
                        $result = $mysql->query("update users set active='0' where user_id=".$user_id);

                        $_SESSION['feedback-success'] = "Вие успешно изтрихте своя акаунт. Благодарим ви, че бяхте част от Пловдив064!";
                        header("Location: logout.inc.php");
                    }                    
                }
            }
            else {
                
                $_SESSION['error-delete-form'] = 'Потребителското име или парола са грешни!';
                header("Location: ../delete_user.php?failure=username-or-password-invalid!");
            }             
        }

        $mysql->close();
    }   
?>