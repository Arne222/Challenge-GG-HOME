<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>

<body>
    <div class="container">      
        <h1 class="form-title">
            Log in bij GG!
        </h1>
        <form method="POST" action="user-account.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" required placeholder="Email">
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
                <i class="fa fa-eye" id="eye"></i>
           </div>
           <p class="recover">
            <a href="#">Reset wachtwoord</a>
           </p>
           <input type="submit" class="btn" value="Log In" name="signin">
        </form>
        <p class="or">
         
        </p>
        <div class="icons">
           
        </div>
        <div class="links">
            <p>Nog geen account?</p>
            <a href="register.php">Registreer</a>
        </div>        
    </div>
    <script src="script.js"></script>
</body>
</html>