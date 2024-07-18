<?php
require '../../php/db_connection.php';

//post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    // sending request to delete function and storing in result var
    $result = deleteStudent($conn, $id);
    echo json_encode(['status' => 'success', 'message' => $result ]);
}

function deleteStudent($conn, $id) {
    //searching and deleting student if found in database
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->execute()) {
        // returning response to result var
        return "Student Deleted successfully!";
    } else {
        return "Error: " . $stmt->error;
    }
}
?>
