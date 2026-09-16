
<?php


include("../config/database.php");


session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === "" || $password === "") {
        echo '<p style="color: red;">Please enter both email and password.</p>';
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }


        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if(password_verify($password, $row["password"])) {

            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            

                header("Location: ./dash.html");
                exit();
            } else {
                echo '<p style="color: red; position: absolute; top: 510px; left: 50%; transform: translateX(-50%);">Invalid password.</p>';
            }
}
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Student Management System</title>

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

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .login-card {
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

        .login-btn {
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

        .login-btn:hover {
            background: #0052a3;
        }

        .register-link {
            text-align: center;
            margin-top: 22px;
            color: #666;
            font-size: 14px;
        }

        .register-link a {
            color: #0066cc;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .required {
            color: #0066cc;
        }

        @media (max-width: 500px) {

            .login-card {
                padding: 25px 20px;
            }

            .logo h1 {
                font-size: 24px;
            }

        }

    </style>

</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <div class="logo">
                <h1>Welcome Back</h1>
            </div>

            <p class="subtitle">
                Login to the Student Management System
            </p>

            <form action="login.php" method="post">

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
                        placeholder="Enter your password"
                        required
                    >

                </div>

                <button type="submit" class="login-btn">
                    Login
                </button>

            </form>

            <div class="register-link">

                Don't have an account?

                <a href="register.php">
                    Register
                </a>

            </div>

        </div>

    </div>

</body>

</html>
