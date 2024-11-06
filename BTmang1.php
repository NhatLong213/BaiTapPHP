<!DOCTYPE html>
<html>
<head>
    <title>Phát sinh mảng ngẫu nhiên</title>
</head>
<body>

<form method="post">
    <label for="n">Nhập số tự nhiên n:</label>
    <input type="number" name="n" id="n" required>
    <input type="submit" value="Phát sinh mảng">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị n từ form
    $n = $_POST["n"];
    
    
    $arr = [];
    for ($i = 0; $i < $n; $i++) {
        $arr[] = rand(-500, 500);  
    }

   
    echo "<h3>Mảng phát sinh ngẫu nhiên:</h3>";
    echo implode(", ", $arr) . "<br>";



    // a- Đếm số chẵn
    $evenCount = 0;
    foreach ($arr as $num) {
        if ($num % 2 == 0) {
            $evenCount++;
        }
    }
    echo "<p>Số lượng phần tử là số chẵn: $evenCount</p>";

    // b- Đếm số nhỏ hơn 100
    $lessThan100Count = 0;
    foreach ($arr as $num) {
        if ($num < 100) {
            $lessThan100Count++;
        }
    }
    echo "<p>Số lượng phần tử nhỏ hơn 100: $lessThan100Count</p>";

    // c- Tính tổng các số âm
    $negativeSum = 0;
    foreach ($arr as $num) {
        if ($num < 0) {
            $negativeSum += $num;
        }
    }
    echo "<p>Tổng các phần tử âm: $negativeSum</p>";

    // d- In ra vị trí của các thành phần có chữ số kề cuối là 0
    $positionArr = [];
    foreach ($arr as $index => $num) {
        if (abs($num) >= 10 && (int)(abs($num) / 10) % 10 == 0) {
            $positionArr[] = $index;
        }
    }
    if (count($positionArr) > 0) {
        echo "<p>Vị trí của các phần tử có chữ số kề cuối là 0: " . implode(", ", $positionArr) . "</p>";
    } else {
        echo "<p>Không có phần tử nào có chữ số kề cuối là 0.</p>";
    }

    // e- Sắp xếp mảng theo thứ tự tăng dần
    sort($arr);
    echo "<h3>Mảng sau khi sắp xếp tăng dần:</h3>";
    echo implode(", ", $arr) . "<br>";
}
?>

</body>
</html>
