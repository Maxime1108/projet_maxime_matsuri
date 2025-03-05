<link rel="stylesheet" href="<?= ROOT ?>public/assets/css/style-jeux.css">

<h1 class="category-title"><?= $categorie ?></h1>

<?php if (empty($produits)): ?>
    <p class="category-title">Aucun produit dans cette catégorie</p>
<?php endif; ?>

<div class="search-bar">
    <input type="text" id="search-input" placeholder="Rechercher un produit...">
</div>

<div class="manga-container">
    <?php foreach ($produits as $produit): ?>
        <div class="manga-card">
            <?php if ($produit->getTopVente() == 'oui'): ?>
                <span class="top-sale">#1 DES VENTES</span>
            <?php endif; ?>
            <img src="<?= ROOT . 'public/assets/img/' . $produit->getImage(); ?>" alt="<?= $produit->getTitle(); ?>">
            <h3><?= $produit->getTitle(); ?></h3>
            <p><?= $produit->getPrix(); ?>€</p>
            <div class="buttons">
                <button class="add-to-cart" data-id="<?= $produit->getId(); ?>" data-url="<?= addLink('panier', 'addToCart') ?>">Ajouter au Panier</button>
                <button class="view-article">
                    <a href="<?= addlink('produits', 'details', $produit->getId()); ?>">Voir l'Article</a>
                </button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-input");
    const productCards = document.querySelectorAll(".manga-card");

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();

        productCards.forEach(card => {
            const title = card.querySelector("h3").textContent.toLowerCase();
            card.style.display = title.includes(searchTerm) ? "block" : "none";
        });
    });
});
</script>


