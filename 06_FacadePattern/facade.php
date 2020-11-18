<?php
// Giả sử bộ phận quản lý của công ty muốn thông báo một tin tức gì đó đến tất cả các phòng ban,
// nhân viên trong công ty

interface ThongBaoPhongBanInterface
{
    public function setMessage($message);
    public function share();
}
 
class PhongBanAdmin implements ThongBaoPhongBanInterface
{
    private $message;
 
    public function setMessage($message)
    {
        $this->message = $message;
    }
 
    public function share()
    {
        echo "Thông báo đến Phòng Admin: " . $this->message;
    }
}
 
class PhongBanKySu implements ThongBaoPhongBanInterface
{
    private $message;
 
    public function setMessage($message)
    {
        $this->message = $message;
    }
 
    public function share()
    {
        echo "Thông báo đến Phòng Kỹ sư: " . $this->message;
    }
}
 
class PhongBanKiemThu implements ThongBaoPhongBanInterface
{
    private $message;
 
    public function setMessage($message)
    {
        $this->message = $message;
    }
 
    public function share()
    {
        echo "Thông báo đến Phòng ban Kiểm thử: " . $this->message;
    }
}

class ThongbaoFacade
{
    // tên các phòng ban
    private $admin;
    private $kysu;
    private $tester;
 
    public function __construct(ThongBaoPhongBanInterface $admin, ThongBaoPhongBanInterface $kysu, ThongBaoPhongBanInterface $tester)
    {
        $this->admin = $admin;
        $this->kysu = $kysu;
        $this->tester = $tester;
    }
 
    public function setMessage($message)
    {
        $this->admin->setMessage($message);
        $this->kysu->setMessage($message);
        $this->tester->setMessage($message);
 
        return $this;
    }
 
    public function share()
    {
        $this->admin->share();
        $this->kysu->share();
        $this->tester->share();
    }
}

// thay vì phải thực hiện theo kiểu
// $admin = new PhongBanAdmin();
// $admin->setMessage('Learning Facade pattern.');
// $admin->share();
// Lặp lại như thế với các phòng ban còn lại, nếu công ty có rất nhiều phòng ban thì việc lặp lại là quá nhiều

$thongBao = new ThongbaoFacade(new PhongBanAdmin(), new PhongBanKySu(), new PhongBanKiemThu());
$thongBao->setMessage('Cùng tìm hiểu về mẫu Facade Pattern.')->share();