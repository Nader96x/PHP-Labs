<?php

$errors = [];
if($_GET && in_array("errors",$_GET)){
    $errors = json_decode($_GET['errors'],true);
}

$user = [];
if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET["id"] ){
        $id = $_GET['id'];
        echo $id."<br>";
        $users = file("users.txt");
        $users =array_filter($users,function($user) use($id){
            $user = explode(":",$user);
            return $user[0] == $id;
        });
        foreach($users as $user) {
            $user = explode(":",trim($user));
            $user[6] = explode(",",$user[6]);
            break;
        }
        if (!$user){
            header("location:users.php");
            exit;
        }
//    echo "<pre>";
//    var_dump($user);
//    echo "</pre>";

}else{
    header("location:users.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 1 </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>

<div class="container">
    <form method="POST" action="users.php">
        <div class="mb-3">
            <label for="fname" class="form-label">First Name : </label>
            <input name="fname" type="text" class="form-control" id="fname" value="<?php echo $user[1]?>">
            <?php if($errors && isset($errors['fname']) && !empty($errors['fname'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['fname'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name : </label>
            <input name="lname" type="text" class="form-control" id="lname" value="<?php echo $user[2]?>">
            <?php if($errors && isset($errors['lname']) && !empty($errors['lname'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['lname'] ?>
                </div>
            <?php } ?>

        </div>
        <!-- textarea -->
        <div class="mb-3">
            <label for="address" class="form-label">Address :</label>
            <textarea name="address" class="form-control" id="address" rows="3"><?php echo $user[4]?></textarea>
            <?php if($errors && isset($errors['address']) && !empty($errors['address'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['address'] ?>
                </div>
            <?php } ?>

        </div>
        <!-- select -->
        <select name="country" class="form-select" aria-label="Default select example">
            <option disabled>Open this select menu</option>
            <option <?php echo ($user[5]=='EG')? 'selected':''?> value="EG">Egypt</option>
            <option <?php echo ($user[5]=='EG')? 'selected':''?> value="UK">United Kingdom</option>
            <option <?php echo ($user[5]=='EG')? 'selected':''?> value="US">United States</option>
        </select>
        <?php if($errors && isset($errors['country']) && !empty($errors['country'])){ ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors['country'] ?>
            </div>
        <?php } ?>
        <!-- Radio checkboxes -->
        <div class="row my-3">
            <div class="col-2">
                <label for="gender" class="form-label">Gender :</label>
            </div>
            <div class="form-check col-2">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo ($user[3]=='male')? 'checked':''?> >
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check col-2">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php echo ($user[3]=='female')? 'checked':''?>>
                <label class="form-check-label" for="female">Female</label>
            </div>
            <?php if($errors && isset($errors['gender']) && !empty($errors['gender'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['gender'] ?>
                </div>
            <?php } ?>
        </div>
        <!-- Checkboxes -->
        <div class="row">
            <div class="mb-3 form-check col-4">
                <input name="langs[]" type="checkbox" class="form-check-input" id="php" value="PHP" <?php echo (in_array("PHP",$user[6]))? 'checked':''?> >
                <label class="form-check-label" for="php">PHP</label>
            </div>
            <div class="mb-3 form-check col-4">
                <input name="langs[]" type="checkbox" class="form-check-input" id="js" value="JavaScript" <?php echo (in_array("JavaScript",$user[6]))? 'checked':''?> >
                <label class="form-check-label" for="js">JS</label>
            </div>
            <div class="mb-3 form-check col-4">
                <input name="langs[]" type="checkbox" class="form-check-input" id="python" value="Python" <?php echo (in_array("Python",$user[6]))? 'checked':''?> >
                <label class="form-check-label" for="python">Python</label>
            </div>
            <div class="mb-3 form-check col-4">
                <input name="langs[]" type="checkbox" class="form-check-input" id="perl" value="Perl" <?php echo (in_array("Perl",$user[6]))? 'checked':''?> >
                <label class="form-check-label" for="perl">Perl</label>
            </div>
            <div class="mb-3 form-check col-4">
                <input name="langs[]" type="checkbox" class="form-check-input" id="ruby" value="Ruby" <?php echo (in_array("Ruby",$user[6]))? 'checked':''?> >
                <label class="form-check-label" for="ruby">Ruby</label>
            </div>

            <div class="mb-3 form-check col-4">
                <input name="langs[]" type="checkbox" class="form-check-input" id="go" value="Go Lang" <?php echo (in_array("Go Lang",$user[6]))? 'checked':''?> >
                <label class="form-check-label" for="go">Go Lang</label>
            </div>
            <?php if($errors && isset($errors['langs']) && !empty($errors['langs'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['langs'] ?>
                </div>
            <?php } ?>

        </div>
        <!-- login -->
        <div class="mb-3">
            <label for="username" class="form-label">username : </label>
            <input name="username" type="text" class="form-control" id="username" value="<?php echo $user[7]?>">
            <?php if($errors && isset($errors['username']) && !empty($errors['username'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['username'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Password : </label>
            <input name="pass" type="text" class="form-control" id="pass" value="<?php echo $user[8]?>">
            <?php if($errors && isset($errors['pass']) && !empty($errors['pass'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['pass'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Department : </label>
            <input name="department" readonly value="<?php echo $user[9]?>" type="text" class="form-control" id="department">
            <?php if($errors && isset($errors['department']) && !empty($errors['department'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors['department'] ?>
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
