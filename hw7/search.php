<?php
    // connect database 
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "etz";

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    // check connection error 
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    } else {
        // connect success, do nothing
        // echo "Connect success.";
    }

    // $kw = $_GET['kw'];
    $kw = $_POST['kw']; 
    $typ = $_POST['typ'];
    if ($typ == 1){
        $sql = "SELECT *
        FROM music
        WHERE musicName LIKE '%$kw%'";
        $result = $mysqli->query($sql);
    } else{
        $sql = "SELECT *
        FROM music
        WHERE   musicName LIKE '%$kw%' AND albumName LIKE '%$typ%'";
        $result = $mysqli->query($sql);
    }
    $typ = $_POST['typ']; 
    $sql = "SELECT *
            FROM music
            WHERE artistname LIKE '%$kw%' OR albumName LIKE '%$kw%'";
    $result = $mysqli->query($sql);

    $arr = array();
    if ($result->num_rows > 0){
        // Convert MySQL Result Set to PHP Array of object
        while($row = $result->fetch_object())
        {
            $arr[] = $row;
        }
    } else {
        // echo "Not found.";
    }
    echo json_encode($arr);


    // $name = $_POST['name'];
    // $addr = $_POST['addr'];
    // $email = $_POST['email'];
    // $user = $_POST['user'];
    // $pass = $_POST['pass'];
    // $sql = "INSERT INTO registers (id, name, address, email, username, password) 
    //         VALUES (NULL, '$name', '$addr', '$email', '$user', '$pass')";
    // $result = $mysqli->query($sql);