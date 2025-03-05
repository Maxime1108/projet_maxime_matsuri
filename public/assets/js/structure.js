document.addEventListener('DOMContentLoaded', () => {

    const BUTTON = document.querySelectorAll('.add-to-cart');

    BUTTON.forEach((button) => {
        button.addEventListener('click', function (event) {
            const URL = this.getAttribute('data-url');
            const ID = this.getAttribute('data-id');

            fetch(URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: ID })
            })
                .then((result) => result.json())
                .then((result) => {
                    const parent = button.parentElement;

                    // Supprimer tous les éléments <p> enfants du parent
                    parent.querySelectorAll('p').forEach((p) => p.remove());

                    // Créer un nouvel élément <p> pour afficher le message
                    const info = document.createElement('p');

                    if (result.message) {
                        info.textContent = result.message;
                    } else {
                        info.textContent = result.doublon;
                    }

                    // Ajouter le nouvel élément <p> au parent du bouton
                    parent.append(info);
                })
                .catch((error) => console.log(error))
        })


    })

    // Ici on récupère la DIV qui contient l'input
    const QUANTITES = document.querySelectorAll('.quantites');
    // Le prix total
    const totalElement = document.querySelector('#total_price');

    // On créé une fonction qui recalcule le total à chaque changement de valeur dans un input pour obtenir le prix de tous les produits et faire leur total
    function recalculerTotal() {
        let total = 0;

        // Pour chaque div qui contient l'input
        QUANTITES.forEach((quantite) => {
            // On récupère l'input en lui même
            const INPUT = quantite.querySelector('input');
            // On remonte sur son parent et on récupère le prix unitaire
            const PRIX = parseFloat(quantite.parentElement.querySelector('.item_price').textContent);

            // Le sousTotal est égal à la valeur de l'input * le prix unitaire de chaque article
            let sousTotal = INPUT.value * PRIX;
            total += sousTotal;
        });

        totalElement.textContent = total.toFixed(2) + (" €");
    }

    // ici on va mettre un écouteur d'évenement sur chaque input dans les div .quantites qui appelera recalculerTotal() à chaque changement de valeur d'input, de plus on va faire une requete ajax pour mettre à jour la quantité du produit dans le panier de la session
    QUANTITES.forEach((quantite) => {
        const INPUT = quantite.querySelector('input');
        INPUT.addEventListener('input', function () {
            const ID = this.getAttribute('data-id');
            const URL = this.getAttribute('data-url');
            if (this.value < 1) {
                this.value = 1;
            }
            recalculerTotal();
            fetch(URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: ID, quantite: this.value })
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then((result) => {
                    if (result) {
                        INPUT.value = result.quantite;
                        totalElement.textContent = result.total.toFixed(2) + (" €");
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    });




    // Suppression du panier 

    const BOUTONSUPP = document.querySelectorAll('.item_supp')

    BOUTONSUPP.forEach((bouton) => {
        bouton.addEventListener('click', function () {
            const URL = this.getAttribute('data-url');
            const URLHOME = this.getAttribute('data-home');
            const ID = this.getAttribute('data-id');

            fetch(URL, {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: ID })
            }).then((result) => result.json()).then((result) => {

                if (result.success) {
                    this.parentElement.remove();
                    totalElement.textContent = result.newTotal.toFixed(2) + ('€');
                }
                if (result.newTotal <= 0) {
                    document.querySelector('.panier').innerHTML = `
            <h3>Votre panier est vide</h3>
            <a href="${URLHOME}">Retour à l'accueil</a>
        `;
                }

            }).catch((error) => console.log(error));
        })
    })
})