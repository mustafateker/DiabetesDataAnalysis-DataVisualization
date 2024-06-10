<?php
include('db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Diabetes Data Graphs</title>
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
    <a href="#" class="active">Diabete Veri Tablosu</a>
    <a href="index.php">Ana Menu</a>
</div>

<?php
// Özellik kombinasyonları
$combinations = array(
    array("Pregnancies", "Glucose"),
    array("Pregnancies", "BloodPressure"),
    array("Glucose", "BloodPressure"),
    array("SkinThickness", "Insulin"),
    array("BMI", "DiabetesPedigreeFunction"),
    array("Pregnancies", "Age"),
    array("Glucose", "Age"),
    array("BMI", "Age")
);

// Renkler
$colors = array(
    'rgb(255, 99, 132)',
    'rgb(54, 162, 235)',
    'rgb(255, 206, 86)',
    'rgb(75, 192, 192)',
    'rgb(153, 102, 255)',
    'rgb(255, 159, 64)',
    'rgb(255, 99, 132)',
    'rgb(54, 162, 235)'
);

// Her bir özellik kombinasyonu için grafik oluştur
foreach ($combinations as $index => $combination) {
    $x_label = $combination[0];
    $y_label = $combination[1];

    // Sorguyu hazırla
    $query = "SELECT $x_label, $y_label FROM diabetes_origin";

    // Sorguyu çalıştır
    $result = $conn->query($query);

    // Verileri depolamak için boş diziler oluşturun
    $x_values = [];
    $y_values = [];

    // Veritabanından gelen verileri diziye aktarın
    while($row = $result->fetch_assoc()) {
        $x_values[] = $row[$x_label];
        $y_values[] = $row[$y_label];
    }
?>

<div class="graph-container">
    <canvas id="<?php echo $x_label . $y_label . "Chart"; ?>" width="400" height="300"></canvas>
</div>

<script>
    // <?php echo $x_label; ?> ve <?php echo $y_label; ?> verileri için grafik oluştur
    var <?php echo $x_label . $y_label . "Ctx"; ?> = document.getElementById('<?php echo $x_label . $y_label . "Chart"; ?>').getContext('2d');
    var <?php echo $x_label . $y_label . "Chart"; ?> = new Chart(<?php echo $x_label . $y_label . "Ctx"; ?>, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($x_values); ?>,
            datasets: [{
                label: '<?php echo $x_label . " vs " . $y_label; ?>',
                data: <?php echo json_encode($y_values); ?>,
                borderColor: '<?php echo $colors[$index]; ?>',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: '<?php echo $x_label; ?>'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: '<?php echo $y_label; ?>'
                    }
                }
            }
        }
    });
</script>

<?php
}
?>

