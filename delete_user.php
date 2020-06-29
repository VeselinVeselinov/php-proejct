<link href="css/delete-user-style.css" rel="stylesheet" />

<?php
    require "header.php";

    if(!isset($_SESSION['username'])){
        $_SESSION['feedback-failure'] = "Моля влезте в системата за да актуализирате свойте данни. ";
        echo "<script>location.href = 'index.php?failure=nouser';</script>";
    }

    if(isset($_SESSION['repeatPassword_error'])) {
        $repeatPassword_error = $_SESSION['repeatPassword_error'];
        unset($_SESSION['repeatPassword_error']);
    }
    
    if(isset($_SESSION['error-delete-form'])) {
        $error = $_SESSION['error-delete-form'];
        unset($_SESSION['error-delete-form']);
    }
?>

<br>
<div class="container">
    <form action="includes/delete_user.inc.php" method="post" style="max-width:500px;margin:auto">
        <h3>Форма за изтриване на акаунт:</h3>
        <hr />
        <p id="paragraph-comfirm" style="color: #d9534f;">Наистина ли искате да изтриете акаунта си?</p>
        <div class="input-container">
            <i class="fa fa-user icon"></i>
            <input name="username" class="input-field" type="text" placeholder="Потребителско име" required/>
        </div>

        <div class="input-container">
            <i class="fa fa-lock icon"></i>
            <input name="password_users" type="password" class="input-field" placeholder="Парола" required/>
        </div>

        <div class="input-container">
            <i class="fa fa-lock icon"></i>
            <input name="repeatPassword" type="password" class="input-field" placeholder="Повторете паролата" required/>       
        </div>
        <div class="invalid-feedback">
            <?php if(isset($repeatPassword_error)) { ?>
                    <p><strong><?php echo $repeatPassword_error; ?></strong></p>
            <?php } ?>
            <?php if(isset($error)) { ?>
                    <p><strong><?php echo $error; ?></strong></p>
            <?php } ?> 
        </div>

        <button type="submit" class="btn" name="delete-account-submit">Потрвърди</button>
    </form>
</div>
<br>
<hr>

<?php
    require "footer.php";
?>