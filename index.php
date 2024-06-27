<?php

$models_path = __DIR__ . "/models";

require_once $models_path . "/Product.php";
require_once $models_path . "/Food.php";
require_once $models_path . "/Item.php";







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