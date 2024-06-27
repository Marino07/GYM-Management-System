<?php
include 'konekcija.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['ime'];
    $password = $_POST['pass'];
    $sql = "SELECT password,admin_id  FROM admin WHERE username = ?";
    $pokreni = $konekt->prepare($sql);
    $pokreni->bind_param("s", $username);
    $pokreni->execute();
    $rez = $pokreni->get_result();
    if ($rez->num_rows == 1) {
        $admin = $rez->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['admin_id'];
            header("Location: administrator.php");
            exit;
        } else {
            $_SESSION['error'] = 'netocan pass';
            header("Location: prijava.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: white; /* Promijenjena boja pozadine u narančastu (#f5a623) */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 400px;
            margin-top: 5vh;
            transition: box-shadow 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .login-form:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.9);
        }

        .login-form h1 {
            text-align: center;
            margin-bottom: 20px;
            font-family: "Roboto", sans-serif;
            color: #333;
        }

        .login-form label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #dcdcdc;
            border-radius: 5px;
        }

        .login-form button[type="submit"] {
            background-color: #f26d6d;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.2s ease-in-out;
        }

        .login-form button[type="submit"]:hover {
            background-color: #d53d3d;
        }

        .login-form .error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="login-form">
        <h1>Prijava Administratora</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="prijava.php " method="post">
            <label for="ime">Username:</label>
            <input type="text" name="ime" placeholder="Username" required>

            <label for="pass">Password:</label>
            <input type="password" name="pass" placeholder = "password"required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>













