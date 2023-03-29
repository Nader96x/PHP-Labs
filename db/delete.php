<?php
//require_once "conn.php";
require_once "connection.php";
if (isset($_GET['id'])) {

    $id = $_GET['id'];
//    $db = con();
//    $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
//    $stmt->execute(['id' => $id]);
    $db = new DbConnection();
    $db->deleteUser($id);

}
header("location:users.php");
exit;
