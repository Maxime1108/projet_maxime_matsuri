<h1>Formulaire de paiement ici</h1>
<link rel="stylesheet" href="<?= ROOT . 'public/assets/css/style-paiement.css'; ?>">
<form method="post">
    <div class="payment-container">
        <h2>Paiement sécurisé</h2>

        <div class="card-icons">
            <div class="card-icon">VISA</div>
            <div class="card-icon">MC</div>
            <div class="card-icon">AMEX</div>
            <div class="card-icon">CB</div>
        </div>

        <form id="payment-form">
            <div class="form-group">
                <label for="card-holder">Titulaire de la carte</label>
                <input type="text" id="card-holder" placeholder="Nom sur la carte" name="titulaire" required>
            </div>

            <div class="form-group">
                <label for="card-number">Numéro de carte</label>
                <input type="text" id="card-number" placeholder="1234 5678 9012 3456" name="num_carte" maxlength="19" required>
            </div>

            <div class="form-group expiry-cvv">
                <div>
                    <label for="expiry-date">Date d'expiration</label>
                    <input type="text" id="expiry-date" placeholder="MM/AA" maxlength="5" name="expire" required>
                </div>
                <div>
                    <label for="cvv">Code de sécurité (CVV)</label>
                    <input type="text" id="cvv" placeholder="123" maxlength="4" name="cvv" required>
                </div>
            </div>

            <button type="submit" class="btn-pay" name="cart_pay">Payer maintenant</button>
        </form>

        <p class="secure-note">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 5px;">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            Toutes vos données sont chiffrées et sécurisées
        </p>
    </div>
</form>