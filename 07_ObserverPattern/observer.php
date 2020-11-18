<?php

abstract class Observer {
    abstract function update(Subject $subject_in);
}

abstract class Subject {
    abstract function attach(Observer $observer_in);
    abstract function detach(Observer $observer_in);
    abstract function notify();
}

function writeln($line_in) {
    echo $line_in."<br/>";
}

class KhachHang extends Observer {

    public function __construct() {
       
    }
    public function update(Subject $subject) {
      writeln(' Thông tin cập nhật ');
      writeln(' Tin tức mới: '.$subject->gettinTucDienThoai());     
    }
}

class CuaHang extends Subject { 
    
    private $dsKhachHang = array();
    private $tinTucDienThoai;

    function __construct() {
    }

    function attach(Observer $khachHang) {
      //cũng có thể dùng array_push($this->observers, $observer_in);
      $this->dsKhachHang[] = $khachHang;
    }

    function detach(Observer $khachHang) {
      //$key = array_search($observer_in, $this->observers);
      foreach($this->dsKhachHang as $khkey => $khval) {
        if ($khval == $khachHang) { 
          unset($this->dsKhachHang[$khkey]);
        }
      }
    }

    function notify() {
      foreach($this->dsKhachHang as $kh) {
        $kh->update($this);
      }
    }
    function capNhatTinTucDienThoai($tinTucDienThoai) {
      $this->tinTucDienThoai = $tinTucDienThoai;
      $this->notify();
    }
    function gettinTucDienThoai() {
      return $this->tinTucDienThoai;
    }

}

  $cuaHang = new CuaHang();
  $khachHang = new KhachHang();

  $cuaHang->attach($khachHang);

  $cuaHang->capNhatTinTucDienThoai('Mẫu điện thoại Iphone mới đã về đến Việt Nam');

  $cuaHang->capNhatTinTucDienThoai('Mẫu điện thoại Iphone mới hiện nay đã có mặt tại cửa hàng');

  $cuaHang->detach($khachHang);

  $cuaHang->capNhatTinTucDienThoai('Mẫu điện thoại Iphone mới đã hết hàng tại cửa hàng');


?>