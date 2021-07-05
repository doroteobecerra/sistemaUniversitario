<?php

$conn = new mysqli('localhost','root','','proyecto');

if($conn->connect_error){
    echo $error -> $conn->connect_error;
}