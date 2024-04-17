<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Save Password</h1>
                    </div>
                    <div class="card-body">
                        <form action="save_password.php" method="post">
                            <div class="form-group">
                                <label for="website">Website:</label>
                                <input type="text" id="website" name="website" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="text" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="save" class="btn btn-primary btn-block">Save Password</button>
                        </form>
                        <br>
                        <h2 class="text-center">Existing Passwords</h2>
                        <ul class="list-group">
                            <?php
                            require_once('connect.php');

                            session_start();

                            if (isset($_POST['save'])) {
                                $website = $_POST['website'];
                                $password = $_POST['password'];
                                $user_id = $_SESSION['user_id'];

                                $insert_query = "INSERT INTO passwords (user_id, website, password) VALUES ('$user_id', '$website', '$password')";
                                if ($conn->query($insert_query) === TRUE) {
                                    echo "<p>Successfuly saved!</p>";
                                } else {
                                    echo "Error: " . $insert_query . "<br>" . $conn->error;
                                }
                            }

                            if (isset($_GET['delete'])) {
                                $website_to_delete = $_GET['delete'];
                                $user_id = $_SESSION['user_id'];

                                $delete_query = "DELETE FROM passwords WHERE user_id='$user_id' AND website='$website_to_delete'";
                                if ($conn->query($delete_query) === TRUE) {
                                    echo "<script>window.location.href = 'save_password.php';</script>";
                                } else {
                                    echo "Error deleting record: " . $conn->error;
                                }
                            }

                            $user_id = $_SESSION['user_id'];
                            $select_query = "SELECT * FROM passwords WHERE user_id='$user_id'";
                            $result = $conn->query($select_query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $website = $row['website'];
                                    $password = $row['password'];
                                    echo "<li class='list-group-item'>$website: $password <a href='save_password.php?delete=$website' class='btn btn-sm btn-danger float-right'>Delete</a></li>";
                                }
                            } else {
                                echo "<li class='list-group-item'>No passwords saved</li>";
                            }
                            ?>
                        </ul>
                        <br>
                        <p class="text-center"><a href="main_page.php">Go back to main page</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
