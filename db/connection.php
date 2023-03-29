<?php
class DbConnection {
    private PDO $con;
    function __construct()
    {
        $dsn = "mysql:host=localhost;";
        $this->con = new PDO($dsn, "root", "");
        $res = $this->con->exec("CREATE DATABASE IF NOT EXISTS php_users DEFAULT CHARACTER SET utf8");
    //    var_dump($res);
        $this->con->exec("USE php_users");
        $stmt = $this->con->prepare(
            "CREATE TABLE IF NOT EXISTS users 
            (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            pass VARCHAR(255) NOT NULL,
            room VARCHAR(255) NOT NULL,
            ext VARCHAR(255) NOT NULL,
            photo VARCHAR(255) NOT NULL
            )"
        );
        $stmt->execute();


    }
    function addUser($name, $email, $pass, $room, $ext, $photo): bool
    {
        $stmt = $this->con->prepare("INSERT INTO `users` (name, email, pass, room, ext, photo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $name,
            $email,
            $pass,
            $room,
            $ext,
            $photo
        ]);
        return ($stmt->rowCount() == 1);
    }
    function deleteUser($id): bool
    {
        $stmt = $this->con->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return ($stmt->rowCount() == 1);
    }
    function updateUser($id, $name, $email, $pass, $room, $ext, $photo): bool
    {
        $stmt = $this->con->prepare("UPDATE users SET name = :name, email = :email, pass = :pass, room = :room, ext = :ext, photo = :photo WHERE id = :id");
        $res = $stmt->execute([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'pass' => $pass,
            'room' => $room,
            'ext' => $ext,
            'photo' => $photo
        ]);
//        var_dump($res);
//        return ($stmt->rowCount() == 1);
        return ($res);
    }
    function getUser($id): array
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function getUsers(): array
    {
        $stmt = $this->con->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
//echo __DIR__.DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."1.jpg";
//$db = con();
#$stmt = $con->prepare("INSERT INTO users (name, email, pass, room, ext, photo) VALUES (:name, :email, :pass, :room, :ext, :photo)");
