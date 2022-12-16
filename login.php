<?php
ob_start();
require_once "config.php";
require_once "functions.php";
if (isset($_SESSION['uid']) && ($_SESSION['role'] == '1')) {
    header('location:dashboard.php');
} else if (isset($_SESSION['uid']) && ($_SESSION['role'] == '0')) {
    echo '<script>history.back();</script>';
} else {

    $img = random_int(1, 9);
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Admin Login</title>
    </head>

    <body class="text-center vh-100 overflow-hidden">
        <div class="row m-0 h-100">
            <div class="col-12 col-lg-5 d-none d-md-block p-0 position-relative">
            </div>
            <div class="col-12 col-lg-7">
                <main class="form-signin mw-350px p-4 w-100 m-auto vh-100 d-flex align-items-center">
                    <form method="POST" action="" class="w-100 d-grid gap-2">
                        <a href="#" class="position-relative has-tooltip tooltip-bottom" data-tooltip="Go to Home"><img class="mx-auto w-100px h-100px" src="./img/logos/logo.png" alt="GoAlert Logo"></a>
                        <h1 class="h3 mb-3 fw-bolder">Please sign in</h1>
                        <div class="">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="username" placeholder="@username" name="username" autocomplete="username">
                                <label class="fw-semibold" for="username">Username</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" autocomplete="current-password">
                                <label class="fw-semibold" for="password">Password</label>
                            </div>
                        </div>
                        <a href="forgot-password.php" class="fw-semibold hover-text-decoration-underline link-warning ms-auto text-decoration-none text-sm w-max">Forgot
                            Password?</a>
                        <button class="spinner w-100 btn btn-lg btn-primary fw-semibold" type="submit" name="login">Signin</button>
                    </form>
                </main>
            </div>
        </div>
    </body>
    </html>

<?php
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $username = sanitize($_POST['username']);
        $password = sanitize($_POST['password']);
        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );
        $checkUserifExist = "SELECT COUNT(*) FROM users WHERE username=?";
        $UserifExist = $pdo->prepare($checkUserifExist);
        $UserifExist->execute([$username]);
        $ifExist = $UserifExist->fetchColumn();
        if ($ifExist == 1) {
            $admin = admin($pdo);
            $admin_role = "1";
            $sqlCheckPassword = "SELECT * FROM users WHERE uid=? AND username=? AND role=?";
            $checkPassword = $pdo->prepare($sqlCheckPassword);
            $checkPassword->execute([$admin, $username, $admin_role]);
            $fetched_password = $checkPassword->fetch();
            $password_verify = password_verify($password, $fetched_password["password"]);
            if ($password_verify) {
                $sqlCheckUser = "SELECT * FROM users WHERE username=?";
                $checkUser = $pdo->prepare($sqlCheckUser);
                $checkUser->execute([$username]);
                $user = $checkUser->fetch();
                $_SESSION['uid'] = $user['uid'];
                $_SESSION['role'] = $user['role'];
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<script>alert('Password is incorrect. Try Again!')</script>";
            }
        } else {
            echo "<script>alert('User is not exist. Try Again!')</script>";
        }
    }
}
?>
