<!DOCTYPE html>
<html>
<head>
    <title>Diabetes Data Table</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .graph-container {
            width: 400px;
            height: 300px;
            float: left;
            margin: 10px;
        }
        .menu {
            background-color: #f2f2f2;
            overflow: hidden;
        }

        .menu a {
            float: left;
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .menu a:hover {
            background-color: #ddd;
            color: black;
        }

        .menu a.active {
            background-color: #2196F3;
            color: white;
        }
    </style>
</head>
<body>

<div class="menu">
    <a href="#" class="active">Diabetes Data Tablosu</a>
    <a href="index.php">Ana Menü</a>
</div>

<?php
include('db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$result = $conn->query("SELECT * FROM diabetes_origin");

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Pregnancies</th>
                <th>Glucose</th>
                <th>BloodPressure</th>
                <th>SkinThickness</th>
                <th>Insulin</th>
                <th>BMI</th>
                <th>DiabetesPedigreeFunction</th>
                <th>Age</th>
                <th>Outcome</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['Pregnancies']."</td>
                <td>".$row['Glucose']."</td>
                <td>".$row['BloodPressure']."</td>
                <td>".$row['SkinThickness']."</td>
                <td>".$row['Insulin']."</td>
                <td>".$row['BMI']."</td>
                <td>".$row['DiabetesPedigreeFunction']."</td>
                <td>".$row['Age']."</td>
                <td>".$row['Outcome']."</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No data found.";
}
?>

</body>
</html>
