<?php
// Lớp NhanVien
class NhanVien {
    public $hoTen;
    public $gioiTinh;
    public $ngayVaoLam;
    public $heSoLuong;
    public $soCon;
    const LUONG_CO_BAN = 5000000; // lương cơ bản cố định

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon) {
        $this->hoTen = $hoTen;
        $this->gioiTinh = $gioiTinh;
        $this->ngayVaoLam = $ngayVaoLam;
        $this->heSoLuong = $heSoLuong;
        $this->soCon = $soCon;
    }

    public function tinhTienLuong() {
        return self::LUONG_CO_BAN * $this->heSoLuong;
    }

    public function tinhTienThuong() {
        $soNamLamViec = date("Y") - date("Y", strtotime($this->ngayVaoLam));
        return $soNamLamViec * 1000000;
    }

    public function tinhTroCap() {
        // Mặc định trợ cấp cho nhân viên thường, lớp con sẽ override
        return 0;
    }
}

// Lớp NhanVienVanPhong kế thừa từ NhanVien
class NhanVienVanPhong extends NhanVien {
    public $soNgayVang;
    const DINH_MUC_VANG = 3; // định mức vắng
    const DON_GIA_PHAT = 100000; // đơn giá phạt

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soNgayVang) {
        parent::__construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon);
        $this->soNgayVang = $soNgayVang;
    }

    public function tinhTienPhat() {
        if ($this->soNgayVang > self::DINH_MUC_VANG) {
            return ($this->soNgayVang - self::DINH_MUC_VANG) * self::DON_GIA_PHAT;
        }
        return 0;
    }

    public function tinhTroCap() {
        if ($this->gioiTinh == "Nữ") {
            return 200000 * $this->soCon * 1.5;
        } else {
            return 200000 * $this->soCon;
        }
    }

    public function tinhTienLuong() {
        return parent::tinhTienLuong() - $this->tinhTienPhat();
    }
}

// Lớp NhanVienSanXuat kế thừa từ NhanVien
class NhanVienSanXuat extends NhanVien {
    public $soSanPham;
    const DINH_MUC_SAN_PHAM = 100; // định mức sản phẩm
    const DON_GIA_SAN_PHAM = 20000; // đơn giá sản phẩm

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soSanPham) {
        parent::__construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon);
        $this->soSanPham = $soSanPham;
    }

    public function tinhTienThuong() {
        if ($this->soSanPham > self::DINH_MUC_SAN_PHAM) {
            return ($this->soSanPham - self::DINH_MUC_SAN_PHAM) * self::DON_GIA_SAN_PHAM * 0.03;
        }
        return 0;
    }

    public function tinhTroCap() {
        return $this->soCon * 120000;
    }

    public function tinhTienLuong() {
        return $this->soSanPham * self::DON_GIA_SAN_PHAM;
    }
}
?>
