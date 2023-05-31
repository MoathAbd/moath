<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization,  X Request-With');

include('fun.php');

if ($_SERVER["REQUEST_METHOD"] == "GET"){
   
    $users = getAllUser();
    echo $users;
}
else{

    $out = [
        'status' => 405,
        'message' => $_SERVER["REQUEST_METHOD"]. ' Method Not Allowed',
    ];
        header("HTTP/1.0 405 Method Not Allowed");

        echo json_encode($out);
}    




?>