<?php
$alert = false;
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'partials/_dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $exists = false;
    // $error = false;
    $sql = "SELECT username FROM users WHERE username = '$username'";
    $checkSQL = mysqli_query($conn, $sql);

    if (mysqli_num_rows($checkSQL) != 0) {
        $exists = true;
    }
    if (($password == $cpassword) && $exists == false) {
        $sql = "INSERT INTO `users`(`username`, `password`,`date`) VALUES ('$username','$password',current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $alert = true;
        }
    } else {
        $showError = "Passwords do not match or the username already exists.";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGNUP</title>
    <style>
        <?php require 'css/signup.css'; ?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php require 'partials/_nav.php'; ?>
    <?php
    if ($alert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>SUCCESS</strong> Your Account was succesfully created.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ERROR</strong> ' . $showError . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>


    <div class="container">
        <h1>Don't Have an account? Signup</h1>
        <form action="/login_system/signup.php" method="post">
            <div class="mb-3 items">
                <label for="username" class="form-label">
                    <h4>Username</h4>
                </label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 items">
                <label for="password" class="form-label">
                    <h4>Password</h4>
                </label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 items">
                <label for="cpassword" class="form-label">
                    <h4>Confirm Password</h4>
                </label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>