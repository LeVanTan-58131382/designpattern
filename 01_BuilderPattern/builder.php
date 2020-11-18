<?php

interface CoffeeBuilder
{

    public function prepareCoffeeAndWater(): void;

    public function boilWater(): void;

    public function mixCoffeeAndBoilWater(): void;
    
    public function addSugar(): void;

    public function addMilk(): void;
    
}

class MyCoffee implements CoffeeBuilder
{

    private $coffee;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->coffee = new Coffee();
    }

    public function prepareCoffeeAndWater(): void
    {
        $this->coffee->description .= " Chuẩn bị nước và coffee ";
    }

    public function boilWater(): void
    {
        $this->coffee->description .= " Đun sôi nước ";
    }

    public function mixCoffeeAndBoilWater(): void
    {
        $this->coffee->description .= " Pha coffee với nước sôi ";
    }

    public function addSugar(): void
    {
        $this->coffee->description .= " Thêm đường vào và khuấy đều ";
    }

    public function addMilk(): void
    {
        $this->coffee->description .= " Thêm sữa vào và khuấy đều ";
    }

    public function getCoffee(): Coffee
    {
        $result = $this->coffee;
        $this->reset();

        return $result;
    }
}

class Coffee
{
    public $description = "";

    public function describe(): void
    {
        echo "Mô tả ly Coffee của bạn: " . $this->description ."<br>";
    }
}

class Director
{
    /**
     * @var Builder
     */

    private $builder;

    public function setBuilder(CoffeeBuilder $builder): void
    {
        $this->builder = $builder;
    }

    public function makeCoffee(): void
    {
        $this->builder->prepareCoffeeAndWater();
        $this->builder->boilWater();
        $this->builder->mixCoffeeAndBoilWater();

        $this->builder->addSugar();
    }

    public function makeMilkCoffee(): void
    {
        $this->builder->prepareCoffeeAndWater();
        $this->builder->boilWater();
        $this->builder->mixCoffeeAndBoilWater();

        $this->builder->addMilk();
    }
}

function clientCode(Director $director)
{
    $builder = new MyCoffee();
    $director->setBuilder($builder);

    echo "Pha coffee đen: "."<br>";
    $director->makeCoffee();
    $builder->getCoffee()->describe(); 

    echo "Pha coffee sữa: "."<br>";
    $director->makeMilkCoffee();
    $builder->getCoffee()->describe();

}

$director = new Director();
clientCode($director);
