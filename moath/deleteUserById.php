<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization,  X Request-With');

include('fun.php');

if ($_SERVER["REQUEST_METHOD"] == "DELETE"){

    $delet = deletUserById($_GET);
    echo $delet;

    
}else{

    $out = [
        'status' => 405,
        'message' => $_SERVER["REQUEST_METHOD"]. ' Method Not Allowed',
    ];
        header("HTTP/1.0 405 Method Not Allowed");

        echo json_encode($out);
}    




?>