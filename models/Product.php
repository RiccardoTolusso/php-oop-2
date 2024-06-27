<?php
# class product
class Product
{
    # protected properties
    public static int $product_number = 0;
    protected string $id;
    protected string $name;
    protected string $image;
    protected float | null $price;
    protected float $fullPrice;
    protected int | null $discount;
    protected string $animal;
    protected string $description;
    protected string $category;
    protected int $stock;

    # constructor
    public function __construct(string $name, int $stock, string $image, float $price, int | null $discount, string $animal, string $description, string $category)
    {
        $this->name = strtoupper($name);
        $this->image = $image;
        $this->price = $this->setPrice($price, $discount);
        $this->fullPrice = $price;
        $this->discount = $discount;
        $this->animal = strtoupper($animal);
        $this->description = $description;
        $this->category = strtoupper($category);
        $this->id = $this->generateId();
        $this->stock = $stock;
    }

    # GETTERS
    protected function generateId()
    {
        $num = self::$product_number++;
        $id = "$num-$this->animal-$this->category";
        return $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float | null
    {
        return $this->price;
    }

    public function getFullPrice(): float
    {
        return $this->fullPrice;
    }

    public function getDiscount(): string | null
    {
        if (!is_null($this->discount)) {
            return $this->discount . "%";
        } else {
            return null;
        }
    }

    public function getAnimal(): string
    {
        if ($this->animal === "CAT") {
            return "Gatto";
        } elseif ($this->animal === "DOG") {
            return "Cane";
        } else {
            return "Animali";
        }
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getID(): string
    {
        return $this->id;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    #SETTERS
    public function setPrice(float $price, float | null $discount)
    {
        if (is_float($discount)) {
            return round($price / 100 * (100 - $discount), 2);
        } else {
            return null;
        }
    }
}
