<?php
$text = file_get_contents(__DIR__ . '/db/productsDB.json');

$products_categories = json_decode($text, true);
