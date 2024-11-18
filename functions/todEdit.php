<?php
header('Content-Type: application/json');
// print_r($_POST);
// Array
// (
//     [jsId] => 51
//     [jsName] => Est accusamus 
// )

$id = $_POST['jsId'];
$name = $_POST['jsName'];

include('./connect.php');

$update = "UPDATE `todo` SET `toDoName`='$name' WHERE id = $id";
$query = $con->query($update);

if($query){
    $sel = "SELECT * FROM `todo` WHERE id = $id";
    $querySel = $con->query($sel);
    $res = $querySel->fetch_assoc();

    echo json_encode($res);
}