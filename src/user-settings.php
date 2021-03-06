<?php
    session_start();
    include('./user-info.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; background-color: #F5FCFC; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="welcome.php">IronWorks</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="welcome.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="exercise-library.php">Library</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="monthly-calendar.php">Calendar</a>
        </li>  
        <li class="nav-item">
            <a class="nav-link" href="add-workout.php">New Workout</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="complete-workout.php">Complete Workout</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view-workout.php">View Workout</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="user-settings.php">Settings <span class="sr-only">(current)</span></a>
        </li>
        </ul>
        <a href="logout.php" class="btn btn-secondary" style="margin-left: auto; margin-right: 0;">Log Out</a>
    </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
                <div class="card m-4" style="width: 20rem;">
                    <img class="card-img-top" src="../muscleGroupImages/blank-profile-picture.png" alt="profile picture">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php displayUserInfo($pdo); ?>
                            <li class="list-group-item"><a href="./reset-password.php" class="btn btn-warning">Reset Your Password</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card m-4" style="width: 20rem;">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group m-4">
                            <label for="newUsername">Update Username</label>
                            <input type="text" class="form-control" name="newUsername" placeholder="Enter a new username" required>
                        </div>
                        <div class="form-group m-4">
                            <label for="newFname">Update First Name</label>
                            <input type="text" class="form-control" name="newFname" placeholder="Enter a new first name" required>
                        </div>
                        <div class="form-group m-4">
                            <label for="newLname">Update Last Name</label>
                            <input type="text" class="form-control" name="newLname" placeholder="Enter a new last name" required>
                        </div>
                        <div class="form-group m-4">
                            <label for="newHeight">Update Height</label>
                            <input type="number" class="form-control" name="newHeight" placeholder="Enter a new height in inches" required>
                        </div>
                        <div class="form-group m-4">
                            <label for="newWeight">Update Weight</label>
                            <input type="number" class="form-control" name="newWeight" placeholder="Enter a new weight in lbs" required>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" name="submitUserInfo">Update Info</button>
                    </form>
                    <?php updateUserInfo($pdo); ?>
                </div>
        </div>
    </div>
</body>
</html>