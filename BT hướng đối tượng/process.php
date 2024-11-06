<?php
include('NhanVien.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loaiNV = $_POST['loaiNV'];
    $hoTen = $_POST['hoTen'];
    $gioiTinh = $_POST['gioiTinh'];
    $ngayVaoLam = $_POST['ngayVaoLam'];
    $heSoLuong = $_POST['heSoLuong'];
    $soCon = $_POST['soCon'];

    if ($loaiNV == 'vanphong') {
        $soNgayVang = $_POST['soNgayVang'];
        $nhanVien = new NhanVienVanPhong($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soNgayVang);
        $tienPhat = $nhanVien->tinhTienPhat();
    } else if ($loaiNV == 'sanxuat') {
        $soSanPham = $_POST['soSanPham'];
        $nhanVien = new NhanVienSanXuat($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soSanPham);
        $tienPhat = 0; // không có tiền phạt
    }

    $tienLuong = $nhanVien->tinhTienLuong();
    $tienTroCap = $nhanVien->tinhTroCap();
    $tienThuong = $nhanVien->tinhTienThuong();

    echo "<h3>Thông tin lương nhân viên</h3>";
    echo "Tên: $hoTen<br>";
    echo "Giới tính: $gioiTinh<br>";
    echo "Ngày vào làm: $ngayVaoLam<br>";
    echo "Hệ số lương: $heSoLuong<br>";
    echo "Số con: $soCon<br>";
    echo "Lương cơ bản: " . NhanVien::LUONG_CO_BAN . " VND<br>";
    echo "Tiền lương: " . number_format($tienLuong, 0, ',', '.') . " VND<br>";
    echo "Tiền thưởng: " . number_format($tienThuong, 0, ',', '.') . " VND<br>";
    echo "Tiền trợ cấp: " . number_format($tienTroCap, 0, ',', '.') . " VND<br>";
    if ($loaiNV == 'vanphong') {
        echo "Tiền phạt: " . number_format($tienPhat, 0, ',', '.') . " VND<br>";
    }
    echo "Thực lĩnh: " . number_format($tienLuong + $tienThuong + $tienTroCap - $tienPhat, 0, ',', '.') . " VND<br>";
}
?>
