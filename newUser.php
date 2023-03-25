<?php
include "func.php";
echo "<pre>";
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $allowed = ["name", "email", "pass", "pass2", "room", "ext"];
    $required = ["name", "email", "pass", "pass2", "room"];
    $_POST = array_intersect_key($_POST, array_flip($allowed));

//    var_dump($_POST);
//    var_dump($_FILES);

//    exit;
//    echo $_POST['pass']." <br>";
//    echo preg_match("/[a-z0-9_]{8}/", $_POST['pass'])." <br>";
    foreach ($allowed as $key) {
        if (!isset($_POST[$key])) {
            $errors[$key] = " is required";
        } else {
//            echo $key." is set <br>";
            if (in_array($key, $required) && empty($_POST[$key]))
                $errors[$key] = " is required and can't be empty";
            elseif ($key == "pass" && (
//                    strlen($_POST['pass']) != 8 ||
                !preg_match("/[a-z0-9_]{8}/", $_POST['pass']) ////////////////// BONUS
                )
            )
                $errors[$key] = " must be 8 chars contains only chars, numbers and _ ";
            elseif ($key == "pass2" && $_POST['pass'] != $_POST['pass2'])
                $errors[$key] = " must be equal to pass";
            elseif ($key == "name" && strlen($_POST['name']) < 5)
                $errors[$key] = " can't be less than 5";
            elseif ($key == "email" && !empty($_POST['email'])
                && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
                //    && !preg_match("/[a-zA-Z0-9_]+@gmail\.com/", $_POST['email'])
            )
                $errors[$key] = " must be valid email";
            elseif ($key == "room" && !in_array($_POST['room'], ["Cloud", "Application2", "Application1"]))
                $errors[$key] = " must be one of Cloud, Application2, Application1";
        }
    }
    $id = microtime(true) * 10000;
    $photo = "";
    if (empty($_FILES['photo']['name']) || $_FILES['photo']['size'] == 0)
        $errors['photo'] = "photo is required";
    else {
        $allowedTypes = ["image/png", "image/jpg", "image/jpeg"];
        if (!in_array($_FILES['photo']['type'], $allowedTypes))
            $errors['photo'] = "photo is required and must be png, jpg or jpeg";
        else {
            $photo = $_FILES['photo']['name'];
            $tmp = $_FILES['photo']['tmp_name'];
            if (!is_dir("uploads"))
                mkdir("uploads");
            $photo = "uploads/$id-$photo";
            move_uploaded_file($tmp, $photo);
        }
    }
    if (!$errors) {
        $file = fopen("new_users.txt", "a+");

        $data = "{$id}:{$_POST['email']}:{$_POST['pass']}:{$_POST['name']}:{$_POST['room']}:{$_POST['ext']}:{$photo}\n";
        fwrite($file, $data);
        fclose($file);
        $_POST = [];
        echo '<div class="alert alert-success d-flex align-items-center text-center w-75 m-auto" role="alert"><span class="w-100 text-center">User Added Successfully</span</div>';

//        header("Location:new_users.php");
//        exit;
    } else {
        if (!empty($photo))
            unlink($photo);
    }
//    var_dump($errors);
}

echo "</pre>";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>New User Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"/>
</head>

<body>
<div class="container my-5 py-5 w-75 shadow-lg">
    <h1 class="text-center">Cafeteria</h1>
    <form action="newUser.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name : </label>
            <input name="name" type="text" class="form-control" id="name" value="<?php echo value_exists("name") ?>">
            <?php if ($errors && isset($errors['name']) && !empty($errors['name'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['name'] ?>
                </div>
            <?php } ?>
        </div>
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
        <div class="mb-3">
            <label for="pass2" class="form-label">Confirm Password : </label>
            <input name="pass2" type="password" class="form-control" id="pass2"
                   value="<?php echo value_exists("pass2") ?>">
            <?php if ($errors && isset($errors['pass2']) && !empty($errors['pass2'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['pass2'] ?>
                </div>
            <?php } ?>
        </div>
        <!-- select -->
        <div class="mb-3">
            <label for="room" class="form-label">Room number : </label>
            <select name="room" class="form-select" aria-label="Default select example">
                <option selected disabled>Select One</option>
                <option
                    <?php echo (value_exists("room") == "Application1") ? 'selected' : '' ?>
                        value="Application1">Application1
                </option>
                <option
                    <?php echo (value_exists("room") == "Application2") ? 'selected' : '' ?>
                        value="Application2">Application2
                </option>
                <option
                    <?php echo (value_exists("room") == "Cloud") ? 'selected' : '' ?>
                        value="Cloud">Cloud
                </option>
            </select>
            <?php if ($errors && isset($errors['room']) && !empty($errors['room'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['room'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="ext" class="form-label">Ext : </label>
            <input name="ext" type="text" class="form-control" id="ext" value="<?php echo value_exists("ext") ?>">
            <?php if ($errors && isset($errors['ext']) && !empty($errors['ext'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['ext'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo : </label>
            <input name="photo" type="file" class="form-control" id="photo"
                   value="<?php echo $_FILES['photo']['name'] ?>">
            <?php if ($errors && isset($errors['photo']) && !empty($errors['photo'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['photo'] ?>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</body>

</html>