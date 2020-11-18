<?php

abstract class ChuyenDuLichAbstract
{
    public $name; // tên khu du lich 
    public function __construct($name)
    {
        $this->name = $name;
    }
    // this is template method
    final public function thucHienChuyenDi(): void
    {
        $this->xemThongTinCacKhuDuLich();
        $this->chonMotKhuDuLich();
        $this->lenKeHoachThamQuan();
        
        $this->ngayKhoiHanh();
        $this->ngayKetThuc();
    }

    protected function xemThongTinCacKhuDuLich(): void
    {
        echo "Bạn có thể xem thông tin các khu du lịch trên http://dulich24.com.vn/" . "<br>";
    }

    protected function chonMotKhuDuLich(): void
    {
        echo "Chọn khu du lịch: $this->name". "<br>";
    }

    protected function lenKeHoachThamQuan(): void
    {
        echo "Lên kế hoạch tham quan và vui chơi tại khu du lịch". "<br>";
    }

    abstract protected function ngayKhoiHanh(): void;

    abstract protected function ngayKetThuc(): void;

}

class DuLichDauNam extends ChuyenDuLichAbstract
{
    protected function ngayKhoiHanh(): void
    {
        echo "Chuyến đi bắt đầu ngày 20/1/2021". "<br>";
    }

    protected function ngayKetThuc(): void
    {
        echo "Chuyến đi kết thúc ngày 30/1/2021". "<br>";
    }

}

class DuLichCuoiNam extends ChuyenDuLichAbstract
{

    protected function ngayKhoiHanh(): void
    {
        echo "Chuyến đi bắt đầu ngày 10/11/2021". "<br>";
    }

    protected function ngayKetThuc(): void
    {
        echo "Chuyến đi kết thúc ngày 20/11/2021". "<br>";
    }

}

function clientCode(ChuyenDuLichAbstract $chuyenDL)
{
    
    $chuyenDL->thucHienChuyenDi();

}

echo "Thông tin chuyến du lịch đầu năm" . "<br>";
clientCode(new DuLichDauNam("Đồng Tháp Mười"));
echo "<br>";

echo "Thông tin chuyến du lịch cuối năm" . "<br>";
clientCode(new DuLichCuoiNam("Cao nguyên đá Đồng Văn"));