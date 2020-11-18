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

    abstract public function getPrice(): int;
}


class Laptop extends Component
{
    public $name;
    public $price;
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return  $this->price;
    }
}

class Phone extends Component
{
    public $name;
    public $price;
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return  $this->price;
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

    public function getPrice(): int
    {
        $results = 0;
        foreach ($this->children as $child) {
            $results  += $child->getPrice();
        }
        return $results;
    }
}

function clientCode(Component $component)
{
    echo "<br>" . "KẾT QUẢ: " . $component->getPrice();
}

$Box_1 = new Composite("Thùng 1.0x");
$Box_2 = new Composite("Thùng 2.0x");

$Box_1->add(new Phone("SamSung Galasy 2018", 2000));
$Box_1->add(new Phone("IPhone 6", 5000));
$Box_1->add(new Phone("Nokia 3", 2500));
$Box_1->add(new Phone("Xiaomi Note 5", 1000));

$Box_2->add(new Laptop("Dell", 8000));
$Box_2->add(new Laptop("Mac", 5500));
$Box_2->add(new Laptop("Assus", 3500));
$Box_2->add(new Laptop("Acer", 1500));

$Box_3 = new Composite("Thùng 3.0x");
$Box_3->add($Box_1);
$Box_3->add($Box_2);

echo "<br>" . "Tổng giá Thùng 1.0x: ";
clientCode($Box_1);
echo "<br>";

echo "<br>" . "Tổng giá Thùng 2.0x: ";
clientCode($Box_2);
echo "<br>"; 

echo "<br>" . "Tổng giá Thùng 3.0x: ";
clientCode($Box_3);
echo "<br>";