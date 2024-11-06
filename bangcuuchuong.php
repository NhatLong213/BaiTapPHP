<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng cửu chương</title>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
        }
        .column {
            width: 45%;
            padding: 10px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }
        h2 {
            text-align: center;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <h1>Bảng cửu chương</h1>
    <div class="container">
        <div class="column">
            <h2>Bảng cửu chương từ 1 đến 5</h2>
            <?php
            for ($i = 1; $i <= 5; $i++) {
                echo "Bảng cửu chương $i:<br>";
                for ($j = 1; $j <= 10; $j++) {
                    echo "$i x $j = " . ($i * $j) . "<br>";
                }
                echo "<br>";
            }
            ?>
        </div>
        
        <div class="column">
            <h2>Bảng cửu chương từ 6 đến 10</h2>
            <?php
            for ($i = 6; $i <= 10; $i++) {
                echo "Bảng cửu chương $i:<br>";
                for ($j = 1; $j <= 10; $j++) {
                    echo "$i x $j = " . ($i * $j) . "<br>";
                }
                echo "<br>";
            }
            ?>
        </div>
    </div>
</body>
</html>
