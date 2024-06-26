- L'e-commerce vende *prodotti* per animali.
- I prodotti sono categorizzati, le *categorie* sono Cani o Gatti.
- I prodotti saranno oltre al *cibo*, anche *giochi*, *cucce*, etc.


CATEGORIE => SOTTO-CATEGORIE => PRODOTTO

CATEGORIA:
    -name: dog/cat
    -children: [
        CATEGORIA,
        CATEGORIA: [
            prodotto
        ]
    ]

prodotto{
    id
    made_for: cat dog all
    category: food/toy/doghouse
    nome
    prezzo
    sconto
    descrizione
    consigliato per
}

prodotto -> alimentare{
    peso
    ingredienti
}

prodotto -> oggetto {
    dimensione
    materiali
}
    

1. crea un file json contenente una lista di prodotti aventi le seguenti caratteristiche

nome 
prezzo
sconto (int or null)
animal
categoria food/toy/doghouse
descrizione

    peso
    indgredienti

    dimensione
    materiali

2. crea la classe Product
3. crea la classe food