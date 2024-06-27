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


$text = file_get_contents(__DIR__ . '/db/productsDB.json');

$products_categories = json_decode($text, true);

foreach ($products_categories['food'] as $prodcut) {
    $tempFood = new Food($prodcut['name'], $prodcut['stock'], $prodcut['image'], $prodcut['price'], $prodcut['discount'], $prodcut['animal'], $prodcut['description'], "food", $prodcut['weight'], $prodcut['ingredients']);

    $products["food"][] = $tempFood;
}

foreach ($products_categories['doghouse'] as $prodcut) {
    $tempFood = new Item($prodcut['name'], $prodcut['stock'], $prodcut['image'], $prodcut['price'], $prodcut['discount'], $prodcut['animal'], $prodcut['description'], "food", $prodcut['dimensions'], $prodcut['materials']);

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

<body class="bg-dark">
    <div class="container py-5">
        <div class="row row-cols-4 gap-5">
            <?php foreach ($result as $key => $prod) : ?>
                <div class="card text-center text-bg-light pt-2">

                    <!-- BADGES -->
                    <div class="position-absolute end-0 top-0 d-flex">
                        <div class="badge bg-success fs-6 m-0"><?php echo $prod->getDiscount() ?></div>
                        <div class="badge bg-secondary fs-6"><?php echo $prod->getAnimal() ?></div>
                    </div>

                    <!-- IMMAGINE PRODOTTO -->
                    <img class="card-img-top" src="<?php echo $prod->getImage() ?>" alt="product image">

                    <!-- CARD BODY -->
                    <div class="card-body">

                        <!-- NOME PRODOTTO -->
                        <h5 class="card-title">
                            <?php echo $prod->getName() ?>
                        </h5>

                        <!-- PREZZO PRODOTTO -->
                        <h6 class="card-subtitle mb-3">
                            <?php if (is_null($prod->getDiscount())) : ?>
                                <?php echo $prod->getFullPrice(); ?>
                            <?php else : ?>
                                <span><?php echo $prod->getPrice() ?></span>
                                <del class="text-danger"><?php echo $prod->getFullPrice() ?></del>
                            <?php endif ?>
                        </h6>

                        <!-- DESCRIZIONE -->
                        <p class="card-text"><?php echo $prod->getDescription() ?></p>
                        <!-- ATTRIBUTI -->
                        <p class="card-text"><?php echo $prod->getAttributes() ?></p>
                    </div>

                    <!-- CARD FOOTER -->
                    <div class="card-footer text-body-secondary">
                        <?php if ($prod->getStock() === 0) : ?>
                            <button href="" class="btn btn-secondary" disabled>Scorte Esaurite</button>
                        <?php else : ?>
                            <button href="" class="btn btn-primary">Aggiungi al carrello</button>
                        <?php endif ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</body>

</html>