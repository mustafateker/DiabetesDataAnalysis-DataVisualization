<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa - Diabet Veri Analizi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
        }
        .menu {
            background-color: #f2f2f2;
            overflow: hidden;
            padding: 10px 20px;
        }
        .menu a {
            float: left;
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .menu a:hover {
            background-color: #ddd;
            color: black;
        }
        .menu a.active {
            background-color: #2196F3;
            color: white;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Diabet Veri Analizi</h1>
        <a href="logout.php" style="color: white;">Çıkış Yap</a>
    </div>
    <div class="menu">
        <a href="#" class="active">Ana Sayfa</a>
        <a href="data.php">Veri Tablosu</a>
        <a href="graph.php">Grafikler</a>
    </div>
    <div class="content">
        <h2>Tablo verileri, bir dizi tıbbi tahmin edici (bağımsız) değişken ve bir hedef (bağımlı) değişken olan "Sonuç"tan oluşur. Bağımsız değişkenler arasında hastanın yaşadığı hamilelik sayısı, vücut kitle indeksi (BMI), insülin seviyesi, yaş vb. yer alır. Bu değişkenler, diyabet teşhisi koymak veya risk faktörlerini değerlendirmek gibi klinik sonuçları tahmin etmek için kullanılabilir. Tablodaki her bir veri noktası, bir hastanın belirli özelliklerini temsil eder ve bu özelliklerin bir araya gelmesi, diyabet riskini veya teşhisini anlamamıza yardımcı olabilir.</h2>
    </div>
    
    <div class="content">
        <h2>Veri Seti Hakkında</h2>
        <p>Tıbbi veri seti, hastaların sağlık durumlarını değerlendirmek ve gelecekte olası hastalık risklerini tahmin etmek için önemli bir araçtır. Bu veri setleri, çeşitli bağımsız değişkenleri (tahminciler) ve bir bağımlı değişkeni (hedef) içerir. Örneğin, diyabet veri seti, hamilelik sayısı, vücut kitle indeksi (BMI), insülin seviyeleri, yaş ve daha fazlası gibi bağımsız değişkenleri içerirken, bağımlı değişken olarak hastanın diyabet durumunu (sonucu) içerir.</p>
        <p>Bu veri setlerinin analizi, hastaların sağlık durumlarını anlamak, risk faktörlerini belirlemek, hastalık gelişimini öngörmek ve tedavi planlarını geliştirmek için önemli bilgiler sağlar. Veri analitiği ve makine öğrenimi teknikleri kullanılarak, bu veri setleri üzerinde yapılan analizler hastaların sağlık sonuçlarını iyileştirmek için kritik öneme sahip olabilir.</p>
    </div>  
</body>
</html>