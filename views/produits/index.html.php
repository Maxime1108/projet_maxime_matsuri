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

<div class="pagination">
    <a href="http://localhost/projet_maxime/produits/index?categorie=Jeux%20Videos" class="page-circle">1</a>
    <a href="http://localhost/projet_maxime/produits/index?categorie=Mangas"class="page-circle">2</a>
    <a href="http://localhost/projet_maxime/produits/index?categorie=Accessoires" class="page-circle">3</a>
    <a href="http://localhost/projet_maxime/produits/index?categorie=V%C3%AAtements%20Traditionnels" class="page-circle">4</a>
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".add-to-cart");

    buttons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            
           
            const card = this.closest(".manga-card");

           
            const existingMessage = card.querySelector(".cart-message");
            if (existingMessage) {
                existingMessage.remove();
            }

            
            const message = document.createElement("p");
            message.textContent = "✅ Ajouté au panier !";
            message.classList.add("cart-message");

           
            card.appendChild(message);

            
            setTimeout(() => {
                message.remove();
            }, 2000);
        });
    });
});
</script>
