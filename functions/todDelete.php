<?php
header('Content-Type: application/json');


$id = $_POST['id'];

include('./connect.php');
$delete = "DELETE FROM `todo` WHERE id = $id";
$query = $con->query($delete);


if($query){
    
        echo json_encode("success");
}