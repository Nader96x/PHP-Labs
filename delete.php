<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $users = file("users.txt");
    // echo "<pre>";
    $users = array_filter($users, function ($user) use ($id) {
        $user = explode(":", $user);
        return $user[0] != $id;
    });
    // var_dump($users);
    // echo "</pre>";
    file_put_contents("users.txt", implode("", $users));
}
header("location:users.php");
exit;
