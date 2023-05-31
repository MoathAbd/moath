<?Php

$conn = mysqli_connect("localhost" ,"root", "" , "university");

if(!$conn){
    dir("There is a problem to connect DataBase : ") ;
}else{
    return $conn;
}

?>