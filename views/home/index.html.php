 <div class="categories">
     <?php
        // On a récupéré $categories du HomeController avec le tableau associatif donc on peut boucler directement dans la vue
        foreach ($categories as $category) {
            echo '
            <div class="category-card">
                <a href="' . addLink('produits', 'index') . '?categorie=' . $category['title'] . '">
                    <img src="' . ROOT . $category["image"] . '" alt="' . $category["title"] . '">
                    <h3>' . $category["title"] . '</h3>
                </a>
            </div>';
        }
        ?>
 </div>
