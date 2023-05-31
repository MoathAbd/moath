<?php
require 'conn.php';

function error($msg)
{
    $out = [
        'status' => 422,
        'message' => $msg,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");

    echo json_encode($out);
    exit();
}

function getAllUser(){

    global $conn;
    $query = "select * from user";
    $run = mysqli_query($conn, $query);

    if ($run) {

        if (mysqli_num_rows($run) > 0) {

            $result = mysqli_fetch_all($run, MYSQLI_ASSOC);
            $out = [
                'status' => 200,
                'message' => 'Users Fetched Successfully',
                'data' => $result
            ];
            header("HTTP/1.0 200 OK");

            return json_encode($out);
        } else {
            $out = [
                'status' => 404,
                'message' => 'No user Found',
            ];
            header("HTTP/1.0 404 No user Found");

            return json_encode($out);
        }




    } else {
        $out = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");

        return json_encode($out);
    }


}

function deletUserById($userEnter){
    global $conn;
    if (!isset($userEnter['id'])) {
        return error('user id not found in URL');
    }elseif ($userEnter['id'] == null) {
        return error('Enter the user id');
    }
    $userId = mysqli_real_escape_string($conn, $userEnter['id']);
    $query = "DELETE FROM user WHERE id='$userId' limit 1";
    $run = mysqli_query($conn, $query);

    if ($run) {
        $out = [
            'status' => 200,
            'message' => 'user Delete Successfully',
        ];
        header("HTTP/1.0 200 OK");

        return json_encode($out);
    }
}

function insertuser($input){
    global $conn;

    $name = mysqli_real_escape_string($conn, $input['name']);
    $email = mysqli_real_escape_string($conn, $input['email']);
    $age = mysqli_real_escape_string($conn, $input['age']);
    $password = mysqli_real_escape_string($conn, $input['password']);


    if (empty(trim($name))) {

        return error('Enter Your name');
    } elseif (empty(trim($email))) {


        return error('Enter Your email');
    } elseif (empty(trim($age))) {



        return error('Enter Your age');
    }elseif (empty(trim($password))) {
        return error('Enter Your password');
    } 
    else 
  {
 
    $query = "INSERT INTO `user`( `name`, `email`, `age`, `password`) VALUES ('$name','$email','$age','$password')";
    $run = mysqli_query($conn, $query);
    if ($run) {
        $out = [
            'status' => 201,
            'message' => 'user Created Successfully',
        ];
        header("HTTP/1.0 201 Created");

        return json_encode($out);
    } else {
        $out = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");

        return json_encode($out);
    }

   }


}

function updateUser($userinput, $userEnter){
    global $conn;

    if (!isset($userEnter['id'])) {
        return error422('Book id not found in URL');
    }elseif ($userEnter['id']== null) {
        return error422('Enter the book id');
    }

    $userId = mysqli_real_escape_string($conn, $userEnter['id']);
    $name = mysqli_real_escape_string($conn, $userinput['name']);
    $email = mysqli_real_escape_string($conn, $userinput['email']);
    $age = mysqli_real_escape_string($conn, $userinput['age']);
    $password = mysqli_real_escape_string($conn, $userinput['password']);


    if (empty(trim($name))) {
        return error('Enter the book name');
    } elseif (empty(trim($email))) {
        return error('Enter the email');
    } elseif (empty(trim($age))) {
        return error('Enter the age');
    }elseif (empty(trim($password))) {
        return error('Enter Your password');
    } else {
        $query = "UPDATE `user` SET `name`='$name', `email`='$email', `age`='$age',`password`='$password' WHERE id='$userId' LIMIT 1";
        $ren = mysqli_query($conn, $query);

        if ($ren) {
            $out = [
                'status' => 201,
                'message' => 'User updated successfully',
            ];
            header("HTTP/1.0 201 Created");
            return json_encode($out);
        } else {
            $out = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($out);
        }
    }
}

?>