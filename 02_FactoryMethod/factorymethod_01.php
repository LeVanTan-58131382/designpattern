<?php

namespace RefactoringGuru\FactoryMethod\Conceptual;

abstract class GiaoThongVanTai
{

    abstract public function vanTai(): PhuongTienVanTai;

    public function hoatDong(): string
    {
        // Gọi hàm vanTai() - factory method để tạo đối tượng PhuongTienVanTai
        $phuongTien = $this->vanTai();
        // Now, use the PhươngTienVanTai.
        return $phuongTien->hinhThucVanTai();
    }
}

class XeTai extends GiaoThongVanTai
{

    public function vanTai(): PhuongTienVanTai
    {
        return new PhuongTienVanTai_DuongBo();
    }
}

class Thuyen extends GiaoThongVanTai
{
    public function vanTai(): PhuongTienVanTai
    {
        return new PhuongTienVanTai_DuongThuy();
    }
}

class MayBay extends GiaoThongVanTai
{
    public function vanTai(): PhuongTienVanTai
    {
        return new PhuongTienVanTai_DuongHangKhong();
    }
}

interface PhuongTienVanTai
{
    public function hinhThucVanTai(): string;
}

class PhuongTienVanTai_DuongBo implements PhuongTienVanTai
{
    public function hinhThucVanTai(): string
    {
        return "Vận Tải Đường Bộ";
    }
}

class PhuongTienVanTai_DuongThuy implements PhuongTienVanTai
{
    public function hinhThucVanTai(): string
    {
        return "Vận Tải Đường Thủy";
    }
}

class PhuongTienVanTai_DuongHangKhong implements PhuongTienVanTai
{
    public function hinhThucVanTai(): string
    {
        return "Vận Tải Hàng Không";
    }
}

function clientCode(GiaoThongVanTai $gtvt)
{
    // ...
    echo "Thông Tin:\n"
        . $gtvt->hoatDong();
    // ...
}

echo "Đối tượng: XeTai.\n";
clientCode(new XeTai());
echo "<br>";

echo "Đối tượng: Thuyen.\n";
clientCode(new Thuyen());
echo "<br>";

echo "Đối tượng: MayBay.\n";
clientCode(new MayBay());
echo "<br>";