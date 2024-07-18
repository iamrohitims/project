<?php 
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("Location: ../index.php");
    exit();
}
require '../php/db_connection.php'; 
?>

<!doctype html>
<html lang="en">
<head>
    <title>Teacher Portal Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
	<style>
		.modal {
		display: none;
		position: fixed;
		z-index: 1;
		padding-top: 60px;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgb(0,0,0);
		background-color: rgba(0,0,0,0.4);
		}

		.modal-content {
		background-color: #fefefe;
		margin: 5% auto;
		padding: 20px;
		border: 1px solid #888;
		width: 80%;
		}

		.close {
		color: #aaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
		}

		.close:hover,
		.close:focus {
		color: black;
		text-decoration: none;
		cursor: pointer;
		}


		.modal {
		display: none; 
		position: fixed; 
		z-index: 1; 
		left: 0;
		top: 0;
		width: 100%; 
		height: 100%; 
		overflow: auto; 
		background-color: rgb(0,0,0); 
		background-color: rgba(0,0,0,0.4); 
		padding-top: 60px;
		}

		.modal-content {
		background-color: #fefefe;
		margin: 5% auto; 
		padding: 20px;
		border: 1px solid #888;
		width: 80%;
		max-width: 600px;
		border-radius: 10px;
		box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
		}

		.close {
		color: #aaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
		}

		.close:hover,
		.close:focus {
		color: black;
		text-decoration: none;
		cursor: pointer;
		}

		.modal h2 {
		text-align: center;
		margin-bottom: 20px;
		color: #333;
		}

		.modal form {
		display: flex;
		flex-direction: column;
		}

		.modal form label {
		font-size: 16px;
		margin-bottom: 8px;
		color: #555;
		}

		.modal form input[type="text"] {
		padding: 10px;
		margin-bottom: 20px;
		border: 1px solid #ccc;
		border-radius: 5px;
		font-size: 14px;
		}

		.modal form input[type="submit"] {
		background-color: #28a745;
		color: white;
		border: none;
		padding: 12px 20px;
		border-radius: 5px;
		cursor: pointer;
		font-size: 16px;
		}

		.modal form input[type="submit"]:hover {
		background-color: #218838;
		}
	</style>
</head>
<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Teacher Portal Home</h2>
                </div>
            </div>
			<div class="row">
				<div class="col-md-6">
					<button id="addButton" class="btn btn-primary mb-3">Add New Entry</button>
				</div>
				<div class="col-md-6 text-right">
					<button id="LogoutButton" class="btn btn-primary mb-3" onclick="logout()">Log Out</button>
				</div>
			</div>
                    <div class="table-wrap">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Marks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM students";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
									//displaying results from database
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<th scope='row'>".$row['id']."</th>";
                                        echo "<td>".$row['name']."</td>";
                                        echo "<td>".$row['subject']."</td>";
                                        echo "<td>".$row['marks']."</td>";
                                        echo "<td>
                                                <div class='dropdown'>
                                                    <button class='dropbtn'>Action</button>
                                                    <div class='dropdown-content'>
                                                        <a href='#' class='edit' data-id='".$row['id']."'>Edit</a>
                                                        <a href='#' class='delete' data-id='".$row['id']."'>Delete</a>
                                                    </div>
                                                </div>
                                              </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit/Add Modal -->
		<div id="editModal" class="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			<h2 id="modalTitle">Edit Entry</h2>
			<form id="editForm">
				<input type="hidden" id="edit-id" name="id">
				<label for="edit-name">Name:</label>
				<input type="text" id="edit-name" name="name">
				<label for="edit-subject">Subject:</label>
				<input type="text" id="edit-subject" name="subject">
				<label for="marks">Marks:</label>
				<input type="text" id="marks" name="marks">
				<input type="submit" value="Save">
			</form>
		</div>
	</div>


    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
	<script>
    function logout() {
			window.location.href = 'Logout.php';
		}
	</script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const span = document.getElementsByClassName('close')[0];
        const addButton = document.getElementById('addButton');
        const modalTitle = document.getElementById('modalTitle');

        addButton.addEventListener('click', function() {
            modalTitle.innerText = 'Add New Entry';
            document.getElementById('edit-id').value = '';
            document.getElementById('edit-name').value = '';
            document.getElementById('edit-subject').value = '';
            document.getElementById('marks').value = '';
            editModal.style.display = 'block';
        });

        document.querySelectorAll('.edit').forEach(editButton => {
            editButton.addEventListener('click', function(event) {
                event.preventDefault();
                modalTitle.innerText = 'Edit Entry';
                const id = this.getAttribute('data-id');
                const row = this.closest('tr');
                const name = row.cells[1].innerText;
                const subject = row.cells[2].innerText;
                const marks = row.cells[3].innerText;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-subject').value = subject;
                document.getElementById('marks').value = marks;
                editModal.style.display = 'block';
            });
        });

        span.onclick = function() {
            editModal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == editModal) {
                editModal.style.display = 'none';
            }
        }

        editForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(editForm);
            let url = 'php/edit.php';
            
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    editModal.style.display = 'none';
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        document.querySelectorAll('.delete').forEach(deleteButton => {
            deleteButton.addEventListener('click', function(event) {
                event.preventDefault();
                const id = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this entry?')) {
                    fetch('php/delete.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id=${id}`
                    })
                    .then(response => response.json())
                    .then(data => {
						if (data.status === 'success') {
								alert(data.message);
								editModal.style.display = 'none';
								location.reload();
							} else {
								alert('Error: ' + data.message);
							}
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });
    });
    </script>
</body>
</html>
