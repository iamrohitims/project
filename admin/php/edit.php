<?php
require '../../php/db_connection.php';

//request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];
    
    //calling addstudent function and storing in result variable to send back the response
    $result = addStudent($conn, $name, $subject, $marks);
    echo json_encode(['status' => 'success', 'message' => $result ]);
}

function addStudent($conn, $name, $subject, $marks) {
    $stmt = $conn->prepare("SELECT id, marks FROM students WHERE name = ? AND subject = ?");
    $stmt->bind_param("ss", $name, $subject);
    $stmt->execute();
    $result = $stmt->get_result();

    //if student name and subject present updating the same field
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $newMarks = $row['marks'] + $marks; //adding Markes to prvious marks on update 
        $stmt = $conn->prepare("UPDATE students SET marks = ? WHERE id = ?");
        $stmt->bind_param("ii", $newMarks, $row['id']);
        if ($stmt->execute()) {
            //query executed sending return response which will be stored in result var
            return "Student updated successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    } 
    //student and subject names are diffrent creating a new record
    else {
        $stmt = $conn->prepare("INSERT INTO students (name, subject, marks) VALUES (?, ?, ?)");
        if (!$stmt) {
            return "Error: " . $conn->error;
        }
        $stmt->bind_param("ssi", $name, $subject, $marks);
        if ($stmt->execute()) {
            //returning response with this message to result variable
            return "Student added successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
?>
