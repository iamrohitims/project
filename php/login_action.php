<?php
session_start();
require 'db_connection.php';

//post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);//for password use md5 encryption for security

    //matching username and password in database 
    $stmt = $conn->prepare("SELECT id FROM teachers WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    //if result matched then creating a session variable and storing user id in it 
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['teacher_id'] = $user['id'];
        header("Location: ../admin/index.php");
        exit();
    } else {
        // when username and password is invalid then returning a error in url (encode) 
        $error = "Invalid username or password.";
        header("Location: ../index.php?error=".$error);
    }
}
?>
