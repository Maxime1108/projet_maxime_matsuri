<?php
$messageEnvoye = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $messageEnvoye = true;
}
?>

<main class="container mt-4">
    <?php if ($messageEnvoye): ?>
        <div class="alert alert-success" role="alert">
            Votre message a bien été envoyé. Merci, <?php echo $nom; ?> ! Nous vous contacterons dans les plus brefs délais.
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</main>

<link rel="stylesheet" href="<?= ROOT ?>public/assets/css/style-contact.css">