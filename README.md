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
    
