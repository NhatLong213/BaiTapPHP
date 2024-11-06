<?php
// Lớp Nguoi
class Nguoi {
    public $hoTen;
    public $diaChi;
    public $gioiTinh;

    public function __construct($hoTen, $diaChi, $gioiTinh) {
        $this->hoTen = $hoTen;
        $this->diaChi = $diaChi;
        $this->gioiTinh = $gioiTinh;
    }

    public function hienThiThongTin() {
        return "Họ tên: {$this->hoTen}<br>Địa chỉ: {$this->diaChi}<br>Giới tính: {$this->gioiTinh}<br>";
    }
}

// Lớp SinhVien kế thừa từ lớp Nguoi
class SinhVien extends Nguoi {
    public $lopHoc;
    public $nganhHoc;

    public function __construct($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc) {
        parent::__construct($hoTen, $diaChi, $gioiTinh);
        $this->lopHoc = $lopHoc;
        $this->nganhHoc = $nganhHoc;
    }

    public function tinhDiemThuong() {
        if ($this->nganhHoc === 'CNTT') {
            return 1;
        } elseif ($this->nganhHoc === 'Kinh tế') {
            return 1.5;
        } else {
            return 0;
        }
    }

    public function hienThiThongTin() {
        $thongTin = parent::hienThiThongTin();
        $thongTin .= "Lớp học: {$this->lopHoc}<br>Ngành học: {$this->nganhHoc}<br>";
        $thongTin .= "Điểm thưởng: " . $this->tinhDiemThuong() . "<br>";
        return $thongTin;
    }
}

// Lớp GiangVien kế thừa từ lớp Nguoi
class GiangVien extends Nguoi {
    public $trinhDo;
    const LUONG_CO_BAN = 1500000;

    public function __construct($hoTen, $diaChi, $gioiTinh, $trinhDo) {
        parent::__construct($hoTen, $diaChi, $gioiTinh);
        $this->trinhDo = $trinhDo;
    }

    public function tinhLuong() {
        switch ($this->trinhDo) {
            case 'Cử nhân':
                return self::LUONG_CO_BAN * 2.34;
            case 'Thạc sĩ':
                return self::LUONG_CO_BAN * 3.67;
            case 'Tiến sĩ':
                return self::LUONG_CO_BAN * 5.66;
            default:
                return self::LUONG_CO_BAN;
        }
    }

    public function hienThiThongTin() {
        $thongTin = parent::hienThiThongTin();
        $thongTin .= "Trình độ: {$this->trinhDo}<br>";
        $thongTin .= "Lương: " . number_format($this->tinhLuong(), 0, ',', '.') . " VND<br>";
        return $thongTin;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin GV/SV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center">Nhập thông tin Giảng viên hoặc Sinh viên</h2>
            </div>
            <div class="card-body">
                <form action="" method="post" class="row g-3">
                    <div class="col-md-12">
                        <label for="loai" class="form-label">Chọn loại</label>
                        <select name="loai" id="loai" class="form-select">
                            <option value="sinhvien">Sinh viên</option>
                            <option value="giangvien">Giảng viên</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="hoTen" class="form-label">Họ tên</label>
                        <input type="text" name="hoTen" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="diaChi" class="form-label">Địa chỉ</label>
                        <input type="text" name="diaChi" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label for="gioiTinh" class="form-label">Giới tính</label><br>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gioiTinh" value="Nam" class="form-check-input" checked> 
                            <label class="form-check-label">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gioiTinh" value="Nữ" class="form-check-input"> 
                            <label class="form-check-label">Nữ</label>
                        </div>
                    </div>

                    <div id="sinhVienFields" class="col-md-12">
                        <label for="lopHoc" class="form-label">Lớp học</label>
                        <input type="text" name="lopHoc" class="form-control">
                        <label for="nganhHoc" class="form-label mt-2">Ngành học</label>
                        <input type="text" name="nganhHoc" class="form-control">
                    </div>

                    <div id="giangVienFields" class="col-md-12" style="display: none;">
                        <label for="trinhDo" class="form-label">Trình độ</label>
                        <select name="trinhDo" class="form-select">
                            <option value="Cử nhân">Cử nhân</option>
                            <option value="Thạc sĩ">Thạc sĩ</option>
                            <option value="Tiến sĩ">Tiến sĩ</option>
                        </select>
                    </div>

                    <div class="col-md-12 text-center">
                        <input type="submit" value="Hiển thị thông tin" class="btn btn-success mt-3">
                    </div>
                </form>
            </div>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $loai = $_POST['loai'];
            $hoTen = $_POST['hoTen'];
            $diaChi = $_POST['diaChi'];
            $gioiTinh = $_POST['gioiTinh'];

            echo "<div class='card mt-5'>";
            echo "<div class='card-body'>";
            if ($loai == "sinhvien") {
                $lopHoc = $_POST['lopHoc'];
                $nganhHoc = $_POST['nganhHoc'];
                $sinhVien = new SinhVien($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc);
                echo "<h3 class='text-center'>Thông tin Sinh viên</h3>";
                echo $sinhVien->hienThiThongTin();
            } elseif ($loai == "giangvien") {
                $trinhDo = $_POST['trinhDo'];
                $giangVien = new GiangVien($hoTen, $diaChi, $gioiTinh, $trinhDo);
                echo "<h3 class='text-center'>Thông tin Giảng viên</h3>";
                echo $giangVien->hienThiThongTin();
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
        const loaiElement = document.getElementById('loai');
        const sinhVienFields = document.getElementById('sinhVienFields');
        const giangVienFields = document.getElementById('giangVienFields');

        loaiElement.addEventListener('change', function () {
            if (this.value === 'sinhvien') {
                sinhVienFields.style.display = 'block';
                giangVienFields.style.display = 'none';
            } else {
                sinhVienFields.style.display = 'none';
                giangVienFields.style.display = 'block';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
