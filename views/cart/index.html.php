<h2>Votre Panier</h2>
<div class="panier">
    <?php if (!empty($panier)) {
        foreach ($panier as $p) {
    ?>
            <div class="item_panier">
                <img src="<?= ROOT . 'public/assets/img/' . $p['produit']->getImage(); ?>" alt="Image produit">
                <h3><?= $p['produit']->getTitle(); ?></h3>
                <p class="item_price"><?= $p['produit']->getPrix(); ?><span>€</span></p>
                <div class="quantites">
                    <label for="quantite">Quantité : </label>
                    <input type="number" value="<?= $p['quantite']; ?>" data-id="<?= $p['produit']->getId() ?>" data-url = "<?= addLink('panier','update'); ?>">
                </div>
                <button class="item_supp" data-id="<?= $p['produit']->getId(); ?>" data-url="<?= addLink('panier', 'supp', $p['produit']->getId()); ?>" data-home="<?= addLink('home', 'index'); ?>">Supprimer</button>
            </div>
        <?php
        } ?>
        <div>
            <h3>Total des articles</h3>
            <p id="total_price"><?= htmlspecialchars($total); ?><span> €</span></p>
        </div>

    <?php } else { ?>
        <h3>Votre panier est vide</h3>
        <a href="<?= addLink('home', 'index'); ?>">retour à l'accueil</a>
    <?php } ?>
    <link rel="stylesheet" href="<?= ROOT ?>public/assets/css/style-panier.css">
</div> 