<?php
require_once "func.php";
session_start();
if (isset($_SESSION['email'])) {
    header("Location: welcome.php");
    exit;
}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $allowed = ["email", "pass"];
    $_POST = array_intersect_key($_POST, array_flip($allowed));
    foreach ($allowed as $key) {
        if (!isset($_POST[$key])) $errors[$key] = " is required";
    }

    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $users = file("new_users.txt");
    $user = array_filter($users, function ($user) use ($email, $pass) {
        $user_info = explode(":", trim($user));
        return ($user_info && $user_info[1] == $email && $user_info[2] == $pass);
    });
    if ($user) {

        $_SESSION['email'] = $_POST['email'];
        header("Location: welcome.php");
        exit;
    }
    else{
        $errors['error'] = '<div class="alert alert-danger d-flex align-items-center text-center w-75 m-auto" role="alert"><span class="w-100 text-center">Login Failed</span></div>';
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"/>
</head>

<body>
<div class="container my-5 py-5 w-75 shadow-lg">
    <h1 class="text-center">Cafeteria</h1>
    <?php if (isset($errors) && isset($errors['error']))echo $errors['error']; ?>
    <form action="login.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="email" class="form-label">Email : </label>
            <input name="email" type="email" class="form-control" id="email"
                   value="<?php echo value_exists("email") ?>">
            <?php if ($errors && isset($errors['email']) && !empty($errors['email'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['email'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Password : </label>
            <input name="pass" type="password" class="form-control" id="pass"
                   value="<?php echo value_exists("pass") ?>">
            <?php if ($errors && isset($errors['pass']) && !empty($errors['pass'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['pass'] ?>
                </div>
            <?php } ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</body>

</html>