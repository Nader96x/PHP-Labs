<?php
//require_once "conn.php";
require_once "connection.php";


$db = new DbConnection();
$users = $db->getUsers();

?>
<?php require_once "static/header.php"; ?>
<h1 class="text-center text-decoration-underline">Users</h1>
<table class="table  table-dark table-striped table-hover table-bordered rounded text-center align-middle">


    <thead>
    <tr>
        <th>#</th>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>room</th>
        <th>ext</th>
        <th>photo</th>
        <th>Edit</th>
        <th>Delete</th>

    </tr>
    </thead>

    <tbody>
    <?php
    $i = 0;
    foreach ($users as $user) {
        $i++;
        echo "
                <tr>
                    <td>{$i}</td>
                    <td>{$user["id"]}</td>
                    <td>{$user["name"]}</td>  
                    <td>{$user["email"]}</td>
                    <td>{$user["room"]}</td>
                    <td>{$user["ext"]}</td>
                    <td><img src='{$user["photo"]}' width='150px' height='150px'></td>
                    <td><a href='edit.php?id={$user["id"]}' class='btn btn-warning'>Edit</a></td>
                    <td><a href='delete.php?id={$user["id"]}' class='btn btn-danger'>Delete</a></td>
                </tr>
                ";
    }; ?>
    </tbody>
</table>

<?php require_once "static/footer.php"; ?>
