<?php

//------------Crear Sesion------------------------

session_start();

//------------Conexion a BD Local-----------------

include 'CONN/conn_bd_uei_forms.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$conn->set_charset("utf8");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
    $imgData = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
    $sql = "UPDATE users SET imagen = '{$imgData}' WHERE user = '{$_SESSION['user']}'";
    mysqli_query($conn, $sql);

    header("location:home.php");
}else{
    echo 'FILE NOT UPLOADED';
}

