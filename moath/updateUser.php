<?php
error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization,  X Request-With');

include('fun.php');


if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $insertuser = json_decode(file_get_contents("php://input"), true);
    $result = updateUser($insertuser, $_GET);
    echo $result;

} else {
    $out = [
        'status' => 405,
        'message' => $_SERVER["REQUEST_METHOD"] . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");

    echo json_encode($out);
}





?>