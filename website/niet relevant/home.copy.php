<?php
session_start();
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];

}else{
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="user-details">
        <p>Luchtkwaliteit Dashboard</p>
        <?php
        echo '<p>Email: ' . $user['email'] . '</p><br>';

        echo '<p> Welkom ' . $user['name'] . '</p>';

        echo '<p> uw luchtkwaliteit is slecht!' . $Luchtkwaliteit['co2'] . '</p>';
        

        ?>
        <a href="logout.php">Logout</a>

    </div>


</body>

</html>

<?php 


$conn =mysqli_connect('localhost','root','','auth');


if (!$conn){
    echo'Connection error: ' . mysqli_connect_error();
}

$sql = 'SELECT co2, luchtvochtigheid, temperatuur FROM Luchtkwaliteit';

$result = mysqli_query($conn, $sql);

$luchtkwalitiet = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);



?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>

    <h4 class="grey-text center"></h4>

    <div class="container"> 
        <div class="row">

        <?php foreach ($luchtkwalitiet as $luchtkwalitiet){ ?>

            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <div><?php echo '<p> CO2:'?> <?php echo htmlspecialchars($luchtkwalitiet['co2']); ?></div>
                        <div><?php echo '<p> Luchtvochtigheid:' ?> <?php echo htmlspecialchars($luchtkwalitiet['luchtvochtigheid']); ?></div>
                        <div><?php echo '<p> Temperatuur:'?> <?php echo htmlspecialchars($luchtkwalitiet['temperatuur']); ?></div>
                    </div>
                
                </div>
            </div>

        <?php } ?>

        </div>
    </div>

    <?php include('templates/footer.php'); ?>

</html>