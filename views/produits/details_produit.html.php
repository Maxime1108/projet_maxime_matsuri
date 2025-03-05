<h2>Details produits</h2>

<!-- $produit vient de la méthode details dans la classe ProduitsController -->
<div class="container">
    <h1><?php echo $produit->getTitle() ?></h1>
    <img src="<?php echo ROOT . 'public/assets/img/' . $produit->getImage() ?>" alt="<?php echo $produit->getTitle() ?>">
    <p><span>Prix :</span> <?php echo $produit->getPrix(); ?></p>
    <p><span>Description :</span> <?php echo $produit->getDescription(); ?></p>
    <a href="<?= addLink('produits', 'index') . '?categorie=' . $produit->getCategorie(); ?>" class="return-link">Retour aux produits</a>
    <link rel="stylesheet" href="<?= ROOT . 'public/assets/css/style-produit.css'; ?>">

</div>