<?php
#class Object EXTENDED FROM product
class Item extends Product
{
    #private properties
    private string $dimensions;
    private array $materials;

    #constructor polimorph of Product constructor
    public function __construct(string $name, int $stock, string $image,  float $price, int | null $discount, string $animal, string $description, string $category, string $dimensions, array $materials)
    {
        parent::__construct($name, $stock,  $image, $price, $discount, $animal, $description, $category);

        $this->dimensions = $dimensions;
        $this->materials = $materials;
    }

    public function getAttributes(): string
    {
        $res = $this->dimensions;
        if (count($this->materials) > 0) {
            $materials = implode(", ", $this->materials);
            $res .= "<br>Materiali: $materials";
        }

        return $res;
    }
}
