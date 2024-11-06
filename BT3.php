<?php
// Tạo giá trị ngẫu nhiên n từ 1 đến 10000
$N = 10000;
$n = rand(1, $N);

// Kiểm tra n có phải là số nguyên tố hay không
function la_so_nguyen_to($num) {
    if ($num < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}

// Tính tổng các số lẻ có 2 chữ số và nhỏ hơn n
function tong_so_le_2_chu_so_nho_hon($n) {
    $tong = 0;
    for ($i = 11; $i < 100; $i += 2) { // Bắt đầu từ 11 và bước nhảy là 2
        if ($i < $n) {
            $tong += $i;
        }
    }
    return $tong;
}

// Đếm số chữ số của n mà không dùng strlen
function dem_so_chu_so($num) {
    $dem = 0;
    while ($num > 0) {
        $num = (int)($num / 10); // Chia số cho 10 để loại bỏ chữ số cuối cùng
        $dem++;
    }
    return $dem;
}

// Thực hiện các bước
$la_so_nguyen_to = la_so_nguyen_to($n);
$tong_so_le = tong_so_le_2_chu_so_nho_hon($n);
$so_chu_so = dem_so_chu_so($n);

// Kết quả
echo "Giá trị ngẫu nhiên n: $n <br>";
echo "n có phải là số nguyên tố không: " . ($la_so_nguyen_to ? 'Có' : 'Không') . "<br>";
echo "Tổng các số lẻ có 2 chữ số và nhỏ hơn n: $tong_so_le<br>";
echo "Số chữ số của n: $so_chu_so<br>";
?>
