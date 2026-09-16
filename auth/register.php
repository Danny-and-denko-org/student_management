
<?php

include '../config/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    $confirm_password = $_POST['confirm_password']; 

    if($password != $confirm_password){
        echo '<p style="color: red;">Passwords do not match.</p>';
    
}
$check = $conn->prepare("SELECT * FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();


$result = $check->get_result();

if($result->num_rows >0){
    echo '<p style="color: red;"> User with this Email already exists.</p>';
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username,password,email) VALUES (?,?,?)");
$stmt->bind_param("sss", $username,$hashed_password,$email);


if($stmt->execute()){
    
    header("Location: login.php");


}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Student Management System</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f8fc;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 450px;
        }

        .register-card {
            background: #ffffff;
            padding: 35px;
            border-radius: 12px;

            box-shadow: 0 8px 25px rgba(0, 82, 204, 0.12);

            border-top: 5px solid #0066cc;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo h1 {
            color: #0066cc;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px;

            border: 1px solid #ccd6e0;
            border-radius: 7px;

            font-size: 15px;
            outline: none;

            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #0066cc;

            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.12);
        }

        .register-btn {
            width: 100%;
            padding: 14px;

            background: #0066cc;
            color: #ffffff;

            border: none;
            border-radius: 7px;

            font-size: 16px;
            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;
        }

        .register-btn:hover {
            background: #0052a3;
        }

        .login-link {
            text-align: center;
            margin-top: 22px;

            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #0066cc;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .required {
            color: #0066cc;
        }

        @media (max-width: 500px) {

            .register-card {
                padding: 25px 20px;
            }

            .logo h1 {
                font-size: 24px;
            }
        }

    </style>
</head>

<body>

    <div class="register-container">

        <div class="register-card">

            <div class="logo">
                <h1>Create Account</h1>
            </div>

            <p class="subtitle">
                Register for the Student Management System
            </p>

            <form action="register.php" method="post">

                <div class="form-group">

                    <label for="username">
                        Full Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter your full name"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="email">
                        Email <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="password">
                        Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create a password"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="confirm_password">
                        Confirm Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Confirm your password"
                        required
                    >

                </div>


                <button type="submit" class="register-btn">
                    Register
                </button>

            </form>


            <div class="login-link">

                Already have an account?

                <a href="login.php">
                    Login
                </a>

            </div>

        </div>

    </div>

</body>

</html>
