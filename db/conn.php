<?php
function con()
{
    $dsn = "mysql:host=localhost;";
    $con = new PDO($dsn, "root", "");
    $res = $con->exec("CREATE DATABASE IF NOT EXISTS php_users DEFAULT CHARACTER SET utf8");
//    var_dump($res);
    $con->exec("USE php_users");
    $stmt = $con->prepare("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    room VARCHAR(255) NOT NULL,
    ext VARCHAR(255) NOT NULL,
    photo VARCHAR(255) NOT NULL
)");
    $stmt->execute();

    return $con;
}
//echo __DIR__.DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."1.jpg";
//$db = con();
#$stmt = $con->prepare("INSERT INTO users (name, email, pass, room, ext, photo) VALUES (:name, :email, :pass, :room, :ext, :photo)");
