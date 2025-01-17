<?php

session_start();
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>
    <div class="container" id="signup">
        <h1 class="form-title">Register</h1>
        
        
        <?php
        if (isset($errors['user_exist'])) {
            echo '<div class="error-main">
                    <p>' . $errors['user_exist'] . '</p>
                    </div>';
                    unset($errors['user_exist']);
        }
        ?>
        <form method="POST" action="user-account.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" id="name" placeholder="Naam" required>
                <?php
                if (isset($errors['name'])){
                    echo ' <div class="error">
                    <p>' . $errors['name'] . '</p>
                </div>';
          
                }
                ?>
            </div>

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <?php
                if (isset($errors['email'])) {
                    echo '<div class="error">
                    <p>' . $errors['email'] . '</p>
                    </div>';
                    unset($errors['email']);

                }
                ?>
            </div>
            <div class="input-group password">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Wachtwoord" >
                <i id="eye" class="fa fa-eye"></i>
                <?php
                if (isset($errors['password'])) {
                    echo '<div class="error">
                    <p>' . $errors['password'] . '</p>
                    </div>'
                    ;
                    unset($errors['password']);

                }
                ?>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirm_password" placeholder="Wachtwoord" required>
                <?php
                if (isset($errors['confirm_password'])) {
                    echo '<div class="error">
                    <p>' . $errors['confirm_password'] . '</p>
                    </div>';
                    unset($errors['confirm_password']);

                }
                ?>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signup">
        </form>
        <p class="or">
            
        </p>
        <div class="icons">
            
        </div>
        <div class="links">
            <p>Already Have Account ?</p>
            <a href="index.php">Sign In</a>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>
<?php
if(isset($_SESSION['errors'])){
unset($_SESSION['errors']);
}
?>