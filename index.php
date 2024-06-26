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


    # constructor
    public function __construct(string $name, string $image, float $price, int | null $discount, string $animal, string $description, string $category)
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
    }

    # GETTERS
    protected function generateId()
    {
        $num = self::$product_number++;
        $id = "$this->animal-$this->category-$num";
        return $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getFullPrice(): float
    {
        return $this->fullPrice;
    }

    public function getDiscount(): int | null
    {
        return $this->discount;
    }

    public function getAnimal(): string
    {
        return $this->animal;
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

# class food EXTENDED FROM product
class Food extends Product
{
    #private properties
    private float $weight;
    private array $ingredients;

    #constructor polimorph of Product constructor
    public function __construct(string $name, string $image,  float $price, int | null $discount, string $animal, string $description, string $category, float $weight, array $ingredients)
    {
        parent::__construct($name, $image, $price, $discount, $animal, $description, $category);

        $this->weight = $weight;
        $this->ingredients = $ingredients;
    }

    public function getAttributes(): string
    {
        $ingredients = implode(", ", $this->ingredients);
        return "Peso: $this->weight Kg <br>Ingredienti: $ingredients";
    }
}


$text = file_get_contents(__DIR__ . '/db/productsDB.json');

$products_categories = json_decode($text, true);

foreach ($products_categories['food'] as $prodcut) {
    $tempFood = new Food($prodcut['name'], $prodcut['image'], $prodcut['price'], $prodcut['discount'], $prodcut['animal'], $prodcut['description'], "food", $prodcut['weight'], $prodcut['ingredients']);

    $products["food"][] = $tempFood;
}


$result = [...$products['food']];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container py-5">
        <div class="row row-cols-6 gap-5">
            <?php foreach ($result as $key => $prod) : ?>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $prod->getImage() ?>" alt="product image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $prod->getName() ?></h5>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</body>

</html>