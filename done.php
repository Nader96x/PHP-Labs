<?php
echo "<pre>";
var_dump($_POST);
echo "</pre>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
if($_POST['gender'] == "male"){
    echo "<h1> Thanks Mr. {$_POST['fname']} {$_POST['lname']}</h1>";
}else{
    echo "<h1> Thanks Miss. {$_POST['fname']} {$_POST['lname']}</h1>";
}
echo "<h3> Your Name : {$_POST['fname']} {$_POST['lname']}</h3>";
echo "<h3> Your Address is : {$_POST['address']}</h3>";
echo "<h3> Your Department is : {$_POST['department']}</h3>";
echo "<h3>Your Skills</h3>";
foreach ($_POST['langs'] as $key => $value)
    echo $value,"<br>";

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";


?>