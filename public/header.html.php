<!-- le header sera inclu dans toutes les pages -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT . 'public/assets/css/' . isset($categorie) ? "style-$categorie.css" : 'style.css' ?>">
    <link rel="stylesheet" href="<?= ROOT . 'public/assets/css/style-a-propos.css' ?>">
    <link rel="stylesheet" href="<?= ROOT . 'public/assets/css/style.css' ?>">


    <title>Document</title>
</head>

<body>
    <header>
        <h1><a href="<?= addLink('home', 'index') ?>">Matsuri</a></h1>
        <nav>
            <a href="<?= addLink('home', 'a_propos') ?>">À propos</a>
            <a href="<?= addLink('contact', 'index') ?>">Contact</a>
            <?php if (!empty($_SESSION['user'])) { ?>
                <a href="<?= addLink('panier','index') ?>"><img src="<?= ROOT . 'public/assets/img/panier.png' ?>" alt="Icone panier" id="img_panier"></a>
            <?php } ?>
            <?php if (empty($_SESSION['user'])) { ?>
                <div class="inscription_connexion">
                    <a href="<?= addLink('user', 'register') ?>">
                        <img src="<?= ROOT . '/public/assets/img/inscription2.png' ?>" alt="inscription">
                    </a>
                    <a href="<?= addLink('user', 'login'); ?>" class="avatar-link">
                        <img src="<?= ROOT . '/public/assets/img/kitsune.png' ?>" alt="Avatar" class="avatar-icon">
                    </a>
                </div>
            <?php } else { ?>

                <div class="inscription_connexion">
                    <span>Vous êtes connecté(e) en tant que <br> <?= $_SESSION['user']['username'] ?><a href="<?= addLink('admin/home', 'index') ?>"><?= $_SESSION['user']['role'] == 'admin' ? $_SESSION['user']['role'] : ''; ?></a></span>
                    <a href="<?= addLink('user', 'logout'); ?>" class="avatar-link">
                        <img src="<?= ROOT . '/public/assets/img/deconnecter.png' ?>" alt="Avatar" class="avatar-icon" title="Se Déconnecter">
                    </a>
                </div>
            <?php } ?>
        </nav>

    </header>
    <!-- On affiche ici les erreurs si elles existent (ça évitera de les passer à chaque vue dans chaque controleur) -->
    <?php if (!empty($_ENV['ERROR_MESSAGE'])): ?>
        <div class="error-message">
            <span class="alert-error"><?= htmlspecialchars($_ENV['ERROR_MESSAGE']) ?></span>
        </div>
    <?php endif; ?>

    