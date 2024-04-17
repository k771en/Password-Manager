<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function validatePassword() {
            var password = document.getElementById("reg_password").value;
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                alert("Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one digit, and one special character.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Register</h1>
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="post" onsubmit="return validatePassword()">
                            <div class="form-group">
                                <label for="reg_email">Email:</label>
                                <input type="email" id="reg_email" name="reg_email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="reg_password">Password:</label>
                                <input type="password" id="reg_password" name="reg_password" class="form-control" required>
                            </div>
                            <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
                        </form>
                        <br>
                        <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
require_once('connect.php');

session_start();

if (isset($_POST['register'])) {
    $reg_email = $_POST['reg_email'];
    $reg_password = $_POST['reg_password'];
    
    // Проверка пароля
    $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    if (!preg_match($passwordRegex, $reg_password)) {
        echo "<script>alert('Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one digit, and one special character.')</script>";
        exit();
    }

    $hashed_password = md5($reg_password);

    $check_query = "SELECT * FROM users WHERE email='$reg_email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo "User with this email already exists";
    } else {
        $register_query = "INSERT INTO users (email, password) VALUES ('$reg_email', '$hashed_password')";
        if ($conn->query($register_query) === TRUE) {
            echo "Registration successful";
        } else {
            echo "Error: " . $register_query . "<br>" . $conn->error;
        }
    }
}
?>
