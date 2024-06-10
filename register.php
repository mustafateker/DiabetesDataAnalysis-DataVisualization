<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include(__DIR__ . '/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Parola tekrarını kontrol et
    if ($password !== $confirm_password) {
        echo "<script>alert('Parola Eşleşmedi! Lütfen tekrar deneyin.');</script>";
    } else {
        // Parolayı hashle
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            // Kayıt başarılı oldu, index.php'ye yönlendir
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .register-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .register-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .register-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Kaydol</h2>
        <form class="register-form" method="post" action="">
            <label for="username">Kullanıcı Adı:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Parola:</label><br>
            <input type="password" id="password" name="password" required><br>
            <label for="confirm_password">Parola Tekrar:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" required><br>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
