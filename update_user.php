<link rel="stylesheet" href="css/register.css">

<?php
    require "header.php";
?>

<?php 

    if (session_status() == PHP_SESSION_NONE) {
        include 'includes/dbh.inc.php';
    }

    if(isset($_SESSION['userId'])){
        $mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
        $mysql->set_charset('utf8');

        $result_user = $mysql->query("select * from users where user_id='". $_SESSION["userId"] . "'");

        if ($row_user = $result_user->fetch_assoc()) {
            $username = $row_user["username"];
            $password_users = $row_user["password_users"];
            $email = $row_user["email"];
            $phone = $row_user["phone"];
            $address_users = $row_user["address_users"];
            $firstName = $row_user["firstName"];
            $lastName = $row_user["lastName"];
        }
    }
    else{
        $_SESSION['feedback-failure'] = "Моля влезте в системата за да актуализирате свойте данни. ";
        echo "<script>location.href = 'index.php?failure=nouser';</script>";
    }
?>

<?php
    
    switch ([isset($_SESSION['username_error']), isset($_SESSION['email_error']), isset($_SESSION['repeatPassword_error'])]) {
        case [true, false, false]:
            $username_error = $_SESSION['username_error'];
		    unset($_SESSION['username_error']);
                break;

        case [false, true, false]:
            $email_error = $_SESSION['email_error'];
		    unset($_SESSION['email_error']);
            break;

        case [false, false, true]:
            $repeatPassword_error = $_SESSION['repeatPassword_error'];
		    unset($_SESSION['repeatPassword_error']);
            break;

        default:
            break;
    }

?>

<section class="testimonial py-5">
    <div class="container">
        <div class="row ">
            <div id="register-form-holder" class="col-md-4 py-5 bg-primary text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <img src="https://image.flaticon.com/icons/png/512/2000/2000200.png" style="width:40%">
                        <h2 class="py-3">Форма за актуализация на акаунт</h2>
                        <p>
                            Скейтборд екипировка с гарантирано качество на марките Jart, Girl, Chocolate, Tricks и др. 
                            Скейт дъски, комплекти, колесари, колела, каски, протектори, инструменти и шкурки. Богат 
                            избор. Бърза доставка. Достъпни цени. Гарантирано качество.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Моля, попълнете новите данни:</h4>
                <form action="includes/update_user.inc.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Първо име:</label>
                            <input name="firstName" minlength="3" maxlength="10" placeholder="Първо име" class="form-control" type="text" 
                            class="form-control" required value="<?php echo $firstName; ?>">
                            <div class="invalid-feedback">
                                <?php if(isset($firstName_error)) { ?>
                                    <p><?php echo $firstName_error; ?></p>
                                <?php } ?> 
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Фамилия:</label>
                            <input name="lastName" minlength="4" maxlength="15" placeholder="Фамилия" class="form-control" type="text" 
                            class="form-control" required value="<?php echo $lastName; ?>">
                            <div class="invalid-feedback">
                                <?php if(isset($lastName_error)) { ?>
                                    <p><?php echo $lastName_error; ?></p>
                                <?php } ?> 
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Адрес:</label>
                            <input name="address_users" minlength="5" maxlength="20" placeholder="Адрес" class="form-control" type="text" 
                            class="form-control" required value="<?php echo $address_users; ?>">
                            <div class="invalid-feedback">
                                <?php if(isset($address_users_error)) { ?>
                                    <p><?php echo $address_users_error; ?></p>
                                <?php } ?> 
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Eлектронна поща:</label>
                            <input name="email" minlength="4" maxlength="17" placeholder="Eлектронна поща" class="form-control" type="email" 
                            class="form-control" required value="<?php echo $email; ?>">
                            <div class="invalid-feedback">
                                <?php if(isset($email_error)) { ?>
                                    <p><?php echo $email_error; ?></p>
                                <?php } ?> 
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Телефон:</label>
                            <input name="phone" minlength="10" maxlength="10" placeholder="Телефон" class="form-control" type="text" 
                            class="form-control" required value="<?php echo $phone; ?>">
                            <div class="invalid-feedback">
                                <?php if(isset($phone_error)) { ?>
                                    <p><?php echo $phone_error; ?></p>
                                <?php } ?> 
                            </div>
                        </div>     
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Потребителско име:</label>
                            <input name="username" placeholder="Потребителско име" minlength="3" maxlength="13"
                            class="form-control" type="text" required value="<?php echo $username; ?>">
                            <div class="invalid-feedback">
                                <?php if(isset($username_error)) { ?>
                                    <p><?php echo $username_error; ?></p>
                                <?php } ?> 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Парола:</label>
                            <input name="password_users" placeholder="Парола" minlength="5" maxlength="20"
                            class="form-control" type="password" required value="<?php echo $password_users; ?>">
                            <div class="invalid-feedback">
                                <?php if(isset($password_user_error)) { ?>
                                    <p><?php echo $password_user_error; ?></p>
                                <?php } ?> 
                            </div>
                        </div>   
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Потвърдете паролата:</label>
                            <input name="repeatPassword" placeholder="Потвърдете паролата" 
                            class="form-control" type="password" required value="<?php echo $password_users; ?>">
                            <div class="invalid-feedback">
                                <?php if(isset($repeatPassword_error)) { ?>
                                    <p><?php echo $repeatPassword_error; ?></p>
                                <?php } ?> 
                            </div>
                        </div>  
                    </div>              
                    <div class="form-row">
                        <button type="submit" name="update-account-submit" class="btn btn-primary">Актуализация</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- this script handles the rendering of feedback messages -->
<script type="text/javascript" src="js/renderHandler.js"></script>

<?php
    if(isset($_SESSION['feedback-success'])){
        echo "<script>notifySuccess('".$_SESSION['feedback-success']."')</script>";
        unset($_SESSION['feedback-success']);
    }
    if(isset($_SESSION['feedback-failure'])){
        echo "<script>notifyFailure('".$_SESSION['feedback-failure']."')</script>";
        unset($_SESSION['feedback-failure']);
    }
?>

<?php
    require "footer.php";
?>
