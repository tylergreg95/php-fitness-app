<?php
// Initialize the session
session_start();
require_once('config.php');
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$today = date('Y-m-d');
$weekAfterToday = date('Y-m-d', strtotime($today . ' + 7 days'));

$daysOfWeekNextSevenDays = array();

for($i = 0; $i < 7; $i++) {
    if($i == 0) {
        $day = date('l');
    } else {
        $day = date('l', strtotime($today . " + {$i} days"));
    }
    array_push($daysOfWeekNextSevenDays, $day);
}


$sql = "SELECT * FROM workouts w INNER JOIN users u ON w.userID = u.userID WHERE username = ? 
AND workoutDate >= ? AND workoutDate <= ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION["username"], $today, $weekAfterToday]);

$nextSevenDaysWorkouts = array();

if($stmt->rowCount() < 1) {
    for($i=0;$i<7;$i++)
        array_push($nextSevenDaysWorkouts, 'No Workout');
}
if($stmt->rowCount() > 0)
    $nextSevenDaysWorkouts = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the site.</h1>

    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    <br>
    <h5>Here's what you have going on this week</h3>
    
    <div class="container-week">
        <?php
        for($i = 0; $i < 7; $i++) {
            //echo "<div class=\"week-glance-item\">";
            echo "<div class=\"week-glance-item\">{$daysOfWeekNextSevenDays[$i]}</div>";
            //echo "<div class=\"week-glance-item-sub\">{$nextSevenDaysWorkouts[$i]}</div>";
            //echo "</div>";
        }
        for($i = 0; $i < 7; $i++) {
            echo "<div class=\"week-glance-item\">{$nextSevenDaysWorkouts[$i]}</div>";
        }
        ?>
    </div>
</body>
</html>