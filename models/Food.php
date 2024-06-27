<?php

# class food EXTENDED FROM product
class Food extends Product
{
    #private properties
    private float $weight;
    private array $ingredients;

    #constructor polimorph of Product constructor
    public function __construct(string $name, int $stock, string $image,  float $price, int | null $discount, string $animal, string $description, string $category, float $weight, array $ingredients)
    {
        parent::__construct($name, $stock,  $image, $price, $discount, $animal, $description, $category);

        $this->weight = $weight;
        $this->ingredients = $ingredients;
    }

    public function getAttributes(): string
    {
        $res = "Peso: $this->weight Kg";
        if (count($this->ingredients) > 0) {
            $ingredients = implode(", ", $this->ingredients);
            $res .= "<br>Ingredienti: $ingredients";
        }

        return $res;
    }
}
