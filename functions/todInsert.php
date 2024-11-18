<?php
header('Content-Type: application/json');

// print_r($_POST);

// die();

include('connect.php');
$toDo = $_POST['todo'];

$insert = "INSERT INTO `todo`(`toDoName`) VALUES ('$toDo')";
$query = $con->query($insert);


if($query){
    $lastId = $con->insert_id;

    $sel = "SELECT * FROM `todo` where id = $lastId";
    $queryAll = $con->query($sel);
    $res = $queryAll->fetch_assoc();

    echo json_encode($res);
    

}

