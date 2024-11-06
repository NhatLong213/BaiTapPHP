<?php
$n = rand(1, 100);
echo "Giá trị n được tạo ra là $n.";
echo "<br> Các số chẵn nhỏ hơn $n là: ";

for ($i = 1; $i <= $n; $i++) {
    if ($i % 2 == 0) {
        echo "$i "; // In số chẵn với dấu phẩy
    }
}
?>
