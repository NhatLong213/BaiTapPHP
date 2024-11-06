<?php
include('NhanVien.php');

$tienLuong = 0;
$tienTroCap = 0;
$tienThuong = 0;
$tienPhat = 0;
$thucLinh = 0;
$thongTin = '';

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
    $thucLinh = $tienLuong + $tienThuong + $tienTroCap - $tienPhat;

    // Lưu thông tin để hiển thị
    $thongTin = "
        <div class='alert alert-info mt-4'>
            <h4>Thông tin lương nhân viên</h4>
            <p><strong>Tên:</strong> $hoTen</p>
            <p><strong>Giới tính:</strong> $gioiTinh</p>
            <p><strong>Ngày vào làm:</strong> $ngayVaoLam</p>
            <p><strong>Hệ số lương:</strong> $heSoLuong</p>
            <p><strong>Số con:</strong> $soCon</p>
            <p><strong>Lương cơ bản:</strong> " . number_format(NhanVien::LUONG_CO_BAN, 0, ',', '.') . " VND</p>
            <p><strong>Tiền lương:</strong> " . number_format($tienLuong, 0, ',', '.') . " VND</p>
            <p><strong>Tiền thưởng:</strong> " . number_format($tienThuong, 0, ',', '.') . " VND</p>
            <p><strong>Tiền trợ cấp:</strong> " . number_format($tienTroCap, 0, ',', '.') . " VND</p>";

    if ($loaiNV == 'vanphong') {
        $thongTin .= "<p><strong>Tiền phạt:</strong> " . number_format($tienPhat, 0, ',', '.') . " VND</p>";
    }

    $thongTin .= "<p><strong>Thực lĩnh:</strong> " . number_format($thucLinh, 0, ',', '.') . " VND</p></div>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính lương nhân viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h3>Tính lương nhân viên</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" class="row g-3">
                    <div class="col-md-6">
                        <label for="loaiNV" class="form-label">Loại nhân viên</label>
                        <select name="loaiNV" id="loaiNV" class="form-select">
                            <option value="vanphong">Nhân viên văn phòng</option>
                            <option value="sanxuat">Nhân viên sản xuất</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="hoTen" class="form-label">Họ tên</label>
                        <input type="text" name="hoTen" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="gioiTinh" class="form-label">Giới tính</label>
                        <select name="gioiTinh" id="gioiTinh" class="form-select">
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="ngayVaoLam" class="form-label">Ngày vào làm</label>
                        <input type="date" name="ngayVaoLam" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="heSoLuong" class="form-label">Hệ số lương</label>
                        <input type="number" step="0.1" name="heSoLuong" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="soCon" class="form-label">Số con</label>
                        <input type="number" name="soCon" class="form-control" required>
                    </div>

                    <!-- Thông tin thêm cho nhân viên văn phòng -->
                    <div class="col-md-6">
                        <label for="soNgayVang" class="form-label">Số ngày vắng (cho NV văn phòng)</label>
                        <input type="number" name="soNgayVang" class="form-control">
                    </div>

                    <!-- Thông tin thêm cho nhân viên sản xuất -->
                    <div class="col-md-6">
                        <label for="soSanPham" class="form-label">Số sản phẩm (cho NV sản xuất)</label>
                        <input type="number" name="soSanPham" class="form-control">
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Tính lương</button>
                    </div>
                </form>

                <!-- Hiển thị kết quả sau khi tính lương -->
                <?php
                if ($thongTin) {
                    echo $thongTin;
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
