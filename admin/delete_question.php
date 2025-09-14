<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include '../db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM questions WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: dashboard.php");
exit;
?>
