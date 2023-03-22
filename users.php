<?php
// validation
// fname,lname,username,password,gender

if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $allowed = ["fname","lname","address","country","gender","langs","username","pass","department"];
        $required = ["fname","lname","gender","username","pass"];
        $errors = [];
        $_POST = array_intersect_key($_POST,array_flip($allowed));
        var_dump($_POST);
        foreach($allowed as $key){
            if(!isset($_POST[$key])){
                $errors[$key] = $key." is required";
            }else {
                if (in_array($key, $required) && empty($_POST[$key]))
                    $errors[$key] = $key . " is required and can't be empty";
                elseif ($key == "gender" &&  !in_array($_POST['gender'], ["male", "female"]) )
                    $errors[$key] = $key . " is one Of [male,female].";
                elseif ($key == "pass" && strlen($_POST['pass']) < 8)
                    $errors[$key] = $key . " is required and can't be empty and can't be less than 8";
                elseif ($key == "username" && strlen($_POST['username']) < 8)
                    $errors[$key] = $key . " is required and can't be empty and can't be less than 8";
                elseif ($key == "country" && !in_array($_POST['country'], ["EG", "UK", "US"]))
                    $errors[$key] = $key . " is one Of [EG,UK,US].";
                elseif ($key == "fname" && strlen($_POST['fname']) < 3)
                    $errors[$key] = $key . " is required and can't be empty and can't be less than 3";
                elseif ($key == "lname" && strlen($_POST['lname']) < 3)
                    $errors[$key] = $key . " is required and can't be empty and can't be less than 3";
            }


        }
        if($errors){
            header("Location:index.php?errors=".json_encode($errors)."&old=".json_encode($_POST));
        }else{
            $file = fopen("users.txt","a+");
            $id = microtime(    true)*10000;
            $langs = implode(",",$_POST['langs']);
            $data = "{$id}:{$_POST['fname']}:{$_POST['lname']}:{$_POST['gender']}:{$_POST['address']}:{$_POST['country']}:{$langs}:{$_POST['username']}:{$_POST['pass']}:{$_POST['department']}\n";
            fwrite($file,$data);
            fclose($file);
            header("Location:users.php");
        }
    exit;
}
$users = file("users.txt");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center text-decoration-underline">Users</h1>
        <table class="table  table-dark table-striped table-hover table-bordered rounded text-center align-middle">


            <head>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>Skills</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Department</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </head>

            <body>
                <?php
                $i=0;
                foreach($users as $user){
                    $user = explode(":",$user);
                    $i++;
                echo"
                <tr>
                    <td>{$i}</td>
                    <td>{$user[0]}</td>
                    <td>{$user[1]}</td>
                    <td>{$user[2]}</td>
                    <td>{$user[3]}</td>
                    <td>{$user[4]}</td>
                    <td>{$user[5]}</td>
                    <td>{$user[6]}</td>
                    <td>{$user[7]}</td>
                    <td>{$user[8]}</td>
                    <td>{$user[9]}</td>
                    <!--
                    <td>
                    <form action='edit.php' method='get'>
                    <input type='hidden' name='id' value='{$user[0]}'>
                    <input type='submit' value='Edit' class='btn btn-warning'>
                    </form>
                    </td>
                    -->
                    <td><a href='edit.php?id={$user[0]}' class='btn btn-warning'>Edit</a></td>
                    <td><a href='delete.php?id={$user[0]}' class='btn btn-danger'>Delete</a></td>
                </tr>
                ";
                 }; ?>
            </body>
        </table>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>