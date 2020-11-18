<?php

abstract class Component
{
    /**
     * @var Component
     */
    protected $parent;

    public function setParent(Component $parent )
    {
        $this->parent = $parent;
    }

    public function getParent(): Component
    {
        return $this->parent;
    }

    public function add(Component $component): void { }

    public function remove(Component $component): void { }

    public function isComposite(): bool
    {
        return false;
    }

    abstract public function diemDanh(): string;
}


class BoDoi extends Component
{
    public $name;
    public function __construct($name = null)
    {
        if($name)
        {
            $this->name = $name;
        }
    }
    public function diemDanh(): string
    {
        return "Tôi là bộ đội: '$this->name'";
    }
}

class Composite extends Component
{
    public $name = "";
    protected $children = array();

    public function __construct($name = null)
    {
        if($name)
        {
            $this->name = $name;
        }
    }

    public function add(Component $component): void
    {
        $this->children[] = $component;
        $component->setParent($this);
    }

    public function remove(Component $component): void
    {
        foreach($this->children as $chkey => $chval) {
            if ($chval == $component) { 
                
                unset($this->children[$chkey]);
            }
          }
    }

    public function isComposite(): bool
    {
        return true;
    }

    public function diemDanh(): string
    {
        $results = [];
        foreach ($this->children as $child) {
            $results[] = $child->diemDanh();
        }

        return "Danh sách điểm danh của $this->name: (" . implode(" + ", $results) . ")";
    }
}

function clientCode(Component $component)
{
    echo "<br>" . "KẾT QUẢ: " . $component->diemDanh();
}

$trungDoi_1 = new Composite("Trung đội 1");
$trungDoi_2 = new Composite("Trung đội 2");

$tieuDoi_1 = new Composite("Tiểu đội 1");
$tieuDoi_2 = new Composite("Tiểu đội 2");
$tieuDoi_3 = new Composite("Tiểu đội 3");
$tieuDoi_4 = new Composite("Tiểu đội 4");

$tieuDoi_1->add(new BoDoi("Tùng"));
$tieuDoi_1->add(new BoDoi("Quang"));
$tieuDoi_1->add(new BoDoi("Nhựt"));

$tieuDoi_2->add(new BoDoi("Tân"));
$tieuDoi_2->add(new BoDoi("Tiến"));

$tieuDoi_3->add(new BoDoi("Cường"));
$tieuDoi_3->add(new BoDoi("Hoài"));
$tieuDoi_3->add(new BoDoi("Hoàng"));

$tieuDoi_4->add(new BoDoi("Nam"));
$tieuDoi_4->add(new BoDoi("Lan"));

$trungDoi_1->add($tieuDoi_1);
$trungDoi_1->add($tieuDoi_2);

$trungDoi_2->add($tieuDoi_3);
$trungDoi_2->add($tieuDoi_4);

$daiDoi_1 = new Composite("Đại đội 1");
$daiDoi_1->add($trungDoi_1);
$daiDoi_1->add($trungDoi_2);

echo "<br>" . "Trung đội 1: ";
clientCode($trungDoi_1);
echo "<br>";

echo "<br>" . "Trung đội 2: ";
clientCode($trungDoi_2);
echo "<br>"; 

echo "<br>" . "Đại đội 1: ";
clientCode($daiDoi_1);
echo "<br>";

$daiDoi_1->remove($trungDoi_1);
echo "<br>" . "Đại đội 1: (Sau khi bỏ Trung đội 1)";
clientCode($daiDoi_1);
echo "<br>";

//var_dump($tieuDoi_1);

function clientCode2(Component $component1, Component $component2)
{
    if ($component1->isComposite()) {
        $component1->add($component2);
    }
    echo "KẾT QUẢ: " . $component1->diemDanh();
}

// Tôi không cần kiểm tra các lớp thành phần ngay cả khi quản lý cây
//clientCode2($trungDoi_1, $tieuDoi_1);