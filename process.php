<?php

session_start();

$mysqli = new mysqli('%', 'mojo9900', 'mojtaba52', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$email = '';
$salary = '';

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];

    $mysqli ->query("INSERT INTO data (name, email, salary) VALUES('$name', '$email', '$salary')")
    or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: php_crud.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli ->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: php_crud.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli ->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if (count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $email = $row['email'];
        $salary = $row['salary'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];

    $mysqli->query("UPDATE data SET name='$name', email='$email', salary='$salary' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: php_crud.php");
}